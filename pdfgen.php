<?php
    require("fpdf/fpdf.php");
    require("db_connect.php");

if (isset($_GET["employeeNumber"])) {

    $employeeNumber = $_GET["employeeNumber"];
    $monthYear = $_GET["monthYear"];

    //fetch employee information

    $sql = "SELECT id, fullName, idNo, addresss, dateOfEmployment, phoneNumber, taxNumber, occupation FROM employees WHERE employeeNumber='$employeeNumber'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $fullName = $row["fullName"];
        $idNo = $row["idNo"];
        $addresss = $row["addresss"];
        $dateOfEmployment = $row["dateOfEmployment"];
        $phoneNumber = $row["phoneNumber"];
        $taxNumber = $row["taxNumber"];
        $occupation = $row["occupations"];   
    }
    }

      //fetch banking information

      $sql = "SELECT id, employeeId, branchCode, accountNumber, bank, branch FROM banking_details WHERE employeeId='$employeeNumber'";
      $result = mysqli_query($conn, $sql);
  
      if (mysqli_num_rows($result) > 0) {
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
          $branchCode = $row["branchCode"];
          $accountNumber = $row["accountNumber"];
          $bank = $row["bank"];
          $branch = $row["branch"]; 
      }
      }

      //fetch payslip informations

      $sql = "SELECT id, payDate, monthYear, employeeId, normalRate, normalDays, bonusRate, bonusDays, overtimeRate, overtimeHours, tax, uif, loan, uniform, unionPay, unpaidLeave, extraIncome, extraDeductions FROM payslips WHERE employeeId='$employeeNumber' AND monthYear='$monthYear'";
      $result = mysqli_query($conn, $sql);
  
      if (mysqli_num_rows($result) > 0) {
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
          $payDate = $row["payDate"];
          $dateToSearch = $row["monthYear"];
          $extraIncome = $row["extraIncome"];
          $extraDeductions = $row["extraDeductions"];
          $monthYear = date_create($dateToSearch);
          $nice_date = date_format($monthYear, "F Y");
          $normalRate = $row["normalRate"];
          $normalDays = $row["normalDays"];
          $totalNormalAmount = floor($normalDays * $normalRate);
          $bonusHours = $row["bonusDays"];
          $bonusRate = $row["bonusRate"];
          $totalBonusAmount = floor($bonusHours * $bonusRate);
          $overtimeRate = $row["overtimeRate"];
          $overtimeHours = $row["overtimeHours"];
          $totalOvertimeAmount = floor($overtimeHours * $overtimeRate);
          $totalEarnings = $totalNormalAmount + $totalBonusAmount + $totalOvertimeAmount;
          $tax = $row["tax"];
          $uif = $row["uif"];
          $loan = $row["loan"];
          $union = $row["union"];
          $unpaidLeave = $row["unpaidLeave"];
          $totalDeductions = floor($tax + $uif + $loan + $union + $unpaidLeave);
          
        }
      }


    class PDF extends FPDF
    {
    // Page header
    function Header()
    {
        // Logo
        $this->Image('images/logo_img.jpg',10,6,30);
        // Arial bold 15
        $this->SetTextColor(50, 108, 156);
        $this->SetFont('Arial','B',20);
        // Move to the right
        $this->Cell(40);
        // Title
        $this->Cell(30,10,'Pest Control',0,0,'C');
        $this->Cell(80);
        $this->Cell(30,10,'PAYSLIP',0,1,'C');
        $this->Cell(56);
        $this->Cell(30,10,'Hygiene and Cleaning',0,1,'C');
        $this->SetTextColor(0, 0, 0);
        $this->SetFont('Arial','B',9);
        $this->Cell(34);
        $this->Cell(30,4,'UIF Ref No.: 0716 492/1',0,1,'L');
        $this->Cell(34);
        $this->Cell(30,4,'REG NO: 92/002548/23',0,1,'L');
        $this->Cell(34);
        $this->Cell(30,4,'TEL: 015 296 3913, FAX: 015 296 2295',0,1,'L');
        $this->Cell(34);
        $this->Cell(30,4,'293 Mashall Street, Florapark, Polokwane, 0699',0,1,'L');

        // Line break
        $this->Ln(10);
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
    }

    // Instanciation of inherited class
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();

    //subheader employee information

    $pdf->SetFont('Arial','B',12);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFillColor(115, 161, 201);
    $pdf->Cell(2);
    $pdf->Cell(80,10,'EMPLOYEE INFORMATION',0,0,'L',true);
    $pdf->Cell(20);
    $pdf->Cell(30,10,'PAY DATE',0,0,'C',true);
    $pdf->Cell(2);
    $pdf->Cell(30,10,'PAY TYPE',0,0,'C',true);
    $pdf->Cell(2);
    $pdf->Cell(30,10,'PERIOD',0,1,'C',true);
    $pdf->SetFillColor(75, 255, 0);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','B',15);
    $pdf->Cell(2);
    $pdf->Cell(80,10,$fullName,0,0,'L');
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(20);
    $pdf->Cell(30,10,$payDate,0,0,'C',true);
    $pdf->Cell(2);
    $pdf->Cell(30,10,'Monthly',0,0,'C',true);
    $pdf->Cell(2);
    $pdf->Cell(30,10,$nice_date,0,1,'C',true);
    $pdf->Cell(2);
    $pdf->Cell(80,4,'ID No.: ' . $idNo,0,1,'L');
    $pdf->Cell(2);
    $pdf->Cell(80,4,$addresss,0,1,'L');
    $pdf->Cell(2);
    $pdf->Cell(80,4,'Date Of Employment: '. $dateOfEmployment,0,0,'L');
    $pdf->Cell(20);
    $pdf->Cell(30,4,'BANKING DETAILS',0,1,'L');
    $pdf->Cell(2);
    $pdf->Cell(80,4,'Employee No.: ' . $employeeNumber,0,0,'L');
    $pdf->Cell(20);
    $pdf->Cell(30,4,'BANK: ' . $bank,0,1,'L');
    $pdf->Cell(2);
    $pdf->Cell(80,4,'Tel No.: ' . $phoneNumber,0,0,'L');
    $pdf->Cell(20);
    $pdf->Cell(30,4,'ACCOUNT NUMBER: ' . $accountNumber,0,1,'L');
    $pdf->Cell(2);
    $pdf->Cell(80,4,'Income Tax No.: ' . $taxNumber,0,0,'L');
    $pdf->Cell(20);
    $pdf->Cell(30,4,'BRANCH: ' . $branch,0,1,'L');
    $pdf->Cell(2);
    $pdf->Cell(80,4,'Occupation: ' . $occupation,0,0,'L');
    $pdf->Cell(20);
    $pdf->Cell(30,4,'BRANCH CODE: ' . $branchCode,0,1,'L');
    $pdf->Ln(10);

    //earnings information
    //earnings header column
    $pdf->SetFont('Arial','B',12);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFillColor(132, 125, 133);
    $pdf->Cell(2);
    $pdf->Cell(100,10,'EARNINGS',0,0,'L',true);
    $pdf->Cell(36,10,'HOURS/DAYS',0,0,'L',true);
    $pdf->Cell(22,10,'RATE',0,0,'L',true);
    $pdf->Cell(36,10,'TOTAL AMOUNT',0,1,'L',true);

    //earnings detailed information
    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(2);
    $pdf->Cell(100,10,'Standard Pay',"B",0,'L');
    $pdf->Cell(36,10,$normalDays,"B",0,'L');
    $pdf->Cell(22,10,$normalRate,"B",0,'L');
    $pdf->Cell(36,10,$totalNormalAmount,"B",1,'R');

    $pdf->Cell(2);
    $pdf->Cell(100,10,'Bonus Pay',"B",0,'L');
    $pdf->Cell(36,10,$bonusHours,"B",0,'L');
    $pdf->Cell(22,10,$bonusRate,"B",0,'L');
    $pdf->Cell(36,10,$totalBonusAmount,"B",1,'R');

    $pdf->Cell(2);
    $pdf->Cell(100,10,'Overtime',"B",0,'L');
    $pdf->Cell(36,10,$overtimeHours,"B",0,'L');
    $pdf->Cell(22,10,$overtimeRate,"B",0,'L');
    $pdf->Cell(36,10,$totalOvertimeAmount,"B",1,'R');

    if ($extraIncome != 0) {
        $income = unserialize($extraIncome);
        
        foreach($income as $key => $val) {
            $pdf->Cell(2);
            $pdf->Cell(136,10,$key,"B",0,'L');
            $pdf->Cell(22,10,$val,"B",0,'L');
            $pdf->Cell(36,10,$val,"B",1,'R');
            $totalEarnings += $val;
        }
    }

    $pdf->Ln(5);
    $pdf->SetFont('Arial','B',12);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFillColor(132, 125, 133);
    $pdf->Cell(2);
    $pdf->Cell(130,10,'GROSS EARNINGS',0,0,'R',true);
    $pdf->Cell(64,10,'R'.$totalEarnings,0,1,'R',true);
    $pdf->Ln(5);

    //deductions information
    //deductions header column
    $pdf->SetFont('Arial','B',12);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFillColor(132, 125, 133);
    $pdf->Cell(2);
    $pdf->Cell(158,10,'DEDUCTIONS',0,0,'L',true);
    $pdf->Cell(36,10,'TOTAL AMOUNT',0,1,'L',true);

    // deductions detailed informations
    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(2);
    $pdf->Cell(158,10,'Tax',"B",0,'L');
    $pdf->Cell(36,10,$tax,"B",1,'R');

    $pdf->Cell(2);
    $pdf->Cell(158,10,'UIF',"B",0,'L');
    $pdf->Cell(36,10,$uif,"B",1,'R');

    if ($loan > 0) {
        $pdf->Cell(2);
        $pdf->Cell(158,10,'Loan',"B",0,'L');
        $pdf->Cell(36,10,$loan,"B",1,'R');
    }

    if ($union > 0) {
        $pdf->Cell(2);
        $pdf->Cell(158,10,'Union',"B",0,'L');
        $pdf->Cell(36,10,$union,"B",1,'R');
    }

    if ($unpaidLeave) {
        $pdf->Cell(2);
        $pdf->Cell(158,10,'Unpaid Leave',"B",0,'L');
        $pdf->Cell(36,10,$unpaidLeave,"B",1,'R');
    }

    if ($extraDeductions != 0) {
        $deductions = unserialize($extraDeductions);
        
        foreach($deductions as $key => $val) {
            $pdf->Cell(2);
            $pdf->Cell(158,10,$key,"B",0,'L');
            $pdf->Cell(36,10,$val,"B",1,'R');
            $totalDeductions += $val;
        }
    }

    $pdf->Ln(5);
    $pdf->SetFont('Arial','B',12);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFillColor(132, 125, 133);
    $pdf->Cell(2);
    $pdf->Cell(130,10,'TOTAL DEDUCTIONS',0,0,'R',true);
    $pdf->Cell(64,10,'R'. $totalDeductions,0,1,'R',true);
    $pdf->Ln(5);

    // NET PAY
    $nettPay = $totalEarnings - $totalDeductions;
    $pdf->Cell(88);
    $pdf->Cell(30,10,'NETT PAY',0,0,'L',true);
    $pdf->Cell(78,10,'R' . $nettPay,0,1,'R',true);



    $pdf->Output();
}
?>