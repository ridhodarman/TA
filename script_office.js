function tampilsemuakantor() {
  $.ajax({
    url: 'act/kantor_cari.php',
    data: "",
    dataType: 'json',
    success: function (rows) {
      cari_kantor(rows);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $('#gagal').modal('show');
      $('#notifikasi').append(xhr.status);
      $('#notifikasi').append(thrownError);
    }
  });

}

function cari_kantor(rows) {
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
        icon: 'assets/ico/kantor.png',
        map: map,
        animation: google.maps.Animation.DROP,
      });
      markersDua.push(marker);
      map.setCenter(centerBaru);
      klikInfoWindowkantor(id);
      map.setZoom(15);
      tampilkanhasilcari();
      $('#hasilcari').append("<tr><td>" + name + "</td><td style='text-align: center'><button class='btn btn-theme04 btn-xs' onclick='detailkantor_infow(\"" + id + "\");' title='tampilkan info'><i class='fa fa-search-plus'></i></button></td></tr>");
      a = a + 1;
    }
    $('#found').append("Found: " + a)
    $('#hidecari').show();
  }
}

function carinamakantor() { 
  var namakantor = document.getElementById("namakantor").value;
  $.ajax({
    url: 'act/kantor_cari-nama.php?cari_nama=' + namakantor,
    data: "",
    dataType: 'json',
    success: function (rows) {
      cari_kantor(rows);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $('#gagal').modal('show');
      $('#notifikasi').append(xhr.status);
      $('#notifikasi').append(thrownError);
    }
  });
}

function carijenis_kantor() { 
  var jenis = document.getElementById("jeniskantor").value;
  console.log("cari kantor dengan jenis: " + jenis);
  $.ajax({
    url: 'act/kantor_cari-jenis.php?type=' + jenis,
    data: "",
    dataType: 'json',
    success: function (rows) {
      cari_kantor(rows);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $('#gagal').modal('show');
      $('#notifikasi').append(xhr.status);
      $('#notifikasi').append(thrownError);
    }
  });
}

function carikons_kantor() { 
  var jenis_k = document.getElementById("jeniskons_kantor").value;
  console.log("cari kantor dengan jenis konstruksi: " + jenis_k);
  $.ajax({
    url: 'act/kantor_cari-jeniskonstruksi.php?k=' + jenis_k,
    data: "",
    dataType: 'json',
    success: function (rows) {
      cari_kantor(rows);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $('#gagal').modal('show');
      $('#notifikasi').append(xhr.status);
      $('#notifikasi').append(thrownError);
    }
  });
}


function caritahun_kantor() { 
  var awal = document.getElementById("kantor_awaltahun").value;
  var akhir = document.getElementById("kantor_akhirtahun").value;
  console.log("cari kantor dengan tahun berdiri: " + awal + " - " +akhir);
  $.ajax({
    url: 'act/kantor_cari-tahun.php?awal=' + awal + '&akhir=' + akhir,
    data: "",
    dataType: 'json',
    success: function (rows) {
      cari_kantor(rows);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $('#gagal').modal('show');
      $('#notifikasi').append(xhr.status);
      $('#notifikasi').append(thrownError);
    }
  });
}

function carijorong_kantor() { 
  var jorong = document.getElementById("jorong_kantor").value;
  console.log("cari b kantor dengan jorong: " + jorong);
  $.ajax({
    url: 'act/kantor_cari-jorong.php?j=' + jorong,
    data: "",
    dataType: 'json',
    success: function (rows) {
      cari_kantor(rows);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $('#gagal').modal('show');
      $('#notifikasi').append(xhr.status);
      $('#notifikasi').append(thrownError);
    }
  });
}

function klikInfoWindowkantor(id) {
  google.maps.event.addListener(marker, "click", function () {
    console.log("marker dengan id=" + id + " diklik");
    detailkantor_infow(id);
  });

}

