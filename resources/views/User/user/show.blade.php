<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('My Profile') }}
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
            {{ $user->name }}
        </div>
        <br>

        <div class="col-12">
            <a type="button" class="btn btn-success" href="{{ route('users.user.edit', $user->id) }}">{{ __('Edit') }}</a>
        </div>

        <div class="row mt-3">
            <div class="col-12">
                <p><strong>{{ __('First Name: ') }}</strong> {{ $user->name }}</p>
                <p><strong>{{ __('Last Name: ') }}</strong> {{ $user->lastName }}</p>
                <p><strong>{{ __('Work For: ') }}</strong> {{ $user->company_name }}</p>
                <p><strong>{{ __('Email: ') }}</strong> {{ $user->email }}</p>
                <p><strong>{{ __('Phone: ') }}</strong> {{ $user->phone }}</p>
            </div>
        </div>

        @if($user->photo)
            <div class="row">
                <div class="col-12">
                    <img src="{{ asset('storage/image/'. $user->photo) }}" alt="{{ __('User Image') }}" class="img-thumbnail">
                </div>
            </div>
        @endif

    @endsection
</x-app-layout>
