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
                var sub_total = 0;
                var total = 0;
                var sub_total_input = Number( jQuery('#sub-total').html() );
                var total_input = Number( jQuery('#total').html() );
                var max = Number(jQuery('#cant-'+id).attr('max'));
                var iva = Number(jQuery('#cotizacion-iva').val());
                var descuento = Number(jQuery('#cotizacion-descuento').val());
                var total_iva = 0;
                var total_descuento = 0;

                console.log("iva: "+iva+" descuento: "+descuento);


                if ( cantidad > max ) {
                	jQuery('#cant-'+id).parent().addClass('has-error');
                } else{

	                if ( cantidad != 0 && cantidad != '' ) {
	                    total_producto = cantidad * precio;

	                    jQuery('#productos').append('<tr id="'+id+'">'+ 
	                                                    '<td>#</td>'+
	                                                    '<td>'+codigo+'<input type="text" name="producto[]" value="'+id+'" hidden></td>'+
	                                                    '<td>'+nombre+'</td>'+
	                                                    '<td>'+descripcion+'</td>'+
	                                                    '<td>'+cantidad+'<input type="text" name="cant[]" value="'+cantidad+'" hidden></td>'+
	                                                    '<td>$'+precio+'<input type="text" name="precio[]" value="'+precio+'" hidden></td>'+
	                                                    '<td>$<span id="total-producto-'+id+'">'+total_producto+'</span></td>'+
	                                                    '<td><a class="delete" data-id="'+id+'" href="#"><span class="glyphicon glyphicon-trash"></span></a></td>'+
	                                                '</tr>');
	                    //Sub-Total
	                    sub_total = total_producto + sub_total_input;
	                    jQuery('#sub-total').html( sub_total.toFixed(2) );
	                    //Descuento
	                    total_descuento = ( (sub_total) * descuento ) / 100
        				jQuery('#total-descuento').html( total_descuento.toFixed(2) );
	                    //IVA
	                    total_iva = ( (sub_total) * iva) / 100;
	                    jQuery('#total-iva').html( total_iva.toFixed(2) );
	                    //Total
	                    total = sub_total + total_iva;
	                    jQuery('#total').html( total.toFixed(2) );

	                    jQuery('#productos-modal > tr#producto-'+id).hide();

	                    cotizacionObj.delete();
	                }
	            }
            });

            cotizacionObj.iva();
            cotizacionObj.descuento();
        },

        delete: function(){
        	jQuery('.delete').off().on('click', function(event) {
            	event.preventDefault();
            	var id = jQuery(this).data('id');
            	var sub_total_input = parseFloat( jQuery('#sub-total').html()+"" );
            	var total_producto = parseFloat( jQuery('#total-producto-'+id).html()+"");
            	var sub_total = 0;
            	var total_descuento = 0;
            	var total_iva = 0;
        		var total = 0;
        		var iva = Number(jQuery('#cotizacion-iva').val());
        		var descuento = Number(jQuery('#cotizacion-descuento').val());

            	jQuery('#productos-modal > tr#producto-'+id).show();

            	//Sub-Total
                sub_total = sub_total_input - total_producto;
                jQuery('#sub-total').html( sub_total.toFixed(2) );
                //Descuento
                total_descuento = ( (sub_total) * descuento) / 100;
                jQuery('#total-descuento').html( total_descuento.toFixed(2) );
                //IVA
                total_iva = ( (sub_total) * iva) / 100;
                jQuery('#total-iva').html( total_iva.toFixed(2) );
                //Total
                total = (sub_total - total_descuento ) + total_iva;
                jQuery('#total').html( total.toFixed(2) );

            	jQuery('#'+id).remove();
            });
        },

        iva: function(){
        	jQuery('#cotizacion-iva').on('change', function(event) {
        		event.preventDefault();
        		var total_iva = 0;
        		var total = 0;
        		var iva = jQuery(this).val();
        		var sub_total_input = Number( jQuery('#sub-total').html() );
        		var total_descuento_input = Number( jQuery('#total_descuento').html() );

                //IVA
                total_iva = ( (sub_total_input) * iva) / 100;
                jQuery('#total-iva').html( total_iva.toFixed(2) );
                //Total
                total = (sub_total_input - total_descuento) + total_iva;
                jQuery('#total').html( total.toFixed(2) );

        		jQuery('#iva').html(iva);
        	});
        },

        descuento: function(){
        	jQuery('#cotizacion-descuento').on('change', function(event) {
        		event.preventDefault();
        		var descuento = jQuery(this).val();
        		var iva = Number(jQuery('#cotizacion-iva').val());
        		var sub_total_input = Number( jQuery('#sub-total').html() );
        		var total_iva = 0;
        		var total_descuento = 0;
        		var total = 0;
        		
        		//Descuento
        		total_descuento = ( (sub_total_input) * descuento ) / 100
        		jQuery('#total-descuento').html( total_descuento.toFixed(2) );
                //IVA
                total_iva = ( (sub_total_input) * iva) / 100;
                jQuery('#total-iva').html( total_iva.toFixed(2) );
                //Total
                total = (sub_total_input - total_descuento ) + total_iva;
                jQuery('#total').html( total.toFixed(2) );

        		jQuery('#descuento').html(descuento);
        	});
        },
    }

    cotizacionObj.init();
});