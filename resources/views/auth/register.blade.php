
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - GearCamp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f7f9f7;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .auth-card {
            width: 100%;
            max-width: 430px;
            background: white;
            padding: 35px;
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0,0,0,.08);
        }
        .brand { color: #1f4d3a; font-weight: bold; }
        .btn-green {
            background: #1f4d3a;
            color: white;
        }
        .btn-green:hover {
            background: #163b2c;
            color: white;
        }
    </style>
</head>
<body>
<div class="auth-card">
    <h3 class="brand text-center mb-2">GearCamp</h3>
    <h5 class="text-center mb-1">Buat Akun</h5>
    <p class="text-muted text-center mb-4">Daftar untuk mulai menyewa perlengkapan</p>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register.process') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control"
                   value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control"
                   minlength="8" required>
        </div>

        <div class="mb-4">
            <label class="form-label">Konfirmasi Password</label>
            <input type="password" name="password_confirmation"
                   class="form-control" minlength="8" required>
        </div>

        <button type="submit" class="btn btn-green w-100 py-2">
            Daftar Sekarang
        </button>
    </form>

    <p class="text-center mt-4 mb-0">
        Sudah punya akun?
        <a href="{{ route('login.user') }}" class="brand">Login</a>
    </p>
</div>
</body>
</html>
