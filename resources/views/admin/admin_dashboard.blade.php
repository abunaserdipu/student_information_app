@extends('admin.admin_master')
@section('content')
  {{-- Error Alert --}}
  @if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ Session::get('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
  <ul class="nav nav-pills nav-pills-bg-soft justify-content-sm-end mb-4 ">
    <a class="btn btn-success" href="javascript:void(0)" id="createNewStudent"> Create New Student</a>
  </ul>
  </a>
  <table class="table table-striped table-hover data-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Age</th>
        <th>Address</th>
        <th>Action</th>

      </tr>
    </thead>

    <tbody>


    </tbody>

  </table>
  {{-- Modal --}}
  <div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="modelHeading"></h4>
        </div>
        <div class="modal-body">
          <form id="studentForm" name="studentForm" class="form-horizontal">
            <input type="hidden" name="student_id" id="student_id">
            <div class="form-group mb-3">
              <label for="">Name</label>
              <input class="form-control" type="text" id="name" name="name" placeholder="Enter student name">
            </div>
            <div class="form-group mb-3">
              <label for="">Email</label>
              <input class="form-control" type="email" id="email" name="email" placeholder="Enter student email">
            </div>
            <div class="form-group mb-3">
              <label for="">Password</label>
              <input class="form-control" type="password" id="password" name="password" placeholder="Password">
            </div>
            <div class="form-group mb-3">
              <label for="">Confirm Password</label>
              <input class="form-control" type="password" name="password_confirmation" placeholder="Confirm Password">
            </div>
            <div class="form-group mb-3">
              <label for="">Age</label>
              <input class="form-control" type="text" id="age" name="age" placeholder="Enter student age">
            </div>
            <div class="form-group mb-3">
              <label for="">Address</label>
              <textarea name="address" class="form-control" id="address" cols="30" rows="3"
                placeholder="Enter student address"></textarea>
            </div>

            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  @push('scripts')
    <script>
      $(function() {
        //  Pass Header Token
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });


        // Render DataTable
        var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('student.index') }}",
          columns: [{
              data: 'DT_RowIndex',
              name: 'DT_RowIndex'
            },
            {
              data: 'name',
              name: 'name'
            },
            {
              data: 'email',
              name: 'email'
            },
            {
              data: 'age',
              name: 'age'
            },
            {
              data: 'address',
              name: 'address'
            },
            {
              data: 'action',
              name: 'action',
              orderable: false,
              searchable: false
            },
          ]
        });


        // Click to Button
        $('#createNewStudent').click(function() {
          $('#saveBtn').val("create-student");
          $('#student_id').val('');
          $('#studentForm').trigger("reset");
          $('#modelHeading').html("Create New Student");
          $('#ajaxModel').modal('show');
        });


        // Click to Edit Button
        $('body').on('click', '.editStudent', function() {
          var student_id = $(this).data('id');
          $.get("{{ route('student.index') }}" + '/' + student_id + '/edit', function(data) {
            $('#modelHeading').html("Edit Student");
            $('#saveBtn').val("edit-student");
            $('#ajaxModel').modal('show');
            $('#student_id').val(data.id);
            $('#name').val(data.name);
            $('#email').val(data.email);
            $('#password').val(data.password);
            $('#age').val(data.age);
            $('#address').val(data.address);
          })
        });


        // Create Student Code
        $('#saveBtn').click(function(e) {
          e.preventDefault();
          $(this).html('Sending..');

          $.ajax({
            data: $('#studentForm').serialize(),
            url: "{{ route('student.store') }}",
            type: "POST",
            dataType: 'json',
            success: function(data) {

              $('#studentForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              table.draw();

            },
            error: function(data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
            }
          });
        });


        // Delete Student Code
        $('body').on('click', '.deleteStudent', function() {

          var student_id = $(this).data("id");
          confirm("Are You sure want to delete !");

          $.ajax({
            type: "DELETE",
            url: "{{ route('student.store') }}" + '/' + student_id,
            success: function(data) {
              table.draw();
            },
            error: function(data) {
              console.log('Error:', data);
            }
          });
        });
      })
    </script>
  @endpush
@endsection
