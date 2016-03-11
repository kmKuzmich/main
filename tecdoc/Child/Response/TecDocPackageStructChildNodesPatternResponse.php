<?php
/**
 * File for class TecDocPackageStructChildNodesPatternResponse
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageStructChildNodesPatternResponse originally named ChildNodesPatternResponse
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
class TecDocPackageStructChildNodesPatternResponse extends TecDocPackageWsdlClass
{
	/**
	 * The data
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var TecDocPackageStructChildNodesPatternRecordSeq
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
	 * Constructor method for ChildNodesPatternResponse
	 * @see parent::__construct()
	 * @param TecDocPackageStructChildNodesPatternRecordSeq $_data
	 * @param int $_status
	 * @param string $_statusText
	 * @return TecDocPackageStructChildNodesPatternResponse
	 */
	public function __construct($_data = NULL,$_status = NULL,$_statusText = NULL)
	{
		parent::__construct(array('data'=>$_data,'status'=>$_status,'statusText'=>$_statusText));
	}
	/**
	 * Get data value
	 * @return TecDocPackageStructChildNodesPatternRecordSeq
	 */
	public function getData()
	{
		return $this->data;
	}
	/**
	 * Set data value
	 * @param TecDocPackageStructChildNodesPatternRecordSeq the data
	 * @return TecDocPackageStructChildNodesPatternRecordSeq
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