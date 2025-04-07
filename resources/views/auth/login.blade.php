<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Member - FreshClean</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            min-height: 100vh;
            position: relative;
            overflow: hidden;
        }

        /* Glassmorphism Effect */
        .card-login {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
        }

        /* Animated Bubbles */
        .bubbles {
            position: absolute;
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
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            animation: rise 15s infinite ease-in;
        }

        /* Bubble sizes and positions */
        .bubble:nth-child(1) {
            width: 120px;
            height: 120px;
            left: 10%;
            animation-duration: 12s;
        }

        .bubble:nth-child(2) {
            width: 80px;
            height: 80px;
            left: 25%;
            animation-duration: 8s;
            animation-delay: 1s;
        }

        .bubble:nth-child(3) {
            width: 150px;
            height: 150px;
            left: 40%;
            animation-duration: 10s;
            animation-delay: 2s;
        }

        .bubble:nth-child(4) {
            width: 200px;
            height: 200px;
            left: 60%;
            animation-duration: 15s;
            animation-delay: 0s;
        }

        .bubble:nth-child(5) {
            width: 100px;
            height: 100px;
            left: 75%;
            animation-duration: 9s;
            animation-delay: 1s;
        }

        .bubble:nth-child(6) {
            width: 130px;
            height: 130px;
            left: 85%;
            animation-duration: 11s;
            animation-delay: 3s;
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

        /* Input field styling */
        .input-field {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .input-field:focus {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.4);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
        }

        /* Button hover effect */
        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        /* Error message styling */
        .error-message {
            background: rgba(239, 68, 68, 0.1);
            border-left: 4px solid rgba(239, 68, 68, 0.7);
            backdrop-filter: blur(5px);
        }
    </style>
</head>

<body class="flex items-center justify-center p-4">
    <!-- Animated Bubbles Background -->
    <div class="bubbles">
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
    </div>

    <!-- Login Card -->
    <div class="card-login w-full max-w-md p-8 transform transition-all duration-300 hover:scale-[1.01]">
        <div class="text-center mb-8">
            <div class="flex justify-center mb-4">
                <div class="bg-white text-blue-600 p-3 rounded-lg shadow-lg">
                    <i class="fas fa-tshirt text-3xl"></i>
                </div>
            </div>
            <h1 class="text-2xl font-bold text-white">FreshClean Laundry</h1>
            <p class="text-blue-100">Masuk ke akun member Anda</p>
        </div>

        @if ($errors->any())
            <div class="error-message p-4 mb-6 rounded-lg">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle text-red-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-white">
                            Username atau password yang Anda masukkan salah.
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-6">
                <label for="username" class="block text-sm font-medium text-blue-100 mb-1">Username</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-user text-blue-200"></i>
                    </div>
                    <input type="text" id="username" name="username" value="{{ old('username') }}" required autofocus
                        class="input-field block w-full pl-10 pr-3 py-2 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-white sm:text-sm text-white placeholder-blue-200"
                        placeholder="username">
                </div>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-blue-100 mb-1">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-blue-200"></i>
                    </div>
                    <input type="password" id="password" name="password" required
                        class="input-field block w-full pl-10 pr-3 py-2 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-white sm:text-sm text-white placeholder-blue-200"
                        placeholder="••••••••">
                </div>
            </div>

            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <input id="remember-me" name="remember" type="checkbox"
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="remember-me" class="ml-2 block text-sm text-blue-100">
                        Ingat saya
                    </label>
                </div>

                <div class="text-sm">
                    <a href="#" class="font-medium text-white hover:text-blue-200 transition-colors">
                        Lupa password?
                    </a>
                </div>
            </div>

            <div>
                <button type="submit"
                    class="login-btn w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-blue-600 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white transition-all duration-300">
                    <i class="fas fa-sign-in-alt mr-2"></i> Masuk
                </button>
            </div>
        </form>

        <div class="mt-8 text-center text-sm text-blue-100">
            Belum punya akun?
            <a href="#" class="font-medium text-white hover:text-blue-200 transition-colors">
                Hubungi admin
            </a>
        </div>
    </div>

    <script>
        // Add more random bubbles
        document.addEventListener('DOMContentLoaded', function () {
            const bubblesContainer = document.querySelector('.bubbles');
            const colors = ['rgba(255, 255, 255, 0.1)', 'rgba(255, 255, 255, 0.15)', 'rgba(255, 255, 255, 0.2)'];

            for (let i = 0; i < 4; i++) {
                const bubble = document.createElement('div');
                bubble.className = 'bubble';

                const size = Math.random() * 100 + 50;
                const color = colors[Math.floor(Math.random() * colors.length)];

                bubble.style.width = `${size}px`;
                bubble.style.height = `${size}px`;
                bubble.style.left = `${Math.random() * 100}%`;
                bubble.style.background = color;
                bubble.style.animationDelay = `${Math.random() * 5}s`;
                bubble.style.animationDuration = `${8 + Math.random() * 12}s`;

                bubblesContainer.appendChild(bubble);
            }
        });
    </script>
</body>

</html>