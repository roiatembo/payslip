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

document.getElementById('employeeForm').addEventListener('submit', (e) => {
    const formData = new FormData(e.target);
    var fullName = formData.get('fullName');
    var idNo = formData.get('idNo');
    var address = formData.get('address');
    var phoneNumber = formData.get('phoneNumber');
    var occupation = formData.get('occupation');
    var date = formData.get('date');
    var employeeNumber = formData.get('employeeNumber');
    var taxNumber = formData.get('taxNumber');
    var bankName = formData.get('bankName');
    var accountNumber = formData.get('accountNumber');
    var branchName = formData.get('branchName');
    var branchCode = formData.get('branchCode');
    
    var userdata = {'fullName':fullName,'idNo':idNo, 'address':address, 'phoneNumber':phoneNumber, 'occupation':occupation, 'date':date,
                    'employeeNumber':employeeNumber, 'taxNumber':taxNumber, 'bankName':bankName, 'accountNumber':accountNumber, 'branchName':branchName, 'branchCode':branchCode
                    };

    // check if employee number is already taken
    var employeeCheck = {"employeeCheck": employeeNumber}
    var result = "";
    
    $.ajax({
        type: "POST",
        url: "save.php",
        data: employeeCheck, 
        success: function(data){
            result = data;

            if (result == "good") {
                $.ajax({
                    type: "POST",
                    url: "save.php",
                    data:userdata, 
                    success: function(data){
                        console.log(data);
                        document.querySelector('form').reset();
                        document.getElementById("result").innerHTML = 'Employee has been saved';
                        $('html, body').animate({ scrollTop: 0 }, 'fast');
                    }
                    
                    }
                    );
          $(document).ajaxError(function () {
              document.getElementById("error").innerHTML = 'Oops something has gone wrong, you are missing some informations'; 
          })
            } else if (result == "problem") {
                document.getElementById("error").innerHTML = 'The employee number already exists';
            }
            
        }
        
        }
        );

              
  });
