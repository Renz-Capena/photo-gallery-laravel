@extends('layouts.main')

@section('title')
    Login
@endsection

@section('container')
    <form class="w-25 shadow mt-5 mx-auto p-3 rounded" id="loginUser">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" name="email">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" name="password">
        </div>
        <button type="submit" class="btn btn-primary w-100 my-3">Login</button>
        <a href="{{ route('registerFn') }}" class="btn w-100 mt-3">Register</a>
    </form>
@endsection

@section('scripts')
    <script>
        $(function() {

            // login
            $("#loginUser").on("submit", function(e) {
                e.preventDefault()

                const data = $(this).serializeArray()

                $.ajax({
                    url: "{{ route('loginUserFn') }}",
                    method: "post",
                    data: data,
                    success(e) {


                        if (e == 1) {

                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                text: 'Login Success!',
                                showConfirmButton: false,
                                timer: 1500
                            });

                            setTimeout(() => {
                                
                                window.location.href="{{ route('homeFn') }}";

                            }, 2000);

                        } else {

                            Swal.fire({
                                position: "top-end",
                                icon: "error",
                                text: e,
                                showConfirmButton: false,
                                timer: 1500
                            });

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
