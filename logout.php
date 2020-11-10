<?php
session_start();
if (isset($_SESSION['usnm']) && isset($_SESSION['user_id'])) {
	# code
	unset($_SESSION['usnm']);
	unset($_SESSION['user_id']);
	if (!isset($_SESSION['usnm']) && !isset($_SESSION['user_id'])) {
		# code...
		header('location:index.php');
	}
}