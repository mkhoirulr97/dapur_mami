let totalIncomeCtx = document
    .getElementById("totalIncomeChart")
    .getContext("2d");
let totalIncomeChart = new Chart(totalIncomeCtx, {
    // makanan, minuman, lainnya
    type: "doughnut",
    data: {
        labels: ["Makanan", "Minuman", "Snack"],
        datasets: [
            {
                label: "Total Pemesanan",
                data: totalSalesTypeOfMenu,
                backgroundColor: ["#806043", "#19743b", "#3D4451"],
                hoverBackgroundColor: ["#806043", "#19743b", "#3D4451"],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            },
        ],
    },
    options: {
        maintainAspectRatio: false,
        reponsive: true,
        plugins: {
            legend: {
                position: "bottom",
                // custome shape for legend circle
                labels: {
                    usePointStyle: true,
                    pointStyle: "circle",
                    pointRadius: 5,
                    padding: 16,
                },
            },
        },
    },
});
