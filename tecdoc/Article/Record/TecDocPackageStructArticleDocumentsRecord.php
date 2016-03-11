<?php
/**
 * File for class TecDocPackageStructArticleDocumentsRecord
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageStructArticleDocumentsRecord originally named ArticleDocumentsRecord
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
class TecDocPackageStructArticleDocumentsRecord extends TecDocPackageWsdlClass
{
	/**
	 * The docFileName
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $docFileName;
	/**
	 * The docFileTypeName
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $docFileTypeName;
	/**
	 * The docId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $docId;
	/**
	 * The docLinkId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $docLinkId;
	/**
	 * The docText
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $docText;
	/**
	 * The docTypeId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $docTypeId;
	/**
	 * The docTypeName
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $docTypeName;
	/**
	 * Constructor method for ArticleDocumentsRecord
	 * @see parent::__construct()
	 * @param string $_docFileName
	 * @param string $_docFileTypeName
	 * @param string $_docId
	 * @param long $_docLinkId
	 * @param string $_docText
	 * @param long $_docTypeId
	 * @param string $_docTypeName
	 * @return TecDocPackageStructArticleDocumentsRecord
	 */
	public function __construct($_docFileName = NULL,$_docFileTypeName = NULL,$_docId = NULL,$_docLinkId = NULL,$_docText = NULL,$_docTypeId = NULL,$_docTypeName = NULL)
	{
		parent::__construct(array('docFileName'=>$_docFileName,'docFileTypeName'=>$_docFileTypeName,'docId'=>$_docId,'docLinkId'=>$_docLinkId,'docText'=>$_docText,'docTypeId'=>$_docTypeId,'docTypeName'=>$_docTypeName));
	}
	/**
	 * Get docFileName value
	 * @return string
	 */
	public function getDocFileName()
	{
		return $this->docFileName;
	}
	/**
	 * Set docFileName value
	 * @param string the docFileName
	 * @return string
	 */
	public function setDocFileName($_docFileName)
	{
		return ($this->docFileName = $_docFileName);
	}
	/**
	 * Get docFileTypeName value
	 * @return string
	 */
	public function getDocFileTypeName()
	{
		return $this->docFileTypeName;
	}
	/**
	 * Set docFileTypeName value
	 * @param string the docFileTypeName
	 * @return string
	 */
	public function setDocFileTypeName($_docFileTypeName)
	{
		return ($this->docFileTypeName = $_docFileTypeName);
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
	 * Get docLinkId value
	 * @return long
	 */
	public function getDocLinkId()
	{
		return $this->docLinkId;
	}
	/**
	 * Set docLinkId value
	 * @param long the docLinkId
	 * @return long
	 */
	public function setDocLinkId($_docLinkId)
	{
		return ($this->docLinkId = $_docLinkId);
	}
	/**
	 * Get docText value
	 * @return string
	 */
	public function getDocText()
	{
		return $this->docText;
	}
	/**
	 * Set docText value
	 * @param string the docText
	 * @return string
	 */
	public function setDocText($_docText)
	{
		return ($this->docText = $_docText);
	}
	/**
	 * Get docTypeId value
	 * @return long
	 */
	public function getDocTypeId()
	{
		return $this->docTypeId;
	}
	/**
	 * Set docTypeId value
	 * @param long the docTypeId
	 * @return long
	 */
	public function setDocTypeId($_docTypeId)
	{
		return ($this->docTypeId = $_docTypeId);
	}
	/**
	 * Get docTypeName value
	 * @return string
	 */
	public function getDocTypeName()
	{
		return $this->docTypeName;
	}
	/**
	 * Set docTypeName value
	 * @param string the docTypeName
	 * @return string
	 */
	public function setDocTypeName($_docTypeName)
	{
		return ($this->docTypeName = $_docTypeName);
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