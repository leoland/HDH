!function(){function n(n,r,u,t){var o=n%10;return 1==o&&(1==n||n>20)?r:o>1&&o<5&&(n>20||n<10)?u:t}jQuery.timeago.settings.strings={prefixAgo:null,prefixFromNow:"через",suffixAgo:"тому",suffixFromNow:null,seconds:"менше хвилини",minute:"хвилина",minutes:function(r){return n(r,"%d хвилина","%d хвилини","%d хвилин")},hour:"година",hours:function(r){return n(r,"%d година","%d години","%d годин")},day:"день",days:function(r){return n(r,"%d день","%d дні","%d днів")},month:"місяць",months:function(r){return n(r,"%d місяць","%d місяці","%d місяців")},year:"рік",years:function(r){return n(r,"%d рік","%d роки","%d років")}}}();