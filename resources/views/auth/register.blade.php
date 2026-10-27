<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - GearCamp</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Premium -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Fraunces:opsz,wght@9..144,600;9..144,700&display=swap" rel="stylesheet">

    <style>
        :root {
            --green-900: #10271c;
            --green-800: #183b2b;
            --green-700: #1f4d3a;
            --green-100: #e5eee7;
            --gold-500: #d49a4a;
            --line: #e5e7eb;
        }

        body {
            background-color: #f7f9f7;
            background-image: radial-gradient(#dce4df 1px, transparent 1px);
            background-size: 24px 24px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Plus Jakarta Sans', Arial, sans-serif;
            padding: 40px 20px;
            color: #1f2937;
        }

        .auth-card {
            width: 100%;
            max-width: 460px;
            background: white;
            padding: 45px 40px;
            border-radius: 24px;
            box-shadow: 0 20px 40px -20px rgba(16, 39, 28, 0.15);
            border: 1px solid rgba(229, 231, 235, 0.5);
            position: relative;
            overflow: hidden;
            animation: slideUp 0.6s cubic-bezier(.22, .61, .36, 1) both;
        }

        /* Garis aksen emas di atas card */
        .auth-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--green-700), var(--gold-500));
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .brand {
            font-family: 'Fraunces', serif;
            color: var(--green-800);
            font-weight: 700;
            font-size: 32px;
            letter-spacing: -0.02em;
        }

        .brand-icon {
            color: var(--gold-500);
            margin-right: 8px;
        }

        .subtitle {
            font-size: 15px;
            color: #6b7280;
            margin-top: 8px;
        }

        .form-label {
            font-weight: 600;
            font-size: 14px;
            color: #374151;
            margin-bottom: 8px;
        }

        .form-control {
            padding: 14px 16px;
            border-radius: 10px;
            border: 1px solid var(--line);
            font-size: 15px;
            background-color: #fafbfa;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--green-700);
            box-shadow: 0 0 0 4px rgba(31, 77, 58, 0.1);
            background-color: white;
        }

        .form-control::placeholder {
            color: #9ca3af;
        }

        .btn-green {
            background: var(--green-700);
            color: white;
            border: none;
            padding: 14px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 15px;
            letter-spacing: 0.01em;
            transition: all 0.28s cubic-bezier(.22, .61, .36, 1);
            box-shadow: 0 8px 20px -8px rgba(31, 77, 58, 0.6);
        }

        .btn-green:hover {
            background: var(--green-900);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 12px 24px -8px rgba(12, 35, 24, 0.8);
        }

        /* Alert Error Styling */
        .alert-danger {
            border-radius: 10px;
            border: none;
            background-color: #fee2e2;
            color: #991b1b;
            font-size: 14px;
            font-weight: 500;
        }

        .alert-danger ul {
            padding-left: 20px;
        }

        /* Link Login */
        a.login-link {
            color: var(--green-700);
            font-weight: 700;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        a.login-link:hover {
            color: var(--gold-500);
        }
    </style>
</head>
<body>

<div class="auth-card">
    <div class="text-center mb-4">
        <h3 class="brand mb-1">
            <i class="fa-solid fa-mountain-sun brand-icon"></i>GearCamp
        </h3>
        <h5 class="fw-bold mt-3" style="color: var(--green-800);">Buat Akun</h5>
        <p class="subtitle mb-0">Daftar untuk mulai menyewa perlengkapan</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger mb-4">
            <i class="fa-solid fa-circle-exclamation me-2"></i> <strong>Periksa kembali isian Anda:</strong>
            <ul class="mt-2 mb-0">
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
                   value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control"
                   value="{{ old('email') }}" placeholder="nama@email.com" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control"
                   placeholder="Minimal 8 karakter" minlength="8" required>
        </div>

        <div class="mb-4">
            <label class="form-label">Konfirmasi Password</label>
            <input type="password" name="password_confirmation"
                   class="form-control" placeholder="Ulangi password" minlength="8" required>
        </div>

        <button type="submit" class="btn btn-green w-100 py-2">
            Daftar Sekarang
        </button>
    </form>

    <p class="text-center mt-4 mb-0 text-muted" style="font-size: 14.5px;">
        Sudah punya akun?
        <a href="{{ route('login.user') }}" class="login-link ms-1">Login di sini</a>
    </p>
</div>

<!-- FontAwesome untuk Ikon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</body>
</html>