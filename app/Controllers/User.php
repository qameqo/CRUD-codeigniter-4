<?php

namespace App\Controllers;

use App\Models\UserModels;

class User extends BaseController
{
    protected $UserModel;

    public function __construct(){
        $this->UserModel = new UserModels();
        helper(['form', 'url']);
    }
    public function index(){
        if ($this->request->isAJAX()) {
            $data = [
                'user' => $this->UserModel->get_user(),
            ];
            return json_encode($data);
        }
    }
}