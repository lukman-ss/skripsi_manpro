<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\ProjectModel;

use App\Models\TaskModel;

use App\Models\TimelineModel;

use App\Models\TeamModel;

use App\Models\AuthModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $this->ProjectModel = new ProjectModel;

        $this->TaskModel = new TaskModel;

        $this->TimelineModel = new TimelineModel;
        
        $this->AuthModel = new AuthModel;

        $data['users'] = $this->AuthModel
        ->select('role.name, COUNT(role.name) as count')
        ->join('role', 'auth.role = role.id')
        ->where('auth.status', 'ACTIVE')
        ->groupBy('role.name')
        ->findAll();
        if($_SESSION['role'] == 1)
        {
            $data['project'] = $this->ProjectModel
          
            ->countAllResults();
            $data['project_progress'] = $this->ProjectModel
            ->where('project.status', 'ACTIVE')
            ->countAllResults();
            $data['project_finished'] = $this->ProjectModel
            ->where('project.status', 'FINISHED')
            ->countAllResults();
            $data['task_onprogress'] = $this->TaskModel
            ->where('task.status','ACTIVE')
            ->countAllResults();
            $data['task_finish'] = $this->TaskModel
            ->where('task.status','FINISHED')
            ->countAllResults();
            $data['task_all'] = $this->TaskModel
            ->join('team', 'team.project_id = task.project_id')
            ->countAllResults();
        }else{
            $data['project'] = $this->ProjectModel
            ->join('team', 'team.project_id = project.id')
            ->where('team.auth_id', $_SESSION['id'])
            ->countAllResults();
            $data['project_progress'] = $this->ProjectModel
            ->join('team', 'team.project_id = project.id')
            ->where('project.status', 'ACTIVE')
            ->where('team.auth_id', $_SESSION['id'])
            ->countAllResults();
            $data['project_finished'] = $this->ProjectModel
            ->join('team', 'team.project_id = project.id')
            ->where('project.status', 'FINISHED')
            ->where('team.auth_id', $_SESSION['id'])
            ->countAllResults();
            $data['task_onprogress'] = $this->TaskModel
            ->join('team', 'team.project_id = task.project_id')
            ->where('task.status','ACTIVE')
            ->where('team.auth_id', $_SESSION['id'])
            ->countAllResults();
            $data['task_finish'] = $this->TaskModel
            ->join('team', 'team.project_id = task.project_id')
            ->where('task.status','FINISHED')
            ->where('team.auth_id', $_SESSION['id'])
            ->countAllResults();
            $data['task_all'] = $this->TaskModel
            ->join('team', 'team.project_id = task.project_id')
            ->where('team.auth_id', $_SESSION['id'])
            ->countAllResults();
        }

        
        $data['notification'] = $this->list_notification($_SESSION['id']);
        return view('dashboards/index', $data);
    }
}
