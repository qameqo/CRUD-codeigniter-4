<?php

namespace App\Controllers;
use App\Models\UnitModels;
use App\Models\TypeProductModels;
use App\Models\ProductModels;
use CodeIgniter\Controller;
class Unit extends BaseController
{
    public function __construct(){
        $this->UnitModel = new UnitModels();
        $this->ProductModel = new ProductModels();
        helper(['form', 'url']);
    }
    public function index(){
        if ($this->request->isAJAX()) {
            // $data['product'] = $model->orderBy('id','DESC')->findAll();
            $data = [
                'unit' => $this->UnitModel->get_unit(),
            ];
            return json_encode($data);
        }
    }
    public function CheckName($name){
        if ($this->request->isAJAX()) {
            $data = $this->UnitModel->check_name_unit($name);
            $len = count($data);
            return $len;
        }
    }
    public function CheckNameByid($name,$id){
        if ($this->request->isAJAX()) {
            $data = $this->UnitModel->check_name_unit_by_id($name,$id);
            $len = count($data);
            return $len;
        }
    }
    public function Add(){
        if ($this->request->isAJAX()) {
            $name = $this->request->getPost('unit_name');
            $id = $this->request->getPost('unit_id');
            $update_date = $this->request->getPost('update_date');
            $update_by = $this->request->getPost('update_by');
            $chkname = $this->CheckName($name);
            if($chkname > 0){
                return json_encode(['success'=> false,'status' => 'Error','msg' => "Duplicate : Name Unit" ]);
            }
            $model_unit = new UnitModels();
            $data = [
                'unit_id' => $id,
                'unit_name' => $name,
                'unit_create_date' => $update_date,
                'unit_create_by' => $update_by,
                'unit_update_date'=> $update_date,
                'unit_update_by' => $update_by,
            ];
            $model_unit->insert($data);
            $result = $model_unit->affectedRows();
            if($result > 0){
                return json_encode(['success'=> true,'status' => 'OK','msg' => "Save Data Successfully" ]);
            }else{
                return json_encode(['success'=> false,'status' => 'Error','msg' => "Save Data not Success" ]);
            }
        }
    }
    public function Edit(){
        if ($this->request->isAJAX()) {
            $name = $this->request->getPost('unit_name');
            $id = $this->request->getPost('unit_id');
            $update_date = $this->request->getPost('update_date');
            $update_by = $this->request->getPost('update_by');
            $chkname = $this->CheckNameByid($name,$id);
            if($chkname > 0){
                return json_encode(['success'=> false,'status' => 'Error','msg' => "Duplicate : Name Unit" ]);
            }
            $model_unit = new UnitModels();
            $model_unit->set('unit_name',$name)->set('unit_update_date',$update_date)->set('unit_update_by',$update_by)->where('unit_id',$id);
            $model_unit->update();
            $query = $model_unit->affectedRows();
            if($query > 0){
                return json_encode(['success'=> true,'status' => 'OK','msg' => "Save Data Successfully" ]);
            }else{
                return json_encode(['success'=> false,'status' => 'Error','msg' => "Save Data not Success" ]);
            }
        }
    }
    public function Delete(){
        if ($this->request->isAJAX()) {
            $id_unit = $this->request->getPost('id_unit');
            $data_product = [
                'product' => $this->ProductModel->get_product_by_unit($id_unit),
            ];
            if(count($data_product['product']) > 0 ){ // ไม่อนุญาตให้ลบ
                return json_encode(['success'=> false,'status' => 'Error','msg' => "There are products in this unit" ]);
            }else{ // ลบได้
                $model_unit = new UnitModels();
                $model_unit->where('unit_id', $id_unit);
                $model_unit->delete();
                $result = $model_unit->affectedRows();
                if($result > 0){
                    return json_encode(['success'=> true,'status' => 'OK','msg' => "Delete Data Success" ]);  
                }else{
                    return json_encode(['success'=> false,'status' => 'Error','msg' => "Delete Data not Success" ]);  
                }
            }
        }
    }
    public function UnitList(){
        $data_unit = [
            'unit' => $this->UnitModel->dropdownlist(),
        ];
        return json_encode($data_unit);
    }
}