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



    $_SESSION['ID']  = $dataLogin->id;



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

      $_SESSION['banner_show'] = $dataRole->banner_show;

      $_SESSION['banner_add'] = $dataRole->banner_add;

      $_SESSION['banner_edit'] = $dataRole->banner_edit;

      $_SESSION['banner_remove'] = $dataRole->banner_remove;

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

  // $uploaded_images = [];


  // if (isset($_FILES['attached_images']['name']) && count($_FILES['attached_images']['name']) > 0) {
  //   foreach ($_FILES['attached_images']['name'] as $index => $original_filenames) {
  //     if ($_FILES['attached_images']['error'][$index] == 0) {
  //       $file_ext = substr($original_filenames, strripos($original_filenames, '.'));

  //       if (!in_array($file_ext, ['.png', '.jpg', '.jpeg', '.gif'])) {
  //         $outputMsg = "Only jpg, jpeg, png, and gif format images are allowed to upload.";
  //         continue;
  //       }

  //       $filename_without_numbers = preg_replace('/^\d+/', '', pathinfo($original_filenames, PATHINFO_FILENAME)) . $file_ext;

  //       $minute = date('i');
  //       $second = date('s');

  //       $renamed_image = $minute . $second . $filename_without_numbers;

  //       $new_filename = $renamed_image;
  //       $target_img = "./data/event/gallery/" . $new_filename;

  //       if (move_uploaded_file($_FILES['attached_images']['tmp_name'][$index], $target_img)) {
  //         $uploaded_images[] = $new_filename;
  //       } else {
  //         $outputMsg = "File upload failed for {$new_filename}.";
  //       }
  //     }
  //   }
  // }

  // $uploaded_images_str = implode(',', $uploaded_images);


  function compressImageEvent($source, $destination, $file_ext, $quality)
  {
    switch ($file_ext) {
      case 'jpg':
      case 'jpeg':
        $image = imagecreatefromjpeg($source);
        break;
      case 'png':
        $image = imagecreatefrompng($source);
        break;
      case 'gif':
        $image = imagecreatefromgif($source);
        break;
      default:
        return false;
    }

    // Save the compressed image
    switch ($file_ext) {
      case 'jpg':
      case 'jpeg':
        $result = imagejpeg($image, $destination, $quality); // JPEG compression
        break;
      case 'png':
        $result = imagepng($image, $destination, 9 - round($quality / 10)); // PNG compression
        break;
      case 'gif':
        $result = imagegif($image, $destination); // GIF doesn't support quality parameter
        break;
      default:
        return false;
    }

    // Free up memory
    imagedestroy($image);

    return $result;
  }

  $uploaded_images = [];

  if (isset($_FILES['attached_images']['name']) && count($_FILES['attached_images']['name']) > 0) {
    foreach ($_FILES['attached_images']['name'] as $index => $original_filenames) {
      if ($_FILES['attached_images']['error'][$index] == 0) {
        $file_ext = strtolower(pathinfo($original_filenames, PATHINFO_EXTENSION));

        if (!in_array($file_ext, ['png', 'jpg', 'jpeg', 'gif'])) {
          $outputMsg = "Only jpg, jpeg, png, and gif format images are allowed to upload.";
          continue;
        }

        $filename_without_numbers = preg_replace('/^\d+/', '', pathinfo($original_filenames, PATHINFO_FILENAME)) . '.' . $file_ext;

        $minute = date('i');
        $second = date('s');

        $renamed_image = $minute . $second . $filename_without_numbers;

        $new_filename = $renamed_image;
        $target_img = "./data/event/gallery/" . $new_filename;

        // Compress and save the image
        $source_img = $_FILES['attached_images']['tmp_name'][$index];
        $quality = 75; // Compression quality (0-100 for JPEG, lower for higher compression)

        if (compressImageEvent($source_img, $target_img, $file_ext, $quality)) {
          $uploaded_images[] = $new_filename;
        } else {
          $outputMsg = "File upload failed during compression for {$new_filename}.";
        }
      }
    }
  }

  $uploaded_images_str = implode(',', $uploaded_images);

  // Function to compress and save the image




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



  function compressImageLatestUpdate($source, $destination, $file_ext, $quality)
  {
    // Create an image resource based on file type
    switch ($file_ext) {
      case 'jpg':
      case 'jpeg':
        $image = imagecreatefromjpeg($source);
        break;
      case 'png':
        $image = imagecreatefrompng($source);
        break;
      case 'gif':
        $image = imagecreatefromgif($source);
        break;
      default:
        return false;
    }

    // Save compressed image based on file type
    switch ($file_ext) {
      case 'jpg':
      case 'jpeg':
        $result = imagejpeg($image, $destination, $quality); // For JPG/JPEG, compression quality is used
        break;
      case 'png':
        $result = imagepng($image, $destination, 9 - round($quality / 10)); // For PNG, quality is 0-9
        break;
      case 'gif':
        $result = imagegif($image, $destination); // GIF does not support quality
        break;
      default:
        return false;
    }

    // Free up memory
    imagedestroy($image);

    return $result;
  }


  $image = '';

  if (isset($_FILES['attached_image']['name']) && $_FILES['attached_image']['error'] == 0) {
    $original_filename = $_FILES['attached_image']['name'];
    $file_ext = strtolower(pathinfo($original_filename, PATHINFO_EXTENSION)); // Get extension

    if (!in_array($file_ext, ['png', 'jpg', 'jpeg', 'gif'])) {
      $outputMsg = "Only jpg, jpeg, png, and gif format images are allowed to upload.";
      return false;
    }

    $minute = date('i');
    $second = date('s');

    $renamed_image = $minute . $second . $original_filename;
    $image = $renamed_image;
    $target_img = "./data/latest_update/image/" . $image;

    // Compress and save the image
    $source_img = $_FILES["attached_image"]["tmp_name"];
    $quality = 75; // Compression quality (0-100)

    if (!compressImageLatestUpdate($source_img, $target_img, $file_ext, $quality)) {
      $outputMsg = "File upload failed during compression.";
      return false;
    }
  }

  // Function to compress and save the image



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
  return true;
}
function addSetting($con, $req, &$outputMsg)
{
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  $address1    = trim($req['address1']);
  $address2   = trim($req['address2']);
  $address3   = trim($req['address3']);
  $phone1   = trim($req['phone1']);
  $phone2   = trim($req['phone2']);
  $phone3   = trim($req['phone3']);
  $email1 = trim($req['email1']);
  $email2 = trim($req['email2']);
  $email3 = trim($req['email3']);
  $fburl = trim($req['fburl']);
  $igurl = trim($req['igurl']);
  $yturl = trim($req['yturl']);
  $liurl = trim($req['liurl']);
  $pturl = trim($req['pturl']);
  $curtime = date('H:i:s');
  $curdate = date('Y-m-d');


  $logo = '';

  if (isset($_FILES['attached_logo']['name']) && $_FILES['attached_logo']['error'] == 0) {
    $original_filename = $_FILES['attached_logo']['name'];
    $file_ext = substr($original_filename, strripos($original_filename, '.')); // Get extension

    if (($file_ext != '.png') && ($file_ext != '.jpg') && ($file_ext != '.jpeg') && ($file_ext != '.gif')) {
      $outputMsg = "Only jpg, jpeg, png, and gif format images are allowed to upload.";
      return false;
    }

    $minute = date('i');
    $second = date('s');

    $renamed_logo = $minute . $second . $original_filename;

    $logo = $renamed_logo;
    $target_img   = "./data/logo/" . $logo;

    if (!move_uploaded_file($_FILES["attached_logo"]["tmp_name"], $target_img)) {
      $outputMsg = "File upload failed.";
      return false;
    }
  }

  $faviconLogo = '';

  if (isset($_FILES['attached_faviconLogo']['name']) && $_FILES['attached_faviconLogo']['error'] == 0) {
    $original_filename = $_FILES['attached_faviconLogo']['name'];
    $file_ext = substr($original_filename, strripos($original_filename, '.')); // Get extension

    if (($file_ext != '.png') && ($file_ext != '.jpg') && ($file_ext != '.jpeg') && ($file_ext != '.gif')) {
      $outputMsg = "Only jpg, jpeg, png, and gif format images are allowed to upload.";
      return false;
    }

    $minute = date('i');
    $second = date('s');

    $renamed_faviconLogo = $minute . $second . $original_filename;

    $faviconLogo = $renamed_faviconLogo;
    $target_img   = "./data/favicon_logo/" . $faviconLogo;

    if (!move_uploaded_file($_FILES["attached_faviconLogo"]["tmp_name"], $target_img)) {
      $outputMsg = "File upload failed.";
      return false;
    }
  }


  $unitsql = mysqli_query($con, "insert into setting set address1 = '" . $address1 . "', address2 = '" . $address2 . "', address3 = '" . $address3 . "',phone1 = '" . $phone1 . "', phone2 = '" . $phone2 . "', phone3 = '" . $phone3 . "',email1 = '" . $email1 . "',email2 = '" . $email2 . "',email3 = '" . $email3 . "',fburl = '" . $fburl . "',igurl = '" . $igurl . "',yturl = '" . $yturl . "',liurl = '" . $liurl . "',pturl = '" . $pturl . "',logo = '" . $logo . "',faviconLogo = '" . $faviconLogo . "',status = '1', edate= '" . $curdate . "', etime= '" . $curtime . "'") or die(mysqli_error($con));

  header("location:setting.php?act=add");
  return true;
}

