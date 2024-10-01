<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand fs-4" href="{{ route('admin_index') }}">Courses</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                @can('Home')
                <li class="nav-item">
                    <a class="nav-link active fs-6" aria-current="page" href="{{ route('admin_index') }}">Home</a>
                </li> 
                @endcan
                
                @can('section')
                <li class="nav-item">
                    <a class="nav-link active fs-6" aria-current="page" href="{{ route('section_index') }}">Section</a>
                </li> 
                @endcan

                @can('instructor')
                <li class="nav-item">
                    <a class="nav-link active fs-6" aria-current="page" href="{{ route('instructor.index') }}">Instructors</a>
                </li> 
                @endcan

                @can('course')
                <li class="nav-item">
                    <a class="nav-link active fs-6" aria-current="page" href="{{ route('course.index') }}">Courses</a>
                </li> 
                @endcan 
                
                @can('contact_us')
                <li class="nav-item">
                    <a class="nav-link active fs-6" aria-current="page" href="{{ route('Contact_us') }}">Contact Us</a>
                </li> 
                @endcan

                @can('blog')
                <li class="nav-item">
                    <a class="nav-link active fs-6" aria-current="page" href="{{ route('blog_index') }}">Blogs</a>
                </li> 
                @endcan

                @can('payment')
                <li class="nav-item">
                    <a class="nav-link active fs-6" aria-current="page" href="{{ route('payment_index') }}">payment</a>
                </li> 
                @endcan

                @can('user')
                <li class="nav-item">
                    <a class="nav-link active fs-6" aria-current="page" href="{{ route('users.index') }}">users</a>
                </li> 
                @endcan

                @can('role')
                <li class="nav-item">
                    <a class="nav-link active fs-6" aria-current="page" href="{{ route('roles.index') }}">roles</a>
                </li> 
                @endcan
                
            
                
                <li class="nav-item">
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link fs-6">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                    
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
