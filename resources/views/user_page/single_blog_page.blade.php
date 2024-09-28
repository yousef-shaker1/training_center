@extends('layouts.master')

@section('title')
    single-blog
@endsection

@section('css')
    <style>
        .thumb img {
            border-radius: 50%;
            width: 95px;
            height: 79px;
            object-fit: cover;
        }

        .d-inline-block.d-flex.flex-column {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
@endsection


@section('content')
    <main>
        <section class="slider-area slider-area2">
            <div class="slider-active">
                <div class="single-slider slider-height2">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-8 col-lg-11 col-md-12">
                                <div class="hero__caption hero__caption2">
                                    <h1 data-animation="bounceIn" data-delay="0.2s">Company insights</h1>
                                    <!-- breadcrumb Start-->
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                            <li class="breadcrumb-item"><a
                                            href="{{ route('blog_page') }}">{{ $blog->title }}</a></li>
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
                        <div class="single-post">
                            <div class="feature-img">
                                <img class="img-fluid" src="{{ Storage::url($blog->img) }}" alt=""
                                    style="width: 400px; height:300px;">
                            </div>
                            <div class="blog_details">
                                <h2>{{ $blog->title }}
                                </h2>
                                <ul class="blog-info-link mt-3 mb-4">
                                </ul>
                                <p class="excert">{{ $blog->body }}</p>
                            </div>
                        </div>
                        <div class="navigation-top">
                            <div class="d-sm-flex justify-content-between text-center">
                                @if (Auth::check())
                                <livewire:love-blog :blogId="$blog->id">
                                @endif
                            </div>
                        </div>
                      @livewire('comment-blog', ['id' => $blog->id])
                </div>
            </div>
        </section>
    @endsection

    @section('js')
    @endsection
