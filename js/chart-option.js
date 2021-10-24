import confChat from './config-chart.js';
let actionElm = document.querySelectorAll(".card .dropdown-item")
let chartCtx

actionElm.forEach(elm => {
    elm.addEventListener("click", function(e) {
        getDataChart(elm.classList[1])
    })
})

function getNumberOfWeek() {
    const today = new Date();
    const firstDayOfYear = new Date(today.getFullYear(), 0, 1);
    const pastDaysOfYear = (today.valueOf() - firstDayOfYear.valueOf()) / 86400000;
    return Math.ceil((pastDaysOfYear + firstDayOfYear.getDay() + 1) / 7 / 12);
}

function getDataChart(path) {
    fetch(`utils/get-data-chart-${path.toLowerCase()}.php`)
        .then(response => response.json())
        .then(data => updateChart(data))

    let today = new Date()
    let date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()
    if (path == "Minggu") {
        document.querySelector('h6.chart-header').innerText = `Grafik Omset ${path} Ke-${getNumberOfWeek()} (${date})`
    } else {
        document.querySelector('h6.chart-header').innerText = `Grafik Omset ${path} (${date})`
    }
}

function updateChart(data) {
    let dataChart = {
        'label': [],
        'dataset': [],
    }
    for (let key in data) {
        dataChart['label'].push(key)
        dataChart['dataset'].push(data[key])
    }
    
    if (chartCtx !== undefined) {
        chartCtx.destroy()
    }
    chartCtx = confChat(dataChart)
}


getDataChart('Tahun')