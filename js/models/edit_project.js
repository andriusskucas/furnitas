// edit_project
var save = true;
$( "#target" ).submit(function( event ) {
	
		var progressElem = $('#op');
		var val = $(this).find("input[type=submit]:focus" ).attr('name');
		
			if(val == 'optimize' || val == 'save'){
				var ar = false;
				if(val == 'optimize'){
					ar = true;	
				}
				
		  $.ajax({
			type: 'POST',		
			url:  home_url+'/projektas/atnaujinti/true/'+ar+'/',
			data: $("#target").serialize(),
			
			error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.responseText);
				alert(thrownError);
			},
			
			beforeSend: function () {
				$('#loading_window').find('p').html('Vyksta skaičiavimas.');
				$('#loading_window').show('.2s');
				
				
			},
			complete: function () {
				$("#loading_window").hide('.2s');
			},
			success: function (data) {
				console.log(data);
				var d = JSON.parse(data);
				if (typeof d.error == 'undefined') {
					if(ar){
						$('state').val(5);
					}else{
						$('state').val(4);
					}
					
					
					$('#projecttitle').append('<p style="display:none" class="note">Atnaujinta sėkmingai.</p>');
					$('.note').show('0.5s');
					setTimeout(function(){$('.note').animate({opcity:0, height:1},'0.5s',function(){$(this).remove();});},3000);
					
					if($('#projecttitle').html().indexOf('*') > -1){
						
						$('#projecttitle').html($('#projecttitle').html().replace('*',''));
					}
					
					
					if(!ar){
						enable_count();
						$('#downloadicon').addClass('inactive');
						$('#downloadicon_holder').addClass('inactive');
					}
					if(ar){
						$('#p_all_holder').removeClass('inactive');
						$('#p_all_holder').addClass('tab-title');
						$('#downloadicon').removeClass('inactive').off();
						$('#downloadicon_holder').removeClass('inactive').off();
						
						$('#project_tab').removeClass('active');
						$('#parts_tab').removeClass('active');
						$('#final_tab').addClass('active');
						
						
						$('#p_info_holder').removeClass('active');
						$('#p_parts_holder').removeClass('active');
						$('#p_all_holder').addClass('active');
						
					}
					
					
					var j = 0;
					var parts = d.parts;
					
					if(parts.length > 0){
						console.log($('tr').length+'           asd');
						$('tr').each(function(a, obj) {
							for(var i = 0; i<parts.length; i++){
								
								if(parseInt($(obj).find('.part_num').val()) == parseInt(parts[i].NUM)){
									console.log(parts[i].ID);
									$(obj).find('.part_id').val(parts[i].ID);
									
									var urll = $(obj).find('.del_part');
									if($(urll).attr('href') == '#'){
										$(urll).attr('href',home_url+'/projektas/trinti_detale/'+parts[i].ID+'/'+d.pID+'/');
										$(urll).attr('onClick','deleteLine1(this); return false;');
									}
								}
							}
							
							
								
							
							//console.log($(obj).find('.part_num').val());
						});
					}
					save = true;
				}else{
					$('#projecttitle').append('<p id="'+$(this).attr('name')+'" class="error">Išsaugoti nepavyko.</p>');
				}
				
			}
		  
			});
			event.preventDefault();
			}
		
	  
	});
	
	$('input').change(function(){
		save = false;
		if($(this).attr('name') == 'w'){
			var block = $(this);
			var em = false;
			$('.pw').each(function(i, obj) {
				
				if(parseInt($(obj).val())>parseInt($(block).val())){
					em = true;
					$(obj).addClass('error');
				}else{
					$(obj).removeClass('error');
				}
			});
			
			if(em){
				$(block).addClass('error');
				if($($(this).attr('name')+'12').length<1){
					$('#projecttitle').append('<p id="'+$(this).attr('name')+'12" class="error">Yra didesniu detaliu</p>');
				}
				disable_count();
			}else{
				$('#'+$(this).attr('name')+'12').remove();
				enable_count();
			}
		}
		if($(this).attr('name') == 'h'){
			var block = $(this);
			var em = false;
			$('.ph').each(function(i, obj) {
				
				if(parseInt($(obj).val())>parseInt($(block).val())){
					console.log('error');
					$(obj).addClass('error');
					em = true;
					
					
				}else{
					$(obj).removeClass('error');
				}
			});
			
			if(em){
				$(block).addClass('error');
				if($($(this).attr('name')+'12').length<1){
					$('#projecttitle').append('<p id="'+$(this).attr('name')+'12" class="error">Yra didesniu detaliu</p>');
				}
				
				disable_count();
			}else{
				$('#'+$(this).attr('name')+'12').remove();
				enable_count();
			}
		}
		
	});
	
	
	