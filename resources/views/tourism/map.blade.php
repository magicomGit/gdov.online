<x-app-layout>
    <div class="max-w-7xl  mx-auto px-4 min-h-[60vh] ">

        <H2 class="sm:text-4xl text-2xl font-bold border-b border-gray-300 py-2 mb-4">Достопримечательности Гдовского
            района</H2>

        <div class="flex  flex-col md:flex-row">

            <div class="order-2 sm:pt-10 text-2xl flex flex-col gap-5 max-w-[550px] ">

                <div onmouseover="ChangeContent(fort, '{{ config('app.url') }}/img/culture/fort.webp')">
                    <a id="fort-link" href=""
                        class="hover:text-[#3C8C73] text-[#2f6d59] transition-all duration-600 delay-150 ease-in-out font-bold">
                        Гдовская крепость
                    </a>
                    <p class="text-base text-gray-500">
                        Гдовский кремль известен с XIV века. Впервые каменная крепость-город Гдов, названный "городком"
                        был упомянут в летописи в 1323 году в Псковской первой летописи (Тихоновский список).
                    </p>
                </div>

                <div onmouseover="ChangeContent(hram, '{{ config('app.url') }}/img/culture/hram.webp')">
                    <a id="fort-link" href=""
                        class="hover:text-[#3C8C73] text-[#2f6d59] transition-all duration-600 delay-150 ease-in-out font-bold">Собор
                        в честь Державной иконы Божией Матери</a>
                    <p class="text-base">
                        Построен в 1989—1993 годах на фундаменте собора Димитрия Солунского. На стене храма есть
                        мемориальная доска в память о Псковской миссии.
                    </p>
                </div>

                <div onmouseover="ChangeContent(museum, '{{ config('app.url') }}/img/culture/museum.webp')">
                    <a target="_blank" href="http://gdovmus.ru"
                        class="hover:text-[#3C8C73] text-[#2f6d59] transition-colors duration-150 ease-in-out font-bold">Гдовский
                        музей истории края</a>
                    <p class="text-base">
                        Гдовский краеведческий был основан в 1919 году силами членов Географического общества и
                        представителями местной интеллигенции.
                    </p>
                </div>
                <div onmouseover="ChangeContent(aist, '{{ config('app.url') }}/img/culture/aist.webp')">
                    <a target="_blank" href="https://vk.com/aistiniydom"
                        class="hover:text-[#3C8C73] text-[#2f6d59] transition-colors duration-150 ease-in-out font-bold">
                        Дом белого аиста</a>
                    <p class="text-base">
                        Волонтёрский центр "Дом Белого Аиста" - место, где помогают аистам, попавшим в трудные жизненные
                        обстоятельства. д.Низовицы.
                    </p>
                </div>
                <div onmouseover="ChangeContent(samolvarf, '{{ config('app.url') }}/img/culture/samolvarf.webp')">
                    <a target="_blank" href="https://самолва.рф"
                        class="hover:text-[#3C8C73] text-[#2f6d59] transition-colors duration-150 ease-in-out font-bold">
                        «Музей Ледовое побоище. Самолва»</a>
                    <p class="text-base">
                        В центре деревни Самолва, недалеко от здания основной Самолвовской школы, находится двухэтажный
                        деревянный сруб, с одной стороны дубы, с другой – сосновая аллея. В этом доме теперь «живет»
                        частное учреждение культуры «Музей Ледовое побоище. Самолва». На первом этаже здания
                        разместились два зала: основной и малый.
                    </p>
                </div>
            </div>
            {{-- ------------------------------------------- --}}
            <div style="background-image: url({{ config('app.url', 'http://localhost') }}/img/culture/svit.webp)"
                class="hidden md:block my-4 bg-contain bg-no-repeat w-[500px] h-[700px] mx-6 py-20 pr-8 pl-10">


                <div id="content-block" class="transition-all duration-500 ease-in-out">


                    <img id="img" src="{{ config('app.url') }}/img/culture/fort.webp"
                        class="shadow-md rounded-md">
                    <div id="text" class="p-3 hidden lg:block text-[#124132] font-bold">
                        Гдовский кремль известен с XIV века. Впервые каменная крепость-город Гдов, названный «городком»
                        был упомянут в летописи в 1323 году в Псковской первой летописи (Тихоновский список).
                    </div>

                </div>



            </div>
        </div>
    </div>
