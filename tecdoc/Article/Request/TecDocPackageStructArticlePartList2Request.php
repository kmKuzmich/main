<?php
/**
 * File for class TecDocPackageStructArticlePartList2Request
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageStructArticlePartList2Request originally named ArticlePartList2Request
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
class TecDocPackageStructArticlePartList2Request extends TecDocPackageWsdlClass
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
	 * The axleId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $axleId;
	/**
	 * The carId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $carId;
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
	 * The markId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $markId;
	/**
	 * The motorId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $motorId;
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
	 * Constructor method for ArticlePartList2Request
	 * @see parent::__construct()
	 * @param long $_articleId
	 * @param long $_articleLinkId
	 * @param long $_axleId
	 * @param long $_carId
	 * @param string $_country
	 * @param string $_lang
	 * @param long $_markId
	 * @param long $_motorId
	 * @param int $_priceDate
	 * @param int $_provider
	 * @return TecDocPackageStructArticlePartList2Request
	 */
	public function __construct($_articleId = NULL,$_articleLinkId = NULL,$_axleId = NULL,$_carId = NULL,$_country = NULL,$_lang = NULL,$_markId = NULL,$_motorId = NULL,$_priceDate = NULL,$_provider = NULL)
	{
		parent::__construct(array('articleId'=>$_articleId,'articleLinkId'=>$_articleLinkId,'axleId'=>$_axleId,'carId'=>$_carId,'country'=>$_country,'lang'=>$_lang,'markId'=>$_markId,'motorId'=>$_motorId,'priceDate'=>$_priceDate,'provider'=>$_provider));
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
	 * Get axleId value
	 * @return long
	 */
	public function getAxleId()
	{
		return $this->axleId;
	}
	/**
	 * Set axleId value
	 * @param long the axleId
	 * @return long
	 */
	public function setAxleId($_axleId)
	{
		return ($this->axleId = $_axleId);
	}
	/**
	 * Get carId value
	 * @return long
	 */
	public function getCarId()
	{
		return $this->carId;
	}
	/**
	 * Set carId value
	 * @param long the carId
	 * @return long
	 */
	public function setCarId($_carId)
	{
		return ($this->carId = $_carId);
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
	 * Get markId value
	 * @return long
	 */
	public function getMarkId()
	{
		return $this->markId;
	}
	/**
	 * Set markId value
	 * @param long the markId
	 * @return long
	 */
	public function setMarkId($_markId)
	{
		return ($this->markId = $_markId);
	}
	/**
	 * Get motorId value
	 * @return long
	 */
	public function getMotorId()
	{
		return $this->motorId;
	}
	/**
	 * Set motorId value
	 * @param long the motorId
	 * @return long
	 */
	public function setMotorId($_motorId)
	{
		return ($this->motorId = $_motorId);
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