function tampilsemuaumkm() { //menampilkan semua umkm
  $.ajax({
    url: 'act/umkm_cari.php',
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

function cari_umkm(rows) {
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
        icon: 'assets/ico/kadai.png',
        map: map,
        animation: google.maps.Animation.DROP,
      });
      markersDua.push(marker);
      map.setCenter(centerBaru);
      klikInfoWindowumkm(id);
      map.setZoom(14);
      tampilkanhasilcari();
      $('#hasilcari').append("<tr><td>" + name + "</td><td style='text-align: center'><button class='btn btn-theme04 btn-xs' onclick='detailumkm_infow(\"" + id + "\");' title='tampilkan info'><i class='fa fa-search-plus'></i></button></td></tr>");
      a = a + 1;
    }
    $('#found').append("Found: " + a)
    $('#hidecari').show();
  }
}

function carinamaumkm() { //menampilkan umkm berdasarkan nama
  var namaumkm = document.getElementById("namaumkm").value;
  console.log("memanggil fungsi pencarian umkm berdasarkan nama: " + namaumkm);
  $.ajax({
    url: 'act/umkm_cari-nama.php?cari_nama=' + namaumkm,
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

function carijenis_umkm() { 
  var jenis = document.getElementById("jenisumkm").value;
  console.log("cari umkm dengan jenis: " + jenis);
  $.ajax({
    url: 'act/umkm_cari-jenis.php?type=' + jenis,
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

function carikons_umkm() { 
  var jenis_k = document.getElementById("jeniskons_umkm").value;
  console.log("cari umkm dengan jenis konstruksi: " + jenis_k);
  $.ajax({
    url: 'act/umkm_cari-jeniskonstruksi.php?k=' + jenis_k,
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

function carijorong_umkm() { 
  var jorong = document.getElementById("jorong_umkm").value;
  console.log("cari umkm dengan jorong: " + jorong);
  $.ajax({
    url: 'act/umkm_cari-jorong.php?j=' + jorong,
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

function klikInfoWindowumkm(id) {
  google.maps.event.addListener(marker, "click", function () {
    console.log("marker dengan id=" + id + " diklik");
    detailumkm_infow(id);
  });

}

function detailumkm_infow(id) { //menampilkan informas
  hapusInfo();
  clearroute2();
  console.log("fungsi info marker id=" + id);
    $.ajax({
    url: 'act/umkm_detail.php?cari=' + id,
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
          var image = "<img src='foto/umkm/"+row.image+"' alt='building photo' width='165'>";
        }
        var latitude = row.latitude;
        var longitude = row.longitude;
        centerBaru = new google.maps.LatLng(row.latitude, row.longitude);
        marker = new google.maps.Marker({
          position: centerBaru,
          icon: 'assets/ico/kadai.png',
          map: map,
          animation: google.maps.Animation.DROP,
        });
        markersDua.push(marker);
        map.setCenter(centerBaru);
        map.setZoom(18);
        infowindow = new google.maps.InfoWindow({
          position: centerBaru,
          content: "<span style=color:black><center><b>Information</b><br>"+image+"<p><i class='fas fa-store-alt'></i><b>" + nama + "</b><br><a role='button' class='btn btn-default fa fa-car' onclick='callRoute(centerLokasi, centerBaru);rutetampil();'> Show Route</a>&nbsp<a role='button' class='btn btn-default fa fa-info-circle' onclick='detailumkm("+'"'+id+'"'+")'> View Details</a></center></span>",
          pixelOffset: new google.maps.Size(0, -33)
        });
        infoDua.push(infowindow);
        hapusInfo();
        infowindow.open(map);
        klikInfoWindowumkm(id);
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $('#gagal').modal('show');
      $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
      $('#notifikasi').append(thrownError);
    }
  });
}


function aktifkanRadiusumkm() { //fungsi radius umkm
  if (pos == 'null') {
    $('#atur-posisi').modal('show');
  } else {
    hapusRadius();
    clearroute2();
    var inputradiusumkm = document.getElementById("inputradiusumkm").value;
    var circle = new google.maps.Circle({
      center: pos,
      radius: parseFloat(inputradiusumkm * 100),
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
    teksradiusumkm()
  }
  cekRadiusStatus = 'on';
  tampilkanradiusumkm();
}

function teksradiusumkm() {
  document.getElementById('km_umkm').innerHTML = document.getElementById('inputradiusumkm').value * 100
}

function cekRadiusumkm() {
  radiusumkm = inputradiusumkm.value * 100;
  lat = document.getElementById("lat").value;
  lng = document.getElementById("lng").value;
}

function tampilkanradiusumkm() { //menampilkan umkm berdasarkan radius
  $('#hasilcari1').show();
  $('#hasilcari').empty();
  $('#found').empty();
  hapusInfo();
  hapusMarkerTerdekat();
  cekRadiusumkm();
  clearroute2();
  console.log("panggil radiusnyaa, umkm sekitar dengan koordinat:" + lat + "," + lng + " dan radius=" + radiusumkm);
  $.ajax({
    url: 'act/umkm_radius.php?lat=' + pos.lat + '&lng=' + pos.lng + '&rad=' + radiusumkm,
    data: "",
    dataType: 'json',
    success: function (rows) {
      if (rows != null) {
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
            icon: 'assets/ico/kadai.png',
            map: map,
            animation: google.maps.Animation.DROP,
          });
          markersDua.push(marker);
          map.setCenter(centerBaru);
          klikInfoWindowumkm(id);
          map.setZoom(14);
          tampilkanhasilcari();
          $('#hasilcari').append("<tr><td>" + nama + "</td><td style='text-align: center'><button class='btn btn-theme04 btn-xs' onclick='detailumkm_infow(\"" + id + "\");' title='tampilkan info'><i class='fa fa-search-plus'></i></button></td></tr>");
          a = a + 1;
        }
        $('#found').append("Found: " + a);
        $('#hidecari').show();
      }
      else {
        $('#hasilcari').append('<td colspan="2">no result</td>');
      }
    }
  });
}

function carifasilitas_umkm(){

  $('#hasilcari1').show();
  $('#hasilcari').empty();
  hapusInfo();
  clearroute2();
  hapusRadius();
  hapusMarkerTerdekat();
  var arrayFas=[];
  for(i=0; i<$("input[name=fas_umkm]:checked").length;i++){
    arrayFas.push($("input[name=fas_umkm]:checked")[i].value);
  }
  if (arrayFas==''){
    $('#ket-p').empty();
    $('#peringatan').modal('show');
    $('#ket-p').append('Choose Facility !');
  }else{
    console.log(server+'act/umkm_cari-fasilitas.php?fas='+arrayFas);
    $.ajax({ url: server+'act/umkm_cari-fasilitas.php?fas='+arrayFas, data: "", dataType: 'json', success: function(rows){
      $('#found').empty();
      $('#hasilcari').empty();
      if(rows==null)
            {
              $('#kosong').modal('show');
              $('#hasilcari').append('<td colspan="2">no result</td>');
            }
      else {
        var a = 0;
        for (var i in rows) {   
              var row     = rows[i];
              var id   = row.id;
              var nama   = row.name;
              var latitude  = row.latitude ;
              var longitude = row.longitude ;
              centerBaru = new google.maps.LatLng(latitude, longitude);
              marker = new google.maps.Marker
            ({
              position: centerBaru,
              icon:'assets/ico/kadai.png',
              map: map,
              animation: google.maps.Animation.DROP,
            });
            markersDua.push(marker);
            map.setCenter(centerBaru);
            klikInfoWindowumkm(id)
            map.setZoom(14);
            tampilkanhasilcari();
            $('#hasilcari').append("<tr><td>" + nama + "</td><td style='text-align: center'><button class='btn btn-theme04 btn-xs' onclick='detailumkm_infow(\"" + id + "\");' title='tampilkan info'><i class='fa fa-search-plus'></i></button></td></tr>");
            a = a + 1;
        }
        $('#found').append("Found: " + a);
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

function cari_pendumkm() { 
  var awal = document.getElementById("penghasilan-umkm1").value;
  var akhir = document.getElementById("penghasilan-umkm2").value;
  console.log("cari pendapatan umkm dari: " + awal + " - " +akhir);
  $.ajax({
    url: 'act/umkm_cari-pendapatan.php?awal=' + awal + '&akhir=' + akhir,
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