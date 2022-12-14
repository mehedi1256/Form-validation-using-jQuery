<?php
$conn = mysqli_connect("localhost", "root", "", "wbs_db") or die("Connection Failed");
$sql = "SELECT * FROM outdoor_com_barcode";
$result = mysqli_query($conn, $sql) or die("SQL Query Failed.");

$outdoor = [];
$compressor = [];

while ($row = mysqli_fetch_assoc($result)) {

  $outdoor[] .= substr($row['outdoor_barcode'], 0, 9);
  $compressor[] .= substr($row['compressor_barcode'], 0, 3);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Validation</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>

<body>
  <input type="text" id="outdoor_barcode" value="" onkeyup="form_validation()" />
  <input type="text" value="" id="comp_barcode" onkeyup="form_validation()" />
  <input type="submit" id="btn" value="Submit" />

  <script>
    $('input[id="btn"]').attr("disabled", true);

    function form_validation() {


      var outdoor_final_val = <?php echo json_encode($outdoor); ?>

      

      var compressor_final_val = <?php echo json_encode($compressor); ?>



      var outdoor_barcode_val = $("#outdoor_barcode").val();
      var outdoor_sbustr = outdoor_barcode_val.substring(0, 9);
      console.log(outdoor_sbustr);

      var com_barcode_val = $("#comp_barcode").val();
      var compressor_substr = com_barcode_val.substring(0, 3);
      console.log(compressor_substr);

      var find_pos_of_outdoor = (outdoor_final_val.indexOf(outdoor_sbustr));
      console.log(find_pos_of_outdoor);

      var compressor_new_val = compressor_final_val[find_pos_of_outdoor];
      console.log(compressor_new_val);


      if (find_pos_of_outdoor >= 0 && compressor_substr === compressor_new_val) {
        $('input[id="btn"]').attr("disabled", false);
        document.getElementById("btn").style.color = "green";
        document.getElementById("btn").value = "Submit";
      } else {
        $('input[id="btn"]').attr("disabled", true);
        document.getElementById("btn").style.color = "red";
        document.getElementById("btn").value = "Enter valid barcode";
      }

    }
  </script>





</body>

</html>