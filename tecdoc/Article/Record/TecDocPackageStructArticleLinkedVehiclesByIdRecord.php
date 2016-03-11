<?php
/**
 * File for class TecDocPackageStructArticleLinkedVehiclesByIdRecord
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageStructArticleLinkedVehiclesByIdRecord originally named ArticleLinkedVehiclesByIdRecord
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
class TecDocPackageStructArticleLinkedVehiclesByIdRecord extends TecDocPackageWsdlClass
{
	/**
	 * The assembledFrom
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $assembledFrom;
	/**
	 * The assembledTo
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $assembledTo;
	/**
	 * The axisConfiguration
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $axisConfiguration;
	/**
	 * The carDesc
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $carDesc;
	/**
	 * The carId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $carId;
	/**
	 * The constructionType
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $constructionType;
	/**
	 * The cylinderCapacity
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var int
	 */
	public $cylinderCapacity;
	/**
	 * The manuDesc
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $manuDesc;
	/**
	 * The manuId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $manuId;
	/**
	 * The modelDesc
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $modelDesc;
	/**
	 * The modelId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $modelId;
	/**
	 * The powerHpFrom
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var int
	 */
	public $powerHpFrom;
	/**
	 * The powerHpTo
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var int
	 */
	public $powerHpTo;
	/**
	 * The powerKwFrom
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var int
	 */
	public $powerKwFrom;
	/**
	 * The powerKwTo
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var int
	 */
	public $powerKwTo;
	/**
	 * The tonnage
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var int
	 */
	public $tonnage;
	/**
	 * The yearOfConstructionFrom
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var int
	 */
	public $yearOfConstructionFrom;
	/**
	 * The yearOfConstructionTo
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var int
	 */
	public $yearOfConstructionTo;
	/**
	 * Constructor method for ArticleLinkedVehiclesByIdRecord
	 * @see parent::__construct()
	 * @param string $_assembledFrom
	 * @param string $_assembledTo
	 * @param string $_axisConfiguration
	 * @param string $_carDesc
	 * @param long $_carId
	 * @param string $_constructionType
	 * @param int $_cylinderCapacity
	 * @param string $_manuDesc
	 * @param long $_manuId
	 * @param string $_modelDesc
	 * @param long $_modelId
	 * @param int $_powerHpFrom
	 * @param int $_powerHpTo
	 * @param int $_powerKwFrom
	 * @param int $_powerKwTo
	 * @param int $_tonnage
	 * @param int $_yearOfConstructionFrom
	 * @param int $_yearOfConstructionTo
	 * @return TecDocPackageStructArticleLinkedVehiclesByIdRecord
	 */
	public function __construct($_assembledFrom = NULL,$_assembledTo = NULL,$_axisConfiguration = NULL,$_carDesc = NULL,$_carId = NULL,$_constructionType = NULL,$_cylinderCapacity = NULL,$_manuDesc = NULL,$_manuId = NULL,$_modelDesc = NULL,$_modelId = NULL,$_powerHpFrom = NULL,$_powerHpTo = NULL,$_powerKwFrom = NULL,$_powerKwTo = NULL,$_tonnage = NULL,$_yearOfConstructionFrom = NULL,$_yearOfConstructionTo = NULL)
	{
		parent::__construct(array('assembledFrom'=>$_assembledFrom,'assembledTo'=>$_assembledTo,'axisConfiguration'=>$_axisConfiguration,'carDesc'=>$_carDesc,'carId'=>$_carId,'constructionType'=>$_constructionType,'cylinderCapacity'=>$_cylinderCapacity,'manuDesc'=>$_manuDesc,'manuId'=>$_manuId,'modelDesc'=>$_modelDesc,'modelId'=>$_modelId,'powerHpFrom'=>$_powerHpFrom,'powerHpTo'=>$_powerHpTo,'powerKwFrom'=>$_powerKwFrom,'powerKwTo'=>$_powerKwTo,'tonnage'=>$_tonnage,'yearOfConstructionFrom'=>$_yearOfConstructionFrom,'yearOfConstructionTo'=>$_yearOfConstructionTo));
	}
	/**
	 * Get assembledFrom value
	 * @return string
	 */
	public function getAssembledFrom()
	{
		return $this->assembledFrom;
	}
	/**
	 * Set assembledFrom value
	 * @param string the assembledFrom
	 * @return string
	 */
	public function setAssembledFrom($_assembledFrom)
	{
		return ($this->assembledFrom = $_assembledFrom);
	}
	/**
	 * Get assembledTo value
	 * @return string
	 */
	public function getAssembledTo()
	{
		return $this->assembledTo;
	}
	/**
	 * Set assembledTo value
	 * @param string the assembledTo
	 * @return string
	 */
	public function setAssembledTo($_assembledTo)
	{
		return ($this->assembledTo = $_assembledTo);
	}
	/**
	 * Get axisConfiguration value
	 * @return string
	 */
	public function getAxisConfiguration()
	{
		return $this->axisConfiguration;
	}
	/**
	 * Set axisConfiguration value
	 * @param string the axisConfiguration
	 * @return string
	 */
	public function setAxisConfiguration($_axisConfiguration)
	{
		return ($this->axisConfiguration = $_axisConfiguration);
	}
	/**
	 * Get carDesc value
	 * @return string
	 */
	public function getCarDesc()
	{
		return $this->carDesc;
	}
	/**
	 * Set carDesc value
	 * @param string the carDesc
	 * @return string
	 */
	public function setCarDesc($_carDesc)
	{
		return ($this->carDesc = $_carDesc);
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
	 * Get constructionType value
	 * @return string
	 */
	public function getConstructionType()
	{
		return $this->constructionType;
	}
	/**
	 * Set constructionType value
	 * @param string the constructionType
	 * @return string
	 */
	public function setConstructionType($_constructionType)
	{
		return ($this->constructionType = $_constructionType);
	}
	/**
	 * Get cylinderCapacity value
	 * @return int
	 */
	public function getCylinderCapacity()
	{
		return $this->cylinderCapacity;
	}
	/**
	 * Set cylinderCapacity value
	 * @param int the cylinderCapacity
	 * @return int
	 */
	public function setCylinderCapacity($_cylinderCapacity)
	{
		return ($this->cylinderCapacity = $_cylinderCapacity);
	}
	/**
	 * Get manuDesc value
	 * @return string
	 */
	public function getManuDesc()
	{
		return $this->manuDesc;
	}
	/**
	 * Set manuDesc value
	 * @param string the manuDesc
	 * @return string
	 */
	public function setManuDesc($_manuDesc)
	{
		return ($this->manuDesc = $_manuDesc);
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
	 * Get modelDesc value
	 * @return string
	 */
	public function getModelDesc()
	{
		return $this->modelDesc;
	}
	/**
	 * Set modelDesc value
	 * @param string the modelDesc
	 * @return string
	 */
	public function setModelDesc($_modelDesc)
	{
		return ($this->modelDesc = $_modelDesc);
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
	 * Get powerHpFrom value
	 * @return int
	 */
	public function getPowerHpFrom()
	{
		return $this->powerHpFrom;
	}
	/**
	 * Set powerHpFrom value
	 * @param int the powerHpFrom
	 * @return int
	 */
	public function setPowerHpFrom($_powerHpFrom)
	{
		return ($this->powerHpFrom = $_powerHpFrom);
	}
	/**
	 * Get powerHpTo value
	 * @return int
	 */
	public function getPowerHpTo()
	{
		return $this->powerHpTo;
	}
	/**
	 * Set powerHpTo value
	 * @param int the powerHpTo
	 * @return int
	 */
	public function setPowerHpTo($_powerHpTo)
	{
		return ($this->powerHpTo = $_powerHpTo);
	}
	/**
	 * Get powerKwFrom value
	 * @return int
	 */
	public function getPowerKwFrom()
	{
		return $this->powerKwFrom;
	}
	/**
	 * Set powerKwFrom value
	 * @param int the powerKwFrom
	 * @return int
	 */
	public function setPowerKwFrom($_powerKwFrom)
	{
		return ($this->powerKwFrom = $_powerKwFrom);
	}
	/**
	 * Get powerKwTo value
	 * @return int
	 */
	public function getPowerKwTo()
	{
		return $this->powerKwTo;
	}
	/**
	 * Set powerKwTo value
	 * @param int the powerKwTo
	 * @return int
	 */
	public function setPowerKwTo($_powerKwTo)
	{
		return ($this->powerKwTo = $_powerKwTo);
	}
	/**
	 * Get tonnage value
	 * @return int
	 */
	public function getTonnage()
	{
		return $this->tonnage;
	}
	/**
	 * Set tonnage value
	 * @param int the tonnage
	 * @return int
	 */
	public function setTonnage($_tonnage)
	{
		return ($this->tonnage = $_tonnage);
	}
	/**
	 * Get yearOfConstructionFrom value
	 * @return int
	 */
	public function getYearOfConstructionFrom()
	{
		return $this->yearOfConstructionFrom;
	}
	/**
	 * Set yearOfConstructionFrom value
	 * @param int the yearOfConstructionFrom
	 * @return int
	 */
	public function setYearOfConstructionFrom($_yearOfConstructionFrom)
	{
		return ($this->yearOfConstructionFrom = $_yearOfConstructionFrom);
	}
	/**
	 * Get yearOfConstructionTo value
	 * @return int
	 */
	public function getYearOfConstructionTo()
	{
		return $this->yearOfConstructionTo;
	}
	/**
	 * Set yearOfConstructionTo value
	 * @param int the yearOfConstructionTo
	 * @return int
	 */
	public function setYearOfConstructionTo($_yearOfConstructionTo)
	{
		return ($this->yearOfConstructionTo = $_yearOfConstructionTo);
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