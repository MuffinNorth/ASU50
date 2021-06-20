let myMap;
ymaps.ready(init);

function init () {

    myMap = new ymaps.Map('map', {
        center: [66.25, 94.15],
        zoom: 3,
        scroll: false,
        controls: ["zoomControl"]
    }, {
        searchControlProvider: 'yandex#search'
    });

    $.get("/api/getCity", null, function (req) {
        for (let i = 1; i < req.size + 1; i++) {
            ymaps.geocode(req[i]['city'], {
                results: 1
            }).then(function (res) {
                let firstGeoObject = res.geoObjects.get(0),
                    coords = firstGeoObject.geometry.getCoordinates();
                myMap.geoObjects.add(new ymaps.Placemark(coords, {
                    // Данные для построения диаграммы.
                    data: [
                        {weight: parseInt(req[i]['count']), color: '#0E4779'}
                    ],
                }, {
                    // Зададим произвольный макет метки.
                    iconLayout: 'default#pieChart',
                    // Радиус диаграммы в пикселях.
                    iconPieChartRadius: 15,
                    // Радиус центральной части макета.
                    iconPieChartCoreRadius: 11,
                    // Стиль заливки центральной части.
                    iconPieChartCoreFillStyle: '#ffffff',
                    // Cтиль линий-разделителей секторов и внешней обводки диаграммы.
                    iconPieChartStrokeStyle: '#ffffff',
                    // Ширина линий-разделителей секторов и внешней обводки диаграммы.
                    iconPieChartStrokeWidth: 3,
                    // Максимальная ширина подписи метки.
                    iconPieChartCaptionMaxWidth: 200
                }))
            });
        }
    })

}