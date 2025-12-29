<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pesanan Top Up</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #00f5ff, #39ff14);
            color: #000;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }
        .content {
            color: #333;
            line-height: 1.6;
        }
        .info-box {
            background-color: #f9f9f9;
            padding: 20px;
            border-left: 4px solid #00f5ff;
            margin: 20px 0;
            border-radius: 4px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #e0e0e0;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .label {
            font-weight: bold;
            color: #555;
        }
        .value {
            color: #333;
            text-align: right;
        }
        .total {
            background-color: #f0f0f0;
            padding: 15px;
            border-radius: 4px;
            margin: 20px 0;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            color: #00f5ff;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
            text-align: center;
            color: #999;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎮 Pay to Win - Pesanan Diterima</h1>
        </div>

        <div class="content">
            <p>Halo {{ $transaction->user->name }},</p>
            
            <p>Terima kasih telah melakukan pemesanan top up game di Pay to Win! Pesanan Anda telah kami terima dan sedang diproses.</p>

            <div class="info-box">
                <div class="info-row">
                    <span class="label">Nomor Pesanan:</span>
                    <span class="value">{{ $transaction->transaction_code }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Game:</span>
                    <span class="value">{{ $transaction->gamePackage->game_name }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Paket:</span>
                    <span class="value">{{ $transaction->gamePackage->package_name }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Jumlah:</span>
                    <span class="value">{{ $transaction->gamePackage->amount }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Status:</span>
                    <span class="value"><strong>{{ ucfirst($transaction->status) }}</strong></span>
                </div>
            </div>

            <div class="total">
                Harga: Rp {{ number_format($transaction->amount, 0, ',', '.') }}
            </div>

            <p>Pesanan Anda akan diproses dalam waktu kurang lebih 5-15 menit. Pastikan data akun game Anda sudah benar.</p>

            <p>Jika ada pertanyaan atau memerlukan bantuan, jangan ragu untuk menghubungi kami.</p>

            <p>Terima kasih telah mempercayai Pay to Win!</p>

            <p>Salam,<br>
            <strong>Tim Pay to Win</strong></p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Pay to Win - Game Top Up Services. All rights reserved.</p>
            <p>Email ini dikirim ke {{ $transaction->user->email }} karena Anda memiliki akun di platform kami.</p>
        </div>
    </div>
</body>
</html>
