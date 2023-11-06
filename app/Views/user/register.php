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
                echo $validation->listErrors();
                // foreach( as $errors)
                // {
                //     echo $errors;
                // }
                // foreach(session()->getFlashdata('error') as $error)
                // {
                //     echo $error;
                // }
                ?></div>
            <?php endif;?>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Button trigger modal -->
    <button type="button" data-bs-toggle="modal" data-bs-target="#create_user" class='btn btn-sm btn-primary'>Add
        Users</button>
    <br />
    <br />
    <form action="<?= base_url(); ?>/user/search" method="GET">
        <div class="input-group">
            <input type="search" name="search" class="form-control form-control-lg"
                placeholder="Cari berdasarkan Nama atau Email" value="<?php if(!empty($_GET['search'])){ echo $_GET['search'];} ?>">
            <div class="input-group-append">
                <button type="submit" class="btn btn-lg btn-default">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </form>
    <!-- Modal -->
    <div class="modal fade" id="create_user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form action="<?= base_url(); ?>/user/register_save" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Users</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">General</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body" style="display: block;">
                                <div class="form-group">
                                    <label for="inputName">Name</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Email</label>
                                    <input type="email" name="email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Role</label>
                                    <select name="role" class="form-select" id="">
                                        <option value="1">Super User</option>
                                        <option value="2">Project Manager</option>
                                        <option value="3">Designer</option>
                                        <option value="4">Developer</option>
                                        <option value="5">Tester</option>
                                    </select>
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
    <br />
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tabel User</h3>
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
                        <th style="width: 20%"> Nama </th>
                        <th style="width: 30%"> Email </th>
                        <th style="width: 20%"> Role </th>
                        <th style="width: 30%" class="text-center"> Action </th>
                    </tr>
                </thead>
                <tbody>
                    <?php   foreach($list as $lists)
                    {  ?>
                    <tr>
                        <td><?= $lists['name']; ?></td>
                        <td><?= $lists['email']; ?></td>
                        <td><?= $lists['role_name']; ?></td>
                        <td>
                            <a class="btn btn-sm btn-primary btn-cpas" data-bs-toggle="modal"
                                data-bs-target="#cpas_user_<?= $lists['id']; ?>">
                                Change Password
                            </a>
                            <a class="btn btn-sm btn-warning btn-edit" data-bs-toggle="modal"
                                data-bs-target="#edit_user_<?= $lists['id']; ?>">
                                Edit
                            </a>
                            <a data-bs-toggle="modal" data-bs-target="#delete_user_<?= $lists['id']; ?> "
                                class="btn btn-sm btn-danger">
                                Delete
                            </a>
                        </td>
                    </tr>
                    <div class="modal fade" id="cpas_user_<?= $lists['id']; ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <form action="<?= base_url(); ?>/user/register_cpas" method="post">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Change Password User <span
                                                class="font-weight-bold"><?= strtoupper($lists['name']); ?></span></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card card-primary">
                                            <div class="card-header">
                                                <h3 class="card-title">General</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool"
                                                        data-card-widget="collapse" title="Collapse">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body" style="display: block;">
                                                <input type="hidden" name="id" value="<?= $lists['id']; ?>">
                                                <div class="form-group">
                                                    <label for="inputName">New Password</label>
                                                    <input required type="password" name="password"
                                                        class="form-control name">
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
                    <div class="modal fade" id="edit_user_<?= $lists['id']; ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <form action="<?= base_url(); ?>/user/register_update" method="post">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit User <span
                                                class="font-weight-bold"><?= strtoupper($lists['name']); ?></span></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card card-primary">
                                            <div class="card-header">
                                                <h3 class="card-title">General</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool"
                                                        data-card-widget="collapse" title="Collapse">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body" style="display: block;">
                                                <input type="hidden" name="id" value="<?= $lists['id']; ?>">
                                                <div class="form-group">
                                                    <label for="inputName">Name</label>
                                                    <input type="text" name="name" class="form-control name"
                                                        value="<?= $lists['name']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputName">Email</label>
                                                    <input type="email" name="email" value="<?= $lists['email']; ?>"
                                                        class="form-control email">
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputName">Role</label>
                                                    <select name="role" class="form-select" id="">
                                                        <option value="1" <?= $lists['role'] == 1 ? 'selected' : '' ?>>
                                                            Super User
                                                        </option>
                                                        <option value="2" <?= $lists['role'] == 2 ? 'selected' : '' ?>>
                                                            Project
                                                            Leader</option>
                                                        <option value="3" <?= $lists['role'] == 3 ? 'selected' : '' ?>>
                                                            Designer
                                                        </option>
                                                        <option value="4" <?= $lists['role'] == 4 ? 'selected' : '' ?>>
                                                            Developer
                                                        </option>
                                                        <option value="5" <?= $lists['role'] == 5 ? 'selected' : '' ?>>
                                                            Tester
                                                        </option>
                                                    </select>
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
                    <div class="modal fade" id="delete_user_<?= $lists['id']; ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="<?= base_url(); ?>/user/register_delete" method="post">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete User <span
                                                class="font-weight-bold"><?= strtoupper($lists['name']); ?></span></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Anda Yakin Ingin Menghapus Data ID <span
                                            class="font-font-weight-bold"><?= $lists['id']; ?></span> ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <a href="<?= base_url(); ?>/user/register_delete/<?= $lists['id']; ?>"
                                            class="btn btn-danger">Delete</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php  } ?>
                </tbody>
            </table>

        </div>
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
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->

<?= $this->endSection() ?>
<?= $this->section("extra_js") ?>

<?= $this->endSection() ?>