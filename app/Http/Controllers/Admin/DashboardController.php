<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\Loan;
use App\Models\Review;
use App\Models\User;
use App\Models\Petugas;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'countBooks' => Book::count(),
            'countCategories' => Category::count(),
            'countUsers' => User::count(),
            'countPetugas' => Petugas::count(),
            'countBorrowed' => Loan::where('status','borrowed')->count(),
            'countReturned' => Loan::where('status','returned')->count(),
            'countReviews' => Review::count(),
        ]);
    }
}
