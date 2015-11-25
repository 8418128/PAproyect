<?php
/**
 * Created by PhpStorm.
 * User: S
 * Date: 22/11/2015
 * Time: 11:15
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class CanvasController extends Controller
{
    function save(Request $request){
        $img = $request->input('img64');
        $filteredData=substr($img, strpos($img, ",")+1);
        $unencodedData=base64_decode($filteredData);
        $f =  public_path("canvasimg") . "\\" . uniqid() .'.png';
        $fp = fopen($f, 'wb' );
        fwrite( $fp, $unencodedData);
        fclose( $fp );

        return 'main';

    }
}