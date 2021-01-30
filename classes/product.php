<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>


<?php 
	class product
	{
		private $db ;
		private $fm;

		
		public	function __construct()
		{
			$this->db = new Database(); // class Database trong file database
			$this->fm = new Format();
		}
		public function insert_product($data, $files)
		{
			// kiem tra hop le hay khong\


			$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
			$brand = mysqli_real_escape_string($this->db->link, $data['brand']);
			$category = mysqli_real_escape_string($this->db->link, $data['category']);
			$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
			$price = mysqli_real_escape_string($this->db->link, $data['price']);
			$type = mysqli_real_escape_string($this->db->link, $data['type']);

			// upload image
			// kiem tra va lay image cho vao folder upload
			$permited = array('jpg', 'jpeg', 'png', 'gif');
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;
			// return file_name



			if($productName == "" || $brand == "" || $category == "" || $product_desc == "" || $price == "" || $type == "" || $file_name == "" )
			{
				$alert = "<span class='error'> Fiels must be not empty</span>";
				return $alert;
			}
			else {
				move_uploaded_file($file_temp, $uploaded_image);
				$query = "insert into tbl_product(productName,brandid,catid,product_desc,price,type,image) values('$productName', '$brand', '$category', '$product_desc', '$price', '$type', '$unique_image')";
				$result = $this->db->insert($query);
				if($result) {
					$alert = "<span class='success'>Insert Product Successfully</span>";
					return $alert;
				} else {
					$alert = "<span class='error'>Insert Product not Success</span>";
					return $alert;
				}

			}
		}
		public function show_product()
		{
			$query = "select tbl_product.*, tbl_category.catName, tbl_brand.brandName 
				from tbl_product inner join tbl_category on tbl_product.catid = tbl_category.catid 
						inner join tbl_brand on tbl_product.brandid = tbl_brand.brandid 
				order by tbl_product.productid desc";
			// $query = "select * from tbl_product order by productid desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function getproductbyId($id)
		{
			$query = "select * from tbl_product where productid = $id";
			$result = $this->db->select($query);
			return $result;
		}
		// update category
		public function update_product($data, $fliles, $id)
		{
			// kiem tra hop le hay khong


			$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
			$brand = mysqli_real_escape_string($this->db->link, $data['brand']);
			$category = mysqli_real_escape_string($this->db->link, $data['category']);
			$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
			$price = mysqli_real_escape_string($this->db->link, $data['price']);
			$type = mysqli_real_escape_string($this->db->link, $data['type']);

			// upload image
			// kiem tra va lay image cho vao folder upload
			$permited = array('jpg', 'jpeg', 'png', 'gif');
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;

			if($productName == "" || $brand == "" || $category == "" || $product_desc == "" || $price == "" || $type == "" )
			{
				$alert = "<span class='error'> Fiels must be not empty</span>";
				return $alert;
			}
			else {
				if(!empty($file_name)){
					//  neu chon anh
					if ($file_size > 10248) {
						$alert = "<span class='success'>Image Size should be less then 1MB</span>";
						return $alert;
					} elseif (in_array($file_ext, $permited) === false)
					{
						$alert = "<span class='success'>You can update only</span>";
						return $alert;
					}
					// update
					$query = "update tbl_product set 
						productName = '$productName',
						brandid = '$brand',
						catid = '$category',
						type = '$type',
						price = '$price',
						image = '$unique_image',
						product_desc = '$product_desc'
						where productid = '$id'";
				} else {
					// neu khong chon anh
					$query = "update tbl_product set 
						productName = '$productName',
						brandid = '$brand',
						catid = '$category',
						type = '$type',
						price = '$price',
						product_desc = '$product_desc'
						where productid = '$id'";
				}	
				move_uploaded_file($file_temp, $uploaded_image);
				$result = $this->db->update($query);
				if($result) {
					$alert = "<span class='success'>Product update Successfully</span>";
					return $alert;
				} else {
					$alert = "<span class='error'>Product update not Success</span>";
					return $alert;
				}

			}
		}
		// delete
		public function del_product($id)
		{
			$query = "delete from tbl_product where productid = $id";
			$result = $this->db->delete($query);
			if($result) {
				$alert = "<span class='success'>Product deleted Successfully</span>";
				return $alert;
			} else {
				$alert = "<span class='error'>Product deleted not Success</span>";
				return $alert;
			}
		}
		// END

		// start FrontEnd
		// hien thi product cho trang Home
		// san pham noi bat
		public function getproduct_feathered()
		{
			$query = "select * from tbl_product where type = '0'";
			$result = $this->db->select($query);
			return $result;	
		}
		// san pham new
		public function getproduct_new()
		{
			$query = "select * from tbl_product order by productid desc limit 4"; // gioi han 4  product
			$result = $this->db->select($query);
			return $result;	
		}
		// detail product
		public function get_details($id)
		{
			$query = "select tbl_product.*, tbl_category.catName, tbl_brand.brandName 
						from tbl_product inner join tbl_category on tbl_product.catid = tbl_category.catid 
						inner join tbl_brand on tbl_product.brandid = tbl_brand.brandid 
						where tbl_product.productid = '$id'"; 
			$result = $this->db->select($query);
			return $result;	
		}

		// lay san pham moi nhat cua DELL

		public function getLastestDell()
		{
			$query = "select * from tbl_product where brandid = '5' order by productid desc limit 1";
			$result = $this->db->select($query);
			return $result;	
		}
		public function getLastestApple()
		{
			$query = "select * from tbl_product where brandid = '3' order by productid desc limit 1";
			$result = $this->db->select($query);
			return $result;	
		}
		public function getLastestOppo()
		{
			$query = "select * from tbl_product where brandid = '4' order by productid desc limit 1";
			$result = $this->db->select($query);
			return $result;	
		}
		public function getLastestTesla()
		{
			$query = "select * from tbl_product where brandid = 6 order by productid desc limit 1";
			$result = $this->db->select($query);
			return $result;	
		}

		//  so sanh san pham
		public function insertCompare($productid, $customer_id)
		{
			$productid = mysqli_real_escape_string($this->db->link, $productid);
			$customer_id = mysqli_real_escape_string($this->db->link, $customer_id);

			$query = "select * from tbl_product where productid = '$productid'";
			$result = $this->db->select($query)->fetch_assoc();
			
			$productName = $result['productName'];
			$price = $result['price'];
			$image = $result['image'];
			
			

			// kiem tra san pham trung lap
			$check_compare = "select * from tbl_compare where productid = '$productid' and customer_id = '$customer_id'";
			$result_check = $this->db->select($check_compare);
			if($result_check){
				$msg = "<span class='error'>Product Already Added To Compare</span>";
				return $msg;
			} 
			else 
			{
				$query_insert = "insert into tbl_compare(productid,price,image,customer_id,productName) values('$productid', '$price', '$image', '$customer_id', '$productName')";
				$insert_compare = $this->db->insert($query_insert);
				if($insert_compare) {
					$alert = "<span class='success'>Added Compare Successfully</span>";
					return $alert;
				} else {
					$alert = "<span class='error'>Added Compare not Success</span>";
					return $alert;
				}
			}
		}

		// lay compare
		public function get_compare($customer_id)
		{
		    $query = "select * from tbl_compare where customer_id = '$customer_id' order by id desc ";
			$result = $this->db->select($query);
			return $result;
		}

		// insert Slider
		public function insert_slider($data, $files)
		{
		    $sliderName = mysqli_real_escape_string($this->db->link, $data['sliderName']);
			$type = mysqli_real_escape_string($this->db->link, $data['type']);

			// upload image
			// kiem tra va lay image cho vao folder upload
			$permited = array('jpg', 'jpeg', 'png', 'gif');
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;
			// return file_name



			if($sliderName == "" || $type == "" || $file_name == "" )
			{
				$alert = "<span class='error'> Fiels must be not empty</span>";
				return $alert;
			}
			else {
				move_uploaded_file($file_temp, $uploaded_image);
				$query = "insert into tbl_slider(sliderName,type,slider_image) values('$sliderName', '$type','$unique_image')";
				$result = $this->db->insert($query);
				if($result) {
					$alert = "<span class='success'>Insert Slider Successfully</span>";
					return $alert;
				} else {
					$alert = "<span class='error'>Insert Slider not Success</span>";
					return $alert;
				}

			}
		}

		// show silder
		public function show_slider() 
		{
			$query = "select * from tbl_slider where type='1' order by sliderid desc";
			$result = $this->db->select($query);
			return $result;
		}

		public function show_sliders() 
		{
			$query = "select * from tbl_slider order by sliderid desc";
			$result = $this->db->select($query);
			return $result;
		}

		// update type slider
		public function update_type_slider($id, $type)
		{
			$type = mysqli_real_escape_string($this->db->link, $type);
			$query = "update tbl_slider set type = '$type' where sliderid = '$id'";
			$result = $this->db->update($query);
			return $result;
		}

		// delete Slide
		public function del_slider($id)
		{
			$query = "delete from tbl_slider where sliderid = $id";
			$result = $this->db->delete($query);
			if($result) {
				$alert = "<span class='success'>Slider deleted Successfully</span>";
				return $alert;
			} else {
				$alert = "<span class='error'>Slider deleted not Success</span>";
				return $alert;
			}
		}

		// search product---------------------
		public function search_product($tukhoa)
		{
		    $tukhoa = $this->fm->validation($tukhoa); // kiem tra $tukhoa co hay chua
		    $query = "select * from tbl_product where productName like '%$tukhoa%'";
			$result = $this->db->select($query);
			return $result;

		}

	}

?>