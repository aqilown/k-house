<!DOCTYPE html>
<html lang="en">
    

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K.House Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
<div class="container">

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <img src="https://cdn-icons-png.flaticon.com/512/25/25694.png" width="50">
            <h2>K.HOUSE</h2>
        </div>

        <a class="menu active">
            <span>🏠</span> Dashboard
        </a>
        <a class="menu">
            <span>🛏️</span> Kamar
        </a>
        <a class="menu">
            <span>👤</span> Penghuni
        </a>
    </div>

    <!-- Main content -->
    <div class="content">
        <!-- Stats -->
        <div class="stats">
            <div class="card">
                <h1>5</h1>
                <p>Kamar Tersedia</p>
            </div>

            <div class="card">
                <h1>3</h1>
                <p>Kamar Terisi</p>
            </div>

            <div class="card">
                <h1>2</h1>
                <p>Belum Bayar</p>
            </div>

            <div class="card">
                <h1>3.000.000</h1>
                <p>Pemasukan</p>
            </div>
        </div>

        <!-- Chart -->
        <div class="chart-container">
            <canvas id="myChart"></canvas>
        </div>
    </div>

</div>

<script>
const ctx = document.getElementById('myChart').getContext('2d');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['1','9','11','15','19','22','26','31'],
        datasets: [{
            data: [0,1,1,1,2,2,3,5],
            borderWidth: 3,
            tension: 0.3
        }]
    },
    options: {
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true },
            x: { ticks: { font: { size: 14 } } }
        }
    }
});
</script>

</body>
</html>
