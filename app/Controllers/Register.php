<?php

namespace App\Controllers;
use App\Models\UserModels;

class Register extends BaseController
{
    public function getData(){
        if ($this->request->isAJAX()) {
            $model = new UserModels();
            $data['user'] = $model->orderBy('id','DESC')->findAll();
            return json_encode($data);
        }
    }
    public function index(){
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $firstname = $this->request->getPost('firstname');
            $lastname = $this->request->getPost('lastname');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $confirmpassword = $this->request->getPost('confirmpassword');
            $update_date = $this->request->getPost('update_date');
            try{
                $model = new UserModels();
                $model->select('email');
                $model->where('email',$email);
                $query = $model->get();
                if($query->getNumRows() > 0){
                    return json_encode(['success'=> false,'status' => 'Error','msg' => "this email is correct..." ]);
                }else{
                    $data = [
                        'id' => $id,
                        'firstname' => $firstname,
                        'lastname' => $lastname,
                        'email' => $email,
                        'password' => password_hash($password,PASSWORD_DEFAULT),
                        'level' => 1,
                        'is_active' => false,
                        'create_date' => $update_date,
                        'create_by' => $firstname,
                        'update_date' => $update_date,
                        'update_by' => $firstname,
                    ];
                    $model->insert($data);
                    $result = $model->affectedRows();
                    if($result > 0){
                        $sendemail = $this->send_email($email,$firstname);
                        if($sendemail){
                            return json_encode(['success'=> true,'status' => 'OK','msg' => "Save the information successfully...." ]);
                        }else{
                            return json_encode(['success'=> false,'status' => 'Error','msg' => "Send Email Failed..." ]);
                        }
                    }else{
                        return json_encode(['success'=> false,'status' => 'Error','msg' => "Failed to save data..." ]);
                    }
                }
                
            }catch(Exception $e){
                return json_encode(['success'=> false,'status' => 'Error','msg' => $e->getMessage() ]);
            }
        }
    }
    public function validatedata(){
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $firstname = $this->request->getPost('firstname');
            $lastname = $this->request->getPost('lastname');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $confirmpassword = $this->request->getPost('confirmpassword');
            $update_date = $this->request->getPost('update_date');
            if(empty($firstname)){
                return json_encode(['success'=> false,'status' => 'Error','msg' => "Please Enter firstname"]);
            }
            if(strlen($firstname) < 3 || strlen($firstname) > 30 ){
                return json_encode(['success'=> false,'status' => 'Error','msg' => "firstname Minimum 3 characters but no more than 30" ]);
            }
            if(empty($lastname)){
                return json_encode(['success'=> false,'status' => 'Error','msg' => "Please Enter lastname" ]);
            }
            if(strlen($lastname) < 3 || strlen($lastname) > 30 ){
                return json_encode(['success'=> false,'status' => 'Error','msg' => "lirstname Minimum 3 characters but no more than 30" ]);
            }
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
            if(empty($confirmpassword)){
                return json_encode(['success'=> false,'status' => 'Error','msg' => "Please Enter confirmpassword" ]);
            }
            if($confirmpassword != $password){
                return json_encode(['success'=> false,'status' => 'Error','msg' => "does not match password" ]);
            }
            return json_encode(['success'=> true,'status' => 'OK','msg' => "" ]);
        }
    }
    public function send_email($email,$firstname){
        $to = $email;
        $subject = "Janda Air requires you to verify your email.";
        $message = '<fieldset style="border:1px dotted teal;">Dear '.$firstname.',<br><br>
                <H1 style="text-align:center;">Thank you for your information. </H1> <br><br>
                <p style="text-align:center; font-size:150%;">
                <a href="'.base_url('Register/verify_email/'.$email).'"
                style="padding: 20px 40px 20px 40px; background-color:orange; 
                color:white; text-decoration:none; border-radius:40px;">Accept</a>
                </p>
                <br><br>
                Best Regards, <br><br>
                </fieldset>';

        $emailci4 = \Config\Services::email();
        $emailci4->setFrom('qameqo.98@gmail.com','Janda Air');
        $emailci4->setTo($to);
        $emailci4->setSubject($subject);
        $emailci4->setMessage($message);
        
        if($emailci4->send()){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function verify_email($getemail){
        if(!empty($getemail)){
            $model = new UserModels();
            $data = $model->select('is_active')->where('email',$getemail)->first();
            if($data['is_active']){
                echo "<script>";
                echo "alert('email verified');";
                echo "window.location.href = '". base_url()."';";
                echo "</script>";
            }else{
                $model->set('is_active', 1);
                $model->where('email', $getemail);
                $query = $model->update();
                if($query){
                    echo "<script>";
                    echo "alert('verify email successfully');";
                    echo "window.location.href = '". base_url()."';";
                    echo "</script>";
                }else{
                    echo "<script>";
                    echo "alert('verify email not success');";
                    echo "window.location.href = '". base_url()."';";
                    echo "</script>";
                }
            }
        }else{
            echo "<script>";
            echo "alert('email not found');";
            echo "window.location.href = '". base_url()."';";
            echo "</script>";
        }
    }
}