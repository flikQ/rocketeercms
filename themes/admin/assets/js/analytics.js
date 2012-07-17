/*! Javascript plotting library for jQuery, v. 0.7.
 *
 * Released under the MIT license by IOLA, December 2007.
 *
 */

// Hacked by Rob Crowe <hello@vivalacrowe.com>
(function(g){g.color={};g.color.make=function(w,h,u,V){var p={};p.r=w||0;p.g=h||0;p.b=u||0;p.a=V!=null?V:1;p.add=function(h,g){for(var u=0;u<h.length;++u)p[h.charAt(u)]+=g;return p.normalize()};p.scale=function(h,g){for(var u=0;u<h.length;++u)p[h.charAt(u)]*=g;return p.normalize()};p.toString=function(){return p.a>=1?"rgb("+[p.r,p.g,p.b].join(",")+")":"rgba("+[p.r,p.g,p.b,p.a].join(",")+")"};p.normalize=function(){function h(g,p,u){return p<g?g:p>u?u:p}p.r=h(0,parseInt(p.r),255);p.g=h(0,parseInt(p.g),
255);p.b=h(0,parseInt(p.b),255);p.a=h(0,p.a,1);return p};p.clone=function(){return g.color.make(p.r,p.b,p.g,p.a)};return p.normalize()};g.color.extract=function(w,h){var u;do{u=w.css(h).toLowerCase();if(u!=""&&u!="transparent")break;w=w.parent()}while(!g.nodeName(w.get(0),"body"));u=="rgba(0, 0, 0, 0)"&&(u="transparent");return g.color.parse(u)};g.color.parse=function(w){var h,u=g.color.make;if(h=/rgb\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*\)/.exec(w))return u(parseInt(h[1],10),
parseInt(h[2],10),parseInt(h[3],10));if(h=/rgba\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]+(?:\.[0-9]+)?)\s*\)/.exec(w))return u(parseInt(h[1],10),parseInt(h[2],10),parseInt(h[3],10),parseFloat(h[4]));if(h=/rgb\(\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*\)/.exec(w))return u(parseFloat(h[1])*2.55,parseFloat(h[2])*2.55,parseFloat(h[3])*2.55);if(h=/rgba\(\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\s*\)/.exec(w))return u(parseFloat(h[1])*
2.55,parseFloat(h[2])*2.55,parseFloat(h[3])*2.55,parseFloat(h[4]));if(h=/#([a-fA-F0-9]{2})([a-fA-F0-9]{2})([a-fA-F0-9]{2})/.exec(w))return u(parseInt(h[1],16),parseInt(h[2],16),parseInt(h[3],16));if(h=/#([a-fA-F0-9])([a-fA-F0-9])([a-fA-F0-9])/.exec(w))return u(parseInt(h[1]+h[1],16),parseInt(h[2]+h[2],16),parseInt(h[3]+h[3],16));w=g.trim(w).toLowerCase();return w=="transparent"?u(255,255,255,0):(h=L[w]||[0,0,0],u(h[0],h[1],h[2]))};var L={aqua:[0,255,255],azure:[240,255,255],beige:[245,245,220],black:[0,
0,0],blue:[0,0,255],brown:[165,42,42],cyan:[0,255,255],darkblue:[0,0,139],darkcyan:[0,139,139],darkgrey:[169,169,169],darkgreen:[0,100,0],darkkhaki:[189,183,107],darkmagenta:[139,0,139],darkolivegreen:[85,107,47],darkorange:[255,140,0],darkorchid:[153,50,204],darkred:[139,0,0],darksalmon:[233,150,122],darkviolet:[148,0,211],fuchsia:[255,0,255],gold:[255,215,0],green:[0,128,0],indigo:[75,0,130],khaki:[240,230,140],lightblue:[173,216,230],lightcyan:[224,255,255],lightgreen:[144,238,144],lightgrey:[211,
211,211],lightpink:[255,182,193],lightyellow:[255,255,224],lime:[0,255,0],magenta:[255,0,255],maroon:[128,0,0],navy:[0,0,128],olive:[128,128,0],orange:[255,165,0],pink:[255,192,203],purple:[128,0,128],violet:[128,0,128],red:[255,0,0],silver:[192,192,192],white:[255,255,255],yellow:[255,255,0]}})(jQuery);
(function(g){function L(h,u,V,p){function H(a,d){for(var d=[y].concat(d),b=0;b<a.length;++b)a[b].apply(this,d)}function Z(a){for(var d=[],b=0;b<a.length;++b){var e=g.extend(!0,{},f.series);a[b].data!=null?(e.data=a[b].data,delete a[b].data,g.extend(!0,e,a[b]),a[b].data=e.data):e.data=a[b];d.push(e)}x=d;d=x.length;b=[];e=[];for(a=0;a<x.length;++a){var c=x[a].color;c!=null&&(--d,typeof c=="number"?e.push(c):b.push(g.color.parse(x[a].color)))}for(a=0;a<e.length;++a)d=Math.max(d,e[a]+1);b=[];for(a=e=
0;b.length<d;)c=f.colors.length==a?g.color.make(100,100,100):g.color.parse(f.colors[a]),c.scale("rgb",1+(e%2==1?-1:1)*Math.ceil(e/2)*0.2),b.push(c),++a,a>=f.colors.length&&(a=0,++e);for(a=d=0;a<x.length;++a){e=x[a];if(e.color==null)e.color=b[d].toString(),++d;else if(typeof e.color=="number")e.color=b[e.color].toString();if(e.lines.show==null){var t,c=!0;for(t in e)if(e[t]&&e[t].show){c=!1;break}if(c)e.lines.show=!0}e.xaxis=P(B,N(e,"x"));e.yaxis=P(F,N(e,"y"))}C()}function N(a,d){var b=a[d+"axis"];
if(typeof b=="object")b=b.n;typeof b!="number"&&(b=1);return b}function A(){return g.grep(B.concat(F),function(a){return a})}function T(a){var d={},b,e;for(b=0;b<B.length;++b)(e=B[b])&&e.used&&(d["x"+e.n]=e.c2p(a.left));for(b=0;b<F.length;++b)(e=F[b])&&e.used&&(d["y"+e.n]=e.c2p(a.top));if(d.x1!==void 0)d.x=d.x1;if(d.y1!==void 0)d.y=d.y1;return d}function P(a,d){a[d-1]||(a[d-1]={n:d,direction:a==B?"x":"y",options:g.extend(!0,{},a==B?f.xaxis:f.yaxis)});return a[d-1]}function C(){function a(a,c,b){if(c<
a.datamin&&c!=-e)a.datamin=c;if(b>a.datamax&&b!=e)a.datamax=b}var d=Number.POSITIVE_INFINITY,b=Number.NEGATIVE_INFINITY,e=Number.MAX_VALUE,c,t,k,n,q,l,z,f,j,h;g.each(A(),function(a,c){c.datamin=d;c.datamax=b;c.used=!1});for(c=0;c<x.length;++c)q=x[c],q.datapoints={points:[]},H(I.processRawData,[q,q.data,q.datapoints]);for(c=0;c<x.length;++c){q=x[c];var Q=q.data,s=q.datapoints.format;if(!s){s=[];s.push({x:!0,number:!0,required:!0});s.push({y:!0,number:!0,required:!0});if(q.bars.show||q.lines.show&&
q.lines.fill)if(s.push({y:!0,number:!0,required:!1,defaultValue:0}),q.bars.horizontal)delete s[s.length-1].y,s[s.length-1].x=!0;q.datapoints.format=s}if(q.datapoints.pointsize==null){q.datapoints.pointsize=s.length;z=q.datapoints.pointsize;l=q.datapoints.points;insertSteps=q.lines.show&&q.lines.steps;q.xaxis.used=q.yaxis.used=!0;for(t=k=0;t<Q.length;++t,k+=z){h=Q[t];var m=h==null;if(!m)for(n=0;n<z;++n){f=h[n];if(j=s[n])if(j.number&&f!=null&&(f=+f,isNaN(f)?f=null:f==Infinity?f=e:f==-Infinity&&(f=-e)),
f==null&&(j.required&&(m=!0),j.defaultValue!=null))f=j.defaultValue;l[k+n]=f}if(m)for(n=0;n<z;++n)f=l[k+n],f!=null&&(j=s[n],j.x&&a(q.xaxis,f,f),j.y&&a(q.yaxis,f,f)),l[k+n]=null;else if(insertSteps&&k>0&&l[k-z]!=null&&l[k-z]!=l[k]&&l[k-z+1]!=l[k+1]){for(n=0;n<z;++n)l[k+z+n]=l[k+n];l[k+1]=l[k-z+1];k+=z}}}}for(c=0;c<x.length;++c)q=x[c],H(I.processDatapoints,[q,q.datapoints]);for(c=0;c<x.length;++c){q=x[c];l=q.datapoints.points;z=q.datapoints.pointsize;h=k=d;m=Q=b;for(t=0;t<l.length;t+=z)if(l[t]!=null)for(n=
0;n<z;++n)if(f=l[t+n],(j=s[n])&&!(f==e||f==-e))j.x&&(f<k&&(k=f),f>Q&&(Q=f)),j.y&&(f<h&&(h=f),f>m&&(m=f));q.bars.show&&(t=q.bars.align=="left"?0:-q.bars.barWidth/2,q.bars.horizontal?(h+=t,m+=t+q.bars.barWidth):(k+=t,Q+=t+q.bars.barWidth));a(q.xaxis,k,Q);a(q.yaxis,h,m)}g.each(A(),function(a,c){if(c.datamin==d)c.datamin=null;if(c.datamax==b)c.datamax=null})}function $(a,d){var b=document.createElement("canvas");b.className=d;b.width=E;b.height=G;a||g(b).css({position:"absolute",left:0,top:0});g(b).appendTo(h);
b.getContext||(b=window.G_vmlCanvasManager.initElement(b));b.getContext("2d").save();return b}function L(){E=h.width();G=h.height();if(E<=0||G<=0)throw"Invalid dimensions for plot, width = "+E+", height = "+G;}function aa(a){if(a.width!=E)a.width=E;if(a.height!=G)a.height=G;a=a.getContext("2d");a.restore();a.save()}function na(a){function d(a){return a}var b,e,c=a.options.transform||d,t=a.options.inverseTransform;a.direction=="x"?(b=a.scale=O/Math.abs(c(a.max)-c(a.min)),e=Math.min(c(a.max),c(a.min))):
(b=a.scale=K/Math.abs(c(a.max)-c(a.min)),b=-b,e=Math.max(c(a.max),c(a.min)));a.p2c=c==d?function(a){return(a-e)*b}:function(a){return(c(a)-e)*b};a.c2p=t?function(a){return t(e+a/b)}:function(a){return e+a/b}}function oa(a){function d(c,b){return g('<div style="position:absolute;top:-10000px;'+b+'font-size:smaller"><div class="'+a.direction+"Axis "+a.direction+a.n+'Axis">'+c.join("")+"</div></div>").appendTo(h)}var b=a.options,e,c=a.ticks||[],t=[],k,n=b.labelWidth,b=b.labelHeight;if(a.direction=="x"){if(n==
null&&(n=Math.floor(E/(c.length>0?c.length:1))),b==null){t=[];for(e=0;e<c.length;++e)(k=c[e].label)&&t.push('<div class="tickLabel" style="float:left;width:'+n+'px">'+k+"</div>");t.length>0&&(t.push('<div style="clear:left"></div>'),c=d(t,"width:10000px;"),b=c.height(),c.remove())}}else if(n==null||b==null){for(e=0;e<c.length;++e)(k=c[e].label)&&t.push('<div class="tickLabel">'+k+"</div>");t.length>0&&(c=d(t,""),n==null&&(n=c.children().width()),b==null&&(b=c.find("div.tickLabel").height()),c.remove())}n==
null&&(n=0);b==null&&(b=0);a.labelWidth=n;a.labelHeight=b}function pa(a){var d=a.labelWidth,b=a.labelHeight,e=a.options.position,c=a.options.tickLength,t=f.grid.axisMargin,k=f.grid.labelMargin,n=a.direction=="x"?B:F,q=g.grep(n,function(a){return a&&a.options.position==e&&a.reserveSpace});g.inArray(a,q)==q.length-1&&(t=0);c==null&&(c="full");n=g.grep(n,function(a){return a&&a.reserveSpace});n=g.inArray(a,n)==0;!n&&c=="full"&&(c=5);isNaN(+c)||(k+=+c);a.direction=="x"?(b+=k,e=="bottom"?(o.bottom+=b+
t,a.box={top:G-o.bottom,height:b}):(a.box={top:o.top+t,height:b},o.top+=b+t)):(d+=k,e=="left"?(a.box={left:o.left+t,width:d},o.left+=d+t):(o.right+=d+t,a.box={left:E-o.right,width:d}));a.position=e;a.tickLength=c;a.box.padding=k;a.innermost=n}function ba(){var a,d=A();g.each(d,function(a,b){b.show=b.options.show;if(b.show==null)b.show=b.used;b.reserveSpace=b.show||b.options.reserveSpace;var e=b.options,d=+(e.min!=null?e.min:b.datamin),f=+(e.max!=null?e.max:b.datamax),l=f-d;if(l==0){if(l=f==0?1:0.01,
e.min==null&&(d-=l),e.max==null||e.min!=null)f+=l}else{var z=e.autoscaleMargin;z!=null&&(e.min==null&&(d-=l*z,d<0&&b.datamin!=null&&b.datamin>=0&&(d=0)),e.max==null&&(f+=l*z,f>0&&b.datamax!=null&&b.datamax<=0&&(f=0)))}b.min=d;b.max=f});allocatedAxes=g.grep(d,function(a){return a.reserveSpace});o.left=o.right=o.top=o.bottom=0;if(f.grid.show){g.each(allocatedAxes,function(a,b){qa(b);var e=b.options.ticks,d=[];e==null||typeof e=="number"&&e>0?d=b.tickGenerator(b):e&&(d=g.isFunction(e)?e({min:b.min,max:b.max}):
e);var f;b.ticks=[];for(e=0;e<d.length;++e){var l=null,z=d[e];typeof z=="object"?(f=+z[0],z.length>1&&(l=z[1])):f=+z;l==null&&(l=b.tickFormatter(f,b));isNaN(f)||b.ticks.push({v:f,label:l})}d=b.ticks;if(b.options.autoscaleMargin&&d.length>0){if(b.options.min==null)b.min=Math.min(b.min,d[0].v);if(b.options.max==null&&d.length>1)b.max=Math.max(b.max,d[d.length-1].v)}oa(b)});for(a=allocatedAxes.length-1;a>=0;--a)pa(allocatedAxes[a]);var b=f.grid.minBorderMargin;if(b==null)for(a=b=0;a<x.length;++a)b=Math.max(b,
x[a].points.radius+x[a].points.lineWidth/2);for(var e in o)o[e]+=f.grid.borderWidth,o[e]=Math.max(b,o[e])}O=E-o.left-o.right;K=G-o.bottom-o.top;g.each(d,function(a,b){na(b)});f.grid.show&&(g.each(allocatedAxes,function(a,b){b.direction=="x"?(b.box.left=o.left,b.box.width=O):(b.box.top=o.top,b.box.height=K)}),ra());sa()}function qa(a){var d=a.options,b=(a.max-a.min)/(typeof d.ticks=="number"&&d.ticks>0?d.ticks:0.3*Math.sqrt(a.direction=="x"?E:G)),e,c,f,k;if(d.mode=="time"){var n={second:1E3,minute:6E4,
hour:36E5,day:864E5,month:2592E6,year:525949.2*6E4};k=[[1,"second"],[2,"second"],[5,"second"],[10,"second"],[30,"second"],[1,"minute"],[2,"minute"],[5,"minute"],[10,"minute"],[30,"minute"],[1,"hour"],[2,"hour"],[4,"hour"],[8,"hour"],[12,"hour"],[1,"day"],[2,"day"],[3,"day"],[0.25,"month"],[0.5,"month"],[1,"month"],[2,"month"],[3,"month"],[6,"month"],[1,"year"]];e=0;d.minTickSize!=null&&(e=typeof d.tickSize=="number"?d.tickSize:d.minTickSize[0]*n[d.minTickSize[1]]);for(c=0;c<k.length-1;++c)if(b<(k[c][0]*
n[k[c][1]]+k[c+1][0]*n[k[c+1][1]])/2&&k[c][0]*n[k[c][1]]>=e)break;e=k[c][0];f=k[c][1];f=="year"&&(c=Math.pow(10,Math.floor(Math.log(b/n.year)/Math.LN10)),k=b/n.year/c,e=k<1.5?1:k<3?2:k<7.5?5:10,e*=c);a.tickSize=d.tickSize||[e,f];c=function(a){var b=[],e=a.tickSize[0],c=a.tickSize[1],d=new Date(a.min),f=e*n[c];c=="second"&&d.setUTCSeconds(w(d.getUTCSeconds(),e));c=="minute"&&d.setUTCMinutes(w(d.getUTCMinutes(),e));c=="hour"&&d.setUTCHours(w(d.getUTCHours(),e));c=="month"&&d.setUTCMonth(w(d.getUTCMonth(),
e));c=="year"&&d.setUTCFullYear(w(d.getUTCFullYear(),e));d.setUTCMilliseconds(0);f>=n.minute&&d.setUTCSeconds(0);f>=n.hour&&d.setUTCMinutes(0);f>=n.day&&d.setUTCHours(0);f>=n.day*4&&d.setUTCDate(1);f>=n.year&&d.setUTCMonth(0);var q=0,k=Number.NaN,l;do if(l=k,k=d.getTime(),b.push(k),c=="month")if(e<1){d.setUTCDate(1);var t=d.getTime();d.setUTCMonth(d.getUTCMonth()+1);var j=d.getTime();d.setTime(k+q*n.hour+(j-t)*e);q=d.getUTCHours();d.setUTCHours(0)}else d.setUTCMonth(d.getUTCMonth()+e);else c=="year"?
d.setUTCFullYear(d.getUTCFullYear()+e):d.setTime(k+f);while(k<a.max&&k!=l);return b};e=function(a,b){var e=new Date(a);if(d.timeformat!=null)return g.plot.formatDate(e,d.timeformat,d.monthNames);var c=b.tickSize[0]*n[b.tickSize[1]],f=b.max-b.min,k=d.twelveHourClock?" %p":"";fmt=c<n.minute?"%h:%M:%S"+k:c<n.day?f<2*n.day?"%h:%M"+k:"%b %d %h:%M"+k:c<n.month?"%b %d":c<n.year?f<n.year?"%b":"%b %y":"%y";return g.plot.formatDate(e,fmt,d.monthNames)}}else{f=d.tickDecimals;var q=-Math.floor(Math.log(b)/Math.LN10);
f!=null&&q>f&&(q=f);c=Math.pow(10,-q);k=b/c;if(k<1.5)e=1;else if(k<3){if(e=2,k>2.25&&(f==null||q+1<=f))e=2.5,++q}else e=k<7.5?5:10;e*=c;if(d.minTickSize!=null&&e<d.minTickSize)e=d.minTickSize;a.tickDecimals=Math.max(0,f!=null?f:q);a.tickSize=d.tickSize||e;c=function(a){var b=[],e=w(a.min,a.tickSize),c=0,d=Number.NaN,f;do f=d,d=e+c*a.tickSize,b.push(d),++c;while(d<a.max&&d!=f);return b};e=function(a,b){return a.toFixed(b.tickDecimals)}}if(d.alignTicksWithAxis!=null){var l=(a.direction=="x"?B:F)[d.alignTicksWithAxis-
1];if(l&&l.used&&l!=a){c=c(a);if(c.length>0){if(d.min==null)a.min=Math.min(a.min,c[0]);if(d.max==null&&c.length>1)a.max=Math.max(a.max,c[c.length-1])}c=function(a){var b=[],e,c;for(c=0;c<l.ticks.length;++c)e=(l.ticks[c].v-l.min)/(l.max-l.min),e=a.min+e*(a.max-a.min),b.push(e);return b};if(a.mode!="time"&&d.tickDecimals==null&&(b=Math.max(0,-Math.floor(Math.log(b)/Math.LN10)+1),k=c(a),!(k.length>1&&/\..*0$/.test((k[1]-k[0]).toFixed(b)))))a.tickDecimals=b}}a.tickGenerator=c;a.tickFormatter=g.isFunction(d.tickFormatter)?
function(a,b){return""+d.tickFormatter(a,b)}:e}function ca(){j.clearRect(0,0,E,G);var a=f.grid;if(a.show&&a.backgroundColor)j.save(),j.translate(o.left,o.top),j.fillStyle=da(f.grid.backgroundColor,K,0,"rgba(255, 255, 255, 0)"),j.fillRect(0,0,O,K),j.restore();a.show&&!a.aboveData&&ea();for(var d=0;d<x.length;++d){H(I.drawSeries,[j,x[d]]);var b=x[d];b.lines.show&&ta(b);b.bars.show&&ua(b);b.points.show&&va(b)}H(I.draw,[j]);a.show&&a.aboveData&&ea()}function fa(a,d){var b,e,c,f,k=A();for(i=0;i<k.length;++i)if(b=
k[i],b.direction==d&&(f=d+b.n+"axis",!a[f]&&b.n==1&&(f=d+"axis"),a[f])){e=a[f].from;c=a[f].to;break}a[f]||(b=d=="x"?B[0]:F[0],e=a[d+"1"],c=a[d+"2"]);e!=null&&c!=null&&e>c&&(f=e,e=c,c=f);return{from:e,to:c,axis:b}}function ea(){var a;j.save();j.translate(o.left,o.top);var d=f.grid.markings;if(d){if(g.isFunction(d)){var b=y.getAxes();b.xmin=b.xaxis.min;b.xmax=b.xaxis.max;b.ymin=b.yaxis.min;b.ymax=b.yaxis.max;d=d(b)}for(a=0;a<d.length;++a){var b=d[a],e=fa(b,"x"),c=fa(b,"y");if(e.from==null)e.from=e.axis.min;
if(e.to==null)e.to=e.axis.max;if(c.from==null)c.from=c.axis.min;if(c.to==null)c.to=c.axis.max;if(!(e.to<e.axis.min||e.from>e.axis.max||c.to<c.axis.min||c.from>c.axis.max))if(e.from=Math.max(e.from,e.axis.min),e.to=Math.min(e.to,e.axis.max),c.from=Math.max(c.from,c.axis.min),c.to=Math.min(c.to,c.axis.max),!(e.from==e.to&&c.from==c.to))e.from=e.axis.p2c(e.from),e.to=e.axis.p2c(e.to),c.from=c.axis.p2c(c.from),c.to=c.axis.p2c(c.to),e.from==e.to||c.from==c.to?(j.beginPath(),j.strokeStyle=b.color||f.grid.markingsColor,
j.lineWidth=b.lineWidth||f.grid.markingsLineWidth,j.moveTo(e.from,c.from),j.lineTo(e.to,c.to),j.stroke()):(j.fillStyle=b.color||f.grid.markingsColor,j.fillRect(e.from,c.to,e.to-e.from,c.from-c.to))}}b=A();d=f.grid.borderWidth;for(e=0;e<b.length;++e){c=b[e];a=c.box;var t=c.tickLength,k,n,q,l;if(c.show&&c.ticks.length!=0){j.strokeStyle=c.options.tickColor||g.color.parse(c.options.color).scale("a",0.22).toString();j.lineWidth=1;c.direction=="x"?(k=0,n=t=="full"?c.position=="top"?0:K:a.top-o.top+(c.position==
"top"?a.height:0)):(n=0,k=t=="full"?c.position=="left"?0:O:a.left-o.left+(c.position=="left"?a.width:0));c.innermost||(j.beginPath(),q=l=0,c.direction=="x"?q=O:l=K,j.lineWidth==1&&(k=Math.floor(k)+0.5,n=Math.floor(n)+0.5),j.moveTo(k,n),j.lineTo(k+q,n+l),j.stroke());j.beginPath();for(a=0;a<c.ticks.length;++a){var z=c.ticks[a].v;q=l=0;z<c.min||z>c.max||t=="full"&&d>0&&(z==c.min||z==c.max)||(c.direction=="x"?(k=c.p2c(z),l=t=="full"?-K:t,c.position=="top"&&(l=-l)):(n=c.p2c(z),q=t=="full"?-O:t,c.position==
"left"&&(q=-q)),j.lineWidth==1&&(c.direction=="x"?k=Math.floor(k)+0.5:n=Math.floor(n)+0.5),j.moveTo(k,n),j.lineTo(k+q,n+l))}j.stroke()}}if(d)j.lineWidth=d,j.strokeStyle=f.grid.borderColor,j.strokeRect(-d/2,-d/2,O+d,K+d);j.restore()}function ra(){h.find(".tickLabels").remove();for(var a=['<div class="tickLabels" style="font-size:smaller">'],d=A(),b=0;b<d.length;++b){var e=d[b],c=e.box;if(e.show){a.push('<div class="'+e.direction+"Axis "+e.direction+e.n+'Axis" style="color:'+e.options.color+'">');for(var f=
0;f<e.ticks.length;++f){var k=e.ticks[f];if(k.label&&!(k.v<e.min||k.v>e.max)){var n={},q;e.direction=="x"?(q="center",n.left=Math.round(o.left+e.p2c(k.v)-e.labelWidth/2),e.position=="bottom"?n.top=c.top+c.padding:n.bottom=G-(c.top+c.height-c.padding)):(n.top=Math.round(o.top+e.p2c(k.v)-e.labelHeight/2),e.position=="left"?(n.right=E-(c.left+c.width-c.padding),q="right"):(n.left=c.left+c.padding,q="left"));n.width=e.labelWidth;q=["position:absolute","text-align:"+q];for(var l in n)q.push(l+":"+n[l]+
"px");a.push('<div class="tickLabel" style="'+q.join(";")+'">'+k.label+"</div>")}}a.push("</div>")}}a.push("</div>");h.append(a.join(""))}function ta(a){function d(a,b,e,c,d){var f=a.points,a=a.pointsize,h=null,t=null;j.beginPath();for(var g=a;g<f.length;g+=a){var s=f[g-a],m=f[g-a+1],r=f[g],v=f[g+1];if(!(s==null||r==null)){if(m<=v&&m<d.min){if(v<d.min)continue;s=(d.min-m)/(v-m)*(r-s)+s;m=d.min}else if(v<=m&&v<d.min){if(m<d.min)continue;r=(d.min-m)/(v-m)*(r-s)+s;v=d.min}if(m>=v&&m>d.max){if(v>d.max)continue;
s=(d.max-m)/(v-m)*(r-s)+s;m=d.max}else if(v>=m&&v>d.max){if(m>d.max)continue;r=(d.max-m)/(v-m)*(r-s)+s;v=d.max}if(s<=r&&s<c.min){if(r<c.min)continue;m=(c.min-s)/(r-s)*(v-m)+m;s=c.min}else if(r<=s&&r<c.min){if(s<c.min)continue;v=(c.min-s)/(r-s)*(v-m)+m;r=c.min}if(s>=r&&s>c.max){if(r>c.max)continue;m=(c.max-s)/(r-s)*(v-m)+m;s=c.max}else if(r>=s&&r>c.max){if(s>c.max)continue;v=(c.max-s)/(r-s)*(v-m)+m;r=c.max}(s!=h||m!=t)&&j.moveTo(c.p2c(s)+b,d.p2c(m)+e);h=r;t=v;j.lineTo(c.p2c(r)+b,d.p2c(v)+e)}}j.stroke()}
function b(a,b,c){for(var d=a.points,a=a.pointsize,e=Math.min(Math.max(0,c.min),c.max),f=0,h=!1,t=1,g=0,s=0;;){if(a>0&&f>d.length+a)break;f+=a;var m=d[f-a],r=d[f-a+t],v=d[f],o=d[f+t];if(h){if(a>0&&m!=null&&v==null){s=f;a=-a;t=2;continue}if(a<0&&f==g+a){j.fill();h=!1;a=-a;t=1;f=g=s+a;continue}}if(!(m==null||v==null)){if(m<=v&&m<b.min){if(v<b.min)continue;r=(b.min-m)/(v-m)*(o-r)+r;m=b.min}else if(v<=m&&v<b.min){if(m<b.min)continue;o=(b.min-m)/(v-m)*(o-r)+r;v=b.min}if(m>=v&&m>b.max){if(v>b.max)continue;
r=(b.max-m)/(v-m)*(o-r)+r;m=b.max}else if(v>=m&&v>b.max){if(m>b.max)continue;o=(b.max-m)/(v-m)*(o-r)+r;v=b.max}h||(j.beginPath(),j.moveTo(b.p2c(m),c.p2c(e)),h=!0);if(r>=c.max&&o>=c.max)j.lineTo(b.p2c(m),c.p2c(c.max)),j.lineTo(b.p2c(v),c.p2c(c.max));else if(r<=c.min&&o<=c.min)j.lineTo(b.p2c(m),c.p2c(c.min)),j.lineTo(b.p2c(v),c.p2c(c.min));else{var p=m,u=v;if(r<=o&&r<c.min&&o>=c.min)m=(c.min-r)/(o-r)*(v-m)+m,r=c.min;else if(o<=r&&o<c.min&&r>=c.min)v=(c.min-r)/(o-r)*(v-m)+m,o=c.min;if(r>=o&&r>c.max&&
o<=c.max)m=(c.max-r)/(o-r)*(v-m)+m,r=c.max;else if(o>=r&&o>c.max&&r<=c.max)v=(c.max-r)/(o-r)*(v-m)+m,o=c.max;m!=p&&j.lineTo(b.p2c(p),c.p2c(r));j.lineTo(b.p2c(m),c.p2c(r));j.lineTo(b.p2c(v),c.p2c(o));v!=u&&(j.lineTo(b.p2c(v),c.p2c(o)),j.lineTo(b.p2c(u),c.p2c(o)))}}}}j.save();j.translate(o.left,o.top);j.lineJoin="round";var e=a.lines.lineWidth,c=a.shadowSize;if(e>0&&c>0){j.lineWidth=c;j.strokeStyle="rgba(0,0,0,0.1)";var f=Math.PI/18;d(a.datapoints,Math.sin(f)*(e/2+c/2),Math.cos(f)*(e/2+c/2),a.xaxis,
a.yaxis);j.lineWidth=c/2;d(a.datapoints,Math.sin(f)*(e/2+c/4),Math.cos(f)*(e/2+c/4),a.xaxis,a.yaxis)}j.lineWidth=e;j.strokeStyle=a.color;if(c=X(a.lines,a.color,0,K))j.fillStyle=c,b(a.datapoints,a.xaxis,a.yaxis);e>0&&d(a.datapoints,0,0,a.xaxis,a.yaxis);j.restore()}function va(a){function d(a,b,c,d,e,f,h,t){for(var g=a.points,a=a.pointsize,o=0;o<g.length;o+=a){var m=g[o],r=g[o+1];if(!(m==null||m<f.min||m>f.max||r<h.min||r>h.max)){j.beginPath();m=f.p2c(m);r=h.p2c(r)+d;t=="circle"?j.arc(m,r,b,0,e?Math.PI:
Math.PI*2,!1):t(j,m,r,b,e);j.closePath();if(c)j.fillStyle=c,j.fill();j.stroke()}}}j.save();j.translate(o.left,o.top);var b=a.points.lineWidth,e=a.shadowSize,c=a.points.radius,f=a.points.symbol;if(b>0&&e>0)e/=2,j.lineWidth=e,j.strokeStyle="rgba(0,0,0,0.1)",d(a.datapoints,c,null,e+e/2,!0,a.xaxis,a.yaxis,f),j.strokeStyle="rgba(0,0,0,0.2)",d(a.datapoints,c,null,e/2,!0,a.xaxis,a.yaxis,f);j.lineWidth=b;j.strokeStyle=a.color;d(a.datapoints,c,X(a.points,a.color),0,!1,a.xaxis,a.yaxis,f);j.restore()}function ga(a,
d,b,e,c,f,k,h,j,l,g,o){var p,u,x,s;g?(s=u=x=!0,p=!1,g=b,b=d+e,c=d+c,a<g&&(d=a,a=g,g=d,p=!0,u=!1)):(p=u=x=!0,s=!1,g=a+e,a+=c,c=b,b=d,b<c&&(d=b,b=c,c=d,s=!0,x=!1));if(!(a<h.min||g>h.max||b<j.min||c>j.max)){if(g<h.min)g=h.min,p=!1;if(a>h.max)a=h.max,u=!1;if(c<j.min)c=j.min,s=!1;if(b>j.max)b=j.max,x=!1;g=h.p2c(g);c=j.p2c(c);a=h.p2c(a);b=j.p2c(b);if(k)l.beginPath(),l.moveTo(g,c),l.lineTo(g,b),l.lineTo(a,b),l.lineTo(a,c),l.fillStyle=k(c,b),l.fill();if(o>0&&(p||u||x||s))l.beginPath(),l.moveTo(g,c+f),p?l.lineTo(g,
b+f):l.moveTo(g,b+f),x?l.lineTo(a,b+f):l.moveTo(a,b+f),u?l.lineTo(a,c+f):l.moveTo(a,c+f),s?l.lineTo(g,c+f):l.moveTo(g,c+f),l.stroke()}}function ua(a){j.save();j.translate(o.left,o.top);j.lineWidth=a.bars.lineWidth;j.strokeStyle=a.color;var d=a.bars.align=="left"?0:-a.bars.barWidth/2;(function(b,d,c,f,h,g,o){for(var l=b.points,b=b.pointsize,p=0;p<l.length;p+=b)l[p]!=null&&ga(l[p],l[p+1],l[p+2],d,c,f,h,g,o,j,a.bars.horizontal,a.bars.lineWidth)})(a.datapoints,d,d+a.bars.barWidth,0,a.bars.fill?function(b,
d){return X(a.bars,a.color,b,d)}:null,a.xaxis,a.yaxis);j.restore()}function X(a,d,b,e){var c=a.fill;if(!c)return null;if(a.fillColor)return da(a.fillColor,b,e,d);a=g.color.parse(d);a.a=typeof c=="number"?c:0.4;a.normalize();return a.toString()}function sa(){h.find(".legend").remove();if(f.legend.show){for(var a=[],d=!1,b=f.legend.labelFormatter,e,c,j=0;j<x.length;++j)if(e=x[j],c=e.label)j%f.legend.noColumns==0&&(d&&a.push("</tr>"),a.push("<tr>"),d=!0),b&&(c=b(c,e)),a.push('<td class="legendColorBox"><div style="border:1px solid '+
f.legend.labelBoxBorderColor+';padding:1px"><div style="width:4px;height:0;border:5px solid '+e.color+';overflow:hidden"></div></div></td><td class="legendLabel">'+c+"</td>");d&&a.push("</tr>");if(a.length!=0)if(d='<table style="font-size:smaller;color:'+f.grid.color+'">'+a.join("")+"</table>",f.legend.container!=null)g(f.legend.container).html(d);else if(a="",b=f.legend.position,e=f.legend.margin,e[0]==null&&(e=[e,e]),b.charAt(0)=="n"?a+="top:"+(e[1]+o.top)+"px;":b.charAt(0)=="s"&&(a+="bottom:"+
(e[1]+o.bottom)+"px;"),b.charAt(1)=="e"?a+="right:"+(e[0]+o.right)+"px;":b.charAt(1)=="w"&&(a+="left:"+(e[0]+o.left)+"px;"),d=g('<div class="legend">'+d.replace('style="','style="position:absolute;'+a+";")+"</div>").appendTo(h),f.legend.backgroundOpacity!=0){b=f.legend.backgroundColor;if(b==null)b=(b=f.grid.backgroundColor)&&typeof b=="string"?g.color.parse(b):g.color.extract(d,"background-color"),b.a=1,b=b.toString();e=d.children();g('<div style="position:absolute;width:'+e.width()+"px;height:"+
e.height()+"px;"+a+"background-color:"+b+';"> </div>').prependTo(d).css("opacity",f.legend.backgroundOpacity)}}}function ha(a){f.grid.hoverable&&Y("plothover",a,function(a){return a.hoverable!=!1})}function ia(a){f.grid.hoverable&&Y("plothover",a,function(){return!1})}function ja(a){Y("plotclick",a,function(a){return a.clickable!=!1})}function Y(a,d,b){var e=J.offset(),c=d.pageX-e.left-o.left,j=d.pageY-e.top-o.top,g=T({left:c,top:j});g.pageX=d.pageX;g.pageY=d.pageY;var d=f.grid.mouseActiveRadius,
n=d*d+1,q=null,l,p;for(l=x.length-1;l>=0;--l)if(b(x[l])){var u=x[l],y=u.xaxis,w=u.yaxis,C=u.datapoints.points,s=u.datapoints.pointsize,m=y.c2p(c),r=w.c2p(j),v=d/y.scale,D=d/w.scale;if(y.options.inverseTransform)v=Number.MAX_VALUE;if(w.options.inverseTransform)D=Number.MAX_VALUE;if(u.lines.show||u.points.show)for(p=0;p<C.length;p+=s){var B=C[p],A=C[p+1];if(B!=null&&!(B-m>v||B-m<-v||A-r>D||A-r<-D))B=Math.abs(y.p2c(B)-c),A=Math.abs(w.p2c(A)-j),A=B*B+A*A,A<n&&(n=A,q=[l,p/s])}if(u.bars.show&&!q){y=u.bars.align==
"left"?0:-u.bars.barWidth/2;u=y+u.bars.barWidth;for(p=0;p<C.length;p+=s)if(B=C[p],A=C[p+1],w=C[p+2],B!=null&&(x[l].bars.horizontal?m<=Math.max(w,B)&&m>=Math.min(w,B)&&r>=A+y&&r<=A+u:m>=B+y&&m<=B+u&&r>=Math.min(w,A)&&r<=Math.max(w,A)))q=[l,p/s]}}q?(l=q[0],p=q[1],s=x[l].datapoints.pointsize,b={datapoint:x[l].datapoints.points.slice(p*s,(p+1)*s),dataIndex:p,series:x[l],seriesIndex:l}):b=null;if(b)b.pageX=parseInt(b.series.xaxis.p2c(b.datapoint[0])+e.left+o.left),b.pageY=parseInt(b.series.yaxis.p2c(b.datapoint[1])+
e.top+o.top);if(f.grid.autoHighlight){for(e=0;e<M.length;++e)c=M[e],c.auto==a&&(!b||!(c.series==b.series&&c.point[0]==b.datapoint[0]&&c.point[1]==b.datapoint[1]))&&ka(c.series,c.point);b&&la(b.series,b.datapoint,a)}h.trigger(a,[g,b])}function W(){U||(U=setTimeout(wa,30))}function wa(){U=null;D.save();D.clearRect(0,0,E,G);D.translate(o.left,o.top);var a,d;for(a=0;a<M.length;++a)if(d=M[a],d.series.bars.show)xa(d.series,d.point);else{var b=d.series,e=d.point;d=e[0];var e=e[1],c=b.xaxis,f=b.yaxis;if(!(d<
c.min||d>c.max||e<f.min||e>f.max))D.lineWidth=2,D.strokeStyle=g.color.parse(b.color).scale("a",0.5).toString(),D.fillStyle=b.color,d=c.p2c(d),e=f.p2c(e),D.beginPath(),b.points.symbol=="circle"?D.arc(d,e,5,0,2*Math.PI,!1):b.points.symbol(D,d,e,5,!1,!0),D.closePath(),D.fill(),D.stroke()}D.restore();H(I.drawOverlay,[D])}function la(a,d,b){typeof a=="number"&&(a=x[a]);if(typeof d=="number")var e=a.datapoints.pointsize,d=a.datapoints.points.slice(e*d,e*(d+1));e=ma(a,d);if(e==-1)M.push({series:a,point:d,
auto:b}),W();else if(!b)M[e].auto=!1}function ka(a,d){a==null&&d==null&&(M=[],W());typeof a=="number"&&(a=x[a]);typeof d=="number"&&(d=a.data[d]);var b=ma(a,d);b!=-1&&(M.splice(b,1),W())}function ma(a,d){for(var b=0;b<M.length;++b){var e=M[b];if(e.series==a&&e.point[0]==d[0]&&e.point[1]==d[1])return b}return-1}function xa(a,d){D.lineWidth=a.bars.lineWidth;D.strokeStyle=g.color.parse(a.color).scale("a",0.5).toString();var b=g.color.parse(a.color).scale("a",0.5).toString(),e=a.bars.align=="left"?0:
-a.bars.barWidth/2;ga(d[0],d[1],d[2]||0,e,e+a.bars.barWidth,0,function(){return b},a.xaxis,a.yaxis,D,a.bars.horizontal,a.bars.lineWidth)}function da(a,d,b,e){if(typeof a=="string")return a;else{for(var d=j.createLinearGradient(0,b,0,d),b=0,c=a.colors.length;b<c;++b){var f=a.colors[b];if(typeof f!="string"){var h=g.color.parse(e);f.brightness!=null&&(h=h.scale("rgb",f.brightness));f.opacity!=null&&(h.a*=f.opacity);f=h.toString()}d.addColorStop(b/(c-1),f)}return d}}var x=[],f={colors:["#edc240","#afd8f8",
"#cb4b4b","#4da74d","#9440ed"],legend:{show:!0,noColumns:1,labelFormatter:null,labelBoxBorderColor:"#ccc",container:null,position:"ne",margin:5,backgroundColor:null,backgroundOpacity:0.85},xaxis:{show:null,position:"bottom",mode:null,color:null,tickColor:null,transform:null,inverseTransform:null,min:null,max:null,autoscaleMargin:null,ticks:null,tickFormatter:null,labelWidth:null,labelHeight:null,reserveSpace:null,tickLength:null,alignTicksWithAxis:null,tickDecimals:null,tickSize:null,minTickSize:null,
monthNames:null,timeformat:null,twelveHourClock:!1},yaxis:{autoscaleMargin:0.02,position:"left"},xaxes:[],yaxes:[],series:{points:{show:!1,radius:3,lineWidth:2,fill:!0,fillColor:"#ffffff",symbol:"circle"},lines:{lineWidth:2,fill:!1,fillColor:null,steps:!1},bars:{show:!1,lineWidth:2,barWidth:1,fill:!0,fillColor:null,align:"left",horizontal:!1},shadowSize:0},grid:{show:!0,aboveData:!1,color:"#545454",backgroundColor:null,borderColor:null,tickColor:null,labelMargin:5,axisMargin:8,borderWidth:2,minBorderMargin:null,
markings:null,markingsColor:"#f4f4f4",markingsLineWidth:2,clickable:!1,hoverable:!1,autoHighlight:!0,mouseActiveRadius:10},hooks:{}},R=null,S=null,J=null,j=null,D=null,B=[],F=[],o={left:0,right:0,top:0,bottom:0},E=0,G=0,O=0,K=0,I={processOptions:[],processRawData:[],processDatapoints:[],drawSeries:[],draw:[],bindEvents:[],drawOverlay:[],shutdown:[]},y=this;y.setData=Z;y.setupGrid=ba;y.draw=ca;y.getPlaceholder=function(){return h};y.getCanvas=function(){return R};y.getPlotOffset=function(){return o};
y.width=function(){return O};y.height=function(){return K};y.offset=function(){var a=J.offset();a.left+=o.left;a.top+=o.top;return a};y.getData=function(){return x};y.getAxes=function(){var a={};g.each(B.concat(F),function(d,b){b&&(a[b.direction+(b.n!=1?b.n:"")+"axis"]=b)});return a};y.getXAxes=function(){return B};y.getYAxes=function(){return F};y.c2p=T;y.p2c=function(a){var d={},b,e,c;for(b=0;b<B.length;++b)if((e=B[b])&&e.used)if(c="x"+e.n,a[c]==null&&e.n==1&&(c="x"),a[c]!=null){d.left=e.p2c(a[c]);
break}for(b=0;b<F.length;++b)if((e=F[b])&&e.used)if(c="y"+e.n,a[c]==null&&e.n==1&&(c="y"),a[c]!=null){d.top=e.p2c(a[c]);break}return d};y.getOptions=function(){return f};y.highlight=la;y.unhighlight=ka;y.triggerRedrawOverlay=W;y.pointOffset=function(a){return{left:parseInt(B[N(a,"x")-1].p2c(+a.x)+o.left),top:parseInt(F[N(a,"y")-1].p2c(+a.y)+o.top)}};y.shutdown=function(){U&&clearTimeout(U);J.unbind("mousemove",ha);J.unbind("mouseleave",ia);J.unbind("click",ja);H(I.shutdown,[J])};y.resize=function(){L();
aa(R);aa(S)};y.hooks=I;(function(){for(var a=0;a<p.length;++a){var d=p[a];d.init(y);d.options&&g.extend(!0,f,d.options)}})(y);(function(a){g.extend(!0,f,a);if(f.xaxis.color==null)f.xaxis.color=f.grid.color;if(f.yaxis.color==null)f.yaxis.color=f.grid.color;if(f.xaxis.tickColor==null)f.xaxis.tickColor=f.grid.tickColor;if(f.yaxis.tickColor==null)f.yaxis.tickColor=f.grid.tickColor;if(f.grid.borderColor==null)f.grid.borderColor=f.grid.color;if(f.grid.tickColor==null)f.grid.tickColor=g.color.parse(f.grid.color).scale("a",
0.22).toString();for(a=0;a<Math.max(1,f.xaxes.length);++a)f.xaxes[a]=g.extend(!0,{},f.xaxis,f.xaxes[a]);for(a=0;a<Math.max(1,f.yaxes.length);++a)f.yaxes[a]=g.extend(!0,{},f.yaxis,f.yaxes[a]);if(f.xaxis.noTicks&&f.xaxis.ticks==null)f.xaxis.ticks=f.xaxis.noTicks;if(f.yaxis.noTicks&&f.yaxis.ticks==null)f.yaxis.ticks=f.yaxis.noTicks;if(f.x2axis)f.xaxes[1]=g.extend(!0,{},f.xaxis,f.x2axis),f.xaxes[1].position="top";if(f.y2axis)f.yaxes[1]=g.extend(!0,{},f.yaxis,f.y2axis),f.yaxes[1].position="right";if(f.grid.coloredAreas)f.grid.markings=
f.grid.coloredAreas;if(f.grid.coloredAreasColor)f.grid.markingsColor=f.grid.coloredAreasColor;f.lines&&g.extend(!0,f.series.lines,f.lines);f.points&&g.extend(!0,f.series.points,f.points);f.bars&&g.extend(!0,f.series.bars,f.bars);if(f.shadowSize!=null)f.series.shadowSize=f.shadowSize;for(a=0;a<f.xaxes.length;++a)P(B,a+1).options=f.xaxes[a];for(a=0;a<f.yaxes.length;++a)P(F,a+1).options=f.yaxes[a];for(var d in I)f.hooks[d]&&f.hooks[d].length&&(I[d]=I[d].concat(f.hooks[d]));H(I.processOptions,[f])})(V);
(function(){var a;a=h.children("canvas.base");var d=h.children("canvas.overlay");a.length==0||d==0?(h.html(""),h.css({padding:0}),h.css("position")=="static"&&h.css("position","relative"),L(),R=$(!0,"base"),S=$(!1,"overlay"),a=!1):(R=a.get(0),S=d.get(0),a=!0);j=R.getContext("2d");D=S.getContext("2d");J=g([S,R]);a&&(h.data("plot").shutdown(),y.resize(),D.clearRect(0,0,E,G),J.unbind(),h.children().not([R,S]).remove());h.data("plot",y)})();Z(u);ba();ca();f.grid.hoverable&&(J.mousemove(ha),J.mouseleave(ia));
f.grid.clickable&&J.click(ja);H(I.bindEvents,[J]);var M=[],U=null}function w(h,g){return g*Math.floor(h/g)}g.plot=function(h,u,w){return new L(g(h),u,w,g.plot.plugins)};g.plot.version="0.7";g.plot.plugins=[];g.plot.formatDate=function(h,g,w){var p=function(g){g=""+g;return g.length==1?"0"+g:g},H=[],L=!1,N=!1,A=h.getUTCHours(),T=A<12;w==null&&(w=["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"]);g.search(/%p|%P/)!=-1&&(A>12?A-=12:A==0&&(A=12));for(var P=0;P<g.length;++P){var C=
g.charAt(P);if(L){switch(C){case "h":C=""+A;break;case "H":C=p(A);break;case "M":C=p(h.getUTCMinutes());break;case "S":C=p(h.getUTCSeconds());break;case "d":C=""+h.getUTCDate();break;case "m":C=""+(h.getUTCMonth()+1);break;case "y":C=""+h.getUTCFullYear();break;case "b":C=""+w[h.getUTCMonth()];break;case "p":C=T?"am":"pm";break;case "P":C=T?"AM":"PM";break;case "0":C="",N=!0}C&&N&&(C=p(C),N=!1);H.push(C);N||(L=!1)}else C=="%"?L=!0:H.push(C)}return H.join("")}})(jQuery);

