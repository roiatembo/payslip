<?php
require("db_connect.php");
    echo "<ul>";

if (isset($_POST["employeeNumber"])) {

    $employeeNumber = $_POST["employeeNumber"];

    $sql = "SELECT id, monthYear, employeeId FROM payslips WHERE $employeeNumber LIKE employeeId ORDER BY monthYear DESC";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
    
        $dateToSearch = $row["monthYear"];
        $monthYear = date_create($dateToSearch);
        $nice_date = date_format($monthYear, "F Y");
        echo "<li>$nice_date <a href='#'>Edit</a><span> or </span><a href='pdfgen.php?employeeNumber={$employeeNumber}&monthYear={$dateToSearch}'> Download Pdf</a></li>";

    }
    } else {
    echo "<li>No payslips found</li>";
    }

    } elseif (isset($_POST["monthYear"])) {
        $employeeIds = [];

        $monthYear = $_POST["monthYear"];

        $sql = "SELECT employeeId FROM payslips WHERE '$monthYear' LIKE monthYear";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result)> 0) {

            while($row = mysqli_fetch_assoc(($result))) {
                $employeeId = $row["employeeId"];
                $employeeIds[] = $employeeId;
                
            }

        } else {
            echo "<li>No payslips found";
        }

        for($i=0;$i<count($employeeIds);$i++) {
            $theId = $employeeIds[$i];
            $sql = "SELECT fullName FROM employees WHERE employeeNumber='$theId'";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result)>0) {

                while($row = mysqli_fetch_assoc($result)) {
                    $fullName =  $row["fullName"];

                    echo "<li>$fullName <a href='#'>Edit </a><span> or </span><a href='pdfgen.php?employeeNumber={$theId}&monthYear={$monthYear}'> Download Pdf</a></li>";
                }
            }
        }
        
    }


    echo "</ul>";
    mysqli_close($conn);


?>