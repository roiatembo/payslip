<?php
require ("db_connect.php");

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
  $bankName = $_POST["bankName"];
  $accountNumber = $_POST["accountNumber"];
  $branch = $_POST["branch"];
  $branchCode = $_POST["branchCode"];
  $bankingDetailsId = $_POST["bankingDetailsId"];

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
if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

//check if banking details already exist by selections
$stmt_two = $conn->prepare("SELECT accountNumber FROM banking_details WHERE id = ?");
$stmt_two->bind_param("i", $bankingDetailsId);
$stmt_two->execute();
$result_two = $stmt_two->get_result();

if ($result_two->num_rows > 0) {
  $update_sql = "UPDATE banking_details SET branchCode = ?, accountNumber = ?, bank = ?, branch = ? WHERE id = ?";
  $stmt_update = $conn->prepare($update_sql);
  $stmt_update->bind_param("ssssi", $branchCode, $accountNumber, $bankName, $branch, $bankingDetailsId);
  $stmt_update->execute();
} else {
  $insert_sql = "INSERT INTO banking_details (employeeId, branchCode, accountNumber, bank, branch) VALUES (?, ?, ?, ?, ?)";
  $stmt_insert = $conn->prepare($insert_sql);
  $stmt_insert->bind_param("issss", $employeeId, $branchCode, $accountNumber, $bankName, $branch);
  if ($stmt_insert->execute()) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();
}


?>