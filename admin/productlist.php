<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>
<?php include '../classes/category.php';?>
<?php include '../classes/product.php';?>
<?php include_once '../helpers/format.php';?>
<?php 	
	$pd = new product();
	$fm = new Format();
	if(isset($_GET['productid'])){
        $id = $_GET['productid'];
        $delpro = $pd->del_product($id);
    } 
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Product List</h2>
        <div class="block">  
        	<?php 
        		if(isset($delpro)){
        			echo $delpro;
        		}
        	?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Id</th>
					<th>Product Name</th>
					<th>Product Price</th>
					<th>Product Image</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Description</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>

				<?php
					$pblist = $pd->show_product();
					if ($pblist) {
						$i = 0;
						while($result = $pblist->fetch_assoc()){
							$i++;
				?>
				<tr class="odd gradeX">
					<td><?= $i; ?></td>
					<td><?= $result['productName'] ?></td>
					<td><?= $result['price'] ?></td>
					<td>
						<img src="uploads/<?= $result['image'] ?>" style="width: 100px; align-items: center;padding-top: 10px">
							
					</td>
					<td><?= $result['catName'] ?></td>
					<td><?= $result['brandName'] ?></td>
					<td><?= $fm->textShorten($result['product_desc'], 50); ?></td>
					<td class="center">
						<?php
							if($result['type']==0){
								echo 'Feathered';
							} else {
								echo 'Non-Feathered';
							}
						?>
					</td>
					<td><a href="productedit.php?productid=<?= $result['productid'] ?>">Edit</a> || <a href="?productid=<?= $result['productid'] ?>">Delete</a></td>
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
