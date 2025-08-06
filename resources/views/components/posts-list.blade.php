<div>
    <h1>Posts</h1>
    <hr>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->author->name ?? 'N/A' }}</td>
                    <td>{{ ucfirst($post->status) }}</td>
                    <td>
                        {{-- The developer will need to create their own edit route --}}
                        <a href="#">Edit</a>

                        {{-- Add the delete form --}}
                        <form action="{{ route('blogify.admin.posts.destroy', $post) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No posts found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>