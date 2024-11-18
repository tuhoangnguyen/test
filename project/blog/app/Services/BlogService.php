<?php
namespace App\Services;

use App\Models\Blog;
use App\Models\Image;
use App\Repositories\BlogRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class BlogService extends AbstractService {

    protected BlogRepository $blogRepository;

    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }


    public function add($data) {
         
        $validator = Validator::make($data, [
            'title' => 'required | min:3',
            'author' => 'required | min:3',
        ]);

        if($validator->fails()) {
            $this->setStatus(false);
            $this->setMessage("Please fix this error");
            $this->setError($validator->errors());
            return $this;
        } 

        // $evaluatedData = [
        //     'id' => $data['id'],
        //     'title' => $data['title'],
        //     'author' => $data['author'],
        //     'shortDesc' => $data['shortDesc'],
        //     'description' => $data['description'],
        //     'image' => $data['image']
        // ];

        // $this->blogRepository->updateOrCreate([
        //     'id' => $data['id']
        // ],$evaluatedData);

        $tempImage = Image::find($data['image']);

        if($tempImage != null) {
            $imageExtArray = explode('.', $tempImage->name);
            $ext = last($imageExtArray);
            $imageName = time().'-'.$data->id.'.'.$ext;

            $data->image = $imageName;

            $sourcePath = public_path('uploads/temp/'.$tempImage->name);
            $destPath = public_path('uploads/blogs/'.$imageName);

            File::copy($sourcePath, $destPath);

        }

        $saveBlog = $this->blogRepository->save($data);

     
        $this->setStatus(true);
        $this->setMessage("Blog added successfully");
        $this->setError($validator->errors());
        $this->setData($saveBlog);
        return $this;
    }

}

