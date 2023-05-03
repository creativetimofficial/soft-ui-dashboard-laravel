<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use App\Models\Stores;
use App\Models\ProductsFirebird;
use App\Models\LogsDiscounts;
use Session;
use Helper;
use Illuminate\Support\Facades\Auth;

class ProdControlController extends Controller
{
    public function getImagesApi(){
        // Set up the API request
        $api_key = "AIzaSyDzf5SN86wmCZQPiS2ZIvLx7xo4cTvkPMc";
        $search_engine_id = "c552e150707e44216";
        $ean = "7891033198160";

        $url = "https://www.googleapis.com/customsearch/v1?key={$api_key}&cx={$search_engine_id}&q={$ean}&searchType=image&imgSize=large";

        // Send the API request
        $response = file_get_contents($url);

        // Parse the response to extract the image URL
        $json = json_decode($response);
        $image_url = $json->items[0]->link;

        // Download the image
        $image_data = file_get_contents($image_url);

        // Set the headers to indicate that we're sending an image
        header("Content-Type: image/jpeg");
        header("Content-Disposition: attachment; filename=image.jpg");

        // Send the image data as the response
        echo $image_data;
    }
}
