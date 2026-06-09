<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - SIFOMA</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css'])
    <style>
        body {
            background-color: var(--bg-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-image: radial-gradient(circle at 50% -20%, #1E40AF 0%, #0F172A 50%);
        }
        .login-card {
            width: 100%;
            max-width: 420px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: var(--radius-lg);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            padding: 2.5rem;
        }
    </style>
</head>
<body>
    <div class="login-card animate-slide-up">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-primary-light text-primary text-3xl mb-4">
                <i class="fas fa-lock"></i>
            </div>
            <h1 class="font-bold text-2xl font-['Plus_Jakarta_Sans'] text-gray-900">Admin SIFOMA</h1>
            <p class="text-muted text-sm mt-1">Silakan login untuk mengelola sistem</p>
        </div>

        @include('partials.flash-message')

        <form action="{{ route('admin.login.post') }}" method="POST">
            @csrf
            <div class="form-group mb-5">
                <label for="username" class="form-label text-sm text-gray-700">Username</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-user text-gray-400"></i>
                    </div>
                    <input type="text" name="username" id="username" class="form-control pl-10 bg-gray-50 border-gray-200" placeholder="Masukkan username" value="{{ old('username') }}" required autofocus>
                </div>
            </div>

            <div class="form-group mb-6">
                <label for="password" class="form-label text-sm text-gray-700">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-key text-gray-400"></i>
                    </div>
                    <input type="password" name="password" id="password" class="form-control pl-10 bg-gray-50 border-gray-200" placeholder="••••••••" required>
                </div>
            </div>

            <div class="flex items-center mb-6">
                <input type="checkbox" name="remember" id="remember" class="mr-2 w-4 h-4 text-primary rounded border-gray-300 focus:ring-primary">
                <label for="remember" class="text-sm text-gray-600 cursor-pointer">Ingat saya</label>
            </div>

            <button type="submit" class="btn btn-primary btn-block py-3 text-lg font-bold shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50">
                Login ke Dashboard <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </form>
        
        <div class="mt-6 text-center text-sm text-gray-500 border-t border-gray-100 pt-4">
            <a href="{{ route('beranda') }}" class="hover:text-primary"><i class="fas fa-home mr-1"></i> Kembali ke Beranda Publik</a>
        </div>
    </div>
</body>
</html>
