!function(){function n(n,i,t){var u=n%10;return u>1&&u<5&&(n>20||n<10)?i:t}jQuery.timeago.settings.strings={prefixAgo:null,prefixFromNow:"za",suffixAgo:"temu",suffixFromNow:null,seconds:"mniej niż minutę",minute:"minutę",minutes:function(i){return n(i,"%d minuty","%d minut")},hour:"godzinę",hours:function(i){return n(i,"%d godziny","%d godzin")},day:"dzień",days:"%d dni",month:"miesiąc",months:function(i){return n(i,"%d miesiące","%d miesięcy")},year:"rok",years:function(i){return n(i,"%d lata","%d lat")}}}();