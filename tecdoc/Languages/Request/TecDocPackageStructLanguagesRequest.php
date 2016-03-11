<?php
/**
 * File for class TecDocPackageStructLanguagesRequest
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageStructLanguagesRequest originally named LanguagesRequest
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
class TecDocPackageStructLanguagesRequest extends TecDocPackageWsdlClass
{
	/**
	 * The lang
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $lang;
	/**
	 * The provider
	 * @var int
	 */
	public $provider;
	/**
	 * Constructor method for LanguagesRequest
	 * @see parent::__construct()
	 * @param string $_lang
	 * @param int $_provider
	 * @return TecDocPackageStructLanguagesRequest
	 */
	public function __construct($_lang = NULL,$_provider = NULL)
	{
		parent::__construct(array('lang'=>$_lang,'provider'=>$_provider));
	}
	/**
	 * Get lang value
	 * @return string
	 */
	public function getLang()
	{
		return $this->lang;
	}
	/**
	 * Set lang value
	 * @param string the lang
	 * @return string
	 */
	public function setLang($_lang)
	{
		return ($this->lang = $_lang);
	}
	/**
	 * Get provider value
	 * @return int
	 */
	public function getProvider()
	{
		return $this->provider;
	}
	/**
	 * Set provider value
	 * @param int the provider
	 * @return int
	 */
	public function setProvider($_provider)
	{
		return ($this->provider = $_provider);
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