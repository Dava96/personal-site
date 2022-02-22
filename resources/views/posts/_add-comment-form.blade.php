<x-panel>
    @auth
        <form method="POST" action="/posts/{{ $post->slug }}/comments">
            @csrf
            <header class="flex items-center">
                <img src="https://i.pravatar.cc/100?u={{auth()->id()}}" alt="" width="40" height="40"
                     class="rounded-xl">
                <h2 class="ml-4">Join the conversation!</h2>
            </header>
            <div class="mt-5">
                            <textarea class="w-full text-sm bg-gray-100 focus:outline-none focus:ring"
                                      name="body"
                                      rows="5"
                                      placeholder="Leave a comment..."
                                      required></textarea>
                @error('body')
                <span class="text-xs text-red-500"> {{$message}} </span>
                @enderror
            </div>

            <div class="flex justify-end mt-6 border-t border-gray-400 pt-6">
                <x-form.button>
                    Post
                </x-form.button>
            </div>
        </form>
    @else
        <header class="">
            <h2 class="mb-5 text-center">You need to log in or register an account to post a comment!</h2>
        </header>
    <div class="flex">

        <a href="/login"
           class="flex-1 text-center mx-12 bg-gray-700 text-white font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-gray-800">
            Log in
        </a>

        <a href="/register"
           class="flex-1 text-center mx-12 bg-gray-700 text-white font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-gray-800">
            Register
        </a>
    </div>
    @endauth
</x-panel>
