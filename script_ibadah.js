function tampilsemuaibadah() {
  $.ajax({
    url: 'act/ibadah_cari.php',
    data: "",
    dataType: 'json',
    success: function (rows) {
      cari_ibadah(rows);
    }
  });

}

function cari_ibadah(rows) {
  hapusInfo();
  hapusRadius();
  clearroute2();
  hapusMarkerTerdekat();
  $('#hasilcari').empty();
  $('#found').empty();
  if (rows == null) {
    $('#kosong').modal('show');
  }
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
      icon: 'assets/ico/musajik.png',
      map: map,
      animation: google.maps.Animation.DROP,
    });
    markersDua.push(marker);
    map.setCenter(centerBaru);
    klikInfoWindowibadah(id);
    map.setZoom(14);
    tampilkanhasilcari();
    $('#hasilcari').append("<tr><td>" + name + "</td><td style='text-align: center'><button class='btn btn-theme04 btn-xs' onclick='detailibadah_infow(\"" + id + "\");' title='tampilkan info'><i class='fa fa-search-plus'></i></button></td></tr>");
    a = a + 1;
  }
  $('#found').append("Found: " + a)
  $('#hidecari').show();
}

function carinamaibadah() { 
  var namaibadah = document.getElementById("namaibadah").value;
  $.ajax({
    url: 'act/ibadah_cari-nama.php?cari_nama=' + namaibadah,
    data: "",
    dataType: 'json',
    success: function (rows) {
      cari_ibadah(rows);
    }
  });
}

function carijenis_ibadah() { 
  var jenis = document.getElementById("jenisibadah").value;
  console.log("cari ibadah dengan jenis: " + jenis);
  $.ajax({
    url: 'act/ibadah_cari-jenis.php?type=' + jenis,
    data: "",
    dataType: 'json',
    success: function (rows) {
      cari_ibadah(rows);
    }
  });
}

function carikons_ibadah() { 
  var jenis_k = document.getElementById("jeniskons_ibadah").value;
  console.log("cari ibadah dengan jenis konstruksi: " + jenis_k);
  $.ajax({
    url: 'act/ibadah_cari-jeniskonstruksi.php?k=' + jenis_k,
    data: "",
    dataType: 'json',
    success: function (rows) {
      cari_ibadah(rows);
    }
  });
}

function cariluasbang_ibadah() { 
  var awal = document.getElementById("ibadah_awalbang").value;
  var akhir = document.getElementById("ibadah_akhirbang").value;
  console.log("cari ibadah dengan luas bangunan: " + awal + " - " +akhir);
  $.ajax({
    url: 'act/ibadah_cari-luasbang.php?awal=' + awal + '&akhir=' + akhir,
    data: "",
    dataType: 'json',
    success: function (rows) {
      cari_ibadah(rows);
    }
  });
}

function cariluastanah_ibadah() { 
  var awal = document.getElementById("ibadah_awaltanah").value;
  var akhir = document.getElementById("ibadah_akhirtanah").value;
  console.log("cari ibadah dengan luas tanah: " + awal + " - " +akhir);
  $.ajax({
    url: 'act/ibadah_cari-luastanah.php?awal=' + awal + '&akhir=' + akhir,
    data: "",
    dataType: 'json',
    success: function (rows) {
      cari_ibadah(rows);
    }
  });
}

function caritahun_ibadah() { 
  var awal = document.getElementById("ibadah_awaltahun").value;
  var akhir = document.getElementById("ibadah_akhirtahun").value;
  console.log("cari ibadah dengan tahun berdiri: " + awal + " - " +akhir);
  $.ajax({
    url: 'act/ibadah_cari-tahun.php?awal=' + awal + '&akhir=' + akhir,
    data: "",
    dataType: 'json',
    success: function (rows) {
      cari_ibadah(rows);
    }
  });
}

function carijorong_ibadah() { 
  var jorong = document.getElementById("jorong_ibadah").value;
  console.log("cari b ibadah dengan jorong: " + jorong);
  $.ajax({
    url: 'act/ibadah_cari-jorong.php?j=' + jorong,
    data: "",
    dataType: 'json',
    success: function (rows) {
      cari_ibadah(rows);
    }
  });
}

function klikInfoWindowibadah(id) {
  google.maps.event.addListener(marker, "click", function () {
    console.log("marker dengan id=" + id + " diklik");
    detailibadah_infow(id);
  });

}

