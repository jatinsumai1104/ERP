<?php
 require_once("../../includes/db.php");
session_start();
if(isset($_POST["product_id"])){
   $product_id = $_POST['product_id'];
   $query = "SELECT product.product_id, product.product_name, product.eoq, product_sale_rate.rate_of_sale, product.additional_specification,GROUP_CONCAT( DISTINCT supplier.supplier_name, ',') as supplier_name, category.category_name, product.deleted FROM product,supplier,category,product_sale_rate,product_supplier WHERE product.category_id = category.category_id AND product.product_id = product_supplier.product_id AND product_supplier.supplier_id = supplier.supplier_id AND product.product_id = product_sale_rate.product_id GROUP BY product.product_id HAVING product.deleted=0";
   $result = mysqli_query($connection,$query);
   $row = mysqli_fetch_assoc($result);
   echo json_encode($row);
}
?>