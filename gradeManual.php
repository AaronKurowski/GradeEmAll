<!DOCTYPE html>

<html>
    <head>
        <title>Grading Home</title>
    
        <style>
            body {
                background-color: black;
                color: bisque;
            }

            h1 {
                text-align: center;
            }

            table {
                border: 1px solid white;
                width: 100%;
                text-align: center;
                border-collapse: collapse;
            }

<<<<<<< HEAD
            thead > tr > td {
                font-size: larger;
                font-weight: bold;
                color: cadetblue;
=======
            thead > tr {
                background-color: #298d9e;
                height: 30px;
>>>>>>> 40adafc205ee8f4a22eb40f5c540f9dd99a7f106
            }

            tbody > tr {
                border: 2px solid bisque;
                cursor: pointer;
                height: 33px;
            }
            
            tbody > tr > td {
<<<<<<< HEAD
                border: 1px solid bisque;
=======
                border: 1px solid bisque; 
                cursor: pointer;
                height: 40px;
>>>>>>> 40adafc205ee8f4a22eb40f5c540f9dd99a7f106
            }

            tbody > tr:hover {
                background-color: #403f3f;
            }

        </style> 

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/handlebars@latest/dist/handlebars.js"></script>

        <script type="text/javascript">
            Handlebars.registerHelper('each', function(context, options) {
                var ret = "";

                for(var i=0, j=context.length; i<j; i++) {
                    ret = ret + options.fn(context[i]);
                }

                return ret;
            });

            // On load
            $(function() {
                loadClasses();
            })

            function onClick(id) {
                console.log(id);
                clearTable();
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

            function loadAssignments(id) {
                clearTable();
                console.log("Loading student id " + id + " assignments");

                $.ajax({
                    url: 'processGrading.php',
                    type: 'POST',
                    async: true,
                    data: {action: "getAssignments", studentID: id},
                    success: function(response) {
                        let data = JSON.parse(response);
                        console.log(data);
                    
                        if(data.err == null) {
                            let templateScript = $("#assignmentTableTemplate").html();
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

            <!-- Scripts for handlebars below -->
        <script id="classTableTemplate" type="text/x-handlebars-template">
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
                        <tr id="id_{{ID}}" onclick="loadStudents('{{ID}}')"> <!-- add on click event to direct to a student list of each class -->
                            <td>{{ID}}</td>
                            <td>{{Name}}</td>
                            <td>{{'Start Date'}}</td>
                            <td>{{'End Date'}}</td>
                            <td>{{Instructor}}</td>
                        </tr>
                    {{/each}}
                </tbody>
            </table>
        </script>

        <script id="studentTableTemplate" type="text/x-handlebars-template">
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
                        <tr id="id_{{id}}" onclick="loadAssignments('{{id}}')">
                            <td>{{id}}</td>
                            <td>{{name}}</td>
                            <td>{{class}}</td>
                            <td>{{company}}</td>
                        </tr>
                    {{/each}}
                </tbody>
            </table>
        </script>

        <script id="assignmentTableTemplate" type="text/x-handlebars-template">
            <table>
                <thead>
                    <tr>
                        {{#each headers}}
                            <td>{{this}}</td>
                        {{/each}}
                    </tr>
                </thead>

                <tbody>
                    {{#each assignments}}
                        <tr>
                            <td>{{id}}</td>
                            <td>{{name}}</td>
                            <td>{{class}}</td>
                            <td>{{weight}}</td>
                            <td>{{student}}</td>
                        </tr>
                    {{/each}}
                </tbody>
            </table>
        </script>
    </head>

    <body>
        <section>
            <h1>GradeEmAll</h1>
        </section>

        <section>
            <div id="table">
    
            </div>
        </section>
        
    </body>
</html>