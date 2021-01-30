<?php 
	include "inc/header.php";
	// include "inc/slider.php";
?>

<?php
	if(!isset($_GET['proid']) || $_GET['proid'] == null){
       echo "<script>window.location = '404.php'</script>";
    }else {
        $id = $_GET['proid'];
    }
    // isset cho nut submit
	$customer_id = Session::get('customer_id');
    if ( $_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['compare'])) {

    	
    	$productid = $_POST['productid'];
        $insertCompare = $product->insertCompare($productid, $customer_id);
    } 
    if ( $_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit'])) {

    	
    	$quantity = $_POST['quantity'];
        $AddtoCart = $ct->add_to_cart($quantity, $id);
    }
?>
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<?php
    			$get_product_detail = $product->get_details($id);
    			if($get_product_detail) {
    				while($result_details = $get_product_detail->fetch_assoc()){
    			
    		?>
			<div class="cont-desc span_1_of_2">				
				<div class="grid images_3_of_2">
					<img src="admin/uploads/<?= $result_details['image'] ?>" alt="" />
				</div>
				<div class="desc span_3_of_2">
					<h2><?= $result_details['productName'] ?></h2>
					<p><?= $result_details['product_desc'] ?></p>					
					<div class="price">
						<p>Price: <span><?= $result_details['price'] ?> VND</span></p>
						<p>Category: <span><?= $result_details['catName'] ?></span></p>
						<p>Brand:<span><?= $result_details['brandName'] ?></span></p>
					</div>
					<div class="add-cart">
						<form action="" method="post">
							<input type="number" class="buyfield" name="quantity" value="1" min="1" max="10" />
							<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
						</form>	
						<?php if(isset($AddtoCart)){
							echo '<span style="color:red;font-size:18px;">Product Already Added </span>';
						}
						?>
					</div>
					<div class="add-cart">
						<form action="" method="post">
							<!-- <a href="?wlist=<?= $result_details['productid'] ?>" class="buysubmit">Save to Wishlist</a> -->
							<!-- <a href="?compare=<?= $result_details['productid'] ?>" class="buysubmit">Compare Product</a> -->
							<input type="hidden" name="productid" value="<?= $result_details['productid'] ?>"/>

							<?php
							  	$login_check = Session::get('customer_login');
							  	if($login_check == false){
							  		echo '';
							  	}
							  	else{
							  		echo '<input type="submit" class="buysubmit" name="compare" value="Copare Product"/>'.' ';
							  		echo '<input type="submit" class="buysubmit" name="wishlist" value="Save to Wishlist"/>';
							  	}
							 ?>
							
							<?php
								if (isset($insertCompare)){
									echo $insertCompare;
								} 
							?>
						</form>
					</div>
				</div>
				<div class="product-desc">
				<h2>Product Details</h2>
					<p><?= $result_details['product_desc'] ?></p>
		   		 </div>
				
			</div>
			<?php
				}
			}
			?>
			<!-- category -->
			<div class="rightsidebar span_3_of_1">
				<h2>CATEGORIES</h2>
					<ul>
						<!-- hien thi danh muc san pham -->
						<?php
							$getall_category = $cat->show_category_frontend();
							if($getall_category){
								while($resultall = $getall_category->fetch_assoc()){
						?>
				      <li><a href="productbycat.php?catid=<?= $resultall['catid'] ?>"><?= $resultall['catName'] ?></a></li>
				      <?php
				      		}
				      	}
				      ?>
					</ul>
				</div>
 		</div>
 	</div>
 </div>
	<?php include 'inc/footer.php' ; ?>