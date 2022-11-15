<H2 class="text-4xl font-bold border-b border-gray-300 py-2 mb-4">Последние новости</H2>

<div class=" flex flex-col sm:flex-row  gap-3  ">
    <div class="sm:w-1/2 ">
        <a href={{ route('post.show', $posts[0]->id) }}>
            <div class="w-full overflow-hidden max-w-[600px]">
                <img class="scale-100 hover:scale-105 transition-all duration-500 ease-in-out"
                    src="img/{{ $posts[0]->pictures[0]->path }}/600-{{ $posts[0]->pictures[0]->picture }} " />
            </div>
        </a>
    </div>

    <div class="sm:w-1/2 flex flex-col sm:justify-between border-b sm:border-none ">
        <a href={{ route('post.show', $posts[0]->id) }}
             class="block text-3xl font-semibold hover:text-[#3C8C73] text-[#2f6d59] transition-colors duration-200 ease-in-out">
            {{ $posts[0]->title }}
        </a>
        <div class="pt-2 text-sm sm:order-2">{{ $posts[0]->created_at->format('d.m.Y') }}</div>
        <div class="">{!! $posts[0]->preview !!}</div>


    </div>
</div>

<div class="flex flex-col gap-3 sm:flex-row my-8">
    <div class="sm:w-1/2 lg:w-1/3 border-b sm:border-none pb-3">
        <a href={{ route('post.show', $posts[1]->id) }}>
            <div class="w-full overflow-hidden ">
                <img class="scale-100 hover:scale-105 transition-all duration-500 ease-in-out"
                    src="img/{{ $posts[1]->pictures[0]->path }}/600-{{ $posts[1]->pictures[0]->picture }} " />
            </div>
        </a>
        <a href={{ route('post.show', $posts[1]->id) }}
            class="text-2xl font-semibold hover:text-[#3C8C73] text-[#2f6d59] transition-colors duration-200 ease-in-out">
            {{ $posts[1]->title }}
        </a>
        <div class="text-sm mt-3">{{ $posts[2]->created_at->format('d.m.Y') }}</div>
    </div>

    <div class="sm:w-1/2 lg:w-1/3 border-b sm:border-none pb-3">
        <a href={{ route('post.show', $posts[2]->id) }}>
            <div class="w-full overflow-hidden">
                <img class="scale-100 hover:scale-105 transition-all duration-500 ease-in-out"
                    src="img/{{ $posts[2]->pictures[0]->path }}/600-{{ $posts[2]->pictures[0]->picture }} " />
            </div>
        </a>
        <a href={{ route('post.show', $posts[2]->id) }}
            class="text-2xl font-semibold hover:text-[#3C8C73] text-[#2f6d59] transition-colors duration-200 ease-in-out">
            {{ $posts[2]->title }}
        </a>
        <div class="text-sm mt-3">{{ $posts[2]->created_at->format('d.m.Y') }}</div>
    </div>

    <div class="hidden lg:w-1/3 lg:block">
        <a href={{ route('post.show', $posts[3]->id) }}>
            <div class="w-full overflow-hidden">
                <img class="scale-100 hover:scale-105 transition-all duration-500 ease-in-out"
                    src="img/{{ $posts[3]->pictures[0]->path }}/600-{{ $posts[3]->pictures[0]->picture }} " />
            </div>
        </a>
        <a href={{ route('post.show', $posts[3]->id) }}
            class="text-2xl font-semibold hover:text-[#3C8C73] text-[#2f6d59] transition-colors duration-200 ease-in-out">
            {{ $posts[3]->title }}
        </a>
        <div class="text-sm mt-3">{{ $posts[3]->created_at->format('d.m.Y') }}</div>
    </div>
</div>
