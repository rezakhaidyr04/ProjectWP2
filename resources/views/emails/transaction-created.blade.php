@component('mail::message')
# Pesanan Top Up Game Dibuat

Halo {{ $transaction->user->name }},

Pesanan top up game Anda telah berhasil dibuat. Silakan selesaikan pembayaran untuk melanjutkan.

@component('mail::panel')
**Kode Transaksi:** {{ $transaction->transaction_code }}
**Game:** {{ $transaction->gamePackage->game_name }}
**Paket:** {{ $transaction->gamePackage->package_name }}
**Total Pembayaran:** Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
**ID Game:** {{ $transaction->game_account }}
@endcomponent

@component('mail::button', ['url' => route('topup.receipt', $transaction->id)])
Lanjutkan Pembayaran
@endcomponent

Jika Anda memiliki pertanyaan, silakan hubungi tim support kami.

Terima kasih,
**Kelompok 2 Team**
@endcomponent
