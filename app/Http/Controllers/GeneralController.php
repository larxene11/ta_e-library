<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use App\Models\Pinjaman;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GeneralController extends Controller
{
    
    public function katalog()
    {
        $data = [
            'title' => 'Books Catalog | E-Library SMANDUTA',
            'books' => Book::latest()->filter(request(['search']))->get(),
            'category' => Category::latest()->get()
        ];
        return view('frontpage.buku.catalog-book', $data);
    }
    
    public function booksByCategory(Category $category)
    {
        $data = [
            'title' => 'Books Catalog | Bali Tour Driver',
            'books' => $category->books,
            'name' => $category->name,
            'category' => Category::latest()->get()
        ];
        return view('frontpage.buku.catalog-book', $data);
    }

    public function main()
    {
        $books = Book::orderBy('created_at', 'desc')->take(4)->get();
        $mostFrequentlyBorrowedBooks = Book::select('books.judul', 'books.kode_buku', DB::raw('COUNT(pinjamen.id) as borrow_count'))
        ->join('pinjamen', 'pinjamen.kode_buku', '=', 'books.kode_buku')
        ->groupBy('books.judul', 'books.kode_buku')
        ->orderByDesc('borrow_count')
        ->limit(4)
        ->get();
        $mostFrequentBorrowers = User::select(DB::raw('MAX(users.name) as name'), DB::raw('COUNT(pinjamen.id) as borrow_count'))
        ->join('pinjamen', 'pinjamen.nis', '=', 'users.nis_nip')
        ->groupBy('users.nis_nip')
        ->orderByDesc('borrow_count')
        ->limit(4)
        ->get();
        $data = [
            'title' => 'Homepage | E-Library SMANDUTA',
            'category' => Category::get(),
            'books' => $books,
            'mostBorrow' => $mostFrequentlyBorrowedBooks,
            'users' => $mostFrequentBorrowers,
        ];
        return view('frontpage.main.main', $data);
    }

    public function detailBook(Book $books)
    {
        $relatedBooks = Book::where('judul', $books->judul)->where('kode_buku', '!=', $books->kode_buku)->get();
        $data = [
            'title' => 'Detail Books | E-Library SMANDUTA',
            'books' => $books,
            'judul' => $books->judul,
            'relatedBooks' => $relatedBooks,
            'category' => Category::get(),
        ];
        return view('frontpage.buku.book-detail', $data);
    }
    
    public function my_account(User $user)
    {
        $data = [
            'user' => $user->where('id', auth()->user()->id)->first(),
            'title' => 'Profile | E-Library SMANDUTA',
        ];
        return view('frontpage.profile.my-account', $data);
    }
    
}
