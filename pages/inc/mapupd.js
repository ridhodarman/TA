    var map;
    var drawingManager;
    var selectedShape;
    var markers = [];

    function initialize() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -0.914742, lng: 100.460899},
          zoom: 16,
          mapTypeId: google.maps.MapTypeId.SATELLITE,
          disableDefaultUI: true,
          zoomControl: true,
          mapTypeControl: true,
          gestureHandling: 'greedy'
        });

          var geocoder = new google.maps.Geocoder;
          var infowindow = new google.maps.InfoWindow;
          document.getElementById('btnlatlng').addEventListener('click', function() {
            setMapOnAll(null);
                geocodeLatLng(geocoder, map, infowindow);
            });

        function geocodeLatLng(geocoder, map, infowindow) {
        var input = document.getElementById('latlng').value;
        var latlngStr = input.split(',', 2);
        var latlng = {lat: parseFloat(latlngStr[0]), lng: parseFloat(latlngStr[1])};
        geocoder.geocode({'location': latlng}, function(results, status) {
          if (status === google.maps.GeocoderStatus.OK) {
            if (results[1]) {
              map.setZoom(20);
              var marker = new google.maps.Marker({
                position: latlng,
                map: map
              });
        map.setCenter(latlng);
        markers.push(marker);
              /* infowindow.setContent(results[1].formatted_address);
              infowindow.open(map, marker); */
        $('#showm,#hidem').remove();
        $('#floating-panel').append('<button class="btn btn-default my-btn" id="hidem" onclick="clearMarkers()" type="button" title="Hide marker"><i class="fa fa-map-marker"></button>');
            } else {
              window.alert('No results found');
            }
          } else {
            window.alert('Geocoder failed due to: ' + status);
          }
        });
    }
        
        var show_digitation ;
        $.ajax({ url: '../../inc/data.php', dataType: 'json', cache: false, success: function(arrays){
            for(i=0;i<arrays.features.length;i++){
                var data = arrays.features[i];
                var arrayGeometries = data.geometry.coordinates;
                var jenis = data.jenis;
                var p1 = '<p> ID : '+data.properties.id+'</p>';
                var p2 = '<p> Nama : '+data.properties.nama+'</p>';
                var p3 = p1+p2+jenis;
                
                var idTitik = 0;
                var hitungTitik=[];
                while(idTitik < arrayGeometries[0][0].length){
                    var aa = arrayGeometries[0][0][idTitik][0];
                    var bb = arrayGeometries[0][0][idTitik][1];
                    hitungTitik[idTitik]= {lat:bb,lng: aa};
                    idTitik += 1;
                }

                show_digitation = new google.maps.Polygon({
                  paths: hitungTitik,
                  strokeColor: 'yellow',
                  strokeOpacity: 1,
                  strokeWeight: 0.5,
                  fillColor: 'green',
                  fillOpacity: 0.35,
                  content: p3
                });
                show_digitation.setMap(map);
                show_digitation.addListener('click', function(event) {
                    var lat = event.latLng.lat();
                    var lng = event.latLng.lng();
                    var info = {lat:lat, lng:lng};
                    infoWindow.setContent(this.content);
                    infoWindow.setPosition(info);
                    map.setCenter(info);
                    infoWindow.open(map);
                  });
                
            }
        }});


             $.ajax({ url: '../../inc/dataumkm.php', dataType: 'json', cache: false, success: function(arrays){
                for(i=0;i<arrays.features.length;i++){
                    var data = arrays.features[i];
                    var arrayGeometries = data.geometry.coordinates;
                    var jenis = data.jenis;
                    var p1 = '<p> ID : '+data.properties.id+'</p>';
                    var p2 = '<p> Nama : '+data.properties.nama+'</p>';
                    var p3 = p1+p2+jenis;
                    
                    var idTitik = 0;
                    var hitungTitik=[];
                    while(idTitik < arrayGeometries[0][0].length){
                        var aa = arrayGeometries[0][0][idTitik][0];
                        var bb = arrayGeometries[0][0][idTitik][1];
                        hitungTitik[idTitik]= {lat:bb,lng: aa};
                        idTitik += 1;
                    }

                    show_digit = new google.maps.Polygon({
                      paths: hitungTitik,
                      strokeColor: 'yellow',
                      strokeOpacity: 1,
                      strokeWeight: 0.5,
                      fillColor: 'orange',
                      fillOpacity: 0.35,
                      content: p3
                    });
                    show_digit.setMap(map);
                    show_digit.addListener('click', function(event) {
                        var lat = event.latLng.lat();
                        var lng = event.latLng.lng();
                        var info = {lat:lat, lng:lng};
                        infoWindow.setContent(this.content);
                        infoWindow.setPosition(info);
                        map.setCenter(info);
                        infoWindow.open(map);
                      });
                    
                }
            }});
            var infoWindow = new google.maps.InfoWindow({map: map});

        
        var infoWindow = new google.maps.InfoWindow({map: map});
        var bounds = new google.maps.LatLngBounds();
          var polyOptions = {
          fillColor: 'blue',
          strokeColor: 'blue',
          draggable: true
          };

        //menampilkan drawing manager
          drawingManager = new google.maps.drawing.DrawingManager({
          drawingMode: google.maps.drawing.OverlayType.POLYGON,
          drawingControlOptions: {
            position: google.maps.ControlPosition.TOP_LEFT,
            drawingModes: [
              google.maps.drawing.OverlayType.POLYGON
            ]
          },
          polygonOptions: polyOptions,
          map: map
        });
        //event digitasi di google map
        google.maps.event.addListener(drawingManager, 'overlaycomplete', function(event){
          if (event.type == google.maps.drawing.OverlayType.POLYGON){
            //console.log('polygon path array', event.overlay.getPath().getArray());
            var str_input ='MULTIPOLYGON(((';
            var i=0;
            var coor = [];
            $.each(event.overlay.getPath().getArray(), function(key, latlng){
              var lat = latlng.lat();
              var lon = latlng.lng();
              coor[i] = lon +' '+ lat;
              str_input += lon +' '+ lat +',';
              i++;
            });
            str_input = str_input+''+coor[0]+')))';
            $("#geom").val(str_input);
            drawingManager.setDrawingMode(null);
            drawingManager.setOptions({
              drawingControl: false
            });
            // Add an event listener that selects the newly-drawn shape when the user mouses down on it.
            var newShape = event.overlay;
            newShape.type = event.type;
            setSelection(newShape);
            google.maps.event.addListener(newShape, 'click', function(){
              setSelection(newShape);
            });
          }
          function getCoordinate(){
            var polygonBounds = newShape.getPath();
            str_input ='MULTIPOLYGON(((';
            for(var i = 0 ; i < polygonBounds.length ; i++){
              coor[i] = polygonBounds.getAt(i).lng() +' '+ polygonBounds.getAt(i).lat();
              str_input += polygonBounds.getAt(i).lng() +' '+ polygonBounds.getAt(i).lat() +',';
            }
            str_input = str_input+''+coor[0]+')))';     
            $("#geom").val(str_input);
          }
          google.maps.event.addListener(newShape.getPath(), 'set_at', getCoordinate);
          google.maps.event.addListener(newShape.getPath(), 'insert_at', getCoordinate);
          google.maps.event.addListener(newShape.getPath(), 'remove_at', getCoordinate);
        });
        google.maps.event.addListener(drawingManager, 'drawingmode_changed', clearSelection);
        google.maps.event.addListener(map, 'click', clearSelection);
        google.maps.event.addDomListener(document.getElementById('delete-button'), 'click', deleteSelectedShape);
      }

      google.maps.event.addDomListener(window, 'load', initialize);

      function processPoints(geometry, callback, thisArg) {
        if (geometry instanceof google.maps.LatLng) {
          callback.call(thisArg, geometry);
        } else if (geometry instanceof google.maps.Data.Point) {
          callback.call(thisArg, geometry.get());
        } else {
          geometry.getArray().forEach(function(g) {
            processPoints(g, callback, thisArg);
          });
        }
      }
      function clearSelection() {
        if (selectedShape) {
          selectedShape.setEditable(false);
          selectedShape = null;
        }
      }
      function setSelection(shape) {
        clearSelection();
        selectedShape = shape;
        shape.setEditable(true);
      }
      function deleteSelectedShape() {
        if (selectedShape) {
        $("#geom").val('');
        selectedShape.setMap(null);
        drawingManager.setOptions({
          drawingControl: true
        });
        }
      }
      // Sets the map on all markers in the array.
      function setMapOnAll(map) {
        for (var i = 0; i < markers.length; i++) {
          markers[i].setMap(map);
        }
      }
      // Removes the markers from the map, but keeps them in the array.
      function clearMarkers() {
        setMapOnAll(null);
        $('#hidem').remove();
        $('#floating-panel').append('<button class="btn btn-default my-btn" id="showm" onclick="showMarkers()" type="button" title="Show marker"><i class="fa fa-map-marker"></i></button>');
      }
      // Shows any markers currently in the array.
      function showMarkers() {
        setMapOnAll(map);
        $('#showm').remove();
        $('#floating-panel').append('<button class="btn btn-default my-btn" id="hidem" onclick="clearMarkers()" type="button" title="Hide marker"><i class="fa fa-map-marker"></i></button>');
      }

      function resizeMap() {
         if(typeof map =="undefined") return;
         setTimeout( function(){resizingMap();} , 400);
      }

      function resizingMap() {
         if(typeof map =="undefined") return;
         var center = map.getCenter();
         google.maps.event.trigger(map, "resize");
         map.setCenter(center); 

        var infoWindow = new google.maps.InfoWindow({map: map});
      }

      function hapusmarkerdankoor(){
        setMapOnAll(null);
        markers = [];
        document.getElementById('latlng').value=null;
      }