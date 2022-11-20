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

    <H2 class="sm:text-4xl text-2xl font-bold border-b border-gray-300 py-2 mb-4">Интерактивная карта Гдовского
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




    <div id="map" style=" height: 500px"></div>
    <div class="py-6"><img class="object-cover min-h-[60px]" src="{{ config('app.url') }}/img/orn-red.webp"
            alt=""></div>


</x-app-layout>

<script src="https://api-maps.yandex.ru/2.1/?apikey=4adcaf3b-9daf-4fa8-94da-121704fbfc5e&lang=ru_RU"
    type="text/javascript"></script>



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
        },
        {
            layer: 'arch',
            coord: [58.74084140, 27.81943020],
            title: 'Гдовская крепость',
            img: appUrl + '/img/culture/300-fort.webp',
            description: 'г.Гдов',
            link: appUrl + '#',
            iconColorPreset: 'islands#brownStretchyIcon',
        },
        {
            layer: 'religion',
            coord: [58.74012748, 27.82037434],
            title: 'Собор в честь Державной иконы</br> Божией Матери',
            img: appUrl + '/img/culture/300-hram.webp',
            description: 'г.Гдов',
            link: appUrl + '#',
            iconColorPreset: 'islands#darkGreenStretchyIcon',
        },
        {
            layer: 'hotel',
            coord: [58.43504985, 28.25809144],
            title: 'Эко Парк Большая Рыба',
            img: appUrl + '/img/culture/300-bigfish.webp',
            description: 'Гдовский район, Полновская волость. База отдыха',
            link: 'https://vk.com/bolshayariba',
            iconColorPreset: 'islands#nightStretchyIcon',
        },
        {
            layer: 'museum',
            coord: [58.74531862, 27.82056792],
            title: 'Гдовский музей истории края',
            img: appUrl + '/img/culture/300-museum.webp',
            description: 'г.Гдов',
            link: 'http://gdovmus.ru',
            iconColorPreset: 'islands#redStretchyIcon',
        },
        {
            layer: 'hotel',
            coord: [58.45906381, 27.79537661],
            title: 'Остров спасения. Дом отдыха.',
            img: appUrl + '/img/culture/300-islandsave.webp',
            description: 'Гдовский район, Раскопель.',
            link: 'https://travel.yandex.ru/hotels/pskov-oblast/ostrov-spaseniia/',
            iconColorPreset: 'islands#nightStretchyIcon',
        },
        {
            layer: 'hotel',
            coord: [58.42891325, 27.90755732],
            title: 'Точка притяжения. Дом отдыха.',
            img: appUrl + '/img/culture/300-pointgrav.webp',
            description: 'Гдовский район, д. Ореховцы.',
            link: 'https://travel.yandex.ru/hotels/pskov-oblast/ostrov-spaseniia/',
            iconColorPreset: 'islands#nightStretchyIcon',
        },
        {
            layer: 'hotel',
            coord: [58.54163167, 27.85012828],
            title: 'Гостевой дом Чудской.',
            img: appUrl + '/img/culture/300-chudskoi.webp',
            description: 'Гдовский район, д.Спицино.',
            link: 'http://chudskoi.ru',
            iconColorPreset: 'islands#nightStretchyIcon',
        },
        {
            layer: 'hotel',
            coord: [58.62486839, 27.80080202],
            title: 'Хутор Утешение, отдых на ферме.',
            img: appUrl + '/img/culture/300-hutor.webp',
            description: 'Гдовский район, д.Спицино.',
            link: 'https://yandex.ru/profile/1702594909',
            iconColorPreset: 'islands#nightStretchyIcon',
        },
        {
            layer: 'hotel',
            coord: [58.47842124, 27.88089553],
            title: 'Усадьба "Друг" </br>Отдых и Рыбалкана Чудском',
            img: appUrl + '/img/culture/300-frend.webp',
            description: 'Гдовский район, д.Залахтовье.',
            link: 'https://vk.com/club86894330',
            iconColorPreset: 'islands#nightStretchyIcon',
        },
        {
            layer: 'hotel',
            coord: [58.42487057, 27.79144737],
            title: 'База отдыха Тишина',
            img: appUrl + '/img/culture/300-silence.webp',
            description: 'Гдовский район, Спицинская волость.',
            link: 'https://yandex.ru/profile/166673202058',
            iconColorPreset: 'islands#nightStretchyIcon',
        },
        {
            layer: 'hotel',
            coord: [58.78781564, 27.85336997],
            title: 'База отдыха Чистые Пруды',
            img: appUrl + '/img/culture/300-cleanpond.webp',
            description: 'Гдовский район, д.Верхоляне-2.',
            link: 'https://yandex.ru/maps/org/baza_otdykha_chistyye_prudy/201701578828/?ll=27.866704%2C58.785775&z=14',
            iconColorPreset: 'islands#nightStretchyIcon',
        },
        {
            layer: 'hotel',
            coord: [58.47969686, 27.88196842],
            title: 'Тридевятое царство',
            img: appUrl + '/img/culture/300-999.webp',
            description: 'Гдовский район, д.Залахтовье.',
            link: 'https://baza999.ru',
            iconColorPreset: 'islands#nightStretchyIcon',
        },
        {
            layer: 'hotel',
            coord: [58.75528066, 27.78430079],
            title: 'Гостевой дом Устье',
            img: appUrl + '/img/culture/300-ust.webp',
            description: 'Гдовский район, п.Устье.',
            link: 'https://yandex.ru/maps/org/gostevoy_dom_ustye/204062193564/?ll=27.784280%2C58.755270&z=16',
            iconColorPreset: 'islands#nightStretchyIcon',
        },
        {
            layer: 'hotel',
            coord: [58.51993309, 27.86033655],
            title: 'База отдыха Чудское подворье',
            img: appUrl + '/img/culture/300-podvor.webp',
            description: 'Гдовский район, д.Спицино.',
            link: 'https://chudskoe.ru',
            iconColorPreset: 'islands#nightStretchyIcon',
        },
        {
            layer: 'religion',
            coord: [58.80364022, 27.90814198],
            title: 'Церковь Покрова Божией Матери',
            img: appUrl + '/img/culture/300-kjar.webp',
            description: 'Гдовский район, д.Верхоляне (Кярово)',
            link: 'https://yandex.ru/maps/org/tserkov_pokrova_presvyatoy_bogoroditsy_v_kyarovo/1691689524/?ll=27.908096%2C58.803621&z=12.4',
            iconColorPreset: 'islands#darkGreenStretchyIcon',
        },
        {
            layer: 'religion',
            coord: [58.31417964, 27.79072719],
            title: 'Церковь Николая Чудотворца',
            img: appUrl + '/img/culture/300-remda.webp',
            description: 'Гдовский район, д.Ремда',
            link: 'https://yandex.ru/maps/org/tserkov_nikolaya_chudotvortsa/1241681439/?ll=27.792795%2C58.314311&z=15.71',
            iconColorPreset: 'islands#darkGreenStretchyIcon',
        },
        {
            layer: 'religion',
            coord: [58.90218612, 27.74979769],
            title: 'Церковь Троицы Живоначальной',
            img: appUrl + '/img/culture/300-domagirka.webp',
            description: 'Гдовский район, д.Доможирка.',
            link: 'https://yandex.ru/maps/org/tserkov_troitsy_zhivonachalnoy_v_domozhirke/1294135182/?ll=27.749792%2C58.902228&z=9.45',
            iconColorPreset: 'islands#darkGreenStretchyIcon',
        },
        {
            layer: 'religion',
            coord: [58.85549794, 27.83192712],
            title: 'Церковь Николая Чудотворца',
            img: appUrl + '/img/culture/300-kamkon.webp',
            description: 'Гдовский район, д.Каменный конец.',
            link: 'https://yandex.ru/maps/org/tserkov_nikolaya_chudotvortsa_v_kamennom_kontse/1730130541/?ll=27.831843%2C58.855461&z=9.46',
            iconColorPreset: 'islands#darkGreenStretchyIcon',
        },
        {
            layer: 'religion',
            coord: [58.52118406, 27.85941954],
            title: 'Церковь Петра и Павла',
            img: appUrl + '/img/culture/300-petropavl.webp',
            description: 'Гдовский район, д.Спицино.',
            link: 'https://yandex.ru/maps/org/tserkov_petra_i_pavla_v_spitsino/1815743185/?ll=27.859425%2C58.521152&z=16.66',
            iconColorPreset: 'islands#darkGreenStretchyIcon',
        },
        {
            layer: 'religion',
            coord: [58.42453904, 28.06810711],
            title: 'Церковь Серафима Саровского',
            img: appUrl + '/img/culture/300-jamm.webp',
            description: 'Гдовский район, п.Ямм.',
            link: 'https://yandex.ru/maps/org/tserkov_serafima_sarovskogo_v_yamme/1816419639/?ll=28.068128%2C58.424547&z=16.66',
            iconColorPreset: 'islands#darkGreenStretchyIcon',
        },
        {
            layer: 'religion',
            coord: [58.35999231, 28.34232128],
            title: 'Церковь Космы и Дамиана',
            img: appUrl + '/img/culture/300-kosdam.webp',
            description: 'Гдовский район, д.Гвоздно.',
            link: 'https://yandex.ru/maps/org/tserkov_kosmy_i_damiana/107475832098/?ll=28.342179%2C58.360013&z=12.46',
            iconColorPreset: 'islands#darkGreenStretchyIcon',
        },
        {
            layer: 'religion',
            coord: [58.83696037, 27.79264209],
            title: 'Церковь Петра и Павла',
            img: appUrl + '/img/culture/300-petrpavl.webp',
            description: 'Гдовский район, д.Лаптовицы.',
            link: 'https://yandex.ru/maps/org/tserkov_petra_i_pavla_v_laptovitsakh/1761918428/?ll=27.792644%2C58.836938&z=16.07',
            iconColorPreset: 'islands#darkGreenStretchyIcon',
        },
        {
            layer: 'religion',
            coord: [58.80144365, 27.81613662],
            title: 'Церковь Николая Чудотворца',
            img: appUrl + '/img/culture/300-polichno.webp',
            description: 'Гдовский район, д.Полично.',
            link: 'https://yandex.ru/maps/org/tserkov_nikolaya_chudotvortsa_v_polichno/1703973715/?ll=27.816166%2C58.801413&z=12.4',
            iconColorPreset: 'islands#darkGreenStretchyIcon',
        },
        {
            layer: 'religion',
            coord: [58.41984089, 27.93068349],
            title: 'Церковь Покрова Пресвятой Богородицы',
            img: appUrl + '/img/culture/300-ozera.webp',
            description: 'Гдовский район, д.Озера.',
            link: 'https://yandex.ru/maps/org/tserkov_pokrova_presvyatoy_bogoroditsy/102363363657/?ll=27.930574%2C58.419877&z=9.46',
            iconColorPreset: 'islands#darkGreenStretchyIcon',
        },
        {
            layer: 'religion',
            coord: [58.69053927, 28.21632440],
            title: 'Церковь Преображения Господня',
            img: appUrl + '/img/culture/300-pribug.webp',
            description: 'Гдовский район, д.Прибуж.',
            link: 'https://yandex.ru/maps/org/tserkov_preobrazheniya_gospodnya_v_pribuzhe/1300761933/?ll=28.216275%2C58.690515&z=15.49',
            iconColorPreset: 'islands#darkGreenStretchyIcon',
        },
        {
            layer: 'religion',
            coord: [58.29809261, 27.64745299],
            title: 'Часовня Трифона мученика',
            img: appUrl + '/img/culture/300-kobile.webp',
            description: 'Гдовский район, д.Кобылье Городище.',
            link: 'https://yandex.ru/maps/org/chasovnya_trifona_muchenika/1158401232/?ll=27.645839%2C58.301424&z=11.05',
            iconColorPreset: 'islands#darkGreenStretchyIcon',
        },
        {
            layer: 'religion',
            coord: [58.66953516, 27.76297233],
            title: 'Церковь апостолов Петра и Павла',
            img: appUrl + '/img/culture/300-vetvenik.webp',
            description: 'Гдовский район, д.Ветвеник.',
            link: 'https://yandex.ru/maps/org/tserkov_apostolov_petra_i_pavla/1153478780/?ll=27.762888%2C58.669503&z=15.49',
            iconColorPreset: 'islands#darkGreenStretchyIcon',
        },
        {
            layer: 'religion',
            coord: [58.61273095, 27.81082420],
            title: 'Церковь апостолов Петра и Павла',
            img: appUrl + '/img/culture/300-kunest.webp',
            description: 'Гдовский район, д.Кунесть.',
            link: 'https://yandex.ru/maps/org/tserkov_apostolov_petra_i_pavla/64327621016/?ll=27.810815%2C58.612739&z=16.49',
            iconColorPreset: 'islands#darkGreenStretchyIcon',
        },
        {
            layer: 'monument',
            coord: [58.44440032, 28.00364334],
            title: 'Поле Памяти',
            img: appUrl + '/img/culture/300-pole.webp',
            description: 'Гдовский район.',
            link: 'https://yandex.ru/maps/org/pole_pamyati/89893554136/?from=tabbar&ll=28.003701%2C58.444401&source=serp_navig&z=11.01',
            iconColorPreset: 'islands#oliveStretchyIcon',
        },
        {
            layer: 'monument',
            coord: [58.74104010, 27.82402268],
            title: 'Т-34',
            img: appUrl + '/img/culture/300-t34.webp',
            description: 'Легендарная 34-ка',
            link: 'https://yandex.ru/maps/org/tank_t_34/129841039010/?from=tabbar&ll=27.824027%2C58.741024&source=serp_navig&z=16.2',
            iconColorPreset: 'islands#oliveStretchyIcon',
        },
        {
            layer: 'monument',
            coord: [58.74263526, 27.82514391],
            title: 'Мемориальный комплекс',
            img: appUrl + '/img/culture/300-gdovbrat.webp',
            description: 'Героям павшим за Родину',
            link: 'https://yandex.ru/maps/org/bratskaya_mogila/165231737351/?from=tabbar&ll=27.824975%2C58.742706&source=serp_navig&z=18.31',
            iconColorPreset: 'islands#oliveStretchyIcon',
        },
        {
            layer: 'arch',
            coord: [58.74079646, 27.81551473],
            title: 'Народный дом',
            img: appUrl + '/img/culture/300-naroddom.webp',
            description: '',
            link: 'https://yandex.ru/maps/org/narodny_dom/215045619495/?from=tabbar&ll=27.815512%2C58.740800&source=serp_navig&z=15.8',
            iconColorPreset: 'islands#brownStretchyIcon',
        },
        {
            layer: 'arch',
            coord: [58.74429825, 27.82022067],
            title: 'Земская управа',
            img: appUrl + '/img/culture/300-zemska.webp',
            description: '',
            link: 'https://yandex.ru/maps/org/zemskaya_uprava/124923264173/?from=tabbar&ll=27.820206%2C58.744302&source=serp_navig&z=16.6',
            iconColorPreset: 'islands#brownStretchyIcon',
        },
        {
            layer: 'monument',
            coord: [58.79202405, 27.87011335],
            title: 'Роща Памяти',
            img: appUrl + '/img/culture/300-roscha.webp',
            description: '',
            link: 'https://yandex.ru/maps/org/roshcha_pamyati/67430496751/?from=tabbar&ll=27.868785%2C58.792091&source=serp_navig&z=10.25',
            iconColorPreset: 'islands#oliveStretchyIcon',
        },
        {
            layer: 'arch',
            coord: [58.61514438, 27.94967495],
            title: 'Трутневские пещеры',
            img: appUrl + '/img/culture/300-trutnev.webp',
            description: 'Гдовский район, д.Трутнево',
            link: 'https://yandex.ru/maps/org/trutnevskiye_peshchery/135958611853/?from=tabbar&ll=27.949703%2C58.615184&source=serp_navig&z=16.06',
            iconColorPreset: 'islands#brownStretchyIcon',
        }
        //olive brown darkGreen night
    ]

    function layerSelect(name) {
        layerCollection[name] = !layerCollection[name];
        let layer = document.querySelector('#' + name);



        if (layerCollection[name]) {
            clusterer.add(placemarkCollections[name])
            myMap.geoObjects.add(clusterer)
            layer.classList.remove(name + 'Off')
            layer.classList.add(name + 'On')
        } else {
            clusterer.remove(placemarkCollections[name])
            myMap.geoObjects.removeAll()
            myMap.geoObjects.add(clusterer)
            layer.classList.remove(name + 'On')
            layer.classList.add(name + 'Off')
        }
    }






    ymaps.ready(init);

    function init() {
        document.querySelector('#menu').scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });

        // Создаем карту
        myMap = new ymaps.Map("map", {
            center: [58.52461183, 27.84345160],
            zoom: 9,
            controls: [
                'zoomControl'
            ],
            zoomMargin: [20]
        });

        clusterer = new ymaps.Clusterer({
            clusterIconLayout: 'default#pieChart', // Макет метки кластера pieChart.
            clusterIconPieChartRadius: 25, // Радиус диаграммы в пикселях.
            clusterIconPieChartCoreRadius: 10, // Радиус центральной части макета.
            clusterIconPieChartStrokeWidth: 3, // Ширина линий-разделителей секторов и внешней обводки диаграммы.
            hasBalloon: false
        }); // Определяет наличие поля balloon.



        var museumCollection = [];
        var monumentCollection = [];
        var archCollection = [];
        var religionCollection = [];
        var hotelCollection = [];

        var iconColorPreset = '';

        markers.map((marker) => {
            plaseMarker = new ymaps.Placemark(marker.coord, {
                balloonContentHeader: marker.title,
                balloonContentBody: '<img src="' + marker.img + '" height="200" width="300"> <br/> ' +
                    marker.description + '<br/>',
                balloonContentFooter: '<a class="more" href="' + marker.link + '">Подробнее</a>',
                //iconContent: marker.title,
                // Зададим содержимое всплывающей подсказки.
                hintContent: marker.title
            }, {
                preset: marker.iconColorPreset,
            });

            switch (marker.layer) {
                case 'museum':
                    museumCollection.push(plaseMarker);
                    break;
                case 'monument':
                    monumentCollection.push(plaseMarker);
                    break;
                case 'arch':
                    archCollection.push(plaseMarker);
                    break;
                case 'religion':
                    religionCollection.push(plaseMarker);
                    break;
                case 'hotel':
                    hotelCollection.push(plaseMarker);
                    break;

                default:
                    break;
            }

        })



        //myMap.geoObjects.add(clusterer)


        placemarkCollections['museum'] = museumCollection;
        placemarkCollections['monument'] = monumentCollection;
        placemarkCollections['arch'] = archCollection;
        placemarkCollections['religion'] = religionCollection;
        placemarkCollections['hotel'] = hotelCollection;



    }
</script>
