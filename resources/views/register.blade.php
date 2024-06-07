@extends('layouts.main')

@section('title')
    Register
@endsection

@section('container')
    <form class="w-50 card mt-5 mx-auto p-3 rounded" id="registerForm">
        <h3 class="text-center">PHOTO GALLERY</h3>
        <hr>
        <p class="text-secondary text-center"><i>Fill up the details to create account</i></p>
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Full Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address <span class="text-danger">*</span></label>
            <input type="email" class="form-control" name="email">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password <span class="text-danger">*</span></label>
            <input type="password" class="form-control" name="password">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Confim Password <span class="text-danger">*</span></label>
            <input type="password" class="form-control" name="password_confirmation">
        </div>
        <button type="submit" class="btn btn-primary w-100 my-3">Register</button>
        <a href="{{ route('loginFn') }}" class="btn w-100 mt-3">Login</a>
    </form>

    <div class="text-light mt-5 text-center pb-5" style="position:absolute;left:0;right:0;bottom:0;z-index:2;text-shadow:1px 1px 10px #000">
        <div id="quotesText">Loading..</div>
        <div id="quotesAuthor">Loading..</div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function() {

            $("#registerForm").on("submit", function(e) {
                e.preventDefault()

                const data = $(this).serializeArray()

                $.ajax({
                    url: "{{ route('registerUserFn') }}",
                    method: "post",
                    data: data,
                    success(e) {
                        if (e) {
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                text: 'Create Account success!',
                                showConfirmButton: false,
                                timer: 1500
                            });

                            $("#registerForm")[0].reset()
                        }
                    },
                    error({
                        responseJSON: {
                            message
                        }
                    }) {
                        Swal.fire({
                            position: "top-end",
                            icon: "error",
                            text: message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                })
            })

        })
    </script>
@endsection
