<?php
include "../config/database.php";
// if (isset($_GET['action']) && $_GET['action']=="insert") {
if (isset($_GET['action']) && $_GET['action']=="insert") {
  $acc_number = $_POST['acc_number'];
  $list = $_POST['list'];

  $sql = "INSERT INTO tb_account_number (acc_id,acc_number,list)
                 VALUES (NULL,'$acc_number','$list')";

  $result = mysqli_query($conn, $sql);
  header("refresh:1; url=../accountNumber.php");
}


if (isset($_GET['action']) && $_GET['action']=="update") {
  echo "update";
}

if (isset($_GET['action']) && $_GET['action']=="delete") {
  echo "delete";
}
?>
