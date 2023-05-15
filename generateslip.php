<!DOCTYPE html>
<html lang="en">
<head>
    <title>Generate Payslip</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <!-- Consolidated CSS imports -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/navstyle.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/style.css">

    <!-- Consolidated JavaScript imports -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
</head>
<body>
    <?php include "navbar.php"; ?>

        <div class="container-fluid px-1 py-5 mx-auto">
            <div class="row d-flex justify-content-center">
                <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
                    <h3>Generate Payslip</h3>
                    <div class="card">
                        <h5 class="text-center mb-4">Enter Name</h5>
                        <form id="payslipForm" class="form-card" onsubmit="event.preventDefault()">
                            <div class="row justify-content-between text-left">
                                <div style="display: block;" class="form-group col-sm-12 flex-column d-flex"> <label class="form-control-label px-3">Full Name<span class="text-danger"> *</span></label> <input type="text" id="fname" name="fullName" placeholder="Enter full name"required> </div>
                                <input type="hidden" name="employeeNumber" id="employeeNumber">
                            </div>
                            <h5 class="text-center mb-4">Or Enter a Month and Year</h5>
                            <span style="color: red;" class="text-center" id="message"></span>
                            <div class="row justify-content-between text-left">
                                <div class="form-group col-sm-6 flex-column d-flex">
                                    <label class="form-control-label px-3">Month<span class="text-danger"> </span></label>
                                        <select id="month" class="form-control" name="month">
                                            <option value="">Pick A Month</option>
                                            <option value="01">January</option>
                                            <option value="02">February</option>
                                            <option value="03">March</option>
                                            <option value="04">April</option>
                                            <option value="05">May</option>
                                            <option value="06">June</option>
                                            <option value="07">July</option>
                                            <option value="08">August</option>
                                            <option value="09">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                    </div>
                                <div class="form-group col-sm-6 flex-column d-flex">
                                    <label class="form-control-label px-3">Year<span class="text-danger"> </span></label>
                                        <select id="year" class="form-control" name="year">
                                            <option value="">Pick A Year</option>
                                            <option value="2023">2023</option>
                                        </select>
                                </div>
                            </div>
                        </form>
                        <br /> <br />
                        <h5 id="payslipsName" class="text-center mb-4"></h5>
                        <div id="listOfPayslips" class="text-left">

                        </div>



                    </div>
                </div>
            </div>
        </div>
    </body>
</html>