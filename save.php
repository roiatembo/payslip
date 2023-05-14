<?php
require("db_connect.php");

if (isset($_POST["fullName"])) {
    $fullName = $_POST["fullName"];
    $idNo = $_POST["idNo"];
    $address = $_POST["address"];
    $phoneNumber = $_POST["phoneNumber"];
    $occupation = $_POST["occupation"];
    $date = $_POST["date"];
    $employeeNumber = $_POST["employeeNumber"];
    $taxNumber = $_POST["taxNumber"];
    $bankName = $_POST["bankName"];
    $accountNumber = $_POST["accountNumber"];
    $branchName = $_POST["branchName"];
    $branchCode = $_POST["branchCode"];



$sql = "INSERT INTO employees (fullName, idNo, addresss, phoneNumber, occupation, dateOfEmployment, employeeNumber, taxNumber)
VALUES ('$fullName', '$idNo', '$address', '$phoneNumber', '$occupation', '$date', '$employeeNumber', '$taxNumber')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$sql = "INSERT INTO banking_details (employeeId, branchCode, accountNumber, bank, branch)
VALUES ('$employeeNumber', '$branchCode', '$accountNumber', '$bankName', '$branchName')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
}

if (isset($_POST["employeeCheck"])) {
  $employeeCheck = $_POST["employeeCheck"];

  $sql = "SELECT employeeNumber FROM employees WHERE employeeNumber='$employeeCheck'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result)> 0) {
          echo "problem";
        } else {
            echo "good";
        }
}