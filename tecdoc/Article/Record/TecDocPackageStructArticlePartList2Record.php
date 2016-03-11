<?php
/**
 * File for class TecDocPackageStructArticlePartList2Record
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageStructArticlePartList2Record originally named ArticlePartList2Record
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
class TecDocPackageStructArticlePartList2Record extends TecDocPackageWsdlClass
{
	/**
	 * The articleAddName
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $articleAddName;
	/**
	 * The articleName
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $articleName;
	/**
	 * The articleNo
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $articleNo;
	/**
	 * The articleState
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $articleState;
	/**
	 * The articleStateName
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $articleStateName;
	/**
	 * The brandName
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $brandName;
	/**
	 * The brandNo
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $brandNo;
	/**
	 * The genericArticleId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $genericArticleId;
	/**
	 * The genericArticleName
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $genericArticleName;
	/**
	 * The hasAxleLink
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var boolean
	 */
	public $hasAxleLink;
	/**
	 * The hasDocuments
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var boolean
	 */
	public $hasDocuments;
	/**
	 * The hasMarkLink
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var boolean
	 */
	public $hasMarkLink;
	/**
	 * The hasMotorLink
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var boolean
	 */
	public $hasMotorLink;
	/**
	 * The hasOEN
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var boolean
	 */
	public $hasOEN;
	/**
	 * The hasPartList
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var boolean
	 */
	public $hasPartList;
	/**
	 * The hasPrices
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var boolean
	 */
	public $hasPrices;
	/**
	 * The hasSecurityInfo
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var boolean
	 */
	public $hasSecurityInfo;
	/**
	 * The hasVehicleLink
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var boolean
	 */
	public $hasVehicleLink;
	/**
	 * The packingUnit
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var int
	 */
	public $packingUnit;
	/**
	 * The partArticleId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $partArticleId;
	/**
	 * The partId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $partId;
	/**
	 * The quantity
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var int
	 */
	public $quantity;
	/**
	 * The quantityPerPackingUnit
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var int
	 */
	public $quantityPerPackingUnit;
	/**
	 * Constructor method for ArticlePartList2Record
	 * @see parent::__construct()
	 * @param string $_articleAddName
	 * @param string $_articleName
	 * @param string $_articleNo
	 * @param long $_articleState
	 * @param string $_articleStateName
	 * @param string $_brandName
	 * @param long $_brandNo
	 * @param long $_genericArticleId
	 * @param string $_genericArticleName
	 * @param boolean $_hasAxleLink
	 * @param boolean $_hasDocuments
	 * @param boolean $_hasMarkLink
	 * @param boolean $_hasMotorLink
	 * @param boolean $_hasOEN
	 * @param boolean $_hasPartList
	 * @param boolean $_hasPrices
	 * @param boolean $_hasSecurityInfo
	 * @param boolean $_hasVehicleLink
	 * @param int $_packingUnit
	 * @param long $_partArticleId
	 * @param long $_partId
	 * @param int $_quantity
	 * @param int $_quantityPerPackingUnit
	 * @return TecDocPackageStructArticlePartList2Record
	 */
	public function __construct($_articleAddName = NULL,$_articleName = NULL,$_articleNo = NULL,$_articleState = NULL,$_articleStateName = NULL,$_brandName = NULL,$_brandNo = NULL,$_genericArticleId = NULL,$_genericArticleName = NULL,$_hasAxleLink = NULL,$_hasDocuments = NULL,$_hasMarkLink = NULL,$_hasMotorLink = NULL,$_hasOEN = NULL,$_hasPartList = NULL,$_hasPrices = NULL,$_hasSecurityInfo = NULL,$_hasVehicleLink = NULL,$_packingUnit = NULL,$_partArticleId = NULL,$_partId = NULL,$_quantity = NULL,$_quantityPerPackingUnit = NULL)
	{
		parent::__construct(array('articleAddName'=>$_articleAddName,'articleName'=>$_articleName,'articleNo'=>$_articleNo,'articleState'=>$_articleState,'articleStateName'=>$_articleStateName,'brandName'=>$_brandName,'brandNo'=>$_brandNo,'genericArticleId'=>$_genericArticleId,'genericArticleName'=>$_genericArticleName,'hasAxleLink'=>$_hasAxleLink,'hasDocuments'=>$_hasDocuments,'hasMarkLink'=>$_hasMarkLink,'hasMotorLink'=>$_hasMotorLink,'hasOEN'=>$_hasOEN,'hasPartList'=>$_hasPartList,'hasPrices'=>$_hasPrices,'hasSecurityInfo'=>$_hasSecurityInfo,'hasVehicleLink'=>$_hasVehicleLink,'packingUnit'=>$_packingUnit,'partArticleId'=>$_partArticleId,'partId'=>$_partId,'quantity'=>$_quantity,'quantityPerPackingUnit'=>$_quantityPerPackingUnit));
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
	 * Get articleNo value
	 * @return string
	 */
	public function getArticleNo()
	{
		return $this->articleNo;
	}
	/**
	 * Set articleNo value
	 * @param string the articleNo
	 * @return string
	 */
	public function setArticleNo($_articleNo)
	{
		return ($this->articleNo = $_articleNo);
	}
	/**
	 * Get articleState value
	 * @return long
	 */
	public function getArticleState()
	{
		return $this->articleState;
	}
	/**
	 * Set articleState value
	 * @param long the articleState
	 * @return long
	 */
	public function setArticleState($_articleState)
	{
		return ($this->articleState = $_articleState);
	}
	/**
	 * Get articleStateName value
	 * @return string
	 */
	public function getArticleStateName()
	{
		return $this->articleStateName;
	}
	/**
	 * Set articleStateName value
	 * @param string the articleStateName
	 * @return string
	 */
	public function setArticleStateName($_articleStateName)
	{
		return ($this->articleStateName = $_articleStateName);
	}
	/**
	 * Get brandName value
	 * @return string
	 */
	public function getBrandName()
	{
		return $this->brandName;
	}
	/**
	 * Set brandName value
	 * @param string the brandName
	 * @return string
	 */
	public function setBrandName($_brandName)
	{
		return ($this->brandName = $_brandName);
	}
	/**
	 * Get brandNo value
	 * @return long
	 */
	public function getBrandNo()
	{
		return $this->brandNo;
	}
	/**
	 * Set brandNo value
	 * @param long the brandNo
	 * @return long
	 */
	public function setBrandNo($_brandNo)
	{
		return ($this->brandNo = $_brandNo);
	}
	/**
	 * Get genericArticleId value
	 * @return long
	 */
	public function getGenericArticleId()
	{
		return $this->genericArticleId;
	}
	/**
	 * Set genericArticleId value
	 * @param long the genericArticleId
	 * @return long
	 */
	public function setGenericArticleId($_genericArticleId)
	{
		return ($this->genericArticleId = $_genericArticleId);
	}
	/**
	 * Get genericArticleName value
	 * @return string
	 */
	public function getGenericArticleName()
	{
		return $this->genericArticleName;
	}
	/**
	 * Set genericArticleName value
	 * @param string the genericArticleName
	 * @return string
	 */
	public function setGenericArticleName($_genericArticleName)
	{
		return ($this->genericArticleName = $_genericArticleName);
	}
	/**
	 * Get hasAxleLink value
	 * @return boolean
	 */
	public function getHasAxleLink()
	{
		return $this->hasAxleLink;
	}
	/**
	 * Set hasAxleLink value
	 * @param boolean the hasAxleLink
	 * @return boolean
	 */
	public function setHasAxleLink($_hasAxleLink)
	{
		return ($this->hasAxleLink = $_hasAxleLink);
	}
	/**
	 * Get hasDocuments value
	 * @return boolean
	 */
	public function getHasDocuments()
	{
		return $this->hasDocuments;
	}
	/**
	 * Set hasDocuments value
	 * @param boolean the hasDocuments
	 * @return boolean
	 */
	public function setHasDocuments($_hasDocuments)
	{
		return ($this->hasDocuments = $_hasDocuments);
	}
	/**
	 * Get hasMarkLink value
	 * @return boolean
	 */
	public function getHasMarkLink()
	{
		return $this->hasMarkLink;
	}
	/**
	 * Set hasMarkLink value
	 * @param boolean the hasMarkLink
	 * @return boolean
	 */
	public function setHasMarkLink($_hasMarkLink)
	{
		return ($this->hasMarkLink = $_hasMarkLink);
	}
	/**
	 * Get hasMotorLink value
	 * @return boolean
	 */
	public function getHasMotorLink()
	{
		return $this->hasMotorLink;
	}
	/**
	 * Set hasMotorLink value
	 * @param boolean the hasMotorLink
	 * @return boolean
	 */
	public function setHasMotorLink($_hasMotorLink)
	{
		return ($this->hasMotorLink = $_hasMotorLink);
	}
	/**
	 * Get hasOEN value
	 * @return boolean
	 */
	public function getHasOEN()
	{
		return $this->hasOEN;
	}
	/**
	 * Set hasOEN value
	 * @param boolean the hasOEN
	 * @return boolean
	 */
	public function setHasOEN($_hasOEN)
	{
		return ($this->hasOEN = $_hasOEN);
	}
	/**
	 * Get hasPartList value
	 * @return boolean
	 */
	public function getHasPartList()
	{
		return $this->hasPartList;
	}
	/**
	 * Set hasPartList value
	 * @param boolean the hasPartList
	 * @return boolean
	 */
	public function setHasPartList($_hasPartList)
	{
		return ($this->hasPartList = $_hasPartList);
	}
	/**
	 * Get hasPrices value
	 * @return boolean
	 */
	public function getHasPrices()
	{
		return $this->hasPrices;
	}
	/**
	 * Set hasPrices value
	 * @param boolean the hasPrices
	 * @return boolean
	 */
	public function setHasPrices($_hasPrices)
	{
		return ($this->hasPrices = $_hasPrices);
	}
	/**
	 * Get hasSecurityInfo value
	 * @return boolean
	 */
	public function getHasSecurityInfo()
	{
		return $this->hasSecurityInfo;
	}
	/**
	 * Set hasSecurityInfo value
	 * @param boolean the hasSecurityInfo
	 * @return boolean
	 */
	public function setHasSecurityInfo($_hasSecurityInfo)
	{
		return ($this->hasSecurityInfo = $_hasSecurityInfo);
	}
	/**
	 * Get hasVehicleLink value
	 * @return boolean
	 */
	public function getHasVehicleLink()
	{
		return $this->hasVehicleLink;
	}
	/**
	 * Set hasVehicleLink value
	 * @param boolean the hasVehicleLink
	 * @return boolean
	 */
	public function setHasVehicleLink($_hasVehicleLink)
	{
		return ($this->hasVehicleLink = $_hasVehicleLink);
	}
	/**
	 * Get packingUnit value
	 * @return int
	 */
	public function getPackingUnit()
	{
		return $this->packingUnit;
	}
	/**
	 * Set packingUnit value
	 * @param int the packingUnit
	 * @return int
	 */
	public function setPackingUnit($_packingUnit)
	{
		return ($this->packingUnit = $_packingUnit);
	}
	/**
	 * Get partArticleId value
	 * @return long
	 */
	public function getPartArticleId()
	{
		return $this->partArticleId;
	}
	/**
	 * Set partArticleId value
	 * @param long the partArticleId
	 * @return long
	 */
	public function setPartArticleId($_partArticleId)
	{
		return ($this->partArticleId = $_partArticleId);
	}
	/**
	 * Get partId value
	 * @return long
	 */
	public function getPartId()
	{
		return $this->partId;
	}
	/**
	 * Set partId value
	 * @param long the partId
	 * @return long
	 */
	public function setPartId($_partId)
	{
		return ($this->partId = $_partId);
	}
	/**
	 * Get quantity value
	 * @return int
	 */
	public function getQuantity()
	{
		return $this->quantity;
	}
	/**
	 * Set quantity value
	 * @param int the quantity
	 * @return int
	 */
	public function setQuantity($_quantity)
	{
		return ($this->quantity = $_quantity);
	}
	/**
	 * Get quantityPerPackingUnit value
	 * @return int
	 */
	public function getQuantityPerPackingUnit()
	{
		return $this->quantityPerPackingUnit;
	}
	/**
	 * Set quantityPerPackingUnit value
	 * @param int the quantityPerPackingUnit
	 * @return int
	 */
	public function setQuantityPerPackingUnit($_quantityPerPackingUnit)
	{
		return ($this->quantityPerPackingUnit = $_quantityPerPackingUnit);
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