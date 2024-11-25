<?php
require_once("../include/config.php");
require_once ("../include/library.php");
## Read value
$draw            = $_POST['draw'];
$row             = $_POST['start'];
$catid           = $_POST['catid'];
if(isset($catid) && $catid!='')
{
 $str = "cat_id='".$catid."'";
}
else
{
 $str = 1;
}
$rowperpage      = $_POST['length']; // Rows display per page
$columnIndex     = $_POST['order'][0]['column']; // Column index
$columnName      = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value
## Search 
$searchQuery = " ";
if($searchValue != '')
{
   $searchQuery = " and ( title like '%".$searchValue."%') ";
}
## Total number of records without filtering
$sel = mysqli_query($con,"select count(*) as total from gallery where $str");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['total'];
## Total number of record with filtering
$sel = mysqli_query($con,"select count(*) as allcount from gallery WHERE $str ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];
## Fetch records

$empQuery = "select * from gallery where $str ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
//echo $empQuery;die;
$empRecords = mysqli_query($con, $empQuery);
$data = array();
$currdate = date('Y-m-d');
while($row = mysqli_fetch_assoc($empRecords)) 
{
   if(isset($row['image']) && $row['image']!='')
   {
     $image = '<img width="50" height="50" src="'.$wwwroot.'/upload/gallery/'.$row['image'].'">';
   }
   else
   {
     $image = '<img width="50" height="50" src="'.$wwwroot.'/images/default.png">';
   }
   if(isset($catid) && $catid!='')
   {
	 $data[] = array( 
      "id"=>'<input value="'.$row['id'].'" name="enqId[]" class="checkbox" type="checkbox">',
      "level_name"=>$row['level_name'],
      "image"=>$image,
	  "date"=>date('d M,Y',$row['created_date']),
      "action"=> '<a href="edit_gallery.php?cat_id='.$catid.'&edit_id='.$row['id'].'" title="Edit"><i class="fa fa-edit"></i></a> <a title="Delete" href="gallery_list.php?cat_id='.$catid.'&del_id='.$row['id'].'"><i class="fa fa-trash-o"></i></a>'
   );
   }
   else
   {
		 $data[] = array( 
		  "id"=>'<input value="'.$row['id'].'" name="enqId[]" class="checkbox" type="checkbox">',
		  "level_name"=>$row['level_name'],
		  "image"=>$image,
		  "date"=>date('d M,Y',$row['created_date']),
		  "action"=> '<a href="edit_gallery.php?edit_id='.$row['id'].'" title="Edit"><i class="fa fa-edit"></i></a> <a title="Delete" href="gallery_list.php?del_id='.$row['id'].'"><i class="fa fa-trash-o"></i></a>'
	   );
   }
   
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