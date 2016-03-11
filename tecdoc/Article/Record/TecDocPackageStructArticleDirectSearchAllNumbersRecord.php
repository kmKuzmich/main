<?php
/**
 * File for class TecDocPackageStructArticleDirectSearchAllNumbersRecord
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageStructArticleDirectSearchAllNumbersRecord originally named ArticleDirectSearchAllNumbersRecord
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
class TecDocPackageStructArticleDirectSearchAllNumbersRecord extends TecDocPackageWsdlClass
{
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
	 * The articleSearchNo
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $articleSearchNo;
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
	 * The numberType
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var int
	 */
	public $numberType;
	/**
	 * Constructor method for ArticleDirectSearchAllNumbersRecord
	 * @see parent::__construct()
	 * @param long $_articleId
	 * @param string $_articleName
	 * @param string $_articleNo
	 * @param string $_articleSearchNo
	 * @param string $_brandName
	 * @param long $_brandNo
	 * @param long $_genericArticleId
	 * @param int $_numberType
	 * @return TecDocPackageStructArticleDirectSearchAllNumbersRecord
	 */
	public function __construct($_articleId = NULL,$_articleName = NULL,$_articleNo = NULL,$_articleSearchNo = NULL,$_brandName = NULL,$_brandNo = NULL,$_genericArticleId = NULL,$_numberType = NULL)
	{
		parent::__construct(array('articleId'=>$_articleId,'articleName'=>$_articleName,'articleNo'=>$_articleNo,'articleSearchNo'=>$_articleSearchNo,'brandName'=>$_brandName,'brandNo'=>$_brandNo,'genericArticleId'=>$_genericArticleId,'numberType'=>$_numberType));
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
	 * Get articleSearchNo value
	 * @return string
	 */
	public function getArticleSearchNo()
	{
		return $this->articleSearchNo;
	}
	/**
	 * Set articleSearchNo value
	 * @param string the articleSearchNo
	 * @return string
	 */
	public function setArticleSearchNo($_articleSearchNo)
	{
		return ($this->articleSearchNo = $_articleSearchNo);
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
	 * Get numberType value
	 * @return int
	 */
	public function getNumberType()
	{
		return $this->numberType;
	}
	/**
	 * Set numberType value
	 * @param int the numberType
	 * @return int
	 */
	public function setNumberType($_numberType)
	{
		return ($this->numberType = $_numberType);
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