<?= $this->extend("layout/main_layout") ?> <?= $this->section("content") ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>User</h1>
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
            <h3 class="card-title"><?= $list['project_name']; ?></h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-center text-muted">Estimated budget</span>
                                    <span
                                        class="info-box-number text-center text-muted mb-0"><?= $list['estimated_budget']; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-center text-muted">Total amount spent</span>
                                    <span
                                        class="info-box-number text-center text-muted mb-0"><?= $list['total_amount']; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-center text-muted">Estimated project duration</span>
                                    <span
                                        class="info-box-number text-center text-muted mb-0"><?= $list['estimated_duration']; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h4>List Task</h4>
                            <?php if($_SESSION['role'] == 1 || $_SESSION['role'] == 2) { ?>
                                <?php if($list['project_status'] == 'ACTIVE') { ?>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#add_task"
                                class='btn btn-sm btn-primary'>Tambah Task</button>
                                <?php }  ?>
                            <?php }  ?>

                            <!-- Modal -->
                            <div class="modal fade" id="add_task" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah Task</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<?= base_url(); ?>/project/task_save" method="post">
                                                <div class="card card-primary">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Task</h3>
                                                        <div class="card-tools">
                                                            <button type="button" class="btn btn-tool"
                                                                data-card-widget="collapse" title="Collapse">
                                                                <i class="fas fa-minus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="card-body" style="display: block;">
                                                        <input type="hidden" name="project_id"
                                                            value="<?= $list['project_id']; ?>">
                                                        <div class="form-group">
                                                            <label for="inputName">Task Name</label>
                                                            <input type="text" id="inputName" class="form-control"
                                                                required name="task_name">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputDescription">Task Description</label>
                                                            <textarea id="inputDescription" class="form-control"
                                                                rows="4" required name="task_description"></textarea>
                                                        </div>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <br />
                            <br />
                            <?php if (!empty($tasks)) {
                            foreach($tasks as $task) { ?>
                            <div class="post">
                                <div>
                                    <h4>
                                        <?php if($task['status'] != 'DELETED') { ?>
                                        <a href="<?= base_url(); ?>/project/project_task/<?= $task['id']; ?>"><?= $task['task_name']; ?>
                                        </a>
                                        <?php }else{ ?>
                                            <?= $task['task_name']; ?>
                                        <?php }   ?>
                                    </h4>
                                </div>
                                <p>
                                    <?= $task['task_description']; ?>
                                </p>
                                 <?php if($task['status'] == 'ACTIVE'){
                                    $badge = '<span class="badge badge-primary">ACTIVE</span>';
                                }elseif($task['status'] == 'FINISHED') {
                                    $badge = '<span class="badge badge-success">FINISHED</span>';
                                }elseif($task['status'] == 'DELETED') {
                                    $badge = '<span class="badge badge-danger">DELETED</span>';
                                } ?>
                                    <p>Status: <?= $badge; ?></p>
                                    <?php if($_SESSION['role'] == 1 || $_SESSION['role'] == 2) { ?>
                                        <?php if($list['project_status'] == 'ACTIVE') { ?>
                                    <div>
                                        <button type="button" data-bs-toggle="modal" class="btn btn-warning btn-sm" data-bs-target="#edit_task_<?= $task['id']; ?>">Edit</button>
                                        <button type="button" data-bs-toggle="modal" class="btn btn-danger btn-sm" data-bs-target="#delete_task_<?= $task['id']; ?>">Delete</button>
                                    </div>
                                        <?php }   ?>
                                    <?php }   ?>
                            </div>
                            <?php } } ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                    <h3 class="text-primary"><i class="fas fa-paint-brush"></i> <?= $list['project_name']; ?> </h3>
                    <p class="text-muted"><?= $list['project_description']; ?></p>
                    <!-- Button trigger modal -->
                    <?php if($_SESSION['role'] == 1 || $_SESSION['role'] == 2) { ?>
                        <?php if($list['project_status'] == 'ACTIVE') { ?>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#finish_project">
                        Selesaikan Proyek!
                    </button>
                        <?php }  ?>
                    <?php }  ?>
                    <br>
                    <div class="text-muted">
                        <p class="text-lg">Client Company
                            <b class="d-block"><?= $list['company']; ?></b>
                        </p>
                        <p class="text-lg">Team
                            <?php foreach($list_team as $lists) { ?>
                            <b class="d-block"><?= $lists['name']; ?> | <?= $lists['role_name']; ?></b>
                            <?php }  ?>
                        </p>
                    </div>

                    <h5 class="mt-5 text-muted">Project files</h5>
                    <ul class="list-unstyled">
                        <?php
                        if(!empty($file)){
                        foreach($file as $key => $value) { ?>
                        <li>
                            <a href="<?= base_url(); ?>/upload/berkas/<?= $value['name_file']; ?>"
                                class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i>
                                <?= $value['name_file']; ?></a>
                        </li>
                        <?php
                            }
                        } ?>
                    </ul>
                    <div class="text-left mt-5 mb-3">
                        <?php if($_SESSION['role'] == 1 || $_SESSION['role'] == 2) { ?>
                            <?php if($list['project_status'] == 'ACTIVE') { ?>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#add_files"
                            class='btn btn-sm btn-primary'>Add files</button>
                            <?php }  ?>
                        <?php }  ?>
                    </div>
                    <div class="modal fade" id="add_files" tabindex="-1" aria-labelledby="exampleModalLabel1"
                        aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah File</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form enctype="multipart/form-data" action="<?= base_url(); ?>/project/file_save"
                                        method="post">
                                        <div class="card card-primary">
                                            <div class="card-header">
                                                <h3 class="card-title">File</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool"
                                                        data-card-widget="collapse" title="Collapse">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body" style="display: block;">
                                                <input type="hidden" name="project_id"
                                                    value="<?= $list['project_id']; ?>">
                                                <div class="form-group">
                                                    <label for="formFile" class="form-label">File</label>
                                                    <input name="berkas" class="form-control" type="file" id="formFile">
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->
<!-- Modal -->
<div class="modal fade" id="finish_project" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Selesaikan Proyek</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Anda Yakin Menyelesaikan Proyek <b><?= $list['project_name']; ?></b> ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <a class="btn btn-primary"
                    href="<?= base_url(); ?>/project/project_finish/<?= $list['project_id']; ?>">Selesai</a>
            </div>
        </div>
    </div>
