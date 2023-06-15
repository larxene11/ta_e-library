<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewTemplateController extends Controller
{
    public function dashboard()
    {
        $data = [
            'title' => 'Admin | Dashboard',
        ];
        return view('admin.dashboard.index', $data);
    }
    public function login()
    {
        $data = [
            'title' => 'Halaman Login',
        ];
        return view('auth.login', $data);
    }
    public function register()
    {
        $data = [
            'title' => 'Halaman Register',
        ];
        return view('auth.register', $data);
    }

    public function all()
    {
        $data = [
            'title' => 'Data Buku',
        ];
        return view('admin.buku.buku-all', $data);
    }


    
}
