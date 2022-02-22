@props(['post'])
<div class="border-b border-blue-200 flex items-center lg:justify-center text-sm mt-4 pb-2">

    <a href="{{$post->repo->html_url}}" class="hover:text-blue-500">
        <img src="/icons/github-logo-sm.png" class="w-12 h-12 rounded-xl" alt="Users Github">
        <div class="ml-3 text-left">
            <h5 class="font-bold">
                {{ $post->author->github_username }}
            </h5>
    </a>
</div>

</div>

<div class="border-b border-blue-200 flex items-center lg:justify-center text-sm mt-4 pb-2">

    <img src="/icons/star-24.svg" class="w-4 h-4 rounded-xl" alt="Amount of Stars">
    <div class="ml-3 text-left mr-3">
        <h5 class="font-bold">
            {{ $post->repo->stargazers_count}}
        </h5>
    </div>

    <img src="/icons/eye-24.svg" class="w-4 h-4 rounded-xl" alt="Amount of Stars">
    <div class="ml-3 text-left mr-3">
        <h5 class="font-bold">
            {{ $post->repo->watchers_count}}
        </h5>
    </div>

    <img src="/icons/repo-forked-24.svg" class="w-4 h-4 rounded-xl" alt="Amount of Stars">
    <div class="ml-3 text-left mr-3">
        <h5 class="font-bold">
            {{ $post->repo->forks_count}}
        </h5>
    </div>
</div>

<div class="border-b border-blue-200 flex items-center lg:justify-center text-sm mt-4 pb-2">

    <img src="/icons/clock-24.svg" class="w-4 h-4 rounded-xl" alt="Amount of Stars">
    <div class="ml-3 text-left mr-3">
        <h5 class="font-bold">
            Created:
            <time>{{ ($post->repo->created_at->format('j F, Y'))}} </time>
        </h5>
    </div>

</div>

<div class="border-b border-blue-200 flex items-center lg:justify-center text-sm mt-4 pb-2">

    <img src="/icons/clock-24.svg" class="w-4 h-4 rounded-xl" alt="Amount of Stars">
    <div class="ml-3 text-left mr-3">
        <h5 class="font-bold">
            Updated:
            <time>{{ ($post->repo->updated_at->format('j F, Y'))}} </time>
        </h5>
    </div>
</div>
