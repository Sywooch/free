function initMap() {                  /* Функция создает карту с маркерами и маршрутом */
  var id = 0;
  var markers = [];
  var map, line;
  map = new google.maps.Map(document.getElementById('map'),  /*Создание карты*/
    {
      center: {lat: 55.752, lng: 37.615},           /*Координаты Москвы*/
      zoom: 6
    });

  if (navigator.geolocation) {        /*Проверка на поддержку геолокации*/
    navigator.geolocation.getCurrentPosition(function(position) {   /*Определяем координаты*/
      var pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
        };
      map.setCenter(pos);             /*Ставим карту в центре геолокации*/
    });
  };

  line = new google.maps.Polyline({     /*Создаем ломаную линию*/
        strokeColor: '#000000',
        strokeOpacity: 1.0,
        strokeWeight: 3,
        map: map
      });
  var path = line.getPath();           /*Создаем массив точек ломанной линии*/

  map.addListener('click', function (event) {       /*Создаем событие при клике по карте*/
    var marker = new google.maps.Marker({
          position: event.latLng,
          map: map,
        });
    marker.id = ++id;
    markers.push(marker);
    path.push(event.latLng);

    marker.addListener("click", function (event) {      /*Создаем событие при клике на маркер*/
      for (var i = 0; i < markers.length; i++) {
        if (markers[i].id == marker.id) {
            markers[i].setMap(null);
            markers.splice(i, 1);
            path.removeAt(i);
            break;
        };
      };             
    });
  });
};

