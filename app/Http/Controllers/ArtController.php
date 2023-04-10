<?php

namespace App\Http\Controllers;

use App\Models\Art;
use App\Models\User;
use App\Models\Error;
use App\Models\Download;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use chillerlan\QRCode\QRCode;
use Illuminate\Support\Facades\Config;
use PDF;

class ArtController extends Controller
{
    public function createart($id, Request $request)
    {
        // Config::set('app.debug', true);
        // set_time_limit(999999999999999999);
        ini_set('memory_limit', '300M');
        $user = Auth::user();
        $input = $request->all();
        // $this->$id($request, $user);
        try {
            $this->$id($request, $user);
            return back();
        } catch (\Throwable $th) {
            unset($input['_token']);
            Error::create(['user_id'=>$user->id,'description'=>'Erro ao criar arte, função: '.$id,'json'=>json_encode($input)]);
            session()->flash('error', 'Erro ao criar arte, entre em contato com o suporte.');
            return back();
        }
    }

    public function birthday(Request $request, $user){
        $input = $request->all();

        $inputFormat = $input['type'];
        $inputName = mb_strtoupper($input['name']);
        $inputBirthdayDate = mb_strtoupper($input['date']);

        if (!$inputName||!$inputBirthdayDate||!$inputFormat) {
            return false;
        }

        $artOption = Art::where('id',$input['art_id'])->first();
        $folder = public_path('assets/img/functions/'.$artOption->function);
        $file = $artOption->function.'-'.$inputFormat.'.jpg';
        $directoryFile = $folder.'/'.$file;

        $bgImage = imagecreatefromjpeg($directoryFile);
        if(!$bgImage) { return false; }

        $color = imagecolorallocate( $bgImage, 39, 37, 37 );
        $fontImage = public_path('assets/fonts/aftika.ttf');

        switch ($inputFormat) {
            case 'quadrado':
            default:
                $sizeInputName = strlen($inputName);
                if($sizeInputName<10){
                    $sizeInputName = 50;
                }else{
                    if($sizeInputName>10&&$sizeInputName<20){
                        $sizeInputName = 45;
                    }else{
                        $sizeInputName = 40;
                    }   
                }
        
                $sizeInputBDate = strlen($inputBirthdayDate);
                if($sizeInputBDate<10){
                    $sizeInputBDate = 30;
                }else{
                    if($sizeInputBDate>10&&$sizeInputBDate<20){
                        $sizeInputBDate = 25;
                    }else{
                        $sizeInputBDate = 20;
                    }   
                }
        
                $putFontImage = imagettfbbox($sizeInputName, 0, $fontImage, $inputName);
                $textWidthName = $putFontImage[2]-$putFontImage[0];
                $xPositionName = (1080/2) - ($textWidthName/2);
                imagettftext($bgImage, $sizeInputName, 0, $xPositionName, 735, $color, $fontImage, $inputName);
        
                $putFontBDate = imagettfbbox($sizeInputBDate, 0, $fontImage, $inputBirthdayDate);
                $textWidthBDate = $putFontBDate[2]-$putFontBDate[0];
                $xPositionBDate = (1080/2) - ($textWidthBDate/2);
                imagettftext($bgImage, $sizeInputBDate, 0, $xPositionBDate, 920, $color, $fontImage, $inputBirthdayDate);
            break;
            case 'status':
                $sizeInputName = strlen($inputName);
                if($sizeInputName<10){
                    $sizeInputName = 60;
                }else{
                    if($sizeInputName>10&&$sizeInputName<20){
                        $sizeInputName = 50;
                    }else{
                        $sizeInputName = 40;
                    }   
                }
                
                $sizeInputBDate = 40;
        
                $putFontImage = imagettfbbox($sizeInputName, 0, $fontImage, $inputName);
                $textWidthName = $putFontImage[2]-$putFontImage[0];
                $xPositionName = (1080/2) - ($textWidthName/2);
                imagettftext($bgImage, $sizeInputName, 0, $xPositionName, 1195, $color, $fontImage, $inputName);
        
                $putFontBDate = imagettfbbox($sizeInputBDate, 0, $fontImage, $inputBirthdayDate);
                $textWidthBDate = $putFontBDate[2]-$putFontBDate[0];
                $xPositionBDate = (1080/2) - ($textWidthBDate/2);
                imagettftext($bgImage, $sizeInputBDate, 0, $xPositionBDate, 1550, $color, $fontImage, $inputBirthdayDate);
            break;
        }
        $this->donwloadArt($input, $user, $bgImage, $artOption);
    }

