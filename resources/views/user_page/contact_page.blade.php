@extends('layouts.master')

@section('title')
contact
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
                              <h1 data-animation="bounceIn" data-delay="0.2s">Contact us</h1>
                              <!-- breadcrumb Start-->
                              <nav aria-label="breadcrumb">
                                  <ol class="breadcrumb">
                                      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                      <li class="breadcrumb-item"><a href="{{ route('contact_page') }}">Contact</a></li> 
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
  <!--?  Contact Area start  -->
  <section class="contact-section">
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <h2 class="contact-title">Get in Touch</h2>
              </div>
              <div class="col-lg-8">
                @if(session()->has('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif
                  <form class="form-contact contact_form" action="{{ route('save_contact') }}" method="post" >
                    @csrf
                      <div class="row">
                          <div class="col-sm-6">
                              <div class="form-group">
                                  <input class="form-control valid" name="name" id="name" type="text"  placeholder="Enter your name">
                                  @error('name') <div class='alert alert-danger'>{{ $message }}</div>@enderror
                              </div>
                          </div>
                          <div class="col-sm-6">
                              <div class="form-group">
                                  <input class="form-control valid" name="email" id="email" type="email"  placeholder="Email">
                                  @error('email') <div class='alert alert-danger'>{{ $message }}</div>@enderror
                                </div>
                          </div>
                          <div class="col-12">
                            <div class="form-group">
                                <textarea class="form-control w-100" name="message" id="message" cols="30" rows="9" placeholder=" Enter Message"></textarea>
                                @error('message') <div class='alert alert-danger'>{{ $message }}</div>@enderror
                            </div>
                        </div>
                      </div>
                      {{-- <div class="form-group mt-3"> --}}
                          <button type="submit" class="button button-contactForm boxed-btn">Send</button>
                      {{-- </div> --}}
                  </form>
              </div>
              <div class="col-lg-3 offset-lg-1">
                  <div class="media contact-info">
                      <span class="contact-info__icon"><i class="ti-home"></i></span>
                      <div class="media-body">
                          <h3>Buttonwood, California.</h3>
                          <p>Rosemead, CA 91770</p>
                      </div>
                  </div>
                  <div class="media contact-info">
                      <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                      <div class="media-body">
                          <h3>+1 253 565 2365</h3>
                          <p>Mon to Fri 9am to 6pm</p>
                      </div>
                  </div>
                  <div class="media contact-info">
                      <span class="contact-info__icon"><i class="ti-email"></i></span>
                      <div class="media-body">
                          <h3>support@colorlib.com</h3>
                          <p>Send us your query anytime!</p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- Contact Area End -->
</main>
@endsection

@section('js')

@endsection