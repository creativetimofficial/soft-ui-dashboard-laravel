<!DOCTYPE html>
<html>
    <head>
        <title>Produto QR Code</title>
        @if ($input['type']=='horizontal')
            <style type="text/css">
                p,img,span{
                    color: #4e515f;
                    position: absolute;
                    z-index: 9999999;
                }
                .row, div, .col {
                    text-align: center;
                    margin: 0 auto;
                }
                p,span {
                    font-family: 'Dosis';
                }
                .nomeproduto {
                    font-size: 40px;
                    line-height: 45px;
                    width: 85%;
                    margin: 0 auto;
                    left: 0;
                    right: 0;
                    top: 120px;
                }
                .textovalidade {
                    font-size: 14px;
                    position: absolute;
                    width: 100%;
                    margin: 0 auto;
                    left: 0;
                    right: 0;
                    font-weight: bold;
                    top: 46%;
                }
                .qrcodeimg{
                    position: absolute;
                    left: 30px;
                    position: absolute;
                    margin-top: 190px;
                }
                .compresite{
                    font-size: 15px;
                    font-weight: bold;
                    left: 95px;
                    margin-top: 410px;
                }
                .por {
                    font-size: 30px;
                    font-weight: bold;
                    left: 450px;
                    margin-top: 190px;
                }
                .por2{
                    font-size: 30px;
                    font-weight: bold;
                    left: 450px;
                    margin-top: 380px;
                }
                .por3 {
                    font-size: 30px;
                    font-weight: bold;
                    right: 210px;
                    margin-top: 370px;
                }
                .por4 {
                    font-size: 30px;
                    font-weight: bold;
                    right: 210px;
                    margin-top: 380px;
                }
                .por5 {
                    font-size: 30px;
                    font-weight: bold;
                    right: 220px;
                    margin-top: 380px;
                }
                .precoprincipal2 {
                    font-size: 160px;
                    margin-top: 190px;
                    left: 380px;
                    font-weight: bold;
                }
                .precoprincipal3 {
                    font-size: 150px;
                    margin-top: 190px;
                    right: 60px;
                    font-weight: bold;
                }
                .precoprincipal4 {
                    font-size: 130px;
                    margin-top: 190px;
                    right: 60px;
                    font-weight: bold;
                }
                .precoprincipal5 {
                    font-size: 100px;
                    margin-top: 190px;
                    right: 60px;
                    font-weight: bold;
                }
                .precounitario{
                    margin-top: 410px;
                    font-size: 22px;
                    left: 420px;
                    font-weight: bold;
                }
                .rs {
                    font-size: 30px;
                    font-weight: 100;
                }

                .nomeproduto2 {
                    font-size: 40px;
                    line-height: 45px;
                    width: 85%;
                    margin: 0 auto;
                    left: 0;
                    right: 0;
                    top: 690px;
                }
                .textovalidade2 {
                    font-size: 14px;
                    position: absolute;
                    width: 100%;
                    margin: 0 auto;
                    left: 0;
                    right: 0;
                    font-weight: bold;
                    bottom: 3%;
                }
                .qrcodeimgsecond{
                    position: absolute;
                    left: 90px;
                    position: absolute;
                    margin-top: 760px;
                }
                .compresite2{
                    font-size: 15px;
                    font-weight: bold;
                    left: 95px;
                    margin-top: 980px;
                }
                .por2 {
                    font-size: 30px;
                    font-weight: bold;
                    left: 450px;
                    margin-top: 760px;
                }
                .por22{
                    font-size: 30px;
                    font-weight: bold;
                    left: 450px;
                    margin-top: 950px;
                }
                .por32 {
                    font-size: 30px;
                    font-weight: bold;
                    right: 210px;
                    margin-top: 940px;
                }
                .por42 {
                    font-size: 30px;
                    font-weight: bold;
                    right: 210px;
                    margin-top: 950px;
                }
                .por52 {
                    font-size: 30px;
                    font-weight: bold;
                    right: 220px;
                    margin-top: 950px;
                }
                .precoprincipal22 {
                    font-size: 160px;
                    margin-top: 760px;
                    left: 380px;
                    font-weight: bold;
                }
                .precoprincipal32 {
                    font-size: 150px;
                    margin-top: 760px;
                    right: 60px;
                    font-weight: bold;
                }
                .precoprincipal42 {
                    font-size: 130px;
                    margin-top: 760px;
                    right: 60px;
                    font-weight: bold;
                }
                .precoprincipal52 {
                    font-size: 100px;
                    margin-top: 760px;
                    right: 60px;
                    font-weight: bold;
                }
                .precounitario2{
                    margin-top: 980px;
                    font-size: 22px;
                    left: 420px;
                    font-weight: bold;
                }
                .rs2 {
                    font-size: 30px;
                    font-weight: 100;
                }
            </style>
        @else
            <style type="text/css">
                p,img,span{
                    color: #4e515f;
                    position: absolute;
                    z-index: 9999999;
                }
                .row, div, .col {
                    text-align: center;
                    margin: 0 auto;
                }
                p,span {
                    font-family: 'Dosis';
                }
                .nomeproduto {
                    font-size: 40px;
                    line-height: 45px;
                    width: 85%;
                    margin: 0 auto;
                    left: 0;
                    right: 0;
                    top: 120px;
                }
                .textovalidade {
                    font-size: 14px;
                    position: absolute;
                    width: 100%;
                    margin: 0 auto;
                    left: 0;
                    right: 0;
                    font-weight: bold;
                    top: 46%;
                }
                .qrcodeimg{
                    position: absolute;
                    left: 30px;
                    position: absolute;
                    margin-top: 190px;
                }
                .compresite{
                    font-size: 15px;
                    font-weight: bold;
                    left: 95px;
                    margin-top: 410px;
                }
                .por {
                    font-size: 30px;
                    font-weight: bold;
                    left: 450px;
                    margin-top: 190px;
                }
                .porr{
                    font-size: 30px;
                    font-weight: bold;
                    left: 450px;
                    margin-top: 190px;
                }
                .por3 {
                    font-size: 30px;
                    font-weight: bold;
                    right: 210px;
                    margin-top: 370px;
                }
                .por4 {
                    font-size: 30px;
                    font-weight: bold;
                    right: 210px;
                    margin-top: 380px;
                }
                .por5 {
                    font-size: 30px;
                    font-weight: bold;
                    right: 220px;
                    margin-top: 380px;
                }
                .precoprincipal2 {
                    font-size: 160px;
                    margin-top: 190px;
                    left: 380px;
                    font-weight: bold;
                }
                .precoprincipal3 {
                    font-size: 150px;
                    margin-top: 190px;
                    right: 60px;
                    font-weight: bold;
                }
                .precoprincipal4 {
                    font-size: 130px;
                    margin-top: 190px;
                    right: 60px;
                    font-weight: bold;
                }
                .precoprincipal5 {
                    font-size: 100px;
                    margin-top: 190px;
                    right: 60px;
                    font-weight: bold;
                }
                .precounitario{
                    margin-top: 410px;
                    font-size: 22px;
                    left: 420px;
                    font-weight: bold;
                }
                .rs {
                    font-size: 30px;
                    font-weight: 100;
                }

                .nomeproduto2 {
                    font-size: 40px;
                    line-height: 45px;
                    width: 85%;
                    margin: 0 auto;
                    left: 0;
                    right: 0;
                    top: 690px;
                }
                .textovalidade2 {
                    font-size: 14px;
                    position: absolute;
                    width: 100%;
                    margin: 0 auto;
                    left: 0;
                    right: 0;
                    font-weight: bold;
                    bottom: 3%;
                }
                .qrcodeimgsecond{
                    position: absolute;
                    left: 90px;
                    position: absolute;
                    margin-top: 760px;
                }
                .compresite2{
                    font-size: 15px;
                    font-weight: bold;
                    left: 95px;
                    margin-top: 980px;
                }
                .por2 {
                    font-size: 30px;
                    font-weight: bold;
                    left: 450px;
                    margin-top: 760px;
                }
                .por22{
                    font-size: 30px;
                    font-weight: bold;
                    left: 450px;
                    margin-top: 760px;
                }
                .por32 {
                    font-size: 30px;
                    font-weight: bold;
                    right: 210px;
                    margin-top: 940px;
                }
                .por42 {
                    font-size: 30px;
                    font-weight: bold;
                    right: 210px;
                    margin-top: 950px;
                }
                .por52 {
                    font-size: 30px;
                    font-weight: bold;
                    right: 220px;
                    margin-top: 950px;
                }
                .precoprincipal22 {
                    font-size: 160px;
                    margin-top: 760px;
                    left: 380px;
                    font-weight: bold;
                }
                .precoprincipal32 {
                    font-size: 150px;
                    margin-top: 760px;
                    right: 60px;
                    font-weight: bold;
                }
                .precoprincipal42 {
                    font-size: 130px;
                    margin-top: 760px;
                    right: 60px;
                    font-weight: bold;
                }
                .precoprincipal52 {
                    font-size: 100px;
                    margin-top: 760px;
                    right: 60px;
                    font-weight: bold;
                }
                .precounitario2{
                    margin-top: 980px;
                    font-size: 22px;
                    left: 420px;
                    font-weight: bold;
                }
                .rs2 {
                    font-size: 30px;
                    font-weight: 100;
                }
            </style>
        @endif
        
    </head>
    <body>
        @php
            if(isset($input['nomeproduto1'])){ $nomeproduto = nl2br(trim($input['nomeproduto1'])); }else{ $nomeproduto = ''; }
            if(isset($input['quantidade1'])){ $quantidade = nl2br(trim($input['quantidade1'])); }else{ $quantidade = 0; }
            if(isset($input['precoprincipal1'])){ $precoprincipal = nl2br(trim($input['precoprincipal1'])); }else{ $precoprincipal = ''; }
            if(isset($input['precocentavos1'])){ $precocentavos = nl2br(trim($input['precocentavos1'])); }else{ $precocentavos = ''; }
            if(isset($input['textovalidade1'])){ $textovalidade = nl2br(trim($input['textovalidade1'])); }else{ $textovalidade = ''; }
            if(isset($input['precounitario1'])){ $precounitario = nl2br(trim($input['precounitario1'])); }else{ $precounitario = ''; } 
        @endphp
        @if ($nomeproduto!=''&&$precoprincipal!=''&&$textovalidade!='')
            @if ($input['type']=='horizontal') {
                <p class="nomeproduto">{{$nomeproduto}}</p>
            @else
                <p class="nomeproduto">{{$nomeproduto}}</p>
            @endif
                <div class="qrcodeimg">
                    <img src="{{$input['qrcode1']}}" />
                </div>
                <p class="compresite">Compre pelo site</p>
                @if($quantidade>1)
                    <p class="por">LEVE {{$quantidade}} E PAGUE</p>
                @endif
                
                @if($quantidade==0&&$precounitario!='')
                    <p class="porr">DE R${{$precounitario}} POR:</p>
                @endif
                
                @switch(strlen($precoprincipal))
                    @case('1')
                    @case('2')
                    @case('3')
                    @case('4')
                        <p class="precoprincipal2 top1"><span class="rs">R$ </span>{{$precoprincipal}}</p>
                        @break
                    @case('5')
                        <p class="precoprincipal3 top1"><span class="rs">R$ </span>{{$precoprincipal}}</p>
                        @break
                    @case('6')
                        <p class="precoprincipal4 top1"><span class="rs">R$ </span>{{$precoprincipal}}</p>
                        @break
                    @default
                    <p class="precoprincipal5 top1"><span class="rs">R$ </span>{{$precoprincipal}}</p>
                    @break
                @endswitch
                
                @if($quantidade>1)
                    <p class="por3">CADA</p>
                @endif
                
                @if($quantidade>1&&$precounitario!='')
                    <p class="precounitario">PREÇO UNITÁRIO: R$ {{$precounitario}}</p>
                @endif
                
                @if($quantidade==0&&$precounitario!='')
                    <p class="por4">CADA</p>
                @endif

                @if($precounitario=='')
                    <p class="por5">CADA</p>
                @endif
            @if ($input['type']=='horizontal')
                <p class="textovalidade">{{$textovalidade}}</p>        
            @endif
        
            @if ($input['type']=='vertical')
                <p class="textovalidade">{{$textovalidade}}</p>        
            @endif
        @endif

        @php
            if(isset($input['nomeproduto2'])){ $nomeproduto2 = nl2br(trim($input['nomeproduto2'])); }else{ $nomeproduto2 = ''; }
            if(isset($input['quantidade2'])){ $quantidade2 = nl2br(trim($input['quantidade2'])); }else{ $quantidade2 = 0; }
            if(isset($input['precoprincipal2'])){ $precoprincipal2 = nl2br(trim($input['precoprincipal2'])); }else{ $precoprincipal2 = ''; }
            if(isset($input['precocentavos2'])){ $precocentavos2 = nl2br(trim($input['precocentavos2'])); }else{ $precocentavos2 = ''; }
            if(isset($input['textovalidade2'])){ $textovalidade2 = nl2br(trim($input['textovalidade2'])); }else{ $textovalidade2 = ''; }
            if(isset($input['precounitario2'])){ $precounitario2 = nl2br(trim($input['precounitario2'])); }else{ $precounitario2 = ''; } 
        @endphp
        @if ($nomeproduto2!=''&&$precoprincipal2!=''&&$textovalidade2!='')
            @if ($input['type']=='horizontal') {
                <p class="nomeproduto2">{{$nomeproduto2}}</p>
            @else
                <p class="nomeproduto2">{{$nomeproduto2}}</p>
            @endif
                <img class="qrcodeimgsecond" src="{{$input['qrcode2']}}" />
                <p class="compresite2">Compre pelo site</p>
                @if($quantidade2>1)
                    <p class="por2">LEVE {{$quantidade2}} E PAGUE</p>
                @endif
                
                @if($quantidade2==0&&$precounitario2!='')
                    <p class="por22">DE R${{$precounitario2}} POR:</p>
                @endif
                
                @switch(strlen($precoprincipal2))
                    @case('1')
                    @case('2')
                    @case('3')
                    @case('4')
                        <p class="precoprincipal22 top1"><span class="rs2">R$ </span>{{$precoprincipal2}}</p>
                        @break
                    @case('5')
                        <p class="precoprincipal32 top1"><span class="rs2">R$ </span>{{$precoprincipal2}}</p>
                        @break
                    @case('6')
                        <p class="precoprincipal42 top1"><span class="rs2">R$ </span>{{$precoprincipal2}}</p>
                        @break
                    @default
                    <p class="precoprincipal52 top1"><span class="rs2">R$ </span>{{$precoprincipal2}}</p>
                    @break
                @endswitch
                
                @if($quantidade2>1)
                    <p class="por32">CADA</p>
                @endif
                
                @if($quantidade2>1&&$precounitario2!='')
                    <p class="precounitario2">PREÇO UNITÁRIO: R$ {{$precounitario2}}</p>
                @endif
                
                @if($quantidade2==0&&$precounitario2!='')
                    <p class="por42">CADA</p>
                @endif

                @if($precounitario2=='')
                    <p class="por52">CADA</p>
                @endif
            @if ($input['type']=='horizontal')
                <p class="textovalidade2">{{$textovalidade2}}</p>        
            @endif
        
            @if ($input['type']=='vertical')
                <p class="textovalidade2">{{$textovalidade2}}</p>        
            @endif
        @endif
    </body>
</html>