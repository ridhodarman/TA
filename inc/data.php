<?php

include('koneksi.php');

$sql  = "SELECT  
			ST_AsGeoJSON(geom) AS geometry,
			id,
			name
		FROM house
		";
		$geojson = array(
			'type'      => 'FeatureCollection',
			'features'  => array()
		);
		$query = pg_query($sql);
		if(pg_num_rows($query)==0) return 0;
		while($rows=pg_fetch_assoc($query)){
			$feature = array(
				"type" => 'Feature',
				'geometry' => json_decode($rows['geometry'], true),
				'jenis' => "rumah",
				'properties' => array(
					'id' => $rows['id'],
					'nama' => $rows['name']
				)
			);
			array_push($geojson['features'], $feature);
		}


$sql2  = "SELECT  
			ST_AsGeoJSON(geom) AS geometry,
			id,
			name
		FROM small_industry
		";
		$query2 = pg_query($sql2);
		if(pg_num_rows($query)==0) return 0;
		while($rows=pg_fetch_assoc($query2)){
			$feature2 = array(
				"type" => 'Feature',
				'geometry' => json_decode($rows['geometry'], true),
				'jenis' => "umkm",
				'properties' => array(
					'id' => $rows['id'],
					'nama' => $rows['name']
				)
			);
			array_push($geojson['features'], $feature2);
		}


		echo json_encode($geojson);