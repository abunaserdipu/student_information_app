<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Student App</title>
  <!-- Latest compiled and minified CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Latest compiled JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  {{-- Font Awesome --}}
  <script src="https://kit.fontawesome.com/ad84f6ded1.js" crossorigin="anonymous"></script>
</head>

<body>
  @auth
    <div class="container-fluid">
      @include('layouts.top-nav')

      <div class="row p-0 m-0">
        <div class="col-md-3 ps-0">
          @include('admin.admin_sidebar')
        </div>
        <div class="col-md-9 pe-0">
          @yield('content')
        </div>
      </div>
    @endauth

  </div>
  @stack('scripts')
</body>

</html>
