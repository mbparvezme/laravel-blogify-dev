<div>
    <h1>{{ $tag ? 'Edit Tag' : 'Create New Tag' }}</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ $tag ? route('blogify.admin.tags.update', $tag) : route('blogify.admin.tags.store') }}" method="POST">
        @csrf
        @if($tag)
            @method('PUT')
        @endif

        <div>
            <label for="name">Tag Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $tag?->name) }}">
        </div>

        <br>

        <button type="submit">{{ $tag ? 'Update Tag' : 'Save Tag' }}</button>
    </form>
</div>