<?php 
	include "inc/header.php";
	// include "inc/slider.php";
?>
<?php
	// delete
	if(isset($_GET['cartid'])){
        $cartid = $_GET['cartid'];
        $delcart = $ct->del_product_cart($cartid);
    } 

	// isset cho nut submit
    if ( $_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {

    	$cartid = $_POST['cartid'];
    	// them quantity vao class cart
    	$quantity = $_POST['quantity'];
        $update_quatity_cart = $ct->update_quatity_cart($quantity, $cartid);
        // cau lenh update quantity > 0
        if($quantity <= 0) {
        	$delcart = $ct->del_product_cart($cartid);
        }
    }

?>
<!-- tu dong cap nhat gio hang khi THEM -->
<?php
	if(!isset($_GET['id'])){
		echo "<meta http-equiv='refresh' content='0;url=?id=live'>";
	}	
?>

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
		    	<h2>Your Cart</h2>
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
						<th width="20%">Product Name</th>
						<th width="10%">Image</th>
						<th width="15%">Price</th>
						<th width="25%">Quantity</th>
						<th width="20%">Total Price</th>
						<th width="10%">Action</th>
					</tr>

					<?php
						$get_product_cart = $ct->get_product_cart();
						if($get_product_cart){
							// tong gia
							$subtotal = 0;
							$qty = 0;
							while($result = $get_product_cart->fetch_assoc()){
					?>
					<tr>
						<td><?= $result['productName'] ?></td>
						<td><img src="admin/uploads/<?= $result['image'] ?>" alt=""/></td>
						<td>Tk. <?= $result['price'] ?> VND</td>
						<td>
							<form action="" method="post">
								<input type="hidden" name="cartid" value="<?= $result['cartid'] ?>">
								<input type="number" name="quantity" value="<?= $result['quantity'] ?>" min ="0" max="10"/>
								<input type="submit" name="submit" value="Update"/>
							</form>
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
						<td><a onClick="return confirm('Are you sure delete ?')"  href="?cartid=<?= $result['cartid'] ?>">Delete</a></td>
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
			<div class="shopping">
				<div class="shopleft">
					<a href="index.php"> <img src="images/shop.png" alt="" /></a>
				</div>
				<div class="shopright">
					<a href="payment.php"> <img src="images/check.png" alt="" /></a>
				</div>
			</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php' ; ?>