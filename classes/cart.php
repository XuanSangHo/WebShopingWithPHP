<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>


<?php 
	class cart
	{
		private $db ;
		private $fm;

		
		public	function __construct()
		{
			$this->db = new Database(); // class Database trong file database
			$this->fm = new Format();
		}
		// them cart
		public function add_to_cart($quantity, $id)
		{
			// kiem tra validation
			$quantity = $this->fm->validation($quantity);
			$quantity = mysqli_real_escape_string($this->db->link, $quantity);
			$id = mysqli_real_escape_string($this->db->link, $id);
			$sid = session_id();

			$query = "select * from tbl_product where productid = '$id'";
			$result = $this->db->select($query)->fetch_assoc();

			$image = $result['image'];
			$price = $result['price'];
			$productName = $result['productName'];

			// kiem tra san pham trung lap
			$check_cart = "select * from tbl_cart where productid = '$id' and sid = '$sid'";
			$result_check = $this->db->select($check_cart);
			if($result_check){
				$msg = "Product Already Added";
				return $msg;
			} 
			else 
			{
				$query_insert = "insert into tbl_cart(productid,quantity,sid,image,price,productName) values('$id', '$quantity', '$sid', '$image', '$price', '$productName')";
				$insert_cart = $this->db->insert($query_insert);
				if($insert_cart) {
					header("Location:cart.php" );
				} else {
					header("Location:404.php" );
				}
			}
		}
		// lay cart
		public function get_product_cart()
		{
			$sid = session_id();
			$query = "select * from tbl_cart where sid = '$sid'";
			$result = $this->db->select($query);
			return $result;
		}
		// update quatity cart
		public function update_quatity_cart($quantity, $cartid)
		{
			$quantity = mysqli_real_escape_string($this->db->link, $quantity);
			$cartid = mysqli_real_escape_string($this->db->link, $cartid);

			$query = "update tbl_cart set 
						quantity = '$quantity'
						where cartid = '$cartid'";
			$result = $this->db->update($query);
			if($result)
			{
				header("Location:cart.php");
			}
			else
			{
				$msg = '<span style="color:red;font-size:18px;">Product Quantity Updated Not Successfully</span>';
				return $msg;
			}
		}

		// delete cart
		public function del_product_cart($cartid)
		{
			$cartid = mysqli_real_escape_string($this->db->link, $cartid);
			$query = "delete from tbl_cart where cartid = '$cartid'";
			$result = $this->db->delete($query);
			if($result)
			{
				header("Location:cart.php");
			}
			else
			{
				$msg = '<span style="color:red;font-size:18px;">Product Deleted Not Successfully</span>';
				return $msg;
			}
		}

		// kiem tra gioi hang co tien k
		public function check_cart()
		{
			$sid = session_id();
			$query = "select * from tbl_cart where sid = '$sid'";
			$result = $this->db->select($query);
			return $result;
		}

		// kiem tra co order k
		public function check_order($customer_id)
		{
			$query = "select * from tbl_order where customer_id = '$customer_id'";
			$result = $this->db->select($query);
			return $result;
		}

		// xu ly gio hang khi login
		public function del_all_data_cart()
		{
			$sid = session_id();
			$query = "delete  from tbl_cart where sid = '$sid'";
			$result = $this->db->delete($query);
			return $result;
		}

		// xoa compare khi logout
		public function del_compare($customer_id)
		{
			$query = "delete  from tbl_compare where customer_id = '$customer_id'";
			$result = $this->db->delete($query);
			return $result;
		}

		// insert Order
		public function insertOrder($customer_id)
		{
			$sid = session_id();
			// lay cac du lieu de insert vao table Order
			$query = "select *  from tbl_cart where sid = '$sid'";
			$get_product = $this->db->select($query);
			if ($get_product)
			{
				while($result = $get_product->fetch_assoc())
				{
					$productid = $result['productid'];
					$productName = $result['productName'];
					$quantity = $result['quantity'];
					$price = $result['price'] * $quantity; // total 
					$image = $result['image'];
					$customer_id = $customer_id;

					$query_order = "insert into tbl_order(productid,productName,customer_id,quantity,price,image) values('$productid', '$productName','$customer_id', '$quantity', '$price', '$image')";
					$insert_order = $this->db->insert($query_order);
					
				}
			}
		}

		// tong tien thanh toan
		public function getAmountPrice($customer_id)
		{
			$query = "select price  from tbl_order where customer_id = '$customer_id'"; // lay ngay hom nay-------------------
			$get_price = $this->db->select($query);
			return $get_price;
		}

		// xem cac san pham da mua
		public function get_cart_ordered($customer_id)
		{
			$query = "select *  from tbl_order where customer_id = '$customer_id'"; // lay ngay hom nay-------------------
			$get_price = $this->db->select($query);
			return $get_price;
		}


		// lay cart show ra trang Admin
		public function get_inbox_cart()
		{
			$query = "select *  from tbl_order order by date_order"; 
			$get_inbox_cart = $this->db->select($query);
			return $get_inbox_cart;
		}

		// xu ly don hang
		public function shifted($id, $time, $price)
		{
		    $id = mysqli_real_escape_string($this->db->link, $id);
			$time = mysqli_real_escape_string($this->db->link, $time);
			$price = mysqli_real_escape_string($this->db->link, $price);

			$query = "update tbl_order set 
						status = '1'
						where id = '$id' and date_order = '$time' and price = '$price'";
			$result = $this->db->update($query);
			if($result)
			{
				$msg = '<span style="color:green;font-size:18px;">Updated Order Successfully</span>';
				return $msg;
			}
			else
			{
				$msg = '<span style="color:red;font-size:18px;">Updated Order Not Successfully</span>';
				return $msg;
			}
		}

		// delete don hang
		public function del_shifted($id, $time, $price)
		{
		    $id = mysqli_real_escape_string($this->db->link, $id);
			$time = mysqli_real_escape_string($this->db->link, $time);
			$price = mysqli_real_escape_string($this->db->link, $price);

			$query = "delete from tbl_order
						where id = '$id' and date_order = '$time' and price = '$price'";
			$result = $this->db->delete($query);
			if($result)
			{
				$msg = '<span style="color:green;font-size:18px;">Deleted Order Successfully</span>';
				return $msg;
			}
			else
			{
				$msg = '<span style="color:red;font-size:18px;">Deleted Order Not Successfully</span>';
				return $msg;
			}
		}

		// da nhan hang
		public function shifted_comfirm($id, $time, $price)
		{
			$id = mysqli_real_escape_string($this->db->link, $id);
			$time = mysqli_real_escape_string($this->db->link, $time);
			$price = mysqli_real_escape_string($this->db->link, $price);

			$query = "update tbl_order set 
						status = '2'
						where id = '$id' and date_order = '$time' and price = '$price'";
			$result = $this->db->update($query);
			if($result)
			{
				$msg = '<span style="color:green;font-size:18px;">Updated Order Successfully</span>';
				return $msg;
			}
			else
			{
				$msg = '<span style="color:red;font-size:18px;">Updated Order Not Successfully</span>';
				return $msg;
			}
		}
	}

?>