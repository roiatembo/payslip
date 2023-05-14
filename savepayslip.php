<?php
$servername = "localhost";
$username = "dithetoc_roia";
$password = "rolanga4";
$dbname = "dithetoc_payslip";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


if (isset($_POST["employeeId"])) {
  $monthYear = $_POST["monthYear"];
  $employeeId = $_POST["employeeId"];
  $payDate = $_POST["payDate"];
  $normalRate = $_POST["normalRate"];
  $normalDays = $_POST["normalDays"];
  $bonusRate = $_POST["bonusRate"];
  $bonusDays = $_POST["bonusDays"];
  $overtimeRate = $_POST["overtimeRate"];
  $overtimeHours = $_POST["overtimeHours"];
  $tax = $_POST["tax"];
  $uif = $_POST["uif"];
  $loan = $_POST["loan"];
  $uniform = $_POST["uniform"];
  $unionPay = $_POST["unionPay"];
  $unpaidLeave = $_POST["unpaidLeave"];

  if(isset($_POST["extraDeductions"])) {
    $extraDeductions = serialize($_POST["extraDeductions"]);
  } else {
    $extraDeductions = "0";
  }

  if(isset($_POST["extraIncome"])) {
    $extraIncome = serialize($_POST["extraIncome"]);
  } else {
    $extraIncome = "0";
  }
  echo $extraDeductions;
  echo $extraIncome;

  $sql = "INSERT INTO payslips (payDate, monthYear, employeeId, normalRate, normalDays, bonusRate, bonusDays, overtimeRate, overtimeHours, tax, uif, loan, uniform, unionPay, unpaidLeave, extraIncome, extraDeductions)
VALUES ('$payDate','$monthYear', '$employeeId', '$normalRate', '$normalDays', '$bonusRate', '$bonusDays', '$overtimeRate', '$overtimeHours', '$tax', '$uif', '$loan', '$uniform', '$unionPay', '$unpaidLeave','$extraIncome','$extraDeductions')";
echo $employeeId;
if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
}


?>