@extends('layouts.backend.login-backend')
@section('css')
<style>

</style>
@endsection
@section('content')
<!-- Page content -->
<div class="container mt--8 pb-5">
    <div class="row justify-content-center" style="margin-top: 20%">
        <div class="col-lg-5 col-md-7">
            <div class="card bg-secondary border-0 mb-0">
                <div class="card-header bg-transparent" style="text-align: center;">
                    <img class="write" src="assets/frontend/img/logo.png" alt="logo write" />
                    <div class="text-muted text-center mt-2 mb-3"><small>Sign in with</small></div>
                </div>
                <div class="card-body px-lg-5 py-lg-5">
                    <form method="POST" action="{{ route('LoginCMS') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                </div>
                                <input class="form-control" placeholder="Username" type="text" name="email"  required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                </div>
                                <input class="form-control" placeholder="Password" type="password" name="password" required autocomplete="current-password">
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary my-4">Sign in</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')

@endsection
