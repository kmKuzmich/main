<?php
/**
 * File for class TecDocPackageStructReplacedByNumbersRecordSeq
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageStructReplacedByNumbersRecordSeq originally named ReplacedByNumbersRecordSeq
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
class TecDocPackageStructReplacedByNumbersRecordSeq extends TecDocPackageWsdlClass
{
	/**
	 * The array
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var Array
	 */
	public $array;
	/**
	 * The empty
	 * @var boolean
	 */
	public $empty;
	/**
	 * Constructor method for ReplacedByNumbersRecordSeq
	 * @see parent::__construct()
	 * @param Array $_array
	 * @param boolean $_empty
	 * @return TecDocPackageStructReplacedByNumbersRecordSeq
	 */
	public function __construct($_array = NULL,$_empty = NULL)
	{
		parent::__construct(array('array'=>$_array,'empty'=>$_empty));
	}
	/**
	 * Get array value
	 * @return Array
	 */
	public function getArray()
	{
		return $this->array;
	}
	/**
	 * Set array value
	 * @param Array the array
	 * @return Array
	 */
	public function setArray($_array)
	{
		return ($this->array = $_array);
	}
	/**
	 * Get empty value
	 * @return boolean
	 */
	public function getEmpty()
	{
		return $this->empty;
	}
	/**
	 * Set empty value
	 * @param boolean the empty
	 * @return boolean
	 */
	public function setEmpty($_empty)
	{
		return ($this->empty = $_empty);
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