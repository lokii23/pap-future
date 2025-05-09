<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg p-4 flex flex-col">
        <img src="../../../pap3.png" alt="">
        <br />
        <div class="text-2xl font-bold text-center mb-10 text-red-600">
            SUPER ADMIN PANEL
        </div>
        <nav class="flex-1 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded text-white {{ request()->routeIs('admin.dashboard') ? 'bg-red-600 font-semibold' : '' }}">
                Dashboard
            </a>
            <a href="{{ route('testimonials.index') }}" class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('testimonials.index') ? 'bg-gray-200 font-semibold' : '' }}">
                Testimonials
            </a>
            <a href="{{ route('facebook-posts.index') }}" class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('facebook-posts.index') ? 'bg-gray-200 font-semibold' : '' }}">
                Facebook Posts
            </a>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
               class="block px-4 py-2 rounded hover:bg-gray-200">Logout</a>
    
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
        @yield('content')
        
    </main>

</body>
</html>
