//add this function in view.html or index.html

<div class="MonthPicker" id="MonthPicker" style="width:100%;" align="center"></div>


//add this function in view.html or index.html
//add this function call to init() function

function suppressTooltip()
{
	// Suppress tooltip display for links that have the classname 'suppress'
	var links = document.getElementsByTagName('a');
	for (var i = 0; i < links.length; i++) {
		if (links[i].className == 'suppress') {
			links[i]._title = links[i].title;
			links[i].onmouseover = function() { 
				this.title = '';
			}
			links[i].onmouseout = function() { 
				this.title = this._title;
			}
		}
	}

}



//replace this code in monthpicker.min.js

} else if (tpl.type == "button") {
                var $items = jQuery('<td class="month"></td>');
                for (var i = 0; i < range.length; i++) {
                    className = (tpl.value == range[i]) ? "selected" : "";
                    jQuery('<a href="javascript:;" title="' + range[i] + '"' + 'class="suppress"' + '><span class="' + className + '">' + text[i] + '</span></a>').click(function () { //added suppress class to allow title hover to be suppressed
                        var $this = jQuery(this);
                        var value = $this.attr('title');
                        $this.parent().find('span').removeClass('selected');
                        $this.find('span').addClass('selected');
                        update(tpl.key, value, this);
                    }).appendTo($items);
                }
                $body.append('<th class="caption">' + tpl.caption + '</th>').append($items);
            }