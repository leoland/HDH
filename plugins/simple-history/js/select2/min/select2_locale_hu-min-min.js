!function($){"use strict";$.fn.select2.locales.hu={formatNoMatches:function(){return"Nincs találat."},formatInputTooShort:function(t,e){var n=e-t.length;return"Túl rövid. Még "+n+" karakter hiányzik."},formatInputTooLong:function(t,e){var n=t.length-e;return"Túl hosszú. "+n+" karakterrel több, mint kellene."},formatSelectionTooBig:function(t){return"Csak "+t+" elemet lehet kiválasztani."},formatLoadMore:function(t){return"Töltés…"},formatSearching:function(){return"Keresés…"}},$.extend($.fn.select2.defaults,$.fn.select2.locales.hu)}(jQuery);