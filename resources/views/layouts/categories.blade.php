
@if (COUNT($categories))

    @foreach ($categories as $category)
        <div>
            <input type="checkbox" value="{{ $category->id }}" class="photoCategoryCheckBox"><label class="ms-2">{{ $category->category }}</label>
        </div>
    @endforeach
    
@else
    <div class="text-secondary">
       No category found please add.
    </div>
@endif
