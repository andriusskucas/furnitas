$(document).ready(function(){
//save or delete

$('.taskbutton').click(function() {

    window.onbeforeunload = null;

    window.location='yourUrl'; //navigate to required page..

});

window.onbeforeunload = function() {
	if(!save){
              var message = 'Yra neišsaugotų pakeitimų. Ar tikrai nerite išeiti iš puslapio?';
              return message;
          }    
}



}); 


    $(document).on('click', function(e) {
        if (e.target.id == 'mat_name') {
            //alert('Div Clicked !!');
        } else {
            $('.must_hide').hide();
        }

    });
	
	
	
	
	if($('.note').length>0){
		setTimeout(function(){$('.note').animate({opcity:0, height:1},'0.5s',function(){$(this).remove();});},3000);	
	}
	
	$('.inactive').on('click',function(){
		
		return false;
	});
	
	$('.inactive').on('click','a',function(){
		
		return false;
	});
	
	
	$('.delete').on('click',function(){
		if (confirm("Ar tikrai norite ištrinti?") == true) {
			return;
		} else {
			return false;
		}
	});
	
	
	function disable_count(){
		$('#counticon').addClass('inactive').on('click',function(){
			
			return false;
		});
		$('#counticon_holder').addClass('inactive').on('click','a',function(){
			
			return false;
		});
		
	}
	
	function enable_count(){
		if($('.error').length<1){
			$('#counticon').removeClass('inactive').off();
			$('#counticon_holder').removeClass('inactive').off();
		}
		
	}
