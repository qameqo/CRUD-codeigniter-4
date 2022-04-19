<?php

namespace App\Controllers;
use App\Models\TypeProductModels;
use App\Models\ProductModels;
use App\Models\ImagesModels;
use CodeIgniter\Controller;
class TypeProduct extends BaseController
{
    protected $TypeProductModel;

    public function __construct(){
        $this->TypeProductModel = new TypeProductModels();
        $this->ProductModel = new ProductModels();
        $this->ImageModel = new ImagesModels();
        helper(['form', 'url']);
    }
    public function index(){
        if ($this->request->isAJAX()) {
            // $data['product'] = $model->orderBy('id','DESC')->findAll();
            $data = [
                'type_product' => $this->TypeProductModel->get_type_product(),
            ];
            return json_encode($data);
        }
    }
    public function CheckName($name){
        if ($this->request->isAJAX()) {
            $data = $this->TypeProductModel->get_name_type_product($name);
            $len = count($data);
            return $len;
        }
    }
    public function Checkname_by_id($name,$id){
        if ($this->request->isAJAX()) {
            $data = $this->TypeProductModel->get_name_and_id_type_product($name,$id);
            $len = count($data);
            return $len;
        }
    }
    public function Add(){
        if ($this->request->isAJAX()) {
            
            $name = $this->request->getPost('type_name');
            $id_img = $this->request->getPost('id_img');
            $id_type = $this->request->getPost('id_type');
            $update_date = $this->request->getPost('update_date');
            $update_by = $this->request->getPost('update_by');

            $file = $this->request->getFile('image');
            $profile_image = $file->getName();
            $temp = explode(".",$profile_image);
            $newfilename = $id_img . '.' . end($temp);
            $len = $this->CheckName($name);

            $validated = $this->validate([
                'image' => [
                    'uploaded[image]',
                    'mime_in[image,image/jpg,image/jpeg,image/gif,image/png]',
                    'max_size[image,1024]',
                    'is_image[image]'
                ],
            ]);
    
            if (!$validated) {
                return json_encode(['success'=> false,'status' => 'Error','msg' => $this->validator->geterror() ]);
            }
            
            if($len > 0){
                return json_encode(['success'=> false,'status' => 'Error','msg' => "Duplicate : Name Type Product" ]);
            }
            if($file->move("uploads", $newfilename)){
                $model_type = new TypeProductModels();
                $model_img = new ImagesModels();
                $data_type_product = [
                    'type_id' => $id_type,
                    'type_name' => $name,
                    'type_is_active' => 1,
                    'type_create_date' => $update_date,
                    'type_create_by' => $update_by,
                    'type_update_date'=> $update_date,
                    'type_update_by' => $update_by,
                    'type_id_images' => $id_img
                ];
                $data_img = [
                    'image_id' => $id_img,
                    'image_path' => $newfilename,
                    'image_is_active' => 1,
                    'image_create_date' => $update_date,
                    'image_create_by' => $update_by,
                    'image_update_date'=> $update_date,
                    'image_update_by' => $update_by,
                ];
                $model_img->insert($data_img);
                $result_img = $model_img->affectedRows();
                if($result_img > 0){
                    $model_type->insert($data_type_product);
                    $result_type = $model_type->affectedRows();
                    if($result_type > 0){
                        return json_encode(['success'=> true,'status' => 'OK','msg' => "Save Data Successfully" ]);
                    }
                }
            }else{
                return json_encode(['success'=> false,'status' => 'Error','msg' => "Upload Image Fail , re-upload" ]);
            }
        }
    }
    public function Delete(){
        if ($this->request->isAJAX()) {
            $id_type = $this->request->getPost('id_type');
            $data_product = [
                'product' => $this->ProductModel->get_product_by_type($id_type),
            ];
            $data_image = ['image_path' =>  $this->TypeProductModel->get_image_by_type($id_type)];
            $filefordelete = $data_image['image_path'][0]['image_path'];
            $id_img = $data_image['image_path'][0]['image_id'];

            if(count($data_product['product']) > 0 ){ // ไม่อนุญาตให้ลบ
                return json_encode(['success'=> false,'status' => 'Error','msg' => "There are products in this category" ]);
            }else{ // ลบได้
                if(file_exists('uploads/'.$filefordelete)){
                    unlink('uploads/'.$filefordelete);
                    $model_type = new TypeProductModels();
                    $model_type->where('type_id', $id_type);
                    $model_type->delete();
                    $result = $model_type->affectedRows();
                    if($result > 0){
                        $model_img = new ImagesModels();
                        $model_img->where('image_id', $id_img);
                        $model_img->delete();
                        $result_img = $model_img->affectedRows();
                        if($result_img > 0){
                            return json_encode(['success'=> true,'status' => 'OK','msg' => "Delete Data Success" ]);  
                        }
                    }
                }else{
                    return json_encode(['success'=> false,'status' => 'Error','msg' => "Delete Data not Success" ]);  
                }
            }
        }
    }
    public function Edit(){
        if ($this->request->isAJAX()) {
            $model_type = new TypeProductModels();
            $model_img = new ImagesModels();

            $status_image = $this->request->getPost('status_image');

            $image_id = $this->request->getPost('id_img');
            $type_id = $this->request->getPost('id_type');
            $type_name = $this->request->getPost('type_name');
            $update_date = $this->request->getPost('update_date');
            $update_by = $this->request->getPost('update_by');

            $len = $this->Checkname_by_id($type_name,$type_id);

            if($status_image == "New"){ // update 2 table and uploads file
                $data_image = ['image_path' =>  $this->TypeProductModel->get_image_by_type($type_id)];
                $filefordelete = $data_image['image_path'][0]['image_path'];

                $file = $this->request->getFile('image');
                $profile_image = $file->getName();
                $temp = explode(".",$profile_image);
                $newfilename = $image_id . '.' . end($temp);

                $validated = $this->validate([
                    'image' => [
                        'uploaded[image]',
                        'mime_in[image,image/jpg,image/jpeg,image/gif,image/png]',
                        'max_size[image,1024]',
                        'is_image[image]'
                    ],
                ]);
                if (!$validated) {
                    return json_encode(['success'=> false,'status' => 'Error','msg' => $this->validator->geterror() ]);
                }else if($len > 0){
                    return json_encode(['success'=> false,'status' => 'Error','msg' => "Duplicate : Name Type Product" ]);
                }else{
                    if(file_exists('uploads/'.$filefordelete)){
                        unlink('uploads/'.$filefordelete);
                        if($file->move("uploads", $newfilename)){
                            $model_img->set('image_path',$newfilename)->set('image_update_date',$update_date)->set('image_update_by',$update_by)
                            ->where('image_id',$image_id);
                            $model_img->update();
                            $result_img = $model_img->affectedRows();
                            if($result_img > 0){
                                $model_type->set('type_name',$type_name)->set('type_update_date',$update_date)->set('type_update_by',$update_by)
                                ->where('type_id',$type_id);
                                $model_type->update();
                                $result_type = $model_type->affectedRows();
                                if($result_type > 0){
                                    return json_encode(['success'=> true,'status' => 'OK','msg' => "Update Data Success" ]);
                                }else{
                                    return json_encode(['success'=> false,'status' => 'Error','msg' => "Update Data not Success" ]);
                                }
                            }else{
                                return json_encode(['success'=> false,'status' => 'Error','msg' => "Update Data not Success" ]);
                            }
                        }else{
                            return json_encode(['success'=> false,'status' => 'Error','msg' => "Update Data not Success" ]);
                        }
                    }else{
                        return json_encode(['success'=> false,'status' => 'Error','msg' => "Update Data not Success" ]);
                    }
                }
                return json_encode(['success'=> true,'status' => 'OK','msg' => "Save Data Successfully" ]);
            }else if($status_image == "Old"){ // update 1 table and no uploads file
                if($len > 0){
                    return json_encode(['success'=> false,'status' => 'Error','msg' => "Duplicate : Name Type Product" ]);
                }else{
                    $model_type->set('type_name',$type_name)->set('type_update_date',$update_date)->set('type_update_by',$update_by)->where('type_id',$type_id);
                    $model_type->update();
                    $query = $model_type->affectedRows();
                    if($query > 0){
                        return json_encode(['success'=> true,'status' => 'OK' ,'msg' => "Update Data Success" ]);
                    }else{
                        return json_encode(['success'=> false,'status' => 'Error','msg' => "Update Data not Success" ]);
                    }
                }
            }
        }
    }
    public function TypeProductList(){
        $data_type = [
            'type' => $this->TypeProductModel->dropdownlist(),
        ];
        return json_encode($data_type);
    }
}