    public function jobs(Request $request, $user){
        $input = $request->all();
            
        $inputFormat = $input['type'];
        $inputJob = mb_strtoupper($input['job']);
        $inputCity = mb_strtoupper($input['city']);
        $inputEmail = mb_strtolower($input['email']);
        $inputNecessary = $input['necessary'];
        $inputBenefits = $input['benefits'];
        $inputObservation = $input['observation'];

        if (!$inputCity||!$inputJob||!$inputFormat||!$inputEmail||!$inputNecessary||!$inputBenefits||!$inputObservation) {
            return false;
        }

        $artOption = Art::where('id',$input['art_id'])->first();
        $folder = public_path('assets/img/functions/'.$artOption->function);
        $file = $artOption->function.'-'.$inputFormat.'.jpg';
        $directoryFile = $folder.'/'.$file;

        $bgImage = imagecreatefromjpeg($directoryFile);
        if(!$bgImage) { return false; }

        $colorWhite = imagecolorallocate( $bgImage, 255, 255, 255 );
        $colorGreen = imagecolorallocate( $bgImage, 64, 155, 110 );
        $colorGray = imagecolorallocate( $bgImage, 60, 60, 60 );
        $fontImage = public_path('assets/fonts/Myriad-Pro-Black.ttf');
        $fontImageRegular = public_path('assets/fonts/Myriad-Pro-SemiCondensed.ttf');

        switch ($inputFormat) {
            case 'quadrado':
            default:
                $sizeInputJob = strlen($inputJob);
                if($sizeInputJob<14){
                    $fontSizeInputJob = 40;
                    $yPositionJob = 440;
                    $xPositionJob = 160;
                }else{
                    if($sizeInputJob>13&&$sizeInputJob<21){
                        $fontSizeInputJob = 30;
                        $yPositionJob = 435;
                        $xPositionJob = 160;
                    }else{
                        $fontSizeInputJob = 23;
                        $yPositionJob = 430;
                        $xPositionJob = 160;
                    }   
                }
                imagettftext($bgImage, $fontSizeInputJob, 0, $xPositionJob, $yPositionJob, $colorWhite, $fontImage, $inputJob);

                $sizeInputCity = strlen($inputCity);
                if($sizeInputCity<16){
                    $fontSizeInputCity = 50;
                    $yPositionCity = 370;
                    $xPositionCity = 160;
                }else{
                    if($sizeInputCity>13&&$sizeInputCity<21){
                        $fontSizeInputCity = 35;
                        $yPositionCity = 365;
                        $xPositionCity = 160;
                    }else{
                        $fontSizeInputCity = 23;
                        $yPositionCity = 360;
                        $xPositionCity = 160;
                    }   
                }
                imagettftext($bgImage, $fontSizeInputCity, 0, $xPositionCity, $yPositionCity, $colorWhite, $fontImage, $inputCity);

                $fontSizeInputEmail = 20;
                $yPositionEmail = 1000;
                $xPositionEmail = 160;
                imagettftext($bgImage, $fontSizeInputEmail, 0, $xPositionEmail, $yPositionEmail, $colorGray, $fontImage, $inputEmail);

                $fontSizeInputObservation = 16;
                $putFontObservation = imagettfbbox($fontSizeInputObservation, 0, $fontImage, $inputObservation);
                $textWidthObservation = $putFontObservation[2]-$putFontObservation[0];
                $xPositionObservation = (1080/2) - ($textWidthObservation/2);
                $yPositionObservation = 900;
                imagettftext($bgImage, $fontSizeInputObservation, 0, $xPositionObservation, $yPositionObservation, $colorGray, $fontImageRegular, $inputObservation);

                $fontSizeInputNecessary = 15;
                $yPositionNecessary = 640;
                $xPositionNecessary = 160;
                imagettftext($bgImage, $fontSizeInputNecessary, 0, $xPositionNecessary, $yPositionNecessary, $colorGray, $fontImageRegular, $inputNecessary);

                $fontSizeInputBenefits = 15;
                $yPositionBenefits = 640;
                $xPositionBenefits = 590;
                imagettftext($bgImage, $fontSizeInputBenefits, 0, $xPositionBenefits, $yPositionBenefits, $colorGray, $fontImageRegular, $inputBenefits);
            break;
            case 'status':
                $sizeInputJob = strlen($inputJob);
                if($sizeInputJob<14){
                    $fontSizeInputJob = 40;
                    $yPositionJob = 465;
                    $xPositionJob = 75;
                }else{
                    if($sizeInputJob>13&&$sizeInputJob<21){
                        $fontSizeInputJob = 30;
                        $yPositionJob = 465;
                        $xPositionJob = 75;
                    }else{
                        $fontSizeInputJob = 23;
                        $yPositionJob = 455;
                        $xPositionJob = 75;
                    }   
                }
                imagettftext($bgImage, $fontSizeInputJob, 0, $xPositionJob, $yPositionJob, $colorWhite, $fontImage, $inputJob);

                $sizeInputCity = strlen($inputCity);
                if($sizeInputCity<10){
                    $fontSizeInputCity = 42;
                    $yPositionCity = 400;
                    $xPositionCity = 75;
                }else{
                    if($sizeInputCity>9&&$sizeInputCity<16){
                        $fontSizeInputCity = 35;
                        $yPositionCity = 395;
                        $xPositionCity = 75;
                    }else{
                        if($sizeInputCity>15&&$sizeInputCity<21){
                            $fontSizeInputCity = 30;
                            $yPositionCity = 395;
                            $xPositionCity = 75;
                        }else{
                            $fontSizeInputCity = 20;
                            $yPositionCity = 390;
                            $xPositionCity = 75;
                        }
                    }   
                }
                imagettftext($bgImage, $fontSizeInputCity, 0, $xPositionCity, $yPositionCity, $colorWhite, $fontImage, $inputCity);

                $fontSizeInputEmail = 20;
                $yPositionEmail = 1195;
                $xPositionEmail = 65;
                imagettftext($bgImage, $fontSizeInputEmail, 0, $xPositionEmail, $yPositionEmail, $colorGray, $fontImage, $inputEmail);

                $fontSizeInputObservation = 20;
                $yPositionObservation = 1080;
                $xPositionObservation = 65;
                imagettftext($bgImage, $fontSizeInputObservation, 0, $xPositionObservation, $yPositionObservation, $colorGray, $fontImageRegular, $inputObservation);

                $fontSizeInputNecessary = 20;
                $yPositionNecessary = 690;
                $xPositionNecessary = 80;
                imagettftext($bgImage, $fontSizeInputNecessary, 0, $xPositionNecessary, $yPositionNecessary, $colorGray, $fontImageRegular, $inputNecessary);

                $fontSizeInputBenefits = 20;
                $yPositionBenefits = 690;
                $xPositionBenefits = 420;
                imagettftext($bgImage, $fontSizeInputBenefits, 0, $xPositionBenefits, $yPositionBenefits, $colorGray, $fontImageRegular, $inputBenefits);
            break;
        }
        $this->donwloadArt($input, $user, $bgImage, $artOption);
    }

