<?php

// echo ""; die;

ini_set('memory_limit', '-1');

function AdminLogin($con, $req, &$outputMsg)
{

  $sqlLogin = "select * from admin where admin_email='" . trim($req['email']) . "' and admin_password='" . trim(md5($req['password'])) . "'";



  $resLogin = mysqli_query($con, $sqlLogin);



  $rowLogin = mysqli_num_rows($resLogin);



  if ($rowLogin > 0) {



    $dataLogin = mysqli_fetch_object($resLogin);



    $_SESSION['adminID'] = $dataLogin->admin_id;



    $_SESSION['adminName'] = $dataLogin->admin_name;



    $_SESSION['adminEmail'] = $dataLogin->admin_email;



    header("location:publication.php");



    exit();



    return true;
  } else {



    $outputMsg = 'Invalid Username or Password';



    return false;
  }
}

function Login($con, $req, &$outputMsg)
{

  $sqlLogin = "select * from user where user_email='" . trim($req['email']) . "' and user_password='" . trim(md5($req['password'])) . "'";



  $resLogin = mysqli_query($con, $sqlLogin);



  $rowLogin = mysqli_num_rows($resLogin);


  if ($rowLogin > 0) {
    $sqlActiveUser = "update user set status = '1' where user_email='" . trim($req['email']) . "' and user_password='" . trim(md5($req['password'])) . "'";

    $resUserActive = mysqli_query($con, $sqlActiveUser);
  }


  if ($rowLogin > 0) {



    $dataLogin = mysqli_fetch_object($resLogin);



    $_SESSION['ID'] = $dataLogin->id;



    $_SESSION['Name'] = $dataLogin->user_name;



    $_SESSION['Email'] = $dataLogin->user_email;

    $_SESSION['Status'] = $dataLogin->status;

    $_SESSION['Role'] = $dataLogin->role;


    $sqlRole = "select * from role where role_name='" . trim($dataLogin->role) . "'";



    $resRole = mysqli_query($con, $sqlRole);

    $rowRole = mysqli_num_rows($resRole);


    if ($rowRole > 0) {
      $dataRole = mysqli_fetch_object($resRole);

      $_SESSION['user_show'] = $dataRole->user_show;

      $_SESSION['user_edit'] = $dataRole->user_edit;

      $_SESSION['user_remove'] = $dataRole->user_remove;

      $_SESSION['user_add'] = $dataRole->user_add;

      $_SESSION['role_show'] = $dataRole->role_show;

      $_SESSION['role_edit'] = $dataRole->role_edit;

      $_SESSION['role_remove'] = $dataRole->role_remove;

      $_SESSION['role_add'] = $dataRole->role_add;
    } else {
      $outputMsg = 'Role not Found!!';

      return false;
    }




    header("location:publication.php");



    exit();



    return true;
  } else {



    $outputMsg = 'Invalid Username or Password';



    return false;
  }
}

function Register($con, $req, &$outputMsg)
{

  $name = trim($req['user_name']);
  $email = trim($req['user_email']);
  $password = trim(md5($req['password']));
  $edate = date('Y-m-d');
  $etime = date('H:i:s');


  $sqlLogin = "insert into user set user_name='" . $name . "', user_email='" . $email . "', user_password='" . $password . "', image='null', edate='" . $edate . "', etime='" . $etime . "'";

  $resLogin = mysqli_query($con, $sqlLogin);

  header("location:index.php?act=reg");
  exit();
  return true;
}

function downloadPdf($pdf)
{
  header("location: $pdf");
}

