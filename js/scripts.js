const ctx = document.getElementById("mdbhc-chart");

jQuery(document).ready(function ($) {
	$.ajax({
		type: "post",
		data: { action: "mdbhc_executiontime", nonce: mdbhc.nonce },
		url: mdbhc.ajaxUrl,
		success: function (response) {
			let labels = [];
			let data = [];
			response.forEach((res) => {
				data.push(res["avg(seconds)"]);
				labels.push(res["Hours Ago"]);
			});
			// console.log([data, labels]);
			// labels = ["Today"];
			// data = [];

			new Chart(ctx, {
				type: "line",
				data: {
					labels: labels,
					datasets: [
						{
							label: "Execution time in Seconds for the last xx hours",
							data: data,
							borderWidth: 1,
						},
					],
				},
				options: {
					scales: {
						y: {
							beginAtZero: true,
						},
						x: {
							ticks: {
								callback: function (val, index) {
									//return index % 2 === 0 ? this.getLabelForValue(val) : "";
									return this.getLabelForValue(val);
								},
							},
						},
					},
				},
			});
		},
	});
});
