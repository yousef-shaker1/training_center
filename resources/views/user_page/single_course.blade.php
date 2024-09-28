@extends('layouts.master')

@section('title')
contact
@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@endsection

@section('content')
<main>
  <!--? slider Area Start-->
  <section class="slider-area slider-area2">
      <div class="slider-active">
          <!-- Single Slider -->
          <div class="single-slider slider-height2">
              <div class="container">
                  <div class="row">
                      <div class="col-xl-8 col-lg-11 col-md-12">
                          <div class="hero__caption hero__caption2">
                              <h1 data-animation="bounceIn" data-delay="0.2s">Contact us</h1>
                              <!-- breadcrumb Start-->
                              <nav aria-label="breadcrumb">
                                  <ol class="breadcrumb">
                                      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                      <li class="breadcrumb-item"><a href="{{ route('single_course', $course->id) }}">{{ $course->name }}</a></li> 
                                  </ol>
                              </nav>
                              <!-- breadcrumb End -->
                          </div>
                      </div>
                  </div>
              </div>          
          </div>
      </div>
  </section>

  <section class="blog_area single-post-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 posts-list">
              @if (session()->has('message'))
              <div class="alert alert-success" role="alert">
                  <strong>{{ session()->get('message') }}</strong>
              </div>
            @endif
            
              @if (session()->has('cancel'))
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>{{ session()->get('cancel') }}</strong>
                  </div>
              @endif
                <div class="single-post">
                    <div class="feature-img">
                        <img class="img-fluid" src="{{ Storage::url($course->img) }}" alt="{{ $course->name }}">
                    </div>
                    <div class="course-details mt-4">
                        <h2 class="font-weight-bold">{{ $course->name }}</h2>
                        <h4>Course details:</h4>
                        <p class="mb-4">{{ $course->description }}</p>

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <strong>Price:</strong> <span class="text-success">${{ $course->price }}</span>
                            </li>
                            <li class="list-group-item">
                                <strong>Number of hours:</strong> {{ $course->Numberofhours }} hours
                            </li>
                            <li class="list-group-item">
                                <strong>date:</strong> From {{ $course->start_data }} To {{ $course->end_data }}
                            </li>
                            <li class="list-group-item">
                                <strong>section:</strong> {{ $course->section->name }}
                            </li>
                        </ul>
                    </div>

                    <div class="mt-4 text-center">
                        <form action="{{ route('poststripe', $course->id) }}" method="post" id="payment-form">
                          @csrf
                            <button type='submit' class="btn btn-primary btn-lg">Register now</button>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



@endsection

@section('js')
<script src="https://checkout.stripe.com/checkout.js"></script>

@endsection