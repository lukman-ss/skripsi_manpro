<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\NotificationModel;
use App\Models\ProjectModel;
use App\Models\TeamModel;
use App\Models\LogModel;
use App\Models\AuthModel;
/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        $this->session = \Config\Services::session();

        $this->validation = \Config\Services::validation();
    }

    public function write_notification(array $data)
    {
        $this->NotificationModel = new NotificationModel;

        $this->NotificationModel
        ->set('auth_id', $data['auth_id'])
        ->set('project_id', $data['project_id'])
        ->set('task_id', $data['task_id'])
        ->set('redirect', $data['redirect'])
        ->set('notification_body', $data['notification_body'])
        ->insert();
    }

    public function read_notification(array $data)
    {
        $this->NotificationModel = new NotificationModel;

        $num_rows = $this->NotificationModel
        ->where('auth_id', $data['auth_id'])
        ->where('project_id', $data['project_id'])
        ->where('task_id', $data['task_id'])
        ->countAllResults();

        if($num_rows > 0)
        {
            $this->NotificationModel
            ->set('status', 'READ')
            ->where('auth_id', $data['auth_id'])
            ->where('project_id', $data['project_id'])
            ->where('task_id', $data['task_id'])
            ->update();
        }
    }
    
    public function list_notification(int $user_id)
    {
        $this->NotificationModel = new NotificationModel;

        $data['notifications'] = $this->NotificationModel
        ->where('status', 'UNREAD')
        ->where('auth_id', $user_id)
        ->findAll();

        $data['notifications_num_rows'] = $this->NotificationModel
        ->where('status', 'UNREAD')
        ->where('auth_id', $user_id)
        ->countAllResults();
        
        return $data;
    }

    public function in_project(int $user_id, int $project_id)
    {
        $this->TeamModel = new TeamModel;

        $list = $this->TeamModel
        ->select('auth_id')
        ->where('project_id', $project_id)
        ->findAll();
        $column = array_column($list, 'auth_id','auth_id');

        if(!in_array($user_id, $column))
        {
            session()->setFlashdata('error', 'Akses Ditolak');
            return false;
        }
        return true;
    }
    public function write_log(string $text)
    {
        $this->LogModel = new LogModel;

        $this->LogModel
        ->set('user_id', $_SESSION['id'])
        ->set('log_text', $text)
        ->insert();
    }
    public function isSuperUser(int $id)
    {
        $this->AuthModel = new AuthModel;
        return $this->AuthModel->select('id')->where('id',$id)->where('role', 1)->where('status', 'ACTIVE')->findAll();
    }
}
