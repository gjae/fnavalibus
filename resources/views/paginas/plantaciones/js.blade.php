    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable();

          var totalize = function( parentId, inputPress, inputValue ){
          	var inputs = {
          		cantidad_usada: parentId+'-costo',
          		costo_material: parentId+'-usado'
          	};

          	//alert( inputs[ inputPress.attr('data-util') ] );
          	$("#monto_total-"+parentId).val( (inputValue  * $("."+inputs[ inputPress.attr('data-util') ] ).val() ).toFixed(2) );
          }


          $(".costo_material").on('keyup', function(){
          		var parent_id = $(this).parent().parent().attr('id'); 
          		
          		totalize(parent_id, $(this), $(this).val() );
          });
          $(".cantidad_usada").on('keyup', function(){
          		var parent_id = $(this).parent().parent().attr('id'); 

          		totalize(parent_id, $(this), $(this).val() );
          });
          $("#addData").one('click', function(){
	          	var url = 'http://'+location.host+'/dashboard/plantaciones/nueva_fila';

	          	$.getJSON(url, {}, function(resp){
	          		$("#filas").append(resp.vista);
	          	});
          });

          $(".remove-row").on('click', function(){
          	//alert( $(this).attr('data-row') );
          	$("#fila-"+$(this).attr('data-row')).html('');
          });

        } );

        function eliminar(e, btn){
        	e.preventDefault();
        	var token = $("[name=_token]").val();
        	if( confirm('¿Seguro que desea eliminar este registro?') )
	        	$.post(btn.getAttribute('href'), {_token: token, _method: 'DELETE'}, function(resp){
	        		alert(resp.message);
	        		if( !resp.error )
	        			location.reload();
	        	});
        }
    </script>