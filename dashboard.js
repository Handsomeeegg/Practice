const ctx = document.getElementById('visitsChart');



new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['16.04', '17.04', '18.04', '19.04', '20.04'],
        datasets: [{
            label: 'Посещения',
            data: [12, 19, 15, 22, 30]
        }]
    },
    options: {
        responsive: true
    }
});