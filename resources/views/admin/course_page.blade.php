@extends('layouts.master_admin')


@section('title')
courses
@endsection

@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

@endsection

@section('content')
<div class="row">
  @if (session()->has('message'))
  <div class="alert alert-success" role="alert">
      <strong>{{ session()->get('message') }}</strong>
  </div>
@endif

  @if (session()->has('delete'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>{{ session()->get('delete') }}</strong>
      </div>
  @endif
  <div class="container-fluid p-2"> 
    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-3"> 
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Instructors Management</h5>
                        @can('create_course')
                        <button type="button" class="btn btn-light btn-sm" data-toggle="modal" href="#exampleModal">
                            Add New Course
                        </button>
                        @endcan
                    </div>
                </div>

                <div class="card-body p-2"> 
                    <div class="table-responsive">
                        <table id="example1" class="table table-hover text-center table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Section</th>
                                    <th>Price</th>
                                    <th>Number of Hours</th>
                                    <th>Quantity</th>
                                    <th>registrants</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                    <th>Start At</th>
                                    <th>End At</th>
                                    <th>Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($Courses as $course)
                                    <tr>
                                        <td>{{ $Courses->firstItem() + $loop->index }}</td>
                                        <td>
                                            <a href="{{ Storage::url($course->img) }}">
                                                <img src="{{ Storage::url($course->img) }}" class="img-thumbnail" style="width: 100px; "> <!-- تصغير الصورة -->
                                            </a>
                                        </td>
                                        <td>{{ $course->name }}</td>
                                        <td>{{ $course->section->name }}</td>
                                        <td>{{ $course->price }} $</td>
                                        <td>{{ $course->Numberofhours }} hours</td>
                                        <td>{{ $course->Quantity }} person</td>
                                        <td>{{ $payment->where('course_id', $course->id)->count() }} person</td>
                                        <td>{{ $course->type }}</td>
                                        <td>{{ $course->description }}</td>
                                        <td>{{ \Carbon\Carbon::parse($course->start_data)->format('d-m-Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($course->end_data)->format('d-m-Y') }}</td>
                                        <td>
                                            @can('edit_course')
                                            <a class="modal-effect btn btn-sm btn-info custom-btn"
                                            data-effect="effect-scale" data-id="{{ $course->id }}"
                                            data-img="{{ $course->img }}" data-price="{{ $course->price }}" 
                                            data-name="{{ $course->name }}"
                                            data-description="{{ $course->description }}" 
                                            data-start_data="{{ $course->start_data }}"
                                            data-number_of_hours="{{ $course->Numberofhours }}"
                                            data-Quantity="{{ $course->Quantity }}"
                                            data-type="{{ $course->type }}"
                                            data-section_id="{{ $course->section->id }}" 
                                            data-end_data="{{ $course->end_data }}"
                                            data-toggle="modal" href="#exampleModal2" title="تعديل">تعديل
                                             <i class="las la-pen"></i>
                                         </a>
                                         @endcan
                                         @can('delete_course')
                                         <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                            data-id="{{ $course->id }}" data-name="{{ $course->name }}"
                                            data-toggle="modal" href="#modaldemo9" title="حذف">حذف
                                             <i class="las la-trash"></i>
                                         </a>
                                         @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center my-4">
                          @if ($Courses->hasPages())
                              <ul class="pagination justify-content-center">
                                  @if ($Courses->onFirstPage())
                                      <li class="page-item disabled"><span class="page-link">السابق</span></li>
                                  @else
                                      <li class="page-item"><a href="{{ $Courses->previousPageUrl() }}" class="page-link" rel="prev">السابق</a></li>
                                  @endif

                                  @foreach (range(1, $Courses->lastPage()) as $page)
                                      <li class="page-item {{ $page == $Courses->currentPage() ? 'active' : '' }}">
                                          <a href="{{ $Courses->url($page) }}" class="page-link">{{ $page }}</a>
                                      </li>
                                  @endforeach

                                  @if ($Courses->hasMorePages())
                                      <li class="page-item"><a href="{{ $Courses->nextPageUrl() }}" class="page-link" rel="next">التالي</a></li>
                                  @else
                                      <li class="page-item disabled"><span class="page-link">التالي</span></li>
                                  @endif
                              </ul>
                          @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



      <!-- add -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">اضافة كورس</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('course.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">اسم الكورس</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                        @error('name') 
                          <div class="text-danger">{{ $message }}</div> 
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="price">السعر</label>
                        <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}">
                        @error('price')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="price">عدد ساعات الكورس</label>
                        <input type="text" class="form-control" id="Numberofhours" name="Numberofhours" value="{{ old('Numberofhours') }}">
                        @error('Numberofhours')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">شرح الكورس</label>
                        <input type="text" class="form-control" id="description" name="description" value="{{ old('description') }}">
                        @error('description')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="Quantity">عدد الاشخاص في الكورس</label>
                        <input type="text" class="form-control" id="Quantity" name="Quantity" value="{{ old('Quantity') }}">
                        @error('Quantity')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="type">نوع الكورس</label>
                        <select name="type" id="type" class="form-control" required>
                            <option value="" selected disabled>- حدد النوع -</option>
                                <option value="online">online</option>
                                <option value="offline">offline</option>
                                <option value="onsite">onsite</option>
                        </select>
                        @error('type')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="section_id">القسم التابع له</label>
                        <select name="section_id" id="section_id" class="form-control" required>
                            <option value="" selected disabled>- حدد القسم -</option>
                            @foreach ($sections as $section)
                                <option value="{{ $section->id }}">{{ $section->name }}</option>
                            @endforeach
                        </select>
                        @error('section_id')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="start_data">بداية الكورس</label>
                        <input type="date" class="form-control" id="start_data" name="start_data" value="{{ old('start_data') }}">
                        @error('start_data')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="end_data">نهاية الكورس</label>
                        <input type="date" class="form-control" id="end_data" name="end_data" value="{{ old('end_data') }}">
                        @error('end_data')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="img">صورة القسم</label>
                        <input type="file" class="form-control" id="img" name="img" value="{{ old('img') }}">
                        @error('img')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">تأكيد</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                </div>
            </form>
        </div>
    </div>
</div>


    <!-- Edit Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تعديل الكورس</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editInstructorForm" action="{{ route('course.update', $i) }}" method="POST" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <input type="hidden" id="id" name="id">

                    <div class="form-group">
                        <label for="name">اسم الكورس</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                        @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="description">وصف الكورس</label>
                        <input type="text" class="form-control" id="description" name="description" required>
                        @error('description')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="price">السعر</label>
                        <input type="number" class="form-control" id="price" name="price" required>
                        @error('price')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="number_of_hours">عدد ساعات الكورس</label>
                        <input type="number" class="form-control" id="number_of_hours" name="Numberofhours" required>
                        @error('number_of_hours')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="Quantity">عدد الأشخاص في الكورس</label>
                        <input type="number" class="form-control" id="Quantity" name="Quantity" required>
                        @error('Quantity')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="type">نوع الكورس</label>
                        <select name="type" id="type" class="form-control" required>
                            <option value="online">Online</option>
                            <option value="offline">Offline</option>
                            <option value="onsite">Onsite</option>
                        </select>
                        @error('type')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    

                    <div class="form-group">
                        <label for="section_id">القسم التابع للكورس</label>
                        <select name="section_id" id="section_id" class="form-control" required>
                            @foreach ($sections as $section)
                                <option value="{{ $section->id }}">{{ $section->name }}</option>
                            @endforeach
                        </select>
                        @error('section_id')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="start_data">بداية الوقت</label>
                        <input type="date" class="form-control" id="start_data" name="start_data" required>
                        @error('start_data')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="end_data">نهاية الوقت</label>
                        <input type="date" class="form-control" id="end_data" name="end_data" required>
                        @error('end_data')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>

                    <label for="current_img" class="col-form-label">الصورة الحالية للكورس:</label>
                    <br>
                    <a id="current_img_link" href="#" target="_blank">
                        <img id="current_img" src="#" style="width: 80px; height: 50px;" alt="الصورة الحالية">
                    </a>
                    <br>
                    <div class="form-group">
                        <label for="img">صورة المدرب الجديدة</label>
                        <input type="file" class="form-control" id="img" name="img">
                        @error('img')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="editInstructorForm">تاكيد</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
            </div>
        </div>
    </div>
</div>


<!-- delete -->
<div class="modal" id="modaldemo9">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">حذف الكورس</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('course.destroy', $i) }}" method="post">
                @method('delete')
                @csrf
                <div class="modal-body">
                    <p>هل انت متأكد من عملية الحذف؟</p><br>
                    <input type="hidden" name="id" id="id" value="">
                    <input class="form-control" name="name" id="name" type="text" value="" readonly>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                    <button type="submit" class="btn btn-danger">تأكيد</button>
                </div>
            </form>
        </div>
    </div>
</div>
    
    


  <!-- row closed -->
  </div>
  <!-- Container closed -->
  </div>

@endsection
@section('js')

   <script>
    $(document).on('click', '.modal-effect', function() {
    var id = $(this).data('id');
    var img = $(this).data('img');
    var name = $(this).data('name');
    var description = $(this).data('description');
    var price = $(this).data('price');
    var number_of_hours = $(this).data('number_of_hours');
    var Quantity = $(this).data('quantity');
    var type = $(this).data('type');
    var start_data = $(this).data('start_data');
    var end_data = $(this).data('end_data');
    var section_id = $(this).data('section_id');

    $('#exampleModal2 #id').val(id);
    $('#exampleModal2 #name').val(name);
    $('#exampleModal2 #description').val(description);
    $('#exampleModal2 #price').val(price);
    $('#exampleModal2 #number_of_hours').val(number_of_hours);
    $('#exampleModal2 #Quantity').val(Quantity);
    $('#exampleModal2 #type').val(type);
    $('#exampleModal2 #start_data').val(start_data);
    $('#exampleModal2 #end_data').val(end_data);
    $('#exampleModal2 #section_id').val(section_id);
    $('#current_img').attr('src', img); 
    if (img) {
        var imgUrl = '{{ Storage::url('') }}' + img; 
        $('#current_img').attr('src', imgUrl);
        $('#current_img_link').attr('href', imgUrl); 
    } else {
        $('#current_img').attr('src', 'default-image.jpg'); 
        $('#current_img_link').attr('href', '#'); 
    }
});

$(document).ready(function() {
    $('#modaldemo9').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); 
        var id = button.data('id');
        var name = button.data('name');
        var modal = $(this);
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #name').val(name);
    });
});


  </script> 
@endsection
