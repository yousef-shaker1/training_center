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
<div class="container mt-4">
    <!-- Header -->
    <div class="row mb-3">
      <div class="col-12 text-center">
        <h4>Course Sales Over Time</h4>
        <p class="text-muted">Track the sales trends of courses over time.</p>
      </div>
    </div>
  
    <!-- Line Chart for Course Sales -->
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header text-center">
            <h6 class="card-title">Course Sales Trend</h6>
          </div>
          <div class="card-body">
            <canvas id="courseSalesChart" style="max-width: 100%; height: 200px;"></canvas>
          </div>
        </div>
      </div>
    </div>
</div>
</div>

@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
     var ctxCourseSales = document.getElementById('courseSalesChart').getContext('2d');
  var courseSalesChart = new Chart(ctxCourseSales, {
      type: 'line',
      data: {
          labels: @json($labels), // تواريخ مبيعات الكورسات
          datasets: [{
              label: 'Course Sales',
              data: @json($salesData), // بيانات مبيعات الكورسات
              backgroundColor: 'rgba(75, 192, 192, 0.2)',
              borderColor: 'rgba(75, 192, 192, 1)',
              borderWidth: 2,
              fill: true,
              tension: 0.4, // لجعل الرسم أكثر سلاسة
              pointRadius: 3,
              pointHoverRadius: 5
          }]
      },
      options: {
          scales: {
              y: {
                  beginAtZero: true
              }
          },
          plugins: {
              tooltip: {
                  callbacks: {
                      label: function(context) {
                          let label = context.dataset.label || '';
                          if (label) {
                              label += ': ';
                          }
                          label += context.raw + ' sales';
                          return label;
                      }
                  }
              }
          }
      }
  });
  </script>
@endsection