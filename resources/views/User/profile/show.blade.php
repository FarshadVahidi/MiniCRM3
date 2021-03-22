<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Profile') }}
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
                    <img src="{{ asset('storage/image/'. $user->photo) }}" alt="{{ __('User Image') }}"
                         class="img-thumbnail">
                </div>
            </div>
        @endif
    <div class="mt-3">
        @can('profile-update')
            <div class="col-12">
                <a type="button" class="btn btn-success"
                   href="{{ route('users.info.edit', $user->id) }}">{{ __('Edit') }}</a>
            </div>
        @endif

        @can('profile-delete')
            <div class="col-12 mt-3">
                <form method="POST" action="{{ route('users.info.destroy', $user->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are You Sure? you want to DELETE this user')"
                            class="btn btn-danger">{{ __('Delete') }}
                    </button>
                </form>
            </div>
        @endif
    </div>

    @endsection
</x-app-layout>
