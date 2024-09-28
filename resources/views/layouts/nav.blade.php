<header>
  <!-- Header Start -->
  <div class="header-area header-transparent">
      <div class="main-header ">
          <div class="header-bottom  header-sticky">
              <div class="container-fluid">
                  <div class="row align-items-center">
                      <!-- Logo -->
                      <div class="col-xl-2 col-lg-2">
                          <div class="logo">
                              <a href="{{ route('home') }}"><img src="{{ asset('assets/img/logo/logo.png') }}" alt=""></a>
                          </div>
                      </div>
                      <div class="col-xl-10 col-lg-10">
                          <div class="menu-wrapper d-flex align-items-center justify-content-end">
                              <!-- Main-menu -->
                              <div class="main-menu d-none d-lg-block">
                                  <nav>
                                    <ul id="navigation" class="navigation">
                                        <li class="active"><a href="{{ route('home') }}">Home</a></li>
                                        <li><a href="{{ route('Courses_page') }}">Courses</a></li>
                                        <li><a href="{{ route('about_page') }}">About</a></li>
                                        <li><a href="{{ route('blog_page') }}">Blog</a></li>
                                        
                                        <li><a href="{{ route('contact_page') }}">Contact</a></li>
                                    
                                        <!-- إذا كان المستخدم مسجل دخول -->
                                        @if(Auth::check())
                                                <li  class="button-header margin-left">
                                                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger" style="border: none; background: none; padding: 0; color: #f00; cursor: pointer;">{{Auth::user()->name}}</button>
                                                    </form>
                                                </li>
                                        @else
                                        <li class="button-header margin-left"><a href="{{ route('register') }}" class="btn">Join</a></li>
                                        <li class="button-header"><a href="{{ route('login') }}" class="btn btn3">Log in</a></li>
                                        @endif
                                    </ul>
                                    
                                  </nav>
                              </div>
                          </div>
                      </div> 
                      <!-- Mobile Menu -->
                      <div class="col-12">
                          <div class="mobile_menu d-block d-lg-none"></div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Header End -->
</header>