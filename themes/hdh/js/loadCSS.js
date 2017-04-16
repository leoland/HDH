/*!
loadCSS: load a CSS file asynchronously. 
[c]2014 @scottjehl, Filament Group, Inc. 
Licensed MIT 
*/

function loadCSS( href, before, media ){ 
"use strict"; 
var ss = window.document.createElement( "link" ); 
var ref = before || window.document.getElementsByTagName( "script" )[ 0 ]; 
ss.rel = "stylesheet"; 
ss.href = href; 
ss.media = "only x"; 
ref.parentNode.insertBefore( ss, ref ); 
setTimeout( function(){ 
ss.media = media || "all"; 
} );
console.log('fonts should be loaded, check head for css file');
return ss;

}

// here's where you specify the CSS files to be loaded asynchronously
//get the base url regardless of environment
function getBaseURL() {
    var url = location.href;  // entire url including querystring - also: window.location.href;
    var baseURL = url.substring(0, url.indexOf('/', 14));


    if (baseURL.indexOf('http://localhost') !== -1) {
        // Base Url for localhost
        var url = location.href;  // window.location.href;
        var pathname = location.pathname;  // window.location.pathname;
        var index1 = url.indexOf(pathname);
        var index2 = url.indexOf("/", index1 + 1);
        var baseLocalUrl = url.substr(0, index2);

        return baseLocalUrl + "/";
    }
    else {
        // Root Url for domain name
        return baseURL + "/";
    }

}
var root = getBaseURL();
loadCSS(root+"wp-content/themes/hdh/fonts/Univers.css");

