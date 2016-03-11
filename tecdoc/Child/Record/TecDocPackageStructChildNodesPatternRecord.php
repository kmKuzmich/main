<?php
/**
 * File for class TecDocPackageStructChildNodesPatternRecord
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageStructChildNodesPatternRecord originally named ChildNodesPatternRecord
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
class TecDocPackageStructChildNodesPatternRecord extends TecDocPackageWsdlClass
{
	/**
	 * The assemblyGroupName
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $assemblyGroupName;
	/**
	 * The assemblyGroupNodeId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $assemblyGroupNodeId;
	/**
	 * The parentNodeId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $parentNodeId;
	/**
	 * Constructor method for ChildNodesPatternRecord
	 * @see parent::__construct()
	 * @param string $_assemblyGroupName
	 * @param long $_assemblyGroupNodeId
	 * @param long $_parentNodeId
	 * @return TecDocPackageStructChildNodesPatternRecord
	 */
	public function __construct($_assemblyGroupName = NULL,$_assemblyGroupNodeId = NULL,$_parentNodeId = NULL)
	{
		parent::__construct(array('assemblyGroupName'=>$_assemblyGroupName,'assemblyGroupNodeId'=>$_assemblyGroupNodeId,'parentNodeId'=>$_parentNodeId));
	}
	/**
	 * Get assemblyGroupName value
	 * @return string
	 */
	public function getAssemblyGroupName()
	{
		return $this->assemblyGroupName;
	}
	/**
	 * Set assemblyGroupName value
	 * @param string the assemblyGroupName
	 * @return string
	 */
	public function setAssemblyGroupName($_assemblyGroupName)
	{
		return ($this->assemblyGroupName = $_assemblyGroupName);
	}
	/**
	 * Get assemblyGroupNodeId value
	 * @return long
	 */
	public function getAssemblyGroupNodeId()
	{
		return $this->assemblyGroupNodeId;
	}
	/**
	 * Set assemblyGroupNodeId value
	 * @param long the assemblyGroupNodeId
	 * @return long
	 */
	public function setAssemblyGroupNodeId($_assemblyGroupNodeId)
	{
		return ($this->assemblyGroupNodeId = $_assemblyGroupNodeId);
	}
	/**
	 * Get parentNodeId value
	 * @return long
	 */
	public function getParentNodeId()
	{
		return $this->parentNodeId;
	}
	/**
	 * Set parentNodeId value
	 * @param long the parentNodeId
	 * @return long
	 */
	public function setParentNodeId($_parentNodeId)
	{
		return ($this->parentNodeId = $_parentNodeId);
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