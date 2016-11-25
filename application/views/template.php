<!DOCTYPE html>
<html>
<head>

<!-- META -->
<?php echo @$_meta; ?>

<!-- CSS -->
<?php echo @$_css; ?>

<script src="<?=base_url('assets/plugins/jQuery/jquery-2.2.3.min.js')?>"></script>
<script src="<?=base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
  
</head>

<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">

<!-- HEADER -->
<?php echo @$_header; ?>

<!-- SIDEBAR LEFT -->
<?php echo @$_sidebar; ?>

<?php
$this->user_login = $this->session->userdata('user_session');
	if (count($this->user_login) == 0) {
		$this->session->set_flashdata('alert_msg', err_msg('Silahkan login terlebih dahulu'));
		redirect('auth');
	}
?>

<!-- CONTENT -->
<?php echo @$_body; ?>
  
<!-- FOOTER -->
<?php echo @$_footer; ?>

<!-- SIDEBAR RIGHT CONTROL -->
<?php echo @$_sidebar_right_control; ?>
  
</div><!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<?php echo @$_jquery; ?>

</body>
</html>