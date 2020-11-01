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

    <title>บัญชีแยกประเภท</title>
  </head>
  <body>
<header>
  <?php include "template/header.php" ?><br><br><br>
</header>
<br>
<br>
<br>
<br>
<center>
<h3>ร้านกระเป๋าสตางค์</h3>
<h3>บัญชีแยกประเภท</h3>
<h3>ณ วันที่ 30 พฤษจิกายน พ.ศ. 2561 </h3></center>
<br>

<?php $sql = "SELECT * FROM tb_account_book book
                 LEFT JOIN tb_account_number accnum
                 ON book.acc_id = accnum.acc_id
                 WHERE book.acc_id != 0
                 GROUP BY accnum.acc_number ASC ";
$result = mysqli_query($conn,$sql);

?>
<div class="container">
<?php

while ($data = mysqli_fetch_array($result)) {

 ?>
<br>
<div class="form-row">
  <div class="col-md-4">

  </div>
  <div class="col-md-4">
    <div align= "center">
      <label><font size="4"><b>
        ชื่อบัญชี <?php echo$data["list"] ?>
      </b></font></lebel>

  </div>
    </div>
      <br>
<div class="col-md-4">
  <div align="right">
    <div class="form-group">
<label>เลขที่บัญชี <?php echo $data["acc_number"] ?>
</label>
    </div>
  </div>
</div>
</div>

<div>
  <div class="col-md-12 mb-3" align = "Center">
    <table class="table">
      <thead>

      </thead>

    <tbody>

      <tr>
        <td width = "50%" >
<table  class="table table-bordered">
  <thead class="thead-dark" >
    <tr align= "center" >
      <th width="20%" colspan = "3">วันเดือนปี</th>
      <th width= 10% rowspan="2">รายการ</th>
      <th rowspan="2" >หน้าบัญชี</th>
      <th rowspan="2" >เดบิต</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $acc_num = $data["acc_number"];
   $sql_debit = "SELECT * FROM tb_account_book book
                     LEFT JOIN tb_account_number acc
                     ON book.acc_id = acc.acc_id
                     WHERE status= 'debit' and acc.acc_number = $acc_num
                     GROUP BY date ";
            $rs_debit = mysqli_query($conn,$sql_debit);
            $total_cost_debit = 0;
            while ($data_debit = mysqli_fetch_array($rs_debit)) {
              $date_debit = date_create($data_debit['date']);
              $month_debit = dateThai(date_format($date_debit, 'm'));
              $day_debit =  date_format($date_debit, 'd');
              $year_debit =  date_format($date_debit, 'Y');
               $year_debit +=543;
               $start_date_debit = $data_debit['date'];
               $total_cost_debit += $data_debit['cost'];

?>
<tr align="center">
  <td width= "5%"> <?php echo $year_debit;?></td>
  <td width= "5%"> <?php echo $month_debit;?></td>
  <td width= "5%"> <?php echo $day_debit;?></td>
<td width="20%">
  <?php
  $sql_list_debit = "SELECT * FROM tb_account_book book
                   LEFT JOIN tb_account_number acc
                   ON book.acc_id = acc.acc_id
                   WHERE date = $start_date_debit";
    $rs_list_debit = mysqli_query($conn, $sql_list_debit);
    while ($data_list_debit = mysqli_fetch_array($rs_list_debit)) {
      echo $data_list_debit['list'];
    }
   ?>
</td>
<td width="9%">ร.ว.1</td>
<td width="9%"><?php echo number_format($data_debit['cost']); ?></td>

</tr>
<?php
}
 ?>
</td>
<tr>
 <td width=5%></td>
  <td width=5%></td>
   <td width=5%></td>
    <td width=20%></td>
     <td width=9%></td>
      <td width=9%><div align="center"><font color = "E40404"><?php echo number_format($total_cost_debit,2); ?></font></div></td>
      </tr>

  </tbody>
</table>
<td width=50% >
  <table class="table table-bordered">
    <thead>
      <tr align="center" >
          <th width =20% colspan="3" >วันเดือนปี</th>
          <th width =10% rowspan="2" >รายการ</th>
          <th rowspan="2" >หน้าบัญชี</th>
          <th rowspan="2" >เครดิต</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $acc_num = $data["acc_number"];
      $sql_credit = "SELECT * FROM tb_account_book book
                      LEFT JOIN tb_account_number acc ON book.acc_id = acc.acc_id
                      WHERE status='credit'and acc.acc_number = $acc_num
                       GROUP BY date ";
        $rs_credit = mysqli_query($conn, $sql_credit);

$total_cost_credit = 0;
        while ($data_credit= mysqli_fetch_array($rs_credit)) {
          $date_credit = date_create($data_credit['date']);
          $month_credit = dateThai(date_format($date_credit, 'm'));
          $day_credit =  date_format($date_credit, 'd');
          $year_credit =  date_format($date_credit, 'Y');
           $year_credit +=543;
           $start_date_credit = $data_credit['date'];
           $total_cost_credit += $data_credit['cost'];
       ?>
       <tr align="center">
         <td width= "5%"> <?php echo $year_credit;?></td>
         <td width= "5%"> <?php echo $month_credit;?></td>
         <td width= "5%"> <?php echo $day_credit;?></td>
       <td width="20%">
         <?php
          $sql_list_credit = "SELECT * FROM tb_account_book book
                          LEFT JOIN tb_account_number acc
                          ON book.acc_id = acc.acc_id
                          WHERE date = $start_date_credit";
           $rs_list_credit = mysqli_query($conn, $sql_list_credit);
           while ($data_list_credit = mysqli_fetch_array($rs_list_credit)) {
             echo $data_list_credit['list'];
           }
          ?>
          </td>

          <td width = "9%">ร.ว.1</td>
          <td width="9%"><?php echo number_format($data_credit['cost']); ?></td>
        </tr>
        <?php
      }
       ?>
       </td>
          <tr>
           <td width=5%></td>
            <td width=5%></td>
             <td width=5%></td>
              <td width=20%></td>
               <td width=9%></td>

                <td width=9%><div align="center"><font color = "#E40404"><?php echo number_format($total_cost_credit,2); ?></font></div></td>
                </tr>
    </tbody>

  </table>

</td>
</tr>
</tbody>
</table>
  </div>
</div>
<?php
$total = 0;
if ($total_cost_debit >$total_cost_credit) {
  $total = $total_cost_debit - $total_cost_credit;
 ?>
 <div class="form-row">
   <div class="col-md-3 mb-3">
     </div>
   <div class="col-md-3 mb-3"
   <a align= "right">ยอดรวม &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size = "5" color = "#f9320c"><?php echo number_format($total,2) ?></font></a>
 </div>
   <div class="col-md-3 mb-3">
     </div>
     <div class="col-md-3 mb-3">
       <a align="rignt">ยอดรวม </a>
       </div>
 </div>
 <?php
 }

 if($total_cost_credit >$total_cost_debit ) {
$total = $total_cost_credit - $total_cost_debit;
  ?>
  <div class="form-row">
    <div class="col-md-3 mb-3">
      </div>
    <div class="col-md-3 mb-3"
    <a align="rignt">ยอดรวม </a>
  </div>
  <div class="col-md-3 mb-3">
    </div>
  <div class="col-md-3 mb-3"
  <a align= "right">ยอดรวม &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size = "5" color = "#f9320c"><?php echo number_format($total,2) ?></font></a>
  </div>
</div>
<?php
}
 ?>
 <br>
 <br>
<?php
}
 ?>

</div>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="bootstrap/js/jquery-3.3.1.slim.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js" ></script>
    </body>
  </html>
  <?php
  function dateThai($int)
{
  $num = intval($int);
  $arr =  ["","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย","ธ.ค."];
return $arr[$num];

}

  ?>
