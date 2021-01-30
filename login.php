
<?php 
	include "inc/header.php";
	// include "inc/slider.php";
?>
<?php
	$login_check = Session::get('customer_login');
	if($login_check){
		header('Location:order.php');
	}

?>


<!-- dang ki thanh vien -->
<?php
    if ( $_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit'])) {


        $insertCustomers = $cs->insert_customers($_POST);
    }

?>
<!-- đăng nhập -->
<?php
    if ( $_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['login'])) {


        $login_Customers = $cs->login_customers($_POST);
    }

?>

 <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>Existing Customers</h3>
        	<p>Sign in with the form below.</p>
        	<?php
    			if (isset($login_Customers)){
    				echo $login_Customers;
    			}
    		?>
        	<form action="" method="post" >
            	<input name="email" type="text" placeholder="Enter email" class="filed">
                <input name="password" type="password" placeholder="Enter password" class="filed">
             
                 <p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a>
                 </p>
                    <div class="buttons"><div>
                    	<input type="submit" class="grey" name="login" value="Sign In">
                    </div></div>
            </form>
         </div>


    	<div class="register_account">
    		<h3>Register New Account</h3>
    		<?php
    			if (isset($insertCustomers)){
    				echo $insertCustomers;
    			}
    		?>
    		<form action="" method="post">
	   			 <table>
	   				<tbody>
						<tr>
							<td>
								<div>
								<input type="text" name="name" placeholder="Enter Name ....." >
								</div>
								
								<div>
								   <input type="text" name="city" placeholder="Enter City ...">
								</div>
								
								<div>
									<input type="text" name="zipcode" placeholder="Enter Xip-Code ....">
								</div>
								<div>
									<input type="text" name="email" placeholder="Enter Email ...">
								</div>
			    			 </td>
			    			<td>
								<div>
									<input type="text" name="address" placeholder="Address ...">
								</div>
					    			<div>
									<select id="country" name="country" onchange="change_country(this.value)" class="frm-field required">
										<option value="null">Select a Country</option>   

										<option value="AF">Afghanistan</option>
					         		</select>
					 			</div>		        
		
			           			<div>
			          				<input type="text" name="phone" placeholder="Phone...">
			          			</div>
					  
								 <div>
									<input type="password" class="field" name="password" placeholder="Password.....">
								</div>
			    			</td>
		    			</tr> 
		    		</tbody>
				</table>
				 <div>
				 	<input class="btn btn-info" type="submit" name="submit" value="Create Account" >
				 </div>
			    	<p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
			    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php' ; ?>