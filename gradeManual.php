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

            $(function() {
                loadClasses();
            })

            function onSubmit(id) {
                console.log(id);
            }

            function loadStudents() {

            }

            function loadClasses() {
                $.ajax({
                    url: 'processGrading.php',
                    type: 'POST',
                    async: true,
                    success: function(response) {
                        let data = JSON.parse(response);
                        console.log(data);
                        
                        if(data.err == null) {
                            let templateScript = $("#classTableTemplate").html();
                            let template = Handlebars.compile(templateScript);
                            let compiledHtml = template(data);
                            $("#classTable").html(compiledHtml);
                        }
                        else {
                            $("#classTable").html("<tr>" + data.err +"</td>");
                        }
                    }
                });
            }
        </script>

            <!-- Scripts for handlebars below -->
        <script id="classTableTemplate" type="text/x-handlebars-template">
            <!-- Add headers to these scripts -->
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
                        <tr id="id_{{ID}}" onclick="onSubmit('{{ID}}')"> <!-- add on click event to direct to a student list of each class -->
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

        <script id="studentTableTemplate" type="text/x-handlebars-template"></script>
        
    </head>

    <body>
        <section>
            <h1>Grading Home</h1>

        </section>

        <div id="classTable">

        </div>

    </body>
</html>