const ctx = document.getElementById('prestasiChart').getContext('2d');
    const prestasiChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['2018', '2019', '2020', '2021', '2022', '2023', '2024'],
        datasets: [
          {
            label: 'Akademik',
            data: [15, 18, 20, 19, 20, 22, 21],
            backgroundColor: 'rgba(74, 58, 255, 1)',
            borderWidth: 1,
            borderRadius: 15
          },
          {
            label: 'Non Akademik',
            data: [10, 12, 14, 15, 14, 16, 15],
            backgroundColor: 'rgba(200, 147, 253, 1)',
            borderWidth: 1,
            borderRadius: 15
          }
        ]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'bottom',
            labels: {
                usePointStyle: true, // Change the style to use points (circle)
                pointStyle: 'circle', // Set point style to circle
                padding: 50,
              }
          },
        },
        scales: {
          y: {
            beginAtZero: true,
            max: 25
          }
        }
      }
    });