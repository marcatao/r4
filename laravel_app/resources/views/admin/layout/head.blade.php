<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ env('APP_NAME')}} | sistema de gerenciamento</title>

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link href="{{ asset('admin/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('admin/font-awesome/css/font-awesome.css')}}" rel="stylesheet">


  
    <link href="{{ asset('admin/css/animate.css')}}" rel="stylesheet">
    <link href="{{ asset('admin/css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('admin/css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
    <link href="{{ asset('admin/css/plugins/select2/select2.min.css')}}" rel="stylesheet">
</head>