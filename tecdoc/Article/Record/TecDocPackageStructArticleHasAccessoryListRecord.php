<?php
/**
 * File for class TecDocPackageStructArticleHasAccessoryListRecord
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageStructArticleHasAccessoryListRecord originally named ArticleHasAccessoryListRecord
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
class TecDocPackageStructArticleHasAccessoryListRecord extends TecDocPackageWsdlClass
{
	/**
	 * The articleAccessoryId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $articleAccessoryId;
	/**
	 * Constructor method for ArticleHasAccessoryListRecord
	 * @see parent::__construct()
	 * @param long $_articleAccessoryId
	 * @return TecDocPackageStructArticleHasAccessoryListRecord
	 */
	public function __construct($_articleAccessoryId = NULL)
	{
		parent::__construct(array('articleAccessoryId'=>$_articleAccessoryId));
	}
	/**
	 * Get articleAccessoryId value
	 * @return long
	 */
	public function getArticleAccessoryId()
	{
		return $this->articleAccessoryId;
	}
	/**
	 * Set articleAccessoryId value
	 * @param long the articleAccessoryId
	 * @return long
	 */
	public function setArticleAccessoryId($_articleAccessoryId)
	{
		return ($this->articleAccessoryId = $_articleAccessoryId);
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