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

    <br />
    <!-- Default box -->
    <div class="card">
        <div class="card-body">
            <div class="row">
                
                <form action="<?= base_url(); ?>/user/change_password_save" method="post">
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password">

                    </div>
                    <div class="form-group">
                        <label for="">Ulangi Password</label>
                        <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password">

                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Change password</button>
                        </div>
                        <!-- /.col -->
                    </div>
            </div>
            </form>
        </div>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->

<?= $this->endSection() ?>
<?= $this->section("extra_js") ?>

<?= $this->endSection() ?>