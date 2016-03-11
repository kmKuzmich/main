<?php
/**
 * File for class TecDocPackageStructArticlePricesNormalAustauschRecord
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageStructArticlePricesNormalAustauschRecord originally named ArticlePricesNormalAustauschRecord
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
class TecDocPackageStructArticlePricesNormalAustauschRecord extends TecDocPackageWsdlClass
{
	/**
	 * The currency
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $currency;
	/**
	 * The hasLessDiscount
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var boolean
	 */
	public $hasLessDiscount;
	/**
	 * The price
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var int
	 */
	public $price;
	/**
	 * The priceTypeId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $priceTypeId;
	/**
	 * The priceTypeName
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $priceTypeName;
	/**
	 * The priceUnitId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var long
	 */
	public $priceUnitId;
	/**
	 * The priceUnitName
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $priceUnitName;
	/**
	 * The quantityUnitId
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $quantityUnitId;
	/**
	 * The quantityUnitName
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $quantityUnitName;
	/**
	 * The validDateFrom
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var int
	 */
	public $validDateFrom;
	/**
	 * The validDateTo
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var int
	 */
	public $validDateTo;
	/**
	 * Constructor method for ArticlePricesNormalAustauschRecord
	 * @see parent::__construct()
	 * @param string $_currency
	 * @param boolean $_hasLessDiscount
	 * @param int $_price
	 * @param long $_priceTypeId
	 * @param string $_priceTypeName
	 * @param long $_priceUnitId
	 * @param string $_priceUnitName
	 * @param string $_quantityUnitId
	 * @param string $_quantityUnitName
	 * @param int $_validDateFrom
	 * @param int $_validDateTo
	 * @return TecDocPackageStructArticlePricesNormalAustauschRecord
	 */
	public function __construct($_currency = NULL,$_hasLessDiscount = NULL,$_price = NULL,$_priceTypeId = NULL,$_priceTypeName = NULL,$_priceUnitId = NULL,$_priceUnitName = NULL,$_quantityUnitId = NULL,$_quantityUnitName = NULL,$_validDateFrom = NULL,$_validDateTo = NULL)
	{
		parent::__construct(array('currency'=>$_currency,'hasLessDiscount'=>$_hasLessDiscount,'price'=>$_price,'priceTypeId'=>$_priceTypeId,'priceTypeName'=>$_priceTypeName,'priceUnitId'=>$_priceUnitId,'priceUnitName'=>$_priceUnitName,'quantityUnitId'=>$_quantityUnitId,'quantityUnitName'=>$_quantityUnitName,'validDateFrom'=>$_validDateFrom,'validDateTo'=>$_validDateTo));
	}
	/**
	 * Get currency value
	 * @return string
	 */
	public function getCurrency()
	{
		return $this->currency;
	}
	/**
	 * Set currency value
	 * @param string the currency
	 * @return string
	 */
	public function setCurrency($_currency)
	{
		return ($this->currency = $_currency);
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
	 * Get price value
	 * @return int
	 */
	public function getPrice()
	{
		return $this->price;
	}
	/**
	 * Set price value
	 * @param int the price
	 * @return int
	 */
	public function setPrice($_price)
	{
		return ($this->price = $_price);
	}
	/**
	 * Get priceTypeId value
	 * @return long
	 */
	public function getPriceTypeId()
	{
		return $this->priceTypeId;
	}
	/**
	 * Set priceTypeId value
	 * @param long the priceTypeId
	 * @return long
	 */
	public function setPriceTypeId($_priceTypeId)
	{
		return ($this->priceTypeId = $_priceTypeId);
	}
	/**
	 * Get priceTypeName value
	 * @return string
	 */
	public function getPriceTypeName()
	{
		return $this->priceTypeName;
	}
	/**
	 * Set priceTypeName value
	 * @param string the priceTypeName
	 * @return string
	 */
	public function setPriceTypeName($_priceTypeName)
	{
		return ($this->priceTypeName = $_priceTypeName);
	}
	/**
	 * Get priceUnitId value
	 * @return long
	 */
	public function getPriceUnitId()
	{
		return $this->priceUnitId;
	}
	/**
	 * Set priceUnitId value
	 * @param long the priceUnitId
	 * @return long
	 */
	public function setPriceUnitId($_priceUnitId)
	{
		return ($this->priceUnitId = $_priceUnitId);
	}
	/**
	 * Get priceUnitName value
	 * @return string
	 */
	public function getPriceUnitName()
	{
		return $this->priceUnitName;
	}
	/**
	 * Set priceUnitName value
	 * @param string the priceUnitName
	 * @return string
	 */
	public function setPriceUnitName($_priceUnitName)
	{
		return ($this->priceUnitName = $_priceUnitName);
	}
	/**
	 * Get quantityUnitId value
	 * @return string
	 */
	public function getQuantityUnitId()
	{
		return $this->quantityUnitId;
	}
	/**
	 * Set quantityUnitId value
	 * @param string the quantityUnitId
	 * @return string
	 */
	public function setQuantityUnitId($_quantityUnitId)
	{
		return ($this->quantityUnitId = $_quantityUnitId);
	}
	/**
	 * Get quantityUnitName value
	 * @return string
	 */
	public function getQuantityUnitName()
	{
		return $this->quantityUnitName;
	}
	/**
	 * Set quantityUnitName value
	 * @param string the quantityUnitName
	 * @return string
	 */
	public function setQuantityUnitName($_quantityUnitName)
	{
		return ($this->quantityUnitName = $_quantityUnitName);
	}
	/**
	 * Get validDateFrom value
	 * @return int
	 */
	public function getValidDateFrom()
	{
		return $this->validDateFrom;
	}
	/**
	 * Set validDateFrom value
	 * @param int the validDateFrom
	 * @return int
	 */
	public function setValidDateFrom($_validDateFrom)
	{
		return ($this->validDateFrom = $_validDateFrom);
	}
	/**
	 * Get validDateTo value
	 * @return int
	 */
	public function getValidDateTo()
	{
		return $this->validDateTo;
	}
	/**
	 * Set validDateTo value
	 * @param int the validDateTo
	 * @return int
	 */
	public function setValidDateTo($_validDateTo)
	{
		return ($this->validDateTo = $_validDateTo);
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