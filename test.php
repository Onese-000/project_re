<!DOCTYPE html>
<?php

    require("DB_connect.php");

    //if the user has clicked the SEARCH BUTTON

    if (isset($_POST['search'])) {

        $buildingName = $_POST['buildingName'];
        $buildingName_metaphone = metaphone($buildingName);

        $apartment_name_query = "SELECT Apartment_Name FROM Apartments";
  
        $result = mysqli_query($_SESSION['$connection'],$apartment_name_query);
        $metaphone_match = array();

        while ($row = mysqli_fetch_assoc($result)) {
             $buildingQuery_metaphone = metaphone($row['Apartment_Name']);
             if (strstr($buildingQuery_metaphone,$buildingName_metaphone)) {
                $metaphone_match[] = $row['Apartment_Name'];
             }
        }

         //format the metaphone match list to use it in the sql query
          $inClause = "'" . implode("','", $metaphone_match) . "'";
         
        
        function create_table($inClause) {
          
            $sql = "SELECT  Apartment_Name,Apartment_County, Apartment_Constituency FROM Apartments WHERE Apartment_Name IN ($inClause)";
            $output = mysqli_query($_SESSION['$connection'], $sql);
            // Check if the query returns any rows
            echo "<br>";
            if (mysqli_num_rows($output) > 0) {
                // Display the result in an HTML table ..CSS for the table
                echo "
                <style>
                    table {
                        border-collapse: collapse;
                        width: 100%;
                        margin-bottom: 1rem;
                    }
                    
                    th, td {
                        text-align: left;
                        padding: 0.5rem;
                        border-bottom: 1px solid #ddd;
                    }
                    
                    th {
                        background-color: #f2f2f2;
                    }
                    
                    tr:hover {
                        cursor: pointer;
                        background-color: #f5f5f5;
                    }
                    
                    #apartment-name {
                        color: #ccc;
                    }
                </style>                
                ";
                echo "<table>";
                echo "<tr><th>Apartment Name</th><th>County</th><th>Constituency</th></tr>";
                
                while($row = mysqli_fetch_assoc($output)) {
                    echo "<tr onclick='sendDataName(this)' data-name='".$row["Apartment_Name"]."'><td>" . $row["Apartment_Name"] . "</td><td>" . $row["Apartment_County"] . "</td><td>" . $row["Apartment_Constituency"] . "</td></tr>";
                }
                
                echo "</table>";
            } else {
                echo "No results found.";
            }

        }
        
        echo "WAITING FOR AJAX"."\n";
        if (isset($_POST['dataName'])) {        
            
                $chosen_BuildingName = $_POST['dataName'];
                // Do something with $dataName, such as storing it in a database
                echo "AJAX WORKED AND THE DATA HAS ARRIVED"," ",$chosen_BuildingName;
                echo             
                $sql_get_apartment_id = " SELECT Apartment_Id FROM Apartments WHERE Apartment_Name = '$chosen_BuildingName';";
                $sql_get_apartment_id_output= mysqli_query($_SESSION['$connection'], $sql_get_apartment_id);
                
                //
                while ($Apartment_Id_row = mysqli_fetch_assoc($sql_get_apartment_id_output)) {

                    $Apartment_Id = $Apartment_Id_row['Apartment_Id'];
                }
                echo $Apartment_Id;

                //GET THE LIST OF UNITS 
                $sql_get_units = " SELECT Unit_Id from `Apartment_Id`";
                $sql_get_units_output = mysqli_query($_SESSION['$connection'], $sql_get_units);

                //while ($units = mysqli_fetch_assoc($sql_get_units_output)) {
                //  echo "<option value='" . $units["Unit_Id"] . "'>" . $units["Unit_Id"] . "</option>";
                    echo "<select>";

                while ($units = mysqli_fetch_assoc($sql_get_units_output)) {
                    echo "<option value='" . $units["Unit_Id"] . "'>" . $units["Unit_Id"] . "</option>";
                }
                echo "</select>";

            }
        }
        else echo "\n"."DATA NOT ARRIVED";    
        
    if (isset($_POST['sendotp'])) {

        $Recepient = $_POST['phoneNumber'];
        //$phoneNumber = preg_replace('/^0/','254',str_replace("+","",$Recepient));
        $phoneNumber = 254757202111;
        $generated_OTP = mt_rand(12222,999999);
        setcookie('generated_OTP',$generated_OTP);

        $Message = ("MyHouse Login OTP is".$generated_OTP);
        echo "PhoneNumber::  ".$phoneNumber,"\n";
        echo "Generated OTP:: ".$generated_OTP;

        $reply= sendSMS($phoneNumber,$Message);
        //$reply = trim($reply, '[]');
        //$sms_res = json_decode($reply);
        echo "THIS IS THE API REPLY",$reply;

        if (isset($_POST['verifyotp'])) {

            $verificationOTP = $_POST['otp'];
            if ($verificationOTP == $_COOKIE['generated_OTP']) {
                echo ("LOGIN SUCCESS");
            }

            else{
                echo  ("LOGIN FAILURE");
            }}
        
        }

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MyHouse</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/favicon.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          crossorigin="anonymous">
     <link rel="stylesheet" href="css/test.css" >
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" ></script>
    <!-- CSS STYLESHEET -->
    <style>
        body{
            background-color:#36393f;
            font: white;
        }

        .form-header {
            color: white;
            font-size: 30px;
            font-weight: bold;
            text-align: center;
            margin-top: 50px;
            margin-bottom: 30px;
        }

        label {
            color:white;
        }

        input[type=text], select {
            background-color: white;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px;
            width: 100%;
            margin-bottom: 20px;
        }

        textarea {
            background-color: #36393f;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px;
            width: 100%;
            height: 100px;
            margin-bottom: 20px;
            resize: none;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        input[type=submit] {
            background-color: #7289da;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            font-size: 18px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            
            border-left:1px red;
            border-bottom:1px red;
            border-radius:1px red;

        }

        /**/

        /*     OUTPUT SEARCH TABLE*/
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 1rem;
        }
        
        th, td {
            text-align: left;
            padding: 0.5rem;
            border-bottom: 1px solid #ddd;
        }
        
        th {
            background-color: #f2f2f2;
        }
        
        tr:hover {
            cursor: pointer;
            background-color: #f5f5f5;
        }
        
        #apartment-name {
            color: #ccc;
        }

    </style>
