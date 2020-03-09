@extends('layouts.app')

@section('page-title-breadcrumb')
    @lang('Edit Your Profile')
@endsection

@section('page-title', __('Edit Your Profile'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @lang('User was NOT updated.')
                        </div>
                    @endif

                    <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="mt-4">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group @error('name') has-danger @enderror">
                                    <label for="name">@lang('register.name')</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="@lang('Enter your full name')" value="{{ $user->name }}">
                                    @error('name')
                                        <small class="form-control-feedback">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="form-group @error('email') has-danger @enderror">
                                    <label for="email">@lang('login.email')</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="@lang('login.email')" value="{{ $user->email }}">
                                    <div class="help-block"></div>
                                    @error('email')
                                        <small class="form-control-feedback">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="form-group @error('password') has-danger @enderror">
                                    <label for="password">@lang('login.password')</label>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="@lang('login.password')">
                                    @error('password')
                                        <small class="form-control-feedback">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="form-group @error('password_confirmation') has-danger @enderror">
                                    <label for="password_confirmation">@lang('register.confirmPassword')</label>
                                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="@lang('register.confirmPassword')" data-validation-match-match="password">
                                    <div class="help-block"></div>
                                    @error('password_confirmation')
                                        <small class="form-control-feedback">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <center class="m-t-30 m-b-30 mx-auto"> <img src="{{ asset('storage/' . $user->profile_picture) }}" class="img-circle" width="150" />
                                </center>
                                <div class="custom-file mb-3">
                                    <input type="file" name="profile_picture" class="custom-file-input" id="profile_picture" accept="image/png, image/jpeg">
                                    <label class="custom-file-label form-control" for="profile_picture">@lang('Choose an image')</label>
                                    @error('profile_picture')
                                        <small class="form-control-feedback">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <button type="submit" class="btn btn-primary mx-auto">
                                @lang('Update')
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('assets/dist/js/pages/validation.js') }}"></script>
    <script>
        ! function(window, document, $) {
            "use strict";
            $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
        }(window, document, jQuery);
    </script>
    <script>
        const imageInput = document.querySelector('.custom-file-input');
        const imageElement = document.querySelector('form .img-circle');

        imageInput.addEventListener('change', (event) => {
            if (event.target.files[0]) {
                let filename = event.target.files[0].name;
                imageInput.nextSibling.nextSibling.innerHTML = filename;

                let fileReader = new FileReader();
                fileReader.onload = (event) => {
                    imageElement.setAttribute('src', event.target.result);
                }
                fileReader.readAsDataURL(event.target.files[0]);
            }
        });
    </script>
@endsection
