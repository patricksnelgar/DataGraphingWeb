<!DOCTYPE html>
<html>
    <header>
        <script type="text/javascript" src="js/Chart.bundle.js"></script>
    </header>
    <body>
        <div>
            <p>Graphing test for weather stations</p>
            <div id="file_contents"></div>
        </div>
        <div style="width: 800px; height:600px;">
            <canvas id="line_graph"></canvas>
        </div>
    </body>
    <script>  
        var header = [];
        var temp_data = [];
        var dates = [];
        function _rListener() {
            //console.log(this.responseText);
            header = this.responseText.split("\n")[1].split(",");
            //console.log("Header:" + header);
            var rows = this.responseText.split("\n");
            for(i = 0; i < rows.length -1; i++){
               if(! (i<2)) {
                    var split = rows[i].split(",");
                    temp_data.push(split[3]);
                    dates.push(split[0]);
               }
            }
            console.log("Dates: " + dates.length)
            console.log("Data: " + temp_data.length);

            makeGraph(dates, temp_data);
        } 

        var _r = new XMLHttpRequest();
        _r.addEventListener("load", _rListener);
        _r.open("GET", "test.dat");
        _r.send();

        function makeGraph(l,d){
            var canvas = document.getElementById("line_graph").getContext("2d");
            var graph = new Chart(canvas, {
                type: 'line',
                data : {
                    labels: l,
                    datasets: [{
                        label: 'Temp over time',
                        data: d,
                        borderWidth: 1,
                        fill: false,
                        lineTension: 0
                    }]
                },               
                options: {                    
                    scales :{
                        yAxes: [{
                            display: true,
                            ticks :{
                                beginAtZero:true
                            }
                        }],
                        xAxes: [{
                            display: true,
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }       
    </script>
</html>