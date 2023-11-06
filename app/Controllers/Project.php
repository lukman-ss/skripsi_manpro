<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthModel;
use App\Models\ProjectModel;
use App\Models\TeamModel;
use App\Models\BudgetModel;
use App\Models\TimelineModel;
use App\Models\TaskModel;
use App\Models\AmountModel;
use App\Models\FileModel;
use App\Models\ClientModel;
// use App\Models\Am

class Project extends BaseController
{
    public function project_finish(int $project_id)
    {
        $this->ProjectModel = new ProjectModel;
        $check = $this->ProjectModel
        ->select('project.id')
        ->join('task', 'task.project_id = project.id')
        ->where('task.status', 'ACTIVE')
        ->where('project.id', $project_id)
        ->countAllResults();

        if($check > 0)
        {
            session()->setFlashdata( 'error', 'Selesaikan Task Terlebih Dahulu');
            return redirect()->to('project/project_detail/' . $project_id);
        }else{
            $this->ProjectModel
            ->set('status', 'FINISHED')
            ->where('id', $project_id)
            ->update();

            session()->setFlashdata( 'msg', 'Proyek Anda Telah Selesai!');
            return redirect()->to('project/project_detail/'. $project_id);
        }
    }
    public function client_update()
    {
        $post = $this->request->getPost();
        $this->ClientModel = new ClientModel;
        $rules = [
            'name'          => 'required',
            'company'         => 'required',
        ];
        if($this->validate($rules)){
            $this->ClientModel
            ->set('name', $post['name'])
            ->set('company', $post['company'])
            ->set('updated_at', date('Y-m-d H:i:s'))
            ->where('id', $post['id'])
            ->update();
            session()->setFlashdata('msg', 'Data Berhasil Diubah');
            $text_log = 'CLIENT UPDATE | ' 
                        . 'Name: '.$post['name'] 
                        . ' | Company: '. $post['company'] 
                        . ' | Date Create: ' . date('Y-m-d H:i:s');
            $this->write_log($text_log);
            return redirect()->to('project/client');
        }else{
            session()->setFlashdata('error', $this->validator);
            return redirect()->to('project/client');
        }
    }
    public function client_delete($id)
    {
        $this->ClientModel = new ClientModel;
        $data = $this->ClientModel->select('id')->where('id', $id)->first();
        if(!empty($data))
        {
            $this->ClientModel
            ->set('status', 'DELETED')
            ->set('deleted_at', date('Y-m-d H:i:s'))
            ->set('deleted_by', $_SESSION['name'])
            ->where('id', $id)
            ->update();
            session()->setFlashdata('msg', 'Data Berhasil Dihapus');
            $text_log = 'CLIENT DELETE | ' 
                        . 'id: '.$id
                        . ' | Date Create: ' . date('Y-m-d H:i:s');
            $this->write_log($text_log);
            return redirect()->to('project/client');
        }
    }
    public function client_save()
    {
        $this->ClientModel = new ClientModel;
        $post = $this->request->getPost();
        $rules = [
            'name'          => 'required',
            'company'         => 'required',
        ];
        if($this->validate($rules)){
            $this->ClientModel
            ->set('name', $post['name'])
            ->set('company', $post['company'])
            ->insert();
            session()->setFlashdata('msg', 'Data Berhasil Ditambah');
            $text_log = 'CLIENT CREATE | ' 
                        . 'Name: '.$post['name'] 
                        . ' | Company: '. $post['company'] 
                        . ' | Date Create: ' . date('Y-m-d H:i:s');
            $this->write_log($text_log);
            return redirect()->to('project/client');
        }else{
            session()->setFlashdata('error', $this->validator);
            return redirect()->to('project/client');
        }
        
    }
    public function client()
    {
        helper('form');
        $ClientModel = new ClientModel;

        $data['position'] = 'project/client'; //definisikan posisi url (setelah base_url)
        $data['page']=(int)(($this->request->getVar('page')!==null)?$this->request->getVar('page'):1)-1; // define page $_GET
        $data['perPage'] =  10; // limit data per page
        $data['list'] = [];
        $data['count'] = 0;
        if($_SESSION['role'] == 1 )
        {
            $data['list'] = $ClientModel
            ->select('client.name, client.id, client.company,client.status')
            ->distinct()
            ->join('project', 'client.id = project.project_client')
            ->join('team', 'team.project_id = project.id')
            ->where('client.status', 'ACTIVE')
            ->paginate($data['perPage'], 'default');
            $data['count'] =  $ClientModel
            ->select('client.name, client.id, client.company,client.status')
            ->distinct()
            ->join('project', 'client.id = project.project_client')
            ->join('team', 'team.project_id = project.id')
            ->where('client.status', 'ACTIVE')
            ->countAllResults();
        }else{
            $data['list'] = $ClientModel
            ->select('client.name, client.id, client.company,client.status')
            ->join('project', 'client.id = project.project_client')
            ->join('team', 'team.project_id = project.id')
            ->where('client.status', 'ACTIVE')
            ->where('team.auth_id', $_SESSION['id'])
            ->paginate($data['perPage'], 'default');
            $data['count'] =  $ClientModel
            ->select('client.name, client.id, client.company,client.status')
            ->join('project', 'client.id = project.project_client')
            ->join('team', 'team.project_id = project.id')
            ->where('client.status', 'ACTIVE')
            ->where('team.auth_id', $_SESSION['id'])
            ->countAllResults();
        }
        
        
        $data['pager'] = $ClientModel->pager; // running pagination

        $data['notification'] = $this->list_notification($_SESSION['id']);
        return view('projects/client', $data);
    }
    public function cleint_search()
    {
        
    }
    public function project_delete($id)
    {
        $this->ProjectModel = new ProjectModel;
        $data = $this->ProjectModel->select('id')->where('id', $id)->first();
        if(!empty($data))
        {
            $check = $this->ProjectModel
            ->select('project.id')
            ->join('task', 'task.project_id = project.id')
            ->where('task.status', 'ACTIVE')
            ->where('project.id', $id)
            ->countAllResults();

            if($check > 0)
            {
                session()->setFlashdata( 'error', 'Selesaikan Task Terlebih Dahulu');
                return redirect()->to('project');
            }else{
                $this->ProjectModel
                ->set('status', 'DELETED')
                ->set('deleted_at', date('Y-m-d H:i:s'))
                ->set('deleted_by', $_SESSION['name'])
                ->where('id', $id)
                ->update();
                session()->setFlashdata('msg', 'Data Berhasil Dihapus');
                $text_log = 'PROJECT DELETE | ' 
                            . 'id: '.$id
                            . ' | Date Create: ' . date('Y-m-d H:i:s');
                $this->write_log($text_log);
                return redirect()->to('project');
            }
        }
    }
    public function index()
    {
        helper('form');
        $AuthModel = new AuthModel;
        $ProjectModel = new ProjectModel;
        $ClientModel = new ClientModel;
        $project_leader = $AuthModel->where('role', 2)->where('status', 'ACTIVE')->findAll();
        $project_leader_column = array_column($project_leader, 'name', 'id');
        $project_leader_other_attrs = ["class" => "form-select"];
        $data['project_leader_dropdown'] = form_dropdown('project_leader',$project_leader_column, 1, $project_leader_other_attrs);

        $designer = $AuthModel->where('role', 3)->where('status', 'ACTIVE')->findAll();
        $designer_column = array_column($designer, 'name', 'id');
        $designer_other_attrs = ["class" => "form-select"];
        $data['designer_dropdown'] = form_dropdown('designer',$designer_column, 1, $designer_other_attrs);

        $developer = $AuthModel->where('role', 4)->where('status', 'ACTIVE')->findAll();
        $developer_column = array_column($developer, 'name', 'id');
        $developer_other_attrs = ["class" => "form-select"];
        $data['developer_dropdown'] = form_dropdown('developer',$developer_column, 1, $developer_other_attrs);

        $tester = $AuthModel->where('role', 5)->where('status', 'ACTIVE')->findAll();
        $tester_column = array_column($tester, 'name', 'id');
        $tester_other_attrs = ["class" => "form-select"];
        $data['tester_dropdown'] = form_dropdown('tester',$tester_column, 1, $tester_other_attrs);

        $client = $ClientModel->where('status', 'ACTIVE')->orderBy('company', 'ASC')->findAll();
        $client_column = array_column($client, 'company', 'id');
        $client_other_attrs = ["class" => "form-select"];
        $data['client_dropdown'] = form_dropdown('project_client',$client_column, 1, $client_other_attrs);

        $data['position'] = 'project'; //definisikan posisi url (setelah base_url)
        $data['page']=(int)(($this->request->getVar('page')!==null)?$this->request->getVar('page'):1)-1; // define page $_GET
        $data['perPage'] =  10; // limit data per page
        if($_SESSION['role'] == 1)
        {
            $data['list'] = $ProjectModel
            ->select('project.id, project.project_name, project.project_description, project.project_client, project.status, client.company AS client_name')
            ->distinct()
            ->join('team', 'team.project_id = project.id')
            ->join('client', 'project.project_client = client.id')
            ->where('project.status', 'ACTIVE')
            ->paginate($data['perPage'], 'default');

            $data['count'] =  $ProjectModel
            ->select('project.id, project_name, project_description, project_client, status')
            ->distinct()
            ->join('team', 'team.project_id = project.id')
            ->where('project.status', 'ACTIVE')
            ->countAllResults();
        }else{
            $data['list'] = $ProjectModel
            ->select('project.id, project.project_name, project.project_description, project.project_client, project.status, client.company AS client_name')
            ->join('team', 'team.project_id = project.id')
            ->join('client', 'project.project_client = client.id')
            ->where('project.status', 'ACTIVE')
            ->where('team.auth_id', $_SESSION['id'])
            ->paginate($data['perPage'], 'default');

            $data['count'] =  $ProjectModel
            ->select('project.id, project_name, project_description, project_client, status')
            ->join('team', 'team.project_id = project.id')
            ->where('project.status', 'ACTIVE')
            ->where('team.auth_id', $_SESSION['id'])->countAllResults();
        }
        
        $data['pager'] = $ProjectModel->pager; // running pagination

        $data['notification'] = $this->list_notification($_SESSION['id']);
        return view('projects/index', $data);
    }
    public function project_finished()
    {
        helper('form');
        $AuthModel = new AuthModel;
        $ProjectModel = new ProjectModel;
        $ClientModel = new ClientModel;
        $project_leader = $AuthModel->where('role', 2)->where('status', 'ACTIVE')->findAll();
        $project_leader_column = array_column($project_leader, 'name', 'id');
        $project_leader_other_attrs = ["class" => "form-select"];
        $data['project_leader_dropdown'] = form_dropdown('project_leader',$project_leader_column, 1, $project_leader_other_attrs);

        $designer = $AuthModel->where('role', 3)->where('status', 'ACTIVE')->findAll();
        $designer_column = array_column($designer, 'name', 'id');
        $designer_other_attrs = ["class" => "form-select"];
        $data['designer_dropdown'] = form_dropdown('designer',$designer_column, 1, $designer_other_attrs);

        $developer = $AuthModel->where('role', 4)->where('status', 'ACTIVE')->findAll();
        $developer_column = array_column($developer, 'name', 'id');
        $developer_other_attrs = ["class" => "form-select"];
        $data['developer_dropdown'] = form_dropdown('developer',$developer_column, 1, $developer_other_attrs);

        $tester = $AuthModel->where('role', 5)->where('status', 'ACTIVE')->findAll();
        $tester_column = array_column($tester, 'name', 'id');
        $tester_other_attrs = ["class" => "form-select"];
        $data['tester_dropdown'] = form_dropdown('tester',$tester_column, 1, $tester_other_attrs);

        $client = $ClientModel->where('status', 'ACTIVE')->orderBy('company', 'ASC')->findAll();
        $client_column = array_column($client, 'company', 'id');
        $client_other_attrs = ["class" => "form-select"];
        $data['client_dropdown'] = form_dropdown('project_client',$client_column, 1, $client_other_attrs);

        $data['position'] = 'project/finished'; //definisikan posisi url (setelah base_url)
        $data['page']=(int)(($this->request->getVar('page')!==null)?$this->request->getVar('page'):1)-1; // define page $_GET
        $data['perPage'] =  10; // limit data per page
        $data['list'] = $ProjectModel
        ->select('project.id, project_name, project_description, project_client, project.status, client.company AS client_name')
        ->join('team', 'team.project_id = project.id')
        ->join('client', 'project.project_client = client.id')
        ->where('project.status', 'FINISHED')
        ->where('team.auth_id', $_SESSION['id'])
        ->paginate($data['perPage'], 'default');
        $data['count'] =  $ProjectModel
        ->select('project.id, project_name, project_description, project_client, status')
        ->join('team', 'team.project_id = project.id')
        ->where('project.status', 'FINISHED')
        ->where('team.auth_id', $_SESSION['id'])->countAllResults();
        
        $data['pager'] = $ProjectModel->pager; // running pagination

        $data['notification'] = $this->list_notification($_SESSION['id']);
        return view('projects/index', $data);
    }
    public function search()
    {
        helper('form');
        $AuthModel = new AuthModel;
        $ProjectModel = new ProjectModel;
        $ClientModel = new ClientModel;
        $project_leader = $AuthModel->where('role', 2)->where('status', 'ACTIVE')->findAll();
        $project_leader_column = array_column($project_leader, 'name', 'id');
        $project_leader_other_attrs = ["class" => "form-select"];
        $data['project_leader_dropdown'] = form_dropdown('project_leader',$project_leader_column, 1, $project_leader_other_attrs);

        $designer = $AuthModel->where('role', 3)->where('status', 'ACTIVE')->findAll();
        $designer_column = array_column($designer, 'name', 'id');
        $designer_other_attrs = ["class" => "form-select"];
        $data['designer_dropdown'] = form_dropdown('designer',$designer_column, 1, $designer_other_attrs);

        $developer = $AuthModel->where('role', 4)->where('status', 'ACTIVE')->findAll();
        $developer_column = array_column($developer, 'name', 'id');
        $developer_other_attrs = ["class" => "form-select"];
        $data['developer_dropdown'] = form_dropdown('developer',$developer_column, 1, $developer_other_attrs);

        $tester = $AuthModel->where('role', 5)->where('status', 'ACTIVE')->findAll();
        $tester_column = array_column($tester, 'name', 'id');
        $tester_other_attrs = ["class" => "form-select"];
        $data['tester_dropdown'] = form_dropdown('tester',$tester_column, 1, $tester_other_attrs);

        $client = $ClientModel->where('status', 'ACTIVE')->orderBy('company', 'ASC')->findAll();
        $client_column = array_column($client, 'company', 'id');
        $client_other_attrs = ["class" => "form-select"];
        $data['client_dropdown'] = form_dropdown('project_client',$client_column, 1, $client_other_attrs);

        $data['position'] = 'project'; //definisikan posisi url (setelah base_url)
        $data['page']=(int)(($this->request->getVar('page')!==null)?$this->request->getVar('page'):1)-1; // define page $_GET
        $data['perPage'] =  10; // limit data per page

        $get = $this->request->getGet();

        if($_SESSION['role'] != 1)
        {
            $data['list'] = $ProjectModel
            ->distinct()
            ->select('project.id, project_name, project_description, project_client, status')
            ->join('team', 'team.project_id = project.id')
            ->where('project.status', 'ACTIVE')
            ->where('team.auth_id', $_SESSION['id'])
            ->like('project.project_name', $get['search'], 'both')
            ->orLike('project.project_description', $get['search'], 'both')
            ->orLike('project.project_client', $get['search'], 'both')
            ->paginate($data['perPage'], 'default');
            // print_r($data['list']);exit;

            $data['count'] =  $ProjectModel
            ->distinct()
            ->select('project.id, project_name, project_description, project_client, status')
            ->join('team', 'team.project_id = project.id')
            ->where('project.status', 'ACTIVE')
            ->where('team.auth_id', $_SESSION['id'])
            ->like('project.project_name', $get['search'], 'both')
            ->orLike('project.project_description', $get['search'], 'both')
            ->orLike('project.project_client', $get['search'], 'both')
            ->countAllResults();
        }else{
            $data['list'] = $ProjectModel
            ->distinct()
            ->select('project.id, project.project_name, project.project_description, project.project_client, project.status, client.company as client_name')
            ->join('team', 'team.project_id = project.id')
            ->join('client', 'project.project_client = client.id')
            ->where('project.status', 'ACTIVE')
            // ->where('team.auth_id', $_SESSION['id'])
            ->like('project.project_name', $get['search'], 'both')
            ->orLike('project.project_description', $get['search'], 'both')
            ->orLike('project.project_client', $get['search'], 'both')
            ->paginate($data['perPage'], 'default');
            // print_r($data['list']);exit;

            $data['count'] =  $ProjectModel
            ->distinct()
            ->select('project.id, project_name, project_description, project_client, status')
            ->join('team', 'team.project_id = project.id')
            ->where('project.status', 'ACTIVE')
            // ->where('team.auth_id', $_SESSION['id'])
            ->like('project.project_name', $get['search'], 'both')
            ->orLike('project.project_description', $get['search'], 'both')
            ->orLike('project.project_client', $get['search'], 'both')
            ->countAllResults();
        }

        $data['pager'] = $ProjectModel->pager; // running pagination

        $data['notification'] = $this->list_notification($_SESSION['id']);
        return view('projects/index', $data);
    }
    public function project_edit($id)
    {
        helper('form');
        $AuthModel = new AuthModel;
        $ProjectModel = new ProjectModel;
        $BudgetModel = new BudgetModel;
        $ClientModel = new ClientModel;
        $FileModel = new FileModel;

        $project_team = $AuthModel->select('auth.id, auth.role, auth.name')->join('team', 'auth.id = team.auth_id')->where('team.project_id', $id)->findAll();
        $data = array();
        foreach($project_team as $key => $value)
        {
            if($value['role'] == 3)
            {
                $designer = $AuthModel->where('role', 3)->where('status', 'ACTIVE')->findAll();
                $designer_column = array_column($designer, 'name', 'id');
                $designer_other_attrs = ["class" => "form-select"];
                $data['id_designer'] = $value['id'];
                $data['designer_dropdown'] = form_dropdown('designer',$designer_column, $value['id'], $designer_other_attrs);
            }
            if($value['role'] == 4)
            {
                $developer = $AuthModel->where('role', 4)->where('status', 'ACTIVE')->findAll();
                $developer_column = array_column($developer, 'name', 'id');
                $developer_other_attrs = ["class" => "form-select"];
                $data['id_developer'] = $value['id'];
                $data['developer_dropdown'] = form_dropdown('developer',$developer_column, $value['id'], $developer_other_attrs);
            }
            if($value['role'] == 5)
            {
                $tester = $AuthModel->where('role', 5)->where('status', 'ACTIVE')->findAll();
                $tester_column = array_column($tester, 'name', 'id');
                $tester_other_attrs = ["class" => "form-select"];
                $data['id_tester'] = $value['id'];
                $data['tester_dropdown'] = form_dropdown('tester',$tester_column, $value['id'], $tester_other_attrs);
            }
            if($value['role'] == 2)
            {
                $project_leader = $AuthModel->where('role', 2)->where('status', 'ACTIVE')->findAll();
                $project_leader_column = array_column($project_leader, 'name', 'id');
                $project_leader_other_attrs = ["class" => "form-select"];
                $data['id_project_leader'] = $value['id'];
                $data['project_leader_dropdown'] = form_dropdown('project_leader',$project_leader_column, $value['id'], $project_leader_other_attrs);
            }
        }
        $data['project_id'] = $id;
        $data['project'] = $ProjectModel->where('id', $id)->where('status', 'ACTIVE')->first();
        $data['budget'] = $BudgetModel->where('project_id', $id)->first();

        $client = $ClientModel->where('status', 'ACTIVE')->orderBy('company', 'ASC')->findAll();
        $client_column = array_column($client, 'company', 'id');
        $client_other_attrs = ["class" => "form-select"];
        $data['client_dropdown'] = form_dropdown('project_client',$client_column, $data['project']['project_client'], $client_other_attrs);

        $data['file'] = $FileModel
        ->select('name_file, id')
        ->where('status', 'ACTIVE')
        ->where('project_id', $id)
        ->findAll();
        
        $data['notification'] = $this->list_notification($_SESSION['id']);
        return view('projects/edit', $data);
    }
    public function update_budget()
    {
        $post = $this->request->getPost();
        
        $this->BudgetModel = new BudgetModel;

        if($this->BudgetModel->where('project_id', $post['project_id'])->first() > 0)
        {
            $this->BudgetModel
            ->set('estimated_duration', $post['estimated_duration'])
            ->set('estimated_budget', $post['estimated_budget'])
            ->where('project_id', $post['project_id'])
            ->update();
            $text_log = 
            'PROJECT UPDATE BUDGET | ' 
            . ' project id : ' 
            .$post['project_id']
            .' | estimated budget: '
            .$post['estimated_budget'] 
            . ' | estimated_duration: '
            . $post['estimated_duration'] 
            .  ' | Date Create: '. date('Y-m-d H:i:s');
            $this->write_log($text_log);

            session()->setFlashdata('msg', 'Budget Berhasil Diubah');

            return redirect()->to('project/project_edit/'. $post['project_id']);
        }
    }
    public function file_save()
    {
        $this->FileModel = new FileModel;
        if (!$this->validate([
			'berkas' => [
				'rules' => 'mime_in[berkas,application/x-download,image/jpg,image/jpeg,image/gif,image/png,application/x-pdf,application/pdf]|max_size[berkas,8048]',
				'errors' => [
					'mime_in' => 'File Extention Harus Berupa jpg,jpeg,gif,png',
					'max_size' => 'Ukuran File Maksimal 8 MB'
				]
 
			]
		])) {
			session()->setFlashdata('error', $this->validator->listErrors());
			return redirect()->back()->withInput();
		}

        $post = $this->request->getPost();
 
		$dataBerkas = $this->request->getFile('berkas');
		$fileName = 'PROJECT ' . $post['project_id'] . ' - '. $dataBerkas->getClientName();
        // echo $fileName;
		$this->FileModel->insert([
            'created_by' => $_SESSION['name'],
            'project_id' => $post['project_id'],
			'name_file' => $fileName,
		]);
		$dataBerkas->move(ROOTPATH . 'public\upload\berkas', $fileName);
		session()->setFlashdata('success', 'Berkas Berhasil diupload');
		return redirect()->to(base_url('project/project_detail/' . $post['project_id']));
    }
    public function update_project()
    {
        $post = $this->request->getPost();

        $this->ProjectModel = new ProjectModel;

        if($this->ProjectModel->where('id', $post['id'])->where('status', 'ACTIVE')->first() > 0)
        {
            $this->ProjectModel
            ->set('project_name', $post['project_name'])
            ->set('project_description', $post['project_description'])
            ->set('project_client', $post['project_client'])
            ->set('updated_at', date('Y-m-d H:i:s'))
            ->where('id', $post['id'])
            ->update();
            $text_log = 'PROJECT UPDATE PROJECT | ' 
            . ' id: ' 
            .$post['id']
            .' | project_name: '
            .$post['project_name'] 
            . ' | project_description: '
            . $post['project_description'] 
            . ' | project_client: '
            . $post['project_client'] 
            . ' | Date Create: '
            . date('Y-m-d H:i:s');
            $this->write_log($text_log);
            session()->setFlashdata('msg', 'Team Berhasil Diubah');

            return redirect()->to('project/project_edit/'. $post['id']);
        }
    }
    public function project_add_amount()
    {
        $post = $this->request->getPost();
        $this->AmountModel = new AmountModel;
        $this->BudgetModel = new BudgetModel;
        $budget = $this->BudgetModel->where('id', $post['budget_id'])->first();
        if(!empty($budget))
        {
            $this->AmountModel
            ->set('amount', $post['amount'])
            ->set('amount_name', $post['amount_name'])
            ->set('budget_id', $post['budget_id'])
            ->insert();

            $budget_total = (int) $budget['total_amount'] + $post['amount'];
            $this->BudgetModel
            ->set('total_amount' ,  $budget_total)
            ->where('id', $post['budget_id'])
            ->update();

            $text_log = 'PROJECT ADD AMOUNT | ' 
            . ' budget_id: ' 
            .$post['budget_id']
            .' | amount: '
            .$post['amount'] 
            . ' | amount_name: '
            . $post['amount_name'] 
            . ' | budget_id: '
            . $post['budget_id'] 
            . ' | Date Create: '
            . date('Y-m-d H:i:s');
            $this->write_log($text_log);
            session()->setFlashdata('msg', 'Amount Berhasil Ditambah');

            return redirect()->to('project/project_edit/'. $budget['project_id']);
        }

    }
    public function update_team()
    {
        $post = $this->request->getPost();

        $this->TeamModel = new TeamModel;

        $this->ProjectModel = new ProjectModel;

        if($this->ProjectModel->where('id', $post['project_id'])->where('status', 'ACTIVE')->first() > 0)
        {
            if(!empty($post['project_leader']))
            {
                $this->TeamModel
                ->set('auth_id', $post['project_leader'])
                ->where('auth_id', $post['id_project_leader'])
                ->where('project_id', $post['project_id'])
                ->update();
            }
            $this->TeamModel
            ->set('auth_id', $post['designer'])
            ->where('auth_id', $post['id_designer'])
            ->where('project_id', $post['project_id'])
            ->update();
            $this->TeamModel
            ->set('auth_id', $post['developer'])
            ->where('auth_id', $post['id_developer'])
            ->where('project_id', $post['project_id'])
            ->update();
            $this->TeamModel
            ->set('auth_id', $post['tester'])
            ->where('auth_id', $post['id_tester'])
            ->where('project_id', $post['project_id'])
            ->update();

            $text_log = 'PROJECT UPDATE TEAM | ' 
            . ' project_id: ' 
            .$post['project_id']
            .' | designer: '
            .$post['designer'] 
            . ' | developer: '
            . $post['developer'] 
            . ' | tester: '
            . $post['tester'] 
            . ' | Date Create: '
            . date('Y-m-d H:i:s');
            $this->write_log($text_log);
            session()->setFlashdata('msg', 'Team Berhasil Diubah');
            return redirect()->to('project/project_edit/'. $post['project_id']);
        }
    }
    // retrive form insert project
    public function project_save()
    {
        // inisialize $_POST
        $post = $this->request->getPost();

        // inisialize project model
        $this->ProjectModel = new ProjectModel;

        // inisialize budget model
        $this->BudgetModel = new BudgetModel;

        // inisialize team model
        $this->TeamModel = new TeamModel;
        
        // insert in project table
        $this->ProjectModel
        ->set('project_name', $post['project_name'])
        ->set('project_description', $post['project_description'])
        ->set('project_client', $post['project_client'])
        ->set('created_by', $_SESSION['name'])
        ->insert();

        // inisialize project id
        $project_id = $this->ProjectModel->getInsertID();

        // insert in budget table
        $this->BudgetModel
        ->set('estimated_budget', $post['estimated_budget'])
        ->set('total_amount', $post['total_amount'])
        ->set('estimated_duration', $post['estimated_duration'])
        ->set('project_id', $project_id)
        ->insert();

        // check jf $_POST[project_leader] is empty/NULL
        if(empty($post['project_leader']))
        {
            $post['project_leader'] = $_SESSION['id'];
        }
        // insert in team table
        $this->TeamModel
        ->set('project_id', $project_id)
        ->set('auth_id', $post['project_leader'])
        ->insert();
        $project_leader_notification = [
            'auth_id'                   => $post['project_leader'],
            'project_id'                => $project_id,
            'task_id'                   => NULL,
            'redirect'                  => 'project/project_detail/' . $project_id,
            'notification_body'         => $_SESSION['name'] . ' Membuat Proyek ' . $post['project_name'],

        ];
        // insert notification table with specific id and project
        $this->write_notification($project_leader_notification);

        // insert in team table
        $this->TeamModel
        ->set('project_id', $project_id)
        ->set('auth_id', $post['designer'])
        ->insert();
        $designer_notification = [
            'auth_id'                   => $post['designer'],
            'project_id'                => $project_id,
            'task_id'                   => NULL,
            'redirect'                  => 'project/project_detail/' . $project_id,
            'notification_body'         => $_SESSION['name'] . ' Membuat Proyek ' . $post['project_name'],

        ];
        // insert notification table with specific id and project
        $this->write_notification($designer_notification);

        // insert in team table
        $this->TeamModel
        ->set('project_id', $project_id)
        ->set('auth_id', $post['developer'])
        ->insert();
        $developer_notification = [
            'auth_id'                   => $post['developer'],
            'project_id'                => $project_id,
            'task_id'                   => NULL,
            'redirect'                  => 'project/project_detail/' . $project_id,
            'notification_body'         => $_SESSION['name'] . ' Membuat Proyek ' . $post['project_name'],

        ];
        // insert notification table with specific id and project
        $this->write_notification($developer_notification);

        // insert in team table
        $this->TeamModel
        ->set('project_id', $project_id)
        ->set('auth_id', $post['tester'])
        ->insert();
        $tester_notification = [
            'auth_id'                   =>  $post['tester'],
            'project_id'                => $project_id,
            'task_id'                   => NULL,
            'redirect'                  => 'project/project_detail/' . $project_id,
            'notification_body'         => $_SESSION['name'] . ' Membuat Proyek ' . $post['project_name'],
        ];
        // insert notification table with specific id and project
        $this->write_notification($tester_notification);

        $text_log = 'PROJECT SAVE | ' 
            . ' project_id: ' 
            .$project_id
            .' | project_name: '
            .$post['project_name'] 
            . ' | project_description: '
            . $post['project_description'] 
            . ' | project_client: '
            . $post['project_client']
            .' | estimated budget: '
            .$post['estimated_budget'] 
            . ' | total_amount: '
            . $post['total_amount']  
            . ' | estimated_duration: '
            . $post['estimated_duration']  
            .' | project_leader: '
            .$post['project_leader'] 
            .' | designer: '
            .$post['designer'] 
            . ' | developer: '
            . $post['developer'] 
            . ' | tester: '
            . $post['tester'] 
            . ' | Date Create: '
            . date('Y-m-d H:i:s');
            $this->write_log($text_log);
        session()->setFlashdata('msg','Project Berhasil Dibuat');
        return redirect()->to('project');

    }
    public function project_detail($id)
    {
        $this->read_notification(
            [
                'auth_id' => $_SESSION['id'],  
                'project_id' => $id, 
                'task_id' => NULL, 
            ]);

        // inisialize auth model
        $this->AuthModel = new AuthModel;

        // inisialize project model
        $this->ProjectModel = new ProjectModel;

        // initialize task model
        $this->TaskModel = new TaskModel;

        // initialize File Model
        $this->FileModel = new FileModel;
        $data['file'] = $this->FileModel
        ->where('project_id', $id)
        ->findAll();

        if($_SESSION['role'] != 1)
        {
            if($this->in_project($_SESSION['id'], $id) == false)
            {
                session()->setFlashdata('error','Akses Ditolak');
                return redirect()->back();
            }
        }
        // list team where project id
        $data['list_team'] = $this->AuthModel
        ->select('auth.id, auth.name, role.name as role_name')
        ->join('team', 'team.auth_id = auth.id')
        ->join('role', 'role.id = auth.role')
        ->where('auth.status', 'ACTIVE')
        ->where('team.project_id', $id)
        ->orderBy('team.id', 'DESC')
        ->findAll();
        // print_r($data['list_team']);

        // show table project join table budget
        $data['list'] = $this->ProjectModel
        ->select('*, project.status as project_status')
        ->join('client', 'client.id = project.project_client')
        ->join('budget', 'project.id = budget.project_id')
        ->where('project.id', $id)
        ->first();

        // show table task
        $data['tasks'] = $this->TaskModel
        ->where('project_id', $id)
        ->orderBy('id', 'DESC')
        ->findAll();
        // $data['file'] = $this->File

        $data['notification'] = $this->list_notification($_SESSION['id']);

        return view('projects/detail', $data);
    }
    public function task_save()
    {
        $post = $this->request->getPost();

        $this->TaskModel = new TaskModel;
        $this->TeamModel = new TeamModel;
        
        // insert task
        $this->TaskModel
        ->set('project_id', $post['project_id'])
        ->set('task_name', $post['task_name'])
        ->set('task_description', $post['task_description'])
        ->set('created_by', $_SESSION['name'])
        ->insert();

        $task_id = $this->TaskModel->getInsertID();
        
        $teams = $this->TeamModel
        ->select('auth_id')
        ->where('project_id', $post['project_id'])
        ->findAll();

        foreach($teams as $team)
        {
            $notification = [
                'auth_id'                   => $team['auth_id'],
                'project_id'                => $post['project_id'],
                'task_id'                   => $task_id,
                'redirect'                  => 'project/project_task/' . $task_id,
                'notification_body'         => $_SESSION['name'] . ' Membuat Task ' . $post['task_name'],
            ];
            // insert notification table with specific id and project
            $this->write_notification($notification);
        }
        $text_log = 'PROJECT TASK SAVE | ' 
            . ' project_id: ' 
            .$post['project_id']
            .' | task_name: '
            .$post['task_name'] 
            . ' | task_description: '
            . $post['task_description'] 
            . ' | created_by: '
            . $_SESSION['name']
            . ' | Date Create: '
            . date('Y-m-d H:i:s');
        $this->write_log($text_log);
        session()->setFlashdata('msg','Task Berhasil Dibuat');
        
        return redirect()->to('project/project_detail/' . $post['project_id']);
    }
    public function task_update()
    {
        $post = $this->request->getPost();
        $this->TaskModel = new TaskModel;

        $this->TaskModel
        ->set('task_name',$post['task_name'])
        ->set('task_description', $post['task_description'])
        ->set('updated_at', date('Y-m-d H:i:s'))
        ->where('id', $post['id'])->update();

        $teams = $this->TaskModel
        ->join('team', 'task.project_id = team.project_id')
        ->where('team.project_id', $post['project_id'])->findAll();
        foreach($teams as $team)
        {
            $notification = [
                'auth_id'                   => $team['auth_id'],
                'project_id'                => $post['project_id'],
                'task_id'                   => $post['id'],
                'redirect'                  => 'project/project_detail/' . $post['project_id'],
                'notification_body'         => $_SESSION['name'] . ' Update Task ' . $post['task_name'], // bikin kondisi kalo FINISHED notification bodynya beda
            ];
            // insert notification table with specific id and project
            $this->write_notification($notification);
        }
        $text_log = 'TASK UPDATE  | '
            . ' auth_id: '
            . $_SESSION['id']
            . ' project_id: '
            . $post['project_id']
            .' | task_name: '
            .$post['task_name']
            . ' | task_description: '
            . $post['task_description']
            . ' | Date Create: '
            . date('Y-m-d H:i:s');
        $this->write_log($text_log);
        session()->setFlashdata('msg','Task Berhasil di Update');
        return redirect()->to('project/project_detail/' . $post['project_id']);
    }
    public function task_delete(int $task_id)
    {
        $this->TaskModel = new TaskModel;
        $this->TaskModel
        ->set('status','DELETED')
        ->set('deleted_at', date('Y-m-d H:i:s'))
        ->set('deleted_by', $_SESSION['name'])
        ->where('id', $task_id)->update();

        $project = $this->TaskModel->select('project_id, task_name')->where('id', $task_id)->first();
        $teams = $this->TaskModel
        ->join('team', 'task.project_id = team.project_id')
        ->where('team.project_id', $project['project_id'])->findAll();
        foreach($teams as $team)
        {
            $notification = [
                'auth_id'                   => $team['auth_id'],
                'project_id'                => $project['project_id'],
                'task_id'                   => $task_id,
                'redirect'                  => 'project/project_detail/' . $project['project_id'],
                'notification_body'         => $_SESSION['name'] . ' DELETE Task ' . $project['task_name'], // bikin kondisi kalo FINISHED notification bodynya beda
            ];
            // insert notification table with specific id and project
            $this->write_notification($notification);
        }
        $text_log = 'TASK DELETED  | '
            . ' auth_id: '
            . $_SESSION['id']
            . ' project_id: '
            . $project['project_id']
            .' | task_name: '
            .$project['task_name']
            . ' | Date Create: '
            . date('Y-m-d H:i:s');
        $this->write_log($text_log);
        session()->setFlashdata('msg','Task Berhasil di Delete');
        return redirect()->to('project/project_detail/' . $project['project_id']);
    }
    public function project_task(int $id)
    {
        // initialize Task Model
        $this->TaskModel = new TaskModel;
        $this->TimelineModel = new Timelinemodel;


        // show data in table task where task_id = $id
        $data['task'] = $this->TaskModel
        ->where('id', $id)
        ->first();
        if($_SESSION['role'] != 1)
        {
            if($this->in_project($_SESSION['id'], $data['task']['project_id']) == false)
            {
                session()->setFlashdata('error','Akses Ditolak');
                return redirect()->back();
            }
        }
        // $this->in_project($_SESSION['id'], $data['task']['project_id']);

        $this->read_notification(
            [
                'auth_id' => $_SESSION['id'],  
                'project_id' => $data['task']['project_id'], 
                'task_id' => $id, 
            ]);

        // timeline check
        $timeline = $this->TimelineModel
        ->select('position, id, status')
        ->where('task_id', $id)
        ->orderBy('id', 'DESC')
        ->first();

        if(empty($timeline))
        {
            $data['position'] = 3;
        }else{
            if($timeline['status'] == 'REJECTED')
            {
                $data['position'] = 3;
            }else{
                $data['position'] =(int) $timeline['position'] + 1;
            }
        }
        
        $data['list'] = $this->TimelineModel
        ->where('task_id', $id)
        ->findAll();

        $data['notification'] = $this->list_notification($_SESSION['id']);

        return view('projects/task', $data);
    }
    public function project_timeline_save()
    {
        $post = $this->request->getPost();
        $this->TeamModel = new TeamModel;
        $this->TimelineModel = new Timelinemodel;
        $this->TaskModel = new TaskModel;

        $project = $this->TaskModel
        ->select('project_id')
        ->where('id', $post['task_id'])
        ->first();
        $project_id = $project['project_id'];
        
        $timeline = $this->TimelineModel
        ->select('position, id, status')
        ->where('task_id', $post['task_id'])
        ->orderBy('id', 'DESC')
        ->first();

        if(empty($timeline))
        {
            $position = 3;
        }else{
            if($timeline['status'] == 'REJECTED')
            {
                $position = 3;
            }else{
                $position =(int) $timeline['position'] + 1;
            }
        }
        if($position == 5) #nanti tambah kondisi jika rejected false
        {
            $this->TaskModel
            ->set('status', 'FINISHED')
            ->set('finished_at', date('Y-m-d H:i:s'))
            ->where('id', $post['task_id'])
            ->update();
        }
        $dataBerkas = $this->request->getFile('attachment');
        if($dataBerkas->getSize() > 0)
        {
            if (!$this->validate([
                'attachment' => [
                    'rules' => 'mime_in[attachment,application/x-download,image/jpg,image/jpeg,image/gif,image/png,application/x-pdf,application/pdf]|max_size[attachment,8048]',
                    'errors' => [
                        'mime_in' => 'File Extention Harus Berupa jpg,jpeg,gif,png',
                        'max_size' => 'Ukuran File Maksimal 8 MB'
                    ]
     
                ]
            ])) {
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }
     
            $fileName = 'TASK ' . $post['task_id'] . ' - '. $dataBerkas->getClientName();
           
            $dataBerkas->move(ROOTPATH . 'public\upload\timeline', $fileName);
        }

        $this->TimelineModel
        ->set('timeline_header', $post['timeline_header'])
        ->set('timeline_body', $post['timeline_body'])
        ->set('attachment', $dataBerkas->getSize() > 0 ? $fileName : NULL)
        ->set('link',  empty($post['link']) ? NULL : $post['link'])
        ->set('task_id', $post['task_id'])
        ->set('position', $position)
        ->set('user_id', $_SESSION['id'])
        ->insert();

        $teams = $this->TeamModel
        ->select('auth_id')
        ->where('project_id', $project_id)
        ->findAll();

        foreach($teams as $team)
        {
            $notification = [
                'auth_id'                   => $team['auth_id'],
                'project_id'                => $project_id,
                'task_id'                   => $post['task_id'],
                'redirect'                  => 'project/project_task/' . $post['task_id'],
                'notification_body'         => $_SESSION['name'] . ' Membuat Task ' . $post['timeline_header'], // bikin kondisi kalo FINISHED notification bodynya beda
            ];
            // insert notification table with specific id and project
            $this->write_notification($notification);
        }
        $text_log = 'PROJECT TIMELINE SAVE | ' 
            . ' project_id: ' 
            .$project_id
            .' | timeline_header: '
            .$post['timeline_header'] 
            . ' | timeline_body: '
            . $post['timeline_body'] 
            . ' | link: '
            . $post['link']
            . ' | attachment: '
            . $dataBerkas
            . ' | task_id: '
            . $post['task_id']
            . ' | position: '
            . $position
            . ' | Date Create: '
            . date('Y-m-d H:i:s');
        $this->write_log($text_log);
        session()->setFlashdata('msg','Aktifitas Berhasil Diupdate');
        
        return redirect()->to('project/project_task/' . $post['task_id']);
    }
    public function list_budget()
    {
        helper('form');
        $ProjectModel = new ProjectModel;

        $data['position'] = 'project/list_budget'; //definisikan posisi url (setelah base_url)
        $data['page']=(int)(($this->request->getVar('page')!==null)?$this->request->getVar('page'):1)-1; // define page $_GET
        $data['perPage'] =  10; // limit data per page
        if($_SESSION['role'] == 1)
        {
            $data['list'] = $ProjectModel
            ->select('project.id, project.project_name, project.project_description, project.project_client, project.status, client.company AS client_name')
            ->distinct()
            ->join('team', 'team.project_id = project.id')
            ->join('client', 'project.project_client = client.id')
            ->paginate($data['perPage'], 'default');

            $data['count'] =  $ProjectModel
            ->select('project.id, project_name, project_description, project_client, status')
            ->distinct()
            ->join('team', 'team.project_id = project.id')
            ->countAllResults();
        }else{
            $data['list'] = $ProjectModel
            ->select('project.id, project.project_name, project.project_description, project.project_client, project.status, client.company AS client_name')
            ->join('team', 'team.project_id = project.id')
            ->join('client', 'project.project_client = client.id')
            ->where('team.auth_id', $_SESSION['id'])
            ->paginate($data['perPage'], 'default');

            $data['count'] =  $ProjectModel
            ->select('project.id, project_name, project_description, project_client, status')
            ->join('team', 'team.project_id = project.id')
            ->where('team.auth_id', $_SESSION['id'])->countAllResults();
        }
        
        $data['pager'] = $ProjectModel->pager; // running pagination

        $data['notification'] = $this->list_notification($_SESSION['id']);
        return view('projects/budget', $data);
        
    }
    public function budget_detail(int $project_id)
    {
        $AmountModel = new AmountModel();

        if($_SESSION['role'] != 1)
        {
            if($this->in_project($_SESSION['id'], $project_id) == false)
            {
                session()->setFlashdata('error','Akses Ditolak');
                return redirect()->back();
            }
        }
        $data['position'] = 'project/budget_detail'; //definisikan posisi url (setelah base_url)
        $data['page']=(int)(($this->request->getVar('page')!==null)?$this->request->getVar('page'):1)-1; // define page $_GET
        $data['perPage'] =  10; // limit data per page
        $data['list'] = $AmountModel
        ->select('amount.amount_name, amount.amount')
        ->join('budget', 'budget.id = amount.budget_id')
        ->join('project', 'project.id = budget.project_id')
        ->where('budget.project_id', $project_id)
        ->findAll();
        $data['count'] = $AmountModel
        ->join('budget', 'budget.id = amount.budget_id')
        ->join('project', 'project.id = budget.project_id')
        ->where('budget.project_id', $project_id)
        ->countAllResults();
        $data['pager'] = $AmountModel->pager; // running pagination

        $data['notification'] = $this->list_notification($_SESSION['id']);
        return view('projects/budget_detail', $data);
        
            
    }
}