//Flot resize
(function(n,p,u){var w=n([]),s=n.resize=n.extend(n.resize,{}),o,l="setTimeout",m="resize",t=m+"-special-event",v="delay",r="throttleWindow";s[v]=250;s[r]=true;n.event.special[m]={setup:function(){if(!s[r]&&this[l]){return false}var a=n(this);w=w.add(a);n.data(this,t,{w:a.width(),h:a.height()});if(w.length===1){q()}},teardown:function(){if(!s[r]&&this[l]){return false}var a=n(this);w=w.not(a);a.removeData(t);if(!w.length){clearTimeout(o)}},add:function(b){if(!s[r]&&this[l]){return false}var c;function a(d,h,g){var f=n(this),e=n.data(this,t);e.w=h!==u?h:f.width();e.h=g!==u?g:f.height();c.apply(this,arguments)}if(n.isFunction(b)){c=b;return a}else{c=b.handler;b.handler=a}}};function q(){o=p[l](function(){w.each(function(){var d=n(this),a=d.width(),b=d.height(),c=n.data(this,t);if(a!==c.w||b!==c.h){d.trigger(m,[c.w=a,c.h=b])}});q()},s[v])}})(jQuery,this);(function(b){var a={};function c(f){function e(){var h=f.getPlaceholder();if(h.width()==0||h.height()==0){return}f.resize();f.setupGrid();f.draw()}function g(i,h){i.getPlaceholder().resize(e)}function d(i,h){i.getPlaceholder().unbind("resize",e)}f.hooks.bindEvents.push(g);f.hooks.shutdown.push(d)}b.plot.plugins.push({init:c,options:a,name:"resize",version:"1.0"})})(jQuery);

