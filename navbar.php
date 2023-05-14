<?php
echo "
<div class='site-mobile-menu site-navbar-target'>
        <div class='site-mobile-menu-header'>
          <div class='site-mobile-menu-close mt-3'>
            <span class='icon-close2 js-menu-toggle'></span>
          </div>
        </div>
        <div class='site-mobile-menu-body'></div>
      </div>

      <header class='site-navbar js-sticky-header site-navbar-target' role='banner'>

        <div class='container'>
          <div class='row align-items-center position-relative'>


            <div class='site-logo'>
              <a href='index.php'><img src='images/logo_img.jpg' width='80px'></a>
            </div>

            <div class='col-12'>
              <nav class='site-navigation text-right ml-auto ' role='navigation'>

                <ul class='site-menu main-menu js-clone-nav ml-auto d-none d-lg-block'>
                  <li><a href='employee.html' class='nav-link'>Add Employees</a></li>
                  <li><a href='view-employees.php' class='nav-link'>View Employees</a></li>

                  <li><a href='payslip.php' class='nav-link'>Enter Payslip</a></li>

                  <li><a href='generateslip.php' class='nav-link'>Generate Payslip</a></li>
                </ul>
              </nav>

            </div>

            <div class='toggle-button d-inline-block d-lg-none'><a href='#' class='site-menu-toggle py-5 js-menu-toggle text-black'><span class='icon-menu h3'></span></a></div>

          </div>
        </div>";
        ?>