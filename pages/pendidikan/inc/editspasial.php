<script src="../inc/mapupd.js" type="text/javascript"></script>
<style type="text/css">
    .readonly {
        background-color: #eee;
        cursor: col-resize;
    }
</style>

<a style="float: right; padding-right: 1%; padding-bottom: 6%; ">
<button type="button" class="btn btn-info btn-sm btn-flat btn-lg mt-3" data-toggle="modal" data-target="#editlokasi"><i class="fa fa-edit"></i> Edit</button>
</a>
            <!-- Modal -->
<div class="modal fade bd-example-modal-lg modal-xl" id="editlokasi">
    <div class="modal-dialog modal-lg modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Edit Spasial Data / Location : <?php echo $nama." (".$id.")" ?></h6>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form method="post" action="act/info-editspasial.php">
                <div class="modal-body" style="font-size: 110%">
                    <!-- menampilkan peta-->
                    <div class="row">
                        <div class="col-lg-8">
                            <header class="panel-heading">
                                <h3>
                                <div class="row">
                                 <div class="col-lg-8">                    
                                  <input id="latlng" type="text" class="form-control" value="" placeholder="Latitude, Longitude"> <p/>
                                 </div>
                                 <div class="col-lg-4">
                                  <button class="btn btn-default my-btn" id="btnlatlng" type="button" title="Geocode"><i class="fa fa-search"></i></button>
                                  <button class="btn btn-default my-btn" type="button" title="Hapus Marker" onclick="hapusmarkerdankoor()"><i class="fa fa-ban"></i></button>
                                  <button class="btn btn-default my-btn" id="delete-button" type="button" title="Remove shape"><i class="fa fa-trash"></i></button> 
                                 </div>
                                </h3>
                                </header>
                              <div class="panel-body">
                                  <div id="map" style="width:100%;height:420px;"></div>
                              </div>
                        </div>
                        <div class="col-lg-4">
                            <input type="hidden" class="form-control" name="id-bang" value="<?php echo $id ?>">
                            <br/><br/><br/>
                            <label for="geom"><span style="color:red">*</span> Coordinat</label>
                            <textarea class="form-control readonly" id="geom" name="geom" required style="height: 50%"><?php echo $geom; ?></textarea>  
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(".readonly").on('keydown paste', function(e){
        e.preventDefault();
    });
    
    $("#geom").on( 'click', function () {
        reset();
        alertify.alert('<img src="../../inc/poligon.gif" width="150px"><br/>please draw the area with polygon on the map');
        return false;
    });
</script>