@extends('layouts.master')

@section('title')
404
@endsection

@section('css')

@endsection

@section('content')
<main>
  <!-- Slider Area Start -->
  <section class="slider-area slider-area2">
      <div class="slider-active">
          <!-- Single Slider -->
          <div class="single-slider slider-height2">
              <div class="container">
                  <div class="row">
                      <div class="col-xl-8 col-lg-11 col-md-12 mx-auto">
                          <div class="hero__caption hero__caption2 text-center">
                              <h1 data-animation="bounceIn" data-delay="0.2s" class="display-1">404</h1>
                              <!-- Breadcrumb Start -->
                              <nav aria-label="breadcrumb">
                                  <ol class="breadcrumb justify-content-center">
                                      <li class="breadcrumb-item"><a href="/">Home</a></li>
                                      <li class="breadcrumb-item active" aria-current="page">404</li>
                                  </ol>
                              </nav>
                              <!-- Breadcrumb End -->
                              <p class="lead mt-4">عذرًا، الصفحة التي تبحث عنها غير موجودة. قد تم نقلها أو حذفها أو لم تعد متاحة.</p>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- Slider Area End -->
</main>

<!-- Section for additional message -->
<section class="section-404">
  <div class="container">
      <div class="row">
          <div class="col-lg-12 text-center">
              <div class="text-404">
                <br>
                  <h3>Oops! This page Could Not Be Found!</h3>
                  <p>عذرًا، الصفحة التي تبحث عنها غير موجودة، قد تم إزالتها أو تغيير اسمها.</p>
                  <a href="{{ route('home') }}" class="btn btn-secondary mt-3"><i class="fa fa-home"></i> Go Back Home</a>
                  <br><br>
              </div>
          </div>
      </div>
  </div>
</section>


@endsection

@section('js')

@endsection