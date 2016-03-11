////////////////////////////////////////////////////////////////////
function fHoliday(y,m,d) {
	var r=fGetEvent(y,m,d); // get agenda event.
	if (r) return r;	// ignore the following holiday checking if the date has already been set by the above addEvent functions. Of course you can write your own code to merge them instead of just ignoring.

	// you may have sophisticated holiday calculation set here, following are only simple examples.
	if (m==1&&d==1)
		r=[" Jan 1, "+y+" \n Happy New Year! ","","#87ceeb","red"];
	else if (m==12&&d==25)
		r=[" Dec 25, "+y+" \n Merry X'mas! ",null,"#87ceeb","red"];	// show a line-through effect
	return r;	// if r is null, the engine will just render it as a normal day.
}


// -- You may also put your self-defined functions here if required, like the following two which are used in the above examples. --
function popup(url,framename) {	// popup an url in the designated window, you may delete it if no need.
	var w=parent.open(url,framename,"top=200,left=200,width=400,height=200,scrollbars=1,resizable=1");
	if (w&&url.split(":")[0]=="mailto") w.close();
	else if (w&&!framename) w.focus();
}

function getDateByDOW(y,m,q,n) { // return the actual date of the q-th n-day in the specific month (y,m), you may delete it if no need.
// n: 0 - Sunday, 1 - Monday ... 6 - Saturday
// q: 1 - 5 ( 5 denotes the last n-day )
	var dom=new Date(y,m-1,1).getDay();
	var d=7*q-6+n-dom;
	if (dom>n) d+=7;
	if (d>fGetDays(y)[m]) d-=7;
	return d;
}