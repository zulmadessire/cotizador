jQuery(document).ready(function(jQuery) {
    var cotizacionObj = {
        init: function () {
            jQuery('.add-producto').on('click', function(event) {
                event.preventDefault();
                var id = jQuery(this).data('id');
                var codigo = jQuery(this).data('codigo');
                var nombre = jQuery(this).data('nombre');
                var descripcion = jQuery(this).data('descripcion');
                var cantidad = jQuery('#cant-'+id).val();
                var precio = jQuery('#precio-'+id).val();
                var total = 0;
                var total_input = Number( jQuery('#total').html() );

                if ( cantidad != 0 && cantidad != '' ) {
                    total = cantidad * precio;

                    jQuery('#productos').append('<tr>'+ 
                                                    '<td>#</td>'+
                                                    '<td>'+codigo+'<input type="text" name="producto[]" value="'+id+'" hidden></td>'+
                                                    '<td>'+nombre+'</td>'+
                                                    '<td>'+descripcion+'</td>'+
                                                    '<td>'+cantidad+'<input type="text" name="cant[]" value="'+cantidad+'" hidden></td>'+
                                                    '<td>$'+precio+'<input type="text" name="precio[]" value="'+precio+'" hidden></td>'+
                                                    '<td>$'+total+'</td>'+
                                                '</tr>');
                    jQuery('#total').html(total + total_input);
                    jQuery('#productos-modal > tr#producto-'+id).hide();
                }

            });

        },
    }

    cotizacionObj.init();
});