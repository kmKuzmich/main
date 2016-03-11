<?php
/**
 * File for class TecDocPackageStructChildNodesAllLinkingTarget2Request
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageStructChildNodesAllLinkingTarget2Request originally named ChildNodesAllLinkingTarget2Request
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
class TecDocPackageStructChildNodesAllLinkingTarget2Request extends TecDocPackageWsdlClass
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
	 * Constructor method for ChildNodesAllLinkingTarget2Request
	 * @see parent::__construct()
	 * @param boolean $_childNodes
	 * @param string $_lang
	 * @param string $_linkingTargetType
	 * @param long $_parentNodeId
	 * @param int $_provider
	 * @return TecDocPackageStructChildNodesAllLinkingTarget2Request
	 */
	public function __construct($_childNodes = NULL,$_lang = NULL,$_linkingTargetType = NULL,$_parentNodeId = NULL,$_provider = NULL)
	{
		parent::__construct(array('childNodes'=>$_childNodes,'lang'=>$_lang,'linkingTargetType'=>$_linkingTargetType,'parentNodeId'=>$_parentNodeId,'provider'=>$_provider));
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
	 * Method returning the class name
	 * @return string __CLASS__
	 */
	public function __toString()
	{
		return __CLASS__;
	}
}
?>