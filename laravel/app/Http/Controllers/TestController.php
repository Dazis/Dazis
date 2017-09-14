<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

use App\Models\Test;
class TestController extends BaseController
{
    public function index(){
    	$model = new Test();
    	$res = $model -> index();
    	// print_r($res);
    	return view('layouts.retrieval');
    }
}
