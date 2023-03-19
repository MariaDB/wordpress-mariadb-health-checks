const ctx = document.getElementById("mdbhc-chart");

jQuery(document).ready(function ($) {
	$.ajax({
		type: "post",
		data: { action: "mdbhc_executiontime", nonce: mdbhc.nonce },
		url: mdbhc.ajaxUrl,
		success: function (response) {
			let labels = [];
			let data = [];

			response.forEach((res, i) => {
				const resPrevDate = response[i - 1]?.date;
				if (resPrevDate !== res.date && resPrevDate !== undefined) {
					labels.push(res.date);
				} else {
					labels.push("");
				}
				data.push(res.microseconds);
			});

			new Chart(ctx, {
				type: "line",
				data: {
					labels: labels,
					datasets: [
						{
							label: "Average execution time in μs during the last 7 days",
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
