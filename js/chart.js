$(document).ready(function () {
    getDataTotalIncome();
    getDataRatioScooters();
    getDataTotalVisitor();
    getDataDevice();
});

// function

function showChartIncome(data, labels) {
    const colorBackground = ['rgba(213, 122, 176, 0.2)', 'rgba(87, 167, 116, 0.2)', 'rgba(213, 122, 176, 0.2)', 'rgba(87, 167, 116, 0.2)', 'rgba(213, 122, 176, 0.2)', 'rgba(87, 167, 116, 0.2)' ];
    const colorBorder = ['rgba(213, 122, 176, 1)', 'rgba(87, 167, 116, 1)', 'rgba(213, 122, 176, 1)', 'rgba(87, 167, 116, 1)', 'rgba(213, 122, 176, 1)', 'rgba(87, 167, 116, 1)'];

    const ctx = document.getElementById('incomeChart');
    const myChart = new Chart(ctx, {

        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Revenue du mois',
                data: data,
                backgroundColor: colorBackground,
                borderColor: colorBorder,
                borderWidth: 1,
                barPercentage: 0.3,
                borderRadius: 5
            }]
        },
        options: {
            scales: {
                xAxes: [{
                    gridLines: {
                        display:false
                    }
                }],
                yAxes: [{
                    gridLines: {
                        display:true

                    },
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            legend: {
                display: false

            }
        },
    });
}

function convertNumberToMonth(number) {
    switch (number) {
        case 1:
            return 'Jan';
        case 2:
            return 'Fév';
        case 3:
            return 'Mar';
        case 4:
            return 'Avr';
        case 5:
            return 'Mai';
        case 6:
            return 'Jui';
        case 7:
            return 'Juil';
        case 8:
            return 'Août';
        case 9:
            return 'Sep';
        case 10:
            return 'Oct';
        case 11:
            return 'Nov';
        case 12:
            return 'Déc';
        default:
            return 'Erreur';
    }
}

function getDataTotalIncome() {

    let average_price = [];
    let months = [];

    const req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState === 4) {
            const result = req.responseText;

            //parse the result
            const data = JSON.parse(result);

            for (let i in data) {
                average_price.push(data[i].average.toFixed(2));
                months.push(convertNumberToMonth(data[i].month));
            }

            showChartIncome(average_price, months);
        }
    };

    req.open("GET", "ajax.php?totalIncome");
    req.send();
}

function showChartScooter(data) {

    const ctx = document.getElementById('RatioScooter');
    const myChart = new Chart(ctx, {

        type: 'bar',
        data: {
            labels: ['En service', 'Hors Service'],
            datasets: [{
                label: ['En service ', 'Hors Service'],
                data: data,
                backgroundColor: [
                    'rgba(87, 167, 116, 0.2)',
                    'rgba(213, 122, 176, 0.2)'
                ],
                borderColor: [
                    'rgba(87, 167, 116, 1)',
                    'rgba(213, 122, 176, 1)'
                ],
                borderWidth: 1,
                barPercentage: 0.3,


            }]
        },
        options: {
            scales: {
                xAxes: [{
                    gridLines: {
                        display:false
                    }
                }],
                yAxes: [{
                    gridLines: {
                        display:true

                    },
                    ticks: {
                        beginAtZero: true,
                        stepSize: 1,
                    }
                }]

            },
            legend: {
                display: false

            }
        },
    });
}

function getDataRatioScooters() {

    let scooterUp = null;
    let scooterDown = null;


    const req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState === 4) {
            const result = req.responseText;


            //parse the result
            let data = JSON.parse(result);

            scooterDown = data[0].hs;
            scooterUp = data[1].up;

            data = [scooterUp, scooterDown];


            showChartScooter(data);
        }
    };

    req.open("GET", "ajax.php?ratioScooter");
    req.send();
}

function showChartClient(data, labels) {

    const ctx = document.getElementById('totalVisitor');
    const myChart = new Chart(ctx, {

        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Nombre de vidieurs',
                data: data,
                backgroundColor: 'rgba(213, 122, 176, 0.2)',
                borderColor: 'rgba(213, 122, 176, 1)',
                borderWidth: 1,
                barPercentage: 0.3,
                borderRadius: 5
            }]
        },
        options: {
            scales: {
                xAxes: [{
                    gridLines: {
                        display:false
                    }
                }],
                yAxes: [{
                    gridLines: {
                        display:true

                    },
                    ticks: {
                        beginAtZero: true,
                        stepSize: 1,
                    }
                }],
            },
            legend: {
                display: false

            }
        },
    });
}

function getDataTotalVisitor() {

    let nbr_visitor = [];
    let months = [];

    const req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState === 4) {
            const result = req.responseText;

            //parse the result
            const data = JSON.parse(result);

            for (let i in data) {
                nbr_visitor.push(data[i].nbr);
                months.push(convertNumberToMonth(data[i].month));
            }

            showChartClient(nbr_visitor, months);
        }
    };

    req.open("GET", "ajax.php?totalVisitor");
    req.send();
}

function showChartDevice(data, labels) {
    const colorBackground = ['rgba(213, 122, 176, 0.2)', 'rgba(87, 167, 116, 0.2)', 'rgba(213, 122, 176, 0.2)', 'rgba(87, 167, 116, 0.2)', 'rgba(213, 122, 176, 0.2)', 'rgba(87, 167, 116, 0.2)' ];
    const colorBorder = ['rgba(213, 122, 176, 1)', 'rgba(87, 167, 116, 1)', 'rgba(213, 122, 176, 1)', 'rgba(87, 167, 116, 1)', 'rgba(213, 122, 176, 1)', 'rgba(87, 167, 116, 1)'];

    const ctx = document.getElementById('deviceChart');
    const myChart = new Chart(ctx, {

        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                label: ['appareil utilisé'],
                data: data,
                backgroundColor: [
                    'rgb(30,144,255)',
                    'rgb(186,85,211)',
                    'rgb(255, 205, 86)',
                    'rgb(50,205,50)',
                    'rgb(255,140,0)'
                ],
                hoverOffset: 4


            }]
        },

    });
}

function getDataDevice() {

    let label = ["Windows", "Mac", "Linux", "Android", "Ios"];

    const req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState === 4) {
            const result = req.responseText;

            //parse the result
            const data = JSON.parse(result);

            showChartDevice(data, label);
        }
    };

    req.open("GET", "ajax.php?ratioDevice");
    req.send();
}


