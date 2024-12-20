<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class HomeController extends BaseController
{
    
    public function index() {
        return "Home";
    }

    public function form() {
        return View("form");
    }

    public function category() {
        return "Đây là trang danh mục";
    }

    use AuthorizesRequests, ValidatesRequests;
}
