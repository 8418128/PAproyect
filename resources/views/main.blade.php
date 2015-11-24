<?php
/**
 * Created by PhpStorm.
 * User: S
 * Date: 21/11/2015
 * Time: 20:17
 */
?>
<style>
.capa{
  position: absolute;
  top:0;
  z-index: -1;
 }
 body{
  background-color: #8a6d3b;
 }

</style>

 <p>Bienvenido {{ $user->nick }}</p>
<h1>Imagenes(todas):</h1>
@foreach ($user->images as $image)
 <p>Imagen: {{ $image->name }}</p>
 <p>Comentario: {{ $image->comment }}</p>
 <hr/>
@endforeach

<h1>Imagenes(con where comment like desfve):</h1>
@foreach ($user->imagesLike("desfve") as $image)
 <p>Imagen: {{ $image->name }}</p>
 <p>Comentario: {{ $image->comment }}</p>
 <hr/>
@endforeach
<p>nuevo commit dris dross</p>
<img class="capa" src="{{ asset('canvas/56538d38c89e0.png') }}"/>
<img class="capa" src="{{ asset('canvas/56538eafaeb75.png') }}"/>
