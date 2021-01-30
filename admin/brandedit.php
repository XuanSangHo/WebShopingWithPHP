<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';  ?>
<?php
    $brand = new brand();
    if(!isset($_GET['brandid']) || $_GET['brandid'] == null){
       echo "<script>window.location = 'brandlist.php'</script>";
    }else {
        $id = $_GET['brandid'];
    } 
    if ( $_SERVER['REQUEST_METHOD'] === "POST") {
        $brandName = $_POST['brandName']; 

        $updateBrand = $brand->update_brand($brandName, $id);
    }

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Eidt New brand</h2>
                
               <div class="block copyblock"> 
                <?php 
                    $get_brand_name = $brand->getbrandbyId($id);
                    if( $get_brand_name){
                        while($result = $get_brand_name->fetch_assoc()){
                            
                ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="brandName" value="<?= $result['brandName'] ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php 
                                    if( isset($updateBrand)){
                                        echo $updateBrand;
                                    }
                                 ?>

                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" class="btn btn-warning" Value="Update" /> 
                            </td>
                            <td>
                                <a href="brandlist.php" class="btn btn-light">Back</a>
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