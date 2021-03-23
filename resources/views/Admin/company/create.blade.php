<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('New Client') }}
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

        <form class="row g-3" action="{{ route('admins.company.store')}}" method="POST">

            <div class="col-md-6">
                <label for="name" class="form-label">{{ __('Company Name') }}</label>
                <input type="text" class="form-control" name="name" required="required" value="{{ old('name')}}">
                <div>{{ $errors->first('name') }}</div>
            </div>

            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" required="required" value="{{ old('email')}}">
                <div>{{ $errors->first('email') }}</div>
            </div>

            <div class="col-md-6">
                <label for="phone" class="form-label">{{ __('Website') }}</label>
                <input type="text" class="form-control" name="website" required="required" value="{{ old('website')}}">
                <div>{{ $errors->first('website') }}</div>
            </div>

            @csrf

            <div class="col-12">
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
            </div>
        </form>

    @endsection
</x-app-layout>
