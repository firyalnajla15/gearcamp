<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login User - GearCamp</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f2f5f1;
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            background: white;
            padding: 35px;
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, .08);
        }

        .brand {
            color: #1f4d3a;
            font-size: 28px;
            font-weight: bold;
        }

        .login-icon {
            width: 65px;
            height: 65px;
            border-radius: 16px;
            background: #e5eee7;
            color: #1f4d3a;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            margin: 20px auto;
        }

        .btn-green {
            background: #1f4d3a;
            color: white;
            border: none;
            padding: 12px;
            font-weight: 600;
        }

        .btn-green:hover {
            background: #163b2c;
            color: white;
        }

        .form-control {
            padding: 11px;
        }

        .register-link {
            color: #1f4d3a;
            font-weight: 600;
        }
    </style>
</head>

<body>

    <div class="login-card">
        <div class="text-center">
            <div class="brand">GearCamp</div>
            <p class="text-muted small">
                Masuk untuk melanjutkan penyewaan perlengkapan camping.
            </p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.user.process') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="nama@email.com"
                    value="{{ old('email') }}" required autofocus>
            </div>

            <div class="mb-4">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>

            <button type="submit" class="btn btn-green w-100">
                Login sebagai User
            </button>
        </form>

        <div class="text-center mt-3 small">
            Belum punya akun?
            <a href="{{ route('register') }}" class="register-link text-decoration-none">
                Daftar sekarang
            </a>
        </div>

        <div class="text-center mt-3">
            <a href="{{ route('home') }}" class="text-decoration-none text-muted small">
                ← Kembali ke Beranda
            </a>
        </div>
    </div>

</body>

</html>
