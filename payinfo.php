<?php
require("db_connect.php");
    echo "<ul>";
    if (isset($_POST["monthYear"])) {
        $monthYear = $_POST["monthYear"];
        
        // Prepare the statement to fetch employee IDs
        $stmt = mysqli_prepare($conn, "SELECT employeeId FROM payslips WHERE monthYear = ?");
        
        // Bind the parameter
        mysqli_stmt_bind_param($stmt, "s", $monthYear);
        
        // Execute the statement
        mysqli_stmt_execute($stmt);
        
        // Get the result
        $result = mysqli_stmt_get_result($stmt);
        
        $employeeIds = [];
        
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $employeeIds[] = $row["employeeId"];
            }
        } else {
            echo "<li>No Payslips found</li>";
        }
        
        // Close the statement
        mysqli_stmt_close($stmt);
    
        foreach ($employeeIds as $theId) {
                // Fetch employee details
            $stmt = mysqli_prepare($conn, "SELECT fullName FROM employees WHERE id = ?");
        
            // Bind the parameter
            mysqli_stmt_bind_param($stmt, "s", $theId);
            // Execute the statement
            mysqli_stmt_execute($stmt);
    
            // Get the result
            $result = mysqli_stmt_get_result($stmt);
    
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $fullName = $row["fullName"];
    
                    echo "<li>$fullName <a href='#'>Edit </a><span> or </span><a href='pdfgen.php?employeeNumber={$theId}&monthYear={$monthYear}'> Download Pdf</a></li>";
                }
            }
        }
        
        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        $employeeNumber = $_POST["employeeNumber"];
        
        // Prepare the statement
        $stmt = mysqli_prepare($conn, "SELECT id, monthYear, employeeId FROM payslips WHERE employeeId = ? ORDER BY monthYear DESC");
        
        // Bind the parameter
        mysqli_stmt_bind_param($stmt, "i", $employeeNumber);
        
        // Execute the statement
        mysqli_stmt_execute($stmt);
        
        // Get the result
        $result = mysqli_stmt_get_result($stmt);
        
        if (mysqli_num_rows($result) > 0) {
            // Output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                $dateToSearch = $row["monthYear"];
                $monthYear = date_create($dateToSearch);
                $nice_date = date_format($monthYear, "F Y");
                echo "<li>$nice_date <a href='#'>Edit</a><span> or </span><a href='pdfgen.php?employeeNumber={$employeeNumber}&monthYear={$dateToSearch}'> Download Pdf</a></li>";
            }
        } else {
            echo "<li>No Payslips Found</li>";
        }
    
        // Close the statement
        mysqli_stmt_close($stmt);

        
    }
    


    echo "</ul>";
    mysqli_close($conn);


?>