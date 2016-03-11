<?php
/**
 * File for class TecDocPackageStructArticleLinkedAllLinkingTargetManufacturerRecord
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageStructArticleLinkedAllLinkingTargetManufacturerRecord originally named ArticleLinkedAllLinkingTargetManufacturerRecord
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
class TecDocPackageStructArticleLinkedAllLinkingTargetManufacturerRecord extends TecDocPackageWsdlClass
{
	/**
	 * The manuId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $manuId;
	/**
	 * The manuName
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $manuName;
	/**
	 * Constructor method for ArticleLinkedAllLinkingTargetManufacturerRecord
	 * @see parent::__construct()
	 * @param long $_manuId
	 * @param string $_manuName
	 * @return TecDocPackageStructArticleLinkedAllLinkingTargetManufacturerRecord
	 */
	public function __construct($_manuId = NULL,$_manuName = NULL)
	{
		parent::__construct(array('manuId'=>$_manuId,'manuName'=>$_manuName));
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
	 * Get manuName value
	 * @return string
	 */
	public function getManuName()
	{
		return $this->manuName;
	}
	/**
	 * Set manuName value
	 * @param string the manuName
	 * @return string
	 */
	public function setManuName($_manuName)
	{
		return ($this->manuName = $_manuName);
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