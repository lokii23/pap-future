<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Facebook Posts</title>
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
        <div class="max-w-7xl mx-auto">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Facebook Posts</h1>

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Add Post Form -->
            <form action="{{ route('facebook-posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 mb-10 bg-white p-6 rounded shadow">
                @csrf
                <div>
                    <label class="block text-gray-700 font-medium">Title</label>
                    <input type="text" name="title" required class="w-full mt-1 px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-gray-700 font-medium">Author</label>
                        <input type="text" name="author" class="w-full mt-1 px-3 py-2 border rounded-md">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium">Category</label>
                        <input type="text" name="category" class="w-full mt-1 px-3 py-2 border rounded-md">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium">Posted At</label>
                        <input type="date" name="posted_at" class="w-full mt-1 px-3 py-2 border rounded-md">
                    </div>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium">Description</label>
                    <textarea name="description" rows="4" required class="w-full mt-1 px-3 py-2 border rounded-md"></textarea>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium">Image</label>
                    <input type="file" name="image" class="w-full mt-1">
                </div>

                <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-500">Add Post</button>
            </form>

            <!-- List of Posts -->
            <div class="grid md:grid-cols-3 gap-6">
                @foreach($posts as $post)
                    <div class="bg-white rounded-lg shadow overflow-hidden flex flex-col">
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="h-48 w-full object-cover">
                        @endif
                        <div class="p-4 flex-1 flex flex-col">
                            <h3 class="text-lg font-semibold text-gray-800">{{ $post->title }}</h3>
                            <p class="text-sm text-gray-500 mb-2">{{ $post->author }} / {{ $post->category }}<br>
                                {{ \Carbon\Carbon::parse($post->posted_at)->format('M d, Y') }}
                            </p>
                            <p class="text-gray-700 flex-1">{{ $post->description }}</p>
                            <form action="{{ route('facebook-posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Delete this post?')" class="mt-4">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 text-white px-3 py-1 text-sm rounded hover:bg-red-400">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>

</body>
</html>
