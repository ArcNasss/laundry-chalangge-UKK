<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi {{ $start_date ? 'dari ' . $start_date : '' }} {{ $end_date ? 'sampai ' . $end_date : '' }}
    </title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .report-title {
            font-size: 18px;
            font-weight: bold;
        }

        .period {
            margin-bottom: 10px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
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

        .text-center {
            text-align: center;
        }

        .footer {
            margin-top: 50px;
            text-align: right;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Laporan Transaksi Laundry</h2>
        <div class="report-title">Rekapitulasi Transaksi</div>
        @if($start_date || $end_date)
            <div class="period">
                Periode: {{ $start_date ? $start_date : 'Awal' }} - {{ $end_date ? $end_date : 'Sekarang' }}
            </div>
        @endif
    </div>

    @foreach($transactions as $transaction)
        <div class="transaction">
            <h3>No. Invoice: {{ $transaction->invoice_code }}</h3>
            <p><strong>Outlet:</strong> {{ $transaction->outlet->name }}</p>
            <p><strong>Member:</strong> {{ $transaction->member->nama }}</p>
            <p><strong>Tanggal:</strong> {{ $transaction->tanggal->format('d/m/Y') }}</p>
            <p><strong>Status:</strong> {{ ucfirst($transaction->status) }} |
                <strong>Pembayaran:</strong> {{ $transaction->dibayar == 'lunas' ? 'Lunas' : 'Belum Dibayar' }}
            </p>

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
                            <td class="text-center">{{ $detail->qty }}</td>
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
        </div>

        @if(!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach

    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d/m/Y H:i') }}</p>
    </div>
</body>

</html>