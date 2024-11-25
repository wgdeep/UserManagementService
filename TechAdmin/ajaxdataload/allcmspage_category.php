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
        page_title like '%".$searchValue."%' or 
        page_name like '%".$searchValue."%') ";
}
## Total number of records without filtering
$sel = mysqli_query($con,"select count(*) as total from content_page where parent_id ='0'");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['total'];
## Total number of record with filtering
$sel = mysqli_query($con,"select count(*) as allcount from content_page  where parent_id ='0' ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];
## Fetch records

$empQuery = "select * from content_page  where parent_id ='0' ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
//echo $empQuery;die;
$empRecords = mysqli_query($con, $empQuery);
$data = array();
$currdate = date('Y-m-d');
while($row = mysqli_fetch_assoc($empRecords)) 
{    
   $ids=array(1);
   if(!in_array($row['page_id'],$ids))
   { 
     $morepage = '<a href="manage_subpages.php?parent_id='.$row['page_id'].'">Manage Second Level Pages Name</a>';
   }
   else
   {
     $morepage = "No Sub Pages...";
   } 
   if(isset($row['page_status']) && $row['page_status']==1)
   {
     $status = '<img border="0" src="'.$wwwroot.'/images/visible.gif">';
   }
   else
   {
     $status = '<img src="'.$wwwroot.'/images/invisible.gif" border="0">';
   }
   $data[] = array( 
      "page_id"=>'<input value="'.$row['page_id'].'" name="enqId[]" class="checkbox" type="checkbox">',
      "page_title"=>$row['page_title'],
	  "page_name"=>$row['page_name'],
      "page_url"=>$row['page_url'],
	  "morepage"=>$morepage,
	  "page_order"=>$row['page_order'],
      "status"=>$status,
	  //"created_date"=>$row['created_date'],
      "action"=> '<a href="add_cmspage_category.php?first_edit_id='.$row['page_id'].'" title="Edit"><i class="fa fa-edit"></i></a> <a title="Delete" href="cms_page.php?first_del_id='.$row['page_id'].'"><i class="fa fa-trash-o"></i></a>'
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