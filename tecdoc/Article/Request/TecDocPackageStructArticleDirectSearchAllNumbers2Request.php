<?php
/**
 * File for class TecDocPackageStructArticleDirectSearchAllNumbers2Request
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageStructArticleDirectSearchAllNumbers2Request originally named ArticleDirectSearchAllNumbers2Request
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
class TecDocPackageStructArticleDirectSearchAllNumbers2Request extends TecDocPackageWsdlClass
{
	/**
	 * The articleNumber
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $articleNumber;
	/**
	 * The brandno
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $brandno;
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
	 * @var long
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
	 * The numberType
	 * @var int
	 */
	public $numberType;
	/**
	 * The provider
	 * @var int
	 */
	public $provider;
	/**
	 * The searchExact
	 * @var boolean
	 */
	public $searchExact;
	/**
	 * The sortType
	 * @var int
	 */
	public $sortType;
	/**
	 * Constructor method for ArticleDirectSearchAllNumbers2Request
	 * @see parent::__construct()
	 * @param string $_articleNumber
	 * @param long $_brandno
	 * @param string $_country
	 * @param long $_genericArticleId
	 * @param string $_lang
	 * @param int $_numberType
	 * @param int $_provider
	 * @param boolean $_searchExact
	 * @param int $_sortType
	 * @return TecDocPackageStructArticleDirectSearchAllNumbers2Request
	 */
	public function __construct($_articleNumber = NULL,$_brandno = NULL,$_country = NULL,$_genericArticleId = NULL,$_lang = NULL,$_numberType = NULL,$_provider = NULL,$_searchExact = NULL,$_sortType = NULL)
	{
		parent::__construct(array('articleNumber'=>$_articleNumber,'brandno'=>$_brandno,'country'=>$_country,'genericArticleId'=>$_genericArticleId,'lang'=>$_lang,'numberType'=>$_numberType,'provider'=>$_provider,'searchExact'=>$_searchExact,'sortType'=>$_sortType));
	}
	/**
	 * Get articleNumber value
	 * @return string
	 */
	public function getArticleNumber()
	{
		return $this->articleNumber;
	}
	/**
	 * Set articleNumber value
	 * @param string the articleNumber
	 * @return string
	 */
	public function setArticleNumber($_articleNumber)
	{
		return ($this->articleNumber = $_articleNumber);
	}
	/**
	 * Get brandno value
	 * @return long
	 */
	public function getBrandno()
	{
		return $this->brandno;
	}
	/**
	 * Set brandno value
	 * @param long the brandno
	 * @return long
	 */
	public function setBrandno($_brandno)
	{
		return ($this->brandno = $_brandno);
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
	 * @return long
	 */
	public function getGenericArticleId()
	{
		return $this->genericArticleId;
	}
	/**
	 * Set genericArticleId value
	 * @param long the genericArticleId
	 * @return long
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
	 * Get numberType value
	 * @return int
	 */
	public function getNumberType()
	{
		return $this->numberType;
	}
	/**
	 * Set numberType value
	 * @param int the numberType
	 * @return int
	 */
	public function setNumberType($_numberType)
	{
		return ($this->numberType = $_numberType);
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
	 * Get searchExact value
	 * @return boolean
	 */
	public function getSearchExact()
	{
		return $this->searchExact;
	}
	/**
	 * Set searchExact value
	 * @param boolean the searchExact
	 * @return boolean
	 */
	public function setSearchExact($_searchExact)
	{
		return ($this->searchExact = $_searchExact);
	}
	/**
	 * Get sortType value
	 * @return int
	 */
	public function getSortType()
	{
		return $this->sortType;
	}
	/**
	 * Set sortType value
	 * @param int the sortType
	 * @return int
	 */
	public function setSortType($_sortType)
	{
		return ($this->sortType = $_sortType);
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