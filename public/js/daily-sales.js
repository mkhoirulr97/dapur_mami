let dailySalesCtx = document.getElementById("dailySalesChart").getContext("2d");
let dailySalesChart = new Chart(dailySalesCtx, {
    type: "line",
    data: {
        labels: ["17:00", "18:00", "19:00", "20:00", "21:00"],
        datasets: [
            {
                label: "Penjualan Harian",
                data: totalSalesHourly,
                backgroundColor: "rgba(25, 116, 59, 0.1)",
                borderColor: "#19743b",
                borderWidth: 1.5,
                fill: "start",
            },
        ],
    },
    options: {
        maintainAspectRatio: false,
        reponsive: true,
        scales: {
            y: {
                grid: {
                    display: false,
                },
                ticks: {
                    beginAtZero: true,
                    stepSize: 1,
                },
            },
        },
        elements: {
            line: {
                tension: 0.4,
            },
        },
    },
});
