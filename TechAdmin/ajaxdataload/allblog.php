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
        title like '%".$searchValue."%' or 
        status like '%".$searchValue."%') ";
}
## Total number of records without filtering
$sel = mysqli_query($con,"select count(*) as total from blog");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['total'];
## Total number of record with filtering
$sel = mysqli_query($con,"select count(*) as allcount from blog WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];
## Fetch records

$empQuery = "select * from blog where 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
//echo $empQuery;die;
$empRecords = mysqli_query($con, $empQuery);
$data = array();
$currdate = date('Y-m-d');
while($row = mysqli_fetch_assoc($empRecords)) 
{     
   if(isset($row['status']) && $row['status']==1)
   {
     $status = '<img border="0" src="'.$wwwroot.'/images/visible.gif">';
   }
   else
   {
     $status = '<img src="'.$wwwroot.'/images/invisible.gif" border="0">';
   }
   if(isset($row['image']) && $row['image']!='')
   {
     $image = '<img width="50" height="50" src="'.$wwwroot.'/upload/blog/'.$row['image'].'">';
   }
   else
   {
     $image = '<img width="50" height="50" src="'.$wwwroot.'/images/default.png">';
   }
   $data[] = array( 
      "id"=>'<input value="'.$row['id'].'" name="enqId[]" class="checkbox" type="checkbox">',
      "title"=>$row['title'],
      "image"=>$image,
	  "date"=>$row['created_date'],
      "status"=>$status,
      "action"=> '<a href="add_blog.php?edit_id='.$row['id'].'" title="Edit"><i class="fa fa-edit"></i></a> <a title="Delete" href="blog_list.php?del_id='.$row['id'].'"><i class="fa fa-trash-o"></i></a>'
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