function tampilsemuarumah(){ //menampilkan semua rumah
  $.ajax({ url: 'act/rumah_tampil.php', data: "", dataType: 'json', success: function (rows){
    cari_rumah(rows);
  }});

}

function rumahkosong(){ 
  $.ajax({ url: 'act/rumah_kosong.php', data: "", dataType: 'json', success: function (rows){
    cari_rumah(rows);
  }});
}

function rumahberpenghuni(){ 
  $.ajax({ url: 'act/rumah_berpenghuni.php', data: "", dataType: 'json', success: function (rows){
    cari_rumah(rows);
  }});
}

function cari_rumah(rows)
{   
	hapusInfo();
	hapusRadius();
	clearroute2();
	hapusMarkerTerdekat();
	$('#hasilcari').empty();
	if(rows==null)
		{
	     $('#kosong').modal('show');
	    }
  var a=0;
	for (var i in rows) 
	    {   
			var row     = rows[i];
		  	var id   = row.id;
		    var latitude  = row.latitude ;
		    var longitude = row.longitude ;
		    centerBaru = new google.maps.LatLng(latitude, longitude);
		    marker = new google.maps.Marker
		       	({
		          position: centerBaru,
		          icon:'assets/ico/home.png',
		          map: map,
		          animation: google.maps.Animation.DROP,
		        });
		        markersDua.push(marker);
		        map.setCenter(centerBaru);
				    klikInfoWindow(id);
		        map.setZoom(14);            
            tampilkanhasilcari();
		        $('#hasilcari').append("<tr><td>"+id+"</td><td style='text-align: center'><button class='btn btn-theme04 btn-xs' onclick='detailrumah_infow(\""+id+"\");' title='tampilkan info'><i class='fa fa-search-plus'></i></button></td></tr>");
            a=a+1;
	    }
      $('#found').append("Found: "+a)
      $('#hidecari').show();
}


function klikInfoWindow(id)
{
    google.maps.event.addListener(marker, "click", function(){
        console.log("marker dengan id="+id+" diklik");
        detailrumah_infow(id);
      });
}


function detailrumah_infow(id){  //menampilkan informasi rumah
  hapusInfo();
  clearroute2();
  console.log("fungsi info marker id="+id);
    $.ajax({url: 'act/rumah_detail.php?cari='+id, data: "", dataType: 'json', success: function(rows)
      {
         for (var i in rows) 
          { 
            var row = rows[i];
            var id = row.id;
            //var nama = row.name;
            if (row.image==null) {
              var image = "There are no photos for this building";
            }
            else {
              var image = "<img src='foto/rumah/"+row.image+"' alt='building photo' width='165'>";
            }
            var latitude  = row.latitude; 
            var longitude = row.longitude ;
            console.log(image);
            centerBaru = new google.maps.LatLng(row.latitude, row.longitude);
            marker = new google.maps.Marker
            ({
              position: centerBaru,
              icon:'assets/ico/home.png',
              map: map,
              animation: google.maps.Animation.DROP,
            });
            markersDua.push(marker);
            map.setCenter(centerBaru);
            klikInfoWindow(id);
            map.setZoom(18); 
            infowindow = new google.maps.InfoWindow({
            position: centerBaru,
            content: "<span style=color:black><center><b>Information</b><br>"+image+"<br><i class='fa fa-home'></i> "+id+"</center><a role='button' class='btn btn-default fa fa-car' onclick='callRoute(centerLokasi, centerBaru);rutetampil();'> Show Route</a> <a role='button' class='btn btn-default fa fa-info-circle' onclick='detailrumah("+'"'+id+'"'+")'> View Details</a>&nbsp</span>",
            pixelOffset: new google.maps.Size(0, -33)
            });
            infoDua.push(infowindow); 
            hapusInfo();
            infowindow.open(map);
          }  
        }
      }); 
}

function aktifkanRadius() { //fungsi radius rumah
  if (pos == 'null') {
    $('#atur-posisi').modal('show');
  } else {
    hapusRadius();
    clearroute2();
    var inputradiusrumah = document.getElementById("inputradius").value;
    var circle = new google.maps.Circle({
      center: pos,
      radius: parseFloat(inputradiusrumah * 100),
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
    teksradius()
  }
  cekRadiusStatus = 'on';
  tampilkanradius();
}


 function tampilkanradius(){ //menampilkan rumah berdasarkan radius
   console.log("panggil radiusnyaa");
    $('#hasilcari1').show();
    $('#hasilcari').empty();
    $('#found').empty();
      hapusInfo();
      hapusMarkerTerdekat();
      cekRadius();
      clearroute2();

        $.ajax({ 
        url: 'act/rumah_radius.php?lat='+pos.lat+'&lng='+pos.lng+'&rad='+rad, data: "", dataType: 'json', success: function(rows)
        {
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
              icon:'assets/ico/home.png',
              map: map,
              animation: google.maps.Animation.DROP,
            });
              markersDua.push(marker);
              map.setCenter(centerBaru);
        klikInfoWindow(id);
              map.setZoom(14);
              tampilkanhasilcari();
              $('#hasilcari').append("<tr><td>"+nama+"</td><td style='text-align: center'><button class='btn btn-theme04 btn-xs' onclick='detaiumkm(\""+id+"\");' title='tampilkan info'><i class='fa fa-search-plus'></i></button></td></tr>");
            } 
            }    
          });
}

function cekRadius()
  {
    rad = inputradius.value*100;
    }

function teksradius()
  {
    document.getElementById('km').innerHTML=document.getElementById('inputradius').value*100
  }

