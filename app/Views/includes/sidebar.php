<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?= base_url(); ?>" class="brand-link">
    <img  src="<?= base_url(); ?>/img/logoukur.png" class="brand-image img-rounded elevation-3"
      style="opacity: .8">
    <span class="brand-text font-weight-light">UKUR-MenPro</span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info">
        <a href="#" class="d-block"><?= $_SESSION['name']; ?></a>
      </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item">
          <a href="<?= base_url(); ?>/dashboard" class="nav-link <?= (url_is('dashboard*') ? 'active' : '') ?>">
            <i class="far fa-circle nav-icon"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <?php if($_SESSION['role'] == 1) { ?>
        <li class="nav-item <?= (url_is('user*') ? 'menu_open' : '') ?>">
          <a href="#" class="nav-link <?= (url_is('user*') ? 'active' : '') ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              User Management
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" <?= (url_is('user*') ? 'style="display:block"' : '') ?>>
            <li class="nav-item <?= (url_is('user*') ? 'menu_open' : '') ?>">
              <a href="#" class="nav-link <?= (url_is('user*') ? 'active' : '') ?>">
                <i class="nav-icon fas fa-circle"></i>
                <p>
                  List User
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" <?= (url_is('user*') ? 'style="display:block"' : '') ?>>
              <li class="nav-item <?= (url_is('user/list_user/all') || url_is('user/search*') ? 'active' : '') ?>">
              <a href="<?= base_url(); ?>/user/list_user/all" class="nav-link <?= (url_is('user/list_user/all') || url_is('user/search*') ? 'active' : '') ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Semua User</p>
              </a>
            </li>
                <li class="nav-item <?= (url_is('user/super_user') ? 'active' : '') ?>">
                  <a href="<?= base_url(); ?>/user/list_user/super_user" class="nav-link <?= (url_is('user/list_user/super_user') ? 'active' : '') ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Super User</p>
                  </a>
                </li>
                <li class="nav-item <?= (url_is('user/list_user/project_leader') ? 'active' : '') ?>">
                  <a href="<?= base_url(); ?>/user/list_user/project_leader" class="nav-link <?= (url_is('user/list_user/project_leader') ? 'active' : '') ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Manajer Proyek</p>
                  </a>
                </li>
                <li class="nav-item <?= (url_is('user/list_user/designer') ? 'active' : '') ?>">
                  <a href="<?= base_url(); ?>/user/list_user/designer"
                    class="nav-link <?= (url_is('user/list_user/designer') ? 'active' : '') ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Desainer</p>
                  </a>
                </li>
                <li class="nav-item <?= (url_is('user/list_user/developer') ? 'active' : '') ?>">
                  <a href="<?= base_url(); ?>/user/list_user/developer"
                    class="nav-link <?= (url_is('user/list_user/developer') ? 'active' : '') ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Developer</p>
                  </a>
                </li>
                <li class="nav-item <?= (url_is('user/list_user/tester') ? 'active' : '') ?>">
                  <a href="<?= base_url(); ?>/user/list_user/tester"
                    class="nav-link <?= (url_is('user/list_user/tester') ? 'active' : '') ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tester</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </li>
        <?php }  ?>
        <li class="nav-item <?= (url_is('project*') ? 'menu_open' : '') ?>">
          <a href="#" class="nav-link <?= (url_is('project*') ? 'active' : '') ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Project
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" <?= (url_is('project*') ? 'style="display:block"' : '') ?>>
            <li class="nav-item <?= (url_is('project*') ? 'menu_open' : '') ?>">
              <a href="#" class="nav-link <?= (url_is('project*') ? 'active' : '') ?>">
                <i class="nav-icon fas fa-circle"></i>
                <p>
                  List Proyek
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" <?= (url_is('project*') ? 'style="display:block"' : '') ?>>
                <li class="nav-item <?= (url_is('project') ? 'active' : '') ?>">
                  <a href="<?= base_url(); ?>/project" class="nav-link <?= (url_is('project') ? 'active' : '') ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Project On Going</p>
                  </a>
                </li>
                <li class="nav-item <?= (url_is('project/finished') ? 'active' : '') ?>">
                  <a href="<?= base_url(); ?>/project/finished"
                    class="nav-link <?= (url_is('project/finished') ? 'active' : '') ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Project Finished</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item <?= (url_is('project/list_budget') ? 'menu_open' : '') ?>">
              <a href="<?= base_url(); ?>/project/list_budget" class="nav-link <?= (url_is('project/list_budget') ? 'active' : '') ?>">
                <i class="nav-icon fas fa-circle"></i>
                <p>
                  List Budget
                </p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item <?= (url_is('project/client') ? 'menu_open' : '') ?>">
          <a href="#" class="nav-link <?= (url_is('project/client') ? 'active' : '') ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Client
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" <?= (url_is('project/client') ? 'style="display:block"' : '') ?>>
            <li class="nav-item <?= (url_is('project/client') ? 'menu_open' : '') ?>">
              <a href="<?= base_url(); ?>/project/client" class="nav-link <?= (url_is('project/client') ? 'active' : '') ?>">
                <i class="nav-icon fas fa-circle"></i>
                <p>
                  List Client
                </p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="<?= base_url(); ?>/notification" class="nav-link <?= (url_is('notification*') ? 'active' : '') ?>">
            <i class="far fa-circle nav-icon"></i>
            <p>Notification</p>
          </a>
        </li>
        <?php if($_SESSION['role'] == 1 || $_SESSION['role'] == 2) { ?>
        <li class="nav-item">
          <a href="<?= base_url(); ?>/report" class="nav-link <?= (url_is('report*') ? 'active' : '') ?>">
            <i class="far fa-circle nav-icon"></i>
            <p>Report</p>
          </a>
        </li>
        <?php }  ?>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>