@if (COUNT($comments))

    @foreach ($comments as $comment)
        <div style="font-size: 13px" class="border p-3 my-2">
            <div class="text-primary"><b>{{ $comment->name }}</b></div>
            <div>{{ $comment->comment }}</div>
            <div class="text-secondary"><b><i>{{ $comment->created_at->format('F j, Y g:ia') }}</i></b></div>
        </div>
    @endforeach

@else
    <div class="text-center w-100 text-secondary">
        <i>No comment</i>
    </div>
@endif