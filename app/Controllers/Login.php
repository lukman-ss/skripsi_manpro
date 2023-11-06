<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthModel;

class Login extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }
    public function process()
    {
        $session = session();
        $this->AuthModel = new AuthModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $data = $this->AuthModel->where('email', $email)->first();
        if($data){
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if($verify_pass){
                $ses_data = [
                    'id'            => $data['id'],
                    'name'          => $data['name'],
                    'email'         => $data['email'],
                    'role'          => $data['role'],
                    'logged_in'     => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/dashboard');
            }else{
                $session->setFlashdata('error', 'Password Salah');
                return redirect()->to('/login');
            }
        }else{
            $session->setFlashdata('error', 'Email Tidak Tersedia');
            return redirect()->to('/login');
        }
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}
