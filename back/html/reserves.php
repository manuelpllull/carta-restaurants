<!DOCTYPE html>
<html lang="en">
<title>Reserves</title>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/buttons/1.3.1/css/buttons.bootstrap4.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.7/css/select.bootstrap4.min.css" />
    <link rel="stylesheet" href="/css/dist/style.css">
    <!-- js -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.15/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/buttons/1.3.1/js/buttons.bootstrap4.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
    <script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://d3js.org/d3.v4.min.js"></script>


    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="icon" href="/images/icon/icon.png">
    <!-- <script type="text/javascript" src="/js/reserves.js"></script> -->
    <script src="/js/closeSesion.js"></script>


</head>

<?php
include_once 'navBar.php';
?>

<body>
    <h1>Reserves</h1>
    <div class="row">
        <div class="col-md-6">
            <form class="form-inline">
                <div class="form-check mb-2 mr-sm-2">
                    <label for="consulta" class="form-date">Seleciona un dia</label>
                    <input type="date" id='data' class="form-control" name="data">
                </div>
                <div class="col-auto">
                    <button class="btn mb-2" type="button" onclick="loadData();" id="consulta">Consulta</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6" id="taula">
            <table id="reserva" class="table table-striped table-bordered" width="100%">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Hora</th>
                        <th>Pax</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="col-md-6" id="svg"></div>
    </div>
</body>
<script>
var reserves;
var grafic;
var taula;
var id = sessionStorage.getItem('key');

if (id == null) {
    window.location.replace("iniciSesio.php");
}

function loadData() {
    var d = $("#data").val();
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            reserves = JSON.parse(this.responseText);
            taula = $("#reserva").DataTable({
                data: reserves,
                dom: "Bfrtip",
                resposive: true,
                buttons: ["copy", "excel", "pdf"],
                columns: [{
                        data: "nomUsuari",
                    },
                    {
                        data: "hora",
                    },
                    {
                        data: "comensals",
                    },
                ],
                responsive: true,
                order: [
                    [1, "asc"]
                ],
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Catalan.json",
                },
                select: true,
                destroy: true,
            });
        }
    };
    xhttp.open("POST", "https://api.restaurat.me/controller/reserves/reserves.php?data=" + d + "&id=" + id, false);
    xhttp.send();
}


var margin = { top: 30, right: 30, bottom: 70, left: 60 },
            width = 460 - margin.left - margin.right,
            height = 460 - margin.top - margin.bottom;

        var svg = d3.select("#svg")
            .append("svg")
            .attr("width", width + margin.left + margin.right)
            .attr("height", height + margin.top + margin.bottom)
            .append("g")
            .attr("transform",
                "translate(" + margin.left + "," + margin.top + ")");

        d3.json("https://api.restaurat.me/controller/reserves/graficReserves.php?id=" + id, function (data) {
            data.sort(function (b, a) {
                return a.Value - b.Value;
            });

            var x = d3.scaleBand()
                .range([0, width])
                .domain(data.map(function (d) { return d.mes; }))
                .padding(0.2);
            svg.append("g")
                .attr("transform", "translate(0," + height + ")")
                .call(d3.axisBottom(x))
                .selectAll("text")
                .attr("transform", "translate(-10,0)rotate(-45)")
                .style("text-anchor", "end");

            var y = d3.scaleLinear()
                .domain([0, 100])
                .range([height, 0]);
            svg.append("g")
                .call(d3.axisLeft(y));

            svg.selectAll("mybar")
                .data(data)
                .enter()
                .append("rect")
                .attr("x", function (d) { return x(d.mes); })
                .attr("y", function (d) { return y(d.suma); })
                .attr("width", x.bandwidth())
                .attr("height", function (d) { return height - y(d.suma); })
                .attr("fill", "#94bfbe")
        })



</script>

<?php
include_once 'footer.php';
?>

</html>