function addSeo($con, $req, &$outputMsg)
{
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  $title    = trim($req['title']);
  $meta_title   = trim($req['meta_title']);
  $meta_description   = trim($req['meta_description']);
  $meta_keyword   = trim($req['meta_keyword']);
  $header   = trim($req['header']);
  $footer   = trim($req['footer']);
  $body   = trim($req['body']);
  $status = trim($req['status']);
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
    $target_img   = "./data/seo/" . $image;

    if (!move_uploaded_file($_FILES["attached_image"]["tmp_name"], $target_img)) {
      $outputMsg = "File upload failed.";
      return false;
    }
  }

  $unitsql = mysqli_query($con, "insert into seo set title = '" . $title . "', meta_title = '" . $meta_title . "', meta_description = '" . $meta_description . "',meta_keyword = '" . $meta_keyword . "', header = '" . $header . "', footer = '" . $footer . "', body = '" . $body . "',status = '" . $status . "',image = '" . $image . "', edate= '" . $curdate . "', etime= '" . $curtime . "'") or die(mysqli_error($con));

  header("location:manage_seo.php?act=add");
  return true;
}

function addPurpose($con, $req, &$outputMsg)
{
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  $title    = trim($req['title']);
  $sub_title    = trim($req['sub_title']);
  $description   = trim($req['description']);
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
    $target_img   = "./data/purpose/image/" . $image;

    if (!move_uploaded_file($_FILES["attached_image"]["tmp_name"], $target_img)) {
      $outputMsg = "File upload failed.";
      return false;
    }
  }

  $unitsql = mysqli_query($con, "insert into purpose set title = '" . $title . "', sub_title = '" . $sub_title . "', description = '" . $description . "',image = '" . $image . "', status ='1' ,edate= '" . $curdate . "', etime= '" . $curtime . "'") or die(mysqli_error($con));

  header("location:purpose.php?act=add");
  return true;
}

