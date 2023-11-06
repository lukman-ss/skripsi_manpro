<?= $this->extend("layout/main_layout") ?>
<?= $this->section("extra_css") ?>
<!-- <link rel="stylesheet" href="<?= base_url(); ?>/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css"> -->
<?= $this->endSection() ?>
<?= $this->section("content") ?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Project Edit</h1>
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
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">General</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                <form action="<?= base_url(); ?>/project/update_project" method="post">

                    <input type="hidden" name="id" value="<?= $project['id']; ?>">
                    <div class="form-group">
                        <label for="inputName">Project Name</label>
                        <input type="text" id="inputName" class="form-control" name="project_name" value="<?= $project['project_name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputDescription">Project Description</label>
                        <textarea name="project_description" id="inputDescription" class="form-control"
                            rows="4"><?= $project['project_description']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="inputClientCompany">Client Company</label>
                        <?= $client_dropdown; ?>
                    </div>
                    <button class="btn btn-sm btn-primary" type="submit">Submit</button>
                    </form>

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
                <form action="<?= base_url(); ?>/project/update_team"  method="post">
                    <input type="hidden" name="project_id" value="<?= $project_id; ?>">
                    <input type="hidden" name="id_designer" value="<?= $id_designer; ?>">
                    <input type="hidden" name="id_developer" value="<?= $id_developer; ?>">
                    <input type="hidden" name="id_tester" value="<?= $id_tester; ?>">
                    <input type="hidden" name="id_project_leader" value="<?= $id_project_leader; ?>">
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
                    <button type="submit" class="btn btn-sm btn-success">Submit</button>

                </form>

                </div>
                
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-md-6">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Budget</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                <form action="<?= base_url(); ?>/project/update_budget" method="post">

                    <input type="hidden" name="project_id" value="<?= $project_id; ?>">
                    <div class="form-group">
                        <label for="inputEstimatedBudget">Estimated budget</label>
                        <input type="number" id="inputEstimatedBudget" class="form-control" value="<?= $budget['estimated_budget']; ?>" name="estimated_budget" step="1">
                    </div>
                    <div class="form-group">
                        <label for="inputSpentBudget">Total amount spent</label>
                            <div class="row">
                                <div class="col-md-10">
                                    <input type="number" disabled id="inputSpentBudget" class="form-control" value="<?= $budget['total_amount']; ?>" name="total_amount" step="1">
                                </div>
                                <div class="col-md-2"><a type="button" data-bs-toggle="modal" data-bs-target="#add_amount" class="btn btn-sm btn-primary">Add Amount</a></div>
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEstimatedDuration">Estimated project duration</label>
                        <input type="number" id="inputEstimatedDuration" class="form-control" value="<?= $budget['estimated_duration']; ?>" name="estimated_duration" step="0.1">
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                </form>


                </div>
                <!-- /.card-body -->
                
            </div>
            <!-- /.card -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Files</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>File Name</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($file as $files) { ?>
                            <tr>
                                <td><?= $files['name_file']; ?></td>
                                <td class="text-right py-0 align-middle text-center">
                                    <div class="btn-group btn-group-sm">
                                        <a target="_blank" href="<?= base_url(); ?>/upload/berkas/<?= $files['name_file']; ?>"  class="btn btn-info"><i class="fas fa-eye"></i></a>
                                        <a href="<?= base_url(); ?>/project/project_delete_file" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <?php }  ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    
</section>
<div class="modal fade" id="add_amount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Amount</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="<?= base_url(); ?>/project/project_add_amount" method="post">
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" name="budget_id" value="<?= $budget['id']; ?>">
                <label for="inputName">Amount Name</label>
                <input type="text" id="inputBudgetAmount" class="form-control" required name="amount_name">
              </div>
          <div class="form-group">
                <label for="inputName">Amount</label>
                <input type="text" id="inputBudgetAmount" class="form-control" required name="amount">
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
<?= $this->endSection() ?>