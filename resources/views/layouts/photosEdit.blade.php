
@if (COUNT($categories))

    @php
        $categoriesarr = $photoCategoryFinal
    @endphp

    @foreach ($categories as $category)
    

        <div>
            <input type="checkbox" value="{{ $category->id }}" class="photoCategoryCheckBoxEdit" {{ in_array($category->id,$categoriesarr) ? 'checked' : '' }}>
            <label class="ms-2">{{ $category->category }}</label>
        </div>
    @endforeach
    
@else
    <div class="text-secondary">
       No category found please add.
    </div>
@endif
