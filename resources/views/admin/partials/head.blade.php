<meta name="csrf-token" content="{{ csrf_token() }}">

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="diego garcia">

<link rel="shortcut icon" href="assets/images/favicon.ico">

<title>{{Config::get('app.name')}}</title>

<!--Morris Chart CSS -->
<link rel="stylesheet" href="{{ asset('admin/assets/plugins/morris/morris.css') }}">

<!-- App css -->
<link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
{{--<link href="css/style_white.css" rel="stylesheet" type="text/css"/>--}}
<link href="{{ asset('admin/assets/css') }}/{{ session('style')?:'style.css'}}" rel="stylesheet" type="text/css"/>

<link href="{{ asset('admin/assets/css/icons.css') }}" rel="stylesheet" type="text/css"/>
<script src="{{ asset('admin/assets/js/modernizr.min.js') }}"></script>