function addReport($con, $req, &$outputMsg)
{
  $title  = trim($req['title']);
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

  $permissionInfo = array_slice(mysqli_fetch_fields($sqlQry), 1);

  // foreach ($permissionInfo as $permissionName) {
  //   ${$permissionName} = 0;
  // }

  foreach ($req['permission'] as $permission) {
    ${$permission} = 1;
  }

  $name = trim($req['role_name']);

  $curtime = date('H:i:s');
  $curdate = date('Y-m-d');

  $sqlQry = mysqli_query($con, "
  INSERT INTO role SET 
  role_name = '" . $name . "', 
  user_show = '" . $user_show . "', 
  user_edit = '" . $user_edit . "', 
  user_remove = '" . $user_remove . "', 
  user_add = '" . $user_add . "', 
  banner_show = '" . $banner_show . "', 
  banner_edit = '" . $banner_edit . "', 
  banner_remove = '" . $banner_remove . "', 
  banner_add = '" . $banner_add . "', 
  latest_show = '" . $latest_show . "', 
  latest_edit = '" . $latest_edit . "', 
  latest_remove = '" . $latest_remove . "', 
  latest_add = '" . $latest_add . "', 
  people_show = '" . $people_show . "', 
  people_edit = '" . $people_edit . "', 
  people_remove = '" . $people_remove . "', 
  people_add = '" . $people_add . "', 
  purpose_show = '" . $purpose_show . "', 
  purpose_edit = '" . $purpose_edit . "', 
  purpose_remove = '" . $purpose_remove . "', 
  purpose_add = '" . $purpose_add . "', 
  event_show = '" . $event_show . "', 
  event_edit = '" . $event_edit . "', 
  event_remove = '" . $event_remove . "', 
  event_add = '" . $event_add . "', 
  publication_show = '" . $publication_show . "', 
  publication_edit = '" . $publication_edit . "', 
  publication_remove = '" . $publication_remove . "', 
  publication_add = '" . $publication_add . "', 
  reports_show = '" . $reports_show . "', 
  reports_edit = '" . $reports_edit . "', 
  reports_remove = '" . $reports_remove . "', 
  reports_add = '" . $reports_add . "', 
  form = '" . $form . "', 
  seo_show = '" . $seo_show . "', 
  seo_edit = '" . $seo_edit . "', 
  seo_remove = '" . $seo_remove . "', 
  seo_add = '" . $seo_add . "', 
  role_show = '" . $role_show . "', 
  role_edit = '" . $role_edit . "', 
  role_remove = '" . $role_remove . "', 
  role_add = '" . $role_add . "', 
  setting_show = '" . $setting_show . "', 
  setting_edit = '" . $setting_edit . "', 
  setting_remove = '" . $setting_remove . "', 
  setting_add = '" . $setting_add . "', 
  status = '" . $status . "', 
  edate = '" . $curdate . "', 
  etime = '" . $curtime . "'
") or die(mysqli_error($con));



  header("location: role_management.php?act=add");
  // Always include exit after a header redirect
  return true;
}


function addUser($con, $req, &$outputMsg)
{
  $name  = trim($req['user_name']);
  $email = trim($req['user_email']);
  $password = trim(md5($req['user_password']));
  $role = trim($req['role_name']);
  $status = '0';
  $curtime = date('H:i:s');
  $curdate = date('Y-m-d');


  $curtime = date('H:i:s');
  $curdate = date('Y-m-d');

  $sqlQry = mysqli_query($con, "INSERT INTO user SET user_name = '" . $name . "', user_email = '" . $email . "', user_password = '" . $password . "', role= '" . $role . "',status = '" . $status . "', edate = '" . $curdate . "', etime = '" . $curtime . "'") or die(mysqli_error($con));

  header("location: user_management.php?act=add");
  // Always include exit after a header redirect
  return true;
}
function updateUser($con, $req, &$outputMsg)
{
  $name  = trim($req['user_name']);
  $email = trim($req['user_email']);
  $password = trim(md5($req['user_password']));
  $role = trim($req['role_name']);
  $status = trim($req['status']);
  $curtime = date('H:i:s');
  $curdate = date('Y-m-d');
  $edit_id = $req['id'];

  $curtime = date('H:i:s');
  $curdate = date('Y-m-d');

  $sqlQry = mysqli_query($con, "UPDATE user SET user_name = '" . $name . "', user_email = '" . $email . "', user_password = '" . $password . "', role= '" . $role . "',status = '" . $status . "', edate = '" . $curdate . "', etime = '" . $curtime . "' where id = '" . $edit_id . "' ") or die(mysqli_error($con));

  header("location: user_management.php?act=edit");
  // Always include exit after a header redirect
  return true;
}


function updateProfile($con, $req, &$outputMsg)
{
  $name  = trim($req['user_name']);
  $email = trim($req['user_email']);
  $password = trim(md5($req['new_password']));
  $role = trim($req['role_name']);
  $status = '1';
  $curtime = date('H:i:s');
  $curdate = date('Y-m-d');
  $edit_id = $req['id'];
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
    $target_img = "./data/user/image/" . $image;


    if (!move_uploaded_file($_FILES["attached_image"]["tmp_name"], $target_img)) {
      $outputMsg = "File upload failed.";
      return false;
    }
  } else {
    $image = $_POST['existing_image'] ?? '';
  }

  $sqlQry = mysqli_query($con, "UPDATE user SET user_name = '" . $name . "', user_email = '" . $email . "', user_password = '" . $password . "', role= '" . $role . "',status = '" . $status . "',image = '" . $image . "', edate = '" . $curdate . "', etime = '" . $curtime . "' where id = '" . $edit_id . "' ") or die(mysqli_error($con));

  header("location: user_management.php?act=edit");
  // Always include exit after a header redirect
  return true;
}

