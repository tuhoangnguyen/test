<?php

namespace App\Services;

use App\Models\Image;
use App\Repositories\ImageRepository;
use App\Services\AbstractService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImageService extends AbstractService {

    protected ImageRepository $imageRepository;


    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    public function save(Request $request) {
        $data = $request->all();

        // Check validation img
        $validator = Validator::make($data, [
            'image' => 'required|image'
        ]);

        if($validator->fails()) {
            $this->setStatus(false);
            $this->setMessage("Please fix this error");
            $this->setError($validator->errors());
            return $this;
        } 

    

        // Upload hình
        $image = $request->file('image');
        $ext = $image->getClientOriginalExtension();
        $imageName = time().'.'.$ext;

        // Lưu hình vào database
        $tempImg = new Image();
        $tempImg->name = $imageName;
        $saveImg = $this->imageRepository->save(['name' => $imageName]);
        
        // Di chuyển hình ảnh vào folder tạm
        $image->move(public_path("uploads/temp",$imageName));
        $this->setStatus(true);
        $this->setMessage("Image added successfully");
        $this->setError($validator->errors());
        $this->setData($saveImg);

        return $this;
    }


}