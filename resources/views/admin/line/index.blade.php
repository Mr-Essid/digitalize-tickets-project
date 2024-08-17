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
            <button data-bs-target="#add-line-modal" data-bs-toggle="modal" class="btn btn-outline-primary fw-bold special"
                id="add-subscription">
                now line
            </button>
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



    <div class="modal fade" tabindex="-1" id="add-line-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Line</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post">

                    <div class="modal-body">
                        <input type="text" name="lineLabel" class="form-control mb-2" placeholder="label">
                        <input type="text" name="password" class="form-control" placeholder="sudo, pass">
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




@endsection


@section('script')

@endsection
