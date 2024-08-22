<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">


<title>@yield('title')</title>
<!--Google Font-->
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
<link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&family=Plus+Jakarta+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
    rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<!--Bootstrap CSS-->
<link type="text/css" href="{{ asset('front_end/css/bootstrap.min.css') }}" rel="stylesheet" />

<!--Custom CSS-->
<link type="text/css" href="{{ asset('front_end/css/styles.css') }}" rel="stylesheet" />
<style>
    .body.from-outer {
        border-radius: 15px;
        box-shadow: 0 0 20px #715d37;
    }

    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        appearance: none;
        margin: 0;
    }

    .readonly-class {
        background-color: #dddddd;
        pointer-events: none;
        user-select: none;
    }

    .btn-submit-cls {
        background: #bda568 !important;
        color: #ffffff !important;
    }

    .btn-submit-cls:hover {
        background: #bda568 !important;
        color: #ffffff !important;
        /* Set the same background color on hover */
    }
</style>
