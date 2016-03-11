<?php
/**
 * File for class TecDocPackageStructArticleOENumbersRecord
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageStructArticleOENumbersRecord originally named ArticleOENumbersRecord
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
class TecDocPackageStructArticleOENumbersRecord extends TecDocPackageWsdlClass
{
	/**
	 * The blockNumber
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var int
	 */
	public $blockNumber;
	/**
	 * The brandName
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $brandName;
	/**
	 * The oeNumber
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $oeNumber;
	/**
	 * The sortNumber
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var int
	 */
	public $sortNumber;
	/**
	 * Constructor method for ArticleOENumbersRecord
	 * @see parent::__construct()
	 * @param int $_blockNumber
	 * @param string $_brandName
	 * @param string $_oeNumber
	 * @param int $_sortNumber
	 * @return TecDocPackageStructArticleOENumbersRecord
	 */
	public function __construct($_blockNumber = NULL,$_brandName = NULL,$_oeNumber = NULL,$_sortNumber = NULL)
	{
		parent::__construct(array('blockNumber'=>$_blockNumber,'brandName'=>$_brandName,'oeNumber'=>$_oeNumber,'sortNumber'=>$_sortNumber));
	}
	/**
	 * Get blockNumber value
	 * @return int
	 */
	public function getBlockNumber()
	{
		return $this->blockNumber;
	}
	/**
	 * Set blockNumber value
	 * @param int the blockNumber
	 * @return int
	 */
	public function setBlockNumber($_blockNumber)
	{
		return ($this->blockNumber = $_blockNumber);
	}
	/**
	 * Get brandName value
	 * @return string
	 */
	public function getBrandName()
	{
		return $this->brandName;
	}
	/**
	 * Set brandName value
	 * @param string the brandName
	 * @return string
	 */
	public function setBrandName($_brandName)
	{
		return ($this->brandName = $_brandName);
	}
	/**
	 * Get oeNumber value
	 * @return string
	 */
	public function getOeNumber()
	{
		return $this->oeNumber;
	}
	/**
	 * Set oeNumber value
	 * @param string the oeNumber
	 * @return string
	 */
	public function setOeNumber($_oeNumber)
	{
		return ($this->oeNumber = $_oeNumber);
	}
	/**
	 * Get sortNumber value
	 * @return int
	 */
	public function getSortNumber()
	{
		return $this->sortNumber;
	}
	/**
	 * Set sortNumber value
	 * @param int the sortNumber
	 * @return int
	 */
	public function setSortNumber($_sortNumber)
	{
		return ($this->sortNumber = $_sortNumber);
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