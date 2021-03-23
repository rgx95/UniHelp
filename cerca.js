		//quando il caricamento giunge a questo punto della pagina, imposto una funzione che sarà eseguita alla fine del caricamento della pagina $(document).ready(function(){});
		var flagCerca = false;
		var flagUni = false;
		var vettoreInput=[];
		var vettoreDiv=[];
		function cercaSetup() {	
		
			for (let i=0, input, nomeRicerca; i < $("input[cerca]").length; i++){
				input = $("input[cerca]")[i];
				nomeRicerca = $("input[cerca]")[i].getAttribute("cerca");
				
				input.setAttribute("id", "inputCerca"+i+nomeRicerca);
				vettoreInput.push("inputCerca"+i+nomeRicerca);
				//STILE ELEMENTI RICERCA UNIVERSITA E CORSO
				let tmpDiv = document.createElement("div");
				
				tmpDiv.setAttribute("id", "divCerca"+i+nomeRicerca);
				vettoreDiv.push("divCerca"+i+nomeRicerca);
				tmpDiv.setAttribute("class", "list-group");
				tmpDiv.setAttribute("style", "position:absolute; width:100%; z-index:99; display:block");
				
				input.after(tmpDiv);
				
				//input.setAttribute("onblur", "$('#divCerca"+i+nomeRicerca+"').hide()");
				input.setAttribute("onclick", "$('#divCerca"+i+nomeRicerca+"').show()");
				input.setAttribute("oninput", "cerca('"+nomeRicerca+"', this.value, 'divCerca"+i+nomeRicerca+"')");
			}
			flagCerca = true;
		}
		
		function cerca(tabella = "", cosa = "", idDiv = "")
		{	
			if (!flagCerca)
				cercaSetup();
			
			$("#" + idDiv).empty(); 
			
			if (tabella == "" || cosa == "" || idDiv == "")
				return;														
			
			let tabellaValue = ["universita, corso, esame"];
			let i;
			
			for (i = 0; i < tabellaValue.length + 1; i++)
				if (tabellaValue[i] == tabella)
					break;
				
			if (i >= tabellaValue.lenght)
				return;
			
			cosa = encodeURI(cosa);
			
			$.get("cerca.php?tabella=" + tabella + "&cosa=" + cosa, function(data, status){
				if (status !== "success" && data !== null)
					return;
				
				$("#" + idDiv).show();
				
				// window.alert(data);
				data = JSON.parse(data);
				
				/*if (data.length === 0){
					$("#divCercaUni").hide();
					return;
				}*/
				/*
				data.forEach(function(val){
					$("#" + idDiv).append("<a href='' class='list-group-item'>" + val + "</a>");
				});*/
				$("#" + idDiv).append("<a style=\"cursor:pointer\" class=\"list-group-item\" onclick=\"riempi('"+data[0]+"','"+tabella+"');$('#"+idDiv+"').hide();\">" + data[0] + "</a>");
				});
		}
		//,"+idDiv+" 
		function riempi(valore, tabella) {
			$("input[cerca='"+tabella+"']").val(valore);
			$("input[cerca='"+tabella+"']").click(function(){
				$("input[cerca='"+tabella+"']").val("");
				flagUni = false;
			});
			flagUni = true;
			
		}
		
		function svuota()
		{
			
		}