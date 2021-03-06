/////////////////////////////////////////////////////////////////////
fAddEvent(2003,3,28," March 28, 2003 \n Click to detect calendar size. ","alert('Here is the current size of the calendar - \"width='+gfSelf.offsetWidth+' height='+gfSelf.offsetHeight+'\"');","#87ceeb","dodgerblue");
fAddEvent(2002,12,2," Your comments're of vital importance. ","popup('mailto:pop@calendarxp.net?subject=Comments on PopCalendarXP')","#87ceeb","dodgerblue",null,true);


fAddEvent(2003,4,18," Hello World! ","alert('Hello World!');","#87ceeb","dodgerblue");



///////////// Dynamic holiday calculations /////////////////////////
// This function provides you a flexible way to make holidays of your own.
// It will be called whenever the calendar engine needs the agenda info of a specific date, and the date is passed in as (y,m,d);
// With the date in hand, just do whatever you want to check to validate whether it is a desired holiday;
// Finally you should return an agenda array like [message, action, bgcolor, fgcolor, bgimg, boxit, html] to tell the engine how to render it.
////////////////////////////////////////////////////////////////////
function fHoliday(y,m,d) {
	var r=fGetEvent(y,m,d); // get agenda event.
	if (r) return r;	// ignore the following holiday checking if the date has already been set by the above addEvent functions. Of course you can write your own code to merge them instead of just ignoring.

	// you may have sophisticated holiday calculation set here, following are only simple examples.
	if (m==1&&d==1)
		r=[" Jan 1, "+y+" \n Happy New Year! ","","#87ceeb","red"];
	else if (m==12&&d==25)
		r=[" Dec 25, "+y+" \n Merry X'mas! ",null,"#87ceeb","red"];	// show a line-through effect
	else if (m==5&&d>20) {
		var date=getDateByDOW(y,5,5,1);	// Memorial day is the last Monday of May
		if (d==date) r=["May "+d+", "+y+"  Memorial Day ",gsAction,"#87ceeb","red"];	// use default action
	}

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

