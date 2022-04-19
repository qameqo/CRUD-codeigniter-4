<?php namespace App\Models;

use CodeIgniter\Model;

class UnitModels extends Model{

    protected $table = 'unit';
    protected $allowedFields = ['unit_id','unit_name','unit_create_date','unit_create_by','unit_update_date','unit_update_by'];

    public function get_unit(){
        return $this->db->table('unit')
        ->select('*')
        ->orderBy('unit.unit_name','ASC')
        ->get()->getResultArray();
    }

    public function check_name_unit($name){
        return $this->db->table('unit')
        ->select('unit.unit_name')->where('unit_name',$name)
        ->get()->getResultArray();
    }
    public function check_name_unit_by_id($name,$id){
        return $this->db->table('unit')
        ->select('unit.unit_name,unit.unit_id')
        ->where('unit_name',$name)
        ->where('unit_id !=',$id)
        ->get()->getResultArray();
    }
    public function dropdownlist(){
        return $this->db->table('unit')
        ->select('unit.unit_name,unit.unit_id')
        ->get()->getResultArray();
    }
}