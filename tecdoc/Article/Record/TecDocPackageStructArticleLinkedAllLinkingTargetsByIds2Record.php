<?php
/**
 * File for class TecDocPackageStructArticleLinkedAllLinkingTargetsByIds2Record
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageStructArticleLinkedAllLinkingTargetsByIds2Record originally named ArticleLinkedAllLinkingTargetsByIds2Record
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
class TecDocPackageStructArticleLinkedAllLinkingTargetsByIds2Record extends TecDocPackageWsdlClass
{
	/**
	 * The articleLinkId
	 * @var long
	 */
	public $articleLinkId;
	/**
	 * The linkedArticleImmediateAttributs
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var TecDocPackageStructImmediateAttributsLinkedElementsRecordSeq
	 */
	public $linkedArticleImmediateAttributs;
	/**
	 * The linkedAxles
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var TecDocPackageStructAxleByIdRecordSeq
	 */
	public $linkedAxles;
	/**
	 * The linkedMarks
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var TecDocPackageStructMarkByIdRecordSeq
	 */
	public $linkedMarks;
	/**
	 * The linkedMotors
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var TecDocPackageStructArticleLinkedMotorsByIdRecordSeq
	 */
	public $linkedMotors;
	/**
	 * The linkedVehicles
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var TecDocPackageStructArticleLinkedVehiclesByIdRecordSeq
	 */
	public $linkedVehicles;
	/**
	 * The linkingTargetId
	 * @var long
	 */
	public $linkingTargetId;
	/**
	 * Constructor method for ArticleLinkedAllLinkingTargetsByIds2Record
	 * @see parent::__construct()
	 * @param long $_articleLinkId
	 * @param TecDocPackageStructImmediateAttributsLinkedElementsRecordSeq $_linkedArticleImmediateAttributs
	 * @param TecDocPackageStructAxleByIdRecordSeq $_linkedAxles
	 * @param TecDocPackageStructMarkByIdRecordSeq $_linkedMarks
	 * @param TecDocPackageStructArticleLinkedMotorsByIdRecordSeq $_linkedMotors
	 * @param TecDocPackageStructArticleLinkedVehiclesByIdRecordSeq $_linkedVehicles
	 * @param long $_linkingTargetId
	 * @return TecDocPackageStructArticleLinkedAllLinkingTargetsByIds2Record
	 */
	public function __construct($_articleLinkId = NULL,$_linkedArticleImmediateAttributs = NULL,$_linkedAxles = NULL,$_linkedMarks = NULL,$_linkedMotors = NULL,$_linkedVehicles = NULL,$_linkingTargetId = NULL)
	{
		parent::__construct(array('articleLinkId'=>$_articleLinkId,'linkedArticleImmediateAttributs'=>$_linkedArticleImmediateAttributs,'linkedAxles'=>$_linkedAxles,'linkedMarks'=>$_linkedMarks,'linkedMotors'=>$_linkedMotors,'linkedVehicles'=>$_linkedVehicles,'linkingTargetId'=>$_linkingTargetId));
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
	 * Get linkedArticleImmediateAttributs value
	 * @return TecDocPackageStructImmediateAttributsLinkedElementsRecordSeq
	 */
	public function getLinkedArticleImmediateAttributs()
	{
		return $this->linkedArticleImmediateAttributs;
	}
	/**
	 * Set linkedArticleImmediateAttributs value
	 * @param TecDocPackageStructImmediateAttributsLinkedElementsRecordSeq the linkedArticleImmediateAttributs
	 * @return TecDocPackageStructImmediateAttributsLinkedElementsRecordSeq
	 */
	public function setLinkedArticleImmediateAttributs($_linkedArticleImmediateAttributs)
	{
		return ($this->linkedArticleImmediateAttributs = $_linkedArticleImmediateAttributs);
	}
	/**
	 * Get linkedAxles value
	 * @return TecDocPackageStructAxleByIdRecordSeq
	 */
	public function getLinkedAxles()
	{
		return $this->linkedAxles;
	}
	/**
	 * Set linkedAxles value
	 * @param TecDocPackageStructAxleByIdRecordSeq the linkedAxles
	 * @return TecDocPackageStructAxleByIdRecordSeq
	 */
	public function setLinkedAxles($_linkedAxles)
	{
		return ($this->linkedAxles = $_linkedAxles);
	}
	/**
	 * Get linkedMarks value
	 * @return TecDocPackageStructMarkByIdRecordSeq
	 */
	public function getLinkedMarks()
	{
		return $this->linkedMarks;
	}
	/**
	 * Set linkedMarks value
	 * @param TecDocPackageStructMarkByIdRecordSeq the linkedMarks
	 * @return TecDocPackageStructMarkByIdRecordSeq
	 */
	public function setLinkedMarks($_linkedMarks)
	{
		return ($this->linkedMarks = $_linkedMarks);
	}
	/**
	 * Get linkedMotors value
	 * @return TecDocPackageStructArticleLinkedMotorsByIdRecordSeq
	 */
	public function getLinkedMotors()
	{
		return $this->linkedMotors;
	}
	/**
	 * Set linkedMotors value
	 * @param TecDocPackageStructArticleLinkedMotorsByIdRecordSeq the linkedMotors
	 * @return TecDocPackageStructArticleLinkedMotorsByIdRecordSeq
	 */
	public function setLinkedMotors($_linkedMotors)
	{
		return ($this->linkedMotors = $_linkedMotors);
	}
	/**
	 * Get linkedVehicles value
	 * @return TecDocPackageStructArticleLinkedVehiclesByIdRecordSeq
	 */
	public function getLinkedVehicles()
	{
		return $this->linkedVehicles;
	}
	/**
	 * Set linkedVehicles value
	 * @param TecDocPackageStructArticleLinkedVehiclesByIdRecordSeq the linkedVehicles
	 * @return TecDocPackageStructArticleLinkedVehiclesByIdRecordSeq
	 */
	public function setLinkedVehicles($_linkedVehicles)
	{
		return ($this->linkedVehicles = $_linkedVehicles);
	}
	/**
	 * Get linkingTargetId value
	 * @return long
	 */
	public function getLinkingTargetId()
	{
		return $this->linkingTargetId;
	}
	/**
	 * Set linkingTargetId value
	 * @param long the linkingTargetId
	 * @return long
	 */
	public function setLinkingTargetId($_linkingTargetId)
	{
		return ($this->linkingTargetId = $_linkingTargetId);
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