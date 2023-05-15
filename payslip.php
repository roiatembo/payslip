<!doctype html>
<html lang="en">
  <head>
  	<title>Enter Payslip</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
        	<!-- navbar stylsheet -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="css/navstyle.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script>
    $(function(){
        $.ajax({
            url: "db_query.php",
            dataType: "json",
            success: function(data) {
                $("#fname").autocomplete({
                    source: data,
                    select: function(event, ui) {
                        $("#employeeNumber").val(ui.item.empn);
                        $("#fname").val(ui.item.label);
                        $("#accountNumber").val(ui.item.accountNumber);
                        $("#bank").val(ui.item.bank);
                        $("#branch").val(ui.item.branch);
                        $("#branchCode").val(ui.item.branchCode);
                        $("#bankingDetailsId").val(ui.item.bankingDetailsId);
                        return false;
                    }
                });
            }
        });
    });
</script>
	</head>
	<body>

   <!-- navbar section -->
      <?php include "navbar.php"; ?>

        <div class="container-fluid px-1 py-5 mx-auto">
            <div class="row d-flex justify-content-center">
                <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
                    <h3>Enter Payslip Information</h3>
                    <div class="card">
                        <h5 class="text-center mb-4">Enter Details</h5>
                        <span style="color: green;" id="result"></span>
                        <form id="payslipForm" class="form-card" onsubmit="event.preventDefault()">
                            <div class="row justify-content-between text-left">
                                <div class="form-group col-sm-12 flex-column d-flex"> <label class="form-control-label px-3">Full Name<span class="text-danger"> *</span></label> <input type="text" id="fname" name="fullName" placeholder="Enter full name"required> </div>
                                <input type="hidden" name="employeeNumber" id="employeeNumber">
                            </div>
                            <div class="row justify-content-between text-left">
                                <div style="display: block;" class="form-group col-sm-12 flex-column d-flex"> <label class="form-control-label px-3">Pay Date<span class="text-danger"> *</span></label> <input type="date" id="payDate" name="payDate" placeholder=""required> </div>
                            </div>
                            <h6 class="text-center mb-4">Banking Details</h6>
                            <div class="row justify-content-between text-left">
                                <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Bank Name</label> <input type="text" id="bank" name="bankName" placeholder=""> </div>
                                <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Account Number</label> <input type="text" id="accountNumber" name="accountNumber" placeholder=""> </div>
                            </div>
                            <div class="row justify-content-between text-left">
                                <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Branch</label> <input type="text" id="branch" name="branch" placeholder=""> </div>
                                <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Branch Code</label> <input type="text" id="branchCode" name="branchCode" placeholder=""> </div>
                                <input type="hidden" name="bankingDetailsId" id="bankingDetailsId">
                            </div>
                            <h6 class="text-center mb-4">Enter Month and Year Of Payslip</h6>
                            <div class="row justify-content-between text-left">
                                <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Month<span class="text-danger"> </span></label>
                                <select class="form-control" name="month">
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
                                <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Year<span class="text-danger"> </span></label> 
                                <select class="form-control" name="year">
                                            <option value="">Pick A Year</option>
                                            <option value="2023">2023</option>
                                        </select>
                                </div>
                            </div>
                            <h6 class="text-center mb-4">Normal</h6>
                            <div class="row justify-content-between text-left">
                                <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Rate<span class="text-danger"> *</span></label> <input type="text" id="email" name="normalRate" placeholder="" required> </div>
                                <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Hours / Days<span class="text-danger"> *</span></label> <input type="text" id="mob" name="normalDays" placeholder="" required> </div>
                            </div>
                            <h6 class="text-center mb-4">Bonus Pay</h6>
                            <div class="row justify-content-between text-left">
                                <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Hours<span class="text-danger"> </span></label> <input type="text" id="job" name="bonusDays" value="0" placeholder=""> </div>
                                <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Rate<span class="text-danger"> </span></label> <input type="text" id="mob" name="bonusRate" value="0" placeholder=""> </div>
                            </div>
                            <h6 class="text-center mb-4">Overtime</h6>
                            <div class="row justify-content-between text-left">
                                <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Rate<span class="text-danger"> </span></label> <input type="text" id="email" name="overtimeRate" value="0" placeholder=""> </div>
                                <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Hours<span class="text-danger"> </span></label> <input type="text" id="mob" name="overtimeHours" value="0" placeholder=""> </div>
                            </div>
                            <span id="clickIncome"><span> Click to add more income rows</span>&nbsp;&nbsp;&nbsp;&nbsp;<i style="color:black;" onmouseover="this.style.color='green'" onmouseout="this.style.color='black'" class="plus-sign fa fa-plus-circle fa-2x" aria-hidden="true"></i></span>
                            <div id="extraIncome">

                            </div>
                            <h4 class="text-center mb-4">Deductions</h4>
                            <div class="row justify-content-between text-left">
                                <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Tax<span class="text-danger"> </span></label> <input type="text" id="email" name="tax" value="0" placeholder=""> </div>
                                <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">UIF<span class="text-danger"> </span></label> <input type="text" id="mob" name="uif" value="0" placeholder=""> </div>
                            </div>
                            <div class="row justify-content-between text-left">
                                <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Loan<span class="text-danger"> </span></label> <input type="text" id="email" name="loan" value="0" placeholder=""> </div>
                                <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Uniform<span class="text-danger"> </span></label> <input type="text" id="mob" name="uniform" value="0" placeholder=""> </div>
                            </div>
                            <div class="row justify-content-between text-left">
                                <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Union<span class="text-danger"> </span></label> <input type="text" id="email" name="unionPay" value="0" placeholder=""> </div>
                                <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Unpaid Leave<span class="text-danger"> </span></label> <input type="text" id="mob" name="unpaidLeave" value="0" placeholder=""> </div>
                            </div>
                            <span id="clickDeductions"><span> Click to add more deduction rows</span>&nbsp;&nbsp;&nbsp;&nbsp;<i style="color:black;" onmouseover="this.style.color='green'" onmouseout="this.style.color='black'" class="plus-sign fa fa-plus-circle fa-2x" aria-hidden="true"></i></span>
                            <div id="extraDeductions"></div>
                            <div class="row justify-content-end">
                                <span style="color: red;" id="error"></span>
                                <div class="form-group col-sm-6"> <button type="submit" class="btn-block btn-primary">Submit</button> </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <script src="js/popper.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/form.js"></script>
    </body>
</html>