<div class="vh-100 position-fixed d-flex flex-column border-end" style="width: 400px" id=""
    aria-labelledby="offcanvasLabel">
    <div class="offcanvas-header flex-column align-items-start p-3">


        <img src="{{ asset('storage/images/GoDigital(1).svg') }}" alt="logo godigital">

        <h4 class="offcanvas-title" id="offcanvasLabel">Wel<span id="title">come,</span>
            {{ Auth::user()->firstname }}
        </h4>
        <small class="load">
            {{ Auth::user()->email }}
        </small>
    </div>
    <hr style="margin: 0">
    <div class="offcanvas-body mt-0 p-0 d-flex flex-column justify-content-between">
        <div class="top-section">

            <ul class="list-group">

                @foreach ($routes as $key => $route)
                    <li class="list-group-item hover-effect">
                        <a href="{{ $route['link'] }}"
                            class="row link-underline link-underline-opacity-0 text-capitalize align-items-center">
                            <div class="icon col-2">
                                <img src="{{ $route['icon_path'] }}" alt="icon-{{ $key }}"
                                    style="max-width: 100%">
                            </div>
                            <p class="col fw-bold">
                                {{ $key }}
                            </p>

                        </a>
                    </li>
                @endforeach

            </ul>
        </div>

        <div class="bottom-section p-3">

            <a class="row align-items-center link-underline link-underline-opacity-0"
                href="{{ route('admin.logout') }}">
                <div class="col-2">
                    <img src="{{ asset('storage/images/logout.png') }}" style="max-width: 100%" alt="logout-icon">
                </div>
                <p class="col text-capitalize m-0 p-0 fw-bold">
                    logout
                </p>
            </a>
        </div>

    </div>
    <div class="ps-3 pb-3">

        @include('footer')
    </div>
</div>
