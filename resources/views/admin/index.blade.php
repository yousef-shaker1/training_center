@extends('layouts.master_admin')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

@endsection

@section('title')
index
@endsection

@section('content')
<div class="container mt-4">
  <!-- row -->
<div class="row g-3">
<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
    <div class="card text-white bg-danger mb-3">
        <div class="card-body">
            <h6 class="card-title">all Users</h6>
            <h4 class="card-text">
                {{\App\Models\User::where('roles_name', '["user"]')->count()}} user
            </h4>
        </div>
    </div>
</div>
<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
    <div class="card text-white bg-primary mb-3">
        <div class="card-body">
            <h6 class="card-title">Courses</h6>
            <h4 class="card-text">
                {{\App\Models\Course::count() }}
            </h4>
        </div>
    </div>
</div>

<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
    <div class="card text-white bg-success mb-3">
        <div class="card-body">
            <h6 class="card-title">Instructors</h6>
            <h4 class="card-text">
                {{\App\Models\Instructor::count() }} Instructor
            </h4>
        </div>
    </div>
</div>
<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
    <div class="card text-white bg-warning mb-3">
        <div class="card-body">
            <h6 class="card-title">payment</h6>
            <h4 class="card-text">
                {{\App\Models\payment::count()}} payment
            </h4>
        </div>
    </div>
</div>
</div>

</div>

@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection