jQuery(document).ready(function(jQuery) {
    var cotizacionObj = {
        init: function () {
            jQuery('.add-producto').on('click', function(event) {
                event.preventDefault();
                var id = jQuery(this).data('id');
                var codigo = jQuery(this).data('codigo');
                var nombre = jQuery(this).data('nombre');
                var descripcion = jQuery(this).data('descripcion');
                var cantidad = Number(jQuery('#cant-'+id).val());
                var precio = jQuery('#precio-'+id).val();
                var total = 0;
                var total_input = Number( jQuery('#total').html() );
                var max = Number(jQuery('#cant-'+id).attr('max'));

                if ( cantidad > max ) {
                	jQuery('#cant-'+id).parent().addClass('has-error');
                } else{

	                if ( cantidad != 0 && cantidad != '' ) {
	                    total = cantidad * precio;

	                    jQuery('#productos').append('<tr id="'+id+'">'+ 
	                                                    '<td>#</td>'+
	                                                    '<td>'+codigo+'<input type="text" name="producto[]" value="'+id+'" hidden></td>'+
	                                                    '<td>'+nombre+'</td>'+
	                                                    '<td>'+descripcion+'</td>'+
	                                                    '<td>'+cantidad+'<input type="text" name="cant[]" value="'+cantidad+'" hidden></td>'+
	                                                    '<td>$'+precio+'<input type="text" name="precio[]" value="'+precio+'" hidden></td>'+
	                                                    '<td>$<span id="total-producto-'+id+'">'+total+'</span></td>'+
	                                                    '<td><a class="delete" data-id="'+id+'" href="#"><span class="glyphicon glyphicon-trash"></span></a></td>'+
	                                                '</tr>');
	                    jQuery('#total').html(total + total_input);
	                    jQuery('#productos-modal > tr#producto-'+id).hide();

	                    cotizacionObj.delete();
	                }
	            }

            });
        },

        delete: function(){
        	jQuery('.delete').off().on('click', function(event) {
            	event.preventDefault();
            	var id = jQuery(this).data('id');
            	var total_input = parseFloat( jQuery('#total').html()+"" );
            	var total_producto = parseFloat( jQuery('#total-producto-'+id).html()+"");
            	jQuery('#productos-modal > tr#producto-'+id).show();
            	jQuery('#total').html( (total_input - total_producto).toFixed(2) );
            	jQuery('#'+id).remove();
            });
        },
    }

    cotizacionObj.init();
});