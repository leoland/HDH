!function($){"use strict";$.fn.select2.locales.bg={formatNoMatches:function(){return"Няма намерени съвпадения"},formatInputTooShort:function(t,n){var o=n-t.length;return"Моля въведете още "+o+" символ"+(o>1?"а":"")},formatInputTooLong:function(t,n){var o=t.length-n;return"Моля въведете с "+o+" по-малко символ"+(o>1?"а":"")},formatSelectionTooBig:function(t){return"Можете да направите до "+t+(t>1?" избора":" избор")},formatLoadMore:function(t){return"Зареждат се още…"},formatSearching:function(){return"Търсене…"}},$.extend($.fn.select2.defaults,$.fn.select2.locales.bg)}(jQuery);