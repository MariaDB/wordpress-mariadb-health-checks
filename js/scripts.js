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
// const data = new FormData();
// data.append('action', 'mdbhc_executiontime');
// console.log(data.action);
// document.addEventListener(
//   'click',
//   async (e) => {
//     if (e.target.matches('.clickme')) {
//       const response = await fetch(mdbhc.ajaxUrl, {
//         method: 'POST',
//         headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
//         body: data,
//       });
//       const result = await response.text();
//       console.log(result);
//     }
//   },
//   false
// );

jQuery(document).ready(function ($) {
  $.ajax({
    type: 'post',
    data: { action: 'mdbhc_executiontime', nonce: mdbhc.nonce },
    url: mdbhc.ajaxUrl,
    success: function (response) {
      console.log(response);
    },
  });
});
