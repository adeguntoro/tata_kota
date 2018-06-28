<html>
    <head>
    </head>
    <body>
        <div class="chart-container">
            <canvas id="mycanvas"></canvas>
        </div>
        <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="js/Chart.js"></script>
        <script>
            $(document).ready(function(){
                $.ajax({
                    url     : "baca_chart.php",
                    type    : "GET",
                    success : function(data){
                        console.log(data);
                    },
                    error : function(data) { }
                });
            });
        </script>
    </body>
</html>
