!function($){"use strict";$.fn.select2.locales["zh-TW"]={formatNoMatches:function(){return"沒有找到相符的項目"},formatInputTooShort:function(t,n){var o=n-t.length;return"請再輸入"+o+"個字元"},formatInputTooLong:function(t,n){var o=t.length-n;return"請刪掉"+o+"個字元"},formatSelectionTooBig:function(t){return"你只能選擇最多"+t+"項"},formatLoadMore:function(t){return"載入中…"},formatSearching:function(){return"搜尋中…"}},$.extend($.fn.select2.defaults,$.fn.select2.locales["zh-TW"])}(jQuery);