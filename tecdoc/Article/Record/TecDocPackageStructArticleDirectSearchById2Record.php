<?php
/**
 * File for class TecDocPackageStructArticleDirectSearchById2Record
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageStructArticleDirectSearchById2Record originally named ArticleDirectSearchById2Record
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
class TecDocPackageStructArticleDirectSearchById2Record extends TecDocPackageWsdlClass
{
	/**
	 * The articleAddName
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $articleAddName;
	/**
	 * The articleId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $articleId;
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
	 * The hasAppendage
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var boolean
	 */
	public $hasAppendage;
	/**
	 * The hasAxleLink
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var boolean
	 */
	public $hasAxleLink;
	/**
	 * The hasCsGraphics
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var boolean
	 */
	public $hasCsGraphics;
	/**
	 * The hasDocuments
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var boolean
	 */
	public $hasDocuments;
	/**
	 * The hasLessDiscount
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var boolean
	 */
	public $hasLessDiscount;
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
	 * The hasUsage
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var boolean
	 */
	public $hasUsage;
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
	 * The quantityPerPackingUnit
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var int
	 */
	public $quantityPerPackingUnit;
	/**
	 * Constructor method for ArticleDirectSearchById2Record
	 * @see parent::__construct()
	 * @param string $_articleAddName
	 * @param long $_articleId
	 * @param string $_articleName
	 * @param string $_articleNo
	 * @param long $_articleState
	 * @param string $_articleStateName
	 * @param string $_brandName
	 * @param long $_brandNo
	 * @param long $_genericArticleId
	 * @param boolean $_hasAppendage
	 * @param boolean $_hasAxleLink
	 * @param boolean $_hasCsGraphics
	 * @param boolean $_hasDocuments
	 * @param boolean $_hasLessDiscount
	 * @param boolean $_hasMarkLink
	 * @param boolean $_hasMotorLink
	 * @param boolean $_hasOEN
	 * @param boolean $_hasPartList
	 * @param boolean $_hasPrices
	 * @param boolean $_hasSecurityInfo
	 * @param boolean $_hasUsage
	 * @param boolean $_hasVehicleLink
	 * @param int $_packingUnit
	 * @param int $_quantityPerPackingUnit
	 * @return TecDocPackageStructArticleDirectSearchById2Record
	 */
	public function __construct($_articleAddName = NULL,$_articleId = NULL,$_articleName = NULL,$_articleNo = NULL,$_articleState = NULL,$_articleStateName = NULL,$_brandName = NULL,$_brandNo = NULL,$_genericArticleId = NULL,$_hasAppendage = NULL,$_hasAxleLink = NULL,$_hasCsGraphics = NULL,$_hasDocuments = NULL,$_hasLessDiscount = NULL,$_hasMarkLink = NULL,$_hasMotorLink = NULL,$_hasOEN = NULL,$_hasPartList = NULL,$_hasPrices = NULL,$_hasSecurityInfo = NULL,$_hasUsage = NULL,$_hasVehicleLink = NULL,$_packingUnit = NULL,$_quantityPerPackingUnit = NULL)
	{
		parent::__construct(array('articleAddName'=>$_articleAddName,'articleId'=>$_articleId,'articleName'=>$_articleName,'articleNo'=>$_articleNo,'articleState'=>$_articleState,'articleStateName'=>$_articleStateName,'brandName'=>$_brandName,'brandNo'=>$_brandNo,'genericArticleId'=>$_genericArticleId,'hasAppendage'=>$_hasAppendage,'hasAxleLink'=>$_hasAxleLink,'hasCsGraphics'=>$_hasCsGraphics,'hasDocuments'=>$_hasDocuments,'hasLessDiscount'=>$_hasLessDiscount,'hasMarkLink'=>$_hasMarkLink,'hasMotorLink'=>$_hasMotorLink,'hasOEN'=>$_hasOEN,'hasPartList'=>$_hasPartList,'hasPrices'=>$_hasPrices,'hasSecurityInfo'=>$_hasSecurityInfo,'hasUsage'=>$_hasUsage,'hasVehicleLink'=>$_hasVehicleLink,'packingUnit'=>$_packingUnit,'quantityPerPackingUnit'=>$_quantityPerPackingUnit));
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
	 * Get articleId value
	 * @return long
	 */
	public function getArticleId()
	{
		return $this->articleId;
	}
	/**
	 * Set articleId value
	 * @param long the articleId
	 * @return long
	 */
	public function setArticleId($_articleId)
	{
		return ($this->articleId = $_articleId);
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
	 * Get hasAppendage value
	 * @return boolean
	 */
	public function getHasAppendage()
	{
		return $this->hasAppendage;
	}
	/**
	 * Set hasAppendage value
	 * @param boolean the hasAppendage
	 * @return boolean
	 */
	public function setHasAppendage($_hasAppendage)
	{
		return ($this->hasAppendage = $_hasAppendage);
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
	 * Get hasCsGraphics value
	 * @return boolean
	 */
	public function getHasCsGraphics()
	{
		return $this->hasCsGraphics;
	}
	/**
	 * Set hasCsGraphics value
	 * @param boolean the hasCsGraphics
	 * @return boolean
	 */
	public function setHasCsGraphics($_hasCsGraphics)
	{
		return ($this->hasCsGraphics = $_hasCsGraphics);
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
	 * Get hasLessDiscount value
	 * @return boolean
	 */
	public function getHasLessDiscount()
	{
		return $this->hasLessDiscount;
	}
	/**
	 * Set hasLessDiscount value
	 * @param boolean the hasLessDiscount
	 * @return boolean
	 */
	public function setHasLessDiscount($_hasLessDiscount)
	{
		return ($this->hasLessDiscount = $_hasLessDiscount);
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
	 * Get hasUsage value
	 * @return boolean
	 */
	public function getHasUsage()
	{
		return $this->hasUsage;
	}
	/**
	 * Set hasUsage value
	 * @param boolean the hasUsage
	 * @return boolean
	 */
	public function setHasUsage($_hasUsage)
	{
		return ($this->hasUsage = $_hasUsage);
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