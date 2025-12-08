<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K.House | Manajemen Penghuni</title>

    <link rel="stylesheet" href="{{ asset('css/penghuni_dashboard.css') }}">
</head>

<body>

<div class="container">

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <img src="https://cdn-icons-png.flaticon.com/512/25/25694.png" width="50">
            <h2>K.HOUSE</h2>
        </div>

        <a href="/admin/dashboard" class="menu">
            <span>🏠</span> Dashboard
        </a>

        <a href="/admin/kamar" class="menu">
            <span>🛏️</span> Kamar
        </a>

        <a href="/admin/penghuni" class="menu active">
            <span>👤</span> Penghuni
        </a>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="header">
            <h2>Manajemen Penghuni</h2>
            <div class="profile-icon">👤</div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Kamar</th>
                    <th>Check-in</th>
                    <th>Durasi</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>Abdul</td>
                    <td>01</td>
                    <td>11-01-2025</td>
                    <td>3 Bulan</td>
                </tr>

                <tr>
                    <td>Bani</td>
                    <td>02</td>
                    <td>25-05-2025</td>
                    <td>1 Bulan</td>
                </tr>

                <tr>
                    <td>Chico</td>
                    <td>03</td>
                    <td>30-08-2024</td>
                    <td>6 Bulan</td>
                </tr>

                <tr>
                    <td>Dendi</td>
                    <td>04</td>
                    <td>07-11-2023</td>
                    <td>3 Bulan</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>
