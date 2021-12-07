<?php 

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $link = mysqli_connect("localhost", "root", "root", "GradeEmAll");

        if($link == false) {
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
    
        $attendeeName = mysqli_real_escape_string($link, $_REQUEST['attendeeName']);
        $attendeeEmail = mysqli_real_escape_string($link, $_REQUEST['attendeeEmail']);
        $attendeePhone = mysqli_real_escape_string($link, $_REQUEST['attendeePhone']);
        $submitterName = mysqli_real_escape_string($link, $_REQUEST['submitterName']);
        $submitterEmail = mysqli_real_escape_string($link, $_REQUEST['submitterEmail']);
        $submitterPhone = mysqli_real_escape_string($link, $_REQUEST['submitterPhone']);
        $academyDate = mysqli_real_escape_string($link, $_REQUEST['academyDate']);

        // Need to look up company contact or add it
        $sql = "INSERT INTO `Student` (`Contact No_`, `Class ID`, `Company No_`, `Name`, `Email`, `Phone`, `Submitted By Name`, `Submitted By Email`, `Submitted By Phone`, `Final Grade`) 
                VALUES ('1', '$academyDate', '1', '$attendeeName', '$attendeeEmail', '$attendeePhone', '$submitterName', '$submitterEmail', '$submitterPhone', NULL);";
    
        // $sql2 = ""; below: && mysqli_query($link, $sql2)
    
        if(mysqli_query($link, $sql)) {
            echo "Records added successfully!";
        } else {
            echo "ERROR: Could not execute $sql. " . mysqli_error($link);
        }
    
        mysqli_close($link);
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>WebForm</title>
    
        <style>
            body {
                background-color: black;
                color: #FFFFCC;
                font-family: 'Arial';
            }

            #main-wrapper {
                /* display: block; */
                /* justify-content: center; */
            }

            h2 {
                text-align: center;
            }

            #form-content {
                width: 60%;
                margin: 0 auto;
                padding: 10px;
            }

            form {
                margin: 0 auto;
                text-align: center;
            }

            label {
                display:inline-block;
                width: 200px;
                margin-right: 10px;
                text-align: right;
                font-size: 25px;
            }
            
            form > input, select {
                padding: 3px;
                margin-bottom: 25px;
                height: 40px;
                width: 260;
                font-size: 1.5em;
            }
            
            @media screen and (max-width: 671px) {                
                label {
                    width: 200px;
                    display: inline-block;
                    text-align: center;
                    margin-right: 10px;
                }
            }

            .btn {
                -moz-box-shadow: 0px 0px 0px 2px #9fb4f2;
                -webkit-box-shadow: 0px 0px 0px 2px #9fb4f2;
                box-shadow: 0px 0px 0px 2px #9fb4f2;
                background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #7892c2), color-stop(1, #476e9e));
                background:-moz-linear-gradient(top, #7892c2 5%, #476e9e 100%);
                background:-webkit-linear-gradient(top, #7892c2 5%, #476e9e 100%);
                background:-o-linear-gradient(top, #7892c2 5%, #476e9e 100%);
                background:-ms-linear-gradient(top, #7892c2 5%, #476e9e 100%);
                background:linear-gradient(to bottom, #7892c2 5%, #476e9e 100%);
                filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#7892c2', endColorstr='#476e9e',GradientType=0);
                background-color:#7892c2;
                -moz-border-radius:10px;
                -webkit-border-radius:10px;
                border-radius:10px;
                border:1px solid #4e6096;
                display:inline-block;
                cursor:pointer;
                color:#ffffff;
                font-family:Arial;
                font-size:13px;
                padding:5px 25px;
                text-decoration:none;
                text-shadow:0px 1px 0px #283966;
                margin-left: 20px;
                margin-bottom: 10px;
            }

            .btn:active {
                background: #e5e5e5;
                -webkit-box-shadow: inset 0px 0px 5px #c1c1c1;
                -moz-box-shadow: inset 0px 0px 5px #c1c1c1;
                box-shadow: inset 0px 0px 5px #c1c1c1;
                outline: none;
                color: black;
            }

            button:focus {
                background: #e5e5e5;
                outline: none;
                -webkit-box-shadow: inset 0px 0px 5px #c1c1c1;
                -moz-box-shadow: inset 0px 0px 5px #c1c1c1;
                box-shadow: inset 0px 0px 5px #c1c1c1;
            }

        </style>
    </head>

    <body>
        <div id="main-wrapper">
            <h2>Class Sign-Up</h2>
            <div id="form-content">
                <form action="initialWebForm.php" method="POST">
                    <label for="attendeeName" >Attendee Name: </label>
                    <input type="text" name="attendeeName" id="attendeeName"><br>

                    <label for="attendeeEmail">Attendee Email: </label>
                    <input type="email" name="attendeeEmail"><br>

                    <label for="attendeePhone">Attendee Phone: </label>
                    <input type="tel" name="attendeePhone" id="attendeePhone"><br>

                    <label for="submitterName">Submitter Name: </label>
                    <input type="text" name="submitterName" id="submitterName"><br>

                    <label for="submitterEmail">Submitter Email: </label>
                    <input type="email" name="submitterEmail" id="submitterEmail"><br>

                    <label for="submitterPhone">Submitter Phone: </label>
                    <input type="tel" name="submitterPhone" id="submitterPhone"><br>

                    <label for="academyDate">Academy Date: </label>
                    <select id="date-dropdown" name="academyDate">
                        <option value="">--Select a Date--</option>
                        <option value="1">12/7/2021</option>
                        <option value="2">02/1/2022</option>
                    </select>

                    <br><br>
                    <input class="btn" type="submit" value="Submit">
                </form>
            </div>
        </div>
    </body>
</html>