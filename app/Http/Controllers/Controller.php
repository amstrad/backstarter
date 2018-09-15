<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $style;
    public $currentUser;

    public function __construct()
    {

        $this->middleware(function ($request, $next) {
            $this->currentUser = Auth::user();
            View::share(array('currentUser' => $this->currentUser));
            return $next($request);
        });
    }


    public function swith_theme()
    {
        $style = session('style');

        if ($style == 'style.css' || empty($style)) {
            $switch_style = 'style_dark.css';
        } else {
            $switch_style = 'style.css';
        }

        session(['style' => $switch_style]);


        return redirect('admin/');
    }
}
