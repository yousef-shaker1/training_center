<div>
    <div class="container-fluid p-4">
        @include('livewire.model-section')
    
        @if (session()->has('message'))
            <div class="alert alert-success" role="alert">
                <strong>{{ session()->get('message') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Section Management</h5>
                            @can('create_section')
                            <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addSectionModal">
                                Add New Section
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
                                        <th>Operations</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sections as $index => $section)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <a href="{{ Storage::url($section->img) }}">
                                                    <img src="{{ Storage::url($section->img) }}" class="img-thumbnail" style="width: 80px; height: 50px;">
                                                </a>
                                            </td>
                                            <td>{{ $section->name }}</td>
                                            <td>
                                                @can('edit_section')
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#updateSectionModal" wire:click="editSection({{ $section->id }})" class="btn btn-sm btn-outline-info mx-1">
                                                    edit
                                                </button>
                                                @endcan
                                                
                                                @can('delete_section')
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#deleteSectionModal" wire:click="deleteSection({{ $section->id }})" class="btn btn-sm btn-outline-danger mx-1">
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
                                {{ $sections->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
