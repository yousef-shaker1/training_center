@extends('layouts.master_admin')


@section('title')
Contact_us 
@endsection

@section('content')
@livewire('contact-us')


    </div>

  </div>
@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  window.addEventListener('close-modal', event => {
      $('#deleteContact_usModal').modal('hide');
  });
</script>
@endsection