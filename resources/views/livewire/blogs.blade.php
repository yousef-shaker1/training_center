<div>
    <div class="container-fluid p-4">
        @include('livewire.model-blog')
    
        @if (session()->has('message'))
            <div class="alert alert-success" role="alert">
                <strong>{{ session()->get('message') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('delete') }}</strong>
            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Section Management</h5>
                            @can('create_blog')
                            <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addBlogModal">
                                Add New Blog
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
                                        <th>img</th>
                                        <th>title</th>
                                        <th>body</th>
                                        <th>comment</th>
                                        <th>Operations</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;?>
                                    @foreach ($blogs as $blog)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>
                                                <a href="{{ Storage::url($blog->img) }}">
                                                    <img src="{{ Storage::url($blog->img) }}" class="img-thumbnail" style="width: 80px; height: 50px;">
                                                </a>
                                            </td>
                                            <td>{{ $blog->title }}</td>
                                            <td>{{ $blog->body }}</td>
                                            <td><a href="{{ route('show_comment', $blog->id) }}">show coment</a></td>
                                            <td>
                                                @can('edit_blog')
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#updateBlogModal" wire:click="editBlog({{ $blog->id }})" class="btn btn-sm btn-outline-info mx-1">
                                                    edit
                                                </button>
                                                @endcan
                                                @can('delete_blog')
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#deleteBlogModal" wire:click="deleteBlog({{ $blog->id }})" class="btn btn-sm btn-outline-danger mx-1">
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
                                {{ $blogs->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
