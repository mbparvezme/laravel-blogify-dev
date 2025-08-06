<div>
    <h1>Tags</h1>
    <hr>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tags as $tag)
                <tr>
                    <td>{{ $tag->name }}</td>
                    <td>
                        {{-- The developer must create their own edit route that uses the tag-form component --}}
                        <a href="#">Edit</a>

                        <form action="{{ route('blogify.admin.tags.destroy', $tag) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">No tags found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>