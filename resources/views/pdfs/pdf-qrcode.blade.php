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
                .qrcodeimg{
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
                    font-size: 60px;
                    line-height: 70px;
                    position: absolute;
                    top: 185px;
                    width: 90%;
                    margin: 0 auto;
                    left: 0;
                    right: 0;
                }
                .textovalidade {
                    font-size: 20px;
                    position: absolute;
                    bottom: 45px;
                    width: 98%;
                    margin: 0 auto;
                    left: 0;
                    right: 0;
                    font-weight: bold;
                }
                .qrcodeimg{
                    width: 350px;
                    margin-top: 290px;
                }
                .compresite{
                    font-size: 20px;
                    margin-top: 620px;
                    font-weight: bold;
                    left: 160px;
                }
                .por {
                    font-size: 40px;
                    margin-top: 300px;
                    font-weight: bold;
                    left: 55%;
                }
                .por2{
                    font-size: 40px;
                    margin-top: 300px;
                    font-weight: bold;
                    left: 54%;
                }
                .por3 {
                    font-size: 40px;
                    margin-top: 530px;
                    font-weight: bold;
                    left: 60%;
                }
                .por4 {
                    font-size: 40px;
                    margin-top: 530px;
                    font-weight: bold;
                    left: 60%;
                }
                .por5 {
                    font-size: 40px;
                    margin-top: 550px;
                    font-weight: bold;
                    left: 60%;
                }
                .precoprincipal2 {
                    margin-top: 300px;
                    font-size: 190px;
                    left: 45%;
                    font-weight: bold;
                }
                .precoprincipal3 {
                    margin-top: 300px;
                    font-size: 190px;
                    left: 42%;
                    font-weight: bold;
                }
                .precoprincipal4 {
                    margin-top: 300px;
                    font-size: 190px;
                    left: 42%;
                    font-weight: bold;
                }
                .precoprincipal5 {
                    margin-top: 300px;
                    font-size: 190px;
                    left: 42%;
                    font-weight: bold;
                }
                .precounitario{
                    font-size: 36px;
                    margin-top: 590px;
                    font-weight: bold;
                    left: 47%;
                }
                .rs {
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
                .qrcodeimg{
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
                    font-size: 60px;
                    line-height: 70px;
                    position: absolute;
                    top: 340px;
                    width: 85%;
                    margin: 0 auto;
                    left: 0;
                    right: 0;
                }
                .textovalidade {
                    font-size: 20px;
                    position: absolute;
                    bottom: 25px;
                    width: 60%;
                    margin: 0 auto;
                    left: 0;
                    right: 0;
                    font-weight: bold;
                }
                .qrcodeimg{
                    width: 300px;
                    margin-top: 540px;
                }
                .compresite{
                    font-size: 20px;
                    margin-top: 830px;
                    font-weight: bold;
                    left: 120px;
                }
                .por {
                    font-size: 30px;
                    margin-top: 560px;
                    font-weight: bold;
                    right: 160px;
                }
                .por2{
                    font-size: 30px;
                    margin-top: 550px;
                    font-weight: bold;
                    left: 450px;
                }
                .por3 {
                    font-size: 30px;
                    margin-top: 760px;
                    font-weight: bold;
                    right: 210px;
                }
                .por4 {
                    font-size: 30px;
                    margin-top: 760px;
                    font-weight: bold;
                    right: 210px;
                }
                .por5 {
                    font-size: 30px;
                    margin-top: 760px;
                    font-weight: bold;
                    right: 220px;
                }
                .precoprincipal2 {
                    margin-top: 570px;
                    font-size: 160px;
                    left: 380px;
                    font-weight: bold;
                }
                .precoprincipal3 {
                    margin-top: 580px;
                    font-size: 150px;
                    right: 60px;
                    font-weight: bold;
                }
                .precoprincipal4 {
                    margin-top: 580px;
                    font-size: 130px;
                    right: 60px;
                    font-weight: bold;
                }
                .precoprincipal5 {
                    margin-top: 600px;
                    font-size: 100px;
                    right: 60px;
                    font-weight: bold;
                }
                .precounitario{
                    margin-top: 840px;
                    font-size: 30px;
                    left: 400px;
                    font-weight: bold;
                }
                .rs {
                    font-size: 30px;
                    font-weight: 100;
                }
            </style>
        @endif
        
    </head>
    <body>
        @php
            if(isset($input['nomeproduto1'])){ $nomeproduto = nl2br(trim($input['nomeproduto1'])); }else{ $nomeproduto = ''; }
            if(isset($input['quantidade1'])){ $quantidade = nl2br(trim($input['quantidade1'])); }else{ $quantidade = ''; }
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
            
            <img class="qrcodeimg" src="{{$input['qrcode1']}}" />
            <p class="compresite">Compre pelo site</p>
            
            @if($quantidade>1)
                <p class="por">LEVE {{$quantidade}} E PAGUE</p>
            @endif
            
            @if($quantidade==''&&$precounitario!='')
                <p class="por2">DE R${{$precounitario}} POR:</p>
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
            
            @if($quantidade==''&&$precounitario!='')
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
    </body>
</html>