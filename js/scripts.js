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

				response.forEach((res, i) => {
					const resPrevDate = response[i - 1]?.date;
					if (resPrevDate !== res.date && resPrevDate !== undefined) {
						labels.push(res.date);
					} else {
						labels.push("");
					}
					execTime.push(Math.round(res.microseconds));
					averageQueries.push(res["queries-num"]);
				});

				new Chart(ctx, {
					type: "line",
					data: {
						labels: labels,
						datasets: [
							{
								label: "Average execution time in μS",
								data: execTime,
								borderWidth: 1,
								yAxisID: "y",
							},
							{
								label: "Queries",
								data: averageQueries,
								borderWidth: 1,
								yAxisID: "y1",
							},
						],
					},
					options: {
						scales: {
							y: {
								beginAtZero: true,
								type: "linear",
								display: true,
								position: "left",
							},
							y1: {
								beginAtZero: true,
								type: "linear",
								display: true,
								position: "right",

								// grid line settings
								grid: {
									drawOnChartArea: false, // only want the grid lines for one axis to show up
								},
							},
							x: {
								// ticks: {
								// 	callback: function (val, index) {
								// 		//return index % 2 === 0 ? this.getLabelForValue(val) : "";
								// 		if (this.getLabelForValue(val) != "") {
								// 			return this.getLabelForValue(val);
								// 		}
								// 	},
								// },
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
