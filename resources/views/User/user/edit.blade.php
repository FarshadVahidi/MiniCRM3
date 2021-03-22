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

        <form class="row g-3" action="{{ route('users.user.update', $user->id)}}" method="POST" enctype="multipart/form-data">
            @method('PATCH')
            <div class="col-md-6">
                <label for="name" class="form-label">{{ __('First Name') }}</label>
                <input type="text" class="form-control" name="name" required="required" value="{{ old('name') ?? $user->name }}">
                <div>{{ $errors->first('name') }}</div>
            </div>
            <div class="col-md-6">
                <label for="lastName" class="form-label">{{ __('Last Name') }}</label>
                <input type="text" class="form-control" name="lastName" required="required" value="{{ old('lastName') ?? $user->lastName }}">
                <div>{{ $errors->first('lastName') }}</div>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" required="required" value="{{ old('email') ?? $user->email }}">
                <div>{{ $errors->first('email') }}</div>
            </div>
            <div class="col-md-6">
                <label for="phone" class="form-label">{{ __('Phone') }}</label>
                <input type="text" class="form-control" name="phone" required="required" value="{{ old('phone') ?? $user->phone }}">
                <div>{{ $errors->first('phone') }}</div>
            </div>

            @if($user->photo)
                <figure class="container pt-6">
                    <img src="{{ asset('storage/image/'. $user->photo) }}" class="figure-img img-fluid img-thumbnail" alt="User profile photo" width="300", height="300">
                </figure>
            @endif

            <div class="form-group d-flex flex-column">
                <label for="photo" class="py-2">{{ __('Photo') }}</label>
                <input type="file" name="photo" class="py-2" value="{{ old('photo') ?? $user->photo }}">
                <div>{{ $errors->first('photo') }}</div>
            </div>

            @csrf

            <div class="col-12">
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
            </div>
        </form>

    @endsection
</x-app-layout>
