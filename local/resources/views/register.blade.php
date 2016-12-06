@extends('layouts.loginReg')

@section('content')

<div class="loginColumns animated fadeInDown" ng-controller = "signUpCtrl">
    <div class="row">

       
        <div class="col-lg-6 col-sm-6" style="float: none;margin: 0 auto;">
            <div class="ibox-content">
                <form class="m-t" name ="signUpForm" ng-submit ="signUpForm.$valid && signUp(signUpForm.$valid)" novalidate>
                {!! csrf_field() !!}

                <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }} " ng-class="{'has-error': signUpForm.$submitted && signUpForm.username.$invalid || signUpForm.username.$touched && signUpForm.username.$invalid || errors.username}">


                        <input type="text" ng-model="signUp.username" class="form-control input-lg" name = "username" placeholder="Name" required="">

                        <div class="help-block m-b-none computed " ng-show="signUpForm.$submitted && signUpForm.username.$invalid || signUpForm.username.$touched">
                            <span class="text-danger" ng-show = "signUpForm.username.$error.required">This field is required</span>
                             <span class="text-danger" ng-show = "signUpForm.username.$error.username">Please enter a valid email address</span>
                        </div>
                        <div class="help-block m-b-none computed " ng-show="errors.username">
                                 <span class="text-danger" ng-show = "errors.username">@{{ errors.username.toString() }}</span>
                            </div>
                    </div>

                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }} " ng-class="{'has-error': signUpForm.$submitted && signUpForm.email.$invalid || signUpForm.email.$touched && signUpForm.email.$invalid || errors.email}">


                        <input type="email" ng-model="signUp.email" class="form-control input-lg" name = "email" placeholder="Email Address" required="">

                        <div class="help-block m-b-none computed " ng-show="signUpForm.$submitted && signUpForm.email.$invalid || signUpForm.email.$touched">
                            <span class="text-danger" ng-show = "signUpForm.email.$error.required">This field is required</span>
                             <span class="text-danger" ng-show = "signUpForm.email.$error.email">Please enter a valid email address</span>
                        </div>
                        <div class="help-block m-b-none computed " ng-show="errors.email">
                                 <span class="text-danger" ng-show = "errors.email">@{{ errors.email.toString() }}</span>
                            </div>
                    </div>

                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }} " ng-class="{'has-error':signUpForm.$submitted && signUpForm.password.$invalid || signUpForm.password.$touched && signUpForm.password.$invalid || errors.password}">
                        <input type="password" ng-model="signUp.password" class="form-control input-lg" name = "password" placeholder="Password" required="">
                        <div class="help-block m-b-none computed " ng-show="signUpForm.$submitted && signUpForm.password.$invalid || signUpForm.password.$touched">
                            <span class="text-danger" ng-show = "signUpForm.password.$error.required">This field is required</span>
                             <span class="text-danger" ng-show = "signUpForm.password.$error.email">Please enter a valid email address</span>
                        </div>
                        <div class="help-block m-b-none computed " ng-show="errors.password">
                                 <span class="text-danger" ng-show = "errors.password">@{{ errors.password.toString() }}</span>
                            </div>
                    </div>
                    <button  type="submit" class="btn btn-primary block full-width m-b" ladda="isProcessing" data-style="expand-right">Create Account</button>


                    <a href="#">
                        <small>Forgot password?</small>
                    </a><br/>
                    <br/>

                    <p class="text-muted text-center">
                        <small>I already have an account?</small>
                    </p>
                    <a class="btn btn-sm btn-white btn-block" href="{{ url('/login') }}">Login to your account</a>
                </form>
            </div>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-6" style="font-size:11px">
            Copyright <?php echo date("Y");  ?> © PayAdriot
        </div>
    </div>
</div>


@endsection