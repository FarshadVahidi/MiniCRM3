<x-app-layout>

    @section('MyStyles')
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    @endsection

    <x-slot name="header">
        <div class="row">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Client List') }}
            </h2>
        </div>
    </x-slot>


    @section('message')
        {{ Session::get('message') }}
    @endsection
    @section('alert')
        {{ Session::get('alert') }}
    @endsection

    @section('mainContent')

        @can('profile-create')
            <div class="col-12 m-3">
                <a type="button" class="btn btn-success"
                   href="{{ route('admins.company.create') }}">{{ __('New Client') }}</a>
            </div>
        @endif

        <div>
            <table class="table table-bordered data-table" id="datatable">
                <thead>
                <tr>
                    <th scope="col">{{ __('Company Name') }}</th>
                    <th scope="col">{{ __('Email') }}</th>
                    <th scope="col">{{ __('Website') }}</th>
                    <th scope="col">{{ __('Action') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($companies as $company)
                    <tr>
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->email }}</td>
                        <td>{{ $company->website }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                                <div>
                                    <p><a class="btn btn-primary"
                                          href="{{ route('admins.company.show', $company->id) }}">{{ __('Show') }}</a></p>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    @endsection

    @section('MyScript')
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#datatable').DataTable()
            });
        </script>
    @endsection
</x-app-layout>
