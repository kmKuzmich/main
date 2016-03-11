<?php
/**
 * File for class TecDocPackageStructArticleIdPair
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageStructArticleIdPair originally named ArticleIdPair
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
class TecDocPackageStructArticleIdPair extends TecDocPackageWsdlClass
{
	/**
	 * The articleId
	 * @var long
	 */
	public $articleId;
	/**
	 * The articleLinkId
	 * @var long
	 */
	public $articleLinkId;
	/**
	 * Constructor method for ArticleIdPair
	 * @see parent::__construct()
	 * @param long $_articleId
	 * @param long $_articleLinkId
	 * @return TecDocPackageStructArticleIdPair
	 */
	public function __construct($_articleId = NULL,$_articleLinkId = NULL)
	{
		parent::__construct(array('articleId'=>$_articleId,'articleLinkId'=>$_articleLinkId));
	}
	/**
	 * Get articleId value
	 * @return long
	 */
	public function getArticleId()
	{
		return $this->articleId;
	}
	/**
	 * Set articleId value
	 * @param long the articleId
	 * @return long
	 */
	public function setArticleId($_articleId)
	{
		return ($this->articleId = $_articleId);
	}
	/**
	 * Get articleLinkId value
	 * @return long
	 */
	public function getArticleLinkId()
	{
		return $this->articleLinkId;
	}
	/**
	 * Set articleLinkId value
	 * @param long the articleLinkId
	 * @return long
	 */
	public function setArticleLinkId($_articleLinkId)
	{
		return ($this->articleLinkId = $_articleLinkId);
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