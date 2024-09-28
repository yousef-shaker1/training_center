@extends('layouts.master')

@section('title')
Courses
@endsection

@section('css')
<style>
    .properties__img img {
    width: 100%; /* جعل الصورة بعرض كامل للعنصر الحاوي */
    height: 250px; /* تحديد ارتفاع ثابت للصورة */
    object-fit: cover; /* الحفاظ على نسبة العرض إلى الارتفاع بدون تشويه */
    border-radius: 8px; /* إضافة حدود دائرية إذا كنت تريد ذلك */
}

</style>
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
                              <h1 data-animation="bounceIn" data-delay="0.2s">Our courses</h1>
                              <!-- breadcrumb Start-->
                              <nav aria-label="breadcrumb">
                                  <ol class="breadcrumb">
                                      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                      <li class="breadcrumb-item"><a href="{{ route('Courses_page') }}">Services</a></li> 
                                  </ol>
                              </nav>
                          </div>
                      </div>
                  </div>
              </div>          
          </div>
      </div>
  </section>
  <!-- Courses area start -->
  <div class="courses-area section-padding40 fix">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-8">
                <div class="section-tittle text-center mb-55">
                    <h2>Our featured courses</h2>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($courses as $course)
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="properties pb-20">
                        <div class="properties__card">
                            <div class="properties__img overlay1">
                                <a href="{{ route('single_course', $course->id) }}"><img src="{{ Storage::url($course->img) }}" alt=""></a>
                            </div>
                            <div class="properties__caption">
                                <p>{{ $course->section->name }}</p>
                                <h3><a href="#">{{ $course->name }}</a></h3>
                                <p>{{ $course->description }}</p>
                                <div class="properties__footer d-flex justify-content-between align-items-center">
                                    <div class="price">
                                        <span>{{ $course->price }} $</span>
                                    </div>
                                </div>
                                <a href="{{ route('single_course', $course->id) }}" class="border-btn border-btn2">Find out more</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-8">
                <div class="section-tittle text-center mt-40">
                    <a href="#" class="border-btn">Load More</a>
                </div>
            </div>
        </div>
    </div>
</div>

  <!-- Courses area End -->
  <!--? top subjects Area Start -->
  <div class="topic-area">
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
                                <h3><a href="{{ route('single_section', $section->id) }}">{{ $section->name }}</a></h3>
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
  <!-- ? services-area -->
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
</main>
@endsection

@section('js')

@endsection