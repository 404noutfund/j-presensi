/* $.ajaxSetup({url	:"demo_ajax_load.txt",
			tryCount : 0,
			retryLimit : 3,
			error 	: function(xhr, textStatus, errorThrown ) {
						if (textStatus == 'timeout') {
							this.tryCount++;
							if (this.tryCount <= this.retryLimit) {
								//try again
								$.ajax(this);
								return;
							}            
							return;
						}
						if (xhr.status == 500) {
							//handle error
							$("body").append("<div class='err' style='position:absolute;top:40px;left:230px;'>Server Eror Tekan F5</div>");
							$(".err").delay(5000).fadeOut();
						} else {
							//handle error
							$("body").append("<div class='err' style='position:absolute;top:40px;left:230px;'>Data Eror Tekan F5</div>");
							$(".err").delay(5000).fadeOut();
						}
			}
}); */
$.extend ({
		popup : function (options) {
			
			var o = $.extend( {
				'popup' 	: '#popup',
				'by' 		: '',
				'url' 		: '',
				'update'	: '',
				'form'		: '#form',
				'result'	: Array(),
				'find'		: '#SEARCH',
				'grid'		: '#popup .grid tbody tr',
				'left'		: '',
				'top'		: '',
				'submit'	: "input:submit",
				'filter'	: false,
				'fil_calon'	: false,
				'zona'		: false,
				'freeze'	: false,
				'is_update' : true,
				'del'	    : true,
				'is_delete' : true,
				'format'    : {},
			}, options);
			
			var position ;
			var selected	= -1;
			var size		= 0;
			var result 		= new Array();
			var nama_akun;
			var data_temp;
			var object;
			var url_plus 	= "";// untuk memberi variable tambahan untuk d kirim oleh ajax
			var ajax;
			$(o.by).not("input[type='button']").attr("readonly", true);
			$(o.by).click(function(){
				if($(o.popup).text() == ''){
					$_newDiv = '<div style="max-height:300px;border:blue;min-height:50px;max-width:600px;overflow: auto;border-style:solid;border-width:1px;position: absolute;z-index:9999;background-color: #F3F3F3;min-width:400px;padding:5px;" id="popup">'+
											'<table style="margin:auto;">'+
												'<tr>'+
													'<td><span id="keys">Keyword</span></td>'+
													'<td style="text-align:center;width:10px;">:</td>'+
													'<td>'+
														'<input type="text" id="SEARCH" style="width:250px;margin-right:25px;" placeholder="Keyword">'+
														'<span class="close" title="Tutup">&nbsp;</span>'+
													'</td>'+
												'</tr>'+
												'<tr><td colspan="3" style="text-align:center;" id="filter_pel"></td></tr>'+
											'</table>'+
											'<div></div></div>';

					$("body").after($_newDiv);

					$(o.popup).css("display","block");
					position = $(o.by).position();
					if(o.left == ''){
						o.left = position.left-180;
						o.top  = position.top+30;
					}

					$(o.popup).css({"left":o.left,"top":o.top});

					if(o.filter){
						$("#filter_pel").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" class="filter" name="filter" value="no_kontrak" checked>No Kontrak&nbsp;<input type="radio" class="filter" name="filter" value="nama">Nama&nbsp;<input type="radio" class="filter" name="filter" value="no_meter_air">No Meter&nbsp;<input type="radio" class="filter" name="filter" value="alamat_lengkap">Alamat');
						$(".filter").click(function(){
							$(o.find).val("").focus();
						});
					}

					if(o.fil_calon){
						$("#filter_pel").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" class="filter" name="filter" value="no_daftar" checked>No Pendaftaran&nbsp;<input type="radio" class="filter" name="filter" value="nama">Nama&nbsp;<input type="radio" class="filter" name="filter" value="alamat">Alamat');
						$(".filter").click(function(){
							$(o.find).val("").focus();
						});
					}

					if(o.zona)
					{
						$("#keys").html("Zona");
						$("#SEARCH").before('<select id="zone_select"></select>&nbsp;&nbsp;');
						generate_zona();
					}

					$(o.find).focus();

					tampil_data();
				}
				else
				 {
					// $(o.popup).remove();
					// nama_akun = "";
				}
				
				$(o.popup).find(".close").click(function(){
						$(o.popup).remove();
						nama_akun = "";
						if(o.afterClose){
							o.afterClose.call(1, o.popup);
						}
				});
				
				$(o.find).keydown(function(e)
				{
					if(ajax)
					{
						ajax.abort();
					}
					object = $(this);
					object.attr( "autocomplete", "off" );
					if(e.which == 13)
					{
						get_result(data_temp);
						$(o.popup).remove();
						nama_akun = "";
						e.preventDefault();
					}
				});
				
				$(o.find).keyup(function(e)
				{	
					if(ajax)
					{
						ajax.abort();
					}
					object = $(this);
					
					nama_akun = object.val();
					object.attr( "autocomplete", "off" );
					if(e.which == 40 || e.which == 9 || e.which == 38)//move up, down 
					{
						size = $(o.grid).length;
						
					   switch(e.which) 
					  {
						case 40:
						  selected = selected >= size - 1 ? 0 : selected + 1; break;
						case 38:
						  selected = selected <= 0 ? size - 1 : selected - 1; break;
						default: break;
					  }
						$(o.grid).removeClass('selected').eq(selected).addClass("selected"); 
						e.preventDefault();
						
					}else if(e.which == 13)
					{
						get_result(data_temp);
						$(o.popup).remove();
						nama_akun = "";
						e.preventDefault();
					}else if(e.which == 27)
					{
						$(o.popup).remove();
						nama_akun = "";
						e.preventDefault();
					}
					else
					{	
						// $_keyLenght = $(o.find).val().length;
						// $_filter = $("#popup .filter:checked").val();
						// if($_filter != "no_kontrak"){
						// 	if($_keyLenght%4 == 0){
						// 		tampil_data();
						// 	}
						// }else{
							tampil_data();
						// }
					}
					
				});
			
			});			
			function tampil_data()
			{
				if(o.url_plus){
					url_plus = o.url_plus.call();
				}
				$_idZona = "";
				if(o.zona){
					$_idZona = $("#zone_select").val();
				}
					selected = -1;
					preloader(o.popup,1);
					ajax = $.ajax({
							url : o.url+url_plus,
							data: {keyword:nama_akun,filter:$(".filter:checked").val(),zona:$_idZona},
							type: "GET",
							dataType: "json",
							cache: true,
							success:function(data)
							{
								
								$(o.popup+" div").html(data['grid']);	
								data_temp = data['data'];	
								
								$("#popup tbody a").click(function(){
									get_result(data_temp,$(this));
									$(o.popup).remove();
									nama_akun = "";
									return false;
								});
								$("#popup thead a").click(function(){
									return false;
								});
								if(o.page)
								{
									$(o.page).html(data['page_link']);
								}

								if(o.freeze){
									
									$_col = $("#popup .grid thead th").length;
									$_array = new Array();
									$_array[0] = 35;
									for(var i=1; i<$_col;i++){
										$_array[i] = $("#popup .grid thead th").eq(i).width()+25;
									}
									
									$_width = $("#popup .grid").width()+40;
									$_width = $_width < 620?$_width:620;
									$_height = $("#popup .grid").height();
									$_height = $_height > 245?245:$_height;

									$('#popup .grid').fixheadertable({
										colratio : $_array,
										height : $_height,
										width : $_width,
										resizeCol   : true,
									});
									if(o.filter){
										$_pHeight = 350;
									}else{
										$_pHeight = 335;
									}
									$("#popup").css({"overflow":"hidden","height":$_pHeight+"px","max-height":"","max-width":""});

									if($_height >= 245){
										$("#popup .headtable").css("margin-right","17px");
									}
									$("#popup .ui-corner-all .ui-widget-header").css("background","none repeat scroll 0 0 #F3F3F3");
								}

								preloader(o.popup,0);
							}
						});	
					$(o.grid).removeClass('selected').eq(selected).addClass("selected");
			}

			function generate_zona()
			{
				$base_url = $base_url.replace('http://','');
				$.ajax({
					url :"//"+$base_url+"master/data/generate_zona",
					dataType : 'json',
					async:false,
					success : function(result){
						$.each(result, function(index, data){
							$_opt = '<option value="'+data['ID']+'">'+data['NAMA']+'</option>';
							$("#zone_select").append($_opt);
						});

						$("#zone_select option").click(function(){
							tampil_data();
						});
					}
				})
			}

			function get_result(data,obj){
				if(obj)
				{					
					selected = $("#popup tbody a").index(obj);
				}
				
				inpt_selected = $(o.find).index(object);
				var az = o.result;
				for(field in az)
				{
						var val = $.trim(data[selected][field]);
						if(o.format[field] == "currency")
						{
							val = number_format(val);
						}
						if($($(az[field]).eq(inpt_selected)).is(':text'))
						{
							$(az[field]).eq(inpt_selected).val(val);
						}
						else if($($(az[field]).eq(inpt_selected)).is(':hidden'))
						{
							$(az[field]).eq(inpt_selected).val(val);
						}
						else if($($(az[field]).eq(inpt_selected)).is(':checkbox'))
						{
							if(val != 0 || val != ""){
								$($(az[field]).eq(inpt_selected)).attr('checked','checked');
							}
							else
							{
								$($(az[field]).eq(inpt_selected)).removeAttr('checked');
							}
						}
						else if($($(az[field]).eq(inpt_selected)).is('select'))
						{			
							$(az[field]+' option:[value='+val+']').eq(inpt_selected).attr("selected", "selected");
						}
						else{
							$(az[field]).eq(inpt_selected).html(val);
						}
					
				}
				if(o.done){
					o.done.call(1,data[selected]);
				}
				
				//set action form
				if(o.is_update == true){
					$(o.form).attr("action",o.update+"/update/"+data[selected]["ID"])+"/1";
				}
				$("#delete").remove();
				
				if(o.del)
				if(o.is_delete){
					$(o.submit).after('<input type="button" id="delete" value="Delete" onclick="window.location.href=\''+o.update+'/delete/'+data[selected]["ID"]+'\';">');
				}
			}
		},

		upload_file : function(options)
		{
			var o = $.extend( {
				'input' 	: '.images',
				'hidden'	: 'img',
				'preview'	: '#preview',
				'response' 	: '#response',
				'img_list'	: 'image-list',
				'width'		: '350',
				'base_url'	: '',
			}, options);
			
			var input = $(o.input), 
			formdata = false;
			$(o.preview).html('<div id="'+o.response+'"></div><ul id="'+o.img_list+'"></ul>');
			function showUploadedItem (source) {
				$("#response").prepend('<div class="preloader">&nbsp;</div>');
				var list = document.getElementById(o.img_list),
						li   = document.createElement("li"),
						a  	 = document.createElement("a");
						img  = document.createElement("img");
				list.innerHTML='';
				img.src = source;
				if(o.width){
					img.width  = o.width;
				}
				a.appendChild(img)
				a.href = "javascript:void(0)";
				a.className  = "show_img";
				a.id  		 = source;
				li.appendChild(a);
				list.appendChild(li);
				
				$(".show_img").bind("click",function(){
					preloader(this,1);
					$id = $(this).attr("id");
					var div_img 	= document.createElement( 'div' ),
						img_show 	= document.createElement( 'img' );
					img_show.src = $id;
					img_show.width  = '600';					
					img_show.height  = '400';					
					$.colorbox({html:div_img.appendChild(img_show)});
					preloader(this,0);
					$(".preloader").remove();				
				});
				
				preloader(this,0);
				$(".preloader").remove();
			}   

			if (window.FormData) {
				formdata = new FormData();
			}
			//event onclick
				$(".toview img").click(function(){
					index_img = $(this).index(".toview img");
					$(".toview a").eq(index_img).html("File");
					$(".toview img").eq(index_img).attr("src",o.base_url+"del.gif");
					$(".toview").find("input[type='hidden']").eq(index_img).remove();
					$(o.preview).find("#image-list").html("");
				});

				$(".toview a").click(function(){
					index_a = $(this).index(".toview a");
					source = $(".toview").eq(index_a).find("input[type='hidden']").val();
					showUploadedItem(source);
				});
			//end event
			input.change(function(){
				obj = this;
				// index = $(obj).index("input[type='file']");
				index = $(obj).index("input[type='file'].images");
				$("#response").prepend('<div class="preloader">&nbsp;</div>');
				$(".toview").find("input[type='hidden']").eq(index).remove();
				//$(o.response).html("Uploading . . .");
				var i = 0, len = this.files.length, img, reader, file;
				for ( ; i < len; i++ ) {
					file = this.files[i];					
					if ( window.FileReader ) {
							reader = new FileReader();
							reader.onloadend = function (e) { 
								showUploadedItem(e.target.result);
								$(".toview").eq(index).find("a").html(file['name']);
								$(".toview").eq(index).find("a").html(file['name']).after("<input type='hidden' name='"+o.hidden+"' value='"+e.target.result+"'>");
								$(".toview").eq(index).find('img').attr("src",o.base_url+"del.gif");
								
								$(".toview img").click(function(){
									index_img = $(this).index(".toview img");
									$("input[type=file]"+o.input).eq(index_img).val("");
									$(".toview a").eq(index_img).html("File");
									$(".toview img").eq(index_img).attr("src",o.base_url+"del.gif");
									$(".toview input[type='hidden']").eq(index_img).remove();
									$(o.preview+" #image-list").html("");
								});
								// $(".toview").eq(index).find('img').click(function(){
								// 	index_img = $(this).index("img")-1;
								// 	$(".toview").eq(index_img).find("a").html("File");
								// 	$(".toview").eq(index_img).find('img').attr("src","");
								// 	$(".toview").find("input[type='hidden']").eq(index_img).remove();
								// 	$(o.preview).find("#image-list").html("");
								// });
								$(".toview").eq(index).find('a').click(function(){									
									index_a = $(this).index(".toview a");
									source = $(".toview").eq(index_a).find("input[type='hidden']").val();
									showUploadedItem(source);									
								});								
							};
							reader.readAsDataURL(file);
					}
					// if (formdata) {
						// formdata.append(o.input, file);
					// }
					
				}
				
				// if (formdata) {
					// $.ajax({
						// url: o.url,
						// type: "POST",
						// data: formdata,
						// processData: false,
						// contentType: false,
						// success: function (res) {
							// $(o.response).html(res); 
						// }
					// });
				// }
			});
		},
		get_data : function(options)
		{
			var o = $.extend( {
				'url' 	: '',
				'result': '',
				'find'	: '',
				'data'	: '',
				'events': 'change',
			}, options);
			
			var key;
			var evnt = o.events.toString().split('-');
			var keyCode = evnt[1];
				console.log(evnt+"-"+keyCode);
			$(o.find).bind(evnt, function(e){
				if(keyCode == e.keyCode && evnt == 'keydown')
				{
					console.log(evnt+"-"+keyCode);
					return false;
				}
					
			/*
				preloader(o.find,1);
				key = {keyword:$(o.find).val()};
				
				if(o.data != ''){
					for(keys in o.data){
						var val = $(o.data[keys]).val();
						key = {keys:val};
					}
				}
				$.ajax({
					url : o.url,
					data: key,
					type: "GET",
					dataType: "json",
					success:function(data)
					{
						var az = o.result;
						for(field in az)
						{
							var val = $.trim(data[az[field]]);
							if($(field).is(':text'))
							{
								$(field).val(val);
							}
							else if($(field).is(':hidden'))
							{
								$(field).val(val);
							}else if($(field).is('select'))
							{			
								$(field+' option:[value='+val+']').attr("selected", "selected");
							}
							else{
								$(field).html(val);
							}
						}
						if(o.done){
							o.done.call(1,data);
						}
						preloader(o.find,0);
					}
				});
				return false;
			*/});
				
		},
		
		grid : function(options)
		{
			var o = $.extend( {
				'base_url' 	: '',
				'url' 		: '',
				'result'	: '',
				'num_row'	: '',
				'data'		: {},
				'field'		: {},
				'image_dir'	: '',
				'type'		: '',
				'als'		: '',
				'width'		: '',
				'special'	: '',
				'func'		: '',
				'readonly'	: '',
				'clas'		: '',
				'select_data': '',
				'action_img': '',
				'action_name': '',
				'action_arr': false,
				'field_img'	: {},
				'combo_value': {},//untuk combo action
				'opt_value'	: {},//untuk combo action
				'combo_name': '',
				'link'		: '',
				'cek'		: '',
				'cek_field'	: {},
				'link_detail': '',
				'link_ubah'	: '',
				'append'   	: false,
				'totextarea': false,
			}, options);
			
			get_data();
			
			function get_data()
			{

				if(o.append == false)
				{
					preloader(o.result,1);
				}
				
				$.ajax({
					url : o.url,
					data: o.data,
					type: "GET",
					dataType: "json",
					success:function(data)
					{
						var x="";
						var y="";
						var jumlah=0;
						var kelas =0;
						$data = !data['data']? data : data['data'];
						var data_temp_select = {};
						if(o.select_data){
							for(SField in o.select_data){
								
								if(typeof o.select_data[SField] == "object")
								{
									data_temp_select[SField] =o.select_data[SField];
								}
								else
								{
									$.ajax({
										url : o.select_data[SField],
										async:false,
										type: "GET",
										dataType: "json",
										success:function(dat)
										{
											data_temp_select[SField] = dat;
										}
									});	
								}
							}
						}

						$parent = $(o.result).parent();
						$parent.find("tbody tr").remove();
						$parent.find("#to_del").remove();

						$.each($data, function(i,n){
							i++;
							jumlah++;
							kelas++;
							if(kelas%2 == 1){
								if(o.append == true){
									x +="<tr id='row-"+n['ID']+"'>";
								}
								else{
									x +="<tr id='row-"+i+"'>";
								}
							}
							else{
								if(o.append == true){
									x +="<tr class ='even' id='row-"+n['ID']+"'>";
								}
								else{
									x +="<tr class ='even'  id='row-"+i+"'>";
								}
							}
							if(o.action_img == 'check_img')
							{
								if(o.action_name == ''){
									if(o.append == true){
									x	+="<td align='center'><input type='checkbox' name='pilih[]' value='"+n['ID']+"'/></td>";
									}	
									else{
									x	+="<td align='center'><input type='checkbox' id='"+n['ID']+"' name='pilih[]' value='"+i+"'/></td>" ;
									}	
								}
								else{
									var action = o.action_name+'[]';
									if(o.append == true){
										x	+="<td align='center'><input type='checkbox' name='"+action+"' value='"+n['ID']+"'/></td>";
									}	
									else{
										if(o.action_arr == false)
										{
											x	+="<td align='center'><input type='checkbox' id='"+n['ID']+"' name='"+action+"' value='"+i+"'/></td>" ;
										}
										else{
											x	+="<td align='center'><input type='checkbox' id='"+n['ID']+"' name='"+action+"' value='"+i+"'/></td>" ;
										}
									}	
								}
							}
							if(o.action_img == 'chec_img')
							{
								if(o.action_name == ''){
									if(o.append == true){
									x	+="<td align='center'><input type='checkbox' name='pilih["+n['ID']+"]' value='"+n['ID']+"'/></td>";
									}	
									else{
									x	+="<td align='center'><input type='checkbox' id='"+n['ID']+"' name='pilih["+i+"]' value='"+i+"'/></td>" ;
									}	
								}
								else{
									var action = o.action_name+'[]';
									if(o.append == true){
										x	+="<td align='center'><input type='checkbox' name='"+action+"' value='"+n['ID']+"'/></td>";
									}	
									else{
										if(o.action_arr == false)
										{
											x	+="<td align='center'><input type='checkbox' id='"+n['ID']+"' name='"+action+"' value='"+i+"'/></td>" ;
										}
										else{
											x	+="<td align='center'><input type='checkbox' id='"+n['ID']+"' name='"+action+"' value='"+i+"'/></td>" ;
										}
									}	
								}
							}
							
							for(field in o.field){
								//alert(o.type[field]);
								var tipe  = typeof o.type[field] == "object" && typeof o.type[field]['type'] != "undefined"? o.type[field]['type']:o.type[field];
								var other = typeof o.type[field] == "object" && typeof o.type[field]['other'] != "undefined"? o.type[field]['other']:"";
								var width = typeof o.type[field] == "object" && typeof o.type[field]['width'] != "undefined" ? o.type[field]['width']:o.width[field];
								var special = typeof o.type[field] == "object" && typeof o.type[field]['special'] != "undefined" ? o.type[field]['special']:o.special[field];
								if(o.field[field].substr(0, 2) == "ID")
								{
									out = n[field];
									
									//console.log(n[field]+"-"+tipe);
									if(tipe == "number")
									{
										out = curr_jns(out) == 'id'? out:curr_to_id(out);
									}
									out1 = n[o.field[field]];
									if(out1 == null)
									{
										out1 = "";
									}
									name = o.field[field];
								}
								// else if(o.field[field]== "DENDA"){
									// alert(data['denda']['5341']);
								// }
								else
								{
									
									out = n[o.field[field]];
									out1 = n[o.field[field]];
									
									if(tipe == "currency")
									{
										out = curr_jns(out) == 'id'? curr_to_id(curr_antonim(out)):curr_to_id(out);
										out1 = curr_jns(out1) == 'id'? out1:curr_to_id(curr_antonim(out1)).split(".").join("").split(",").join(".");
										
									}
									if(tipe == "numeric")
									{
										out = curr_jns(out) == 'id'? curr_to_id(curr_antonim(out)):curr_to_id(out);
										out1 = curr_jns(out1) == 'id'? curr_to_id(curr_antonim(out1)):curr_to_id(out1);								
										
									}else
									if(out1 == null){
										out1 = "";
									}

									if(out == null){
										out = "-";
									}
									name = field;
									/*console.log( n[o.field[field]]+"-"+curr_jns(out)+"-"+field+"-"+tipe+"-"+out);*/
								}
								
								if(tipe == "hidden"){
									if(typeof o.als[field] != "undefined"){
										$class='';
										if(o.field[field].substr(0, 2) == "ID"){$class='ID';}
										if(o.append == true){
										x +="<input type='hidden' id='"+i+"' "+other+" class='required "+$class+"'  placeholder='"+out1+"' name='"+o.als[field]+"["+n['ID']+"]' value='"+out1+"'/>" ;
										}
										else{
										x +="<input type='hidden' id='"+i+"' "+other+" class='required'  placeholder='"+out1+"' name='"+o.als[field]+"["+i+"]' value='"+out1+"'/>" ;
										}
									}
									else{
										$class='';
										if(o.field[field].substr(0, 2) == "ID"){$class='ID';}
										if(o.append == true){
										x +="<input type='hidden' id='"+i+"' "+other+" class='required "+$class+"'  placeholder='"+out1+"' name='"+name+"["+n['ID']+"]' value='"+out1+"'/>" ;
										}
										else{
										x +="<input type='hidden' id='"+i+"' "+other+" class='required'  placeholder='"+out1+"' name='"+name+"["+i+"]' value='"+out1+"'/>" ;
										}
									}

								}else if(tipe == "hiddenNum"){
									$class='';
									out = curr_to_id(curr_to_netral(out));
									out1 = curr_to_id(curr_to_netral(out1));
									out = curr_jns(out) == 'id'? out:curr_to_id(out);
									out1 = curr_jns(out1) == 'id'? out1:curr_to_id(out1);	
									if(o.field[field].substr(0, 2) == "ID"){$class='ID';}
									if(o.append == true){
									x +="<input type='hidden' id='"+i+"' "+other+" class='required "+$class+"'  placeholder='"+out1+"' name='"+name+"["+n['ID']+"]' value='"+out1+"'/>" ;
									}
									else{
									x +="<input type='hidden' id='"+i+"' "+other+" class='required'  placeholder='"+out1+"' name='"+name+"["+i+"]' value='"+out1+"'/>" ;
									}
								}else if(tipe == "checkbox"){
									if(out == 1)
									{
										x +="<td align = 'center'><input class='"+o.clas[field]+"' "+other+" type='checkbox' id='"+i+"' name='"+name+"["+i+"]' value='0' checked/></td>" ;
									}
									else
									{
										x +="<td align = 'center'><input type='checkbox' "+other+" class='"+o.clas[field]+"' id='"+i+"' name='"+name+"["+i+"]' value='1'/></td>" ;
									}
								}else if(tipe == "radiobutton"){
									if(out == 1)
									{
										x +="<td align = 'center'><input type='radio' "+other+" class='"+o.clas[field]+"' id='"+i+"' name='"+name+"[]' value='"+n['ID']+"' checked/></td>" ;
									}
									else
									{
										x +="<td align = 'center'><input type='radio' "+other+" class='"+o.clas[field]+"' id='"+i+"' name='"+name+"[]' value='"+n['ID']+"'/></td>" ;
									}
								}else if(tipe == "text"){
									if(typeof out == "undefined" || typeof out === 'NaN')
									{
										out=0;
									}
									if(o.append == true){
										x +="<td align = 'center'><input id='"+i+"' "+other+" style='width:"+width+"px;' class='required "+o.clas[field]+"' placeholder ='"+name+"' type='text' name='"+name+"["+n['ID']+"]' value='"+out+"'/></td>" ;
									}
									else{
										x +="<td align = 'center'><input id='"+i+"' "+other+" style='width:"+width+"px;' class='required "+o.clas[field]+"'cplaceholder ='"+name+"' type='text' name='"+name+"["+i+"]' value='"+out+"'/></td>" ;
									}
								}else if(tipe == "select" ){
									var SOption = "";
									if(typeof out == "undefined" || typeof out === 'NaN')
									{
										out=0;
									}
									
									if(typeof o.select_data[SField] == "object")
									{
										for(SKey in data_temp_select[field])
										{
											SSelected = SValue[SKey] == out ? "selected='selected'":"";
											SOption += "<option "+SSelected+" value='"+SKey+"'>"+SValue[SKey]+"</option>";
										}
									}
									else
									{	
										$.each(data_temp_select[field], function(i,data_temp){
											SSelected = data_temp["NAMA"] == out ? "selected='selected'":"";
											SOption += "<option "+SSelected+" value='"+data_temp["ID"]+"'>"+data_temp["NAMA"]+"</option>";
										});
									}
									
									if(o.append == true){
										x +="<td align = 'center'><select id='"+i+"' "+other+" style='width:"+width+"px;' class='required "+o.clas[field]+"' placeholder ='"+name+"' type='text' name='"+name+"["+n['ID']+"]'>"+SOption+"</select></td>" ;
									}
									else{
										x +="<td align = 'center'><select id='"+i+"' "+other+" style='width:"+width+"px;' class='required "+o.clas[field]+"'cplaceholder ='"+name+"' type='text' name='"+name+"["+i+"]'>"+SOption+"</select></td>" ;
									}
								}else if(tipe == "number_text"){
									if(IsNumeric(out))out = number_format(out);
									if(typeof out == "undefined" || typeof out === 'NaN')
									{
										out=0;
									}
									if(tipe == true){
										x +="<td align = 'center'><input id='"+i+"' "+other+" style='width:"+width+"px;' class='required "+o.clas[field]+"' placeholder ='"+name+"' type='text' name='"+name+"["+n['ID']+"]' value='"+out+"'/></td>" ;
									}
									else{
										x +="<td align = 'center'><input id='"+i+"' "+other+" style='width:"+width+"px;' class='required "+o.clas[field]+"' cplaceholder ='"+name+"' type='text' name='"+name+"["+i+"]' value='"+out+"'/></td>" ;
									}
								}else if(tipe == "last_text"){
									if(out1 === undefined)
									{
										out1=0;
									}
									if(i == data.length)
									{
										if(o.append == true){
											x +="<td align = 'center'><input id='"+i+"' "+other+" class='currency  style='width:30px;' type='text' name='"+name+"["+n['ID']+"]' value='"+out1+"'/></td>" ;
										}
										else{
											x +="<td align = 'center'><input id='"+i+"' "+other+" class='currency' style='width:30px;' type='text' name='"+name+"["+i+"]' value='"+out1+"'/></td>" ;
										}
									}
									else{
										if(o.append == true){
											x +="<td>" +out1 + "</td>";
											x +="<input type='hidden' class='currency  "+other+" id='"+n['ID']+"' name='"+name+"["+n['ID']+"]' value='"+out1+"'/>";
										}
										else{
											x +="<td>" +out1 + "</td>";
											x +="<input type='hidden' class='currency  "+other+" id='"+i+"' name='"+name+"["+i+"]' value='"+out1+"'/>";
										}
									}
								}else if(tipe == "last_text_readonly"){
									if(out1 === undefined)
									{
										out1=0;
									}
									//var val = '';
									//if(IsNumeric(out1))out = number_format(out1);
									// if(other == 'angka'){
										// val = number_format(out1);
									// }
									// else{
										// val = out1;
									// }
									console.log(out);
									if(i == data.length)
									{
										if(o.append == true){
											x +="<td align = 'center'><input id='"+i+"' style='width:30px;' "+other+" type='text' readonly name='"+name+"["+n['ID']+"]' value='"+out+"'/></td>" ;
										}
										else{
											x +="<td align = 'center'><input id='"+i+"' style='width:30px;' "+other+" type='text' readonly name='"+name+"["+i+"]' value='"+out+"'/></td>" ;
										}
									}
									else{
										x +="<td>" +out + "</td>";
										x +="<input type='hidden' id='"+i+"'  name='"+name+"["+i+"]' value='"+out+"'/>";
									}
								}else if(tipe == "numeric"){
									if(typeof out == "undefined" || typeof out === 'NaN')
									{
										out=0;
									}
									if(o.append == true){
										x +="<td align = 'center'><input id='"+i+"' "+other+" class='currency "+o.clas[field]+"' style='width:"+width+"px;' type='text' name='"+name+"["+n['ID']+"]' value='"+out+"'/></td>" ;
									}
									else{
										x +="<td align = 'center'><input id='"+i+"' "+other+" class='currency "+o.clas[field]+"' style='width:"+width+"px;' type='text' name='"+name+"["+i+"]' value='"+out+"'/></td>" ;
									}
								}else if(tipe == "numericspecial"){
									out = data[special][n['ID']];
									out = curr_jns(out) == 'id'? curr_to_id(curr_antonim(out)):curr_to_id(out);
									if(typeof out == "undefined" || typeof out === 'NaN')
									{
										out=0;
									}
									if(o.append == true){
										x +="<td align = 'center'><input id='"+i+"' "+other+" class='currency "+o.clas[field]+"' style='width:"+width+"px;' type='text' name='"+name+"["+n['ID']+"]' value='"+out+"'/></td>" ;
									}
									else{
										x +="<td align = 'center'><input id='"+i+"' "+other+" class='currency "+o.clas[field]+"' style='width:"+width+"px;' type='text' name='"+name+"["+i+"]' value='"+out+"'/></td>" ;
									}
								}else if(tipe == "readonly"){
									if(IsNumeric(out))out = number_format(out);
									if(typeof out == "undefined" || typeof out === 'NaN')
									{
										out=0;
									}
									if(o.append == true){
										x +="<td align = 'center'><input readonly id='"+i+"' "+other+" class='numeric "+o.clas[field]+"' style='width:"+width+"px;' type='text' name='"+name+"["+n['ID']+"]' value='"+out+"'/></td>" ;
									}
									else{
										x +="<td align = 'center'><input readonly id='"+i+"' "+other+" class='numeric "+o.clas[field]+"' style='width:"+width+"px;' type='text' name='"+name+"["+i+"]' value='"+out+"'/></td>" ;
									}
								}else{
									
									if(o.link == name)
									{
										x +="<td><a href='javascript:void(0)' class='edit' rowid='"+i+"'>" +out + "</a></td>";
										x +="<input type='hidden' id='"+i+"' name='"+name+"["+i+"]' value='"+out1+"'/>";
									}
									else if(o.link_detail == name)
									{
										x +="<td><a href='javascript:void(0)' class='detil' id='"+n['ID']+"'>" +out+ "</a></td>";
									}
									else if(o.link_ubah == name)
									{
										if(i == data.length)
										{
											x +="<td><a href='javascript:void(0)' class='ubah' id='"+n['ID']+"'>" +out+ "</a></td>";
										}
										else{
											x +="<td>" +out + "</td>";
										}
									}
									else if(o.cek == name)
									{
										for(field in o.cek_field)
										{
											if(out == field){
												x +="<td>" +o.cek_field[field] + "</td>";
											}
										}
									}
									else
									{
										
										if(o.append == true){

											x +="<td>" +out + "</td>";
											x +="<input type='hidden' id='"+n['ID']+"' class='"+n['ID']+"' "+other+" name='"+name+"["+n['ID']+"]' value='"+out1+"'/>";
										}
										else{
											if(tipe == 'numeric' || tipe == 'currency'){
												x +="<td align='right'>" +out + "</td>";
											}
											else{
												x +="<td>" +out + "</td>";
											}
											x +="<input type='hidden' id='"+i+"' name='"+name+"["+i+"]' "+other+" value='"+out1+"'/>";
										}
									}
								}

							}
							//===================================== untuk action =====================================
							if(o.action_img == 'all_image'){
								if(o.append == true){
								x	+="<td align='center'><a href='javascript:void(0)' class='edit' rowid='"+n['ID']+"'><img src='"+o.base_url+"ico/edit.gif' /></a></td>"
										+"<td align='center'><a href='javascript:void(0)' class='del' rowid='"+n['ID']+"'><img src='"+o.base_url+"ico/del.gif' /></a></td>" 
									+"</tr>";
								}
								else{
								x	+="<td align='center'><a href='javascript:void(0)' class='edit' rowid='"+i+"'><img src='"+o.base_url+"ico/edit.gif' /></a></td>"
										+"<td align='center'><a href='javascript:void(0)' class='del' rowid='"+i+"'><img src='"+o.base_url+"ico/del.gif' /></a></td>" 
									+"</tr>";
								}
							}else if(o.action_img == 'del_image'){
								if(o.append == true){
								x	+="<td align='center'><a href='javascript:void(0)' class='del' rowid='"+n['ID']+"'><img src='"+o.base_url+"ico/del.gif' /></a></td>" 
									+"</tr>";
								}
								else{
								x	+="<td align='center'><a href='javascript:void(0)' class='del' rowid='"+i+"'><img src='"+o.base_url+"ico/del.gif' /></a></td>" 
									+"</tr>";
								}
							}else if(o.action_img == 'check_img_double'){
								if(o.append == true){
								x	+="<td align='center'><input type='checkbox' name='pilih1[]' value='"+n['ID']+"'/></td>" 
									+"<td align='center'><input type='checkbox' name='pilih2[]' value='"+n['ID']+"'/></td>" 
									+"</tr>";
								}	
								else{
								x	+="<td align='center'><input type='checkbox' name='pilih1[]' value='"+i+"'/></td>" 
									+"<td align='center'><input type='checkbox' name='pilih2[]' value='"+i+"'/></td>" 
									+"</tr>";
								}	
							}else if(o.action_img == 'check_img_triple'){
								if(o.append == true){
								x	+="<td align='center'><input type='checkbox' name='pilih1[]' value='"+n['ID']+"'/></td>" 
									+"<td align='center'><input type='checkbox' name='pilih2[]' value='"+n['ID']+"'/></td>" 
									+"<td align='center'><input type='checkbox' name='pilih3[]' value='"+n['ID']+"'/></td>" 
									+"</tr>";
								}	
								else{
								x	+="<td align='center'><input type='checkbox' name='pilih1[]' value='"+i+"'/></td>" 
									+"<td align='center'><input type='checkbox' name='pilih2[]' value='"+i+"'/></td>" 
									+"<td align='center'><input type='checkbox' name='pilih3[]' value='"+i+"'/></td>" 
									+"</tr>";
								}	
							}else if(o.action_img == 'radio_img_triple'){
								if(o.append == true){
								x	+="<td align='center'><input type='radio' name='pilih["+n['ID']+"]' value='1' checked /></td>" 
									+"<td align='center'><input type='radio' name='pilih["+n['ID']+"]' value='2'/></td>" 
									+"<td align='center'><input type='radio' name='pilih["+n['ID']+"]' value='0'/></td>" 
									+"</tr>";
								}	
								else{
								x	+="<td align='center'><input type='radio' name='pilih["+i+"]' value='1' checked /></td>" 
									+"<td align='center'><input type='radio' name='pilih["+i+"]' value='2'/></td>" 
									+"<td align='center'><input type='radio' name='pilih["+i+"]' value='0'/></td>" 
									+"</tr>";
								}	
							}else if(o.action_img == 'radio_img_dinamis'){
								val = n[o.field_img];
								for(field in o.opt_value)
								{
									if(val == o.opt_value[field]){
										if(o.append == true){
											x	+="<td align='center'><input type='radio' name='pilih["+n['ID']+"]' value='"+o.opt_value[field]+"' checked/></td>" ;
										}
										else{
											x	+="<td align='center'><input type='radio' name='pilih["+i+"]' value='"+o.opt_value[field]+"' checked/></td>" ;
										}
									}
									else{
										if(o.append == true){
											x	+="<td align='center'><input type='radio' name='pilih["+n['ID']+"]' value='"+o.opt_value[field]+"' /></td>" ;
										}
										else{
											x	+="<td align='center'><input type='radio' name='pilih["+i+"]' value='"+o.opt_value[field]+"' /></td>" ;
										}
									}
								}
								x = x+"</tr>";
							}else if(o.action_img == 'combo_img'){
								
								var text = "<option value = '0'>---------</option>";
								for(field in o.combo_value)
								{
									text +='<option value='+o.combo_value[field]+'>'+field+'</option>';				
								}
								x	+="<td align='center'><select name = '"+o.combo_name+"["+i+"]'>"
									+text
									+"</select></td></tr>";
							}else if(o.action_img == 'edit_image'){
								if(o.append == true){
								x	+="<td align='center'><a href='javascript:void(0)' class='edit' rowid='"+n['ID']+"'><img src='"+o.base_url+"ico/edit.gif' /></a></td>"
									+"</tr>";
								}
								else{
								x	+="<td align='center'><a href='javascript:void(0)' class='edit' rowid='"+i+"'><img src='"+o.base_url+"ico/edit.gif' /></a></td>"
									+"</tr>";
								}
							}else if(o.action_img == 'no_image'){
								x	+="</tr>";
							}	
						});
						
						if($data.length == 0){
							//alert("Data Tidak Ada!");
							$parent = $(o.result).parent();
							$target = $parent.find("thead th").length;
							$tr = '<tr id="to_del"><td colspan="'+$target+'" style="font-size:15px;font-weight:600;color:red;">Data Tidak Ada!</td></tr>';
							$parent.find("tbody tr").remove();
							$parent.find("#to_del").remove();
							$parent.find("tbody").after($tr);
						}

						y +=parseInt(jumlah);
						if(o.append == true){
							$(o.result).append(x);
						}
						else
						{
							$(o.result).html(x);
						}
						
						if(o.num_row){
							$(o.num_row).html(y);
						}
						crud();
						if(o.done)
						{
							o.done.call(1, data);
						}
						preloader(o.result,0);
					}
				});
			}
			
			function crud()
			{
				$(".grid").dinatagrid({
						items: o.field,
						type:  o.type,
						image_dir:o.image_dir,
						action_img:o.action_img,
						link:o.link,
						totextarea:o.totextarea
				});
			}

		}
});

