<?php
/**
 * File for class TecDocPackageStructArticleIds3RecordSeq
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageStructArticleIds3RecordSeq originally named ArticleIds3RecordSeq
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
class TecDocPackageStructArticleIds3RecordSeq extends TecDocPackageWsdlClass
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
	 * Constructor method for ArticleIds3RecordSeq
	 * @see parent::__construct()
	 * @param Array $_array
	 * @param boolean $_empty
	 * @return TecDocPackageStructArticleIds3RecordSeq
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