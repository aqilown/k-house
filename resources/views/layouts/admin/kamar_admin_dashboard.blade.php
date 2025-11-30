@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/kamar_dashboard.css') }}">
@endsection

@section('content')
<div class="content">

    <h2 class="title">Manajemen Kamar</h2>

    <table class="room-table">
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
@endsection
