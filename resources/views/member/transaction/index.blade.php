<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi - Laundry</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0
        }

        /* Glassmorphism Effect */
        .glass {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
        }

        /* Animated Bubbles */
        .bubbles {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: -1;
            overflow: hidden;
        }

        .bubble {
            position: absolute;
            bottom: -100px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            animation: rise 15s infinite ease-in;
        }

        /* Larger bubble sizes */
        .bubble:nth-child(1) {
            width: 120px;
            height: 120px;
            left: 10%;
            animation-duration: 12s;
        }

        .bubble:nth-child(2) {
            width: 80px;
            height: 80px;
            left: 20%;
            animation-duration: 8s;
            animation-delay: 1s;
        }

        .bubble:nth-child(3) {
            width: 150px;
            height: 150px;
            left: 35%;
            animation-duration: 10s;
            animation-delay: 2s;
        }

        .bubble:nth-child(4) {
            width: 200px;
            height: 200px;
            left: 50%;
            animation-duration: 15s;
            animation-delay: 0s;
        }

        .bubble:nth-child(5) {
            width: 100px;
            height: 100px;
            left: 55%;
            animation-duration: 9s;
            animation-delay: 1s;
        }

        .bubble:nth-child(6) {
            width: 130px;
            height: 130px;
            left: 65%;
            animation-duration: 11s;
            animation-delay: 3s;
        }

        .bubble:nth-child(7) {
            width: 90px;
            height: 90px;
            left: 75%;
            animation-duration: 10s;
            animation-delay: 2s;
        }

        .bubble:nth-child(8) {
            width: 180px;
            height: 180px;
            left: 80%;
            animation-duration: 9s;
            animation-delay: 1s;
        }

        @keyframes rise {
            0% {
                bottom: -100px;
                transform: translateX(0);
            }

            50% {
                transform: translateX(100px);
            }

            100% {
                bottom: 1080px;
                transform: translateX(-200px);
            }
        }

        /* Hover Effects */
        .hover-scale {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-scale:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .btn-glow:hover {
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.6);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-100 to-blue-200 min-h-screen overflow-y-hidden relative overflow-x-hidden">
    <!-- Animated Bubbles -->
    <div class="bubbles">
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <h1 class="text-3xl font-bold text-gray-800 bg-white/30 glass px-6 py-3 hover-scale">
                <i class="fas fa-receipt mr-2 text-blue-600"></i> Daftar Transaksi Laundry
            </h1>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg  transition-all duration-300 flex items-center">
                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                </button>
            </form>
        </div>

        <!-- Filter Section -->
        {{-- <div class="glass p-6 mb-8 hover-scale">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="w-full md:w-1/3">
                    <div class="relative">
                        <input type="text" placeholder="Cari invoice..."
                            class="w-full px-4 py-3 bg-white/50 border border-white/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-600">
                        <i class="fas fa-search absolute right-3 top-3.5 text-gray-400"></i>
                    </div>
                </div>
                <div class="flex flex-wrap gap-2">
                    <select
                        class="bg-white/50 border border-white/30 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option>Semua Status</option>
                        <option>Baru</option>
                        <option>Proses</option>
                        <option>Selesai</option>
                    </select>
                    <select
                        class="bg-white/50 border border-white/30 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option>Semua Pembayaran</option>
                        <option>Lunas</option>
                        <option>Belum Dibayar</option>
                    </select>
                    <button
                        class="bg-blue-600 text-white px-5 py-2.5 rounded-lg hover:bg-blue-700 btn-glow transition-all duration-300 flex items-center">
                        <i class="fas fa-filter mr-2"></i>Filter
                    </button>
                </div>
            </div>
        </div> --}}

        <!-- Transactions Table -->
        <div class="glass overflow-hidden hover-scale">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-white/30">
                    <thead class="bg-white/30">
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                Invoice</th>
                            <th
                                class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                Outlet</th>
                            <th
                                class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                Member</th>
                            <th
                                class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                Tanggal</th>
                            <th
                                class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                Batas Waktu</th>
                            <th
                                class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                Status</th>
                            <th
                                class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                Pembayaran</th>
                            <th
                                class="px-6 py-4 text-right text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white/20 divide-y divide-white/30">
                        @foreach($transactions as $transaction)
                                                <tr class="hover:bg-white/30 transition-colors duration-200">
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm font-medium text-blue-600 hover:text-blue-800 transition-colors">
                                                            {{ $transaction->invoice_code }}
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-700">{{ $transaction->outlet->name }}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-700">{{ $transaction->member->nama }}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-700">{{ date('d M Y', strtotime($transaction->tanggal)) }}
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-700">
                                                            {{ date('d M Y', strtotime($transaction->batas_waktu)) }}
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        @php
                                                            $statusColors = [
                                                                'baru' => 'bg-blue-200 text-blue-800',
                                                                'proses' => 'bg-yellow-100 text-yellow-800 ',
                                                                'selesai' => 'bg-green-100 text-green-800 ',
                                                                'belum_dibayar' => 'bg-red-100 text-red-800 '
                                                            ];
                                                        @endphp
                                                        <span
                                                            class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$transaction->status] }} transition-all duration-200 hover:shadow-md">
                                                            {{ ucfirst(str_replace('_', ' ', $transaction->status)) }}
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        @if($transaction->dibayar == 'lunas')
                                                            <div class="flex flex-col">
                                                                <span
                                                                    class="px-3 py-1 inline-flex text-xs leading-5 text-center font-semibold rounded-md bg-green-100 text-green-800 mb-1 transition-all duration-200 hover:shadow-md">
                                                                    Lunas
                                                                </span>
                                                                <span class="text-xs text-gray-600">
                                                                    {{ $transaction->tanggal_bayar ? date('d M Y', strtotime($transaction->tanggal_bayar)) : '' }}
                                                                </span>
                                                            </div>
                                                        @else
                                                            <span
                                                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-md text-center  bg-red-100 text-red-800 transition-all duration-200 hover:shadow-md">
                                                                Belum Dibayar
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <a href="{{ route('transactions.download-proof', $transaction->id) }}"
                                                            class="text-blue-500 hover:text-blue-700 inline-flex items-center mr-3"
                                                            title="Download Bukti Transaksi">
                                                            <i class="fas fa-download mr-1"></i> Bukti
                                                        </a>
                                                    </td>
                                                </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="bg-white/20 px-4 py-3 border-t border-white/30 sm:px-6">
                {{ $transactions->links() }}
            </div>
        </div>
    </div>

    <script>
        // Create additional random bubbles with larger sizes
        document.addEventListener('DOMContentLoaded', function () {
            const colors = ['rgba(255, 255, 255, 0.15)', 'rgba(255, 255, 255, 0.2)', 'rgba(255, 255, 255, 0.1)'];

            for (let i = 0; i < 5; i++) {
                const bubble = document.createElement('div');
                bubble.className = 'bubble';

                // Larger random sizes (100px to 250px)
                const size = Math.random() * 150 + 100;
                const color = colors[Math.floor(Math.random() * colors.length)];

                bubble.style.width = `${size}px`;
                bubble.style.height = `${size}px`;
                bubble.style.top = `${Math.random() * 100}%`;
                bubble.style.left = `${Math.random() * 100}%`;
                bubble.style.background = color;
                bubble.style.animationDelay = `${Math.random() * 5}s`;
                bubble.style.animationDuration = `${8 + Math.random() * 12}s`;

                document.body.appendChild(bubble);
            }
        });
    </script>
</body>

</html>