function addEvent($con, $req, &$outputMsg)
{

  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  $title    = trim($req['title']);
  $url    = clean(trim($req['title']));
  $date   = trim($req['date']);
  $venue   = trim($req['venue']);
  $description = trim($req['description']);
  $curtime = date('H:i:s');
  $curdate = date('Y-m-d');

  $banner_image = '';

  if (isset($_FILES['attached_banner']['name']) && $_FILES['attached_banner']['error'] == 0) {
    $original_filename = $_FILES['attached_banner']['name'];
    $file_ext = substr($original_filename, strripos($original_filename, '.')); // Get extension

    if (($file_ext != '.png') && ($file_ext != '.jpg') && ($file_ext != '.jpeg') && ($file_ext != '.gif')) {
      $outputMsg = "Only jpg, jpeg, png, and gif format images are allowed to upload.";
      return false;
    }

    $minute = date('i');
    $second = date('s');

    $renamed_banner = $minute . $second . $original_filename;

    $banner_image = $renamed_banner;
    $target_img   = "./data/event/banner/" . $banner_image;

    if (!move_uploaded_file($_FILES["attached_banner"]["tmp_name"], $target_img)) {
      $outputMsg = "File upload failed.";
      return false;
    }
  } else {
    $banner_image = $_POST['existing_banner'] ?? '';
  }

  $uploaded_images = [];


  if (isset($_FILES['attached_images']['name']) && count($_FILES['attached_images']['name']) > 0) {
    foreach ($_FILES['attached_images']['name'] as $index => $original_filenames) {
      if ($_FILES['attached_images']['error'][$index] == 0) {
        $file_ext = substr($original_filenames, strripos($original_filenames, '.'));

        if (!in_array($file_ext, ['.png', '.jpg', '.jpeg', '.gif'])) {
          $outputMsg = "Only jpg, jpeg, png, and gif format images are allowed to upload.";
          continue;
        }

        $filename_without_numbers = preg_replace('/^\d+/', '', pathinfo($original_filenames, PATHINFO_FILENAME)) . $file_ext;

        $minute = date('i');
        $second = date('s');

        $renamed_image = $minute . $second . $filename_without_numbers;

        $new_filename = $renamed_image;
        $target_img = "./data/event/gallery/" . $new_filename;

        if (move_uploaded_file($_FILES['attached_images']['tmp_name'][$index], $target_img)) {
          $uploaded_images[] = $new_filename;
        } else {
          $outputMsg = "File upload failed for {$new_filename}.";
        }
      }
    }
  }

  $uploaded_images_str = implode(',', $uploaded_images);

  $unitsql = mysqli_query($con, "insert into event set title = '" . $title . "', url = '" . $url . "', date = '" . $date . "', venue = '" . $venue . "', description = '" . $description . "' , banner_image = '" . $banner_image . "', gallery_images = '" . $uploaded_images_str . "', status = '', edate= '" . $curdate . "', etime= '" . $curtime . "', meta_title= '', meta_description='', meta_keyword='',header='',footer=''") or die(mysqli_error($con));

  header("location:event.php?act=add");
  return true;
}

function addPublication($con, $req, &$outputMsg)
{
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  $title    = trim($req['title']);
  $date   = trim($req['date']);
  $venue   = trim($req['venue']);
  $media   = trim($req['media']);
  $url = trim($req['url']);
  $description = trim($req['description']);
  $curtime = date('H:i:s');
  $curdate = date('Y-m-d');

  $banner_image = '';

  if (isset($_FILES['attached_banner']['name']) && $_FILES['attached_banner']['error'] == 0) {
    $original_filename = $_FILES['attached_banner']['name'];
    $file_ext = substr($original_filename, strripos($original_filename, '.')); // Get extension

    if (($file_ext != '.png') && ($file_ext != '.jpg') && ($file_ext != '.jpeg') && ($file_ext != '.gif')) {
      $outputMsg = "Only jpg, jpeg, png, and gif format images are allowed to upload.";
      return false;
    }

    $minute = date('i');
    $second = date('s');

    $renamed_banner = $minute . $second . $original_filename;

    $banner_image = $renamed_banner;
    $target_img   = "./data/publication/banner/" . $banner_image;

    if (!move_uploaded_file($_FILES["attached_banner"]["tmp_name"], $target_img)) {
      $outputMsg = "File upload failed.";
      return false;
    }
  }


  $unitsql = mysqli_query($con, "insert into publication set title = '" . htmlentities($title) . "', date = '" . $date . "', venue = '" . $venue . "', media = '" . $media . "', description = '" . htmlentities($description) . "' , banner_image = '" . $banner_image . "',url = '" . htmlentities($url) . "', status = '', edate= '" . $curdate . "', etime= '" . $curtime . "'") or die(mysqli_error($con));

  header("location:publication.php?act=add");
  return true;
}

