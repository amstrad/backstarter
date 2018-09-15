<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MediaUploader;

class DashboardController extends Controller
{
    //
    public function index(Request $request){


        return View('admin.content');
    }


    public function settings(){

    }

}
