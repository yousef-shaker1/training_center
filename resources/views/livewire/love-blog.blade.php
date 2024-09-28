<div class="d-inline-block d-flex flex-column align-items-center">
    @if (in_array($blogId, $love_blogs))
        <a class="heart_mark mb-2" wire:click="delLove({{ $blogId }})"><i class="fa fa-heart"></i></a>
    @else
        <a class="heart_mark mb-2" wire:click="addLove({{ $blogId }})"><i class="ti-heart"></i></a>
    @endif
    <p class="like-info mb-0">
        <span class="align-middle me-2"><i class="fa fa-heart"></i></span> {{ $count_love }}
        people like this
    </p>
</div>
