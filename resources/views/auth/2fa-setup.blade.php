<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup Two-Factor Authentication - SIMPEG</title>
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen bg-gradient-to-br from-indigo-50 to-purple-50 flex items-center justify-center px-4 py-8">
    <div class="max-w-2xl w-full">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Setup Two-Factor Authentication</h1>
            <p class="text-gray-600">Aktifkan keamanan tambahan untuk akun Anda</p>
        </div>

        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Error Message -->
            @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
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

            <!-- Instructions -->
            <div class="p-8">
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-blue-800">Langkah-langkah:</h3>
                            <div class="mt-2 text-sm text-blue-700 space-y-1">
                                <ol class="list-decimal list-inside space-y-1">
                                    <li>Download aplikasi authenticator (Google Authenticator, Authy, dll)</li>
                                    <li>Scan QR Code di bawah ini</li>
                                    <li>Masukkan kode 6 digit yang ditampilkan oleh aplikasi</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- QR Code -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-3">QR Code</label>
                    <div class="flex justify-center">
                        <img src="{{ $qrCodeUrl }}" alt="QR Code" class="border border-gray-200 rounded-lg p-4 bg-white shadow-sm">
                    </div>
                </div>

                <!-- Secret Key -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kode Secret</label>
                    <div class="flex items-center space-x-2">
                        <input type="text" readonly value="{{ $secret }}"
                            class="flex-1 block w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-900 text-sm font-mono">
                        <button onclick="copySecret()" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                            Copy
                        </button>
                    </div>
                </div>

                <!-- Verification Form -->
                <form action="{{ route('2fa.enable') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="code" class="block text-sm font-medium text-gray-700 mb-2">Kode Verifikasi</label>
                        <input type="text" id="code" name="code"
                            class="block w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 text-center text-xl tracking-widest text-gray-900 placeholder-gray-400"
                            placeholder="000000" maxlength="6" pattern="\d{6}" required autofocus>
                        <p class="mt-2 text-xs text-gray-500 text-center">Masukkan 6 digit kode dari aplikasi authenticator</p>
                    </div>

                    <div class="flex space-x-4">
                        <a href="{{ route('profile.index') }}"
                            class="flex-1 inline-flex justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Batal
                        </a>
                        <button type="submit"
                            class="flex-1 inline-flex justify-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Aktifkan 2FA
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Warning -->
        <div class="mt-6 text-center">
            <p class="text-xs text-gray-500">
                Pastikan Anda menyimpan kode secret di tempat aman. Jika Anda kehilangan akses ke aplikasi authenticator,
                Anda akan kehilangan akses ke akun Anda.
            </p>
        </div>
    </div>

    <script>
        function copySecret() {
            const secretInput = document.querySelector('input[readonly][value="{{ $secret }}"]');
            secretInput.select();
            document.execCommand('copy');
            
            // Show brief confirmation
            const button = event.target.closest('button');
            const originalText = button.innerHTML;
            button.innerHTML = '<svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Copied!';
            setTimeout(() => {
                button.innerHTML = originalText;
            }, 2000);
        }

        // Auto-format input to 6 digits
        document.getElementById('code').addEventListener('input', function(e) {
            this.value = this.value.replace(/\D/g, '').slice(0, 6);
        });
    </script>
</body>

</html>