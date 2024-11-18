<?php

namespace App\Providers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    public function add(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required | min:3',
            'author' => 'required | min:3',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 'false',
                "message" => "Please fix this error",
                "error" => $validator->errors()
            ]);
        }

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->author = $request->author;
        $blog->shortDesc = $request->shortDesc;
        $blog->description = $request->description;
        $blog->save();

        return response()->json([
            'status' => 'true',
            'message' => 'Blog added successfully',
            "data" => $blog
        ]);
    }

}
