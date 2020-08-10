$(document).ready(function() {

    $('select[name="estado_id"]').on('change', function(){
        var estado_id = $(this).val();
        if(estado_id) {
            $.ajax({
                url: '/cidades/get/'+estado_id,
                type:"GET",
                dataType:"json",
                beforeSend: function(){
                    $('#loader').css("visibility", "visible");
                },

                success:function(data) {

                    $('select[name="cidade_id"]').empty();

                    $.each(data, function(key, value){

                        $('select[name="cidade_id"]').append('<option value="'+ key +'">' + value + '</option>');

                    });
                },
                complete: function(){
                    $('#loader').css("visibility", "hidden");
                }
            });
        } else {
            $('select[name="cidade_id"]').empty();
        }

    });

});