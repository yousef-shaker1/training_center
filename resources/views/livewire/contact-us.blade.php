<div>
    <div class="container-fluid p-4">
        @include('livewire.model-contact-us')
    
        @if (session()->has('delete'))
            <div class="alert alert-danger" role="alert">
                <strong>{{ session()->get('delete') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-hover text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>name</th>
                                        <th>email</th>
                                        <th>message</th>
                                        <th>Operations</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;?>
                                    @foreach ($Contact_us as $Contact)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $Contact->name }}</td>
                                            <td>{{ $Contact->email }}</td>
                                            <td>{{ $Contact->message }}</td>
                                            <td>
                                                @can('delete_contact_us')
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#deleteContact_usModal" wire:click="deleteContact({{ $Contact->id }})" class="btn btn-sm btn-outline-danger mx-1">
                                                    delete
                                                </button>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
    
                            <!-- Pagination -->
                            <div class="d-flex justify-content-center my-4">
                                {{ $Contact_us->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
