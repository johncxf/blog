if (!Array.prototype.get) {
  Array.prototype.get = function(index){
    return this[index];
  }
}
/* 
 * addEventListener:监听Dom元素的事件 
 * 
 * target：监听对象 
 * type：监听函数类型，如click,mouseover 
 * func：监听函数 
 */

var support_css = (function() {
 var div = document.createElement('div'),
  vendors = 'Ms O Moz Webkit'.split(' '),
  len = vendors.length;
  
 return function(prop) {
  if ( prop in div.style ) return true;
  
  prop = prop.replace(/^[a-z]/, function(val) {
   return val.toUpperCase();
  });
  
  while(len--) {
   if ( vendors[len] + prop in div.style ) {
   return true;
   } 
  }
  return false;
 };
})();

function addEventHandler(target,type,func, useCapture){
  if (!target) {
    return;
  }
 if(target.addEventListener){ 
  //监听IE9，谷歌和火狐 
  target.addEventListener(type, func, useCapture==true); 
 }else if(target.attachEvent){ 
  target.attachEvent("on" + type, func); 
 }else{ 
  target["on" + type] = func; 
 } 
} 
/* 
 * removeEventHandler:移除Dom元素的事件 
 * 
 * target：监听对象 
 * type：监听函数类型，如click,mouseover 
 * func：监听函数 
 */
function removeEventHandler(target, type, func, useCapture) { 
  if (!target) {
    return;
  }
 if (target.removeEventListener){ 
  //监听IE9，谷歌和火狐 
  target.removeEventListener(type, func, userClose == true); 
 } else if (target.detachEvent){ 
  target.detachEvent("on" + type, func); 
 }else { 
  delete target["on" + type]; 
 } 
}

function zIndex(index, level){
  var level = level || 0;
  var num = +new Date + '';
  var str = num.substr(-5-level);
  var index = index || 0;
  return str + index;
}

function windowSize(){
  if (window.innerWidth){
    winWidth = window.innerWidth;
  }else if ((document.body) && (document.body.clientWidth)){
    winWidth = document.body.clientWidth;
  }
  // 获取窗口高度
  if (window.innerHeight){
    winHeight = window.innerHeight;
  }else if ((document.body) && (document.body.clientHeight)){
    winHeight = document.body.clientHeight;
  }
  // 通过深入 Document 内部对 body 进行检测，获取窗口大小
  if (document.documentElement && document.documentElement.clientHeight && document.documentElement.clientWidth)
  {
  winHeight = document.documentElement.clientHeight;
  winWidth = document.documentElement.clientWidth;
  }
  return {
    width: winWidth,
    height: winHeight
  }
}

var userUpTimer, userDownTimer;
function usrOpen(event){
  if (userDownTimer) {
   clearTimeout(userDownTimer);
   userDownTimer = null;
 }
   document.getElementById('user-tools').className = 'user-tools user-tools-active';
   userUpTimer = setTimeout(function(){
      document.getElementById('user-menu').className = 'user-menu user-menu-up';
   },1);
}

function userClose(){
  if (userUpTimer) {
  clearTimeout(userUpTimer);
  userUpTimer = null;
}
  document.getElementById('user-menu').className = 'user-menu user-menu-down';
  userDownTimer = setTimeout(function(){
     document.getElementById('user-tools').className = 'user-tools';
     document.getElementById('user-menu').className = 'user-menu';
  },300);
}

function ajaxForm(form, $url){
   if (typeof form === "string") {
      form = document.getElementById(form);
   }
   if (!form || !form.tagName || !form.submit) {
    return;
   }
   var data = serialize(form, true);
   if (this.slug && !validate(data, this.slug)) {
     return;
   }
   if (!InstantClick.supported) {
      return form.submit();
   }
   var that = this;
   var url = form.action ? form.action : window.location.href,
        $url = $url || url;

    if (this.target && this.target=="comment-form") {
       var hashIndex = $url.indexOf("#");
       var hash = "#comment-form";
       if (data.parent) {
          hash = "#comment-"+data.parent;
       }
       if(hashIndex>-1){
         $url = $url.substr(0, hashIndex);
       }
       $url += hash;
    }
    InstantClick.bar.start(0, true);
    var start = +new Date + 0;
    var type = form.method ? form.method : 'post';
    return ajax(url, {
      type:type,
      data: data,
      success:function(responseText){
        that.text && ArmMessage.success(that.text+'成功');
        InstantClick.reload($url);
      },
      error:function(){
        ArmMessage.error(target.text+'失败, 请重试');
      },
      complete:function(){
        InstantClick.bar.done();
      }
    });
}


function validate(data, rule){
  switch (rule) {
    case 'comment':
          if (typeof data.author!=="undefined" && !trim(data.author).length) {
            return returnFalse('请填写昵称');
          }
          if (typeof data.mail!=="undefined" && !trim(data.mail).length) {
            return returnFalse('请填写邮箱');
          }
          if ( !/^([^@]+)@([^.]+)\.([^.]+)/.test(data.mail)) {
            return returnFalse('这个邮箱收不到邮件啊');
          }
         if (trim(data.url).length && !/^https?:\/\/([^.]+)\.([^.]+)/.test(data.url)) {
            return returnFalse('这个网站打不开啊');
          }
          if (typeof data.text!=="undefined" && !trim(data.text).length) {
            return returnFalse('评论内容呢？');
          }
      break;
  }

  return true;
}

function serialize(form, toArray) {
  if (typeof form === "string") {
    form = document.getElementById(form);
  }
  if (!form) {
    return toArray ? [] : null;
  }
  var data = [];
  var parse = function(elems){
    for (var i = 0; i < elems.length; i++) {
      if ((/radio|checkbox/.test(elems[i].type) && !elems[i].checked) || elems[i].disabled ) {
         continue;
      }
      data[elems[i].name] =  trim(elems[i].value);
    }
  }
  parse(form.getElementsByTagName('input'));
  parse(form.getElementsByTagName('select'));
  parse(form.getElementsByTagName('textarea'));
  return data;
}

function trim(string){
  return string.replace(/^\s+/,'').replace(/\s+$/,'');
}

function extend(obj1, obj2, newObj) {
  var key;
  if (typeof obj2==="object" && typeof obj1 === "object") {
    if(newObj){
      var obj = {};
      for (key in obj1) {
        obj[key] = obj1[key];
      }
      for (key in obj2) {
        obj[key] = obj2[key];
      }
      return obj;
    }else{
      for(key in obj2){
        obj1[key] = obj2[key];
      }
    }
  }
  return obj1;
}

