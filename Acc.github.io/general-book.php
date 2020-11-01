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
    <title>สมุดรายวันทั่วไป</title>
  </head>
  <body>
    <header>
    <?php include "template/header.php"; ?> <br><br><br>
    </header>
    <br>
    <br>
    <br>
    
    <center>
     <h3>ร้านกระเป๋าสตางค์</h3>
     <h3>สมุดบัญชีรายวันทั่วไป</h3>
     <h3>ณ วันที่ 30 พฤษจิกายน พ.ศ. 2561 </h3></center><br>
    <br>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <table class="table table-bordered">
            <tr>
              <td colspan="2">วัน/เดือน/ปี</td>
              <td rowspan="2">รายการ</td>
              <td rowspan="2">เลขที่บัญชี</td>
              <td colspan="2">เดบิต</td>
              <td colspan="2">เครดิต</td>
            </tr>
            <tr>
              <td>เดือน</td>
              <td>วัน</td>
              <td>บาท</td>
              <td>สต.</td>
              <td>บาท</td>
              <td>สต.</td>

            </tr>
            <?php
            $sql ="SELECT*FROM tb_account_book book
                              LEFT JOIN tb_account_number acc
                              ON book.acc_id = acc.acc_id
                              ORDER BY date , book.id ASC";
            $result = mysqli_query($conn ,$sql);
            //
            $old_month ="";
            $old_day="";
            //
            while ($data = mysqli_fetch_array($result)) {
              //แยกวันที่
              $date = date_create($data['date']);
              $year = date_format($date,'Y');
              $month = date_format($date,'m');
              $day = date_format($date,'j');
              ?>

              <tr>
                <td><?php
                if ($old_month!= $month) {
                  echo monthThai($month);
                  $old_month = $month;
                }
                 ?>
              </td>
                <td><?php
                if ($old_day!=$day) {
                  echo $day;
                  $old_day = $day;
                }
                 ?></td>
                <td>
                  <?php
                  if ($data['status'] == 'debit') {
                    echo $data['list'];
                  }else if ($data['status'] == 'credit') {
                    echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$data['list'];
                  }else {
                    echo $data['detail'];
                  }
                 ?>
               </td>

                <td><?php echo $data['acc_number']; ?></td>
                <td><?php
                  if ($data['status'] == 'debit') {
                    echo (int)$data['cost'];

                  }
                 ?></td>
                <td>-</td>
                <td>
                  <?php
                    if ($data['status'] == 'credit') {
                      echo (int)$data['cost'];
                    }
                   ?>
                </td>
                <td>-</td>
              <?php
            }
             ?>


            </tr>
          </table>
        </div>

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
<?php
function monthThai($num){
  $month_num = (int)$num;
  $array_month = array( "",
                        "ม.ค.",
                        "ก.พ.",
                        "มี.ค.",
                        "เม.ย.",
                        "พ.ค.",
                        "มิ.ย.",
                        "ก.ค.",
                        "ส.ค.",
                        "ก.ย.",
                        "ต.ค.",
                        "พ.ย.",
                        "ธ.ค.");
$month_thai = $array_month[$month_num];
return $month_thai;
}

 ?>
