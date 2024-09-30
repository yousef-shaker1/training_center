<div>
    <div class="comments-area">
        <h4>{{ $count_comment }} Comments</h4>
        @foreach ($comment_blogs as $comment_blog)
        <div class="comment-list" style="margin-bottom: 20px; padding: 15px; border: 1px solid #f3e9e9; border-radius: 8px; background-color: #f9f9f9;">
            <div class="single-comment justify-content-between d-flex">
                <div class="user d-flex align-items-start">
                    <div class="desc" style="margin-left: 15px;">
                        <h4 style="margin-bottom: 5px; font-size: 16px; font-weight: 600;">{{ $comment_blog->user->name }}</h4>
                        <p class="comment" style="font-size: 14px; color: #555;">
                            {{ $comment_blog->comment }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center" style="margin-top: 10px;">
                            <p class="date" style="font-size: 12px; color: #888;">
                                {{ \Carbon\Carbon::parse($comment_blog->created_at)->format('d-M-Y') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if ($check == 1)
    <div class="comment-form" style="margin-top: 30px;">
        <h4>Leave a Reply</h4>
        <form class="form-contact comment_form" wire:submit.prevent="save_comment" method='post' id="commentForm">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <textarea class="form-control w-100" wire:model.lazy="comment" id="comment" cols="30" rows="9" placeholder="Write Comment"></textarea>
                        @error('comment') 
                        <div class='alert alert-danger'>{{ $message }}</div>
                    @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="button button-contactForm btn_1 boxed-btn">Send Message</button>
            </div>
        </form>
    </div>
    @endif
</div>