function showLoading(){
  var loading = document.getElementById('loading');
  if (!loading) {
     loading = document.createElement('div');
     loading.className = 'loading';
     loading.id = 'loading';
     document.body.appendChild(loading);
  }
  loading.className = 'loading loading-active';
}

function hideLoading(){
  if (document.getElementById('loading')) {
    document.getElementById('loading').className = 'loading';
  }
}

function addClass(element, className){
  if (!element) {
    return;
  }
   var className = trim(className).split(/\s+/);
   var _className = element.className;
   for (var i = 0; i < className.length; i++) {
     if (!className[i] ||
      new RegExp('([\s\'"]+)?'+className[i]+'([\s\'"]+)?', 'ig').test(_className) ) {
      continue;
     }
     _className += ' ' + className[i];
   }
   element.className = trim(_className).replace(/\s+/, ' ');
}

function hasClass(element, className) {
  return element && element.className && new RegExp('([\s\'"]+)?'+className+'([\s\'"]+)?', 'ig').test(element.className);
}

function removeClass(element, className) {
  if (!element) {
    return;
  }
  var className = trim(className).split(/\s+/);
  var _className = trim(element.className);
  for (var i = 0; i < className.length; i++) {
    if (!className[i]) {
      continue;
    }
    _className = _className.replace(new RegExp('([\s\'"]+)?'+className[i]+'([\s\'"]+)?', 'ig'), '$1$2');
  }
  if (_className!==element.className) {
    element.className = trim(_className).replace(/\s+/, ' ');
  }
}

function getScrollOffset(){
    // 除IE8及更早版本
    if( window.pageXOffset != null ){
        return {
            x : window.pageXOffset,
            y : window.pageYOffset
        }
    }
    // 标准模式下的IE
    if( document.compatMode == "css1Compat" ){
        return {
            x : document.documentElement.scrollLeft,
            y : document.documentElement.scrollTop
        }
    }
    // 怪异模式下的浏览器
    return {
        x : document.body.scrollLeft,
        y : document.body.scrollTop
    }
}

/**
 * 判断是否为选择元素
 * @author NatLiu
 * @date   2018-01-18T10:29:27+0800
 * @param  {[type]}                 element  [description]
 * @param  {[type]}                 selector [description]
 * @return {Boolean}                         [description]
 */
