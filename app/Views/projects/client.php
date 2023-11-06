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
        <h1>Clients</h1>
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
  <button type="button" data-bs-toggle="modal" data-bs-target="#add_client" class='btn btn-sm btn-primary'>Add
    Client</button>
  <br />
  <br />
  <!-- Modal -->
  <div class="modal fade" id="add_client" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Client</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="<?= base_url(); ?>/project/client_save" method="post">
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
                  <label for="inputName">Name</label>
                  <input type="text" id="inputName" class="form-control" required name="name">
                </div>
                <div class="form-group">
                  <label for="inputName">Company</label>
                  <input type="text" id="inputName" class="form-control" required name="company">
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
  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">List CLient</h3>
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
            <th style="width: 20%"> Name </th>
            <th> Company </th>
            <?php if($_SESSION['role'] == 1 && $_SESSION['role'] == 2) { ?>
            <th class="text-center" style="width: 20%">Action</th>
            <?php }  ?>
          </tr>
        </thead>
        <tbody>
          <?php
            if (!empty($list)) {
                foreach ($list as $lists) { ?>
          <tr>
            <td><?= $lists['name']; ?></td>
            <td><?= $lists['company']; ?></td>
            <td class="project-actions text-right">
              <button type="button" data-bs-toggle="modal" class="btn btn-info btn-sm" data-bs-target="#edit_client_<?= $lists['id']; ?>">
                <i class="fas fa-pencil-alt"></i> Edit </button>
              <button type="button" data-bs-toggle="modal"  class="btn btn-danger btn-sm" data-bs-target="#delete_client_<?= $lists['id']; ?>">
                <i class="fas fa-trash"></i> Delete </button>
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
  <div class="modal fade" id="edit_client_<?= $lists['id']; ?>" tabindex="-1">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Client <?= $lists['name']; ?> -
            <?= $lists['company']; ?>
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="<?= base_url(); ?>/project/client_update" method="post">
            <input type="hidden" id="inputName" class="form-control" value="<?= $lists['id']; ?>" required name="id">

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
                  <label for="inputName">Name</label>
                  <input type="text" id="inputName" class="form-control" value="<?= $lists['name']; ?>" required
                    name="name">
                </div>
                <div class="form-group">
                  <label for="inputName">Company</label>
                  <input type="text" id="inputName" class="form-control" value="<?= $lists['company']; ?>" required
                    name="company">
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
  <div class="modal fade" id="delete_client_<?= $lists['id']; ?>" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Client <?= $lists['name']; ?> -
            <?= $lists['company']; ?>
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Anda Yakin Menghapus Data <?= $lists['name']; ?> - <?= $lists['company']; ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <a href="<?= base_url(); ?>/project/client_delete/<?= $lists['id']; ?>" class="btn btn-primary">Save</a>
        </div>
      </div>
    </div>
  </div>
  <?php } } ?>
<!-- /.content --> <?= $this->endSection() ?>