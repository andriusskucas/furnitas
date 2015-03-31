// parts.js

var lines = $('#parts_table tr').length-1;
if(lines<2){
					disable_count();
				}else{
					enable_count();
				}
var number = lines;
$('#parts_table').on('change', 'input', function(){
	save = false;
	if($(this).parent().parent().find('.eilnr').html()-lines == 0){
		
		$('#parts_table').append('<tr><td><span class="eilnr">'+(lines+1)+'</span><input class="part_id" name="parts['+number+'][ID]" type="hidden" value=""><input class="part_num" name="parts['+number+'][NUM]" type="hidden" value="'+(lines+1)+'"></td><td><input name="parts['+number+'][W]" type="number" value="" size="6" min="1"></td><td><input name="parts['+number+'][H]" type="number" value="" size="6" min="1"></td><td><input name="parts['+number+'][Q]" type="number" value="1" size="2" min="1"></td><td><input name="parts['+number+'][SIDES1]" type="number" value="0" min="0" max="2"></td><td><input name="parts['+number+'][SIDES2]" type="number" value="0" min="0" max="2"></td><td><input name="parts['+number+'][COMM]" type="text"></td><td class="dell"></td></tr>');
		number++;
		lines = $('#parts_table tr').length-1;
	}
	
	if($(this).parent().parent().find('.dell').html() == ''){
		$(this).parent().parent().find('.dell').append('<a onClick="deleteLine(this); return false;" class="del_part button" href="#" data-num="'+$(this).parent().parent().find('.eilnr').html()+'">x</a>');
	}
	
	$('state').val(3);
	
	$('#downloadicon').addClass('inactive').on('click',function(){
			
			return false;
		});
	$('#downloadicon_holder').addClass('inactive').on('click',function(){
			
			return false;
		});
	
	var pagew = $('#mat_w').val();
	var pageh = $('#mat_h').val();
	var sides = $('#sides').val();	
	pagew -= 2*sides;
	pageh -= 2*sides;
	
	if($(this).hasClass('pw')){
		
		if(parseInt($(this).val())>pagew){
			
			$(this).addClass('error');
			$('#projecttitle').append('<p id="'+$(this).attr('name').replace('[','').replace(']','').replace('[','').replace(']','')+'123" class="error">Detales plotis didesnis negu lapo.</p>');
			disable_count();
		}else if($(this).hasClass('error')){
			$(this).removeClass('error');
			$('#'+$(this).attr('name').replace('[','').replace(']','').replace('[','').replace(']','')+'123').remove();
			enable_count();
		}
	}
	
	if($(this).hasClass('ph')){
		
		if(parseInt($(this).val())>pageh){
			$(this).addClass('error');
			$('#projecttitle').append('<p id="'+$(this).attr('name').replace('[','').replace(']','').replace('[','').replace(']','')+'123" class="error">Detales ilgis didesnis negu lapo.</p>');
			disable_count();
		}else if($(this).hasClass('error')){
			$(this).removeClass('error');
			console.log('#'+$(this).attr('name').replace('[','').replace(']','').replace('[','').replace(']','')+'123');
			$('#'+$(this).attr('name').replace('[','').replace(']','').replace('[','').replace(']','')+'123').remove();
			enable_count();
		}
	}
	
	
if(lines<2){
					disable_count();
				}else{
					enable_count();
				}
	
	
});



	
/*******
** Nustatyti ataskaitos lauko auksti
********/
    if(document.getElementById){
		var newheight;
    	var newwidth;
        newheight=$('#displayed_conten').height(); 
		$('#ataskaita').height(newheight);       
    }
	
	
	/********
	**** trinti detale
	********/


$('.del_part').on('click',function(){
	var obj = $(this);
	deleteLine1(obj);
	return false;
}); 
function deleteLine1(obj){
	if (confirm("Ar tikrai norite ištrinti?") == true) {
		if($(obj).attr('href') != '#'){
			$.ajax({
			type: 'GET',		
			url:  $(obj).attr('href')+'true/',
			
			
			error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.responseText);
				alert(thrownError);
			},
			
			beforeSend: function () {
				$(obj).hide('.2s');
				
				
			},
			complete: function () {
				
			},
			success: function (data) {
				deleteLine(obj);
				
			}
		  
			});
		}else{
			deleteLine(obj);
		}
		
			return false;
		} else {
			return false;
		}
}

function deleteLine(obj){
	var num = $(obj).attr('data-num');
				$('tr:eq('+num+')').hide('.3s').remove();
				$('#projecttitle').append('<p style="display:none" class="note">Ištrinta sėkmingai.</p>');
				$('.note').show('0.5s');
				setTimeout(function(){$('.note').animate({opcity:0, height:1},'0.5s',function(){$(this).remove();});},3000);
				
				var num = 0;
				$('tr').each(function(i, obj) {
					$(obj).find('.eilnr').html(num);
					$(obj).find('.part_num').val(num);
					num++;
				});
				
				lines--;
				
				if(lines<2){
					disable_count();
				}else{
					enable_count();
				}
				$('#p_all_holder').addClass('inactive');
				$('#p_all_holder').removeClass('tab-title').removeClass('active');
				
				$('#final_tab').removeClass('active');
				save = false;
				$('#downloadicon').addClass('inactive').on('click',function(){
			
			return false;
		});
	$('#downloadicon_holder').addClass('inactive').on('click',function(){
			
			return false;
		});
}
   

