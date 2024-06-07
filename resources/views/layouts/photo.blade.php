@if (COUNT($photos))

    @foreach ($photos as $photo)

        @php
            $photoParentId = $photo->id;

            $categories = App\Models\PhotoCategory::leftJoin('categories','categories.id','photo_categories.category')
            ->where('photo_categories.photo_id',$photoParentId)
            ->where("photo_categories.status",1)
            ->get();

            // count reactions
            $reactionCounts = App\Models\Reactions::where('photo_id',$photoParentId)->where('status',1)->count()

        @endphp

        <div class="col-12 col-md-3  ">
            <div class="shadow p-3 text-center border">

                <div class="d-flex justify-content-end mb-3" style="height: 33px">
                    @if ($photo->user_id == Auth::user()->id)
                        <button class="btn btn-sm btn-outline-primary me-2" id="editPhotosModalBtn" data-id="{{ $photoParentId }}"><i class="fa-regular fa-pen-to-square"></i></button>
                        <button class="btn btn-sm btn-outline-danger removePhotosDb" data-id="{{ $photoParentId }}"><i class="fa-solid fa-trash"></i></button>
                        @endif
                </div>
                
                <img src="uploads/{{$photo->system_name}}" alt="" class="img-fluid" style="height: 200px">
                <div class="my-3">
                    <label for="">Categories :</label>
                    <div class="row my-4">
                        @foreach ($categories as $category)
                            <div class="col-4 my-1">
                                <div class="bg-secondary text-light rounded-pill">
                                    {{ $category->category }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between mt-2">
                    <button class="btn btn-outline-primary w-25" id="likeBtn" data-id="{{ $photoParentId }}"><i class="fa-regular fa-thumbs-up"></i> {{ $reactionCounts ? $reactionCounts : "" }}</button>
                    <button class="btn btn-outline-primary w-25" id="showCommentBtn" data-id="{{ $photoParentId }}" data-img="uploads/{{$photo->system_name}}"><i class="fa-regular fa-message"></i></button>
                </div>
            </div>
        </div>
    @endforeach
    
@else
    <div class="col-12 text-center text-secondary">No data found</div>
@endif

