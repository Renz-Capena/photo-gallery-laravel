@extends('layouts.main')

@section('title')
    Home
@endsection

@section('container')
    {{-- add photos modal --}}
    <div class="modal fade" id="addPhotosModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Photos</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <label class="mb-1">Upload Photos</label>
                        <input type="file" class="form-control" id="photosUploadInput" accept="image/*">
                    </div>
                    <div class="mt-5">
                        <p class="mb-1">Categories :</p>
                        <div class="my-2" id="categoriesMainContainer">
                            {{-- category --}}
                        </div>
                        <div id="addCategoriesContainer" style="display: none;">
                            <div class="d-flex">
                                <input type="text" class="form-control w-50" id="inputCategories">
                                <button class="btn btn-sm btn-primary ms-3" id="addCategoriesBtnDb"><i
                                        class="fa-solid fa-plus"></i> Add</button>
                                <button class="btn btn-sm btn-danger ms-1" id="closeAddCategoriesBtn"><i
                                        class="fa-solid fa-x"></i></button>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-sm" id="showAddCategoriesBtn"><i class="fa-solid fa-plus"></i>
                            Add More</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="savePhotosDb">Save</button>
                </div>
            </div>
        </div>
    </div>

    {{-- commentModal --}}
    <div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Comments</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="w-50 text-center mx-auto">
                        <img src="" alt="" id="commmentsPhoto" style="width:90%">
                    </div>
                    <div class="text-secondary">
                        <p><b>Comments : </b></p>
                    </div>
                    <div class="mt-4" id="commentsParentContainer">
                        {{-- comments here --}}
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="d-flex align-items-center justify-content-between w-100">
                        {{-- hidden photo id --}}
                        <input type="hidden" id="commentPhotoParentId">

                        <input type="text" class="form-control w-75" id="commentInput">
                        <button class="btn btn-sm btn-outline-primary" id="commentBtnDb">Comment</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="border p-3 mt-5 d-md-flex text-center align-items-center justify-content-between rounded">
        <p class="p-0 m-0"><b><i>Welcome {{ Auth::user()->name }}!</i></b></p>
        <a href="{{ route('logOutFn') }}" class="btn btn-sm btn-danger"><i class="fa-solid fa-right-from-bracket"></i>
            Logout</a>
    </div>

    <div class="text-center mt-5">
        <button class="btn btn-outline-primary btn-sm" id="showAddImgModal"><i class="fa-solid fa-plus"></i> Add
            Picture</button>
    </div>

    <div class="d-flex align-items-center justify-content-center justify-content-md-start mt-3">
        <p class="p-0 m-0 me-3">Filter : </p>
        <select class="form-control w-25" id="filterDropDown">
            {{-- filter --}}
        </select>
    </div>

    <div class="row mt-5 " id="photoGalleryContainer">
        <div class="text-center">Loading...</div>
    </div>
@endsection

@section('scripts')
    <script>
        // load all categories in modal
        function loadCategories() {

            $.ajax({
                url: "{{ route('fetchAllCategoriesFn') }}",
                method: "get",
                success(e) {
                    // console.log(e)
                    $("#categoriesMainContainer").html(e)
                }
            })

        }

        // load all photos
        function loadAllPhotos(filterData = 0) {

            const filter = filterData

            $.ajax({
                url: "{{ route('fetchAllPhoto') }}",
                method: "get",
                data: {
                    filter
                },
                success(e) {
                    // console.log(e)
                    $("#photoGalleryContainer").html(e)
                }
            })

        }

        // load categories
        function loadAllCategories() {

            $.ajax({
                url: "{{ route('fetchAllCategoryFilterFn') }}",
                method: "get",
                success(e) {
                    $("#filterDropDown").html(e)
                }
            })

        }

        function loadComments(parentId) {

            $.ajax({
                url: "{{ route('fetchCommentsFn') }}",
                method: "post",
                data:{
                    parentId,
                    _token:"{{ csrf_token() }}"
                },
                success(e) {
                    $("#commentsParentContainer").html(e)
                }
            })

        }

        $(function() {

            // initial functions to load data
            loadAllPhotos()
            loadAllCategories()

            // show add photos modal
            $("#showAddImgModal").click(function() {

                $("#addPhotosModal").modal('show')

                loadCategories();

            })

            // show categories
            $(document).on("click", "#showAddCategoriesBtn", function() {

                $("#inputCategories").val('')

                $("#addCategoriesContainer").show()

                $("#showAddCategoriesBtn").hide()

            })

            // hide categories
            $("#closeAddCategoriesBtn").click(function() {

                $("#inputCategories").val('')

                $("#addCategoriesContainer").hide()

                $("#showAddCategoriesBtn").show()

            })

            // add categories Db
            $("#addCategoriesBtnDb").click(function() {

                const categories = $("#inputCategories").val()

                if (categories) {

                    $.ajax({
                        url: "{{ route('addCategoryFn') }}",
                        method: "post",
                        data: {
                            _token: "{{ csrf_token() }}",
                            categories
                        },
                        success(e) {
                            // console.log(e)

                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                text: "Add Success!",
                                showConfirmButton: false,
                                timer: 1500
                            });

                            $("#inputCategories").val('')

                            $("#addCategoriesContainer").hide()

                            $("#showAddCategoriesBtn").show()

                            loadCategories();

                            loadAllCategories()
                        }
                    })

                } else {
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        text: "Category input required",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }

            })

            // upload photo
            $("#savePhotosDb").click(function() {

                const data = new FormData();

                const file = $("#photosUploadInput")[0].files[0]

                const category = $(".photoCategoryCheckBox:checked").map(function() {
                    return this.value
                }).get()

                data.append('file', file)
                data.append("_token", "{{ csrf_token() }}")
                data.append('category', category)



                if (file && category.length) {

                    $.ajax({
                        url: "{{ route('addPhotosFn') }}",
                        method: "post",
                        processData: false,
                        contentType: false,
                        data: data,
                        success(e) {
                            console.log(e)

                            $("#photosUploadInput").val('')

                            $("#addPhotosModal").modal('hide')

                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                text: "Upload Photo success!",
                                showConfirmButton: false,
                                timer: 1500
                            });

                            $("#filterDropDown").val(0)

                            loadAllPhotos()


                        }
                    })
                } else {

                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        text: "Please upload photos and select category",
                        showConfirmButton: false,
                        timer: 1500
                    });

                }

            })

            // filter
            $("#filterDropDown").change(function() {

                const filter = $(this).val()

                loadAllPhotos(filter)
            })

            // show comments
            $(document).on("click", "#showCommentBtn", function() {

                const id = $(this).data("id")
                const img = $(this).data("img")

                $("#commentModal").modal('show')

                $("#commmentsPhoto").attr('src', img)
                $("#commentPhotoParentId").val(id)

                loadComments(id)
            })

            // comment btn
            $("#commentBtnDb").click(function() {

                const parentId = $("#commentPhotoParentId").val()
                const comment = $("#commentInput").val()

                if (comment) {

                    $.ajax({
                        url: "{{ route('addCommentsFn') }}",
                        method: "post",
                        data: {
                            parentId,
                            comment,
                            _token: "{{ csrf_token() }}"
                        },
                        success(e) {

                            $("#commentInput").val('')

                            loadComments(parentId)

                        }
                    })

                } else {

                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        text: "Comment field is required!",
                        showConfirmButton: false,
                        timer: 1500
                    });

                }

            })

        })
    </script>
@endsection
