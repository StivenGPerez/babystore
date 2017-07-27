//esta funcion es para dar estilos al select de busquedas
//$(".chosen-select").chosen({disable_search_threshold: 10});
$(".chosen-select").chosen({"disable_search_threshold": 4});
//$(".chosen-select").chosen({disable_search_threshold: 10});
													  
//$(".chosen-select").chosen({width: "95%"}); 
//$(".chosen-select").chosen({allow_single_deselect: true});


//Esta funcion es para el efecto del menu principal
// var activeEl = 0;
// $(function() {
//     var items = $('.btn-nav');
//     $( items[activeEl] ).addClass('active');
//     $( ".btn-nav" ).click(function() {
//         $( items[activeEl] ).removeClass('active');
//         $( this ).addClass('active');
//         activeEl = $( ".btn-nav" ).index( this );
//     });
// });
	
function VolverCartapoder(){
	//if(confirm("Está seguro de volver al menú principal"))
	window.location.href=baseurl+"con_inicio/principal";
}

function Refresh()
{
    location.reload();
}
