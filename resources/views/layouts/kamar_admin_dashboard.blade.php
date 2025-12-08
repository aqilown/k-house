<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K.House | Manajemen Kamar</title>

    <link rel="stylesheet" href="{{ asset('css/kamar_dashboard.css') }}">
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

        <a href="/admin/kamar" class="menu active">
            <span>🛏️</span> Kamar
        </a>

        <a href="/admin/penghuni" class="menu">
            <span>👤</span> Penghuni
        </a>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="header">
            <h2>Manajemen Kamar</h2>
            <div class="profile-icon">👤</div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Kamar</th>
                    <th>Tipe</th>
                    <th>Harga</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>01</td>
                    <td>1</td>
                    <td>1.000.000</td>
                    <td>Tersedia</td>
                </tr>

                <tr>
                    <td>02</td>
                    <td>2</td>
                    <td>1.200.000</td>
                    <td>Terisi</td>
                </tr>

                <tr>
                    <td>03</td>
                    <td>2</td>
                    <td>1.200.000</td>
                    <td>Tersedia</td>
                </tr>

                <tr>
                    <td>04</td>
                    <td>1</td>
                    <td>1.000.000</td>
                    <td>Terisi</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>
