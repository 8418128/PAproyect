<?php
/**
 * Created by PhpStorm.
 * User: S
 * Date: 22/11/2015
 * Time: 11:15
 */

namespace App\Http\Controllers;
use App\Chat;
use App\Comment;
use App\Guest;
use App\Painting;
use App\User;
use Carbon\Carbon;
use File;
use App\Canvas;
use Illuminate\Http\Request;
use DB;
use PDO;
class CanvasController extends Controller implements Pusheable
{

    function getCanvasView($id, Request $request)
    {
        $user = $request->session()->get('user_obj')->idUser;
        $c = Canvas::find($id);
        $g = Guest::where('user', $user)->where('canvas', $id)->get();
        if (empty($c))
            return "no hay canvas";
        else if (count($g) < 1)
            return "no estas invitado al canvas";
        return view('canvas')->with('canvas', $id);


    }

    function newCanvas(Request $request)
    {
        $user = $request->session()->get('user_obj');
        return view('newCanvas')->with('user', $user);
    }

    function createCanvas(Request $request)
    {
        $title = $request->input('title');
        $editable = $request->input('editable');
        $guests = $request->input('guests');
        $user = $request->session()->get('user_obj');

        $id = Canvas::create(array('user' => $user->idUser, 'title' => $title, 'editable' => $editable, 'preview' => 'noimg.png'))->idCanvas;

        foreach ($guests as $guest) {
            $g = new Guest();
            $g->user = $guest;
            $g->canvas = $id;
            $g->save();
            self::pushGuest($user->idUser, $guest, $id);

        }
        $g = new Guest();
        $g->user = $user->idUser;
        $g->canvas = $id;
        $g->save();

        return "/socialnet/public/canvas/" . $id;

    }

    function pushGuest($creator, $user, $canvas)
    {
        $chat = ['text' => 'Te he invitado a mi <a href="/socialnet/public/canvas/' . $canvas . '">canvas</a>', 'sends' => $creator];
        //$json = json_encode($chat);
        $c = new Chat();
        $c->sends = $creator;
        $c->receives = $user;
        $c->text = $chat['text'];
        $c->save();
        event(new \App\Events\ChEvent($user, $chat));
    }

    /**
     *OBTENER 0 O 1 EN BASE A SI EL CANVAS A SIDO MODIFICADO HACE 5 MINUTOS
     */
    function lastmod(Request $request)
    {
        $canvas_id = $request->input('canvas_id');

        $canvas_update = Canvas::find($canvas_id)->updated_at;
        $up = Carbon::createFromFormat('Y-m-d H:i:s', $canvas_update);
        $now = Carbon::now()->addMinutes(-5)->format('Y-m-d H:i:s');

        if ($now > $up) {
            return 1;
        }
        return 0;


    }


    /**
     *GUARDAR IMAGEN EN BASE 64
     */
    function save(Request $request)
    {
        $img = $request->input('img64');
        $filteredData = substr($img, strpos($img, ",") + 1);
        $unencodedData = base64_decode($filteredData);
        $uniq = uniqid();
        $f = public_path("canvasimg") . "\\" . $uniq . '.png';
        $fp = fopen($f, 'wb');
        fwrite($fp, $unencodedData);
        fclose($fp);

        return $uniq . '.png';
    }

    /**
     *GUARDAR EL PREVIEW CON UN 7% DE ALTURA Y DE ANCHURA AL ORIGINAL
     * UPDATEAR CANVAS Y BORRAR IMAGENES
     */
    function savePreview(Request $request)
    {
        $canvas_id = $request->input('canvas_id');
        $img = self::save($request);
        $canvas = Canvas::find($canvas_id);
        $previuos_preview = $canvas->preview;
        $f = public_path("preview") . "\\" . $previuos_preview;
        if ($previuos_preview != 'noimg.png')
            File::delete($f);

        $path = public_path("canvasimg") . "\\" . $img;
        list($width, $height) = getimagesize($path);
        $preview = "preview" . $img;
        self::smart_resize_image(null, file_get_contents($path), $width * 0.07, $height * 0.07, false, "preview/" . $preview, true, false, 100);
        $canvas->preview = $preview;
        $canvas->save();

        $images = $request->input('images');

        foreach ($images as $image) {
            $f = public_path("canvasimg") . "\\" . $image;
            File::delete($f);
        }

        return $img;


    }


