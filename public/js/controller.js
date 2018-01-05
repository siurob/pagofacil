$(function(){
	$(document).on('click','#POST',function(){
		$('#json_response').html('');
		$('#showAlumnos').show();
		$('#showMaterias').show();
		$('#showButton').show();
		$('#actionBtn').attr({'value':'Dar de alta','data-method':'POST'});
		$('#helper').show().html('<br><label>Ingresa una calificación</label><br><input type="text" class="form-control" style="max-width:30%;" id="calificacion">')
	});

	$(document).on('click','#GET',function(){
		$('#json_response').html('');
		$('#showAlumnos').show();
		$('#showMaterias').hide();
		$('#showButton').show();
		$('#helper').hide().html('');
		$('#actionBtn').attr({'value':'Revisar calificaciones','data-method':'GET'});
	});

	$(document).on('click','#put',function(){
		$('#json_response').html('');
		$('#showAlumnos').hide();
		$('#showMaterias').hide();
		$('#showButton').hide();
		$('#helper').hide().html('');
		$('#actionBtn').attr({'value':'Actualizar calificaciones','data-method':'put'});
		$.ajax({
			url:'landingPage/loadGrades',
			method:'get',
			success:function(r)
			{
				r = JSON.parse(r);
				var h = "";
				if(r.data.length > 0)
				{
					r.data.forEach(function(t){
						h+='Actualiza la materia <b>'+t.materia+'</b> para el alumno <b>'+t.nombre+'</b><input type="text" class="form-control modCal" style="max-width:100%;" id="'+t.id+'" value="'+t.calificacion+'"><br>';
					});
				}

				else
				{
					h+='<h2 class="text-center">No hay calificaciones activas</h2>';
				}
				$('#helper').show().html(h);
			}
		})
	});

	$(document).on('click','#delete',function(){
		$('#json_response').html('');
		$('#showAlumnos').hide();
		$('#showMaterias').hide();
		$('#showButton').hide();
		$('#helper').hide().html('');
		$('#actionBtn').attr({'value':'Eliminar calificaciones','data-method':'delete'});
		$.ajax({
			url:'landingPage/loadGrades',
			method:'get',
			success:function(r)
			{
				r = JSON.parse(r);
				var h = "";
				if(r.data.length > 0)
				{
					r.data.forEach(function(t){
						h+='<div id="del_'+parseInt(t.id)+'_ok">Elimina el registro con la materia <b>'+t.materia+'</b> para el alumno <b>'+t.nombre+'</b> y la calificación <b>'+t.calificacion+'</b><input type="button" class="btn btn-sm btn-danger delCal" style="max-width:100%;" id="'+t.id+'" value="Eliminar"></div><br>';
					});
				}

				else
				{
					h+='<h2 class="text-center">No hay calificaciones activas</h2>';
				}
				$('#helper').show().html(h);
			}
		})
	});

	$(document).on('keyup','#calificacion',function(){
		var val = parseInt($(this).val())
		if($.trim(val) === "")
			$(this).val('');
		else
		{
			if (!$.isNumeric(val)) 
			{
				$(this).val('');
			}

			else
			{
				if (val < 0 || val > 10) 
				{
					$(this).val('');
				}
			}
		}
	});

	$(document).on('keyup','.modCal',function(){
		var val = parseInt($(this).val());
		if(val !== "")
		{
			if($.isNumeric(val))
			{
				if(val >= 0 && val <=10)
				{
					var id = parseInt($(this).attr('id'));
					$.ajax({
						url:'landingPage/pfput/'+id+'/'+val,
						method:'PUT',
						success:function(r)
						{
							$('#json_response').html('<h3>Respuesta JSON</h3>'+r+'<br><label class="text-success">La calificación fue modificada por: '+val+'</label>');
						}
					});
				}
			}	
		}
	});

	$(document).on('click','.delCal',function(){
		var id = parseInt($(this).attr('id'));
		$.ajax({
			url:'landingPage/pfdelete/'+id,
			method:'DELETE',
			success:function(r)
			{
				$('#json_response').html('<h3>Respuesta JSON</h3>'+r+'<br><label class="text-success">La calificación fue eliminada</label>');
				$('#del_'+id+'_ok').remove();
			}
		});
	});

	$(document).on('click','#actionBtn',function(){
		var method = $(this).attr('data-method');
		switch(method)
		{
			case 'POST':
				var a = parseInt($('#alumno').val());
				var m = parseInt($('#materias').val());
				var c = parseInt($('#calificacion').val());
				var url = method+'/'+ a +'/'+ m +'/'+ c;
			break;

			case 'GET':
				var a = parseInt($('#alumno').val());
				var url = method+'/'+ a;
			break;
		}

		$.ajax({
			url:'landingPage/pf'+url,
			method:method,
			success:function(r)
			{
				$('#json_response').html('<h3>Respuesta JSON</h3>'+r);
				r = JSON.parse(r);
				$('#calificacion').val('');
			}
		});
	});

});