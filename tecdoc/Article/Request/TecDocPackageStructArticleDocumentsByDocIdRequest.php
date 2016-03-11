<?php
/**
 * File for class TecDocPackageStructArticleDocumentsByDocIdRequest
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageStructArticleDocumentsByDocIdRequest originally named ArticleDocumentsByDocIdRequest
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
class TecDocPackageStructArticleDocumentsByDocIdRequest extends TecDocPackageWsdlClass
{
	/**
	 * The docId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $docId;
	/**
	 * The provider
	 * @var int
	 */
	public $provider;
	/**
	 * The thumbFlag
	 * @var boolean
	 */
	public $thumbFlag;
	/**
	 * Constructor method for ArticleDocumentsByDocIdRequest
	 * @see parent::__construct()
	 * @param string $_docId
	 * @param int $_provider
	 * @param boolean $_thumbFlag
	 * @return TecDocPackageStructArticleDocumentsByDocIdRequest
	 */
	public function __construct($_docId = NULL,$_provider = NULL,$_thumbFlag = NULL)
	{
		parent::__construct(array('docId'=>$_docId,'provider'=>$_provider,'thumbFlag'=>$_thumbFlag));
	}
	/**
	 * Get docId value
	 * @return string
	 */
	public function getDocId()
	{
		return $this->docId;
	}
	/**
	 * Set docId value
	 * @param string the docId
	 * @return string
	 */
	public function setDocId($_docId)
	{
		return ($this->docId = $_docId);
	}
	/**
	 * Get provider value
	 * @return int
	 */
	public function getProvider()
	{
		return $this->provider;
	}
	/**
	 * Set provider value
	 * @param int the provider
	 * @return int
	 */
	public function setProvider($_provider)
	{
		return ($this->provider = $_provider);
	}
	/**
	 * Get thumbFlag value
	 * @return boolean
	 */
	public function getThumbFlag()
	{
		return $this->thumbFlag;
	}
	/**
	 * Set thumbFlag value
	 * @param boolean the thumbFlag
	 * @return boolean
	 */
	public function setThumbFlag($_thumbFlag)
	{
		return ($this->thumbFlag = $_thumbFlag);
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