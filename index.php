
<?php 
	include "inc/header.php";
	include "inc/slider.php";
?>	

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Feature Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	      	<?php
	      		$product_feathered = $product->getproduct_feathered();
	      		if($product_feathered){
	      			while($result = $product_feathered->fetch_assoc()){
	      	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proid=<?= $result['productid'] ?>"><img src="admin/uploads/<?= $result['image'] ?>" alt="" style="width: 200px; height: 130px;"/></a>
					 <h2><?= $result['productName'] ?></h2>
					 <p><?= $fm->textShorten($result['product_desc'], 50) ?></p>
					 <p><span class="price"><?= $fm->format_currency($result['price']) ?> VND</span></p>
				     <div class="button"><span><a href="details.php?proid=<?= $result['productid'] ?>" class="details">Details</a></span></div>
				</div>
			
			<?php
					}
				}
			?>	
			</div>
			<div class="content_bottom">
	    		<div class="heading">
	    		<h3>New Products</h3>
	    		</div>
	    		<div class="clear"></div>
    		</div>
			<div class="section group">
				<?php
		      		$product_new = $product->getproduct_new();
		      		if($product_new){
	      				while($result_new = $product_new->fetch_assoc()){
	      		?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proid=<?= $result_new['productid'] ?>"><img src="admin/uploads/<?= $result_new['image'] ?>" alt="" style="width: 200px; height: 130px;"/></a>
					 <h2><?= $result_new['productName'] ?></h2>
					 <p><?= $fm->textShorten($result_new['product_desc'], 50) ?></p>
					 <p><span class="price"><?= $result_new['price'] ?> VND</span></p>
				     <div class="button"><span><a href="details.php?proid=<?= $result_new['productid'] ?>" class="details">Details</a></span></div>
				</div>
				
				<?php
					}
				}
				?>
			</div>
    </div>
 </div>
 <?php include 'inc/footer.php'; ?>
   
