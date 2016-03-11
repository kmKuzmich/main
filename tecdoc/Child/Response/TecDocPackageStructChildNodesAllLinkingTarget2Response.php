<?php
/**
 * File for class TecDocPackageStructChildNodesAllLinkingTarget2Response
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageStructChildNodesAllLinkingTarget2Response originally named ChildNodesAllLinkingTarget2Response
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
class TecDocPackageStructChildNodesAllLinkingTarget2Response extends TecDocPackageWsdlClass
{
	/**
	 * The data
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var TecDocPackageStructChildNodesAllLinkingTarget2RecordSeq
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
	 * Constructor method for ChildNodesAllLinkingTarget2Response
	 * @see parent::__construct()
	 * @param TecDocPackageStructChildNodesAllLinkingTarget2RecordSeq $_data
	 * @param int $_status
	 * @param string $_statusText
	 * @return TecDocPackageStructChildNodesAllLinkingTarget2Response
	 */
	public function __construct($_data = NULL,$_status = NULL,$_statusText = NULL)
	{
		parent::__construct(array('data'=>$_data,'status'=>$_status,'statusText'=>$_statusText));
	}
	/**
	 * Get data value
	 * @return TecDocPackageStructChildNodesAllLinkingTarget2RecordSeq
	 */
	public function getData()
	{
		return $this->data;
	}
	/**
	 * Set data value
	 * @param TecDocPackageStructChildNodesAllLinkingTarget2RecordSeq the data
	 * @return TecDocPackageStructChildNodesAllLinkingTarget2RecordSeq
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