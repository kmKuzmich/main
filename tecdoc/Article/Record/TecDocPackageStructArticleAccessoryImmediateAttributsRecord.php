<?php
/**
 * File for class TecDocPackageStructArticleAccessoryImmediateAttributsRecord
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageStructArticleAccessoryImmediateAttributsRecord originally named ArticleAccessoryImmediateAttributsRecord
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
class TecDocPackageStructArticleAccessoryImmediateAttributsRecord extends TecDocPackageWsdlClass
{
	/**
	 * The attrBlockNo
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $attrBlockNo;
	/**
	 * The attrId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $attrId;
	/**
	 * The attrIsConditional
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var boolean
	 */
	public $attrIsConditional;
	/**
	 * The attrIsInterval
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var boolean
	 */
	public $attrIsInterval;
	/**
	 * The attrName
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $attrName;
	/**
	 * The attrShortName
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $attrShortName;
	/**
	 * The attrSuccessorId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $attrSuccessorId;
	/**
	 * The attrType
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $attrType;
	/**
	 * The attrUnit
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $attrUnit;
	/**
	 * The attrValue
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $attrValue;
	/**
	 * The isAccessoryAttr
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var boolean
	 */
	public $isAccessoryAttr;
	/**
	 * Constructor method for ArticleAccessoryImmediateAttributsRecord
	 * @see parent::__construct()
	 * @param long $_attrBlockNo
	 * @param long $_attrId
	 * @param boolean $_attrIsConditional
	 * @param boolean $_attrIsInterval
	 * @param string $_attrName
	 * @param string $_attrShortName
	 * @param long $_attrSuccessorId
	 * @param string $_attrType
	 * @param string $_attrUnit
	 * @param string $_attrValue
	 * @param boolean $_isAccessoryAttr
	 * @return TecDocPackageStructArticleAccessoryImmediateAttributsRecord
	 */
	public function __construct($_attrBlockNo = NULL,$_attrId = NULL,$_attrIsConditional = NULL,$_attrIsInterval = NULL,$_attrName = NULL,$_attrShortName = NULL,$_attrSuccessorId = NULL,$_attrType = NULL,$_attrUnit = NULL,$_attrValue = NULL,$_isAccessoryAttr = NULL)
	{
		parent::__construct(array('attrBlockNo'=>$_attrBlockNo,'attrId'=>$_attrId,'attrIsConditional'=>$_attrIsConditional,'attrIsInterval'=>$_attrIsInterval,'attrName'=>$_attrName,'attrShortName'=>$_attrShortName,'attrSuccessorId'=>$_attrSuccessorId,'attrType'=>$_attrType,'attrUnit'=>$_attrUnit,'attrValue'=>$_attrValue,'isAccessoryAttr'=>$_isAccessoryAttr));
	}
	/**
	 * Get attrBlockNo value
	 * @return long
	 */
	public function getAttrBlockNo()
	{
		return $this->attrBlockNo;
	}
	/**
	 * Set attrBlockNo value
	 * @param long the attrBlockNo
	 * @return long
	 */
	public function setAttrBlockNo($_attrBlockNo)
	{
		return ($this->attrBlockNo = $_attrBlockNo);
	}
	/**
	 * Get attrId value
	 * @return long
	 */
	public function getAttrId()
	{
		return $this->attrId;
	}
	/**
	 * Set attrId value
	 * @param long the attrId
	 * @return long
	 */
	public function setAttrId($_attrId)
	{
		return ($this->attrId = $_attrId);
	}
	/**
	 * Get attrIsConditional value
	 * @return boolean
	 */
	public function getAttrIsConditional()
	{
		return $this->attrIsConditional;
	}
	/**
	 * Set attrIsConditional value
	 * @param boolean the attrIsConditional
	 * @return boolean
	 */
	public function setAttrIsConditional($_attrIsConditional)
	{
		return ($this->attrIsConditional = $_attrIsConditional);
	}
	/**
	 * Get attrIsInterval value
	 * @return boolean
	 */
	public function getAttrIsInterval()
	{
		return $this->attrIsInterval;
	}
	/**
	 * Set attrIsInterval value
	 * @param boolean the attrIsInterval
	 * @return boolean
	 */
	public function setAttrIsInterval($_attrIsInterval)
	{
		return ($this->attrIsInterval = $_attrIsInterval);
	}
	/**
	 * Get attrName value
	 * @return string
	 */
	public function getAttrName()
	{
		return $this->attrName;
	}
	/**
	 * Set attrName value
	 * @param string the attrName
	 * @return string
	 */
	public function setAttrName($_attrName)
	{
		return ($this->attrName = $_attrName);
	}
	/**
	 * Get attrShortName value
	 * @return string
	 */
	public function getAttrShortName()
	{
		return $this->attrShortName;
	}
	/**
	 * Set attrShortName value
	 * @param string the attrShortName
	 * @return string
	 */
	public function setAttrShortName($_attrShortName)
	{
		return ($this->attrShortName = $_attrShortName);
	}
	/**
	 * Get attrSuccessorId value
	 * @return long
	 */
	public function getAttrSuccessorId()
	{
		return $this->attrSuccessorId;
	}
	/**
	 * Set attrSuccessorId value
	 * @param long the attrSuccessorId
	 * @return long
	 */
	public function setAttrSuccessorId($_attrSuccessorId)
	{
		return ($this->attrSuccessorId = $_attrSuccessorId);
	}
	/**
	 * Get attrType value
	 * @return string
	 */
	public function getAttrType()
	{
		return $this->attrType;
	}
	/**
	 * Set attrType value
	 * @param string the attrType
	 * @return string
	 */
	public function setAttrType($_attrType)
	{
		return ($this->attrType = $_attrType);
	}
	/**
	 * Get attrUnit value
	 * @return string
	 */
	public function getAttrUnit()
	{
		return $this->attrUnit;
	}
	/**
	 * Set attrUnit value
	 * @param string the attrUnit
	 * @return string
	 */
	public function setAttrUnit($_attrUnit)
	{
		return ($this->attrUnit = $_attrUnit);
	}
	/**
	 * Get attrValue value
	 * @return string
	 */
	public function getAttrValue()
	{
		return $this->attrValue;
	}
	/**
	 * Set attrValue value
	 * @param string the attrValue
	 * @return string
	 */
	public function setAttrValue($_attrValue)
	{
		return ($this->attrValue = $_attrValue);
	}
	/**
	 * Get isAccessoryAttr value
	 * @return boolean
	 */
	public function getIsAccessoryAttr()
	{
		return $this->isAccessoryAttr;
	}
	/**
	 * Set isAccessoryAttr value
	 * @param boolean the isAccessoryAttr
	 * @return boolean
	 */
	public function setIsAccessoryAttr($_isAccessoryAttr)
	{
		return ($this->isAccessoryAttr = $_isAccessoryAttr);
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