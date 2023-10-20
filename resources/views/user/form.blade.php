@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Maklumat User</div>

                     <div class="card-body">
                        @if($act=='edit')
                        <form method="POST" action="{{ route('user.update') }}">
                        @else
                        <form method="POST" action="{{ route('user.store') }}">
                        @endif
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" onkeyup="this.value=this.value.toUpperCase()" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name ?? '' }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email ?? '' }}" required   readonly>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        @if($act!='edit')

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  required    >

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
						
					    @endif
						
						 
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                            <div class="col-md-6">
                               <select class="form-control select2-single" name="role_id" required >
                              <option value="">-Pilih-</option>
                              @foreach($roles as $index => $role)
                              <option value="{{ $role->id }}"  @if($act=='edit') {{ ($user->role_id) == $role->id ? 'selected' : '' }} @endif>
                                {{ $role->role }}    </option>
                              @endforeach
                            </select>
                            </div>
                        </div>
                        



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <input   type="hidden"  name="id" value="@if(!empty($user->id)) {{$user->id}} @endif">
                                <button type="submit" class="btn btn-primary">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
