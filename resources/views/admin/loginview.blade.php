@extends('layout')
@section('title', 'App Name - Login')



@section('content')

    <div class="container h-100">

        <div class="row h-75 align-items-center">
            @error('fatal-error')
                <div class="alert alert-danger alert-dismissable fade show">
                    <div class="d-flex justify-content-between">
                        <p style="margin: 0"> email or password incorrect, please make sure you are in the right place </p>
                        <button class="btn btn-close" id="close-button" role="close" data-dissmis="alert" aria-label="close">
                        </button>


                    </div>
                </div>
            @enderror
            <div class="row">

                <div class="form-text col-lg-6 d-none d-lg-block">
                    <div class="h5">
                        Our Admin
                    </div>


                    <p class="load w-75">
                        Welcome to the Admin Portal. Please log in to access administrative functions and manage the system.
                        For assistance, contact support. Thank you for ensuring the smooth operation of our platform.
                    </p>

                </div>
                <div class="form-input col-md-12 col-lg-6">
                    <div class="div mb-4">

                        <h2 class="typing-effect">
                            SIGN<span style="color: var(--bs-primary)" id=""> IN</span>
                        </h2>


                    </div>
                    <form method="POST" action="{{ route('start-session') }}">
                        @csrf
                        <div class="mb-3">
                            {{-- <label for="exampleInputEmail1" class="form-label">Email address</label> --}}
                            <input type="email" class="form-control form-control-lg" placeholder="email"
                                id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                        </div>
                        <div class="mb-3">
                            {{-- <label for="exampleInputPassword1" class="form-label">Password</label> --}}
                            <input type="password" class="form-control form-control-lg" placeholder="password"
                                id="exampleInputPassword1" name="password">
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="rememberme" class="form-check-input form-chek-secondary"
                                id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">remember me</label>
                        </div>
                        <div class="row gy-1">
                            <button type="submit" class="btn btn-custom-primary">SUBMIT</button>
                            <button type="rest" class="btn btn-outline-primary ">CANCEL</button>
                        </div>
                    </form>


                </div>

            </div>

        </div>
        <hr>

        @include('footer')

    </div>

@section('script')

    <script defer>
        let closeButton = document.getElementById('close-button');
        console.log(closeButton);
    </script>


@endsection
