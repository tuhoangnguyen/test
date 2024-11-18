<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    //
    public function __construct()
    {
        
    }

    public function index() {
        return View("clients/categories/list");
    }

    public function getCategory($id) {
        return View("clients/categories/edit");
    }

    public function updateCategory($id) {
        return "Submit sửa danh mục ".$id;
    }

    public function addCategory() {
        return View("clients/categories/add");
    }

    public function deleteCategory($id) {
        return "Submit xóa danh mục có id ".$id;
    }

    public function handleAddCategory() {
        return redirect(route("categories.add"));
    }
}