function preloader(obj,status)
{
	if(status == 1){
		var position = $(obj).position();
		$(obj).after('<div class="preloader">&nbsp;</div>');
		$(".preloader").css({"left":position.left,"top":position.top});
	}
	else
	{
		$(".preloader").remove();
	}
}

function number_format(number, decimals, dec_point, thousands_sep) {
// Formats a number with grouped thousands

// *     example 1: number_format(1234,56);
// *     returns 1: '1.235'
// *     example 2: number_format(1234.56, 2, ',', ' ');
// *     returns 2: '1 234,56'
// *     example 3: number_format(1234.5678, 2, '.', '');
// *     returns 3: '1234.57'
// *     example 4: number_format(67, 2, ',', '.');
// *     returns 4: '67.00'
// *     example 5: number_format(1000);
// *     returns 5: '1.000'
// *     example 6: number_format(67,311, 2);
// *     returns 6: '67,31'
// *     example 7: number_format(1000,55, 1);
// *     returns 7: '1.000,6'
// *     example 8: number_format(67000, 5, ',', '.');
// *     returns 8: '67.000,00000'
// *     example 9: number_format(0,9, 0);
// *     returns 9: '1'
// *     example 10: number_format('1,20', 2);
// *     returns 10: '1,20'
// *     example 11: number_format('1,20', 4);
// *     returns 11: '1,2000'
// *     example 12: number_format('1,2000', 3);
// *     returns 12: '1,200'
	var n = number, prec = decimals;

	var toFixedFix = function (n,prec) {
		var k = Math.pow(10,prec);
		return (Math.round(n*k)/k).toString();
	};

	n = !isFinite(+n) ? 0 : +n;
	prec = !isFinite(+prec) ? 0 : Math.abs(prec);
	var sep = (typeof thousands_sep === 'undefined') ? '.' : thousands_sep;
	var dec = (typeof dec_point === 'undefined') ? ',' : dec_point;

	var s = (prec > 0) ? toFixedFix(n, prec) : toFixedFix(Math.round(n), prec); //fix for IE parseFloat(0.55).toFixed(0) = 0;

	var abs = toFixedFix(Math.abs(n), prec);
	var _, i;

	if (abs >= 1000) {
		_ = abs.split(/\D/);
		i = _[0].length % 3 || 3;

		_[0] = s.slice(0,i + (n < 0)) +
			  _[0].slice(i).replace(/(\d{3})/g, sep+'$1');
		s = _.join(dec);
	} else {
		s = s.replace(',', dec);
	}

	var decPos = s.indexOf(dec);
	if (prec >= 1 && decPos !== -1 && (s.length-decPos-1) < prec) {
		s += new Array(prec-(s.length-decPos-1)).join(0)+'0';
	}
	else if (prec >= 1 && decPos === -1) {
		s += dec+new Array(prec).join(0)+'0';
	}
	return s; 
}

