/*
 Highcharts JS v7.1.2 (2019-06-03)

 Exporting module

 (c) 2010-2019 Torstein Honsi

 License: www.highcharts.com/license
*/
(function(c){"object"===typeof module&&module.exports?(c["default"]=c,module.exports=c):"function"===typeof define&&define.amd?define("highcharts/modules/export-data",["highcharts","highcharts/modules/exporting"],function(f){c(f);c.Highcharts=f;return c}):c("undefined"!==typeof Highcharts?Highcharts:void 0)})(function(c){function f(a,d,b,g){a.hasOwnProperty(d)||(a[d]=g.apply(null,b))}c=c?c._modules:{};f(c,"mixins/ajax.js",[c["parts/Globals.js"]],function(a){a.ajax=function(d){var b=a.merge(!0,{url:!1,
    type:"GET",dataType:"json",success:!1,error:!1,data:!1,headers:{}},d);d={json:"application/json",xml:"application/xml",text:"text/plain",octet:"application/octet-stream"};var g=new XMLHttpRequest;if(!b.url)return!1;g.open(b.type.toUpperCase(),b.url,!0);g.setRequestHeader("Content-Type",d[b.dataType]||d.text);a.objectEach(b.headers,function(a,d){g.setRequestHeader(d,a)});g.onreadystatechange=function(){var a;if(4===g.readyState){if(200===g.status){a=g.responseText;if("json"===b.dataType)try{a=JSON.parse(a)}catch(n){b.error&&
    b.error(g,n);return}return b.success&&b.success(a)}b.error&&b.error(g,g.responseText)}};try{b.data=JSON.stringify(b.data)}catch(D){}g.send(b.data||!0)}});f(c,"mixins/download-url.js",[c["parts/Globals.js"]],function(a){var d=a.win,b=d.navigator,g=d.document,c=d.URL||d.webkitURL||d,n=/Edge\/\d+/.test(b.userAgent);a.dataURLtoBlob=function(a){if((a=a.match(/data:([^;]*)(;base64)?,([0-9A-Za-z+/]+)/))&&3<a.length&&d.atob&&d.ArrayBuffer&&d.Uint8Array&&d.Blob&&c.createObjectURL){for(var g=d.atob(a[3]),b=
    new d.ArrayBuffer(g.length),b=new d.Uint8Array(b),h=0;h<b.length;++h)b[h]=g.charCodeAt(h);a=new d.Blob([b],{type:a[1]});return c.createObjectURL(a)}};a.downloadURL=function(h,c){var q=g.createElement("a"),r;if("string"===typeof h||h instanceof String||!b.msSaveOrOpenBlob){if(n||2E6<h.length)if(h=a.dataURLtoBlob(h),!h)throw Error("Failed to convert to blob");if(void 0!==q.download)q.href=h,q.download=c,g.body.appendChild(q),q.click(),g.body.removeChild(q);else try{if(r=d.open(h,"chart"),void 0===r||
    null===r)throw Error("Failed to open window");}catch(l){d.location.href=h}}else b.msSaveOrOpenBlob(h,c)}});f(c,"modules/export-data.src.js",[c["parts/Globals.js"]],function(a){function d(a,b){if(c.Blob&&c.navigator.msSaveOrOpenBlob)return new c.Blob(["\ufeff"+a],{type:b})}var b=a.defined,g=a.pick,c=a.win,n=c.document,h=a.seriesTypes,f=a.downloadURL,q=a.fireEvent;a.setOptions({exporting:{csv:{columnHeaderFormatter:null,dateFormat:"%Y-%m-%d %H:%M:%S",decimalPoint:null,itemDelimiter:null,lineDelimiter:"\n"},
    showTable:!1,useMultiLevelHeaders:!0,useRowspanHeaders:!0},lang:{downloadCSV:"Download CSV",downloadXLS:"Download XLS",openInCloud:"Open in Highcharts Cloud",viewData:"View data table"}});a.addEvent(a.Chart,"render",function(){this.options&&this.options.exporting&&this.options.exporting.showTable&&this.viewData()});a.Chart.prototype.setUpKeyToAxis=function(){h.arearange&&(h.arearange.prototype.keyToAxis={low:"y",high:"y"});h.gantt&&(h.gantt.prototype.keyToAxis={start:"x",end:"x"})};a.Chart.prototype.getDataRows=
    function(c){var d=this.time,h=this.options.exporting&&this.options.exporting.csv||{},k,l=this.xAxis,t={},f=[],m,n=[],p=[],x,u,v,C=function(e,d,b){if(h.columnHeaderFormatter){var k=h.columnHeaderFormatter(e,d,b);if(!1!==k)return k}return e?e instanceof a.Axis?e.options.title&&e.options.title.text||(e.isDatetimeAxis?"DateTime":"Category"):c?{columnTitle:1<b?d:e.name,topLevelColumnTitle:e.name}:e.name+(1<b?" ("+d+")":""):"Category"},y=[];u=0;this.setUpKeyToAxis();this.series.forEach(function(e){var b=
    e.options.keys||e.pointArrayMap||["y"],k=b.length,v=!e.requireSorting&&{},w={},A={},m=l.indexOf(e.xAxis),B,f;b.forEach(function(a){var b=(e.keyToAxis&&e.keyToAxis[a]||a)+"Axis";w[a]=e[b]&&e[b].categories||[];A[a]=e[b]&&e[b].isDatetimeAxis});if(!1!==e.options.includeInDataExport&&!e.options.isInternal&&!1!==e.visible){a.find(y,function(e){return e[0]===m})||y.push([m,u]);for(f=0;f<k;)x=C(e,b[f],b.length),p.push(x.columnTitle||x),c&&n.push(x.topLevelColumnTitle||x),f++;B={chart:e.chart,autoIncrement:e.autoIncrement,
    options:e.options,pointArrayMap:e.pointArrayMap};e.options.data.forEach(function(a,c){var l,p;p={series:B};e.pointClass.prototype.applyOptions.apply(p,[a]);a=p.x;l=e.data[c]&&e.data[c].name;f=0;e.xAxis&&"name"!==e.exportKey||(a=l);v&&(v[a]&&(a+="|"+c),v[a]=!0);t[a]||(t[a]=[],t[a].xValues=[]);t[a].x=p.x;t[a].name=l;for(t[a].xValues[m]=p.x;f<k;)c=b[f],l=p[c],t[a][u+f]=g(w[c][l],A[c]?d.dateFormat(h.dateFormat,l):null,l),f++});u+=f}});for(m in t)t.hasOwnProperty(m)&&f.push(t[m]);var w,z;m=c?[n,p]:[p];
    for(u=y.length;u--;)w=y[u][0],z=y[u][1],k=l[w],f.sort(function(a,b){return a.xValues[w]-b.xValues[w]}),v=C(k),m[0].splice(z,0,v),c&&m[1]&&m[1].splice(z,0,v),f.forEach(function(a){var e=a.name;k&&!b(e)&&(k.isDatetimeAxis?(a.x instanceof Date&&(a.x=a.x.getTime()),e=d.dateFormat(h.dateFormat,a.x)):e=k.categories?g(k.names[a.x],k.categories[a.x],a.x):a.x);a.splice(z,0,e)});m=m.concat(f);q(this,"exportData",{dataRows:m});return m};a.Chart.prototype.getCSV=function(a){var b="",c=this.getDataRows(),d=this.options.exporting.csv,
    l=g(d.decimalPoint,","!==d.itemDelimiter&&a?(1.1).toLocaleString()[1]:"."),h=g(d.itemDelimiter,","===l?";":","),f=d.lineDelimiter;c.forEach(function(a,d){for(var k,g=a.length;g--;)k=a[g],"string"===typeof k&&(k='"'+k+'"'),"number"===typeof k&&"."!==l&&(k=k.toString().replace(".",l)),a[g]=k;b+=a.join(h);d<c.length-1&&(b+=f)});return b};a.Chart.prototype.getTable=function(a){var b='\x3ctable id\x3d"highcharts-data-table-'+this.index+'"\x3e',c=this.options,d=a?(1.1).toLocaleString()[1]:".",h=g(c.exporting.useMultiLevelHeaders,
    !0);a=this.getDataRows(h);var f=0,l=h?a.shift():null,m=a.shift(),n=function(a,b,c,h){var k=g(h,"");b="text"+(b?" "+b:"");"number"===typeof k?(k=k.toString(),","===d&&(k=k.replace(".",d)),b="number"):h||(b="empty");return"\x3c"+a+(c?" "+c:"")+' class\x3d"'+b+'"\x3e'+k+"\x3c/"+a+"\x3e"};!1!==c.exporting.tableCaption&&(b+='\x3ccaption class\x3d"highcharts-table-caption"\x3e'+g(c.exporting.tableCaption,c.title.text?c.title.text.replace(/&/g,"\x26amp;").replace(/</g,"\x26lt;").replace(/>/g,"\x26gt;").replace(/"/g,
    "\x26quot;").replace(/'/g,"\x26#x27;").replace(/\//g,"\x26#x2F;"):"Chart")+"\x3c/caption\x3e");for(var p=0,r=a.length;p<r;++p)a[p].length>f&&(f=a[p].length);b+=function(a,b,d){var k="\x3cthead\x3e",f=0;d=d||b&&b.length;var g,e,l=0;if(e=h&&a&&b){a:if(e=a.length,b.length===e){for(;e--;)if(a[e]!==b[e]){e=!1;break a}e=!0}else e=!1;e=!e}if(e){for(k+="\x3ctr\x3e";f<d;++f)e=a[f],g=a[f+1],e===g?++l:l?(k+=n("th","highcharts-table-topheading",'scope\x3d"col" colspan\x3d"'+(l+1)+'"',e),l=0):(e===b[f]?c.exporting.useRowspanHeaders?
    (g=2,delete b[f]):(g=1,b[f]=""):g=1,k+=n("th","highcharts-table-topheading",'scope\x3d"col"'+(1<g?' valign\x3d"top" rowspan\x3d"'+g+'"':""),e));k+="\x3c/tr\x3e"}if(b){k+="\x3ctr\x3e";f=0;for(d=b.length;f<d;++f)void 0!==b[f]&&(k+=n("th",null,'scope\x3d"col"',b[f]));k+="\x3c/tr\x3e"}return k+"\x3c/thead\x3e"}(l,m,Math.max(f,m.length));b+="\x3ctbody\x3e";a.forEach(function(a){b+="\x3ctr\x3e";for(var c=0;c<f;c++)b+=n(c?"td":"th",null,c?"":'scope\x3d"row"',a[c]);b+="\x3c/tr\x3e"});b+="\x3c/tbody\x3e\x3c/table\x3e";
    a={html:b};q(this,"afterGetTable",a);return a.html};a.Chart.prototype.downloadCSV=function(){var a=this.getCSV(!0);f(d(a,"text/csv")||"data:text/csv,\ufeff"+encodeURIComponent(a),this.getFilename()+".csv")};a.Chart.prototype.downloadXLS=function(){var a='\x3chtml xmlns:o\x3d"urn:schemas-microsoft-com:office:office" xmlns:x\x3d"urn:schemas-microsoft-com:office:excel" xmlns\x3d"http://www.w3.org/TR/REC-html40"\x3e\x3chead\x3e\x3c!--[if gte mso 9]\x3e\x3cxml\x3e\x3cx:ExcelWorkbook\x3e\x3cx:ExcelWorksheets\x3e\x3cx:ExcelWorksheet\x3e\x3cx:Name\x3eArk1\x3c/x:Name\x3e\x3cx:WorksheetOptions\x3e\x3cx:DisplayGridlines/\x3e\x3c/x:WorksheetOptions\x3e\x3c/x:ExcelWorksheet\x3e\x3c/x:ExcelWorksheets\x3e\x3c/x:ExcelWorkbook\x3e\x3c/xml\x3e\x3c![endif]--\x3e\x3cstyle\x3etd{border:none;font-family: Calibri, sans-serif;} .number{mso-number-format:"0.00";} .text{ mso-number-format:"@";}\x3c/style\x3e\x3cmeta name\x3dProgId content\x3dExcel.Sheet\x3e\x3cmeta charset\x3dUTF-8\x3e\x3c/head\x3e\x3cbody\x3e'+
    this.getTable(!0)+"\x3c/body\x3e\x3c/html\x3e";f(d(a,"application/vnd.ms-excel")||"data:application/vnd.ms-excel;base64,"+c.btoa(unescape(encodeURIComponent(a))),this.getFilename()+".xls")};a.Chart.prototype.viewData=function(){this.dataTableDiv||(this.dataTableDiv=n.createElement("div"),this.dataTableDiv.className="highcharts-data-table",this.renderTo.parentNode.insertBefore(this.dataTableDiv,this.renderTo.nextSibling));this.dataTableDiv.innerHTML=this.getTable();q(this,"afterViewData",this.dataTableDiv)};
    a.Chart.prototype.openInCloud=function(){function b(c){Object.keys(c).forEach(function(d){"function"===typeof c[d]&&delete c[d];a.isObject(c[d])&&b(c[d])})}var c,d;c=a.merge(this.userOptions);b(c);c={name:c.title&&c.title.text||"Chart title",options:c,settings:{constructor:"Chart",dataProvider:{csv:this.getCSV()}}};d=JSON.stringify(c);(function(){var a=n.createElement("form");n.body.appendChild(a);a.method="post";a.action="https://cloud-api.highcharts.com/openincloud";a.target="_blank";var b=n.createElement("input");
    b.type="hidden";b.name="chart";b.value=d;a.appendChild(b);a.submit();n.body.removeChild(a)})()};var r=a.getOptions().exporting;r&&(a.extend(r.menuItemDefinitions,{downloadCSV:{textKey:"downloadCSV",onclick:function(){this.downloadCSV()}},downloadXLS:{textKey:"downloadXLS",onclick:function(){this.downloadXLS()}},viewData:{textKey:"viewData",onclick:function(){this.viewData()}},openInCloud:{textKey:"openInCloud",onclick:function(){this.openInCloud()}}}),r.buttons&&r.buttons.contextButton.menuItems.push("separator",
    "downloadCSV","downloadXLS","viewData","openInCloud"));h.map&&(h.map.prototype.exportKey="name");h.mapbubble&&(h.mapbubble.prototype.exportKey="name");h.treemap&&(h.treemap.prototype.exportKey="name")});f(c,"masters/modules/export-data.src.js",[],function(){})});
    //# sourceMappingURL=export-data.js.map