<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Company Profile') }}
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

        <div class="row">
            {{ __('Detail: ') }}
            {{ $company->name }}
        </div>
        <br>

        <div class="row mt-3">
            <div class="col-12">
                <p><strong>{{ __('Company Name: ') }}</strong> {{ $company->name }}</p>
                <p><strong>{{ __('Email: ') }}</strong> {{ $company->email }}</p>
                <p><strong>{{ __('Website: ') }}</strong> {{ $company->website }}</p>
                <p><a href="{{ route('admins.info.show', $company->id) }}" class="btn btn-primary">{{ __('List Of Staff') }}</a></p>
            </div>
        </div>

        @if($company->photo)
            <div class="row">
                <div class="col-12">
                    <img src="{{ asset('storage/image/'. $company->photo) }}" alt="{{ __('Company Logo') }}" class="img-thumbnail">
                </div>
            </div>
        @endif

        @can('companies-update')
            <div class="col-12 mt-3">
                <a type="button" class="btn btn-success" href="{{ route('admins.company.edit', $company->id) }}">{{ __('Edit') }}</a>
            </div>
        @endif

        @can('companies-delete')
            <div class="col-12 mt-3">
                <div class="col-12 mt-3">
                    <form method="POST" action="{{ route('admins.company.destroy', $company->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are You Sure? you want to DELETE this Client')"
                                class="btn btn-danger">{{ __('Delete') }}
                        </button>
                    </form>
                </div>
            </div>
        @endif
    @endsection
</x-app-layout>
