<nav class="side-nav">
    <ul>
        <li>
            <a href="javascript:;.html" class="side-menu side-menu--active">
                <div class="side-menu__icon"> <i data-lucide="home"></i> </div>
                <div class="side-menu__title">
                    Dashboard
                    <div class="side-menu__sub-icon transform rotate-180"> <i data-lucide="chevron-down"></i>
                    </div>
                </div>
            </a>
            <ul class="side-menu__sub-open">
                <li>
                    <a href="{{ route('dashboard') }}" class="side-menu side-menu--active">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> Overview </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="side-menu">
                <div class="side-menu__icon"> <i data-lucide="box"></i> </div>
                <div class="side-menu__title">
                    Menu Option
                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                </div>
            </a>
            <ul class="">
                @if (auth()->user()->level === 'admin')
                    <li>
                        <a href="{{ route('manage_book.all') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="book"></i> </div>
                            <div class="side-menu__title"> Buku </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('manage_siswa.all') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="user"></i> </div>
                            <div class="side-menu__title"> Siswa </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('manage_pegawai.all') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="user"></i> </div>
                            <div class="side-menu__title"> Pegawai </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('manage_category.all') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="list"></i> </div>
                            <div class="side-menu__title"> Kategori Buku </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('manage_pinjaman.all') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="book-open"></i> </div>
                            <div class="side-menu__title"> Pinjaman </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('manage_kunjungan.all') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="monitor"></i> </div>
                            <div class="side-menu__title"> Kunjungan </div>
                        </a>
                    </li>
                @else
                    <li>
                        <a href="{{ route('manage_book.all') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="book"></i> </div>
                            <div class="side-menu__title"> Buku </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('manage_siswa.all') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="user"></i> </div>
                            <div class="side-menu__title"> Siswa </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('manage_category.all') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="list"></i> </div>
                            <div class="side-menu__title"> Kategori Buku </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('manage_pinjaman.all') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="book-open"></i> </div>
                            <div class="side-menu__title"> Pinjaman </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('manage_kunjungan.all') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="monitor"></i> </div>
                            <div class="side-menu__title"> Kunjungan </div>
                        </a>
                    </li>
                @endif
            </ul>
        </li>
    </ul>
</nav>
