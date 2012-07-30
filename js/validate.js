/*
 * http://github.com/davist11/jQuery-Simple-Validate
 *
 * Copyright (c) 2010 Trevor Davis 
 * Dual licensed under the MIT and GPL licenses.
 * Uses the same license as jQuery, see:
 * http://jquery.org/license
 *
 * @version 0.1
 */
;(function(b){b.fn.simpleValidate=function(l){var g=b.extend({},b.fn.simpleValidate.defaults,l);return this.each(function(){var d=b(this),a=b.meta?b.extend({},g,d.data()):g,h=a.errorText.search(/{label}/);d.bind("submit",function(i){var f=false;d.find(a.errorElement+"."+a.errorClass).remove();d.find(":input."+a.inputErrorClass).removeClass(a.inputErrorClass);d.find(":input.required").each(function(){var e=b(this),j=b.trim(e.val()),k=e.siblings("label").text().replace(a.removeLabelChar,""),c="";if(j===
""){c=h>-1?(c=a.errorText.replace("{label}",k)):(c=a.errorText);f=true}else if(e.hasClass("email"))if(!/^([_a-z0-9-]+)(\.[_a-z0-9-]+)*@([a-z0-9-]+)(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/.test(j)){c=h>-1?(c=a.emailErrorText.replace("{label}",k)):(c=a.emailErrorText);f=true}c!==""&&e.addClass(a.inputErrorClass).after("<"+a.errorElement+' class="'+a.errorClass+'">'+c+"</"+a.errorElement+">")});if(f)i.preventDefault();else if(a.completeCallback!==""){a.completeCallback(d);a.ajaxRequest&&i.preventDefault()}})})};
b.fn.simpleValidate.defaults={errorClass:"error",errorText:"{label} is a required field.",emailErrorText:"Please enter a valid {label}",errorElement:"strong",removeLabelChar:"*",inputErrorClass:"",completeCallback:"",ajaxRequest:false}})(jQuery);