</div>
<?php if (!empty($tasks)) {
    foreach($tasks as $task) { ?>
  <div class="modal fade" id="edit_task_<?= $task['id']; ?>" tabindex="-1">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Task <?= $task['task_name']; ?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="<?= base_url(); ?>/project/task_update" method="post">
            <input type="hidden" id="inputName" class="form-control" value="<?= $task['id']; ?>" required name="id">
            <input type="hidden" name="project_id" value="<?= $list['project_id']; ?>">
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
                  <label for="inputName">Task Name</label>
                  <input type="text" id="inputName" class="form-control" value="<?= $task['task_name']; ?>" required
                    name="task_name">
                </div>
                <div class="form-group">
                  <label for="inputName">Description</label>
                  <textarea name="task_description" class="form-control" cols="30" rows="5"><?= $task['task_description']; ?></textarea>
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
  <div class="modal fade" id="delete_task_<?= $task['id']; ?>" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Task <?= $task['task_name']; ?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Anda Yakin Menghapus Data Task <?= $task['task_name']; ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <a href="<?= base_url(); ?>/project/task_delete/<?= $task['id']; ?>" class="btn btn-primary">Save</a>
        </div>
      </div>
    </div>
  </div>
  <?php } } ?>
<?= $this->endSection() ?>
<?= $this->section("extra_js") ?>
<!-- Select2 -->
<script src="<?= base_url(); ?>/plugins/select2/js/select2.full.min.js"></script>
<!-- moment -->
<script src="<?= base_url(); ?>/plugins/moment/moment.min.js"></script>
<?= $this->endSection() ?>