<div>
    <h1>Categories</h1>
    <hr>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>
                        {{-- The developer must create their own edit route that uses the category-form component --}}
                        <a href="#">Edit</a>

                        <form action="{{ route('blogify.admin.categories.destroy', $category) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">No categories found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>