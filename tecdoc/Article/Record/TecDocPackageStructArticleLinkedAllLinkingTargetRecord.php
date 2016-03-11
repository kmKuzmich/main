<?php
/**
 * File for class TecDocPackageStructArticleLinkedAllLinkingTargetRecord
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageStructArticleLinkedAllLinkingTargetRecord originally named ArticleLinkedAllLinkingTargetRecord
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
class TecDocPackageStructArticleLinkedAllLinkingTargetRecord extends TecDocPackageWsdlClass
{
	/**
	 * The articleLinkId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $articleLinkId;
	/**
	 * The linkingTargetId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $linkingTargetId;
	/**
	 * The linkingTargetType
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $linkingTargetType;
	/**
	 * Constructor method for ArticleLinkedAllLinkingTargetRecord
	 * @see parent::__construct()
	 * @param long $_articleLinkId
	 * @param long $_linkingTargetId
	 * @param string $_linkingTargetType
	 * @return TecDocPackageStructArticleLinkedAllLinkingTargetRecord
	 */
	public function __construct($_articleLinkId = NULL,$_linkingTargetId = NULL,$_linkingTargetType = NULL)
	{
		parent::__construct(array('articleLinkId'=>$_articleLinkId,'linkingTargetId'=>$_linkingTargetId,'linkingTargetType'=>$_linkingTargetType));
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
	 * Get linkingTargetId value
	 * @return long
	 */
	public function getLinkingTargetId()
	{
		return $this->linkingTargetId;
	}
	/**
	 * Set linkingTargetId value
	 * @param long the linkingTargetId
	 * @return long
	 */
	public function setLinkingTargetId($_linkingTargetId)
	{
		return ($this->linkingTargetId = $_linkingTargetId);
	}
	/**
	 * Get linkingTargetType value
	 * @return string
	 */
	public function getLinkingTargetType()
	{
		return $this->linkingTargetType;
	}
	/**
	 * Set linkingTargetType value
	 * @param string the linkingTargetType
	 * @return string
	 */
	public function setLinkingTargetType($_linkingTargetType)
	{
		return ($this->linkingTargetType = $_linkingTargetType);
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