<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Bukti Transaksi {{ $transaction->invoice_code }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice-code {
            font-size: 18px;
            font-weight: bold;
        }

        .details {
            margin-bottom: 30px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .text-right {
            text-align: right;
        }

        .footer {
            margin-top: 50px;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Bukti Transaksi Laundry</h2>
        <div class="invoice-code">No. Invoice: {{ $transaction->invoice_code }}</div>
    </div>

    <div class="details">
        <p><strong>Outlet:</strong> {{ $transaction->outlet->name }}</p>
        <p><strong>Member:</strong> {{ $transaction->member->nama }}</p>
        <p><strong>Tanggal:</strong> {{ $transaction->tanggal->format('d/m/Y') }}</p>
        <p><strong>Batas Waktu:</strong> {{ $transaction->batas_waktu->format('d/m/Y') }}</p>
        <p><strong>Status:</strong> {{ ucfirst($transaction->status) }}</p>
        <p><strong>Pembayaran:</strong> {{ $transaction->dibayar == 'lunas' ? 'Lunas' : 'Belum Dibayar' }}</p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Paket</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaction->transactionDetails as $detail)
                <tr>
                    <td>{{ $detail->package->nama_paket }}</td>
                    <td class="text-right">Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                    <td>{{ $detail->qty }}</td>
                    <td class="text-right">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Diskon</th>
                <th class="text-right">{{ $transaction->diskon }}%</th>
            </tr>
            <tr>
                <th colspan="3">Total Harga</th>
                <th class="text-right">Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Terima kasih telah menggunakan layanan kami</p>
    </div>
</body>

</html>