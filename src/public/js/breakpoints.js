/*! breakpoints.js - v0.4.2 - 2015-04-22*/
!function(a,b,c){"use strict";function d(a,b){var c;for(var d in a)if(c=b(d,a[d]),c===!1)break}function e(a){return"function"==typeof a||!1}function f(a,b){for(var c in b)a[c]=b[c];return a}var g=b.Breakpoints=function(){g.define.apply(g,arguments)};g.defaults={xs:{min:0,max:767},sm:{min:768,max:991},md:{min:992,max:1199},lg:{min:1200,max:1/0}};var h=g.mediaBuilder={min:function(a,b){return"(min-width: "+a+b+")"},max:function(a,b){return"(max-width: "+a+b+")"},between:function(a,b,c){return"(min-width: "+a+c+") and (max-width: "+b+c+")"},get:function(a,b,c){return c||(c="px"),0===a?this.max(b,c):b===1/0?this.min(a,c):this.between(a,b,c)}},i=function(){var a=[];return{length:0,add:function(b,c,d){a.push({fn:b,data:c||{},one:d||0}),this.length++},remove:function(b){for(var c=0;c<a.length;c++)a[c].fn===b&&(a.splice(c,1),this.length--,c--)},empty:function(){a=[],this.length=0},call:function(c,d,f){d||(d=this.length-1);var g=a[d];e(f)?f.call(this,c,g,d):e(g.fn)&&g.fn.call(c||b,g.data),g.one&&(delete a[d],this.length--)},fire:function(b,c){for(var d in a)this.call(b,d,c)}}},j={current:null,callbacks:new i,trigger:function(a){var b=this.current;this.current=a,this.callbacks.fire(a,function(c,d){e(d.fn)&&d.fn.call({current:a,previous:b},d.data)})},one:function(a,b){return this.on(a,b,1)},on:function(a,b,d){return null==b&&e(a)&&(b=a,a=c),e(b)?void this.callbacks.add(b,a,d):this},off:function(a){null==a&&this.callbacks.empty()}},k=g.mediaQuery=function(a,b){this.name=a,this.media=b,this.initialize.apply(this)};k.prototype={constructor:k,initialize:function(){this.callbacks={enter:new i,leave:new i},this.mql=b.matchMedia&&b.matchMedia(this.media)||{matches:!1,media:this.media,addListener:function(){},removeListener:function(){}};var a=this;this.mqlListener=function(b){var c=b.matches&&"enter"||"leave";a.callbacks[c].fire(a)},this.mql.addListener(this.mqlListener)},on:function(a,b,d,f){var g;if("object"==typeof a){for(g in a)this.on(g,b,a[g],f);return this}return null==d&&e(b)&&(d=b,b=c),e(d)?(a in this.callbacks&&(this.callbacks[a].add(d,b,f),this.isMatched()&&"enter"===a&&this.callbacks[a].call(this)),this):this},one:function(a,b,c){return this.on(a,b,c,1)},off:function(a,b){var c;if("object"==typeof a){for(c in a)this.off(c,a[c]);return this}return null==a&&(this.callbacks.enter.empty(),this.callbacks.leave.empty()),a in this.callbacks&&(b?this.callbacks[a].remove(b):this.callbacks[a].empty()),this},isMatched:function(){return this.mql.matches},destory:function(){this.off()}};var l=function(a,b,c,d){this.name=a,this.min=b?b:0,this.max=c?c:1/0,this.media=h.get(this.min,this.max,d),this.initialize.apply(this);var e=this;this.changeListener=function(){e.isMatched()&&j.trigger(e)},this.isMatched()&&(j.current=this),this.mql.addListener(this.changeListener)};l.prototype=k.prototype,l.prototype.constructor=l,f(l.prototype,{destory:function(){this.off(),this.mql.removeListener(this.changeHander)}});var m=function(a){this.name=a,this.sizes=[];var b=this,c=[];d(a.split(" "),function(a,d){var e=g.get(d);e&&(b.sizes.push(e),c.push(e.media))}),this.media=c.join(","),this.initialize.apply(this)};m.prototype=k.prototype,m.prototype.constructor=m;var n={},o={};g=f(g,{defined:!1,define:function(a,b){this.defined&&this.destory(),a||(a=g.defaults),this.options=f(b||{},{unit:"px"});for(var c in a)this.set(c,a[c].min,a[c].max,this.options.unit);this.defined=!0},destory:function(){d(n,function(a,b){b.destory()}),n={},j.current=null},is:function(a){var b=this.get(a);return b?b.isMatched():null},all:function(){var a=[];return d(n,function(b){a.push(b)}),a},set:function(a,b,c,d){var e=this.get(a);return e&&e.destory(),n[a]=new l(a,b||null,c||null,d||null),n[a]},get:function(a){return n.hasOwnProperty(a)?n[a]:null},getUnion:function(a){return o.hasOwnProperty(a)?o[a]:(o[a]=new m(a),o[a])},getMin:function(a){var b=this.get(a);return b?b.min:null},getMax:function(a){var b=this.get(a);return b?b.max:null},current:function(){return j.current},getMedia:function(a){var b=this.get(a);return b?b.media:null},on:function(a,b,c,d,e){if("change"===a)return d=c,c=b,j.on(c,d,e);if(a.indexOf(" ")){var f=this.getUnion(a);f&&f.on(b,c,d,e)}else{var g=this.get(a);g&&g.on(b,c,d,e)}return this},one:function(a,b,c,d){return this.on(a,b,c,d,1)},off:function(a,b,c){if("change"===a)return j.off(b);if(a.indexOf(" ")){var d=this.getUnion(a);d&&d.off(b,c)}else{var e=this.get(a);e&&e.off(b,c)}return this}})}(document,window);