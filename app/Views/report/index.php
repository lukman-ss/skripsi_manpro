<?= $this->extend("layout/main_layout") ?> <?= $this->section("content") ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Report</h1>
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
    <!-- Button trigger modal -->
 
    <!-- Modal -->
 
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">List Report</h3>
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
                        <th style="width: 40%"> Project Description </th>
                        <th style="width: 20%"> Project Client </th>
                        <th style="width: 20%" class="text-center"> Action </th>
                    </tr>
                </thead>
                <tbody>
                    <?php   foreach($list as $lists)
                    {  ?>
                    <tr>
                        <td><?= $lists['project_name']; ?></td>
                        <td><?= $lists['project_description']; ?></td>
                        <td><?= $lists['company']; ?></td>
                        <td>
                            <a class="btn btn-sm btn-primary btn-cpas" target="_blank"
                                href="<?= base_url(); ?>/report/generate_pdf/<?= $lists['id']; ?>">
                                Generate Report
                            </a>
                            
                        </td>
                    </tr>
                    <?php  } ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-sm-12 col-md-5">
                    <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Tampil <?= $page * $perPage + 1; ?> sampai <?= ($page * $perPage) + $perPage ; ?>
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