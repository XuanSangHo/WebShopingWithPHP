<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>


<?php 
	class category
	{
		private $db ;
		private $fm;

		
		public	function __construct()
		{
			$this->db = new Database(); // class Database trong file database
			$this->fm = new Format();
		}
		public function insert_catgory($catName)
		{
			// kiem tra hop le hay khong
			$catName = $this->fm->validation($catName);

			$catName = mysqli_real_escape_string($this->db->link, $catName);

			if(empty($catName))
			{
				$alert = "<span class='error'> Category must be not empty</span>";
				return $alert;
			}
			else {
				$query = "insert into tbl_category(catName) values('$catName')";
				$result = $this->db->insert($query);
				if($result) {
					$alert = "<span class='success'>Insert category Successfully</span>";
					return $alert;
				} else {
					$alert = "<span class='error'>Insert Category not Success</span>";
					return $alert;
				}

			}
		}
		public function show_category()
		{
			$query = "select * from tbl_category order by catid desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function getcatbyId($id)
		{
			$query = "select * from tbl_category where catid = $id";
			$result = $this->db->select($query);
			return $result;
		}
		// update category
		public function update_catgory($catName, $id)
		{
			// kiem tra hop le hay khong
			$catName = $this->fm->validation($catName);

			$catName = mysqli_real_escape_string($this->db->link, $catName);
			$catid = mysqli_real_escape_string($this->db->link, $id);

			if(empty($catName))
			{
				$alert = "<span class='error'> Category must be not empty</span>";
				return $alert;
			}
			else {
				$query = "update tbl_category set catName = '$catName' where catid = '$id'";
				$result = $this->db->update($query);
				if($result) {
					$alert = "<span class='success'>category update Successfully</span>";
					return $alert;
				} else {
					$alert = "<span class='error'>category update not Success</span>";
					return $alert;
				}

			}
		}
		// delete
		public function del_catgory($id)
		{
			$query = "delete from tbl_category where catid = $id";
			$result = $this->db->delete($query);
			if($result) {
				$alert = "<span class='success'>category deleted Successfully</span>";
				return $alert;
			} else {
				$alert = "<span class='error'>category deleted not Success</span>";
				return $alert;
			}
		}

		// show category trong FrontEnd
		public function show_category_frontend()
		{
			$query = "select * from tbl_category order by catid desc";
			$result = $this->db->select($query);
			return $result;
		}

		// hien thi san pham theo Catid category
		public function get_product_by_cat($id)
		{
			$query = "select * from tbl_product where catid = '$id' order by catid desc limit 8 ";
			$result = $this->db->select($query);
			return $result;
		}
		// hien thi ten category theo Catid category
		public function get_name_by_cat($id)
		{
			$query = "select * from tbl_category where catid = '$id'";
			$result = $this->db->select($query);
			return $result;
		}
	}

?>