    public function covid(Request $request, $user){
        $input = $request->all();
            
        $inputFormat = $input['type'];
        $inputCity = mb_strtoupper($input['city']);
        $inputStore = mb_strtoupper($input['store']);
        $inputWhatsapp = mb_strtoupper($input['whatsapp']);

        if (!$inputCity||!$inputStore||!$inputWhatsapp) {
            return false;
        }

        $artOption = Art::where('id',$input['art_id'])->first();
        $folder = public_path('assets/img/functions/'.$artOption->function);
        $file = $artOption->function.'-'.$inputFormat.'.jpg';
        $directoryFile = $folder.'/'.$file;

        $bgImage = imagecreatefromjpeg($directoryFile);
        if(!$bgImage) { return false; }

        $colorWhite = imagecolorallocate( $bgImage, 255, 255, 255 );
        $colorGray = imagecolorallocate( $bgImage, 96, 111, 114 );

        $fontImageRegular = public_path('assets/fonts/Dosis-Regular.ttf');
        $fontImage = public_path('assets/fonts/Dosis-Bold.ttf');

        switch ($inputFormat) {
            case 'quadrado':
            default:
                $sizeInputCity = strlen($inputCity);
                if($sizeInputCity<16){
                    $fontSizeInputCity = 50;
                }else{
                    if($sizeInputCity>15&&$sizeInputCity<25){
                        $fontSizeInputCity = 50;
                    }else{
                        $fontSizeInputCity = 50;
                    }   
                }
        
                $putFontImageCity = imagettfbbox($fontSizeInputCity, 0, $fontImage, $inputCity);
                $textWidthCity = $putFontImageCity[2]-$putFontImageCity[0];
                $xPositionCity = (1080/2) - ($textWidthCity/2);
                imagettftext($bgImage, $fontSizeInputCity, 0, $xPositionCity, 1020, $colorGray, $fontImage, $inputCity);

                $fontSizeInputStore = 20;
                $putFontStore = imagettfbbox($fontSizeInputStore, 0, $fontImage, $inputStore);
                $textWidthStore = $putFontStore[2]-$putFontStore[0];
                $xPositionStore = (1080/2) - ($textWidthStore/2);
                $yPositionStore = 950;
                imagettftext($bgImage, $fontSizeInputStore, 0, $xPositionStore, $yPositionStore, $colorGray, $fontImageRegular, $inputStore);

                $fontSizeInputWhatsapp = 35;
                $yPositionWhatsapp = 770;
                $xPositionWhatsapp = 690;
                imagettftext($bgImage, $fontSizeInputWhatsapp, 0, $xPositionWhatsapp, $yPositionWhatsapp, $colorWhite, $fontImage, $inputWhatsapp);
            break;
            case 'status':
                $sizeInputCity = strlen($inputCity);
                if($sizeInputCity<16){
                    $fontSizeInputCity = 65;
                }else{
                    if($sizeInputCity>15&&$sizeInputCity<25){
                        $fontSizeInputCity = 65;
                    }else{
                        $fontSizeInputCity = 50;
                    }   
                }
        
                $putFontImageCity = imagettfbbox($fontSizeInputCity, 0, $fontImage, $inputCity);
                $textWidthCity = $putFontImageCity[2]-$putFontImageCity[0];
                $xPositionCity = (1080/2) - ($textWidthCity/2);
                imagettftext($bgImage, $fontSizeInputCity, 0, $xPositionCity, 1600, $colorGray, $fontImage, $inputCity);

                $fontSizeInputStore = 30;
                $putFontStore = imagettfbbox($fontSizeInputStore, 0, $fontImage, $inputStore);
                $textWidthStore = $putFontStore[2]-$putFontStore[0];
                $xPositionStore = (1080/2) - ($textWidthStore/2);
                $yPositionStore = 1525;
                imagettftext($bgImage, $fontSizeInputStore, 0, $xPositionStore, $yPositionStore, $colorGray, $fontImageRegular, $inputStore);

                $fontSizeInputWhatsapp = 50;
                $putFontWhatsapp = imagettfbbox($fontSizeInputWhatsapp, 0, $fontImage, $inputWhatsapp);
                $textWidthWhatsapp = $putFontWhatsapp[2]-$putFontWhatsapp[0];
                $xPositionWhatsapp = (1080/2) - ($textWidthWhatsapp/2);
                $yPositionWhatsapp = 1450;
                imagettftext($bgImage, $fontSizeInputWhatsapp, 0, $xPositionWhatsapp, $yPositionWhatsapp, $colorGray, $fontImage, $inputWhatsapp);
            break;
        }
        $this->donwloadArt($input, $user, $bgImage, $artOption);
    }

