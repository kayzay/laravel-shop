@extends("admin.layout.admin.auth.auth")
@section('content')
<div class="card-header text-center">
      <a href="#" class="h1">{{getTextAdmin('name')}}</a>
    </div>
    <div class="card-body">
      <!--<p class="login-box-msg">Sign in to start your session</p> -->
        @if ($errors->any())
            <div class="callout callout-danger">
                @foreach ($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            </div>
        @endif
      <form action="{{route('sign-in')}}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input
            name="email"
            type="email"
            class="form-control"
            value="{{old('email', '')}}"
            placeholder="{{getTextAdmin('name_login')}}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input
            name="password"
            type="password"
            class="form-control"
            value="{{old('password', '')}}"
            placeholder="{{getTextAdmin('name_password')}}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input name="remember" type="checkbox" id="remember">
              <label for="remember">
               {{getTextAdmin('remember')}}
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button
                 type="submit"
                 class="btn btn-primary btn-block">{{getTextAdmin('btn_next')}}</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-1">
        <a href="forgot-password.html">{{getTextAdmin('forget')}}</a>
      </p>
    </div>
    @endsection