function addLatestUpdate($con, $req, &$outputMsg)
{
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  $title    = trim($req['title']);
  $curtime = date('H:i:s');
  $curdate = date('Y-m-d');

  $image = '';

  if (isset($_FILES['attached_image']['name']) && $_FILES['attached_image']['error'] == 0) {
    $original_filename = $_FILES['attached_image']['name'];
    $file_ext = substr($original_filename, strripos($original_filename, '.')); // Get extension

    if (($file_ext != '.png') && ($file_ext != '.jpg') && ($file_ext != '.jpeg') && ($file_ext != '.gif')) {
      $outputMsg = "Only jpg, jpeg, png, and gif format images are allowed to upload.";
      return false;
    }

    $minute = date('i');
    $second = date('s');

    $renamed_image = $minute . $second . $original_filename;

    $image = $renamed_image;
    $target_img   = "./data/latest_update/image/" . $image;

    if (!move_uploaded_file($_FILES["attached_image"]["tmp_name"], $target_img)) {
      $outputMsg = "File upload failed.";
      return false;
    }
  }


  $unitsql = mysqli_query($con, "insert into latest_update set title = '" . htmlentities($title) . "', image = '" . $image . "', edate= '" . $curdate . "', etime= '" . $curtime . "', status = ''") or die(mysqli_error($con));

  header("location:latest_update.php?act=add");
  return true;
}

function addBanner($con, $req, &$outputMsg)
{
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  $title1    = trim($req['title1']);
  $title2   = trim($req['title2']);
  $title3   = trim($req['title3']);
  $button_name   = strtoupper(trim($req['button_name']));
  $button_url = trim($req['button_url']);
  $curtime = date('H:i:s');
  $curdate = date('Y-m-d');

  $unitsql = mysqli_query($con, "insert into banner set title1 = '" . htmlentities($title1) . "', title2 = '" . $title2 . "', title3 = '" . $title3 . "', button_name = '" . $button_name . "', button_url = '" . htmlentities($button_url) . "', edate= '" . $curdate . "', etime= '" . $curtime . "'") or die(mysqli_error($con));

  header("location:banner.php?act=add");
  return true;
}
function addPeople($con, $req, &$outputMsg)
{
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  $title    = trim($req['title']);
  $post1   = trim($req['post1']);
  $post2   = trim($req['post2']);
  $post3   = trim($req['post3']);
  $description   = trim($req['description']);
  $mail = trim($req['mail']);
  $curtime = date('H:i:s');
  $curdate = date('Y-m-d');

  $image = '';

  if (isset($_FILES['attached_image']['name']) && $_FILES['attached_image']['error'] == 0) {
    $original_filename = $_FILES['attached_image']['name'];
    $file_ext = substr($original_filename, strripos($original_filename, '.')); // Get extension

    if (($file_ext != '.png') && ($file_ext != '.jpg') && ($file_ext != '.jpeg') && ($file_ext != '.gif')) {
      $outputMsg = "Only jpg, jpeg, png, and gif format images are allowed to upload.";
      return false;
    }

    $minute = date('i');
    $second = date('s');

    $renamed_banner = $minute . $second . $original_filename;

    $image = $renamed_banner;
    $target_img   = "./data/people/" . $image;

    if (!move_uploaded_file($_FILES["attached_image"]["tmp_name"], $target_img)) {
      $outputMsg = "File upload failed.";
      return false;
    }
  }

  $unitsql = mysqli_query($con, "insert into people set title = '" . $title . "', post1 = '" . $post1 . "', post2 = '" . $post2 . "',post3 = '" . $post3 . "', description = '" . htmlentities($description) . "', mail = '" . $mail . "',image = '" . $image . "', edate= '" . $curdate . "', etime= '" . $curtime . "'") or die(mysqli_error($con));

  header("location:people.php?act=add");
  header("location:people.php?act=add");
  return true;
}

