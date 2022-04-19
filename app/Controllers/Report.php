<?php

namespace App\Controllers;

use App\Models\ReportModels;

class Report extends BaseController
{
    protected $ReportModel;

    public function __construct(){
        $this->ReportModel = new ReportModels();
        helper(['form', 'url']);
    }
    public function index(){
        if ($this->request->isAJAX()) {
            $data = [
                'report' => $this->ReportModel->get_report(),
            ];
            return json_encode($data);
        }
    }
    public function SaveReport(){
        if ($this->request->isAJAX()) {
           $action = $this->request->getPost('action');
           $detail = $this->request->getPost('detail');
           $action_date = $this->request->getPost('action_date');
           $action_by = $this->request->getPost('action_by');
           $data_report = [
                'action' => $action,
                'detail' => $detail,
                'action_date' => $action_date,
                'action_by' => $action_by,
            ];
            $model_report = new ReportModels();
            $model_report->insert($data_report);
            $result = $model_report->affectedRows();
            if($result > 0){
                return json_encode(['success'=> true,'status' => 'OK','msg' => "Save Report Success" ]);
            }
        }
    }
}