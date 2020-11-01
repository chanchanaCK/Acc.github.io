<?php
include "config/database.php";
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/one-page-wonder.min.css" rel="stylesheet">
    <title>Accounting</title>
  </head>
  <body>
    <header>
    <?php include "template/header.php"; ?> <br><br><br>
    </header>
    <br>
    <div class="container">
      <form method="post" action="process/accountNumberProcess.php?action=insert">
        <div class="form-group">
          <label>รายการ</label>
            <input type="text" class="form-control" name="list" required>
        </div>
        <div class="form-group">
          <label>เลขที่บัญชี</label>
            <input type="text" class="form-control" name="acc_number" required>
        </div>
        <button type="submit" class="btn btn-primary">บันทึก</button>
        <button type="reset" class="btn btn-danger">ล้างฟอร์ม</button>
      </form>
    </div>
    <br>
    <div class="container">
      <div class="table-responsive">
        <table class="table">
          <tr>
            <th>เลขบัญชี</th>
            <th>รายการ</th>
          </tr>
          <?php
          $sql = "SELECT * FROM tb_account_number";
          $result = mysqli_query($conn,$sql);
          while ($data = mysqli_fetch_array($result)) {
          ?>
          <tr>
            <td><?php echo $data['acc_number']; ?></td>
            <td><?php echo $data['list']; ?></td>
          </tr>
          <?php
          }
          ?>

        </table>
      </div>
    </div>


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="bootstrap/js/jquery-3.3.1.slim.min.js" ></script>
    <script src="bootstrap/js/popper.min.js" ></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
