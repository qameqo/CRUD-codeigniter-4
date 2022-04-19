<?php

namespace App\Controllers;

class Email extends BaseController
{
    public function index(){
        $to = 'kikukamo2540@gmail.com';
        $subject = "Hello Bulma requires you to verify your email.";
        $message = '<fieldset style="border:1px dotted teal;">Dear '.$to.',<br><br>
                <H1 style="text-align:center;">Thank you for your information. </H1> <br><br>
                <p style="text-align:center; font-size:150%;">
                <a href="'.base_url('Register/verify_email/'.$to).'"
                style="padding: 20px 40px 20px 40px; background-color:orange; 
                color:white; text-decoration:none; border-radius:40px;">Accept</a>
                </p>
                <br><br>
                Best Regards, <br><br>
                </fieldset>';
        $email = \Config\Services::email();
        $email->setFrom('qameqo.98@gmail.com','Hello Bulma');
        $email->setTo($to);
        $email->setSubject($subject);
        $email->setMessage($message);
        
        if($email->send()){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}