function isSelectorElement(element, selector) {
  if (!element || element.nodeType!=1) {
    return false;
  }
  if (typeof selector === "string") {
    if (selector === '*') {
      return true;
    }
    if ( /^#\S+/i.test(selector) ) {
       return document.getElementById( selector.replace(/^#/,'') ) == element;
    }
    var match = selector.match(/([^\.\[]+)?(\[\w+=\w+\])?(\.\S+)?/);
    if (!match || !match.length) {
      return false;
    }

    if (match[1] && match[1].toUpperCase() != element.tagName.toUpperCase() ) {
       return false;
    }

    if (match[2]) {
       var attrs = match[2].replace(/\[([^\[\]]+)\]/,'$1').split('=');
       if (element.getAttribute(attrs[0]) != attrs[1] ) {
         return false;
       }
    }

    if (match[3]) {
      var classNames = match[3].split('.');
      for (var i = 0; i < classNames.length; i++) {
        if ( !hasClass(element, classNames[i] ) ) {
          return false;
        }
      }

    }

    return true;
  }
  return element == selector;
}
/**
 * 查找所有匹配的子元素
 * @author NatLiu
 * @date   2018-01-18T11:23:29+0800
 * @param  {[type]}                 selector [description]
 * @param  {[type]}                 finds    [description]
 * @param  {[type]}                 parent   [description]
 * @return {[type]}                          [description]
 */
function findElements(selector, context, querySelectorAll) {
  if (typeof selector!=="string") {
    if (typeof selector == "object" && selector.tagName) {
      return [selector];
    }
    return [];
  }
  var parent;
  if (context) {
    var parent = findElements(context)[0];
    if (!parent) {
      return [];
    }
  }
  if (typeof document.querySelectorAll == "function" ) {
    var parent = parent || document;
    var finds = parent.querySelectorAll(selector);
    return finds;
  }
  var matches = selector.split(','), finds = [], selectorGroup = [];
  for (var j = 0; j < matches.length; j++) {
    var selectors = matches[j].split(/\s+/), isBreak = false;
    for (var i = 0; i < selectors.length; i++) {
      if (/^#\S+/i.test(selectors[i]) && !document.getElementById( selectors[i].replace(/^#/,'') ) ) {
        isBreak = true;
        break;
      }
    }
    if (!isBreak) {
      if (parent) {
        selectors.splice(0,0, parent);
      }
      selectorGroup.push(selectors);
    }
  }
  if (selectorGroup.length==1 && selectorGroup[0].length == 1 && /^#\S+/i.test(selectorGroup[0][0])) {
     return [document.getElementById( selectorGroup[0][0].replace(/^#/,'') )];
  }

  var elements = document.getElementsByTagName('*');
  for (var i = 0; i < elements.length; i++) {

     var matches = _matchChildNodes(elements[i], selectorGroup);
     if (matches === true) {
        finds.push(elements[i]);
        continue;
     }
     if (!matches.length) {
       continue;
     }
     var parentMatches = _matchParentNodes( elements[i], matches );
     if ( parentMatches ) {
        finds.push(elements[i]);
     }
     
  }
  return finds;
}

/**
 * 匹配子元素
 * @author NatLiu
 * @date   2018-01-22T09:10:49+0800
 * @param  {[type]}                 element       [description]
 * @param  {[type]}                 selectorGroup [description]
 * @return {[type]}                               [description]
 */
function _matchChildNodes(element, selectorGroup) {
  var matches = [];
  for (var i = 0; i < selectorGroup.length; i++) {
    var selector = selectorGroup[i][selectorGroup[i].length-1];
    if (isSelectorElement(element, selector) ) {
       if (selectorGroup[i].length==1) {
         matches = true;
         break;
       }
       matches.push(selectorGroup[i]);
    }
  }
  return matches;
}

/**
 * 匹配父级元素
 * @author NatLiu
 * @date   2018-01-22T09:11:07+0800
 * @param  {[type]}                 element     [description]
 * @param  {[type]}                 parentGroup [description]
 * @return {[type]}                             [description]
 */
function _matchParentNodes(element, parentGroup) {
   var parent = element.parentNode, parentMathes = [];
   var match = false;
   while (parent && parent != parent.parentNode && !match) {
      for (var i = 0; i < parentGroup.length; i++) {
         var node = parentGroup[i];
         parentMathes[i] = typeof parentMathes[i] == "undefined" ? node.length - 2 : parentMathes[i];
         if (isSelectorElement(parent, node[parentMathes[i]] )) {
            if (parentMathes[i] == 0) {
              match = true;
              break;
            }
            parentMathes[i]--;
         }
      }
      if (match) {
        break;
      }
      parent = parent.parentNode;
   }
   return match;
}

/**
 * 选择第一级子元素
 * @author NatLiu
 * @date   2018-01-18T10:29:41+0800
 * @param  {[type]}                 element  [description]
 * @param  {[type]}                 selector [description]
 * @return {[type]}                          [description]
 */
function childrenElements(selector, parent) {
  parent = parent || document.documentElement;
  if (typeof parent !=="object" || parent.nodeType!=1) {
    parent = findElements(parent)[0];
  }
  if (!parent || !parent.childNodes || !parent.childNodes.length) {
    return [];
  }
  var children = [], nodes = parent.childNodes;
   for (var i = 0; i < nodes.length; i++) {
     if (nodes[i].nodeType == 1) {
      if (selector) {
        if (isSelectorElement(nodes[i], selector )) {
          children.push(nodes[i]);
        }
      }else{
        children.push(nodes[i]);
      }
     }
   }
   return children;
}

function getHeight(dom, height, withPadding){
   var height = dom.innerHeight || dom.clientHeight || dom.offsetHeight || dom.scrollHeight;
   if (withPadding && dom.style) {
      height += parseInt(dom.style.paddingTop) + parseInt(dom.style.paddingBottom);
      height += parseInt(dom.style.borderTop) + parseInt(dom.style.borderBottom);
   }
   return height;
}

function getWidth(dom, height, withPadding){
   var width = dom.innerWidth || dom.clientWidth || dom.offsetWidth || dom.scrollWidth;
   if (withPadding && dom.style) {
      width += parseInt(dom.style.paddingLeft) + parseInt(dom.style.paddingRight);
      width += parseInt(dom.style.borderLeft) + parseInt(dom.style.borderRight);
   }
   return width;
}

var prefixStyle = (function(){
  var _elementStyle = document.createElement('div').style;
  return function _prefixStyle (style) {
    if(style in _elementStyle)
      return style;
    var vendors = ['webkit', 'Moz', 'ms', 'O'],
          s,
          i = 0,
          l = vendors.length;

      for ( ; i < l; i++ ) {
          s = vendors[i] + style.charAt(0).toUpperCase() + style.substr(1);
          if ( s in _elementStyle) return s;
      }
      return false;
  }
})();

function toggleClass(element, className) {
    if (!element) {
    return;
  }
    if(new RegExp('([\s\'"]+)?'+className+'([\s\'"]+)?', 'ig').test(element.className)){
      removeClass(element, className);
    }else{
      addClass(element, className);
    }
}
var rvalidtokens = /(,)|(\[|{)|(}|])|"(?:[^"\\\r\n]|\\["\\\/bfnrt]|\\u[\da-fA-F]{4})*"\s*:?|true|false|null|-?(?!0\d)\d+(?:\.\d+|)(?:[eE][+-]?\d+|)/g;
function parseJSON(data){
   if (window.JSON && JSON.parse) {
      return JSON.parse(data);
   }
  var requireNonComma,
    depth = null,
    str = trim( data + "" );
  return str && !trim( str.replace( rvalidtokens, function( token, comma, open, close ) {

    if ( requireNonComma && comma ) {
      depth = 0;
    }
    if ( depth === 0 ) {
      return token;
    }
    requireNonComma = open || comma;

    depth += !close - !open;
    return "";
  } ) ) ?
    ( Function( "return " + str ) )() :
    throwError( "Invalid JSON: " + data );

}

function throwError(str){
    throw new Error( str );
}

function addZero(number, digits){
  var number = ''+number;
  var digits = digits || 2;
   if (digits > number.length) {
      number = new Array(digits - number.length + 1).join('0') + number;
   }
   return number;
}

function getRandomNum(Min,Max){   
  var Range = Max - Min;   
  var Rand = Math.random();   
  return (Min + Math.round(Rand * Range));   
}

function ajaxResponse(){
  var handler = arguments[0];
  var args = [];
  if (arguments.length>1) {
    for (var i = 1; i < arguments.length; i++) {
      args.push(arguments[i]);
    }
  }
  typeof this.options[handler] === "function" && this.options[handler].apply(this, args);
  typeof this.options.complete === "function" && this.options.complete.apply(this, args);
}

function ajaxConvert(text, type) {
  switch (type) {
    case 'json':
      return parseJSON(text);
      break;
  }
  return text;
}

function ajax(url, params){
  var xmlhttp;
  if (window.XMLHttpRequest)
  {// code for all new browsers
    xmlhttp=new XMLHttpRequest();
  }
  else if (window.ActiveXObject)
  {// code for IE5 and IE6
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  if (!xmlhttp) {
    return throwError("Your browser does not support XMLHTTP.");
  }
  
  var type = 'GET',
      async = true,
      data = [],
      paramstring = '',
      url = url.replace(/(#.+)?/i, ''),
      urlParamstring = url.replace(/[^\?]+\?([^=]+=[\S]+)?/i, "$1"),
      formData = null;
  if (typeof params === "object") {
    if (typeof params.type == "string" && (params.type.toUpperCase() === "GET" || params.type.toUpperCase() ==="POST") ) {
      type = params.type.toUpperCase();
    }

    if (typeof params.async === "boolean") {
       async = params.async;
    }

    if (typeof params.data === "object") {
      if (window.FormData && params.formData === true) {
        formData = new FormData();
      }
       for (key in params.data) {
         if (formData) {
           formData.append(key, params.data[key]);
         }
         if (typeof params.data[key] === "object") {
            params.data[key] = JSON.stringify(params.data[key]);
         }
         data.push(key+'=' + params.data[key]);
       }
    }else if(typeof params.data === "string" && /[^=]+=[\S]+/i.test(params.data)){
      data.push(params.data);
    }
  }

  paramstring = data.join('&');

  if (type === "GET") {
     if (urlParamstring !== url) {
        url = url + (paramstring.length ? '&' + paramstring : '');
     }else{
        url = url + (paramstring.length ? '?' + paramstring : '');
     }
  }
  xmlhttp.open(type, url, async);

  var options = typeof params === "object" ? params : {};
  var xhrData = {
     url: url,
     xhr: xmlhttp,
     options: options
  };
  xmlhttp.onabort = function(event){
    ajaxResponse.call(xhrData, 'error', event, 'abort');
  };

  xmlhttp.onerror = function(event){
    ajaxResponse.call(xhrData, 'error', event, 'error');
  }

  xmlhttp.ontimeout = function(event){
    ajaxResponse.call(xhrData, 'error', event, 'timeout');
  }

  xmlhttp.onreadystatechange = function(){
    if (xmlhttp.readyState==4) {
      var isSuccess = xmlhttp.status >= 200 && xmlhttp.status < 300 || xmlhttp.status === 304;
      if (isSuccess) {
        ajaxResponse.call(xhrData, 'success', ajaxConvert(xmlhttp.responseText, options.dataType));
      }else{
        ajaxResponse.call(xhrData, 'error', xmlhttp.status, 'error');
      }
    }
  }

  if (type === "POST") {
    xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    xmlhttp.send( formData ? formData : (paramstring ? paramstring : null) );
  }else{
    xmlhttp.send(null);
  }
  return xhrData;
  
}

function returnFalse(msg){
  ArmMessage.error(msg);
  return false;
}

var cookie = (function(doc){

  function getCookie(name){
    var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
    if(arr=doc.cookie.match(reg)){
        return unescape(arr[2]);
    }
    return null;
  }

  function setCookie(name,value,time){
    time = time || '3d'; //默认3天
    var strsec = getsec(time);
    var exp = new Date();
    exp.setTime(exp.getTime() + strsec*1);
    doc.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
  }

  function removeCookie(name){
    var exp = new Date();
    exp.setTime(exp.getTime() - 1);
    var cval = getCookie(name);
    if(cval!=null)
    doc.cookie= name + "="+cval+";expires="+exp.toGMTString();
  }

  function getsec(str){
    if (typeof str ==="number") {
      return str *1000;
    }
    var str1= 1 * str.substring(0,str.length-1);
    var str2=str.substr(-1,1);
    if (str2=="s"){
      return str1*1000;
    }
    else if (str2=="h"){
      return str1*60*60*1000;
    }else if (str2=="d"){
      return str1*24*60*60*1000;
    }
  }

  return {
    getItem: getCookie,
    setItem: setCookie,
    removeItem: removeCookie
  }
})(document);


/**
 * 对话框
 * @param  {[type]} win [description]
 * @param  {[type]} doc [description]
 * @return {[type]}     [description]
 */
;(function(win, doc){

    var current;
    var dialog = function(){
        
    }

    dialog.prototype.open = function(el, options){
        if (typeof el === "string") {
          el = document.getElementById(el);
        }
        if (current) {
          this._close(current);
        }
        var newcreate = false;
        if (!el || !el.tagName) {
            newcreate = true;
            options = typeof el === "object" ? el : options;
            var el = document.createElement('DIV'),
            body = typeof options.content == "function" ? options.content() : options.content;
            if (options.type==="iframe") {
               body = '<div class="dialog-loading"></div><iframe src="'+body+'" style="position:absolute; right:0; top:0; bottom:0; left:0;" width="100%" height="100%" marginheight="0" marginheight="0" frameborder="0" scrolling="auto"></iframe>';
            }
          var style = '', win = windowSize(),
              className = 'dialog dialog-dynamic' + (options.className ? ' '+options.className : '');;
          if (options.width) {
             options.width = parseInt(options.width);
             if (options.width > win.width-10) {
              options.width = win.width-10;
             }
             style += 'width:'+options.width + 'px;';
             style += 'margin-left:'+(-options.width/2) + 'px;';
             style += 'left:50%; right:auto;';
          }
          if (options.width) {
            options.height = parseInt(options.height);
            if (options.height > win.height-10) {
              options.height = win.height-10;
            }
            style += 'height:'+options.height + 'px;';
            style += 'margin-top:'+(-options.height/2) + 'px;';
            style += 'top:50%; bottom:auto;';
          }
          el.innerHTML = '<div class="dialog-bg" data-dialog-toggle="close"></div>\
                          <div class="dialog-box" style="'+style+'">\
                            <div class="dialog-body">'
                            + body +
                            '</div>\
                          </div>';

          var iframe = findElements('iframe', el)[0], loading = findElements('.dialog-loading', el)[0];
          el.className = className;
          document.body.appendChild(el);
          if (iframe && loading) {
            setTimeout(function(){
              loading.style.width = options.width*0.9 + 'px';
            }, 700);
            iframe.onload = function(){
              loading.style.width = options.width + 'px';
              loading.parentNode.removeChild(loading);
            }
          }
        }
        if (!el.id) {
           el.id = options.id || 'dialog-' + Number(new Date());
        }
        if (newcreate) {
          typeof options.oncreate == "function" && options.oncreate.call(el);
        }
        return this._open(el, options ? options : {});
    }

    dialog.prototype._open = function(el, options){
      var that = this;
      addClass(el, 'dialog dialog-open');
      el.style.zIndex = zIndex();
      current = el;
      if (!el._isDialog) {
        addEventHandler(el, 'click', function(event){
          var target = event.target || event.srcElement;
          if (target) {
            var action = target.getAttribute('data-dialog-toggle');
            if (action==="close") {
               that.close(el);
            }
          }
        });
        el._isDialog = true;
      }
      typeof options.open == "function" && options.open.call(el);
    }

    dialog.prototype.close = function(el){
      if (typeof el === "string") {
        el = document.getElementById(el);
      }
      if (el && el.tagName) {
        this._close(el);
      }
    }

    dialog.prototype._close = function(el){
      if (hasClass(el, 'dialog-dynamic')) {
        el.parentNode.removeChild(el);
      }else{
        removeClass(el, 'dialog-open');
      }
      current = null;
    }

    window.ArmDialog = new dialog;
})(window, document);

;(function(win, doc){
    var support = support_css('transform');
    var messageTypes = {
        success: {},
        error:{},
        warn: {},
        info:{},
        normal:{
           icon:false
        }
    };
    var idx = 0;
    var queue = [];
    var tags = {};
    var map = {};
    var box = null;
    var config = {
        animateIn: 400,
        animateOut: 400,
        time: 2000,
        position: 'rb',
        distance: '10px',
        boxWidth: 240,
        opacity: 0.8,
        translateY: false,
        translateBack: true
    };
    var _position = config.position;

    var poses = {
        rb: {

        },
        rt: {

        },
        lb:{

        },
        lt:{

        },
        cb:{

        },
        ct:{

        }
    };

    function msgId(index){
      return 'msg'+index;
    }

    function getMsg(index){
      return queue[map[msgId(index)]];
    }

    function msgBox(position, open){
       if (!box) {
          box = doc.createElement('DIV');
          box.className = 'message-box';
          box.id = 'message-box';
          doc.body.appendChild(box);
        }
        if (open==true) {
          var pos = poses[position] ? position : config.position;
          box.style.left = /l/i.test(pos) ? config.distance : 'auto';
          box.style.right = /r/i.test(pos) ? config.distance : 'auto';
          box.style.top = /t/i.test(pos) ? config.distance : 'auto';
          box.style.bottom = /b/i.test(pos) ? config.distance : 'auto';
          if (/c/i.test(pos)) {
            box.style.left = "50%";
            box.style.right = "auto";
            box.style.marginLeft =  - config.boxWidth / 2 + 'px';
          }
          box.style.zIndex = zIndex(1,1);
          _position = pos;
        }
        return box;
    }

    function getConfig(key){
        if (key && typeof key==="string") {
          return config[key];
        }
        if (typeof key === "object") {
          for (i in key) {
            if(typeof i !=="undefined"){
              break;
            }
            config[i] = key[i];
          }
        }
        var name, _config = {};
        for (name in config) {
          _config[name] = config[name];
        }
        return _config;
    }

    function closeAll(){
       queue = [];
       map = {};
       tags = {};
       msgBox().innerHTML = '';
    }

    function close(index, destroy){
      var msgData = getMsg(index);
      if (msgData && msgData.id) {
        var target = document.getElementById(msgData.id);
        if (!target) {
          return;
        }
        msgData.status = -1;
        var timer = support && !destroy ? config.animateOut : 0;
        if (support) {
          target.style[prefixStyle('transition')] = 'all '+config.animateOut+'ms';
          setTimeout(function(){
            var distance = msgData.translateBack == false ? 0 - msgData.ani.distance : msgData.ani.distance;
            target.style[prefixStyle('transform')] = msgData.ani.translate+'('+ distance +'px)';
            target.style.opacity = 0;
          },1);
        }
        setTimeout(function(){
          if (target && target.nodeType == 1){
            try {
              msgBox().removeChild(target);
            } catch(e) {
            }
          }
        }, timer);
      }
    }

    function delay(index, delay){
      var msgData = getMsg(index);
      if (msgData) {
        msgData.timer = setTimeout(function(){
          close(index);
        }, delay);
      }
    }

    function getAni(translateY){
      var translate = 'translateX';
      var distance = config.boxWidth;
      var dir = translateY || config.translateY;
       if (/c/i.test(_position) || dir) {
          translate = 'translateY';
          distance = 100;
       }
       if ( (translate==="translateX" && /l/i.test(_position)) 
          ||(translate==="translateY" && /t/i.test(_position)) ){
          distance = -distance;
       }
       return {
          translate: translate,
          distance: distance
       }
    }

    function getTag(tagName, index, type){
      var tagName = tagName || 'message';
      if (!tags[tagName]) {
        tags[tagName] = [];
      }
      if (!tags[type]) {
        tags[type] = [];
      }
      tags[tagName].push(index);
      tags[type].push(index);
      return tagName;
    }

    function open(text, options){
      if (!support) {
        closeAll();
      }
      var msg = doc.createElement('DIV'),
            timestamp = +new Date;
            index = zIndex(++idx, 1);
            id = msgId(index),
            type = messageTypes[options.type] ? options.type : 'normal';

        msg.className = 'message message-'+type;
        msg.id = id;
        msg.style.zIndex = index;
        var _type = messageTypes[type];
        var icon = options.icon || '';
        if(!icon){
          if (_type.icon) {
            icon = 'message-type-icon icon-white-'+_type.icon;
          }else if(_type.icon!==false){
            icon = 'message-type-icon icon-white-'+type;
          }
          if (options.tag && options.tag!=='message' && options.icon!==false) {
            icon = 'message-tag-icon icon-white-'+options.tag;
          }
        }
        var html = '<div class="message-body">\
                        <div class="message-content">'+text+'</div>\
                    </div>';
        if (icon) {
          msg.className += ' message-has-icon';
          html += '<div class="message-icon icon '+icon+'"></div>';
        }
        msg.innerHTML = html;
        var msgData = {
           index: index,
           timestamp: timestamp,
           id: id,
           type: type,
           text: text,
           status: 0,
           tag: getTag(options.tag, index, type),
           time: typeof options.time ==="number" ? options.time : config.time,
           ani: getAni(options.translateY),
           action: options.action || '',
           translateBack: options.translateBack !== false,
           position: options.position || config.position
        };
        if (support) {
          msg.style[prefixStyle('transform')] = msgData.ani.translate+'('+msgData.ani.distance+'px)';
          msg.style.opacity = 0;
          msg.style[prefixStyle('transition')] = 'all '+config.animateIn+'ms';
        }
        if (msgData.action) {
           msg.setAttribute('data-action', msgData.action);
        }
        map[id] = queue.length;
        queue.push(msgData);
        var box = msgBox(options.position, true);
        if (box.childNodes.length) {
           box.insertBefore(msg, box.childNodes[0]);
        }else{
          box.appendChild(msg);
        }
        typeof options.onopen === "function" && options.onopen.call(msg, msgData);
        if (support) {
          setTimeout(function(){
            msg.style[prefixStyle('transform')] = msgData.ani.translate+'(0px)';
            msg.style.opacity = config.opacity;
          },15);
        }

        setTimeout(function(){
          typeof options.onopened === "function" && options.onopened.call(msg, msgData);
        }, support ? config.animateIn : 0);

        options.clickClose && addEventHandler(msg, 'click', function(){
           close(index);
        }, true);
        addEventHandler(msg, 'mouseenter', function(){
          if (msgData.timer) {
             clearTimeout(msgData.timer);
             msgData.timer = null;
          }
           addClass(msg, 'message-focus');
        });
        addEventHandler(msg, 'mouseleave', function(){
           delay(index, 500);
        });
        delay(index, msgData.time);
        return index;
    }

    var message = function(){
        this.version = '1.0';
    };
    message.prototype.config = function(key, value){
        if (typeof key==="string" && arguments.length == 2) {
           config[key] = value;
           return true;
        }
        return getConfig(key);
    }

    message.prototype.success = function(text, options){
       return this.open(text ,options, 'success');
    }

     message.prototype.error = function(text, options){
       return this.open(text , options, 'error');
    }

     message.prototype.warn = function(text, options){
       return this.open(text ,options, 'warn');
    }

     message.prototype.info = function(text, options){
       return this.open(text ,options, 'info');
    }

    message.prototype.open = function(text, options, _type){
        if (!text && text!=='' && text!==0) {
          return null;
        }
        if (typeof options === "object") {
          var type = options.type || 'normal';
        }else{
          var type = options;
          options = {}
        }
        options.type = _type || options.type;
        return open(text, options);
    }

    message.prototype.close = function(index){
        return close(index);
    }

    message.prototype.destroy = function(index){
      return close(index, true);
    }

    window.ArmMessage = new message;
})(window, document);

function reloadPage(){
  if (InstantClick && InstantClick.supported) {
    InstantClick.removeCache();
    InstantClick.reload(window.location.href);
  }else{
    setTimeout(function(){
      window.location.reload();
    },500);
  }
}


;(function(win, doc){
  var defaults = {
     fixed: false,
     title: '目录'
  };
  var Index = function(){
     
  };

  Index.prototype.init = function(element, options){
    this.element = findElements(element)[0];
    this.options = extend(defaults, options);
    if (!this.element || !this.options.target) {
      this.hasInit = false;
      return this;
    }
    this.headers = findElements('h2,h3', this.options.target);
    if (!this.headers || !this.headers.length) {
      this.hasInit = false;
      return this;
    }
    this.hasInit = true;
    this.options.width = getWidth(this.element);
    this.options.offsetTop = this.element.offsetTop;
    this.parseHeaders();
    this.build(this.data, this.element);
    var that = this;
    addEventHandler(window, 'scroll', function(event){
      that.scroll(event);
    });
  }

  Index.prototype.parseHeaders = function(){
    if (!this.hasInit) {
      return [];
    }
    this.data = [];
    this.headerIds = [];
    for (var i = 0; i < this.headers.length; i++) {
      var header = this.headers[i], tagName = header.tagName.toLowerCase();
      if (!header.id) {
        header.id = 'article-header-'+i;
      }
      this.headerIds.push(header.id);
      if ('h2'==tagName) {
        this.data.push(
            {
              id:header.id,
              title: header.innerHTML,
              children: []
            }
        );
      }else if('h3'==tagName){
        this.data[this.data.length-1].children.push({
          id: header.id,
          title: header.innerHTML
        });
      }
    }
    return this.data;
  }

  Index.prototype.build = function(headers, element){
    if (!this.hasInit) {
      return this;
    }
    if (!headers||!headers.length) {
      element.innerHTML = '';
      return this;
    }
    var html = '<div class="article-index"><div class="article-index-head">'+this.options.title+'</div><ul class="article-index-list" id="article-index-list">';
    for (var i = 0; i < headers.length; i++) {
      var data = headers[i];
      html += '<li class="article-index-item"><a id="article-index-'+data.id+'" class="article-index-anchor" href="#'+data.id+'">'+data.title+'</a>';
      if (data.children && data.children.length) {
        html += '<ul>';
        for (var j = 0; j < data.children.length; j++) {
          html += '<li><a id="article-index-'+data.children[j].id+'" class="article-index-anchor" href="#'+data.children[j].id+'">'+data.children[j].title+'</a></li>';
        }
        html += '</ul>';
      }
      html += '</li>';
    }

    html += '</ul></div>';
    element.innerHTML = html;
    element.className = (element.className ? element.className + ' ' : '') + 'article-index-wrapper';
    var that = this;
    addEventHandler(document.getElementById('article-index-list'), 'click', function(event){
      event.preventDefault();
      var target = event.target || event.srcElement;
      if (target && target.className == 'article-index-anchor') {
        that.index(target);
      }
    });
    this.slideblock = document.createElement('DIV');
    this.slideblock.className = 'article-index-slide';
    this.slideblock.style.display = 'none';
    element.appendChild(this.slideblock);
    this.scroll();
  }

  Index.prototype.index = function(target){
    if (!this.hasInit) {
      return this;
    }
    var id = target.getAttribute('href');
    this.scrollTo(id.replace(/^#/, ''));
  }

  Index.prototype.active = function(id){
     if (!this.hasInit) {
      return this;
    }
    var element = element || document.getElementById('article-index-'+id);
    if (this.current) {
      removeClass(this.current, 'active');
    }
    this.current = element;
    addClass(element, 'active');
    if (this.slideblock) {
      this.slideblock.style.top = (element.offsetTop - childrenElements('.article-index', this.element)[0].offsetTop) + 'px';
      this.slideblock.style.display = 'block';
    }
  }

  Index.prototype.scrollTo = function(id){
     if (!this.hasInit) {
      return this;
    }
    var header = document.getElementById(id);
    if (!header) {
      return;
    }
    this.active(id);
    var scrollTop = header.offsetTop - this.options.fixed;
    window.scrollTo(0, scrollTop);
  }

  Index.prototype.scroll = function(event){
     if (!this.hasInit) {
      return this;
    }
    var scroll = getScrollOffset().y;
    var offsetTop = this.options.offsetTop - this.options.fixed;
    var mlh = getHeight(window) - this.options.fixed - getHeight(footer) - 15; //20180529 最大高度
    if (scroll < offsetTop ) {
      this.element.style.top = '';
      this.element.style.width = '';
      this.element.style.maxHeight = '';
      removeClass(this.element, 'article-index-fixed');
    }else{
      this.element.style.top = this.options.fixed + 'px';
      this.element.style.width = this.options.width+'px';
      
      /*20180529 目录超出*/
      if ( getScrollTop() + getClientHeight()>=getScrollHeight() ){
        this.element.style.maxHeight = mlh + 'px';
      }else{
        
      this.element.style.maxHeight = (getHeight(window) - this.options.fixed - 60) + 'px';
        
      }
      
      addClass(this.element, 'article-index-fixed');
    }

    for (var i = this.headerIds.length - 1; i >= 0; i--) {
       var header = document.getElementById(this.headerIds[i]);
       var top = header.offsetTop - this.options.fixed;
       if (window.scrollY > top -1 ) {
          this.active(this.headerIds[i]);
          break;
       }
    }
  }

  win.articleIndex = new Index();

})(window, document);

/**
 * 页面实现
 * @author NatLiu
 * @date   2018-01-09T16:59:08+0800
 * @return {[type]}                 [description]
 */
function login(dialogId, isBind) {
   var user = trim(document.getElementById('login-name').value),
       pswd = trim(document.getElementById('login-password').value);

   if (!user || !user.length) {
      return returnFalse('请填写用户名');
   }
   if (user.length < 2 || user.length > 32) {
     return returnFalse('无效用户名');
   }
   if (!pswd || !pswd.length) {
     return returnFalse('请填写密码');
   }
   if (pswd.length < 6 || pswd.length > 18) {
      return returnFalse('无效密码');
   }

   ajax('/api/user/login', {
      type:'post',
      dataType:"json",
      data: {
        name: user,
        password: pswd,
        bindOAuth: isBind ? 1 : 0,
        _: window.__onece
      },
      success:function(res){
          if (res && res.error) {
            returnFalse(res.msg);
          }else{
            ArmDialog.close(dialogId);
            ArmMessage.success(res.msg ? res.msg : '登录成功');
            reloadPage();
          }
      },
      error:function(){
        ArmMessage.error('请检查网络后重试');
      }
   });
}

function register(dialogId, isBind) {
   var user = trim(document.getElementById('register-name').value),
       pswd = trim(document.getElementById('register-password').value),
       confirm = trim(document.getElementById('register-confirm').value);

   if (!user || !user.length) {
      return returnFalse('请填写用户名');
   }
   if (user.length < 2 || user.length > 32) {
     return returnFalse('无效用户名');
   }
   if (!pswd || !pswd.length) {
     return returnFalse('请填写密码');
   }
   if (pswd.length < 6 || pswd.length > 18) {
      return returnFalse('无效密码');
   }

   if (confirm!==pswd) {
    return returnFalse('2次密码不相同');
   }

   ajax('/api/user/register', {
      type:'post',
      dataType:"json",
      data: {
        name: user,
        password: pswd,
        confirm: confirm,
        bindOAuth: isBind ? 1 : 0,
        _: window.__onece
      },
      success:function(res){
          if (res && res.error) {
            returnFalse(res.msg);
          }else{
            ArmDialog.close(dialogId);
            ArmMessage.success(res.msg ? res.msg : '欢迎您，注册成功');
            reloadPage();
          }
      },
      error:function(){
        ArmMessage.error('请检查网络后重试');
      }
   });
}

function logout() {
  ajax('/api/user/logout', {
      type:'get',
      dataType:"json",
      data: {
        _: window.__onece
      },
      success:function(res){
          if (res && res.error) {
            returnFalse(res.msg);
          }else{
            ArmMessage.success('退出成功');
            reloadPage();
          }
      },
      error:function(){
        ArmMessage.error('请检查网络后重试');
      }
   });
}

function oauthLogout(){
  ajax('/api/user/oauthLogout', {
      type:'get',
      dataType:"json",
      data: {
        _: window.__onece
      },
      success:function(res){
          if (res && res.error) {
            returnFalse(res.msg);
          }else{
            ArmMessage.success('退出成功');
            reloadPage();
          }
      },
      error:function(){
        ArmMessage.error('请检查网络后重试');
      }
   });
}

function doDialog(id) {
  var bindOAuth = /_bind/i.test(id);
   if (/^login/i.test(id)) {

       ArmDialog.open({
          id:'login-dialog',
          content: '<div class="login-logo">\
                      <div class="login-title">码圃<span class="login-logo-img"></span>通行证</div>\
                    </div>\
                    <div class="login-panel">\
                      <h3 class="panel-title">'+(bindOAuth ? '绑定已有账号':'用户登录')+'</h3>\
                      <div class="login-form">\
                        <div class="form-item"><div class="tip">用户名</div><input type="text" name="name" id="login-name" placeholder="用户名" /></div>\
                        <div class="form-item"><div class="tip">密码</div><input type="password" name="password" id="login-password" placeholder="密码" /></div>\
                        <div class="form-item"><button class="action-btn login-btn" id="login-submit">'+(bindOAuth ? '绑定':'登录')+'</button><a onclick="doAction(\'dialog.register'+(bindOAuth ? '_bind':'')+'\')" class="fr">'+(bindOAuth ? '新用户绑定':'新用户注册')+'</a></div>\
                        ' + (bindOAuth ? '' :'<p>第三方帐号登录</p>\
                        <div class="login-third-platform">\
                        <a href="javascript:;" title="QQ号登录" class="action-btn login-third login-qq" data-action="oauth.qq"></a>\
                        <a href="javascript:;" class="action-btn login-third login-weibo" title="新浪微博登录" data-action="oauth.weibo"></a>\
                        <a href="javascript:;" class="action-btn login-third login-osc" title="开源中国" data-action="oauth.osc"></a>\
                        <a href="javascript:;" class="action-btn login-third login-github" title="Github" data-action="oauth.github"></a>\
                        <a href="javascript:;" class="action-btn login-third login-alipay" title="支付宝登录" data-action="oauth.alipay"></a>\
                        </div>')+
                      '</div>\
                    </div>',
          className:'login-dialog',
          oncreate:function(){
            var dialogId = this.id;
             addEventHandler(document.getElementById('login-submit'), 'click', function(){
                login(dialogId, bindOAuth);
             });
          }
       });
   }

   if (/^register/i.test(id)) {
       ArmDialog.open({
          id:'login-dialog',
          content: '<div class="login-logo">\
                      <div class="login-title">码圃<span class="login-logo-img"></span>通行证</div>\
                    </div>\
                    <div class="login-panel">\
                      <h3 class="panel-title">'+(bindOAuth ? '绑定新用户':'用户注册')+'</h3>\
                      <div class="login-form">\
                        <div class="form-item"><div class="tip">用户名</div><input type="text" name="name" id="register-name" placeholder="用户名" /></div>\
                        <div class="form-item"><div class="tip">设置密码</div><input type="password" name="password" id="register-password" placeholder="设置密码（6到18个字符）" /></div>\
                        <div class="form-item"><div class="tip">重复密码</div><input type="password" name="confirm" id="register-confirm" placeholder="重复密码（6到18个字符）" /></div>\
                        <div class="form-item"><button class="action-btn login-btn" id="register-submit">注册</button><a onclick="doAction(\'dialog.login'+(bindOAuth ? '_bind':'')+'\')" class="fr">'+(bindOAuth ? '绑定已有账号':'已有账号登录')+'</a>\
                        </div>\
                      </div>\
                    </div>',

          className:'login-dialog',
          oncreate:function(){
            var dialogId = this.id;
             addEventHandler(document.getElementById('register-submit'), 'click', function(){
                register(dialogId, bindOAuth);
             });
          }
       });
   }
}

/**
 * 用户操作
 * @author NatLiu
 * @date   2018-01-09T17:06:42+0800
 * @param  {[type]}                 action [description]
 * @return {[type]}                        [description]
 */
var __ACTIONS = {
  comment: '评论'
};
function doAction(action) {
  if (!action) {
    return;
  }
  var actions = action.split('@'),
      mod = actions[0].split('.'),
      module = mod[0],
      action = mod[1],
      params = (actions[1] ? actions[1] : '').split(':'),
      target = params[0],
      slug = params[1];

  var _this = {
    target: target,
    slug: slug,
    srcElement: this,
    module: module,
    action: action,
    text: slug ? __ACTIONS[slug] : '操作', 
    _action: action
  };

  if (module==="dialog") {
     doDialog(action);
  }

  if (module=="logout") {
     logout();
  }
  if (module=="form") {
    action == "submit" && target && ajaxForm.call(_this, target, window.location.href);
  }

  if (module==="oauth") {
    oauth(action);
  }
}

function oauth($platform) {
  if ($platform==="logout") {
      oauthLogout();
     return;
  }
  if (!/qq|weixin|weibo|wxqrcode|alipay|github|osc/i.test($platform)) {
    ArmMessage.error('不支持此平台登录');
  }
  $url = "/api/oauth/"+$platform+"?do=connect";
  var sizes = {
    weibo:[600, 340],
    alipay:[480, 394],
    osc:[600, 340]
  };
  if ($platform==="github") {
     try {
        var win = window.open($url, 'github_oauth', "width=360,height=480,left="+(Math.ceil(getWidth(window)/2)-180) );
        win.document.title = '授权登录';
      } catch(e) {
        window.location.href = $url;
      }
      return;
  }
  var size = sizes[$platform];
  ArmDialog.open({
    id:'login-dialog',
    width: size ? size[0] : 480,
    height:size ? size[1] : 320,
    type:'iframe',
    content:$url
  });
}

function oauthSuccess(msg){
    ArmDialog.close('login-dialog');
    ArmMessage.success(msg?msg:'登录成功');
    reloadPage();
}

function oauthError(msg){
    ArmDialog.close('login-dialog');
    ArmMessage.error(msg?msg:'请检查网络后重试');
}

function toggleNav() {
  var nav = document.getElementById('nav');
  var className = nav.className;
  if (/nav-show/i.test(className)) {
    className = className.replace('nav-show', '');
  }else{
    className += ' nav-show';
  }
  nav.className = className;
}

/**
 * 页面初始化
 * @author NatLiu
 * @date   2018-01-09T15:36:34+0800
 * @return {[type]}                 [description]
 */
function pageInit(){
  // 代码美化
  if (window.hljs) {
    var codes = document.getElementsByTagName('code');
    for (var i = 0; i < codes.length; i++) {
      if(codes[i].parentNode && codes[i].parentNode.tagName.toLowerCase() == "pre"){
        if (window.isIE && isIE < 8) {
          codes[i].textContent = codes[i].innerText;
        }
        hljs.highlightBlock(codes[i]);
      }
    }
  }

  articleIndex.init('#article-index', {
    target: '.article-content',
    fixed: 72
  });

  // 事件监听
  addEventHandler(document.getElementById('search-btn'), 'click', search);
  addEventHandler(document.getElementById('user-tools'), 'mouseenter', usrOpen);
  addEventHandler(document.getElementById('user-tools'), 'touchstart', usrOpen);
  addEventHandler(document.getElementById('user-tools'), 'mouseleave', userClose);
  addEventHandler(document.getElementById('search'), 'submit', function(e){
    e.preventDefault();
    return false;
  });

  addEventHandler(document.getElementById('menu-switch'), 'click', toggleNav);
}

/**
 * 回车执行函数
 * @return {[type]} [description]
 */
function enterKey() {

  switch (true) {
    case document.activeElement.id == 's':
      search();
      break;
    case document.activeElement.id == 'search-box':
      searchBox();
    default:
      // statements_def
      break;
  }
}

// 全局事件绑定
function bindEvent(){
    addEventHandler(document.body, 'click', function(event){
      var target = event.target || event.srcElement;
        // 事件派发
         if (target && target !==document) {
           target.getAttribute('data-action') && doAction.call(target, target.getAttribute('data-action'));
         }
    });

    addEventHandler(document, 'keyup', function(event){
      switch (event.keyCode) {
        case 13:
          enterKey.call(this, event);
          break;
      }
    });
}
bindEvent();

//输出
window.onload=function(){
  console.log("%c喵~ 大佬好！","color: #0069D6 !important;font-size:14px;");
  console.log("%c%c网站%cVirCloud's Blog","line-height:28px;","line-height:28px;padding:4px;background:#0cc;color:#fff;font-size:14px;","color:#0cc;line-height:28px;font-size:14px;padding:4px 15px;background:#f8f8f8;");
  console.log("%c%c地址%chttps://blog.vircloud.net","line-height:28px;","line-height:28px;padding:4px;background:#222;color:#fff;font-size:14px;margin-right:15px","color:#000;line-height:28px;font-size:14px;");
  console.log("%c%c主题%cArmx Mod for Typecho","line-height:28px;","line-height:28px;padding:4px;background:#25b15e;color:#fff;font-size:14px;margin-right:15px","color:#25b15e;line-height:28px;font-size:14px;");
  console.log("%c%c联系%chttps://t.me/vircloud","line-height:28px;","line-height:28px;padding:4px;background:#58666e;color:#fff;font-size:14px;margin-right:15px","color:#58666e;line-height:28px;font-size:14px;");
}
