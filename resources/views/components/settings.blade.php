@props(['heading'])

<section class="py-8 max-w-3xl mx-auto">
    <h1 class="text-lg font-bold mb-8 pb-2 border-b text-center">
        {{$heading}}
    </h1>

        <main class="flex">

            <x-panel class="flex">

                <div class="flex">
                    <div class="overflow-hidden border-r sm:rounded-lg mr-5">
                        <aside class="w-48 mr-1 pl-2 flex-shrink-0">
                            <h4 class="font-semibold mb-1 mt-2 text-center border-b">
                                Links
                            </h4>
                            <ul>
                                <li class="px-3 py-4 whitespace-nowrap border-b rounded min-w-full">
                                    <a href="/admin/posts" class="{{request()->is('admin/posts') ? 'text-blue-500' : ''}}">All Posts</a>
                                </li>
                                <li class="px-3 py-4 whitespace-nowrap border-b rounded min-w-full">
                                    <a href="/admin/posts/create" class="{{request()->is('admin/posts/create') ? 'text-blue-500' : ''}}">New Post</a>
                                </li>
                                <li class="px-3 py-4 whitespace-nowrap border-b rounded min-w-full">
                                    <a href="/admin/posts/github-create" class="{{request()->is('admin/posts/github-create') ? 'text-blue-500' : ''}}">Github New Post</a>
                                </li>

                            </ul>
                        </aside>
                    </div>

                {{$slot}}
            </x-panel>
        </main>
    </div>
</section>
