<a style="float: right; padding-right: 1%; padding-bottom: 6%; ">
<button type="button" class="btn btn-info btn-sm btn-flat btn-lg mt-3" data-toggle="modal" data-target="#editpemilik"><i class="fa fa-edit"></i> Edit</button>
</a>
            <!-- Modal -->
<div class="modal fade" id="editpemilik">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h6 class="modal-title">Edit Owner</h6>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body" style="font-size: 110%">
                    National ID Number: <input class="form-control" type="text" name="" value="<?php echo $nik ?>">
                    Family Card Number: <input class="form-control" type="text" name="" value="<?php echo $nokk ?>">
                    Name: <input class="form-control" type="text" name="" value="<?php echo $nama ?>">
                    Birth Date: <input class="form-control" type="date" name="" value="<?php echo $tgl ?>">
                    Education Level: <input class="form-control" type="text" name="">
                    Job: <input class="form-control" type="text" name="">
                    Income:
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Rp</div>
                            </div>
                            <input type="text" class="form-control" id="penghasilan" value="<?php echo $pendapatan ?>" onkeyup="ceknominal()">
                        </div>
                    Take Insurance: <input class="form-control" type="text" name="">
                    Savings: <input class="form-control" type="text" name="">
                    Datuk: <input class="form-control" type="text" name="">
                    Tribe: <input class="form-control" type="text" name="">
                    Village: <input class="form-control" type="text" name="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
function ceknominal() {
    var rupiah = document.getElementById('penghasilan');
    rupiah.value = formatRupiah(rupiah.value, '');
}

function formatRupiah(angka, prefix){
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split           = number_string.split(','),
    sisa            = split[0].length % 3,
    rupiah          = split[0].substr(0, sisa),
    ribuan          = split[0].substr(sisa).match(/\d{3}/gi);
 
    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }
 
    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
}
</script>