    public function delivery(Request $request, $user){
        $input = $request->all();
            
        $inputFormat = $input['type'];
        $inputCity = mb_strtoupper($input['city']);
        $inputStore = mb_strtoupper($input['store']);
        $inputWhatsapp = mb_strtoupper($input['whatsapp']);

        if (!$inputCity||!$inputStore||!$inputWhatsapp) {
            return false;
        }

        $artOption = Art::where('id',$input['art_id'])->first();
        $folder = public_path('assets/img/functions/'.$artOption->function);
        
        $file = $artOption->function.'-'.$inputFormat.'.jpg';
        $directoryFile = $folder.'/'.$file;

        $bgImage = imagecreatefromjpeg($directoryFile);
        if(!$bgImage) { return false; }

        $colorWhite = imagecolorallocate( $bgImage, 255, 255, 255 );
        $colorGray = imagecolorallocate( $bgImage, 96, 111, 114 );

        $fontImageRegular = public_path('assets/fonts/Dosis-Regular.ttf');
        $fontImage = public_path('assets/fonts/Dosis-Bold.ttf');

        switch ($inputFormat) {
            case 'quadrado':
            default:
                $sizeInputCity = strlen($inputCity);
                if($sizeInputCity<13){
                    $fontSizeInputCity = 50;
                }else{
                    if($sizeInputCity>12&&$sizeInputCity<17){
                        $fontSizeInputCity = 40;
                    }else{
                        $fontSizeInputCity = 24;
                    }   
                }
        
                imagettftext($bgImage, $fontSizeInputCity, 0, 80, 870, $colorWhite, $fontImage, $inputCity);

                $fontSizeInputStore = 22;
                $yPositionStore = 800;
                $xPositionStore = 80;
                imagettftext($bgImage, $fontSizeInputStore, 0, $xPositionStore, $yPositionStore, $colorWhite, $fontImageRegular, $inputStore);

                $fontSizeInputWhatsapp = 35;
                $yPositionWhatsapp = 960;
                $xPositionWhatsapp = 170;
                imagettftext($bgImage, $fontSizeInputWhatsapp, 0, $xPositionWhatsapp, $yPositionWhatsapp, $colorWhite, $fontImage, $inputWhatsapp);
            break;
            case 'status':
                $sizeInputCity = strlen($inputCity);
                if($sizeInputCity<16){
                    $fontSizeInputCity = 80;
                }else{
                    if($sizeInputCity>15&&$sizeInputCity<25){
                        $fontSizeInputCity = 70;
                    }else{
                        $fontSizeInputCity = 50;
                    }   
                }
        
                $putFontImageCity = imagettfbbox($fontSizeInputCity, 0, $fontImage, $inputCity);
                $textWidthCity = $putFontImageCity[2]-$putFontImageCity[0];
                $xPositionCity = (1080/2) - ($textWidthCity/2);
                imagettftext($bgImage, $fontSizeInputCity, 0, $xPositionCity, 1300, $colorWhite, $fontImage, $inputCity);

                $fontSizeInputStore = 30;
                $putFontStore = imagettfbbox($fontSizeInputStore, 0, $fontImage, $inputStore);
                $textWidthStore = $putFontStore[2]-$putFontStore[0];
                $xPositionStore = (1080/2) - ($textWidthStore/2);
                $yPositionStore = 1200;
                imagettftext($bgImage, $fontSizeInputStore, 0, $xPositionStore, $yPositionStore, $colorWhite, $fontImageRegular, $inputStore);

                $fontSizeInputWhatsapp = 50;
                $yPositionWhatsapp = 1680;
                $xPositionWhatsapp = 230;
                imagettftext($bgImage, $fontSizeInputWhatsapp, 0, $xPositionWhatsapp, $yPositionWhatsapp, $colorWhite, $fontImage, $inputWhatsapp);
            break;
        }
        $this->donwloadArt($input, $user, $bgImage, $artOption);
    }