function addReport($con, $req, &$outputMsg)
{
  $title    = trim($req['title']);
  $pdf    = trim($req['pdf']);

  $curtime = date('H:i:s');
  $curdate = date('Y-m-d');

  $image = '';

  if (isset($_FILES['attached_image']['name']) && $_FILES['attached_image']['error'] == 0) {
    $original_filename = $_FILES['attached_image']['name'];
    $file_ext = substr($original_filename, strripos($original_filename, '.'));

    if (!in_array($file_ext, ['.png', '.jpg', '.jpeg', '.gif'])) {
      $outputMsg = "Only jpg, jpeg, png, and gif format images are allowed to upload.";
      return false;
    }

    $original_filename_without_numbers = preg_replace('/^\d+/', '', pathinfo($original_filename, PATHINFO_FILENAME)) . $file_ext;


    $minute = date('i');
    $second = date('s');

    $renamed_image = $minute . $second . $original_filename_without_numbers;


    $image = $renamed_image;
    $target_img = "./data/report/image/" . $image;


    if (!move_uploaded_file($_FILES["attached_image"]["tmp_name"], $target_img)) {
      $outputMsg = "File upload failed.";
      return false;
    }
  } else {
    $image = $_POST['existing_image'] ?? '';
  }

  // echo "update publication set title = '" . htmlentities($title) . "',date = '" . $date . "',venue  = '" . $venue  . "',media  = '" . $media  . "',description = '" . htmlentities($description) . "', banner_image = '" . $banner_image . "',url = '" . htmlentities($url) . "', edate = '" . $curdate . "', etime = '" . $curtime . "' where id='" . $edit_id . "'"; die;

  $unitsql = mysqli_query($con, "insert into report set title = '" . htmlentities($title) . "', image = '" . $image . "', pdf = '" . $pdf . "', edate = '" . $curdate . "', etime = '" . $curtime . "'") or die(mysqli_error($con));

  header("location:report.php?act=add");

  return true;
}

function addFormReport($con, $req, &$outputMsg)
{
  $name = trim($req['name']);
  $email = trim($req['email']);
  $phone = trim($req['phone']); // Updated key
  $message = trim($req['message']);
  $curtime = date('H:i:s');
  $curdate = date('Y-m-d');

  $sqlQry = mysqli_query($con, "INSERT INTO form_report SET name = '" . $name . "', email = '" . $email . "', phone = '" . $phone . "', message = '" . $message . "', edate = '" . $curdate . "', etime = '" . $curtime . "'") or die(mysqli_error($con));

  header("location: https://itcodetech.com/projects/assets/SHARE_Recommendations_BD.pdf");
  // Always include exit after a header redirect
  return true;
}

function adminAddFormReport($con, $req, &$outputMsg)
{
  $name = trim($req['name']);
  $email = trim($req['email']);
  $phone = trim($req['phone']); // Updated key
  $message = trim($req['message']);
  $curtime = date('H:i:s');
  $curdate = date('Y-m-d');

  $sqlQry = mysqli_query($con, "INSERT INTO form_report SET name = '" . $name . "', email = '" . $email . "', phone = '" . $phone . "', message = '" . $message . "', edate = '" . $curdate . "', etime = '" . $curtime . "'") or die(mysqli_error($con));

  header("location: form_report.php?act=add");
  // Always include exit after a header redirect
  return true;
}

