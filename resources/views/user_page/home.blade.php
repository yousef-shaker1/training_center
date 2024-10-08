@extends('layouts.master')

@section('title')
home
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

<!-- Preloader Start -->
<main>
    <!--? slider Area Start-->
    <section class="slider-area ">
        <div class="slider-active">
            <!-- Single Slider -->
            <div class="single-slider slider-height d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-7 col-md-12">
                            <div class="hero__caption">
                                <h1 data-animation="fadeInLeft" data-delay="0.2s">Online learning<br> platform</h1>
                                <p data-animation="fadeInLeft" data-delay="0.4s">Build skills with courses, certificates, and degrees online from world-class universities and companies</p>
                                <a href="#" class="btn hero-btn" data-animation="fadeInLeft" data-delay="0.7s">Join for Free</a>
                            </div>
                        </div>
                    </div>
                </div>          
            </div>
        </div>
    </section>
    <!-- ? services-area -->
    <div class="services-area">
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
            <div class="courses-actives">
                <!-- Single -->
                @foreach($courses as $course)
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
                @endforeach
            </div>
        </div>
    </div>
    <!-- Courses area End -->
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
                        <a href="{{ route('Courses_page') }}" class="border-btn">View More Subjects</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="about-area3 fix">
        <div class="support-wrapper align-items-center">
            <div class="right-content3">
                <div class="right-img">
                    <img src="{{ asset('assets/img/gallery/about3.png') }}" alt="">
                </div>
            </div>
            <div class="left-content3">
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
    <!-- Services End -->
    <!--? About Area-2 Start -->
    <section class="about-area2 fix pb-padding">
        <div class="support-wrapper align-items-center">
            <div class="right-content2">
                <!-- img -->
                <div class="right-img">
                    <img src="{{ asset('assets/img/gallery/about2.png') }}" alt="">
                </div>
            </div>
            <div class="left-content2">
                <!-- section tittle -->
                <div class="section-tittle section-tittle2 mb-20">
                    <div class="front-text">
                        <h2 class="">Take the next step
                            toward your personal
                            and professional goals
                        with us.</h2>
                        <p>The automated process all your website tasks. Discover tools and techniques to engage effectively with vulnerable children and young people.</p>
                        <a href="#" class="btn">Join now for Free</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('js')

@endsection