    public function popular(Request $request, $user){
        $input = $request->all();
            
        $inputFormat = $input['type'];
        $inputCity = mb_strtoupper($input['city']);
        $inputStore = mb_strtoupper($input['store']);
        $inputWhatsapp = mb_strtoupper($input['whatsapp']);

        if (!$inputCity||!$inputStore||!$inputWhatsapp) {
            return false;
        }

        $artOption = Art::where('id',$input['art_id'])->first();
        $folder = public_path('assets/img/functions/'.$artOption->function);
        $file = $artOption->function.'-'.$inputFormat.'.jpg';
        $directoryFile = $folder.'/'.$file;

        $bgImage = imagecreatefromjpeg($directoryFile);
        if(!$bgImage) { return false; }

        $colorWhite = imagecolorallocate( $bgImage, 255, 255, 255 );
        $colorGray = imagecolorallocate( $bgImage, 96, 111, 114 );

        $fontImageRegular = public_path('assets/fonts/Dosis-Regular.ttf');
        $fontImage = public_path('assets/fonts/Dosis-Bold.ttf');

        switch ($inputFormat) {
            case 'quadrado':
            default:
                $sizeInputCity = strlen($inputCity);
                if($sizeInputCity<13){
                    $fontSizeInputCity = 40;
                }else{
                    if($sizeInputCity>12&&$sizeInputCity<17){
                        $fontSizeInputCity = 35;
                    }else{
                        $fontSizeInputCity = 20;
                    }   
                }
        
                imagettftext($bgImage, $fontSizeInputCity, 0, 610, 380, $colorWhite, $fontImage, $inputCity);

                $fontSizeInputStore = 20;
                $yPositionStore = 420;
                $xPositionStore = 610;
                imagettftext($bgImage, $fontSizeInputStore, 0, $xPositionStore, $yPositionStore, $colorWhite, $fontImageRegular, $inputStore);

                $fontSizeInputWhatsapp = 45;
                $yPositionWhatsapp = 520;
                $xPositionWhatsapp = 610;
                imagettftext($bgImage, $fontSizeInputWhatsapp, 0, $xPositionWhatsapp, $yPositionWhatsapp, $colorWhite, $fontImage, $inputWhatsapp);
            break;
            case 'status':
                $sizeInputCity = strlen($inputCity);
                if($sizeInputCity<16){
                    $fontSizeInputCity = 80;
                }else{
                    if($sizeInputCity>15&&$sizeInputCity<25){
                        $fontSizeInputCity = 70;
                    }else{
                        $fontSizeInputCity = 50;
                    }   
                }
        
                $putFontImageCity = imagettfbbox($fontSizeInputCity, 0, $fontImage, $inputCity);
                $textWidthCity = $putFontImageCity[2]-$putFontImageCity[0];
                $xPositionCity = (1080/2) - ($textWidthCity/2);
                imagettftext($bgImage, $fontSizeInputCity, 0, $xPositionCity, 1300, $colorWhite, $fontImage, $inputCity);

                $fontSizeInputStore = 30;
                $putFontStore = imagettfbbox($fontSizeInputStore, 0, $fontImage, $inputStore);
                $textWidthStore = $putFontStore[2]-$putFontStore[0];
                $xPositionStore = (1080/2) - ($textWidthStore/2);
                $yPositionStore = 1200;
                imagettftext($bgImage, $fontSizeInputStore, 0, $xPositionStore, $yPositionStore, $colorWhite, $fontImageRegular, $inputStore);

                $fontSizeInputWhatsapp = 50;
                $yPositionWhatsapp = 1680;
                $xPositionWhatsapp = 230;
                imagettftext($bgImage, $fontSizeInputWhatsapp, 0, $xPositionWhatsapp, $yPositionWhatsapp, $colorWhite, $fontImage, $inputWhatsapp);
            break;
        }
        $this->donwloadArt($input, $user, $bgImage, $artOption);
    }

    public function address(Request $request, $user){
        ini_set('memory_limit', '300M');
        $input = $request->all();
        $file_name='endereco-'.$input['art_id'].'-'.date("Y-m-d").'.pdf';
        $artOption = Art::where('id',$input['art_id'])->first();
        
        $pdf = PDF::loadView('pdfs/pdf-address',compact('input'),[],[
            'format'=>'A4',
            'orientation'=>'landscape',
            'watermark_image_path' => public_path().'/assets/img/functions/address/fundo-impressao.jpg',
            'show_watermark_image' => true,
            'watermark_image_alpha' => 1,
            'watermark_image_position' => 'F',
        ]);
        unset($input['_token']);
        Download::create(['art_id'=>$input['art_id'],'user_id'=>$user->id,'json'=>json_encode($input),'type'=>2]);
        // session()->flash('success', 'Arte criada com sucesso.');
        $pdf->download($file_name);
    }

    public function files(Request $request, $user){
        
    }

