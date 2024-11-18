<?php

namespace App\Http\Controllers;

use App\Services\ImageService;
use Illuminate\Http\Request;

class TempImageController extends ApiController
{
    //
    protected ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    // Phương thức save hình
    public function save(Request $request) {
        $service = $this->imageService->save($request);
        
        return $this->response($service);
    }
}
