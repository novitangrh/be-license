<?php

namespace App\Http\Controllers\FYP;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

use App\Models\FYP\Url;
use GuzzleHttp\Exception\GuzzleException;

class RoutingController extends Controller
{
    //With Auth
    public static function LoadServices()
    {
        $list = Url::GetPrimaryUrls();

        foreach ($list as $key => $val) 
        {
            if ($val['url_method'] === 'GET') 
            {
                Route::get(''.$val['url_masked_name'].''.$val['url_parameter'].'', ''.$val['controller_namespaces'].'@'.$val['function_name'].'');
            }
            elseif ($val['url_method'] === 'POST') 
            {
                Route::post(''.$val['url_masked_name'].''.$val['url_parameter'].'', ''.$val['controller_namespaces'].'@'.$val['function_name'].'')->name(''.$val['url_name'].'');
            }
            elseif ($val['url_method'] === 'PUT') 
            {
                Route::put(''.$val['url_masked_name'].''.$val['url_parameter'].'', ''.$val['controller_namespaces'].'@'.$val['function_name'].'')->name(''.$val['url_name'].'');
            }
            else 
            {
                Route::delete(''.$val['url_masked_name'].''.$val['url_parameter'].'', ''.$val['controller_namespaces'].'@'.$val['function_name'].'')->name(''.$val['url_name'].'');
            }
        }
    }

    //Without Auth
    public static function LoadPublicServices()
    {
        $list = Url::GetPublicUrls();

        foreach ($list as $key => $val) 
        {
            if ($val['url_method'] === 'GET') 
            {
                Route::get(''.$val['url_masked_name'].''.$val['url_parameter'].'', ''.$val['controller_namespaces'].'@'.$val['function_name'].'');
            }
            elseif ($val['url_method'] === 'POST') 
            {
                Route::post(''.$val['url_masked_name'].''.$val['url_parameter'].'', ''.$val['controller_namespaces'].'@'.$val['function_name'].'')->name(''.$val['url_name'].'');
            }
            elseif ($val['url_method'] === 'PUT') 
            {
                Route::put(''.$val['url_masked_name'].''.$val['url_parameter'].'', ''.$val['controller_namespaces'].'@'.$val['function_name'].'')->name(''.$val['url_name'].'');
            }
            else 
            {
                Route::delete(''.$val['url_masked_name'].''.$val['url_parameter'].'', ''.$val['controller_namespaces'].'@'.$val['function_name'].'')->name(''.$val['url_name'].'');
            }
        }
    }
}