</x-app-layout>

<script>
document.querySelector('#menu').scrollIntoView({block: 'start'});


    const fort = 'Гдовский кремль известен с XIV века. Впервые каменная крепость-город Гдов, названный «городком»'+
                        ' был упомянут в летописи в 1323 году в Псковской первой летописи (Тихоновский список).'

    const hram =      'Собор в честь Державной иконы Божией Матери. Построен в 1989—1993 годах на фундаменте собора Димитрия Солунского. На стене храма есть мемориальная доска в память о Псковской миссии.'

    const museum = 'Гдовский краеведческий был основан в 1919 году силами членов Географического общества и представителями местной интеллигенции.'

    const samolvarf = 'В центре деревни Самолва, недалеко от здания основной Самолвовской школы, находится двухэтажный деревянный сруб, с одной стороны дубы, с другой – сосновая аллея. В этом доме теперь «живет» частное учреждение культуры «Музей Ледовое побоище. Самолва». На первом этаже здания разместились два зала: основной и малый.'

    const aist = 'Волонтёрский центр «Дом Белого Аиста» - место, где помогают аистам, попавшим в трудные жизненные обстоятельства. д.Низовицы.'

    function ChangeContent(text, src) {
        const contentBlock = document.querySelector('#content-block');
        const description = document.querySelector('#text');
        const img = document.querySelector('#img');

        //contentBlock.style.visibility = 'hidden'
        description.innerHTML = text
        img.src = src
        //contentBlock.style.visibility = 'visible'

    }

    // function LinkOut(id) {
    //     const fort = document.querySelector(id);
    //     fort.style.visibility = 'hidden'
    //     fort.classList.remove('opacity-100')
    //     fort.classList.add('opacity-0')
    // }
</script>










{{-- <div id="fort"
                    class="absolute bottom-[700px] left-1 border-2 border-yellow-600 w-[200px] h-[40px] overflow-hidden
                    transition-all duration-500 ease-in-out">
                    <a href="">
                        <div class="relative">
                            <img src="{{ config('app.url', 'http://localhost') }}/img/fort.webp" class="">
                        </div>
                    </a>
                </div>
                <div class="absolute bottom-[700px] left-1  p-1 text-center  w-[200px] h-[40px] bg-white text-2xl font-bold opacity-70">
                    Крепость
                </div>

                <div id="hram"
                    class="absolute bottom-[650px] left-1 border-2 border-yellow-600 w-[200px] h-[40px] overflow-hidden
                    transition-all duration-500 ease-in-out">
                    <a href="">
                        <div class="relative">
                            <img src="{{ config('app.url', 'http://localhost') }}/img/hram.webp" class="">
                        </div>
                    </a>
                </div>
                <div class="absolute bottom-[650px] left-1  p-1 text-center  w-[200px] h-[40px] bg-white text-2xl font-bold opacity-70">
                    Храм
                </div>

                <div id="museum"
                    class="absolute bottom-[600px] left-1 border-2 border-yellow-600 w-[200px] h-[40px] overflow-hidden
                    transition-all duration-500 ease-in-out">
                    <a href="">
                        <div class="relative">
                            <img src="{{ config('app.url', 'http://localhost') }}/img/museum.webp" class="">
                        </div>
                    </a>
                </div>
                <div class="absolute bottom-[600px] left-1  p-1 text-center  w-[200px] h-[40px] bg-white text-2xl font-bold opacity-70">
                    Музей
                </div> --}}
