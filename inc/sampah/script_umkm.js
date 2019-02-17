function tampilsemuaumkm(){ //menampilkan semua umkm
  $.ajax({ url: 'act/umkm_cari.php', data: "", dataType: 'json', success: function (rows){
    cari_umkm(rows);
  }});

}

function cari_umkm(rows)
{   
  hapusInfo();
  hapusRadius();
  clearroute2();
  hapusMarkerTerdekat();
  $('#hasilcari').empty();
  if(rows==null)
    {
       alert('Small Industry Not found');
      }
  var a=0;
  for (var i in rows) 
      {   
      var row     = rows[i];
        var id   = row.id;
        var name   = row.name;
        var latitude  = row.latitude ;
        var longitude = row.longitude ;
        centerBaru = new google.maps.LatLng(latitude, longitude);
        marker = new google.maps.Marker
            ({
              position: centerBaru,
              icon:'assets/ico/retail-stores.png',
              map: map,
              animation: google.maps.Animation.DROP,
            });
            markersDua.push(marker);
            map.setCenter(centerBaru);
        klikInfoWindowumkm(id);
            map.setZoom(14);            
            tampilkanhasilcari();
            $('#hasilcari').append("<tr><td>"+name+"</td><td style='text-align: center'><button class='btn btn-theme04 btn-xs' onclick='detailumkm(\""+id+"\");' title='tampilkan info'><i class='fa fa-search-plus'></i></button></td></tr>");
            a=a+1;
      }
      $('#found').append("Found: "+a)
      $('#hidecari').show();
}

function carinamaumkm(){ //menampilkan umkm berdasarkan nama
  var namaumkm = document.getElementById("namaumkm").value;
  alert('cari nama....')
  console.log("memanggil fungsi pencarian umkm berdasarkan nama: "+namaumkm);
  $.ajax({ url: 'act/umkm_carinama.php?cari_nama='+namaumkm, data: "", dataType: 'json', success: function (rows){
    cari_umkm(rows);
  }});

}


function klikInfoWindowumkm(id)
{
    google.maps.event.addListener(marker, "click", function(){
        detailumkm_infow(id);
        console.log("marker dengan id="+id+" diklik");
      });

}

function detailumkm_infow(id){  //menampilkan informas
  hapusInfo();
  clearroute2();
  console.log("fungsi info marker id="+id);
    $.ajax({url: 'act/umkm_detail.php?cari='+id, data: "", dataType: 'json', success: function(rows)
      {
         for (var i in rows) 
          { 
            var row = rows[i];
            var id = row.id;
            var nama = row.name;
            var image = row.image;
            var latitude  = row.latitude; 
            var longitude = row.longitude ;
            console.log(image);
            centerBaru = new google.maps.LatLng(row.latitude, row.longitude);
            marker = new google.maps.Marker
            ({
              position: centerBaru,
              icon:'assets/ico/retail-stores.png',
              map: map,
              animation: google.maps.Animation.DROP,
            });
            markersDua.push(marker);
            map.setCenter(centerBaru);
            klikInfoWindowumkm(id);
            map.setZoom(18); 
            infowindow = new google.maps.InfoWindow({
            position: centerBaru,
            content: "<span style=color:black><center><b>Information</b><br><img src='"+fotosrc+image+"' alt='image in infowindow' width='150'></center><br><i class='fa fa-home'></i> "+nama+"<br><br><a role='button' title='tracking' class='btn btn-default fa fa-car' value='Route' onclick='callRoute(centerLokasi, centerBaru);rutetampil();'></a>&nbsp<a role='button' title='gallery' class='btn btn-default fa fa-picture-o' value='Gallery' onclick='galeri(\""+id+"\")'></a></span>",
            pixelOffset: new google.maps.Size(0, -33)
            });
            infoDua.push(infowindow); 
            hapusInfo();
            infowindow.open(map);
          }  
        }
      }); 
}

