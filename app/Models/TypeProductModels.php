<?php namespace App\Models;

use CodeIgniter\Model;

class TypeProductModels extends Model{

    protected $table = 'type_product';
    protected $allowedFields = ['type_id','type_name','type_is_active','type_create_date','type_create_by','type_update_date','type_update_by','type_id_images'];

    public function get_type_product(){
        return $this->db->table('type_product')
        ->select('type_product.type_id,type_product.type_name,type_product.type_is_active,type_product.type_create_date,type_product.type_create_by,type_product.type_update_date,type_product.type_update_by,images.image_id,images.image_path')
        ->join('images','images.image_id=type_product.type_id_images')
        ->orderBy('type_product.type_name','ASC')
        ->get()->getResultArray();
    }
    public function get_name_type_product($name){
        return $this->db->table('type_product')
        ->select('type_product.type_name')
        ->where('type_name',$name)
        ->get()->getResultArray();
    }
    
    public function get_image_by_type($id_type){
        return $this->db->table('type_product')
        ->select('images.image_path,images.image_id')
        ->join('images','images.image_id=type_product.type_id_images')
        ->where('type_id',$id_type)
        ->get()->getResultArray();
    }
    public function get_name_and_id_type_product($name,$id){
        return $this->db->table('type_product')
        ->select('type_product.type_name,type_product.type_id')
        ->where('type_name',$name)
        ->where('type_id !=',$id)
        ->get()->getResultArray();
    }
    public function dropdownlist(){
        return $this->db->table('type_product')
        ->select('type_product.type_name,type_product.type_id')
        ->get()->getResultArray();
    }
}