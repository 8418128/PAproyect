<?php
/**
 * Created by PhpStorm.
 * User: S
 * Date: 22/11/2015
 * Time: 11:15
 */

namespace App\Http\Controllers;
use Carbon\Carbon;
use File;
use App\Painting;
use Illuminate\Http\Request;

class CanvasController extends Controller
{
    function lastmod(Request $request){
        $canvas_id = $request->input('canvas_id');
        $now = Carbon::now();
        $canvas_update = Painting::find($canvas_id)->update_at;
        if($now->subMinutes(5) > $canvas_update)
            return true;
        return false;
    }

    function push(Request $request){
        $json = $request->input('doc');
        event(new \App\Events\ChEvent($json['canvas_id'],$json));
        return "OKK-->";
    }


    function save(Request $request){
        $img = $request->input('img64');
        $filteredData=substr($img, strpos($img, ",")+1);
        $unencodedData=base64_decode($filteredData);
        $uniq = uniqid();
        $f =  public_path("canvasimg") . "\\" . $uniq .'.png';
        $fp = fopen($f, 'wb' );
        fwrite( $fp, $unencodedData);
        fclose( $fp );

        return $uniq.'.png';

    }



    function resizeImage(Request $request){
        $img = $request->input('src');
        $width = $request->input('width');
        $height = $request->input('height');
        $file = public_path("canvasimg").'\\'.$img;

        //indicate the path and name for the new resized file
        $uniq = uniqid().'.png';
        $resizedFile =  public_path("canvasimg") . "\\" . $uniq;
        //call the function (when passing path to pic)
        self::smart_resize_image(null , file_get_contents($file), $width, $height, false , $resizedFile , true , false ,100 );

        File::delete($file);
        //rename($resizedFile,public_path("canvasimg").'\\'.$img);

        return $uniq;
    }



    static function smart_resize_image($file,
                                $string             = null,
                                $width              = 0,
                                $height             = 0,
                                $proportional       = false,
                                $output             = 'file',
                                $delete_original    = true,
                                $use_linux_commands = false,
                                $quality = 100
    ) {

        if ( $height <= 0 && $width <= 0 ) return false;
        if ( $file === null && $string === null ) return false;

        # Setting defaults and meta
        $info                         = $file !== null ? getimagesize($file) : getimagesizefromstring($string);
        $image                        = '';
        $final_width                  = 0;
        $final_height                 = 0;
        list($width_old, $height_old) = $info;
        $cropHeight = $cropWidth = 0;

        # Calculating proportionality
        if ($proportional) {
            if      ($width  == 0)  $factor = $height/$height_old;
            elseif  ($height == 0)  $factor = $width/$width_old;
            else                    $factor = min( $width / $width_old, $height / $height_old );

            $final_width  = round( $width_old * $factor );
            $final_height = round( $height_old * $factor );
        }
        else {
            $final_width = ( $width <= 0 ) ? $width_old : $width;
            $final_height = ( $height <= 0 ) ? $height_old : $height;
            $widthX = $width_old / $width;
            $heightX = $height_old / $height;

            $x = min($widthX, $heightX);
            $cropWidth = ($width_old - $width * $x) / 2;
            $cropHeight = ($height_old - $height * $x) / 2;
        }

        # Loading image to memory according to type
        switch ( $info[2] ) {
            case IMAGETYPE_JPEG:  $file !== null ? $image = imagecreatefromjpeg($file) : $image = imagecreatefromstring($string);  break;
            case IMAGETYPE_GIF:   $file !== null ? $image = imagecreatefromgif($file)  : $image = imagecreatefromstring($string);  break;
            case IMAGETYPE_PNG:   $file !== null ? $image = imagecreatefrompng($file)  : $image = imagecreatefromstring($string);  break;
            default: return false;
        }


        # This is the resizing/resampling/transparency-preserving magic
        $image_resized = imagecreatetruecolor( $final_width, $final_height );
        if ( ($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG) ) {
            $transparency = imagecolortransparent($image);
            $palletsize = imagecolorstotal($image);

            if ($transparency >= 0 && $transparency < $palletsize) {
                $transparent_color  = imagecolorsforindex($image, $transparency);
                $transparency       = imagecolorallocate($image_resized, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
                imagefill($image_resized, 0, 0, $transparency);
                imagecolortransparent($image_resized, $transparency);
            }
            elseif ($info[2] == IMAGETYPE_PNG) {
                imagealphablending($image_resized, false);
                $color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
                imagefill($image_resized, 0, 0, $color);
                imagesavealpha($image_resized, true);
            }
        }
        imagecopyresampled($image_resized, $image, 0, 0, $cropWidth, $cropHeight, $final_width, $final_height, $width_old - 2 * $cropWidth, $height_old - 2 * $cropHeight);


        # Taking care of original, if needed
        if ( $delete_original ) {
            if ( $use_linux_commands ) exec('rm '.$file);
            else @unlink($file);
        }

        # Preparing a method of providing result
        switch ( strtolower($output) ) {
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
        switch ( $info[2] ) {
            case IMAGETYPE_GIF:   imagegif($image_resized, $output);    break;
            case IMAGETYPE_JPEG:  imagejpeg($image_resized, $output, $quality);   break;
            case IMAGETYPE_PNG:
                $quality = 9 - (int)((0.9*$quality)/10.0);
                imagepng($image_resized, $output, $quality);
                break;
            default: return false;
        }

        return true;
    }



}