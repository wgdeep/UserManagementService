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
        edate LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' OR
        etime LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' 

    )";
}


$sel = mysqli_query($con, "select count(*) as total from report");

$records = mysqli_fetch_assoc($sel);

$totalRecords = $records['total'];

$sel = mysqli_query($con, "select count(*) as allcount from report WHERE 1 " . $searchQuery);

$records = mysqli_fetch_assoc($sel);

$totalRecordwithFilter = $records['allcount'];

$empQuery = "SELECT * FROM report 
             WHERE 1 " . $searchQuery . " 
             ORDER BY id ASC, " . $columnName . " " . $columnSortOrder . " 
             LIMIT " . $row . "," . $rowperpage;

$empRecords = mysqli_query($con, $empQuery);

$data = array();

$currdate = date('Y-m-d');

while ($row = mysqli_fetch_assoc($empRecords)) {
  $data[] = array(
    "id" => '<input value="' . $row['id'] . '" name="id[]" class="checkbox" type="checkbox">',
    "title" => $row['title'],
    "image" => '<img src="./data/report/image/' . $row['image'] . '"  width="50" alt="">',
    "pdf" => '<a href="' . $row['pdf'] . '" target="_blank"><img src="./data/pdf_img/pdficon.webp" title="' . htmlspecialchars($row['pdf']) . '" alt="PDF" width="50" style="cursor: pointer;"></a>',
    "edate" => $row['edate'],
    "etime" => $row['etime'],
    "action" => '<a title="Delete" href="report.php?del_id=' . $row['id'] . '&img_Path=./data/report/image/' . $row['image'] . '"><i class="fa fa-trash-o"></i></a> <a title="Edit" href="update_report.php?edit_id=' . $row['id'] . '" style="margin-left: 10px;"><i class="fa fa-pencil"></i></a>',
 
  );
}

$response = array(

  "draw" => intval($draw),

  "iTotalRecords" => $totalRecordwithFilter,

  "iTotalDisplayRecords" => $totalRecords,

  "aaData" => $data

);

echo json_encode($response);
