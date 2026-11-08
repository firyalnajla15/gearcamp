
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\User\RescheduleController;
use App\Models\Rental;

// HALAMAN PUBLIK
Route::get('/', function () {
    return view('landing.index');
})->name('home');

Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog.index');
Route::get('/katalog/{id}', [KatalogController::class, 'show'])->name('katalog.show');

// KERANJANG
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/increase/{id}', [CartController::class, 'increase'])->name('cart.increase');
Route::post('/cart/decrease/{id}', [CartController::class, 'decrease'])->name('cart.decrease');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// CHECKOUT
Route::get('/checkout', function () {
    return redirect()->route('login.user');
})->name('checkout');


// LOGIN DAN REGISTER
Route::middleware('guest')->group(function () {

    // Satu halaman login untuk Admin dan User
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.process');

    // Alias lama agar link yang masih memakai route login.admin/login.user
    // tetap diarahkan ke halaman login gabungan.
    Route::get('/login/admin', function () {
        return redirect()->route('login', ['mode' => 'admin']);
    })->name('login.admin');

    Route::get('/login/user', function () {
        return redirect()->route('login', ['mode' => 'user']);
    })->name('login.user');

    // Register khusus User
    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.process');
});

// LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


// LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// KHUSUS ADMIN
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');


        // KELOLA TRANSAKSI
        Route::get('/transaksi', [TransaksiController::class, 'index'])
            ->name('transaksi.index');

        Route::get('/transaksi/{rental}', [TransaksiController::class, 'show'])
            ->name('transaksi.show');

        Route::get('/transaksi/{rental}/edit', [TransaksiController::class, 'edit'])
            ->name('transaksi.edit');

        Route::put('/transaksi/{rental}', [TransaksiController::class, 'update'])
            ->name('transaksi.update');

        Route::patch('/transaksi/{rental}/terima', [TransaksiController::class, 'terima'])
            ->name('transaksi.terima');

        Route::patch('/transaksi/{rental}/tolak', [TransaksiController::class, 'tolak'])
            ->name('transaksi.tolak');

        Route::patch('/transaksi/{rental}/serahkan', [TransaksiController::class, 'serahkan'])
            ->name('transaksi.serahkan');

        Route::patch('/transaksi/{rental}/kembalikan', [TransaksiController::class, 'kembalikan'])
            ->name('transaksi.kembalikan');

        Route::patch('/transaksi/{rental}/pembayaran-tambahan', [
            TransaksiController::class,
            'konfirmasiPembayaranTambahan'
        ])->name('transaksi.pembayaran-tambahan');

        Route::patch(
            '/transaksi/{rental}/batalkan',
            [TransaksiController::class, 'batalkan']
        )->name('transaksi.batalkan');

        // RESCHEDULE
        Route::post('/transaksi/{rental}/reschedule', [TransaksiController::class, 'ajukanReschedule'])
            ->name('transaksi.reschedule');

        Route::patch('/transaksi/{rental}/reschedule/{reschedule}/setujui', [TransaksiController::class, 'setujuiReschedule'])
            ->name('transaksi.reschedule.setujui');

        Route::patch('/transaksi/{rental}/reschedule/{reschedule}/tolak', [TransaksiController::class, 'tolakReschedule'])
            ->name('transaksi.reschedule.tolak');


        // KELOLA BARANG
        Route::resource('/barang', BarangController::class);

        // KELOLA KATEGORI
        Route::resource('/kategori', KategoriController::class)
            ->except(['show']);

        // KELOLA PENGGUNA
        Route::resource('/pengguna', PenggunaController::class)
            ->only(['index', 'show', 'edit', 'update']);

        Route::patch('/pengguna/{id}/status', [PenggunaController::class, 'updateStatus'])
            ->name('pengguna.status');

        // LAPORAN
        Route::get('/laporan/export-pdf', [LaporanController::class, 'exportPdf'])
            ->name('laporan.export-pdf');

        Route::get('/laporan', [LaporanController::class, 'index'])
            ->name('laporan.index');
    });

// KHUSUS USER
Route::middleware(['auth', 'role:user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {

        Route::get('/dashboard', [UserDashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/rentals', function (Request $request) {
            $rentals = Rental::with([
                'details.barang',
                'reschedules.pengaju',
                'reschedules.peninjau',
            ])
                ->where('user_id', $request->user()->id)
                ->latest()
                ->get();

            return view('user.rentals', compact('rentals'));
        })->name('rentals');

        Route::get('/transactions', function () {
            return view('user.transactions');
        })->name('transactions');

        Route::get('/profile', function () {
            return view('user.profile');
        })->name('profile');

        Route::put('/profile', function (Request $request) {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
            ]);

            $user = $request->user();
            $user->name = $validated['name'];
            $user->save();

            return redirect()->route('user.profile')
                ->with('success', 'Profil berhasil diperbarui.');
        })->name('profile.update');

        Route::get('/help', function () {
            return view('user.help');
        })->name('help');

        Route::put('/profile', [ProfileController::class, 'update'])
            ->name('profile.update');

        Route::put('/profile/password', [ProfileController::class, 'updatePassword'])
            ->name('profile.password.update');

        // PERSETUJUAN PERUBAHAN JADWAL RENTAL
        Route::patch(
            '/rentals/{rental}/reschedule/{reschedule}/setujui',
            [RescheduleController::class, 'setujui']
        )->name('rentals.reschedule.setujui');

        Route::patch(
            '/rentals/{rental}/reschedule/{reschedule}/tolak',
            [RescheduleController::class, 'tolak']
        )->name('rentals.reschedule.tolak');
    });
