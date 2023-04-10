<!DOCTYPE html>
<html>
    <head>
        <title>Endereço de Filial</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <style type="text/css">
            p{
                color: #4e515f;
            }
            
            .name01, .name02, .name03, .name04, .name05, .name06, .name07, .name08{
                font-size: 18px;
                margin-top:15px;
                font-weight: bolder;
                color: #037e45;
                z-index: 99999999;
            } 
            .end01, .end02, .end03, .end04, .end05, .end06, .end07, .end08{
                font-size: 12px;
                margin-top:15px;
                z-index: 99999999;
            } 
            .name01{
                top: 121px;
                left: 50px;
                position: absolute;
            }
            .name02{
                top: 121px;
                left: 330px;
                position: absolute;
            }
            .name03{
                top: 121px;
                left: 610px;
                position: absolute;
            }
            .name04{
                top: 121px;
                left: 890px;
                position: absolute;
            }
            .name05{
                top: 519px;
                left: 50px;
                position: absolute;
            }
            .name06{
                top: 519px;
                left: 330px;
                position: absolute;
            }
            .name07{
                top: 519px;
                left: 610px;
                position: absolute;
            }
            .name08{
                top: 519px;
                left: 890px;
                position: absolute;
            }

            .end01{
                top: 155px;
                left: 50px;
                position: absolute;
            }
            .end02{
                top: 155px;
                left: 330px;
                position: absolute;
            }
            .end03{
                top: 155px;
                left: 610px;
                position: absolute;
            }
            .end04{
                top: 155px;
                left: 890px;
                position: absolute;
            }
            .end05{
                top: 550px;
                left: 50px;
                position: absolute;
            }
            .end06{
                top: 550px;
                left: 330px;
                position: absolute;
            }
            .end07{
                top: 550px;
                left: 610px;
                position: absolute;
            }
            .end08{
                top: 550px;
                left: 890px;
                position: absolute;
            }
        </style>
    </head>
    <body>
        <p class="name01">{{$input['whatsapp']}}</p>
        <p class="name02">{{$input['whatsapp']}}</p>
        <p class="name03">{{$input['whatsapp']}}</p>
        <p class="name04">{{$input['whatsapp']}}</p>
        <p class="name05">{{$input['whatsapp']}}</p>
        <p class="name06">{{$input['whatsapp']}}</p>
        <p class="name07">{{$input['whatsapp']}}</p>
        <p class="name08">{{$input['whatsapp']}}</p>
        <p class="end01">{{$input['address']}}</p>
        <p class="end02">{{$input['address']}}</p>
        <p class="end03">{{$input['address']}}</p>
        <p class="end04">{{$input['address']}}</p>
        <p class="end05">{{$input['address']}}</p>
        <p class="end06">{{$input['address']}}</p>
        <p class="end07">{{$input['address']}}</p>
        <p class="end08">{{$input['address']}}</p>
    </body>
</html>