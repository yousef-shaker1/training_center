@extends('layouts.master_admin')


@section('title')
payments
@endsection

@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

@endsection

@section('content')
<div class="row">
  @if (session()->has('delete'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>{{ session()->get('delete') }}</strong>
      </div>
  @endif
  <div class="container-fluid p-2"> 
    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-3"> 
                <div class="card-body p-2"> 
                    <div class="table-responsive">
                        <table id="example1" class="table table-hover text-center table-sm"> 
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>name user</th>
                                    <th>course</th>
                                    <th>price</th>
                                    <th>time</th>
                                    <th>Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($payments as $payment)
                                    <tr>
                                        <td>{{ $payments->firstItem() + $loop->index }}</td>
                                        <td>{{ $payment->user->name }}</td>
                                        <td>{{ $payment->course->name }}</td>
                                        <td>{{ $payment->course->price }}$</td>
                                        <td>{{ \Carbon\Carbon::parse($payment->created_at)->format('h:i A - d-m-Y') }}</td>
                                        <td>
                                        @can('delete_payment')
                                         <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                            data-id="{{ $payment->id }}" data-user="{{ $payment->user->name }}"  data-course="{{ $payment->course->name }}"
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
                          @if ($payments->hasPages())
                              <ul class="pagination justify-content-center">
                                  @if ($payments->onFirstPage())
                                      <li class="page-item disabled"><span class="page-link">السابق</span></li>
                                  @else
                                      <li class="page-item"><a href="{{ $payments->previousPageUrl() }}" class="page-link" rel="prev">السابق</a></li>
                                  @endif

                                  @foreach (range(1, $payments->lastPage()) as $page)
                                      <li class="page-item {{ $page == $payments->currentPage() ? 'active' : '' }}">
                                          <a href="{{ $payments->url($page) }}" class="page-link">{{ $page }}</a>
                                      </li>
                                  @endforeach

                                  @if ($payments->hasMorePages())
                                      <li class="page-item"><a href="{{ $payments->nextPageUrl() }}" class="page-link" rel="next">التالي</a></li>
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
            <form action="{{ route('payment_destroy', $i) }}" method="post">
                @method('delete')
                @csrf
                <div class="modal-body">
                    <p>هل انت متأكد من عملية الحذف؟</p><br>
                    <input type="hidden" name="id" id="id" value="">
                    <label>اسم العميل</label>
                    <input class="form-control" name="user" id="user" type="text" value="" readonly>
                    <label>اسم الكورس</label>
                    <input class="form-control" name="course" id="course" type="text" value="" readonly>
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


$(document).ready(function() {
    $('#modaldemo9').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id'); 
        var user = button.data('user');
        var course = button.data('course');
        var modal = $(this);
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #user').val(user); 
        modal.find('.modal-body #course').val(course);
    });
});


  </script> 
@endsection
