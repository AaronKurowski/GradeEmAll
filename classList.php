<html>
    <head>
        <title>Class List</title>

        <style>
            body {
                background-color: black;
                color: bisque;
            }

            #header {
                text-align: center;
            }

            h1 {
                text-align: center;
            }

            .navButtons {
                text-align: center;
                margin-bottom: 5px;
            }

            table {
                border: 1px solid white;
                width: 100%;
                text-align: center;
                border-collapse: collapse;
            }

            thead > tr {
                background-color: #298d9e;
                height: 30px;
            }

            tbody > tr {
                border: 2px solid bisque;
            }

            tbody > tr > td {
                border: 1px solid bisque; 
                cursor: pointer;
                height: 40px;
            }

            tbody > tr:hover {
                background-color: #403f3f;
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

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/handlebars@latest/dist/handlebars.js"></script>

        <script>
            $(function() {
                loadClasses();
            })

            function onClick(id) {
                alert("Class " + id + " selected");

            }

            function clearTable() {
                $("#classTable").empty();
            }

            function loadClasses() {
                $.ajax({
                    url: 'processGrading.php',
                    type: 'POST',
                    async: true,
                    data: {action: "getClasses"},
                    success: function(response) {
                        let data = JSON.parse(response);
                        console.log(data);

                        if(data.err == null) {
                            let templateScript = $("#classTableTemplate").html();
                            let template = Handlebars.compile(templateScript);
                            let compiledHtml = template(data);
                            $("#table").html(compiledHtml);
                        }
                        else {
                            $("#table").html("<tr>" + data.err +"</td>");
                        }
                    }
                });
            }

            function loadStudents(id) {
                clearTable();
                console.log("Loading class id: " + id);

                $.ajax({
                    url: 'processGrading.php',
                    type: 'POST',
                    async: true,
                    data: {action: "getStudents", classID: id},
                    success: function(response) {
                        let data = JSON.parse(response);
                        console.log(data);

                        if(data.err == null) {
                            let templateScript = $("#studentTableTemplate").html();
                            let template = Handlebars.compile(templateScript);
                            let compiledHtml = template(data);

                            $("#table").html(compiledHtml);
                        }
                        else {
                            $("#table").html("<tr>" + data.err + "</tr>");
                        }
                    }
                })
            }

            function loadSections(id) {
                clearTable();
                console.log("Loading student id " + id + " sections");

                $.ajax({
                    url: 'processGrading.php',
                    type: 'POST',
                    async: true,
                    data: {action: "getSections", studentID: id},
                    success: function(response) {
                        let data = JSON.parse(response);
                        console.log(data);
                    
                        if(data.err == null) {
                            let templateScript = $("#studentSectionTemplate").html();
                            let template = Handlebars.compile(templateScript);
                            let compiledHtml = template(data);

                            $("#table").html(compiledHtml);
                        }
                        else {
                            $("#table").html("<tr>" + data.err + "</tr>");
                        }
                    }
                })
            }

        </script>

        <!-- Change of plans. Have clickable classes to navigate to the sections
             and then to the subsections. After that there will be a dropdown in which
             you can select a student and administer grading
             Classes => sections => subsections => select students => grade -->
        <script id="classTableTemplate" type="text/x-handlebars-template">
            <h1>Classes</h1>
            <table id="classTable">
                <thead>
                    <tr>
                        {{#each headers}}
                            <td>{{this}}</td>
                        {{/each}}
                    </tr>
                </thead>

                <tbody>
                    {{#each classes}}
                        <tr id="id_{{ID}}" onclick="loadStudents({{'Class ID'}})"> <!-- add on click event to direct to a student list of each class -->
                            <td>{{'Class ID'}}</td>
                            <td>{{'Start Date'}}</td>
                            <td>{{'End Date'}}</td>
                            <td>{{'Class Type'}}</td>
                        </tr>
                    {{/each}}
                </tbody>
            </table>
        </script>

        <script id="classSectionTemplate" type="text/x-handlebars-template">
            <h1>Class Sections</h1>
            <div class="navButtons">
                <button class="btn" type="submit" onclick="" value="Classes">Classes</button>
            </div>

            <table>
                <thead>
                    <tr>
                        {{#each headers}}
                            <td>{{this}}</td>
                        {{/each}}
                    </tr>
                </thead>

                <tbody>
                    {{#each section}}
                        <tr id="id_'{{Section ID}}'">
                            <td>{{classType}}</td>
                            <td>{{sectionID}}</td>
                            <td>{{title}}</td>
                            <td>{{startTime}}</td>
                            <td>{{endTime}}</td>
                        </tr>
                    {{/each}}
                </tbody>
            </table>
        </script>

        <script id="studentTableTemplate" type="text/x-handlebars-template">
            <h1>Students</h1>
            <div class="navButtons">
                <button class="btn" type="submit" onclick="loadClasses();" value="Classes">Classes</button>
            </div>

            <table>
                <thead>
                    <tr>
                        {{#each headers}}
                            <td>{{this}}</td>
                        {{/each}}
                    </tr>
                </thead>

                <tbody>
                    {{#each students}}
                        <tr id="id_{{contactNo}}" onclick="loadSections('{{contactNo}}')">
                            <td>{{contactNo}}</td>
                            <td>{{companyNo}}</td>
                            <td>{{name}}</td>
                            <td>{{phone}}</td>
                            <td>{{grade}}</td>
                        </tr>
                    {{/each}}
                </tbody>
            </table>
        </script>

        <script id="studentSectionTemplate" type="text/x-handlebars-template">
            <div class="navButtons">
                <button class="btn" type="submit" onclick="" value="Classes">Back</button>
            </div>

            <table>
                <thead>
                    <tr>
                        {{#each headers}}
                            <td>{{this}}</td>
                        {{/each}}
                    </tr>
                </thead>

                <tbody>
                    {{#each section}}
                        <tr id="id_'{{Section ID}}'">
                            <td>{{classType}}</td>
                            <td>{{sectionID}}</td>
                            <td>{{title}}</td>
                            <td>{{startTime}}</td>
                            <td>{{endTime}}</td>
                        </tr>
                    {{/each}}
                </tbody>
            </table>
        </script>
    </head>

    <body>
        <section>
            <!-- <div id="header">
                <h1>Class List</h1>
            </div> -->
        </section>

        <section>
            <div id="table">
                
            </div>
        </section>
    </body>
</html>