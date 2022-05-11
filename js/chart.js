$(document).ready(function () {
    getDataTotalIncome();
});

// function

function showChart(data, labels) {
    const colorBackground = ['rgba(213, 122, 176, 0.2)', 'rgba(87, 167, 116, 0.2)', 'rgba(213, 122, 176, 0.2)', 'rgba(87, 167, 116, 0.2)', 'rgba(213, 122, 176, 0.2)', 'rgba(87, 167, 116, 0.2)' ];
    const colorBorder = ['rgba(213, 122, 176, 1)', 'rgba(87, 167, 116, 1)', 'rgba(213, 122, 176, 1)', 'rgba(87, 167, 116, 1)', 'rgba(213, 122, 176, 1)', 'rgba(87, 167, 116, 1)'];

    const ctx = document.getElementById('myChart');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Revenue par mois',
                data: data,
                backgroundColor: colorBackground,
                borderColor: [
                    'rgba(213, 122, 176, 1)',
                    'rgba(87, 167, 116, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

function getDataTotalIncome() {

    let average_price = [];
    let months = [];

    const req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState === 4) {
            const result = req.responseText;

            //reload the window
            //window.location.reload();
            // searchMembres();
            console.log(result);

            //parse the result
            const data = JSON.parse(result);

            for (let i in data) {
                average_price.push(data[i].average.toFixed(2));
                months.push(data[i].month);
            }

            console.log(average_price);
            console.log(months);

            showChart(average_price, months);
        }
    };

    req.open("GET", "ajax.php?totalIncome");
    req.send();
}


