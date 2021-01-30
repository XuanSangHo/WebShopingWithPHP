<?php 
	include "inc/header.php";
	// include "inc/slider.php";
?>
<?php
	// delete
	// if(isset($_GET['cartid'])){
 //        $cartid = $_GET['cartid'];
 //        $delcart = $ct->del_product_cart($cartid);
 //    } 

	// // isset cho nut submit
 //    if ( $_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {

 //    	$cartid = $_POST['cartid'];
 //    	// them quantity vao class cart
 //    	$quantity = $_POST['quantity'];
 //        $update_quatity_cart = $ct->update_quatity_cart($quantity, $cartid);
 //        // cau lenh update quantity > 0
 //        if($quantity <= 0) {
 //        	$delcart = $ct->del_product_cart($cartid);
 //        }
 //    }

?>
<!-- tu dong cap nhat gio hang khi THEM -->
<?php
	// if(!isset($_GET['id'])){
	// 	echo "<meta http-equiv='refresh' content='0;url=?id=live'>";
	// }	
?>

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
		    	<div class="heading">
					<h3>Compare Product</h3>
				</div>
				<div class="clear"></div>
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
						<th width="5%">ID Compare</th>
						<th width="20%">Product Name</th>
						<th width="20%">Image</th>
						<th width="15%">Price</th>
						<th width="15%">Action</th>

					</tr>

					<?php
						$customer_id = Session::get('customer_id');
						$get_compare = $product->get_compare($customer_id);
						if($get_compare){
							$i = 0;
							while($result = $get_compare->fetch_assoc()){
								$i++;
					?>
					<tr>
						<td><?= $i; ?></td>
						<td><?= $result['productName'] ?></td>
						<td><img src="admin/uploads/<?= $result['image'] ?>" style="width: 120px; height: 80px;" alt=""/></td>
						<td>Tk. <?= $result['price'] ?> VND</td>
						<td><a href="details.php?proid=<?= $result['productid'] ?>">View</a></td>
					</tr>
					<?php
							}
						}
					?>
					
					
				</table>
			</div>
			<div class="shopping">
				<div class="shopleft">
					<a href="index.php"> <img src="images/shop.png" alt="" /></a>
				</div>
			</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php' ; ?>