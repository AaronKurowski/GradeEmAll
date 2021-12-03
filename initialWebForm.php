<html>
    <head>
        <title>WebForm</title>
    
        <style>
            body {
                background-color: black;
                color: #FFFFCC;
                font-family: 'Arial';
            }

            #main-wrapper {
                display: block;
                justify-content: center;
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
            }

            form > input {
                padding: 3px;
                margin-bottom: 10px;
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
                <form>
                    <label>Attendee Name: </label>
                    <input type="text"><br>

                    <label>Attendee Email: </label>
                    <input type="email"><br>

                    <label>Attendee Phone: </label>
                    <input type="tel"><br>

                    <label>Submitter Name: </label>
                    <input type="text"><br>

                    <label>Submitter Email: </label>
                    <input type="email"><br>

                    <label>Submitter Phone: </label>
                    <input type="tel"><br>

                    <label>Academy Date: </label>
                    <select id="date-dropdown">
                        <option value="">--Select a Date--</option>
                        <option value="Date 1">Date 1</option>
                        <option value="Date 2">Date 2</option>
                    </select>

                    <br><br>
                    <input class="btn" type="submit" value="Submit">
                </form>
            </div>
        </div>
    </body>
</html>