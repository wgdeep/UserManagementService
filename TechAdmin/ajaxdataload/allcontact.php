<?php
require_once("../include/config.php");
require_once ("../include/library.php");
## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value
## Search 
$searchQuery = " ";
if($searchValue != '')
{
   $searchQuery = " and ( 
        name like '%".$searchValue."%' or 
        mobile like '%".$searchValue."%' or
        email like '%".$searchValue."%' or
        subject like '%".$searchValue."%' or
        message like '%".$searchValue."%') ";
}
## Total number of records without filtering
$sel = mysqli_query($con,"select count(*) as total from contact");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['total'];
## Total number of record with filtering
$sel = mysqli_query($con,"select count(*) as allcount from contact WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];
## Fetch records

$empQuery = "select * from contact where 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
//echo $empQuery;die;
$empRecords = mysqli_query($con, $empQuery);
$data = array();
$currdate = date('Y-m-d');
while($row = mysqli_fetch_assoc($empRecords)) 
{     
   $data[] = array( 
      "name"=>$row['name'],
      "mobile"=>$row['mobile'],
      "email"=>$row['email'],
      "subject"=>$row['subject'],
      "message"=>$row['message'],
      "enquiry_view"=> '<a href="view_enquiry.php?enq_id='.$row['id'].'"><i class="fa fa-eye"></i></a> <a href="contact_list.php?del_id='.$row['id'].'"><i class="fa fa-trash-o"></i></a>'
   );
}
## Response
$response = array(
  "draw" => intval($draw),
  "iTotalRecords" => $totalRecordwithFilter,
  "iTotalDisplayRecords" => $totalRecords,
  "aaData" => $data
);
echo json_encode($response);
?>