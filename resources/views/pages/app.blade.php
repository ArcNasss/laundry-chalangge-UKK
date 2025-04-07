<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FreshClean - Premium Laundry Service</title>
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

        .hero-gradient {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            position: relative;
            overflow: hidden;
        }

        /* Animated Bubbles */
        .bubbles {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 0;
            overflow: hidden;
        }

        .bubble {
            position: absolute;
            bottom: -100px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            animation: rise 15s infinite ease-in;
        }

        .bubble:nth-child(1) {
            width: 150px;
            height: 150px;
            left: ;
            animation-duration: 12s;
        }

        .bubble:nth-child(2) {
            width: 80px;
            height: 80px;
            left: 10%;
            animation-duration: 8s;
            animation-delay: 1s;
        }

        .bubble:nth-child(3) {
            width: 150px;
            height: 150px;
            left: 30%;
            animation-duration: 10s;
            animation-delay: 2s;
        }

        .bubble:nth-child(4) {
            width: 200px;
            height: 200px;
            left: 40%;
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
            width: 200px;
            height: 200px;
            left: 75%;
            animation-duration: 7s;
            animation-delay: 2s;
        }

        .bubble:nth-child(8) {
            width: 180px;
            height: 180px;
            left: 80%;
            animation-duration: 6s;
            animation-delay: 1s;
        }

        .bubble:nth-child(9) {
            width: 100px;
            height: 100px;
            left: 0%;
            animation-duration: 4s;
            animation-delay: 1s;
        }

        .bubble:nth-child(10) {
            width: 120px;
            height: 120px;
            left: 30%;
            animation-duration: 6s;
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

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 1s ease-out forwards;
        }

        .delay-1 {
            animation-delay: 0.2s;
        }

        .delay-2 {
            animation-delay: 0.4s;
        }

        .delay-3 {
            animation-delay: 0.6s;
        }

        .delay-4 {
            animation-delay: 0.8s;
        }

        .delay-5 {
            animation-delay: 1s;
        }

        /* Hover Effects */
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .testimonial-card:hover {
            transform: scale(1.05);
        }

        /* Floating Animation */
        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-15px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .floating {
            animation: float 6s ease-in-out infinite;
        }

        /* Tambahkan di bagian style */
        .navbar-scrolled {

            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .navbar-scrolled a,
        .navbar-scrolled #menu-toggle {
            color: #3b82f6 !important;
            /* Warna biru */
        }

        .navbar-scrolled .logo-text {
            color: #3b82f6 !important;
            /* Warna biru untuk teks logo */
        }

        #btn-login {
            color: #3b82f6
        }
    </style>
</head>

