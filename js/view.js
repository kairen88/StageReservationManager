
function createTable(monthSelected)
{

	if (!document.getElementsByTagName) return;

	

	tableDiv=document.getElementById("table");
	//clear the div
	emptyDiv(tableDiv)
	
	table = document.createElement("table");
	table.setAttribute('id','reservationList');
	
	pager = document.createElement("div");
	pager.setAttribute('id','pager');
	
	tableDiv.appendChild(table);
	tableDiv.appendChild(pager);
	
	$.getJSON('/displayStage.php', function(stages) {

		stageArray = new Array();
		
		for(stage in stages)
		{
			stageArray.push(stages[stage].name);
		}
		
		populateTable(monthSelected, stageArray);		
	});
	
	
}

function populateTable(monthSelected, stageArray)
{
	$.getJSON('/display.php', function(table) {

		//need to get month to display from user
		var objMonth = new Date(monthSelected);
		var objMonthEnd = new Date(monthSelected);
		
		daysPerMonth = DaysInMonth(objMonth.getFullYear(), objMonth.getMonth()+1);//month starts from 0		
		objMonthEnd.setDate(objMonthEnd.getDate()+ daysPerMonth);
		
		tableData = new Array();
		
		for(var day = objMonth; day < objMonthEnd; day.setDate(day.getDate()+1) )
		{
			ary = {};
			ary["month"] = objMonth.toString("MMMM");
			ary["day"] = day.getDate();
			specNameAry = new Array();	
			
			//loop through reservation table
			for(row in table)
			{
				var dateFrom = new Date(table[row].date_reserved_from);
				var dateTo = new Date(table[row].date_reserved_to);
				
				//need to check if status is R or U
				if(table[row].status == "R");
				{
					//current day is within stage reserved period
					if(day >= dateFrom && day <= dateTo)
					{
						ary[table[row].stage_name.toString()] = table[row].spec_id + '\n' + table[row].spec_name;
					}else
					{
						ary[table[row].stage_name.toString()] = "" ;
					}	
				}
			}

			tableData.push(ary);
		}	
			
			//creating table
			//creating table attributes
			colmodelAry = new Array();	
			colnames = new Array();

			//creating month and day column models
			monthModel = new createColModelObj("month", "center");
			dayModel = new createColModelObj("day", "center");
			colnames.push("Month", "Day");
			
			colmodelAry.push(monthModel);
			colmodelAry.push(dayModel);
	
			//populating table attributes
			for(stage in stageArray)
			{
				model = new createColModelObj(stageArray[stage], "center");
				colmodelAry.push(model);
				colnames.push(stageArray[stage]);
			}
			
			loadTable(colnames, colmodelAry, tableData)	
	});
}

function loadTable(colnames, colmodel, tableData)
{
var mydata = tableData,

                grid = $("#reservationList");



            grid.jqGrid({

				rowNum:31,
				
                datatype:'local',

                colNames:colnames,

                colModel:colmodel,

                pager: '#pager',

                viewrecords: true,
				
				autowidth: false,
shrinkToFit: true,

                caption:'Stage Reservation List',
				
                height: '100%'

            });

            grid.jqGrid ('navGrid', '#pager',

                         {edit:false, add:false, del:false, refresh:true, view:false},

                         {},{},{},{multipleSearch:true,overlay:false});

            grid.jqGrid ('navButtonAdd', '#pager',

                         {

                             caption: "", buttonicon: "ui-icon-calculator", title: "choose columns",

                             onClickButton: function() {

                                 grid.jqGrid('columnChooser');

                            }

                         });
			//grid.setGridWidth(780,true);
			 
			for(var i=0;i<=tableData.length;i++)
				jQuery("#reservationList").jqGrid('addRowData',i+1,tableData[i]);
}

function createColModelObj(name, align)
{
	var colModel = {
						name: name,
						index: name,
						width: 100,
						align: align
					}
	return colModel				
}

function loadMonthBar()
{
	$(function(){		

		currentYear = new Date().getFullYear();
		
		$("#MonthPicker").monthpicker({
										elements: [
											{tpl:"year",opt:{

												range: "-0~4",
												value: currentYear
											}},
											{tpl:"month",opt:{

												value: 1
											}}
											

										],
										onChanged: callback
									});		
		
		});
}
	
function callback(data,$e){
	var str = "";
	for(key in data) {
		str += " " + key + ": " + data[key]+ "; ";
	}
	
	monthSelected = data["year"] + '-' + '0' + data["month"] + '-' + "01";
	//alert(monthSelected);

	if(data["year"] == '2012' && data["month"] < '7')	
		{
			tableDiv=document.getElementById("table");
			//clear the div
			emptyDiv(tableDiv)
			
			msgDiv = document.createElement("div");
			divText= document.createTextNode("No Data Avaliable For This Month");
			msgDiv.setAttribute('id','msgDiv');
			
			msgDiv.appendChild(divText);
			tableDiv.appendChild(msgDiv);
		}
	else
			createTable(monthSelected);
}

function emptyDiv (divToClear){
	var i;
	while (i=divToClear.childNodes[0])
	{
		if (i.nodeType == 1 || i.nodeType == 3)
		{
			divToClear.removeChild(i);
		}
	}		
}

function DaysInMonth(y,m) { return new Date(y,m,0).getDate(); }

function tableInIt()
{
	current = new Date();
	month = current.getMonth();
	month = month + 1;
	createTable(current.getFullYear() + '-' + '0' + month + '-' + "01")
	
}

function init()
		{
			loadMonthBar()
			tableInIt()
		}
		
window.onload = init;