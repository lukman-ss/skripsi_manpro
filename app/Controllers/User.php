<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthModel;
use App\Models\NotificationModel;

class User extends BaseController
{
    
    public function index($role)
    {
        if(empty($this->isSuperUser($_SESSION['id'])))
        {
            session()->setFlashdata('error', 'Akses Ditolak');
            return redirect()->to('dashboard');
        }
        $AuthModel = new AuthModel();
        $pager=service('pager'); // call a service pager
        if($role == 'super_user')
        {
            $role_q = 'Super User';
        }else if($role =='project_leader')
        {
            $role_q = 'Project Leader';
        }else if($role =='designer')
        {
            $role_q = 'Designer';
        }else if($role =='developer')
        {
            $role_q = 'Developer';
        }else if($role =='tester')
        {
            $role_q = 'Tester';
        }
        $data['position'] = 'user/' . $role; //definisikan posisi url (setelah base_url)
        $data['page']=(int)(($this->request->getVar('page')!==null)?$this->request->getVar('page'):1)-1; // define page $_GET
        $data['perPage'] =  10; // limit data per page
        if($role == 'all')
        {
            $data['list'] = $AuthModel
            ->select('auth.id, auth.name, auth.email, role.name as role_name, auth.role')
            ->join('role', 'role.id = auth.role')
            ->where('auth.status', 'ACTIVE')->paginate($data['perPage'], 'default');
            $data['count'] = $AuthModel
            ->join('role', 'role.id = auth.role')
            ->where('auth.status', 'ACTIVE')
            ->countAllResults();
        }else{
            $data['list'] = $AuthModel
            ->select('auth.id, auth.name, auth.email, role.name as role_name, auth.role')
            ->join('role', 'role.id = auth.role')
            ->where('role.name', $role_q)
            ->where('auth.status', 'ACTIVE')->paginate($data['perPage'], 'default');
            $data['count'] = $AuthModel
            ->join('role', 'role.id = auth.role')
            ->where('auth.status', 'ACTIVE')
            ->where('role.name', $role_q)
            ->countAllResults();
        }
        // $data['list'] = $AuthModel
        // ->select('auth.id, auth.name, auth.email, role.name as role_name, auth.role')
        // ->join('role', 'role.id = auth.role')
        // ->where('role.name', $role_q)
        // ->where('auth.status', 'ACTIVE')->paginate($data['perPage'], 'default');
        // $data['count'] = $AuthModel
        // ->join('role', 'role.id = auth.role')
        // ->where('auth.status', 'ACTIVE')
        // ->where('role.name', $role_q)
        // ->countAllResults();
        $data['pager'] = $AuthModel->pager; // running pagination
        $data['notification'] = $this->list_notification($_SESSION['id']);
        return view('user/register',$data);
    }
    public function register()
    {
        if(empty($this->isSuperUser($_SESSION['id'])))
        {
            session()->setFlashdata('error', 'Akses Ditolak');
            return redirect()->to('dashboard');
        }
        $AuthModel = new AuthModel();
        $pager=service('pager'); // call a service pager
        $data['position'] = 'user/register'; //definisikan posisi url (setelah base_url)
        $data['page']=(int)(($this->request->getVar('page')!==null)?$this->request->getVar('page'):1)-1; // define page $_GET
        $data['perPage'] =  10; // limit data per page
        $data['list'] = $AuthModel
        ->select('auth.id, auth.name, auth.email, role.name as role_name, auth.role')
        ->join('role', 'role.id = auth.role')
        ->where('auth.status', 'ACTIVE')->paginate($data['perPage'], 'default');
        $data['count'] = $AuthModel->where('status', 'ACTIVE')->countAllResults();
        $data['pager'] = $AuthModel->pager; // running pagination
        $data['notification'] = $this->list_notification($_SESSION['id']);
        return view('user/register',$data);
    }
    public function search()
    {
        if(empty($this->isSuperUser($_SESSION['id'])))
        {
            session()->setFlashdata('error', 'Akses Ditolak');
            return redirect()->to('dashboard');
        }
        $AuthModel = new AuthModel();
        $pager=service('pager'); // call a service pager
        $data['position'] = 'user/search'; //definisikan posisi url (setelah base_url)
        $data['page']=(int)(($this->request->getVar('page')!==null)?$this->request->getVar('page'):1)-1; // define page $_GET
        $data['perPage'] =  10; // limit data per page

        $get = $this->request->getGet();

        $data['list'] = $AuthModel
        ->select('auth.id, auth.name, auth.email, role.name as role_name, auth.role')
        // ->distinct()
        ->join('role', 'role.id = auth.role' )
        ->like('auth.name', $get['search'])
        ->orLike('auth.email', $get['search'])
        ->where('auth.status', 'ACTIVE')
        ->paginate($data['perPage'], 'default');
        $data['count'] = $AuthModel
        // ->distinct()
        ->join('role', 'role.id = auth.role')
        ->like('auth.name', $get['search'])
        ->orLike('auth.email', $get['search'])
        ->where('auth.status', 'ACTIVE')
        ->countAllResults();
        $data['pager'] = $AuthModel->pager; // running pagination
        $data['notification'] = $this->list_notification($_SESSION['id']);
        return view('user/register',$data);
    }
    public function change_password()
    {
        if(empty($this->isSuperUser($_SESSION['id'])))
        {
            session()->setFlashdata('error', 'Akses Ditolak');
            return redirect()->to('dashboard');
        }
        $data['notification'] = $this->list_notification($_SESSION['id']);
        return view('user/change_password', $data);
    }
    public function change_password_save()
    {
        $post = $this->request->getPost();
        $this->AuthModel = new AuthModel();
        if ($post['password'] == $post['confirm_password']) 
        {
            $this->AuthModel
            ->set('password', password_hash($post['password'], PASSWORD_DEFAULT))
            ->where('id', $_SESSION['id'])
            ->update();

            session()->setFlashdata('msg', 'Password Berhasil Di Ubah, Silakan Login Kembali');
            return redirect()->to('dashboard');
        }
    }
    public function register_save()
    {
        $post  = $this->request->getPost();
        $this->AuthModel = new AuthModel;

        $rules = [
            'name'          => 'required',
            'email'         => 'is_unique[auth.email]',
            'password'      => 'required',
            'role'          => 'required'
        ];

        if($this->validate($rules)){
            $this->AuthModel
            ->set('name', $post['name'])
            ->set('email', $post['email'])
            ->set('password', password_hash($post['password'], PASSWORD_DEFAULT))
            ->set('role', $post['role'])
            ->insert();
            session()->setFlashdata('msg', 'Data Berhasil Ditambah');
            $text_log = 'USER MANAGEMENT CREATE | ' . 'Name: '.$post['name'] . ' | Email: '. $post['name'] . ' | Role: '. $post['role']. ' | Date Create: '. date('Y-m-d H:i:s');
            $this->write_log($text_log);
            return redirect()->to('user/register');
        }else{
            session()->setFlashdata('error', $this->validator);
            return redirect()->to('user/register');
        }
    }
    public function register_update()
    {
        $post = $this->request->getPost();
        $this->AuthModel = new AuthModel;
        $id = $this->AuthModel->select('id')->where('id', $post['id'])->first();
        if(empty($id))
        {
            session()->setFlashdata('error', 'User Tidak Ditemukan');
            return redirect()->to('user/register');
        }
        $rules = [
            'name'          =>  [
                                'rules' =>'required',
                                'errors' => [
                                    'required' => '{field} harus di isi'
                                            ],
                                ],
            'email'         => [
                                'rules' =>'is_unique[auth.email]',
                                'errors' => [
                                    'is_unique' => 'Data Telah Terdaftar'
                                            ],
                                ],
            'role'          =>  [
                                'rules' =>'required',
                                'errors' => [
                                    'required' => '{field} harus di isi'
                                            ],
                                ],
        ];
        if($this->validate($rules))
        {
            $this->AuthModel
            ->set('name', $post['name'])
            ->set('email', $post['email'])
            ->set('role', $post['role'])
            ->set('updated_at', date('Y-m-d H:i:s'))
            ->where('id', $post['id'])
            ->update();
            session()->setFlashdata('msg','ID: '.$id['id'].' Berhasil Diubah');
            $text_log = 'USER MANAGEMENT UPDATE | ' . ' ID : ' .$post['id'].' | Name: '.$post['name'] . ' | Email: '. $post['name'] . ' | Role: '. $post['role']. ' | Date Create: '. date('Y-m-d H:i:s');
            $this->write_log($text_log);
            return redirect()->to('user/register');
        }else{
            $AuthModel = new AuthModel();
            $data['position'] = 'user/register'; //definisikan posisi url (setelah base_url)
            $data['page']=(int)(($this->request->getVar('page')!==null)?$this->request->getVar('page'):1)-1; // define page $_GET
            $data['perPage'] =  10; // limit data per page
            $data['list'] = $AuthModel->where('status', 'ACTIVE')->paginate($data['perPage'], 'default');
            $data['pager'] = $AuthModel->pager; // running pagination
        return view('user/register',$data);
            $data['validation'] = $this->validator;
            return view('user/register',$data);
            // session()->setFlashdata('error',$data['validation'] );
        }
        return redirect()->to('user/register');
    }
    public function register_delete($id)
    {
        $post = $this->request->getPost();
        $this->AuthModel = new AuthModel;
        $user = $this->AuthModel->select('id')->where('id', $id )->first();
        if(empty($id))
        {
            session()->setFlashdata('error', 'User Tidak Ditemukan');
            return redirect()->to('user/register');
        }
        $this->AuthModel
            ->set('updated_at', date('Y-m-d H:i:s'))
            ->set('deleted_at', date('Y-m-d H:i:s'))
            ->set('deleted_by', $_SESSION['name'])
            ->set('status', 'DELETED')
            ->where('id', $id)
            ->update();
            $text_log = 'USER MANAGEMENT DELETE | ' . ' ID : ' .$id.' | Date Create: '. date('Y-m-d H:i:s');
            $this->write_log($text_log);
            session()->setFlashdata('msg','ID: '.$id .' Berhasil Dihapus');
            return redirect()->to('user/register');
        
    }
    public function register_cpas()
    {
        
        $post = $this->request->getPost();
        $this->AuthModel = new AuthModel;

        $rules = [
            'password'      => 'required',
        ];

        if($this->validate($rules)){
            $this->AuthModel
            ->set('password', password_hash($post['password'], PASSWORD_DEFAULT))
            ->where('id', $post['id'])
            ->update();
            $text_log = 'USER MANAGEMENT DELETE | ' . ' ID : ' .$post['id'].' | Date Create: '. date('Y-m-d H:i:s');
            $this->write_log($text_log);
            session()->setFlashdata('msg', 'Password Berhasil Diubah');
            return redirect()->to('user/register');
        }else{
            
            session()->setFlashdata('error', $this->validator);
            return redirect()->to('user/register');
        }
    }
}
