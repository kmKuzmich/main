<?php
/**
 * File for class TecDocPackageStructChildNodesAllLinkingTarget2Record
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageStructChildNodesAllLinkingTarget2Record originally named ChildNodesAllLinkingTarget2Record
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
class TecDocPackageStructChildNodesAllLinkingTarget2Record extends TecDocPackageWsdlClass
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
	 * The hasChilds
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var boolean
	 */
	public $hasChilds;
	/**
	 * The parentNodeId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $parentNodeId;
	/**
	 * Constructor method for ChildNodesAllLinkingTarget2Record
	 * @see parent::__construct()
	 * @param string $_assemblyGroupName
	 * @param long $_assemblyGroupNodeId
	 * @param boolean $_hasChilds
	 * @param long $_parentNodeId
	 * @return TecDocPackageStructChildNodesAllLinkingTarget2Record
	 */
	public function __construct($_assemblyGroupName = NULL,$_assemblyGroupNodeId = NULL,$_hasChilds = NULL,$_parentNodeId = NULL)
	{
		parent::__construct(array('assemblyGroupName'=>$_assemblyGroupName,'assemblyGroupNodeId'=>$_assemblyGroupNodeId,'hasChilds'=>$_hasChilds,'parentNodeId'=>$_parentNodeId));
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
	 * Get hasChilds value
	 * @return boolean
	 */
	public function getHasChilds()
	{
		return $this->hasChilds;
	}
	/**
	 * Set hasChilds value
	 * @param boolean the hasChilds
	 * @return boolean
	 */
	public function setHasChilds($_hasChilds)
	{
		return ($this->hasChilds = $_hasChilds);
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