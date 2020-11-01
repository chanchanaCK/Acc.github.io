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
    <title>งบทดลอง</title>
  </head>
      <body>
        <header>
        <?php include "template/header.php"; ?><br><br><br>
        </header>
        <br>
        <br>
        <br>
        <br>
        <center>
        <h3>ร้านกระเป๋าสตางค์</h3>
        <h3>งบทดลอง</h3>
        <h3>ณ วันที่ 30 พฤษจิกายน พ.ศ. 2561 </h3></center>
        <br>
          <table class="table table-bordered">
            <thead>
            <tr align="center">
              <th width="20%" rowspan="2">ชื่อบัญชี</th>
              <th width="10%" rowspan="2">เลขที่บัญชี</th>
              <th colspan="2">เดบิต</th>
              <th colspan="2">เครดิต</th>
            </tr>
            <tr align="center">
              <th width="20%">บาท</th>
              <th width="5%">สต.</th>
              <th width="20%">บาท</th>
              <th width="5%">สต.</th>
            </tr>

          </thead>
          <tbody>
            <?php
             $sql = "SELECT * FROM tb_account_book book
                               LEFT JOIN tb_account_number accnum ON book.acc_id = accnum.acc_id
                               WHERE book.acc_id != 0
                               GROUP BY accnum.acc_number ASC ";
             $result = mysqli_query($conn, $sql);
             $total_all_debit1 = 0;
             $total_all_credit1 = 0;
             $total_all = 0;
             while ($data = mysqli_fetch_array($result)){
               ?>
               <tr align="center">
                 <td><?php echo $data['list'] ?></td>
                 <td><?php echo $data['acc_number'] ?></td>
               <?php
               $acc_num = $data['acc_number'];


               $sql_debit = "SELECT * FROM tb_account_book book
                              LEFT JOIN tb_account_number acc ON book.acc_id = acc.acc_id
                              WHERE status = 'debit' and acc.acc_number = $acc_num
                              GROUP BY date";
               $re_debit = mysqli_query($conn, $sql_debit);
               $total_cost_debit = 0;

               $sql_credit = "SELECT * FROM tb_account_book book
                              LEFT JOIN tb_account_number acc ON book.acc_id = acc.acc_id
                              WHERE status = 'credit' and acc.acc_number = $acc_num
                              GROUP BY date";
               $re_credit = mysqli_query($conn, $sql_credit);
               $total_cost_credit = 0;
              //
               $sql_sum = "SELECT * FROM tb_account_book book
                              LEFT JOIN tb_account_number acc ON book.acc_id = acc.acc_id
                              WHERE acc_number BETWEEN '100' AND '299'
                              GROUP BY date";
               $re_sum = mysqli_query($conn, $sql_sum);
               $total_sum = 0;
//

               // $sql_credit2 = "SELECT * FROM tb_book b00k"

               while ($data_debit = mysqli_fetch_array($re_debit)) {
                 $total_cost_debit += $data_debit['cost'];
               }
               while ($data_credit = mysqli_fetch_array($re_credit)) {
                 $total_cost_credit += $data_credit['cost'];
               }
//
               while ($data_sum = mysqli_fetch_array($re_debit)) {
                  $total_cost_debit += $data_sum['cost'];
               }
//
               $total = 0;



               if ($total_cost_debit >= $total_cost_credit) {
                 $total = $total_cost_debit -$total_cost_credit;
                 $total_all_debit1 += $total;
                 ?>
                 <td><?php echo number_format($total,2) ?></td>
                 <td>-</td>
                 <td></td>
                 <td></td>
                 <?php
               }
               else {
                 $total = $total_cost_credit -$total_cost_debit;
                 $total_all_credit1 += $total
                 ?>
                 <td></td>
                 <td></td>
                 <td><?php echo number_format($total,2) ?></td>
                 <td></td>
                 <?php
               }
               ?>
               </tr>
               <?php
             }
             ?>
             <tr align="center">


               <td><?php echo number_format($data_sum,2) ?></td>
               <td>-</td>
               <td><?php echo number_format($total_all_credit1,2) ?></td>
               <td>-</td>
               <td><?php echo number_format($total_all_credit1,2) ?></td>
               <td>-</td>
             </tr>
          </tbody>
          </table>
        </div>
        <script src="bootstrap/js/jquery-3.3.1.slim.min.js" ></script>
        <script src="bootstrap/js/popper.min.js" ></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
      </body>
      </html>