    public function promo(Request $request, $user){
        // if($user->role_id!=1){echo 'não tá pronto ainda';dd();}
        // Config::set('app.debug', true);
        // set_time_limit(999999999999999999);
        $input = $request->all();

        $inputFormat = $input['type'];
        $inputQrCode = $input['qrcode1'];
        $inputVal = mb_strtoupper($input['textovalidade1']);
        $inputName = $input['nomeproduto1'];
        $inputName = wordwrap($inputName, 30, "\n");
        $explodeName = explode("\n", $inputName);
        $inputQtd = $input['quantidade1'];
        $inputPrice = $input['precoprincipal1'];
        $inputPriceUn = $input['precounitario1'];
        $remoteFile="https://maxxieconomica.com/storage/photos/1/Products/webp/".$inputQrCode."_1.webp";

        $ch = curl_init($remoteFile);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if($responseCode!=200){
            unset($input['_token']);
            Error::create(['user_id'=>$user->id,'description'=>'Erro ao criar arte, função: promo','json'=>json_encode($input)]);
            session()->flash('error', 'Erro ao criar arte, produto não tem imagem.');
            return back();
        }

        $artOption = Art::where('id',$input['art_id'])->first();
        $folder = public_path('assets/img/functions/'.$artOption->function);
        $file = $artOption->function.'-'.$inputFormat.'.jpg';
        $directoryFile = $folder.'/'.$file;

        $bgImage = imagecreatefromjpeg($directoryFile);
        if(!$bgImage) { return false; }

        $colorWhite = imagecolorallocate( $bgImage, 255, 255, 255 );
        $colorGray = imagecolorallocate( $bgImage, 96, 111, 114 );

        $fontImageRegular = public_path('assets/fonts/Dosis-Regular.ttf');
        $fontImage = public_path('assets/fonts/Dosis-Bold.ttf');

        switch ($inputFormat) {
            case 'status':
                $imageProduct = imagecreatefromwebp($remoteFile);
                // Target dimensions
                $max_width = 350;
                $max_height = 350;
                // Get current dimensions
                $old_width  = imagesx($imageProduct);
                $old_height = imagesy($imageProduct);
                // Calculate the scaling we need to do to fit the image inside our frame
                $scale = min($max_width/$old_width, $max_height/$old_height);
                // Get the new dimensions
                $new_width  = ceil($scale*$old_width);
                $new_height = ceil($scale*$old_height);
                $xPositionImage = (1080/2) - ($new_width/2);

                imagecopyresized($bgImage, $imageProduct, $xPositionImage, 820, 0, 0, $new_width, $new_height, $old_width, $old_height);

                $fontSizeInputName = 40;        
                $yPositionName = 660;
                foreach ($explodeName as $eName){
                    $putFontImageName = imagettfbbox($fontSizeInputName, 0, $fontImage, $eName);
                    $textWidthName = $putFontImageName[2]-$putFontImageName[0];
                    $xPositionName = (1080/2) - ($textWidthName/2);
                    imagettftext($bgImage, $fontSizeInputName, 0, $xPositionName, $yPositionName, $colorGray, $fontImage, $eName);
                    $yPositionName=$yPositionName+60;
                }

                $inputEach = mb_strtoupper('CADA');
                $fontSizeInputEach = 35;        
                $putFontImageEach = imagettfbbox($fontSizeInputEach, 0, $fontImage, $inputEach);
                $textWidthEach = $putFontImageEach[2]-$putFontImageEach[0];
                $xPositionEach = (1080/2) - ($textWidthEach/2);
                imagettftext($bgImage, $fontSizeInputEach, 0, $xPositionEach, 1550, $colorWhite, $fontImage, $inputEach);

                $inputCypher = mb_strtoupper('R$');
                $fontSizeInputCypher = 20;        
                $putFontImageCypher = imagettfbbox($fontSizeInputCypher, 0, $fontImage, $inputCypher);
                $textWidthCypher = $putFontImageCypher[2]-$putFontImageCypher[0];
                $xPositionCypher = 310;
                imagettftext($bgImage, $fontSizeInputCypher, 0, $xPositionCypher, 1450, $colorWhite, $fontImage, $inputCypher);

                if($inputQtd>0){
                    $fontSizeInputVal = 15;        
                    $putFontImageVal = imagettfbbox($fontSizeInputVal, 0, $fontImage, $inputVal);
                    $textWidthVal = $putFontImageVal[2]-$putFontImageVal[0];
                    $xPositionVal = (1080/2) - ($textWidthVal/2);
                    imagettftext($bgImage, $fontSizeInputVal, 0, $xPositionVal, 1680, $colorGray, $fontImageRegular, $inputVal);

                    $inputQtdText = mb_strtoupper('LEVE '.$inputQtd.' POR:');
                    $fontSizeInputQtdText = 35;        
                    $putFontImageQtdText = imagettfbbox($fontSizeInputQtdText, 0, $fontImage, $inputQtdText);
                    $textWidthQtdText = $putFontImageQtdText[2]-$putFontImageQtdText[0];
                    $xPositionQtdText = (1080/2) - ($textWidthQtdText/2);
                    imagettftext($bgImage, $fontSizeInputQtdText, 0, $xPositionQtdText, 1340, $colorWhite, $fontImage, $inputQtdText);
                    
                    $sizeInputPrice = strlen($inputPrice);
                    if($sizeInputPrice==5){
                        $fontSizeInputPrice = 95;
                        $yPositionPrice = 1470;
                    }else{
                        if($sizeInputPrice<5){
                            $fontSizeInputPrice = 110;
                            $yPositionPrice = 1475;
                        }else{
                            $fontSizeInputPrice = 90;
                            $yPositionPrice = 1470;
                        }   
                    }
                    $putFontImagePrice = imagettfbbox($fontSizeInputPrice, 0, $fontImage, $inputPrice);
                    $textWidthPrice = $putFontImagePrice[2]-$putFontImagePrice[0];
                    $xPositionPrice = (1080/2) - ($textWidthPrice/2);
                    
                    imagettftext($bgImage, $fontSizeInputPrice, 0, $xPositionPrice, $yPositionPrice, $colorWhite, $fontImage, $inputPrice);

                    $inputPriceUn = 'PREÇO UNITÁRIO: R$'.$inputPriceUn;
                    $fontSizeInputPriceUn = 20;        
                    $putFontImagePriceUn = imagettfbbox($fontSizeInputPriceUn, 0, $fontImage, $inputPriceUn);
                    $textWidthPriceUn = $putFontImagePriceUn[2]-$putFontImagePriceUn[0];
                    $xPositionPriceUn = (1080/2) - ($textWidthPriceUn/2);
                    imagettftext($bgImage, $fontSizeInputPriceUn, 0, $xPositionPriceUn, 1630, $colorGray, $fontImage, $inputPriceUn);
                }else{
                    $fontSizeInputVal = 15;        
                    $putFontImageVal = imagettfbbox($fontSizeInputVal, 0, $fontImage, $inputVal);
                    $textWidthVal = $putFontImageVal[2]-$putFontImageVal[0];
                    $xPositionVal = (1080/2) - ($textWidthVal/2);
                    imagettftext($bgImage, $fontSizeInputVal, 0, $xPositionVal, 1650, $colorGray, $fontImageRegular, $inputVal);
                    
                    $sizeInputPrice = strlen($inputPrice);
                    if($sizeInputPrice==5){
                        $fontSizeInputPrice = 95;
                        $yPositionPrice = 1470;
                    }else{
                        if($sizeInputPrice<5){
                            $fontSizeInputPrice = 110;
                            $yPositionPrice = 1475;
                        }else{
                            $fontSizeInputPrice = 90;
                            $yPositionPrice = 1470;
                        }   
                    }
                    $putFontImagePrice = imagettfbbox($fontSizeInputPrice, 0, $fontImage, $inputPrice);
                    $textWidthPrice = $putFontImagePrice[2]-$putFontImagePrice[0];
                    $xPositionPrice = (1080/2) - ($textWidthPrice/2);
                    
                    imagettftext($bgImage, $fontSizeInputPrice, 0, $xPositionPrice, $yPositionPrice, $colorWhite, $fontImage, $inputPrice);

                    $inputPriceUn = 'DE: R$'.$inputPriceUn.' POR:';
                    $fontSizeInputPriceUn = 30;        
                    $putFontImagePriceUn = imagettfbbox($fontSizeInputPriceUn, 0, $fontImage, $inputPriceUn);
                    $textWidthPriceUn = $putFontImagePriceUn[2]-$putFontImagePriceUn[0];
                    $xPositionPriceUn = (1080/2) - ($textWidthPriceUn/2);
                    imagettftext($bgImage, $fontSizeInputPriceUn, 0, $xPositionPriceUn, 1340, $colorWhite, $fontImage, $inputPriceUn);
                }


            break;
        }
        $this->donwloadArt($input, $user, $bgImage, $artOption);
    }
    