    /**
     *CAMBIAR TAMAÑO IMAGEN
     */
    function resizeImage(Request $request)
    {
        $img = $request->input('src');
        $width = $request->input('width');
        $height = $request->input('height');
        $file = public_path("canvasimg") . '\\' . $img;


        $uniq = uniqid() . '.png';
        $resizedFile = public_path("canvasimg") . "\\" . $uniq;

        self::smart_resize_image(null, file_get_contents($file), $width, $height, false, $resizedFile, true, false, 100);

        File::delete($file);

        return $uniq;
    }


    /**
     *METODO MÁGICO PARA CAMBIAR TAMAÑO DE IMAGENES
     */
    static function smart_resize_image($file,
                                       $string = null,
                                       $width = 0,
                                       $height = 0,
                                       $proportional = false,
                                       $output = 'file',
                                       $delete_original = true,
                                       $use_linux_commands = false,
                                       $quality = 100)
    {

        if ($height <= 0 && $width <= 0) return false;
        if ($file === null && $string === null) return false;

        # Setting defaults and meta
        $info = $file !== null ? getimagesize($file) : getimagesizefromstring($string);
        $image = '';
        $final_width = 0;
        $final_height = 0;
        list($width_old, $height_old) = $info;
        $cropHeight = $cropWidth = 0;

        # Calculating proportionality
        if ($proportional) {
            if ($width == 0) $factor = $height / $height_old;
            elseif ($height == 0) $factor = $width / $width_old;
            else                    $factor = min($width / $width_old, $height / $height_old);

            $final_width = round($width_old * $factor);
            $final_height = round($height_old * $factor);
        } else {
            $final_width = ($width <= 0) ? $width_old : $width;
            $final_height = ($height <= 0) ? $height_old : $height;
            $widthX = $width_old / $width;
            $heightX = $height_old / $height;

            $x = min($widthX, $heightX);
            $cropWidth = ($width_old - $width * $x) / 2;
            $cropHeight = ($height_old - $height * $x) / 2;
        }

        # Loading image to memory according to type
        switch ($info[2]) {
            case IMAGETYPE_JPEG:
                $file !== null ? $image = imagecreatefromjpeg($file) : $image = imagecreatefromstring($string);
                break;
            case IMAGETYPE_GIF:
                $file !== null ? $image = imagecreatefromgif($file) : $image = imagecreatefromstring($string);
                break;
            case IMAGETYPE_PNG:
                $file !== null ? $image = imagecreatefrompng($file) : $image = imagecreatefromstring($string);
                break;
            default:
                return false;
        }


        # This is the resizing/resampling/transparency-preserving magic
        $image_resized = imagecreatetruecolor($final_width, $final_height);
        if (($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG)) {
            $transparency = imagecolortransparent($image);
            $palletsize = imagecolorstotal($image);

            if ($transparency >= 0 && $transparency < $palletsize) {
                $transparent_color = imagecolorsforindex($image, $transparency);
                $transparency = imagecolorallocate($image_resized, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
                imagefill($image_resized, 0, 0, $transparency);
                imagecolortransparent($image_resized, $transparency);
            } elseif ($info[2] == IMAGETYPE_PNG) {
                imagealphablending($image_resized, false);
                $color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
                imagefill($image_resized, 0, 0, $color);
                imagesavealpha($image_resized, true);
            }
        }
        imagecopyresampled($image_resized, $image, 0, 0, $cropWidth, $cropHeight, $final_width, $final_height, $width_old - 2 * $cropWidth, $height_old - 2 * $cropHeight);


        # Taking care of original, if needed
        if ($delete_original) {
            if ($use_linux_commands) exec('rm ' . $file);
            else @unlink($file);
        }

        # Preparing a method of providing result
        switch (strtolower($output)) {
            case 'browser':
                $mime = image_type_to_mime_type($info[2]);
                header("Content-type: $mime");
                $output = NULL;
                break;
            case 'file':
                $output = $file;
                break;
            case 'return':
                return $image_resized;
                break;
            default:
                break;
        }

        # Writing image according to type to the output destination and image quality
        switch ($info[2]) {
            case IMAGETYPE_GIF:
                imagegif($image_resized, $output);
                break;
            case IMAGETYPE_JPEG:
                imagejpeg($image_resized, $output, $quality);
                break;
            case IMAGETYPE_PNG:
                $quality = 9 - (int)((0.9 * $quality) / 10.0);
                imagepng($image_resized, $output, $quality);
                break;
            default:
                return false;
        }

        return true;
    }

    function viewMyCanvas(Request $request)
    {//Obtengo los canvas del usuario
        $idUser = $request->session()->get('user_obj')->idUser;
        $canvas = Canvas::viewCanvas($idUser);
        $c = [];
        foreach ($canvas as $canva) {
            $c[] = $canva;//Cambas del usuario
        }
        //Obtener los canvas invitados
        $guests = Guest::viewCanvasInvited($idUser);//Obtengo los canvas que me han invitado
        $cg = [];
        foreach ($guests as $canva) {
            $cg[] = $canva->canvas;
        }
        if (count($cg) > 0) {
            $canvasGuests = Canvas::getCanvasId($cg);
        } else {
            $canvasGuests = [];
        }
        //var_dump($canvasGuests);

    return view('atelier', ['canvas' => $c, 'idUserSession' => $idUser, 'invited' => $canvasGuests]);

    }


    function viewMyPainting(Request $request)
    {//Obtengo los canvas del usuario
        $idUser = $request->session()->get('user_obj')->idUser;
        $painting = Painting::viewMyPainting($idUser);
        $c = [];
        foreach ($painting as $paint) {
            $c[] = $paint;


            return view('gallery', ['painting' => $c, 'idUserSession' => $idUser]);
        }
    }


    function paintingHome(Request $request)
    {
        $idUser = $request->session()->get('user_obj')->idUser;
        DB::setFetchMode(PDO::FETCH_ASSOC);
        $x = DB::table('friends')->select('friend')->where('user', $idUser)->get();//obtengo mis amigos
        $fs = [];
        foreach ($x as $n) {
            $fs[] = $n['friend'];
        }

        //DB::enableQueryLog();
        $autor = [];
        $comments = [];
        $painting = Painting::viewPaintingFriend($fs);
        if (count($painting) > 0) {
            foreach ($painting as $paint) {
                // var_dump($paint->comments());
                $name = User::getUserById($paint->publish);//Obtengos los nonbres de quien ha hecho el canvas
                $autor = [$paint->publish => $name->get(0)->name];
                $comment = Comment::viewCommentById($paint->idPainting);//Obtengo los comentarios del painting
                // var_dump($comment->publish());
                // $name = User::getUserById($comment->publish);//Obtengo el nombre de usuario quien lo escribe
                //  $comments = [];
            }

        }
        // dd(DB::getQueryLog());
        return view('home', ['painting' => $painting, 'idUserSession' => $idUser, 'autor' => $autor]);

    }


    function comment(Request $request)
    {
        $comentario = $request->input('comment');
        $idCanva = $request->input('id');
        $userId = $request->session()->get('user_obj')->idUser;
        $new_comment = new Comment();
        $new_comment->painting = $idCanva;
        $new_comment->publish = $userId;
        $new_comment->text = $comentario;
        $new_comment->save();

        $user = ['name' => $new_comment->publish()->name, 'text' => $new_comment->text];
        return $user;


    }


    function push(Request $request)
    {
        $json = $request->input('doc');
        event(new \App\Events\ChEvent($json['canvas_id'], $json));
        return "OKK-->";
    }


}