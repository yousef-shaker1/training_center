@extends('layouts.master')

@section('title')
about
@endsection

@section('css')

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
                              <h1 data-animation="bounceIn" data-delay="0.2s">About us</h1>
                              <!-- breadcrumb Start-->
                              <nav aria-label="breadcrumb">
                                  <ol class="breadcrumb">
                                      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                      <li class="breadcrumb-item"><a href="{{ route('about_page') }}">about</a></li> 
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
  <div class="services-area services-area2 section-padding40">
      <div class="container">
          <div class="row justify-content-sm-center">
              <div class="col-lg-4 col-md-6 col-sm-8">
                  <div class="single-services mb-30">
                      <div class="features-icon">
                          <img src="{{ asset('assets/img/icon/icon1.svg') }}" alt="">
                      </div>
                      <div class="features-caption">
                          <h3>60+ UX courses</h3>
                          <p>The automated process all your website tasks.</p>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-8">
                  <div class="single-services mb-30">
                      <div class="features-icon">
                          <img src="{{ asset('assets/img/icon/icon2.svg') }}" alt="">
                      </div>
                      <div class="features-caption">
                          <h3>Expert instructors</h3>
                          <p>The automated process all your website tasks.</p>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-8">
                  <div class="single-services mb-30">
                      <div class="features-icon">
                          <img src="{{ asset('assets/img/icon/icon3.svg') }}" alt="">
                      </div>
                      <div class="features-caption">
                          <h3>Life time access</h3>
                          <p>The automated process all your website tasks.</p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!--? About Area-1 Start -->
  <section class="about-area1 fix pt-10">
      <div class="support-wrapper align-items-center">
          <div class="left-content1">
              <div class="about-icon">
                  <img src="{{ asset('assets/img/icon/about.svg') }}" alt="">
              </div>
              <!-- section tittle -->
              <div class="section-tittle section-tittle2 mb-55">
                  <div class="front-text">
                      <h2 class="">Learn new skills online with top educators</h2>
                      <p>The automated process all your website tasks. Discover tools and 
                          techniques to engage effectively with vulnerable children and young 
                      people.</p>
                  </div>
              </div>
              <div class="single-features">
                  <div class="features-icon">
                      <img src="{{ asset('assets/img/icon/right-icon.svg') }}" alt="">
                  </div>
                  <div class="features-caption">
                      <p>Techniques to engage effectively with vulnerable children and young people.</p>
                  </div>
              </div>
              <div class="single-features">
                  <div class="features-icon">
                      <img src="{{ asset('assets/img/icon/right-icon.svg') }}" alt="">
                  </div>
                  <div class="features-caption">
                      <p>Join millions of people from around the world  learning together.</p>
                  </div>
              </div>

              <div class="single-features">
                  <div class="features-icon">
                      <img src="{{ asset('assets/img/icon/right-icon.svg') }}" alt="">
                  </div>
                  <div class="features-caption">
                      <p>Join millions of people from around the world learning together. Online learning is as easy and natural.</p>
                  </div>
              </div>
          </div>
          <div class="right-content1">
              <!-- img -->
              <div class="right-img">
                  <img src="{{ asset('assets/img/gallery/about.png') }}" alt="">
              </div>
          </div>
      </div>
  </section>
  <!-- About Area End -->
  <!--? top subjects Area Start -->
  <div class="topic-area section-padding40">
      <div class="container">
          <div class="row justify-content-center">
              <div class="col-xl-7 col-lg-8">
                  <div class="section-tittle text-center mb-55">
                      <h2>Explore top subjects</h2>
                  </div>
              </div>
          </div>
          <div class="row">
            @foreach ($sections as $section)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="single-topic text-center mb-30">
                    <div class="topic-img">
                        <img src="{{ Storage::url($section->img) }}" alt="" style="width: 200px; height: 100px; border-radius: 10%;">
                        <div class="topic-content-box">
                            <div class="topic-content">
                                <h3><a href="#">{{ $section->name }}</a></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
          <div class="row justify-content-center">
              <div class="col-xl-12">
                  <div class="section-tittle text-center mt-20">
                      <a href="courses.html" class="border-btn">View More Subjects</a>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- top subjects End -->
  <!--? About Area-3 Start -->
  <section class="about-area3 fix">
      <div class="support-wrapper align-items-center">
          <div class="right-content3">
              <!-- img -->
              <div class="right-img">
                  <img src="{{ asset('assets/img/gallery/about3.png') }}" alt="">
              </div>
          </div>
          <div class="left-content3">
              <!-- section tittle -->
              <div class="section-tittle section-tittle2 mb-20">
                  <div class="front-text">
                      <h2 class="">Learner outcomes on courses you will take</h2>
                  </div>
              </div>
              <div class="single-features">
                  <div class="features-icon">
                      <img src="{{ asset('assets/img/icon/right-icon.svg') }}" alt="">
                  </div>
                  <div class="features-caption">
                      <p>Techniques to engage effectively with vulnerable children and young people.</p>
                  </div>
              </div>
              <div class="single-features">
                  <div class="features-icon">
                      <img src="{{ asset('assets/img/icon/right-icon.svg') }}" alt="">
                  </div>
                  <div class="features-caption">
                      <p>Join millions of people from around the world
                      learning together.</p>
                  </div>
              </div>
              <div class="single-features">
                  <div class="features-icon">
                      <img src="{{ asset('assets/img/icon/right-icon.svg') }}" alt="">
                  </div>
                  <div class="features-caption">
                      <p>Join millions of people from around the world learning together.
                      Online learning is as easy and natural.</p>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- About Area End -->
  <!--? Team -->
  <section class="team-area section-padding40 fix">
      <div class="container">
          <div class="row justify-content-center">
              <div class="col-xl-7 col-lg-8">
                  <div class="section-tittle text-center mb-55">
                      <h2>Community experts</h2>
                  </div>
              </div>
          </div>
          <div class="team-active">
            @foreach ($instructors as $instructor)
            <div class="single-cat text-center">
                <div class="cat-icon">
                    <img src="{{ Storage::url($instructor->img) }}" alt="" style="width: 150px;  height: 190px; border-radius: 60%;">
                </div>
                <div class="cat-cap">
                    <h5><a href="services.html">{{ $instructor->name }}</a></h5>
                    <p>{{ $instructor->description }}</p>
                </div>
            </div>
            @endforeach
              
          </div>
      </div>
  </section>
</main>
@endsection

@section('js')

@endsection