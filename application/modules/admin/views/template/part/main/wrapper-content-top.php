  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?php 
                if ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == '') {
                  echo 'Dashboard';
                } else {
                    echo ucwords(str_replace('-', ' ', $this->uri->segment(2)));
                }
            ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo site_url('admin') ?>">Dashboard</a></li>
              <?php if ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) != ''): ?>
                <li class="breadcrumb-item active"><?php echo ucfirst(str_replace('-', ' ', $this->uri->segment(2))); ?></li>
              <?php endif ?>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="content">
      <div class="container-fluid">
        <div class="row">