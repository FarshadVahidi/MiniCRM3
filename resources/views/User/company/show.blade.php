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

    @can('companies-update')
        <div class="col-12">
            <a type="button" class="btn btn-success" href="{{ route('users.company.edit', $company->id) }}">{{ __('Edit') }}</a>
        </div>
    @endif
        <div class="row mt-3">
            <div class="col-12">
                <p><strong>{{ __('First Name: ') }}</strong> {{ $company->name }}</p>
                <p><strong>{{ __('Email: ') }}</strong> {{ $company->email }}</p>
                <p><strong>{{ __('Website: ') }}</strong> {{ $company->website }}</p>
            </div>
        </div>

        @if($company->photo)
            <div class="row">
                <div class="col-12">
                    <img src="{{ asset('storage/image/'. $company->photo) }}" alt="{{ __('Company Logo') }}" class="img-thumbnail">
                </div>
            </div>
        @endif

    @endsection
</x-app-layout>
