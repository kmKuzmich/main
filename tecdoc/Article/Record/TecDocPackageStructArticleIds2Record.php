<?php
/**
 * File for class TecDocPackageStructArticleIds2Record
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageStructArticleIds2Record originally named ArticleIds2Record
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
class TecDocPackageStructArticleIds2Record extends TecDocPackageWsdlClass
{
	/**
	 * The articleId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $articleId;
	/**
	 * The articleLinkId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $articleLinkId;
	/**
	 * The articleNo
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $articleNo;
	/**
	 * The brandName
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $brandName;
	/**
	 * The brandNo
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $brandNo;
	/**
	 * The genericArticleId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $genericArticleId;
	/**
	 * The genericArticleName
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $genericArticleName;
	/**
	 * The sortNo
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var int
	 */
	public $sortNo;
	/**
	 * Constructor method for ArticleIds2Record
	 * @see parent::__construct()
	 * @param long $_articleId
	 * @param long $_articleLinkId
	 * @param string $_articleNo
	 * @param string $_brandName
	 * @param long $_brandNo
	 * @param long $_genericArticleId
	 * @param string $_genericArticleName
	 * @param int $_sortNo
	 * @return TecDocPackageStructArticleIds2Record
	 */
	public function __construct($_articleId = NULL,$_articleLinkId = NULL,$_articleNo = NULL,$_brandName = NULL,$_brandNo = NULL,$_genericArticleId = NULL,$_genericArticleName = NULL,$_sortNo = NULL)
	{
		parent::__construct(array('articleId'=>$_articleId,'articleLinkId'=>$_articleLinkId,'articleNo'=>$_articleNo,'brandName'=>$_brandName,'brandNo'=>$_brandNo,'genericArticleId'=>$_genericArticleId,'genericArticleName'=>$_genericArticleName,'sortNo'=>$_sortNo));
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
	 * Get articleNo value
	 * @return string
	 */
	public function getArticleNo()
	{
		return $this->articleNo;
	}
	/**
	 * Set articleNo value
	 * @param string the articleNo
	 * @return string
	 */
	public function setArticleNo($_articleNo)
	{
		return ($this->articleNo = $_articleNo);
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
	 * Get brandNo value
	 * @return long
	 */
	public function getBrandNo()
	{
		return $this->brandNo;
	}
	/**
	 * Set brandNo value
	 * @param long the brandNo
	 * @return long
	 */
	public function setBrandNo($_brandNo)
	{
		return ($this->brandNo = $_brandNo);
	}
	/**
	 * Get genericArticleId value
	 * @return long
	 */
	public function getGenericArticleId()
	{
		return $this->genericArticleId;
	}
	/**
	 * Set genericArticleId value
	 * @param long the genericArticleId
	 * @return long
	 */
	public function setGenericArticleId($_genericArticleId)
	{
		return ($this->genericArticleId = $_genericArticleId);
	}
	/**
	 * Get genericArticleName value
	 * @return string
	 */
	public function getGenericArticleName()
	{
		return $this->genericArticleName;
	}
	/**
	 * Set genericArticleName value
	 * @param string the genericArticleName
	 * @return string
	 */
	public function setGenericArticleName($_genericArticleName)
	{
		return ($this->genericArticleName = $_genericArticleName);
	}
	/**
	 * Get sortNo value
	 * @return int
	 */
	public function getSortNo()
	{
		return $this->sortNo;
	}
	/**
	 * Set sortNo value
	 * @param int the sortNo
	 * @return int
	 */
	public function setSortNo($_sortNo)
	{
		return ($this->sortNo = $_sortNo);
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