function updateFormReport($con, $req, &$outputMsg)
{
  $name  = trim($req['name']);
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

  $id       = trim($req['id']);
  $title1   = trim($req['title1']);
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
  $url   = clean(trim($req['title']));
  $date  = trim($req['date']);
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
  $title   = trim($req['title']);
  $date    = trim($req['date']);
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
  $title   = trim($req['title']);

  $curtime = date('H:i:s');
  $curdate = date('Y-m-d');



  $edit_id = $req['id'];



  function compressImageUpdateLatestUpdate($source, $destination, $file_ext, $quality)
  {
    // Create an image resource based on file type
    switch ($file_ext) {
      case 'jpg':
      case 'jpeg':
        $image = imagecreatefromjpeg($source);
        break;
      case 'png':
        $image = imagecreatefrompng($source);
        break;
      case 'gif':
        $image = imagecreatefromgif($source);
        break;
      default:
        return false;
    }

    // Save compressed image based on file type
    switch ($file_ext) {
      case 'jpg':
      case 'jpeg':
        $result = imagejpeg($image, $destination, $quality); // For JPG/JPEG, compression quality is used
        break;
      case 'png':
        $result = imagepng($image, $destination, 9 - round($quality / 10)); // For PNG, quality is 0-9
        break;
      case 'gif':
        $result = imagegif($image, $destination); // GIF does not support quality
        break;
      default:
        return false;
    }

    // Free up memory
    imagedestroy($image);

    return $result;
  }


  $image = '';

  if (isset($_FILES['attached_image']['name']) && $_FILES['attached_image']['error'] == 0) {
    $original_filename = $_FILES['attached_image']['name'];
    $file_ext = strtolower(pathinfo($original_filename, PATHINFO_EXTENSION)); // Get extension

    if (!in_array($file_ext, ['png', 'jpg', 'jpeg', 'gif'])) {
      $outputMsg = "Only jpg, jpeg, png, and gif format images are allowed to upload.";
      return false;
    }

    $minute = date('i');
    $second = date('s');

    $renamed_image = $minute . $second . $original_filename;
    $image = $renamed_image;
    $target_img = "./data/latest_update/image/" . $image;

    // Compress and save the image
    $source_img = $_FILES["attached_image"]["tmp_name"];
    $quality = 75; // Compression quality (0-100)

    if (!compressImageUpdateLatestUpdate($source_img, $target_img, $file_ext, $quality)) {
      $outputMsg = "File upload failed during compression.";
      return false;
    }
  } else {
    $image = $_POST['existing_image'] ?? '';
  }

  // $image = '';

  // if (isset($_FILES['attached_image']['name']) && $_FILES['attached_image']['error'] == 0) {
  //   $original_filename = $_FILES['attached_image']['name'];
  //   $file_ext = substr($original_filename, strripos($original_filename, '.'));

  //   if (!in_array($file_ext, ['.png', '.jpg', '.jpeg', '.gif'])) {
  //     $outputMsg = "Only jpg, jpeg, png, and gif format images are allowed to upload.";
  //     return false;
  //   }

  //   $original_filename_without_numbers = preg_replace('/^\d+/', '', pathinfo($original_filename, PATHINFO_FILENAME)) . $file_ext;


  //   $minute = date('i');
  //   $second = date('s');

  //   $renamed_image = $minute . $second . $original_filename_without_numbers;


  //   $image = $renamed_image;
  //   $target_img = "./data/latest_update/image/" . $image;


  //   if (!move_uploaded_file($_FILES["attached_image"]["tmp_name"], $target_img)) {
  //     $outputMsg = "File upload failed.";
  //     return false;
  //   }
  // } else {
  //   $image = $_POST['existing_image'] ?? '';
  // }

  // echo "update publication set title = '" . htmlentities($title) . "',date = '" . $date . "',venue  = '" . $venue  . "',media  = '" . $media  . "',description = '" . htmlentities($description) . "', banner_image = '" . $banner_image . "',url = '" . htmlentities($url) . "', edate = '" . $curdate . "', etime = '" . $curtime . "' where id='" . $edit_id . "'"; die;

  $unitsql = mysqli_query($con, "update latest_update set title = '" . htmlentities($title) . "', image = '" . $image . "', edate = '" . $curdate . "', etime = '" . $curtime . "' where id='" . $edit_id . "'") or die(mysqli_error($con));

  header("location:latest_update.php?act=edit");

  return true;
}

