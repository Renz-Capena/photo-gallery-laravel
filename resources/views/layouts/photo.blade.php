@if (COUNT($photos))

    @foreach ($photos as $photo)

        @php
            $photoParentId = $photo->id;

            $categories = App\Models\PhotoCategory::leftJoin('categories','categories.id','photo_categories.category')
            ->where('photo_categories.photo_id',$photoParentId)->get();

        @endphp

        <div class="col-12 col-md-3 shadow p-5 p-3 text-center">
            <img src="uploads/{{$photo->system_name}}" alt="" class="img-fluid" style="height: 200px">
            <div class="my-3">
                <label for="">Categories :</label>
                <div class="row my-4">
                    @foreach ($categories as $category)
                        <div class="col-4">
                            <div class="bg-secondary text-light rounded-pill">
                                {{ $category->category }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-between mt-2">
                <button class="btn btn-outline-primary w-25"><i class="fa-regular fa-thumbs-up"></i> {{ $photoParentId }}</button>
                <button class="btn btn-outline-primary w-25" id="showCommentBtn" data-id="{{ $photoParentId }}" data-img="uploads/{{$photo->system_name}}"><i class="fa-regular fa-message"></i></button>
            </div>
        </div>
    @endforeach
    
@else
    <div class="col-12 text-center text-secondary">No data found</div>
@endif

