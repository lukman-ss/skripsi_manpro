<?= $this->extend("layout/main_layout") ?>
<?= $this->section("content") ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>List Notification</h1>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Notification</h3>
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
            <table class="table table-borderless">

                <tbody>
                    <?php if(!empty($list)){ 
            foreach($list as $lists){?>
                    <tr>
                        <td>
                            <p><a class="text-dark" href="<?= base_url(); ?>/<?= $lists['redirect']; ?>"><?= $lists['notification_body']; ?> - <?= $lists['created_at']; ?></a>
                            </p>
                        </td>
                    </tr>
                    <?php } 
    }  ?>

                </tbody>
            </table>

        </div>
        <!-- /.card-body -->

    </div>
    <!-- /.card -->
</section>

<!-- /.content --> <?= $this->endSection() ?>