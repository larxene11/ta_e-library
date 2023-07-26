<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    public function allBook()
    {
        $data = [
            'title' => 'Buku | E-Library SMANDUTA',
            'books' => Book::latest()->filter(request(['category', 'search']))->paginate(10)->withQueryString(),
            'categories' => Category::latest()->get(),
        ];
        return view('admin.buku.buku-all', $data);
    }

    public function createBook()
    {
        $data = [
            'title' => 'Tambah Data Buku | E-Library SMANDUTA',
            'categories' => Category::latest()->get(),
        ];
        return view('admin.buku.buku-add', $data);
    }

    public function detailBook(Book $book)
    {
        $data = [
            'title' => 'Detail Buku | E-Library SMANDUTA',
            'book' => $book
        ];
        return view('admin.buku.buku-detail', $data);
    }
    public function updateBook(Book $book)
    {
        $data = [
            'title' => 'Edit Data Buku | E-Library SMANDUTA',
            'book' => $book,
            'categories' => Category::latest()->get(),
        ];
        return view('admin.buku.buku-edit', $data);
    }
    public function storeBook(Request $request)
    {
        // dd($request->toArray());
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string',
            'kode_buku' => 'required|string|unique:books,kode_buku',
            'category_id' => 'required|numeric',
            'pengarang' => 'required|string',
            'penerbit' => 'required|string',
            'dana' => 'required|string',
            'tahun' => 'required|numeric',
            'tahun_terbit' => 'required|numeric',
            'no_rak' => 'required|numeric',
            'description' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Input Failed!<br>Please Try Again With Correct Input');
        }
        $validated = $validator->validated();
        $created_book = Book::create([
            'judul' => $validated['judul'],
            'kode_buku' => $validated['kode_buku'],
            'category_id' => $validated['category_id'] == 0 ? NULL : $validated['category_id'],
            'pengarang' => $validated['pengarang'],
            'penerbit' => $validated['penerbit'],
            'dana' => $validated['dana'],
            'tahun' => $validated['tahun'],
            'tahun_terbit' => $validated['tahun_terbit'],
            'no_rak' => $validated['no_rak'],
            'description' => $validated['description'],
        ]);
        if ($created_book) {
            return redirect()->route('manage_book.all')->with('success', 'New Book Successfully Added');
        }
        return redirect()->back()->with('error', 'Error Occured, Please Try Again');
    }

    public function patchBook(Book $book, Request $request)
    {
        if ($request->kode_buku != $book->kode_buku) {
            if (Book::where('kode_buku', $book->kode_buku)->whereNot('kode_buku', $book->kode_buku)->count()) {
                return redirect()->back()->withInput()->with('error', 'This book has been registered, please input another book');
            } else {
                $code_validator = Validator::make($request->all(), [
                    'kode_buku' => 'required|string|unique:books,kode_buku',
                ]);

                if ($code_validator->fails()) {
                    return redirect()->back()->withErrors($code_validator)->withInput()->with('error', 'OPPS! <br> An Error Occurred During Updating!');
                }

                $validated_code = $code_validator->validate();
                $book->update(['kode_buku' => $validated_code['kode_buku']]);
            }
        }
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string',
            'category_id' => 'required|numeric',
            'pengarang' => 'required|string',
            'penerbit' => 'required|string',
            'dana' => 'required|string',
            'tahun' => 'required|numeric',
            'tahun_terbit' => 'required|numeric',
            'no_rak' => 'required|numeric',
            'description' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Input Failed!<br>Please Try Again With Correct Input');
        }
        $validated = $validator->validated();
        $book->touch();
        $updated_book = $book->update([
            'judul' => $validated['judul'],
            'category_id' => $validated['category_id'] == 0 ? NULL : $validated['category_id'],
            'pengarang' => $validated['pengarang'],
            'penerbit' => $validated['penerbit'],
            'dana' => $validated['dana'],
            'tahun' => $validated['tahun'],
            'tahun_terbit' => $validated['tahun_terbit'],
            'no_rak' => $validated['no_rak'],
            // 'description' => $validated['description'],
        ]);
        if ($updated_book) {
            return redirect()->route('manage_book.all')->with('success', 'Data Buku berhasil di edit');
        }
        return redirect()->back()->with('error', 'Error Occured, Please Try Again');
    }
    public function deleteBook(Book $book)
    {
        if ($book->delete()) {
            return redirect()->route('manage_book.all')->with('success', 'Data Buku Berhasil di Hapus');
        }
        return redirect()->back()->with('error', 'Error Occured, Please Try Again!');
    }
}
