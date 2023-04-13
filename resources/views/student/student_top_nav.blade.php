<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('student.dashboard') }}">Student Information App</a>
    <strong class="text-info">{{ Auth::guard('student')->user()->name }}</strong>
  </div>
</nav>
