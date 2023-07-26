<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use App\Models\Pinjaman;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class GeneralController extends Controller
{
    
    public function katalog()
    {
        $data = [
            'title' => 'Hasil Pencarian | E-Library SMANDUTA',
            'books' => Book::latest()->filter(request(['category', 'search'])),
            'category' => Category::latest()->get()
        ];
        return view('frontpage.buku.catalog-book', $data);
    }
    
    public function booksByCategory($categoryId)
    {
        $data = [
            'title' => 'Books By Category | E-Library SMANDUTA',
            'category' => Category::get(),
            'books' => Book::where('category_id', $categoryId)->get(),
        ];
        return view('frontpage.buku.search-result', $data);
    }

    public function main()
    {
        $books = Book::orderBy('created_at', 'desc')->take(4)->get();
        $data = [
            'title' => 'Homepage | E-Library SMANDUTA',
            'category' => Category::get(),
            'books' => $books,
        ];
        return view('frontpage.main.main', $data);
    }
    
    public function books()
    {
        $data = [
            'title' => 'Books | E-Library SMANDUTA',
            'books' => Book::all(),
            'name' => 'All Books',
            'categories' => Category::first()->get(),
        ];
        return view('frontpage.category.category', $data);
    }

    public function detailBook(Book $books)
    {
        // return dd($product->brand);
        $data = [
            'title' => 'Detail Books | E-Library SMANDUTA',
            'books' => $books,
            // 'books' => Product::latest()->get()->random(Product::all()->count() > 6 ? 6 : Product::all()->count()),
            'categories' => Category::get(),
        ];
        return view('frontpage.buku.buku-detail', $data);
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
