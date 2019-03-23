function tampilsemuakesehatan() {
  $.ajax({
    url: 'act/kesehatan_cari.php',
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

}

function cari_kesehatan(rows) {
  hapusInfo();
  hapusRadius();
  clearroute2();
  hapusMarkerTerdekat();
  $('#hasilcari').empty();
  $('#found').empty();
  if (rows == null) {
    $('#kosong').modal('show');
    $('#hasilcari').append('<td colspan="2">no result</td>');
  }
  else {
    var a = 0;
    for (var i in rows) {
      var row = rows[i];
      var id = row.id;
      var name = row.name;
      var latitude = row.latitude;
      var longitude = row.longitude;
      centerBaru = new google.maps.LatLng(latitude, longitude);
      marker = new google.maps.Marker({
        position: centerBaru,
        icon: 'assets/ico/kesehatan.png',
        map: map,
        animation: google.maps.Animation.DROP,
      });
      markersDua.push(marker);
      map.setCenter(centerBaru);
      klikInfoWindowkesehatan(id);
      map.setZoom(15);
      tampilkanhasilcari();
      $('#hasilcari').append("<tr><td>" + name + "</td><td style='text-align: center'><button class='btn btn-theme04 btn-xs' onclick='detailkesehatan_infow(\"" + id + "\");' title='tampilkan info'><i class='fa fa-search-plus'></i></button></td></tr>");
      a = a + 1;
    }
    $('#found').append("Found: " + a)
    $('#hidecari').show();
  }
}

function carinamakesehatan() { 
  var namakesehatan = document.getElementById("namakesehatan").value;
  $.ajax({
    url: 'act/kesehatan_cari-nama.php?cari_nama=' + namakesehatan,
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
}

function carijenis_kesehatan() { 
  var jenis = document.getElementById("jeniskesehatan").value;
  console.log("cari kesehatan dengan jenis: " + jenis);
  $.ajax({
    url: 'act/kesehatan_cari-jenis.php?type=' + jenis,
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
}

function carijorong_kesehatan() { 
  var jorong = document.getElementById("jorong_kesehatan").value;
  console.log("cari b kesehatan dengan jorong: " + jorong);
  $.ajax({
    url: 'act/kesehatan_cari-jorong.php?j=' + jorong,
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
}

function klikInfoWindowkesehatan(id) {
  google.maps.event.addListener(marker, "click", function () {
    console.log("marker dengan id=" + id + " diklik");
    detailkesehatan_infow(id);
  });

}

function detailkesehatan_infow(id) { //menampilkan informas
  hapusInfo();
  clearroute2();
  console.log("fungsi info marker id=" + id);
    $.ajax({
    url: 'act/kesehatan_detail.php?cari=' + id,
    data: "",
    dataType: 'json',
    success: function (rows) {
      for (var i in rows) {
        var row = rows[i];
        var id = row.id;
        var nama = row.name;
        if (row.image==null) {
          var image = "There are no photos for this building";
        }
        else {
          var image = "<img src='foto/kesehatan/"+row.image+"' alt='building photo' width='165'>";
        }
        var latitude = row.latitude;
        var longitude = row.longitude;
        centerBaru = new google.maps.LatLng(row.latitude, row.longitude);
        marker = new google.maps.Marker({
          position: centerBaru,
          icon: 'assets/ico/kesehatan.png',
          map: map,
          animation: google.maps.Animation.DROP,
        });
        markersDua.push(marker);
        map.setCenter(centerBaru);
        map.setZoom(18);
        infowindow = new google.maps.InfoWindow({
          position: centerBaru,
          content: "<span style=color:black><center><b>Information</b><br>"+image+"<p><i class='fas fa-hospital-alt'></i><b> "+ nama + "</b><br><a role='button' class='btn btn-default fa fa-car' onclick='callRoute(centerLokasi, centerBaru);rutetampil();'> Show Route</a>&nbsp<a role='button' class='btn btn-default fa fa-info-circle' onclick='detailkesehatan("+'"'+id+'"'+")'> View Details</a></center></span>",
          pixelOffset: new google.maps.Size(0, -33)
        });
        infoDua.push(infowindow);
        hapusInfo();
        infowindow.open(map);
        klikInfoWindowkesehatan(id);
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $('#gagal').modal('show');
      $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
      $('#notifikasi').append(thrownError);
    }
  });
}


function aktifkanRadiuskesehatan() { //fungsi radius
  if (pos == 'null') {
    $('#atur-posisi').modal('show');
  } else {
    hapusRadius();
    clearroute2();
    var inputradiuskesehatan = document.getElementById("inputradiuskesehatan").value;
    var circle = new google.maps.Circle({
      center: pos,
      radius: parseFloat(inputradiuskesehatan * 100),
      map: map,
      strokeColor: "blue",
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: "blue",
      fillOpacity: 0.35
    });
    map.setZoom(15);
    map.setCenter(pos);
    circles.push(circle);
    teksradiuskesehatan()
  }
  cekRadiusStatus = 'on';
  tampilkanradiuskesehatan();
}

function teksradiuskesehatan() {
  document.getElementById('m_kesehatan').innerHTML = document.getElementById('inputradiuskesehatan').value * 100
}

function cekRadiuskesehatan() {
  radiuskesehatan = inputradiuskesehatan.value * 100;
  lat = document.getElementById("lat").value;
  lng = document.getElementById("lng").value;
}

function tampilkanradiuskesehatan() { //menampilkan bang kesehatan berdasarkan radius
  $('#hasilcari1').show();
  $('#hasilcari').empty();
  $('#found').empty();
  hapusInfo();
  hapusMarkerTerdekat();
  cekRadiuskesehatan();
  clearroute2();
  console.log("panggil radiusnyaa, b.kesehatan sekitar dengan koordinat:" + lat + "," + lng + " dan radius=" + radiuskesehatan);

  $.ajax({
    url: 'act/kesehatan_radius.php?lat=' + pos.lat + '&lng=' + pos.lng + '&rad=' + radiuskesehatan,
    data: "",
    dataType: 'json',
    success: function (rows) {
      if (rows != null ){
        var a = 0;
        for (var i in rows) {
          var row = rows[i];
          var id = row.id;
          var nama = row.name;
          var latitude = row.latitude;
          var longitude = row.longitude;
          centerBaru = new google.maps.LatLng(latitude, longitude);
          marker = new google.maps.Marker({
            position: centerBaru,
            icon: 'assets/ico/kesehatan.png',
            map: map,
            animation: google.maps.Animation.DROP,
          });
          markersDua.push(marker);
          map.setCenter(centerBaru);
          klikInfoWindowkesehatan(id);
          map.setZoom(15);
          tampilkanhasilcari();
          $('#hasilcari').append("<tr><td>" + nama + "</td><td style='text-align: center'><button class='btn btn-theme04 btn-xs' onclick='detailkesehatan_infow(\"" + id + "\");' title='tampilkan info'><i class='fa fa-search-plus'></i></button></td></tr>");
          a = a + 1;
        }
        $('#found').append("Found: " + a)
        $('#hidecari').show();
      }
      else {
        $('#hasilcari').append('<td colspan="2">no result</td>');
      }
    }
  });
}

function carifasilitas_kesehatan(){

  $('#hasilcari1').show();
  $('#hasilcari').empty();
  hapusInfo();
  clearroute2();
  hapusRadius();
  hapusMarkerTerdekat();
  var arrayFas=[];
  for(i=0; i<$("input[name=fas_kesehatan]:checked").length;i++){
    arrayFas.push($("input[name=fas_kesehatan]:checked")[i].value);
  }
  if (arrayFas==''){
    $('#ket-p').empty();
    $('#peringatan').modal('show');
    $('#ket-p').append('Choose Facility !');
  }else{
    $.ajax({ url: server+'act/kesehatan_cari-fasilitas.php?fas='+arrayFas, data: "", dataType: 'json', success: function(rows){
      console.log(server+'act/kesehatan_cari-fasilitas.php?fas='+arrayFas);
      $('#found').empty();
      $('#hasilcari').empty();
      if(rows==null)
            {
              $('#kosong').modal('show');
              $('#hasilcari').append('<td colspan="2">no result</td>');
            }
      else {
        var a = 0;
        for (var i in rows) 
            {   
              var row     = rows[i];
              var id   = row.id;
              var nama   = row.name;
              var latitude  = row.latitude ;
              var longitude = row.longitude ;
              centerBaru = new google.maps.LatLng(latitude, longitude);
              marker = new google.maps.Marker
            ({
              position: centerBaru,
              icon:'assets/ico/kesehatan.png',
              map: map,
              animation: google.maps.Animation.DROP,
            });
              markersDua.push(marker);
              map.setCenter(centerBaru);
              klikInfoWindowkesehatan(id)
              map.setZoom(15);
              tampilkanhasilcari();
              $('#hasilcari').append("<tr><td>" + nama + "</td><td style='text-align: center'><button class='btn btn-theme04 btn-xs' onclick='detailkesehatan_infow(\"" + id + "\");' title='tampilkan info'><i class='fa fa-search-plus'></i></button></td></tr>");
              a = a + 1;
          }
          $('#found').append("Found: " + a)
          $('#hidecari').show();
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $('#gagal').modal('show');
      $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
      $('#notifikasi').append(thrownError);
    }
  });
  }
}