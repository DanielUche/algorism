<!DOCTYPE html>
<html ng-app = "trello">
<head>
 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Page title set in pageTitle directive -->
 
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css') }}">
    <!-- Fonts -->
    <link rel="stylesheet" href="{{asset('public/css/font-awesome/css/font-awesome.min.css') }}" >
    <!-- Main CSS files -->
    <link href="{{asset('public/css/animate.css') }}" rel="stylesheet">
    
     <link href="{{asset('public/css/toastr.min.css') }}" rel="stylesheet">
     <link href="{{asset('public/css/ladda-themeless.min.css') }}" rel="stylesheet"> 
     <link href="{{asset('public/css/style.css') }}" rel="stylesheet">
     <link href="{{asset('public/css/angular-datepicker.min.css') }}" rel="stylesheet">

    <script src="{{asset('public/js/jquery-2.1.1.min.js') }}"></script>
    <script src="{{asset('public/js/jquery-ui/jquery-ui.js') }}"></script>
    <script src="{{asset('public/js/bootstrap.min.js') }}"></script>
    <script src="{{asset('public/js/angular.min.js') }}"></script>

    <script src="{{asset('public/js/toastr.min.js') }}"></script>
    
    <title>Trello Mock</title>

    <style type="text/css">
        .computed {
            display: none;
        }
    </style>
</head>
<body class="" landing-scrollspy id="page-top">
<toaster-container toaster-options="{'position-class':'toast-top-right','close-button':true,'body-output-type':'trustedHtml','showDuration':'200','hideDuration':'100'}">
</toaster-container>

<div id="wrapper" class="top-navigation">



    <!-- Page wraper -->
    <!-- ng-class with current state name give you the ability to extended customization your view -->
    <div id="page-wrapper" class="gray-bg">
        <!-- Main view  -->
        @yield('content')
    </div>
    <!-- End page wrapper-->
</div>


<script type="text/javascript">
    $(document).ready(function(){
        $('.computed').css({'display':'block'});
    });
</script>


<script src="{{asset('public/js/spin.min.js') }}"></script>
<script src="{{asset('public/js/ladda.min.js') }}"></script>
<script src="{{asset('public/js/angular-ladda.min.js') }}"></script>
<script src="{{asset('public//js/ui-bootstrap-tpls-1.1.2.min.js') }}"></script>
<script src="{{asset('public/js/angular-animate.min.js') }}"></script>
<script src="{{asset('public/js/angular-resource.min.js') }}"></script>
<script src="{{asset('public/js/moment.min.js') }}"></script>
<script src="{{asset('public/js/angular-datepicker.min.js') }}"></script>
<script src="{{asset('public/ajaxy/app.js') }}"></script>
<script src="{{asset('public/ajaxy/config.js') }}"></script>
<script src="{{asset('public/ajaxy/controllers.js') }}"></script>
<script src="{{asset('public/ajaxy/utilities.js') }}"></script>
</body>
</html>