$(document).ready(function() {
	numeric();
	currency();
	var js = document.createElement("script");
	js.type = "text/javascript";
	js.src = $base_url+"js/jquery.ajaxprogress.js";
	document.head.appendChild(js);

	var fnumber = document.createElement("script");
	fnumber.type = "text/javascript";
	fnumber.src = $base_url+"js/format_number.min.js";	
	document.head.appendChild(fnumber);
	
	check_all();
});
	
function check_all()
{
	$('.checkall').click(function(){
		$('.checkall').parents('table').find(':checkbox').attr('checked', this.checked);
	});
}
	
function numeric($format)
{
	var keys = 0;
	$(".numeric").keydown(function(event) {
		keys = event.keyCode;
		// Allow: backspace, delete, tab, escape, and enter
        if (event.keyCode == 116 || event.keyCode == 46 || event.keyCode == 188 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || 
             // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) || 
             // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39) || event.keyCode == 190 || event.keyCode == 110|| event.keyCode == 188) {
                 // let it happen, don't do anything
				return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault(); 
            }   
        }
    });

 //    $(".numeric").keyup(function(event) {
	// 	if(keys != 188 /*&& keys != 46*/){
	// 		var val = split($(this).val(),'.','');
	// 		$(this).val(format( "###0,00",val));
	// 	}
	// });
}

