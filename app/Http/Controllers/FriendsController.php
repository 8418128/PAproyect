<?php namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Friend;
use PhpParser\Node\Expr\Cast\Array_;
use Validator;
use Input;
use File;
use DB;
use PDO;
class FriendsController extends Controller {

  public function getPeticiones(Request $request) {
      $user=$request->session()->get('user_obj');
      $peticiones=Friend::getPeticionFriend($user->idUser);
      $friend=[];
      foreach($peticiones as $p) {
          $friend[] = User::getUserById($p->friend);

      }
      $fr=$this->getSuggestedFriend($user->idUser);
      //var_dump($fr);
     return view('search', ['peticiones' => $friend,'friend'=>$fr, 'idUserSession'=>$user->idUser]);
  }
    public function getSuggestedFriend($userId){
        //$userId=$request->session()->get('user_obj')->idUser;
        //$friend_ids=DB::table('friends')->select("friend")->where('user','=',$user->idUser)->get();
        //$friend=Friend::getFriend($friend_ids);
        DB::setFetchMode(PDO::FETCH_ASSOC);
        $x = DB::table('friends')->select('friend')->where('user',$userId)->get();//obtengo mis amigos
        $fs=[];
        foreach($x as $n)
            $fs[] = $n['friend'];

        //DB::enableQueryLog();
        if(count($fs>0)) {
            $friends = Friend::whereIn('user', $fs)->where('status', 1)->get();//obtengo los amigos de los amigos
            $cont = 0;
            $fr = [];
            foreach ($friends as $f) {
                if ($f->us->idUser != $userId) {
                    if (!in_array($f->us->idUser, $fs)) {
                        if ($cont == 0) {
                            $fr[] = $f->us;
                        } else {
                            if (!in_array($f->us->idUser, $fr)) {
                                $fr[] = $f->us;
                                $cont++;
                            }
                        }

                    }
                }

            }
            //dd(DB::getQueryLog());
        }
        return $fr;
    }
public function send($friendId, Request $request){
    $user=$request->session()->get('user_obj')->idUser;
    $sendUser=new Friend();
    $sendUser->user=$user;
    $sendUser->friend=$friendId;
    $sendUser->status=0;
    $sendUser->action_user=1;//Envia la peticion
    $sendUser->save();

    $friend=new Friend();
    $friend->user=$friendId;
    $friend->friend=$user;
    $friend->status=0;
    $friend->action_user=0;//Quien recive la peticion
    $friend->save();

    return redirect('search2');

}

    public function send2($friendId, Request $request){
        $user=$request->session()->get('user_obj')->idUser;
        $sendUser=new Friend();
        $sendUser->user=$user;
        $sendUser->friend=$friendId;
        $sendUser->status=0;
        $sendUser->action_user=1;//Envia la peticion
        $sendUser->save();

        $friend=new Friend();
        $friend->user=$friendId;
        $friend->friend=$user;
        $friend->status=0;
        $friend->action_user=0;//Quien recive la peticion
        $friend->save();

        return redirect()->back()->with('id',$friendId);

    }


    public function send3($friendId, Request $request){
        $user=$request->session()->get('user_obj')->idUser;
        $sendUser=new Friend();
        $sendUser->user=$user;
        $sendUser->friend=$friendId;
        $sendUser->status=0;
        $sendUser->action_user=1;//Envia la peticion
        $sendUser->save();

        $friend=new Friend();
        $friend->user=$friendId;
        $friend->friend=$user;
        $friend->status=0;
        $friend->action_user=0;//Quien recive la peticion
        $friend->save();

        return redirect('search2');

    }



    public function lookFor(Request $request){
       /* $name=$request->input('buscar');
        return User::findByUserName($name);*/
        $name = $request->input('name');
        $userId=$request->session()->get('user_obj')->idUser;
//var_dump( User::findByUserName($name));
       //return response()->json(['users'=> User::findByUserName($name)]);
        $us=[];
        $friendok=[];
        if($name!=''){
            $users=User::findByUserName($name);
            foreach($users as $u){
               if($u->idUser != $userId){
                   if(Friend::viewFriend($u->idUser,$userId)){
                        $friendok[]=$u->idUser;
                   }
                   $us[]=$u;
               }


            }
        }
       return view('lookForUsers', ['users' => $us,'friend'=>$friendok,'idUserSession'=>$userId]);


    }

    public function add($friendId, Request $request){
        $user=$request->session()->get('user_obj')->idUser;
        $friend=Friend::getFriends($user,$friendId);
        foreach($friend as $f){
            Friend::updateFriend($f);
        }

        $friend=Friend::getFriends($friendId,$user);
        foreach($friend as $f){
            Friend::updateFriend($f);
        }


        return redirect('search2');
    }

    public function declined($friendId, Request $request){
        $user=$request->session()->get('user_obj')->idUser;
        Friend::getFriendsDelete($user,$friendId);
        Friend::getFriendsDelete($friendId,$user);

        return redirect('search2');


    }

    public function declined2($friendId, Request $request){
        $user=$request->session()->get('user_obj')->idUser;
        Friend::getFriendsDelete($user,$friendId);
        Friend::getFriendsDelete($friendId,$user);

      //  return redirect('friendProfile');
        return redirect()->back()->with('id',$friendId);


    }

      
}
