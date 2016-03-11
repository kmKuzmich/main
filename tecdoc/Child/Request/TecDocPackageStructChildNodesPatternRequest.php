<?php
/**
 * File for class TecDocPackageStructChildNodesPatternRequest
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageStructChildNodesPatternRequest originally named ChildNodesPatternRequest
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
class TecDocPackageStructChildNodesPatternRequest extends TecDocPackageWsdlClass
{
	/**
	 * The country
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $country;
	/**
	 * The lang
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $lang;
	/**
	 * The linkingTargetId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $linkingTargetId;
	/**
	 * The linkingTargetType
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $linkingTargetType;
	/**
	 * The provider
	 * @var int
	 */
	public $provider;
	/**
	 * The searchPattern
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $searchPattern;
	/**
	 * Constructor method for ChildNodesPatternRequest
	 * @see parent::__construct()
	 * @param string $_country
	 * @param string $_lang
	 * @param long $_linkingTargetId
	 * @param string $_linkingTargetType
	 * @param int $_provider
	 * @param string $_searchPattern
	 * @return TecDocPackageStructChildNodesPatternRequest
	 */
	public function __construct($_country = NULL,$_lang = NULL,$_linkingTargetId = NULL,$_linkingTargetType = NULL,$_provider = NULL,$_searchPattern = NULL)
	{
		parent::__construct(array('country'=>$_country,'lang'=>$_lang,'linkingTargetId'=>$_linkingTargetId,'linkingTargetType'=>$_linkingTargetType,'provider'=>$_provider,'searchPattern'=>$_searchPattern));
	}
	/**
	 * Get country value
	 * @return string
	 */
	public function getCountry()
	{
		return $this->country;
	}
	/**
	 * Set country value
	 * @param string the country
	 * @return string
	 */
	public function setCountry($_country)
	{
		return ($this->country = $_country);
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
	 * Get linkingTargetId value
	 * @return long
	 */
	public function getLinkingTargetId()
	{
		return $this->linkingTargetId;
	}
	/**
	 * Set linkingTargetId value
	 * @param long the linkingTargetId
	 * @return long
	 */
	public function setLinkingTargetId($_linkingTargetId)
	{
		return ($this->linkingTargetId = $_linkingTargetId);
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
	 * Get searchPattern value
	 * @return string
	 */
	public function getSearchPattern()
	{
		return $this->searchPattern;
	}
	/**
	 * Set searchPattern value
	 * @param string the searchPattern
	 * @return string
	 */
	public function setSearchPattern($_searchPattern)
	{
		return ($this->searchPattern = $_searchPattern);
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