function currency()
{
	var keys = 0;
	$(".currency").keydown(function(event) {
		keys = event.keyCode;
		// Allow: backspace, delete, tab, escape, and enter
        if (event.keyCode == 116 || event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || 
             // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) || 
             // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39) || event.keyCode == 190 || event.keyCode == 110|| event.keyCode == 188) {
                 // let it happen, don't do anything             	
				return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault(); 
            }   
        }
    });
	
	$(".currency").keyup(function(event) {
		if(keys != 188 /*&& keys != 46*/){
			var val = split($(this).val(),'.','');
			$(this).val(to_curr(val));
		}
	});
}

function validation(sender, required)
{
	var obj = $(sender).find("."+required);
	for (var i = 0; i < obj.length; i++)
	{
		if (obj.eq(i).val() == "")
		{
			alert("Field " + obj.eq(i).attr("placeholder") + " harus diisi!");
			obj.eq(i).focus();
			return false;
		}
	}
	
	return true;
}

function IsNumeric(input)
{
    return (input - 0) == input && (input+'').replace(/^\s+|\s+$/g, "").length > 0;
}
function split(num, split, join)
{
	if(typeof split == "undefined")
	{
		split 	= '.';
		join 	= '';
	}

    return num.toString().split(split).join(join);
}