</head>
<body >
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="form-header">Sign In</div>
            <form action="#" method="post">
                <div class="form-group ">
                    <div class="input-group">
                        <div class="bld-form" style="width:50%;">
                            <label for="buildingname">Name of the Building</label>
                            <input type="text" class="form-control" id="buildingName"  name="buildingName" required>
                            
                        </div>    
                        <div class="input-group-append" style="width:40%;margin-left:auto;">
                                <input class="btn btn-outline-secondary" type="submit" id="search" name="search" value="Search" style="height:40px;margin-top:15%">
                        </div>
                    </div>
                </div>
                <div class="output_table">
                    <?php 
                    if (isset($_POST['search'])){
                    create_table($inClause);}?>
                 </div>
                <div class="form-group">
                    <label for="unit">Select Unit</label>
                    <select class="form-control" id="unit" name="unit">
                        <option value="">Choose your Unit</option>
                        <?php?>
                        <option value="unit-1">Unit 1</option>
                        <option value="unit-2">Unit 2</option>
                        <option value="unit-3">Unit 3</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="phoneNumber">Registered Phone Number</label>
                    <input class="form-control" id="phoneNumber" name="phoneNumber" value="+254757202111">
                </div>
                <div class="btn-container" style="justify-content:center;" >
                    <button type="submit" id="sendotp" name="sendotp" >Send OTP</button>
                </div>
                <div class="form-group">
                    <p>An OTP Link has been sent to the above Mobile Phone number</p>
                </div>
                <div class="form-group">
                    <label for="otp">Enter OTP</label>
                    <input type="text" class="form-control" id="otp" name="otp">
                </div>
                <div class="btn-container" >
                    <button type="submit" id="verifyotp" name="verifyotp" >Login</button>
                </div>
    </div>
 </div>
</div>
<script>
        
    const rows = document.querySelectorAll('tr[data-name]');
    const input = document.getElementById('buildingName');

    rows.forEach(row => {
        row.addEventListener('click', () => {
            const name = row.getAttribute('data-name');
            input.value = name;
            input.disabled = true;
            input.style.color = '#000';
        });
    });

    function sendDataName(row) {
        var dataName = row.getAttribute('data-name');
        alert (dataName);
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', 'test.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.onreadystatechange = function() {
             if (this.readyState == 4 && this.status == 200) {
               
                document.body.innerHTML = xhttp.responseText;
                console.log(xhttp.responseText);
                console.log(dataName);
                }
                else {
                         console.error('Request failed.  Returned status of ' + xhttp.status);
                    }
        };
        xhttp.send('dataName=' + encodeURIComponent(dataName));
        console.log(this.status);
    }


</script>
</body>
</html>


   