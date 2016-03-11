<?php
/**
 * File for class TecDocPackageStructChildNodesAllLinkingTargetShortCut2Request
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageStructChildNodesAllLinkingTargetShortCut2Request originally named ChildNodesAllLinkingTargetShortCut2Request
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
class TecDocPackageStructChildNodesAllLinkingTargetShortCut2Request extends TecDocPackageWsdlClass
{
	/**
	 * The childNodes
	 * @var boolean
	 */
	public $childNodes;
	/**
	 * The lang
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $lang;
	/**
	 * The linkingTargetType
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $linkingTargetType;
	/**
	 * The parentNodeId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $parentNodeId;
	/**
	 * The provider
	 * @var int
	 */
	public $provider;
	/**
	 * The shortCutId
	 * @var long
	 */
	public $shortCutId;
	/**
	 * Constructor method for ChildNodesAllLinkingTargetShortCut2Request
	 * @see parent::__construct()
	 * @param boolean $_childNodes
	 * @param string $_lang
	 * @param string $_linkingTargetType
	 * @param long $_parentNodeId
	 * @param int $_provider
	 * @param long $_shortCutId
	 * @return TecDocPackageStructChildNodesAllLinkingTargetShortCut2Request
	 */
	public function __construct($_childNodes = NULL,$_lang = NULL,$_linkingTargetType = NULL,$_parentNodeId = NULL,$_provider = NULL,$_shortCutId = NULL)
	{
		parent::__construct(array('childNodes'=>$_childNodes,'lang'=>$_lang,'linkingTargetType'=>$_linkingTargetType,'parentNodeId'=>$_parentNodeId,'provider'=>$_provider,'shortCutId'=>$_shortCutId));
	}
	/**
	 * Get childNodes value
	 * @return boolean
	 */
	public function getChildNodes()
	{
		return $this->childNodes;
	}
	/**
	 * Set childNodes value
	 * @param boolean the childNodes
	 * @return boolean
	 */
	public function setChildNodes($_childNodes)
	{
		return ($this->childNodes = $_childNodes);
	}
	/**
	 * Get lang value
	 * @return string
	 */
	public function getLang()
	{
		return $this->lang;
	}
	/**
	 * Set lang value
	 * @param string the lang
	 * @return string
	 */
	public function setLang($_lang)
	{
		return ($this->lang = $_lang);
	}
	/**
	 * Get linkingTargetType value
	 * @return string
	 */
	public function getLinkingTargetType()
	{
		return $this->linkingTargetType;
	}
	/**
	 * Set linkingTargetType value
	 * @param string the linkingTargetType
	 * @return string
	 */
	public function setLinkingTargetType($_linkingTargetType)
	{
		return ($this->linkingTargetType = $_linkingTargetType);
	}
	/**
	 * Get parentNodeId value
	 * @return long
	 */
	public function getParentNodeId()
	{
		return $this->parentNodeId;
	}
	/**
	 * Set parentNodeId value
	 * @param long the parentNodeId
	 * @return long
	 */
	public function setParentNodeId($_parentNodeId)
	{
		return ($this->parentNodeId = $_parentNodeId);
	}
	/**
	 * Get provider value
	 * @return int
	 */
	public function getProvider()
	{
		return $this->provider;
	}
	/**
	 * Set provider value
	 * @param int the provider
	 * @return int
	 */
	public function setProvider($_provider)
	{
		return ($this->provider = $_provider);
	}
	/**
	 * Get shortCutId value
	 * @return long
	 */
	public function getShortCutId()
	{
		return $this->shortCutId;
	}
	/**
	 * Set shortCutId value
	 * @param long the shortCutId
	 * @return long
	 */
	public function setShortCutId($_shortCutId)
	{
		return ($this->shortCutId = $_shortCutId);
	}
	/**
	 * Method returning the class name
	 * @return string __CLASS__
	 */
	public function __toString()
	{
		return __CLASS__;
	}
}
?>