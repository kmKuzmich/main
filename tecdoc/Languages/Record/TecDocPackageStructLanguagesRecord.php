<?php
/**
 * File for class TecDocPackageStructLanguagesRecord
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageStructLanguagesRecord originally named LanguagesRecord
 * @package TecDocPackage
 * @subpackage Structs
 * @date 2013-02-10
 */
class TecDocPackageStructLanguagesRecord extends TecDocPackageWsdlClass
{
	/**
	 * The languageCode
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $languageCode;
	/**
	 * The languageName
	 * Meta informations extracted from the WSDL
	 * - nillable : true
	 * @var string
	 */
	public $languageName;
	/**
	 * Constructor method for LanguagesRecord
	 * @see parent::__construct()
	 * @param string $_languageCode
	 * @param string $_languageName
	 * @return TecDocPackageStructLanguagesRecord
	 */
	public function __construct($_languageCode = NULL,$_languageName = NULL)
	{
		parent::__construct(array('languageCode'=>$_languageCode,'languageName'=>$_languageName));
	}
	/**
	 * Get languageCode value
	 * @return string
	 */
	public function getLanguageCode()
	{
		return $this->languageCode;
	}
	/**
	 * Set languageCode value
	 * @param string the languageCode
	 * @return string
	 */
	public function setLanguageCode($_languageCode)
	{
		return ($this->languageCode = $_languageCode);
	}
	/**
	 * Get languageName value
	 * @return string
	 */
	public function getLanguageName()
	{
		return $this->languageName;
	}
	/**
	 * Set languageName value
	 * @param string the languageName
	 * @return string
	 */
	public function setLanguageName($_languageName)
	{
		return ($this->languageName = $_languageName);
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