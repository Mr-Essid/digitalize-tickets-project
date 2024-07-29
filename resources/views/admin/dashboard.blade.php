@extends('layout')

@section('style')
@vite(['resources/css/sass/dashboard-style.scss'])
@endsection


@section('title', 'GoDigital - Dashbaord')
@section('content')


<div class="content d-flex">



    <x-side-bar />
    <x-header-dashboard />

    <div class="d-flex justify-content-between pe-4 mb-4">

        <h2>
            Clients
        </h2>


        <div class="icon" style="width: 56px">
            <button class="btn btn-primary" type="button" class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target="#exampleModal">
                <img src="{{ asset('/storage/images/search.png') }}" alt="search icon" style="max-width: 100%">
            </button>
        </div>
    </div>
    <div>

        <div class="t-clients me-4">

            <table class="table table-hover align-middle" style="text-align: center">
                <thead style="position: sticky; top:0">
                    <tr>
                        @foreach ($keys as $item)
                        <th class="text-capitalize"> {{ $item }} </th>
                        @endforeach
                        <th>
                            Show
                        </th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($clients as $client)
                    <tr>
                        <td>
                            {{ $client->id }}
                        </td>
                        <td>
                            {{ $client->firstname }}
                        </td>
                        <td>
                            {{ $client->lastname }}
                        </td>
                        <td>
                            {{ $client->email }}
                        </td>
                        <td>
                            {{ $client->wallet }}
                        </td>
                        <td>
                            {{ $client->phone_number }}
                        </td>
                        <td>
                            <a href="{{ url('admin/current-admin/client?client-id='.$client->id) }}"
                                class="btn btn-primary" style="color: white"> Details</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>

</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Search</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" placeholder="keyword eg. mr.essid" name="search" id="search" class="form-control">
            </div>

            <div id="serach-content">

            </div>

        </div>
    </div>
</div>


</div>





@endsection


@section('script')


<script>
    let modal = document.getElementById('exampleModal');

    let searchBar = document.getElementById('search');
    let searchContent = document.getElementById("serach-content")
    searchContent.innerHTML = ''

    searchContent.appendChild(document.createElement('div'))
    searchBar.onkeyup = function (e) {
        searchContent.innerHTML = ''
        if (e.target.value != '') {
            console.log(e.target.value);

            fetch(
                `http://127.0.0.1:8001/api/search-client?q=${e.target.value}`).then((data) => {
                    return data.json()
                }).then((data) => {
                    let clientsByName = data.byName;
                    let clientsByLastname = data.byLastname;
                    let clientsByEmail = data.byEmail;
                    if (clientsByName.length > 0) {
                        searchContent.innerHTML = "<b class='px-2'>By name</b> </hr>"
                        clientsByName.forEach(element => {

                            searchContent.innerHTML += `
                            <a class='card p-2 mx-1 mb-1 link link-underline link-underline-opacity-0' href= {{ url('/admin/current-admin/client?client-id=') }}${element.id}>
                                <small> <b>fullname</b> </small>
                                <p>
                                ${element.firstname.replace(new RegExp(e.target.value, 'i'), '<strong>' + e.target.value + '</strong>')} ${element.lastname}
                                </p>
                                <small> <b>email</b> </small>
                                ${element.email}
                            </a>
                        `;
                        });
                    }

                    if (clientsByEmail.length > 0) {
                        searchContent.innerHTML += "<b class='px-2'>By email</b> </hr>"
                        clientsByEmail.forEach(element => {

                            searchContent.innerHTML += `
                            <a class='card p-2 mx-1 mb-1 link link-underline link-underline-opacity-0' href={{ url('/admin/current-admin/client?client-id=') }} ${element.id} >
                                <small> <b>fullname</b> </small>
                                ${element.firstname} ${element.lastname}

                                <small> <b>email</b> </small>
                                <p>
                                ${element.email.replace(new RegExp(e.target.value, 'i'), '<strong>' + e.target.value + '</strong>')}
                                </p>
                            </a>
                        `;
                        });
                    }

                })
        }
    }
    console.log("OK show");


    // user model
    function createSearchModel(data) {

        let root = document.createElement('div')
        root.innerText = `fullname: ${data.firstname}`

        return root;
    }


    modal.addEventListener('shown.bs.modal', event => { })
    modal.addEventListener('hidden.bs.modal', event => {
        searchContent.innerHTML = ""
        searchBar.value = ""
    })
</script>





@endsection