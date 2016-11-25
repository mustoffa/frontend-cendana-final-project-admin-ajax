<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
<!-- ______________________________________________________________________________ -->

    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?=base_url('assets')?>/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>Mustofa Halim</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
<!-- ______________________________________________________________________________ -->

    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
<!-- ______________________________________________________________________________ -->     

      <li class="treeview">
        <a href="<?=base_url('mahasiswa')?>">
          <i class="glyphicon glyphicon-education"></i>
          <span>Mahasiswa</span>
        </a>
      </li>
<!-- ______________________________________________________________________________ -->     

      <li class="treeview">
        <a href="<?=base_url('dosen')?>">
          <i class="glyphicon glyphicon-user"></i>
          <span>Dosen</span>
        </a>
      </li>
<!-- ______________________________________________________________________________ -->

      <li class="treeview">
        <a href="<?=base_url('nilai')?>">
          <i class="glyphicon glyphicon-th-list"></i>
          <span>Nilai</span>
        </a>
      </li>
<!-- ______________________________________________________________________________ -->

      <li class="treeview">
        <a href="<?=base_url('matkul')?>">
          <i class="glyphicon glyphicon-home"></i>
          <span>Kelas</span>
        </a>
      </li>
<!-- ______________________________________________________________________________ -->

      <li class="treeview">
        <a href="<?php echo base_url('auth/act_logout'); ?>">
          <i class="glyphicon glyphicon-off"></i>
          <span>Sign Out</span>
        </a>
      </li>
<!-- ______________________________________________________________________________ -->
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>