<?php
/**
 * File for class TecDocPackageStructArticleIds3StringListRequest
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageStructArticleIds3StringListRequest originally named ArticleIds3StringListRequest
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
class TecDocPackageStructArticleIds3StringListRequest extends TecDocPackageWsdlClass
{
	/**
	 * The assemblyGroupNodeId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $assemblyGroupNodeId;
	/**
	 * The brandNo
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var TecDocPackageStructStringList
	 */
	public $brandNo;
	/**
	 * The country
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $country;
	/**
	 * The genericArticleId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var TecDocPackageStructStringList
	 */
	public $genericArticleId;
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
	 * The sort
	 * @var int
	 */
	public $sort;
	/**
	 * Constructor method for ArticleIds3StringListRequest
	 * @see parent::__construct()
	 * @param long $_assemblyGroupNodeId
	 * @param TecDocPackageStructStringList $_brandNo
	 * @param string $_country
	 * @param TecDocPackageStructStringList $_genericArticleId
	 * @param string $_lang
	 * @param long $_linkingTargetId
	 * @param string $_linkingTargetType
	 * @param int $_provider
	 * @param int $_sort
	 * @return TecDocPackageStructArticleIds3StringListRequest
	 */
	public function __construct($_assemblyGroupNodeId = NULL,$_brandNo = NULL,$_country = NULL,$_genericArticleId = NULL,$_lang = NULL,$_linkingTargetId = NULL,$_linkingTargetType = NULL,$_provider = NULL,$_sort = NULL)
	{
		parent::__construct(array('assemblyGroupNodeId'=>$_assemblyGroupNodeId,'brandNo'=>$_brandNo,'country'=>$_country,'genericArticleId'=>$_genericArticleId,'lang'=>$_lang,'linkingTargetId'=>$_linkingTargetId,'linkingTargetType'=>$_linkingTargetType,'provider'=>$_provider,'sort'=>$_sort));
	}
	/**
	 * Get assemblyGroupNodeId value
	 * @return long
	 */
	public function getAssemblyGroupNodeId()
	{
		return $this->assemblyGroupNodeId;
	}
	/**
	 * Set assemblyGroupNodeId value
	 * @param long the assemblyGroupNodeId
	 * @return long
	 */
	public function setAssemblyGroupNodeId($_assemblyGroupNodeId)
	{
		return ($this->assemblyGroupNodeId = $_assemblyGroupNodeId);
	}
	/**
	 * Get brandNo value
	 * @return TecDocPackageStructStringList
	 */
	public function getBrandNo()
	{
		return $this->brandNo;
	}
	/**
	 * Set brandNo value
	 * @param TecDocPackageStructStringList the brandNo
	 * @return TecDocPackageStructStringList
	 */
	public function setBrandNo($_brandNo)
	{
		return ($this->brandNo = $_brandNo);
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
	 * Get genericArticleId value
	 * @return TecDocPackageStructStringList
	 */
	public function getGenericArticleId()
	{
		return $this->genericArticleId;
	}
	/**
	 * Set genericArticleId value
	 * @param TecDocPackageStructStringList the genericArticleId
	 * @return TecDocPackageStructStringList
	 */
	public function setGenericArticleId($_genericArticleId)
	{
		return ($this->genericArticleId = $_genericArticleId);
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
	 * Get sort value
	 * @return int
	 */
	public function getSort()
	{
		return $this->sort;
	}
	/**
	 * Set sort value
	 * @param int the sort
	 * @return int
	 */
	public function setSort($_sort)
	{
		return ($this->sort = $_sort);
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