<style>
    *,
    *::before,
    *::after {
        box-sizing: border-box;
    }

    body {
        margin: 0;
    }

    .carousel {
        width: 100%;
        position: relative;
    }

    .carousel>ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .slide {
        width: 0;
        display: block;
        inset: 0;
        opacity: 0;
        transition: 300ms opacity ease-in-out;
        transition-delay: 200ms;
    }

    .slide>img {


        object-fit: cover;
        object-position: center;
    }

    .slide[data-active] {
        width: auto;

        opacity: 1;
        z-index: 1;
        transition-delay: 0ms;
    }

    .carousel-button {
        position: absolute;
        z-index: 2;
        background: none;
        border: none;
        font-size: 4rem;
        top: 50%;
        transform: translateY(-50%);
        color: rgba(255, 255, 255, .5);
        cursor: pointer;
        border-radius: .25rem;
        padding: 0 .5rem;
        background-color: rgba(0, 0, 0, .1);
    }

    .carousel-button:hover,
    .carousel-button:focus {
        color: white;
        background-color: rgba(0, 0, 0, .2);
    }

    .carousel-button:focus {
        outline: 1px solid black;
    }

    .carousel-button.prev {
        left: 1rem;
    }

    .carousel-button.next {
        right: 1rem;
    }
    .trix-content a{
        color: blue;
    }


</style>

<x-app-layout>
    <div class="max-w-7xl  mx-auto px-4 min-h-[60vh]">


        <div class="py-4  ">
            <h2 class="text-4xl font-bold  py-2 ">{{ $post->title }}</h2>
            <div class="border-b border-gray-300 mb-3">
                {{ $post->created_at->format('d.m.Y') }}
            </div>
        </div>


        <div class="carousel relative mb-4" data-carousel>
            @if (count($post->pictures) > 1)
                <button class="carousel-button prev " data-carousel-button="prev">&#8656;</button>
                <button class="carousel-button next" data-carousel-button="next">&#8658;</button>
            @endif
            <ul data-slides>


                @for ($i = 0; $i < count($post->pictures); $i++)
                    @if ($i == 0)
                        <li class="slide " data-active>
                            <img class="max-h-[550px] mx-auto"
                                src="{{ config('app.url', 'http://localhost') }}/img/{{ $post->pictures[$i]->path }}/{{ $post->pictures[$i]->picture }} "
                                alt="">
                        </li>
                    @else
                        <li class="slide ">
                            <img class="max-h-[550px] mx-auto"
                                src="{{ config('app.url', 'http://localhost') }}/img/{{ $post->pictures[$i]->path }}/{{ $post->pictures[$i]->picture }} "
                                alt="">
                        </li>
                    @endif
                @endfor
            </ul>
        </div>
        <div class="max-w-[1024px] mx-auto mb-6">{!! $post->content !!}</div>

    </div>

    @push('trix')
    @vite(['resources/css/trix.css'])
@endpush
</x-app-layout>


<script>
    const buttons = document.querySelectorAll("[data-carousel-button]")

    buttons.forEach(button => {
        button.addEventListener("click", () => {
            const offset = button.dataset.carouselButton === "next" ? 1 : -1
            const slides = button
                .closest("[data-carousel]")
                .querySelector("[data-slides]")

            const activeSlide = slides.querySelector("[data-active]")
            let newIndex = [...slides.children].indexOf(activeSlide) + offset
            if (newIndex < 0) newIndex = slides.children.length - 1
            if (newIndex >= slides.children.length) newIndex = 0

            slides.children[newIndex].dataset.active = true
            delete activeSlide.dataset.active
        })
    })
</script>
