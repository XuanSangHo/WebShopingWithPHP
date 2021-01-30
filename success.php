<?php 
	include "inc/header.php";
	// include "inc/slider.php";
?>

<?php
	// if(!isset($_GET['orderid']) && $_GET['orderid'] == 'order'){
 //       $customer_id = Session::get('customer_id');
 //       $inserOrder = $ct->insertOrder($customer_id);
 //       $delCart = $ct->del_all_data_cart();
 //       header('Location:success.php');
 //    }
?>
<style>
	.box-left {
		width: 48%;
		border: 1px solid #666;

	}
	.box-right {
		width: 48%;
		border: 1px solid #666;

	}
</style>
 <div class="main">
    <div class="content">
    	<div class="section group alert-success text-center">
    		<h2 class=" form-control-lg ">Success Order</h2>
    		<?php
    			$customer_id = Session::get('customer_id');
    			$get_amount = $ct->getAmountPrice($customer_id);
    			$amount = 0;
    			if($get_amount){
    				
    				while($result = $get_amount->fetch_assoc()){
    					$price = $result['price'];
    					$amount += $price;
    				}
    			}

    		?>
    		<p>Total Price You Have Bought From My Website :
    			 <?php $vat = $amount * 0.1;
    			 	echo $total = $vat + $amount;
    			  ?> 
    		VND</p>
    		<p>We will contact as soon as possiable. Please see your order detail here
    			<a href="orderdetails.php">Click here</a>
    		</p>
 		</div>
 	</div>
 </div>
	<?php include 'inc/footer.php' ; ?>