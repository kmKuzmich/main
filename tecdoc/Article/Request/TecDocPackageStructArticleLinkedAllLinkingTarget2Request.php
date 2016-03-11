<?php
/**
 * File for class TecDocPackageStructArticleLinkedAllLinkingTarget2Request
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageStructArticleLinkedAllLinkingTarget2Request originally named ArticleLinkedAllLinkingTarget2Request
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
class TecDocPackageStructArticleLinkedAllLinkingTarget2Request extends TecDocPackageWsdlClass
{
	/**
	 * The articleId
	 * @var long
	 */
	public $articleId;
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
	 * The linkingTargetManuId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $linkingTargetManuId;
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
	 * Constructor method for ArticleLinkedAllLinkingTarget2Request
	 * @see parent::__construct()
	 * @param long $_articleId
	 * @param string $_country
	 * @param string $_lang
	 * @param long $_linkingTargetId
	 * @param long $_linkingTargetManuId
	 * @param string $_linkingTargetType
	 * @param int $_provider
	 * @return TecDocPackageStructArticleLinkedAllLinkingTarget2Request
	 */
	public function __construct($_articleId = NULL,$_country = NULL,$_lang = NULL,$_linkingTargetId = NULL,$_linkingTargetManuId = NULL,$_linkingTargetType = NULL,$_provider = NULL)
	{
		parent::__construct(array('articleId'=>$_articleId,'country'=>$_country,'lang'=>$_lang,'linkingTargetId'=>$_linkingTargetId,'linkingTargetManuId'=>$_linkingTargetManuId,'linkingTargetType'=>$_linkingTargetType,'provider'=>$_provider));
	}
	/**
	 * Get articleId value
	 * @return long
	 */
	public function getArticleId()
	{
		return $this->articleId;
	}
	/**
	 * Set articleId value
	 * @param long the articleId
	 * @return long
	 */
	public function setArticleId($_articleId)
	{
		return ($this->articleId = $_articleId);
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
	 * Get linkingTargetManuId value
	 * @return long
	 */
	public function getLinkingTargetManuId()
	{
		return $this->linkingTargetManuId;
	}
	/**
	 * Set linkingTargetManuId value
	 * @param long the linkingTargetManuId
	 * @return long
	 */
	public function setLinkingTargetManuId($_linkingTargetManuId)
	{
		return ($this->linkingTargetManuId = $_linkingTargetManuId);
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
	 * Method returning the class name
	 * @return string __CLASS__
	 */
	public function __toString()
	{
		return __CLASS__;
	}
}
?>