function addRole($con, $req, &$outputMsg)
{

  $status = trim($req['status']);


  $sqlQry = mysqli_query($con, "select * from permission where id = '1'");

  $permissionInfo = array_slice(mysqli_fetch_assoc($sqlQry), 1);

  foreach ($permissionInfo as $permissionInfo) {
    ${$permissionInfo} = '0';
  }

  foreach ($req['permission'] as $permission) {
    ${preg_replace('/\s+/', '', $permission)} = '1';
  }

  $name = trim($req['role_name']);

  $curtime = date('H:i:s');
  $curdate = date('Y-m-d');

  $sqlQry = mysqli_query($con, "INSERT INTO role SET role_name = '" . $name . "', user_show = '" . $UserShow . "', user_edit = '" . $UserEdit . "', user_remove = '" . $UserRemove . "', user_add = '" . $UserAdd . "', role_show = '" . $RoleShow . "', role_edit = '" . $RoleEdit . "', role_remove = '" . $RoleRemove . "',  role_add = '" . $RoleAdd . "', status = '" . $status . "', edate = '" . $curdate . "', etime = '" . $curtime . "'") or die(mysqli_error($con));

  header("location: role_management.php?act=add");
  // Always include exit after a header redirect
  return true;
}


function addUser($con, $req, &$outputMsg)
{
  $name = trim($req['user_name']);
  $email = trim($req['user_email']);
  $password = trim(md5($req['user_password']));
  $role = trim($req['role_name']);
  $status = trim($req['status']);
  $curtime = date('H:i:s');
  $curdate = date('Y-m-d');


  $curtime = date('H:i:s');
  $curdate = date('Y-m-d');

  $sqlQry = mysqli_query($con, "INSERT INTO user SET user_name = '" . $name . "', user_email = '" . $email . "', user_password = '" . $password . "', role= '" . $role . "',status = '" . $status . "', edate = '" . $curdate . "', etime = '" . $curtime . "'") or die(mysqli_error($con));

  header("location: user_management.php?act=add");
  // Always include exit after a header redirect
  return true;
}

function updateFormReport($con, $req, &$outputMsg)
{
  $name = trim($req['name']);
  $email = trim($req['email']);
  $phone = trim($req['phone']); // Updated key
  $message = trim($req['message']);
  $curtime = date('H:i:s');
  $curdate = date('Y-m-d');
  $edit_id = $req['id'];


  $sqlQry = mysqli_query($con, "update form_report SET name = '" . $name . "', email = '" . $email . "', phone = '" . $phone . "', message = '" . $message . "', edate = '" . $curdate . "', etime = '" . $curtime . "' where id = '" . $edit_id . "'") or die(mysqli_error($con));

  header("location: form_report.php?act=add");
  // Always include exit after a header redirect
  return true;
}



function updateBanner($con, $req, &$outputMsg)
{
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  $id    = trim($req['id']);
  $title1    = trim($req['title1']);
  $title2   = trim($req['title2']);
  $title3   = trim($req['title3']);
  $button_name   = strtoupper(trim($req['button_name']));
  $button_url = trim($req['button_url']);
  $curtime = date('H:i:s');
  $curdate = date('Y-m-d');

  $unitsql = mysqli_query($con, "update banner set title1 = '" . htmlentities($title1) . "', title2 = '" . $title2 . "', title3 = '" . $title3 . "', button_name = '" . $button_name . "', button_url = '" . htmlentities($button_url) . "', edate= '" . $curdate . "', etime= '" . $curtime . "' where id = '" . $id . "'") or die(mysqli_error($con));

  header("location:banner.php?act=edit");
  return true;
}

