<?php
/**
 * File for class TecDocPackageStructArticleHasAccessoryListResponse
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageStructArticleHasAccessoryListResponse originally named ArticleHasAccessoryListResponse
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
class TecDocPackageStructArticleHasAccessoryListResponse extends TecDocPackageWsdlClass
{
	/**
	 * The data
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var TecDocPackageStructArticleHasAccessoryListRecordSeq
	 */
	public $data;
	/**
	 * The status
	 * @var int
	 */
	public $status;
	/**
	 * The statusText
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $statusText;
	/**
	 * Constructor method for ArticleHasAccessoryListResponse
	 * @see parent::__construct()
	 * @param TecDocPackageStructArticleHasAccessoryListRecordSeq $_data
	 * @param int $_status
	 * @param string $_statusText
	 * @return TecDocPackageStructArticleHasAccessoryListResponse
	 */
	public function __construct($_data = NULL,$_status = NULL,$_statusText = NULL)
	{
		parent::__construct(array('data'=>$_data,'status'=>$_status,'statusText'=>$_statusText));
	}
	/**
	 * Get data value
	 * @return TecDocPackageStructArticleHasAccessoryListRecordSeq
	 */
	public function getData()
	{
		return $this->data;
	}
	/**
	 * Set data value
	 * @param TecDocPackageStructArticleHasAccessoryListRecordSeq the data
	 * @return TecDocPackageStructArticleHasAccessoryListRecordSeq
	 */
	public function setData($_data)
	{
		return ($this->data = $_data);
	}
	/**
	 * Get status value
	 * @return int
	 */
	public function getStatus()
	{
		return $this->status;
	}
	/**
	 * Set status value
	 * @param int the status
	 * @return int
	 */
	public function setStatus($_status)
	{
		return ($this->status = $_status);
	}
	/**
	 * Get statusText value
	 * @return string
	 */
	public function getStatusText()
	{
		return $this->statusText;
	}
	/**
	 * Set statusText value
	 * @param string the statusText
	 * @return string
	 */
	public function setStatusText($_statusText)
	{
		return ($this->statusText = $_statusText);
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