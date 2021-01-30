<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>


<?php 
	class brand
	{
		private $db ;
		private $fm;

		
		public	function __construct()
		{
			$this->db = new Database(); // class Database trong file database
			$this->fm = new Format();
		}
		public function insert_brand($brandName)
		{
			// kiem tra hop le hay khong
			$brandName = $this->fm->validation($brandName);

			$brandName = mysqli_real_escape_string($this->db->link, $brandName);

			if(empty($brandName))
			{
				$alert = "<span class='error'> Brand must be not empty</span>";
				return $alert;
			}
			else {
				$query = "insert into tbl_brand(brandName) values('$brandName')";
				$result = $this->db->insert($query);
				if($result) {
					$alert = "<span class='success'>Insert Brand Successfully</span>";
					return $alert;
				} else {
					$alert = "<span class='error'>Insert brand not Success</span>";
					return $alert;
				}

			}
		}
		public function show_brand()
		{
			$query = "select * from tbl_brand order by brandid desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function getbrandbyId($id)
		{
			$query = "select * from tbl_brand where brandid = $id";
			$result = $this->db->select($query);
			return $result;
		}
		// update category
		public function update_brand($brandName, $id)
		{
			// kiem tra hop le hay khong
			$brandName = $this->fm->validation($brandName);

			$brandName = mysqli_real_escape_string($this->db->link, $brandName);
			$brandid = mysqli_real_escape_string($this->db->link, $id);

			if(empty($brandName))
			{
				$alert = "<span class='error'> Brand must be not empty</span>";
				return $alert;
			}
			else {
				$query = "update tbl_brand set brandName = '$brandName' where brandid = '$id'";
				$result = $this->db->update($query);
				if($result) {
					$alert = "<span class='success'>Brand update Successfully</span>";
					return $alert;
				} else {
					$alert = "<span class='error'>Brand update not Success</span>";
					return $alert;
				}

			}
		}
		// delete
		public function del_brand($id)
		{
			$query = "delete from tbl_brand where brandid = $id";
			$result = $this->db->delete($query);
			if($result) {
				$alert = "<span class='success'>Brand deleted Successfully</span>";
				return $alert;
			} else {
				$alert = "<span class='error'>Brand deleted not Success</span>";
				return $alert;
			}
	}
	}

?>