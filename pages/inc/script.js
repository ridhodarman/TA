var abc = 0;      // Declaring and defining global increment variable.
var cek = 0;
$(document).ready(function() {
//  To add new input file field dynamically, on click of "Add More Files" button below function will be executed.
$('#add_more').click(function() {
	if (cek==0) {
		alert("pilih sebuah gambar terlebih dahulu");
	}
	else {
		$(this).before($("<div/>", {
		id: 'filediv'
		}).fadeIn('slow').append($("<input/>", {
		name: 'file[]',
		type: 'file',
		id: 'file'
		}))), $("<br/>");
		cek=0;
	}

});
// Following function will executes on change event of file input to select different file.
$('body').on('change', '#file', function() {
if (this.files && this.files[0]) {
abc += 1; // Incrementing global variable by 1.
var z = abc - 1;
var x = $(this).parent().find('#previewimg' + z).remove();
$(this).before("<a id='abcd" + abc + "' class='abcd'><img id='previewimg" + abc + "' src=''/></a>");
var reader = new FileReader();
reader.onload = imageIsLoaded;
reader.readAsDataURL(this.files[0]);
$(this).hide();
$("#abcd" + abc).append($("<img/>", {
id: 'img',
src: '../inc/x.png',
alt: 'delete'
}).click(function() {
$(this).parent().parent().remove();
}));
cek=1;
}
});
// To Preview Image
function imageIsLoaded(e) {
$('#previewimg' + abc).attr('src', e.target.result);
};
$('#upload').click(function(e) {
var name = $(":file").val();
if (!name) {
alert("First Image Must Be Selected");
e.preventDefault();
}
});
});