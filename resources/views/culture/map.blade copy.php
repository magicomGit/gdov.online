<x-app-layout>
    <div class="max-w-7xl  mx-auto px-4 min-h-[60vh]">

        <div class="flex flex-wrap justify-center gap-2 py-2">

            <div id="museum" onclick="layerSelect('museum', '#ed4543')"
                class="flex items-center gap-3 border-2  px-3  rounded-lg bg-white shadow-md cursor-pointer
                 hover:border-[#ed4543] border-gray-300 transition duration-300 ease-in-out">
                <div class="w-12 ">
                    <x-svg.museum :color="'#ed4543'" />
                </div>
                <div class="text-[#ed4543] font-bold">Музеи</div>
            </div>

            <div id="monument" onclick="layerSelect('monument', '#97a100')"
                class="flex items-center gap-3 border-2  px-3  rounded-lg bg-white shadow-md cursor-pointer
                hover:border-[#97a100] border-gray-300 transition duration-300 ease-in-out">
                <div class="h-10 ">
                    <x-svg.monument :color="'#97a100'" />
                </div>
                <div class="text-[#97a100] font-bold">Памятники</div>
            </div>

            <div id="arch" onclick="layerSelect('arch', '#793d0e')"
                class="flex items-center gap-3 border-2  px-3  rounded-lg bg-white shadow-md cursor-pointer
                hover:border-[#793d0e] border-gray-300 transition duration-300 ease-in-out">
                <div class="h-10 ">
                    <x-svg.arch :color="'#793d0e'" />
                </div>
                <div class="text-[#793d0e] font-bold">Архитектура</div>
            </div>

            <div id="religion" onclick="layerSelect('religion', '#1bad03')"
                class="flex items-center gap-3 border-2  px-3  rounded-lg bg-white shadow-md cursor-pointer
                hover:border-[#1bad03] border-gray-300 transition duration-300 ease-in-out">
                <div class="h-12 ">
                    <x-svg.religion :color="'#1bad03'" />
                </div>
                <div class="text-[#1bad03] font-bold">Церкви</div>
            </div>

            <div id="hotel" onclick="layerSelect('hotel', '#0e4779')"
                class="flex items-center gap-3 border-2  px-3  rounded-lg bg-white shadow-md cursor-pointer
                hover:border-[#0e4779] border-gray-300 transition duration-300 ease-in-out">
                <div class="h-12 ">
                    <x-svg.hotel :color="'#0e4779'" />
                </div>
                <div class="text-[#0e4779] font-bold">Базы отдыха</div>
            </div>
        </div>




        <div id="map" style=" height: 500px"></div>


    </div>
</x-app-layout>

<script src="https://api-maps.yandex.ru/2.1/?apikey=4adcaf3b-9daf-4fa8-94da-121704fbfc5e&lang=ru_RU"
    type="text/javascript"></script>

<script type="text/javascript">
    var appUrl = '{{ config('app.url') }}';

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


    var markers = [{
            layer: 'museum',
            coord: [58.28996536, 27.62414847],
            title: 'Музей Ледового побоища',
            img: appUrl + '/img/culture/samolvarf.webp',
            description: 'Гдовский район, д.Самолва',
            link: appUrl + '#',
            iconColorPreset: 'islands#redIcon',
        },

        {
            layer: 'museum',
            coord: [58.29005606, 27.62023656],
            title: 'Музей рыбацкого края',
            img: appUrl + '/img/culture/musambar.webp',
            description: 'Гдовский район, д.Самолва',
            link: appUrl + '#',
            iconColorPreset: 'islands#redIcon',
        },

        {
            layer: 'monument',
            coord: [58.29807890, 27.62006890],
            title: 'Александр Невский с дружиной',
            img: appUrl + '/img/culture/icefight.webp',
            description: 'Гдовский район, д.Самолва',
            link: appUrl + '#',
            iconColorPreset: 'islands#oliveStretchyIcon',
        }
        //olive brow darkGreen night
    ]

    function layerSelect(name, color) {
        layerCollection[name] = !layerCollection[name];
        let layer = document.querySelector('#' + name);



        if (layerCollection[name]) {

            myMap.geoObjects.add(placemarkCollections[name])
            layer.classList.add('border-[' + color + ']')
        } else {
            myMap.geoObjects.remove(placemarkCollections[name])
            layer.classList.remove('border-[' + color + ']')
        }
    }






    ymaps.ready(init);

    function init() {

        // Создаем карту
        myMap = new ymaps.Map("map", {
            center: [58.52461183, 27.84345160],
            zoom: 9,
            controls: [
                'zoomControl'
            ],
            zoomMargin: [20]
        });

        museumClusterer = new ymaps.Clusterer({// Макет метки кластера pieChart.
            clusterIconLayout: 'default#pieChart',
            // Радиус диаграммы в пикселях.
            clusterIconPieChartRadius: 25,
            // Радиус центральной части макета.
            clusterIconPieChartCoreRadius: 10,
            // Ширина линий-разделителей секторов и внешней обводки диаграммы.
            clusterIconPieChartStrokeWidth: 3,
            // Определяет наличие поля balloon.
            hasBalloon: false});
        monumentClusterer = new ymaps.Clusterer({clusterDisableClickZoom: true, preset: 'islands#oliveClusterIcons',});

        var museumCollection = new ymaps.GeoObjectCollection();
        var monumentCollection = new ymaps.GeoObjectCollection();
        var archCollection = new ymaps.GeoObjectCollection();
        var religionCollection = new ymaps.GeoObjectCollection();
        var hotelCollection = new ymaps.GeoObjectCollection();
        var iconColorPreset = '';

        markers.map((marker) => {
            plaseMarker = new ymaps.Placemark(marker.coord, {
                balloonContentHeader: marker.title,
                balloonContentBody: '<img src="' + marker.img + '" height="200" width="300"> <br/> ' +
                    marker.description + '<br/>',
                balloonContentFooter: '<a href="' + marker.link + '">Подробнее</a>',
                //iconContent: marker.title,
                // Зададим содержимое всплывающей подсказки.
                hintContent: marker.title
            }, {
                preset: marker.iconColorPreset,
            });

            switch (marker.layer) {
                case 'museum':
                    //museumCollection.add(plaseMarker);

                    museumClusterer.add(plaseMarker)
                    break;
                case 'monument':
                    monumentClusterer.add(plaseMarker);
                    break;
                case 'arch':
                    archCollection.add(plaseMarker);
                    break;
                case 'religion':
                    religionCollection.add(plaseMarker);
                    break;
                case 'hotel':
                    hotelCollection.add(plaseMarker);
                    break;

                default:
                    break;
            }

        })


        //museumClusterer.add(museumCollection);
            //myMap.geoObjects.add(clusterer)


        placemarkCollections['museum'] = museumClusterer;
        placemarkCollections['monument'] = monumentClusterer;
        placemarkCollections['arch'] = archCollection;
        placemarkCollections['religion'] = religionCollection;
        placemarkCollections['hotel'] = hotelCollection;



    }
</script>
