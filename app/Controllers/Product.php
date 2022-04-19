<?php

namespace App\Controllers;
use App\Models\TypeProductModels;
use App\Models\ProductModels;
use App\Models\ImagesModels;
use CodeIgniter\Controller;
class Product extends BaseController
{
    protected $ProductModel;

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
                'product' => $this->ProductModel->get_product(),
            ];
            return json_encode($data);
        }
    }
    public function CheckName($name){
        if ($this->request->isAJAX()) {
            $data = $this->ProductModel->get_name_product($name);
            $len = count($data);
            return $len;
        }
    }
    public function Add(){
        if ($this->request->isAJAX()) {

            $name = $this->request->getPost('name_product');
            $qua = $this->request->getPost('qua_product');
            $id_product = $this->request->getPost('id_product');
            $id_img = $this->request->getPost('id_img');
            $id_type = $this->request->getPost('id_type');
            $id_unit = $this->request->getPost('id_unit');
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
                return json_encode(['success'=> false,'status' => 'Error','msg' => "Duplicate : Name Product" ]);
            }

            if($file->move("uploads", $newfilename)){
                $model_product = new ProductModels();
                $model_img = new ImagesModels();
                
                $data_product = [
                    'product_id' => $id_product,
                    'product_name' => $name,
                    'product_quality' => $qua,
                    'product_is_active' => 1,
                    'product_create_date' => $update_date,
                    'product_create_by' => $update_by,
                    'product_update_date'=> $update_date,
                    'product_update_by' => $update_by,
                    'product_id_image' => $id_img,
                    'product_id_unit' => $id_unit,
                    'product_id_type_product' => $id_type,
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
                    $model_product->insert($data_product);
                    $result_product = $model_product->affectedRows();
                    if($result_product > 0){
                        return json_encode(['success'=> true,'status' => 'OK','msg' => "Save Data Successfully" ]);
                    }
                }
            }else{
                return json_encode(['success'=> false,'status' => 'Error','msg' => "Upload Image Fail , re-upload" ]);
            }
        }
    }
    public function Edit(){
        if ($this->request->isAJAX()) {
            $model_product = new ProductModels();
            $model_img = new ImagesModels();

            $status_image = $this->request->getPost('status_image');
            $id = $this->request->getPost('id');
            $image_id = $this->request->getPost('id_img');
            $type_id = $this->request->getPost('id_type');
            $unit_id = $this->request->getPost('id_unit');
            $name = $this->request->getPost('name_product');
            $qua = $this->request->getPost('quality_product');
            $update_date = $this->request->getPost('update_date');
            $update_by = $this->request->getPost('update_by');

            $len = $this->Checkname_by_id($name,$id);

            if($status_image == "New"){ // update 2 table and uploads file
                $data_image = ['image_path' =>  $this->ProductModel->get_image_by_product($id)];
                $filefordelete = $data_image['image_path'][0]['image_path'];
                // return json_encode($data_image);
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
                    return json_encode(['success'=> false,'status' => 'Error','msg' => "Duplicate : Name Product" ]);
                }else{
                    if(file_exists('uploads/'.$filefordelete)){
                        unlink('uploads/'.$filefordelete);
                        if($file->move("uploads", $newfilename)){
                            $model_img->set('image_path',$newfilename)->set('image_update_date',$update_date)->set('image_update_by',$update_by)
                            ->where('image_id',$image_id);
                            $model_img->update();
                            $result_img = $model_img->affectedRows();
                            if($result_img > 0){
                                $model_product
                                ->set('product_name',$name)
                                // ->set('product_quality',$qua)
                                ->set('product_id_unit',$unit_id)
                                ->set('product_id_image',$image_id)
                                ->set('product_id_type_product',$type_id)
                                ->set('product_update_date',$update_date)
                                ->set('product_update_by',$update_by)
                                ->where('product_id',$id);
                                $model_product->update();
                                $result_product = $model_product->affectedRows();
                                if($result_product > 0){
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
                    return json_encode(['success'=> false,'status' => 'Error','msg' => "Duplicate : Name Product" ]);
                }else{
                    $model_product
                    ->set('product_name',$name)
                    // ->set('product_quality',$qua)
                    ->set('product_id_unit',$unit_id)
                    ->set('product_id_image',$image_id)
                    ->set('product_id_type_product',$type_id)
                    ->set('product_update_date',$update_date)
                    ->set('product_update_by',$update_by)
                    ->where('product_id',$id);
                    $model_product->update();
                    $query = $model_product->affectedRows();
                    if($query > 0){
                        return json_encode(['success'=> true,'status' => 'OK' ,'msg' => "Update Data Success" ]);
                    }else{
                        return json_encode(['success'=> false,'status' => 'Error','msg' => "Update Data not Success" ]);
                    }
                }
            }
        }
    }
    public function Checkname_by_id($name,$id){
        if ($this->request->isAJAX()) {
            $data = $this->ProductModel->get_name_and_id_product($name,$id);
            $len = count($data);
            return $len;
        }
    }
    public function Delete(){
        if ($this->request->isAJAX()) {
            $id_product = $this->request->getPost('product_id');
            $data_image = ['image_path' =>  $this->ProductModel->get_image_by_product($id_product)];
            $filefordelete = $data_image['image_path'][0]['image_path'];
            $id_img = $data_image['image_path'][0]['image_id'];

            if(file_exists('uploads/'.$filefordelete)){
                unlink('uploads/'.$filefordelete);
                $model_product = new ProductModels();
                $model_product->where('product_id', $id_product);
                $model_product->delete();
                $result = $model_product->affectedRows();
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
    public function Add_Qua_Product(){
        if($this->request->isAJAX()){
            $id_product = $this->request->getPost('product_id');
            $qua_product = $this->request->getPost('product_qua');
            $update_by = $this->request->getPost('update_by');
            $update_date = $this->request->getPost('update_date');
            $mode = $this->request->getPost('mode');
            $data_qua = $this->ProductModel->get_qua_by_id($id_product);
            $data = $data_qua[0]['product_quality'];
            $sum = null;
            if($mode == "Add"){
                $sum = $data + $qua_product;
            }else{
                if(intval($qua_product) > intval($data)){
                    return json_encode(['success'=> false,'status' => 'Error','msg' => "The number to be subtracted is greater than the number there is." ]);
                }else{
                    $sum = $data - $qua_product;
                }
            }
            $model_product = new ProductModels();
            $model_product
            ->set('product_quality',$sum)
            ->set('product_update_date',$update_date)
            ->set('product_update_by',$update_by)
            ->where('product_id',$id_product);
            $model_product->update();
            $query = $model_product->affectedRows();
            if($query > 0){
                return json_encode(['success'=> true,'status' => 'OK' ,'msg' => "Update Data Success" ]);
            }else{
                return json_encode(['success'=> false,'status' => 'Error','msg' => "Update Data not Success" ]);
            }
        }
    }
}