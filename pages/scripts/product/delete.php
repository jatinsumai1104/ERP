<?php
    require_once("../../includes/functions.php");
    session_start();
    $employee_id=$_SESSION["employee_id"];
    if(isset($_POST["deleteBtn"])){
        $product_id = $_POST['product_id'];
        $tableName = product;
        $primaryKeyColumnName = "product_id";
        delete($tableName, $primaryKeyColumnName, $product_id, $employee_id);
        $tableName = "product_sale_rate";
        delete($tableName, $primaryKeyColumnName, $product_id, $employee_id);
//        $query = "UPDATE product SET deleted = 1, deleted_at=now(), deleted_by = $employee_id WHERE product_id =$product_id";
//        mysqli_query($connection,$query);
//        $query = "UPDATE product_sale_rate SET deleted = 1, deleted_at=now(), deleted_by = $employee_id WHERE product_id =$product_id";
//
//        mysqli_query($connection,$query);
        $_SESSION['status'] = PRODUCT_DELETE_SUCCESS;
        header("Location: http://".BASE_SERVER."/erp/pages/manage-product.php");
        exit();
}
?>