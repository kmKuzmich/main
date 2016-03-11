<?php
/**
 * File for class TecDocPackageServiceAdd
 * @package TecDocPackage
 * @subpackage Services
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageServiceAdd originally named Add
 * @package TecDocPackage
 * @subpackage Services
 * @date 2013-02-10
 */
class TecDocPackageServiceAdd extends TecDocPackageWsdlClass
{
	/**
	 * Method to call the operation originally named addDynamicAddress
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructDynamicAddressRequest::getAddress()
	 * @uses TecDocPackageStructDynamicAddressRequest::getProvider()
	 * @uses TecDocPackageStructDynamicAddressRequest::getValidityHours()
	 * @param TecDocPackageStructDynamicAddressRequest $_tecDocPackageStructDynamicAddressRequest
	 * @return TecDocPackageStructDynamicAddressResponse
	 */
	public function addDynamicAddress(TecDocPackageStructDynamicAddressRequest $_tecDocPackageStructDynamicAddressRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructDynamicAddressResponse(self::getSoapClient()->addDynamicAddress(array('address'=>$_tecDocPackageStructDynamicAddressRequest->getAddress(),'provider'=>$_tecDocPackageStructDynamicAddressRequest->getProvider(),'validityHours'=>$_tecDocPackageStructDynamicAddressRequest->getValidityHours()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Returns the result
	 * @see TecDocPackageWsdlClass::getResult()
	 * @return TecDocPackageStructDynamicAddressResponse
	 */
	public function getResult()
	{
		return parent::getResult();
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