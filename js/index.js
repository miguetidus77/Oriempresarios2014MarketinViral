
		$(function(){
			$("#register").click(function(){
				$("#newPreneurForm").show();
				$("#newPreneurForm").animate({					
					left:0,
					opacity:1
				},1000);
			});

			$("#hiddeFormRegister").click(function(){
				$("#newPreneurForm").animate({
					opacity:0,
					left:1025
				},800,function(){
					$("#newPreneurForm").hide();
				});
				
			});

			setInterval(function indexDatos(){
				var nameDay=["Lunes","Martes","Miercoles","Jueves","Viernes","Sábado","Domingo"];
				var nameMonth=["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
				var date=new Date();
				var year=date.getFullYear(),
					mont=date.getMonth()+1,
					mes=(mont<10)?'0'+mont:mont,
					montName=nameMonth[mont],
					day=date.getDate(),
					dia=(day<10)?'0'+day:day,
					dayNum=date.getDay()-1,
					nameDate=(dayNum===-1)?nameDay[6]:nameDay[dayNum],
					hour=date.getHours(),
					hora=(hour<10)?'0'+hour:hour,
					min=date.getMinutes(),
					minut=(min<10)?'0'+min:min,
					second=date.getSeconds(),
					seg=(second<10)?'0'+second:second;
				var finalindexDate=dia+"/"+mes+"/"+year+"-"+hora+":"+minut+":"+seg;
				$("#preneur_user_date").val(finalindexDate);
				console.log(finalindexDate);
				//return finalindexDate;
			},1000);
			

			function randomIdEntrie(){				
				var stringId="";
				var char="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
				for(r=0;r<16;r++){
					var randNum=Math.floor((Math.random()*char.length)+1);
					stringId+=char.charAt(randNum);
				}
				return stringId;
			}
			
			function identifierRandomEntrie(){
					var date=new Date();
					var year=date.getFullYear(),
					mes=date.getMonth(),
					day=date.getDate();
					var random=randomIdEntrie();
					var dayDate=(day<10)?'0'+day:day;
					var monDate=(mes<10)?'0'+mes:mes;
					var identifier=year+"-"+mes+"-"+dayDate+"-"+random;
					
					return identifier;								
			}

			var identifier=identifierRandomEntrie();
			$("#preneur_user_key").val(identifierRandomEntrie());
		
			/*$(".preneur_validar").blur(function(){
				var empty=$(this).val();
				if(empty==0){
					$(this).css({
						'background-color':'rgba(254,25,86,0.9)',
						'color':'rgba(255,255,255,1)'
					});
				}else{
					$(this).css({
						'background-color':'white',
						'color':'inherit'
					});
				}
			});*/

			$("#inAxesLink").click(function(e){
				event.preventDefault(e);
				$("#inAxesForm").show();
				$("#inAxesForm").animate({
					width:"10%"
				},500,"swing");

			});

			function findPass(){
				$.ajax({
				type:"POST",
				url:"probepass.php",
				data:$("form").serialize(),
				success:function(msg){
					if(msg=="1"){
						$("#precarga").slideUp(800);
						$(".inputdisabled").css({
							"opacity":"1",
							"border-color":"green"
						}).removeAttr("disabled");
						$("#resultText").hide(800);
						$("#resultText p").html("");
						$("input[name='probepass']").removeAttr("disabled");
						//$("#passnew").removeAttr("disabled");
						//$("#passchk").removeAttr("disabled");
						//$("#resultText").show(500);
						//$("#resultText p").html(msg);
					}else{
						$("#precarga").slideUp(800);
						$("#resultText").show(500);
						$("#resultText p").html("!Rectifica por favor tus datos¡");
						$(".inputdisabled").attr("disabled","disabled").css("opacity","0.8");
					}
				}
			});
			}

		$("#pass1").click(function(){
			$("#tipspassindex").slideDown(500);
		});

		var Field = function(id,val,type)
			{
				this.fieldId=id;
				this.fieldValue=val;
				this.fieldType=type;
				this.prueba=function(){
					alert(this.fieldId);
				}
			};

			/*var PassValidate()
			{
				this.val,
				this.size,


			};*/

			var nameField = new Field("preneurTextName");
			console.log(nameField.fieldId.value);
			nameField.prueba();

		$("#pass1").keyup(function(){
			$("#passfieldindex").slideDown(500);

			$("#barresultindex").animate({"height":"0.8em"},500,"linear",function(){
				$("#safepasstextindex").animate({"height":"1.5em"},500,"linear");
			});




			var passfield=$("#pass1").val();
			
			var compare=passfield.match(/[a-z]/),
			compare2=passfield.match(/[A-Z]/),
			compare3=passfield.match(/[0-9]/),
			compare4=passfield.match(/[°|¬@!"#$%&\/=?*,;.^'+\-_\\()]/);
			var gradesafe=0;

			if(compare!=null){
				$("#li2in").css("color","rgba(118,228,4,1)");
				gradesafe++;
			}else{
				$("#li2in").css("color","rgba(7,158,196,1)");
				
			}
			if(compare2!=null){
				$("#li3in").css("color","rgba(118,214,29,1)");
				gradesafe++;
			}else{
				$("#li3in").css("color","rgba(7,158,196,1)");

			}
			if(compare3!=null){
				$("#li4in").css("color","rgba(118,214,29,1)");
				gradesafe++;
			}else{
				$("#li4in").css("color","rgba(7,158,196,1)");
			}
			if(compare4!=null){
				$("#li5in").css("color","rgba(118,214,29,1)");
				gradesafe++;
			}else{
				$("#li5in").css("color","rgba(7,158,196,1)");
			}
			if(passfield.length>=8){
				$("#li1in").css("color","rgba(118,214,29,1)");
				gradesafe++;
			}else{
				$("#li1in").css("color","rgba(7,158,196,1)");
			}			
			
			if(gradesafe==2 && passfield.length>=8){
				$("#safepasstextindex").html("¡Contraseña con Bajo grado de seguridad!");
				$("#safepasstextindex").css("color","rgba(232,46,69,1)");
				$("#barresultindex div").animate({"width":"20%"},800,"swing");
			}
			if(gradesafe==3 && passfield.length>=8){
				$("#safepasstextindex").html("¡Contraseña con Aceptable grado de seguridad!");
				$("#safepasstextindex").css("color","orange");
				$("#barresultindex div").animate({"width":"50%"},800).css("background-color","rgba(232,138,27,1)");
			}
			if(gradesafe==4 && passfield.length>=8){
				$("#safepasstextindex").html("¡Contraseña con Buen grado de seguridad!");
				$("#safepasstextindex").css("color","blue");
				$("#barresultindex div").animate({"width":"75%"},800).css("background-color","rgba(0,81,245,1)");
			}
			if(gradesafe==5 && passfield.length>=8){
				$("#safepasstextindex").html("¡Contraseña con Excelente grado de seguridad!");
				$("#safepasstextindex").css("color","green");
				$("#barresultindex div").animate({"width":"100%"},800).css("background-color","rgba(0,255,23,1)");
			}
			if(passfield.length==0 || passfield.length<8){
				$("#safepasstextindex").html("¡Contraseña muy corta, puedes mejorar la Seguridad!");
				$("#safapasstextindex").css("color","rgba(232,0,10,1)");	
				$("#barresultindex div").animate({"width":"5%"},500,"linear").css("background-color","rgba(232,0,10,1)");			
			}
			//arregalr que al borrar la contraseña se baje la barra de seguridad.

		});

		$("#pass2").focusout(function(e){
			e.preventDefault();
			var pass1=$("#pass1").val();
			var pass2=$("#pass2").val();
			console.log(pass1);
			console.log(pass2);
			 if(pass1==pass2 && pass1!==""){
			 	$("#pass1").attr("disabled","disabled").addClass("disabled");
			 	$("#pass2").attr("disabled","disabled");
			 	$("#precarga").show(800);
			 	$("#tipspassindex").slideUp(500);
			 	$("#resultpassin").show();
			 	$("#resultpassin").html("!Tu pase de seguridad ha sido creado. Acceso Concedido¡");			 	
			
				//window.setTimeout(actuaPass,8000);

			 }else{
			 	$("#precarga").show(800);
			 	$("#tipspassindex").slideUp(500);
			 	$("#resultpassin").show();
			 	$("#resultpassin").html("!Verifica tus contraseñas. Acceso Denegado¡");
			 }


		});

		//Validar los campos de datos Registro

		$("#preneurTextName").focusout(function()
		{
			var valName=$("#preneurTextName").val();
			var validate1=valName.match(/[A-Za-z]{2,}/),
			validate2=valName.match(/[0-9]/),
			validate3=valName.match(/\s$/);
			if(validate1==null)
			{
				$("#preneurTextName").focus();
				$("#preneurTextName").css({
					'border-color':'rgba(254,25,86,0.9)',
					'border-width':'5px'
				});					
			}else
			{
				$("#preneurTextName").css({
						'border-color':'rgba(0,0,0,1)',
						'border-width':'2px'
					});
			}
			if(validate2!=null)
			{
				$("#preneurTextName").focus();
				$(this).css({
					'border-color':'rgba(254,25,86,0.9)',
					'border-width':'5px'
				});					
			}else{
				$(this).css({
						'border-color':'rgba(0,0,0,1)',
						'border-width':'2px'
					});
			}				
			
			if(validate3!=null)
			{
				$("#preneurTextName").focus();
				$(this).css({
					'border-color':'rgba(254,25,86,0.9)',
					'border-width':'5px'
				});					
			}else{
				$(this).css({
						'border-color':'rgba(0,0,0,1)',
						'border-width':'2px'
					});
			}					
			

		});

		/*var valLast=$("#preneurTextLast").val();
		$("#preneurTextLast").focusout(function()
		{		
			var valLast=$("#preneurTextLast").val();
			if(valLast.match(/[A-Za-z]{2,}/)==null)
			{
				$("#preneurTextLast").focus();
				$(this).css({
						'background-color':'rgba(254,25,86,0.9)',
						'color':'rgba(255,255,255,1)'
					});														
			}
			if(valLast.match(/[0-9]/)!=null)
			{
				$("#preneurTextLast").focus();
			}
			if(valLast.match(/\s$/)!=null)
			{
				$("#preneurTextLast").focus();
			}
			

		});*/

		});

			/*var linumber=$("#preHeaderNav li").size();
			console.log(linumber);
			if(linumber==2){
				$("#preHeaderNav").css('margin-left', '20em');
			}else{
				$("#preHeaderNav").css('margin-left', '11em');
			}
*/

		