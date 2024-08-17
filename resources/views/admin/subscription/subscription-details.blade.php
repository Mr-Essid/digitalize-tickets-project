@extends('layout')


@section('title', 'Appname - Subscription Add')


@section('content')

    <div class="content d-flex">
        <x-side-bar />
        <x-header-dashboard />
        <div class="content">
            <div class="mb-4">
                <h3 class="s-a-title mb-0">
                    Add Subscription
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

                @if (session()->get('status'))
                    <p class="alert alert-info">
                        subscription details stored successfully
                    </p>
                @endif

                <hr>
            </div>

            <Fieldset class="w-75 m-auto">
                <legend>
                    Subscription Details
                </legend>

                <form action="{{ Route('subscription.add.store') }}" method="POST" class="d-flex flex-column gap-2">

                    @csrf
                    <div class="row gap-2">

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="label" placeholder="label"
                                    name="label">
                                <label for="label">label</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" name="label_french" class="form-control" id="french-label"
                                    placeholder="french label">
                                <label for="frenchLabel">french label</label>
                            </div>
                        </div>
                    </div>

                    <div class="input-group input-group-lg ">
                        <span class="input-group-text">
                            <div style="width: 32px">
                                <img src="{{ asset('/storage/images/map.png') }}" style="max-width: 100%"
                                    alt="zone name image">
                            </div>
                        </span>
                        <input type="text" name="zoneName" class="form-control" placeholder="zone name">
                    </div>

                    <div class="row gap-2 p-0 m-0">
                        <div class="col input-group p-0">
                            <span class="input-group-text">
                                <div style="width: 32px">
                                    <img src="{{ asset('/storage/images/calendar.png') }}" style="max-width: 100%"
                                        alt="calander">
                                </div>
                            </span>
                            <input type="number" name="months" class="form-control" placeholder="Months" max="36"
                                min="1" />
                        </div>

                        <div class="col input-group p-0">
                            <span class="input-group-text">
                                <div style="width: 32px">

                                    <img src="{{ asset('/storage/images/tunisia.png') }}" style="max-width: 100%"
                                        alt="calander">
                                </div>
                            </span>
                            <input type="number" name="price" class="form-control col" placeholder="price" step="0.1"
                                min="0" max="13000" />
                        </div>
                    </div>


                    <div class="buttons mt-2 d-flex gap-2 justify-content-end">
                        <Button type="submit" class="btn btn-primary" style="color: white; width:180px">
                            submit
                        </Button>
                        <Button type="reset" class="btn btn-outline-primary" style="width: 180px"> cancel </Button>
                    </div>



                </form>

            </Fieldset>



        </div>
    </div>

@endsection
