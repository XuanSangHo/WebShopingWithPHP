<?php 
	include "inc/header.php";
	// include "inc/slider.php";
?>
<?php
	// kiem tra login chua
	$login_check = Session::get('customer_login');
	if($login_check == false){
		header('Location:login.php');
	}
?>


<?php
	// if(!isset($_GET['proid']) || $_GET['proid'] == null){
 //       echo "<script>window.location = '404.php'</script>";
 //    }else {
 //        $id = $_GET['proid'];
 //    }
 //    // isset cho nut submit
 //    if ( $_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit'])) {

 //    	// vao class cart
 //    	$quantity = $_POST['quantity'];
 //        $AddtoCart = $ct->add_to_cart($quantity, $id);
 //    }
?>
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="content_top">
    			<div class="heading">
    				<h3>Profile Customer</h3>
    			</div>
    			<div class="clear"></div>
    		</div>
    		<table class="tblone">
    			<?php
    				$id = Session::get('customer_id');
    				$get_customer = $cs->show_customer($id);
    				if($get_customer){
    					while($result = $get_customer->fetch_assoc()){
    			?>
    			<tr>
    				<td>Name</td>
    				<td>:</td>
    				<td><?= $result['name'] ?></td>
    			</tr>
    			<tr>
    				<td>City</td>
    				<td>:</td>
    				<td><?= $result['city'] ?></td>
    			</tr>
    			<tr>
    				<td>Phone</td>
    				<td>:</td>
    				<td><?= $result['phone'] ?></td>
    			</tr>
    			<!-- <tr>
    				<td>Country</td>
    				<td>:</td>
    				<td><?= $result['country'] ?></td>
    			</tr> -->
    			<tr>
    				<td>Zipcode</td>
    				<td>:</td>
    				<td><?= $result['zipcode'] ?></td>
    			</tr>
    			<tr>
    				<td>Email</td>
    				<td>:</td>
    				<td><?= $result['email'] ?></td>
    			</tr>
    			<tr>
    				<td>Address</td>
    				<td>:</td>
    				<td><?= $result['address'] ?></td>
    			</tr>
    			<tr>
    				<td colspan="3">
    					<a href="editprofile.php">Update Profile</a>
    				</td>
    			</tr>
    			<?php
    				}
    				}
    			?>
    		</table>
 		</div>
 	</div>
 </div>
	<?php include 'inc/footer.php' ; ?>