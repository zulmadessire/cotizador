jQuery(document).ready(function(jQuery) {
    var Obj = {
        init: function () {
            jQuery('.add-producto').on('click', function(event) {
                event.preventDefault();
                var id = jQuery(this).data('id');
                var codigo = jQuery(this).data('codigo');
                var nombre = jQuery(this).data('nombre');
                var cantidad = jQuery('#cant-'+id).val();
                var precio = jQuery(this).data('precio');
                var descuento = jQuery('#descuento-'+id).val();
                var total = 0;

                if ( cantidad != 0 && cantidad != '' ) {
                    if ( descuento != 0 || descuento != "" ){
                        total = (cantidad * precio) - ( ( ( cantidad * precio) * descuento ) / 100 );
                    } else{
                        descuento = 0;
                        total = cantidad * precio;
                    }

                    jQuery('#productos').append('<tr id="paquete-producto-'+id+'">'+ 
                                                    '<td>#</td>'+
                                                    '<td>'+codigo+'<input type="text" name="producto[]" value="'+id+'" hidden></td>'+
                                                    '<td>'+nombre+'</td>'+
                                                    '<td>'+cantidad+'<input type="text" name="cant[]" value="'+cantidad+'" hidden></td>'+
                                                    '<td>$'+precio+'</td>'+
                                                    '<td>'+descuento+'%<input type="text" name="descuento[]" value="'+descuento+'" hidden></td>'+
                                                    '<td>$'+total+'</td>'+
                                                '</tr>');
                    jQuery('#productos-modal > tr#producto-'+id).hide();
                }

            });

        },
    }

    Obj.init();
});