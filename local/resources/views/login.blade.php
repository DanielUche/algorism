@extends('layouts.loginReg')

@section('content')

<div class="loginColumns animated fadeInDown" ng-controller = "signInCtrl">
    <div class="row">

       
        <div class="col-lg-6 col-sm-6" style="float: none;margin: 0 auto;">
    
            <div class="ibox-content">
                <form class="m-t" name ="signInForm" ng-submit ="signInForm.$valid && signIn(signInForm.$valid)" novalidate>
                {!! csrf_field() !!}

                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }} " ng-class="{'has-error': signInForm.$submitted && signInForm.email.$invalid || signInForm.email.$touched && signInForm.email.$invalid || errors.email}">


                        <input type="email" ng-model="signIn.email" class="form-control input-lg" name = "email" placeholder="Email Address" required="">

                        <div class="help-block m-b-none computed " ng-show="signInForm.$submitted && signInForm.email.$invalid || signInForm.email.$touched">
                            <span class="text-denger" ng-show = "signInForm.email.$error.required">This field is required</span>
                             <span class="text-denger"  ng-show = "signInForm.email.$error.email">Please enter a valid email address</span>
                        </div>
                        <div class="help-block m-b-none computed " ng-show="errors.email">
                                 <span class="text-denger" ng-show = "errors.email">@{{ errors.email.toString() }}</span>
                            </div>
                    </div>

                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }} " ng-class="{'has-error':signInForm.$submitted && signInForm.password.$invalid || signInForm.password.$touched && signInForm.password.$invalid || errors.password}">
                        <input type="password" ng-model="signIn.password" class="form-control input-lg" name = "password" placeholder="Password" required="">
                        <div class="help-block m-b-none computed " ng-show="signInForm.$submitted && signInForm.password.$invalid || signInForm.password.$touched">
                            <span ng-show = "signInForm.password.$error.required">This field is required</span>
                             <span ng-show = "signInForm.password.$error.email">Please enter a valid email address</span>
                        </div>
                        <div class="help-block m-b-none computed " ng-show="errors.password">
                                 <span ng-show = "errors.password">@{{ errors.password.toString() }}</span>
                            </div>
                    </div>
                    <button type="submit" class="btn btn-primary block full-width m-b" ladda="isProcessing" data-style="expand-right">Login</button>


                    <a href="#">
                        <small>Forgot password?</small>
                    </a><br/>
                    <br/>

                    <p class="text-muted text-center">
                        <small>Do not have an account?</small>
                    </p>
                    <a class="btn btn-sm btn-white btn-block" href="{{ url('/register') }}">Create an account</a>
                </form>
            </div>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-6" style="font-size:11px">
            Copyright <?php echo date("Y");  ?> © Trello Mock
        </div>
    </div>
</div>


@endsection