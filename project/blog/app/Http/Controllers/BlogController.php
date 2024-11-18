<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Models\Blog;
use App\Services\BlogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogController extends ApiController
{

    protected BlogService $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    //
    // Phương thức lấy hết blogs
    public function index() {

    }

    // Phương thức lấy ra 1 blog
    public function show() {

    }

    public function add(Request $request) {
        $service = $this->blogService->add($request->all());

        return $this->response($service);
    }

    public function update() {

    }

    public function delete() {

    }
}