    public function qrcode(Request $request, $user){
        $input = $request->all();
        $file_name='qrcode-'.$input['art_id'].'-'.date("Y-m-d").'.pdf';
        $artOption = Art::where('id',$input['art_id'])->first();
        $dataQr = $input['qrcode1'].'?qr=1';
        $newqr = new QRCode;
        $input['qrcode1'] = $newqr->render($dataQr);
        unset($input['_token']);
        Download::create(['art_id'=>$input['art_id'],'user_id'=>$user->id,'json'=>json_encode($input),'type'=>2]);

        if($input['type']=='vertical'){
            $pdf = PDF::loadView('pdfs/pdf-qrcode',compact('input'),[],[
                'format'=>'A4',
                'watermark_image_path' => public_path().'/assets/img/functions/qrcode/qrcode-vertical.jpg',
                'show_watermark_image' => true,
                'watermark_image_alpha' => 1,
                'watermark_image_position' => 'P',
                'custom_font_dir'  => public_path().'/assets/fonts/',
                'custom_font_data' => [
                    'dosis' => [ 
                        'R'  => 'Dosis.ttf',
                        'B'  => 'Dosis-Bold.ttf',
                        'I'  => 'Dosis-Regular.ttf'
                    ]
                ]
            ]);
        }else{
            $pdf = PDF::loadView('pdfs/pdf-qrcode',compact('input'),[],[
                'format'=>'A4',
                'orientation'=>'landscape',
                'watermark_image_path' => public_path().'/assets/img/functions/qrcode/qrcode-horizontal.jpg',
                'show_watermark_image' => true,
                'watermark_image_alpha' => 1,
                'watermark_image_position' => 'F',
                'custom_font_dir'  => public_path().'/assets/fonts/',
                'custom_font_data' => [
                    'dosis' => [ 
                        'R'  => 'Dosis.ttf',
                        'B'  => 'Dosis-Bold.ttf',
                        'I'  => 'Dosis-Regular.ttf'
                    ]
                ]
            ]);
        }
        $pdf->download($file_name);
    }
    
    public function qrcodebf(Request $request, $user){
        $input = $request->all();
        $file_name='qrcode-'.$input['art_id'].'-'.date("Y-m-d").'.pdf';
        $artOption = Art::where('id',$input['art_id'])->first();
        $dataQr = $input['qrcode1'].'?qr=1';
        $newqr = new QRCode;
        $input['qrcode1'] = $newqr->render($dataQr);
        unset($input['_token']);
        Download::create(['art_id'=>$input['art_id'],'user_id'=>$user->id,'json'=>json_encode($input),'type'=>2]);

        if($input['type']=='vertical'){
            $pdf = PDF::loadView('pdfs/pdf-qrcode',compact('input'),[],[
                'format'=>'A4',
                'watermark_image_path' => public_path().'/assets/img/functions/qrcodebf/qrcodebf-vertical.jpg',
                'show_watermark_image' => true,
                'watermark_image_alpha' => 1,
                'watermark_image_position' => 'P',
                'custom_font_dir'  => public_path().'/assets/fonts/',
                'custom_font_data' => [
                    'dosis' => [ 
                        'R'  => 'Dosis.ttf',
                        'B'  => 'Dosis-Bold.ttf',
                        'I'  => 'Dosis-Regular.ttf'
                    ]
                ]
            ]);
        }else{
            $pdf = PDF::loadView('pdfs/pdf-qrcode',compact('input'),[],[
                'format'=>'A4',
                'orientation'=>'landscape',
                'watermark_image_path' => public_path().'/assets/img/functions/qrcodebf/qrcodebf-horizontal.jpg',
                'show_watermark_image' => true,
                'watermark_image_alpha' => 1,
                'watermark_image_position' => 'F',
                'custom_font_dir'  => public_path().'/assets/fonts/',
                'custom_font_data' => [
                    'dosis' => [ 
                        'R'  => 'Dosis.ttf',
                        'B'  => 'Dosis-Bold.ttf',
                        'I'  => 'Dosis-Regular.ttf'
                    ]
                ]
            ]);
        }
        $pdf->download($file_name);
    }

