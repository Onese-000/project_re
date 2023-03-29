<?php 
    if (isset($_POST['checkout'])) {

        

        //This function will handle the mpesa stk payment
        function STK_PUSH()
        {
            date_default_timezone_set('Africa/Nairobi');
            //callbackURL
            $callback_url = '';
            $access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
            $stk_push_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

            //access tokens
            $consumer_key = 'T4JaNS1DQMAbQIv4g9GjWAGuzIvICSsg';
            $consumer_sercret = 'dyuzb3kYJZoWl9T2';

            //GET THE USER INPUT
            $phonenumber = $_POST['phonenumber'];
            $amount = $_POST['amount'];
            
            //timestamp
            $timestamp = date('YmdHis');
            

            //shortcode
            $shortcode = '9922067';

            //passkey
            $pass = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';

            //encode passkey
            $passkey = $shortcode.$pass.$timestamp;
            $encode_passkey = base64_encode($passkey);
            
            //'Password' => 'MTc0Mzc5YmZiMjc5ZjlhYTliZGJjZjE1OGU5N2RkNzFhNDY3Y2QyZTBjODkzMDU5YjEwZjc4ZTZiNzJhZGExZWQyYzkxOTIwMjMwMzE0MDk0MzU0',

            //Authorization Request in PHP 
            
            $ch = curl_init($access_token_url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [ 'Authorization: Basic ' .base64_encode($consumer_key.":".$consumer_sercret)]);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            $response = json_decode($response);
            $access_token = $result ->access_token;

            $data = [                
                'BusinessShortCode' => $shortcode,
                'Password' => $encode_passkey,
                'Timestamp' => $timestamp,
                'TransactionType' => 'CustomerBuyGoodsOnline',
                'Amount' => $amount,
                'PartyA' => $phonenumber,
                'PartyB' => $shortcode,
                'PhoneNumber' => $phonenumber,
                'CallBackURL' => 'https://mydomain.com/path',
                'AccountReference' => "MyHouse",
                'TransactionDesc' => 'Payment of Rent' 
            ];

            $jsondata = json_encode($data);     

            $ch = curl_init($stk_push_url);
          
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer'.$access_token,
                'Content-Type: application/json'
            ]);

            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$jsondata);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $reply   = curl_exec($ch);
            curl_close($ch);
            echo $reply;
        }

    }





?>


