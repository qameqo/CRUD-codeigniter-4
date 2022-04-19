<?php namespace App\Models;

use CodeIgniter\Model;

class ReportModels extends model{
    protected $table = 'report';
    protected $allowedFields = ['id','action','detail','action_date','action_by'];

    public function get_report(){
        return $this->db->table('report')
        ->select('*')
        ->orderBy('report.id','ASC')
        ->get()->getResultArray();
    }
}