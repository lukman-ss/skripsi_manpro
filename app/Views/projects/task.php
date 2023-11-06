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
            <div class="alert alert-success"><?= session()->getFlashdata('error') ?></div>
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
    <div class="accordion" id="accordionExample">
        <div class="accordion-item">

            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    Add Activity
                </button>
            </h2>

            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                data-bs-parent="#accordionExample">
                <?php if($_SESSION['role'] == $position ) { ?>

                <div class="accordion-body">
                    <form action="<?= base_url(); ?>/project/project_timeline_save" method="POST"
                        enctype="multipart/form-data">
                        <input type="hidden" name="task_id" value="<?= $task['id']; ?>">
                        <div class="form-group">
                            <label for="inputName">Activity Name</label>
                            <input type="text" id="inputName" class="form-control" required name="timeline_header">
                        </div>
                        <div class="form-group">
                            <label for="inputName">Activity Description</label>
                            <textarea type="text" id="inputName" class="form-control" required name="timeline_body"
                                cols="30" rows="5"></textarea>
                        </div>
                        <span>Upload File dan Link Boleh dikosongkan</span>
                        <div class="form-group">
                            <label for="">Upload File</label>
                            <input type="file" name="attachment" class="form-control" id="inputGroupFile01">
                        </div>
                        <div class="form-group">
                            <label for="">Link</label>
                            <input type="text" id="inputName" class="form-control" name="link">
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary">Add</button>
                        <?php if($position == 5) { ?>
                        <button class="btn btn-sm btn-warning">Reject</button>
                        <?php }  ?>
                </div>
                </form>
                <?php } else{ ?>
                <h4>Form Tidak Tersedia</h4>
                <?php }  ?>
            </div>

        </div>

    </div>
    <div class="container-fluid">

        <!-- Timelime example  -->
        <div class="row">
            <div class="col-md-12">

                <br />
                <br />
                <!-- The time line -->
                <div class="timeline">
                    <!-- timeline time label -->
                    <!-- <div class="time-label">
                        <span class="bg-red">10 Feb. 2014</span>
                    </div> -->
                    <!-- /.timeline-label -->
                    <!-- timeline item -->
                    <?php foreach($list as $key => $value) { 
                        if($value['position'] == 3)
                        {
                            $value['position'] = 'Designer';
                        }elseif($value['position'] == 4)
                        {
                            $value['position'] = 'Developer';
                        }elseif($value['position'] == 5)
                        {
                            $value['position'] = 'Tester';
                        }
                        ?>
                    <div>
                        <i class="fas fa-envelope bg-blue"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fas fa-clock"></i> <?= $value['created_at']; ?></span>
                            <h3 class="timeline-header"><?= $value['timeline_header']; ?> |
                                    <?= $value['position']; ?></h3>

                            <div class="timeline-body">
                                <?= $value['timeline_body']; ?>
                                <br />
                                <?php if($value['link'] != NULL) { ?>
                                <a href="<?= $value['link'] ?>"><?= $value['link']; ?></a>
                                <?php }  ?>
                                <?php if($value['attachment'] != NULL) { ?>
                                <a 
                                    href="<?= base_url(); ?>/upload/timeline/<?= $value['attachment'] ?>"><?= $value['attachment']; ?></a>
                                <?php }  ?>
                            </div>
                            <!-- <div class="timeline-footer">
                                
                            </div> -->
                        </div>
                    </div>
                    <?php } ?>
                    <!-- END timeline item -->

                    <!-- ini digunakan nanti flagging finish -->
                    <div>
                        <i class="fas fa-clock bg-gray"></i>
                        <?php if($position > 5) { ?>
                        <div class="timeline-item">
                            <h4>Finish</h4>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.col -->
    </div>
    </div>
    <!-- /.timeline -->

</section>
<!-- /.content -->
<?= $this->endSection() ?>
<?= $this->section("extra_js") ?>

<!-- Select2 -->
<script src="<?= base_url(); ?>/plugins/select2/js/select2.full.min.js"></script>
<!-- moment -->
<script src="<?= base_url(); ?>/plugins/moment/moment.min.js"></script>

<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2({
            dropdownParent: $("#exampleModal"),
            width: null
        })

        //Initialize Select2 Elements
        // $('.select2bs4').select2({
        //   theme: 'bootstrap4',
        //   dropdownParent: $("#exampleModal"),

        // })
    });
    $('.select2bs4').click(function (e) {
        if ($(this).find('select2-dropdown-open')) {
            $(this).next('.head_ctrl_label').css('margin', '0');
        }
        e.preventDefault();
    });
</script>
<?= $this->endSection() ?>