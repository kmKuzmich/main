// Jeff
// www.huntingground.freeserve.co.uk

upStep=50
downStep=30
showOnLoad=1 // 0 = no, 1 = yes
centerDisplay=1 // center display horizontally; 0 = no, 1 = yes
displayStopPos=350 // top position layer scrolls down to in relation to page top (zero)

scrollTimer=null

function closeAlertContainer(){
	contDiv=document.getElementById("alert_container");
	contDiv.style.left=-1000+"px"
	contDiv.style.top=-1000+"px"
}
function initScrollDiv(){
	contDiv=document.getElementById("alert_container")

if(centerDisplay==1){
	wWidth=document.body.clientWidth
	cWidth=contDiv.offsetWidth
	contDiv.style.left=(wWidth-cWidth)/2
}

cHeight=contDiv.offsetHeight
contDiv.style.top=contDiv.offsetTop-cHeight

defPos=parseInt(contDiv.style.top)
topPos=defPos
stopPos=displayStopPos

dir=0

if(showOnLoad==1){
	scrollDiv(0)
}

}

function scrollDiv(n){
dir=n
clearTimeout(scrollTimer)
downTimer=setTimeout("scrollDiv("+n+")",50)

if(dir==0){
topPos+=downStep

if(topPos>stopPos-downStep){
topPos=stopPos
clearTimeout(scrollTimer)
}

}
else{
topPos-=upStep

if(topPos<(defPos+upStep)) {
topPos=defPos
clearTimeout(scrollTimer)
}

}

contDiv.style.top=topPos
}

// add onload="initScrollDiv()" to the opening BODY tag
