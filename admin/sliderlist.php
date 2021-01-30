<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/product.php';?>

<!-- update type slider on/off -->
<?php
	$product = new product();
	if (isset($_GET['type_slider']) && isset($_GET['type'])){
		$id = $_GET['type_slider'];
		$type = $_GET['type'];
		$update_type_slider = $product->update_type_slider($id, $type);
	}
	if (isset($_GET['slider_del'])){
		$id = $_GET['slider_del'];
		$del_slider = $product->del_slider($id, $type);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider List</h2>
        <?php
        	if(isset($del_slider)){
        		echo $del_slider;
        	} 
        ?>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>No.</th>
					<th>Slider Title</th>
					<th>Slider Image</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$product = new product();
					$get_slider = $product->show_sliders();
					if($get_slider){
						$i = 0;
						while($result_slider = $get_slider->fetch_assoc()){
							$i++;
				?>
				<tr class="odd gradeX">
					<td><?= $i; ?></td>
					<td><?= $result_slider['sliderName'] ?></td>
					<td><img src="uploads/<?= $result_slider['slider_image'] ?>" height="80px" width="120px"/></td>	
					<td>
						<?php 
							if($result_slider['type']){
						?>
							<a href="?type_slider=<?= $result_slider['sliderid'] ?>&type=0">On</a> 
						<?php
							}else {
						?>
							<a href="?type_slider=<?= $result_slider['sliderid'] ?>&type=1">Off</a> 
						<?php
							}
						?>	
					</td>
					<td> 
						<a href="?slider_del=<?= $result_slider['sliderid'] ?>" onclick="return confirm('Are you sure to Delete!');" >Delete</a> 
					</td>
				</tr>	
				<?php
						}
					}
				?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
