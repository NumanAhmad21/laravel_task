@extends('admin.admin_layouts')

@section('admin_content')
<div class="d-flex align-items-center justify-content-center bg-sl-primary ht-100v">

<div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
  <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">iflyvisa <span class="tx-info tx-normal">admin</span></div>
  <div class="tx-center mg-b-60">Professional Admin Template Design</div>
  @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  @if(Session::has('status'))
      <!-- <div class=" alert alert-success" > {{  Session::get('status') }}</div> -->
 
  @endif
<form action="{{route('login')}}" class="d-block" method="post">
  @csrf
  <div class="form-group">
  <input id="email" type="email" class="form-control " name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email Address">
      @error('email')
        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
        </span>
      @enderror
  </div><!-- form-group -->
  <div class="form-group">
    <input id="password" type="password" class="form-control " name="password" required autocomplete="current-password" placeholder="Password">
     @error('password')
     <span class="invalid-feedback" role="alert">
     <strong>{{ $message }}</strong>
     </span>
     @enderror
    <a href="{{ route('admin.password.request') }}" class="tx-info tx-12 d-block mg-t-10">Forgot password?</a>
  </div><!-- form-group -->
  <button type="submit" class="btn btn-info btn-block">Sign In</button>

  <div class="mg-t-60 tx-center">Not yet a member? <a href="page-signup.html" class="tx-info">Sign Up</a></div>
</form>
</div><!-- login-wrapper -->
</div><!-- d-flex -->
@endsection
