@extends('admin.auth.layouts.app')
@section('title')
    تسجيل دخول
@endsection
@section('content')
    <div class="content-body">
        <section class="flexbox-container">
            <div class="col-12 d-flex align-items-center justify-content-center">
                <div class="col-md-4 col-10 box-shadow-2 p-0">
                    <div class="card border-grey border-lighten-3 m-0">
                        <div class="card-header border-0">
                            <div class="card-title text-center">
                                <div class="p-1">
                                    <img src="{{asset('dashboard/app-assets/images/logo/logo-dark.png')}}" alt="branding logo">
                                </div>
                            </div>
                            <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                                <span>تسجيل دخول (نظام ادارة المشتركين)</span>
                            </h6>
                        </div>
                        <div class="card-content">
                            <div class="card-body">

                                <form class="form-horizontal form-simple" action="{{ route('admin.login') }}" novalidate method="post">
                                    @csrf
                                    <fieldset class="form-group position-relative has-icon-left mb-0">
                                        <input type="email"class="form-control form-control-lg input-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus  id="user-name" placeholder="الإيميل"
                                               required>
                                        <div class="form-control-position">
                                            <i class="ft-user"></i>
                                        </div>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </fieldset>
                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input type="password" class="form-control form-control-lg input-lg @error('password') is-invalid @enderror" name="password"  autocomplete="current-password" id="user-password"
                                               placeholder="كلمة السر" required>
                                        <div class="form-control-position">
                                            <i class="la la-key"></i>
                                        </div>

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </fieldset>

                                    <button type="submit" class="btn btn-info btn-lg btn-block"><i class="ft-unlock"></i> تسجيل دخول </button>
                                </form>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="">
                                                            @if (Route::has('admin.password.request'))
                                                                <p class="float-sm-left text-center m-0"><a href="{{route('admin.password.request')}}" class="card-link">استعادة كلمة السر </a></p>

                                                            @endif
{{--                                                            <p class="float-sm-right text-center m-0">New to Moden Admin? <a href="register-simple.html" class="card-link">Sign Up</a></p>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

