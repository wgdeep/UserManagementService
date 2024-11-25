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

        role_name LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' OR
        status LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' 

    )";
}


$sel = mysqli_query($con, "select count(*) as total from user");

$records = mysqli_fetch_assoc($sel);

$totalRecords = $records['total'];

$sel = mysqli_query($con, "select count(*) as allcount from role WHERE 1 " . $searchQuery);

$records = mysqli_fetch_assoc($sel);

$totalRecordwithFilter = $records['allcount'];

$empQuery = "SELECT * FROM role 
             WHERE 1 " . $searchQuery . " 
             ORDER BY id ASC, " . $columnName . " " . $columnSortOrder . " 
             LIMIT " . $row . "," . $rowperpage;

$empRecords = mysqli_query($con, $empQuery);

$data = array();

$currdate = date('Y-m-d');



while ($row = mysqli_fetch_assoc($empRecords)) {
  if ($row['status'] > 0) {
    $status = 'Active';
  } else {
    $status = 'Inactive';
  }

  $data[] = array(
    "id" => '<input value="' . $row['id'] . '" name="id[]" class="checkbox" type="checkbox">',
    "role_name" => $row['role_name'],
    "status" => $status,
    "show" => '<a class="btn btn-info" title="Show" href="showuser.php?show_id=' . $row['id'] . '">Show</a>',
    "edit" => '<a class="btn btn-primary" title="Edit" href="edituser.php?edit_id=' . $row['id'] . '">Edit</a>',
    "remove" => '<a class="btn btn-danger" title="Remove" href="role_management.php?del_id=' . $row['id'] . '">Remove</a>',
  );
}

$response = array(

  "draw" => intval($draw),

  "iTotalRecords" => $totalRecordwithFilter,

  "iTotalDisplayRecords" => $totalRecords,

  "aaData" => $data

);

echo json_encode($response);
