<?php
/**
 * File for class TecDocPackageStructReplacedByNumbersRecord
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageStructReplacedByNumbersRecord originally named ReplacedByNumbersRecord
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
class TecDocPackageStructReplacedByNumbersRecord extends TecDocPackageWsdlClass
{
	/**
	 * The replaceArticleId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $replaceArticleId;
	/**
	 * The replaceNumber
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $replaceNumber;
	/**
	 * Constructor method for ReplacedByNumbersRecord
	 * @see parent::__construct()
	 * @param long $_replaceArticleId
	 * @param string $_replaceNumber
	 * @return TecDocPackageStructReplacedByNumbersRecord
	 */
	public function __construct($_replaceArticleId = NULL,$_replaceNumber = NULL)
	{
		parent::__construct(array('replaceArticleId'=>$_replaceArticleId,'replaceNumber'=>$_replaceNumber));
	}
	/**
	 * Get replaceArticleId value
	 * @return long
	 */
	public function getReplaceArticleId()
	{
		return $this->replaceArticleId;
	}
	/**
	 * Set replaceArticleId value
	 * @param long the replaceArticleId
	 * @return long
	 */
	public function setReplaceArticleId($_replaceArticleId)
	{
		return ($this->replaceArticleId = $_replaceArticleId);
	}
	/**
	 * Get replaceNumber value
	 * @return string
	 */
	public function getReplaceNumber()
	{
		return $this->replaceNumber;
	}
	/**
	 * Set replaceNumber value
	 * @param string the replaceNumber
	 * @return string
	 */
	public function setReplaceNumber($_replaceNumber)
	{
		return ($this->replaceNumber = $_replaceNumber);
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