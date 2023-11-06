<?php

namespace App\Controllers;

use App\Controllers\BaseController;
// use TCPDF;
use App\Libraries\MY_TCPDF AS TCPDF;

use App\Models\ProjectModel;
use App\Models\TeamModel;
use App\Models\TaskModel;
use App\Models\BudgetModel;

class Report extends BaseController
{
    public function index()
    {
        $ProjectModel = new ProjectModel;

        $data['position'] = 'user/register'; //definisikan posisi url (setelah base_url)
        $data['page']=(int)(($this->request->getVar('page')!==null)?$this->request->getVar('page'):1)-1; // define page $_GET
        $data['perPage'] =  10; // limit data per page
        if($_SESSION['role'] == 1)
        {
            $data['list'] = $ProjectModel
            ->select('project.project_name, project.project_description, client.company, project.id')
            ->join('client', 'client.id = project.project_client')
            ->paginate($data['perPage'], 'default');

            $data['count'] = $ProjectModel
            ->select('project.project_name, project.project_description, project.project_client, project.id')
    
            ->countAllResults();
        }else{
            $data['list'] = $ProjectModel
            ->select('project.project_name, project.project_description, client.company, project.id')
            ->join('client', 'client.id = project.project_client')
            ->distinct()
            ->join('team', 'team.project_id = project.id')
            ->join('auth', 'team.auth_id = auth.id')
            ->join('task', 'task.project_id = project.id')
            ->whereIn('project.status', ['ACTIVE', 'FINISHED'])
            ->where('auth.id', $_SESSION['id'])
            // ->where('task.status', 'FINISHED')
            ->paginate($data['perPage'], 'default');

            $data['count'] = $ProjectModel
            ->join('team', 'team.project_id = project.id')
            ->join('auth', 'team.auth_id = auth.id')
            ->join('task', 'task.project_id = project.id')
            ->whereIn('project.status', ['ACTIVE', 'FINISHED'])
            ->where('auth.id', $_SESSION['id'])
            ->countAllResults();

        }
        $data['pager'] = $ProjectModel->pager; // running pagination
        
        $data['notification'] = $this->list_notification($_SESSION['id']);

        return view('report/index', $data);
    }
    public function generate_pdf(int $project_id)
    {
        // create new PDF document

        $this->ProjectModel = new ProjectModel;
        $this->TeamModel = new TeamModel;
        $this->TaskModel = new TaskModel;
        $this->BudgetModel = new BudgetModel;


        $text_log = 'REPORT GENERATE PDF | ' 
            . ' project_id: ' 
            . $project_id
            . ' | Date Create: '
            . date('Y-m-d H:i:s');
        $this->write_log($text_log);

        $data['project'] = $this->ProjectModel
        // ->select('project.project_name')
        ->join('client', 'project.project_client = client.id')
        ->where('project.id', $project_id)
        ->whereIn('project.status', ['ACTIVE', 'FINISHED'])
        ->first();

        $data['project_leader'] = $this->TeamModel
        ->select('auth.name')
        ->join('auth', 'auth.id = team.auth_id')
        ->where('team.project_id', $project_id)
        ->where('auth.role', 2)
        ->first();

        $data['task'] = $this->TaskModel
        ->select('task_name, created_at, finished_at')
        ->where('project_id', $project_id)
        ->where('status', 'FINISHED')
        ->findAll();

        $data['budget'] = $this->BudgetModel
        ->select('amount.amount_name, amount.amount')
        ->join('amount', 'amount.budget_id = budget.id')
        ->where('budget.project_id', $project_id)
        ->findAll();

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('PT ABC');
        $pdf->SetTitle('REPORT PT ABC');
        $pdf->SetSubject('REPORT PROJECT');
        $pdf->SetKeywords('PDF, PT ABC');

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
        $pdf->setFooterData(array(0,64,0), array(0,64,128));

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 14, '', true);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

       //view mengarah ke invoice.php
        $html = view('report', $data);

        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        // ---------------------------------------------------------
        $this->response->setContentType('application/pdf');
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('Report '.$data['project']['company'].'.pdf', 'I');
    }
}
