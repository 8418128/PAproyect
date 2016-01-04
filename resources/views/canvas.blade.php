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

        .footer {
            position: absolute;
            background-color: #222;
            text-align: center;
            bottom: 0px;
            left: 0px;
            right: 0px;
            height: 42px;
            padding:2px;
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
            width:360px;
            margin:auto;
            text-align:center;
        }
        .palette-box {
            float:left;
            padding:2px 6px 2px 6px;
        }
        .palette,.saveImg {
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

        .save{
            color:white;
        }


    #image{
        z-index: 10000;
    }


    </style>@endsection
@section('jscripts')
    <script type="text/javascript" src="{{asset('generalJs/canvas.js')}}"></script>
    <script type="text/javascript" src="{{asset('free/js/Matrix.js')}}"></script>
<script type="text/javascript" src="{{asset('free/js/jquery.freetrans.js')}}"></script>
    <script src="http://js.pusher.com/3.0/pusher.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{asset('free/css/jquery.freetrans.css')}}"/>
@endsection
@section('content')
    <div id="page">
        <div id='image' class="draggable-handler"></div>
    <div id="content"><p style="text-align:center">Loading Canvas...</p></div>

    <div class="footer">

        <div class="palette-case">
            <div id="save" class="palette-box">
                <div class="palette save">Save</div>
            </div>
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