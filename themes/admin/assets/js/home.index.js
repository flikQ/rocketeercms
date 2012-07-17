function drawChart(data) {
	data = JSON.parse(data);
	if(data.length > 0) {
		var chart = [];
		for(var i = 0; i < data.length; i++) {
			chart.push([data[i].date, data[i].value]);
		}
		$.jqplot.config.enablePlugins = true;
		$.jqplot('ga_chart', [chart], {
			axes : {
				yaxis : { min : 0 },
				xaxis : {
					renderer: $.jqplot.DateAxisRenderer
           		}
			},
			series: {lineWidth:4, markerOptions:{style:'square'}}
		});
	}
}
