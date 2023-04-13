@extends('student.student_master')

@section('content')
  @foreach ($infos as $info)
    <div class="card">
      <div class="card-header">
        {{ $info->name }}
      </div>
      <div class="card-body">
        <h5 class="card-title">{{ $info->email }}</h5>
        <p class="card-text">Address: {{ $info->address }}</p>
        <p class="card-text">Age: {{ $info->age }}</p>
      </div>
    </div>
  @endforeach


  </table>
@endsection
