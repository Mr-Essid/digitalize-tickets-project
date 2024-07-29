@extends('layout')

@section('title', 'Appname - Lines')


@section('content')

    <div class="d-flex">

        <x-side-bar />
        <x-header-dashboard />

        <div class="subscriptions-available-header d-flex justify-content-between align-items-center mb-2">
            <h3 class="s-a-title mb-0">
                Lines Available
            </h3>
            <a href="#" class="btn btn-outline-primary fw-bold special" id="add-subscription">
                now line
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
                        created at
                    </th>
                    <th>
                        denger zone
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lines as $line)
                    <tr>
                        <td>
                            {{ $line->id }}
                        </td>
                        <td>
                            {{ $line->label }}
                        </td>
                        <td>
                            {{ $line->created_at->toDateString() }}
                        </td>
                        <td>
                            <a href="#" class="btn btn-danger"> delete </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection


@section('script')

@endsection
