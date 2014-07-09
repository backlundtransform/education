
google.load("visualization", "1", {packages: ["corechart"]});



function drawVisualization(data) {

var data=google.visualization.arrayToDataTable(data);
    new google.visualization.BarChart(document.getElementById('visualization')).
    draw(data, {
        title: "Resultat",
        
        hAxis: {
            title: "Frågor"
        }
        
    });
}