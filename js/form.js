function validate(val) {
    v1 = document.getElementById("fname");
    v2 = document.getElementById("lname");
    v3 = document.getElementById("email");
    v4 = document.getElementById("mob");
    v5 = document.getElementById("job");
    v6 = document.getElementById("ans");

    flag1 = true;
    flag2 = true;
    flag3 = true;
    flag4 = true;
    flag5 = true;
    flag6 = true;

    if(val>=1 || val==0) {
        if(v1.value == "") {
            v1.style.borderColor = "red";
            flag1 = false;
        }
        else {
            v1.style.borderColor = "green";
            flag1 = true;
        }
    }

    if(val>=2 || val==0) {
        if(v2.value == "") {
            v2.style.borderColor = "red";
            flag2 = false;
        }
        else {
            v2.style.borderColor = "green";
            flag2 = true;
        }
    }
    if(val>=3 || val==0) {
        if(v3.value == "") {
            v3.style.borderColor = "red";
            flag3 = false;
        }
        else {
            v3.style.borderColor = "green";
            flag3 = true;
        }
    }
    if(val>=4 || val==0) {
        if(v4.value == "") {
            v4.style.borderColor = "red";
            flag4 = false;
        }
        else {
            v4.style.borderColor = "green";
            flag4 = true;
        }
    }
    if(val>=5 || val==0) {
        if(v5.value == "") {
            v5.style.borderColor = "red";
            flag5 = false;
        }
        else {
            v5.style.borderColor = "green";
            flag5 = true;
        }
    }
    if(val>=6 || val==0) {
        if(v6.value == "") {
            v6.style.borderColor = "red";
            flag6 = false;
        }
        else {
            v6.style.borderColor = "green";
            flag6 = true;
        }
    }

    // flag = flag1 && flag2 && flag3 && flag4 && flag5 && flag6;
    flag = true;

    return flag;
}

{/* <div class="row justify-content-between text-left">
    <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Petrol<span class="text-danger"> </span></label> <input type="text" id="job" name="petrol" value="0" placeholder="" onblur=""> </div>
    <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Monthly<span class="text-danger"> </span></label> <input type="text" id="mob" name="petrolMonthly" value="0" placeholder=""> </div>
</div> */}
var rowNumber = 0;
$("#clickIncome").click(function() {
    rowNumber += 1;
    $("#extraIncome").append("<div id=\"incomeRow"+ rowNumber + "\"class=\"row justify-content-between text-left\"><div class=\"form-group col-sm-6 flex-column d-flex\"> <label class=\"form-control-label px-3\">Extra Income Name" + rowNumber + "<span class=\"text-danger\"> </span></label> <input type=\"text\" id=\"job\" name=\"extraIncome" + rowNumber + "\"" + "placeholder=\"e.g Petrol\"> </div><div class=\"form-group col-sm-6 flex-column d-flex\"> <label class=\"form-control-label px-3\">Price " + rowNumber + "<span class=\"text-danger\"> </span></label> <input type=\"text\" id=\"mob\" name=\"price" + rowNumber + "\"" +  "placeholder=\"e.g 2000\"> </div></div>")
});

var rowDeductions = 0;
$("#clickDeductions").click(function() {
    rowDeductions += 1;
    $("#extraDeductions").append("<div id=\"deductionRow"+ rowDeductions + "\" class=\"row justify-content-between text-left\"><div class=\"form-group col-sm-6 flex-column d-flex\"> <label class=\"form-control-label px-3\">Extra Deduction Name" + rowDeductions + "<span class=\"text-danger\"> </span></label> <input type=\"text\" id=\"job\" name=\"extraDeduction" + rowDeductions + "\"" + "placeholder=\"e.g Damages\"> </div><div class=\"form-group col-sm-6 flex-column d-flex\"> <label class=\"form-control-label px-3\">Price " + rowDeductions + "<span class=\"text-danger\"> </span></label> <input type=\"text\" id=\"mob\" name=\"priceDeductions" + rowDeductions + "\"" +  "placeholder=\"e.g 2000\"> </div></div>")
});

var extraDeduction = {};
var extraIncome = {};

  document.getElementById('payslipForm').addEventListener('submit', (e) => {
    const formData = new FormData(e.target);
    var employeeId = formData.get('employeeNumber');
    var payDate = formData.get('payDate');
    var normalRate = formData.get('normalRate');
    var normalDays = formData.get('normalDays');
    var bonusRate = formData.get('bonusRate');
    var bonusDays = formData.get('bonusDays');
    var overtimeRate = formData.get('overtimeRate');
    var overtimeHours = formData.get('overtimeHours');
    var tax = formData.get('tax');
    var uif = formData.get('uif');
    var loan = formData.get('loan');
    var uniform = formData.get('uniform');
    var unionPay = formData.get('unionPay');
    var unpaidLeave = formData.get('unpaidLeave');
    var month = formData.get('month');
    var year = formData.get('year');
    var bankName = formData.get('bankName');
    var accountNumber = formData.get('accountNumber');
    var branch = formData.get('branch');
    var branchCode = formData.get('branchCode');
    var bankingDetailsId = formData.get('bankingDetailsId');
    console.log(bankingDetailsId);
    var monthYear = year + "-" + month;

    for (i=1;i<=rowNumber;i++) {
        var eIncomeName = formData.get("extraIncome" + i);
        var eIncomePrice = formData.get("price"+ i);
        extraIncome[eIncomeName] = eIncomePrice;

    }

    for (i=1;i<=rowDeductions;i++) {
        var eDeductionName = formData.get("extraDeduction" + i);
        var eDeductionPrice = formData.get("priceDeductions"+ i);
        extraDeduction[eDeductionName] = eDeductionPrice;

    }
    


    var userdata = {'monthYear':monthYear,'employeeId':employeeId,'payDate':payDate,'normalRate':normalRate,'normalDays':normalDays,'bonusRate':bonusRate,'bonusDays':bonusDays,
    'overtimeRate':overtimeRate,'overtimeHours':overtimeHours,'tax':tax,'uif':uif,'loan':loan,'uniform':uniform,'unionPay':unionPay,'unpaidLeave':unpaidLeave, 'bankName':bankName, 'accountNumber':accountNumber,'branch':branch,'branchCode':branchCode,'bankingDetailsId':bankingDetailsId};
    
    if(!(jQuery.isEmptyObject(extraDeduction))) {
        userdata["extraDeductions"] = extraDeduction;
    }
    if(!(jQuery.isEmptyObject(extraIncome))) {
        userdata["extraIncome"] = extraIncome;
    }


    $.ajax({
              type: "POST",
              url: "savepayslip.php",
              data:userdata, 
              success: function(data){
                  console.log(data);
                  document.querySelector('form').reset();
                  document.getElementById("result").innerHTML = "Payslip saved<a href='pdfgen.php?employeeNumber="+ employeeId + "&monthYear=" + monthYear + "'> Download pdf </a>or Add another payslip";
                  
                for (i=1;i<=rowNumber;i++) {
                    $("#incomeRow" + i).remove();
                }

                for (i=1;i<=rowDeductions;i++) {
                    $("#deductionRow" + i).remove();
                }
                  rowDeductions = 0;
                  rowNumber = 0;
                  extraDeduction = {};
                  extraIncome = {};
                  $('html, body').animate({ scrollTop: 0 }, 'fast');
                  
              }
              
              }
              );
              $(document).ajaxError(function () {
                document.getElementById("error").innerHTML = 'Oops something has gone wrong, you are missing some information'; 
            })
              
  });

  