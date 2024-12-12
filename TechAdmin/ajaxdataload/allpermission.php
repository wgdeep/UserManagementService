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

$searchQuery = "";
if ($searchValue != '') {
  $searchQuery = " AND (

        name LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%'
    
    )";
}


$sel = mysqli_query($con, "select count(*) as total from user");

$records = mysqli_fetch_assoc($sel);

$totalRecords = $records['total'];

$sel = mysqli_query($con, "select count(*) as allcount from permission WHERE 1 " . $searchQuery);

$records = mysqli_fetch_assoc($sel);

$totalRecordwithFilter = $records['allcount'];

$empQuery = "SELECT * FROM permission_name 
             WHERE 1 " . $searchQuery . " 
             ORDER BY id ASC, " . $columnName . " " . $columnSortOrder . " 
             LIMIT " . $row . "," . $rowperpage;

$empRecords = mysqli_query($con, $empQuery);

$data = array();

$currdate = date('Y-m-d');



while ($row = mysqli_fetch_assoc($empRecords)) {
  $data[] = array(
    "id" => '<input value="' . $row['id'] . '" name="id[]" class="checkbox" type="checkbox">',
    "name" => $row['user_show'],
    "show" => $row['show'],
    "add" => $row['add'],
    "edit" => $row['edit'],
    "remove" => $row['remove'],
    "action" => '<a title="Edit" href="update_permission.php?edit_id=' . $row['id'] . '" style="margin-left: 10px;"><i class="fa fa-pencil"></i></a>',
  );
}

$response = array(

  "draw" => intval($draw),

  "iTotalRecords" => $totalRecordwithFilter,

  "iTotalDisplayRecords" => $totalRecords,

  "aaData" => $data

);

echo json_encode($response);
