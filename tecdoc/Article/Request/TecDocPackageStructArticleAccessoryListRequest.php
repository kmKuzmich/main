<?php
/**
 * File for class TecDocPackageStructArticleAccessoryListRequest
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageStructArticleAccessoryListRequest originally named ArticleAccessoryListRequest
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
class TecDocPackageStructArticleAccessoryListRequest extends TecDocPackageWsdlClass
{
	/**
	 * The articleId
	 * @var long
	 */
	public $articleId;
	/**
	 * The articleLinkId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $articleLinkId;
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
	 * The manuId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $manuId;
	/**
	 * The modId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $modId;
	/**
	 * The priceDate
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var int
	 */
	public $priceDate;
	/**
	 * The provider
	 * @var int
	 */
	public $provider;
	/**
	 * Constructor method for ArticleAccessoryListRequest
	 * @see parent::__construct()
	 * @param long $_articleId
	 * @param long $_articleLinkId
	 * @param string $_country
	 * @param string $_lang
	 * @param long $_linkingTargetId
	 * @param string $_linkingTargetType
	 * @param long $_manuId
	 * @param long $_modId
	 * @param int $_priceDate
	 * @param int $_provider
	 * @return TecDocPackageStructArticleAccessoryListRequest
	 */
	public function __construct($_articleId = NULL,$_articleLinkId = NULL,$_country = NULL,$_lang = NULL,$_linkingTargetId = NULL,$_linkingTargetType = NULL,$_manuId = NULL,$_modId = NULL,$_priceDate = NULL,$_provider = NULL)
	{
		parent::__construct(array('articleId'=>$_articleId,'articleLinkId'=>$_articleLinkId,'country'=>$_country,'lang'=>$_lang,'linkingTargetId'=>$_linkingTargetId,'linkingTargetType'=>$_linkingTargetType,'manuId'=>$_manuId,'modId'=>$_modId,'priceDate'=>$_priceDate,'provider'=>$_provider));
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
	 * Get articleLinkId value
	 * @return long
	 */
	public function getArticleLinkId()
	{
		return $this->articleLinkId;
	}
	/**
	 * Set articleLinkId value
	 * @param long the articleLinkId
	 * @return long
	 */
	public function setArticleLinkId($_articleLinkId)
	{
		return ($this->articleLinkId = $_articleLinkId);
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
	 * Get manuId value
	 * @return long
	 */
	public function getManuId()
	{
		return $this->manuId;
	}
	/**
	 * Set manuId value
	 * @param long the manuId
	 * @return long
	 */
	public function setManuId($_manuId)
	{
		return ($this->manuId = $_manuId);
	}
	/**
	 * Get modId value
	 * @return long
	 */
	public function getModId()
	{
		return $this->modId;
	}
	/**
	 * Set modId value
	 * @param long the modId
	 * @return long
	 */
	public function setModId($_modId)
	{
		return ($this->modId = $_modId);
	}
	/**
	 * Get priceDate value
	 * @return int
	 */
	public function getPriceDate()
	{
		return $this->priceDate;
	}
	/**
	 * Set priceDate value
	 * @param int the priceDate
	 * @return int
	 */
	public function setPriceDate($_priceDate)
	{
		return ($this->priceDate = $_priceDate);
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