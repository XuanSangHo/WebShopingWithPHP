<?php 
	include "inc/header.php";
	// include "inc/slider.php";
?>
<?php
    if(!isset($_GET['catid']) || $_GET['catid'] == null){
       echo "<script>window.location = '404.php'</script>";
    }else {
        $id = $_GET['catid'];
    } 

    // lay ra nhung san pham dua vao catid
    // if ( $_SERVER['REQUEST_METHOD'] === "POST") {
    //     $catName = $_POST['catName']; 

    //     $updateCat = $cat->update_catgory($catName, $id);
    // }
?>
 <div class="main">
    <div class="content">
    	<div class="content_top">

    		<?php
	     		$name_cat = $cat->get_name_by_cat($id);
	     		if($name_cat){
	     			while($result_name = $name_cat->fetch_assoc()){
	     	?>
    		<div class="heading">
    		<h3>Category: <?= $result_name['catName'] ?> </h3>
    		</div>
    		<?php
				}
			}
			?>
    		<div class="clear"></div>
    	</div>
	     <div class="section group">
	     	<?php
	     		$productbycat = $cat->get_product_by_cat($id);
	     		if($productbycat){
	     			while($result = $productbycat->fetch_assoc()){
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

