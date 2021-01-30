<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">
				<!-- xem san pham moi nhat -->
				<?php
					$getLastestDell = $product->getLastestDell();
					if($getLastestDell){
						while($resultdell = $getLastestDell->fetch_assoc()){
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?= $resultdell['productid'] ?>"> <img src="admin/uploads/<?= $resultdell['image'] ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Dell</h2>
						<p><?= $resultdell['productName'] ?>.</p>
						<div class="button"><span><a href="details.php?proid=<?= $resultdell['productid'] ?>">Add to cart</a></span></div>
				   </div>
			   </div>	
			   <?php
			   	 }
			   	}
			   ?>	

			   <?php
					$getLastestApple = $product->getLastestApple();
					if($getLastestApple){
						while($resultapple = $getLastestApple->fetch_assoc()){
				?>	
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="details.php?proid=<?= $resultapple['productid'] ?>"><img src="admin/uploads/<?= $resultapple['image'] ?>" alt="" / ></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>Apple</h2>
						  <p><?= $resultapple['productName'] ?></p>
						  <div class="button"><span><a href="details.php?proid=<?= $resultapple['productid'] ?>">Add to cart</a></span></div>
					</div>
				</div>
				<?php
			   	 }
			   	}
			   ?>
			</div>
			<div class="section group">
				<?php
					$getLastestOppo = $product->getLastestOppo();
					if($getLastestOppo){
						while($resultoppo = $getLastestOppo->fetch_assoc()){
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?= $resultoppo['productid'] ?>"> <img src="admin/uploads/<?= $resultoppo['image'] ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Oppo</h2>
						<p><?= $resultoppo['productName'] ?></p>
						<div class="button"><span><a href="details.php?proid=<?= $resultoppo['productid'] ?>">Add to cart</a></span></div>
				   </div>
			   </div>
			   <?php
			   	 }
			   	}
			   ?>	

			   <?php
					$getLastestTesla = $product->getLastestTesla();
					if($getLastestTesla){
						while($resulttesla = $getLastestTesla->fetch_assoc()){
				?>		
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="details.php?proid=<?= $resulttesla['productid'] ?>"><img src="admin/uploads/<?= $resulttesla['image'] ?>" alt="" /></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>Tesla</h2>
						  <p><?= $resulttesla['productName'] ?></p>
						  <div class="button"><span><a href="details.php?proid=<?= $resulttesla['productid'] ?>">Add to cart</a></span></div>
					</div>
				</div>
				<?php
			   	 }
			   	}
			   ?>
			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<?php
							$get_slider = $product->show_slider();
							if($get_slider){
								while($result_slider = $get_slider->fetch_assoc()){
						?>
						<li>
							<img src="admin/uploads/<?= $result_slider['slider_image'] ?>" alt="<?= $result_slider['sliderName'] ?>"/>
						</li>
						<?php
								}
							}
						?>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>