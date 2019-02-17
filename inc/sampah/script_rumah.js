function tampilsemuarumah(){ //menampilkan semua rumah
  $.ajax({ url: 'act/rumahcari.php', data: "", dataType: 'json', success: function (rows){
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
	     alert('Rumah Not found');
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
		        $('#hasilcari').append("<tr><td>"+id+"</td><td style='text-align: center'><button class='btn btn-theme04 btn-xs' onclick='detailrumah(\""+id+"\");' title='tampilkan info'><i class='fa fa-search-plus'></i></button></td></tr>");
            a=a+1;
	    }
      $('#found').append("Found: "+a)
      $('#hidecari').show();
}





function teksradius()
  {
    document.getElementById('km').innerHTML=document.getElementById('inputradius').value*100
  }

  function detailrumah(id1){
   hapusInfo();
      clearroute2();
      hapusMarkerTerdekat();

      console.log('memanggil info dari tombol i '+id1);
      $.ajax({ 
      url: 'act/rumahdetail.php?cari='+id1, data: "", dataType: 'json', success: function(rows)
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
              icon:'assets/ico/home.png',
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
      //FASILITASNYA
          // var isi="<br><b style='margin-left:20px'>Facility</b> <br><ol>";
          // for (var i in rows.fasilitas){ 
          //   var row = rows.fasilitas[i];
          //   var id_fas = row.id_fas;
          //   var name = row.name;
          //   console.log(name);
          //   isi = isi+"<li>"+name+"</li>";
          // }//end for
          // isi = isi + "</ol>";
          // $('#info').append(isi);
      
      //KEGIATAN MASJID
          // var isi="<b style='margin-left:20px'>Event</b> <br><ol>";
          // for (var i in rows.keg){ 
          //   var row = rows.keg[i];
          //   var event_name = row.event_name;
          //   var date = row.date;
          //   var time = row.time;
          //   console.log(event_name);
          //   isi = isi+"<li><b>Event Name</b><b>:</b> &nbsp "+event_name+"<br><b>Date</b><b>:</b> &nbsp"+date+"<br><b>Time</b><b>:</b> &nbsp"+time+"</li>";
          // }//end for
          // isi = isi + "</ol>";
          // $('#info').append(isi);
      
           
            
          }  
           

        }
      }); 
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
        url: 'act/rumahradius.php?lat='+pos.lat+'&lng='+pos.lng+'&rad='+rad, data: "", dataType: 'json', success: function(rows)
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