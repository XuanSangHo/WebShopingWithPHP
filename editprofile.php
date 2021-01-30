<?php 
	include "inc/header.php";
	// include "inc/slider.php";
?>
<?php
	// kiem tra login chua
	$login_check = Session::get('customer_login');
	if($login_check == false){
		header('Location:login.php');
	}
?>


<?php
	// if(!isset($_GET['proid']) || $_GET['proid'] == null){
 //       echo "<script>window.location = '404.php'</script>";
 //    }else {
 //        $id = $_GET['proid'];
 //    }
    // isset cho nut submit

    $id = Session::get('customer_id');
    if ( $_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['save'])) {

    	
        $UpdateCustomer = $cs->update_customers($_POST, $id);
    }
?>
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="content_top">
    			<div class="heading">
    				<h3>Update Profile Customer</h3>
                    <?php
                        if(isset($UpdateCustomer)){
                            echo $UpdateCustomer;
                        }
                    ?>
    			</div>
    			<div class="clear"></div>
    		</div>
            <form action="" method="post">
        		<table class="tblone">
        			<?php
        				$id = Session::get('customer_id');
        				$get_customer = $cs->show_customer($id);
        				if($get_customer){
        					while($result = $get_customer->fetch_assoc()){
        			?>
        			<tr>
        				<td>Name</td>
        				<td>:</td>
                        <td>
                            <input type="text" name="name" value="<?= $result['name'] ?>">
                        </td>
        			</tr>
        			<!-- <tr>
        				<td>City</td>
        				<td>:</td>
                        <td>
                            <input type="text" name="city" value="<?= $result['city'] ?>">
                        </td>
        			</tr> -->
        			<tr>
        				<td>Phone</td>
        				<td>:</td>
                        <td>
                            <input type="text" name="phone" value="<?= $result['phone'] ?>">
                        </td>
        			</tr>
        			<!-- <tr>
        				<td>Country</td>
        				<td>:</td>
        				<td><?= $result['country'] ?></td>
        			</tr> -->
        			<tr>
        				<td>Zipcode</td>
        				<td>:</td>
                        <td>
                            <input type="text" name="zipcode" value="<?= $result['zipcode'] ?>">
                        </td>
        			</tr>
        			<tr>
        				<td>Email</td>
        				<td>:</td>
                        <td>
                            <input type="text" name="email" value="<?= $result['email'] ?>">
                        </td>
        			</tr>
        			<tr>
        				<td>Address</td>
        				<td>:</td>
                        <td>
                            <input type="text" name="address" value="<?= $result['address'] ?>">
                        </td>
        			</tr>
        			<tr>
        				<td colspan="3">
        					<input type="submit" name="save" value="Save" class="btn btn-info">
        				</td>
        			</tr>
        			<?php
        				}
        				}
        			?>
        		</table>
            </form>
 		</div>
 	</div>
 </div>
	<?php include 'inc/footer.php' ; ?>