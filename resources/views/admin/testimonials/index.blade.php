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
            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded text-black hover:bg-gray-200 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-200 font-semibold' : '' }}">
                Dashboard
            </a>
            <a href="{{ route('testimonials.index') }}" class="block px-4 py-2 rounded text-white {{ request()->routeIs('testimonials.index') ? 'bg-red-600 font-semibold' : '' }}">
                Testimonials
            </a>
            <a href="{{ route('facebook-posts.index') }}" class="block px-4 py-2 rounded text-black hover:bg-gray-200 {{ request()->routeIs('facebook-posts.index') ? 'bg-gray-200 font-semibold' : '' }}">
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
        <div class="container mt-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Testimonials</h2><br>
                <a href="{{ route('testimonials.create') }}" class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 transition">Add Testimonial</a>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white shadow rounded-lg overflow-hidden">
                    <thead class="bg-red-600 text-white">
                        <tr>
                            <th class="px-4 py-2 text-left">#</th>
                            <th class="px-4 py-2 text-left">Image</th>
                            <th class="px-4 py-2 text-left">Name</th>
                            <th class="px-4 py-2 text-left">Position</th>
                            <th class="px-4 py-2 text-left">Message</th>
                            <th class="px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @forelse ($testimonials as $testimonial)
                            <tr class="border-b hover:bg-gray-100">
                                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2">
                                    @if($testimonial->image)
                                        <img src="{{ asset('storage/' . $testimonial->image) }}" alt="Testimonial Image" width="60" height="60" class="rounded-circle object-fit-cover">
                                    @else
                                        <span class="text-muted">No image</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2">{{ $testimonial->name }}</td>
                                <td class="px-4 py-2">{{ $testimonial->position }}</td>
                                <td class="px-4 py-2">{{ Str::limit($testimonial->message, 100) }}</td>
                                <td class="px-4 py-2 space-x-2">
                                    <a href="{{ route('testimonials.edit', $testimonial->id) }}" class="bg-yellow-500 text-white px-6 py-1 rounded hover:bg-yellow-600">Edit</a>
                                    <button onclick="openModal({{ $testimonial->id }})" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-500">
                                        Delete
                                    </button>

                                        
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-muted">No testimonials found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    
        <!-- Delete Confirmation Modal -->
        <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
                <h2 class="text-xl font-semibold mb-4 text-gray-800">Delete Confirmation</h2>
                <p class="text-gray-600 mb-6">Are you sure you want to delete this testimonial?</p>

                <form id="deleteForm" method="POST" action="{{ route('testimonials.destroy', $testimonial->id) }}" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <div class="flex justify-end space-x-4">
                        <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    <script>
        function openModal(id) {
            const form = document.getElementById('deleteForm');
            form.action = `/admin/testimonials/${id}`;
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteModal').classList.add('flex');
        }
    
        function closeModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            document.getElementById('deleteModal').classList.remove('flex');
        }
    </script>
</body>
</html>
