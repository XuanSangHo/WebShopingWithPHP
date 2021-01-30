<?php 
	include "inc/header.php";
	// include "inc/slider.php";
?>

<?php
	if(isset($_GET['orderid']) && $_GET['orderid'] == 'order'){
       $customer_id = Session::get('customer_id');
       $insertOrder = $ct->insertOrder($customer_id);
       $delCart = $ct->del_all_data_cart();
       header('Location:success.php');
    }
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
<form action="" method="POST">
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="heading">
				<h3>Offline Paymenr</h3>
			</div>
			<div class="clear"></div>
			<div class="row container justify-content-between">
				<div class="box-left">
					<div class="cartpage">
		    	<?php
		    		if( isset($update_quatity_cart)){
		    			echo $update_quatity_cart;
		    		}
		    	?>
		    	<!-- delete cart -->
		    	<?php
		    		if( isset($delcart)){
		    			echo $delcart;
		    		}
		    	?>
				<table class="tblone">
					<tr>
						<th width="5%">ID</th>
						<th width="15%">Product Name</th>
						<th width="15%">Price</th>
						<th width="25%">Quantity</th>
						<th width="20%">Total Price</th>
					</tr>

					<?php
						$get_product_cart = $ct->get_product_cart();
						if($get_product_cart){
							// tong gia
							$subtotal = 0;
							$qty = 0;
							$i = 0;
							while($result = $get_product_cart->fetch_assoc()){
								$i++;
					?>
					<tr>
						<td><?= $i; ?></td>
						<td><?= $result['productName'] ?></td>
						<td>Tk. <?= $result['price'] ?> VND</td>
						<td>
							<?= $result['quantity'] ?>
						</td>
						<td>Tk. 
							<?php 
						 		$total = $result['price']*$result['quantity'];
						 		echo $total;
						 		$subtotal += $total;
						 		$qty = $qty + $result['quantity'];
						 	?>
						 	VND
						 </td>
					</tr>
					<?php
							}
						}
					?>
					
					
				</table>

				<!-- kiem tra gio hang trong -->
				<?php 
					$check_cart = $ct->check_cart();
					if($check_cart)
					{
				?>
				<table style="float:right;text-align:left;" width="40%">
					<tr>
						<th>Sub Total : </th>
						<td>TK. 
							<?php
								echo $subtotal;
							?>
						</td>
					</tr>
					<tr>
						<th>VAT : </th>
						<td>TK. 
							<?php
								$tax = $subtotal*(10/100);
								echo $tax;
							?>
						</td>
					</tr>
					<tr>
						<th>Grand Total :</th>
						<td>TK.
							<?php
								$vat = $subtotal+$tax;
								echo $vat;
								Session::set("sum", $vat);
								Session::set("qty", $qty);
							?>
						</td>
					</tr>
					<tr>
						<th>Total : Quantity</th>
						<td>
							<?php
								echo $qty ;
							?>
						</td>
					</tr>
			   </table>
			   <?php
			   		} 
			   		else {
			   			echo '<span style="font-size:20px; font-weight:bold">Your Cart is Empty ||
			   					<a href="index.php">Please Shopping Now</a>
			   				</span>';
			   		}
			   		//endif check_cart
			   ?>

			</div>
				</div>
				<div class="box-right">
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
			<center><a href="?orderid=order" class="btn btn-warning col-xl-2">Order</a></center>
 		</div>
 	</div>
 </div>
</form>
	<?php include 'inc/footer.php' ; ?>