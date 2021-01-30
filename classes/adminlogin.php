<?php
	$filepath = realpath(dirname(__FILE__));
	include ($filepath.'/../lib/session.php');
	Session::checkLogin();
	include ($filepath.'/../lib/database.php');
	include ($filepath.'/../helpers/format.php');
?>


<?php 
	class adminlogin
	{
		private $db ;
		private $fm;

		
		public	function __construct()
		{
			$this->db = new Database(); // class Database trong file database
			$this->fm = new Format();
		}
		public function login_admin($adminUser, $adminPass)
		{
			// kiem tra hop le hay khong
			$adminUser = $this->fm->validation($adminUser);
			$adminPass = $this->fm->validation($adminPass);

			$adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
			$adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

			if(empty($adminUser) || empty($adminPass))
			{
				$alert = " User and Pass must be not empty";
				return $alert;
			}
			else {
				$query = "select * from tbl_admin where adminUser = '$adminUser' and adminPass = '$adminPass' limit 1";
				$result = $this->db->select($query);
				if ($result != false) {
					$value = $result->fetch_assoc();
					Session::set('login', true);

					Session::set('adminId',$value['adminId']);
					Session::set('adminUser',$value['adminUser']);
					Session::set('adminName',$value['adminName']);
					header('Location:index.php'); // trang quay ve trang index.php
				} else {
					$alert = " User and Pass not match";
					return $alert;
				}
			}

		}
	}

?>