<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/payment.css') }}">
</head>
<body>
    <div class="container">
        <div class="payment-wrapper">
            <div class="payment-form">
                <div class="logo">
                    <h1>{{ config('app.name') }}</h1>
                </div>

                <div class="form-header">
                    <div class="icon-circle">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3v-8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <h2>Pembayaran</h2>
                </div>

                <p class="subtitle">Mohon masukkan semua informasi secara lengkap agar pembayaran dapat diproses.</p>

                <form action="{{ route('payment.process') }}" method="POST" id="paymentForm">
                    @csrf
                    
                    <!-- Banner Nama -->
                    <div class="form-group">
                        <label for="name">
                            Nama Lengkap 
                            <span class="info-icon" title="Masukkan Nama Lengkap, pastikan nama sesuai dan lengkap">ⓘ</span>
                        </label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            value="{{ old('name', $user->name ?? '') }}"
                            required
                        >
                        @error('name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Nomor Kartu -->
                    <div class="form-group">
                        <label for="card_number">
                            Nomor Kartu 
                            <span class="info-icon" title="Masukkan 16 digit yang terdapat pada kartu">ⓘ</span>
                        </label>
                        <input 
                            type="text" 
                            id="card_number" 
                            name="card_number" 
                            placeholder="1234 - - - - - - - - - - - -"
                            maxlength="19"
                            required
                        >
                        @error('card_number')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <!-- CCV -->
                        <div class="form-group">
                            <label for="cvv">
                                CCV 
                                <span class="info-icon" title="Masukkan kode keamanan anda">ⓘ</span>
                            </label>
                            <input 
                                type="text" 
                                id="cvv" 
                                name="cvv" 
                                placeholder="- - -"
                                maxlength="3"
                                required
                            >
                            @error('cvv')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Tanggal kadaluwarsa -->
                        <div class="form-group">
                            <label for="expiry">
                                Tanggal kadaluwarsa
                                <span class="info-icon" title="Masukkan tanggal kadaluwarsa">ⓘ</span>
                            </label>
                            <input 
                                type="text" 
                                id="expiry" 
                                name="expiry" 
                                placeholder="MM / YY"
                                maxlength="7"
                                required
                            >
                            @error('expiry')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">Konfirmasi Pembayaran</button>
                </form>
            </div>

            <!-- Payment Summary -->
            <div class="payment-summary">
                <div class="summary-card">
                    <h3>Ringkasan Pembayaran</h3>
                    
                    <!-- Info Kost & Kamar -->
                    @if(isset($bookingData))
                    <div class="summary-item" style="border-bottom: 1px solid #e9ecef; padding-bottom: 15px; margin-bottom: 15px;">
                        <div style="width: 100%;">
                            <div style="font-weight: 600; color: #2d4538; margin-bottom: 5px;">{{ $bookingData['kost_nama'] }}</div>
                            <div style="font-size: 14px; color: #666;">{{ $bookingData['kamar_tipe'] }}</div>
                            @if($bookingData['kamar_ukuran'])
                            <div style="font-size: 13px; color: #999; margin-top: 3px;">
                                <i class="fas fa-ruler-combined"></i> {{ $bookingData['kamar_ukuran'] }}
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                    
                    <div class="summary-item">
                        <span>Nomor pesanan</span>
                        <span class="value">{{ $order->order_number ?? rand(10000000, 99999999) }}</span>
                    </div>
                    
                    <div class="summary-item">
                        <span>PPN</span>
                        <span class="value">{{ $ppn ?? 12 }}%</span>
                    </div>
                    
                    <div class="summary-item">
                        <span>Jumlah Pembayaran</span>
                        <span class="value">Rp {{ number_format($jumlahPembayaran ?? 0, 0, ',', '.') }}</span>
                    </div>
                    
                    <div class="summary-item">
                        <span>Total Harga</span>
                        <span class="value">Rp {{ number_format($jumlahPesanan ?? 0, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="total-card">
                    <div class="total-amount">
                        <span>Total Pembayaran</span>
                        <h2>Rp. {{ number_format($totalPembayaran ?? 0, 0, ',', '.') }}</h2>
                    </div>
                    <div class="invoice-icon">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none">
                            <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/payment.js') }}"></script>
</body>
</html>