function clog(val)
{
	console.clear();
	console.log(val);
}

function showProgress(evt) {
	var msg = "Length not computable";

	if (evt.lengthComputable) {
		msg = (evt.loaded / evt.total)*100;
	}
	if(msg <= 100)$("#progressbar").reportprogress(parseInt(msg)+1);
	console.log("Progress in "+msg+"%");
}

function update(){
        $("#progressbar").reportprogress(++pct);
        if(pct==100){
                pct=0;
                $("#progressbar").reportprogress(0);
        }
}


function strrchr (haystack, needle) {
  // *     example 1: strrchr("Line 1\nLine 2\nLine 3", 10).substr(1)
  // *     returns 1: 'Line 3'
  var pos = 0;

  if (typeof needle !== 'string') {
    needle = String.fromCharCode(parseInt(needle, 10));
  }
  needle = needle.charAt(0);
  pos = haystack.lastIndexOf(needle);
  if (pos === -1) {
    return false;
  }

  return haystack.substr(pos);
}

function strpos (haystack, needle, offset) {
  // *     example 1: strpos('Kevin van Zonneveld', 'e', 5);
  // *     returns 1: 14
  var i = (haystack + '').indexOf(needle, (offset || 0));
  return i === -1 ? false : i;
}

function curr_antonim($number)
{
	if($number==null || $number == 0){
		return 0;
	}else{
		$string = strrchr($number, ",").toString().substr(1);
		$char = ".";
		$positions =new Array();
		$pos = -1;
		$x = 0;
		while (($pos = strpos($string, $char, $pos+1)) !== false) {
			$x++;
			$positions[$x] = $pos;
		}

		$result = $positions.join(", ");
		if($result == ""){
			$number = $number.split('.').join('ttk').split(',').join('.').split('ttk').join(',');
		}
		else
		{
			$number = $number.split(',').join('km').split('.').join(',').split('km').join('.');
		}

		return $number;
	}

	
}