function cari_idrumah() { 
  var idrumah = document.getElementById("id-rumah").value;
  console.log("cari rumah dengan id: " + idrumah);
  if (idrumah==null || idrumah=="") {
    $('#ket-p').empty();
    $('#peringatan').modal('show');
    $('#ket-p').append('enter survey ID !');
  }
  else {
    $.ajax({
      url: 'act/rumah_cari-id.php?id=' + idrumah,
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
  }
}

function carikons_rumah() { 
  var jenis_k = document.getElementById("jeniskons_rumah").value;
  console.log("cari rumah dengan jenis konstruksi: " + jenis_k);
  $.ajax({
    url: 'act/rumah_cari-jeniskonstruksi.php?k=' + jenis_k,
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
}

function caritahun_rumah() { 
  var awal = document.getElementById("rumah_awaltahun").value;
  var akhir = document.getElementById("rumah_akhirtahun").value;
  console.log("cari rumah dengan tahun berdiri: " + awal + " - " +akhir);
  $.ajax({
    url: 'act/rumah_cari-tahun.php?awal=' + awal + '&akhir=' + akhir,
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
}

function carilistrik_rumah() { 
  var awal = document.getElementById("rumah_awallistrik").value;
  var akhir = document.getElementById("rumah_akhirlistrik").value;
  console.log("cari listrik dengan kapsitas: " + awal + " - " +akhir);
  $.ajax({
    url: 'act/rumah_cari-listrik.php?awal=' + awal + '&akhir=' + akhir,
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
}

function cari_pemilik() { 
  var pemilik = document.getElementById("pemilik").value;
  if (pemilik==null || pemilik=="") {
    $('#ket-p').empty();
    $('#peringatan').modal('show');
    $('#ket-p').append('enter owner name !');
  }
  else {
    $.ajax({
      url: 'act/rumah_cari-pemilik.php?nama=' + pemilik,
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
  }
}

function cari_nikpemilik() { 
  var nikpemilik = document.getElementById("nikpemilik").value;
  if (nikpemilik==null || nikpemilik=="") {
    $('#ket-p').empty();
    $('#peringatan').modal('show');
    $('#ket-p').append('enter National ID Number of owner !');
  }
  else {
    $.ajax({
      url: 'act/rumah_cari-nikpemilik.php?nik=' + nikpemilik,
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
  }
}

function cari_penghuni() { 
  var penghuni = document.getElementById("penghuni").value;
  if (penghuni==null || penghuni=="") {
    $('#ket-p').empty();
    $('#peringatan').modal('show');
    $('#ket-p').append('enter householder name !');
  }
  else {
    $.ajax({
      url: 'act/rumah_cari-penghuni.php?nama=' + penghuni,
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
  }
}

function cari_nikpenghuni() { 
  var nikpenghuni = document.getElementById("nikpenghuni").value;
  if (nikpenghuni==null || nikpenghuni=="") {
    $('#ket-p').empty();
    $('#peringatan').modal('show');
    $('#ket-p').append('enter National ID Number of householder !');
  }
  else {
    $.ajax({
      url: 'act/rumah_cari-nikpenghuni.php?nik=' + nikpenghuni,
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
  }
}

function cari_kk() { 
  var kk = document.getElementById("kk").value;
  if (kk==null || kk=="") {
    $('#ket-p').empty();
    $('#peringatan').modal('show');
    $('#ket-p').append('enter family card number !');
  }
  else {
    $.ajax({
      url: 'act/rumah_cari-kkpenghuni.php?kk=' + kk,
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
  }
}

// function cari_datuk() { 
//   var datuk = document.getElementById("datuk").value;
//   console.log("cari rumah id datuk: " + datuk);
//     $.ajax({
//       url: 'act/rumah_cari-datuk.php?datuk=' + datuk,
//       data: "",
//       dataType: 'json',
//       success: function (rows) {
//         cari_rumah(rows);
//       },
//       error: function (xhr, ajaxOptions, thrownError) {
//         $('#gagal').modal('show');
//         $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
//         $('#notifikasi').append(thrownError);
//       }
//     });
// }

function cari_suku() { 
  var suku = document.getElementById("suku").value;
    $.ajax({
      url: 'act/rumah_cari-suku.php?suku=' + suku,
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
}

// function cari_pendapatan() { 
//   var awal = document.getElementById("penghasilan1").value;
//   var akhir = document.getElementById("penghasilan2").value;
//   console.log("cari pendapatan keluarga dg: " + awal + " - " +akhir);
//   $.ajax({
//     url: 'act/rumah_cari-pendapatan.php?awal=' + awal + '&akhir=' + akhir,
//     data: "",
//     dataType: 'json',
//     success: function (rows) {
//       cari_rumah(rows);
//     },
//     error: function (xhr, ajaxOptions, thrownError) {
//       $('#gagal').modal('show');
//       $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
//       $('#notifikasi').append(thrownError);
//     }
//   });
// }

// function cari_kampung() { 
//   var kampung = document.getElementById("kampung").value;
//     $.ajax({
//       url: 'act/rumah_cari-kampung.php?kampung=' + kampung,
//       data: "",
//       dataType: 'json',
//       success: function (rows) {
//         cari_rumah(rows);
//       },
//       error: function (xhr, ajaxOptions, thrownError) {
//         $('#gagal').modal('show');
//         $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
//         $('#notifikasi').append(thrownError);
//       }
//     });
// }

// function cari_pendkk() { 
//   var pendkk = document.getElementById("pendkk").value;
//     $.ajax({
//       url: 'act/rumah_cari-pendkk.php?pendkk=' + pendkk,
//       data: "",
//       dataType: 'json',
//       success: function (rows) {
//         cari_rumah(rows);
//       },
//       error: function (xhr, ajaxOptions, thrownError) {
//         $('#gagal').modal('show');
//         $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
//         $('#notifikasi').append(thrownError);
//       }
//     });
// }
