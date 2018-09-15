<!DOCTYPE html>
<html>
<head>
    @include('admin.partials.head')
</head>

<body>

<div class="account-pages"></div>
<div class="clearfix"></div>
<div class="wrapper-page">
    <div class="text-center">
        <a href="index.html" class="logo"><span>{{Config::get('app.name')}}</span></a>
    </div>
    <div class="m-t-40 card-box">
        <div class="text-center">
            <h4 class="text-uppercase font-bold m-b-0">Sign In</h4>
        </div>
        <div class="p-20">
            <form class="form-horizontal m-t-20" method="POST" action="{{ route('login')}}">

                {{ csrf_field() }}

                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="text" required="" placeholder="Username" name="username">
                        {!!$errors->first('email','<span class="invalid-feedback">:message</span>')!!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="password" required="" placeholder="Password" name="password">
                        {!!$errors->first('password','<span class="invalid-feedback">:message</span>')!!}
                    </div>
                </div>

                @if (count($errors))
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="form-group text-center m-t-30">
                    <div class="col-xs-12">
                        <button class="btn btn-custom btn-bordered btn-block waves-effect waves-light" type="submit">Log
                            In
                        </button>
                    </div>
                </div>

                <div class="form-group m-t-30 m-b-0">
                    <div class="col-sm-12">
                        <a href="page-recoverpw.html" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot your
                            password?</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <!-- end card-box-->

    <div class="row">
        <div class="col-sm-12 text-center">
            <p class="text-muted">Don't have an account? <a href="page-register.html" class="text-primary m-l-5"><b>Sign
                        Up</b></a></p>
        </div>
    </div>

</div>
<!-- end wrapper page -->


@include('admin.partials.scripts')

</body>
</html>