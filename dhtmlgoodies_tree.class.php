<?php
class dhtmlgoodies_tree{
	var $elementArray = array();
	var $nameOfCookie = "dhtmlgoodies_expanded";
	var $mtree = "";

	function dhtmlgoodies_tree(){
	}
	function writeCSS(){
	$css='
		<style type="text/css">
		#dhtmlgoodies_tree li{list-style-type:none;}
		#dhtmlgoodies_topNodes{	margin-left:0px;padding-left:0px;}
		#dhtmlgoodies_topNodes ul{margin-left:20px;	padding-left:0px;display:none;}
		#dhtmlgoodies_tree .tree_link{line-height:13px;	padding-left:2px;}
		#dhtmlgoodies_tree img{	padding-top:2px;}
		#dhtmlgoodies_tree a{color: #000000;text-decoration:none;}
		.activeNodeLink{background-color: #316AC5;color: #FFFFFF;font-weight:bold;}
		</style>
		';
		$this->mtree.=$css;
	}
	function writeJavascript(){
		$script="
		<script type='text/javascript'>
		var plusNode = 'images/dhtmlgoodies_plus.gif';
		var minusNode = 'images/dhtmlgoodies_minus.gif';

		var nameOfCookie = '".$this->nameOfCookie."';";
		
		$cookieValue = "";
		if(isset($_COOKIE[$this->nameOfCookie]))$cookieValue = $_COOKIE[$this->nameOfCookie];
		$script.="var initExpandedNodes =\"".$cookieValue."\";\n";
		$script.="
		function Get_Cookie(name) {
		   var start = document.cookie.indexOf(name+\"=\");
		   var len = start+name.length+1;
		   if ((!start) && (name != document.cookie.substring(0,name.length))) return null;
		   if (start == -1) return null;
		   var end = document.cookie.indexOf(\";\",len);
		   if (end == -1) end = document.cookie.length;
		   return unescape(document.cookie.substring(len,end));
		}
		// This function has been slightly modified
		function Set_Cookie(name,value,expires,path,domain,secure) {
			expires = expires * 60*60*24*1000;
			var today = new Date();
			var expires_date = new Date( today.getTime() + (expires) );
		    var cookieString = name + \"=\" +escape(value) +
		       ( (expires) ? \";expires=\" + expires_date.toGMTString() : \"\") +
		       ( (path) ? \";path=\" + path : \"\") +
		       ( (domain) ? \";domain=\" + domain : \"\") +
		       ( (secure) ? \";secure\" : \"\");
		    document.cookie = cookieString;
		}
		function expandAll(){
			var treeObj = document.getElementById('dhtmlgoodies_tree');
			var images = treeObj.getElementsByTagName('IMG');
			for(var no=0;no<images.length;no++){
				if(images[no].className=='tree_plusminus' && images[no].src.indexOf(plusNode)>=0)expandNode(false,images[no]);
			}
		}
		function collapseAll(){
			var treeObj = document.getElementById('dhtmlgoodies_tree');
			var images = treeObj.getElementsByTagName('IMG');
			for(var no=0;no<images.length;no++){
				if(images[no].className=='tree_plusminus' && images[no].src.indexOf(minusNode)>=0)expandNode(false,images[no]);
			}
		}
		function expandNode(e,inputNode){
			if(initExpandedNodes.length==0)initExpandedNodes=\",\";
			if(!inputNode)inputNode = this;
			if(inputNode.tagName.toLowerCase()!='img')inputNode = inputNode.parentNode.getElementsByTagName('IMG')[0];

			var inputId = inputNode.id.replace(/[^\d]/g,'');

			var parentUl = inputNode.parentNode;
			var subUl = parentUl.getElementsByTagName('UL');

			if(subUl.length==0)return;
			if(subUl[0].style.display=='' || subUl[0].style.display=='none'){
				subUl[0].style.display = 'block';
				inputNode.src = minusNode;
				initExpandedNodes = initExpandedNodes.replace(',' + inputId+',',',');
				initExpandedNodes = initExpandedNodes + inputId + ',';

			}else{
				subUl[0].style.display = '';
				inputNode.src = plusNode;
				initExpandedNodes = initExpandedNodes.replace(','+inputId+',',',');
			}
			Set_Cookie(nameOfCookie,initExpandedNodes,60);
		}
		function initTree(){
			// Assigning mouse events
			var parentNode = document.getElementById('dhtmlgoodies_tree');
			var lis = parentNode.getElementsByTagName('LI');
			for(var no=0;no<lis.length;no++){
				var subNodes = lis[no].getElementsByTagName('UL');
				if(subNodes.length>0){
					lis[no].childNodes[0].style.visibility='visible';
				}else{
					lis[no].childNodes[0].style.visibility='hidden';
				}
			}
			var images = parentNode.getElementsByTagName('IMG');
			for(var no=0;no<images.length;no++){
				if(images[no].className=='tree_plusminus')images[no].onclick = expandNode;
			}

			var aTags = parentNode.getElementsByTagName('A');
			var cursor = 'pointer';
			if(document.all)cursor = 'hand';
			for(var no=0;no<aTags.length;no++){
				aTags[no].onclick = expandNode;
				aTags[no].style.cursor = cursor;
			}
			var initExpandedArray = initExpandedNodes.split(',');

			for(var no=0;no<initExpandedArray.length;no++){
				if(document.getElementById('plusMinus' + initExpandedArray[no])){
					var obj = document.getElementById('plusMinus' + initExpandedArray[no]);
					expandNode(false,obj);
				}
			}
		}
		</script>";
		$this->mtree.=$script;
	}
	/*
	This function adds elements to the array
	*/
	function addToArray($id,$name,$parentID,$url="",$target="", $hasChild=1, $onclick = ''){
		if ($hasChild==1){ $icon="/images/dhtmlgoodies_folder.gif"; }
		if ($hasChild!=1){ $icon="/images/dhtmlgoodies_sheet.gif"; }
		if(empty($parentID))$parentID=0;
		$this->elementArray[$parentID][] = array(
			'id' => $id,
			'title' => $name,
			'url' => $url,
			'target' => $target,
			'icon' => $icon,
			'onclick' => $onclick
		);
	}
	function addToArrayAss($element){
		if(!isset($element['parentId']) || !$element['parentId']){
			$element['parentId'] = 0;
		}
		$element['url'] = isset($element['url']) ? $element['url'] : 'javascript:return false';
		$element['target'] = isset($element['target']) ? $element['target'] : '';
		$element['icon'] = isset($element['icon']) ? $element['icon'] : 'images/dhtmlgoodies_folder.gif';
		$element['onclick'] = isset($element['onclick']) ? $element['onclick'] : '';
		$this->elementArray[$element['parentId']][] = array(
			'id' => $element['id'],
			'title' => $element['title'],
			'url' => $element['url'],
			'target' => $element['target'],
			'icon' => $element['icon'],
			'onclick' => $element['onclick']
		);
	}
	function drawSubNode($parentID){
		if(isset($this->elementArray[$parentID])){
			$this->mtree.="<ul>";
			for($no=0;$no<count($this->elementArray[$parentID]);$no++){
				$urlAdd = " href=\"#\"";
				if($this->elementArray[$parentID][$no]['url']){
					$urlAdd = " href=\"".$this->elementArray[$parentID][$no]['url']."\"";
					if($this->elementArray[$parentID][$no]['target'])$urlAdd.=" target=\"".$this->elementArray[$parentID][$no]['target']."\"";
				}
				$onclick = "";
				if($this->elementArray[$parentID][$no]['onclick']){
					$onclick = " onmouseup=\"".$this->elementArray[$parentID][$no]['onclick'].";return false\"";
				}
				$this->mtree.="<li class=\"tree_node\">";
				$this->mtree.="<img class=\"tree_plusminus\" id=\"plusMinus".$this->elementArray[$parentID][$no]['id']."\" src=\"images/dhtmlgoodies_plus.gif\"><img src=\"".$this->elementArray[$parentID][$no]['icon']."\">";
				$this->mtree.="<a class=\"tree_link\"$urlAdd$onclick>".$this->elementArray[$parentID][$no]['title']."</a>";
				$this->drawSubNode($this->elementArray[$parentID][$no]['id']);
				$this->mtree.="</li>";
			}
			$this->mtree.="</ul>";
		}
	}

	function drawTree(){
		$this->mtree.="<div id=\"dhtmlgoodies_tree\">";
		$this->mtree.="<ul id=\"dhtmlgoodies_topNodes\">";
		for($no=0;$no<count($this->elementArray[0]);$no++){
			$urlAdd = "";
			if($this->elementArray[0][$no]['url']){
				$urlAdd = " href=\"".$this->elementArray[0][$no]['url']."\"";
				if($this->elementArray[0][$no]['target'])$urlAdd.=" target=\"".$this->elementArray[0][$no]['target']."\"";
			}
			$onclick = "";
			if($this->elementArray[0][$no]['onclick']){
				$onclick = " onmouseup=\"".$this->elementArray[0][$no]['onclick'].";return false\"";
			}
			$this->mtree.="<li class=\"tree_node\" id=\"node_".$this->elementArray[0][$no]['id']."\">";
			$this->mtree.="<img id=\"plusMinus".$this->elementArray[0][$no]['id']."\" class=\"tree_plusminus\" src=\"images/dhtmlgoodies_plus.gif\">";
			$this->mtree.="<img src=\"".$this->elementArray[0][$no]['icon']."\">";
			$this->mtree.="<a class=\"tree_link\"$urlAdd$onclick>".$this->elementArray[0][$no]['title']."</a>";
			$this->drawSubNode($this->elementArray[0][$no]['id']);
			$this->mtree.="</li>";
		}
		$this->mtree.="</ul>";
		$this->mtree.="</div>";
		return $this->mtree;
	}
}
?>