@extends('layouts.master_admin')


@section('title')
instructors
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
  <div class="container-fluid p-4">
    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">instructors Management</h5>
                        @can('create_instructor')
                        <button type="button" class="btn btn-light" data-toggle="modal" href="#exampleModal">
                            Add New instructor
                        </button>
                        @endcan

                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-hover text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>image</th>
                                    <th>name</th>
                                    <th>experince</th>
                                    <th>section</th>
                                    <th>description</th>
                                    <th>Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;?>
                                @foreach ($Instructors as $instructor)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>
                                            <a href="{{ Storage::url($instructor->img) }}">
                                                <img src="{{ Storage::url($instructor->img) }}" class="img-thumbnail" style="width: 80px; height: 50px;">
                                            </a>
                                        </td>
                                        <td>{{ $instructor->name }}</td>
                                        <td>{{ $instructor->year_experience }} year</td>
                                        <td>{{ $instructor->section->name }}</td>
                                        <td>{{ $instructor->description }}</td>
                                        
                                        <td>
                                            @can('edit_instructor')
                                            <a class="modal-effect btn btn-sm btn-info custom-btn"
                                            data-effect="effect-scale" data-id="{{ $instructor->id }}"
                                            data-img="{{ $instructor->img }}" data-name="{{ $instructor->name }}"
                                            data-description="{{ $instructor->description }}"
                                            data-year_experience="{{ $instructor->year_experience }}"
                                            data-section_id="{{ $instructor->section_id }}"
                                            data-toggle="modal" href="#exampleModal2" title="تعديل">تعديل
                                            <i class="las la-pen"></i>
                                            </a>
                                            @endcan
                                            @can('delete_instructor')
                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                            data-id="{{ $instructor->id }}" data-name="{{ $instructor->name }}"
                                            data-toggle="modal" href="#modaldemo9" title="حذف">حذف<i class="las la-trash"></i></a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center my-4">
                          @if ($Instructors->hasPages())
                              <ul class="pagination justify-content-center">
                                  <!-- زر الصفحة السابقة -->
                                  @if ($Instructors->onFirstPage())
                                      <li class="page-item disabled"><span class="page-link">السابق</span></li>
                                  @else
                                      <li class="page-item"><a href="{{ $Instructors->previousPageUrl() }}"
                                              class="page-link" rel="prev">السابق</a></li>
                                  @endif

                                  <!-- أرقام الصفحات -->
                                  @foreach (range(1, $Instructors->lastPage()) as $page)
                                      <li class="page-item {{ $page == $Instructors->currentPage() ? 'active' : '' }}">
                                          <a href="{{ $Instructors->url($page) }}"
                                              class="page-link">{{ $page }}</a>
                                      </li>
                                  @endforeach

                                  <!-- زر الصفحة التالية -->
                                  @if ($Instructors->hasMorePages())
                                      <li class="page-item"><a href="{{ $Instructors->nextPageUrl() }}"
                                              class="page-link" rel="next">التالي</a></li>
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


      <!-- add -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">اضافة قسم</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <form action="{{ route('instructor.store') }}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="modal-body">
                          <div class="form-group">
                              <label for="name">اسم المدرب</label>
                              <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                              @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                          </div>
                          <div class="form-group">
                              <label for="year_experience">خبرتة</label>
                              <input type="text" class="form-control" id="year_experience" name="year_experience" value="{{ old('year_experience') }}">
                            @error('year_experience')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group">
                            <label for="description">شرح بسيط</label>
                            <input type="text" class="form-control" id="description" name="description" value="{{ old('description') }}">
                            @error('description')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group">
                            <label for="name">القسم التابع لية</label>
                              <br>
                              <select name="section_id" id="section_id" required value="{{ old('section_id') }}">
                                <option value="" selected disabled>- حدد القسم -</option>
                                @foreach ($sections as $section)
                                <option value="{{ $section->id }}">{{ $section->name }}</option>
                                @endforeach
                            </select>
                            @error('section_id')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                        <br><br>
                        <div class="form-group">
                            <label for="img">صورة القسم</label>
                            <input type="file" class="form-control" id="img" name="img" value="{{ old('img') }}">
                            @error('img')<div class="text-danger">{{ $message }}</div>@enderror
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button type="submit" class="btn btn-success">تاكيد</button>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">تعديل المدرب</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editInstructorForm" action="{{ route('instructor.update', $i) }}" method="POST" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <input type="hidden" id="id" name="id">
                        
                        <div class="form-group">
                            <label for="name">اسم المدرب</label>
                            <input type="text" class="form-control" id="name" name="name">
                            @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="description">وصف المدرب</label>
                            <input type="text" class="form-control" id="description" name="description">
                            @error('description')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="year_experience">سنوات الخبرة</label>
                            <input type="text" class="form-control" id="year_experience" name="year_experience">
                            @error('year_experience')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                        
                        <div class="form-group">
                                <label for="section_id">القسم</label>
                                <select name="section_id" id="section_id" class="form-control" required>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}"  {{ $section->id == $instructor->section_id ? 'selected' : '' }}>{{ $section->name }}</option>
                                    @endforeach
                                </select>
                                @error('section_id')<div class="text-danger">{{ $message }}</div>@enderror
                            
                            @error('section_id')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                        <label for="current_img" class="col-form-label">الصورة الحالية للقسم:</label>
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
                <h6 class="modal-title">حذف القسم</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('instructor.destroy', $i) }}" method="post">
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
    var year_experience = $(this).data('year_experience');
    var section_id = $(this).data('section_id');

    $('#exampleModal2 #id').val(id);
    $('#exampleModal2 #name').val(name);
    $('#exampleModal2 #description').val(description);
    $('#exampleModal2 #year_experience').val(year_experience);
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
