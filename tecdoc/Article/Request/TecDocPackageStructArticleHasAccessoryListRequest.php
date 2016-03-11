<?php
/**
 * File for class TecDocPackageStructArticleHasAccessoryListRequest
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageStructArticleHasAccessoryListRequest originally named ArticleHasAccessoryListRequest
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
class TecDocPackageStructArticleHasAccessoryListRequest extends TecDocPackageWsdlClass
{
	/**
	 * The articleId
	 * @var long
	 */
	public $articleId;
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
	 * The manuId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $manuId;
	/**
	 * The modelId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $modelId;
	/**
	 * The motorId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $motorId;
	/**
	 * The provider
	 * @var int
	 */
	public $provider;
	/**
	 * The universalFlag
	 * @var boolean
	 */
	public $universalFlag;
	/**
	 * Constructor method for ArticleHasAccessoryListRequest
	 * @see parent::__construct()
	 * @param long $_articleId
	 * @param long $_carId
	 * @param string $_country
	 * @param long $_manuId
	 * @param long $_modelId
	 * @param long $_motorId
	 * @param int $_provider
	 * @param boolean $_universalFlag
	 * @return TecDocPackageStructArticleHasAccessoryListRequest
	 */
	public function __construct($_articleId = NULL,$_carId = NULL,$_country = NULL,$_manuId = NULL,$_modelId = NULL,$_motorId = NULL,$_provider = NULL,$_universalFlag = NULL)
	{
		parent::__construct(array('articleId'=>$_articleId,'carId'=>$_carId,'country'=>$_country,'manuId'=>$_manuId,'modelId'=>$_modelId,'motorId'=>$_motorId,'provider'=>$_provider,'universalFlag'=>$_universalFlag));
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
	 * Get modelId value
	 * @return long
	 */
	public function getModelId()
	{
		return $this->modelId;
	}
	/**
	 * Set modelId value
	 * @param long the modelId
	 * @return long
	 */
	public function setModelId($_modelId)
	{
		return ($this->modelId = $_modelId);
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
	 * Get universalFlag value
	 * @return boolean
	 */
	public function getUniversalFlag()
	{
		return $this->universalFlag;
	}
	/**
	 * Set universalFlag value
	 * @param boolean the universalFlag
	 * @return boolean
	 */
	public function setUniversalFlag($_universalFlag)
	{
		return ($this->universalFlag = $_universalFlag);
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