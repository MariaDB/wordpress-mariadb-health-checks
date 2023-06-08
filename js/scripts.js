jQuery(document).ready(function ($) {
	const ctx = document.getElementById("mdbhc-chart");
	if (ctx) {
		$.ajax({
			type: "post",
			data: { action: "mdbhc_executiontime", nonce: mdbhc.nonce },
			url: mdbhc.ajaxUrl,
			success: function (response) {
				const labels = [];
				const execTime = [];
				const averageQueries = [];
				const queriesPerPage = [];
				const timePerPage = [];
				var greenColor = "#00FF00";
				var orangeColor = "#FFA500";


				response.data.forEach((res, i) => {
					labels.push(res.date * 1000);
					var time_vals = {x: res.date * 1000, y: Math.round(res.microseconds)};
					var query_vals = {x: res.date * 1000, y: res["queries-num"]};
					var query_per_page_vals = {x: res.date * 1000, y: Math.round(res["queries-per-page"])};
					var time_per_page_vals = {x: res.date * 1000, y: Math.round(res['time-per-page'])};
					execTime.push(time_vals);
					averageQueries.push(query_vals);
					queriesPerPage.push(query_per_page_vals);
					timePerPage.push(time_per_page_vals);
				});

				var datasets = [
					{
						label: "Average DB time per page in ms",
						data: timePerPage,
						borderWidth: 1,
						yAxisID: "y",
					},
					{
						label: "Average queries per page",
						data: queriesPerPage,
						borderWidth: 1,
						yAxisID: "y1",
					},
					{
						label: "Average DB time per query in μs",
						data: execTime,
						borderWidth: 1,
						yAxisID: "y",
						hidden: true
					},
					{
						label: "Total hourly queries",
						data: averageQueries,
						borderWidth: 1,
						yAxisID: "y1",
						hidden: true
					},


				];

				var redColor  = "#FF7390";
				var blueColor = "#4DAAED";

				if (response.config.high_contrast) {
					redColor = "#FF0000";
					Chart.defaults.backgroundColor = '#FFFFFF';
					Chart.defaults.borderColor = '#000000';
					Chart.defaults.color = '#000000';
					datasets[0].borderWidth = 3;
					datasets[0].borderColor = blueColor;
					datasets[1].borderWidth = 3;
					datasets[1].borderColor = redColor;
					datasets[2].borderWidth = 3;
					datasets[2].borderColor = greenColor;
					datasets[3].borderWidth = 3;
					datasets[3].borderColor = orangeColor;
				}

				new Chart(ctx, {
					type: "line",
					data: {
						labels: labels,
						datasets: datasets,
					},
					options: {
						scales: {
							y: {
								beginAtZero: true,
								title: {
									display: true,
									text: "DB time",
									color: blueColor,
									font: {
										size: 20,
										style: "normal",
										lineHeight: 2,
									},
								},
								type: "linear",
								display: true,
								position: "left",
							},
							y1: {
								beginAtZero: true,
								title: {
									display: true,
									text: "Query count",
									color: redColor,
									font: {
										size: 20,
										style: "normal",
										lineHeight: 2,
									},
								},
								type: "linear",
								display: true,
								position: "right",

								// grid line settings
								grid: {
									drawOnChartArea: false, // only want the grid lines for one axis to show up
								},
							},
							x: {
								type: 'time',
								time: {
									unit: 'hour',
								},
							},
						},
						responsive: true,
						interaction: {
							mode: "index",
							intersect: false,
						},
						stacked: false,
					},
				});
			},
		});
	}
});
