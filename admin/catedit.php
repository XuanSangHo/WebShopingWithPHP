<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';  ?>
<?php
    $cat = new category();
    if(!isset($_GET['catid']) || $_GET['catid'] == null){
       echo "<script>window.location = 'catlist.php'</script>";
    }else {
        $id = $_GET['catid'];
    } 
    if ( $_SERVER['REQUEST_METHOD'] === "POST") {
        $catName = $_POST['catName']; 

        $updateCat = $cat->update_catgory($catName, $id);
    }

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Eidt New Category</h2>
                
               <div class="block copyblock"> 
                <?php 
                    $get_cat_name = $cat->getcatbyId($id);
                    if( $get_cat_name){
                        while($result = $get_cat_name->fetch_assoc()){
                            
                ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="catName" value="<?= $result['catName'] ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php 
                                    if( isset($updateCat)){
                                        echo $updateCat;
                                    }
                                 ?>

                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" class="btn btn-warning" Value="Update" /> 
                            </td>
                            <td>
                                <a href="catlist.php" class="btn btn-light">Back</a>
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