function updateEvent($con, $req, &$outputMsg)
{
  $title = trim($req['title']);
  $url = clean(trim($req['title']));
  $date = trim($req['date']);
  $venue = trim($req['venue']);
  $description = trim($req['description']);
  $curtime = date('H:i:s');
  $curdate = date('Y-m-d');
  $banner_image = '';
  $edit_id = $req['id'];

  // Banner image handling (unchanged)
  if (isset($_FILES['attached_banner']['name']) && $_FILES['attached_banner']['error'] == 0) {
    $original_filename = $_FILES['attached_banner']['name'];
    $file_ext = substr($original_filename, strripos($original_filename, '.'));

    if (!in_array($file_ext, ['.png', '.jpg', '.jpeg', '.gif'])) {
      $outputMsg = "Only jpg, jpeg, png, and gif format images are allowed to upload.";
      return false;
    }

    $original_filename_without_numbers = preg_replace('/^\d+/', '', pathinfo($original_filename, PATHINFO_FILENAME)) . $file_ext;


    $minute = date('i');
    $second = date('s');

    $renamed_banner = $minute . $second . $original_filename_without_numbers;


    $banner_image = $renamed_banner;
    $target_img = "./data/event/banner/" . $banner_image;


    if (!move_uploaded_file($_FILES["attached_banner"]["tmp_name"], $target_img)) {
      $outputMsg = "File upload failed.";
      return false;
    }
  } else {
    $banner_image = $_POST['existing_banner'] ?? '';
  }

  // Handle existing images and removed images
  $uploaded_images = [];
  if (!empty($_POST['existing_images'])) {
    $existing_images = explode(',', $_POST['existing_images']);
    if (isset($_POST['removed_images'])) {
      $removedImages = explode(',', $_POST['removed_images']);
      // Handle image deletions here
    }


    // Filter out removed images by filename
    $uploaded_images = array_diff($existing_images, $removedImages);
  }

  // Handle new uploads
  if (isset($_FILES['attached_images']['name']) && count($_FILES['attached_images']['name']) > 0) {
    foreach ($_FILES['attached_images']['name'] as $index => $original_filename) {
      if ($_FILES['attached_images']['error'][$index] == 0) {
        // File validation and renaming logic
        $file_ext = substr($original_filename, strripos($original_filename, '.'));
        if (!in_array($file_ext, ['.png', '.jpg', '.jpeg', '.gif'])) {
          $outputMsg = "Only jpg, jpeg, png, and gif format images are allowed to upload.";
          continue;
        }

        $renamed_image = date('i') . date('s') . preg_replace('/^\d+/', '', pathinfo($original_filename, PATHINFO_FILENAME)) . $file_ext;
        $target_img = "./data/event/gallery/" . $renamed_image;

        if (move_uploaded_file($_FILES['attached_images']['tmp_name'][$index], $target_img)) {
          $uploaded_images[] = $renamed_image;
        } else {
          $outputMsg = "File upload failed for {$renamed_image}.";
        }
      }
    }
  }

  // Finalize the image list
  $uploaded_images_str = implode(',', $uploaded_images);

  $update_query = mysqli_query($con, "update event set title = '" . $title . "', date = '" . $date . "', venue = '" . $venue . "', description = '" . $description . "' , banner_image = '" . $banner_image . "', gallery_images = '" . $uploaded_images_str . "',url = '" . $url . "', status = '', edate= '" . $curdate . "', etime= '" . $curtime . "' where id='" . $edit_id . "'") or die(mysqli_error($con));

  header("location:event.php?act=edit");
  return true;
}



function updatePublication($con, $req, &$outputMsg)
{
  $title    = trim($req['title']);
  $date   = trim($req['date']);
  $venue   = trim($req['venue']);
  $media   = trim($req['media']);
  $description = trim($req['description']);
  $url = trim($req['url']);
  $curtime = date('H:i:s');
  $curdate = date('Y-m-d');



  $edit_id = $req['id'];


  $banner_image = '';

  if (isset($_FILES['attached_banner']['name']) && $_FILES['attached_banner']['error'] == 0) {
    $original_filename = $_FILES['attached_banner']['name'];
    $file_ext = substr($original_filename, strripos($original_filename, '.'));

    if (!in_array($file_ext, ['.png', '.jpg', '.jpeg', '.gif'])) {
      $outputMsg = "Only jpg, jpeg, png, and gif format images are allowed to upload.";
      return false;
    }

    $original_filename_without_numbers = preg_replace('/^\d+/', '', pathinfo($original_filename, PATHINFO_FILENAME)) . $file_ext;


    $minute = date('i');
    $second = date('s');

    $renamed_banner = $minute . $second . $original_filename_without_numbers;


    $banner_image = $renamed_banner;
    $target_img = "./data/publication/banner/" . $banner_image;


    if (!move_uploaded_file($_FILES["attached_banner"]["tmp_name"], $target_img)) {
      $outputMsg = "File upload failed.";
      return false;
    }
  } else {
    $banner_image = $_POST['existing_banner'] ?? '';
  }

  // echo "update publication set title = '" . htmlentities($title) . "',date = '" . $date . "',venue  = '" . $venue  . "',media  = '" . $media  . "',description = '" . htmlentities($description) . "', banner_image = '" . $banner_image . "',url = '" . htmlentities($url) . "', edate = '" . $curdate . "', etime = '" . $curtime . "' where id='" . $edit_id . "'"; die;

  $unitsql = mysqli_query($con, "update publication set title = '" . htmlentities($title) . "',date = '" . $date . "',venue  = '" . $venue  . "',media  = '" . $media  . "',description = '" . htmlentities($description) . "', banner_image = '" . $banner_image . "',url = '" . htmlentities($url) . "', edate = '" . $curdate . "', etime = '" . $curtime . "' where id='" . $edit_id . "'") or die(mysqli_error($con));

  header("location:publication.php?act=edit");

  return true;
}

