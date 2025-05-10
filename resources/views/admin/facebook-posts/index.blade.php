<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Facebook Posts</title>
    <!-- Favicons -->
    <link href="../../../pap1.png" rel="icon">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg p-4 flex flex-col">
        <img src="../../../pap3.png" alt="">
        <br />
        <div class="text-2xl font-bold text-center mb-10 text-red-600">
            SUPER ADMIN PANEL
        </div>
        <nav class="flex-1 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-200 font-semibold' : '' }}">
                Dashboard
            </a>
            <a href="{{ route('testimonials.index') }}" class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('testimonials.index') ? 'bg-gray-200 font-semibold' : '' }}">
                Testimonials
            </a>
            <a href="{{ route('facebook-posts.index') }}" class="block px-4 py-2 rounded text-white {{ request()->routeIs('facebook-posts.index') ? 'bg-red-600 font-semibold' : '' }}">
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
    <main class="flex-1 p-10 bg-gray-100 overflow-y-auto">
        <div class="container mx-auto">
        <h2 class="text-2xl font-bold mb-4">Facebook Posts</h2>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Add Post Button -->
        <div class="mb-4">
            <a href="{{ route('facebook-posts.create') }}"
            class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Add New Post</a>
        </div>

        <!-- Posts Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="px-4 py-2 text-left">#</th>
                        <th class="py-2 px-4">Image</th>
                        <th class="py-2 px-4">Title</th>
                        <th class="py-2 px-4">Author</th>
                        <th class="py-2 px-4">Category</th>
                        <th class="py-2 px-4">Posted At</th>
                        <th class="py-2 px-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($facebooks as $facebook)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="py-2 px-4">
                                @if($facebook->image)
                                    <img src="{{ asset('storage/' . $facebook->image) }}" alt="Post Image" class="w-16 h-16 object-cover rounded">
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="py-2 px-4">{{ $facebook->title }}</td>
                            <td class="py-2 px-4">{{ $facebook->author }}</td>
                            <td class="py-2 px-4">{{ $facebook->category }}</td>
                            <td class="py-2 px-4">{{ \Carbon\Carbon::parse($facebook->posted_at)->format('M d, Y') }}</td>
                            <td class="py-2 px-4 flex gap-2">
                                <form action="{{ route('facebook-posts.destroy', $facebook) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this post?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-4 px-4 text-center text-gray-500">No posts available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    </main>

</body>
</html>
