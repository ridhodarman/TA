var batasnagari; var warnanagari = "red"; var ketebalan = 3.0;
var njorong = 0; var digitjorong = [];
var nrumah = 0; var digitrumah = [];
var numkm = 0; var digitumkm = [];
var nibadah = 0; var digitibadah = [];
var nkantor = 0; var digitkantor = [];
var npendidikan = 0; var digitpendidikan = [];
var nkesehatan = 0; var digitkesehatan = [];
var map;
var server="";


var myStyle = [ { "featureType": "administrative", "elementType": "geometry", "stylers": [ { "visibility": "off" } ] }, { "featureType": "landscape.man_made", "elementType": "geometry.fill", "stylers": [ { "visibility": "simplified" } ] }, { "featureType": "landscape.man_made", "elementType": "geometry.stroke", "stylers": [ { "color": "#eeeeee" }, { "visibility": "on" } ] }, { "featureType": "poi", "stylers": [ { "visibility": "off" } ] }, { "featureType": "road", "elementType": "labels.icon", "stylers": [ { "visibility": "off" } ] }, { "featureType": "road.local", "elementType": "geometry.fill", "stylers": [ { "visibility": "off" } ] }, { "featureType": "road.local", "elementType": "geometry.stroke", "stylers": [ { "weight": 1 } ] }, { "featureType": "transit", "stylers": [ { "visibility": "off" } ] } ];
function loadpeta() {
  // map = new google.maps.Map(document.getElementById('map'), {
  //   center: {
  //     lat: -0.323489,
  //     lng: 100.349190
  //   },
  //   zoom: 14.5,
  //   mapTypeId: 'satellite'
  // });

  map = new google.maps.Map(document.getElementById('map'), {
       mapTypeControlOptions: {
         mapTypeIds: ['mystyle', google.maps.MapTypeId.SATELLITE, google.maps.MapTypeId.ROADMAP, google.maps.MapTypeId.TERRAIN]
       },
       center: new google.maps.LatLng(-0.323489, 100.349190),
       zoom: 14.5,
       mapTypeId: 'satellite'
     });
     map.mapTypes.set('mystyle', new google.maps.StyledMapType(myStyle, { name: 'Styled Map' }));
}