function curr_to_netral($number) //hanya untuk format id 1.000.000,23
{
	return split(split($number, '.', ''),',','.');
}

function curr_jns($number)
{
	if($number == null) return 'us';
	$temp = $number.toString().split(",")[1];
	if(typeof $temp == 'undefined')
	{
		$temp = $number.toString().split(".")[1];
		if(typeof $temp == 'undefined')
		{
			status='us';
		}else if($temp.toString().split(".").length <2)
		{
		  status='us';
		}
		else
		{
			status='id';
		}
	}else if($temp.toString().split(".").length >1)
	{
	  status='us';
	}
	else
	{
		status= 'id';
	}
	
	return status;
}

function curr($number)
{
	return curr_jns($number) == 'id'? curr_to_id(curr_antonim($number)):curr_to_id($number)	;
}

function curr_to_id($number)
{
	return format( "#.##0,###", $number);	
}

function to_curr($number)
{
	var curr = curr_jns($number) != 'id'?curr_to_id($number):curr_to_id(curr_to_netral($number));	
	return curr;
}

function bulan_tahun(tgl){
	$ex = tgl.split("-");
	
	if($ex.length == 2){
		tgl = parseInt($ex[0]).toString();
	}else if($ex.length == 3){
		tgl = parseInt($ex[1]).toString();
	}

	switch(tgl)
	{
		case '1'	: tgl = "Januari";break;	
		case '2'	: tgl = "Februari";break;
		case '3'	: tgl = "Maret";break;
		case '4'	: tgl = "April";break;
		case '5'	: tgl = "Mei";break;
		case '6'	: tgl = "Juni";break;
		case '7'	: tgl = "Juli";break;
		case '8'	: tgl = "Agustus";break;
		case '9'	: tgl = "September";break;
		case '10'	: tgl = "Oktober";break;
		case '11'	: tgl = "November";break;
		case '12'	: tgl = "Desember";break;
	}

	if($ex.length == 2){
		tgl = tgl+" "+$ex[1];
	}else if($ex.length == 3){
		tgl = tgl+" "+$ex[2];
	}

	return tgl;
}

