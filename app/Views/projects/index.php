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
        <h1>Projects</h1>
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
  <!-- Button trigger modal -->
  <?php if($_SESSION['role'] == 1 && $_SESSION['role'] == 2) { ?>
  <button type="button" data-bs-toggle="modal" data-bs-target="#add_project" class='btn btn-sm btn-primary'>Add
    Projects</button>
  <br />
  <br />
  <!-- Modal -->
  <div class="modal fade" id="add_project" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Project</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="<?= base_url(); ?>/project/project_save" method="post">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">General</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body" style="display: block;">
                <div class="form-group">
                  <label for="inputName">Project Name</label>
                  <input type="text" id="inputName" class="form-control" required name="project_name">
                </div>
                <div class="form-group">
                  <label for="inputDescription">Project Description</label>
                  <textarea id="inputDescription" class="form-control" rows="4" required
                    name="project_description"></textarea>
                </div>

                <div class="form-group">
                  <label for="inputClientCompany">Client Company</label>
                  <?= $client_dropdown; ?>
                </div>

              </div>
              <!-- /.card-body -->
            </div>
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Budget</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body" style="display: block;">
                <div class="form-group">
                  <label for="inputEstimatedBudget">Estimated budget</label>
                  <input type="number" id="inputEstimatedBudget" class="form-control" required name="estimated_budget">
                </div>
                <div class="form-group">
                  <label for="inputSpentBudget">Total amount spent</label>
                  <input type="number" id="inputSpentBudget" class="form-control" required name="total_amount">
                </div>
                <div class="form-group">
                  <label for="inputEstimatedDuration">Estimated project duration (satuan bulan)</label>
                  <input type="number" id="inputEstimatedDuration" name="estimated_duration" required
                    class="form-control">
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Team</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body" style="display: block;">
                <?php if($_SESSION['role'] == 1) { ?>
                <div class="form-group">
                  <label for="inputProjectLeader">Project Leader</label>
                  <?= $project_leader_dropdown; ?>
                </div>
                <?php }  ?>
                <div class="form-group">
                  <label for="inputEstimatedBudget">Designer</label>
                  <?= $designer_dropdown; ?>
                </div>
                <div class="form-group">
                  <label for="inputSpentBudget">Developer</label>
                  <?= $developer_dropdown; ?>

                </div>
                <div class="form-group">
                  <label for="inputEstimatedDuration">Tester</label>
                  <?= $tester_dropdown; ?>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <?php }  ?>
  <form action="<?= base_url(); ?>/project/search" method="GET">
    <div class="input-group">
      <input type="search" name="search" class="form-control form-control-lg"
        placeholder="search by Project Name/Description/Client" 
      value="<?php if(!empty($_GET['search'])){ echo $_GET['search'];} ?>">
      <div class="input-group-append">
        <button type="submit" class="btn btn-lg btn-default">
          <i class="fa fa-search"></i>
        </button>
      </div>
    </div>
  </form>
  <br />
  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Projects</h3>
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
            <th style="width: 20%"> Project Name </th>
            <th> Project Description </th>
            <th> Project Client </th>
            <th class="text-center" style="width: 20%">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
            if (!empty($list)) {
                foreach ($list as $lists) { ?>
          <tr>
            <td><?= $lists['project_name']; ?></td>
            <td><?= $lists['project_description']; ?></td>
            <td><?= $lists['client_name']; ?></td>
            <td class="project-actions text-center">
              <a class="btn btn-primary btn-sm" href="<?= base_url(); ?>/project/project_detail/<?= $lists['id']; ?>">
                <i class="fas fa-folder"></i> View </a>
              <?php if($_SESSION['role'] == 1 || $_SESSION['role'] == 2) { ?>
                <?php if($lists['status'] == 'ACTIVE') { ?>
              <a class="btn btn-info btn-sm" href="<?= base_url(); ?>/project/project_edit/<?= $lists['id']; ?>">
                <i class="fas fa-pencil-alt"></i> Edit </a>
              <a data-bs-toggle="modal" class="btn btn-danger btn-sm"
                data-bs-target="#delete_project_<?= $lists['id']; ?>">
                <i class="fas fa-trash"></i> Delete </a>
                <?php }  ?>
              <?php }  ?>
            </td>
          </tr>
          <?php }
            }else{?>
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
<?php
  if (!empty($list)) {
      foreach ($list as $lists) { ?>
<div class="modal fade" id="delete_project_<?= $lists['id']; ?>" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Proyek <?= $lists['project_name']; ?>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Anda Yakin Menghapus Proyek <?= $lists['project_name']; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a href="<?= base_url(); ?>/project/project_delete/<?= $lists['id']; ?>" class="btn btn-primary">Save</a>
      </div>
    </div>
  </div>
</div>
<?php } } ?>
<!-- /.content --> <?= $this->endSection() ?>