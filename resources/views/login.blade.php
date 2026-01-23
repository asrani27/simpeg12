<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIMPEG</title>
    @vite('resources/css/app.css')
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            overflow: hidden;
        }

        .circle-pattern {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
        }

        .circle-1 {
            width: 400px;
            height: 400px;
            background: white;
            top: -100px;
            left: -100px;
        }

        .circle-2 {
            width: 300px;
            height: 300px;
            background: white;
            bottom: -50px;
            right: -50px;
        }

        .circle-3 {
            width: 200px;
            height: 200px;
            background: white;
            top: 50%;
            right: 10%;
        }

        .circle-4 {
            width: 150px;
            height: 150px;
            background: white;
            bottom: 30%;
            left: 5%;
        }

        .floating-shape {
            position: absolute;
            opacity: 0.08;
        }

        .shape-1 {
            width: 100px;
            height: 100px;
            background: white;
            transform: rotate(45deg);
            top: 20%;
            left: 40%;
        }

        .shape-2 {
            width: 80px;
            height: 80px;
            border: 3px solid white;
            transform: rotate(30deg);
            bottom: 25%;
            left: 25%;
        }

        @media (max-width: 768px) {
            .circle-1, .circle-2, .circle-3, .circle-4 {
                display: none;
            }
            body {
                overflow: auto;
            }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center px-4 relative">
    <!-- Background Patterns -->
    <div class="circle-pattern circle-1"></div>
    <div class="circle-pattern circle-2"></div>
    <div class="circle-pattern circle-3"></div>
    <div class="circle-pattern circle-4"></div>
    <div class="floating-shape shape-1"></div>
    <div class="floating-shape shape-2"></div>

    <!-- Main Container -->
    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden max-w-5xl w-full flex flex-col md:flex-row">
        
        <!-- Left Column - Branding -->
        <div class="md:w-1/2 bg-gradient-to-br from-indigo-600 to-purple-700 p-12 flex flex-col justify-center items-center text-white relative overflow-hidden">
            <!-- Decorative circles in left panel -->
            <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-5 rounded-full -mr-16 -mt-16"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-5 rounded-full -ml-12 -mb-12"></div>
            
            <!-- Logo -->
            <div class="inline-flex items-center justify-center w-32 h-32 bg-white bg-opacity-20 backdrop-blur-sm rounded-full shadow-lg mb-8 relative z-10 p-4">
                <img src="{{ asset('logo/bjm.png') }}" alt="BJM Logo" class="w-full h-full object-contain">
            </div>
            
            <!-- Title -->
            <h1 class="text-5xl font-bold mb-4 relative z-10">SIMPEG</h1>
            <p class="text-xl text-indigo-100 mb-8 text-center relative z-10">Sistem Informasi Manajemen Pegawai</p>
            
            <!-- Features -->
            <div class="space-y-4 relative z-10">
                <div class="flex items-center space-x-3">
                    <div class="w-2 h-2 bg-white rounded-full"></div>
                    <span class="text-indigo-100">Manajemen Pegawai Terpadu</span>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-2 h-2 bg-white rounded-full"></div>
                    <span class="text-indigo-100">Sistem Absensi Modern</span>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-2 h-2 bg-white rounded-full"></div>
                    <span class="text-indigo-100">Laporan & Analitik Lengkap</span>
                </div>
            </div>
            
            <!-- Copyright -->
            <div class="mt-12 text-sm text-indigo-200 relative z-10">
                <p>© {{ date('Y') }} SIMPEG</p>
                <p>Semua hak dilindungi</p>
            </div>
        </div>

        <!-- Right Column - Login Form -->
        <div class="md:w-1/2 p-12 flex flex-col justify-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Selamat Datang</h2>
            <p class="text-gray-600 mb-8">Silakan masuk untuk melanjutkan</p>

            <!-- Error Message -->
            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">
                                {{ $errors->first('username') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Login Form -->
            <form action="{{ route('login.process') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Username Field -->
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </span>
                        <input
                            type="text"
                            id="username"
                            name="username"
                            value="{{ old('username') }}"
                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out text-gray-900 placeholder-gray-400"
                            placeholder="Masukkan username"
                            required
                            autofocus
                        >
                    </div>
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </span>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="block w-full pl-10 pr-12 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out text-gray-900 placeholder-gray-400"
                            placeholder="Masukkan password"
                            required
                        >
                        <button
                            type="button"
                            id="togglePassword"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer"
                            onclick="togglePasswordVisibility()"
                        >
                            <svg id="eyeIcon" class="h-5 w-5 text-gray-400 hover:text-gray-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            <svg id="eyeOffIcon" class="h-5 w-5 text-gray-400 hover:text-gray-600 transition-colors hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.057 10.057 0 01-2.709 4.514m0 0L21 21"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- JavaScript for toggle password -->
                <script>
                    function togglePasswordVisibility() {
                        const passwordInput = document.getElementById('password');
                        const eyeIcon = document.getElementById('eyeIcon');
                        const eyeOffIcon = document.getElementById('eyeOffIcon');
                        
                        if (passwordInput.type === 'password') {
                            passwordInput.type = 'text';
                            eyeIcon.classList.add('hidden');
                            eyeOffIcon.classList.remove('hidden');
                        } else {
                            passwordInput.type = 'password';
                            eyeIcon.classList.remove('hidden');
                            eyeOffIcon.classList.add('hidden');
                        }
                    }
                </script>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input
                            id="remember"
                            name="remember"
                            type="checkbox"
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded cursor-pointer"
                            {{ old('remember') ? 'checked' : '' }}
                        >
                        <label for="remember" class="ml-2 block text-sm text-gray-700 cursor-pointer">
                            Ingat saya
                        </label>
                    </div>
                    <div class="text-sm">
                        <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500 transition duration-150 ease-in-out">
                            Lupa password?
                        </a>
                    </div>
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="w-full flex justify-center py-3 px-4 border border-transparent text-sm font-semibold rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out shadow-lg hover:shadow-xl"
                >
                    <span class="mr-2">Masuk</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </button>
            </form>

            <!-- Help Text -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-500">
                    Butuh bantuan? <a href="#" class="text-indigo-600 hover:text-indigo-500 font-medium">Hubungi administrator</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
