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
        title LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' OR
        date LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' OR
        venue LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' OR
        media LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' OR
        edate LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' OR
        etime LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' 

    )";
}


$sel = mysqli_query($con, "select count(*) as total from publication");

$records = mysqli_fetch_assoc($sel);

$totalRecords = $records['total'];

$sel = mysqli_query($con, "select count(*) as allcount from publication WHERE 1 " . $searchQuery);

$records = mysqli_fetch_assoc($sel);

$totalRecordwithFilter = $records['allcount'];

$empQuery = "SELECT * FROM publication 
             WHERE 1 " . $searchQuery . " 
             ORDER BY display_order ASC, " . $columnName . " " . $columnSortOrder . " 
             LIMIT " . $row . "," . $rowperpage;

$empRecords = mysqli_query($con, $empQuery);

$data = array();

$currdate = date('Y-m-d');

while ($row = mysqli_fetch_assoc($empRecords)) {
  $data[] = array(
    "id" => '<input value="' . $row['id'] . '" name="id[]" class="checkbox" type="checkbox">',
    "title" => $row['title'],
    "date" => $row['date'],
    "venue" => $row['venue'],
    "media" => $row['media'],
    "msg" => $row['msg'],
    "banner" => '<img src="./data/publication/banner/' . $row['banner_image'] . '"  width="50" alt="">',
    "status" => $row['status'],
    "edate" => $row['edate'],
    "etime" => $row['etime'],
    "action" => '<a title="Delete" href="publication.php?del_id=' . $row['id'] . '&img_Path=./data/publication/banner/'. $row['banner_image'] .'"><i class="fa fa-trash-o"></i></a> <a title="Edit" href="update_publication.php?edit_id=' . $row['id'] . '" style="margin-left: 10px;"><i class="fa fa-pencil"></i></a>',
 
  );
}

$response = array(

  "draw" => intval($draw),

  "iTotalRecords" => $totalRecordwithFilter,

  "iTotalDisplayRecords" => $totalRecords,

  "aaData" => $data

);

echo json_encode($response);
