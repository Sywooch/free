/* Функция создает карту с маркерами и маршрутом */
function printMap() {
  var map;
  var lines = [];
  var markers = [];                
  // Создание маршрутов
  var travels = [
    {
      id: 0,
      info: "0 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur laborum, quidem pariatur repellat delectus aspernatur facilis totam officia",
      markers: [{lat: 54, lng: 27.57}, {lat: 56, lng: 27.57}]
    },
    {
      id: 1,
      info: "1 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur laborum, quidem pariatur repellat delectus aspernatur facilis totam officia",
      markers: [{lat: 53.8, lng: 27.57}, {lat: 52, lng: 27.57}]
    },
    {
      id: 2,
      info: "2 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur laborum, quidem pariatur repellat delectus aspernatur facilis totam officia",
      markers: [{lat: 53.9, lng: 27.7}, {lat: 53.9, lng: 31}]
    },
    {
      id: 3,
      info: "3 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur laborum, quidem pariatur repellat delectus aspernatur facilis totam officia",
      markers: [{lat: 53.9, lng: 27.4}, {lat: 53.9, lng: 24}]
    },
  ];

//Создание карты
  var pos = {lat: 55.752, lng: 37.615};
  var map = new google.maps.Map(document.getElementById('map'),  
    {
      center: pos,  
      zoom: 6,
      scrollwheel: false
    });

// Проверка на поддержку геолокации и ставим карту в центр геолокации
  if (navigator.geolocation) {        
    navigator.geolocation.getCurrentPosition(function(position) {   
      pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      map.setCenter(pos);
      return pos; 
    });           
  };

//Выводим маршруты на карту
  for (var i = 0; i < travels.length; i++) {    
    // Задаем случайные числа для генерации произвольного цвета
    var num1 = Math.floor(Math.random() * 256);
    var num2 = Math.floor(Math.random() * 256);
    var num3 = Math.floor(Math.random() * 256); 
    
    // Выводим маршрут
    var line = new google.maps.Polyline({
      path: travels[i].markers,
      strokeColor: '#' + color(num1, num2, num3),
      strokeOpacity: 1.0,
      strokeWeight: 3,
    });
    // Присваиваем маршруту номер путешествия и заносим в массив
    line.id = travels[i].id;
    lines.push(line);
    line.setMap(map);

    // Создаем цветной маркер
    var markerImage = new google.maps.MarkerImage(
     "http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + color(num1, num2, num3));

    // Выводим маркеры, присваиваем им номер путешествия и заносим в массив
    for (var j = 0; j < travels[i].markers.length; j++) {
      var marker = new google.maps.Marker({
        icon: markerImage,
        position: travels[i].markers[j],
        map: map,
      });
      marker.id = travels[i].id;
      markers.push(marker);

      //Создаем событие при клике на маркер
      marker.addListener("click", function (event) {
        var id = this.id;
        // Удаляем с карты чужие маркеры
        markers.forEach(function(item) {
          item.setMap(item.id==id ? map:null);
        });
        // Удаляем с карты чужие маршруты
        lines.forEach(function(item) {
          item.setMap(item.id==id ? map:null);
        });

        // Создаем информационное окно и выводим
        for (var k = 0; k < travels.length; k++) {
          if (travels[k].id == this.id) {
            var infowindow = new google.maps.InfoWindow({
              content: '<h3>Информация о путешествии</h3>' + travels[k].info 
            });
            break;
          };
        };
        infowindow.open(map, this);

        // При закрытии окна, приводим все к первоначальному виду
        infowindow.addListener("closeclick", function (event) {
          map.setCenter(pos);
          markers.forEach(function(item){item.setMap(map)});
          lines.forEach(function(item){item.setMap(map)});
        });            
      });
    };
  };
};

//Генерация цвета в 16-ричной системе
function color(n1, n2, n3) {
  function tenTo16(n) {
  return n > 15 ? n.toString(16).toUpperCase():'0' + n.toString(16).toUpperCase();
  }
  return (tenTo16(n1) +  tenTo16(n2) + tenTo16(n3));      
};


