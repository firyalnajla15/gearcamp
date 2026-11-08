
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - GearCamp</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Fraunces:opsz,wght@9..144,600;9..144,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --green-900: #10271c;
            --green-800: #183b2b;
            --green-700: #1f4d3a;
            --green-100: #e5eee7;
            --gold-500: #d49a4a;
            --line: #e5e7eb;
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f2f5f1;
            background-image: radial-gradient(#dce4df 1px, transparent 1px);
            background-size: 24px 24px;
            font-family: 'Plus Jakarta Sans', Arial, sans-serif;
            padding: 20px;
            color: #1f2937;
        }

        .login-card {
            width: 100%;
            max-width: 440px;
            background: white;
            padding: 42px 40px;
            border-radius: 24px;
            box-shadow: 0 20px 40px -20px rgba(16, 39, 28, 0.15);
            border: 1px solid rgba(229, 231, 235, 0.5);
            position: relative;
            overflow: hidden;
            animation: slideUp 0.5s ease both;
        }

        .login-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--green-700), var(--gold-500));
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(18px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .brand {
            font-family: 'Fraunces', serif;
            color: var(--green-800);
            font-size: 34px;
            font-weight: 700;
            letter-spacing: -0.02em;
        }

        .brand i {
            color: var(--gold-500);
            font-size: 29px;
        }

        .subtitle {
            color: #8b928d;
            font-size: 13px;
            margin-top: 7px;
        }

        .login-icon {
            width: 68px;
            height: 68px;
            border-radius: 20px;
            background: var(--green-100);
            color: var(--green-700);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 29px;
            margin: 25px auto;
            box-shadow: inset 0 0 0 1px rgba(31, 77, 58, 0.1);
            transition: all 0.25s ease;
        }

        .mode-switch {
            display: flex;
            padding: 5px;
            background: #f1f4f1;
            border-radius: 12px;
            margin-bottom: 25px;
            gap: 5px;
        }

        .mode-btn {
            flex: 1;
            border: none;
            padding: 11px;
            border-radius: 9px;
            color: #718078;
            background: transparent;
            font-size: 14px;
            font-weight: 700;
            transition: all 0.25s ease;
        }

        .mode-btn.active {
            background: var(--green-700);
            color: white;
            box-shadow: 0 4px 10px rgba(31, 77, 58, 0.18);
        }

        .form-label {
            font-weight: 600;
            font-size: 13px;
            color: #374151;
            margin-bottom: 8px;
        }

        .form-control {
            padding: 13px 15px;
            border-radius: 10px;
            border: 1px solid var(--line);
            font-size: 14px;
            background-color: #fafbfa;
            transition: all 0.25s ease;
        }

        .form-control:focus {
            border-color: var(--green-700);
            box-shadow: 0 0 0 4px rgba(31, 77, 58, 0.1);
            background-color: white;
        }

        .form-control::placeholder {
            color: #a1aaa4;
        }

        .btn-green {
            background: var(--green-700);
            color: white;
            border: none;
            padding: 14px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 14px;
            transition: all 0.25s ease;
            box-shadow: 0 8px 20px -8px rgba(31, 77, 58, 0.6);
        }

        .btn-green:hover {
            background: var(--green-900);
            color: white;
            transform: translateY(-2px);
        }

        .register-link {
            color: var(--green-700);
            font-weight: 700;
            text-decoration: none;
        }

        .register-link:hover {
            color: var(--gold-500);
        }

        .back-link {
            display: inline-block;
            transition: all 0.2s ease;
        }

        .back-link:hover {
            color: var(--green-700) !important;
            transform: translateX(-3px);
        }

        .alert-danger {
            border-radius: 10px;
            border: none;
            background-color: #fee2e2;
            color: #991b1b;
            font-size: 13px;
            font-weight: 500;
        }

        .alert-success {
            border-radius: 10px;
            border: none;
            font-size: 13px;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 35px 24px;
            }
        }
    </style>
