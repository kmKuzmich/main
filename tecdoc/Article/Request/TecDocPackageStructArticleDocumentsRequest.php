<?php
/**
 * File for class TecDocPackageStructArticleDocumentsRequest
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageStructArticleDocumentsRequest originally named ArticleDocumentsRequest
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
class TecDocPackageStructArticleDocumentsRequest extends TecDocPackageWsdlClass
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
	 * The docTypeId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $docTypeId;
	/**
	 * The lang
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $lang;
	/**
	 * The provider
	 * @var int
	 */
	public $provider;
	/**
	 * Constructor method for ArticleDocumentsRequest
	 * @see parent::__construct()
	 * @param long $_articleId
	 * @param long $_articleLinkId
	 * @param string $_country
	 * @param long $_docTypeId
	 * @param string $_lang
	 * @param int $_provider
	 * @return TecDocPackageStructArticleDocumentsRequest
	 */
	public function __construct($_articleId = NULL,$_articleLinkId = NULL,$_country = NULL,$_docTypeId = NULL,$_lang = NULL,$_provider = NULL)
	{
		parent::__construct(array('articleId'=>$_articleId,'articleLinkId'=>$_articleLinkId,'country'=>$_country,'docTypeId'=>$_docTypeId,'lang'=>$_lang,'provider'=>$_provider));
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
	 * Get docTypeId value
	 * @return long
	 */
	public function getDocTypeId()
	{
		return $this->docTypeId;
	}
	/**
	 * Set docTypeId value
	 * @param long the docTypeId
	 * @return long
	 */
	public function setDocTypeId($_docTypeId)
	{
		return ($this->docTypeId = $_docTypeId);
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