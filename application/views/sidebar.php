<?php
$user=$this->session->userdata('user');
?>
<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo base_url();?>uploads/no-image.png" class="img-circle" alt="User Image">           
            </div>
            <div class="pull-left info">
              <p><?php echo $user['txt_name'] ?></p>
            </div>
          </div>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li>
              <a href="<?php echo site_url();?>/user/dashboard">
                <i class="fa fa-th"></i> <span>Dashboard</span>
              </a>
            </li>
            <li class="treeview">
              <a href="">
                <i class="fa fa-dashboard"></i> <span>Book Keepers</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo site_url();?>/bkeepers/add"><i class="fa fa-circle-o"></i> Add </a></li>
                <li class="active"><a href="<?php echo site_url();?>/bkeepers/bkeepers_list"><i class="fa fa-circle-o"></i> List</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="">
                <i class="fa fa-dashboard"></i> <span>Record</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo site_url();?>/record/add"><i class="fa fa-circle-o"></i> Add </a></li>
                <li class="active"><a href="<?php echo site_url();?>/record/record_list"><i class="fa fa-circle-o"></i> List</a></li>
              </ul>
            </li>
           </ul>
        </section>
        <!-- /.sidebar -->
      </aside>