function updateLatestUpdate($con, $req, &$outputMsg)
{
  $title    = trim($req['title']);

  $curtime = date('H:i:s');
  $curdate = date('Y-m-d');



  $edit_id = $req['id'];


  $image = '';

  if (isset($_FILES['attached_image']['name']) && $_FILES['attached_image']['error'] == 0) {
    $original_filename = $_FILES['attached_image']['name'];
    $file_ext = substr($original_filename, strripos($original_filename, '.'));

    if (!in_array($file_ext, ['.png', '.jpg', '.jpeg', '.gif'])) {
      $outputMsg = "Only jpg, jpeg, png, and gif format images are allowed to upload.";
      return false;
    }

    $original_filename_without_numbers = preg_replace('/^\d+/', '', pathinfo($original_filename, PATHINFO_FILENAME)) . $file_ext;


    $minute = date('i');
    $second = date('s');

    $renamed_image = $minute . $second . $original_filename_without_numbers;


    $image = $renamed_image;
    $target_img = "./data/latest_update/image/" . $image;


    if (!move_uploaded_file($_FILES["attached_image"]["tmp_name"], $target_img)) {
      $outputMsg = "File upload failed.";
      return false;
    }
  } else {
    $image = $_POST['existing_image'] ?? '';
  }

  // echo "update publication set title = '" . htmlentities($title) . "',date = '" . $date . "',venue  = '" . $venue  . "',media  = '" . $media  . "',description = '" . htmlentities($description) . "', banner_image = '" . $banner_image . "',url = '" . htmlentities($url) . "', edate = '" . $curdate . "', etime = '" . $curtime . "' where id='" . $edit_id . "'"; die;

  $unitsql = mysqli_query($con, "update latest_update set title = '" . htmlentities($title) . "', image = '" . $image . "', edate = '" . $curdate . "', etime = '" . $curtime . "' where id='" . $edit_id . "'") or die(mysqli_error($con));

  header("location:latest_update.php?act=edit");

  return true;
}
function updateReport($con, $req, &$outputMsg)
{
  $title    = trim($req['title']);
  $pdf    = trim($req['pdf']);

  $curtime = date('H:i:s');
  $curdate = date('Y-m-d');



  $edit_id = $req['id'];


  $image = '';

  if (isset($_FILES['attached_image']['name']) && $_FILES['attached_image']['error'] == 0) {
    $original_filename = $_FILES['attached_image']['name'];
    $file_ext = substr($original_filename, strripos($original_filename, '.'));

    if (!in_array($file_ext, ['.png', '.jpg', '.jpeg', '.gif'])) {
      $outputMsg = "Only jpg, jpeg, png, and gif format images are allowed to upload.";
      return false;
    }

    $original_filename_without_numbers = preg_replace('/^\d+/', '', pathinfo($original_filename, PATHINFO_FILENAME)) . $file_ext;


    $minute = date('i');
    $second = date('s');

    $renamed_image = $minute . $second . $original_filename_without_numbers;


    $image = $renamed_image;
    $target_img = "./data/report/image/" . $image;


    if (!move_uploaded_file($_FILES["attached_image"]["tmp_name"], $target_img)) {
      $outputMsg = "File upload failed.";
      return false;
    }
  } else {
    $image = $_POST['existing_image'] ?? '';
  }

  // echo "update publication set title = '" . htmlentities($title) . "',date = '" . $date . "',venue  = '" . $venue  . "',media  = '" . $media  . "',description = '" . htmlentities($description) . "', banner_image = '" . $banner_image . "',url = '" . htmlentities($url) . "', edate = '" . $curdate . "', etime = '" . $curtime . "' where id='" . $edit_id . "'"; die;

  $unitsql = mysqli_query($con, "update report set title = '" . htmlentities($title) . "', image = '" . $image . "', pdf = '" . $pdf . "', edate = '" . $curdate . "', etime = '" . $curtime . "' where id='" . $edit_id . "'") or die(mysqli_error($con));

  header("location:report.php?act=edit");

  return true;
}


