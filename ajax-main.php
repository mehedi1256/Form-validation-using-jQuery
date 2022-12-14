<?php
   $conn = mysqli_connect("localhost","root","","wbs_db") or die("Connection Failed");
   $sql = "SELECT * FROM outdoor_com_barcode";
   $result = mysqli_query($conn,$sql) or die("SQL Query Failed.");

   $outdoor = [];
   $compressor = [];
   
   while($row = mysqli_fetch_assoc($result)){
    
    $outdoor[] .= substr($row['outdoor_barcode'],0,9);
    $compressor[] .= substr($row['compressor_barcode'],0,3);
   
   }

   
   /* echo "<pre>";
   print_r($outdoor);
   echo "</pre>";

   echo "<pre>";
   print_r($compressor);
   echo "</pre>"; */

   print_r($outdoor);
   print_r($compressor);
   


?>