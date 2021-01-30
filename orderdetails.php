<?php 
	include "inc/header.php";
	// include "inc/slider.php";
?>

<?php
	// if(isset($_GET['orderid']) && $_GET['orderid'] == 'order'){
 //       $customer_id = Session::get('customer_id');
 //       $insertOrder = $ct->insertOrder($customer_id);
 //       $delCart = $ct->del_all_data_cart();
 //       header('Location:success.php');
 //    }
?>
<style>
	.box-left {
		width: 108%;
		border: 1px solid #666;

	}
</style>

<?php
	$login_check = Session::get('customer_id');
	if($login_check == false){
		header('Location:login.php');
	}
	// da nhan hang
	$ct = new cart();
	if(isset($_GET['confirmid'])){
       $id = $_GET['confirmid'];
       $time = $_GET['time'];
       $price = $_GET['price'];
       $shifted_comfirm = $ct->shifted_comfirm($id, $time, $price);
    }
?>
<form action="" method="POST">
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="heading">
				<h3>Your Details Ordered</h3>
			</div>
			<div class="clear"></div>
			<div class="row container justify-content-between">
				<div class="box-left">
					<div class="cartpage">
		    	
						<table class="tblone">
							<tr>
								<th width="5%">ID</th>
								<th width="15%">Product Name</th>
								<th width="15%">Image</th>
								<th width="10%">Price</th>
								<th width="10%">Quantity</th>
								<th width="10%">Date</th>
								<th width="15%">Status</th>
								<th width="10%">Action</th>
							</tr>

							<?php
								$customer_id = Session::get('customer_id');
								$get_cart_ordered = $ct->get_cart_ordered($customer_id);
								if($get_cart_ordered){;
									$qty = 0;
									$i = 0;
									while($result = $get_cart_ordered->fetch_assoc()){
										$i++;
							?>
							<tr>
								<td><?=  $i; ?></td>
								<td><?= $result['productName'] ?></td>
								<td><img src="admin/uploads/<?= $result['image'] ?>"></td>
								<td>Tk. <?= $result['price'] ?> VND</td>
								<td>
									<?= $result['quantity'] ?>
								</td>
								<td><?= $fm->formatDate($result['date_order'])  ?></td>
								<td>
									<?php
										if($result['status'] == 0)
										{
											echo "Pending";
										}
										elseif($result['status'] == 1)
										{
									?>
										<a href="?confirmid=<?= $result['id'] ?>&price=<?= $result['price'] ?>&time=<?= $result['date_order'] ?>">Shifted</a>
									<?php
										}else {
											echo "Confirmed";
										}
									?>
								</td>
									<?php
										if($result['status'] != 2)
										{
									?>
										<td><?php echo "N/A" ; ?></td>
									<?php
										}else{
									?>	
										<td>Confirmed</td>
									<?php
										}
									?>
								
							</tr>
							<?php
									}
								}
							?>
						</table>
					</div>
				</div>
				
			</div>
			<center><a href="?orderid=order" class="btn btn-warning col-xl-2">Order</a></center>
 		</div>
 	</div>
 </div>
</form>
	<?php include 'inc/footer.php' ; ?>