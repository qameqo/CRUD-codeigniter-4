<?php namespace App\Models;

use CodeIgniter\Model;

class UserModels extends model{
    protected $table = 'user';
    protected $allowedFields = ['id','firstname','lastname','email','password','level','is_active','create_date','create_by','update_date','update_by'];
    public function get_user(){
        return $this->db->table('user')
        ->select('*')
        ->orderBy('user.create_date','DESC')
        ->get()->getResultArray();
    }
}