function number_to_month(num)
{	
	$ex = num.split("-");
	
	if($ex.length == 3){
		num = parseInt($ex[1]).toString();
	}else if($ex.length == 2){
		num = parseInt($ex[0]).toString();
	}

	switch (num)
	{
		case '1'	: num = "Januari";break;
		case '2'	: num = "Februari";break;
		case '3'	: num = "Maret";break;
		case '4'	: num = "April";break;
		case '5'	: num = "Mei";break;
		case '6'	: num = "Juni";break;
		case '7'	: num = "Juli";break;
		case '8'	: num = "Agustus";break;
		case '9'	: num = "September";break;
		case '10'	: num = "Oktober";break;
		case '11'	: num = "November";break;
		case '12'	: num = "Desember";break;
	}

	if($ex.length == 3){
		num = $ex[0]+" "+num+" "+$ex[2];
	}else if($ex.length == 2){
		num = num+" "+$ex[1];
	}

	return num;
}

function month_singkatan_to_month(month)
{
	switch (month)
	{
		case 'Jan'	: return "Januari";break;
		case 'Feb'	: return "Februari";break;
		case 'Mar'	: return "Maret";break;
		case 'Apr'	: return "April";break;
		case 'May'	: return "Mei";break;
		case 'Jun'	: return "Juni";break;
		case 'Jul'	: return "Juli";break;
		case 'Aug'	: return "Agustus";break;
		case 'Sep'	: return "September";break;
		case 'Oct'	: return "Oktober";break;
		case 'Nov'	: return "November";break;
		case 'Dec'	: return "Desember";break;
	}
}

