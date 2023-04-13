<nav class="navbar bg-light sticky-top">
  <div class="container-fluid">
    <ul class="navbar-nav sidebar vh-100">
      <li class="nav-item">
        <form action="{{ route('student.logout') }}" method="post">
          @csrf
          <button class="btn btn-outline-danger">Logout</button>
        </form>
      </li>

    </ul>
  </div>
</nav>
