@extends('layout')
@section('title', 'Appname - client details')


@section('content')

    <div class="content d-flex">


        <x-side-bar />
        <x-header-dashboard />

        @if (session()->get(0) == 'success')
            <div>
                <div class="alert alert-info row">
                    <div class="row">

                        <div class="img col-1 p-0" style="width: 28px">
                            <img src="{{ asset('storage/images/check.png') }}" style="max-width: 100%" alt="checked">
                        </div>
                        <p class="col mb-0">

                            {{ session()->get(1) }}
                        </p>

                    </div>
                </div>
            </div>
        @endif


        @if ($errors->any())
            <div class="alert alert-danger">
                <div class="error row ">
                    <div class="img col-1 p-0" style="width: 28px">
                        <img src="{{ asset('storage/images/error.png') }}" style="max-width: 100%" alt="error icon">
                    </div>
                    <p class="col mb-0">
                        errors
                    </p>
                </div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <h2 class="text-capitalize">
            {{ $client->firstname }} {{ $client->lastname }}
        </h2>
        <small class="load fw-bold">
            {{ $client->email }}
        </small>
        <hr>
        <table class="table align-middle text-capitalize" style="text-align: center">
            <thead>
                <th>
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="img" style="width: 42px">
                            <img src="{{ asset('storage/images/smartphone.png') }}" alt="smart phone"
                                style="max-width: 100%">
                        </div>
                        <p class="mb-0 ms-1">
                            phone
                        </p>
                    </div>
                </th>
                <th>
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="img" style="width: 42px">
                            <img src="{{ asset('storage/images/wallet.png') }}" alt="smart phone" style="max-width: 100%">
                        </div>
                        <p class="mb-0 ms-1">
                            current wallet
                        </p>
                    </div>
                </th>
                <th>
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="img" style="width: 42px">
                            <img src="{{ asset('storage/images/charge.png') }}" alt="smart phone" style="max-width: 100%">
                        </div>
                        <p class="mb-0 ms-1">
                            charge wallet
                        </p>
                    </div>
                </th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        {{ $client->phone_number }}
                    </td>
                    <td>
                        {{ $client->wallet }} <strong>DT</strong>
                    </td>
                    <td>
                        <button class="btn btn-primary" style="color: white" data-bs-toggle='modal'
                            data-bs-target="#chargeModal"> charge </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <h3> Subscriptions </h3>
        <table class="w-100 table text-capitalize">
            <thead style="position: sticky; top: 0;">
                <tr>
                    <th>
                        id
                    </th>
                    <th>
                        type
                    </th>
                    <th>
                        from
                    </th>
                    <th>
                        to
                    </th>
                    <th>
                        zonename
                    </th>
                    <th>
                        price
                    </th>
                </tr>
            </thead>
            @if (count($subscriptions) > 0)
                <tbody>

                    @foreach ($subscriptions as $item)
                        <tr>

                            <td>
                                {{ $item->id }}
                            </td>
                            <td>
                                {{ $item->subscriptionDetails->label }}
                            </td>

                            <td>
                                {{ $item->from }}
                            </td>
                            <td>
                                {{ $item->to }}
                            </td>
                            <td>
                                {{ $item->subscriptionDetails->zone_name }}
                            </td>
                            <td>
                                {{ $item->subscriptionDetails->price }}dt
                            </td>

                        </tr>
                    @endforeach

                </tbody>

        </table>
        @endif
        @if (count($subscriptions) == 0)
            <p>
                <small class="load fw-bold">
                    client have no subscriptions yet.
                </small>
            </p>
        @endif

        <div class="modal fade" id="chargeModal" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Charge Wallet</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('addtowallet') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $client->id }}">
                            <div>
                                <input type="text" name="amount" id="amountId" class="form-control"
                                    placeholder="amount, eg 60.5dt">
                            </div>

                            <div class="mt-2">
                                <input type="password" name="password" id="amountId" class="form-control"
                                    placeholder="sudo, password">
                            </div>

                            <div class="modal-footer">
                                <div class="row">
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary" style="color: white">SUBMIT</button>
                                    </div>
                                    <div class="col px-0">
                                        <button type="reset" class="btn btn-outline-primary">CANCEL</button>
                                    </div>

                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
