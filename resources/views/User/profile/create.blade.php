<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('New Staff') }}
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

        <br>

        <form class="row g-3" action="{{ route('users.info.store')}}" method="POST">

            <div class="col-md-6">
                <label for="name" class="form-label">{{ __('First Name') }}</label>
                <input type="text" class="form-control" name="name" required="required" value="{{ old('name')}}">
                <div>{{ $errors->first('name') }}</div>
            </div>
            <div class="col-md-6">
                <label for="lastName" class="form-label">{{ __('Last Name') }}</label>
                <input type="text" class="form-control" name="lastName" required="required" value="{{ old('lastName')}}">
                <div>{{ $errors->first('lastName') }}</div>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" required="required" value="{{ old('email')}}">
                <div>{{ $errors->first('email') }}</div>
            </div>
            <div class="col-md-6">
                <label for="phone" class="form-label">{{ __('Phone') }}</label>
                <input type="text" class="form-control" name="phone" required="required" value="{{ old('phone')}}">
                <div>{{ $errors->first('phone') }}</div>
            </div>

            @csrf

            <div class="col-12">
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
            </div>
        </form>

    @endsection
</x-app-layout>
