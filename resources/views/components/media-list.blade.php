<div>
    <h1>Media Library</h1>
    <hr>

    {{-- Upload Form --}}
    <h3>Upload New Media</h3>
    <form action="{{ route('blogify.admin.media.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" required>
        <button type="submit">Upload</button>
    </form>

    <hr>

    {{-- Media Grid --}}
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 1rem;">
        @forelse ($media as $item)
            <div style="border: 1px solid #ccc; padding: 0.5rem; text-align: center;">
                <img src="{{ asset('storage/' . $item->directory . '/' . $item->filename) }}" alt="{{ $item->original_filename }}" style="max-width: 100%; height: auto;">
                <form action="{{ route('blogify.admin.media.destroy', $item) }}" method="POST" style="margin-top: 0.5rem;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </div>
        @empty
            <p>No media found.</p>
        @endforelse
    </div>
</div>