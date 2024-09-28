<div>
    <div class="container-fluid p-4">
        @include('livewire.model-model-comment')
    
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
                                        <th>name user</th>
                                        <th>title blog</th>
                                        <th>comment</th>
                                        <th>Operations</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;?>
                                    @foreach ($comments as $comment)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $comment->user->name }}</td>
                                            <td>{{ $comment->blog->title }}</td>
                                            <td>{{ $comment->comment }}</td>
                                            <td>
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#deleteCommentModal" wire:click="deleteComment_Blog({{ $comment->id }})" class="btn btn-sm btn-outline-danger mx-1">
                                                    delete
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
    
                            <!-- Pagination -->
                            <div class="d-flex justify-content-center my-4">
                                {{ $comments->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
