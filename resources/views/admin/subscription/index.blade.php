@extends('layout')

@section('title', 'Appname - Subscriptions Available')
@section('style')
    <style>
        .special:hover {
            color: white !important;
        }
    </style>
@endsection
@section('content')
    <div class="content d-flex">
        <x-side-bar />
        <x-header-dashboard />

        <div class="subscriptions-available-header d-flex justify-content-between align-items-center mb-2">
            <h3 class="s-a-title mb-0">
                Subscriptions Available
            </h3>
            <a href="{{ route('subscription.add.show') }}" class="btn btn-outline-primary fw-bold special"
                id="add-subscription">
                now subscription
            </a>
        </div>
        <hr>
        <table class="table align-middel text-capitalize" style="text-align: center">
            <thead>
                <tr>
                    <th>
                        id
                    </th>
                    <th>
                        label
                    </th>
                    <th>
                        months
                    </th>
                    <th>
                        zone name
                    </th>
                    <th>
                        price
                    </th>
                    <th>
                        show
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subscriptionsavailable as $subscription)
                    <tr>
                        <td>
                            {{ $subscription->id }}
                        </td>
                        <td>
                            {{ $subscription->label }}
                        </td>
                        <td>
                            {{ $subscription->deltadate_months }}
                        </td>
                        <td>
                            {{ $subscription->zone_name }}
                        </td>
                        <td>
                            {{ $subscription->price }}
                        </td>
                        <td>
                            <a href="{{ route('subscription.show', ['id-subscription' => $subscription->id]) }}"
                                class="btn btn-primary" style="color: white">
                                Details
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>



@endsection

@section('script')

@endsection
