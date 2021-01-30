<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>


<?php 
	class customer
	{
		private $db ;
		private $fm;

		
		public	function __construct()
		{
			$this->db = new Database(); // class Database trong file database
			$this->fm = new Format();
		}
		// them nguoi dung
		public function insert_customers($data)
		{
			$name = mysqli_real_escape_string($this->db->link, $data['name']);
			$city = mysqli_real_escape_string($this->db->link, $data['city']);
			$zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
			$email = mysqli_real_escape_string($this->db->link, $data['email']);
			$address = mysqli_real_escape_string($this->db->link, $data['address']);
			$country = mysqli_real_escape_string($this->db->link, $data['country']);
			$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
			$password = mysqli_real_escape_string($this->db->link, md5($data['password']));

			if($name == "" || $city == "" || $zipcode == "" || $email == "" || $address == "" || $country == "" || $phone == "" || $password == "")
			{
				$alert = '<span class="error"> Fiels must be not empty</span>';
				return $alert;
			}
			else
			{
				$check_email = "select * from tbl_customer where email = '$email' limit 1";
				$result_check = $this->db->select($check_email);
				$check_user = "select * from tbl_customer where name = '$name' limit 1";
				$result_check_user = $this->db->select($check_user);
				if($result_check)
				{
					$alert = "<span class='error'> Email already Existed</span>";
					return $alert;
				}
				else
				{
					// if ($result_check_user) {
					// 	$alert = "<span class='error'> Username already Existed</span>";
					// 	return $alert;
					// } 
					// else
					// {
						$query = "insert into tbl_customer(name,city,zipcode,email,address,country,phone,password) values('$name', '$city', '$zipcode', '$email', '$address', '$country', '$phone', '$password')";
						$result = $this->db->insert($query);
						if($result) {
							$alert = "<span class='success'>Insert Customer Successfully</span>";
							return $alert;
						} else {
							$alert = "<span class='error'>Insert Customer not Success</span>";
							return $alert;
						}
					// }
					
				}
			}
		}
		// ham login customer
		public function login_customers($data)
		{
			$email = mysqli_real_escape_string($this->db->link, $data['email']);
			$password = mysqli_real_escape_string($this->db->link, md5($data['password']));
			if($email == "" || $password == "")
			{
				$alert = '<span class="error"> Email and Password must be not empty</span>';
				return $alert;
			}
			else
			{
				// lay email
				$check_login = "select * from tbl_customer where email = '$email' and password = '$password' ";
				$result_check = $this->db->select($check_login);
				if($result_check  == true)
				{
					// Gửi các giá trị name, id, về trang header để import
					$value = $result_check->fetch_assoc();
					Session::set('customer_login', true);
					Session::set('customer_id', $value['id']);
					Session::set('customer_name', $value['name']);
					header('Location:order.php');
				}
				else
				{
					$alert = "<span class='error'>Email of Password doesn't match</span>";
					return $alert;
				}
			}
		}

		// show customer
		public function show_customer($id)
		{
			$query = "select * from tbl_customer where id = '$id' limit 1";
			$result = $this->db->select($query);
			return $result;
		}

		// update customer
		public function update_customers($data, $id)
		{
			$name = mysqli_real_escape_string($this->db->link, $data['name']);
			$zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
			$email = mysqli_real_escape_string($this->db->link, $data['email']);
			$address = mysqli_real_escape_string($this->db->link, $data['address']);
			$phone = mysqli_real_escape_string($this->db->link, $data['phone']);

			if($name == "" || $zipcode == "" ||  $email == "" || $address == "" || $phone == "" )
			{
				$alert = '<span class="error"> Fiels must be not empty</span>';
				return $alert;
			}
			else
			{
				$query = "update tbl_customer set 
							name = '$name',
							zipcode = '$zipcode', 
							email = '$email', 
							address = '$address', 
							phone = '$phone' 
							where id = '$id'";
				$result = $this->db->update($query);
				if($result) {
					$alert = "<span class='success'> Customer Update Successfully</span>";
					return $alert;
				} else {
					$alert = "<span class='error'> Customer Updated not Success</span>";
					return $alert;
				}
				
			}
		}
	}

?>