<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Ample lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Ample admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description"
        content="Ample Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>My-House</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/ample-admin-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/favicon.png">
    <!-- Custom CSS -->
   <link href="css/style.min.css" rel="stylesheet">
   <link href="css/style.css" rel="stylesheet" type="text/css">
   <link href="css/finance.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="dashboard.html">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!-- Dark Logo icon -->
                            <img src="plugins/images/logo-icon.png" alt="homepage" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text -->
                            <img src="plugins/images/logo-text.png" alt="homepage" />
                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none"
                        href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <ul class="navbar-nav d-none d-md-block d-lg-none">
                        <li class="nav-item">
                            <a class="nav-toggler nav-link waves-effect waves-light text-white"
                                href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav ms-auto d-flex align-items-center">

                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class=" in">
                            <form role="search" class="app-search d-none d-md-block me-3">
                                <input type="text" placeholder="Search..." class="form-control mt-0">
                                <a href="" class="active">
                                    <i class="fa fa-search"></i>
                                </a>
                            </form>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li>
                            <a class="profile-pic" href="#">
                                <img src="plugins/images/users/varun.jpg" alt="user-img" width="36"
                                    class="img-circle"><span class="text-white font-medium">Steave</span></a>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="profile.php"
                                aria-expanded="false">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span class="hide-menu">Profile</span>
                            </a>
                        </li>
                        <li class="sidebar-item pt-2">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="dashboard.php"
                                aria-expanded="false">
                                <i class="far fa-clock" aria-hidden="true"></i>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        
                        
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="finance.php"
                                aria-expanded="false">
                                <i class="fa fa-table" aria-hidden="true"></i>
                                <span class="hide-menu">Finance</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="bills.php"
                                aria-expanded="false">
                                <i class="far fa-credit-card" aria-hidden="true"></i>
                                <span class="hide-menu">Bills</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="fontawesome.php"
                                aria-expanded="false">
                                <i class="fa fa-font" aria-hidden="true"></i>
                                <span class="hide-menu">Icon</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="map-google.php"
                                aria-expanded="false">
                                <i class="fa fa-globe" aria-hidden="true"></i>
                                <span class="hide-menu">Google Map</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="blank.php"
                                aria-expanded="false">
                                <i class="fa fa-columns" aria-hidden="true"></i>
                                <span class="hide-menu">Blank Page</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="404.php"
                                aria-expanded="false">
                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                <span class="hide-menu">Error 404</span>
                            </a>
                        </li>
                        <!-- <li class="text-center p-20 upgrade-btn">
                            <a href="https://www.wrappixel.com/templates/ampleadmin/"
                                class="btn d-grid btn-danger text-white" target="_blank">
                                Upgrade to Pro</a> -->
                        </li>
                    </ul>

                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Finance</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                                <li><a href="dashboard.html" class="fw-normal">Dashboard</a></li>
                            </ol>
                            <!-- <a href="https://www.wrappixel.com/templates/ampleadmin/" target="_blank"
                                class="btn btn-danger  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Upgrade
                                to Pro</a> -->
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                    <div class="row justify-content-center" style="display:flex;justify-content:space-between;">
                        <div class="col-lg-4 col-md-12" >
                            <div class="white-box analytics-info h-100" style="border-radius:10px;margin-bottom:30px;">
                                <h3 class="box-title" style="text-align:center;"> Receipt Details</h3>
                                <ul class="list-inline two-part d-flex align-items-center mb-0">
                                    <li>
                                        <div>
                                            <h6 class="box-title" style="font-size:16px;">
                                            Onese Gachogu Irungu
                                            </h6>
                                            <h6 class="box-title" style="font-size:16px;">Mountain-view Heights, 4B</h6>
                                            <h6  class="box-title" style="font-size:16px;">0757202111
                                            </h6>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="white-box analytics-info h-100" style="border-radius:10px;margin-bottom:30px;">
                                <!-- <h3 class="box-title" style="text-align:center;">Total Payments &emsp;</h3> -->
                                <ul class="list-inline two-part d-flex align-items-center mb-0">
                                    <li>
                                        <form method="POST" action="#">
                                        <div>
                                            <h6 class="ms-auto"><span class="counter text-danger" style="font-size:16px;" >
                                                <strong>Arrears: &emsp;&emsp;&emsp;&ensp;&ensp;&nbsp;&emsp;10,000 </strong></span></h6>
                                            <div class="form-check">
                                                <input class="form-check-input" checked type="radio" value="settle" id="settle-all" name="payment" >
                                                <label class="form-check-label" for="settle-all">
                                                Settle all arrears
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="custom" id="custom-payment" name="payment">
                                                <label class="form-check-label" for="custom-payment">
                                                Custom payment
                                                </label>
                                            </div>
                                            <div class="form-group" id="amountTextAreaWrapper" >
                                                <label for="amount">Amount in Ksh.</label>
                                                <textarea class="form-control" id="amount" rows="1" style="resize:none" readonly>10000</textarea>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <label for="phonenumber">Saf Mobile Number</label>
                                                    </div>   
                                                    <div class="col-sm-7">
                                                        <img src="mpesa-original.png" alt="icon" height="30" width="60">                                                </div>                   
                                                <input type="tel" class="form-control" id="phonenumber" aria-describedby="mobileHelp">
                                            </div>

                                            
                                        </div>
                                      
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>      

                    <div class="d-flex justify-content-center align-items-center h-100" style="margin-top:30px;">
                        <button class="btn btn-primary " type="submit" name="checkout" data-toggle="modal" data-target="#myModal" id="checkout" >Checkout</button>
                    </div>
    </form>

                    <!-- The Modal -->
                    <div class="modal fade" id="myModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title"></h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <p>Keep your Mobile Phone ON. A payment link has been sent to the number 0757202111</p>
                                    <p>Enter your Mpesa PIN to complete the transaction</p>
                                </div>
                                
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closePopWindow">Close</button>
                                </div>
                                
                            </div>
                        </div>
                    </div>


                
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center"> 2021 © Ample Admin brought to you by <a
                    href="https://www.wrappixel.com/">wrappixel.com</a>
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    
    
    <script src="js/app-style-switcher.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.js"></script>

    <!-- PAYMENT AMOUNT-->
    <script>
    $(document).ready(function() {
  // Disable textarea by default
        $('#amountTextArea').prop('readonly', true);
         $('#amountTextArea').css('color', 'grey');
  
  $('input[type="radio"]').click(function() {
        if($(this).attr('id') == 'custom-payment') {
            $('#amountTextAreaWrapper').show();
            $('#amountTextArea').prop('readonly', false);
            $('#amountTextArea').css('color', 'black');
        } else {
            $('#amountTextAreaWrapper').hide();
            $('#amountTextArea').prop('readonly', true);
            $('#amountTextArea').css('color', 'grey');
        }
    });
    });

    </script>

 <!--POP UP WINDOW SCRIPT -->
    <script>
        $(document).ready(function() {
        // Get the modal
            var modal = $("#myModal");

            // Get the button that opens the modal
            var btn = $("#checkout");

            // Get the <span> element that closes the modal
            var span = $(".close");

            //get the footer button that closes the pop up window
            var footerButton = $("#closePopWindow")

            //when user clicks the footer button that closes the pop up window
            footerButton.click(function(){
                modal.modal("hide");
            });

            // When the user clicks on the button, open the modal
            btn.click(function() {
                modal.modal("show");
            });

            // When the user clicks on <span> (x), close the modal
            span.click(function() {
                modal.modal("hide");
            });

            // When the user clicks anywhere outside of the modal, close it
            $(window).click(function(event) {
                if (event.target == modal.get(0)) {
                modal.modal("hide");
                }
            });
        });






    </script>

</body>

</html>