function detailkantor_infow(id) { //menampilkan informas
  hapusInfo();
  clearroute2();
  console.log("fungsi info marker id=" + id);
    $.ajax({
    url: 'act/kantor_detail.php?cari=' + id,
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
          var image = "<img src='foto/kantor/"+row.image+"' alt='building photo' width='165'>";
        }
        var latitude = row.latitude;
        var longitude = row.longitude;
        centerBaru = new google.maps.LatLng(row.latitude, row.longitude);
        marker = new google.maps.Marker({
          position: centerBaru,
          icon: 'assets/ico/kantor.png',
          map: map,
          animation: google.maps.Animation.DROP,
        });
        markersDua.push(marker);
        map.setCenter(centerBaru);
        map.setZoom(18);
        infowindow = new google.maps.InfoWindow({
          position: centerBaru,
          content: "<span style=color:black><center><b>Information</b><br>"+image+"<p><i class='fa fa-bank'></i><b> "+ nama + "</b><br><a role='button' class='btn btn-default fa fa-car' onclick='callRoute(centerLokasi, centerBaru);rutetampil();'> Show Route</a>&nbsp<a role='button' class='btn btn-default fa fa-info-circle' onclick='detailkantor("+'"'+id+'"'+")'> View Details</a></center></span>",
          pixelOffset: new google.maps.Size(0, -33)
        });
        infoDua.push(infowindow);
        hapusInfo();
        infowindow.open(map);
        klikInfoWindowkantor(id);
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $('#gagal').modal('show');
      $('#notifikasi').append(xhr.status);
      $('#notifikasi').append(thrownError);
    }
  });
}


function aktifkanRadiuskantor() { //fungsi radius
  if (pos == 'null') {
    $('#atur-posisi').modal('show');
  } else {
    hapusRadius();
    clearroute2();
    var inputradiuskantor = document.getElementById("inputradiuskantor").value;
    var circle = new google.maps.Circle({
      center: pos,
      radius: parseFloat(inputradiuskantor * 100),
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
    teksradiuskantor()
  }
  cekRadiusStatus = 'on';
  tampilkanradiuskantor();
}

function teksradiuskantor() {
  document.getElementById('m_kantor').innerHTML = document.getElementById('inputradiuskantor').value * 100
}

function cekRadiuskantor() {
  radiuskantor = inputradiuskantor.value * 100;
  lat = document.getElementById("lat").value;
  lng = document.getElementById("lng").value;
}

function tampilkanradiuskantor() { //menampilkan bang kantor berdasarkan radius
  $('#hasilcari1').show();
  $('#hasilcari').empty();
  $('#found').empty();
  hapusInfo();
  hapusMarkerTerdekat();
  cekRadiuskantor();
  clearroute2();
  console.log("panggil radiusnyaa, b.kantor sekitar dengan koordinat:" + lat + "," + lng + " dan radius=" + radiuskantor);

  $.ajax({
    url: 'act/kantor_radius.php?lat=' + pos.lat + '&lng=' + pos.lng + '&rad=' + radiuskantor,
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
            icon: 'assets/ico/kantor.png',
            map: map,
            animation: google.maps.Animation.DROP,
          });
          markersDua.push(marker);
          map.setCenter(centerBaru);
          klikInfoWindowkantor(id);
          map.setZoom(15);
          tampilkanhasilcari();
          $('#hasilcari').append("<tr><td>" + nama + "</td><td style='text-align: center'><button class='btn btn-theme04 btn-xs' onclick='detailkantor_infow(\"" + id + "\");' title='tampilkan info'><i class='fa fa-search-plus'></i></button></td></tr>");
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

function carifasilitas_kantor(){

  $('#hasilcari1').show();
  $('#hasilcari').empty();
  hapusInfo();
  clearroute2();
  hapusRadius();
  hapusMarkerTerdekat();
  var arrayFas=[];
  for(i=0; i<$("input[name=fas_kantor]:checked").length;i++){
    arrayFas.push($("input[name=fas_kantor]:checked")[i].value);
  }
  if (arrayFas==''){
    $('#peringatan').modal('show');
    $('#ket-p').append('Choose Facility !');
  }else{
    $.ajax({ url: server+'act/kantor_cari-fasilitas.php?fas='+arrayFas, data: "", dataType: 'json', success: function(rows){
      console.log(server+'act/kantor_cari-fasilitas.php?fas='+arrayFas);
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
              icon:'assets/ico/kantor.png',
              map: map,
              animation: google.maps.Animation.DROP,
            });
              markersDua.push(marker);
              map.setCenter(centerBaru);
              klikInfoWindowkantor(id)
              map.setZoom(15);
              tampilkanhasilcari();
              $('#hasilcari').append("<tr><td>" + nama + "</td><td style='text-align: center'><button class='btn btn-theme04 btn-xs' onclick='detailkantor_infow(\"" + id + "\");' title='tampilkan info'><i class='fa fa-search-plus'></i></button></td></tr>");
              a = a + 1;
          }
          $('#found').append("Found: " + a)
          $('#hidecari').show();
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $('#gagal').modal('show');
      $('#notifikasi').append(xhr.status);
      $('#notifikasi').append(thrownError);
    }
  });
  }
}