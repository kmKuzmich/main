<?php
/**
 * File for class TecDocPackageStructArticleLinkedAllLinkingTargetsByIds2Request
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageStructArticleLinkedAllLinkingTargetsByIds2Request originally named ArticleLinkedAllLinkingTargetsByIds2Request
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
class TecDocPackageStructArticleLinkedAllLinkingTargetsByIds2Request extends TecDocPackageWsdlClass
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
	 * The immediateAttributs
	 * @var boolean
	 */
	public $immediateAttributs;
	/**
	 * The lang
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $lang;
	/**
	 * The linkedArticlePairs
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var TecDocPackageStructLinkedArticlePairSeq
	 */
	public $linkedArticlePairs;
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
	 * Constructor method for ArticleLinkedAllLinkingTargetsByIds2Request
	 * @see parent::__construct()
	 * @param long $_articleId
	 * @param string $_country
	 * @param boolean $_immediateAttributs
	 * @param string $_lang
	 * @param TecDocPackageStructLinkedArticlePairSeq $_linkedArticlePairs
	 * @param string $_linkingTargetType
	 * @param int $_provider
	 * @return TecDocPackageStructArticleLinkedAllLinkingTargetsByIds2Request
	 */
	public function __construct($_articleId = NULL,$_country = NULL,$_immediateAttributs = NULL,$_lang = NULL,$_linkedArticlePairs = NULL,$_linkingTargetType = NULL,$_provider = NULL)
	{
		parent::__construct(array('articleId'=>$_articleId,'country'=>$_country,'immediateAttributs'=>$_immediateAttributs,'lang'=>$_lang,'linkedArticlePairs'=>$_linkedArticlePairs,'linkingTargetType'=>$_linkingTargetType,'provider'=>$_provider));
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
	 * Get immediateAttributs value
	 * @return boolean
	 */
	public function getImmediateAttributs()
	{
		return $this->immediateAttributs;
	}
	/**
	 * Set immediateAttributs value
	 * @param boolean the immediateAttributs
	 * @return boolean
	 */
	public function setImmediateAttributs($_immediateAttributs)
	{
		return ($this->immediateAttributs = $_immediateAttributs);
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
	 * Get linkedArticlePairs value
	 * @return TecDocPackageStructLinkedArticlePairSeq
	 */
	public function getLinkedArticlePairs()
	{
		return $this->linkedArticlePairs;
	}
	/**
	 * Set linkedArticlePairs value
	 * @param TecDocPackageStructLinkedArticlePairSeq the linkedArticlePairs
	 * @return TecDocPackageStructLinkedArticlePairSeq
	 */
	public function setLinkedArticlePairs($_linkedArticlePairs)
	{
		return ($this->linkedArticlePairs = $_linkedArticlePairs);
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