function month_singkatan_to_num(month)
{
	switch (month)
	{
		case 'Jan'	: return "1";break;
		case 'Feb'	: return "2";break;
		case 'Mar'	: return "3";break;
		case 'Apr'	: return "4";break;
		case 'May'	: return "5";break;
		case 'Jun'	: return "6";break;
		case 'Jul'	: return "7";break;
		case 'Aug'	: return "8";break;
		case 'Sep'	: return "9";break;
		case 'Oct'	: return "10";break;
		case 'Nov'	: return "11";break;
		case 'Dec'	: return "12";break;
	}
}

function month_to_bulan(month)
{
	switch ($.trim(month))
	{
		case "January" : return "Januari";
		case "February" : return "Februari";
		case "March" : return "Maret";
		case "April" : return "April";
		case "May" : return "Mei";
		case "June" : return "Juni";
		case "July" : return "Juli";
		case "August" : return "Agustus";
		case "September" : return "September";
		case "October" : return "Oktober";
		case "November" : return "Nopember";
		case "December" : return "Desember";
		default: return false;break;
	}
}

function terbilang(s){

	if(s == 0){
		return "Nol Rupiah";
	}else{
		var th = ['', 'Ribu', 'Juta', 'Milyar', 'Trilyun'];	
		var dg = ['Nol', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam','Tujuh', 'Delapan', 'Sembilan'];
		var tn = ['Sepuluh', 'Sebelas', 'Dua Belas', 'Tiga Belas', 'Empat Belas', 'Lima Belas', 'Enam Belas', 'Tujuh Belas', 'Delapan Belas', 'Sembilan Belas'];
		var tw = ['Dua Puluh', 'Tiga Puluh', 'Empat Puluh', 'Lima Puluh', 'Enam Puluh', 'Tujuh Puluh', 'Delapan Puluh', 'Sembilan Puluh'];
		
		s = s.toString();
		s = s.replace(/[\, ]/g, '');
		if (s != parseFloat(s)) return 'bukan angka';
		var x = s.indexOf('.');
		if (x == -1) x = s.length;
		if (x > 15) return 'terlalu besar';
		var n = s.split('');
		var str = '';
		var sk = 0;
		for (var i = 0; i < x; i++) {
			if ((x - i) % 3 == 2) {
				if (n[i] == '1') {
					str += tn[Number(n[i + 1])] + ' ';
					i++;
					sk = 1;
				} else if (n[i] != 0) {
					str += tw[n[i] - 2] + ' ';
					sk = 1;
				}
			} else if (n[i] != 0) {
				str += dg[n[i]] + ' ';
				if ((x - i) % 3 == 0) str += 'Ratus ';
				sk = 1;
			}
			if ((x - i) % 3 == 1) {
				if (sk) str += th[(x - i - 1) / 3] + ' ';
				sk = 0;
			}
		}
		if (x != s.length) {
			var y = s.length;
			str += 'Koma ';
			for (var i = x + 1; i < y; i++) str += dg[n[i]] + ' ';
		}
		var hasil = str.replace(/\s+/g, ' ');

		var hasil = hasil.split("Satu Ratus").join("Seratus")+" Rupiah";
		return hasil;
	}
}

function str_pad (input, pad_length, pad_string, pad_type){
  // *     example 1: str_pad('Kevin van Zonneveld', 30, '-=', 'STR_PAD_LEFT');
  // *     returns 1: '-=-=-=-=-=-Kevin van Zonneveld'
  // *     example 2: str_pad('Kevin van Zonneveld', 30, '-', 'STR_PAD_BOTH');
  // *     returns 2: '------Kevin van Zonneveld-----'
  var half = '',
    pad_to_go;

  var str_pad_repeater = function (s, len) {
    var collect = '',
      i;

    while (collect.length < len) {
      collect += s;
    }
    collect = collect.substr(0, len);

    return collect;
  };

  input += '';
  pad_string = pad_string !== undefined ? pad_string : ' ';

  if (pad_type !== 'STR_PAD_LEFT' && pad_type !== 'STR_PAD_RIGHT' && pad_type !== 'STR_PAD_BOTH') {
    pad_type = 'STR_PAD_RIGHT';
  }
  if ((pad_to_go = pad_length - input.length) > 0) {
    if (pad_type === 'STR_PAD_LEFT') {
      input = str_pad_repeater(pad_string, pad_to_go) + input;
    } else if (pad_type === 'STR_PAD_RIGHT') {
      input = input + str_pad_repeater(pad_string, pad_to_go);
    } else if (pad_type === 'STR_PAD_BOTH') {
      half = str_pad_repeater(pad_string, Math.ceil(pad_to_go / 2));
      input = half + input + half;
      input = input.substr(0, pad_length);
    }
  }

  return input;
}

function bln_us_indo(bulan)
{
	switch (bulan)
	{
		case 'january'	: return "Januari";break;
		case 'february'	: return "Februari";break;
		case 'march'	: return "Maret";break;
		case 'april'	: return "April";break;
		case 'may'		: return "Mei";break;
		case 'june'		: return "Juni";break;
		case 'july'		: return "Juli";break;
		case 'august'	: return "Agustus";break;
		case 'september': return "September";break;
		case 'october'	: return "Oktober";break;
		case 'november'	: return "November";break;
		case 'december'	: return "Desember";break;		

		default: return false;break;
	}
}

function num_to_bulan(num){
	
	switch (num)
	{
		case '01'	: return "Januari";break;
		case '02'	: return "Februari";break;
		case '03'	: return "Maret";break;
		case '04'	: return "April";break;
		case '05'	: return "Mei";break;
		case '06'	: return "Juni";break;
		case '07'	: return "Juli";break;
		case '08'	: return "Agustus";break;
		case '09'	: return "September";break;
		case '10'	: return "Oktober";break;
		case '11'	: return "November";break;
		case '12'	: return "Desember";break;
	}
}

function encode_base64(string){
	var leng = string.length;
	var awal = string.substr(0,2), //ZU
		string = string.substr(2, leng),//LBADI
		leng = string.length;
	string = string.slice(0, leng-1)+awal+string.slice((leng-1)+Math.abs(0));//LBADIZUI
	string = btoa('ASP'+string+"NET");//ASPLBADIZUI ->btoa();
	return string;
}

function decode_base64(string){
	string = atob(string); // ASPLBADZUINET -> atob();
	var leng = string.length,
		string = string.slice(3, leng-3), //LBADZUI
		leng = string.length,
		sisipan = string.substr(leng-3, 2); //ZU

	var non_sisip = string.slice(0,leng-3)+string.slice((leng-1)+Math.abs(0)); //LBADI
	string = sisipan+non_sisip; //ZULBADI
	return string;
}