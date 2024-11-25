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
        etime LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' OR
        edate LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' 

    )";
}

$sel = mysqli_query($con, "select count(*) as total from event");

$records = mysqli_fetch_assoc($sel);

$totalRecords = $records['total'];

$sel = mysqli_query($con, "select count(*) as allcount from event WHERE 1 " . $searchQuery);

$records = mysqli_fetch_assoc($sel);

$totalRecordwithFilter = $records['allcount'];

$empQuery = "select * from event where 1" . $searchQuery . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;

$empRecords = mysqli_query($con, $empQuery);

$data = array();

$currdate = date('Y-m-d');

while ($row = mysqli_fetch_assoc($empRecords)) {

  $images = explode(',', $row['gallery_images']);
  $image_html = '';

  foreach ($images as $image_filename) {
    $image_html .= '<img src="./data/event/gallery/' . $image_filename . '" width="50" alt="" style="margin-right: 5px;">';
  }

  $data[] = array(
    "id" => '<input value="' . $row['id'] . '" name="id[]" class="checkbox" type="checkbox">',
    "title" => $row['title'],
    "date" => $row['date'],
    "venue" => $row['venue'],
    "banner" => '<img src="./data/event/banner/' . $row['banner_image'] . '"  width="50" alt="">',
    "gallery" => $image_html,
    "status" => $row['status'],
    "edate" => $row['edate'],
    "etime" => $row['etime'],
    "action" => '<a title="Delete" href="event.php?del_id=' . $row['id'] . '"><i class="fa fa-trash-o"></i></a> <a title="Edit" href="update_event.php?edit_id=' . $row['id'] . '" style="margin-left: 10px;"><i class="fa fa-pencil"></i></a>'
  );
}

$response = array(

  "draw" => intval($draw),

  "iTotalRecords" => $totalRecordwithFilter,

  "iTotalDisplayRecords" => $totalRecords,

  "aaData" => $data

);

echo json_encode($response);
