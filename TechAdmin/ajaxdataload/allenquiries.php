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

if($searchValue != ''){

   $searchQuery = " and (
   
        enquiry.enquiry_name like '%".$searchValue."%' or 

        enquiry.enquiry_num like '%".$searchValue."%' or

        enquiry.enquiry_date like '%".$searchValue."%' or 

        enquiry.enquiry_status like '%".$searchValue."%' or

        enquiry.enquiry_status_User like '%".$searchValue."%' or 
        enquiry.enquiry_state like'%".$searchValue."%' or 
		marketing_agent.ma_name like '%".$searchValue."%') ";

}



## Total number of records without filtering

$sel = mysqli_query($con,"select count(*) as enquiry from enquiry left join marketing_agent on enquiry.dm_id = marketing_agent.ma_tbl_id");

$records = mysqli_fetch_assoc($sel);

$totalRecords = $records['enquiry'];



## Total number of record with filtering

$sel = mysqli_query($con,"select count(*) as allcount from enquiry left join marketing_agent on enquiry.dm_id = marketing_agent.ma_tbl_id WHERE 1 ".$searchQuery);

$records = mysqli_fetch_assoc($sel);

$totalRecordwithFilter = $records['allcount'];



## Fetch records

$empQuery = "select * from enquiry left join marketing_agent on enquiry.dm_id = marketing_agent.ma_tbl_id where 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
//echo $empQuery;die;

$empRecords = mysqli_query($con, $empQuery);

$data = array();


$currdate = date('Y-m-d');
while ($row = mysqli_fetch_assoc($empRecords)) {

	 $get_dm = MktAgentDtlsByID($con,$row['dm_id']);
	 $arrDate = explode(' ',$row['curtime']);
     
   $data[] = array( 

      "enquiry_name"=>$row['enquiry_name'],

      "enquiry_num"=>$row['enquiry_num'],

      "enquiry_subject"=>$row['enquiry_subject'],

      "enquiry_state"=>$row['enquiry_state'],

      "enquiry_loan_type"=>$row['enquiry_loan_type'],

      "enquiry_loan_amount"=>$row['enquiry_loan_amount'],

      "dm_id"=>$get_dm['ma_name'],

      "enquiry_date"=>$row['enquiry_date'],

      "enquiry_time"=>$arrDate[1],

      "enquiry_status_User"=>$row['enquiry_status_User'],

      "enquiry_status"=>$row['enquiry_status'],
      
      "call_back"=>$row['call_back'],

      "enquiry_view"=> '<a href="view_enquiry.php?enq_id='.$row['enquiry_id'].'"><i class="fa fa-eye"></i></a> <a href="delete_delivered_leeds.php?enq_id='.$row['enquiry_id'].'"><i class="fa fa-trash-o"></i></a>'
      
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



/* $getQur = mysqli_query($con,"select * from enquiry");

	 while($result = mysqli_fetch_assoc($getQur)){

	   $data[] = $result;

	 }

	 return $data; */



?>