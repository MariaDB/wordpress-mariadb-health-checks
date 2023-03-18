const ctx = document.getElementById('mdbhc-chart');

new Chart(ctx, {
  type: 'line',
  data: {
    labels: ['Monday', 'Thuseday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
    datasets: [
      {
        label: 'Requests per day',
        data: [12, 19, 3, 5, 2, 3, 1],
        borderWidth: 1,
      },
    ],
  },
  options: {
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
});

(function ($) {
  $(function () {
    $('#tabs').tabs();
  });
})(jQuery);
