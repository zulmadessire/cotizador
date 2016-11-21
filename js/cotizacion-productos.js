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
                var precio = Number(jQuery('#precio-'+id).val());
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
	                                                    '<td>$'+precio+'<input type="text" name="precio[]" value="'+precio.toFixed(2)+'" hidden></td>'+
	                                                    '<td>$<span id="total-producto-'+id+'">'+total_producto.toFixed(2)+'</span></td>'+
	                                                    '<td><a class="delete" data-id="'+id+'" data-type="producto" href="#"><span class="glyphicon glyphicon-trash"></span></a></td>'+
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
	                    total = (sub_total - total_descuento ) + total_iva;
	                    jQuery('#total').html( total.toFixed(2) );

	                    jQuery('#productos-modal > tr#producto-'+id).hide();

	                    cotizacionObj.delete();
	                }
	            }
            });

            jQuery('.add-paquete').on('click', function(event) {
                event.preventDefault();
                var id = jQuery(this).data('id');
                var nombre = jQuery(this).data('nombre');
                var precio_total = jQuery(this).data('total');
                var cantidad = Number(jQuery('#paquete-cant-'+id).val());
                
                var sub_total = 0;
                var total = 0;
                var sub_total_input = Number( jQuery('#sub-total').html() );
                var total_input = Number( jQuery('#total').html() );
                var iva = Number(jQuery('#cotizacion-iva').val());
                var descuento = Number(jQuery('#cotizacion-descuento').val());
                var total_iva = 0;
                var total_descuento = 0;


                    if ( cantidad != 0 && cantidad != '' ) {
                        total_producto = cantidad * precio_total;

                        jQuery('#productos').append('<tr id="paq-'+id+'">'+ 
                                                        '<td>#<input type="text" name="paquete[]" value="'+id+'" hidden></td>'+
                                                        '<td></td>'+
                                                        '<td>'+nombre+'</td>'+
                                                        '<td></td>'+
                                                        '<td>'+cantidad+'<input type="text" name="cant_paquete[]" value="'+cantidad+'" hidden></td>'+
                                                        '<td>$'+precio_total+'<input type="text" name="precio_paquete[]" value="'+precio_total+'" hidden></td>'+
                                                        '<td>$<span id="total-producto-'+id+'">'+total_producto+'</span></td>'+
                                                        '<td><a class="delete" data-id="'+id+'" data-type="paquete" href="#"><span class="glyphicon glyphicon-trash"></span></a></td>'+
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
                        total = (sub_total - total_descuento ) + total_iva;
                        jQuery('#total').html( total.toFixed(2) );

                        jQuery('#paquetes-modal > tr#paquete-'+id).hide();

                        cotizacionObj.delete();
                    }
                
            });


            cotizacionObj.iva();
            cotizacionObj.descuento();
        },

        delete: function(){
        	jQuery('.delete').off().on('click', function(event) {
            	event.preventDefault();
                var id = jQuery(this).data('id');
            	var type = jQuery(this).data('type');
            	var sub_total_input = parseFloat( jQuery('#sub-total').html()+"" );
            	var total_producto = parseFloat( jQuery('#total-producto-'+id).html()+"");
            	var sub_total = 0;
            	var total_descuento = 0;
            	var total_iva = 0;
        		var total = 0;
        		var iva = Number(jQuery('#cotizacion-iva').val());
        		var descuento = Number(jQuery('#cotizacion-descuento').val());

                if ( type == 'producto') {
                    jQuery('#productos-modal > tr#producto-'+id).show();
                    jQuery('#'+id).remove();
                } else{
                    jQuery('#paquetes-modal > tr#paquete-'+id).show();
                    jQuery('#paq-'+id).remove();
                }

            	

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