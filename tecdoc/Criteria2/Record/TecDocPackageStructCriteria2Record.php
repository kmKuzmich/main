<?php
/**
 * File for class TecDocPackageStructCriteria2Record
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageStructCriteria2Record originally named Criteria2Record
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
class TecDocPackageStructCriteria2Record extends TecDocPackageWsdlClass
{
	/**
	 * The criteriaId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $criteriaId;
	/**
	 * The criteriaName
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $criteriaName;
	/**
	 * The criteriaShortName
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $criteriaShortName;
	/**
	 * The criteriaType
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $criteriaType;
	/**
	 * The criteriaUnit
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $criteriaUnit;
	/**
	 * The isInterval
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var boolean
	 */
	public $isInterval;
	/**
	 * The successorId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $successorId;
	/**
	 * Constructor method for Criteria2Record
	 * @see parent::__construct()
	 * @param long $_criteriaId
	 * @param string $_criteriaName
	 * @param string $_criteriaShortName
	 * @param string $_criteriaType
	 * @param string $_criteriaUnit
	 * @param boolean $_isInterval
	 * @param long $_successorId
	 * @return TecDocPackageStructCriteria2Record
	 */
	public function __construct($_criteriaId = NULL,$_criteriaName = NULL,$_criteriaShortName = NULL,$_criteriaType = NULL,$_criteriaUnit = NULL,$_isInterval = NULL,$_successorId = NULL)
	{
		parent::__construct(array('criteriaId'=>$_criteriaId,'criteriaName'=>$_criteriaName,'criteriaShortName'=>$_criteriaShortName,'criteriaType'=>$_criteriaType,'criteriaUnit'=>$_criteriaUnit,'isInterval'=>$_isInterval,'successorId'=>$_successorId));
	}
	/**
	 * Get criteriaId value
	 * @return long
	 */
	public function getCriteriaId()
	{
		return $this->criteriaId;
	}
	/**
	 * Set criteriaId value
	 * @param long the criteriaId
	 * @return long
	 */
	public function setCriteriaId($_criteriaId)
	{
		return ($this->criteriaId = $_criteriaId);
	}
	/**
	 * Get criteriaName value
	 * @return string
	 */
	public function getCriteriaName()
	{
		return $this->criteriaName;
	}
	/**
	 * Set criteriaName value
	 * @param string the criteriaName
	 * @return string
	 */
	public function setCriteriaName($_criteriaName)
	{
		return ($this->criteriaName = $_criteriaName);
	}
	/**
	 * Get criteriaShortName value
	 * @return string
	 */
	public function getCriteriaShortName()
	{
		return $this->criteriaShortName;
	}
	/**
	 * Set criteriaShortName value
	 * @param string the criteriaShortName
	 * @return string
	 */
	public function setCriteriaShortName($_criteriaShortName)
	{
		return ($this->criteriaShortName = $_criteriaShortName);
	}
	/**
	 * Get criteriaType value
	 * @return string
	 */
	public function getCriteriaType()
	{
		return $this->criteriaType;
	}
	/**
	 * Set criteriaType value
	 * @param string the criteriaType
	 * @return string
	 */
	public function setCriteriaType($_criteriaType)
	{
		return ($this->criteriaType = $_criteriaType);
	}
	/**
	 * Get criteriaUnit value
	 * @return string
	 */
	public function getCriteriaUnit()
	{
		return $this->criteriaUnit;
	}
	/**
	 * Set criteriaUnit value
	 * @param string the criteriaUnit
	 * @return string
	 */
	public function setCriteriaUnit($_criteriaUnit)
	{
		return ($this->criteriaUnit = $_criteriaUnit);
	}
	/**
	 * Get isInterval value
	 * @return boolean
	 */
	public function getIsInterval()
	{
		return $this->isInterval;
	}
	/**
	 * Set isInterval value
	 * @param boolean the isInterval
	 * @return boolean
	 */
	public function setIsInterval($_isInterval)
	{
		return ($this->isInterval = $_isInterval);
	}
	/**
	 * Get successorId value
	 * @return long
	 */
	public function getSuccessorId()
	{
		return $this->successorId;
	}
	/**
	 * Set successorId value
	 * @param long the successorId
	 * @return long
	 */
	public function setSuccessorId($_successorId)
	{
		return ($this->successorId = $_successorId);
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