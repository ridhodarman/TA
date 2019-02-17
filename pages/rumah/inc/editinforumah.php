<a style="float: right; padding-right: 1%; padding-bottom: 6%; ">
<button type="button" class="btn btn-info btn-sm btn-flat btn-lg mt-3" data-toggle="modal" data-target="#editinfo"><i class="fa fa-edit"></i> Edit</button>
</a>
            <!-- Modal -->
<div class="modal fade" id="editinfo">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Edit Info</h6>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body" style="font-size: 110%">
                <form>
                    ID: <input class="form-control" type="text" name="" value="<?php echo $id ?>">
                    Standing Year: <span id="tahun"></span><input class="form-control" type="text" name="tahun" value="<?php echo $tahun ?>">
                    Land and Building Tax: 
                        <span id="pbb"></span>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Rp</div>
                            </div>
                            <input type="text" class="form-control" name="pbb" value="<?php echo $pbb ?>">
                        </div>
                    Type of Construction: <input class="form-control" type="text" name="">
                    Tap Water: <input class="form-control" type="text" name="">
                    Status: <input class="form-control" type="text" name="">
                    Address: <textarea class="form-control"><?php echo $alamat ?></textarea>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>