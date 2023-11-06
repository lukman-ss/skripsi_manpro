<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\NotificationModel;

class Notification extends BaseController
{
    public function index()
    {
        $this->NotificationModel = new NotificationModel;

        helper('form');

        $data['position'] = 'notification'; //definisikan posisi url (setelah base_url)
        $data['list'] = $this->NotificationModel
        ->distinct()
        ->where('auth_id', $_SESSION['id'])
        ->orderBy('id', 'DESC')
        ->findAll(50);

        $data['notification'] = $this->list_notification($_SESSION['id']);
        return view('notification/index', $data);
    }
}
