<?php
/**
 * File for class TecDocPackageStructArticleLinkedMotorsByIdRecord
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageStructArticleLinkedMotorsByIdRecord originally named ArticleLinkedMotorsByIdRecord
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
class TecDocPackageStructArticleLinkedMotorsByIdRecord extends TecDocPackageWsdlClass
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
	 * The cylinder
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var int
	 */
	public $cylinder;
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
	 * The motorCode
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $motorCode;
	/**
	 * The motorId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $motorId;
	/**
	 * The powerHp
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var int
	 */
	public $powerHp;
	/**
	 * The powerKw
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var int
	 */
	public $powerKw;
	/**
	 * Constructor method for ArticleLinkedMotorsByIdRecord
	 * @see parent::__construct()
	 * @param string $_assembledFrom
	 * @param string $_assembledTo
	 * @param int $_cylinder
	 * @param int $_cylinderCapacity
	 * @param string $_manuDesc
	 * @param long $_manuId
	 * @param string $_motorCode
	 * @param long $_motorId
	 * @param int $_powerHp
	 * @param int $_powerKw
	 * @return TecDocPackageStructArticleLinkedMotorsByIdRecord
	 */
	public function __construct($_assembledFrom = NULL,$_assembledTo = NULL,$_cylinder = NULL,$_cylinderCapacity = NULL,$_manuDesc = NULL,$_manuId = NULL,$_motorCode = NULL,$_motorId = NULL,$_powerHp = NULL,$_powerKw = NULL)
	{
		parent::__construct(array('assembledFrom'=>$_assembledFrom,'assembledTo'=>$_assembledTo,'cylinder'=>$_cylinder,'cylinderCapacity'=>$_cylinderCapacity,'manuDesc'=>$_manuDesc,'manuId'=>$_manuId,'motorCode'=>$_motorCode,'motorId'=>$_motorId,'powerHp'=>$_powerHp,'powerKw'=>$_powerKw));
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
	 * Get cylinder value
	 * @return int
	 */
	public function getCylinder()
	{
		return $this->cylinder;
	}
	/**
	 * Set cylinder value
	 * @param int the cylinder
	 * @return int
	 */
	public function setCylinder($_cylinder)
	{
		return ($this->cylinder = $_cylinder);
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
	 * Get motorCode value
	 * @return string
	 */
	public function getMotorCode()
	{
		return $this->motorCode;
	}
	/**
	 * Set motorCode value
	 * @param string the motorCode
	 * @return string
	 */
	public function setMotorCode($_motorCode)
	{
		return ($this->motorCode = $_motorCode);
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
	 * Get powerHp value
	 * @return int
	 */
	public function getPowerHp()
	{
		return $this->powerHp;
	}
	/**
	 * Set powerHp value
	 * @param int the powerHp
	 * @return int
	 */
	public function setPowerHp($_powerHp)
	{
		return ($this->powerHp = $_powerHp);
	}
	/**
	 * Get powerKw value
	 * @return int
	 */
	public function getPowerKw()
	{
		return $this->powerKw;
	}
	/**
	 * Set powerKw value
	 * @param int the powerKw
	 * @return int
	 */
	public function setPowerKw($_powerKw)
	{
		return ($this->powerKw = $_powerKw);
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