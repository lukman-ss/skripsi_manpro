<?= $this->extend("layout/main_layout") ?>
<?= $this->section("extra_css") ?>
<link rel="stylesheet" href="<?= base_url(); ?>/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<?= $this->endSection() ?>
<?= $this->section("content") ?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Budget</h1>
      </div>
      <?php if(session()->getFlashdata('msg')):?>
      <div class="alert alert-success"><?= session()->getFlashdata('msg') ?></div>
      <?php endif;?>
      <?php if(session()->getFlashdata('error')):?>
      <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
      <?php endif;?>
      <?php if(isset($validation)): ?>
      <div class="alert alert-danger"><?php
          echo $validation->listErrors(); ?></div>
      <?php endif;?>
    </div>
  </div>
  <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
 
  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Budget Detail</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
          <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
          <i class="fas fa-times"></i>
        </button>
      </div>
    </div>
    <div class="card-body p-0">
      <table class="table table-striped projects">
        <thead>
          <tr>
            <th style="width: 20%"> Barang </th>
            <th class="text-right"> Pengeluaran </th>
          </tr>
        </thead>
        <tbody>
          <?php
            if (!empty($list)) {
                $total = 0;
                foreach ($list as $lists) { 
                    $total += $lists['amount'];
                    ?>
          <tr>
            <td><?= $lists['amount_name']; ?></td>
            <td class="text-right"><?= $lists['amount']; ?></td>
           
          </tr>
          <?php }  ?> 
          <tr>
            <td>total</td>
            <td class="text-right"><?= $total; ?></td>
          </tr>
          <?php } else{?>
          <tr>
            <td colspan="4">
              <h4 class="text-center">Tidak Ada Data</h4>
            </td>
          </tr>
          <?php }   ?>
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      <div class="row">
        <div class="col-sm-12 col-md-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Tampil
            <?= $page * $perPage + 1; ?> sampai
            <?php if($count < (($page * $perPage) + $perPage)) {echo $count;}else{echo ($page * $perPage) + $perPage ;}  ?>
            data dari <?= $count; ?> banyak data</div>
        </div>
        <div class="col-sm-12 col-md-7">
          <?php if ($pager): ?>
          <?php $path_pagination = "".$position; ?>
          <?php $pager->setPath($path_pagination); ?>
          <?= $pager->links("default", "front_full") ?>
          <?php endif; ?>

        </div>
      </div>
    </div>
  </div>
  <!-- /.card -->
</section>

<!-- /.content --> <?= $this->endSection() ?>