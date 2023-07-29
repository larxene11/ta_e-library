<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use App\Models\Pinjaman;
use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        $books = Book::orderBy('created_at', 'desc')->take(4)->get(); //pengambilan data buku yang baru ditambahkan
        
        //pengambilan data buku yang sering di pinjam
        $mostFrequentlyBorrowedBooks = Book::select('books.judul', 'books.kode_buku', DB::raw('COUNT(pinjamen.id) as borrow_count'))
        ->join('pinjamen', 'pinjamen.kode_buku', '=', 'books.kode_buku')
        ->groupBy('books.judul', 'books.kode_buku')
        ->orderByDesc('borrow_count')
        ->limit(4)
        ->get();

        //pengambilan data user yang sering meminjam
        $mostFrequentBorrowers = User::select('users.nis_nip', 'users.name', DB::raw('COUNT(pinjamen.id) as borrow_count'))
        ->join('pinjamen', 'pinjamen.nis', '=', 'users.nis_nip')
        ->groupBy('users.nis_nip', 'users.name')
        ->orderByDesc('borrow_count')
        ->limit(4)
        ->with('images') // Load relasi images untuk mencegah N + 1 query
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
            'user' => $user->where('nis_nip', auth()->user()->nis_nip)->first(),
            'title' => 'Profile | E-Library SMANDUTA',
        ];
        return view('frontpage.profile.my-account', $data);
    }

    public function showLoanHistory()
    {
        $userId = Auth::user()->nis_nip;
        $loanHistory = Pinjaman::where('nis', $userId)
        ->where('status_pengembalian','belum')->get();

        $data = [
            'user' => $userId,
            'loanHistory' => $loanHistory ,
            'title' => 'Loan History | E-Library SMANDUTA',
        ];
        return view('frontpage.pinjaman.riwayat-pinjaman', $data);
    }
    
    public function patchProfile(Request $request, User $user)
    {
        // dd($request->image);
        if ($request->email != $user->email) {
            if (User::where('email', $user->email)->whereNot('nis_nip', $user->nis_nip)->count()) {
                return redirect()->back()->withInput()->with('error', 'This Email Has Been Used, Please Input Another Email');
            } else {
                $email_validator = Validator::make($request->all(), [
                    'email' => 'required|unique:users,email|email:dns',
                ]);

                if ($email_validator->fails()) {
                    return redirect()->back()->withErrors($email_validator)->withInput()->with('error', 'OPPS! <br> An Error Occurred During Updating!');
                }

                $validated_email = $email_validator->validate();
                $user->update(['email' => $validated_email['email']]);
            }
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'nis_nip' => 'required|integer',
            'alamat' => 'required|string',
            'tlp' => 'required|numeric',
            'jurusan_jabatan' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'OPPS! <br> ada yang salah dalam melakukan update');
        }
        $validated = $validator->validate();

        $new_image = request()->file('image');
        // Proses upload gambar jika ada
        if ($request->hasFile('image')) {
            if ($user->images) {
                $user->images()->delete();
                Storage::delete($user->images);
            }
            $uploaded = Image::uploadImage($new_image);
                Image::create([
                    'thumb' => 'thumbnails/' . $uploaded['thumb']->basename,
                    'src' => 'images/' . $uploaded['src']->basename,
                    'alt' => Image::getAlt($new_image),
                    'imageable_id' => $user->nis_nip,
                    'imageable_type' => "App\Models\User"
                ]);
        }
        $updated_profile = $user->update([
            'name' => $validated['name'],
            'nis_nip' => $validated['nis_nip'],
            'tlp' => $validated['tlp'],
            'alamat' => $validated['alamat'],
            'jurusan_jabatan' => $validated['jurusan_jabatan'],
        ]);
        if ($updated_profile) {
            return redirect()->route('my-account', ['user' => auth()->user()])->with('success', 'Your Account Successfully Updated');
        }
        redirect()->route('my-account')->with('error', 'Update Proccess Failed! <br> Please Try Again Later!');
    }

}
