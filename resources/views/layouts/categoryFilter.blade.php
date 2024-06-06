<option value="0">All</option>
@foreach ($categories as $category)
    <option value="{{ $category->id }}">{{ $category->category }}</option>
@endforeach
