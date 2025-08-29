<header x-data="{ mobileMenuOpen: false }" class="main-header" style="position: sticky; top: 0; z-index: 1000; background: white;">
    <div class="container main-nav">
        <a href="{{ auth()->check() ? route('dashboard') : route('home') }}" class="logo">NikahYuk</a>
        
        <div class="hidden md:flex auth-links flex items-center">
            @auth
                <a href="{{ route('home') }}" class="{{ request()->is('/') ? 'active' : '' }}">Beranda</a>
                <a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">Dasbor</a>
                <a href="{{ route('invitation.index') }}" class="{{ request()->is('invitations*') ? 'active' : '' }}">Undangan Saya</a>

                <div x-data="{ open: false }" @click.outside="open = false" class="relative ml-4">
                    <button @click="open = !open" class="flex items-center space-x-1 focus:outline-none">
                        <span>{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open" x-transition x-cloak class="dropdown-content absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1">
                        <a href="{{ route('profile.edit') }}" class="dropdown-item">Profil</a>
                        @if(auth()->user()->isAdmin())
                            <div class="border-t border-gray-100"></div>
                            <a href="{{ route('orders.index') }}" class="dropdown-item">Kelola Pesanan</a> {{-- <-- TAMBAHKAN INI --}}

                            <a href="{{ route('templates.index') }}" class="dropdown-item">Kelola Template</a>
                            <a href="{{ route('packages.index') }}" class="dropdown-item">Kelola Paket</a>
                        @endif
                        <div class="border-t border-gray-100"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="dropdown-item">Keluar</a>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="{{ request()->is('login') ? 'active' : '' }}">Log In</a>
                <a href="{{ route('register') }}" class="{{ request()->is('register') ? 'active' : '' }}">Register</a>
            @endauth
        </div>

        <div class="md:hidden">
            <button @click="mobileMenuOpen = !mobileMenuOpen">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
            </button>
        </div>
    </div>

    <div x-show="mobileMenuOpen" x-cloak class="md:hidden bg-white border-t">
        <div class="container py-4 space-y-2">
            @auth
                <div class="border-t pt-4 mt-4">
                    <div class="font-semibold text-gray-800">{{ Auth::user()->name }}</div>
                    <a href="{{ route('profile.edit') }}" class="mobile-nav-link mt-2">Profil</a>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('templates.index') }}" class="mobile-nav-link">Kelola Template</a>
                        <a href="{{ route('packages.index') }}" class="mobile-nav-link">Kelola Paket</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="mobile-nav-link text-red-500">Keluar</a>
                    </form>
                </div>
                <a href="{{ route('home') }}" class="mobile-nav-link">Beranda</a>
                <a href="{{ route('dashboard') }}" class="mobile-nav-link">Dasbor</a>
                <a href="{{ route('invitation.index') }}" class="mobile-nav-link">Undangan Saya</a>
                
            @else
                <a href="{{ route('login') }}" class="mobile-nav-link">Log In</a>
                <a href="{{ route('register') }}" class="mobile-nav-link">Register</a>
            @endauth
        </div>
    </div>
</header>