function detailibadah_infow(id) { //menampilkan informas
  hapusInfo();
  clearroute2();
  console.log("fungsi info marker id=" + id);
    $.ajax({
    url: 'act/ibadah_detail.php?cari=' + id,
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
          var image = "<img src='foto/b-ibadah/"+row.image+"' alt='building photo' width='165'>";
        }
        var latitude = row.latitude;
        var longitude = row.longitude;
        centerBaru = new google.maps.LatLng(row.latitude, row.longitude);
        marker = new google.maps.Marker({
          position: centerBaru,
          icon: 'assets/ico/musajik.png',
          map: map,
          animation: google.maps.Animation.DROP,
        });
        markersDua.push(marker);
        map.setCenter(centerBaru);
        map.setZoom(18);
        infowindow = new google.maps.InfoWindow({
          position: centerBaru,
          content: "<span style=color:black><center><b>Information</b><br>"+image+"<p><i class='fas fa-mosque'></i><b> "+ nama + "</b><br><a role='button' class='btn btn-default fa fa-car' onclick='callRoute(centerLokasi, centerBaru);rutetampil();'> Show Route</a>&nbsp<a role='button' class='btn btn-default fa fa-info-circle' target='_blank' href='detailrumah.php?id=" + id + "'> View Details</a></center></span>",
          pixelOffset: new google.maps.Size(0, -33)
        });
        infoDua.push(infowindow);
        hapusInfo();
        infowindow.open(map);
        klikInfoWindowibadah(id);
      }

    }
  });
}


function aktifkanRadiusibadah() { //fungsi radius
  if (pos == 'null') {
    $('#atur-posisi').modal('show');
  } else {
    hapusRadius();
    clearroute2();
    var inputradiusibadah = document.getElementById("inputradiusibadah").value;
    var circle = new google.maps.Circle({
      center: pos,
      radius: parseFloat(inputradiusibadah * 100),
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
    teksradiusibadah()
  }
  cekRadiusStatus = 'on';
  tampilkanradiusibadah();
}

function teksradiusibadah() {
  document.getElementById('m_ibadah').innerHTML = document.getElementById('inputradiusibadah').value * 100
}

function cekRadiusibadah() {
  radiusibadah = inputradiusibadah.value * 100;
  lat = document.getElementById("lat").value;
  lng = document.getElementById("lng").value;
}

function tampilkanradiusibadah() { //menampilkan bang ibadah berdasarkan radius
  $('#hasilcari1').show();
  $('#hasilcari').empty();
  $('#found').empty();
  hapusInfo();
  hapusMarkerTerdekat();
  cekRadiusibadah();
  clearroute2();
  console.log("panggil radiusnyaa, b.ibadah sekitar dengan koordinat:" + lat + "," + lng + " dan radius=" + radiusibadah);

  $.ajax({
    url: 'act/ibadah_radius.php?lat=' + pos.lat + '&lng=' + pos.lng + '&rad=' + radiusibadah,
    data: "",
    dataType: 'json',
    success: function (rows) {
      for (var i in rows) {
        var row = rows[i];
        var id = row.id;
        var nama = row.name;
        var latitude = row.latitude;
        var longitude = row.longitude;
        centerBaru = new google.maps.LatLng(latitude, longitude);
        marker = new google.maps.Marker({
          position: centerBaru,
          icon: 'assets/ico/musajik.png',
          map: map,
          animation: google.maps.Animation.DROP,
        });
        markersDua.push(marker);
        map.setCenter(centerBaru);
        klikInfoWindowibadah(id);
        map.setZoom(14);
        tampilkanhasilcari();
        $('#hasilcari').append("<tr><td>" + nama + "</td><td style='text-align: center'><button class='btn btn-theme04 btn-xs' onclick='detailibadah_infow(\"" + id + "\");' title='tampilkan info'><i class='fa fa-search-plus'></i></button></td></tr>");
      }
    }
  });
}

function carifasilitas_ibadah(){

  $('#hasilcari1').show();
  $('#hasilcari').empty();
  hapusInfo();
  clearroute2();
  hapusRadius();
  hapusMarkerTerdekat();
  var arrayFas=[];
  for(i=0; i<$("input[name=fas_ibadah]:checked").length;i++){
    arrayFas.push($("input[name=fas_ibadah]:checked")[i].value);
  }
  if (arrayFas==''){
    alert('Choose Facility !');
  }else{
    $.ajax({ url: server+'act/ibadah_cari-fasilitas.php?fas='+arrayFas, data: "", dataType: 'json', success: function(rows){
      console.log(server+'act/ibadah_cari-fasilitas.php?fas='+arrayFas);
      $('#found').empty();
      $('#hasilcari').empty();
      if(rows==null)
            {
              $('#kosong').modal('show');
            }
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
              icon:'assets/ico/musajik.png',
              map: map,
              animation: google.maps.Animation.DROP,
            });
              markersDua.push(marker);
              map.setCenter(centerBaru);
              klikInfoWindowibadah(id)
              map.setZoom(14);
              tampilkanhasilcari();
              $('#hasilcari').append("<tr><td>" + nama + "</td><td style='text-align: center'><button class='btn btn-theme04 btn-xs' onclick='detailibadah_infow(\"" + id + "\");' title='tampilkan info'><i class='fa fa-search-plus'></i></button></td></tr>");
            }

    }});
  }
}