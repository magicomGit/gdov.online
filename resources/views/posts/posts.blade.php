
<x-app-layout>
    <div class="max-w-7xl mx-auto px-4">
        <H2 class="text-4xl font-bold border-b border-gray-300 py-2 mb-4">Интересные события</H2>

        <div class="pb-4  flex flex-col gap-4">

            @foreach ($posts as $post)
                <div class="flex flex-col sm:flex-row  gap-3">
                    <div class="sm:w-1/2 ">
                        <a href={{ route('post.show', $post->id) }}>
                            <div class="w-full overflow-hidden max-w-[600px]">
                                <img class=" hover:opacity-90 transition duration-200 ease-in-out"
                                    src="img/{{ $post->pictures[0]->path }}/600-{{ $post->pictures[0]->picture }} " />
                            </div>
                        </a>
                    </div>

                    <div class="sm:w-1/2 flex flex-col sm:justify-between border-b sm:border-none ">
                        <a href={{ route('post.show', $post->id) }}
                            class="block  text-3xl font-semibold hover:text-[#3C8C73] text-[#2f6d59] transition-colors duration-200 ease-in-out">
                            {{ $post->title }}
                        </a>
                        <div class="pt-2  text-sm sm:order-2">{{ $post->created_at->format('d.m.Y') }}</div>
                        <div class="">{!! $post->preview !!}</div>
                    </div>
                </div>
            @endforeach
            {{ $posts }}
        </div>

        {{-- <x-pagination :posts="$posts" /> --}}
    </div>


    {{-- @once
        @push('css')
            <link rel="stylesheet" href="/css/trix.css">
        @endpush
    @endonce --}}
</x-app-layout>

<script>
    document.querySelector('#menu').scrollIntoView({block: 'start'});
</script>
