<?php 
session_start();
require_once("../../includes/functions.php");
$employee_id = $_SESSION['employee_id'];
/**********************************************************************
*           Code For Image Upload with validation
**********************************************************************/

/*
    $image_name = $_FILES['product_image']['name'];
    $image_size = $_FILES['product_image']['size'];
    $temp_name = $_FILES['product_image']['tmp_name'];
    $file_type = $_FILES['product_image']['type'];

    $file_extension = strtolower(end(explode(".", $image_name)));
    echo "<br> Image Name : $image_name";
    echo "<br> Image Size : $image_name";
    echo "<br> Temp Name : $temp_name";
    echo "<br> Imaage Type : $file_type";
    echo "<br> file extension : $file_extension";

    $valid_extension = array("jpeg","jpg","png");

    if(in_array($file_extension ,$valid_extension) == false){
        $error_msg[] = "Image is not valid! Please Select a JPEG / PNG file!";
    }
    if($image_size > 1097152){
        $error_msg[] = "Image Size More Than 2MB not allowed! Please Enter less than 2MB file";
    }

    if(empty($error_msg)){
        move_uploaded_file($temp_name ,"../../../assets/products/images/".$employee_id.".".
                           $file_extension);
        echo "File SeccessFully Uploaded ".$image_name;
    }
    else{
        print_r($error_msg);
    }
*/
/**********************************************************************
*           End Of Code For Image Upload with validation
**********************************************************************/

if(isset($_POST['add_product'])){
    if(isset($_FILES['product_image'])){
        //checking if product image is selected or not
        $image_name = $_FILES['product_image']['name'];
        $temp_name = $_FILES['product_image']['tmp_name'];

        $file_extension = strtolower(end(explode(".", $image_name)));
    }
    $category_id = $_POST['category_id'];
    $supplier_id = $_POST['supplier_id'];
    $eoq = $_POST['eoq'];
    $product_name = $_POST['product_name'];
    $rate_of_sale = $_POST['rate_of_sale'];
    $additional_specification = $_POST['additional_specification'];
    
    $tablename = "product";
    $columns = "product_name , eoq , additional_specification , category_id , image_extension, created_by ";
    $values = "'$product_name' , $eoq , '$additional_specification' , $category_id , '$file_extension' , $employee_id";
    
    $result = insert($tablename , $columns , $values);
    //product has been added successfully
    
    //getting product_id which is automatically created by DBA
    $product_id = mysqli_insert_id($connection);
    
    $tablename = "product_sale_rate";
    $columns = "product_id , rate_of_sale , wef , created_by";
    $values = "$product_id , $rate_of_sale , now() , $employee_id";
    $result = insert($tablename , $columns , $values);
    
    
    $tablename = "product_supplier";
    $columns = "product_id , supplier_id";
    foreach ($supplier_id as $supplier_id){
        $values = "$product_id , $supplier_id";
        $result = insert($tablename , $columns , $values);
    }
    if(isset($_FILES['product_image'])){
        move_uploaded_file($temp_name ,"../../../assets/products/images/".$product_id.".".$file_extension);
    }
    
//    echo "ADDED";
    $_SESSION['status'] = PRODUCT_ADD_SUCCESS;
    
    $url = "http://".BASE_SERVER."/erp/pages/add-product.php";
    redirect($url);
    
}
?>