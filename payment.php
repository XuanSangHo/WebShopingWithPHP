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
    				<h3>Payment Method</h3>
    			</div>
    			<div class="clear"></div>
                <div class="card col-8 container bg-secondary">
                    <h3 class="text-center">Choose your method payment</h3>
                    <div class='row align-items-center justify-content-md-around'>
                        <a class="alert-success form-control-lg" href="offlinepayment.php">Offline Payment</a>
                        <a class="alert-success form-control-lg" href="onlinepayment.php">Online Payment</a>
                    </div>
                    <a href="cart.php" class="text-center btn btn-dark">Previous</a>
                </div>
    		</div>
    		
 		</div>
 	</div>
 </div>
	<?php include 'inc/footer.php' ; ?>