<body class="font-sans antialiased text-gray-800">
    <!-- Header/Navigation -->
    <header class="fixed top-0 w-full z-50">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between glass rounded-full px-6 py-3">
                <!-- Logo -->
                <div class="flex items-center">
                    <div class="bg-white text-blue-600 p-2 rounded-lg mr-3">
                        <i class="fas fa-tshirt text-xl"></i>
                    </div>
                    <span class="text-xl font-bold text-white logo-text">FreshClean</span>
                </div>

                <!-- Desktop Navigation -->
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="#home" class="text-white font-medium hover:text-blue-200 transition">Home</a>
                    <a href="#features" class="text-white hover:text-blue-200 transition">Keunggulan</a>
                    <a href="#testimonials" class="text-white hover:text-blue-200 transition">Apa Kata Mereka</a>
                    <a href="/login" id="btn-login"
                        class="bg-white text-blue-600 font-bold py-2 px-6 rounded-full hover:bg-blue-50 transition duration-300">Login</a>
                </nav>

                <!-- Mobile Menu Button -->
                <button class="md:hidden focus:outline-none text-white" id="menu-toggle">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>

            <!-- Mobile Navigation -->
            <div class="md:hidden hidden mt-4 py-2 glass rounded-lg" id="mobile-menu">
                <a href="#home" class="block py-2 px-4 text-white font-medium">Home</a>
                <a href="#features" class="block py-2 px-4 text-white hover:text-blue-200 transition">Keunggulan</a>
                <a href="#testimonials" class="block py-2 px-4 text-white hover:text-blue-200 transition">Apa Kata
                    Mereka</a>
                <a href="#"
                    class="block py-2 px-4 bg-white text-blue-600 font-bold rounded mx-2 my-2 text-center">Login</a>
            </div>
        </div>
    </header>

    <!-- Hero Section (CTA) -->
    <section id="home" class="hero-gradient text-white pt-32 pb-20 relative">
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
            <div class="bubble"></div>
            <div class="bubble"></div>
        </div>

        <div class="container mx-auto px-6 flex flex-col md:flex-row items-center relative z-10">
            <div class="md:w-1/2 mb-10 md:mb-0">
                <h1 class="text-4xl md:text-5xl font-bold mb-6 fade-in">"Laundry Today Or Naked Tomorrow"</h1>
                <p class="text-xl mb-8 opacity-90 fade-in delay-1">Laundry Kiloan Modern dengan Hasil Premium pelayanan
                    laundry terbaik dengan
                    teknologi modern ramah lingkungan.</p>
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 fade-in delay-2">

                    <a href="/login"
                        class="border-2 border-white text-white font-bold py-3 px-8 rounded-lg text-center hover:bg-white hover:text-blue-600 transition duration-300 glass">
                        Login ke Dashboard
                    </a>
                </div>
            </div>
            <div class="md:w-1/2 flex justify-center fade-in delay-3">
                <img src="https://images.unsplash.com/photo-1604176354204-9268737828e4?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                    alt="Laundry Service" class="rounded-lg shadow-2xl max-w-md w-full floating">
            </div>
        </div>
    </section>

    <!-- Keunggulan Section -->
    <section id="features" class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-800 mb-4 fade-in">Keunggulan FreshClean</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto fade-in delay-1">Kami memberikan pelayanan terbaik
                    dengan standar kualitas tinggi untuk kenyamanan Anda</p>
            </div>

            <div class="grid md:grid-cols-3 gap-10">
                <!-- Feature 1 -->
                <div class="feature-card glass p-8 rounded-xl transition duration-300 fade-in delay-1">
                    <div class="bg-white text-blue-600 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-bolt text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Cepat dan Tepat Waktu</h3>
                    <p class="text-gray-700">Proses pencucian hanya 6 jam dengan jaminan pengantaran tepat waktu atau
                        gratis.</p>
                </div>

                <!-- Feature 2 -->
                <div class="feature-card glass p-8 rounded-xl transition duration-300 fade-in delay-2">
                    <div class="bg-white text-green-600 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-leaf text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Ramah Lingkungan</h3>
                    <p class="text-gray-700">Menggunakan detergen biodegradable dan teknologi water recycling untuk
                        lingkungan yang lebih baik.</p>
                </div>

                <!-- Feature 3 -->
                <div class="feature-card glass p-8 rounded-xl transition duration-300 fade-in delay-3">
                    <div class="bg-white text-purple-600 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-shield-alt text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Hygienis Terjamin</h3>
                    <p class="text-gray-700">Proses sterilisasi dengan uap panas dan UV light membunuh 99.9% bakteri dan
                        virus.</p>
                </div>

                <!-- Feature 4 -->
                <div class="feature-card glass p-8 rounded-xl transition duration-300 fade-in delay-2">
                    <div class="bg-white text-yellow-600 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-money-bill-wave text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Harga Terjangkau</h3>
                    <p class="text-gray-700">Harga kompetitif dengan kualitas premium. Paket keluarga dengan diskon
                        khusus.</p>
                </div>

                <!-- Feature 5 -->
                <div class="feature-card glass p-8 rounded-xl transition duration-300 fade-in delay-3">
                    <div class="bg-white text-red-600 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-truck text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Gratis Antar-Jemput</h3>
                    <p class="text-gray-700">Layanan antar-jemput gratis untuk minimal 5kg dengan area jangkauan luas.
                    </p>
                </div>

                <!-- Feature 6 -->
                <div class="feature-card glass p-8 rounded-xl transition duration-300 fade-in delay-4">
                    <div class="bg-white text-indigo-600 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-mobile-alt text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Aplikasi Mobile</h3>
                    <p class="text-gray-700">Pantau status laundry Anda melalui aplikasi mobile kami yang user-friendly.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-800 mb-4 fade-in">Apa Kata Mereka</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto fade-in delay-1">Testimoni dari pelanggan setia
                    FreshClean</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="testimonial-card glass p-8 rounded-xl transition duration-500 fade-in delay-1">
                    <div class="flex items-center mb-6">
                        <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Customer"
                            class="w-16 h-16 rounded-full object-cover mr-4">
                        <div>
                            <h4 class="font-bold">Sarah Wijaya</h4>
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-700 italic">"Pelayanan sangat cepat dan pakaian kembali wangi dan bersih. Sudah
                        2 tahun langganan dan tidak pernah kecewa!"</p>
                </div>

                <!-- Testimonial 2 -->
                <div class="testimonial-card glass p-8 rounded-xl transition duration-500 fade-in delay-2">
                    <div class="flex items-center mb-6">
                        <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Customer"
                            class="w-16 h-16 rounded-full object-cover mr-4">
                        <div>
                            <h4 class="font-bold">Budi Santoso</h4>
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-700 italic">"Harga sangat terjangkau untuk kualitas premium. Driver ramah dan
                        selalu tepat waktu. Recommended banget!"</p>
                </div>

                <!-- Testimonial 3 -->
                <div class="testimonial-card glass p-8 rounded-xl transition duration-500 fade-in delay-3">
                    <div class="flex items-center mb-6">
                        <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Customer"
                            class="w-16 h-16 rounded-full object-cover mr-4">
                        <div>
                            <h4 class="font-bold">Dewi Anggraeni</h4>
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-700 italic">"Pakaian bayi saya dicuci terpisah dengan detergen khusus. Sangat
                        memperhatikan detail dan higienis. Terima kasih FreshClean!"</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 relative overflow-hidden">
        <!-- Background Gradient -->
        <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-blue-700 opacity-95 z-0"></div>

        <!-- Bubbles for Contact Section -->
        <div class="bubbles">
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-white mb-4 fade-in">Hubungi Kami</h2>
                <p class="text-xl text-blue-100 max-w-2xl mx-auto fade-in delay-1">Kami siap melayani kebutuhan laundry
                    Anda</p>
            </div>

            <div class="grid md:grid-cols-2 gap-12">
                <!-- Contact Form -->
                <div class="glass p-8 rounded-xl shadow-lg fade-in delay-1">
                    <h3 class="text-2xl font-bold mb-6 text-white">Kirim Pesan</h3>
                    <form>
                        <div class="mb-6">
                            <label for="name" class="block text-blue-100 font-medium mb-2">Nama Lengkap</label>
                            <input type="text" id="name"
                                class="w-full px-4 py-3 bg-white bg-opacity-20 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-white placeholder-blue-200">
                        </div>
                        <div class="mb-6">
                            <label for="email" class="block text-blue-100 font-medium mb-2">Email</label>
                            <input type="email" id="email"
                                class="w-full px-4 py-3 bg-white bg-opacity-20 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-white placeholder-blue-200">
                        </div>
                        <div class="mb-6">
                            <label for="phone" class="block text-blue-100 font-medium mb-2">Nomor Telepon</label>
                            <input type="tel" id="phone"
                                class="w-full px-4 py-3 bg-white bg-opacity-20 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-white placeholder-blue-200">
                        </div>
                        <div class="mb-6">
                            <label for="message" class="block text-blue-100 font-medium mb-2">Pesan</label>
                            <textarea id="message" rows="4"
                                class="w-full px-4 py-3 bg-white bg-opacity-20 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-white placeholder-blue-200"></textarea>
                        </div>
                        <button type="submit"
                            class="w-full bg-white text-blue-600 font-bold py-3 px-6 rounded-lg hover:bg-blue-50 transition duration-300">
                            Kirim Pesan
                        </button>
                    </form>
                </div>

                <!-- Contact Info -->
                <div class="fade-in delay-2">
                    <h3 class="text-2xl font-bold mb-6 text-white">Informasi Kontak</h3>

                    <div class="mb-8">
                        <h4 class="text-xl font-semibold mb-4 text-white">Alamat</h4>
                        <div class="flex items-start">
                            <i class="fas fa-map-marker-alt text-2xl mr-4 mt-1 text-blue-200"></i>
                            <p class="text-blue-100">Jl. Raya Kebayoran Lama No. 123<br>Jakarta Selatan,
                                12240<br>Indonesia</p>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h4 class="text-xl font-semibold mb-4 text-white">Jam Operasional</h4>
                        <div class="flex items-start">
                            <i class="fas fa-clock text-2xl mr-4 mt-1 text-blue-200"></i>
                            <div>
                                <p class="font-medium text-blue-100">Senin - Jumat: 08.00 - 20.00</p>
                                <p class="font-medium text-blue-100">Sabtu - Minggu: 09.00 - 17.00</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h4 class="text-xl font-semibold mb-4 text-white">Kontak</h4>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <i class="fas fa-phone-alt text-xl mr-4 text-blue-200"></i>
                                <p class="text-blue-100">+62 812-3456-7890</p>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-envelope text-xl mr-4 text-blue-200"></i>
                                <p class="text-blue-100">info@freshclean.com</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h4 class="text-xl font-semibold mb-4 text-white">Media Sosial</h4>
                        <div class="flex space-x-4">
                            <a href="#"
                                class="bg-white bg-opacity-20 text-white w-10 h-10 rounded-full flex items-center justify-center hover:bg-opacity-30 transition">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#"
                                class="bg-white bg-opacity-20 text-white w-10 h-10 rounded-full flex items-center justify-center hover:bg-opacity-30 transition">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#"
                                class="bg-white bg-opacity-20 text-white w-10 h-10 rounded-full flex items-center justify-center hover:bg-opacity-30 transition">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="#"
                                class="bg-white bg-opacity-20 text-white w-10 h-10 rounded-full flex items-center justify-center hover:bg-opacity-30 transition">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 relative overflow-hidden">
        <!-- Bubbles for Footer -->
        <div class="bubbles">
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="grid md:grid-cols-4 gap-8">
                <div class="fade-in">
                    <div class="flex items-center mb-4">
                        <div class="bg-blue-600 text-white p-2 rounded-lg mr-3">
                            <i class="fas fa-tshirt"></i>
                        </div>
                        <span class="text-xl font-bold">FreshClean</span>
                    </div>
                    <p class="text-gray-400">Layanan laundry modern dengan teknologi terkini untuk hasil terbaik dan
                        ramah lingkungan.</p>
                </div>

                <div class="fade-in delay-1">
                    <h4 class="text-lg font-bold mb-4">Layanan</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Laundry Kiloan</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Dry Cleaning</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Laundry Sepatu</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Laundry Bed Cover</a></li>
                    </ul>
                </div>

                <div class="fade-in delay-2">
                    <h4 class="text-lg font-bold mb-4">Perusahaan</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Tentang Kami</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Karir</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Blog</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Kebijakan Privasi</a></li>
                    </ul>
                </div>

                <div class="fade-in delay-3">
                    <h4 class="text-lg font-bold mb-4">Newsletter</h4>
                    <p class="text-gray-400 mb-4">Dapatkan promo dan penawaran spesial dari kami</p>
                    <div class="flex">
                        <input type="email" placeholder="Email Anda"
                            class="px-4 py-2 w-full rounded-l-lg focus:outline-none text-gray-800">
                        <button class="bg-blue-600 px-4 py-2 rounded-r-lg hover:bg-blue-700 transition">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400 fade-in delay-4">
                <p>&copy; 2023 FreshClean. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.getElementById('menu-toggle').addEventListener('click', function () {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();

                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);

                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });

                    // Close mobile menu if open
                    const mobileMenu = document.getElementById('mobile-menu');
                    if (!mobileMenu.classList.contains('hidden')) {
                        mobileMenu.classList.add('hidden');
                    }
                }
            });
        });

        // Add fade-in class to elements when they come into view
        const fadeElements = document.querySelectorAll('.fade-in');

        const fadeInObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('opacity-100');
                    fadeInObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        fadeElements.forEach(element => {
            element.classList.add('opacity-0');
            fadeInObserver.observe(element);
        });
    </script>


    <script>
        // Navbar scroll effect
        const navbar = document.querySelector('header');
        const logoText = document.querySelector('.logo-text');
        const navLinks = document.querySelectorAll('nav a');
        const menuToggle = document.getElementById('menu-toggle');

        function handleNavbarScroll() {
            const isMobile = window.innerWidth <= 768;

            if (!isMobile) {
                // Logika untuk desktop
                if (window.scrollY > 600 && window.scrollY < 2000) {
                    navbar.classList.add('navbar-scrolled');
                    logoText.classList.add('text-blue-600');
                    navLinks.forEach(link => {
                        link.classList.add('text-blue-600');
                        link.classList.remove('text-white');
                    });
                    menuToggle.classList.add('text-blue-600');
                    menuToggle.classList.remove('text-white');
                } else {
                    navbar.classList.remove('navbar-scrolled');
                    logoText.classList.remove('text-blue-600');
                    navLinks.forEach(link => {
                        link.classList.remove('text-blue-600');
                        link.classList.add('text-white');
                    });
                    menuToggle.classList.remove('text-blue-600');
                    menuToggle.classList.add('text-white');
                }
            } else {
                // Logika untuk mobile
                if (window.scrollY > 1000 && window.scrollY < 4000) {
                    navbar.classList.add('navbar-scrolled');
                    logoText.classList.add('text-blue-600');
                    navLinks.forEach(link => {
                        link.classList.add('text-blue-600');
                        link.classList.remove('text-white');
                    });
                    menuToggle.classList.add('text-blue-600');
                    menuToggle.classList.remove('text-white');
                } else {
                    navbar.classList.remove('navbar-scrolled');
                    logoText.classList.remove('text-blue-600');
                    navLinks.forEach(link => {
                        link.classList.remove('text-blue-600');
                        link.classList.add('text-white');
                    });
                    menuToggle.classList.remove('text-blue-600');
                    menuToggle.classList.add('text-white');
                }
            }
        }

        // Jalankan saat load dan scroll
        window.addEventListener('load', handleNavbarScroll);
        window.addEventListener('scroll', handleNavbarScroll);
        window.addEventListener('resize', handleNavbarScroll);

        // Mobile menu toggle
        document.getElementById('menu-toggle').addEventListener('click', function () {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();

                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);

                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });

                    // Close mobile menu if open
                    const mobileMenu = document.getElementById('mobile-menu');
                    if (!mobileMenu.classList.contains('hidden')) {
                        mobileMenu.classList.add('hidden');
                    }
                }
            });
        });
    </script>
</body>

</html>