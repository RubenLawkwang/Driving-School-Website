<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <?php include_once("../php/csslinks.php");
    include_once("../php/jslinks.php")
    ?>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js">
    </script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js">
    </script>

    <script type="text/javascript">
    $(document).ready(function() {
        $.ajax({
            url: "json.php",
            dataType: "JSON",
            success: function(result) {
                google.charts.load('current', {
                    'packages': ['corechart']
                });
                google.charts.setOnLoadCallback(function() {
                    drawChart(result);
                });
            }
        });

        function drawChart(result) {
            var data = new google.visualization.DataTable();

            data.addColumn('string', 'c_lname');
            data.addColumn('number', 'c_id');

            var dataArray = [];
            $.each(result, function(i, obj) {
                dataArray.push([obj.c_lname, parseInt(obj.c_id)]);
            });
            data.addRows(dataArray);

            var piechart_options = {
                title: 'Pie Chart: Stands classified by Number of clients who join Slow and Furious',
                width: 400,
                height: 300
            };
            var piechart = new google.visualization.PieChart(document
                .getElementById('piechart_div'));
            piechart.draw(data, piechart_options);
            var barchart_options = {
                title: 'Barchart: Stands classified by Price',
                width: 400,
                height: 300,
                legend: 'true'
            };


            var barchart = new google.visualization.BarChart(document
                .getElementById('barchart_div'));

            barchart.draw(data, barchart_options);
        }


    });
    </script>

</head>

<body>
    <header>
        <!--start of navbar -->
        <?php
        include_once("../php/adminhead.php")
        ?>
        <!-- end of navbar-->
    </header>
    <div class="container text-centre">

        <h1 class="text-center"> Dash Board </h1>
    </div>
    <h2>Number of Clients Who joined Slow and Furious</h2>
    <div class="container-fluid mt-5">
        <div class="row">

            <main class="col-md-7 offset-md-1 py-5">
                <div class="row mt-3">

                    <table class="columns">
                        <tr>
                            <td>
                                <div id="piechart_div" style="border: 1px solid #ccc"></div>
                            </td>
                            <td>
                                <div id="barchart_div" style="border: 1px solid #ccc"></div>
                            </td>
                        </tr>
                    </table>
                </div>
            </main>
        </div>
    </div>


    <!-- start of footer-->
    <?php include_once("../php/footer.php") ?>
    <!-- end of footer-->
</body>

</html>