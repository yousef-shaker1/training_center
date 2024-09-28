@extends('layouts.master_admin')


@section('title')
comments 
@endsection

@section('content')
@livewire('comments')


    </div>

  </div>
@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  window.addEventListener('close-modal', event => {
      $('#deleteCommentModal').modal('hide');
  });
</script>
@endsection