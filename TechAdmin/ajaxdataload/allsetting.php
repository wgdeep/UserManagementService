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
        address1 LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' OR
        address2 LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' OR
        address3 LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' OR
        phone1 LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' OR
        phone2 LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' OR
        phone3 LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' OR
        email1 LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' OR
        email2 LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' OR
        email3 LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' OR
        fburl LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' OR
        igurl LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' OR
        yturl LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' OR
        liurl LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' OR
        pturl LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' OR
        edate LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' OR
        etime LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' 

    )";
}


$sel = mysqli_query($con, "select count(*) as total from setting");

$records = mysqli_fetch_assoc($sel);

$totalRecords = $records['total'];

$sel = mysqli_query($con, "select count(*) as allcount from setting WHERE 1 " . $searchQuery);

$records = mysqli_fetch_assoc($sel);

$totalRecordwithFilter = $records['allcount'];

$empQuery = "SELECT * FROM setting 
             WHERE 1 " . $searchQuery . " 
             ORDER BY id ASC, " . $columnName . " " . $columnSortOrder . " 
             LIMIT " . $row . "," . $rowperpage;

$empRecords = mysqli_query($con, $empQuery);

$data = array();

$currdate = date('Y-m-d');

while ($row = mysqli_fetch_assoc($empRecords)) {

    $decodedDescription = html_entity_decode($row['description']);

    // Remove HTML tags
    $cleanedDescription = strip_tags($decodedDescription);

    $data[] = array(
        "id" => '<input value="' . $row['id'] . '" name="id[]" class="checkbox" type="checkbox">',
        "address1" => $row['address1'],
        "address2" => $row['address2'],
        "address3" => $row['address3'],
        "phone1" => $row['phone1'],
        "phone2" => $row['phone2'],
        "phone3" => $row['phone3'],
        "email1" => $row['email1'],
        "email2" => $row['email2'],
        "email3" => $row['email3'],
        "fburl" => $row['fburl'],
        "igurl" => $row['igurl'],
        "yturl" => $row['yturl'],
        "liurl" => $row['liurl'],
        "pturl" => $row['pturl'],
        "logo" => '<img src="./data/setting/logo/' . $row['logo'] . '"  width="50" alt="logo">',
        "faviconLogo" => '<img src="./data/setting/favicon_logo/' . $row['faviconLogo'] . '"  width="50" alt="faviconLogo">',
        "status" => $row['status'],
        "edate" => $row['edate'],
        "etime" => $row['etime'],
        "action" => '<a title="Edit" href="update_setting.php?edit_id=' . $row['id'] . '" style="margin-left: 10px;"><i class="fa fa-pencil"></i></a>',
    );
}




$response = array(

    "draw" => intval($draw),

    "iTotalRecords" => $totalRecordwithFilter,

    "iTotalDisplayRecords" => $totalRecords,

    "aaData" => $data

);

echo json_encode($response);
