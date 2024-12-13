<?php

require_once("../include/config.php");

require_once("../include/library.php");





$draw = $_POST['draw'];

$row = $_POST['start'];

$rowperpage = $_POST['length'];

$columnIndex = $_POST['order'][0]['column'];

$columnName = $_POST['columns'][$columnIndex]['data'];

$columnSortOrder = 'desc';

$searchValue = $_POST['search']['value'];

$searchQuery = " ";


$searchQuery = "";
if ($searchValue != '') {
  $searchQuery = " AND (
        id LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' OR
        title1 LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' OR
        title2 LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' OR
        title3 LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' OR
        button_name LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' OR
        button_url LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' OR
        edate LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' OR
        etime LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' 

    )";
}


$sel = mysqli_query($con, "select count(*) as total from banner");

$records = mysqli_fetch_assoc($sel);

$totalRecords = $records['total'];

$sel = mysqli_query($con, "select count(*) as allcount from banner WHERE 1 " . $searchQuery);

$records = mysqli_fetch_assoc($sel);

$totalRecordwithFilter = $records['allcount'];

$empQuery = "SELECT * FROM banner 
             WHERE 1 " . $searchQuery . " 
             ORDER BY id ASC, " . $columnName . " " . $columnSortOrder . " 
             LIMIT " . $row . "," . $rowperpage;

$empRecords = mysqli_query($con, $empQuery);

$data = array();

$currdate = date('Y-m-d');


while ($row = mysqli_fetch_assoc($empRecords)) {
  if ($_SESSION[$update_banner] > 0) {
    $update = '<a title="Edit" href="update_banner.php?edit_id=' . $row['id'] . '" style="margin-left: 10px;"><i class="fa fa-pencil"></i></a>';
  }else{
    $update = '';
  }  
  
  if ($_SESSION[$delete_banner] > 0) {
    $delete = '<a title="Delete" href="banner.php?del_id=' . $row['id'] . '"><i class="fa fa-trash-o"></i></a>';
  }else{
    $delete = '';
  }

  $data[] = array(
    "id" => '<input value="' . $row['id'] . '" name="id[]" class="checkbox" type="checkbox">',
    "title1" => $row['title1'],
    "title2" => $row['title2'],
    "title3" => $row['title3'],
    "button_name" => $row['button_name'],
    "button_url" => $row['button_url'],
    "image" => '<img src="./data/banner/image/'.$row['image'].'" width="50" alt="'.$row['image'].'">',
    "edate" => $row['edate'],
    "etime" => $row['etime'],
    "action" => ''.$delete.' '.$update.'' ,

  );
}

$response = array(

  "draw" => intval($draw),

  "iTotalRecords" => $totalRecordwithFilter,

  "iTotalDisplayRecords" => $totalRecords,

  "aaData" => $data

);

echo json_encode($response);
