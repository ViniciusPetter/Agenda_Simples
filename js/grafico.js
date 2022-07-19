google.charts.load('current', { 'packages': ['corechart'] });
google.charts.setOnLoadCallback(drawChart);
drawChart(1,1,1);
function drawChart(val1,val2,val3) {

    var data = google.visualization.arrayToDataTable([
        ['Situação', 'Quantidade'],
        ['Abertas', 1],
        ['Finalizadas', 1],
        ['Canceladas', 1]
    ]);

    var options = {
        title: 'Atividades agendadas'
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

    chart.draw(data, options);
}