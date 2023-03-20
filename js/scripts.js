jQuery(document).ready(function ($) {
	const ctx = document.getElementById("mdbhc-chart");
	if (ctx) {
		$.ajax({
			type: "post",
			data: { action: "mdbhc_executiontime", nonce: mdbhc.nonce },
			url: mdbhc.ajaxUrl,
			success: function (response) {
				let labels = [];
				let data = [];

				response.data.forEach((res, i) => {
					const resPrevDate = response[i - 1]?.date;
					if (resPrevDate !== res.date && resPrevDate !== undefined) {
						labels.push(res.date);
					} else {
						labels.push("");
					}
					data.push(res.microseconds);
				});

				dataset = {
					label: "Average execution time in μs during the last 7 days",
					data: data,
					borderWidth: 1,
				}

				if (response.config.high_contrast) {
					Chart.defaults.backgroundColor = '#FFFFFF';
					Chart.defaults.borderColor = '#000000';
					Chart.defaults.color = '#000000';
					dataset.borderWidth = 3;
					dataset.borderColor = '#000000';
				}

				new Chart(ctx, {
					type: "line",
					data: {
						labels: labels,
						datasets: [
							dataset,
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
										if (this.getLabelForValue(val) != '') {
											return this.getLabelForValue(val);
										}
									},
								},
							},
						},
					},
				});
			},
		});
	}
});
