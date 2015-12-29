@extends('master')
@section('title', 'Canvas')
@section('style')<style type="text/css">

        body {
            margin:0px;
            width:100%;
            height:100%;
            overflow:hidden;
            font-family:Arial;
            /* prevent text selection on ui */
            user-select: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            /* prevent scrolling in windows phone */
            -ms-touch-action: none;
            /* prevent selection highlight */
            -webkit-tap-highlight-color: rgba(0,0,0,0);
        }

        .header, .footer{
            position: absolute;
            background-color: #222;
            text-align: center;
        }
        .header {
            top: 0px;
            left: 0px;
            right: 0px;
            height: 32px;
            padding:6px;
        }
        .footer {
            bottom: 0px;
            left: 0px;
            right: 0px;
            height: 42px;
            padding:2px;
        }
        .title {
            width: auto;
            line-height: 32px;
            font-size: 20px;
            font-weight: bold;
            color: #eee;
            text-shadow: 0px -1px #000;
            padding:0 60px;
        }
        .navbtn {
            cursor: pointer;
            float:left;
            padding: 6px 10px;
            font-weight: bold;
            line-height: 18px;
            font-size: 14px;
            color: #eee;
            text-shadow: 0px -1px #000;
            border: solid 1px #111;
            border-radius: 4px;
            background-color: #404040;
            box-shadow: 0 0 1px 1px #555,inset 0 1px 0 0 #666;
        }
        .navbtn-hover, .navbtn:active {
            color: #222;
            text-shadow: 0px 1px #aaa;
            background-color: #aaa;
            box-shadow: 0 0 1px 1px #444,inset 0 1px 0 0 #ccc;
        }
        #content{
            position: absolute;
            top: 44px;
            left: 0px;
            right: 0px;
            bottom: 46px;
            overflow:hidden;
            background-color:#ddd;
        }
        #canvas{
            cursor:crosshair ;
            background-color:#fff;
        }
        .palette-case {
            width:260px;
            margin:auto;
            text-align:center;
        }
        .palette-box {
            float:left;
            padding:2px 6px 2px 6px;
        }
        .palette {
            border:2px solid #777;
            height:36px;
            width:36px;
        }
        .red{
            background-color:#c22;
        }
        .blue{
            background-color:#22c;
        }
        .green{
            background-color:#2c2;
        }
        .white{
            background-color:#fff;
        }
        .black{
            background-color:#000;
            border:2px dashed #fff;
        }

    #image{
        position:relative;
        z-index: 10000;
        curso:move;
        background-image: url('/socialnet/public/canvasimg/Sin%20título.png');
        left:0px;
        width:200px;
        height:200px;
    }

    </style>@endsection
@section('jscript'){{asset('generalJs/canvas.js')}}@endsection
@section('content')
<div id="page">
    <div class="header">
        <a id="new" class="navbtn" onclick="newCanvas()">New</a>
        <a id="save" class="navbtn" onclick="saveCanvas()">Save</a>
        <div class="title">Sketch Pad</div>
    </div>
    <div id="content"><p style="text-align:center">Loading Canvas...</p></div>
    <div class="footer">
        <div class="palette-case">
            <div class="palette-box">
                <div class="palette white" onclick="selectColor(this)"></div>
            </div>
            <div class="palette-box">
                <div class="palette red" onclick="selectColor(this)"></div>
            </div>
            <div class="palette-box">
                <div class="palette blue" onclick="selectColor(this)"></div>
            </div>
            <div class="palette-box">
                <div class="palette green" onclick="selectColor(this)"></div>
            </div>
            <div class="palette-box">
                <div class="palette black" onclick="selectColor(this)"></div>
            </div>
            <div style="clear:both"></div>
        </div>
    </div>
</div>
@endsection