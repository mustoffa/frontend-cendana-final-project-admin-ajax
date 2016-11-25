<?php
	function succ_msg($value) 
	{
		$str = '<div class="alert alert-success" role="alert">Berhasil, ' .$value .'</div>';
		return $str;
	}

	function err_msg($value) 
	{
		$str = '<div class="alert alert-danger" role="alert">Warning, ' .$value .'</div>';
		return $str;
	}
?>