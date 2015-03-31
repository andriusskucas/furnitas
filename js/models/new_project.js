// new_project

$('#mat_name').keyup(function() {
	
	  var block = $(this);
	  $.getJSON( ajax_url+'get_mat/'+$(this).val(), function( data ) {
	  
	  if($('#mat_sug').length>0){
		$('#mat_sug').remove();	  
	  }
	  block.css('z-index','9999');
	  
	  var items = [];
	  $.each( data, function( key, val ) {
		items.push( "<li onClick='sel_itt(this)' class='mat_su_it' id='" + key + "'><span class='matNAME'>" + val.NAME + "</span><span class='matW'>"+ val.W + "</span> x <span class='matH'>"+ val.H + "</span></li>" );
	  });
	 
	  $( "<ul/>", {
		"class": "sugestion_list must_hide",
		"id":"mat_sug",
		html: items.join( "" )
	  }).appendTo( "#mat_name_holder" );
	  
	 
	});
	
});
$('#mat_name').click(
	function() {
		
		  var block = $(this);
		  $.getJSON( ajax_url+'get_mat/'+$(this).val(), function( data ) {
		  
		  if($('#mat_sug').length>0){
			$('#mat_sug').remove();	  
		  }
		  block.css('z-index','9999');
		  
		  var items = [];
		  $.each( data, function( key, val ) {
			items.push( "<li onClick='sel_itt(this)' class='mat_su_it' id='" + key + "'><span class='matNAME'>" + val.NAME + "</span><span class='matW'>"+ val.W + "</span> x <span class='matH'>"+ val.H + "</span></li>" );
		  });
		 
		  $( "<ul/>", {
			"class": "sugestion_list must_hide",
			"id":"mat_sug",
			html: items.join( "" )
		  }).appendTo( "#mat_name_holder" );
		  
		 
		});
	}
);



$('input').click(function(){
	$(this).select();
});
$('input').change(function(){
	if($('#projecttitle').html().indexOf('*') < 0){
		$('state').val(2);
		$('#projecttitle').html($('#projecttitle').html()+'*');
	}
	
	$('#p_all_holder').addClass('inactive');
	$('#p_all_holder').removeClass('tab-title');
	$('#downloadicon').addClass('inactive');
	$('#downloadicon_holder').addClass('inactive');
	$('state').val(3);
	
});


	function  sel_itt(block){
		
		var name = $(block).children('.matNAME').html();
		var matW = $(block).children('.matW').html();
		var matH = $(block).children('.matH').html();
		
		$('#mat_h').val(matH);
		$('#mat_w').val(matW);
		$('#mat_name').val(name);
		$('#mat_sug').hide();
	}
	
	
	
	
	$('#project_tab').on('change','input',function(){
		
		if($(this).attr('required') && $(this).val() == ''){
			$(this).addClass('error');
			$('#projecttitle').append('<p style="display:none" id="'+$(this).attr('name').replace('[','').replace(']','')+'1" class="error">Užpildykite laukelį</p>');
			$('#'+$(this).attr('name').replace('[','-').replace(']','-')+'1').show('.2s');
		}else{
			$(this).removeClass('error');
			$('#'+$(this).attr('name')+'1').remove();
		}
	});
	
	

	