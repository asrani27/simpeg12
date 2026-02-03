<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Two-Factor Authentication - SIMPEG</title>
    @vite('resources/css/app.css')
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center px-4 py-8">
    <div class="max-w-md w-full">
        <!-- Card -->
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-indigo-600 to-purple-700 px-8 py-6 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-white bg-opacity-20 backdrop-blur-sm rounded-full mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                        </path>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-white mb-1">Verifikasi 2FA</h1>
                <p class="text-indigo-100 text-sm">Masukkan kode dari aplikasi authenticator</p>
            </div>

            <!-- Error Message -->
            @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 m-6 rounded-r">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">
                            {{ $errors->first('code') ?: $errors->first('error') }}
                        </p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Form -->
            <div class="px-8 py-6">
                <form action="{{ route('2fa.verify') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="code" class="block text-sm font-medium text-gray-700 mb-2">Kode Verifikasi</label>
                        <input type="text" id="code" name="code"
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-center text-3xl tracking-[0.5em] text-gray-900 placeholder-gray-400 transition duration-150 ease-in-out"
                            placeholder="000000" maxlength="6" pattern="\d{6}" required autofocus>
                        <p class="mt-2 text-xs text-gray-500 text-center">
                            Buka aplikasi authenticator Anda dan masukkan 6 digit kode
                        </p>
                    </div>

                    <!-- User Info -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name ?? Auth::user()->username }}</p>
                                <p class="text-xs text-gray-500">Two-Factor Authentication aktif</p>
                            </div>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent text-sm font-semibold rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out shadow-lg hover:shadow-xl">
                        <span class="mr-2">Verifikasi</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7"></path>
                        </svg>
                    </button>

                    <div class="text-center">
                        <a href="{{ route('logout') }}" class="text-sm text-indigo-600 hover:text-indigo-500 font-medium">
                            Kembali ke login
                        </a>
                    </div>
                </form>
            </div>

            <!-- Info Footer -->
            <div class="bg-gray-50 px-8 py-4 border-t border-gray-100">
                <div class="flex items-start space-x-2">
                    <svg class="h-5 w-5 text-blue-400 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="text-xs text-gray-600">
                        Kode ini hanya berlaku selama 30 detik. Kode baru akan dihasilkan secara otomatis oleh aplikasi authenticator Anda.
                    </p>
                </div>
            </div>
        </div>

        <!-- Help Text -->
        <div class="mt-6 text-center">
            <p class="text-sm text-white text-opacity-80">
                Butuh bantuan? <a href="#" class="text-white font-medium underline">Hubungi administrator</a>
            </p>
        </div>
    </div>

    <script>
        // Auto-format input to 6 digits
        document.getElementById('code').addEventListener('input', function(e) {
            this.value = this.value.replace(/\D/g, '').slice(0, 6);
        });

        // Auto-submit when 6 digits entered
        document.getElementById('code').addEventListener('input', function(e) {
            if (this.value.length === 6) {
                this.form.submit();
            }
        });
    </script>
</body>

</html>