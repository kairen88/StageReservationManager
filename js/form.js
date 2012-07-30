		function loadDatePicker()
		{
			$(function() {
				$( "#datepicker" ).datepicker({
					showOn: "both",
					buttonImage: "images/calendar.gif",
					buttonImageOnly: true,
					dateFormat: "yy-mm-dd",
					onSelect: function(dateText, inst) {
					$( "#datepicker2" ).datepicker( "setDate" , $('#datepicker').val() );
					}
				});
			});

			$(function() {
			 date2=new Date($('#datepicker').val());
				$( "#datepicker2" ).datepicker({
					showOn: "both",
					buttonImage: "images/calendar.gif",
					buttonImageOnly: true,
					dateFormat: "yy-mm-dd",
				});


			});
		}
		
		
		
		function loadStageNameSelector()
		{
			$.getJSON('displayStage.php', function(stages) {
			
			stageNameSelector = document.getElementById("stageNameSelector");
			
			idx = 1;
			for(stage in stages)
				{
					stageOption = new Option;
					stageOption.text = stages[stage].name;
					stageOption.value = stages[stage].name;
					stageNameSelector.options[idx] = (stageOption);
					idx ++;
				}

			});
		}
		
		function loadSpecId()
		{
			$.getJSON('specDropDown.php', function(specDetails) {
	
		specID = new Array();
		specName = new Array();
		
		for(spec in specDetails)
		{
			specID.push(specDetails[spec].spec_id);
			specName.push(specDetails[spec].spec_name);
		}
		
	
		//ary = new Array("c++", "java", "php", "coldfusion", "javascript", "asp", "ruby");
		$(document).ready(function() {
			$("input#specName").autocomplete({
			source: specName,
			
			select: function( event, ui ) {
				for(spec in specDetails)
					if(ui.item.value == specDetails[spec].spec_name)
						$("input#specId").val(specDetails[spec].spec_id);
			}
			
			});
			
			$("input#specId").autocomplete({
			source: specID,
			
			select: function( event, ui ) {
				for(spec in specDetails)
					if(ui.item.value == specDetails[spec].spec_id)
						$("input#specName").val(specDetails[spec].spec_name);
			}
			
			
			});
		});
	
	});
		}
		
	//	function init()
	//	{
	//		loadStageNameSelector()
	//		loadSpecId()
	//		loadDatePicker()
	//	}
		

		
		//window.onload = init;
		
		function submitForm()
		{
			alert("Validation in progress...");
		
			var new_from_date=document.forms['sample']['dateFrom'].value;
			var new_to_date=document.forms['sample']['dateTo'].value;
			var stage=document.forms['sample']['stageName'].value;
			
			curr_date=new Date();
			from_date=new Date(new_from_date);			
			
			//reservation from/to date validation
			if(new_from_date > new_to_date || (curr_date>from_date) )
			{
				alert("Invalid reservation period");
				return;
			}
			else
			{
				//spec name/id validation			
				$.getJSON('specDropDown.php', function(table)
				{
					var isSpecDetailValid=1;
					for(row in table)
					{ 
						if( table[row].spec_name==document.forms['sample']['specName'].value && table[row].spec_id==document.forms['sample']['specId'].value)
							isSpecDetailValid=0;
					}
					
					if(isSpecDetailValid)
					{
						alert("Spec details invalid.");
						return ;
					}
					else
					{
						//existing reservation validation
						$.getJSON('display.php', function(table)
						{
							var isOverwritten = 0;
							for(row in table)
							{
								if( table[row].status=='R' && table[row].stage_name==stage && (
								(table[row].date_reserved_from>=new_from_date && table[row].date_reserved_to<=new_to_date) ||
								(table[row].date_reserved_from>=new_from_date && table[row].date_reserved_to>=new_to_date) ||
								(table[row].date_reserved_from<=new_from_date && table[row].date_reserved_to<=new_to_date) ||
								(table[row].date_reserved_from<new_from_date && table[row].date_reserved_to>new_to_date) ))
									{
										if(table[row].spec_name==document.forms['sample']['specName'].value && table[row].date_reserved_from==new_from_date && table[row].date_reserved_to==new_to_date)
											isOverwritten = 2;
										else
											isOverwritten = 1; 
									}				
							}

							if(isOverwritten>0)
							{
							
								if(isOverwritten==2)
									alert("Reservation for this spec exists for the same period.");
									
								else if(confirm("Do you wish to overwrite an existing reservation?"))
									{
										//post reservation
										$.ajax({type:'POST', url: 'reserve.php', data:$('#reservationForm').serialize(), success: function(response) 
										{
											alert(response);
										}});
									}
								return;
							}
							else
							{
								//post reservation
								$.ajax({type:'POST', url: 'reserve.php', data:$('#reservationForm').serialize(), success: function(response) 
								{
									alert(response);
								}});
							}
						});
					}
				});
			}
			
			
			
			
			
			
		}