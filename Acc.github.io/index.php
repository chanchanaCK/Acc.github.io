<?php
include "config/database.php";
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Accounting</title>

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


  </head>
  <body>
    <header>
    <?php include "template/header.php"; ?>
    </header>

    <!-- Custom styles -->
    <header class="masthead text-center text-white">
      <div class="masthead-content">
        <div class="container">
          <h1 class="masthead-heading mb-0">WELCOME</h1>
          <h2 class="masthead-subheading mb-0">โปรแกรมบัญชีออนไลน์</h2>
        </div>
      </div>
      <div class="bg-circle-1 bg-circle"></div>
      <div class="bg-circle-2 bg-circle"></div>
      <div class="bg-circle-3 bg-circle"></div>
      <div class="bg-circle-4 bg-circle"></div>
    </header>

    <section>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 order-lg-2">
          <div class="p-5">
            <img class="img-fluid rounded-circle" src="img/001.jpeg" alt="">
          </div>
        </div>
        <div class="col-lg-6 order-lg-1">
          <div class="p-5">
            <h2 class="display-4">การบัญชี</h2>
            <p>การบัญชี (Accounting) หมายถึงศิลปะของการเก็บรวบรวม บันทึก จำแนก และทำสรุปข้อมูลและการให้ข้อมูลทางการเงิน ซึ่งเป็น ประโยชน์แก่บุคคล หลายฝ่ายและ ผู้ที่สนใจในกิจกรรมของกิจการ</p>
          </div>
        </div>
      </div>
    </div>
  </section>

<br>
<br>
    <div class="container">

      <p>
        <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
          เพิ่มข้อมูล

        </a>


      </p>
      <div class="collapse" id="collapseExample">
        <div class="card card-body">
          <form method="post" action="process/BookProcess.php?action=insert">
            <div class="form-group">
              <label>วันที่</label>
              <input type="date" class="form-control" name="date" required>
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


    </div>
    <br>
    <div class="container">
      <div class="table-responsive">
        <table class="table">
          <tr>
            <th>วันที่</th>
            <th>รายการ</th>
            <th>เลขที่บัญชี</th>
            <th>จำนวนเงิน</th>
            <th>สถานะ</th>
            <th>รายละเอียดเพิ่มเติม</th>
            <th>แก้ไข/ลบ</th>
          </tr>
          <?php
          $sql = "SELECT * FROM tb_account_book book
                           LEFT JOIN tb_account_number accnum
                           ON book.acc_id = accnum.acc_id";
          $result = mysqli_query($conn,$sql);
          while ($data = mysqli_fetch_array($result)) {
          ?>
          <tr>
            <td><?php echo $data['date'];?></td>
            <td><?php echo $data['list'];?></td>
            <td><?php echo $data['acc_number'];?></td>
            <td><?php if ($data['list']!=NULL){
                echo (int)$data['cost'];
            } else {
            echo "";
            }?>

            </td>

            <td><?php echo $data['status'];?></td>
            <td><?php echo $data['detail'];?></td>
            <td>
              <a href="FormEdit.php?action=update&id=<?php echo $data['id']?>" class="btn btn-success btn-sm">แก้ไข</a>
              <a href="process/BookProcess.php?action=delete&id=<?php echo $data['id']?>" onclick="return confirm('ต้องการลบข้อมูลหรือไม่?')" class="btn btn-danger btn-sm">ลบ</a>
            </td>
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
