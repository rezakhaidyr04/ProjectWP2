@component('mail::message')
# Pembayaran Berhasil ✓

Halo {{ $transaction->user->name }},

Pembayaran Anda telah berhasil kami terima. Top up game Anda sedang diproses dan akan segera masuk ke akun game Anda.

@component('mail::panel')
**Kode Transaksi:** {{ $transaction->transaction_code }}
**Game:** {{ $transaction->gamePackage->game_name }}
**Paket:** {{ $transaction->gamePackage->package_name }}
**Total Pembayaran:** Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
**Status:** Berhasil Dikonfirmasi
@endcomponent

**Estimasi Waktu:** Biasanya top up akan masuk dalam 1-15 menit. Jika lebih dari 30 menit belum masuk, silakan hubungi support kami.

@component('mail::button', ['url' => route('topup.myTransactions')])
Lihat Riwayat Transaksi
@endcomponent

Terima kasih telah menggunakan GameCredit!

Salam,
**GameCredit Team**
@endcomponent
