//浏览器检测
var isIE =(function(){
    var browser = {};
    return function(ver,c){
        var key = ver ?  ( c ? "is"+c+"IE"+ver : "isIE"+ver ) : "isIE";
        var v = browser[key];
        if( typeof(v)  != "undefined"){
            return v;
        }
        if( !ver){
            v = (navigator.userAgent.indexOf('MSIE') !== -1 || navigator.appVersion.indexOf('Trident/') > 0) ;
        }else {
            var match = navigator.userAgent.match(/(?:MSIE |Trident\/.*; rv:|Edge\/)(\d+)/);
            if(match){
                var v1 = parseInt(match[1]) ;
                v = c ?  ( c == 'lt' ?  v1 < ver  :  ( c == 'gt' ?  v1 >  ver : undefined ) ) : v1== ver ;
            }else	if(ver <= 9){
                var b = document.createElement('b')
                var s = '<!--[if '+(c ? c : '')+' IE '  + ver + ']><i></i><![endif]-->';
                b.innerHTML =  s;
                v =  b.getElementsByTagName('i').length === 1;
            }else{
                v=undefined;
            }
        }
        browser[key] =v;
        return v;
    };
}());

//低于ie8的浏览器给出提示
if(isIE() && !isIE(9,'gt')){
    //alert('浏览器版本过低！');
    //document.body.innerHTML = '';
    var browserAlert = '<div style="' +
        'position: fixed; height: 100%; width: 100%;padding: 20% 30px;top: 0;left: 0;background: white;z-index: 9999999">' +
        '<h1>:( 你的浏览器版本过低(IE<10)，将不能正常使用。</h1>' +
        '<p>请升级 <A href="http://windows.microsoft.com/zh-CN/internet-explorer/downloads/ie">Internet Explorer</A> ' +
        '或使用 <A href="http://www.google.com/chrome/">Google Chrome</A> 浏览器。 </p>' +
        '<p>如果您的浏览器是360，QQ等国产双核浏览器，请切换到高速 / 极速 / 神速核心（模式）。 </p>' +
        '</div>';
    document.write(browserAlert);
    throw new Error('not support this low version browser');
}