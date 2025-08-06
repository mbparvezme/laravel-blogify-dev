<div>
    <h1>{{ $post ? 'Edit Post' : 'Create New Post' }}</h1>

    {{-- ... error display ... --}}

    <form action="{{ $post ? route('blogify.admin.posts.update', $post) : route('blogify.admin.posts.store') }}" method="POST">
        @csrf
        @if($post)
            @method('PUT')
        @endif

        {{-- ... Title and Content fields ... --}}

        <br>

        {{-- Category Select --}}
        <div>
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id">
                <option value="">Select a category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id', $post?->category_id) == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <br>

        {{-- Tags Multi-Select --}}
        <div>
            <label for="tags">Tags</label>
            <select name="tags[]" id="tags" multiple size="5">
                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}" @selected(in_array($tag->id, old('tags', $post?->tags->pluck('id')->toArray() ?? [])))>
                        {{ $tag->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <br>

        <button type="submit">{{ $post ? 'Update Post' : 'Save Post' }}</button>
    </form>
</div>