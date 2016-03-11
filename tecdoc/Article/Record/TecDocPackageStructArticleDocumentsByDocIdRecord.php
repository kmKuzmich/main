<?php
/**
 * File for class TecDocPackageStructArticleDocumentsByDocIdRecord
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageStructArticleDocumentsByDocIdRecord originally named ArticleDocumentsByDocIdRecord
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
class TecDocPackageStructArticleDocumentsByDocIdRecord extends TecDocPackageWsdlClass
{
	/**
	 * The docData
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var base64Binary
	 */
	public $docData;
	/**
	 * The docFileType
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $docFileType;
	/**
	 * The docId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $docId;
	/**
	 * Constructor method for ArticleDocumentsByDocIdRecord
	 * @see parent::__construct()
	 * @param base64Binary $_docData
	 * @param string $_docFileType
	 * @param string $_docId
	 * @return TecDocPackageStructArticleDocumentsByDocIdRecord
	 */
	public function __construct($_docData = NULL,$_docFileType = NULL,$_docId = NULL)
	{
		parent::__construct(array('docData'=>$_docData,'docFileType'=>$_docFileType,'docId'=>$_docId));
	}
	/**
	 * Get docData value
	 * @return base64Binary
	 */
	public function getDocData()
	{
		return $this->docData;
	}
	/**
	 * Set docData value
	 * @param base64Binary the docData
	 * @return base64Binary
	 */
	public function setDocData($_docData)
	{
		return ($this->docData = $_docData);
	}
	/**
	 * Get docFileType value
	 * @return string
	 */
	public function getDocFileType()
	{
		return $this->docFileType;
	}
	/**
	 * Set docFileType value
	 * @param string the docFileType
	 * @return string
	 */
	public function setDocFileType($_docFileType)
	{
		return ($this->docFileType = $_docFileType);
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
	 * Method returning the class name
	 * @return string __CLASS__
	 */
	public function __toString()
	{
		return __CLASS__;
	}
}
?>