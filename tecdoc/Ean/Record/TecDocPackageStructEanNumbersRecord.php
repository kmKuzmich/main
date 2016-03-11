<?php
/**
 * File for class TecDocPackageStructEanNumbersRecord
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageStructEanNumbersRecord originally named EanNumbersRecord
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
class TecDocPackageStructEanNumbersRecord extends TecDocPackageWsdlClass
{
	/**
	 * The eanNumber
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $eanNumber;
	/**
	 * Constructor method for EanNumbersRecord
	 * @see parent::__construct()
	 * @param string $_eanNumber
	 * @return TecDocPackageStructEanNumbersRecord
	 */
	public function __construct($_eanNumber = NULL)
	{
		parent::__construct(array('eanNumber'=>$_eanNumber));
	}
	/**
	 * Get eanNumber value
	 * @return string
	 */
	public function getEanNumber()
	{
		return $this->eanNumber;
	}
	/**
	 * Set eanNumber value
	 * @param string the eanNumber
	 * @return string
	 */
	public function setEanNumber($_eanNumber)
	{
		return ($this->eanNumber = $_eanNumber);
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