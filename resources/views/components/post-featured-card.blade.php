@props(['post'])

<article
    class="transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl">
    <div class="py-6 px-5 lg:flex">
        <div class="flex-1 lg:mr-8">
            <a href="/posts/{{ $post->slug }}">
                @include('posts._post-picture')
            </a>

        </div>

        <div class="flex-1 flex flex-col justify-between">
            <header class="mt-8 lg:mt-0">
                <div class="space-x-2">
                    <x-category-button :category="$post->category"/>

                    <a href="#"
                       class="px-3 py-1 border border-red-300 rounded-full text-red-500 text-xs uppercase font-semibold"
                       style="font-size: 10px">Updates</a>
                </div>

                <div class="mt-4">
                    <h1 class="text-3xl">
                        <a href="/posts/{{$post->slug}}">
                            {{$post->title}}
                        </a>
                    </h1>

                    <span class="mt-2 block text-gray-400 text-xs">
                        Published <time>{{$post->created_at->diffForHumans()}}</time>
                    </span>
                </div>
            </header>

            <div class="mt-2">
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

        <div class="hidden lg:block">
            <x-link-button :post="$post"/>
        </div>
        </footer>
    </div>
    </div>
</article>
