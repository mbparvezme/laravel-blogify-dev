<div>
    <h1>{{ $category ? 'Edit Category' : 'Create New Category' }}</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ $category ? route('blogify.admin.categories.update', $category) : route('blogify.admin.categories.store') }}" method="POST">
        @csrf
        @if($category)
            @method('PUT')
        @endif

        <div>
            <label for="name">Category Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $category?->name) }}">
        </div>

        <br>

        <button type="submit">{{ $category ? 'Update Category' : 'Save Category' }}</button>
    </form>
</div>