</head>

<body>

    @php
        $loginMode = old('role', $mode ?? request('mode', 'user'));
        $loginMode = in_array($loginMode, ['admin', 'user']) ? $loginMode : 'user';
    @endphp

    <div class="login-card">

        <div class="text-center">
            <div class="brand">
                <i class="fa-solid fa-mountain-sun me-2"></i>GearCamp
            </div>

            <p class="subtitle" id="loginSubtitle">
                Masuk untuk melanjutkan penyewaan perlengkapan camping.
            </p>
        </div>

        <div class="login-icon" id="loginIcon">
            <i class="fa-solid fa-user" id="loginIconSymbol"></i>
        </div>

        <div class="mode-switch">
            <button
                type="button"
                class="mode-btn {{ $loginMode === 'user' ? 'active' : '' }}"
                id="userMode"
                onclick="changeMode('user')">
                <i class="fa-solid fa-user me-1"></i> User
            </button>

            <button
                type="button"
                class="mode-btn {{ $loginMode === 'admin' ? 'active' : '' }}"
                id="adminMode"
                onclick="changeMode('admin')">
                <i class="fa-solid fa-user-shield me-1"></i> Admin
            </button>
        </div>

        @if (session('success'))
            <div class="alert alert-success bg-success-subtle text-success mb-3">
                <i class="fa-solid fa-circle-check me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger mb-3">
                <i class="fa-solid fa-circle-exclamation me-2"></i>
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.process') }}">
            @csrf

            <input type="hidden" name="role" id="loginRole" value="{{ $loginMode }}">

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input
                    type="email"
                    name="email"
                    class="form-control"
                    placeholder="nama@email.com"
                    value="{{ old('email') }}"
                    required
                    autofocus>
            </div>

            <div class="mb-4">
                <label class="form-label">Password</label>
                <input
                    type="password"
                    name="password"
                    class="form-control"
                    placeholder="Masukkan password"
                    required>
            </div>

            <button type="submit" class="btn btn-green w-100" id="loginButton">
                <i class="fa-solid fa-right-to-bracket me-2"></i>
                Masuk sebagai User
            </button>
        </form>

        <div class="text-center mt-4 small" id="registerSection">
            Belum punya akun?
            <a href="{{ route('register') }}" class="register-link ms-1">
                Daftar sekarang
            </a>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('home') }}" class="text-decoration-none text-muted small fw-medium back-link">
                <i class="fa-solid fa-arrow-left me-1"></i>
                Kembali ke Beranda
            </a>
        </div>

    </div>

    <script>
        function changeMode(mode) {
            const userButton = document.getElementById('userMode');
            const adminButton = document.getElementById('adminMode');
            const roleInput = document.getElementById('loginRole');
            const subtitle = document.getElementById('loginSubtitle');
            const icon = document.getElementById('loginIconSymbol');
            const loginButton = document.getElementById('loginButton');
            const registerSection = document.getElementById('registerSection');

            roleInput.value = mode;

            userButton.classList.toggle('active', mode === 'user');
            adminButton.classList.toggle('active', mode === 'admin');

            if (mode === 'admin') {
                subtitle.textContent = 'Masuk untuk mengelola sistem GearCamp.';
                icon.className = 'fa-solid fa-user-shield';
                loginButton.innerHTML =
                    '<i class="fa-solid fa-right-to-bracket me-2"></i>Masuk sebagai Admin';
                registerSection.style.display = 'none';
            } else {
                subtitle.textContent = 'Masuk untuk melanjutkan penyewaan perlengkapan camping.';
                icon.className = 'fa-solid fa-user';
                loginButton.innerHTML =
                    '<i class="fa-solid fa-right-to-bracket me-2"></i>Masuk sebagai User';
                registerSection.style.display = 'block';
            }
        }

        // Atur tampilan awal berdasarkan role yang dipilih
        changeMode(document.getElementById('loginRole').value);
    </script>

</body>
</html>