function updatePeople($con, $req, &$outputMsg)
{
  $title    = trim($req['title']);
  $post1   = trim($req['post1']);
  $post2   = trim($req['post2']);
  $post3   = trim($req['post3']);
  $mail   = trim($req['mail']);
  $description = trim($req['description']);
  $curtime = date('H:i:s');
  $curdate = date('Y-m-d');



  $edit_id = $req['id'];


  $image = '';

  if (isset($_FILES['attached_image']['name']) && $_FILES['attached_image']['error'] == 0) {
    $original_filename = $_FILES['attached_image']['name'];
    $file_ext = substr($original_filename, strripos($original_filename, '.'));

    if (!in_array($file_ext, ['.png', '.jpg', '.jpeg', '.gif'])) {
      $outputMsg = "Only jpg, jpeg, png, and gif format images are allowed to upload.";
      return false;
    }

    $original_filename_without_numbers = preg_replace('/^\d+/', '', pathinfo($original_filename, PATHINFO_FILENAME)) . $file_ext;


    $minute = date('i');
    $second = date('s');

    $renamed_image = $minute . $second . $original_filename_without_numbers;


    $image = $renamed_image;
    $target_img = "./data/people/" . $image;


    if (!move_uploaded_file($_FILES["attached_image"]["tmp_name"], $target_img)) {
      $outputMsg = "File upload failed.";
      return false;
    }
  } else {
    $image = $_POST['existing_image'] ?? '';
  }

  // echo "update publication set title = '" . htmlentities($title) . "',date = '" . $date . "',venue  = '" . $venue  . "',media  = '" . $media  . "',description = '" . htmlentities($description) . "', banner_image = '" . $banner_image . "',url = '" . htmlentities($url) . "', edate = '" . $curdate . "', etime = '" . $curtime . "' where id='" . $edit_id . "'"; die;

  $unitsql = mysqli_query($con, "update people set title = '" . $title . "', post1 = '" . $post1 . "', post2 = '" . $post2 . "',post3 = '" . $post3 . "', description = '" . htmlentities($description) . "', mail = '" . $mail . "',image = '" . $image . "', edate= '" . $curdate . "', etime= '" . $curtime . "' where id = '" . $edit_id . "'") or die(mysqli_error($con));

  header("location:people.php?act=edit");

  return true;
}



function viewData($con, $table, $id)
{

  $getQur = mysqli_query($con, "select * from $table WHERE id = '" . $id . "'");



  $result = mysqli_fetch_assoc($getQur);



  return $result;
}





function editData($con, $table, $id)
{

  $getQur = mysqli_query($con, "select * from $table WHERE id = '" . $id . "'");



  $result = mysqli_fetch_assoc($getQur);



  return $result;
}


function deleteDataWithImg($con, $table, $id)
{



  $result = mysqli_fetch_assoc(mysqli_query($con, "select * from $table WHERE id = '" . $id . "'"));



  unlink('upload/' . $table . '/' . $result['image']);



  $true = mysqli_query($con, "delete from $table WHERE id = '" . $id . "'");



  return $true;
}


function clean($string)



{



  $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.



  $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.



  return strtolower(preg_replace('/-+/', '-', $string)); // Replaces multiple hyphens with single one.



}
