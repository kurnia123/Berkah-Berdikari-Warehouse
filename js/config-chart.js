function confChat(data) {
    let ctx = document.querySelector("#myChart")
    let chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: data['label'],
            datasets:
                [
                    {
                        fill: true,
                        data: data['dataset'],
                        backgroundColor: "rgba(78, 115, 223, 0.05)",
                        borderColor: "rgba(78, 115, 223, 1)"
                    }]
        },
        options: {
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            title: {},
            scales: {
                xAxes:
                    [
                        {
                            gridLines: {
                                color: "rgb(234, 236, 244)",
                                zeroLineColor: "rgb(234, 236, 244)",
                                drawBorder: false,
                                drawTicks: false,
                                borderDash:
                                    [
                                        2
                                    ],
                                zeroLineBorderDash: [2],
                                drawOnChartArea: false
                            },
                            ticks: {
                                fontColor: '#858796',
                                padding: 20
                            }
                        }
                    ],
                yAxes:
                    [
                        {
                            gridLines: {
                                color: "rgb(234, 236, 244)",
                                zeroLineColor: "rgb(234, 236, 244)",
                                drawBorder: false,
                                drawTicks: false,
                                borderDash: [2],
                                zeroLineBorderDash: [2]
                            },
                            ticks: {
                                fontColor: '#858796',
                                padding: 20
                            }
                        }
                    ]
            }
        }
    })

    return chart
}

export default confChat