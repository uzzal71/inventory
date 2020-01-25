  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo site_url('home')?>" class="logo">
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b> <?= $_SESSION['company_name'] ?> </b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only"><?= $_SESSION['company_name'] ?></span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="tasks-menu">
            <a href="<?php echo site_url('Login/logout')?>" >
              Logout
            </a>
          </li>
        </ul>
      </div>

    </nav>
  </header>