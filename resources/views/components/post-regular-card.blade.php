@props(['post']) {{-- DONT THINK ITS WORKING --}}

<article
    {{ $attributes->merge(['class' => 'transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl']) }}>
    <div class="py-6 px-5">
        <div>
            <a href="/posts/{{ $post->slug }}">
                @include('posts._post-picture')
            </a>
        </div>

        <div class="mt-8 flex flex-col justify-between">
            <header>
                <div class="space-x-2">
                    <x-category-button :category="$post->category" class="w-15 h-15"/>
                </div>

                <div class="mt-4">
                    <h1 class="text-3xl">
                        <a href="/posts/{{ $post->slug }}">
                            {{ $post->title }}
                        </a>
                    </h1>

                    <span class="mt-2 block text-gray-400 text-xs">
                    Published <time>{{ $post->created_at->diffForHumans()}}</time>
                                    </span>
                </div>
            </header>

            <div class="prose text-sm mt-4">
                <p>
                    {{ $post->excerpt }}
                </p>
            </div>

            <footer class="flex justify-between items-center mt-8">
                <div class="flex items-center text-sm">
                    <a href="/?author={{ $post->author->username}}">
                        <x-user-information :post="$post"/>
                    </a>
                </div>
        </div>

        <div>
            <x-link-button :post="$post"/>
        </div>
        </footer>
    </div>
    </div>
</article>
