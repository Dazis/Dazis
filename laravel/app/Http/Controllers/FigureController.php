<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

use App\Models\Figure;
header("Content-type: text/html; charset=utf-8"); 

class FigureController extends BaseController
{
    public function figureList(){
    	$model = new Figure();
    	$res = $model -> figureList();
        $ren = $model -> collectionList();
    	// print_r($res);die;
    	return view('layouts.index', ['res'=>$res, 'ren'=>$ren]);
    }
}
