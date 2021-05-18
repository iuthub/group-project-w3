


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Paper Dashboard 2 by Creative Tim
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link href="{{ URL::asset('assets/css/mystyle.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="{{ URL::asset('assets/css/Style.css') }}">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
  <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
  @yield('css')
</head>
<body class="bg-light">

  <div class="d-flex flex-row mt-5">
    <div class="w-25 p-3">
      <ul class="list-group">
        <li class="list-group-item active bg-dark"> Admin Panel</li>
        <li class="list-group-item"><a href="{{ route('category.index') }}">
          Categories
      </a></li>
      <li class="list-group-item "> <a href="{{ route('post.index') }}">
        Posts
    </a></li>
      </ul>
    </div>
    <div class="w-75 p-3">
      @yield('content')
    </div>
  </div>

<script src="{{ URL::asset('assets/js/core/jquery.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/core/popper.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>

<!--  Google Maps Plugin    -->
<!-- Chart JS -->
<script src="{{ URL::asset('assets/js/plugins/chartjs.min.js') }}"></script>
<!--  Notifications Plugin    -->
<script src="{{ URL::asset('assets/js/plugins/bootstrap-notify.js') }}"></script>
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ URL::asset('assets/js/paper-dashboard.min.js?v=2.0.1') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/js/mylogic.js') }}"></script>
@yield('js')
</body>
</html>
