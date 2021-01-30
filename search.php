<?php 
	include "inc/header.php";
	// include "inc/slider.php";
?>
<?php

    // lay ra nhung san pham dua vao catid
    
?>
 <div class="main">
    <div class="content">
    	<div class="content_top">

    		<?php
	     		if ( $_SERVER['REQUEST_METHOD'] === "POST") {
		        $tukhoa = $_POST['tukhoa']; 
		        $search_product = $product->search_product($tukhoa);
		    }
	     	?>
    		<div class="heading">
    		<h3>Từ khóa tìm kiếm: <?php echo $tukhoa; ?> </h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	     <div class="section group">
	     	<?php
	     		if($search_product){
	     			while($result = $search_product->fetch_assoc()){
	     	?>
			<div class="grid_1_of_4 images_1_of_4">
				 <a href="details.php?proid=<?= $result['productid'] ?>"><img src="admin/uploads/<?= $result['image'] ?>" alt="" width="200px;" height="120px;" /></a>
				 <h2><?= $result['productName'] ?> </h2>
				 <p><?= $result['product_desc'] ?></p>
				 <p><span class="price"><?= $result['price'] ?> VND</span></p>
			     <div class="button"><span><a href="details.php?proid=<?= $result['productid'] ?>" class="details">Details</a></span></div>
			</div>
			<?php
				}
			}
			else {
				echo "Categroy Not Available";
			}
			?>
		</div>
    </div>
 </div>
<?php include 'inc/footer.php' ; ?>