/* Draw the graph */	
var data = [];

$(function(){
	
	var visits = null;
	var views  = null;
	
	$('#analytics').css({
		height: '200px',
		width: '100%'
	});
	
	//Get analytics data
	$.getJSON(window.location.href + "/home/analytics", function(series){
		
		visits = $.parseJSON(series.analytics_visits);
		views  = $.parseJSON(series.analytics_views);
		
		var data   = [
			{ label: 'Visits', data: visits, color: visitsColor, points: { fillColor: visitsColor } },
			{ label: 'Views', data: views, color: viewsColor, points: { fillColor: viewsColor } }
		];
		
		$.plot($('#analytics'), data, 
			{
			lines: { show: true },
			legend: {
				show: false
			},
			points: {
				show: true,
				radius: 4,
				symbol: function(ctx, x, y, radius, shadow) {
							ctx.strokeStyle = '#FFFFFF';
							ctx.arc(x, y, radius, 0, Math.PI * 2, false);
						}
			},
			grid: {
				hoverable: true,
				backgroundColor: '#ffffff',
				borderWidth: 0,
				mouseActiveRadius: 3
			},
			series: {
				lines: {
					fill: 0.1,
					show: true,
					lineWidth: 3
				},
				shadowSize: 0
			},
			xaxis: { mode: "time" },
			yaxis: { min: 0},
			selection: { mode: "x" }
		});
	})
	.error(function(xhr, textStatus, errorThrown){
		//There was a problem displaying the chart
		$("#analytics #loading").css({
			'background-image': 'none',
			'padding-left': 0,
			width: '100%',
			'text-align': 'center'
		});
		
		if(xhr.status == 401) {
			$("#analytics #loading").html('Google login details incorrect. Please change them <a href="#">here</a>');
		} else {
			$("#analytics #loading").html('There was an error displaying the graph. Try refreshing the page.');
		}
	});
	
	var previousPoint = null;
			
	$("#analytics").bind("plothover", function(event, pos, item){
		if(item) {
			if(previousPoint != item.dataIndex) {
				previousPoint = item.dataIndex;
				
				$("#analytics_tooltip").remove();
				
				var activeValue = item.datapoint[1].toFixed(0);
				var otherValue  = null;
				
				if(item.seriesIndex == 0) {
					//Hovered over visits, now get views
					otherValue = views[item.dataIndex][1];
					otherValue = otherValue.toFixed(0);
				} else {
					//Hovered over views, now get visits
					otherValue = visits[item.dataIndex][1];
					otherValue = otherValue.toFixed(0);
				}
				
				//Invert if negative
				activeValue = (activeValue < 0) ? activeValue*-1 : activeValue;
				
				if(otherValue !== null) {
					otherValue = (otherValue < 0) ? otherValue*-1 : otherValue;
				}

				//Now set tooltip contents
				var contents = null;
				
				if(activeValue == otherValue) {

					if(item.seriesIndex == 0) {
						otherLbl = 'Views';
					} else {
						otherLbl = 'Visits';
					}
					
					contents = item.series.label + '/' + otherLbl + ': <b>' + activeValue + '</b>';
					
				} else {
					contents = item.series.label + ': <b>' + activeValue + '</b>';
				}
				
				var tooltip  = '<div id="analytics_tooltip">';
					tooltip += '<div id="left"></div>';
					tooltip += '<div id="middle">';
					tooltip += contents;
					tooltip += '<div id="bttm"></div>';
					tooltip += '</div>';
					tooltip += '<div id="right"></div>';
					tooltip += '</div>';
				
				//Calculate width of tooltip
				var width = $("#analytics_tooltip").outerWidth();
				//	width = width/2;
					
				$(tooltip).appendTo("body").fadeIn(1200, function(){
					
					var tooltipWidth = $("#analytics_tooltip").outerWidth();	
					var pageWidth    = $(document).width() - (20); //Minus margin
					var leftPoint    = (item.pageX - (tooltipWidth/2)) - 2;
					
					$("#analytics_tooltip").css({
						top:  item.pageY - 34,
						left: leftPoint
					});
					
					if((leftPoint + tooltipWidth) >= pageWidth)
					{
						//Calculate new leftPoint
						leftPoint = item.pageX;
						leftPoint = leftPoint - tooltipWidth;
						leftPoint = leftPoint + 15;
						
						$("#analytics_tooltip").css({
							left: leftPoint
						});
						
						$("#analytics_tooltip #bttm").css({
							'margin-left':  'auto'
						});
					}
					else if((leftPoint - 20) <= 0)
					{
						//Calculate new leftPoint
						leftPoint = item.pageX;
						leftPoint = leftPoint - 14;
						
						$("#analytics_tooltip").css({
							left: leftPoint
						});
						
						$("#analytics_tooltip #bttm").css({
							'margin-right':  'auto'
						});
					}
					else
					{
						$("#analytics_tooltip #bttm").css({
							'left': 2,
							'margin-left': 'auto',
							'margin-right': 'auto'
						});
					}
				});
			}
		} else {
			$("#analytics_tooltip").remove();
			previousPoint = null;
		}
	});
});