(function(){var n;n=function(n,e){return e[n%100==1?1:n%100==2?2:n%100==3||n%100==4?3:0]},jQuery.timeago.settings.strings={prefixAgo:null,prefixFromNow:"čez",suffixAgo:"nazaj",suffixFromNow:null,second:"sekundo",seconds:function(e){return n(e,["%d sekund","%d sekundo","%d sekundi","%d sekunde"])},minute:"minuto",minutes:function(e){return n(e,["%d minut","%d minuto","%d minuti","%d minute"])},hour:"eno uro",hours:function(e){return n(e,["%d ur","%d uro","%d uri","%d ure"])},day:"en dan",days:function(e){return n(e,["%d dni","%d dan","%d dneva","%d dni"])},month:"en mesec",months:function(e){return n(e,["%d mescov","%d mesec","%d mesca","%d mesce"])},year:"eno leto",years:function(e){return n(e,["%d let","%d leto","%d leti","%d leta"])},wordSeparator:" "}}).call(this);