function digitasirumah() {
  $.ajax({
    url: server+'inc/datarumah.php',
    dataType: 'json',
    cache: false,
    success: function (arrays) {
      for (i = 0; i < arrays.features.length; i++) {
        var data = arrays.features[i];
        var arrayGeometries = data.geometry.coordinates;
        var jenis = data.jenis;
        var link = "<button class='btn btn-info btn-xs fa fa-info-circle' title='View Details' onclick='detailrumah("+'"'+data.properties.id+'"'+")'></button>";
        var p1 = ' ID: ' + data.properties.id;
        var p2 = '<p>' + data.properties.nama + '</p>';
        var p3 = link + p1 + p2 +'('+jenis+') ';

        var idTitik = 0;
        var hitungTitik = [];
        while (idTitik < arrayGeometries[0][0].length) {
          var aa = arrayGeometries[0][0][idTitik][0];
          var bb = arrayGeometries[0][0][idTitik][1];
          hitungTitik[idTitik] = {
            lat: bb,
            lng: aa
          };
          idTitik += 1;
        }

        digitrumah[nrumah] = new google.maps.Polygon({
          paths: hitungTitik,
          strokeColor: 'yellow',
          strokeOpacity: 2,
          strokeWeight: 0.5,
          //fillColor: '#B22222',
          fillColor: 'brown',
          fillOpacity: 0.5,
          zIndex: 1,
          content: p3
        });
        digitrumah[nrumah].setMap(map);
        digitrumah[nrumah].addListener('click', function (event) {
          var lat = event.latLng.lat();
          var lng = event.latLng.lng();
          var info = {
            lat: lat,
            lng: lng
          };
          infoWindow.setContent(this.content);
          infoWindow.setPosition(info);
          infoWindow.open(map);
        });
        nrumah = nrumah + 1;
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $('#gagal').modal('show');
      $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
      $('#notifikasi').append(thrownError);
    }
  });
  var infoWindow = new google.maps.InfoWindow({
    map: map
  });
}

function digitasiumkm() {
  $.ajax({
    url: server+'inc/dataumkm.php',
    dataType: 'json',
    cache: false,
    success: function (arrays) {
      for (i = 0; i < arrays.features.length; i++) {
        var data = arrays.features[i];
        var arrayGeometries = data.geometry.coordinates;
        var jenis = data.jenis;
        var link = "<button class='btn btn-info btn-xs fa fa-info-circle' title='View Details' onclick='detailumkm("+'"'+data.properties.id+'"'+")'></button>";
        var p1 = ' ID: ' + data.properties.id;
        var p2 = '<p>' + data.properties.nama + '</p>';
        var p3 = link + p1 + p2 +'('+jenis+') ';

        var idTitik = 0;
        var hitungTitik = [];
        while (idTitik < arrayGeometries[0][0].length) {
          var aa = arrayGeometries[0][0][idTitik][0];
          var bb = arrayGeometries[0][0][idTitik][1];
          hitungTitik[idTitik] = {
            lat: bb,
            lng: aa
          };
          idTitik += 1;
        }

        digitumkm[numkm] = new google.maps.Polygon({
          paths: hitungTitik,
          strokeColor: 'yellow',
          strokeOpacity: 1,
          strokeWeight: 0.5,
          fillColor: '#8A2BE2',
          fillOpacity: 0.35,
          zIndex: 2,
          content: p3
        });
        digitumkm[numkm].setMap(map);
        digitumkm[numkm].addListener('click', function (event) {
          var lat = event.latLng.lat();
          var lng = event.latLng.lng();
          var info = {
            lat: lat,
            lng: lng
          };
          infoWindow.setContent(this.content);
          infoWindow.setPosition(info);
          infoWindow.open(map);
        });
        numkm = numkm + 1;
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $('#gagal').modal('show');
      $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
      $('#notifikasi').append(thrownError);
    }
  });
  var infoWindow = new google.maps.InfoWindow({
    map: map
  });
}


function digitasit4ibadah() {
  $.ajax({
    url: server+'inc/datat4ibadah.php',
    dataType: 'json',
    cache: false,
    success: function (arrays) {
      for (i = 0; i < arrays.features.length; i++) {
        var data = arrays.features[i];
        var arrayGeometries = data.geometry.coordinates;
        var jenis = data.jenis;
        var jenis = data.jenis;
        var link = "<button class='btn btn-info btn-xs fa fa-info-circle' title='View Details' onclick='detailibadah("+'"'+data.properties.id+'"'+")'></button>";
        var p1 = ' ID: ' + data.properties.id;
        var p2 = '<p>' + data.properties.nama + '</p>';
        var p3 = link + p1 + p2 +'('+jenis+') ';

        var idTitik = 0;
        var hitungTitik = [];
        while (idTitik < arrayGeometries[0][0].length) {
          var aa = arrayGeometries[0][0][idTitik][0];
          var bb = arrayGeometries[0][0][idTitik][1];
          hitungTitik[idTitik] = {
            lat: bb,
            lng: aa
          };
          idTitik += 1;
        }

        digitibadah[nibadah] = new google.maps.Polygon({
          paths: hitungTitik,
          strokeColor: 'orange',
          strokeOpacity: 1,
          strokeWeight: 0.5,
          fillColor: 'green',
          fillOpacity: 0.5,
          zIndex: 2,
          content: p3
        });
        digitibadah[nibadah].setMap(map);
        digitibadah[nibadah].addListener('click', function (event) {
          var lat = event.latLng.lat();
          var lng = event.latLng.lng();
          var info = {
            lat: lat,
            lng: lng
          };
          infoWindow.setContent(this.content);
          infoWindow.setPosition(info);
          infoWindow.open(map);
        });
        nibadah = nibadah + 1;
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $('#gagal').modal('show');
      $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
      $('#notifikasi').append(thrownError);
    }
  });
  var infoWindow = new google.maps.InfoWindow({
    map: map
  });
}

function digitasikantor() {
  $.ajax({
    url: server+'inc/datakantor.php',
    dataType: 'json',
    cache: false,
    success: function (arrays) {
      for (i = 0; i < arrays.features.length; i++) {
        var data = arrays.features[i];
        var arrayGeometries = data.geometry.coordinates;
        var jenis = data.jenis;
        var link = "<button class='btn btn-info btn-xs fa fa-info-circle' title='View Details' onclick='detailkantor("+'"'+data.properties.id+'"'+")'></button>";
        var p1 = ' ID: ' + data.properties.id;
        var p2 = '<p>' + data.properties.nama + '</p>';
        var p3 = link + p1 + p2 +'('+jenis+') ';

        var idTitik = 0;
        var hitungTitik = [];
        while (idTitik < arrayGeometries[0][0].length) {
          var aa = arrayGeometries[0][0][idTitik][0];
          var bb = arrayGeometries[0][0][idTitik][1];
          hitungTitik[idTitik] = {
            lat: bb,
            lng: aa
          };
          idTitik += 1;
        }

        digitkantor[nkantor] = new google.maps.Polygon({
          paths: hitungTitik,
          strokeColor: 'orange',
          strokeOpacity: 1,
          strokeWeight: 0.5,
          fillColor: 'blue',
          fillOpacity: 0.5,
          zIndex: 2,
          content: p3
        });
        digitkantor[nkantor].setMap(map);
        digitkantor[nkantor].addListener('click', function (event) {
          var lat = event.latLng.lat();
          var lng = event.latLng.lng();
          var info = {
            lat: lat,
            lng: lng
          };
          infoWindow.setContent(this.content);
          infoWindow.setPosition(info);
          infoWindow.open(map);
        });
        nkantor = nkantor + 1;
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $('#gagal').modal('show');
      $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
      $('#notifikasi').append(thrownError);
    }
  });
  var infoWindow = new google.maps.InfoWindow({
    map: map
  });
}

function digitasipendidikan() {
  $.ajax({
    url: server+'inc/datapendidikan.php',
    dataType: 'json',
    cache: false,
    success: function (arrays) {
      for (i = 0; i < arrays.features.length; i++) {
        var data = arrays.features[i];
        var arrayGeometries = data.geometry.coordinates;
        var jenis = data.jenis;
        var link = "<button class='btn btn-info btn-xs fa fa-info-circle' title='View Details' onclick='detailpendidikan("+'"'+data.properties.id+'"'+")'></button>";
        var p1 = ' ID: ' + data.properties.id;
        var p2 = '<p>' + data.properties.nama + '</p>';
        var p3 = link + p1 + p2 +'('+jenis+') ';

        var idTitik = 0;
        var hitungTitik = [];
        while (idTitik < arrayGeometries[0][0].length) {
          var aa = arrayGeometries[0][0][idTitik][0];
          var bb = arrayGeometries[0][0][idTitik][1];
          hitungTitik[idTitik] = {
            lat: bb,
            lng: aa
          };
          idTitik += 1;
        }

        digitpendidikan[npendidikan] = new google.maps.Polygon({
          paths: hitungTitik,
          strokeColor: 'black',
          strokeOpacity: 1,
          strokeWeight: 0.5,
          fillColor: 'black',
          fillOpacity: 0.7,
          zIndex: 2,
          content: p3
        });
        digitpendidikan[npendidikan].setMap(map);
        digitpendidikan[npendidikan].addListener('click', function (event) {
          var lat = event.latLng.lat();
          var lng = event.latLng.lng();
          var info = {
            lat: lat,
            lng: lng
          };
          infoWindow.setContent(this.content);
          infoWindow.setPosition(info);
          infoWindow.open(map);
        });
        npendidikan = npendidikan + 1;
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $('#gagal').modal('show');
      $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
      $('#notifikasi').append(thrownError);
    }
  });
  var infoWindow = new google.maps.InfoWindow({
    map: map
  });
}

function digitasikesehatan() {
  $.ajax({
    url: server+'inc/datakesehatan.php',
    dataType: 'json',
    cache: false,
    success: function (arrays) {
      for (i = 0; i < arrays.features.length; i++) {
        var data = arrays.features[i];
        var arrayGeometries = data.geometry.coordinates;
        var jenis = data.jenis;
        var link = "<button class='btn btn-info btn-xs fa fa-info-circle' title='View Details' onclick='detailkesehatan("+'"'+data.properties.id+'"'+")'></button>";
        var p1 = ' ID: ' + data.properties.id;
        var p2 = '<p>' + data.properties.nama + '</p>';
        var p3 = link + p1 + p2 +'('+jenis+') ';

        var idTitik = 0;
        var hitungTitik = [];
        while (idTitik < arrayGeometries[0][0].length) {
          var aa = arrayGeometries[0][0][idTitik][0];
          var bb = arrayGeometries[0][0][idTitik][1];
          hitungTitik[idTitik] = {
            lat: bb,
            lng: aa
          };
          idTitik += 1;
        }

        digitkesehatan[nkesehatan] = new google.maps.Polygon({
          paths: hitungTitik,
          strokeColor: 'red',
          strokeOpacity: 1,
          strokeWeight: 0.5,
          fillColor: 'red',
          fillOpacity: 0.5,
          zIndex: 2,
          content: p3
        });
        digitkesehatan[nkesehatan].setMap(map);
        digitkesehatan[nkesehatan].addListener('click', function (event) {
          var lat = event.latLng.lat();
          var lng = event.latLng.lng();
          var info = {
            lat: lat,
            lng: lng
          };
          infoWindow.setContent(this.content);
          infoWindow.setPosition(info);
          infoWindow.open(map);
        });
        nkesehatan = nkesehatan + 1;
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $('#gagal').modal('show');
      $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
      $('#notifikasi').append(thrownError);
    }
  });
  var infoWindow = new google.maps.InfoWindow({
    map: map
  });
}

function viewdigitnagari() {
  batasnagari = new google.maps.Data();
  batasnagari.loadGeoJson(server+'inc/batasnagari.php');
  batasnagari.setStyle(function (feature) {
    return ({
      strokeWeight: ketebalan,
      strokeColor: warnanagari,
      clickable: false,
    });
  });
  batasnagari.setMap(map);
}


function digitasijorong() {
  $.ajax({
    url: server+'inc/jorong.php',
    dataType: 'json',
    cache: false,
    success: function (arrays) {
      for (i = 0; i < arrays.features.length; i++) {
        var data = arrays.features[i];
        var arrayGeometries = data.geometry.coordinates;
        var jenis = data.jenis;
        var p2 = data.properties.nama;
        var p3 = 'Jorong: ' + p2;

        var idTitik = 0;
        var hitungTitik = [];
        while (idTitik < arrayGeometries[0][0].length) {
          var aa = arrayGeometries[0][0][idTitik][0];
          var bb = arrayGeometries[0][0][idTitik][1];
          hitungTitik[idTitik] = {
            lat: bb,
            lng: aa
          };
          idTitik += 1;
        }
        if (data.properties.id == 1) {
          var warna = 'yellow';
        } else if (data.properties.id == 2) {
          var warna = 'green';
        } else if (data.properties.id == 3) {
          var warna = '#478dff';
        }

        digitjorong[njorong] = new google.maps.Polygon({
          paths: hitungTitik,
          strokeColor: 'gray',
          strokeOpacity: 0.6,
          strokeWeight: 1.5,
          fillColor: warna,
          fillOpacity: 0.2,
          zIndex: 0,
          clickable: false
        });
        digitjorong[njorong].setMap(map);
        njorong = njorong + 1;
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $('#gagal').modal('show');
      $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
      $('#notifikasi').append(thrownError);
    }
  });
  var infoWindow = new google.maps.InfoWindow({
    map: map
  });
}


function layernagari() {
  if (document.getElementById("nagari").checked == 1) {
      batasnagari.setStyle(function (feature) {
        return {
          strokeWeight: ketebalan,
          strokeColor: warnanagari
        }
      });
    cek();
  } else {
    // batasnagari.setMap(null);
    batasnagari.setStyle(function (feature) {
      return {
        strokeWeight: 0
      }
    });
    document.getElementById("semua").checked = 0;
  }
}

function layerjorong() {
  if (document.getElementById("jorong").checked == 1) {
      var n = 0;
      while (n < njorong) {
        digitjorong[n].setOptions({
          visible: true
        });
        n = n + 1;
      }
    
    cek();
  } else {
    var n = 0;
    while (n < njorong) {
      digitjorong[n].setOptions({
        visible: false
      });
      n = n + 1;
    }
    document.getElementById("semua").checked = 0;
  }
}

function layerrumah() {
  if (document.getElementById("rumah").checked == 1) {
      var n = 0;
      while (n < nrumah) {
        digitrumah[n].setOptions({
          visible: true
        });
        n = n + 1;
      }
    cek();
  } else {
    var n = 0;
    while (n < nrumah) {
      digitrumah[n].setOptions({
        visible: false
      });
      n = n + 1;
    }
    document.getElementById("semua").checked = 0;
  }
}

function layerumkm() {
  if (document.getElementById("umkm").checked == 1) {
      var n = 0;
      while (n < numkm) {
        digitumkm[n].setOptions({
          visible: true
        });
        n = n + 1;
      }
    cek();
  } else {
    var n = 0;
    while (n < numkm) {
      digitumkm[n].setOptions({
        visible: false
      });
      n = n + 1;
    }
    document.getElementById("semua").checked = 0;
  }
}

function layeribadah() {
  if (document.getElementById("ibadah").checked == 1) {
      var n = 0;
      while (n < nibadah) {
        digitibadah[n].setOptions({
          visible: true
        });
        n = n + 1;
      }
    cek();
  } else {
    var n = 0;
    while (n < nibadah) {
      digitibadah[n].setOptions({
        visible: false
      });
      n = n + 1;
    }
    document.getElementById("semua").checked = 0;
  }
}

function layerkantor() {
  if (document.getElementById("kantor").checked == 1) {
      var n = 0;
      while (n < nkantor) {
        digitkantor[n].setOptions({
          visible: true
        });
        n = n + 1;
      }
    cek();
  } else {
    var n = 0;
    while (n < nkantor) {
      digitkantor[n].setOptions({
        visible: false
      });
      n = n + 1;
    }
    document.getElementById("semua").checked = 0;
  }
}

function layerpendidikan() {
  if (document.getElementById("pendidikan").checked == 1) {
      var n = 0;
      while (n < npendidikan) {
        digitpendidikan[n].setOptions({
          visible: true
        });
        n = n + 1;
      }
    cek();
  } else {
    var n = 0;
    while (n < npendidikan) {
      digitpendidikan[n].setOptions({
        visible: false
      });
      n = n + 1;
    }
    document.getElementById("semua").checked = 0;
  }
}

function layerkesehatan() {
  if (document.getElementById("kesehatan").checked == 1) {
      var n = 0;
      while (n < nkesehatan) {
        digitkesehatan[n].setOptions({
          visible: true
        });
        n = n + 1;
      }
    cek();
  } else {
    var n = 0;
    while (n < nkesehatan) {
      digitkesehatan[n].setOptions({
        visible: false
      });
      n = n + 1;
    }
    document.getElementById("semua").checked = 0;
  }
}

function ceklis() {
  var x = document.getElementsByName("layerpeta");
  if (document.getElementById("semua").checked == 1) {
    var i;
    for (i = 0; i < x.length; i++) {    
      document.getElementsByName("layerpeta")[i].checked = 1; 
    }
  }
  else {
    var i;
    for (i = 0; i < x.length; i++) {    
      document.getElementsByName("layerpeta")[i].checked = 0; 
    }
  }
  layernagari();
  layerjorong();
  layerumkm();
  layerrumah();
  layerkantor();
  layeribadah();
  layerpendidikan();
  layerkesehatan();
}


function cek() {
  x = document.getElementsByName("layerpeta");
  var stats=true;
  var i;
  for (i = 0; i < x.length; i++) {    
    if (document.getElementsByName("layerpeta")[i].checked == 0) {
      stats=false;
    }
  }
  if (stats==true) {
    document.getElementById("semua").checked = 1;
  } 
}

function semuadigitasi() {
  digitasijorong();
  viewdigitnagari()
  digitasirumah();
  digitasiumkm();
  digitasikantor();
  digitasit4ibadah();
  digitasipendidikan();
  digitasikesehatan();

  document.getElementById("semua").checked = 1;
  var x = document.getElementsByName("layerpeta");
  var i;
  for (i = 0; i < x.length; i++) {    
    document.getElementsByName("layerpeta")[i].checked = 1; 
  }
}

var markersDua = [];
var centerBaru;
var infoDua = [];
var fotosrc = 'foto/';
var markers = [];
var circles = [];
var pos = 'null';
var infowindow;
var centerLokasi;
var tampillegenda = false;


function legenda() {
  $('#legenda').empty();
  $('#legenda').append('<a class="btn btn-default" role="button" id="hidelegenda" data-toggle="tooltip" onclick="hideLegenda()" title="Hide Legend"><i class="fa fa-eye-slash" style="color:black;"></i></a>');

  if (tampillegenda == false) {
    var legend = document.getElementById('legend');
    var div = document.createElement('div');
    var isilegend = document.createElement('div');
    var content = [];
    content.push('<p><div class="batas nagari"></div>Nagari Border</p>');
    content.push('<p><div class="digit gantiang"></div>Jorong Ganting</p>');
    content.push('<p><div class="digit koto"></div>Jorong Koto Gadang</p>');
    content.push('<p><div class="digit sutijo"></div>Jorong Sutijo</p>');
    content.push('<p><div class="digit rumah"></div>House Building</p>');
    content.push('<p><div class="digit ibadah"></div>Worship Building</p>');
    content.push('<p><div class="digit umkm"></div>Mirco, Small, Medium, Enterprise (MSME) Building</p>');
    content.push('<p><div class="digit kantor"></div>Office Building</p>');
    content.push('<p><div class="digit pendidikan"></div>Educational Building</p>');
    content.push('<p><div class="digit kesehatan"></div>Health Building</p>');
    isilegend.innerHTML = content.join('');
    legend.appendChild(isilegend);
    map.controls[google.maps.ControlPosition.LEFT_BOTTOM].push(legend);
    $('#legend').show();
    tampillegenda = true;
  } 
  else {
    $('#legend').show();
  }

}

function hideLegenda() {
  $('#legend').hide();
  $('#legenda').empty();
  $('#legenda').append('<button class="btn btn-default" title="show legend" onclick="legenda()"><i class="fa fa-globe"></i></button>');
}



function hapusInfo() {
  for (var i = 0; i < infoDua.length; i++) {
    infoDua[i].setMap(null);
  }
}

function aktifkanGeolocation() { //posisi saat ini
  navigator.geolocation.getCurrentPosition(function (position) {
    hapusMarkerInfowindow();
    hapusInfo();
    pos = {
      lat: position.coords.latitude,
      lng: position.coords.longitude

    };
    marker = new google.maps.Marker({
      position: pos,
      map: map,
      animation: google.maps.Animation.BOUNCE,
    });
    centerLokasi = new google.maps.LatLng(pos.lat, pos.lng);
    markers.push(marker);
    infowindow = new google.maps.InfoWindow({
      position: pos,
      content: "<a style='color:black;'>You Are Here</a> "
    });
    infowindow.open(map, marker);
    map.setCenter(pos);
  });
  document.getElementById("lat").value = pos.lat;
  document.getElementById("lng").value = pos.lng;
}

function hapusMarkerInfowindow() {
  setMapOnAll(null);
  hapusMarkerTerdekat();
  pos = 'null';
}

function hapusMarkerTerdekat() {
  for (var i = 0; i < markersDua.length; i++) {
    markersDua[i].setMap(null);
  }
}

function setMapOnAll(map) {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(map);
  }
}

function manualLocation() { //posisi manual
  $('#posisimanual').modal('show');
  map.addListener('click', function (event) {
    addMarker(event.latLng);
  });
}

function addMarker(location) {
  hapusposisi();
  marker = new google.maps.Marker({
    position: location,
    map: map,
    animation: google.maps.Animation.DROP,
  });
  pos = {
    lat: location.lat(),
    lng: location.lng()
  }
  centerLokasi = new google.maps.LatLng(pos.lat, pos.lng);
  markers.push(marker);
  infowindow = new google.maps.InfoWindow();
  infowindow.setContent('Current Position');
  infowindow.open(map, marker);
  usegeolocation = true;
  google.maps.event.clearListeners(map, 'click');
  clearroute2();
  document.getElementById("lat").value = pos.lat;
  document.getElementById("lng").value = pos.lng;
}

function hapusposisi() {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(null);
  }
  markers = [];
}


function hapusRadius() {
  for (var i = 0; i < circles.length; i++) {
    circles[i].setMap(null);
  }
  circles = [];
  cekRadiusStatus = 'off';
}


function callRoute(start, end, nama) {
  if (pos == 'null' || typeof (pos) == "undefined") {
    $('#atur-posisi').modal('show');
  } 
  else {
    clearroute2();
    directionsService = new google.maps.DirectionsService;
    directionsDisplay = new google.maps.DirectionsRenderer;


    directionsService.route({
        origin: start,
        destination: end,
        travelMode: google.maps.TravelMode.DRIVING
      },
      function (response, status) {
        if (status === google.maps.DirectionsStatus.OK) {
          directionsDisplay.setDirections(response);
        } else {
          window.alert('Directions request failed due to ' + status);
        }
      }
    );
    directionsDisplay.setMap(map);
    map.setZoom(16);
    $('#detailrute').empty();
    $('#rute').show();
    $('#rute').append('<button class="btn btn-default btn-xs" onclick="tutuprute()" id="tutuprute" style="float: right;"><i class="fas fa-snowplow"></i> Clear Route</button>')
    $('#rute').append("<div class='panel-body' style='max-height:350px;overflow:auto;'><div class='form-group' id='detailrute'></div></div></div>");
    directionsDisplay.setPanel(document.getElementById('detailrute'));
  }
}


function tampilkanhasilcari() {
  $('#found').empty();
  $("#peta").addClass("col-md-9");
  $('#tampilanpencarian').show();
  $('#detail-informasi-pencarian').show();
  document.getElementById('panjangtabel').style.height = "460px";
}

function sembunyikancari() {
  $("#peta").removeClass("col-md-9");
  // $('#tampilanpencarian').hide();
  // $('#found').empty();
  // $('#hidecari').hide();
  // $('#rute').hide();
  $('#detail-informasi-pencarian').hide();
}

function resultt() {
  $("#result").show();
  $("#resultaround").hide();
  $("#eventt").hide();
  $("#infoo").hide();
  $("#att1").hide();
  $("#hide2").show();
  $("#showlist").hide();
  $("#radiuss").hide();
  $("#infoo1").hide();
  $("#att2").hide();
  $("#infoev").hide();
}

function rutetampil() {
  $("#att2").show();
  $("#att1").hide();
  $("#radiuss").hide();
  $("#infoo1").hide();
  $("#infoev").hide();
  $("#infoo").show();
  $("#rute").show();
}


function clearroute2() {
  if (typeof (directionsDisplay) != "undefined" && directionsDisplay.getMap() != undefined) {
    directionsDisplay.setMap(null);
    $("#detailrute").remove();
    $("#rute").empty();
    $("#rute").hide();
  }
}

function tutuprute() {
  $("#tutuprute").remove();
  clearroute2();
}

function refresh() {
  hapusposisi();
  hapusRadius();
  sembunyikancari();
  initMap();
  $('#legenda').empty();
  $('#legenda').append('<button class="btn btn-default" title="show legend" onclick="legenda()"><i class="fa fa-globe"></i></button>');
}

function cari_modelbang() { 
  var model = document.getElementById("model").value;
  console.log("cari model bangunan: " + model);
  $.ajax({
    url: 'act/ibadah_cari-model.php?model=' + model,
    data: "",
    dataType: 'json',
    success: function (rows) {
      cari_ibadah(rows);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $('#gagal').modal('show');
      $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
      $('#notifikasi').append(thrownError);
    }
  });

  $.ajax({
    url: 'act/rumah_cari-model.php?model=' + model,
    data: "",
    dataType: 'json',
    success: function (rows) {
      cari_rumah(rows);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $('#gagal').modal('show');
      $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
      $('#notifikasi').append(thrownError);
    }
  });

    $.ajax({
    url: 'act/kantor_cari-model.php?model=' + model,
    data: "",
    dataType: 'json',
    success: function (rows) {
      cari_kantor(rows);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $('#gagal').modal('show');
      $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
      $('#notifikasi').append(thrownError);
    }
  });

  $.ajax({
    url: 'act/pendidikan_cari-model.php?model=' + model,
    data: "",
    dataType: 'json',
    success: function (rows) {
      cari_pendidikan(rows);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $('#gagal').modal('show');
      $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
      $('#notifikasi').append(thrownError);
    }
  });

  $.ajax({
    url: 'act/kesehatan_cari-model.php?model=' + model,
    data: "",
    dataType: 'json',
    success: function (rows) {
      cari_kesehatan(rows);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $('#gagal').modal('show');
      $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
      $('#notifikasi').append(thrownError);
    }
  });

  $.ajax({
    url: 'act/umkm_cari-model.php?model=' + model,
    data: "",
    dataType: 'json',
    success: function (rows) {
      cari_umkm(rows);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $('#gagal').modal('show');
      $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
      $('#notifikasi').append(thrownError);
    }
  });
}