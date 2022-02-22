@props(['post'])

<img src="{{$post->author->avatar_url ?? '/images/lary-avatar.svg'}}" class="w-14 h-14 rounded-xl w-full" alt="Users Avatar">
<div class="ml-3 text-left">
    <h5 class="font-bold">
        {{ $post->author->username }}
    </h5>
