<x-layout>
    <x-settings heading="Generate Posts From Github Repo">
        <form method="POST" action="{{route('posts.github.store')}}" enctype="multipart/form-data">
            @csrf


            <x-form.input name="repo_name" required />
            <x-form.input name="thumbnail" type="file" required />

            <x-form.button class="mt-4">Publish</x-form.button>
        </form>
    </x-settings>
</x-layout>
