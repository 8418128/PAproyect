<?php
/**
 * Created by PhpStorm.
 * User: S
 * Date: 23/01/2016
 * Time: 18:34
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
interface Pusheable
{
    function push(Request $request);

}