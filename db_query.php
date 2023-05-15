<?php
require ("db_conn.php");

$stmt = $pdo->prepare("SELECT id, fullName, employeeNumber FROM employees");
$stmt->execute();
$employees = $stmt->fetchAll(PDO::FETCH_ASSOC);

$data = [];

foreach ($employees as $employee) {
  $fullName = htmlspecialchars($employee["fullName"]);
  $employeeId = $employee["id"];

  $stmt = $pdo->prepare("SELECT id, accountNumber, bank, branch, branchCode FROM banking_details WHERE employeeId = ?");
  $stmt->execute([$employeeId]);
  $bankingDetails = $stmt->fetch(PDO::FETCH_ASSOC);

  $accountNumber = isset($bankingDetails["accountNumber"]) ? htmlspecialchars($bankingDetails["accountNumber"]) : "";
  $bank = isset($bankingDetails["bank"]) ? htmlspecialchars($bankingDetails["bank"]) : "";
  $branch = isset($bankingDetails["branch"]) ? htmlspecialchars($bankingDetails["branch"]) : "";
  $branchCode = isset($bankingDetails["branchCode"]) ? htmlspecialchars($bankingDetails["branchCode"]) : "";
  $bankingDetailsId = isset($bankingDetails["id"]) ? $bankingDetails["id"] : 0;

  $data[] = [
    "value" => "",
    "fullName" => $fullName,
    "empn" => $employeeId,
    "accountNumber" => $accountNumber,
    "bank" => $bank,
    "branch" => $branch,
    "branchCode" => $branchCode,
    "bankingDetailsId" => $bankingDetailsId
  ];
}

echo json_encode($data);
?>
