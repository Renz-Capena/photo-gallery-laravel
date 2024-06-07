@extends('layouts.main')

@section('title')
    Register
@endsection

@section('container')
    <form class="w-50 shadow mt-5 mx-auto p-3 rounded" id="registerForm">
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
