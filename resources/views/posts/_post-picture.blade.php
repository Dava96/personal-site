@if($post->thumbnail)
    <img src="{{(asset('storage/' . $post->thumbnail)) }}" alt="Blog Post illustration" class="w-full rounded-xl">
@else
    <img src="/images/illustration-1.png" alt="Blog Post illustration" class="w-full rounded-xl">
@endif
