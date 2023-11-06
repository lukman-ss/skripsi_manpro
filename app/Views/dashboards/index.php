<?= $this->extend("layout/main_layout") ?>
<?= $this->section("content") ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
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
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <?php if($_SESSION['role'] == 1  || $_SESSION['role'] == 2 ) { ?>
        <div class="row">
            <?php
            $total_users = 0; foreach($users as $user) {
                $total_users += $user['count'];
                ?>
            <?php if($user['name'] == 'Designer'){
                $icon_user = '<i class="fas fa-user-edit"></i>';
            }elseif($user['name'] == 'Developer'){
                $icon_user = '<i class="fas fa-user-lock"></i>';
            }elseif($user['name'] == 'Project Leader'){
                $icon_user ='<i class="fas fa-user-cog"></i>';
            }elseif($user['name'] == 'Super User'){
                $icon_user ='<i class="fas fa-user-shield"></i>';
            }elseif($user['name'] == 'Tester'){
                $icon_user ='<i class="fas fa-user-check"></i>';
            }   ?>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3><?= $user['count']; ?></h3>

                        <p><?= $user['name']; ?></p>
                    </div>
                    <div class="icon">
                        <?= $icon_user; ?>
                    </div>
                    <a href="<?= base_url(); ?>/project" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <?php }  ?>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3><?= $total_users; ?></h3>

                        <p>Total users</p>
                    </div>
                    
                    <div class="icon">
                    <i class="fas fa-users"></i>
                    </div>
                    <a href="<?= base_url(); ?>/project" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <hr />
        <?php }   ?>
        
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?= $project_progress; ?></h3>

                        <p>Project On Progess</p>
                    </div>
                    <div class="icon">
                    <i class="fas fa-spinner"></i>
                    </div>
                    <a href="<?= base_url(); ?>/project" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?= $project_finished; ?></h3>

                        <p>Project Finished</p>
                    </div>
                    <div class="icon">
                    <i class="fas fa-check"></i>
                    </div>
                    <a href="<?= base_url(); ?>/project" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?= $project; ?></h3>

                        <p>Project</p>
                    </div>
                    <div class="icon">
                        <i class='fas fa-project-diagram'></i>
                    </div>
                    <a href="<?= base_url(); ?>/project" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <hr />
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?= $task_onprogress; ?></h3>

                        <p>Task On Progress</p>
                    </div>
                    <div class="icon">
                    <i class="fas fa-spinner"></i>
                    </div>
                    <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?= $task_finish; ?></h3>

                        <p>Task Finish</p>
                    </div>
                    <div class="icon">
                    <i class="fas fa-check"></i>
                    </div>
                    <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?= $task_all; ?></h3>

                        <p>Task</p>
                    </div>
                    <div class="icon">
                        <i class='fas fa-tasks'></i>
                    </div>
                    <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                </div>
                <!-- ./col -->
            </div>
            <!-- ./col -->
        </div>


        <!-- ./col -->
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<?= $this->endSection() ?>
<?= $this->section("extra_js") ?>
<!-- ChartJS -->
<script src="<?= base_url(); ?>/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?= base_url(); ?>/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?= base_url(); ?>/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?= base_url(); ?>/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url(); ?>/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?= base_url(); ?>/plugins/moment/moment.min.js"></script>
<script src="<?= base_url(); ?>/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url(); ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= base_url(); ?>/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url(); ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<?= $this->endSection() ?>