function updateReport($con, $req, &$outputMsg)
{
  $title   = trim($req['title']);
  $pdf     = trim($req['pdf']);
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

function updatePurpose($con, $req, &$outputMsg)
{
  $title    = trim($req['title']);
  $sub_title    = trim($req['sub_title']);
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

  $unitsql = mysqli_query($con, "update purpose set title = '" . $title . "', sub_title = '" . $sub_title . "', description = '" . $description . "',image = '" . $image . "', status='1' , edate= '" . $curdate . "', etime= '" . $curtime . "' where id = '" . $edit_id . "'") or die(mysqli_error($con));

  header("location:purpose.php?act=edit");

  return true;
}

function updateSeo($con, $req, &$outputMsg)
{
  $title    = trim($req['title']);
  $meta_title   = trim($req['meta_title']);
  $meta_description   = trim($req['meta_description']);
  $meta_keyword   = trim($req['meta_keyword']);
  $header   = trim($req['header']);
  $footer   = trim($req['footer']);
  $body   = trim($req['body']);
  $status = trim($req['status']);
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
    $target_img = "./data/seo/" . $image;


    if (!move_uploaded_file($_FILES["attached_image"]["tmp_name"], $target_img)) {
      $outputMsg = "File upload failed.";
      return false;
    }
  } else {
    $image = $_POST['existing_image'] ?? '';
  }

  // echo "update publication set title = '" . htmlentities($title) . "',date = '" . $date . "',venue  = '" . $venue  . "',media  = '" . $media  . "',description = '" . htmlentities($description) . "', banner_image = '" . $banner_image . "',url = '" . htmlentities($url) . "', edate = '" . $curdate . "', etime = '" . $curtime . "' where id='" . $edit_id . "'"; die;

  $unitsql = mysqli_query($con, "update seo set title = '" . $title . "', meta_title = '" . $meta_title . "', meta_description = '" . $meta_description . "',meta_keyword = '" . $meta_keyword . "', header = '" . $header . "', footer = '" . $footer . "',body = '" . $body . "',status = '" . $status . "',image = '" . $image . "', edate= '" . $curdate . "', etime= '" . $curtime . "' where id = '" . $edit_id . "'") or die(mysqli_error($con));

  header("location:manage_seo.php?act=edit");

  return true;
}

