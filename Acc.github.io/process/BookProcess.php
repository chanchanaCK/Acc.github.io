<?php
include "../config/database.php";
if (isset($_GET['action']) && $_GET['action']=="insert") {
  $date = $_POST['date'];
  $detail = $_POST['detail'];
  $acc_id = $_POST['acc_id'];
  $cost = $_POST['cost'];
  $status = $_POST['status'];
  $sql = "INSERT INTO tb_account_book (id,date,detail,acc_id,cost,status)
              VALUES (NULL, '$date', '$detail', '$acc_id', '$cost', '$status')";
  $result = mysqli_query($conn , $sql);
  header("location: ../index.php");
}

if (isset($_GET['action']) && $_GET['action']=="update") {
  $date = $_POST['date'];
  $detail = $_POST['detail'];
  $acc_id = $_POST['acc_id'];
  $cost = $_POST['cost'];
  $status = $_POST['status'];

  $ids = $_GET['id'];



 $sql = "UPDATE tb_account_book
SET date='$date',detail='$detail',cost=$cost,acc_id=$acc_id,status='$status'
WHERE id= $ids";
  $result = mysqli_query($conn , $sql);
  header("location: ../index.php");

}

if (isset($_GET['action']) && $_GET['action']=="delete") {
    $id = $_GET['id'];
    $sql = "DELETE FROM tb_account_book WHERE id = $id";
    $result = mysqli_query($conn,$sql);
    header("location: ../index.php");
}

?>
