<x-app-layout>
    <div class="max-w-7xl mx-auto p-4">

        <div class="py-2  mb-2">
            <a class=" bg-[#3C8C73] p-2 px-4 text-white" href={{ route('posts.create') }}>Добавить новость</a>
        </div>

        <div class="pb-4  ">

            @foreach ($posts as $post)
                <div class="flex justify-between border border-gray-300 -mb-[1px] gap-4 p-2">
                    <div class="flex gap-4 items-center">
                        <div class="text-md ">{{ $post->created_at->format('d.m.Y') }}</div>

                            {{ $post->title }}

                    </div>

                    <div class="flex gap-4">
                        <a href={{ route('posts.edit', $post->id) }}>
                            <img class="w-6 h-6" src="{{ config('app.url', 'http://localhost') }}/img/svg/edit.svg">
                        </a>

                        <a href={{ route('post.show', $post->id) }}>
                            <img class="w-6 h-6" src="{{ config('app.url', 'http://localhost') }}/img/svg/delete.svg">
                        </a>

                    </div>



                </div>
            @endforeach
            {{ $posts }}
        </div>


    </div>



</x-app-layout>
