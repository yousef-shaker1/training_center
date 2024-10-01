<div>
    <!-- Delete Student Modal -->
    <div wire:ignore.self class="modal fade" id="deleteContact_usModal" tabindex="-1" aria-labelledby="deleteContact_usModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteContact_usModalLabel">Delete Message</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="closeModal">&times;</button>
                </div>
                <form wire:submit.prevent="destroyContact">
                    <div class="modal-body">
                        <h4>Are you sure you want to delete this message ?</h4>
                        <label>الرسالة</label>
                        <input type="text" wire:model.lazy="message" class="form-control" readonly>
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
