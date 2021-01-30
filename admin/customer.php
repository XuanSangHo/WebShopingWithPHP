<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../classes/customer.php');
    include_once ($filepath.'/../helpers/format.php');
?>
<?php
    $cs = new customer();
    if(!isset($_GET['customerid']) || $_GET['customerid'] == null){
       echo "<script>window.location = 'inbox.php'</script>";
    }else {
        $id = $_GET['customerid'];
    } 
    
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Eidt New Category</h2>
                
               <div class="block copyblock"> 
                <?php 
                    $get_customer = $cs->show_customer($id);
                    if( $get_customer){
                        while($result = $get_customer->fetch_assoc()){
                            
                ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td>
                                <!-- cho xem, k sua -->
                                <input type="text" readonly="readonly" name="name" value="<?= $result['name'] ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>:</td>
                            <td>
                                <!-- cho xem, k sua -->
                                <input type="text" readonly="readonly" name="name" value="<?= $result['phone'] ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>:</td>
                            <td>
                                <!-- cho xem, k sua -->
                                <input type="text" readonly="readonly" name="name" value="<?= $result['city'] ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td>:</td>
                            <td>
                                <!-- cho xem, k sua -->
                                <input type="text" readonly="readonly" name="name" value="<?= $result['country'] ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Zipcode</td>
                            <td>:</td>
                            <td>
                                <!-- cho xem, k sua -->
                                <input type="text" readonly="readonly" name="name" value="<?= $result['zipcode'] ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td>
                                <!-- cho xem, k sua -->
                                <input type="text" readonly="readonly" name="name" value="<?= $result['email'] ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>:</td>
                            <td>
                                <!-- cho xem, k sua -->
                                <input type="text" readonly="readonly" name="name" value="<?= $result['address'] ?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <!-- <td>
                                <input type="submit" name="submit" class="btn btn-warning" Value="Update" /> 
                            </td> -->
                            <td>
                                <a href="inbox.php" class="btn btn-light">Back</a>
                            </td>
                        </tr>
                    </table>
                </form>
                <?php
                    }
                }
                ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>