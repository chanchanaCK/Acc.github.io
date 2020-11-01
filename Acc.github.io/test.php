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
    <title>กระดาษทำการ</title>
  </head>
  <body>
    <div class="container">
      <font size='5'><center><p>ÃéÒ¹¢ÒÂ ¿Ô¡à¡ÍÃì</p></center></font>
      <font size='4'><center><p>¡ÃÐ´ÒÉ·Ó¡ÒÃ</p></center></font>
      <br>
      <table class="table table-bordered">
        <thead>
        <tr align="center">
          <th width="20%" rowspan="2">ª×èÍºÑ­ªÕ</th>
          <th width="10%" rowspan="2">àÅ¢·ÕèºÑ­ªÕ</th>
          <th colspan="2">§º·´ÅÍ§</th>
          <th colspan="2">§º¡ÓäÃ¢Ò´·Ø¹</th>
          <th colspan="2">§º´ØÅ</th>
        </tr>
        <tr align="center">
          <th width="10%">à´ºÔµ</th>
          <th width="10%">à¤Ã´Ôµ</th>
          <th width="10%">à´ºÔµ</th>
          <th width="10%">à¤Ã´Ôµ</th>
          <th width="10%">à´ºÔµ</th>
          <th width="10%">à¤Ã´Ôµ</th>
        </tr>

      </thead>
      <tbody>
        <?php
         $sql = "SELECT * FROM tb_book book
                           LEFT JOIN tb_account_number accnum ON book.acc_id = accnum.acc_id
                           WHERE book.acc_id != 0
                           GROUP BY accnum.acc_number ASC ";
         $result = mysqli_query($conn, $sql);

         $total_all_debit1 = 0;
         $total_all_credit1 = 0;
         $total_all_debit2 = 0;
         $total_all_credit2 = 0;


         $sum_balance_debit = 0;
         $sum_balance_credit = 0;
         while ($data = mysqli_fetch_array($result)){

           ?>
           <tr align="center">
             <td><?php echo $data['list'] ?></td>
             <td><?php echo $data['acc_number'] ?></td>
           <?php
           $acc_num = $data['acc_number'];



           $sql_debit1 = "SELECT * FROM tb_book book
                          LEFT JOIN tb_account_number acc ON book.acc_id = acc.acc_id
                          WHERE status = 'debit' and acc.acc_number = $acc_num
                          GROUP BY date";
           $re_debit1 = mysqli_query($conn, $sql_debit1);
           $total_cost_debit1 = 0;

           $sql_credit1 = "SELECT * FROM tb_book book
                          LEFT JOIN tb_account_number acc ON book.acc_id = acc.acc_id
                          WHERE status = 'credit' and acc.acc_number = $acc_num
                          GROUP BY date";
           $re_credit1 = mysqli_query($conn, $sql_credit1);
           $total_cost_credit1 = 0;

           // $sql_credit2 = "SELECT * FROM tb_book b00k"



           while ($data_debit1 = mysqli_fetch_array($re_debit1)) {
             $total_cost_debit1 += $data_debit1['cost'];
           }
           while ($data_credit1 = mysqli_fetch_array($re_credit1)) {
             $total_cost_credit1 += $data_credit1['cost'];
           }

           $total1 = 0;

           if ($total_cost_debit1 >= $total_cost_credit1) {
             $total1 = $total_cost_debit1 -$total_cost_credit1;
             $total_all_debit1 += $total1;
             ?>
             <td><?php echo number_format($total1,2) ?></td>
             <td></td>
             <?php
           }
           else {
             $total1 = $total_cost_credit1 -$total_cost_debit1;
             $total_all_credit1 += $total1
             ?>
             <td></td>
             <td><?php echo number_format($total1,2) ?></td>
             <?php
           }

           ?>
           <!--  <?php
           if ($total_cost_debit2 >= $total_cost_credit2) {
               $total2 = $total_cost_debit2 - $total_cost_credit2;
               $total_all_debit2 += $total2;
               ?>
               <td><?php echo $total2 ?></td>
               <td></td>
               <?php
           }
           else {
             $total2 = $total_cost_credit2 - $total_cost_debit2;
             $total_all_credit2 += $total2
             ?>
             <td></td>
             <td><?php echo $total2 ?></td>
             <?php
           }
           ?> -->

           <?php
           $firstAccNum = substr($acc_num, 0,1);
           if ($firstAccNum == "5") {
             ?>
             <td><?php echo number_format($total1,2); ?></td>
             <td></td>
             <td></td>
             <td></td>
             <?php
           }
           elseif ($firstAccNum == "4"){
             ?>
             <td></td>
             <td><?php echo number_format($total1,2) ?></td>
             <td></td>
             <td></td>

             <?php
           } elseif ($firstAccNum == "1") {
             ?>
             <td></td>
             <td></td>
             <td><?php echo number_format($total1,2);
                      $sum_balance_debit += $total1;
              ?></td>
              <td></td>
             <?php
           }elseif ($firstAccNum == "2") {
             ?>
            <td></td>
            <td></td>
            <td></td>
            <td><?php echo number_format($total1,2);
                      $sum_balance_credit += $total1;
             ?></td>

             <?php
           }elseif ($firstAccNum == "3" && $data['acc_number'] == '302') {
             ?>
             <td></td>
             <td></td>
             <td><?php echo number_format($total1,2);
                       $sum_balance_debit += $total1;
             ?></td>
             <td></td>

             <?php
           }elseif ($firstAccNum == "3") {
             ?>
             <td></td>
             <td></td>
             <td></td>
             <td><?php echo number_format($total1,2);
                       $sum_balance_credit += $total1;
             ?></td>


             <?php
           }
           ?>
           </tr>
           <?php
         }
         ?>
         <tr align="center">
           <td></td>
           <td></td>
           <td><?php echo number_format($total_all_debit1,2) ?></td>
           <td><?php echo number_format($total_all_credit1,2) ?></td>
           <td><?php $sql_debit = "SELECT sum(cost) AS COST_SUM3 FROM tb_book book
                                   LEFT JOIN tb_account_number acc ON book.acc_id = acc.acc_id
                                   WHERE status='debit' and acc.acc_number BETWEEN 400 AND 599
                                   ";
         $result_2_debit = mysqli_query($conn, $sql_debit);
         $sum_debit = mysqli_fetch_array($result_2_debit);
         echo number_format($sum_debit['COST_SUM3'],2);
         ?>
       </td>
       <td><?php $sql_credit = "SELECT sum(cost) AS COST_SUM4 FROM tb_book book
                               LEFT JOIN tb_account_number acc ON book.acc_id = acc.acc_id
                               WHERE status='credit' and acc.acc_number BETWEEN 400 AND 599
                               ";
       $result_2_credit = mysqli_query($conn, $sql_credit);
       $sum_credit = mysqli_fetch_array($result_2_credit);
       echo number_format($sum_credit['COST_SUM4'],2);
       ?>
     </td>
     <td><?php $sql_debit2 = "SELECT sum(cost) AS COST_SUM1 FROM tb_book book
                             LEFT JOIN tb_account_number acc ON book.acc_id = acc.acc_id
                             WHERE status='debit' and acc.acc_number BETWEEN 100 AND 399
                             ";
       $result_2_debit2 = mysqli_query($conn, $sql_debit2);
       $sum_debit2 = mysqli_fetch_array($result_2_debit2);
       echo number_format($sum_balance_debit,2);
       ?>
     </td>
     <td><?php $sql_credit2 = "SELECT sum(cost) AS COST_SUM2 FROM tb_book book
                             LEFT JOIN tb_account_number acc ON book.acc_id = acc.acc_id
                             WHERE status='credit' and acc.acc_number BETWEEN 100 AND 399
                             ";
      $result_2_credit2 = mysqli_query($conn, $sql_credit2);
      $sum_credit2 = mysqli_fetch_array($result_2_credit2);
      echo number_format($sum_balance_credit,2);
       ?>
     </td>
     <tr>
       <td> <div class="txtcenter">¢Ò´·Ø¹ÊØ·¸Ô</div></td>
       <td></td>
       <td></td>
       <td></td>
       <?php
        if ((int)$sum_debit['COST_SUM3'] >= (int)$sum_credit['COST_SUM4']) {
          $sum_2_1 = (int)$sum_debit['COST_SUM3'] - (int)$sum_credit['COST_SUM4'];
          $check1 = $sum_2_1;
          ?>
          <td><div class="txtcenter"></div> </td>
          <td><div class="txtcenter"><?php echo number_format($sum_credit['COST_SUM4']) ?></div> </td>
          <?php
          if ($check1 == $sum_2_1) {
            ?>
            <td><div class="txtcenter">
             <?php echo number_format($sum_2_1,2);
             $check3 = 0;
             ?>
           </div>
          </td>
          <td></td>
            <?php
          }
        }
        ?>


     </tr>
      <tr>
     <td></td>
     <td></td>
     <td></td>
     <td></td>
     <?php if ((int)$sum_debit['COST_SUM3'] >= (int) $sum_credit['COST_SUM4']) {
     ?>
     <td><div class="txtcenter"><?php echo number_format($sum_debit['COST_SUM3'],2); ?></div></td>
     <td><div class="txtcenter"><?php
     $sum_total = (int)$sum_credit['COST_SUM4'] + $sum_2_1;
     echo number_format($sum_total,2);
     ?>
   </div></td>
     <?php
     }
    ?>
    <?php if ($check3 == '0') {
      ?>
       <td><div class="txtcenter">
      <?php
       $sum_total2 = $sum_2_1 + $sum_balance_debit;
       echo number_format($sum_total2,2);
       ?>
       <td><div class="txtcenter"><?php echo number_format($sum_balance_credit,2);?></div></td>
       <?php
     }else {
       ?>
       <td><div class="txtcenter"><?php echo number_format($sum_balance_debit,2);?></div></td>
       <td><div class="txtcenter">
       <?php
       $sum_total3 = $sum_2_2 + $sum_balance_credit;
       echo number_format($sum_total3,2);
       ?>
     </div></td>
       <?php
     }?>
         </tr>
      </tbody>
      </table>
    </div>
    <script src="bootstrap/js/jquery-3.3.1.slim.min.js" ></script>
    <script src="bootstrap/js/popper.min.js" ></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
  </html>
