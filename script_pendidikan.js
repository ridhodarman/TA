function tampilsemuapendidikan() {
  $.ajax({
    url: 'act/pendidikan_cari.php',
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

}

function cari_pendidikan(rows) {
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
        icon: 'assets/ico/sekolah.png',
        map: map,
        animation: google.maps.Animation.DROP,
      });
      markersDua.push(marker);
      map.setCenter(centerBaru);
      klikInfoWindowpendidikan(id);
      map.setZoom(15);
      tampilkanhasilcari();
      $('#hasilcari').append("<tr><td>" + name + "</td><td style='text-align: center'><button class='btn btn-theme04 btn-xs' onclick='detailpendidikan_infow(\"" + id + "\");' title='tampilkan info'><i class='fa fa-search-plus'></i></button></td></tr>");
      a = a + 1;
    }
    $('#found').append("Found: " + a)
    $('#hidecari').show();
  }
}

function carinamapendidikan() { 
  var namapendidikan = document.getElementById("namapendidikan").value;
  $.ajax({
    url: 'act/pendidikan_cari-nama.php?cari_nama=' + namapendidikan,
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
}

function carijenis_pendidikan() { 
  var jenis = document.getElementById("jenispendidikan").value;
  console.log("cari pendidikan dengan jenis tingkatan: " + jenis);
  $.ajax({
    url: 'act/pendidikan_cari-jenistingkat.php?type=' + jenis,
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
}

function caritipe_pendidikan() { 
  var stat = document.getElementById("tipependidikan").value;
  console.log("cari pendidikan dengan tipe: " + stat);
  $.ajax({
    url: 'act/pendidikan_cari-tipe.php?type=' + stat,
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
}

function cariluasbang_pendidikan() { 
  var awal = document.getElementById("pendidikan_awalbang").value;
  var akhir = document.getElementById("pendidikan_akhirbang").value;
  console.log("cari b.pendidikan dengan luas bangunan: " + awal + " - " +akhir);
  $.ajax({
    url: 'act/pendidikan_cari-luasbang.php?awal=' + awal + '&akhir=' + akhir,
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
}

function cariluastanah_pendidikan() { 
  var awal = document.getElementById("pendidikan_awaltanah").value;
  var akhir = document.getElementById("pendidikan_akhirtanah").value;
  console.log("cari b.pendidikan dengan luas tanah: " + awal + " - " +akhir);
  $.ajax({
    url: 'act/pendidikan_cari-luastanah.php?awal=' + awal + '&akhir=' + akhir,
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
}

function carikons_pendidikan() { 
  var jenis_k = document.getElementById("jeniskons_pendidikan").value;
  console.log("cari pendidikan dengan jenis konstruksi: " + jenis_k);
  $.ajax({
    url: 'act/pendidikan_cari-jeniskonstruksi.php?k=' + jenis_k,
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
}

function carijorong_pendidikan() { 
  var jorong = document.getElementById("jorong_pendidikan").value;
  console.log("cari b pendidikan dengan jorong: " + jorong);
  $.ajax({
    url: 'act/pendidikan_cari-jorong.php?j=' + jorong,
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
}

function klikInfoWindowpendidikan(id) {
  google.maps.event.addListener(marker, "click", function () {
    console.log("marker dengan id=" + id + " diklik");
    detailpendidikan_infow(id);
  });

}

function detailpendidikan_infow(id) { //menampilkan informas
  hapusInfo();
  clearroute2();
  console.log("fungsi info marker id=" + id);
    $.ajax({
    url: 'act/pendidikan_detail.php?cari=' + id,
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
          var image = "<img src='foto/b-pendidikan/"+row.image+"' alt='building photo' width='165'>";
        }
        var latitude = row.latitude;
        var longitude = row.longitude;
        centerBaru = new google.maps.LatLng(row.latitude, row.longitude);
        marker = new google.maps.Marker({
          position: centerBaru,
          icon: 'assets/ico/sekolah.png',
          map: map,
          animation: google.maps.Animation.DROP,
        });
        markersDua.push(marker);
        map.setCenter(centerBaru);
        map.setZoom(18);
        infowindow = new google.maps.InfoWindow({
          position: centerBaru,
          content: "<span style=color:black><center><b>Information</b><br>"+image+"<p><i class='fas fa-school'></i><b> "+ nama + "</b><br><a role='button' class='btn btn-default fa fa-car' onclick='callRoute(centerLokasi, centerBaru);rutetampil();'> Show Route</a>&nbsp<a role='button' class='btn btn-default fa fa-info-circle' onclick='detailpendidikan("+'"'+id+'"'+")'> View Details</a></center></span>",
          pixelOffset: new google.maps.Size(0, -33)
        });
        infoDua.push(infowindow);
        hapusInfo();
        infowindow.open(map);
        klikInfoWindowpendidikan(id);
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $('#gagal').modal('show');
      $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
      $('#notifikasi').append(thrownError);
    }
  });
}


function aktifkanRadiuspendidikan() { //fungsi radius
  if (pos == 'null') {
    $('#atur-posisi').modal('show');
  } else {
    hapusRadius();
    clearroute2();
    var inputradiuspendidikan = document.getElementById("inputradiuspendidikan").value;
    var circle = new google.maps.Circle({
      center: pos,
      radius: parseFloat(inputradiuspendidikan * 100),
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
    teksradiuspendidikan()
  }
  cekRadiusStatus = 'on';
  tampilkanradiuspendidikan();
}

function teksradiuspendidikan() {
  document.getElementById('m_pendidikan').innerHTML = document.getElementById('inputradiuspendidikan').value * 100
}

function cekRadiuspendidikan() {
  radiuspendidikan = inputradiuspendidikan.value * 100;
  lat = document.getElementById("lat").value;
  lng = document.getElementById("lng").value;
}

function tampilkanradiuspendidikan() { //menampilkan bang pendidikan berdasarkan radius
  $('#hasilcari1').show();
  $('#hasilcari').empty();
  $('#found').empty();
  hapusInfo();
  hapusMarkerTerdekat();
  cekRadiuspendidikan();
  clearroute2();
  console.log("panggil radiusnyaa, b.pendidikan sekitar dengan koordinat:" + lat + "," + lng + " dan radius=" + radiuspendidikan);

  $.ajax({
    url: 'act/pendidikan_radius.php?lat=' + pos.lat + '&lng=' + pos.lng + '&rad=' + radiuspendidikan,
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
            icon: 'assets/ico/sekolah.png',
            map: map,
            animation: google.maps.Animation.DROP,
          });
          markersDua.push(marker);
          map.setCenter(centerBaru);
          klikInfoWindowpendidikan(id);
          map.setZoom(15);
          tampilkanhasilcari();
          $('#hasilcari').append("<tr><td>" + nama + "</td><td style='text-align: center'><button class='btn btn-theme04 btn-xs' onclick='detailpendidikan_infow(\"" + id + "\");' title='tampilkan info'><i class='fa fa-search-plus'></i></button></td></tr>");
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

function carifasilitas_pendidikan(){

  $('#hasilcari1').show();
  $('#hasilcari').empty();
  hapusInfo();
  clearroute2();
  hapusRadius();
  hapusMarkerTerdekat();
  var arrayFas=[];
  for(i=0; i<$("input[name=fas_pendidikan]:checked").length;i++){
    arrayFas.push($("input[name=fas_pendidikan]:checked")[i].value);
  }
  if (arrayFas==''){
    $('#ket-p').empty();
    $('#peringatan').modal('show');
    $('#ket-p').append('Choose Facility !');
  }else{
    $.ajax({ url: server+'act/pendidikan_cari-fasilitas.php?fas='+arrayFas, data: "", dataType: 'json', success: function(rows){
      console.log(server+'act/pendidikan_cari-fasilitas.php?fas='+arrayFas);
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
              icon:'assets/ico/sekolah.png',
              map: map,
              animation: google.maps.Animation.DROP,
            });
              markersDua.push(marker);
              map.setCenter(centerBaru);
              klikInfoWindowpendidikan(id)
              map.setZoom(15);
              tampilkanhasilcari();
              $('#hasilcari').append("<tr><td>" + nama + "</td><td style='text-align: center'><button class='btn btn-theme04 btn-xs' onclick='detailpendidikan_infow(\"" + id + "\");' title='tampilkan info'><i class='fa fa-search-plus'></i></button></td></tr>");
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