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
    public function main()
    {
        $books = Book::all();
        $data = [
            'title' => 'Homepage | E-Library SMANDUTA',
            'books' => $books,
            // 'best_deals' => Product::bestDeal($books)->all(),
            // 'best_sellers' => Product::bestSeller($books),
            'categories' => collect(Category::get()->each(function ($item) {
                $item->product_count = $item->books->count();
            })->sortByDesc('product_count')->values()->all()),
        ];
        return view('frontpage.main.main', $data);
    }
    public function category(Category $category)
    {
        $data = [
            'title' => 'Category | E-Library SMANDUTA',
            'books' => $category->books,
            'name' => $category->name,
            'categories' => Category::get(),
        ];
        return view('frontpage.category.category', $data);
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
