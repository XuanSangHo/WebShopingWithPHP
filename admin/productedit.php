<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>
<?php include '../classes/category.php';?>
<?php include '../classes/product.php';?>
<?php
    $pd = new product();
    if(!isset($_GET['productid']) || $_GET['productid'] == null){
       echo "<script>window.location = 'productlist.php'</script>";
    }else {
        $id = $_GET['productid'];
    }
    if ( $_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {

        $updateProduct = $pd->update_product($_POST, $_FILES, $id);
    }

?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Product</h2>
        <div class="block">
        <?php
            if(isset($updateProduct)){
                echo $updateProduct;
            }
        ?>
        <?php
            $get_product_by_id = $pd->getproductbyId($id);
            if($get_product_by_id){
                while($resultproduct = $get_product_by_id->fetch_assoc()){

        ?>            
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="productName" value="<?= $resultproduct['productName'] ?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="category">
                            <option>Select Category</option>

                            <?php
                            // doi include_one trong file brand.php va categroy.php
                                $cat = new category();
                                $catlist = $cat->show_category();

                                if ($catlist){
                                    while($result = $catlist->fetch_assoc()){

                            ?>
                            <!-- chon theo id -->
                                <option 

                                    <?php
                                        if($result['catid'] == $resultproduct['catid'])
                                        {
                                            echo 'selected';
                                        }
                                    ?>
                                    value="<?php echo $result['catid'] ?>"><?php echo $result['catName'] ?>
                            
                                </option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brand">
                            <option>Select Brand</option>
                            <?php
                            // doi include_one trong file brand.php va categroy.php
                                $brand = new brand();
                                $brandlist = $brand->show_brand();

                                if ($brandlist){
                                    while($result = $brandlist->fetch_assoc()){

                            ?>
                                <option 
                                    <?php
                                        if($result['brandid'] == $resultproduct['brandid'])
                                        {
                                            echo 'selected';
                                        }
                                    ?>
                                     value="<?= $result['brandid'] ?>"><?= $result['brandName'] ?>
                                </option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea name="product_desc" class="tinymce"><?= $resultproduct['product_desc'] ?></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="price" value="<?= $resultproduct['price'] ?>" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <input type="file" name="image" />

                        <img src="uploads/<?= $resultproduct['image'] ?>" style="width: 100px; align-items: center;padding-top: 10px">
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <!-- chon -->
                        <select id="select" name="type">
                            <option>Select Type</option>
                            <?php
                                if($resultproduct['type'] == 0){
                            ?>
                                <option selected value="0">Featured</option>
                                <option value="1">Non-Featured</option>
                            <?php
                            } else {
                                ?>
                                <option  value="0">Featured</option>
                                <option selected value="1">Non-Featured</option>
                            <?php
                             }
                            ?>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" class="btn btn-block" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
            <?php
                } }
            ?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


