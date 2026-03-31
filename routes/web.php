<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetugasAuthController;
use App\Http\Controllers\User\BookController;
use App\Http\Controllers\User\LoanController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\PetugasController as AdminPetugasController;
use App\Http\Controllers\Admin\LoanController as AdminLoanController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\User\BorrowController;



Route::get('/', fn() => view('landing'))->name('landing');

Route::prefix('admin')->group(function () {
    Route::get('/', fn () => view('admin.dashboard'))->name('admin.dashboard');
});

use App\Http\Controllers\Petugas\DashboardController as PetugasDashboardController;
use App\Http\Controllers\Petugas\BookController as PetugasBookController;
use App\Http\Controllers\Petugas\LoanController as PetugasLoanController;
use App\Http\Controllers\Petugas\ReportController as PetugasReportController;

Route::prefix('petugas')->group(function () {
    Route::get('/', fn () => redirect()->route('petugas.login'));

    Route::get('/login', [PetugasAuthController::class, 'showLogin'])->name('petugas.login');
    Route::post('/login', [PetugasAuthController::class, 'login'])->name('petugas.login.submit');

    Route::middleware('petugas.auth')->name('petugas.')->group(function () {
        Route::get('/dashboard', [PetugasDashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [PetugasAuthController::class, 'logout'])->name('logout');

        Route::resource('books', PetugasBookController::class);
        Route::get('loans', [PetugasLoanController::class, 'index'])->name('loans.index');
        Route::post('loans/{loan}/approve-borrow', [PetugasLoanController::class, 'approveBorrow'])->name('loans.approve-borrow');
        Route::post('loans/{loan}/reject-borrow', [PetugasLoanController::class, 'rejectBorrow'])->name('loans.reject-borrow');
        Route::get('returns', [PetugasLoanController::class, 'returns'])->name('returns.index');
        Route::post('returns/{loan}/approve-return', [PetugasLoanController::class, 'approveReturn'])->name('returns.approve-return');
        Route::post('returns/{loan}/reject-return', [PetugasLoanController::class, 'rejectReturn'])->name('returns.reject-return');
        Route::get('reports', [PetugasReportController::class, 'index'])->name('reports.index');
        Route::get('reports/pdf', [PetugasReportController::class, 'pdf'])->name('reports.pdf');
    });
});

require __DIR__.'/auth.php';


Route::middleware(['auth'])->group(function () {
    // dashboard user: daftar buku + tombol pinjam
    Route::get('/dashboard', [BookController::class, 'index'])->name('dashboard');

    // peminjaman
    Route::post('/books/{book}/borrow', [LoanController::class, 'borrow'])->name('books.borrow');
    Route::post('/loans/{loan}/return', [LoanController::class, 'return'])->name('loans.return');

    // ulasan (hanya jika user pernah pinjam)
    Route::get('/books/{book}/review', [ReviewController::class, 'create'])->name('books.review.create');
    Route::post('/books/{book}/review', [ReviewController::class, 'store'])->name('books.review.store');

    // riwayat
    Route::get('/history/borrows', [LoanController::class, 'historyBorrows'])->name('history.borrows');
    Route::get('/history/returns', [LoanController::class, 'historyReturns'])->name('history.returns');

    Route::get('/books/{book}/borrow', [BorrowController::class, 'create'])->name('books.borrow.create');
    Route::post('/books/{book}/borrow', [BorrowController::class, 'store'])->name('books.borrow.store');

    Route::get('/loans/{loan}/receipt', [\App\Http\Controllers\User\LoanController::class, 'receipt'])
    ->name('loans.receipt');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});

    Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('books', AdminBookController::class);
    Route::resource('categories', AdminCategoryController::class);

    Route::get('users', [AdminUserController::class, 'index'])->name('users.index');
    Route::delete('users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');

    Route::resource('petugas', AdminPetugasController::class);

    Route::get('loans', [AdminLoanController::class, 'index'])->name('loans.index');
    Route::post('loans/{loan}/approve-borrow', [AdminLoanController::class, 'approveBorrow'])->name('loans.approve-borrow');
    Route::post('loans/{loan}/reject-borrow', [AdminLoanController::class, 'rejectBorrow'])->name('loans.reject-borrow');
    Route::get('returns', [AdminLoanController::class, 'returns'])->name('returns.index');
    Route::post('returns/{loan}/approve-return', [AdminLoanController::class, 'approveReturn'])->name('returns.approve-return');
    Route::post('returns/{loan}/reject-return', [AdminLoanController::class, 'rejectReturn'])->name('returns.reject-return');

    Route::get('reviews', [AdminReviewController::class, 'index'])->name('reviews.index');

    Route::get('reports', [AdminReportController::class, 'index'])->name('reports.index');

    Route::get('reports/pdf', [AdminReportController::class, 'pdf'])->name('reports.pdf');

});
