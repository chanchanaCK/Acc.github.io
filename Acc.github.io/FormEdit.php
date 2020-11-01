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
    <title>Edit</title>
  </head>
  <body>
    <header>
    <?php include "template/header.php"; ?><br><br><br>
    </header>
    <br>
    <div class="container">

      <p>
        <a>
          แก้ไขข้อมูล
        </a>
    </p>
    <?php $ids = $_GET['id']?>
      <div class="container">
        <div class="card card-body">
          <form method="post" action="process/BookProcess.php?action=update&id=<?php echo $ids?>">

            <div class="form-group">



              <label>วันที่</label>
              <input type="date" class="form-control" name="date" required >
            </div>

            <div class="form-group">
              <label>เลขที่บัญชี</label>
              <select name="acc_id" class="form-control">
                <option value="">เลือกเลขที่บัญชี</option>
                <?php
                $sql = "SELECT * FROM tb_account_number";
                $result = mysqli_query($conn,$sql);
                while ($data = mysqli_fetch_array($result)) {
                  echo '<option value="'.$data['acc_id'].'">'.$data['acc_number'].' - '.$data['list'].'</option>';
                }
                ?>

              </select>
            </div>
            <div class="form-group">
              <label>จำนวนเงิน</label>
                <input type="text" class="form-control" name="cost">
            </div>
            <div class="form-group">
              <label>ประเภท</label>
              <select class="form-control" name="status">
                <option value="">ประเภท</option>
                <option value="debit">เดบิต</option>
                <option value="credit">เครดิต</option>
              </select>
            </div>
            <div class="form-group">
              <label>รายละเอียดเพิ่มเติม</label>
                <input type="text" class="form-control" name="detail">
            </div>
            <button type="submit" class="btn btn-primary">บันทึก</button>
            <button type="reset" class="btn btn-danger">ล้างฟอร์ม</button>
          </form>
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
