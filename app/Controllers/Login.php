<?php 

namespace App\Controllers;
use App\Models\UserModels;

class Login extends BaseController
{
    public function index()
    {
        if ($this->request->isAJAX()) {
            $session = session();
            $model = new UserModels();
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $data = $model->where('email',$email)->first();
            if($data){
                $chkpass = $data['password'];
                $verify_pass = password_verify($password, $chkpass);
                if($verify_pass){
                    $session_data = [
                        'id' => $data['id'],
                        'firstname' => $data['firstname'],
                        'lastname' => $data['lastname'],
                        'email' => $data['email'],
                        'level' => $data['level'],
                        'is_active' => $data['is_active'],
                        'signined' => TRUE,
                    ];
                    $session->set($session_data);
                    return json_encode(['success'=> true,'status' => 'OK','msg' => "" ]);
                }else{
                    return json_encode(['success'=> false,'status' => 'Error','msg' => "wrong password" ]);
                }
            }else{
                return json_encode(['success'=> false,'status' => 'Error','msg' => "email not found" ]);
            }
        }
    }
    public function signout(){
        if($this->request->isAJAX()){
            $session = session();
            $session->destroy();
            return json_encode(['success'=> true,'status' => 'OK','msg' => "" ]);
        }
       
    }
    public function validatedata(){
        if ($this->request->isAJAX()) {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            
            if(empty($email)){
                return json_encode(['success'=> false,'status' => 'Error','msg' => "Please Enter email" ]);
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return json_encode(['success'=> false,'status' => 'Error','msg' => "Invalid email, Please Enter email" ]);
            } 
            if(empty($password)){
                return json_encode(['success'=> false,'status' => 'Error','msg' => "Please Enter password" ]);
            }
            if(strlen($password) < 8 || strlen($password) > 30 ){
                return json_encode(['success'=> false,'status' => 'Error','msg' => "password Minimum 8 characters but no more than 30" ]);
            }
            return json_encode(['success'=> true,'status' => 'OK','msg' => "" ]);
        }
    }
}