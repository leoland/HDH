function loadCSS(e,t,n){"use strict";var o=window.document.createElement("link"),r=t||window.document.getElementsByTagName("script")[0];return o.rel="stylesheet",o.href=e,o.media="only x",r.parentNode.insertBefore(o,r),setTimeout(function(){o.media=n||"all"}),console.log("fonts should be loaded, check head for css file"),o}function getBaseURL(){var e=location.href,t=e.substring(0,e.indexOf("/",14));if(t.indexOf("http://localhost")!==-1){var e=location.href,n=location.pathname,o=e.indexOf(n),r=e.indexOf("/",o+1),s=e.substr(0,r);return s+"/"}return t+"/"}var root=getBaseURL();loadCSS(root+"wp-content/themes/hdh/fonts/Univers.css");