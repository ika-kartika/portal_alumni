$(document).ready(function() {
    //jika showmore post diklik
    $('.load_more').live("click",function() {
        //buat variabel id_terakhir dari id milik load_more
        var id_terakhir = $(this).attr("id");
        var id_user = $('#id_tujuan').val();
        var nama = $('#namausr').val();
        //Jika id_terakhir tidak sama dengan end
        if(id_terakhir!='end'){//lakukan request ajax
            $.ajax({
                type: "POST",
                url: "pagingal.php", //proses ke file php
                data: "idakhir="+ id_terakhir + '&id_user=' + id_user + '&nama=' + nama,
                beforeSend:  function() {
                    $('a.load_more').append('<img src="facebook_style_loader.gif" />');
                },
                success: function(html){
                    $(".facebook_style").remove(); //hilangkan div dengan class name facebook style
                    $("ol#updates").append(html); //memberikan respon ke ol#updates
                }
            });
        }
        return false;
    });
});