function detailumkm(id1){
   hapusInfo();
      clearroute2();
      hapusMarkerTerdekat();

      console.log('memanggil info dari tombol i '+id1);
      $.ajax({ 
      url: 'act/umkm_detail.php?cari='+id1, data: "", dataType: 'json', success: function(rows)
        { 
         for (var i in rows) 
          { 
            var row = rows[i];
            var id = row.id;
            var nama = row.name;
            var image = row.image;
            var latitude  = row.latitude; 
            var longitude = row.longitude ;
            centerBaru = new google.maps.LatLng(row.latitude, row.longitude);
            marker = new google.maps.Marker
            ({
              position: centerBaru,
              icon:'assets/ico/retail-stores.png',
              map: map,
              animation: google.maps.Animation.DROP,
            });
            markersDua.push(marker);
            map.setCenter(centerBaru);
            map.setZoom(18); 
       infowindow = new google.maps.InfoWindow({
            position: centerBaru,
            content: "<span style=color:black><center><b>Information</b><br><img src='"+fotosrc+image+"' alt='image in infowindow' width='150'></center><br><i class='fa fa-home'></i> "+nama+"<br><a role='button' title='tracking' class='btn btn-default fa fa-car' value='Route' onclick='callRoute(centerLokasi, centerBaru);rutetampil();'></a>&nbsp<a role='button' title='gallery' class='btn btn-default fa fa-info-circle' value='Gallery' target='_blank' href='detailrumah.php?id="+id+"'> View Detail</a></span>",
            pixelOffset: new google.maps.Size(0, -33)
            });
          infoDua.push(infowindow); 
          hapusInfo();
          infowindow.open(map); 
            
          }  
           
        }
      }); 
}


function aktifkanRadiusumkm(){ //fungsi radius umkm
    if (pos == 'null'){
    alert ('Click button current position or manual position first !');
    }
    else {
    hapusRadius();
    clearroute2();
    var inputradiusumkm=document.getElementById("inputradiusumkm").value;
    var circle = new google.maps.Circle({
      center: pos,
      radius: parseFloat(inputradiusumkm*100),      
      map: map,
      strokeColor: "blue",
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: "blue",
      fillOpacity: 0.35
      });        
      map.setZoom(14);       
      map.setCenter(pos);
      circles.push(circle);   
      teksradiusumkm()  
    }   
    cekRadiusStatus = 'on';
    tampilkanradiusumkm();
}

function teksradiusumkm()
  {
    document.getElementById('km_umkm').innerHTML=document.getElementById('inputradiusumkm').value*100
  }

function cekRadiusumkm()
  {
    radiusumkm = inputradiusumkm.value*100;
    lat=document.getElementById("lat").value;
    lng=document.getElementById("lng").value;
    }

function tampilkanradiusumkm(){ //menampilkan umkm berdasarkan radius
    $('#hasilcari1').show();
    $('#hasilcari').empty();
    $('#found').empty();
      hapusInfo();
      hapusMarkerTerdekat();
      cekRadiusumkm();
      clearroute2();
      console.log("panggil radiusnyaa, umkm sekitar dengan koordinat:"+lat+","+lng+" dan radius="+radiusumkm);

        $.ajax({ 
        url: 'act/umkm_radius.php?lat='+pos.lat+'&lng='+pos.lng+'&rad='+radiusumkm, data: "", dataType: 'json', success: function(rows)
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
              icon:'assets/ico/retail-stores.png',
              map: map,
              animation: google.maps.Animation.DROP,
            });
              markersDua.push(marker);
              map.setCenter(centerBaru);
        klikInfoWindowumkm(id);
              map.setZoom(14);
              tampilkanhasilcari();
              $('#hasilcari').append("<tr><td>"+nama+"</td><td style='text-align: center'><button class='btn btn-theme04 btn-xs' onclick='detailumkm(\""+id+"\");' title='tampilkan info'><i class='fa fa-search-plus'></i></button></td></tr>");
            } 
            }    
          });
}

function detailrumah_infow(id){  //menampilkan informasi rumah
  hapusInfo();
  clearroute2();
  console.log("fungsi info marker id="+id);
    $.ajax({url: 'act/detailrumah.php?cari='+id, data: "", dataType: 'json', success: function(rows)
      {
         for (var i in rows) 
          { 
            var row = rows[i];
            var id = row.id;
            var nama = row.name;
            var image = row.image;
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
            content: "<span style=color:black><center><b>Information</b><br><img src='"+fotosrc+image+"' alt='image in infowindow' width='150'></center><br><i class='fa fa-home'></i> "+nama+"<br><br><a role='button' title='tracking' class='btn btn-default fa fa-car' value='Route' onclick='callRoute(centerLokasi, centerBaru);rutetampil();'></a>&nbsp<a role='button' title='gallery' class='btn btn-default fa fa-picture-o' value='Gallery' onclick='galeri(\""+id+"\")'></a></span>",
            pixelOffset: new google.maps.Size(0, -33)
            });
            infoDua.push(infowindow); 
            hapusInfo();
            infowindow.open(map);
          }  
        }
      }); 
}

function klikInfoWindow(id)
{
    google.maps.event.addListener(marker, "click", function(){
        detailrumah_infow(id);
        console.log("marker dengan id="+id+" diklik");
      });

}

function cekRadius()
  {
    radiusumkm = inputradius.value*100;
    }