$(function(){
    let $fname = $("#fname");
    let $employeeNumber = $("#employeeNumber");
    let $month = $("#month");
    let $year = $("#year");
    let $payslipsName = $("#payslipsName");
    let $listOfPayslips = $("#listOfPayslips");
    let $message = $("#message");

    $.ajax({
        url: "db_query.php",
        dataType: "json",
        success: function(data) {
            $("#fname").autocomplete({
                source: data,
                select: function(event, ui) {
                    $employeeNumber.val(ui.item.empn);
                    $fname.val(ui.item.label);
                    let employeeName = ui.item.label;
                    let employeeData = { "employeeNumber": ui.item.empn };
                    // Send selected name to PHP page
                    $.ajax({
                        type: "POST",
                        url: "payinfo.php",
                        data: employeeData,
                        success: function(data) {
                        $payslipsName.html("List of Payslips for " + employeeName);
                        $listOfPayslips.html(data);
                        $('form')[0].reset();
                    }
                });
                    return false;
                }
            });
        }
    });

    $year.click(function() {
        let optionMonth = $month.val();
        let optionYear = $year.val();
        let optionMonthText = $month.find('option:selected').text();
        let optionYearText = $year.find('option:selected').text();
        let employeeId = $employeeNumber.val();
    
        if (optionMonth === "") {
          $month.css("border-color", "red");
          $message.html("You have to pick the month first");
          $('form')[0].reset();
        } else {
          let monthYear = optionYear + "-" + optionMonth;
          let niceMonthYear = optionMonthText + " " + optionYearText;
          let payslipData = { monthYear: monthYear, employeeNumber: employeeId };
          // Send AJAX request to payinfo.php
          $.ajax({
            type: "POST",
            url: "payinfo.php",
            data: payslipData,
            success: function(data) {
              $payslipsName.html("List of Payslips for " + niceMonthYear);
              $listOfPayslips.html(data);
              $('form')[0].reset();
            }
          });
        }
      });
});

