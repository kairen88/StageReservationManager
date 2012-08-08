//fix to remove month column
//replace code in function populateTable
//in view.html or index.html


//creating table
			//creating table attributes
			colmodelAry = new Array();	
			colnames = new Array();

			//creating month and day column models
			//monthModel = new createColModelObj("month", "center"); //removing month column
			dayModel = new createColModelObj("day", "center");
			//colnames.push("Month", "Day");//removing month column
			colnames.push("Day");
			
			//colmodelAry.push(monthModel); //removing month column
			colmodelAry.push(dayModel);