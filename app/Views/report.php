<?php helper('currency'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>REPORT <?= $project['company']; ?></title>

  <!-- Google Font: Source Sans Pro -->
  <!-- Font Awesome -->
  <style>
    p, span, table { font-size: 12px}
    table { width: 100%; border: 1px solid #dee2e6; }
    table#tb-item tr th, table#tb-item tr td {
        border:1px solid #000
    }
</style>
</head>
<body>
    <!-- <br /> -->
<!-- <p style="font-size:18pt;text-align:right">INVOICE</p> -->
<!-- <span>Kepada Yth.</span> -->
<br/>
<table cellpadding="0" >
    <tr>
        <th width="20%">Project Name</th>
        <th width="40%">: <strong><?= $project['project_name']; ?></strong></th>
    </tr>
    <tr>
        <th width="20%">Project Client</th>
        <th width="40%">: <strong><?= $project['company']; ?></strong></th>
    </tr>
    <tr>
        <th width="20%">Project Leader</th>
        <th width="40%">: <strong><?= $project_leader['name']; ?></strong></th>
    </tr>
</table>
<br />
<h3>Laporan Maintance Task</h3>
<p>Berikut adalah hasil Laporan Maintance Tim UKUR-MenPro terkait Task Proyek <b><?= $project['project_name']; ?></b> adalah sebagai berikut:</p>
<br />
<table id="tb-item" cellpadding="4" >
    <tr style="background-color:#a9a9a9">
        <th width="50%" style="height: 2px"><strong>Task Name</strong></th>
        <th width="15%" style="height: 20px"><strong>Task Start</strong></th>
        <th width="15%" style="height: 20px"><strong>Task End</strong></th>
        <th width="20%" style="height: 20px"><strong>Duration</strong></th>
    </tr>
    <?php foreach($task as $key => $value) {?>
    <tr>
        <td style="height: 20px"><?= $value['task_name']; ?></td>
        <td style="height: 20px"><?= substr($value['created_at'], 0, 10); ?></td>
        <td style="height: 20px"><?= substr($value['finished_at'], 0, 10); ?></td>
        <td style="height: 20px;text-align:center"><?php
                            $start  = new DateTime($value['created_at']);
                            $end    = new DateTime($value['finished_at']);
                            $dates  = date_diff($start, $end);
                            $hours = $dates->h;
                            $hours = $hours + ($dates->days*24);
                            echo $dates->d; ?> Day ( <?= $hours; ?> Hour )
        </td>
    </tr>
    <?php } ?>
</table>
<p>Demikian laporan ini kami sampaikan, mohon diterima dengan baik, dan atas perhatian serta kerjasamanya, kami ucapkan banyak terimakasih.</p>
<br />
<br />
<table cellpadding="4" >
    <tr>
        <td width="50%" style="height: 20px;text-align:center">
            <p>&nbsp;</p>
        </td>
        <td width="50%" style="height: 20px;text-align:center">
            <p>Jakarta, <?= date('d M Y'); ?></p>
            <p>Hormat kami,</p>
            <p></p>
            <p></p>
            <p></p>
            <p>PT UKUR Kreasi Nusantara</p>
        </td>
    </tr>
</table>

<br pagebreak="true" />

<table cellpadding="0" >
    <tr>
        <th width="20%">Project Name</th>
        <th width="40%">: <strong><?= $project['project_name']; ?></strong></th>
    </tr>
    <tr>
        <th width="20%">Project Client</th>
        <th width="40%">: <strong><?= $project['company']; ?></strong></th>
    </tr>
    <tr>
        <th width="20%">Project Leader</th>
        <th width="40%">: <strong><?= $project_leader['name']; ?></strong></th>
    </tr>
</table>
<br />
<h3>Laporan Maintance Budget</h3>
<p>Berikut adalah hasil Laporan Maintance Tim UKUR-MenPro terkait Budget Proyek <b><?= $project['project_name']; ?></b> adalah sebagai berikut:</p>
<br />
<table id="tb-item" cellpadding="4" >
    <tr style="background-color:#a9a9a9">
        <th width="70%" style="height: 2px"><strong>Pengeluaran</strong></th>
        <th width="30%" style="height: 20px"><strong>Total</strong></th>
    </tr>
    <?php   $grand_total = 0; 
            foreach($budget as $key => $value) {
            $grand_total+= $value['amount'];?>
    <tr>
        <td style="height: 20px"><?= $value['amount_name']; ?></td>
        <td style="height: 20px;text-align:right"><?= rupiah($value['amount']); ?></td>
    </tr>
    <?php } ?>
    <tr style="border:1px solid #000">
        <td colspan="1" style="height: 20px"><strong>Grand Total</strong></td>
        <td style="height: 20px;text-align:right"><strong><?= rupiah($grand_total); ?></strong></td>
    </tr>
</table>
<p>Demikian laporan ini kami sampaikan, mohon diterima dengan baik, dan atas perhatian serta kerjasamanya, kami ucapkan banyak terimakasih.</p>
<br />
<br />
<table cellpadding="4" >
    <tr>
        <td width="50%" style="height: 20px;text-align:center">
            <p>&nbsp;</p>
        </td>
        <td width="50%" style="height: 20px;text-align:center">
            <p>Jakarta, <?= date('d M Y'); ?></p>
            <p>Hormat kami,</p>
            <p></p>
            <p></p>
            <p></p>
            <p>PT UKUR Kreasi Nusantara</p>
        </td>
    </tr>
</table>

</body>
</html>