    public function qrcodetwo(Request $request, $user){
        ini_set('memory_limit', '300M');
        $input = $request->all();
        $file_name='endereco-'.$input['art_id'].'-'.date("Y-m-d").'.pdf';
        $artOption = Art::where('id',$input['art_id'])->first();
        $dataQr = $input['qrcode1'].'?qr=1';
        $dataQr2 = $input['qrcode2'].'?qr=1';
        $newqr = new QRCode;
        $input['qrcode1'] = $newqr->render($dataQr);
        $input['qrcode2'] = $newqr->render($dataQr2);
        // unset($input['_token']);
        Download::create(['art_id'=>$input['art_id'],'user_id'=>$user->id,'json'=>json_encode($input),'type'=>2]);

        if($input['type']=='vertical'){
            $pdf = PDF::loadView('pdfs/pdf-qrcodetwo',compact('input'),[],[
                'format'=>'A4',
                'watermark_image_path' => public_path().'/assets/img/functions/qrcodetwo/qrcode-vertical.jpg',
                'show_watermark_image' => true,
                'watermark_image_alpha' => 1,
                'watermark_image_position' => 'P',
                'custom_font_dir'  => public_path().'/assets/fonts/',
                'custom_font_data' => [
                    'dosis' => [ 
                        'R'  => 'Dosis.ttf',
                        'B'  => 'Dosis-Bold.ttf',
                        'I'  => 'Dosis-Regular.ttf'
                    ]
                ]
            ]);
        }else{
            $pdf = PDF::loadView('pdfs/pdf-qrcodetwo',compact('input'),[],[
                'format'=>'A4',
                'orientation'=>'landscape',
                'watermark_image_path' => public_path().'/assets/img/functions/qrcodetwo/qrcode-horizontal.jpg',
                'show_watermark_image' => true,
                'watermark_image_alpha' => 1,
                'watermark_image_position' => 'F',
                'custom_font_dir'  => public_path().'/assets/fonts/',
                'custom_font_data' => [
                    'dosis' => [ 
                        'R'  => 'Dosis.ttf',
                        'B'  => 'Dosis-Bold.ttf',
                        'I'  => 'Dosis-Regular.ttf'
                    ]
                ]
            ]);
        }
        $pdf->download($file_name);
    }

    public function qrcodetwobf(Request $request, $user){
        ini_set('memory_limit', '300M');
        $input = $request->all();
        $file_name='endereco-'.$input['art_id'].'-'.date("Y-m-d").'.pdf';
        $artOption = Art::where('id',$input['art_id'])->first();
        $dataQr = $input['qrcode1'].'?qr=1';
        $dataQr2 = $input['qrcode2'].'?qr=1';
        $newqr = new QRCode;
        $input['qrcode1'] = $newqr->render($dataQr);
        $input['qrcode2'] = $newqr->render($dataQr2);
        // unset($input['_token']);
        Download::create(['art_id'=>$input['art_id'],'user_id'=>$user->id,'json'=>json_encode($input),'type'=>2]);

        if($input['type']=='vertical'){
            $pdf = PDF::loadView('pdfs/pdf-qrcodetwo',compact('input'),[],[
                'format'=>'A4',
                'watermark_image_path' => public_path().'/assets/img/functions/qrcodetwobf/qrcodetwobf-vertical.png',
                'show_watermark_image' => true,
                'watermark_image_alpha' => 1,
                'watermark_image_position' => 'P',
                'custom_font_dir'  => public_path().'/assets/fonts/',
                'custom_font_data' => [
                    'dosis' => [ 
                        'R'  => 'Dosis.ttf',
                        'B'  => 'Dosis-Bold.ttf',
                        'I'  => 'Dosis-Regular.ttf'
                    ]
                ]
            ]);
        }else{
            $pdf = PDF::loadView('pdfs/pdf-qrcodetwo',compact('input'),[],[
                'format'=>'A4',
                'orientation'=>'landscape',
                'watermark_image_path' => public_path().'/assets/img/functions/qrcodetwobf/qrcodetwobf-horizontal.png',
                'show_watermark_image' => true,
                'watermark_image_alpha' => 1,
                'watermark_image_position' => 'F',
                'custom_font_dir'  => public_path().'/assets/fonts/',
                'custom_font_data' => [
                    'dosis' => [ 
                        'R'  => 'Dosis.ttf',
                        'B'  => 'Dosis-Bold.ttf',
                        'I'  => 'Dosis-Regular.ttf'
                    ]
                ]
            ]);
        }
        $pdf->download($file_name);
    }


    public function donwloadArt($input, $user, $bgImage, $artOption){
        unset($input['_token']);
        Download::create(['art_id'=>$input['art_id'],'user_id'=>$user->id,'json'=>json_encode($input),'type'=>2]);
        // session()->flash('success', 'Arte criada com sucesso.');
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $artOption->title)));
        header('Content-type: image/jpeg');
        //comentar abaixo caso não queira download
        // if($user->role_id!=1){
            header('Content-Disposition: attachment; filename=arte-'.$user->id.'-'.$slug.'.jpg');
        // }
        
        imagejpeg( $bgImage, NULL, 100 );
        imagedestroy($bgImage);
    }

    public function adddownload(Request $request){
        $input = $request->all();
        $user = Auth::user();
        Download::create(['art_id'=>$input['art'],'user_id'=>$user->id,'json'=>json_encode($input),'type'=>2]);
        return true;
    }
}