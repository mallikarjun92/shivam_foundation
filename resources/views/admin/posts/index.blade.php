<x-admin-layout title="Posts Management" header="Posts">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Posts</h2>
        <a href="{{ route('admin.posts.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ New Post</a>
    </div>

    <table class="w-full border border-gray-300 bg-white rounded">
        <thead class="bg-gray-200">
            <tr>
                <th class="px-4 py-2 text-left">Title</th>
                <th class="px-4 py-2">Author</th>
                <th class="px-4 py-2">Slug</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $post->title }}</td>
                    <td class="px-4 py-2">{{ $post->author }}</td>
                    <td class="px-4 py-2">{{ $post->slug }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('admin.posts.edit', $post) }}" class="text-blue-600">Edit</a> |
                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Delete this post?')" class="text-red-600">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-4 py-2 text-center text-gray-500">No posts found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $posts->links('pagination::bootstrap-5') }}
    </div>
</x-admin-layout>
