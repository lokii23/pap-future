<div class="space-y-6 bg-white p-6 rounded-lg shadow-lg max-w-2xl mx-auto">

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
        <input type="text" name="name" value="{{ old('name', $testimonial->name ?? '') }}"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
            required>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Position</label>
        <input type="text" name="position" value="{{ old('position', $testimonial->position ?? '') }}"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
            required>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Message</label>
        <textarea name="message" rows="4"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
            required>{{ old('message', $testimonial->message ?? '') }}</textarea>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Photo</label>
        <input type="file" name="image"
            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                   file:rounded-full file:border-0 file:text-sm file:font-semibold
                   file:bg-green-50 file:text-green-700 hover:file:bg-green-100">

        @if(!empty($testimonial->image))
            <img src="{{ asset('storage/' . $testimonial->image) }}" alt="Testimonial Image"
                 class="mt-3 w-24 h-24 object-cover rounded shadow">
        @endif
    </div>

    <div>
        <button type="submit"
            class="w-full bg-green-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-green-700 transition">
            {{ $button }}
        </button>
    </div>

</div>
