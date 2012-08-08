// when setting default date, eg "2012-8", parseInt(s[0]) in monthpicker.min.js
//has problem parsing 08 and returns 0 instead of 8
//therefore set month as 8 instead of 08 eg. "2012-8"

//repalce this code in view.html or index.html


function loadMonthBar()
{
	$(function(){		

		currentDate = new Date();
		currentYear = currentDate.getFullYear();
		currentMonth = currentDate.getMonth() + 1;
		
		DisplayMonth = currentYear + '-' + currentMonth
		
		$("#MonthPicker").monthpicker(DisplayMonth, callback,{
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