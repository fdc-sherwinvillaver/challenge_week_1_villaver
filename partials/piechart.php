<script>
    $(function() {
        var data = {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [{
                label: "My First dataset",
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(0,0,0,.15)",
                data: [65, 59, 80, 81, 56, 55, 40],
                backgroundColor: "#4CAF50"
            }, {
                label: "My Second dataset",
                fillColor: "rgba(255,255,255,.25)",
                strokeColor: "rgba(255,255,255,.75)",
                pointColor: "#fff",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(0,0,0,.15)",
                data: [28, 48, 40, 19, 86, 27, 90]
            }]
        };


        var dataPie = [{
            value: 400,
            color: "#4caf50",
            highlight: "#66bb6a",
            label: "Cashflow"
        }, {
            value: 25,
            color: "#03a9f4",
            highlight: "#29b6f6",
            label: "Sales of Enrollment"
        }, {
            value: 25,
            color: "#d32f2f",
            highlight: "#e53935",
            label: "Sales of Reservation"
        }]

        var option = {
            responsive: true,
            // set font color
            scaleFontColor: "#fff",
            // font family
            defaultFontFamily: "'Roboto', sans-serif",
            // background grid lines color
            scaleGridLineColor: "rgba(255,255,255,.1)",
            // hide vertical lines
            scaleShowVerticalLines: false,
        };

        // // Get the context of the canvas element we want to select
        // var ctx = document.getElementById("sales").getContext('2d');
        // var myLineChart = new Chart(ctx).Line(data, option); //'Line' defines type of the chart.

        // // Get the context of the canvas element we want to select
        // var ctx = document.getElementById("conversion").getContext('2d');
        // var myRadarChart = new Chart(ctx).Radar(data, option);

        // Get the context of the canvas element we want to select
        var ctx = document.getElementById("traffic").getContext('2d');
        var myBarChart = new Chart(ctx).Bar(data, option);

        // Get the context of the canvas element we want to select
        var ctx = document.getElementById("seo").getContext('2d');
        var myPieChart = new Chart(ctx).Pie(dataPie, option);

    });
</script>

<script>
    $(function() {
        $('.min-chart#chart-sales').easyPieChart({
            barColor: "#4caf50",
            onStep: function(from, to, percent) {
                $(this.el).find('.percent').text(Math.round(percent));
            }
        });
    });
</script>