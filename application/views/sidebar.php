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
			<?php if($user['int_user_type']==1){ ?>
            <li class="treeview">
              <a href="">
                <i class="fa fa-dashboard"></i> <span>Organizations</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo site_url();?>/organization/add"><i class="fa fa-circle-o"></i> Add </a></li>
                <li class="active"><a href="<?php echo site_url();?>/organization/organization_list"><i class="fa fa-circle-o"></i> List</a></li>
              </ul>
            </li>
           <li class="treeview">
              <a href="">
                <i class="fa fa-dashboard"></i> <span>Staff</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="<?php echo site_url();?>/staff/add_admin"><i class="fa fa-circle-o"></i> Add</a></li>
				<li class="active"><a href="<?php echo site_url();?>/staff/staff_list_admin"><i class="fa fa-circle-o"></i> View</a></li>
              </ul>
            </li>
			 <li class="treeview">
              <a href="">
                <i class="fa fa-dashboard"></i> <span>Stopage</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="<?php echo site_url();?>/location/add_admin"><i class="fa fa-circle-o"></i> Add</a></li>
				<li class="active"><a href="<?php echo site_url();?>/location/location_list_admin"><i class="fa fa-circle-o"></i> View</a></li>
              </ul>
            </li>
			<li class="treeview">
              <a href="">
                <i class="fa fa-dashboard"></i> <span>Routes</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="<?php echo site_url();?>/route/add_admin"><i class="fa fa-circle-o"></i> Add</a></li>
				<li class="active"><a href="<?php echo site_url();?>/route/route_list_admin"><i class="fa fa-circle-o"></i> View</a></li>
              </ul>
            </li>
			<li class="treeview">
              <a href="">
                <i class="fa fa-dashboard"></i> <span>Fare</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="<?php echo site_url();?>/fare/fare_list_admin"><i class="fa fa-circle-o"></i> View</a></li>
				<li class="active"><a href="<?php echo site_url();?>/fare/import_form_admin"><i class="fa fa-circle-o"></i> Import</a></li>
              </ul>
            </li>
			<li class="treeview">
              <a href="">
                <i class="fa fa-dashboard"></i> <span>Vehicle</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
				<li><a href="<?php echo site_url();?>/vehicle/add_admin"><i class="fa fa-circle-o"></i> Add </a></li>
                <li class="active"><a href="<?php echo site_url();?>/vehicle/vehicle_list_admin"><i class="fa fa-circle-o"></i> View</a></li>
              </ul>
            </li>
			<li class="treeview">
              <a href="">
                <i class="fa fa-dashboard"></i> <span>Transactions</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="<?php echo site_url();?>/fare/list_transaction_admin"><i class="fa fa-circle-o"></i> View</a></li>
              </ul>
            </li>
			<li class="treeview">
              <a href="">
                <i class="fa fa-dashboard"></i> <span>Users</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo site_url();?>/user/add"><i class="fa fa-circle-o"></i> Add </a></li>
                <li class="active"><a href="<?php echo site_url();?>/user/user_list"><i class="fa fa-circle-o"></i> List</a></li>
              </ul>
            </li>
			<?php }else{ ?>
			<li class="treeview">
              <a href="">
                <i class="fa fa-dashboard"></i> <span>Staff</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
				<li><a href="<?php echo site_url();?>/staff/add"><i class="fa fa-circle-o"></i> Add </a></li>
                <li class="active"><a href="<?php echo site_url();?>/staff/staff_list"><i class="fa fa-circle-o"></i> View</a></li>
              </ul>
            </li>
			 <li class="treeview">
              <a href="">
				<i class="fa fa-dashboard"></i> <span>Stopage</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
				<li><a href="<?php echo site_url();?>/location/add"><i class="fa fa-circle-o"></i> Add </a></li>
                <li class="active"><a href="<?php echo site_url();?>/location/location_list"><i class="fa fa-circle-o"></i> View</a></li>
              </ul>
            </li>
			<li class="treeview">
              <a href="">
                <i class="fa fa-dashboard"></i> <span>Routes</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="<?php echo site_url();?>/route/add"><i class="fa fa-circle-o"></i> Add</a></li>
				<li class="active"><a href="<?php echo site_url();?>/route/route_list"><i class="fa fa-circle-o"></i> View</a></li>
              </ul>
            </li>
			<li class="treeview">
              <a href="">
                <i class="fa fa-dashboard"></i> <span>Fare</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
				<li><a href="<?php echo site_url();?>/fare/add"><i class="fa fa-circle-o"></i> Add </a></li>
                <li class="active"><a href="<?php echo site_url();?>/fare/fare_list"><i class="fa fa-circle-o"></i> View</a></li>
				<li class="active"><a href="<?php echo site_url();?>/fare/import_form"><i class="fa fa-circle-o"></i> Import</a></li>
              </ul>
            </li>
			<li class="treeview">
              <a href="">
                <i class="fa fa-dashboard"></i> <span>Vehicle</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
				<li><a href="<?php echo site_url();?>/vehicle/add"><i class="fa fa-circle-o"></i> Add </a></li>
                <li class="active"><a href="<?php echo site_url();?>/vehicle/vehicle_list"><i class="fa fa-circle-o"></i> View</a></li>
				<li class="active"><a href="<?php echo site_url();?>/vehicle/assignment"><i class="fa fa-circle-o"></i> Assign</a></li>
              </ul>
            </li>
			<li class="treeview">
              <a href="">
                <i class="fa fa-dashboard"></i> <span>Transactions</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="<?php echo site_url();?>/fare/list_transaction"><i class="fa fa-circle-o"></i> View</a></li>
              </ul>
            </li>
			<?php } ?>
           </ul>
        </section>
        <!-- /.sidebar -->
      </aside>