<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Bukti Transaksi #{{ $transaction->invoice_code }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            width: 100px;
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
            text-align: center;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Bukti Transaksi Laundry</h2>
        <h3>{{FreshClean Laundry}}</h3>

    </div>

    <table class="table">
        <tr>
            <th>Invoice</th>
            <td colspan="3">{{ $transaction->invoice_code }}</td>
        </tr>
        <tr>
            <th>Tanggal</th>
            <td>{{ date('d/m/Y', strtotime($transaction->tanggal)) }}</td>
            <th>Batas Waktu</th>
            <td>{{ date('d/m/Y', strtotime($transaction->batas_waktu)) }}</td>
        </tr>
        <tr>
            <th>Outlet</th>
            <td>{{ $transaction->outlet->name }}</td>
            <th>Member</th>
            <td>{{ $transaction->member?->nama ?? '-' }}</td>

        </tr>
    </table>

    <h4 style="margin-top: 20px;">Detail Pesanan:</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Paket</th>
                <th>Jenis</th>
                <th>Quantity</th>
                <th>Harga</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaction->transactionDetails as $detail)
                <tr>
                    <td>{{ $detail->package->nama_paket }}</td>
                    <td>{{ $detail->package->jenis }}</td>
                    <td>{{ $detail->qty }}</td>
                    <td>Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4">Total</th>
                <td>Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th colspan="4">Status Pembayaran</th>
                <td>{{ ucfirst($transaction->dibayar) }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Terima kasih telah menggunakan layanan kami</p>
        <p>Hubungi kami di: 0812-3456-7890</p>
        <p>barang yang tidak diambil lebih dari 26 hari bukan tanggung jawab kami</p>
    </div>
</body>

</html>
