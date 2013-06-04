$(document).ready(function() {
// Update Status
$("#update_button").click(function() {
  var updateval = $("#update").val();
  var id_user_tujuan = $("#id_tujuan").val();
  var dataString = 'update='+ updateval + '&id_user_tujuan=' + id_user_tujuan;
  if(updateval==''){
    alert("Status Harus Di isi");
  }
  else{
    $("#flash").show();
    $("#flash").fadeIn(400).html('Loading Update...');
    $.ajax({
      type: "POST",
      url: "status_ajax.php",
      data: dataString,
      cache: false,
      success: function(html){
        $("#flash").fadeOut('slow');
        $("#status").prepend(html);
        $("#update").val('');	
        $("#update").focus();
     }
    });
  }
  return false;
});

// Hapus Status
$('.stdelete').live("click",function() {
  var ID = $(this).attr("id");
  var dataString = 'id_status='+ ID;

  if(confirm("Apakah Anda yakin akan menghapus Status?")){
    $.ajax({
      type: "POST",
      url: "hapus_status.php",
      data: dataString,
      cache: false,
      success: function(html){
        $("#stbody"+ID).slideUp();
      }
    });
  }
  return false;
});

// Buka toggle Komentar
$('.commentopen').live("click",function(){
  var ID = $(this).attr("id");
  $("#commentbox"+ID).slideToggle('slow');
return false;
});

// Simpan Komentar
$('.comment_button').live("click",function(){
  var ID = $(this).attr("id");

  var komentar= $("#ctextarea"+ID).val();
  var dataString = 'komentar='+ komentar + '&id_status=' + ID;

  if(komentar==''){
    alert("Silahkan isi komentar dulu");
  }
  else{
    $.ajax({
      type: "POST",
      url: "komentar_ajax.php",
      data: dataString,
      cache: false,
      success: function(html){
        $("#commentload"+ID).append(html);
        $("#ctextarea"+ID).val('');
        $("#ctextarea"+ID).focus();
      }
    });
  }
  return false;
});

// Hapus Komentar berdasarkan ID Komentar
$('.stcommentdelete').live("click",function(){
  var ID = $(this).attr("id");
  var dataString = 'id_kom='+ ID;

  if(confirm("Apakah Anda yakin akan menghapus Komentar?")){
    $.ajax({
      type: "POST",
      url: "hapus_komentar_ajax.php",
      data: dataString,
      cache: false,
      success: function(html){
        $("#stcommentbody"+ID).slideUp();
      }
    });
  }
  return false;
});
});