function editSetting($con, $req, &$outputMsg)
{

  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);


  $address1    = trim($req['address1']);
  $address2   = trim($req['address2']);
  $address3   = trim($req['address3']);
  $phone1   = trim($req['phone1']);
  $phone2   = trim($req['phone2']);
  $phone3   = trim($req['phone3']);
  $email1 = trim($req['email1']);
  $email2 = trim($req['email2']);
  $email3 = trim($req['email3']);
  $fburl = trim($req['fburl']);
  $igurl = trim($req['igurl']);
  $yturl = trim($req['yturl']);
  $liurl = trim($req['liurl']);
  $pturl = trim($req['pturl']);
  $curtime = date('H:i:s');
  $curdate = date('Y-m-d');

  $edit_id = $req['id'];


  $logo = '';

  if (isset($_FILES['attached_logo']['name']) && $_FILES['attached_logo']['error'] == 0) {
    $original_filename = $_FILES['attached_logo']['name'];
    $file_ext = substr($original_filename, strripos($original_filename, '.'));

    if (!in_array($file_ext, ['.png', '.jpg', '.jpeg', '.gif'])) {
      $outputMsg = "Only jpg, jpeg, png, and gif format images are allowed to upload.";
      return false;
    }

    $original_filename_without_numbers = preg_replace('/^\d+/', '', pathinfo($original_filename, PATHINFO_FILENAME)) . $file_ext;


    $minute = date('i');
    $second = date('s');

    $renamed_logo = $minute . $second . $original_filename_without_numbers;


    $logo = $renamed_logo;
    $target_img = "./data/logo/" . $logo;


    if (!move_uploaded_file($_FILES["attached_logo"]["tmp_name"], $target_img)) {
      $outputMsg = "File upload failed.";
      return false;
    }
  } else {
    $logo = $_POST['existing_logo'] ?? '';
  }

  $faviconLogo = '';

  if (isset($_FILES['attached_faviconLogo']['name']) && $_FILES['attached_faviconLogo']['error'] == 0) {
    $original_filename = $_FILES['attached_faviconLogo']['name'];
    $file_ext = substr($original_filename, strripos($original_filename, '.'));

    if (!in_array($file_ext, ['.png', '.jpg', '.jpeg', '.gif'])) {
      $outputMsg = "Only jpg, jpeg, png, and gif format images are allowed to upload.";
      return false;
    }

    $original_filename_without_numbers = preg_replace('/^\d+/', '', pathinfo($original_filename, PATHINFO_FILENAME)) . $file_ext;


    $minute = date('i');
    $second = date('s');

    $renamed_faviconLogo = $minute . $second . $original_filename_without_numbers;


    $faviconLogo = $renamed_faviconLogo;
    $target_img = "./data/favicon_logo/" . $faviconLogo;


    if (!move_uploaded_file($_FILES["attached_faviconLogo"]["tmp_name"], $target_img)) {
      $outputMsg = "File upload failed.";
      return false;
    }
  } else {
    $faviconLogo = $_POST['existing_faviconLogo'] ?? '';
  }

  // echo "update publication set title = '" . htmlentities($title) . "',date = '" . $date . "',venue  = '" . $venue  . "',media  = '" . $media  . "',description = '" . htmlentities($description) . "', banner_image = '" . $banner_image . "',url = '" . htmlentities($url) . "', edate = '" . $curdate . "', etime = '" . $curtime . "' where id='" . $edit_id . "'"; die;

  $unitsql = mysqli_query($con, "update setting set address1 = '" . $address1 . "', address2 = '" . $address2 . "', address3 = '" . $address3 . "',phone1 = '" . $phone1 . "', phone2 = '" . $phone2 . "', phone3 = '" . $phone3 . "',email1 = '" . $email1 . "',email2 = '" . $email2 . "',email3 = '" . $email3 . "',fburl = '" . $fburl . "',igurl = '" . $igurl . "',yturl = '" . $yturl . "',liurl = '" . $liurl . "',pturl = '" . $pturl . "',logo = '" . $logo . "',faviconLogo = '" . $faviconLogo . "',status = '1', edate= '" . $curdate . "', etime= '" . $curtime . "' where id = '" . $edit_id . "'") or die(mysqli_error($con));

  header("location:setting.php?act=edit");

  return true;
}

