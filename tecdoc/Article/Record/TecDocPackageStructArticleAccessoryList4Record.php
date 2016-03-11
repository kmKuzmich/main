<?php
/**
 * File for class TecDocPackageStructArticleAccessoryList4Record
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageStructArticleAccessoryList4Record originally named ArticleAccessoryList4Record
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
class TecDocPackageStructArticleAccessoryList4Record extends TecDocPackageWsdlClass
{
	/**
	 * The accessoryAttributs
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var TecDocPackageStructArticleAccessoryImmediateAttributsRecordSeq
	 */
	public $accessoryAttributs;
	/**
	 * The accessoryDetails
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var TecDocPackageStructArticleAccessoryList3Record
	 */
	public $accessoryDetails;
	/**
	 * Constructor method for ArticleAccessoryList4Record
	 * @see parent::__construct()
	 * @param TecDocPackageStructArticleAccessoryImmediateAttributsRecordSeq $_accessoryAttributs
	 * @param TecDocPackageStructArticleAccessoryList3Record $_accessoryDetails
	 * @return TecDocPackageStructArticleAccessoryList4Record
	 */
	public function __construct($_accessoryAttributs = NULL,$_accessoryDetails = NULL)
	{
		parent::__construct(array('accessoryAttributs'=>$_accessoryAttributs,'accessoryDetails'=>$_accessoryDetails));
	}
	/**
	 * Get accessoryAttributs value
	 * @return TecDocPackageStructArticleAccessoryImmediateAttributsRecordSeq
	 */
	public function getAccessoryAttributs()
	{
		return $this->accessoryAttributs;
	}
	/**
	 * Set accessoryAttributs value
	 * @param TecDocPackageStructArticleAccessoryImmediateAttributsRecordSeq the accessoryAttributs
	 * @return TecDocPackageStructArticleAccessoryImmediateAttributsRecordSeq
	 */
	public function setAccessoryAttributs($_accessoryAttributs)
	{
		return ($this->accessoryAttributs = $_accessoryAttributs);
	}
	/**
	 * Get accessoryDetails value
	 * @return TecDocPackageStructArticleAccessoryList3Record
	 */
	public function getAccessoryDetails()
	{
		return $this->accessoryDetails;
	}
	/**
	 * Set accessoryDetails value
	 * @param TecDocPackageStructArticleAccessoryList3Record the accessoryDetails
	 * @return TecDocPackageStructArticleAccessoryList3Record
	 */
	public function setAccessoryDetails($_accessoryDetails)
	{
		return ($this->accessoryDetails = $_accessoryDetails);
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