<?php namespace App\Models;

use CodeIgniter\Model;

class ProductModels extends Model{
    protected $table = 'product';
    protected $allowedFields = ['product_id','product_name','product_quality','product_is_active','product_create_date','product_create_by'
    ,'product_update_date','product_update_by','product_id_image','product_id_unit','product_id_type_product'];

    public function get_product(){
        return $this->db->table('product')
        ->select('product.product_id,product.product_update_by,product.product_update_date,product.product_name,product.product_quality,type_product.type_name,type_product.type_id,unit.unit_name,unit.unit_id,images.image_path,images.image_id')
        ->join('type_product','type_product.type_id=product.product_id_type_product')
        ->join('unit','unit.unit_id=product.product_id_unit')
        ->join('images','images.image_id=product.product_id_image')
        ->orderBy('product.product_name','ASC')
        ->get()->getResultArray();
    }
    public function get_product_by_type($id_type){
        return $this->db->table('product')
        ->select('product.product_id,product.product_name,product.product_quality,type_product.type_name')
        ->join('type_product','type_product.type_id=product.product_id_type_product')
        ->where('product.product_id_type_product',$id_type)
        ->get()->getResultArray();
    }
    public function get_product_by_unit($id_unit){
        return $this->db->table('product')
        ->select('*')
        ->join('unit','unit.unit_id=product.product_id_unit')
        ->where('product.product_id_unit',$id_unit)
        ->get()->getResultArray();
    }
    public function get_name_product($name){
        return $this->db->table('product')
        ->select('product.product_name')
        ->where('product_name',$name)
        ->get()->getResultArray();
    }
    public function get_name_and_id_product($name,$id){
        return $this->db->table('product')
        ->select('product.product_name,product.product_id')
        ->where('product_name',$name)
        ->where('product_id !=',$id)
        ->get()->getResultArray();
    }
    public function get_image_by_product($id){
        return $this->db->table('product')
        ->select('images.image_path,images.image_id')
        ->join('images','images.image_id=product.product_id_image')
        ->where('product_id',$id)
        ->get()->getResultArray();
    }
    public function get_qua_by_id($id){
        return $this->db->table('product')
        ->select('product.product_quality,product.product_id')
        ->where('product_id =',$id)
        ->get()->getResultArray();
    }
}