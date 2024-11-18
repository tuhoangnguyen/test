<?php

namespace App\Repositories;

use App\Models\Image;

class ImageRepository {

    protected $model;

    public function __construct() 
    {
        $this->model = new Image();
    }

    public function updateOrCreate($params, $data)
    {
        $save = $this->model->updateOrCreate($params, $data);
        return $save;
    }

    public function save($data)
    {
        $id = $data['id'] ?? null;
        
        // Kiểm tra xem bản ghi có tồn tại không
        $find = $id ? $this->model->find($id) : null;
    
        if ($find) {
            // Nếu tìm thấy bản ghi, cập nhật nó
            $save = $find->update($data);
        } else {
            // Nếu không tìm thấy, tạo mới bản ghi
            $save = $this->model->create($data);
        }
    
        return $save;
    }

}