<?php
/**
 * File for class TecDocPackageStructMainArticlesRecord
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageStructMainArticlesRecord originally named MainArticlesRecord
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
class TecDocPackageStructMainArticlesRecord extends TecDocPackageWsdlClass
{
	/**
	 * The articleAddName
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $articleAddName;
	/**
	 * The articleId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $articleId;
	/**
	 * The articleName
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $articleName;
	/**
	 * The articleNumber
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $articleNumber;
	/**
	 * Constructor method for MainArticlesRecord
	 * @see parent::__construct()
	 * @param string $_articleAddName
	 * @param long $_articleId
	 * @param string $_articleName
	 * @param string $_articleNumber
	 * @return TecDocPackageStructMainArticlesRecord
	 */
	public function __construct($_articleAddName = NULL,$_articleId = NULL,$_articleName = NULL,$_articleNumber = NULL)
	{
		parent::__construct(array('articleAddName'=>$_articleAddName,'articleId'=>$_articleId,'articleName'=>$_articleName,'articleNumber'=>$_articleNumber));
	}
	/**
	 * Get articleAddName value
	 * @return string
	 */
	public function getArticleAddName()
	{
		return $this->articleAddName;
	}
	/**
	 * Set articleAddName value
	 * @param string the articleAddName
	 * @return string
	 */
	public function setArticleAddName($_articleAddName)
	{
		return ($this->articleAddName = $_articleAddName);
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
	 * Get articleName value
	 * @return string
	 */
	public function getArticleName()
	{
		return $this->articleName;
	}
	/**
	 * Set articleName value
	 * @param string the articleName
	 * @return string
	 */
	public function setArticleName($_articleName)
	{
		return ($this->articleName = $_articleName);
	}
	/**
	 * Get articleNumber value
	 * @return string
	 */
	public function getArticleNumber()
	{
		return $this->articleNumber;
	}
	/**
	 * Set articleNumber value
	 * @param string the articleNumber
	 * @return string
	 */
	public function setArticleNumber($_articleNumber)
	{
		return ($this->articleNumber = $_articleNumber);
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