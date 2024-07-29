@extends('layout')

@section('title', 'Appname - Subscription Details')


@section('content')

<div class="d-flex">

    <x-side-bar />
    <x-header-dashboard />

    <div class="subscriptions-available-header">
        <h3 class="s-a-title mb-0">
            Subscrption Detail
        </h3>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if (session()->get('success'))
        <p class="alert alert-info">
            opration success
        </p>
        @endif
    </div>

    <hr>

    <h4 class="text-capitalize">information</h4>
    <table class="table text-capitalize" style="text-align: center;table-layout:fixed">

        <thead class="">
            <tr class="">

                <th class="col">
                    <div class="d-flex flex-column align-items-center gap-1">
                        <div class="img" style="width: 38px">
                            <img src="{{ asset('storage/images/map.png') }}" alt="map image" style="max-width: 100%">
                        </div>
                        <p class="m-0">
                            zone name
                        </p>

                    </div>
                </th>
                <th class="col">
                    <div class="d-flex flex-column align-items-center gap-1">
                        <div class="img" style="width: 38px">
                            <img src="{{ asset('storage/images/subscription.png') }}" alt="date image"
                                style="max-width: 100%">
                        </div>
                        <p class="m-0">
                            month
                        </p>

                    </div>
                </th>
                <th class="col">
                    <div class="d-flex flex-column align-items-center gap-1">
                        <div class="img" style="width: 38px">
                            <img src="{{ asset('storage/images/tunisia.png') }}" alt="tunisian dinar image"
                                style="max-width: 100%">
                        </div>
                        <p class="m-0">
                            price
                        </p>

                    </div>
                </th>

            </tr>
        </thead>

        <tbody>
            <tr>
                <td>
                    {{ $subscriptiondetail->zone_name }}
                </td>
                <td>
                    {{ $subscriptiondetail->deltadate_months }} <strong> month </strong>
                </td>
                <td>
                    {{ $subscriptiondetail->price }} <strong> DT </strong>
                </td>
            </tr>

        </tbody>
    </table>

    <h4 class="text-capitalize mb-3">
        days
    </h4>
    <div class="d-flex px-4 justify-content-evenly">
        @foreach ($subscriptiondetail->days as $day)
        <div class="content-center">


            <button
                class="btn @if ($day->pivot->isAvailableRightNow) active text-white @endif btn-outline-primary fw-bold text-capitalize d-flex align-items-center gap-2"
                data-day-id="{{ $day->id }}" data-enabled="{{ $day->pivot->isAvailableRightNow }}"
                data-bs-toggle="modal" data-bs-target='#day-enable-disable-modal'>
                @if ($day->pivot->isAvailableRightNow)
                <div class="img" style="width: 28px;">
                    <img src="{{ asset('storage/images/checked.png') }}" alt="check" style="max-width: 100%;">
                </div>
                @endif
                {{ $day->name }}
            </button>
        </div>
        @endforeach
    </div>

    <h4 class="mt-4 mb-2">
        Lines
    </h4>
    <hr>
    <div class="content-lines px-5">
        <div class="header-lines class justify-content-between d-flex">
            <h5 class="m-0">
                Available Lines
            </h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-line-modal">
                <div class="icon d-flex align-items-center" style="width: 18px;">
                    <img src="{{ asset('storage/images/plus.png') }}" alt="plus" style="max-width: 100%;">
                </div>
            </button>
        </div>
        <div class="my-4">

        </div>
        <table class="table text-capitalize align-middle" style="table-layout: fixed; text-align: center;">
            <thead>
                <tr>
                    <th>
                        id
                    </th>
                    <th>
                        label
                    </th>
                    <th>
                        action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subscriptiondetail->lines as $line)
                <tr>
                    <td>
                        {{ $line->id }}
                    </td>
                    <td>
                        {{ $line->label }}
                    </td>
                    <td>
                        <button class="btn btn-outline-primary text-capitalize">disable</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>



<div class="modal fade" id="day-enable-disable-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('subscription.toggleday') }}" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Toggle Day Status</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-capitalize">
                    <small id="content-DE" class="load">
                    </small>
                    <hr />
                    @csrf
                    <input type="password" placeholder="sudo, pass" class="form-control" name="password" />
                    <input type="hidden" name="dayId" id="id-day" />
                    <input type="hidden" name="dayStatus" id="day-status" />
                    <input type="hidden" name="subscriptionDetailId" value="{{ $subscriptiondetail->id }}" />

                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary text-white">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>



<div class="modal  modal-dialog-scrollable fade" id="add-line-modal" tabindex="-1" aria-labelledby="add-line"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <form action="{{ route('subscription.addline', ['subscription_id' => $subscriptiondetail->id ] )}}"
            method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Search Lines</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-capitalize">
                    <input type="text" placeholder="search, by line label" class="form-control" id="search-line-bar" />
                    <hr>
                    <div style="height: 250px; overflow:auto; text-align: center;" id="form-container">


                    </div>
                    <hr />
                    <input type="password" class="form-control" placeholder="sudo, pass" name="password" />
                </div>

                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary text-white">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection


@section('script')

<script>
    let modalDayED = document.getElementById('day-enable-disable-modal');

    modalDayED.addEventListener('show.bs.modal', (event) => {
        const dayTreggred = event.relatedTarget;

        const enableState = dayTreggred.getAttribute('data-enabled');
        const dayId = dayTreggred.getAttribute('data-day-id');
        console.log(dayId)
        const dayName = dayTreggred.innerText;



        const stringToDisplay =
            `${(enableState === '1') ? 'Disable' : 'Enable'} <strong> ${dayName} </strong> From Current Subscription Details ?`;
        document.getElementById('content-DE').innerHTML = stringToDisplay;
        document.getElementById('id-day').value = dayId;
        document.getElementById('day-status').value = (enableState == '1') ? '0' : '1';

    });

    modalDayED.addEventListener('shown.bs.modal', (event) => {

        console.log(document.getElementById('id-day').value);
        console.log(document.getElementById('day-status').value);
    });


    let shardEventHandler = async (e) => {
        let data = await searchForLine(e.target.value);

        let form_container = document.getElementById('form-container');
        form_container.innerHTML = "";
        if (data.data.length > 0)
            data.data.forEach(element => {
                form_container.innerHTML += createElementOptionLineToInnerHTML(element);

            });
        else
            form_container.innerHTML = '<strong>Zero Lines Available</strong>';
        console.log('from event handler');

    }

    document.getElementById('search-line-bar').addEventListener('keyup', shardEventHandler);


    document.getElementById('add-line-modal').addEventListener('show.bs.modal', async (e) => {
        let form_container = document.getElementById('form-container');
        form_container.innerHTML = ""
        let data = await searchForLine('');

        if (data.data.length > 0)
            data.data.forEach(element => {
                form_container.innerHTML += createElementOptionLineToInnerHTML(element);

            });
        else
            form_container.innerHTML = '<strong>Zero Lines Available</strong>';


    });





    var searchForLine = async (keyword) => {
        return fetch(
            `/api/subscriptions/lines-available/others?query=${keyword}&subscription-id={{ $subscriptiondetail->id }}`
        ).then(
            (data) => data.json()
        ).then((data) => data)
            .catch((res) => console.log(res))
    }

    var createElementOptionLineToInnerHTML = (element) => {
        return `
        <div class='card py-3 px-3 mb-2'>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name='lines[]' value="${element.id}" id="flexCheckChecked">
                    <label class="form-check-label" for="flexCheckChecked">
                       <strong> ${element.label} </strong>
                    </label>
            </div>
        </div>
        `
    }
</script>

@endsection