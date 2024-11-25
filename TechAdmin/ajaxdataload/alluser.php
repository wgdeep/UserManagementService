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
        id LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' OR
        user_name LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' OR
        role LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' OR
        status LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' 

    )";
}


$sel = mysqli_query($con, "select count(*) as total from user");

$records = mysqli_fetch_assoc($sel);

$totalRecords = $records['total'];

$sel = mysqli_query($con, "select count(*) as allcount from user WHERE 1 " . $searchQuery);

$records = mysqli_fetch_assoc($sel);

$totalRecordwithFilter = $records['allcount'];

$empQuery = "SELECT * FROM user 
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

  if ($_SESSION['Role'] == 'Super Admin' || $_SESSION['Role'] == 'Admin') {
    if ($_SESSION[$view_u] > 0) {
      $show = '<a class="btn btn-info" title="Show" href="show_user.php?show_id=' . $row['id'] . '">Show</a>';
    } else {
      $show = '';
    }
    if ($_SESSION[$update_u] > 0) {
      $edit = '<a class="btn btn-primary" title="Edit" href="update_user.php?edit_id=' . $row['id'] . '">Edit</a>';
    } else {
      $edit = '';
    }
    if ($_SESSION[$delete_u] > 0) {
      $remove = '<a class="btn btn-danger" title="Show" href="user_management.php?del_id=' . $row['id'] . '">Remove</a>';
    } else {
      $remove = '';
    }
  } else {
    if ($_SESSION['ID'] == $row['id']) {

      if ($_SESSION[$view_u] > 0) {
        $show = '<a class="btn btn-info" title="Show" href="show_user.php?show_id=' . $row['id'] . '">Show</a>';
      } else {
        $show = '';
      }
      if ($_SESSION[$update_u] > 0) {
        $edit = '<a class="btn btn-primary" title="Edit" href="update_user.php?edit_id=' . $row['id'] . '">Edit</a>';
      } else {
        $edit = '';
      }
      if ($_SESSION[$delete_u] > 0) {
        $remove = '<a class="btn btn-danger" title="Show" href="user_management.php?del_id=' . $row['id'] . '">Remove</a>';
      } else {
        $remove = '';
      }
    }else{
      $show = '';
      $edit = '';
      $remove = '';

    }
  }

  $data[] = array(
    "id" => '<input value="' . $row['id'] . '" name="id[]" class="checkbox" type="checkbox">',
    "name" => $row['user_name'],
    "role" => $row['role'],
    "status" => $status,
    "show" => $show,
    "edit" => $edit,
    "remove" => $remove,
  );
}

$response = array(

  "draw" => intval($draw),

  "iTotalRecords" => $totalRecordwithFilter,

  "iTotalDisplayRecords" => $totalRecords,

  "aaData" => $data

);

echo json_encode($response);
