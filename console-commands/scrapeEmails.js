// mails=$('.BltHke.nH.oy8Mbf[role="main"] .yX.xY .yW span');
mails=$('.BltHke.nH.oy8Mbf[role="main"] .yX.xY .yP , .BltHke.nH.oy8Mbf[role="main"] .yX.xY .yW span.zF, .BltHke.nH.oy8Mbf[role="main"] .yX.xY .yW span'); //new gmail look + multiple use cases
var emmm=[];var isspam=0;
var allowed=["cpanel","harshmalpani","tutes.club"];
mails.each(function(){
var thismail=$(this).attr('email');
isspam=0;
$.each(allowed,function(j,b){
	if(thismail !==undefined){
if(thismail.indexOf(b) > -1){
	isspam=0;
	return false;
	}
else {
	isspam=1;
}
	}
});
if(isspam)emmm.push(thismail);
});
emmm=$.unique(emmm);
var fst='';
$.each(emmm,function(i,v){
fst+=v+"\n";
});
// not needed because " OR " is replaced with newline
// fst=fst.slice(0,-4);
console.log(fst);