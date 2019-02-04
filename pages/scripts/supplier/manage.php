<?php
//THis is the php code for managing the tables in the manage-supplier page

require_once("../../includes/db.php");
$columns = array("supplier_name","supplier_address","supplier_email","supplier_contact","supplier.gst_no");
$query = "SELECT * FROM supplier HAVING supplier.deleted=0";

if(isset($_POST["search"]["value"])){
   $query .= " AND (supplier.supplier_name like '%".$_POST["search"]["value"]."%' OR supplier.supplier_contact like '%".$_POST['search']['value']."%'OR supplier.supplier_email like '%".$_POST['search']['value']."%'OR supplier.gst_no like '%".$_POST['search']['value']."%')";
   
}

if(isset($_POST["order"])){
   $query .= " ORDER BY ".$columns[$_POST['order']['0']['column']]." ".$_POST['order']['0']['dir'];
   
}
else{
   $query .= " ORDER BY ".$columns[0]." ASC";
}

$query1="";

if($_POST["length"]!=-1){
   $query1 = ' LIMIT '.$_POST['start'].','.$_POST['length'];
   
}

$number_filtered_row = mysqli_num_rows(mysqli_query($connection,$query));

$result = mysqli_query($connection,$query.$query1);

$data = array();

while($row = mysqli_fetch_assoc($result)){
   $sub_array =array();
   $sub_array[]= $row["supplier_name"];
   $sub_array[]= $row["supplier_address"];
   $sub_array[]= $row["supplier_email"];
   $sub_array[]= $row["supplier_contact"];
   $sub_array[] = $row["gst_no"];
   $sub_array[] = "<button class='edit fa fa-pencil btn blue' id='".$row['supplier_id']."' data-toggle='modal' data-target='#editModal'> EDIT</button>";
   $sub_array[] = "<button class='delete fa fa-trash btn red' id='".$row["supplier_id"]."' data-toggle='modal' data-target='#deleteModal'> DELETE</button>";
   //I may have to add some more columns!!!!
   
   $data[] = $sub_array;
}

function get_all_data($connection){
   $query ="SELECT * FROM supplier";
   return (mysqli_num_rows(mysqli_query($connection,$query)));
}


$output = array(
   "draw" => intval($_POST['draw']),
   "recordsTotal"  => get_all_data($connection),
   "recordsFiltered" => $number_filtered_row,
   "data" => $data,
);

echo json_encode($output);
?>

