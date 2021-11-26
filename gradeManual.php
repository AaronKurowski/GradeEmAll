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

            tbody > tr {
                border: 2px solid bisque;
            }

            tbody > tr > td {
                border: 1px solid bisque; 
                cursor: pointer;
            }

            tbody > tr:hover {
                background-color: #403f3f;
            }

        </style> 

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/handlebars@latest/dist/handlebars.js"></script>


        <script type="text/javascript">
            function onSubmit() {
                console.log("Pressed");
            }
        </script>
            <!-- Scripts for handlebars below -->

        <script type="text/x-handlebars-template">

        </script>
    </head>

    <body>
        <section>
            <h1>Grading Home</h1>

        </section>

        <section>
            <table>
                <thead>
                    <tr>
                        <td>Class</td>
                        <td>Start Date</td>
                        <td>End Date</td>
                        <td>Instructor</td>
                    </tr>
                </thead>

                <tbody>
                    <tr onclick="onSubmit();">
                        <td>Blue</td>
                        <td>11/23/2021</td>
                        <td>11/25/2021</td>
                        <td>J. Smith</td>
                    </tr>

                    <tr onclick="onSubmit();">
                        <td>Red</td>
                        <td>11/23/2021</td>
                        <td>11/25/2021</td>
                        <td>J. Smith</td>
                    </tr>

                    <tr onclick="onSubmit();">
                        <td>Green</td>
                        <td>11/23/2021</td>
                        <td>11/25/2021</td>
                        <td>J. Smith</td>
                    </tr>
                </tbody>
            </table>
        </section>

    </body>
</html>