function updateRole($con, $req, &$outputMsg)
{
  $status = trim($req['status']);

  $sqlQry = mysqli_query($con, "select * from permission where id = '1'");

  $permissionInfo = array_slice(mysqli_fetch_assoc($sqlQry), 1);

  $edit_id = $req['id'];

  foreach ($permissionInfo as $permissionInfo) {
    ${$permissionInfo} = '0';
  }

  foreach ($req['permission'] as $permission) {
    ${preg_replace('/\s+/', '', $permission)} = '1';
  }

  $name = trim($req['role_name']);

  $curtime = date('H:i:s');
  $curdate = date('Y-m-d');

  $sqlQry = mysqli_query($con, "
  update role SET 
  role_name = '" . $name . "', 
  user_show = '" . $user_show . "', 
  user_edit = '" . $user_edit . "', 
  user_remove = '" . $user_remove . "', 
  user_add = '" . $user_add . "', 
  banner_show = '" . $banner_show . "', 
  banner_edit = '" . $banner_edit . "', 
  banner_remove = '" . $banner_remove . "', 
  banner_add = '" . $banner_add . "', 
  latest_show = '" . $latest_show . "', 
  latest_edit = '" . $latest_edit . "', 
  latest_remove = '" . $latest_remove . "', 
  latest_add = '" . $latest_add . "', 
  people_show = '" . $people_show . "', 
  people_edit = '" . $people_edit . "', 
  people_remove = '" . $people_remove . "', 
  people_add = '" . $people_add . "', 
  purpose_show = '" . $purpose_show . "', 
  purpose_edit = '" . $purpose_edit . "', 
  purpose_remove = '" . $purpose_remove . "', 
  purpose_add = '" . $purpose_add . "', 
  event_show = '" . $event_show . "', 
  event_edit = '" . $event_edit . "', 
  event_remove = '" . $event_remove . "', 
  event_add = '" . $event_add . "', 
  publication_show = '" . $publication_show . "', 
  publication_edit = '" . $publication_edit . "', 
  publication_remove = '" . $publication_remove . "', 
  publication_add = '" . $publication_add . "', 
  reports_show = '" . $reports_show . "', 
  reports_edit = '" . $reports_edit . "', 
  reports_remove = '" . $reports_remove . "', 
  reports_add = '" . $reports_add . "', 
  form = '" . $form . "', 
  seo_show = '" . $seo_show . "', 
  seo_edit = '" . $seo_edit . "', 
  seo_remove = '" . $seo_remove . "', 
  seo_add = '" . $seo_add . "', 
  role_show = '" . $role_show . "', 
  role_edit = '" . $role_edit . "', 
  role_remove = '" . $role_remove . "', 
  role_add = '" . $role_add . "', 
  setting_show = '" . $setting_show . "', 
  setting_edit = '" . $setting_edit . "', 
  setting_remove = '" . $setting_remove . "', 
  setting_add = '" . $setting_add . "', 
  status = '" . $status . "', 
  edate = '" . $curdate . "', 
  etime = '" . $curtime . "' 
  where id = '" . $edit_id . "'
") or die(mysqli_error($con));

  header("location: role_management.php?act=edit");
  // Always include exit after a header redirect
  return true;
}

function updatePermission($con, $req, &$outputMsg)
{

  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  $edit_id = $req['id'];

  $name = trim($req['name']);

  if ($req['show'] == true) {
    $show = '1';
  } else {
    $show = '0';
  }
  if ($req['add'] == true) {
    $add = '1';
  } else {
    $add = '0';
  }
  if ($req['edit'] == true) {
    $edit = '1';
  } else {
    $edit = '0';
  }
  if ($req['remove'] == true) {
    $remove = '1';
  } else {
    $remove = '0';
  }


  $edit_id = $req['id'];


  $curtime = date('H:i:s');
  $curdate = date('Y-m-d');


  $unitsql = mysqli_query($con, "UPDATE `permission` SET `name`='" . $name . "',`show`='" . $show . "',`add`='" . $add . "',`edit`='" . $edit . "',`remove`='" . $remove . "' WHERE id = '" . $edit_id . "'") or die(mysqli_error($con));
  // $unitsql = mysqli_query($con, "UPDATE `permission` SET `name`='" . $name . "',`show`='" . $show . "' WHERE id = '".$edit_id."'") or die(mysqli_error($con));

  header("location: permission_management.php?act=edit");
  // Always include exit after a header redirect
  return true;
}


// Database connection (assuming `$con` is established properly)

function addPermission($inputData, $con)
{
  if ($inputData) {
    foreach ($inputData as $key => $value) {
      $escapedValue = $con->real_escape_string($value);

      $columnCheckSql = "SELECT * FROM permission where name = '$escapedValue'";
      $columnExists = $con->query($columnCheckSql);

      if ($columnExists->num_rows == 0) {
        // Column does not exist, so add it
        $updateSql = "insert into permission SET name = '$escapedValue'";
        if (!$con->query($updateSql)) {
          echo json_encode([
            'status' => 'error',
            'message' => "Error updating column `$key`: " . $con->error,
          ]);
          return;
        }
      }

      // Update the value for the column

    }

    echo json_encode(['status' => 'success', 'message' => 'Permissions updated successfully.']);
  } else {
    echo json_encode(['status' => 'error', 'message' => 'No data received.']);
  }
}



function viewData($con, $table, $id)
{
  $getQur = mysqli_query($con, "select * from $table WHERE id = '" . $id . "'");
  $result = mysqli_fetch_assoc($getQur);

  return $result;
}

function getData($con, $table)
{
  $getQur = mysqli_query($con, "select * from $table");
  $result = mysqli_fetch_assoc($getQur);

  return $result;
}

function getPermissionName($con, $table)
{
  $getQur = mysqli_query($con, "select * from $table");
  $result = mysqli_fetch_assoc($getQur);

  return $result;
}

function editData($con, $table, $id)
{
  $getQur = mysqli_query($con, "select * from $table WHERE id = '" . $id . "'");
  $result = mysqli_fetch_assoc($getQur);

  return $result;
}


function deleteDataWithImg($con, $table, $id, $imgPath)
{
  $result = mysqli_fetch_assoc(mysqli_query($con, "select * from $table WHERE id = '" . $id . "'"));


  if (file_exists($imgPath)) {
    // Attempt to unlink (delete) the file
    if (unlink($imgPath)) {
      echo "The file has been deleted successfully.";
    } else {
      echo "Error: Unable to delete the file.";
    }
  } else {
    echo "Error: File does not exist.";
  }

  $true = mysqli_query($con, "delete from $table WHERE id = '" . $id . "'");

  return $true;
}


function clean($string)
{
  $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
  $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

  return strtolower(preg_replace('/-+/', '-', $string)); // Replaces multiple hyphens with single one.  
}
