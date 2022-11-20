<style>
    .more {
        color: white;
        background-color: #3C8C73;
        padding: 4px;
        border: solid 1px lightgray;
    }

    .museumOff svg {
        fill: #ed4543;
    }

    .museumOff {
        color: #ed4543;
        border-color: #ed4543;
        background-color: white;
    }

    @media (min-width: 640px) {
        .museumOff:hover {
            color: white;
            border-color: white;
            background-color: #ed4543;
        }

        .museumOff:hover svg {
            fill: white;
        }
    }

    .museumOn svg {
        fill: white;
    }

    .museumOn {
        color: white;
        border-color: white;
        background-color: #ed4543;
    }

    /* ---------------------- */
    .monumentOff svg {
        fill: #97a100;
    }

    .monumentOff {
        color: #97a100;
        border-color: #97a100;
        background-color: white;
    }

    @media (min-width: 640px) {
        .monumentOff:hover {
            color: white;
            border-color: white;
            background-color: #97a100;
        }

        .monumentOff:hover svg {
            fill: white;
        }
    }

    .monumentOn svg {
        fill: white;
    }

    .monumentOn {
        color: white;
        border-color: white;
        background-color: #97a100;
    }

    /* ---------------------- */
    .archOff svg {
        fill: #793d0e;
    }

    .archOff {
        color: #793d0e;
        border-color: #793d0e;
        background-color: white;
    }

    @media (min-width: 640px) {
        .archOff:hover {
            color: white;
            border-color: white;
            background-color: #793d0e;
        }

        .archOff:hover svg {
            fill: white;
        }
    }

    .archOn svg {
        fill: white;
    }

    .archOn {
        color: white;
        border-color: white;
        background-color: #793d0e;
    }

    /* ---------------------- */
    .religionOff svg {
        fill: #1bad03;
    }

    .religionOff {
        color: #1bad03;
        border-color: #1bad03;
        background-color: white;
    }

    @media (min-width: 640px) {
        .religionOff:hover {
            color: white;
            border-color: white;
            background-color: #1bad03;
        }

        .religionOff:hover svg {
            fill: white;
        }
    }

    .religionOn svg {
        fill: white;
    }

    .religionOn {
        color: white;
        border-color: white;
        background-color: #1bad03
    }

    /* ---------------------- */
    .hotelOff svg {
        fill: #0e4779;
    }

    .hotelOff {
        color: #0e4779;
        border-color: #0e4779;
        background-color: white;
    }

    @media (min-width: 640px) {
        .hotelOff:hover {
            color: white;
            border-color: white;
            background-color: #0e4779;
        }

        .hotelOff:hover svg {
            fill: white;
        }
    }



    .hotelOn svg {
        fill: white;
    }

    .hotelOn {
        color: white;
        border-color: white;
        background-color: #0e4779
    }
</style>
<x-app-layout>
    <H2 class="sm:text-4xl text-2xl font-bold border-b border-gray-300 py-2 mb-4">Достопримечательности Гдовского
        района</H2>

    <div class="flex flex-wrap justify-center gap-2 py-2">

        <div id="museum" onclick="layerSelect('museum')"
            class="flex items-center gap-3 border-2  px-3 h-[52px] rounded-lg shadow-md cursor-pointer
                      transition duration-300 ease-in-out museumOff">
            <div class="w-12 ">
                <x-svg.museum />
            </div>
            <div class="font-bold">Музеи</div>
        </div>

        <div id="monument" onclick="layerSelect('monument')"
            class="flex items-center gap-3 border-2  px-3 h-[52px] rounded-lg shadow-md cursor-pointer
                      transition duration-300 ease-in-out monumentOff">
            <div class="h-10 ">
                <x-svg.monument />
            </div>
            <div class=" font-bold">Памятники</div>
        </div>

        <div id="arch" onclick="layerSelect('arch')"
            class="flex items-center gap-3 border-2  px-3 h-[52px] rounded-lg shadow-md cursor-pointer
                    transition duration-300 ease-in-out archOff">
            <div class="h-10 ">
                <x-svg.arch />
            </div>
            <div class="font-bold">Архитектура</div>
        </div>

        <div id="religion" onclick="layerSelect('religion')"
            class="flex items-center gap-3 border-2  px-3 h-[52px] rounded-lg shadow-md cursor-pointer
                    transition duration-300 ease-in-out religionOff">
            <div class="h-12 ">
                <x-svg.religion />
            </div>
            <div class="font-bold">Церкви</div>
        </div>

        <div id="hotel" onclick="layerSelect('hotel')"
            class="flex items-center gap-3 border-2  px-3 h-[52px] rounded-lg shadow-md cursor-pointer
                    transition duration-300 ease-in-out hotelOff">
            <div class="h-12 ">
                <x-svg.hotel />
            </div>
            <div class="font-bold">Базы отдыха</div>
        </div>
    </div>

    <div class="flex flex-wrap justify-around gap-3 mt-4">
        <x-places.fort/>
        <x-places.gdovsobor/>
        <x-places.fort/>
        <x-places.gdovsobor/>
        <x-places.gdovsobor/>
        <x-places.fort/>
    </div>

</x-app-layout>

<script>
    document.querySelector('#menu').scrollIntoView({
        block: 'start'
    });
</script>

<script type="text/javascript">



    var appUrl = '{{ config('app.url') }}';

    var colorred = "#ed4543"
    var myMap;
    var placemarkCollections = {};
    var clusterer = {};
    var layerCollection = {
        'museum': false,
        'monument': false,
        'arch': false,
        'religion': false,
        'hotel': false
    };




    function layerSelect(name) {
        layerCollection[name] = !layerCollection[name];
        let layer = document.querySelector('#' + name);



        if (layerCollection[name]) {

            layer.classList.remove(name + 'Off')
            layer.classList.add(name + 'On')
        } else {

            layer.classList.remove(name + 'On')
            layer.classList.add(name + 'Off')
        }
    }







</script>
