<div>
    <!-- Insert Modal -->
    <div wire:ignore.self class="modal fade" id="addBlogModal" tabindex="-1" aria-labelledby="addBlogModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBlogModalLabel">Create Blog</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeModal">&times;</button>
                </div>
                <form wire:submit.prevent="saveBlog">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>blog title</label>
                            <input type="text" wire:model.live="title" class="form-control">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>blog body</label>
                            <input type="text" wire:model.live="body" class="form-control">
                            @error('body')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label>image blog</label>
                            <input type="file" wire:model.live="img" class="form-control">
                            @error('img') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- Update Student Modal -->
    <div wire:ignore.self class="modal fade" id="updateBlogModal" tabindex="-1"
        aria-labelledby="updateBlogModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateBlogModalLabel">Edit Section</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeModal">&times;</button>
                </div>
                <form wire:submit.prevent="updateBlog">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>blog title</label>
                            <input type="text" wire:model.live="title" class="form-control">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>blog body</label>
                            <input type="text" wire:model.live="body" class="form-control">
                            @error('body')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="current_img" class="col-form-label">الصورة الحالية للقسم:</label>
                            <br>
                            <a id="current_img_link" href="{{ Storage::url($img) }}"><img id="" src="{{ Storage::url($img) }}"
                                    style="width: 80px; height: 50px;"></a>
                            <br>
                        </div>
                        <div class="mb-3">
                            <label>صورة القسم</label>
                            <input type="file" wire:model.live="img" class="form-control">
                            @error('img') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Student Modal -->
    <div wire:ignore.self class="modal fade" id="deleteBlogModal" tabindex="-1"
        aria-labelledby="deleteBlogModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteBlogModalLabel">Delete Blog</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeModal">&times;</button>
                </div>
                <form wire:submit.prevent="destroyBlog">
                    @csrf
                    <div class="modal-body">
                        <h4>Are you sure you want to delete this data ?</h4>
                        <label>Blog title</label>
                        <input type="text" wire:model.lazy="title" class="form-control" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
