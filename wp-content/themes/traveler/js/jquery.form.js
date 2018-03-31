!function(a){"use strict";"function"==typeof define&&define.amd?define(["jquery"],a):a("undefined"!=typeof jQuery?jQuery:window.Zepto)}(function(a){"use strict";function d(b){var c=b.data;b.isDefaultPrevented()||(b.preventDefault(),a(b.target).ajaxSubmit(c))}function e(b){var c=b.target,d=a(c);if(!d.is("[type=submit],[type=image]")){var e=d.closest("[type=submit]");if(0===e.length)return;c=e[0]}var f=this;if(f.clk=c,"image"==c.type)if(void 0!==b.offsetX)f.clk_x=b.offsetX,f.clk_y=b.offsetY;else if("function"==typeof a.fn.offset){var g=d.offset();f.clk_x=b.pageX-g.left,f.clk_y=b.pageY-g.top}else f.clk_x=b.pageX-c.offsetLeft,f.clk_y=b.pageY-c.offsetTop;setTimeout(function(){f.clk=f.clk_x=f.clk_y=null},100)}function f(){if(a.fn.ajaxSubmit.debug){var b="[jquery.form] "+Array.prototype.join.call(arguments,"");window.console&&window.console.log?window.console.log(b):window.opera&&window.opera.postError&&window.opera.postError(b)}}var b={};b.fileapi=void 0!==a("<input type='file'/>").get(0).files,b.formdata=void 0!==window.FormData;var c=!!a.fn.prop;a.fn.attr2=function(){if(!c)return this.attr.apply(this,arguments);var a=this.prop.apply(this,arguments);return a&&a.jquery||"string"==typeof a?a:this.attr.apply(this,arguments)},a.fn.ajaxSubmit=function(d){function B(b){var g,h,c=a.param(b,d.traditional).split("&"),e=c.length,f=[];for(g=0;e>g;g++)c[g]=c[g].replace(/\+/g," "),h=c[g].split("="),f.push([decodeURIComponent(h[0]),decodeURIComponent(h[1])]);return f}function C(b){for(var c=new FormData,f=0;f<b.length;f++)c.append(b[f].name,b[f].value);if(d.extraData){var g=B(d.extraData);for(f=0;f<g.length;f++)g[f]&&c.append(g[f][0],g[f][1])}d.data=null;var h=a.extend(!0,{},a.ajaxSettings,d,{contentType:!1,processData:!1,cache:!1,type:e||"POST"});d.uploadProgress&&(h.xhr=function(){var b=a.ajaxSettings.xhr();return b.upload&&b.upload.addEventListener("progress",function(a){var b=0,c=a.loaded||a.position,e=a.total;a.lengthComputable&&(b=Math.ceil(c/e*100)),d.uploadProgress(a,c,e,b)},!1),b}),h.data=null;var i=h.beforeSend;return h.beforeSend=function(a,b){d.formData?b.data=d.formData:b.data=c,i&&i.call(this,a,b)},a.ajax(h)}function D(b){function y(a){var b=null;try{a.contentWindow&&(b=a.contentWindow.document)}catch(c){f("cannot get iframe.contentWindow document: "+c)}if(b)return b;try{b=a.contentDocument?a.contentDocument:a.document}catch(c){f("cannot get iframe.contentDocument: "+c),b=a.document}return b}function B(){function j(){try{var a=y(p).readyState;f("state = "+a),a&&"uninitialized"==a.toLowerCase()&&setTimeout(j,50)}catch(b){f("Server abort: ",b," (",b.name,")"),G(x),u&&clearTimeout(u),u=void 0}}var b=i.attr2("target"),c=i.attr2("action"),d="multipart/form-data",h=i.attr("enctype")||i.attr("encoding")||d;g.setAttribute("target",n),(!e||/post/i.test(e))&&g.setAttribute("method","POST"),c!=k.url&&g.setAttribute("action",k.url),k.skipEncodingOverride||e&&!/post/i.test(e)||i.attr({encoding:"multipart/form-data",enctype:"multipart/form-data"}),k.timeout&&(u=setTimeout(function(){t=!0,G(w)},k.timeout));var l=[];try{if(k.extraData)for(var m in k.extraData)k.extraData.hasOwnProperty(m)&&(a.isPlainObject(k.extraData[m])&&k.extraData[m].hasOwnProperty("name")&&k.extraData[m].hasOwnProperty("value")?l.push(a('<input type="hidden" name="'+k.extraData[m].name+'">').val(k.extraData[m].value).appendTo(g)[0]):l.push(a('<input type="hidden" name="'+m+'">').val(k.extraData[m]).appendTo(g)[0]));k.iframeTarget||o.appendTo("body"),p.attachEvent?p.attachEvent("onload",G):p.addEventListener("load",G,!1),setTimeout(j,15);try{g.submit()}catch(q){var r=document.createElement("form").submit;r.apply(g)}}finally{g.setAttribute("action",c),g.setAttribute("enctype",h),b?g.setAttribute("target",b):i.removeAttr("target"),a(l).remove()}}function G(b){if(!q.aborted&&!F){if(D=y(p),D||(f("cannot access response document"),b=x),b===w&&q)return q.abort("timeout"),void v.reject(q,"timeout");if(b==x&&q)return q.abort("server abort"),void v.reject(q,"error","server abort");if(D&&D.location.href!=k.iframeSrc||t){p.detachEvent?p.detachEvent("onload",G):p.removeEventListener("load",G,!1);var d,c="success";try{if(t)throw"timeout";var e="xml"==k.dataType||D.XMLDocument||a.isXMLDoc(D);if(f("isXml="+e),!e&&window.opera&&(null===D.body||!D.body.innerHTML)&&--E)return f("requeing onLoad callback, DOM not available"),void setTimeout(G,250);var g=D.body?D.body:D.documentElement;q.responseText=g?g.innerHTML:null,q.responseXML=D.XMLDocument?D.XMLDocument:D,e&&(k.dataType="xml"),q.getResponseHeader=function(a){var b={"content-type":k.dataType};return b[a.toLowerCase()]},g&&(q.status=Number(g.getAttribute("status"))||q.status,q.statusText=g.getAttribute("statusText")||q.statusText);var h=(k.dataType||"").toLowerCase(),i=/(json|script|text)/.test(h);if(i||k.textarea){var j=D.getElementsByTagName("textarea")[0];if(j)q.responseText=j.value,q.status=Number(j.getAttribute("status"))||q.status,q.statusText=j.getAttribute("statusText")||q.statusText;else if(i){var l=D.getElementsByTagName("pre")[0],n=D.getElementsByTagName("body")[0];l?q.responseText=l.textContent?l.textContent:l.innerText:n&&(q.responseText=n.textContent?n.textContent:n.innerText)}}else"xml"==h&&!q.responseXML&&q.responseText&&(q.responseXML=H(q.responseText));try{C=J(q,h,k)}catch(r){c="parsererror",q.error=d=r||c}}catch(r){f("error caught: ",r),c="error",q.error=d=r||c}q.aborted&&(f("upload aborted"),c=null),q.status&&(c=q.status>=200&&q.status<300||304===q.status?"success":"error"),"success"===c?(k.success&&k.success.call(k.context,C,"success",q),v.resolve(q.responseText,"success",q),m&&a.event.trigger("ajaxSuccess",[q,k])):c&&(void 0===d&&(d=q.statusText),k.error&&k.error.call(k.context,q,c,d),v.reject(q,"error",d),m&&a.event.trigger("ajaxError",[q,k,d])),m&&a.event.trigger("ajaxComplete",[q,k]),m&&!--a.active&&a.event.trigger("ajaxStop"),k.complete&&k.complete.call(k.context,q,c),F=!0,k.timeout&&clearTimeout(u),setTimeout(function(){k.iframeTarget?o.attr("src",k.iframeSrc):o.remove(),q.responseXML=null},100)}}}var h,j,k,m,n,o,p,q,r,s,t,u,g=i[0],v=a.Deferred();if(v.abort=function(a){q.abort(a)},b)for(j=0;j<l.length;j++)h=a(l[j]),c?h.prop("disabled",!1):h.removeAttr("disabled");if(k=a.extend(!0,{},a.ajaxSettings,d),k.context=k.context||k,n="jqFormIO"+(new Date).getTime(),k.iframeTarget?(o=a(k.iframeTarget),s=o.attr2("name"),s?n=s:o.attr2("name",n)):(o=a('<iframe name="'+n+'" src="'+k.iframeSrc+'" />'),o.css({position:"absolute",top:"-1000px",left:"-1000px"})),p=o[0],q={aborted:0,responseText:null,responseXML:null,status:0,statusText:"n/a",getAllResponseHeaders:function(){},getResponseHeader:function(){},setRequestHeader:function(){},abort:function(b){var c="timeout"===b?"timeout":"aborted";f("aborting upload... "+c),this.aborted=1;try{p.contentWindow.document.execCommand&&p.contentWindow.document.execCommand("Stop")}catch(d){}o.attr("src",k.iframeSrc),q.error=c,k.error&&k.error.call(k.context,q,c,b),m&&a.event.trigger("ajaxError",[q,k,c]),k.complete&&k.complete.call(k.context,q,c)}},m=k.global,m&&0===a.active++&&a.event.trigger("ajaxStart"),m&&a.event.trigger("ajaxSend",[q,k]),k.beforeSend&&k.beforeSend.call(k.context,q,k)===!1)return k.global&&a.active--,v.reject(),v;if(q.aborted)return v.reject(),v;r=g.clk,r&&(s=r.name,s&&!r.disabled&&(k.extraData=k.extraData||{},k.extraData[s]=r.value,"image"==r.type&&(k.extraData[s+".x"]=g.clk_x,k.extraData[s+".y"]=g.clk_y)));var w=1,x=2,z=a("meta[name=csrf-token]").attr("content"),A=a("meta[name=csrf-param]").attr("content");A&&z&&(k.extraData=k.extraData||{},k.extraData[A]=z),k.forceSync?B():setTimeout(B,10);var C,D,F,E=50,H=a.parseXML||function(a,b){return window.ActiveXObject?(b=new ActiveXObject("Microsoft.XMLDOM"),b.async="false",b.loadXML(a)):b=(new DOMParser).parseFromString(a,"text/xml"),b&&b.documentElement&&"parsererror"!=b.documentElement.nodeName?b:null},I=a.parseJSON||function(a){return window.eval("("+a+")")},J=function(b,c,d){var e=b.getResponseHeader("content-type")||"",f="xml"===c||!c&&e.indexOf("xml")>=0,g=f?b.responseXML:b.responseText;return f&&"parsererror"===g.documentElement.nodeName&&a.error&&a.error("parsererror"),d&&d.dataFilter&&(g=d.dataFilter(g,c)),"string"==typeof g&&("json"===c||!c&&e.indexOf("json")>=0?g=I(g):("script"===c||!c&&e.indexOf("javascript")>=0)&&a.globalEval(g)),g};return v}if(!this.length)return f("ajaxSubmit: skipping submit process - no element selected"),this;var e,g,h,i=this;"function"==typeof d?d={success:d}:void 0===d&&(d={}),e=d.type||this.attr2("method"),g=d.url||this.attr2("action"),h="string"==typeof g?a.trim(g):"",h=h||window.location.href||"",h&&(h=(h.match(/^([^#]+)/)||[])[1]),d=a.extend(!0,{url:h,success:a.ajaxSettings.success,type:e||a.ajaxSettings.type,iframeSrc:/^https/i.test(window.location.href||"")?"javascript:false":"about:blank"},d);var j={};if(this.trigger("form-pre-serialize",[this,d,j]),j.veto)return f("ajaxSubmit: submit vetoed via form-pre-serialize trigger"),this;if(d.beforeSerialize&&d.beforeSerialize(this,d)===!1)return f("ajaxSubmit: submit aborted via beforeSerialize callback"),this;var k=d.traditional;void 0===k&&(k=a.ajaxSettings.traditional);var m,l=[],n=this.formToArray(d.semantic,l);if(d.data&&(d.extraData=d.data,m=a.param(d.data,k)),d.beforeSubmit&&d.beforeSubmit(n,this,d)===!1)return f("ajaxSubmit: submit aborted via beforeSubmit callback"),this;if(this.trigger("form-submit-validate",[n,this,d,j]),j.veto)return f("ajaxSubmit: submit vetoed via form-submit-validate trigger"),this;var o=a.param(n,k);m&&(o=o?o+"&"+m:m),"GET"==d.type.toUpperCase()?(d.url+=(d.url.indexOf("?")>=0?"&":"?")+o,d.data=null):d.data=o;var p=[];if(d.resetForm&&p.push(function(){i.resetForm()}),d.clearForm&&p.push(function(){i.clearForm(d.includeHidden)}),!d.dataType&&d.target){var q=d.success||function(){};p.push(function(b){var c=d.replaceTarget?"replaceWith":"html";a(d.target)[c](b).each(q,arguments)})}else d.success&&p.push(d.success);if(d.success=function(a,b,c){for(var e=d.context||this,f=0,g=p.length;g>f;f++)p[f].apply(e,[a,b,c||i,i])},d.error){var r=d.error;d.error=function(a,b,c){var e=d.context||this;r.apply(e,[a,b,c,i])}}if(d.complete){var s=d.complete;d.complete=function(a,b){var c=d.context||this;s.apply(c,[a,b,i])}}var t=a("input[type=file]:enabled",this).filter(function(){return""!==a(this).val()}),u=t.length>0,v="multipart/form-data",w=i.attr("enctype")==v||i.attr("encoding")==v,x=b.fileapi&&b.formdata;f("fileAPI :"+x);var z,y=(u||w)&&!x;d.iframe!==!1&&(d.iframe||y)?d.closeKeepAlive?a.get(d.closeKeepAlive,function(){z=D(n)}):z=D(n):z=(u||w)&&x?C(n):a.ajax(d),i.removeData("jqxhr").data("jqxhr",z);for(var A=0;A<l.length;A++)l[A]=null;return this.trigger("form-submit-notify",[this,d]),this},a.fn.ajaxForm=function(b){if(b=b||{},b.delegation=b.delegation&&a.isFunction(a.fn.on),!b.delegation&&0===this.length){var c={s:this.selector,c:this.context};return!a.isReady&&c.s?(f("DOM not ready, queuing ajaxForm"),a(function(){a(c.s,c.c).ajaxForm(b)}),this):(f("terminating; zero elements found by selector"+(a.isReady?"":" (DOM not ready)")),this)}return b.delegation?(a(document).off("submit.form-plugin",this.selector,d).off("click.form-plugin",this.selector,e).on("submit.form-plugin",this.selector,b,d).on("click.form-plugin",this.selector,b,e),this):this.ajaxFormUnbind().bind("submit.form-plugin",b,d).bind("click.form-plugin",b,e)},a.fn.ajaxFormUnbind=function(){return this.unbind("submit.form-plugin click.form-plugin")},a.fn.formToArray=function(c,d){var e=[];if(0===this.length)return e;var i,f=this[0],g=this.attr("id"),h=c?f.getElementsByTagName("*"):f.elements;if(h&&!/MSIE [678]/.test(navigator.userAgent)&&(h=a(h).get()),g&&(i=a(':input[form="'+g+'"]').get(),i.length&&(h=(h||[]).concat(i))),!h||!h.length)return e;var j,k,l,m,n,o,p;for(j=0,o=h.length;o>j;j++)if(n=h[j],l=n.name,l&&!n.disabled)if(c&&f.clk&&"image"==n.type)f.clk==n&&(e.push({name:l,value:a(n).val(),type:n.type}),e.push({name:l+".x",value:f.clk_x},{name:l+".y",value:f.clk_y}));else if(m=a.fieldValue(n,!0),m&&m.constructor==Array)for(d&&d.push(n),k=0,p=m.length;p>k;k++)e.push({name:l,value:m[k]});else if(b.fileapi&&"file"==n.type){d&&d.push(n);var q=n.files;if(q.length)for(k=0;k<q.length;k++)e.push({name:l,value:q[k],type:n.type});else e.push({name:l,value:"",type:n.type})}else null!==m&&"undefined"!=typeof m&&(d&&d.push(n),e.push({name:l,value:m,type:n.type,required:n.required}));if(!c&&f.clk){var r=a(f.clk),s=r[0];l=s.name,l&&!s.disabled&&"image"==s.type&&(e.push({name:l,value:r.val()}),e.push({name:l+".x",value:f.clk_x},{name:l+".y",value:f.clk_y}))}return e},a.fn.formSerialize=function(b){return a.param(this.formToArray(b))},a.fn.fieldSerialize=function(b){var c=[];return this.each(function(){var d=this.name;if(d){var e=a.fieldValue(this,b);if(e&&e.constructor==Array)for(var f=0,g=e.length;g>f;f++)c.push({name:d,value:e[f]});else null!==e&&"undefined"!=typeof e&&c.push({name:this.name,value:e})}}),a.param(c)},a.fn.fieldValue=function(b){for(var c=[],d=0,e=this.length;e>d;d++){var f=this[d],g=a.fieldValue(f,b);null===g||"undefined"==typeof g||g.constructor==Array&&!g.length||(g.constructor==Array?a.merge(c,g):c.push(g))}return c},a.fieldValue=function(b,c){var d=b.name,e=b.type,f=b.tagName.toLowerCase();if(void 0===c&&(c=!0),c&&(!d||b.disabled||"reset"==e||"button"==e||("checkbox"==e||"radio"==e)&&!b.checked||("submit"==e||"image"==e)&&b.form&&b.form.clk!=b||"select"==f&&-1==b.selectedIndex))return null;if("select"==f){var g=b.selectedIndex;if(0>g)return null;for(var h=[],i=b.options,j="select-one"==e,k=j?g+1:i.length,l=j?g:0;k>l;l++){var m=i[l];if(m.selected){var n=m.value;if(n||(n=m.attributes&&m.attributes.value&&!m.attributes.value.specified?m.text:m.value),j)return n;h.push(n)}}return h}return a(b).val()},a.fn.clearForm=function(b){return this.each(function(){a("input,select,textarea",this).clearFields(b)})},a.fn.clearFields=a.fn.clearInputs=function(b){var c=/^(?:color|date|datetime|email|month|number|password|range|search|tel|text|time|url|week)$/i;return this.each(function(){var d=this.type,e=this.tagName.toLowerCase();c.test(d)||"textarea"==e?this.value="":"checkbox"==d||"radio"==d?this.checked=!1:"select"==e?this.selectedIndex=-1:"file"==d?/MSIE/.test(navigator.userAgent)?a(this).replaceWith(a(this).clone(!0)):a(this).val(""):b&&(b===!0&&/hidden/.test(d)||"string"==typeof b&&a(this).is(b))&&(this.value="")})},a.fn.resetForm=function(){return this.each(function(){("function"==typeof this.reset||"object"==typeof this.reset&&!this.reset.nodeType)&&this.reset()})},a.fn.enable=function(a){return void 0===a&&(a=!0),this.each(function(){this.disabled=!a})},a.fn.selected=function(b){return void 0===b&&(b=!0),this.each(function(){var c=this.type;if("checkbox"==c||"radio"==c)this.checked=b;else if("option"==this.tagName.toLowerCase()){var d=a(this).parent("select");b&&d[0]&&"select-one"==d[0].type&&d.find("option").selected(!1),this.selected=b}})},a.fn.ajaxSubmit.debug=!1});