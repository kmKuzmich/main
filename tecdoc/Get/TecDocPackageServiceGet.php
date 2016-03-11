<?php
/**
 * File for class TecDocPackageServiceGet
 * @package TecDocPackage
 * @subpackage Services
 * @date 2013-02-10
 */
/**
 * This class stands for TecDocPackageServiceGet originally named Get
 * @package TecDocPackage
 * @subpackage Services
 * @date 2013-02-10
 */
class TecDocPackageServiceGet extends TecDocPackageWsdlClass
{
	/**
	 * Method to call the operation originally named getLoad
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @return int
	 */
	public function getLoad()
	{
		try
		{
			$this->setResult(self::getSoapClient()->getLoad());
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getTarget
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @return string
	 */
	public function getTarget()
	{
		try
		{
			$this->setResult(self::getSoapClient()->getTarget());
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getLanguages
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructLanguagesRequest::getLang()
	 * @uses TecDocPackageStructLanguagesRequest::getProvider()
	 * @param TecDocPackageStructLanguagesRequest $_tecDocPackageStructLanguagesRequest
	 * @return TecDocPackageStructLanguagesResponse
	 */
	public function getLanguages(TecDocPackageStructLanguagesRequest $_tecDocPackageStructLanguagesRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructLanguagesResponse(self::getSoapClient()->getLanguages(array('lang'=>$_tecDocPackageStructLanguagesRequest->getLang(),'provider'=>$_tecDocPackageStructLanguagesRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getCountries
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructCountriesRequest::getLang()
	 * @uses TecDocPackageStructCountriesRequest::getProvider()
	 * @param TecDocPackageStructCountriesRequest $_tecDocPackageStructCountriesRequest
	 * @return TecDocPackageStructCountriesResponse
	 */
	public function getCountries(TecDocPackageStructCountriesRequest $_tecDocPackageStructCountriesRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructCountriesResponse(self::getSoapClient()->getCountries(array('lang'=>$_tecDocPackageStructCountriesRequest->getLang(),'provider'=>$_tecDocPackageStructCountriesRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getCountryGroups
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructCountryGroupsRequest::getLang()
	 * @uses TecDocPackageStructCountryGroupsRequest::getProvider()
	 * @param TecDocPackageStructCountryGroupsRequest $_tecDocPackageStructCountryGroupsRequest
	 * @return TecDocPackageStructCountryGroupsResponse
	 */
	public function getCountryGroups(TecDocPackageStructCountryGroupsRequest $_tecDocPackageStructCountryGroupsRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructCountryGroupsResponse(self::getSoapClient()->getCountryGroups(array('lang'=>$_tecDocPackageStructCountryGroupsRequest->getLang(),'provider'=>$_tecDocPackageStructCountryGroupsRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getKeyValuesForTraderMode
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructKeyValuesForTraderModeRequest::getKeyTableId()
	 * @uses TecDocPackageStructKeyValuesForTraderModeRequest::getLang()
	 * @uses TecDocPackageStructKeyValuesForTraderModeRequest::getProvider()
	 * @param TecDocPackageStructKeyValuesForTraderModeRequest $_tecDocPackageStructKeyValuesForTraderModeRequest
	 * @return TecDocPackageStructKeyValuesForTraderModeResponse
	 */
	public function getKeyValuesForTraderMode(TecDocPackageStructKeyValuesForTraderModeRequest $_tecDocPackageStructKeyValuesForTraderModeRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructKeyValuesForTraderModeResponse(self::getSoapClient()->getKeyValuesForTraderMode(array('keyTableId'=>$_tecDocPackageStructKeyValuesForTraderModeRequest->getKeyTableId(),'lang'=>$_tecDocPackageStructKeyValuesForTraderModeRequest->getLang(),'provider'=>$_tecDocPackageStructKeyValuesForTraderModeRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getCriteria2
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructCriteriaRequest::getLang()
	 * @uses TecDocPackageStructCriteriaRequest::getProvider()
	 * @param TecDocPackageStructCriteriaRequest $_tecDocPackageStructCriteriaRequest
	 * @return TecDocPackageStructCriteria2Response
	 */
	public function getCriteria2(TecDocPackageStructCriteriaRequest $_tecDocPackageStructCriteriaRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructCriteria2Response(self::getSoapClient()->getCriteria2(array('lang'=>$_tecDocPackageStructCriteriaRequest->getLang(),'provider'=>$_tecDocPackageStructCriteriaRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getBrandsForAssortment
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructBrandsForAssortmentRequest::getProvider()
	 * @param TecDocPackageStructBrandsForAssortmentRequest $_tecDocPackageStructBrandsForAssortmentRequest
	 * @return TecDocPackageStructBrandsForAssortmentResponse
	 */
	public function getBrandsForAssortment(TecDocPackageStructBrandsForAssortmentRequest $_tecDocPackageStructBrandsForAssortmentRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructBrandsForAssortmentResponse(self::getSoapClient()->getBrandsForAssortment(array('provider'=>$_tecDocPackageStructBrandsForAssortmentRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getManufacturerInfosById
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructManufacturerInfosByIdRequest::getBrandNo()
	 * @uses TecDocPackageStructManufacturerInfosByIdRequest::getCountry()
	 * @uses TecDocPackageStructManufacturerInfosByIdRequest::getLang()
	 * @uses TecDocPackageStructManufacturerInfosByIdRequest::getProvider()
	 * @param TecDocPackageStructManufacturerInfosByIdRequest $_tecDocPackageStructManufacturerInfosByIdRequest
	 * @return TecDocPackageStructManufacturerInfosByIdResponse
	 */
	public function getManufacturerInfosById(TecDocPackageStructManufacturerInfosByIdRequest $_tecDocPackageStructManufacturerInfosByIdRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructManufacturerInfosByIdResponse(self::getSoapClient()->getManufacturerInfosById(array('brandNo'=>$_tecDocPackageStructManufacturerInfosByIdRequest->getBrandNo(),'country'=>$_tecDocPackageStructManufacturerInfosByIdRequest->getCountry(),'lang'=>$_tecDocPackageStructManufacturerInfosByIdRequest->getLang(),'provider'=>$_tecDocPackageStructManufacturerInfosByIdRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getManufacturerInfosById2
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructManufacturerInfosById2Request::getBrandNo()
	 * @uses TecDocPackageStructManufacturerInfosById2Request::getCountry()
	 * @uses TecDocPackageStructManufacturerInfosById2Request::getLang()
	 * @uses TecDocPackageStructManufacturerInfosById2Request::getProvider()
	 * @param TecDocPackageStructManufacturerInfosById2Request $_tecDocPackageStructManufacturerInfosById2Request
	 * @return TecDocPackageStructManufacturerInfosById2Response
	 */
	public function getManufacturerInfosById2(TecDocPackageStructManufacturerInfosById2Request $_tecDocPackageStructManufacturerInfosById2Request)
	{
		try
		{
			$this->setResult(new TecDocPackageStructManufacturerInfosById2Response(self::getSoapClient()->getManufacturerInfosById2(array('brandNo'=>$_tecDocPackageStructManufacturerInfosById2Request->getBrandNo(),'country'=>$_tecDocPackageStructManufacturerInfosById2Request->getCountry(),'lang'=>$_tecDocPackageStructManufacturerInfosById2Request->getLang(),'provider'=>$_tecDocPackageStructManufacturerInfosById2Request->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getVehicleManufacturers2
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructVehicleManufacturers2Request::getCarType()
	 * @uses TecDocPackageStructVehicleManufacturers2Request::getCountriesCarSelection()
	 * @uses TecDocPackageStructVehicleManufacturers2Request::getCountryGroupFlag()
	 * @uses TecDocPackageStructVehicleManufacturers2Request::getEvalFavor()
	 * @uses TecDocPackageStructVehicleManufacturers2Request::getFavouredList()
	 * @uses TecDocPackageStructVehicleManufacturers2Request::getLang()
	 * @uses TecDocPackageStructVehicleManufacturers2Request::getProvider()
	 * @param TecDocPackageStructVehicleManufacturers2Request $_tecDocPackageStructVehicleManufacturers2Request
	 * @return TecDocPackageStructVehicleManufacturers2Response
	 */
	public function getVehicleManufacturers2(TecDocPackageStructVehicleManufacturers2Request $_tecDocPackageStructVehicleManufacturers2Request)
	{
		try
		{
			$this->setResult(new TecDocPackageStructVehicleManufacturers2Response(self::getSoapClient()->getVehicleManufacturers2(array('carType'=>$_tecDocPackageStructVehicleManufacturers2Request->getCarType(),'countriesCarSelection'=>$_tecDocPackageStructVehicleManufacturers2Request->getCountriesCarSelection(),'countryGroupFlag'=>$_tecDocPackageStructVehicleManufacturers2Request->getCountryGroupFlag(),'evalFavor'=>$_tecDocPackageStructVehicleManufacturers2Request->getEvalFavor(),'favouredList'=>$_tecDocPackageStructVehicleManufacturers2Request->getFavouredList(),'lang'=>$_tecDocPackageStructVehicleManufacturers2Request->getLang(),'provider'=>$_tecDocPackageStructVehicleManufacturers2Request->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getVehicleManufacturers3
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructVehicleManufacturers3Request::getCarType()
	 * @uses TecDocPackageStructVehicleManufacturers3Request::getCountriesCarSelection()
	 * @uses TecDocPackageStructVehicleManufacturers3Request::getCountryGroupFlag()
	 * @uses TecDocPackageStructVehicleManufacturers3Request::getEvalFavor()
	 * @uses TecDocPackageStructVehicleManufacturers3Request::getFavouredList()
	 * @uses TecDocPackageStructVehicleManufacturers3Request::getLang()
	 * @uses TecDocPackageStructVehicleManufacturers3Request::getProvider()
	 * @param TecDocPackageStructVehicleManufacturers3Request $_tecDocPackageStructVehicleManufacturers3Request
	 * @return TecDocPackageStructVehicleManufacturers3Response
	 */
	public function getVehicleManufacturers3(TecDocPackageStructVehicleManufacturers3Request $_tecDocPackageStructVehicleManufacturers3Request)
	{
		try
		{
			$this->setResult(new TecDocPackageStructVehicleManufacturers3Response(self::getSoapClient()->getVehicleManufacturers3(array('carType'=>$_tecDocPackageStructVehicleManufacturers3Request->getCarType(),'countriesCarSelection'=>$_tecDocPackageStructVehicleManufacturers3Request->getCountriesCarSelection(),'countryGroupFlag'=>$_tecDocPackageStructVehicleManufacturers3Request->getCountryGroupFlag(),'evalFavor'=>$_tecDocPackageStructVehicleManufacturers3Request->getEvalFavor(),'favouredList'=>$_tecDocPackageStructVehicleManufacturers3Request->getFavouredList(),'lang'=>$_tecDocPackageStructVehicleManufacturers3Request->getLang(),'provider'=>$_tecDocPackageStructVehicleManufacturers3Request->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getVehicleModels2
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructVehicleModels2Request::getCarType()
	 * @uses TecDocPackageStructVehicleModels2Request::getCountriesCarSelection()
	 * @uses TecDocPackageStructVehicleModels2Request::getCountryGroupFlag()
	 * @uses TecDocPackageStructVehicleModels2Request::getEvalFavor()
	 * @uses TecDocPackageStructVehicleModels2Request::getFavouredList()
	 * @uses TecDocPackageStructVehicleModels2Request::getLang()
	 * @uses TecDocPackageStructVehicleModels2Request::getManuId()
	 * @uses TecDocPackageStructVehicleModels2Request::getProvider()
	 * @param TecDocPackageStructVehicleModels2Request $_tecDocPackageStructVehicleModels2Request
	 * @return TecDocPackageStructVehicleModels2Response
	 */
	public function getVehicleModels2(TecDocPackageStructVehicleModels2Request $_tecDocPackageStructVehicleModels2Request)
	{
		try
		{
			$this->setResult(new TecDocPackageStructVehicleModels2Response(self::getSoapClient()->getVehicleModels2(array('carType'=>$_tecDocPackageStructVehicleModels2Request->getCarType(),'countriesCarSelection'=>$_tecDocPackageStructVehicleModels2Request->getCountriesCarSelection(),'countryGroupFlag'=>$_tecDocPackageStructVehicleModels2Request->getCountryGroupFlag(),'evalFavor'=>$_tecDocPackageStructVehicleModels2Request->getEvalFavor(),'favouredList'=>$_tecDocPackageStructVehicleModels2Request->getFavouredList(),'lang'=>$_tecDocPackageStructVehicleModels2Request->getLang(),'manuId'=>$_tecDocPackageStructVehicleModels2Request->getManuId(),'provider'=>$_tecDocPackageStructVehicleModels2Request->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getVehicleModels3
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructVehicleModels3Request::getCarType()
	 * @uses TecDocPackageStructVehicleModels3Request::getCountriesCarSelection()
	 * @uses TecDocPackageStructVehicleModels3Request::getCountryGroupFlag()
	 * @uses TecDocPackageStructVehicleModels3Request::getEvalFavor()
	 * @uses TecDocPackageStructVehicleModels3Request::getFavouredList()
	 * @uses TecDocPackageStructVehicleModels3Request::getLang()
	 * @uses TecDocPackageStructVehicleModels3Request::getManuId()
	 * @uses TecDocPackageStructVehicleModels3Request::getProvider()
	 * @param TecDocPackageStructVehicleModels3Request $_tecDocPackageStructVehicleModels3Request
	 * @return TecDocPackageStructVehicleModels3Response
	 */
	public function getVehicleModels3(TecDocPackageStructVehicleModels3Request $_tecDocPackageStructVehicleModels3Request)
	{
		try
		{
			$this->setResult(new TecDocPackageStructVehicleModels3Response(self::getSoapClient()->getVehicleModels3(array('carType'=>$_tecDocPackageStructVehicleModels3Request->getCarType(),'countriesCarSelection'=>$_tecDocPackageStructVehicleModels3Request->getCountriesCarSelection(),'countryGroupFlag'=>$_tecDocPackageStructVehicleModels3Request->getCountryGroupFlag(),'evalFavor'=>$_tecDocPackageStructVehicleModels3Request->getEvalFavor(),'favouredList'=>$_tecDocPackageStructVehicleModels3Request->getFavouredList(),'lang'=>$_tecDocPackageStructVehicleModels3Request->getLang(),'manuId'=>$_tecDocPackageStructVehicleModels3Request->getManuId(),'provider'=>$_tecDocPackageStructVehicleModels3Request->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getAxisConfigurations
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructAxisConfigurationsRequest::getLang()
	 * @uses TecDocPackageStructAxisConfigurationsRequest::getProvider()
	 * @param TecDocPackageStructAxisConfigurationsRequest $_tecDocPackageStructAxisConfigurationsRequest
	 * @return TecDocPackageStructAxisConfigurationsResponse
	 */
	public function getAxisConfigurations(TecDocPackageStructAxisConfigurationsRequest $_tecDocPackageStructAxisConfigurationsRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructAxisConfigurationsResponse(self::getSoapClient()->getAxisConfigurations(array('lang'=>$_tecDocPackageStructAxisConfigurationsRequest->getLang(),'provider'=>$_tecDocPackageStructAxisConfigurationsRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getConstructionTypes
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructConstructionTypesRequest::getLang()
	 * @uses TecDocPackageStructConstructionTypesRequest::getProvider()
	 * @param TecDocPackageStructConstructionTypesRequest $_tecDocPackageStructConstructionTypesRequest
	 * @return TecDocPackageStructConstructionTypesResponse
	 */
	public function getConstructionTypes(TecDocPackageStructConstructionTypesRequest $_tecDocPackageStructConstructionTypesRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructConstructionTypesResponse(self::getSoapClient()->getConstructionTypes(array('lang'=>$_tecDocPackageStructConstructionTypesRequest->getLang(),'provider'=>$_tecDocPackageStructConstructionTypesRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getFuelTypes
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructFuelTypesRequest::getLang()
	 * @uses TecDocPackageStructFuelTypesRequest::getProvider()
	 * @param TecDocPackageStructFuelTypesRequest $_tecDocPackageStructFuelTypesRequest
	 * @return TecDocPackageStructFuelTypesResponse
	 */
	public function getFuelTypes(TecDocPackageStructFuelTypesRequest $_tecDocPackageStructFuelTypesRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructFuelTypesResponse(self::getSoapClient()->getFuelTypes(array('lang'=>$_tecDocPackageStructFuelTypesRequest->getLang(),'provider'=>$_tecDocPackageStructFuelTypesRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getVehicleIdsByCarTypeManuIdTerm
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdTermRequest::getAxisConfigurationId()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdTermRequest::getCarType()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdTermRequest::getConstructionTypeId()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdTermRequest::getCountriesCarSelection()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdTermRequest::getCountryGroupFlag()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdTermRequest::getCylinderCapacityFrom()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdTermRequest::getCylinderCapacityTo()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdTermRequest::getFuelTypeId()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdTermRequest::getLang()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdTermRequest::getManuId()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdTermRequest::getModelDescription()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdTermRequest::getPowerFrom()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdTermRequest::getPowerHpType()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdTermRequest::getPowerTo()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdTermRequest::getProvider()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdTermRequest::getTonnageFrom()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdTermRequest::getTonnageTo()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdTermRequest::getYearOfConstruction()
	 * @param TecDocPackageStructVehicleIdsByCarTypeManuIdTermRequest $_tecDocPackageStructVehicleIdsByCarTypeManuIdTermRequest
	 * @return TecDocPackageStructVehicleIdsByCarTypeManuIdTermResponse
	 */
	public function getVehicleIdsByCarTypeManuIdTerm(TecDocPackageStructVehicleIdsByCarTypeManuIdTermRequest $_tecDocPackageStructVehicleIdsByCarTypeManuIdTermRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructVehicleIdsByCarTypeManuIdTermResponse(self::getSoapClient()->getVehicleIdsByCarTypeManuIdTerm(array('axisConfigurationId'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdTermRequest->getAxisConfigurationId(),'carType'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdTermRequest->getCarType(),'constructionTypeId'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdTermRequest->getConstructionTypeId(),'countriesCarSelection'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdTermRequest->getCountriesCarSelection(),'countryGroupFlag'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdTermRequest->getCountryGroupFlag(),'cylinderCapacityFrom'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdTermRequest->getCylinderCapacityFrom(),'cylinderCapacityTo'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdTermRequest->getCylinderCapacityTo(),'fuelTypeId'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdTermRequest->getFuelTypeId(),'lang'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdTermRequest->getLang(),'manuId'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdTermRequest->getManuId(),'modelDescription'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdTermRequest->getModelDescription(),'powerFrom'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdTermRequest->getPowerFrom(),'powerHpType'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdTermRequest->getPowerHpType(),'powerTo'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdTermRequest->getPowerTo(),'provider'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdTermRequest->getProvider(),'tonnageFrom'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdTermRequest->getTonnageFrom(),'tonnageTo'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdTermRequest->getTonnageTo(),'yearOfConstruction'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdTermRequest->getYearOfConstruction()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getVehicleIdsByCarTypeManuIdTerm2
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Request::getAxisConfigurationId()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Request::getCarType()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Request::getConstructionTypeId()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Request::getCountriesCarSelection()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Request::getCountryGroupFlag()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Request::getCylinderCapacityFrom()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Request::getCylinderCapacityTo()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Request::getFuelTypeId()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Request::getLang()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Request::getManuId()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Request::getModelDescription()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Request::getPowerFrom()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Request::getPowerHpType()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Request::getPowerTo()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Request::getProvider()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Request::getTonnageFrom()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Request::getTonnageTo()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Request::getYearOfConstruction()
	 * @param TecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Request $_tecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Request
	 * @return TecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Response
	 */
	public function getVehicleIdsByCarTypeManuIdTerm2(TecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Request $_tecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Request)
	{
		try
		{
			$this->setResult(new TecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Response(self::getSoapClient()->getVehicleIdsByCarTypeManuIdTerm2(array('axisConfigurationId'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Request->getAxisConfigurationId(),'carType'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Request->getCarType(),'constructionTypeId'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Request->getConstructionTypeId(),'countriesCarSelection'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Request->getCountriesCarSelection(),'countryGroupFlag'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Request->getCountryGroupFlag(),'cylinderCapacityFrom'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Request->getCylinderCapacityFrom(),'cylinderCapacityTo'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Request->getCylinderCapacityTo(),'fuelTypeId'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Request->getFuelTypeId(),'lang'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Request->getLang(),'manuId'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Request->getManuId(),'modelDescription'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Request->getModelDescription(),'powerFrom'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Request->getPowerFrom(),'powerHpType'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Request->getPowerHpType(),'powerTo'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Request->getPowerTo(),'provider'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Request->getProvider(),'tonnageFrom'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Request->getTonnageFrom(),'tonnageTo'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Request->getTonnageTo(),'yearOfConstruction'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Request->getYearOfConstruction()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getVehicleIdsByCarTypeManuIdModelIdCriteria2
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Request::getAxisConfigurationId()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Request::getCarType()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Request::getConstructionTypeId()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Request::getCountriesCarSelection()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Request::getCountryGroupFlag()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Request::getCylinderCapacityFrom()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Request::getCylinderCapacityTo()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Request::getFuelTypeId()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Request::getLang()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Request::getManuId()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Request::getModId()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Request::getPowerFrom()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Request::getPowerHpType()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Request::getPowerTo()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Request::getProvider()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Request::getTonnageFrom()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Request::getTonnageTo()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Request::getYearOfConstruction()
	 * @param TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Request $_tecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Request
	 * @return TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Response
	 */
	public function getVehicleIdsByCarTypeManuIdModelIdCriteria2(TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Request $_tecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Request)
	{
		try
		{
			$this->setResult(new TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Response(self::getSoapClient()->getVehicleIdsByCarTypeManuIdModelIdCriteria2(array('axisConfigurationId'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Request->getAxisConfigurationId(),'carType'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Request->getCarType(),'constructionTypeId'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Request->getConstructionTypeId(),'countriesCarSelection'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Request->getCountriesCarSelection(),'countryGroupFlag'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Request->getCountryGroupFlag(),'cylinderCapacityFrom'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Request->getCylinderCapacityFrom(),'cylinderCapacityTo'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Request->getCylinderCapacityTo(),'fuelTypeId'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Request->getFuelTypeId(),'lang'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Request->getLang(),'manuId'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Request->getManuId(),'modId'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Request->getModId(),'powerFrom'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Request->getPowerFrom(),'powerHpType'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Request->getPowerHpType(),'powerTo'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Request->getPowerTo(),'provider'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Request->getProvider(),'tonnageFrom'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Request->getTonnageFrom(),'tonnageTo'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Request->getTonnageTo(),'yearOfConstruction'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Request->getYearOfConstruction()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getVehicleIdsByCarTypeManuIdModelIdCriteria3
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Request::getAxisConfigurationId()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Request::getCarType()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Request::getConstructionTypeId()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Request::getCountriesCarSelection()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Request::getCountryGroupFlag()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Request::getCylinderCapacityFrom()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Request::getCylinderCapacityTo()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Request::getFuelTypeId()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Request::getLang()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Request::getManuId()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Request::getModId()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Request::getPowerFrom()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Request::getPowerHpType()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Request::getPowerTo()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Request::getProvider()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Request::getTonnageFrom()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Request::getTonnageTo()
	 * @uses TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Request::getYearOfConstruction()
	 * @param TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Request $_tecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Request
	 * @return TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Response
	 */
	public function getVehicleIdsByCarTypeManuIdModelIdCriteria3(TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Request $_tecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Request)
	{
		try
		{
			$this->setResult(new TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Response(self::getSoapClient()->getVehicleIdsByCarTypeManuIdModelIdCriteria3(array('axisConfigurationId'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Request->getAxisConfigurationId(),'carType'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Request->getCarType(),'constructionTypeId'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Request->getConstructionTypeId(),'countriesCarSelection'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Request->getCountriesCarSelection(),'countryGroupFlag'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Request->getCountryGroupFlag(),'cylinderCapacityFrom'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Request->getCylinderCapacityFrom(),'cylinderCapacityTo'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Request->getCylinderCapacityTo(),'fuelTypeId'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Request->getFuelTypeId(),'lang'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Request->getLang(),'manuId'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Request->getManuId(),'modId'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Request->getModId(),'powerFrom'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Request->getPowerFrom(),'powerHpType'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Request->getPowerHpType(),'powerTo'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Request->getPowerTo(),'provider'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Request->getProvider(),'tonnageFrom'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Request->getTonnageFrom(),'tonnageTo'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Request->getTonnageTo(),'yearOfConstruction'=>$_tecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Request->getYearOfConstruction()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getVehicleSimplifiedSelection2
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructVehicleSimplifiedSelection2Request::getCarType()
	 * @uses TecDocPackageStructVehicleSimplifiedSelection2Request::getCountriesCarSelection()
	 * @uses TecDocPackageStructVehicleSimplifiedSelection2Request::getCountryGroupFlag()
	 * @uses TecDocPackageStructVehicleSimplifiedSelection2Request::getCountryUserSetting()
	 * @uses TecDocPackageStructVehicleSimplifiedSelection2Request::getFavouredList()
	 * @uses TecDocPackageStructVehicleSimplifiedSelection2Request::getLang()
	 * @uses TecDocPackageStructVehicleSimplifiedSelection2Request::getLinked()
	 * @uses TecDocPackageStructVehicleSimplifiedSelection2Request::getManuId()
	 * @uses TecDocPackageStructVehicleSimplifiedSelection2Request::getModId()
	 * @uses TecDocPackageStructVehicleSimplifiedSelection2Request::getProvider()
	 * @param TecDocPackageStructVehicleSimplifiedSelection2Request $_tecDocPackageStructVehicleSimplifiedSelection2Request
	 * @return TecDocPackageStructVehicleSimplifiedSelection2Response
	 */
	public function getVehicleSimplifiedSelection2(TecDocPackageStructVehicleSimplifiedSelection2Request $_tecDocPackageStructVehicleSimplifiedSelection2Request)
	{
		try
		{
			$this->setResult(new TecDocPackageStructVehicleSimplifiedSelection2Response(self::getSoapClient()->getVehicleSimplifiedSelection2(array('carType'=>$_tecDocPackageStructVehicleSimplifiedSelection2Request->getCarType(),'countriesCarSelection'=>$_tecDocPackageStructVehicleSimplifiedSelection2Request->getCountriesCarSelection(),'countryGroupFlag'=>$_tecDocPackageStructVehicleSimplifiedSelection2Request->getCountryGroupFlag(),'countryUserSetting'=>$_tecDocPackageStructVehicleSimplifiedSelection2Request->getCountryUserSetting(),'favouredList'=>$_tecDocPackageStructVehicleSimplifiedSelection2Request->getFavouredList(),'lang'=>$_tecDocPackageStructVehicleSimplifiedSelection2Request->getLang(),'linked'=>$_tecDocPackageStructVehicleSimplifiedSelection2Request->getLinked(),'manuId'=>$_tecDocPackageStructVehicleSimplifiedSelection2Request->getManuId(),'modId'=>$_tecDocPackageStructVehicleSimplifiedSelection2Request->getModId(),'provider'=>$_tecDocPackageStructVehicleSimplifiedSelection2Request->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getVehicleSimplifiedSelection3
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructVehicleSimplifiedSelection2Request::getCarType()
	 * @uses TecDocPackageStructVehicleSimplifiedSelection2Request::getCountriesCarSelection()
	 * @uses TecDocPackageStructVehicleSimplifiedSelection2Request::getCountryGroupFlag()
	 * @uses TecDocPackageStructVehicleSimplifiedSelection2Request::getCountryUserSetting()
	 * @uses TecDocPackageStructVehicleSimplifiedSelection2Request::getFavouredList()
	 * @uses TecDocPackageStructVehicleSimplifiedSelection2Request::getLang()
	 * @uses TecDocPackageStructVehicleSimplifiedSelection2Request::getLinked()
	 * @uses TecDocPackageStructVehicleSimplifiedSelection2Request::getManuId()
	 * @uses TecDocPackageStructVehicleSimplifiedSelection2Request::getModId()
	 * @uses TecDocPackageStructVehicleSimplifiedSelection2Request::getProvider()
	 * @param TecDocPackageStructVehicleSimplifiedSelection2Request $_tecDocPackageStructVehicleSimplifiedSelection2Request
	 * @return TecDocPackageStructVehicleSimplifiedSelection3Response
	 */
	public function getVehicleSimplifiedSelection3(TecDocPackageStructVehicleSimplifiedSelection2Request $_tecDocPackageStructVehicleSimplifiedSelection2Request)
	{
		try
		{
			$this->setResult(new TecDocPackageStructVehicleSimplifiedSelection3Response(self::getSoapClient()->getVehicleSimplifiedSelection3(array('carType'=>$_tecDocPackageStructVehicleSimplifiedSelection2Request->getCarType(),'countriesCarSelection'=>$_tecDocPackageStructVehicleSimplifiedSelection2Request->getCountriesCarSelection(),'countryGroupFlag'=>$_tecDocPackageStructVehicleSimplifiedSelection2Request->getCountryGroupFlag(),'countryUserSetting'=>$_tecDocPackageStructVehicleSimplifiedSelection2Request->getCountryUserSetting(),'favouredList'=>$_tecDocPackageStructVehicleSimplifiedSelection2Request->getFavouredList(),'lang'=>$_tecDocPackageStructVehicleSimplifiedSelection2Request->getLang(),'linked'=>$_tecDocPackageStructVehicleSimplifiedSelection2Request->getLinked(),'manuId'=>$_tecDocPackageStructVehicleSimplifiedSelection2Request->getManuId(),'modId'=>$_tecDocPackageStructVehicleSimplifiedSelection2Request->getModId(),'provider'=>$_tecDocPackageStructVehicleSimplifiedSelection2Request->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getVehicleSimplifiedSelection4
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructVehicleSimplifiedSelectionRequest::getCarType()
	 * @uses TecDocPackageStructVehicleSimplifiedSelectionRequest::getCountriesCarSelection()
	 * @uses TecDocPackageStructVehicleSimplifiedSelectionRequest::getCountryGroupFlag()
	 * @uses TecDocPackageStructVehicleSimplifiedSelectionRequest::getCountryUserSetting()
	 * @uses TecDocPackageStructVehicleSimplifiedSelectionRequest::getFavouredList()
	 * @uses TecDocPackageStructVehicleSimplifiedSelectionRequest::getLang()
	 * @uses TecDocPackageStructVehicleSimplifiedSelectionRequest::getLinked()
	 * @uses TecDocPackageStructVehicleSimplifiedSelectionRequest::getManuId()
	 * @uses TecDocPackageStructVehicleSimplifiedSelectionRequest::getModId()
	 * @uses TecDocPackageStructVehicleSimplifiedSelectionRequest::getProvider()
	 * @param TecDocPackageStructVehicleSimplifiedSelectionRequest $_tecDocPackageStructVehicleSimplifiedSelectionRequest
	 * @return TecDocPackageStructVehicleSimplifiedSelection4Response
	 */
	public function getVehicleSimplifiedSelection4(TecDocPackageStructVehicleSimplifiedSelectionRequest $_tecDocPackageStructVehicleSimplifiedSelectionRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructVehicleSimplifiedSelection4Response(self::getSoapClient()->getVehicleSimplifiedSelection4(array('carType'=>$_tecDocPackageStructVehicleSimplifiedSelectionRequest->getCarType(),'countriesCarSelection'=>$_tecDocPackageStructVehicleSimplifiedSelectionRequest->getCountriesCarSelection(),'countryGroupFlag'=>$_tecDocPackageStructVehicleSimplifiedSelectionRequest->getCountryGroupFlag(),'countryUserSetting'=>$_tecDocPackageStructVehicleSimplifiedSelectionRequest->getCountryUserSetting(),'favouredList'=>$_tecDocPackageStructVehicleSimplifiedSelectionRequest->getFavouredList(),'lang'=>$_tecDocPackageStructVehicleSimplifiedSelectionRequest->getLang(),'linked'=>$_tecDocPackageStructVehicleSimplifiedSelectionRequest->getLinked(),'manuId'=>$_tecDocPackageStructVehicleSimplifiedSelectionRequest->getManuId(),'modId'=>$_tecDocPackageStructVehicleSimplifiedSelectionRequest->getModId(),'provider'=>$_tecDocPackageStructVehicleSimplifiedSelectionRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getVehicleIdsByKTypeNumber
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructVehicleIdsByKTypeNumberRequest::getCarType()
	 * @uses TecDocPackageStructVehicleIdsByKTypeNumberRequest::getCountriesCarSelection()
	 * @uses TecDocPackageStructVehicleIdsByKTypeNumberRequest::getCountryGroupFlag()
	 * @uses TecDocPackageStructVehicleIdsByKTypeNumberRequest::getLang()
	 * @uses TecDocPackageStructVehicleIdsByKTypeNumberRequest::getProvider()
	 * @uses TecDocPackageStructVehicleIdsByKTypeNumberRequest::getTypeNumber()
	 * @param TecDocPackageStructVehicleIdsByKTypeNumberRequest $_tecDocPackageStructVehicleIdsByKTypeNumberRequest
	 * @return TecDocPackageStructVehicleIdsByKTypeNumberResponse
	 */
	public function getVehicleIdsByKTypeNumber(TecDocPackageStructVehicleIdsByKTypeNumberRequest $_tecDocPackageStructVehicleIdsByKTypeNumberRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructVehicleIdsByKTypeNumberResponse(self::getSoapClient()->getVehicleIdsByKTypeNumber(array('carType'=>$_tecDocPackageStructVehicleIdsByKTypeNumberRequest->getCarType(),'countriesCarSelection'=>$_tecDocPackageStructVehicleIdsByKTypeNumberRequest->getCountriesCarSelection(),'countryGroupFlag'=>$_tecDocPackageStructVehicleIdsByKTypeNumberRequest->getCountryGroupFlag(),'lang'=>$_tecDocPackageStructVehicleIdsByKTypeNumberRequest->getLang(),'provider'=>$_tecDocPackageStructVehicleIdsByKTypeNumberRequest->getProvider(),'typeNumber'=>$_tecDocPackageStructVehicleIdsByKTypeNumberRequest->getTypeNumber()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getVehicleIdsByMotor
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructVehicleIdsByMotorRequest::getCarType()
	 * @uses TecDocPackageStructVehicleIdsByMotorRequest::getCountriesCarSelection()
	 * @uses TecDocPackageStructVehicleIdsByMotorRequest::getCountryGroupFlag()
	 * @uses TecDocPackageStructVehicleIdsByMotorRequest::getLang()
	 * @uses TecDocPackageStructVehicleIdsByMotorRequest::getMotorId()
	 * @uses TecDocPackageStructVehicleIdsByMotorRequest::getProvider()
	 * @param TecDocPackageStructVehicleIdsByMotorRequest $_tecDocPackageStructVehicleIdsByMotorRequest
	 * @return TecDocPackageStructVehicleIdsByMotorResponse
	 */
	public function getVehicleIdsByMotor(TecDocPackageStructVehicleIdsByMotorRequest $_tecDocPackageStructVehicleIdsByMotorRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructVehicleIdsByMotorResponse(self::getSoapClient()->getVehicleIdsByMotor(array('carType'=>$_tecDocPackageStructVehicleIdsByMotorRequest->getCarType(),'countriesCarSelection'=>$_tecDocPackageStructVehicleIdsByMotorRequest->getCountriesCarSelection(),'countryGroupFlag'=>$_tecDocPackageStructVehicleIdsByMotorRequest->getCountryGroupFlag(),'lang'=>$_tecDocPackageStructVehicleIdsByMotorRequest->getLang(),'motorId'=>$_tecDocPackageStructVehicleIdsByMotorRequest->getMotorId(),'provider'=>$_tecDocPackageStructVehicleIdsByMotorRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getVehicleIdsByMotor2
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructVehicleIdsByMotor2Request::getCarType()
	 * @uses TecDocPackageStructVehicleIdsByMotor2Request::getCountriesCarSelection()
	 * @uses TecDocPackageStructVehicleIdsByMotor2Request::getCountryGroupFlag()
	 * @uses TecDocPackageStructVehicleIdsByMotor2Request::getLang()
	 * @uses TecDocPackageStructVehicleIdsByMotor2Request::getMotorId()
	 * @uses TecDocPackageStructVehicleIdsByMotor2Request::getProvider()
	 * @param TecDocPackageStructVehicleIdsByMotor2Request $_tecDocPackageStructVehicleIdsByMotor2Request
	 * @return TecDocPackageStructVehicleIdsByMotor2Response
	 */
	public function getVehicleIdsByMotor2(TecDocPackageStructVehicleIdsByMotor2Request $_tecDocPackageStructVehicleIdsByMotor2Request)
	{
		try
		{
			$this->setResult(new TecDocPackageStructVehicleIdsByMotor2Response(self::getSoapClient()->getVehicleIdsByMotor2(array('carType'=>$_tecDocPackageStructVehicleIdsByMotor2Request->getCarType(),'countriesCarSelection'=>$_tecDocPackageStructVehicleIdsByMotor2Request->getCountriesCarSelection(),'countryGroupFlag'=>$_tecDocPackageStructVehicleIdsByMotor2Request->getCountryGroupFlag(),'lang'=>$_tecDocPackageStructVehicleIdsByMotor2Request->getLang(),'motorId'=>$_tecDocPackageStructVehicleIdsByMotor2Request->getMotorId(),'provider'=>$_tecDocPackageStructVehicleIdsByMotor2Request->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getVehicleIdsByMark
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructVehicleIdsByMarkRequest::getCountriesCarSelection()
	 * @uses TecDocPackageStructVehicleIdsByMarkRequest::getCountryGroupFlag()
	 * @uses TecDocPackageStructVehicleIdsByMarkRequest::getCountryUserSetting()
	 * @uses TecDocPackageStructVehicleIdsByMarkRequest::getLang()
	 * @uses TecDocPackageStructVehicleIdsByMarkRequest::getMarkId()
	 * @uses TecDocPackageStructVehicleIdsByMarkRequest::getProvider()
	 * @param TecDocPackageStructVehicleIdsByMarkRequest $_tecDocPackageStructVehicleIdsByMarkRequest
	 * @return TecDocPackageStructVehicleIdsByMarkResponse
	 */
	public function getVehicleIdsByMark(TecDocPackageStructVehicleIdsByMarkRequest $_tecDocPackageStructVehicleIdsByMarkRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructVehicleIdsByMarkResponse(self::getSoapClient()->getVehicleIdsByMark(array('countriesCarSelection'=>$_tecDocPackageStructVehicleIdsByMarkRequest->getCountriesCarSelection(),'countryGroupFlag'=>$_tecDocPackageStructVehicleIdsByMarkRequest->getCountryGroupFlag(),'countryUserSetting'=>$_tecDocPackageStructVehicleIdsByMarkRequest->getCountryUserSetting(),'lang'=>$_tecDocPackageStructVehicleIdsByMarkRequest->getLang(),'markId'=>$_tecDocPackageStructVehicleIdsByMarkRequest->getMarkId(),'provider'=>$_tecDocPackageStructVehicleIdsByMarkRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getVehicleIdsByVendorId
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructVehicleIdsByVendorIdRequest::getCarType()
	 * @uses TecDocPackageStructVehicleIdsByVendorIdRequest::getCountriesCarSelection()
	 * @uses TecDocPackageStructVehicleIdsByVendorIdRequest::getCountryGroupFlag()
	 * @uses TecDocPackageStructVehicleIdsByVendorIdRequest::getLang()
	 * @uses TecDocPackageStructVehicleIdsByVendorIdRequest::getManuId()
	 * @uses TecDocPackageStructVehicleIdsByVendorIdRequest::getProvider()
	 * @uses TecDocPackageStructVehicleIdsByVendorIdRequest::getVendorName()
	 * @param TecDocPackageStructVehicleIdsByVendorIdRequest $_tecDocPackageStructVehicleIdsByVendorIdRequest
	 * @return TecDocPackageStructVehicleIdsByVendorIdResponse
	 */
	public function getVehicleIdsByVendorId(TecDocPackageStructVehicleIdsByVendorIdRequest $_tecDocPackageStructVehicleIdsByVendorIdRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructVehicleIdsByVendorIdResponse(self::getSoapClient()->getVehicleIdsByVendorId(array('carType'=>$_tecDocPackageStructVehicleIdsByVendorIdRequest->getCarType(),'countriesCarSelection'=>$_tecDocPackageStructVehicleIdsByVendorIdRequest->getCountriesCarSelection(),'countryGroupFlag'=>$_tecDocPackageStructVehicleIdsByVendorIdRequest->getCountryGroupFlag(),'lang'=>$_tecDocPackageStructVehicleIdsByVendorIdRequest->getLang(),'manuId'=>$_tecDocPackageStructVehicleIdsByVendorIdRequest->getManuId(),'provider'=>$_tecDocPackageStructVehicleIdsByVendorIdRequest->getProvider(),'vendorName'=>$_tecDocPackageStructVehicleIdsByVendorIdRequest->getVendorName()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getVehicleIdsByVendorId2
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructVehicleIdsByVendorId2Request::getCarType()
	 * @uses TecDocPackageStructVehicleIdsByVendorId2Request::getCountriesCarSelection()
	 * @uses TecDocPackageStructVehicleIdsByVendorId2Request::getCountryGroupFlag()
	 * @uses TecDocPackageStructVehicleIdsByVendorId2Request::getLang()
	 * @uses TecDocPackageStructVehicleIdsByVendorId2Request::getManuId()
	 * @uses TecDocPackageStructVehicleIdsByVendorId2Request::getProvider()
	 * @uses TecDocPackageStructVehicleIdsByVendorId2Request::getVendorName()
	 * @param TecDocPackageStructVehicleIdsByVendorId2Request $_tecDocPackageStructVehicleIdsByVendorId2Request
	 * @return TecDocPackageStructVehicleIdsByVendorId2Response
	 */
	public function getVehicleIdsByVendorId2(TecDocPackageStructVehicleIdsByVendorId2Request $_tecDocPackageStructVehicleIdsByVendorId2Request)
	{
		try
		{
			$this->setResult(new TecDocPackageStructVehicleIdsByVendorId2Response(self::getSoapClient()->getVehicleIdsByVendorId2(array('carType'=>$_tecDocPackageStructVehicleIdsByVendorId2Request->getCarType(),'countriesCarSelection'=>$_tecDocPackageStructVehicleIdsByVendorId2Request->getCountriesCarSelection(),'countryGroupFlag'=>$_tecDocPackageStructVehicleIdsByVendorId2Request->getCountryGroupFlag(),'lang'=>$_tecDocPackageStructVehicleIdsByVendorId2Request->getLang(),'manuId'=>$_tecDocPackageStructVehicleIdsByVendorId2Request->getManuId(),'provider'=>$_tecDocPackageStructVehicleIdsByVendorId2Request->getProvider(),'vendorName'=>$_tecDocPackageStructVehicleIdsByVendorId2Request->getVendorName()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getVehicleIdsByKeyNumberPlates3
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructVehicleIdsByKeyNumberPlates2Request::getCountriesCarSelection()
	 * @uses TecDocPackageStructVehicleIdsByKeyNumberPlates2Request::getCountryGroupFlag()
	 * @uses TecDocPackageStructVehicleIdsByKeyNumberPlates2Request::getCountryUserSetting()
	 * @uses TecDocPackageStructVehicleIdsByKeyNumberPlates2Request::getKeySystemNumber()
	 * @uses TecDocPackageStructVehicleIdsByKeyNumberPlates2Request::getKeySystemType()
	 * @uses TecDocPackageStructVehicleIdsByKeyNumberPlates2Request::getLang()
	 * @uses TecDocPackageStructVehicleIdsByKeyNumberPlates2Request::getProvider()
	 * @param TecDocPackageStructVehicleIdsByKeyNumberPlates2Request $_tecDocPackageStructVehicleIdsByKeyNumberPlates2Request
	 * @return TecDocPackageStructVehicleIdsByKeyNumberPlates3Response
	 */
	public function getVehicleIdsByKeyNumberPlates3(TecDocPackageStructVehicleIdsByKeyNumberPlates2Request $_tecDocPackageStructVehicleIdsByKeyNumberPlates2Request)
	{
		try
		{
			$this->setResult(new TecDocPackageStructVehicleIdsByKeyNumberPlates3Response(self::getSoapClient()->getVehicleIdsByKeyNumberPlates3(array('countriesCarSelection'=>$_tecDocPackageStructVehicleIdsByKeyNumberPlates2Request->getCountriesCarSelection(),'countryGroupFlag'=>$_tecDocPackageStructVehicleIdsByKeyNumberPlates2Request->getCountryGroupFlag(),'countryUserSetting'=>$_tecDocPackageStructVehicleIdsByKeyNumberPlates2Request->getCountryUserSetting(),'keySystemNumber'=>$_tecDocPackageStructVehicleIdsByKeyNumberPlates2Request->getKeySystemNumber(),'keySystemType'=>$_tecDocPackageStructVehicleIdsByKeyNumberPlates2Request->getKeySystemType(),'lang'=>$_tecDocPackageStructVehicleIdsByKeyNumberPlates2Request->getLang(),'provider'=>$_tecDocPackageStructVehicleIdsByKeyNumberPlates2Request->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getVehicleByIds
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructVehicleByIdsRequest::getCarIds()
	 * @uses TecDocPackageStructVehicleByIdsRequest::getCountry()
	 * @uses TecDocPackageStructVehicleByIdsRequest::getCountryUserSetting()
	 * @uses TecDocPackageStructVehicleByIdsRequest::getLang()
	 * @uses TecDocPackageStructVehicleByIdsRequest::getMotorCodes()
	 * @uses TecDocPackageStructVehicleByIdsRequest::getPassengerCarDetails()
	 * @uses TecDocPackageStructVehicleByIdsRequest::getProvider()
	 * @uses TecDocPackageStructVehicleByIdsRequest::getVehicleTerms()
	 * @param TecDocPackageStructVehicleByIdsRequest $_tecDocPackageStructVehicleByIdsRequest
	 * @return TecDocPackageStructVehicleByIdsResponse
	 */
	public function getVehicleByIds(TecDocPackageStructVehicleByIdsRequest $_tecDocPackageStructVehicleByIdsRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructVehicleByIdsResponse(self::getSoapClient()->getVehicleByIds(array('carIds'=>$_tecDocPackageStructVehicleByIdsRequest->getCarIds(),'country'=>$_tecDocPackageStructVehicleByIdsRequest->getCountry(),'countryUserSetting'=>$_tecDocPackageStructVehicleByIdsRequest->getCountryUserSetting(),'lang'=>$_tecDocPackageStructVehicleByIdsRequest->getLang(),'motorCodes'=>$_tecDocPackageStructVehicleByIdsRequest->getMotorCodes(),'passengerCarDetails'=>$_tecDocPackageStructVehicleByIdsRequest->getPassengerCarDetails(),'provider'=>$_tecDocPackageStructVehicleByIdsRequest->getProvider(),'vehicleTerms'=>$_tecDocPackageStructVehicleByIdsRequest->getVehicleTerms()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getVehicleByIdsStringList
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructVehicleByIdsStringListRequest::getCarIds()
	 * @uses TecDocPackageStructVehicleByIdsStringListRequest::getCountry()
	 * @uses TecDocPackageStructVehicleByIdsStringListRequest::getCountryUserSetting()
	 * @uses TecDocPackageStructVehicleByIdsStringListRequest::getLang()
	 * @uses TecDocPackageStructVehicleByIdsStringListRequest::getMotorCodes()
	 * @uses TecDocPackageStructVehicleByIdsStringListRequest::getPassengerCarDetails()
	 * @uses TecDocPackageStructVehicleByIdsStringListRequest::getProvider()
	 * @uses TecDocPackageStructVehicleByIdsStringListRequest::getVehicleTerms()
	 * @param TecDocPackageStructVehicleByIdsStringListRequest $_tecDocPackageStructVehicleByIdsStringListRequest
	 * @return TecDocPackageStructVehicleByIdsResponse
	 */
	public function getVehicleByIdsStringList(TecDocPackageStructVehicleByIdsStringListRequest $_tecDocPackageStructVehicleByIdsStringListRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructVehicleByIdsResponse(self::getSoapClient()->getVehicleByIdsStringList(array('carIds'=>$_tecDocPackageStructVehicleByIdsStringListRequest->getCarIds(),'country'=>$_tecDocPackageStructVehicleByIdsStringListRequest->getCountry(),'countryUserSetting'=>$_tecDocPackageStructVehicleByIdsStringListRequest->getCountryUserSetting(),'lang'=>$_tecDocPackageStructVehicleByIdsStringListRequest->getLang(),'motorCodes'=>$_tecDocPackageStructVehicleByIdsStringListRequest->getMotorCodes(),'passengerCarDetails'=>$_tecDocPackageStructVehicleByIdsStringListRequest->getPassengerCarDetails(),'provider'=>$_tecDocPackageStructVehicleByIdsStringListRequest->getProvider(),'vehicleTerms'=>$_tecDocPackageStructVehicleByIdsStringListRequest->getVehicleTerms()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getVehicleByIds2
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructVehicleByIds2Request::getAxles()
	 * @uses TecDocPackageStructVehicleByIds2Request::getCabs()
	 * @uses TecDocPackageStructVehicleByIds2Request::getCarIds()
	 * @uses TecDocPackageStructVehicleByIds2Request::getCountriesCarSelection()
	 * @uses TecDocPackageStructVehicleByIds2Request::getCountry()
	 * @uses TecDocPackageStructVehicleByIds2Request::getCountryGroupFlag()
	 * @uses TecDocPackageStructVehicleByIds2Request::getCountryUserSetting()
	 * @uses TecDocPackageStructVehicleByIds2Request::getLang()
	 * @uses TecDocPackageStructVehicleByIds2Request::getMotorCodes()
	 * @uses TecDocPackageStructVehicleByIds2Request::getProvider()
	 * @uses TecDocPackageStructVehicleByIds2Request::getSecondaryTypes()
	 * @uses TecDocPackageStructVehicleByIds2Request::getVehicleDetails2()
	 * @uses TecDocPackageStructVehicleByIds2Request::getVehicleTerms()
	 * @uses TecDocPackageStructVehicleByIds2Request::getWheelbases()
	 * @param TecDocPackageStructVehicleByIds2Request $_tecDocPackageStructVehicleByIds2Request
	 * @return TecDocPackageStructVehicleByIds2Response
	 */
	public function getVehicleByIds2(TecDocPackageStructVehicleByIds2Request $_tecDocPackageStructVehicleByIds2Request)
	{
		try
		{
			$this->setResult(new TecDocPackageStructVehicleByIds2Response(self::getSoapClient()->getVehicleByIds2(array('axles'=>$_tecDocPackageStructVehicleByIds2Request->getAxles(),'cabs'=>$_tecDocPackageStructVehicleByIds2Request->getCabs(),'carIds'=>$_tecDocPackageStructVehicleByIds2Request->getCarIds(),'countriesCarSelection'=>$_tecDocPackageStructVehicleByIds2Request->getCountriesCarSelection(),'country'=>$_tecDocPackageStructVehicleByIds2Request->getCountry(),'countryGroupFlag'=>$_tecDocPackageStructVehicleByIds2Request->getCountryGroupFlag(),'countryUserSetting'=>$_tecDocPackageStructVehicleByIds2Request->getCountryUserSetting(),'lang'=>$_tecDocPackageStructVehicleByIds2Request->getLang(),'motorCodes'=>$_tecDocPackageStructVehicleByIds2Request->getMotorCodes(),'provider'=>$_tecDocPackageStructVehicleByIds2Request->getProvider(),'secondaryTypes'=>$_tecDocPackageStructVehicleByIds2Request->getSecondaryTypes(),'vehicleDetails2'=>$_tecDocPackageStructVehicleByIds2Request->getVehicleDetails2(),'vehicleTerms'=>$_tecDocPackageStructVehicleByIds2Request->getVehicleTerms(),'wheelbases'=>$_tecDocPackageStructVehicleByIds2Request->getWheelbases()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getVehicleByIds2StringList
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructVehicleByIds2StringListRequest::getAxles()
	 * @uses TecDocPackageStructVehicleByIds2StringListRequest::getCabs()
	 * @uses TecDocPackageStructVehicleByIds2StringListRequest::getCarIds()
	 * @uses TecDocPackageStructVehicleByIds2StringListRequest::getCountriesCarSelection()
	 * @uses TecDocPackageStructVehicleByIds2StringListRequest::getCountry()
	 * @uses TecDocPackageStructVehicleByIds2StringListRequest::getCountryGroupFlag()
	 * @uses TecDocPackageStructVehicleByIds2StringListRequest::getCountryUserSetting()
	 * @uses TecDocPackageStructVehicleByIds2StringListRequest::getLang()
	 * @uses TecDocPackageStructVehicleByIds2StringListRequest::getMotorCodes()
	 * @uses TecDocPackageStructVehicleByIds2StringListRequest::getProvider()
	 * @uses TecDocPackageStructVehicleByIds2StringListRequest::getSecondaryTypes()
	 * @uses TecDocPackageStructVehicleByIds2StringListRequest::getVehicleDetails2()
	 * @uses TecDocPackageStructVehicleByIds2StringListRequest::getVehicleTerms()
	 * @uses TecDocPackageStructVehicleByIds2StringListRequest::getWheelbases()
	 * @param TecDocPackageStructVehicleByIds2StringListRequest $_tecDocPackageStructVehicleByIds2StringListRequest
	 * @return TecDocPackageStructVehicleByIds2Response
	 */
	public function getVehicleByIds2StringList(TecDocPackageStructVehicleByIds2StringListRequest $_tecDocPackageStructVehicleByIds2StringListRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructVehicleByIds2Response(self::getSoapClient()->getVehicleByIds2StringList(array('axles'=>$_tecDocPackageStructVehicleByIds2StringListRequest->getAxles(),'cabs'=>$_tecDocPackageStructVehicleByIds2StringListRequest->getCabs(),'carIds'=>$_tecDocPackageStructVehicleByIds2StringListRequest->getCarIds(),'countriesCarSelection'=>$_tecDocPackageStructVehicleByIds2StringListRequest->getCountriesCarSelection(),'country'=>$_tecDocPackageStructVehicleByIds2StringListRequest->getCountry(),'countryGroupFlag'=>$_tecDocPackageStructVehicleByIds2StringListRequest->getCountryGroupFlag(),'countryUserSetting'=>$_tecDocPackageStructVehicleByIds2StringListRequest->getCountryUserSetting(),'lang'=>$_tecDocPackageStructVehicleByIds2StringListRequest->getLang(),'motorCodes'=>$_tecDocPackageStructVehicleByIds2StringListRequest->getMotorCodes(),'provider'=>$_tecDocPackageStructVehicleByIds2StringListRequest->getProvider(),'secondaryTypes'=>$_tecDocPackageStructVehicleByIds2StringListRequest->getSecondaryTypes(),'vehicleDetails2'=>$_tecDocPackageStructVehicleByIds2StringListRequest->getVehicleDetails2(),'vehicleTerms'=>$_tecDocPackageStructVehicleByIds2StringListRequest->getVehicleTerms(),'wheelbases'=>$_tecDocPackageStructVehicleByIds2StringListRequest->getWheelbases()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getVehicleByIds2Single
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructVehicleByIds2SingleRequest::getAxles()
	 * @uses TecDocPackageStructVehicleByIds2SingleRequest::getCabs()
	 * @uses TecDocPackageStructVehicleByIds2SingleRequest::getCarIds()
	 * @uses TecDocPackageStructVehicleByIds2SingleRequest::getCountriesCarSelection()
	 * @uses TecDocPackageStructVehicleByIds2SingleRequest::getCountry()
	 * @uses TecDocPackageStructVehicleByIds2SingleRequest::getCountryGroupFlag()
	 * @uses TecDocPackageStructVehicleByIds2SingleRequest::getCountryUserSetting()
	 * @uses TecDocPackageStructVehicleByIds2SingleRequest::getLang()
	 * @uses TecDocPackageStructVehicleByIds2SingleRequest::getMotorCodes()
	 * @uses TecDocPackageStructVehicleByIds2SingleRequest::getProvider()
	 * @uses TecDocPackageStructVehicleByIds2SingleRequest::getSecondaryTypes()
	 * @uses TecDocPackageStructVehicleByIds2SingleRequest::getVehicleDetails()
	 * @uses TecDocPackageStructVehicleByIds2SingleRequest::getVehicleTerms()
	 * @uses TecDocPackageStructVehicleByIds2SingleRequest::getWheelbases()
	 * @param TecDocPackageStructVehicleByIds2SingleRequest $_tecDocPackageStructVehicleByIds2SingleRequest
	 * @return TecDocPackageStructVehicleByIds2Response
	 */
	public function getVehicleByIds2Single(TecDocPackageStructVehicleByIds2SingleRequest $_tecDocPackageStructVehicleByIds2SingleRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructVehicleByIds2Response(self::getSoapClient()->getVehicleByIds2Single(array('axles'=>$_tecDocPackageStructVehicleByIds2SingleRequest->getAxles(),'cabs'=>$_tecDocPackageStructVehicleByIds2SingleRequest->getCabs(),'carIds'=>$_tecDocPackageStructVehicleByIds2SingleRequest->getCarIds(),'countriesCarSelection'=>$_tecDocPackageStructVehicleByIds2SingleRequest->getCountriesCarSelection(),'country'=>$_tecDocPackageStructVehicleByIds2SingleRequest->getCountry(),'countryGroupFlag'=>$_tecDocPackageStructVehicleByIds2SingleRequest->getCountryGroupFlag(),'countryUserSetting'=>$_tecDocPackageStructVehicleByIds2SingleRequest->getCountryUserSetting(),'lang'=>$_tecDocPackageStructVehicleByIds2SingleRequest->getLang(),'motorCodes'=>$_tecDocPackageStructVehicleByIds2SingleRequest->getMotorCodes(),'provider'=>$_tecDocPackageStructVehicleByIds2SingleRequest->getProvider(),'secondaryTypes'=>$_tecDocPackageStructVehicleByIds2SingleRequest->getSecondaryTypes(),'vehicleDetails'=>$_tecDocPackageStructVehicleByIds2SingleRequest->getVehicleDetails(),'vehicleTerms'=>$_tecDocPackageStructVehicleByIds2SingleRequest->getVehicleTerms(),'wheelbases'=>$_tecDocPackageStructVehicleByIds2SingleRequest->getWheelbases()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getAxlesManufacturers2
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructAxlesManufacturers2Request::getLang()
	 * @uses TecDocPackageStructAxlesManufacturers2Request::getProvider()
	 * @param TecDocPackageStructAxlesManufacturers2Request $_tecDocPackageStructAxlesManufacturers2Request
	 * @return TecDocPackageStructAxlesManufacturers2Response
	 */
	public function getAxlesManufacturers2(TecDocPackageStructAxlesManufacturers2Request $_tecDocPackageStructAxlesManufacturers2Request)
	{
		try
		{
			$this->setResult(new TecDocPackageStructAxlesManufacturers2Response(self::getSoapClient()->getAxlesManufacturers2(array('lang'=>$_tecDocPackageStructAxlesManufacturers2Request->getLang(),'provider'=>$_tecDocPackageStructAxlesManufacturers2Request->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getAxleModels
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructAxleModelsRequest::getCountry()
	 * @uses TecDocPackageStructAxleModelsRequest::getLang()
	 * @uses TecDocPackageStructAxleModelsRequest::getManuId()
	 * @uses TecDocPackageStructAxleModelsRequest::getProvider()
	 * @param TecDocPackageStructAxleModelsRequest $_tecDocPackageStructAxleModelsRequest
	 * @return TecDocPackageStructAxleModelsResponse
	 */
	public function getAxleModels(TecDocPackageStructAxleModelsRequest $_tecDocPackageStructAxleModelsRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructAxleModelsResponse(self::getSoapClient()->getAxleModels(array('country'=>$_tecDocPackageStructAxleModelsRequest->getCountry(),'lang'=>$_tecDocPackageStructAxleModelsRequest->getLang(),'manuId'=>$_tecDocPackageStructAxleModelsRequest->getManuId(),'provider'=>$_tecDocPackageStructAxleModelsRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getAxleBrakeSizes
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructAxleBrakeSizesRequest::getLang()
	 * @uses TecDocPackageStructAxleBrakeSizesRequest::getProvider()
	 * @param TecDocPackageStructAxleBrakeSizesRequest $_tecDocPackageStructAxleBrakeSizesRequest
	 * @return TecDocPackageStructAxleBrakeSizesResponse
	 */
	public function getAxleBrakeSizes(TecDocPackageStructAxleBrakeSizesRequest $_tecDocPackageStructAxleBrakeSizesRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructAxleBrakeSizesResponse(self::getSoapClient()->getAxleBrakeSizes(array('lang'=>$_tecDocPackageStructAxleBrakeSizesRequest->getLang(),'provider'=>$_tecDocPackageStructAxleBrakeSizesRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getAxleStyles
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructAxleStylesRequest::getLang()
	 * @uses TecDocPackageStructAxleStylesRequest::getProvider()
	 * @param TecDocPackageStructAxleStylesRequest $_tecDocPackageStructAxleStylesRequest
	 * @return TecDocPackageStructAxleStylesResponse
	 */
	public function getAxleStyles(TecDocPackageStructAxleStylesRequest $_tecDocPackageStructAxleStylesRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructAxleStylesResponse(self::getSoapClient()->getAxleStyles(array('lang'=>$_tecDocPackageStructAxleStylesRequest->getLang(),'provider'=>$_tecDocPackageStructAxleStylesRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getAxleTypes
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructAxleTypesRequest::getLang()
	 * @uses TecDocPackageStructAxleTypesRequest::getProvider()
	 * @param TecDocPackageStructAxleTypesRequest $_tecDocPackageStructAxleTypesRequest
	 * @return TecDocPackageStructAxleTypesResponse
	 */
	public function getAxleTypes(TecDocPackageStructAxleTypesRequest $_tecDocPackageStructAxleTypesRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructAxleTypesResponse(self::getSoapClient()->getAxleTypes(array('lang'=>$_tecDocPackageStructAxleTypesRequest->getLang(),'provider'=>$_tecDocPackageStructAxleTypesRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getAxleIdByTypeManCriteria2
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructAxleIdByTypeManCriteria2Request::getAxleDescription()
	 * @uses TecDocPackageStructAxleIdByTypeManCriteria2Request::getAxleStyleId()
	 * @uses TecDocPackageStructAxleIdByTypeManCriteria2Request::getAxleTypeId()
	 * @uses TecDocPackageStructAxleIdByTypeManCriteria2Request::getBrakeSizeId()
	 * @uses TecDocPackageStructAxleIdByTypeManCriteria2Request::getLang()
	 * @uses TecDocPackageStructAxleIdByTypeManCriteria2Request::getManuId()
	 * @uses TecDocPackageStructAxleIdByTypeManCriteria2Request::getModelId()
	 * @uses TecDocPackageStructAxleIdByTypeManCriteria2Request::getProvider()
	 * @uses TecDocPackageStructAxleIdByTypeManCriteria2Request::getYearOfConstruction()
	 * @param TecDocPackageStructAxleIdByTypeManCriteria2Request $_tecDocPackageStructAxleIdByTypeManCriteria2Request
	 * @return TecDocPackageStructAxleIdByTypeManCriteria2Response
	 */
	public function getAxleIdByTypeManCriteria2(TecDocPackageStructAxleIdByTypeManCriteria2Request $_tecDocPackageStructAxleIdByTypeManCriteria2Request)
	{
		try
		{
			$this->setResult(new TecDocPackageStructAxleIdByTypeManCriteria2Response(self::getSoapClient()->getAxleIdByTypeManCriteria2(array('axleDescription'=>$_tecDocPackageStructAxleIdByTypeManCriteria2Request->getAxleDescription(),'axleStyleId'=>$_tecDocPackageStructAxleIdByTypeManCriteria2Request->getAxleStyleId(),'axleTypeId'=>$_tecDocPackageStructAxleIdByTypeManCriteria2Request->getAxleTypeId(),'brakeSizeId'=>$_tecDocPackageStructAxleIdByTypeManCriteria2Request->getBrakeSizeId(),'lang'=>$_tecDocPackageStructAxleIdByTypeManCriteria2Request->getLang(),'manuId'=>$_tecDocPackageStructAxleIdByTypeManCriteria2Request->getManuId(),'modelId'=>$_tecDocPackageStructAxleIdByTypeManCriteria2Request->getModelId(),'provider'=>$_tecDocPackageStructAxleIdByTypeManCriteria2Request->getProvider(),'yearOfConstruction'=>$_tecDocPackageStructAxleIdByTypeManCriteria2Request->getYearOfConstruction()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getAxleIdByTypeManCriteria3
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructAxleIdByTypeManCriteria3Request::getAxleDescription()
	 * @uses TecDocPackageStructAxleIdByTypeManCriteria3Request::getAxleStyleId()
	 * @uses TecDocPackageStructAxleIdByTypeManCriteria3Request::getAxleTypeId()
	 * @uses TecDocPackageStructAxleIdByTypeManCriteria3Request::getBrakeSizeId()
	 * @uses TecDocPackageStructAxleIdByTypeManCriteria3Request::getLang()
	 * @uses TecDocPackageStructAxleIdByTypeManCriteria3Request::getManuId()
	 * @uses TecDocPackageStructAxleIdByTypeManCriteria3Request::getModelId()
	 * @uses TecDocPackageStructAxleIdByTypeManCriteria3Request::getProvider()
	 * @uses TecDocPackageStructAxleIdByTypeManCriteria3Request::getSearchExact()
	 * @uses TecDocPackageStructAxleIdByTypeManCriteria3Request::getYearOfConstruction()
	 * @param TecDocPackageStructAxleIdByTypeManCriteria3Request $_tecDocPackageStructAxleIdByTypeManCriteria3Request
	 * @return TecDocPackageStructAxleIdByTypeManCriteria3Response
	 */
	public function getAxleIdByTypeManCriteria3(TecDocPackageStructAxleIdByTypeManCriteria3Request $_tecDocPackageStructAxleIdByTypeManCriteria3Request)
	{
		try
		{
			$this->setResult(new TecDocPackageStructAxleIdByTypeManCriteria3Response(self::getSoapClient()->getAxleIdByTypeManCriteria3(array('axleDescription'=>$_tecDocPackageStructAxleIdByTypeManCriteria3Request->getAxleDescription(),'axleStyleId'=>$_tecDocPackageStructAxleIdByTypeManCriteria3Request->getAxleStyleId(),'axleTypeId'=>$_tecDocPackageStructAxleIdByTypeManCriteria3Request->getAxleTypeId(),'brakeSizeId'=>$_tecDocPackageStructAxleIdByTypeManCriteria3Request->getBrakeSizeId(),'lang'=>$_tecDocPackageStructAxleIdByTypeManCriteria3Request->getLang(),'manuId'=>$_tecDocPackageStructAxleIdByTypeManCriteria3Request->getManuId(),'modelId'=>$_tecDocPackageStructAxleIdByTypeManCriteria3Request->getModelId(),'provider'=>$_tecDocPackageStructAxleIdByTypeManCriteria3Request->getProvider(),'searchExact'=>$_tecDocPackageStructAxleIdByTypeManCriteria3Request->getSearchExact(),'yearOfConstruction'=>$_tecDocPackageStructAxleIdByTypeManCriteria3Request->getYearOfConstruction()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getAxleKeyNumbers
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructAxleKeyNumbersRequest::getAxleId()
	 * @uses TecDocPackageStructAxleKeyNumbersRequest::getCountry()
	 * @uses TecDocPackageStructAxleKeyNumbersRequest::getLang()
	 * @uses TecDocPackageStructAxleKeyNumbersRequest::getProvider()
	 * @uses TecDocPackageStructAxleKeyNumbersRequest::getSearchExact()
	 * @uses TecDocPackageStructAxleKeyNumbersRequest::getSearchPattern()
	 * @param TecDocPackageStructAxleKeyNumbersRequest $_tecDocPackageStructAxleKeyNumbersRequest
	 * @return TecDocPackageStructAxleKeyNumbersResponse
	 */
	public function getAxleKeyNumbers(TecDocPackageStructAxleKeyNumbersRequest $_tecDocPackageStructAxleKeyNumbersRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructAxleKeyNumbersResponse(self::getSoapClient()->getAxleKeyNumbers(array('axleId'=>$_tecDocPackageStructAxleKeyNumbersRequest->getAxleId(),'country'=>$_tecDocPackageStructAxleKeyNumbersRequest->getCountry(),'lang'=>$_tecDocPackageStructAxleKeyNumbersRequest->getLang(),'provider'=>$_tecDocPackageStructAxleKeyNumbersRequest->getProvider(),'searchExact'=>$_tecDocPackageStructAxleKeyNumbersRequest->getSearchExact(),'searchPattern'=>$_tecDocPackageStructAxleKeyNumbersRequest->getSearchPattern()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getAxleIdByKeyNumber
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructAxleIdByKeyNumberRequest::getCountry()
	 * @uses TecDocPackageStructAxleIdByKeyNumberRequest::getLang()
	 * @uses TecDocPackageStructAxleIdByKeyNumberRequest::getManuId()
	 * @uses TecDocPackageStructAxleIdByKeyNumberRequest::getProvider()
	 * @uses TecDocPackageStructAxleIdByKeyNumberRequest::getSearchPattern()
	 * @param TecDocPackageStructAxleIdByKeyNumberRequest $_tecDocPackageStructAxleIdByKeyNumberRequest
	 * @return TecDocPackageStructAxleIdByKeyNumberResponse
	 */
	public function getAxleIdByKeyNumber(TecDocPackageStructAxleIdByKeyNumberRequest $_tecDocPackageStructAxleIdByKeyNumberRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructAxleIdByKeyNumberResponse(self::getSoapClient()->getAxleIdByKeyNumber(array('country'=>$_tecDocPackageStructAxleIdByKeyNumberRequest->getCountry(),'lang'=>$_tecDocPackageStructAxleIdByKeyNumberRequest->getLang(),'manuId'=>$_tecDocPackageStructAxleIdByKeyNumberRequest->getManuId(),'provider'=>$_tecDocPackageStructAxleIdByKeyNumberRequest->getProvider(),'searchPattern'=>$_tecDocPackageStructAxleIdByKeyNumberRequest->getSearchPattern()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getAxleByIds
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructAxleByIdsRequest::getAxleIds()
	 * @uses TecDocPackageStructAxleByIdsRequest::getCountry()
	 * @uses TecDocPackageStructAxleByIdsRequest::getLang()
	 * @uses TecDocPackageStructAxleByIdsRequest::getProvider()
	 * @param TecDocPackageStructAxleByIdsRequest $_tecDocPackageStructAxleByIdsRequest
	 * @return TecDocPackageStructAxleByIdsResponse
	 */
	public function getAxleByIds(TecDocPackageStructAxleByIdsRequest $_tecDocPackageStructAxleByIdsRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructAxleByIdsResponse(self::getSoapClient()->getAxleByIds(array('axleIds'=>$_tecDocPackageStructAxleByIdsRequest->getAxleIds(),'country'=>$_tecDocPackageStructAxleByIdsRequest->getCountry(),'lang'=>$_tecDocPackageStructAxleByIdsRequest->getLang(),'provider'=>$_tecDocPackageStructAxleByIdsRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getAxleByIdsStringList
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructAxleByIdsStringListRequest::getAxleIds()
	 * @uses TecDocPackageStructAxleByIdsStringListRequest::getCountry()
	 * @uses TecDocPackageStructAxleByIdsStringListRequest::getLang()
	 * @uses TecDocPackageStructAxleByIdsStringListRequest::getProvider()
	 * @param TecDocPackageStructAxleByIdsStringListRequest $_tecDocPackageStructAxleByIdsStringListRequest
	 * @return TecDocPackageStructAxleByIdsResponse
	 */
	public function getAxleByIdsStringList(TecDocPackageStructAxleByIdsStringListRequest $_tecDocPackageStructAxleByIdsStringListRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructAxleByIdsResponse(self::getSoapClient()->getAxleByIdsStringList(array('axleIds'=>$_tecDocPackageStructAxleByIdsStringListRequest->getAxleIds(),'country'=>$_tecDocPackageStructAxleByIdsStringListRequest->getCountry(),'lang'=>$_tecDocPackageStructAxleByIdsStringListRequest->getLang(),'provider'=>$_tecDocPackageStructAxleByIdsStringListRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getAxleByIds2
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructAxleByIds2Request::getAxleDetails2()
	 * @uses TecDocPackageStructAxleByIds2Request::getAxleIds()
	 * @uses TecDocPackageStructAxleByIds2Request::getBodyTypes()
	 * @uses TecDocPackageStructAxleByIds2Request::getCountry()
	 * @uses TecDocPackageStructAxleByIds2Request::getLang()
	 * @uses TecDocPackageStructAxleByIds2Request::getProvider()
	 * @uses TecDocPackageStructAxleByIds2Request::getWheelbases()
	 * @param TecDocPackageStructAxleByIds2Request $_tecDocPackageStructAxleByIds2Request
	 * @return TecDocPackageStructAxleByIds2Response
	 */
	public function getAxleByIds2(TecDocPackageStructAxleByIds2Request $_tecDocPackageStructAxleByIds2Request)
	{
		try
		{
			$this->setResult(new TecDocPackageStructAxleByIds2Response(self::getSoapClient()->getAxleByIds2(array('axleDetails2'=>$_tecDocPackageStructAxleByIds2Request->getAxleDetails2(),'axleIds'=>$_tecDocPackageStructAxleByIds2Request->getAxleIds(),'bodyTypes'=>$_tecDocPackageStructAxleByIds2Request->getBodyTypes(),'country'=>$_tecDocPackageStructAxleByIds2Request->getCountry(),'lang'=>$_tecDocPackageStructAxleByIds2Request->getLang(),'provider'=>$_tecDocPackageStructAxleByIds2Request->getProvider(),'wheelbases'=>$_tecDocPackageStructAxleByIds2Request->getWheelbases()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getAxleByIds2StringList
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructAxleByIds2StringListRequest::getAxleDetails2()
	 * @uses TecDocPackageStructAxleByIds2StringListRequest::getAxleIds()
	 * @uses TecDocPackageStructAxleByIds2StringListRequest::getBodyTypes()
	 * @uses TecDocPackageStructAxleByIds2StringListRequest::getCountry()
	 * @uses TecDocPackageStructAxleByIds2StringListRequest::getLang()
	 * @uses TecDocPackageStructAxleByIds2StringListRequest::getProvider()
	 * @uses TecDocPackageStructAxleByIds2StringListRequest::getWheelbases()
	 * @param TecDocPackageStructAxleByIds2StringListRequest $_tecDocPackageStructAxleByIds2StringListRequest
	 * @return TecDocPackageStructAxleByIds2Response
	 */
	public function getAxleByIds2StringList(TecDocPackageStructAxleByIds2StringListRequest $_tecDocPackageStructAxleByIds2StringListRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructAxleByIds2Response(self::getSoapClient()->getAxleByIds2StringList(array('axleDetails2'=>$_tecDocPackageStructAxleByIds2StringListRequest->getAxleDetails2(),'axleIds'=>$_tecDocPackageStructAxleByIds2StringListRequest->getAxleIds(),'bodyTypes'=>$_tecDocPackageStructAxleByIds2StringListRequest->getBodyTypes(),'country'=>$_tecDocPackageStructAxleByIds2StringListRequest->getCountry(),'lang'=>$_tecDocPackageStructAxleByIds2StringListRequest->getLang(),'provider'=>$_tecDocPackageStructAxleByIds2StringListRequest->getProvider(),'wheelbases'=>$_tecDocPackageStructAxleByIds2StringListRequest->getWheelbases()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getAxleByIds2Single
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructAxleByIds2SingleRequest::getAxleDetails2()
	 * @uses TecDocPackageStructAxleByIds2SingleRequest::getAxleIds()
	 * @uses TecDocPackageStructAxleByIds2SingleRequest::getBodyTypes()
	 * @uses TecDocPackageStructAxleByIds2SingleRequest::getCountry()
	 * @uses TecDocPackageStructAxleByIds2SingleRequest::getLang()
	 * @uses TecDocPackageStructAxleByIds2SingleRequest::getProvider()
	 * @uses TecDocPackageStructAxleByIds2SingleRequest::getWheelbases()
	 * @param TecDocPackageStructAxleByIds2SingleRequest $_tecDocPackageStructAxleByIds2SingleRequest
	 * @return TecDocPackageStructAxleByIds2Response
	 */
	public function getAxleByIds2Single(TecDocPackageStructAxleByIds2SingleRequest $_tecDocPackageStructAxleByIds2SingleRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructAxleByIds2Response(self::getSoapClient()->getAxleByIds2Single(array('axleDetails2'=>$_tecDocPackageStructAxleByIds2SingleRequest->getAxleDetails2(),'axleIds'=>$_tecDocPackageStructAxleByIds2SingleRequest->getAxleIds(),'bodyTypes'=>$_tecDocPackageStructAxleByIds2SingleRequest->getBodyTypes(),'country'=>$_tecDocPackageStructAxleByIds2SingleRequest->getCountry(),'lang'=>$_tecDocPackageStructAxleByIds2SingleRequest->getLang(),'provider'=>$_tecDocPackageStructAxleByIds2SingleRequest->getProvider(),'wheelbases'=>$_tecDocPackageStructAxleByIds2SingleRequest->getWheelbases()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getMotorManufacturers2
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructMotorManufacturers2Request::getCountry()
	 * @uses TecDocPackageStructMotorManufacturers2Request::getLang()
	 * @uses TecDocPackageStructMotorManufacturers2Request::getProvider()
	 * @param TecDocPackageStructMotorManufacturers2Request $_tecDocPackageStructMotorManufacturers2Request
	 * @return TecDocPackageStructMotorManufacturers2Response
	 */
	public function getMotorManufacturers2(TecDocPackageStructMotorManufacturers2Request $_tecDocPackageStructMotorManufacturers2Request)
	{
		try
		{
			$this->setResult(new TecDocPackageStructMotorManufacturers2Response(self::getSoapClient()->getMotorManufacturers2(array('country'=>$_tecDocPackageStructMotorManufacturers2Request->getCountry(),'lang'=>$_tecDocPackageStructMotorManufacturers2Request->getLang(),'provider'=>$_tecDocPackageStructMotorManufacturers2Request->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getMotorIdsByManuIdCriteria
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructMotorIdsByManuIdCriteriaRequest::getCarType()
	 * @uses TecDocPackageStructMotorIdsByManuIdCriteriaRequest::getCountry()
	 * @uses TecDocPackageStructMotorIdsByManuIdCriteriaRequest::getCylinderCapacityFrom()
	 * @uses TecDocPackageStructMotorIdsByManuIdCriteriaRequest::getCylinderCapacityTo()
	 * @uses TecDocPackageStructMotorIdsByManuIdCriteriaRequest::getFuelTypeId()
	 * @uses TecDocPackageStructMotorIdsByManuIdCriteriaRequest::getLang()
	 * @uses TecDocPackageStructMotorIdsByManuIdCriteriaRequest::getManuId()
	 * @uses TecDocPackageStructMotorIdsByManuIdCriteriaRequest::getMotorCode()
	 * @uses TecDocPackageStructMotorIdsByManuIdCriteriaRequest::getPowerFrom()
	 * @uses TecDocPackageStructMotorIdsByManuIdCriteriaRequest::getPowerHpType()
	 * @uses TecDocPackageStructMotorIdsByManuIdCriteriaRequest::getPowerTo()
	 * @uses TecDocPackageStructMotorIdsByManuIdCriteriaRequest::getProvider()
	 * @uses TecDocPackageStructMotorIdsByManuIdCriteriaRequest::getSellsTerm()
	 * @uses TecDocPackageStructMotorIdsByManuIdCriteriaRequest::getYearOfConstruction()
	 * @param TecDocPackageStructMotorIdsByManuIdCriteriaRequest $_tecDocPackageStructMotorIdsByManuIdCriteriaRequest
	 * @return TecDocPackageStructMotorIdsByManuIdCriteriaResponse
	 */
	public function getMotorIdsByManuIdCriteria(TecDocPackageStructMotorIdsByManuIdCriteriaRequest $_tecDocPackageStructMotorIdsByManuIdCriteriaRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructMotorIdsByManuIdCriteriaResponse(self::getSoapClient()->getMotorIdsByManuIdCriteria(array('carType'=>$_tecDocPackageStructMotorIdsByManuIdCriteriaRequest->getCarType(),'country'=>$_tecDocPackageStructMotorIdsByManuIdCriteriaRequest->getCountry(),'cylinderCapacityFrom'=>$_tecDocPackageStructMotorIdsByManuIdCriteriaRequest->getCylinderCapacityFrom(),'cylinderCapacityTo'=>$_tecDocPackageStructMotorIdsByManuIdCriteriaRequest->getCylinderCapacityTo(),'fuelTypeId'=>$_tecDocPackageStructMotorIdsByManuIdCriteriaRequest->getFuelTypeId(),'lang'=>$_tecDocPackageStructMotorIdsByManuIdCriteriaRequest->getLang(),'manuId'=>$_tecDocPackageStructMotorIdsByManuIdCriteriaRequest->getManuId(),'motorCode'=>$_tecDocPackageStructMotorIdsByManuIdCriteriaRequest->getMotorCode(),'powerFrom'=>$_tecDocPackageStructMotorIdsByManuIdCriteriaRequest->getPowerFrom(),'powerHpType'=>$_tecDocPackageStructMotorIdsByManuIdCriteriaRequest->getPowerHpType(),'powerTo'=>$_tecDocPackageStructMotorIdsByManuIdCriteriaRequest->getPowerTo(),'provider'=>$_tecDocPackageStructMotorIdsByManuIdCriteriaRequest->getProvider(),'sellsTerm'=>$_tecDocPackageStructMotorIdsByManuIdCriteriaRequest->getSellsTerm(),'yearOfConstruction'=>$_tecDocPackageStructMotorIdsByManuIdCriteriaRequest->getYearOfConstruction()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getMotorIdsByManuIdCriteria2
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructMotorIdsByManuIdCriteria2Request::getCarType()
	 * @uses TecDocPackageStructMotorIdsByManuIdCriteria2Request::getCountry()
	 * @uses TecDocPackageStructMotorIdsByManuIdCriteria2Request::getCylinderCapacityFrom()
	 * @uses TecDocPackageStructMotorIdsByManuIdCriteria2Request::getCylinderCapacityTo()
	 * @uses TecDocPackageStructMotorIdsByManuIdCriteria2Request::getFuelTypeId()
	 * @uses TecDocPackageStructMotorIdsByManuIdCriteria2Request::getLang()
	 * @uses TecDocPackageStructMotorIdsByManuIdCriteria2Request::getManuId()
	 * @uses TecDocPackageStructMotorIdsByManuIdCriteria2Request::getMotorCode()
	 * @uses TecDocPackageStructMotorIdsByManuIdCriteria2Request::getPowerFrom()
	 * @uses TecDocPackageStructMotorIdsByManuIdCriteria2Request::getPowerHpType()
	 * @uses TecDocPackageStructMotorIdsByManuIdCriteria2Request::getPowerTo()
	 * @uses TecDocPackageStructMotorIdsByManuIdCriteria2Request::getProvider()
	 * @uses TecDocPackageStructMotorIdsByManuIdCriteria2Request::getSearchExactCode()
	 * @uses TecDocPackageStructMotorIdsByManuIdCriteria2Request::getSearchExactTerm()
	 * @uses TecDocPackageStructMotorIdsByManuIdCriteria2Request::getSellsTerm()
	 * @uses TecDocPackageStructMotorIdsByManuIdCriteria2Request::getYearOfConstruction()
	 * @param TecDocPackageStructMotorIdsByManuIdCriteria2Request $_tecDocPackageStructMotorIdsByManuIdCriteria2Request
	 * @return TecDocPackageStructMotorIdsByManuIdCriteria2Response
	 */
	public function getMotorIdsByManuIdCriteria2(TecDocPackageStructMotorIdsByManuIdCriteria2Request $_tecDocPackageStructMotorIdsByManuIdCriteria2Request)
	{
		try
		{
			$this->setResult(new TecDocPackageStructMotorIdsByManuIdCriteria2Response(self::getSoapClient()->getMotorIdsByManuIdCriteria2(array('carType'=>$_tecDocPackageStructMotorIdsByManuIdCriteria2Request->getCarType(),'country'=>$_tecDocPackageStructMotorIdsByManuIdCriteria2Request->getCountry(),'cylinderCapacityFrom'=>$_tecDocPackageStructMotorIdsByManuIdCriteria2Request->getCylinderCapacityFrom(),'cylinderCapacityTo'=>$_tecDocPackageStructMotorIdsByManuIdCriteria2Request->getCylinderCapacityTo(),'fuelTypeId'=>$_tecDocPackageStructMotorIdsByManuIdCriteria2Request->getFuelTypeId(),'lang'=>$_tecDocPackageStructMotorIdsByManuIdCriteria2Request->getLang(),'manuId'=>$_tecDocPackageStructMotorIdsByManuIdCriteria2Request->getManuId(),'motorCode'=>$_tecDocPackageStructMotorIdsByManuIdCriteria2Request->getMotorCode(),'powerFrom'=>$_tecDocPackageStructMotorIdsByManuIdCriteria2Request->getPowerFrom(),'powerHpType'=>$_tecDocPackageStructMotorIdsByManuIdCriteria2Request->getPowerHpType(),'powerTo'=>$_tecDocPackageStructMotorIdsByManuIdCriteria2Request->getPowerTo(),'provider'=>$_tecDocPackageStructMotorIdsByManuIdCriteria2Request->getProvider(),'searchExactCode'=>$_tecDocPackageStructMotorIdsByManuIdCriteria2Request->getSearchExactCode(),'searchExactTerm'=>$_tecDocPackageStructMotorIdsByManuIdCriteria2Request->getSearchExactTerm(),'sellsTerm'=>$_tecDocPackageStructMotorIdsByManuIdCriteria2Request->getSellsTerm(),'yearOfConstruction'=>$_tecDocPackageStructMotorIdsByManuIdCriteria2Request->getYearOfConstruction()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getMotorsByCarTypeManuIdTerm
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructMotorsByCarTypeManuIdTermRequest::getCarType()
	 * @uses TecDocPackageStructMotorsByCarTypeManuIdTermRequest::getCountriesCarSelection()
	 * @uses TecDocPackageStructMotorsByCarTypeManuIdTermRequest::getCountryGroupFlag()
	 * @uses TecDocPackageStructMotorsByCarTypeManuIdTermRequest::getLang()
	 * @uses TecDocPackageStructMotorsByCarTypeManuIdTermRequest::getManuId()
	 * @uses TecDocPackageStructMotorsByCarTypeManuIdTermRequest::getMotorCode()
	 * @uses TecDocPackageStructMotorsByCarTypeManuIdTermRequest::getProvider()
	 * @param TecDocPackageStructMotorsByCarTypeManuIdTermRequest $_tecDocPackageStructMotorsByCarTypeManuIdTermRequest
	 * @return TecDocPackageStructMotorsByCarTypeManuIdTermResponse
	 */
	public function getMotorsByCarTypeManuIdTerm(TecDocPackageStructMotorsByCarTypeManuIdTermRequest $_tecDocPackageStructMotorsByCarTypeManuIdTermRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructMotorsByCarTypeManuIdTermResponse(self::getSoapClient()->getMotorsByCarTypeManuIdTerm(array('carType'=>$_tecDocPackageStructMotorsByCarTypeManuIdTermRequest->getCarType(),'countriesCarSelection'=>$_tecDocPackageStructMotorsByCarTypeManuIdTermRequest->getCountriesCarSelection(),'countryGroupFlag'=>$_tecDocPackageStructMotorsByCarTypeManuIdTermRequest->getCountryGroupFlag(),'lang'=>$_tecDocPackageStructMotorsByCarTypeManuIdTermRequest->getLang(),'manuId'=>$_tecDocPackageStructMotorsByCarTypeManuIdTermRequest->getManuId(),'motorCode'=>$_tecDocPackageStructMotorsByCarTypeManuIdTermRequest->getMotorCode(),'provider'=>$_tecDocPackageStructMotorsByCarTypeManuIdTermRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getMotorsByCarTypeManuIdTerm2
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructMotorsByCarTypeManuIdTerm2Request::getCarType()
	 * @uses TecDocPackageStructMotorsByCarTypeManuIdTerm2Request::getCountriesCarSelection()
	 * @uses TecDocPackageStructMotorsByCarTypeManuIdTerm2Request::getCountryGroupFlag()
	 * @uses TecDocPackageStructMotorsByCarTypeManuIdTerm2Request::getLang()
	 * @uses TecDocPackageStructMotorsByCarTypeManuIdTerm2Request::getManuId()
	 * @uses TecDocPackageStructMotorsByCarTypeManuIdTerm2Request::getMotorCode()
	 * @uses TecDocPackageStructMotorsByCarTypeManuIdTerm2Request::getProvider()
	 * @uses TecDocPackageStructMotorsByCarTypeManuIdTerm2Request::getSearchExact()
	 * @param TecDocPackageStructMotorsByCarTypeManuIdTerm2Request $_tecDocPackageStructMotorsByCarTypeManuIdTerm2Request
	 * @return TecDocPackageStructMotorsByCarTypeManuIdTerm2Response
	 */
	public function getMotorsByCarTypeManuIdTerm2(TecDocPackageStructMotorsByCarTypeManuIdTerm2Request $_tecDocPackageStructMotorsByCarTypeManuIdTerm2Request)
	{
		try
		{
			$this->setResult(new TecDocPackageStructMotorsByCarTypeManuIdTerm2Response(self::getSoapClient()->getMotorsByCarTypeManuIdTerm2(array('carType'=>$_tecDocPackageStructMotorsByCarTypeManuIdTerm2Request->getCarType(),'countriesCarSelection'=>$_tecDocPackageStructMotorsByCarTypeManuIdTerm2Request->getCountriesCarSelection(),'countryGroupFlag'=>$_tecDocPackageStructMotorsByCarTypeManuIdTerm2Request->getCountryGroupFlag(),'lang'=>$_tecDocPackageStructMotorsByCarTypeManuIdTerm2Request->getLang(),'manuId'=>$_tecDocPackageStructMotorsByCarTypeManuIdTerm2Request->getManuId(),'motorCode'=>$_tecDocPackageStructMotorsByCarTypeManuIdTerm2Request->getMotorCode(),'provider'=>$_tecDocPackageStructMotorsByCarTypeManuIdTerm2Request->getProvider(),'searchExact'=>$_tecDocPackageStructMotorsByCarTypeManuIdTerm2Request->getSearchExact()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getEngineIdsByTecDocEngineNo
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructEngineIdsByTecDocEngineNoRequest::getCountry()
	 * @uses TecDocPackageStructEngineIdsByTecDocEngineNoRequest::getMotorNumber()
	 * @uses TecDocPackageStructEngineIdsByTecDocEngineNoRequest::getProvider()
	 * @param TecDocPackageStructEngineIdsByTecDocEngineNoRequest $_tecDocPackageStructEngineIdsByTecDocEngineNoRequest
	 * @return TecDocPackageStructEngineIdsByTecDocEngineNoResponse
	 */
	public function getEngineIdsByTecDocEngineNo(TecDocPackageStructEngineIdsByTecDocEngineNoRequest $_tecDocPackageStructEngineIdsByTecDocEngineNoRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructEngineIdsByTecDocEngineNoResponse(self::getSoapClient()->getEngineIdsByTecDocEngineNo(array('country'=>$_tecDocPackageStructEngineIdsByTecDocEngineNoRequest->getCountry(),'motorNumber'=>$_tecDocPackageStructEngineIdsByTecDocEngineNoRequest->getMotorNumber(),'provider'=>$_tecDocPackageStructEngineIdsByTecDocEngineNoRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getMotorByIds
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructMotorByIdsRequest::getCountry()
	 * @uses TecDocPackageStructMotorByIdsRequest::getLang()
	 * @uses TecDocPackageStructMotorByIdsRequest::getMotorIds()
	 * @uses TecDocPackageStructMotorByIdsRequest::getProvider()
	 * @param TecDocPackageStructMotorByIdsRequest $_tecDocPackageStructMotorByIdsRequest
	 * @return TecDocPackageStructMotorByIdsResponse
	 */
	public function getMotorByIds(TecDocPackageStructMotorByIdsRequest $_tecDocPackageStructMotorByIdsRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructMotorByIdsResponse(self::getSoapClient()->getMotorByIds(array('country'=>$_tecDocPackageStructMotorByIdsRequest->getCountry(),'lang'=>$_tecDocPackageStructMotorByIdsRequest->getLang(),'motorIds'=>$_tecDocPackageStructMotorByIdsRequest->getMotorIds(),'provider'=>$_tecDocPackageStructMotorByIdsRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getMotorByIdsStringList
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructMotorByIdsStringListRequest::getCountry()
	 * @uses TecDocPackageStructMotorByIdsStringListRequest::getLang()
	 * @uses TecDocPackageStructMotorByIdsStringListRequest::getMotorIds()
	 * @uses TecDocPackageStructMotorByIdsStringListRequest::getProvider()
	 * @param TecDocPackageStructMotorByIdsStringListRequest $_tecDocPackageStructMotorByIdsStringListRequest
	 * @return TecDocPackageStructMotorByIdsResponse
	 */
	public function getMotorByIdsStringList(TecDocPackageStructMotorByIdsStringListRequest $_tecDocPackageStructMotorByIdsStringListRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructMotorByIdsResponse(self::getSoapClient()->getMotorByIdsStringList(array('country'=>$_tecDocPackageStructMotorByIdsStringListRequest->getCountry(),'lang'=>$_tecDocPackageStructMotorByIdsStringListRequest->getLang(),'motorIds'=>$_tecDocPackageStructMotorByIdsStringListRequest->getMotorIds(),'provider'=>$_tecDocPackageStructMotorByIdsStringListRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getMotorByIds2
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructMotorByIds2Request::getCountry()
	 * @uses TecDocPackageStructMotorByIds2Request::getLang()
	 * @uses TecDocPackageStructMotorByIds2Request::getMotorDetails2()
	 * @uses TecDocPackageStructMotorByIds2Request::getMotorIds()
	 * @uses TecDocPackageStructMotorByIds2Request::getProvider()
	 * @param TecDocPackageStructMotorByIds2Request $_tecDocPackageStructMotorByIds2Request
	 * @return TecDocPackageStructMotorByIds2Response
	 */
	public function getMotorByIds2(TecDocPackageStructMotorByIds2Request $_tecDocPackageStructMotorByIds2Request)
	{
		try
		{
			$this->setResult(new TecDocPackageStructMotorByIds2Response(self::getSoapClient()->getMotorByIds2(array('country'=>$_tecDocPackageStructMotorByIds2Request->getCountry(),'lang'=>$_tecDocPackageStructMotorByIds2Request->getLang(),'motorDetails2'=>$_tecDocPackageStructMotorByIds2Request->getMotorDetails2(),'motorIds'=>$_tecDocPackageStructMotorByIds2Request->getMotorIds(),'provider'=>$_tecDocPackageStructMotorByIds2Request->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getMotorByIds2StringList
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructMotorByIds2StringListRequest::getCountry()
	 * @uses TecDocPackageStructMotorByIds2StringListRequest::getLang()
	 * @uses TecDocPackageStructMotorByIds2StringListRequest::getMotorDetails2()
	 * @uses TecDocPackageStructMotorByIds2StringListRequest::getMotorIds()
	 * @uses TecDocPackageStructMotorByIds2StringListRequest::getProvider()
	 * @param TecDocPackageStructMotorByIds2StringListRequest $_tecDocPackageStructMotorByIds2StringListRequest
	 * @return TecDocPackageStructMotorByIds2Response
	 */
	public function getMotorByIds2StringList(TecDocPackageStructMotorByIds2StringListRequest $_tecDocPackageStructMotorByIds2StringListRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructMotorByIds2Response(self::getSoapClient()->getMotorByIds2StringList(array('country'=>$_tecDocPackageStructMotorByIds2StringListRequest->getCountry(),'lang'=>$_tecDocPackageStructMotorByIds2StringListRequest->getLang(),'motorDetails2'=>$_tecDocPackageStructMotorByIds2StringListRequest->getMotorDetails2(),'motorIds'=>$_tecDocPackageStructMotorByIds2StringListRequest->getMotorIds(),'provider'=>$_tecDocPackageStructMotorByIds2StringListRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getMotorByIds2Single
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructMotorByIds2SingleRequest::getCountry()
	 * @uses TecDocPackageStructMotorByIds2SingleRequest::getLang()
	 * @uses TecDocPackageStructMotorByIds2SingleRequest::getMotorDetails2()
	 * @uses TecDocPackageStructMotorByIds2SingleRequest::getMotorIds()
	 * @uses TecDocPackageStructMotorByIds2SingleRequest::getProvider()
	 * @param TecDocPackageStructMotorByIds2SingleRequest $_tecDocPackageStructMotorByIds2SingleRequest
	 * @return TecDocPackageStructMotorByIds2Response
	 */
	public function getMotorByIds2Single(TecDocPackageStructMotorByIds2SingleRequest $_tecDocPackageStructMotorByIds2SingleRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructMotorByIds2Response(self::getSoapClient()->getMotorByIds2Single(array('country'=>$_tecDocPackageStructMotorByIds2SingleRequest->getCountry(),'lang'=>$_tecDocPackageStructMotorByIds2SingleRequest->getLang(),'motorDetails2'=>$_tecDocPackageStructMotorByIds2SingleRequest->getMotorDetails2(),'motorIds'=>$_tecDocPackageStructMotorByIds2SingleRequest->getMotorIds(),'provider'=>$_tecDocPackageStructMotorByIds2SingleRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getVendorIds
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructVendorIdsRequest::getCarType()
	 * @uses TecDocPackageStructVendorIdsRequest::getCountriesCarSelection()
	 * @uses TecDocPackageStructVendorIdsRequest::getCountryGroupFlag()
	 * @uses TecDocPackageStructVendorIdsRequest::getCountryUserSetting()
	 * @uses TecDocPackageStructVendorIdsRequest::getLang()
	 * @uses TecDocPackageStructVendorIdsRequest::getProvider()
	 * @uses TecDocPackageStructVendorIdsRequest::getSearchExact()
	 * @uses TecDocPackageStructVendorIdsRequest::getSearchPattern()
	 * @param TecDocPackageStructVendorIdsRequest $_tecDocPackageStructVendorIdsRequest
	 * @return TecDocPackageStructVendorIdsResponse
	 */
	public function getVendorIds(TecDocPackageStructVendorIdsRequest $_tecDocPackageStructVendorIdsRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructVendorIdsResponse(self::getSoapClient()->getVendorIds(array('carType'=>$_tecDocPackageStructVendorIdsRequest->getCarType(),'countriesCarSelection'=>$_tecDocPackageStructVendorIdsRequest->getCountriesCarSelection(),'countryGroupFlag'=>$_tecDocPackageStructVendorIdsRequest->getCountryGroupFlag(),'countryUserSetting'=>$_tecDocPackageStructVendorIdsRequest->getCountryUserSetting(),'lang'=>$_tecDocPackageStructVendorIdsRequest->getLang(),'provider'=>$_tecDocPackageStructVendorIdsRequest->getProvider(),'searchExact'=>$_tecDocPackageStructVendorIdsRequest->getSearchExact(),'searchPattern'=>$_tecDocPackageStructVendorIdsRequest->getSearchPattern()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getVendorIds2
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructVendorIds2Request::getCarType()
	 * @uses TecDocPackageStructVendorIds2Request::getCountriesCarSelection()
	 * @uses TecDocPackageStructVendorIds2Request::getCountryGroupFlag()
	 * @uses TecDocPackageStructVendorIds2Request::getCountryUserSetting()
	 * @uses TecDocPackageStructVendorIds2Request::getLang()
	 * @uses TecDocPackageStructVendorIds2Request::getProvider()
	 * @uses TecDocPackageStructVendorIds2Request::getSearchExact()
	 * @uses TecDocPackageStructVendorIds2Request::getSearchPattern()
	 * @param TecDocPackageStructVendorIds2Request $_tecDocPackageStructVendorIds2Request
	 * @return TecDocPackageStructVendorIds2Response
	 */
	public function getVendorIds2(TecDocPackageStructVendorIds2Request $_tecDocPackageStructVendorIds2Request)
	{
		try
		{
			$this->setResult(new TecDocPackageStructVendorIds2Response(self::getSoapClient()->getVendorIds2(array('carType'=>$_tecDocPackageStructVendorIds2Request->getCarType(),'countriesCarSelection'=>$_tecDocPackageStructVendorIds2Request->getCountriesCarSelection(),'countryGroupFlag'=>$_tecDocPackageStructVendorIds2Request->getCountryGroupFlag(),'countryUserSetting'=>$_tecDocPackageStructVendorIds2Request->getCountryUserSetting(),'lang'=>$_tecDocPackageStructVendorIds2Request->getLang(),'provider'=>$_tecDocPackageStructVendorIds2Request->getProvider(),'searchExact'=>$_tecDocPackageStructVendorIds2Request->getSearchExact(),'searchPattern'=>$_tecDocPackageStructVendorIds2Request->getSearchPattern()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getMarkById
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructMarkByIdRequest::getCountry()
	 * @uses TecDocPackageStructMarkByIdRequest::getLang()
	 * @uses TecDocPackageStructMarkByIdRequest::getLinked()
	 * @uses TecDocPackageStructMarkByIdRequest::getMarkId()
	 * @uses TecDocPackageStructMarkByIdRequest::getProvider()
	 * @param TecDocPackageStructMarkByIdRequest $_tecDocPackageStructMarkByIdRequest
	 * @return TecDocPackageStructMarkByIdResponse
	 */
	public function getMarkById(TecDocPackageStructMarkByIdRequest $_tecDocPackageStructMarkByIdRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructMarkByIdResponse(self::getSoapClient()->getMarkById(array('country'=>$_tecDocPackageStructMarkByIdRequest->getCountry(),'lang'=>$_tecDocPackageStructMarkByIdRequest->getLang(),'linked'=>$_tecDocPackageStructMarkByIdRequest->getLinked(),'markId'=>$_tecDocPackageStructMarkByIdRequest->getMarkId(),'provider'=>$_tecDocPackageStructMarkByIdRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getShortCuts2
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructShortCuts2Request::getLang()
	 * @uses TecDocPackageStructShortCuts2Request::getLinkingTargetType()
	 * @uses TecDocPackageStructShortCuts2Request::getProvider()
	 * @param TecDocPackageStructShortCuts2Request $_tecDocPackageStructShortCuts2Request
	 * @return TecDocPackageStructShortCuts2Response
	 */
	public function getShortCuts2(TecDocPackageStructShortCuts2Request $_tecDocPackageStructShortCuts2Request)
	{
		try
		{
			$this->setResult(new TecDocPackageStructShortCuts2Response(self::getSoapClient()->getShortCuts2(array('lang'=>$_tecDocPackageStructShortCuts2Request->getLang(),'linkingTargetType'=>$_tecDocPackageStructShortCuts2Request->getLinkingTargetType(),'provider'=>$_tecDocPackageStructShortCuts2Request->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getLinkedShortCuts
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructLinkedShortCutsRequest::getCountry()
	 * @uses TecDocPackageStructLinkedShortCutsRequest::getLang()
	 * @uses TecDocPackageStructLinkedShortCutsRequest::getLinkingTargetId()
	 * @uses TecDocPackageStructLinkedShortCutsRequest::getLinkingTargetType()
	 * @uses TecDocPackageStructLinkedShortCutsRequest::getProvider()
	 * @param TecDocPackageStructLinkedShortCutsRequest $_tecDocPackageStructLinkedShortCutsRequest
	 * @return TecDocPackageStructShortCuts2Response
	 */
	public function getLinkedShortCuts(TecDocPackageStructLinkedShortCutsRequest $_tecDocPackageStructLinkedShortCutsRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructShortCuts2Response(self::getSoapClient()->getLinkedShortCuts(array('country'=>$_tecDocPackageStructLinkedShortCutsRequest->getCountry(),'lang'=>$_tecDocPackageStructLinkedShortCutsRequest->getLang(),'linkingTargetId'=>$_tecDocPackageStructLinkedShortCutsRequest->getLinkingTargetId(),'linkingTargetType'=>$_tecDocPackageStructLinkedShortCutsRequest->getLinkingTargetType(),'provider'=>$_tecDocPackageStructLinkedShortCutsRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getChildNodesAllLinkingTarget2
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructChildNodesAllLinkingTarget2Request::getChildNodes()
	 * @uses TecDocPackageStructChildNodesAllLinkingTarget2Request::getLang()
	 * @uses TecDocPackageStructChildNodesAllLinkingTarget2Request::getLinkingTargetType()
	 * @uses TecDocPackageStructChildNodesAllLinkingTarget2Request::getParentNodeId()
	 * @uses TecDocPackageStructChildNodesAllLinkingTarget2Request::getProvider()
	 * @param TecDocPackageStructChildNodesAllLinkingTarget2Request $_tecDocPackageStructChildNodesAllLinkingTarget2Request
	 * @return TecDocPackageStructChildNodesAllLinkingTarget2Response
	 */
	public function getChildNodesAllLinkingTarget2(TecDocPackageStructChildNodesAllLinkingTarget2Request $_tecDocPackageStructChildNodesAllLinkingTarget2Request)
	{
		try
		{
			$this->setResult(new TecDocPackageStructChildNodesAllLinkingTarget2Response(self::getSoapClient()->getChildNodesAllLinkingTarget2(array('childNodes'=>$_tecDocPackageStructChildNodesAllLinkingTarget2Request->getChildNodes(),'lang'=>$_tecDocPackageStructChildNodesAllLinkingTarget2Request->getLang(),'linkingTargetType'=>$_tecDocPackageStructChildNodesAllLinkingTarget2Request->getLinkingTargetType(),'parentNodeId'=>$_tecDocPackageStructChildNodesAllLinkingTarget2Request->getParentNodeId(),'provider'=>$_tecDocPackageStructChildNodesAllLinkingTarget2Request->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getLinkedChildNodesAllLinkingTarget
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructLinkedChildNodesAllLinkingTargetRequest::getChildNodes()
	 * @uses TecDocPackageStructLinkedChildNodesAllLinkingTargetRequest::getCountry()
	 * @uses TecDocPackageStructLinkedChildNodesAllLinkingTargetRequest::getLang()
	 * @uses TecDocPackageStructLinkedChildNodesAllLinkingTargetRequest::getLinkingTargetId()
	 * @uses TecDocPackageStructLinkedChildNodesAllLinkingTargetRequest::getLinkingTargetType()
	 * @uses TecDocPackageStructLinkedChildNodesAllLinkingTargetRequest::getParentNodeId()
	 * @uses TecDocPackageStructLinkedChildNodesAllLinkingTargetRequest::getProvider()
	 * @param TecDocPackageStructLinkedChildNodesAllLinkingTargetRequest $_tecDocPackageStructLinkedChildNodesAllLinkingTargetRequest
	 * @return TecDocPackageStructChildNodesAllLinkingTarget2Response
	 */
	public function getLinkedChildNodesAllLinkingTarget(TecDocPackageStructLinkedChildNodesAllLinkingTargetRequest $_tecDocPackageStructLinkedChildNodesAllLinkingTargetRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructChildNodesAllLinkingTarget2Response(self::getSoapClient()->getLinkedChildNodesAllLinkingTarget(array('childNodes'=>$_tecDocPackageStructLinkedChildNodesAllLinkingTargetRequest->getChildNodes(),'country'=>$_tecDocPackageStructLinkedChildNodesAllLinkingTargetRequest->getCountry(),'lang'=>$_tecDocPackageStructLinkedChildNodesAllLinkingTargetRequest->getLang(),'linkingTargetId'=>$_tecDocPackageStructLinkedChildNodesAllLinkingTargetRequest->getLinkingTargetId(),'linkingTargetType'=>$_tecDocPackageStructLinkedChildNodesAllLinkingTargetRequest->getLinkingTargetType(),'parentNodeId'=>$_tecDocPackageStructLinkedChildNodesAllLinkingTargetRequest->getParentNodeId(),'provider'=>$_tecDocPackageStructLinkedChildNodesAllLinkingTargetRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getChildNodesAllLinkingTargetShortCut2
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructChildNodesAllLinkingTargetShortCut2Request::getChildNodes()
	 * @uses TecDocPackageStructChildNodesAllLinkingTargetShortCut2Request::getLang()
	 * @uses TecDocPackageStructChildNodesAllLinkingTargetShortCut2Request::getLinkingTargetType()
	 * @uses TecDocPackageStructChildNodesAllLinkingTargetShortCut2Request::getParentNodeId()
	 * @uses TecDocPackageStructChildNodesAllLinkingTargetShortCut2Request::getProvider()
	 * @uses TecDocPackageStructChildNodesAllLinkingTargetShortCut2Request::getShortCutId()
	 * @param TecDocPackageStructChildNodesAllLinkingTargetShortCut2Request $_tecDocPackageStructChildNodesAllLinkingTargetShortCut2Request
	 * @return TecDocPackageStructChildNodesAllLinkingTargetShortCut2Response
	 */
	public function getChildNodesAllLinkingTargetShortCut2(TecDocPackageStructChildNodesAllLinkingTargetShortCut2Request $_tecDocPackageStructChildNodesAllLinkingTargetShortCut2Request)
	{
		try
		{
			$this->setResult(new TecDocPackageStructChildNodesAllLinkingTargetShortCut2Response(self::getSoapClient()->getChildNodesAllLinkingTargetShortCut2(array('childNodes'=>$_tecDocPackageStructChildNodesAllLinkingTargetShortCut2Request->getChildNodes(),'lang'=>$_tecDocPackageStructChildNodesAllLinkingTargetShortCut2Request->getLang(),'linkingTargetType'=>$_tecDocPackageStructChildNodesAllLinkingTargetShortCut2Request->getLinkingTargetType(),'parentNodeId'=>$_tecDocPackageStructChildNodesAllLinkingTargetShortCut2Request->getParentNodeId(),'provider'=>$_tecDocPackageStructChildNodesAllLinkingTargetShortCut2Request->getProvider(),'shortCutId'=>$_tecDocPackageStructChildNodesAllLinkingTargetShortCut2Request->getShortCutId()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getLinkedChildNodesAllLinkingTargetShortCut
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructLinkedChildNodesAllLinkingTargetShortCutRequest::getChildNodes()
	 * @uses TecDocPackageStructLinkedChildNodesAllLinkingTargetShortCutRequest::getCountry()
	 * @uses TecDocPackageStructLinkedChildNodesAllLinkingTargetShortCutRequest::getLang()
	 * @uses TecDocPackageStructLinkedChildNodesAllLinkingTargetShortCutRequest::getLinkingTargetId()
	 * @uses TecDocPackageStructLinkedChildNodesAllLinkingTargetShortCutRequest::getLinkingTargetType()
	 * @uses TecDocPackageStructLinkedChildNodesAllLinkingTargetShortCutRequest::getParentNodeId()
	 * @uses TecDocPackageStructLinkedChildNodesAllLinkingTargetShortCutRequest::getProvider()
	 * @uses TecDocPackageStructLinkedChildNodesAllLinkingTargetShortCutRequest::getShortCutId()
	 * @param TecDocPackageStructLinkedChildNodesAllLinkingTargetShortCutRequest $_tecDocPackageStructLinkedChildNodesAllLinkingTargetShortCutRequest
	 * @return TecDocPackageStructChildNodesAllLinkingTargetShortCut2Response
	 */
	public function getLinkedChildNodesAllLinkingTargetShortCut(TecDocPackageStructLinkedChildNodesAllLinkingTargetShortCutRequest $_tecDocPackageStructLinkedChildNodesAllLinkingTargetShortCutRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructChildNodesAllLinkingTargetShortCut2Response(self::getSoapClient()->getLinkedChildNodesAllLinkingTargetShortCut(array('childNodes'=>$_tecDocPackageStructLinkedChildNodesAllLinkingTargetShortCutRequest->getChildNodes(),'country'=>$_tecDocPackageStructLinkedChildNodesAllLinkingTargetShortCutRequest->getCountry(),'lang'=>$_tecDocPackageStructLinkedChildNodesAllLinkingTargetShortCutRequest->getLang(),'linkingTargetId'=>$_tecDocPackageStructLinkedChildNodesAllLinkingTargetShortCutRequest->getLinkingTargetId(),'linkingTargetType'=>$_tecDocPackageStructLinkedChildNodesAllLinkingTargetShortCutRequest->getLinkingTargetType(),'parentNodeId'=>$_tecDocPackageStructLinkedChildNodesAllLinkingTargetShortCutRequest->getParentNodeId(),'provider'=>$_tecDocPackageStructLinkedChildNodesAllLinkingTargetShortCutRequest->getProvider(),'shortCutId'=>$_tecDocPackageStructLinkedChildNodesAllLinkingTargetShortCutRequest->getShortCutId()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getChildNodesPattern
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructChildNodesPatternRequest::getCountry()
	 * @uses TecDocPackageStructChildNodesPatternRequest::getLang()
	 * @uses TecDocPackageStructChildNodesPatternRequest::getLinkingTargetId()
	 * @uses TecDocPackageStructChildNodesPatternRequest::getLinkingTargetType()
	 * @uses TecDocPackageStructChildNodesPatternRequest::getProvider()
	 * @uses TecDocPackageStructChildNodesPatternRequest::getSearchPattern()
	 * @param TecDocPackageStructChildNodesPatternRequest $_tecDocPackageStructChildNodesPatternRequest
	 * @return TecDocPackageStructChildNodesPatternResponse
	 */
	public function getChildNodesPattern(TecDocPackageStructChildNodesPatternRequest $_tecDocPackageStructChildNodesPatternRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructChildNodesPatternResponse(self::getSoapClient()->getChildNodesPattern(array('country'=>$_tecDocPackageStructChildNodesPatternRequest->getCountry(),'lang'=>$_tecDocPackageStructChildNodesPatternRequest->getLang(),'linkingTargetId'=>$_tecDocPackageStructChildNodesPatternRequest->getLinkingTargetId(),'linkingTargetType'=>$_tecDocPackageStructChildNodesPatternRequest->getLinkingTargetType(),'provider'=>$_tecDocPackageStructChildNodesPatternRequest->getProvider(),'searchPattern'=>$_tecDocPackageStructChildNodesPatternRequest->getSearchPattern()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getGenericArticlesByManufacturer4
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer4Request::getAssemblyGroupNodeId()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer4Request::getBrandNo()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer4Request::getCountry()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer4Request::getGenericArticleId()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer4Request::getLang()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer4Request::getLinkingTargetId()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer4Request::getLinkingTargetType()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer4Request::getProvider()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer4Request::getResultMode()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer4Request::getSortMode()
	 * @param TecDocPackageStructGenericArticlesByManufacturer4Request $_tecDocPackageStructGenericArticlesByManufacturer4Request
	 * @return TecDocPackageStructGenericArticlesByManufacturer4Response
	 */
	public function getGenericArticlesByManufacturer4(TecDocPackageStructGenericArticlesByManufacturer4Request $_tecDocPackageStructGenericArticlesByManufacturer4Request)
	{
		try
		{
			$this->setResult(new TecDocPackageStructGenericArticlesByManufacturer4Response(self::getSoapClient()->getGenericArticlesByManufacturer4(array('assemblyGroupNodeId'=>$_tecDocPackageStructGenericArticlesByManufacturer4Request->getAssemblyGroupNodeId(),'brandNo'=>$_tecDocPackageStructGenericArticlesByManufacturer4Request->getBrandNo(),'country'=>$_tecDocPackageStructGenericArticlesByManufacturer4Request->getCountry(),'genericArticleId'=>$_tecDocPackageStructGenericArticlesByManufacturer4Request->getGenericArticleId(),'lang'=>$_tecDocPackageStructGenericArticlesByManufacturer4Request->getLang(),'linkingTargetId'=>$_tecDocPackageStructGenericArticlesByManufacturer4Request->getLinkingTargetId(),'linkingTargetType'=>$_tecDocPackageStructGenericArticlesByManufacturer4Request->getLinkingTargetType(),'provider'=>$_tecDocPackageStructGenericArticlesByManufacturer4Request->getProvider(),'resultMode'=>$_tecDocPackageStructGenericArticlesByManufacturer4Request->getResultMode(),'sortMode'=>$_tecDocPackageStructGenericArticlesByManufacturer4Request->getSortMode()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getGenericArticlesByManufacturer4StringList
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer4StringListRequest::getAssemblyGroupNodeId()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer4StringListRequest::getBrandNo()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer4StringListRequest::getCountry()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer4StringListRequest::getGenericArticleId()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer4StringListRequest::getLang()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer4StringListRequest::getLinkingTargetId()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer4StringListRequest::getLinkingTargetType()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer4StringListRequest::getProvider()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer4StringListRequest::getResultMode()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer4StringListRequest::getSortMode()
	 * @param TecDocPackageStructGenericArticlesByManufacturer4StringListRequest $_tecDocPackageStructGenericArticlesByManufacturer4StringListRequest
	 * @return TecDocPackageStructGenericArticlesByManufacturer4Response
	 */
	public function getGenericArticlesByManufacturer4StringList(TecDocPackageStructGenericArticlesByManufacturer4StringListRequest $_tecDocPackageStructGenericArticlesByManufacturer4StringListRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructGenericArticlesByManufacturer4Response(self::getSoapClient()->getGenericArticlesByManufacturer4StringList(array('assemblyGroupNodeId'=>$_tecDocPackageStructGenericArticlesByManufacturer4StringListRequest->getAssemblyGroupNodeId(),'brandNo'=>$_tecDocPackageStructGenericArticlesByManufacturer4StringListRequest->getBrandNo(),'country'=>$_tecDocPackageStructGenericArticlesByManufacturer4StringListRequest->getCountry(),'genericArticleId'=>$_tecDocPackageStructGenericArticlesByManufacturer4StringListRequest->getGenericArticleId(),'lang'=>$_tecDocPackageStructGenericArticlesByManufacturer4StringListRequest->getLang(),'linkingTargetId'=>$_tecDocPackageStructGenericArticlesByManufacturer4StringListRequest->getLinkingTargetId(),'linkingTargetType'=>$_tecDocPackageStructGenericArticlesByManufacturer4StringListRequest->getLinkingTargetType(),'provider'=>$_tecDocPackageStructGenericArticlesByManufacturer4StringListRequest->getProvider(),'resultMode'=>$_tecDocPackageStructGenericArticlesByManufacturer4StringListRequest->getResultMode(),'sortMode'=>$_tecDocPackageStructGenericArticlesByManufacturer4StringListRequest->getSortMode()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getGenericArticlesByManufacturer4Single
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer4SingleRequest::getAssemblyGroupNodeId()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer4SingleRequest::getBrandNo()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer4SingleRequest::getCountry()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer4SingleRequest::getGenericArticleId()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer4SingleRequest::getLang()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer4SingleRequest::getLinkingTargetId()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer4SingleRequest::getLinkingTargetType()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer4SingleRequest::getProvider()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer4SingleRequest::getResultMode()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer4SingleRequest::getSortMode()
	 * @param TecDocPackageStructGenericArticlesByManufacturer4SingleRequest $_tecDocPackageStructGenericArticlesByManufacturer4SingleRequest
	 * @return TecDocPackageStructGenericArticlesByManufacturer4Response
	 */
	public function getGenericArticlesByManufacturer4Single(TecDocPackageStructGenericArticlesByManufacturer4SingleRequest $_tecDocPackageStructGenericArticlesByManufacturer4SingleRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructGenericArticlesByManufacturer4Response(self::getSoapClient()->getGenericArticlesByManufacturer4Single(array('assemblyGroupNodeId'=>$_tecDocPackageStructGenericArticlesByManufacturer4SingleRequest->getAssemblyGroupNodeId(),'brandNo'=>$_tecDocPackageStructGenericArticlesByManufacturer4SingleRequest->getBrandNo(),'country'=>$_tecDocPackageStructGenericArticlesByManufacturer4SingleRequest->getCountry(),'genericArticleId'=>$_tecDocPackageStructGenericArticlesByManufacturer4SingleRequest->getGenericArticleId(),'lang'=>$_tecDocPackageStructGenericArticlesByManufacturer4SingleRequest->getLang(),'linkingTargetId'=>$_tecDocPackageStructGenericArticlesByManufacturer4SingleRequest->getLinkingTargetId(),'linkingTargetType'=>$_tecDocPackageStructGenericArticlesByManufacturer4SingleRequest->getLinkingTargetType(),'provider'=>$_tecDocPackageStructGenericArticlesByManufacturer4SingleRequest->getProvider(),'resultMode'=>$_tecDocPackageStructGenericArticlesByManufacturer4SingleRequest->getResultMode(),'sortMode'=>$_tecDocPackageStructGenericArticlesByManufacturer4SingleRequest->getSortMode()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getGenericArticlesByManufacturer5
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer5Request::getAssemblyGroupNodeId()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer5Request::getBrandNo()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer5Request::getCountry()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer5Request::getGenericArticleId()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer5Request::getLang()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer5Request::getLinkingTargetId()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer5Request::getLinkingTargetType()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer5Request::getProvider()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer5Request::getResultMode()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer5Request::getSortMode()
	 * @param TecDocPackageStructGenericArticlesByManufacturer5Request $_tecDocPackageStructGenericArticlesByManufacturer5Request
	 * @return TecDocPackageStructGenericArticlesByManufacturer5Response
	 */
	public function getGenericArticlesByManufacturer5(TecDocPackageStructGenericArticlesByManufacturer5Request $_tecDocPackageStructGenericArticlesByManufacturer5Request)
	{
		try
		{
			$this->setResult(new TecDocPackageStructGenericArticlesByManufacturer5Response(self::getSoapClient()->getGenericArticlesByManufacturer5(array('assemblyGroupNodeId'=>$_tecDocPackageStructGenericArticlesByManufacturer5Request->getAssemblyGroupNodeId(),'brandNo'=>$_tecDocPackageStructGenericArticlesByManufacturer5Request->getBrandNo(),'country'=>$_tecDocPackageStructGenericArticlesByManufacturer5Request->getCountry(),'genericArticleId'=>$_tecDocPackageStructGenericArticlesByManufacturer5Request->getGenericArticleId(),'lang'=>$_tecDocPackageStructGenericArticlesByManufacturer5Request->getLang(),'linkingTargetId'=>$_tecDocPackageStructGenericArticlesByManufacturer5Request->getLinkingTargetId(),'linkingTargetType'=>$_tecDocPackageStructGenericArticlesByManufacturer5Request->getLinkingTargetType(),'provider'=>$_tecDocPackageStructGenericArticlesByManufacturer5Request->getProvider(),'resultMode'=>$_tecDocPackageStructGenericArticlesByManufacturer5Request->getResultMode(),'sortMode'=>$_tecDocPackageStructGenericArticlesByManufacturer5Request->getSortMode()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getGenericArticlesByManufacturer5Single
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer5SingleRequest::getAssemblyGroupNodeId()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer5SingleRequest::getBrandNo()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer5SingleRequest::getCountry()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer5SingleRequest::getGenericArticleId()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer5SingleRequest::getLang()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer5SingleRequest::getLinkingTargetId()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer5SingleRequest::getLinkingTargetType()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer5SingleRequest::getProvider()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer5SingleRequest::getResultMode()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer5SingleRequest::getSortMode()
	 * @param TecDocPackageStructGenericArticlesByManufacturer5SingleRequest $_tecDocPackageStructGenericArticlesByManufacturer5SingleRequest
	 * @return TecDocPackageStructGenericArticlesByManufacturer5Response
	 */
	public function getGenericArticlesByManufacturer5Single(TecDocPackageStructGenericArticlesByManufacturer5SingleRequest $_tecDocPackageStructGenericArticlesByManufacturer5SingleRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructGenericArticlesByManufacturer5Response(self::getSoapClient()->getGenericArticlesByManufacturer5Single(array('assemblyGroupNodeId'=>$_tecDocPackageStructGenericArticlesByManufacturer5SingleRequest->getAssemblyGroupNodeId(),'brandNo'=>$_tecDocPackageStructGenericArticlesByManufacturer5SingleRequest->getBrandNo(),'country'=>$_tecDocPackageStructGenericArticlesByManufacturer5SingleRequest->getCountry(),'genericArticleId'=>$_tecDocPackageStructGenericArticlesByManufacturer5SingleRequest->getGenericArticleId(),'lang'=>$_tecDocPackageStructGenericArticlesByManufacturer5SingleRequest->getLang(),'linkingTargetId'=>$_tecDocPackageStructGenericArticlesByManufacturer5SingleRequest->getLinkingTargetId(),'linkingTargetType'=>$_tecDocPackageStructGenericArticlesByManufacturer5SingleRequest->getLinkingTargetType(),'provider'=>$_tecDocPackageStructGenericArticlesByManufacturer5SingleRequest->getProvider(),'resultMode'=>$_tecDocPackageStructGenericArticlesByManufacturer5SingleRequest->getResultMode(),'sortMode'=>$_tecDocPackageStructGenericArticlesByManufacturer5SingleRequest->getSortMode()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getGenericArticlesByManufacturer6
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer6Request::getAssemblyGroupNodeId()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer6Request::getBrandNo()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer6Request::getCountry()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer6Request::getGenericArticleId()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer6Request::getLang()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer6Request::getLinkingTargetId()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer6Request::getLinkingTargetType()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer6Request::getProvider()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer6Request::getResultMode()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer6Request::getSortMode()
	 * @param TecDocPackageStructGenericArticlesByManufacturer6Request $_tecDocPackageStructGenericArticlesByManufacturer6Request
	 * @return TecDocPackageStructGenericArticlesByManufacturer6Response
	 */
	public function getGenericArticlesByManufacturer6(TecDocPackageStructGenericArticlesByManufacturer6Request $_tecDocPackageStructGenericArticlesByManufacturer6Request)
	{
		try
		{
			$this->setResult(new TecDocPackageStructGenericArticlesByManufacturer6Response(self::getSoapClient()->getGenericArticlesByManufacturer6(array('assemblyGroupNodeId'=>$_tecDocPackageStructGenericArticlesByManufacturer6Request->getAssemblyGroupNodeId(),'brandNo'=>$_tecDocPackageStructGenericArticlesByManufacturer6Request->getBrandNo(),'country'=>$_tecDocPackageStructGenericArticlesByManufacturer6Request->getCountry(),'genericArticleId'=>$_tecDocPackageStructGenericArticlesByManufacturer6Request->getGenericArticleId(),'lang'=>$_tecDocPackageStructGenericArticlesByManufacturer6Request->getLang(),'linkingTargetId'=>$_tecDocPackageStructGenericArticlesByManufacturer6Request->getLinkingTargetId(),'linkingTargetType'=>$_tecDocPackageStructGenericArticlesByManufacturer6Request->getLinkingTargetType(),'provider'=>$_tecDocPackageStructGenericArticlesByManufacturer6Request->getProvider(),'resultMode'=>$_tecDocPackageStructGenericArticlesByManufacturer6Request->getResultMode(),'sortMode'=>$_tecDocPackageStructGenericArticlesByManufacturer6Request->getSortMode()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getGenericArticlesByManufacturer6StringList
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer6StringListRequest::getAssemblyGroupNodeId()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer6StringListRequest::getBrandNo()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer6StringListRequest::getCountry()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer6StringListRequest::getGenericArticleId()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer6StringListRequest::getLang()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer6StringListRequest::getLinkingTargetId()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer6StringListRequest::getLinkingTargetType()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer6StringListRequest::getProvider()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer6StringListRequest::getResultMode()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer6StringListRequest::getSortMode()
	 * @param TecDocPackageStructGenericArticlesByManufacturer6StringListRequest $_tecDocPackageStructGenericArticlesByManufacturer6StringListRequest
	 * @return TecDocPackageStructGenericArticlesByManufacturer6Response
	 */
	public function getGenericArticlesByManufacturer6StringList(TecDocPackageStructGenericArticlesByManufacturer6StringListRequest $_tecDocPackageStructGenericArticlesByManufacturer6StringListRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructGenericArticlesByManufacturer6Response(self::getSoapClient()->getGenericArticlesByManufacturer6StringList(array('assemblyGroupNodeId'=>$_tecDocPackageStructGenericArticlesByManufacturer6StringListRequest->getAssemblyGroupNodeId(),'brandNo'=>$_tecDocPackageStructGenericArticlesByManufacturer6StringListRequest->getBrandNo(),'country'=>$_tecDocPackageStructGenericArticlesByManufacturer6StringListRequest->getCountry(),'genericArticleId'=>$_tecDocPackageStructGenericArticlesByManufacturer6StringListRequest->getGenericArticleId(),'lang'=>$_tecDocPackageStructGenericArticlesByManufacturer6StringListRequest->getLang(),'linkingTargetId'=>$_tecDocPackageStructGenericArticlesByManufacturer6StringListRequest->getLinkingTargetId(),'linkingTargetType'=>$_tecDocPackageStructGenericArticlesByManufacturer6StringListRequest->getLinkingTargetType(),'provider'=>$_tecDocPackageStructGenericArticlesByManufacturer6StringListRequest->getProvider(),'resultMode'=>$_tecDocPackageStructGenericArticlesByManufacturer6StringListRequest->getResultMode(),'sortMode'=>$_tecDocPackageStructGenericArticlesByManufacturer6StringListRequest->getSortMode()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getGenericArticlesByManufacturer6Single
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer6SingleRequest::getAssemblyGroupNodeId()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer6SingleRequest::getBrandNo()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer6SingleRequest::getCountry()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer6SingleRequest::getGenericArticleId()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer6SingleRequest::getLang()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer6SingleRequest::getLinkingTargetId()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer6SingleRequest::getLinkingTargetType()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer6SingleRequest::getProvider()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer6SingleRequest::getResultMode()
	 * @uses TecDocPackageStructGenericArticlesByManufacturer6SingleRequest::getSortMode()
	 * @param TecDocPackageStructGenericArticlesByManufacturer6SingleRequest $_tecDocPackageStructGenericArticlesByManufacturer6SingleRequest
	 * @return TecDocPackageStructGenericArticlesByManufacturer6Response
	 */
	public function getGenericArticlesByManufacturer6Single(TecDocPackageStructGenericArticlesByManufacturer6SingleRequest $_tecDocPackageStructGenericArticlesByManufacturer6SingleRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructGenericArticlesByManufacturer6Response(self::getSoapClient()->getGenericArticlesByManufacturer6Single(array('assemblyGroupNodeId'=>$_tecDocPackageStructGenericArticlesByManufacturer6SingleRequest->getAssemblyGroupNodeId(),'brandNo'=>$_tecDocPackageStructGenericArticlesByManufacturer6SingleRequest->getBrandNo(),'country'=>$_tecDocPackageStructGenericArticlesByManufacturer6SingleRequest->getCountry(),'genericArticleId'=>$_tecDocPackageStructGenericArticlesByManufacturer6SingleRequest->getGenericArticleId(),'lang'=>$_tecDocPackageStructGenericArticlesByManufacturer6SingleRequest->getLang(),'linkingTargetId'=>$_tecDocPackageStructGenericArticlesByManufacturer6SingleRequest->getLinkingTargetId(),'linkingTargetType'=>$_tecDocPackageStructGenericArticlesByManufacturer6SingleRequest->getLinkingTargetType(),'provider'=>$_tecDocPackageStructGenericArticlesByManufacturer6SingleRequest->getProvider(),'resultMode'=>$_tecDocPackageStructGenericArticlesByManufacturer6SingleRequest->getResultMode(),'sortMode'=>$_tecDocPackageStructGenericArticlesByManufacturer6SingleRequest->getSortMode()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getArticlesByIds2
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructArticlesByIdsRequest::getArticleId()
	 * @uses TecDocPackageStructArticlesByIdsRequest::getArticleIdPairs()
	 * @uses TecDocPackageStructArticlesByIdsRequest::getArticleLinkId()
	 * @uses TecDocPackageStructArticlesByIdsRequest::getAttributs()
	 * @uses TecDocPackageStructArticlesByIdsRequest::getCountry()
	 * @uses TecDocPackageStructArticlesByIdsRequest::getDirectSearch()
	 * @uses TecDocPackageStructArticlesByIdsRequest::getDocuments()
	 * @uses TecDocPackageStructArticlesByIdsRequest::getDocumentsData()
	 * @uses TecDocPackageStructArticlesByIdsRequest::getEanNumbers()
	 * @uses TecDocPackageStructArticlesByIdsRequest::getImmediateAttributs()
	 * @uses TecDocPackageStructArticlesByIdsRequest::getImmediateInfo()
	 * @uses TecDocPackageStructArticlesByIdsRequest::getInfo()
	 * @uses TecDocPackageStructArticlesByIdsRequest::getLang()
	 * @uses TecDocPackageStructArticlesByIdsRequest::getLinkingTargetId()
	 * @uses TecDocPackageStructArticlesByIdsRequest::getLinkingTargetType()
	 * @uses TecDocPackageStructArticlesByIdsRequest::getMainArticles()
	 * @uses TecDocPackageStructArticlesByIdsRequest::getManuId()
	 * @uses TecDocPackageStructArticlesByIdsRequest::getModId()
	 * @uses TecDocPackageStructArticlesByIdsRequest::getNormalAustauschPrice()
	 * @uses TecDocPackageStructArticlesByIdsRequest::getOeNumbers()
	 * @uses TecDocPackageStructArticlesByIdsRequest::getPriceDate()
	 * @uses TecDocPackageStructArticlesByIdsRequest::getPrices()
	 * @uses TecDocPackageStructArticlesByIdsRequest::getProvider()
	 * @uses TecDocPackageStructArticlesByIdsRequest::getReplacedByNumbers()
	 * @uses TecDocPackageStructArticlesByIdsRequest::getReplacedNumbers()
	 * @uses TecDocPackageStructArticlesByIdsRequest::getUsageNumbers()
	 * @param TecDocPackageStructArticlesByIdsRequest $_tecDocPackageStructArticlesByIdsRequest
	 * @return TecDocPackageStructArticlesByIds2Response
	 */
	public function getArticlesByIds2(TecDocPackageStructArticlesByIdsRequest $_tecDocPackageStructArticlesByIdsRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructArticlesByIds2Response(self::getSoapClient()->getArticlesByIds2(array('articleId'=>$_tecDocPackageStructArticlesByIdsRequest->getArticleId(),'articleIdPairs'=>$_tecDocPackageStructArticlesByIdsRequest->getArticleIdPairs(),'articleLinkId'=>$_tecDocPackageStructArticlesByIdsRequest->getArticleLinkId(),'attributs'=>$_tecDocPackageStructArticlesByIdsRequest->getAttributs(),'country'=>$_tecDocPackageStructArticlesByIdsRequest->getCountry(),'directSearch'=>$_tecDocPackageStructArticlesByIdsRequest->getDirectSearch(),'documents'=>$_tecDocPackageStructArticlesByIdsRequest->getDocuments(),'documentsData'=>$_tecDocPackageStructArticlesByIdsRequest->getDocumentsData(),'eanNumbers'=>$_tecDocPackageStructArticlesByIdsRequest->getEanNumbers(),'immediateAttributs'=>$_tecDocPackageStructArticlesByIdsRequest->getImmediateAttributs(),'immediateInfo'=>$_tecDocPackageStructArticlesByIdsRequest->getImmediateInfo(),'info'=>$_tecDocPackageStructArticlesByIdsRequest->getInfo(),'lang'=>$_tecDocPackageStructArticlesByIdsRequest->getLang(),'linkingTargetId'=>$_tecDocPackageStructArticlesByIdsRequest->getLinkingTargetId(),'linkingTargetType'=>$_tecDocPackageStructArticlesByIdsRequest->getLinkingTargetType(),'mainArticles'=>$_tecDocPackageStructArticlesByIdsRequest->getMainArticles(),'manuId'=>$_tecDocPackageStructArticlesByIdsRequest->getManuId(),'modId'=>$_tecDocPackageStructArticlesByIdsRequest->getModId(),'normalAustauschPrice'=>$_tecDocPackageStructArticlesByIdsRequest->getNormalAustauschPrice(),'oeNumbers'=>$_tecDocPackageStructArticlesByIdsRequest->getOeNumbers(),'priceDate'=>$_tecDocPackageStructArticlesByIdsRequest->getPriceDate(),'prices'=>$_tecDocPackageStructArticlesByIdsRequest->getPrices(),'provider'=>$_tecDocPackageStructArticlesByIdsRequest->getProvider(),'replacedByNumbers'=>$_tecDocPackageStructArticlesByIdsRequest->getReplacedByNumbers(),'replacedNumbers'=>$_tecDocPackageStructArticlesByIdsRequest->getReplacedNumbers(),'usageNumbers'=>$_tecDocPackageStructArticlesByIdsRequest->getUsageNumbers()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getArticleIds2
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructArticleIds2Request::getAssemblyGroupNodeId()
	 * @uses TecDocPackageStructArticleIds2Request::getBrandNo()
	 * @uses TecDocPackageStructArticleIds2Request::getCountry()
	 * @uses TecDocPackageStructArticleIds2Request::getGenericArticleId()
	 * @uses TecDocPackageStructArticleIds2Request::getLang()
	 * @uses TecDocPackageStructArticleIds2Request::getLinkingTargetId()
	 * @uses TecDocPackageStructArticleIds2Request::getLinkingTargetType()
	 * @uses TecDocPackageStructArticleIds2Request::getProvider()
	 * @uses TecDocPackageStructArticleIds2Request::getSort()
	 * @param TecDocPackageStructArticleIds2Request $_tecDocPackageStructArticleIds2Request
	 * @return TecDocPackageStructArticleIds2Response
	 */
	public function getArticleIds2(TecDocPackageStructArticleIds2Request $_tecDocPackageStructArticleIds2Request)
	{
		try
		{
			$this->setResult(new TecDocPackageStructArticleIds2Response(self::getSoapClient()->getArticleIds2(array('assemblyGroupNodeId'=>$_tecDocPackageStructArticleIds2Request->getAssemblyGroupNodeId(),'brandNo'=>$_tecDocPackageStructArticleIds2Request->getBrandNo(),'country'=>$_tecDocPackageStructArticleIds2Request->getCountry(),'genericArticleId'=>$_tecDocPackageStructArticleIds2Request->getGenericArticleId(),'lang'=>$_tecDocPackageStructArticleIds2Request->getLang(),'linkingTargetId'=>$_tecDocPackageStructArticleIds2Request->getLinkingTargetId(),'linkingTargetType'=>$_tecDocPackageStructArticleIds2Request->getLinkingTargetType(),'provider'=>$_tecDocPackageStructArticleIds2Request->getProvider(),'sort'=>$_tecDocPackageStructArticleIds2Request->getSort()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getArticleIds2StringList
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructArticleIds2StringListRequest::getAssemblyGroupNodeId()
	 * @uses TecDocPackageStructArticleIds2StringListRequest::getBrandNo()
	 * @uses TecDocPackageStructArticleIds2StringListRequest::getCountry()
	 * @uses TecDocPackageStructArticleIds2StringListRequest::getGenericArticleId()
	 * @uses TecDocPackageStructArticleIds2StringListRequest::getLang()
	 * @uses TecDocPackageStructArticleIds2StringListRequest::getLinkingTargetId()
	 * @uses TecDocPackageStructArticleIds2StringListRequest::getLinkingTargetType()
	 * @uses TecDocPackageStructArticleIds2StringListRequest::getProvider()
	 * @uses TecDocPackageStructArticleIds2StringListRequest::getSort()
	 * @param TecDocPackageStructArticleIds2StringListRequest $_tecDocPackageStructArticleIds2StringListRequest
	 * @return TecDocPackageStructArticleIds2Response
	 */
	public function getArticleIds2StringList(TecDocPackageStructArticleIds2StringListRequest $_tecDocPackageStructArticleIds2StringListRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructArticleIds2Response(self::getSoapClient()->getArticleIds2StringList(array('assemblyGroupNodeId'=>$_tecDocPackageStructArticleIds2StringListRequest->getAssemblyGroupNodeId(),'brandNo'=>$_tecDocPackageStructArticleIds2StringListRequest->getBrandNo(),'country'=>$_tecDocPackageStructArticleIds2StringListRequest->getCountry(),'genericArticleId'=>$_tecDocPackageStructArticleIds2StringListRequest->getGenericArticleId(),'lang'=>$_tecDocPackageStructArticleIds2StringListRequest->getLang(),'linkingTargetId'=>$_tecDocPackageStructArticleIds2StringListRequest->getLinkingTargetId(),'linkingTargetType'=>$_tecDocPackageStructArticleIds2StringListRequest->getLinkingTargetType(),'provider'=>$_tecDocPackageStructArticleIds2StringListRequest->getProvider(),'sort'=>$_tecDocPackageStructArticleIds2StringListRequest->getSort()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getArticleIds2Single
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructArticleIds2SingleRequest::getAssemblyGroupNodeId()
	 * @uses TecDocPackageStructArticleIds2SingleRequest::getBrandNo()
	 * @uses TecDocPackageStructArticleIds2SingleRequest::getCountry()
	 * @uses TecDocPackageStructArticleIds2SingleRequest::getGenericArticleId()
	 * @uses TecDocPackageStructArticleIds2SingleRequest::getLang()
	 * @uses TecDocPackageStructArticleIds2SingleRequest::getLinkingTargetId()
	 * @uses TecDocPackageStructArticleIds2SingleRequest::getLinkingTargetType()
	 * @uses TecDocPackageStructArticleIds2SingleRequest::getProvider()
	 * @uses TecDocPackageStructArticleIds2SingleRequest::getSort()
	 * @param TecDocPackageStructArticleIds2SingleRequest $_tecDocPackageStructArticleIds2SingleRequest
	 * @return TecDocPackageStructArticleIds2Response
	 */
	public function getArticleIds2Single(TecDocPackageStructArticleIds2SingleRequest $_tecDocPackageStructArticleIds2SingleRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructArticleIds2Response(self::getSoapClient()->getArticleIds2Single(array('assemblyGroupNodeId'=>$_tecDocPackageStructArticleIds2SingleRequest->getAssemblyGroupNodeId(),'brandNo'=>$_tecDocPackageStructArticleIds2SingleRequest->getBrandNo(),'country'=>$_tecDocPackageStructArticleIds2SingleRequest->getCountry(),'genericArticleId'=>$_tecDocPackageStructArticleIds2SingleRequest->getGenericArticleId(),'lang'=>$_tecDocPackageStructArticleIds2SingleRequest->getLang(),'linkingTargetId'=>$_tecDocPackageStructArticleIds2SingleRequest->getLinkingTargetId(),'linkingTargetType'=>$_tecDocPackageStructArticleIds2SingleRequest->getLinkingTargetType(),'provider'=>$_tecDocPackageStructArticleIds2SingleRequest->getProvider(),'sort'=>$_tecDocPackageStructArticleIds2SingleRequest->getSort()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getArticleIds3
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructArticleIds3Request::getAssemblyGroupNodeId()
	 * @uses TecDocPackageStructArticleIds3Request::getBrandNo()
	 * @uses TecDocPackageStructArticleIds3Request::getCountry()
	 * @uses TecDocPackageStructArticleIds3Request::getGenericArticleId()
	 * @uses TecDocPackageStructArticleIds3Request::getLang()
	 * @uses TecDocPackageStructArticleIds3Request::getLinkingTargetId()
	 * @uses TecDocPackageStructArticleIds3Request::getLinkingTargetType()
	 * @uses TecDocPackageStructArticleIds3Request::getProvider()
	 * @uses TecDocPackageStructArticleIds3Request::getSort()
	 * @param TecDocPackageStructArticleIds3Request $_tecDocPackageStructArticleIds3Request
	 * @return TecDocPackageStructArticleIds3Response
	 */
	public function getArticleIds3(TecDocPackageStructArticleIds3Request $_tecDocPackageStructArticleIds3Request)
	{
		try
		{
			$this->setResult(new TecDocPackageStructArticleIds3Response(self::getSoapClient()->getArticleIds3(array('assemblyGroupNodeId'=>$_tecDocPackageStructArticleIds3Request->getAssemblyGroupNodeId(),'brandNo'=>$_tecDocPackageStructArticleIds3Request->getBrandNo(),'country'=>$_tecDocPackageStructArticleIds3Request->getCountry(),'genericArticleId'=>$_tecDocPackageStructArticleIds3Request->getGenericArticleId(),'lang'=>$_tecDocPackageStructArticleIds3Request->getLang(),'linkingTargetId'=>$_tecDocPackageStructArticleIds3Request->getLinkingTargetId(),'linkingTargetType'=>$_tecDocPackageStructArticleIds3Request->getLinkingTargetType(),'provider'=>$_tecDocPackageStructArticleIds3Request->getProvider(),'sort'=>$_tecDocPackageStructArticleIds3Request->getSort()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getArticleIds3StringList
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructArticleIds3StringListRequest::getAssemblyGroupNodeId()
	 * @uses TecDocPackageStructArticleIds3StringListRequest::getBrandNo()
	 * @uses TecDocPackageStructArticleIds3StringListRequest::getCountry()
	 * @uses TecDocPackageStructArticleIds3StringListRequest::getGenericArticleId()
	 * @uses TecDocPackageStructArticleIds3StringListRequest::getLang()
	 * @uses TecDocPackageStructArticleIds3StringListRequest::getLinkingTargetId()
	 * @uses TecDocPackageStructArticleIds3StringListRequest::getLinkingTargetType()
	 * @uses TecDocPackageStructArticleIds3StringListRequest::getProvider()
	 * @uses TecDocPackageStructArticleIds3StringListRequest::getSort()
	 * @param TecDocPackageStructArticleIds3StringListRequest $_tecDocPackageStructArticleIds3StringListRequest
	 * @return TecDocPackageStructArticleIds3Response
	 */
	public function getArticleIds3StringList(TecDocPackageStructArticleIds3StringListRequest $_tecDocPackageStructArticleIds3StringListRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructArticleIds3Response(self::getSoapClient()->getArticleIds3StringList(array('assemblyGroupNodeId'=>$_tecDocPackageStructArticleIds3StringListRequest->getAssemblyGroupNodeId(),'brandNo'=>$_tecDocPackageStructArticleIds3StringListRequest->getBrandNo(),'country'=>$_tecDocPackageStructArticleIds3StringListRequest->getCountry(),'genericArticleId'=>$_tecDocPackageStructArticleIds3StringListRequest->getGenericArticleId(),'lang'=>$_tecDocPackageStructArticleIds3StringListRequest->getLang(),'linkingTargetId'=>$_tecDocPackageStructArticleIds3StringListRequest->getLinkingTargetId(),'linkingTargetType'=>$_tecDocPackageStructArticleIds3StringListRequest->getLinkingTargetType(),'provider'=>$_tecDocPackageStructArticleIds3StringListRequest->getProvider(),'sort'=>$_tecDocPackageStructArticleIds3StringListRequest->getSort()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getArticleIds3Single
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructArticleIds3SingleRequest::getAssemblyGroupNodeId()
	 * @uses TecDocPackageStructArticleIds3SingleRequest::getBrandNo()
	 * @uses TecDocPackageStructArticleIds3SingleRequest::getCountry()
	 * @uses TecDocPackageStructArticleIds3SingleRequest::getGenericArticleId()
	 * @uses TecDocPackageStructArticleIds3SingleRequest::getLang()
	 * @uses TecDocPackageStructArticleIds3SingleRequest::getLinkingTargetId()
	 * @uses TecDocPackageStructArticleIds3SingleRequest::getLinkingTargetType()
	 * @uses TecDocPackageStructArticleIds3SingleRequest::getProvider()
	 * @uses TecDocPackageStructArticleIds3SingleRequest::getSort()
	 * @param TecDocPackageStructArticleIds3SingleRequest $_tecDocPackageStructArticleIds3SingleRequest
	 * @return TecDocPackageStructArticleIds3Response
	 */
	public function getArticleIds3Single(TecDocPackageStructArticleIds3SingleRequest $_tecDocPackageStructArticleIds3SingleRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructArticleIds3Response(self::getSoapClient()->getArticleIds3Single(array('assemblyGroupNodeId'=>$_tecDocPackageStructArticleIds3SingleRequest->getAssemblyGroupNodeId(),'brandNo'=>$_tecDocPackageStructArticleIds3SingleRequest->getBrandNo(),'country'=>$_tecDocPackageStructArticleIds3SingleRequest->getCountry(),'genericArticleId'=>$_tecDocPackageStructArticleIds3SingleRequest->getGenericArticleId(),'lang'=>$_tecDocPackageStructArticleIds3SingleRequest->getLang(),'linkingTargetId'=>$_tecDocPackageStructArticleIds3SingleRequest->getLinkingTargetId(),'linkingTargetType'=>$_tecDocPackageStructArticleIds3SingleRequest->getLinkingTargetType(),'provider'=>$_tecDocPackageStructArticleIds3SingleRequest->getProvider(),'sort'=>$_tecDocPackageStructArticleIds3SingleRequest->getSort()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getAssignedArticlesByIds2
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructAssignedArticlesByIdsRequest::getArticleIdPairs()
	 * @uses TecDocPackageStructAssignedArticlesByIdsRequest::getAttributs()
	 * @uses TecDocPackageStructAssignedArticlesByIdsRequest::getCountry()
	 * @uses TecDocPackageStructAssignedArticlesByIdsRequest::getDocuments()
	 * @uses TecDocPackageStructAssignedArticlesByIdsRequest::getDocumentsData()
	 * @uses TecDocPackageStructAssignedArticlesByIdsRequest::getEanNumbers()
	 * @uses TecDocPackageStructAssignedArticlesByIdsRequest::getImmediateAttributs()
	 * @uses TecDocPackageStructAssignedArticlesByIdsRequest::getImmediateInfo()
	 * @uses TecDocPackageStructAssignedArticlesByIdsRequest::getInfo()
	 * @uses TecDocPackageStructAssignedArticlesByIdsRequest::getLang()
	 * @uses TecDocPackageStructAssignedArticlesByIdsRequest::getLinkingTargetId()
	 * @uses TecDocPackageStructAssignedArticlesByIdsRequest::getLinkingTargetType()
	 * @uses TecDocPackageStructAssignedArticlesByIdsRequest::getMainArticles()
	 * @uses TecDocPackageStructAssignedArticlesByIdsRequest::getManuId()
	 * @uses TecDocPackageStructAssignedArticlesByIdsRequest::getModId()
	 * @uses TecDocPackageStructAssignedArticlesByIdsRequest::getNormalAustauschPrice()
	 * @uses TecDocPackageStructAssignedArticlesByIdsRequest::getOeNumbers()
	 * @uses TecDocPackageStructAssignedArticlesByIdsRequest::getPriceDate()
	 * @uses TecDocPackageStructAssignedArticlesByIdsRequest::getPrices()
	 * @uses TecDocPackageStructAssignedArticlesByIdsRequest::getProvider()
	 * @uses TecDocPackageStructAssignedArticlesByIdsRequest::getReplacedByNumbers()
	 * @uses TecDocPackageStructAssignedArticlesByIdsRequest::getReplacedNumbers()
	 * @uses TecDocPackageStructAssignedArticlesByIdsRequest::getUsageNumbers()
	 * @param TecDocPackageStructAssignedArticlesByIdsRequest $_tecDocPackageStructAssignedArticlesByIdsRequest
	 * @return TecDocPackageStructArticlesByIds2Response
	 */
	public function getAssignedArticlesByIds2(TecDocPackageStructAssignedArticlesByIdsRequest $_tecDocPackageStructAssignedArticlesByIdsRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructArticlesByIds2Response(self::getSoapClient()->getAssignedArticlesByIds2(array('articleIdPairs'=>$_tecDocPackageStructAssignedArticlesByIdsRequest->getArticleIdPairs(),'attributs'=>$_tecDocPackageStructAssignedArticlesByIdsRequest->getAttributs(),'country'=>$_tecDocPackageStructAssignedArticlesByIdsRequest->getCountry(),'documents'=>$_tecDocPackageStructAssignedArticlesByIdsRequest->getDocuments(),'documentsData'=>$_tecDocPackageStructAssignedArticlesByIdsRequest->getDocumentsData(),'eanNumbers'=>$_tecDocPackageStructAssignedArticlesByIdsRequest->getEanNumbers(),'immediateAttributs'=>$_tecDocPackageStructAssignedArticlesByIdsRequest->getImmediateAttributs(),'immediateInfo'=>$_tecDocPackageStructAssignedArticlesByIdsRequest->getImmediateInfo(),'info'=>$_tecDocPackageStructAssignedArticlesByIdsRequest->getInfo(),'lang'=>$_tecDocPackageStructAssignedArticlesByIdsRequest->getLang(),'linkingTargetId'=>$_tecDocPackageStructAssignedArticlesByIdsRequest->getLinkingTargetId(),'linkingTargetType'=>$_tecDocPackageStructAssignedArticlesByIdsRequest->getLinkingTargetType(),'mainArticles'=>$_tecDocPackageStructAssignedArticlesByIdsRequest->getMainArticles(),'manuId'=>$_tecDocPackageStructAssignedArticlesByIdsRequest->getManuId(),'modId'=>$_tecDocPackageStructAssignedArticlesByIdsRequest->getModId(),'normalAustauschPrice'=>$_tecDocPackageStructAssignedArticlesByIdsRequest->getNormalAustauschPrice(),'oeNumbers'=>$_tecDocPackageStructAssignedArticlesByIdsRequest->getOeNumbers(),'priceDate'=>$_tecDocPackageStructAssignedArticlesByIdsRequest->getPriceDate(),'prices'=>$_tecDocPackageStructAssignedArticlesByIdsRequest->getPrices(),'provider'=>$_tecDocPackageStructAssignedArticlesByIdsRequest->getProvider(),'replacedByNumbers'=>$_tecDocPackageStructAssignedArticlesByIdsRequest->getReplacedByNumbers(),'replacedNumbers'=>$_tecDocPackageStructAssignedArticlesByIdsRequest->getReplacedNumbers(),'usageNumbers'=>$_tecDocPackageStructAssignedArticlesByIdsRequest->getUsageNumbers()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getAssignedArticlesByIds2Single
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructAssignedArticlesByIdsSingleRequest::getArticleId()
	 * @uses TecDocPackageStructAssignedArticlesByIdsSingleRequest::getArticleLinkId()
	 * @uses TecDocPackageStructAssignedArticlesByIdsSingleRequest::getAttributs()
	 * @uses TecDocPackageStructAssignedArticlesByIdsSingleRequest::getCountry()
	 * @uses TecDocPackageStructAssignedArticlesByIdsSingleRequest::getDocuments()
	 * @uses TecDocPackageStructAssignedArticlesByIdsSingleRequest::getDocumentsData()
	 * @uses TecDocPackageStructAssignedArticlesByIdsSingleRequest::getEanNumbers()
	 * @uses TecDocPackageStructAssignedArticlesByIdsSingleRequest::getImmediateAttributs()
	 * @uses TecDocPackageStructAssignedArticlesByIdsSingleRequest::getImmediateInfo()
	 * @uses TecDocPackageStructAssignedArticlesByIdsSingleRequest::getInfo()
	 * @uses TecDocPackageStructAssignedArticlesByIdsSingleRequest::getLang()
	 * @uses TecDocPackageStructAssignedArticlesByIdsSingleRequest::getLinkingTargetId()
	 * @uses TecDocPackageStructAssignedArticlesByIdsSingleRequest::getLinkingTargetType()
	 * @uses TecDocPackageStructAssignedArticlesByIdsSingleRequest::getMainArticles()
	 * @uses TecDocPackageStructAssignedArticlesByIdsSingleRequest::getManuId()
	 * @uses TecDocPackageStructAssignedArticlesByIdsSingleRequest::getModId()
	 * @uses TecDocPackageStructAssignedArticlesByIdsSingleRequest::getNormalAustauschPrice()
	 * @uses TecDocPackageStructAssignedArticlesByIdsSingleRequest::getOeNumbers()
	 * @uses TecDocPackageStructAssignedArticlesByIdsSingleRequest::getPriceDate()
	 * @uses TecDocPackageStructAssignedArticlesByIdsSingleRequest::getPrices()
	 * @uses TecDocPackageStructAssignedArticlesByIdsSingleRequest::getProvider()
	 * @uses TecDocPackageStructAssignedArticlesByIdsSingleRequest::getReplacedByNumbers()
	 * @uses TecDocPackageStructAssignedArticlesByIdsSingleRequest::getReplacedNumbers()
	 * @uses TecDocPackageStructAssignedArticlesByIdsSingleRequest::getUsageNumbers()
	 * @param TecDocPackageStructAssignedArticlesByIdsSingleRequest $_tecDocPackageStructAssignedArticlesByIdsSingleRequest
	 * @return TecDocPackageStructArticlesByIds2Response
	 */
	public function getAssignedArticlesByIds2Single(TecDocPackageStructAssignedArticlesByIdsSingleRequest $_tecDocPackageStructAssignedArticlesByIdsSingleRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructArticlesByIds2Response(self::getSoapClient()->getAssignedArticlesByIds2Single(array('articleId'=>$_tecDocPackageStructAssignedArticlesByIdsSingleRequest->getArticleId(),'articleLinkId'=>$_tecDocPackageStructAssignedArticlesByIdsSingleRequest->getArticleLinkId(),'attributs'=>$_tecDocPackageStructAssignedArticlesByIdsSingleRequest->getAttributs(),'country'=>$_tecDocPackageStructAssignedArticlesByIdsSingleRequest->getCountry(),'documents'=>$_tecDocPackageStructAssignedArticlesByIdsSingleRequest->getDocuments(),'documentsData'=>$_tecDocPackageStructAssignedArticlesByIdsSingleRequest->getDocumentsData(),'eanNumbers'=>$_tecDocPackageStructAssignedArticlesByIdsSingleRequest->getEanNumbers(),'immediateAttributs'=>$_tecDocPackageStructAssignedArticlesByIdsSingleRequest->getImmediateAttributs(),'immediateInfo'=>$_tecDocPackageStructAssignedArticlesByIdsSingleRequest->getImmediateInfo(),'info'=>$_tecDocPackageStructAssignedArticlesByIdsSingleRequest->getInfo(),'lang'=>$_tecDocPackageStructAssignedArticlesByIdsSingleRequest->getLang(),'linkingTargetId'=>$_tecDocPackageStructAssignedArticlesByIdsSingleRequest->getLinkingTargetId(),'linkingTargetType'=>$_tecDocPackageStructAssignedArticlesByIdsSingleRequest->getLinkingTargetType(),'mainArticles'=>$_tecDocPackageStructAssignedArticlesByIdsSingleRequest->getMainArticles(),'manuId'=>$_tecDocPackageStructAssignedArticlesByIdsSingleRequest->getManuId(),'modId'=>$_tecDocPackageStructAssignedArticlesByIdsSingleRequest->getModId(),'normalAustauschPrice'=>$_tecDocPackageStructAssignedArticlesByIdsSingleRequest->getNormalAustauschPrice(),'oeNumbers'=>$_tecDocPackageStructAssignedArticlesByIdsSingleRequest->getOeNumbers(),'priceDate'=>$_tecDocPackageStructAssignedArticlesByIdsSingleRequest->getPriceDate(),'prices'=>$_tecDocPackageStructAssignedArticlesByIdsSingleRequest->getPrices(),'provider'=>$_tecDocPackageStructAssignedArticlesByIdsSingleRequest->getProvider(),'replacedByNumbers'=>$_tecDocPackageStructAssignedArticlesByIdsSingleRequest->getReplacedByNumbers(),'replacedNumbers'=>$_tecDocPackageStructAssignedArticlesByIdsSingleRequest->getReplacedNumbers(),'usageNumbers'=>$_tecDocPackageStructAssignedArticlesByIdsSingleRequest->getUsageNumbers()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getArticleDirectSearchAllNumbers2
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructArticleDirectSearchAllNumbers2Request::getArticleNumber()
	 * @uses TecDocPackageStructArticleDirectSearchAllNumbers2Request::getBrandno()
	 * @uses TecDocPackageStructArticleDirectSearchAllNumbers2Request::getCountry()
	 * @uses TecDocPackageStructArticleDirectSearchAllNumbers2Request::getGenericArticleId()
	 * @uses TecDocPackageStructArticleDirectSearchAllNumbers2Request::getLang()
	 * @uses TecDocPackageStructArticleDirectSearchAllNumbers2Request::getNumberType()
	 * @uses TecDocPackageStructArticleDirectSearchAllNumbers2Request::getProvider()
	 * @uses TecDocPackageStructArticleDirectSearchAllNumbers2Request::getSearchExact()
	 * @uses TecDocPackageStructArticleDirectSearchAllNumbers2Request::getSortType()
	 * @param TecDocPackageStructArticleDirectSearchAllNumbers2Request $_tecDocPackageStructArticleDirectSearchAllNumbers2Request
	 * @return TecDocPackageStructArticleDirectSearchAllNumbersResponse
	 */
	public function getArticleDirectSearchAllNumbers2(TecDocPackageStructArticleDirectSearchAllNumbers2Request $_tecDocPackageStructArticleDirectSearchAllNumbers2Request)
	{
		try
		{
			$this->setResult(new TecDocPackageStructArticleDirectSearchAllNumbersResponse(self::getSoapClient()->getArticleDirectSearchAllNumbers2(array('articleNumber'=>$_tecDocPackageStructArticleDirectSearchAllNumbers2Request->getArticleNumber(),'brandno'=>$_tecDocPackageStructArticleDirectSearchAllNumbers2Request->getBrandno(),'country'=>$_tecDocPackageStructArticleDirectSearchAllNumbers2Request->getCountry(),'genericArticleId'=>$_tecDocPackageStructArticleDirectSearchAllNumbers2Request->getGenericArticleId(),'lang'=>$_tecDocPackageStructArticleDirectSearchAllNumbers2Request->getLang(),'numberType'=>$_tecDocPackageStructArticleDirectSearchAllNumbers2Request->getNumberType(),'provider'=>$_tecDocPackageStructArticleDirectSearchAllNumbers2Request->getProvider(),'searchExact'=>$_tecDocPackageStructArticleDirectSearchAllNumbers2Request->getSearchExact(),'sortType'=>$_tecDocPackageStructArticleDirectSearchAllNumbers2Request->getSortType()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getDirectArticlesByIds2
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructDirectArticlesByIdsRequest::getArticleId()
	 * @uses TecDocPackageStructDirectArticlesByIdsRequest::getAttributs()
	 * @uses TecDocPackageStructDirectArticlesByIdsRequest::getCountry()
	 * @uses TecDocPackageStructDirectArticlesByIdsRequest::getDocuments()
	 * @uses TecDocPackageStructDirectArticlesByIdsRequest::getDocumentsData()
	 * @uses TecDocPackageStructDirectArticlesByIdsRequest::getEanNumbers()
	 * @uses TecDocPackageStructDirectArticlesByIdsRequest::getImmediateAttributs()
	 * @uses TecDocPackageStructDirectArticlesByIdsRequest::getImmediateInfo()
	 * @uses TecDocPackageStructDirectArticlesByIdsRequest::getInfo()
	 * @uses TecDocPackageStructDirectArticlesByIdsRequest::getLang()
	 * @uses TecDocPackageStructDirectArticlesByIdsRequest::getMainArticles()
	 * @uses TecDocPackageStructDirectArticlesByIdsRequest::getNormalAustauschPrice()
	 * @uses TecDocPackageStructDirectArticlesByIdsRequest::getOeNumbers()
	 * @uses TecDocPackageStructDirectArticlesByIdsRequest::getPriceDate()
	 * @uses TecDocPackageStructDirectArticlesByIdsRequest::getPrices()
	 * @uses TecDocPackageStructDirectArticlesByIdsRequest::getProvider()
	 * @uses TecDocPackageStructDirectArticlesByIdsRequest::getReplacedByNumbers()
	 * @uses TecDocPackageStructDirectArticlesByIdsRequest::getReplacedNumbers()
	 * @uses TecDocPackageStructDirectArticlesByIdsRequest::getUsageNumbers()
	 * @param TecDocPackageStructDirectArticlesByIdsRequest $_tecDocPackageStructDirectArticlesByIdsRequest
	 * @return TecDocPackageStructArticlesByIds2Response
	 */
	public function getDirectArticlesByIds2(TecDocPackageStructDirectArticlesByIdsRequest $_tecDocPackageStructDirectArticlesByIdsRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructArticlesByIds2Response(self::getSoapClient()->getDirectArticlesByIds2(array('articleId'=>$_tecDocPackageStructDirectArticlesByIdsRequest->getArticleId(),'attributs'=>$_tecDocPackageStructDirectArticlesByIdsRequest->getAttributs(),'country'=>$_tecDocPackageStructDirectArticlesByIdsRequest->getCountry(),'documents'=>$_tecDocPackageStructDirectArticlesByIdsRequest->getDocuments(),'documentsData'=>$_tecDocPackageStructDirectArticlesByIdsRequest->getDocumentsData(),'eanNumbers'=>$_tecDocPackageStructDirectArticlesByIdsRequest->getEanNumbers(),'immediateAttributs'=>$_tecDocPackageStructDirectArticlesByIdsRequest->getImmediateAttributs(),'immediateInfo'=>$_tecDocPackageStructDirectArticlesByIdsRequest->getImmediateInfo(),'info'=>$_tecDocPackageStructDirectArticlesByIdsRequest->getInfo(),'lang'=>$_tecDocPackageStructDirectArticlesByIdsRequest->getLang(),'mainArticles'=>$_tecDocPackageStructDirectArticlesByIdsRequest->getMainArticles(),'normalAustauschPrice'=>$_tecDocPackageStructDirectArticlesByIdsRequest->getNormalAustauschPrice(),'oeNumbers'=>$_tecDocPackageStructDirectArticlesByIdsRequest->getOeNumbers(),'priceDate'=>$_tecDocPackageStructDirectArticlesByIdsRequest->getPriceDate(),'prices'=>$_tecDocPackageStructDirectArticlesByIdsRequest->getPrices(),'provider'=>$_tecDocPackageStructDirectArticlesByIdsRequest->getProvider(),'replacedByNumbers'=>$_tecDocPackageStructDirectArticlesByIdsRequest->getReplacedByNumbers(),'replacedNumbers'=>$_tecDocPackageStructDirectArticlesByIdsRequest->getReplacedNumbers(),'usageNumbers'=>$_tecDocPackageStructDirectArticlesByIdsRequest->getUsageNumbers()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getDirectArticlesByIds2StringList
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructDirectArticlesByIdsStringListRequest::getArticleId()
	 * @uses TecDocPackageStructDirectArticlesByIdsStringListRequest::getAttributs()
	 * @uses TecDocPackageStructDirectArticlesByIdsStringListRequest::getCountry()
	 * @uses TecDocPackageStructDirectArticlesByIdsStringListRequest::getDocuments()
	 * @uses TecDocPackageStructDirectArticlesByIdsStringListRequest::getDocumentsData()
	 * @uses TecDocPackageStructDirectArticlesByIdsStringListRequest::getEanNumbers()
	 * @uses TecDocPackageStructDirectArticlesByIdsStringListRequest::getImmediateAttributs()
	 * @uses TecDocPackageStructDirectArticlesByIdsStringListRequest::getImmediateInfo()
	 * @uses TecDocPackageStructDirectArticlesByIdsStringListRequest::getInfo()
	 * @uses TecDocPackageStructDirectArticlesByIdsStringListRequest::getLang()
	 * @uses TecDocPackageStructDirectArticlesByIdsStringListRequest::getMainArticles()
	 * @uses TecDocPackageStructDirectArticlesByIdsStringListRequest::getNormalAustauschPrice()
	 * @uses TecDocPackageStructDirectArticlesByIdsStringListRequest::getOeNumbers()
	 * @uses TecDocPackageStructDirectArticlesByIdsStringListRequest::getPriceDate()
	 * @uses TecDocPackageStructDirectArticlesByIdsStringListRequest::getPrices()
	 * @uses TecDocPackageStructDirectArticlesByIdsStringListRequest::getProvider()
	 * @uses TecDocPackageStructDirectArticlesByIdsStringListRequest::getReplacedByNumbers()
	 * @uses TecDocPackageStructDirectArticlesByIdsStringListRequest::getReplacedNumbers()
	 * @uses TecDocPackageStructDirectArticlesByIdsStringListRequest::getUsageNumbers()
	 * @param TecDocPackageStructDirectArticlesByIdsStringListRequest $_tecDocPackageStructDirectArticlesByIdsStringListRequest
	 * @return TecDocPackageStructArticlesByIds2Response
	 */
	public function getDirectArticlesByIds2StringList(TecDocPackageStructDirectArticlesByIdsStringListRequest $_tecDocPackageStructDirectArticlesByIdsStringListRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructArticlesByIds2Response(self::getSoapClient()->getDirectArticlesByIds2StringList(array('articleId'=>$_tecDocPackageStructDirectArticlesByIdsStringListRequest->getArticleId(),'attributs'=>$_tecDocPackageStructDirectArticlesByIdsStringListRequest->getAttributs(),'country'=>$_tecDocPackageStructDirectArticlesByIdsStringListRequest->getCountry(),'documents'=>$_tecDocPackageStructDirectArticlesByIdsStringListRequest->getDocuments(),'documentsData'=>$_tecDocPackageStructDirectArticlesByIdsStringListRequest->getDocumentsData(),'eanNumbers'=>$_tecDocPackageStructDirectArticlesByIdsStringListRequest->getEanNumbers(),'immediateAttributs'=>$_tecDocPackageStructDirectArticlesByIdsStringListRequest->getImmediateAttributs(),'immediateInfo'=>$_tecDocPackageStructDirectArticlesByIdsStringListRequest->getImmediateInfo(),'info'=>$_tecDocPackageStructDirectArticlesByIdsStringListRequest->getInfo(),'lang'=>$_tecDocPackageStructDirectArticlesByIdsStringListRequest->getLang(),'mainArticles'=>$_tecDocPackageStructDirectArticlesByIdsStringListRequest->getMainArticles(),'normalAustauschPrice'=>$_tecDocPackageStructDirectArticlesByIdsStringListRequest->getNormalAustauschPrice(),'oeNumbers'=>$_tecDocPackageStructDirectArticlesByIdsStringListRequest->getOeNumbers(),'priceDate'=>$_tecDocPackageStructDirectArticlesByIdsStringListRequest->getPriceDate(),'prices'=>$_tecDocPackageStructDirectArticlesByIdsStringListRequest->getPrices(),'provider'=>$_tecDocPackageStructDirectArticlesByIdsStringListRequest->getProvider(),'replacedByNumbers'=>$_tecDocPackageStructDirectArticlesByIdsStringListRequest->getReplacedByNumbers(),'replacedNumbers'=>$_tecDocPackageStructDirectArticlesByIdsStringListRequest->getReplacedNumbers(),'usageNumbers'=>$_tecDocPackageStructDirectArticlesByIdsStringListRequest->getUsageNumbers()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getDirectArticlesByIds2Single
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructDirectArticlesByIdsSingleRequest::getArticleId()
	 * @uses TecDocPackageStructDirectArticlesByIdsSingleRequest::getAttributs()
	 * @uses TecDocPackageStructDirectArticlesByIdsSingleRequest::getCountry()
	 * @uses TecDocPackageStructDirectArticlesByIdsSingleRequest::getDocuments()
	 * @uses TecDocPackageStructDirectArticlesByIdsSingleRequest::getDocumentsData()
	 * @uses TecDocPackageStructDirectArticlesByIdsSingleRequest::getEanNumbers()
	 * @uses TecDocPackageStructDirectArticlesByIdsSingleRequest::getImmediateAttributs()
	 * @uses TecDocPackageStructDirectArticlesByIdsSingleRequest::getImmediateInfo()
	 * @uses TecDocPackageStructDirectArticlesByIdsSingleRequest::getInfo()
	 * @uses TecDocPackageStructDirectArticlesByIdsSingleRequest::getLang()
	 * @uses TecDocPackageStructDirectArticlesByIdsSingleRequest::getMainArticles()
	 * @uses TecDocPackageStructDirectArticlesByIdsSingleRequest::getNormalAustauschPrice()
	 * @uses TecDocPackageStructDirectArticlesByIdsSingleRequest::getOeNumbers()
	 * @uses TecDocPackageStructDirectArticlesByIdsSingleRequest::getPriceDate()
	 * @uses TecDocPackageStructDirectArticlesByIdsSingleRequest::getPrices()
	 * @uses TecDocPackageStructDirectArticlesByIdsSingleRequest::getProvider()
	 * @uses TecDocPackageStructDirectArticlesByIdsSingleRequest::getReplacedByNumbers()
	 * @uses TecDocPackageStructDirectArticlesByIdsSingleRequest::getReplacedNumbers()
	 * @uses TecDocPackageStructDirectArticlesByIdsSingleRequest::getUsageNumbers()
	 * @param TecDocPackageStructDirectArticlesByIdsSingleRequest $_tecDocPackageStructDirectArticlesByIdsSingleRequest
	 * @return TecDocPackageStructArticlesByIds2Response
	 */
	public function getDirectArticlesByIds2Single(TecDocPackageStructDirectArticlesByIdsSingleRequest $_tecDocPackageStructDirectArticlesByIdsSingleRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructArticlesByIds2Response(self::getSoapClient()->getDirectArticlesByIds2Single(array('articleId'=>$_tecDocPackageStructDirectArticlesByIdsSingleRequest->getArticleId(),'attributs'=>$_tecDocPackageStructDirectArticlesByIdsSingleRequest->getAttributs(),'country'=>$_tecDocPackageStructDirectArticlesByIdsSingleRequest->getCountry(),'documents'=>$_tecDocPackageStructDirectArticlesByIdsSingleRequest->getDocuments(),'documentsData'=>$_tecDocPackageStructDirectArticlesByIdsSingleRequest->getDocumentsData(),'eanNumbers'=>$_tecDocPackageStructDirectArticlesByIdsSingleRequest->getEanNumbers(),'immediateAttributs'=>$_tecDocPackageStructDirectArticlesByIdsSingleRequest->getImmediateAttributs(),'immediateInfo'=>$_tecDocPackageStructDirectArticlesByIdsSingleRequest->getImmediateInfo(),'info'=>$_tecDocPackageStructDirectArticlesByIdsSingleRequest->getInfo(),'lang'=>$_tecDocPackageStructDirectArticlesByIdsSingleRequest->getLang(),'mainArticles'=>$_tecDocPackageStructDirectArticlesByIdsSingleRequest->getMainArticles(),'normalAustauschPrice'=>$_tecDocPackageStructDirectArticlesByIdsSingleRequest->getNormalAustauschPrice(),'oeNumbers'=>$_tecDocPackageStructDirectArticlesByIdsSingleRequest->getOeNumbers(),'priceDate'=>$_tecDocPackageStructDirectArticlesByIdsSingleRequest->getPriceDate(),'prices'=>$_tecDocPackageStructDirectArticlesByIdsSingleRequest->getPrices(),'provider'=>$_tecDocPackageStructDirectArticlesByIdsSingleRequest->getProvider(),'replacedByNumbers'=>$_tecDocPackageStructDirectArticlesByIdsSingleRequest->getReplacedByNumbers(),'replacedNumbers'=>$_tecDocPackageStructDirectArticlesByIdsSingleRequest->getReplacedNumbers(),'usageNumbers'=>$_tecDocPackageStructDirectArticlesByIdsSingleRequest->getUsageNumbers()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getRequiredAttributes
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructRequiredAttributesRequest::getCountry()
	 * @uses TecDocPackageStructRequiredAttributesRequest::getGenericArticleId()
	 * @uses TecDocPackageStructRequiredAttributesRequest::getProvider()
	 * @param TecDocPackageStructRequiredAttributesRequest $_tecDocPackageStructRequiredAttributesRequest
	 * @return TecDocPackageStructRequiredAttributesResponse
	 */
	public function getRequiredAttributes(TecDocPackageStructRequiredAttributesRequest $_tecDocPackageStructRequiredAttributesRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructRequiredAttributesResponse(self::getSoapClient()->getRequiredAttributes(array('country'=>$_tecDocPackageStructRequiredAttributesRequest->getCountry(),'genericArticleId'=>$_tecDocPackageStructRequiredAttributesRequest->getGenericArticleId(),'provider'=>$_tecDocPackageStructRequiredAttributesRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getCriteriaAttributesByCriteriaArticles
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructCriteriaAttributesByCriteriaArticlesRequest::getArticleIds()
	 * @uses TecDocPackageStructCriteriaAttributesByCriteriaArticlesRequest::getArticleLinkIds()
	 * @uses TecDocPackageStructCriteriaAttributesByCriteriaArticlesRequest::getCountry()
	 * @uses TecDocPackageStructCriteriaAttributesByCriteriaArticlesRequest::getCriteriaId()
	 * @uses TecDocPackageStructCriteriaAttributesByCriteriaArticlesRequest::getLang()
	 * @uses TecDocPackageStructCriteriaAttributesByCriteriaArticlesRequest::getProvider()
	 * @param TecDocPackageStructCriteriaAttributesByCriteriaArticlesRequest $_tecDocPackageStructCriteriaAttributesByCriteriaArticlesRequest
	 * @return TecDocPackageStructCriteriaAttributesByCriteriaArticlesResponse
	 */
	public function getCriteriaAttributesByCriteriaArticles(TecDocPackageStructCriteriaAttributesByCriteriaArticlesRequest $_tecDocPackageStructCriteriaAttributesByCriteriaArticlesRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructCriteriaAttributesByCriteriaArticlesResponse(self::getSoapClient()->getCriteriaAttributesByCriteriaArticles(array('articleIds'=>$_tecDocPackageStructCriteriaAttributesByCriteriaArticlesRequest->getArticleIds(),'articleLinkIds'=>$_tecDocPackageStructCriteriaAttributesByCriteriaArticlesRequest->getArticleLinkIds(),'country'=>$_tecDocPackageStructCriteriaAttributesByCriteriaArticlesRequest->getCountry(),'criteriaId'=>$_tecDocPackageStructCriteriaAttributesByCriteriaArticlesRequest->getCriteriaId(),'lang'=>$_tecDocPackageStructCriteriaAttributesByCriteriaArticlesRequest->getLang(),'provider'=>$_tecDocPackageStructCriteriaAttributesByCriteriaArticlesRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getCriteriaAttributesByCriteriaArticlesStringList
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructCriteriaAttributesByCriteriaArticlesStringListRequest::getArticleIds()
	 * @uses TecDocPackageStructCriteriaAttributesByCriteriaArticlesStringListRequest::getArticleLinkIds()
	 * @uses TecDocPackageStructCriteriaAttributesByCriteriaArticlesStringListRequest::getCountry()
	 * @uses TecDocPackageStructCriteriaAttributesByCriteriaArticlesStringListRequest::getCriteriaId()
	 * @uses TecDocPackageStructCriteriaAttributesByCriteriaArticlesStringListRequest::getLang()
	 * @uses TecDocPackageStructCriteriaAttributesByCriteriaArticlesStringListRequest::getProvider()
	 * @param TecDocPackageStructCriteriaAttributesByCriteriaArticlesStringListRequest $_tecDocPackageStructCriteriaAttributesByCriteriaArticlesStringListRequest
	 * @return TecDocPackageStructCriteriaAttributesByCriteriaArticlesResponse
	 */
	public function getCriteriaAttributesByCriteriaArticlesStringList(TecDocPackageStructCriteriaAttributesByCriteriaArticlesStringListRequest $_tecDocPackageStructCriteriaAttributesByCriteriaArticlesStringListRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructCriteriaAttributesByCriteriaArticlesResponse(self::getSoapClient()->getCriteriaAttributesByCriteriaArticlesStringList(array('articleIds'=>$_tecDocPackageStructCriteriaAttributesByCriteriaArticlesStringListRequest->getArticleIds(),'articleLinkIds'=>$_tecDocPackageStructCriteriaAttributesByCriteriaArticlesStringListRequest->getArticleLinkIds(),'country'=>$_tecDocPackageStructCriteriaAttributesByCriteriaArticlesStringListRequest->getCountry(),'criteriaId'=>$_tecDocPackageStructCriteriaAttributesByCriteriaArticlesStringListRequest->getCriteriaId(),'lang'=>$_tecDocPackageStructCriteriaAttributesByCriteriaArticlesStringListRequest->getLang(),'provider'=>$_tecDocPackageStructCriteriaAttributesByCriteriaArticlesStringListRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getCriteriaAttributesByCriteriaArticlesSingle
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructCriteriaAttributesByCriteriaArticlesSingleRequest::getArticleIds()
	 * @uses TecDocPackageStructCriteriaAttributesByCriteriaArticlesSingleRequest::getArticleLinkIds()
	 * @uses TecDocPackageStructCriteriaAttributesByCriteriaArticlesSingleRequest::getCountry()
	 * @uses TecDocPackageStructCriteriaAttributesByCriteriaArticlesSingleRequest::getCriteriaId()
	 * @uses TecDocPackageStructCriteriaAttributesByCriteriaArticlesSingleRequest::getLang()
	 * @uses TecDocPackageStructCriteriaAttributesByCriteriaArticlesSingleRequest::getProvider()
	 * @param TecDocPackageStructCriteriaAttributesByCriteriaArticlesSingleRequest $_tecDocPackageStructCriteriaAttributesByCriteriaArticlesSingleRequest
	 * @return TecDocPackageStructCriteriaAttributesByCriteriaArticlesResponse
	 */
	public function getCriteriaAttributesByCriteriaArticlesSingle(TecDocPackageStructCriteriaAttributesByCriteriaArticlesSingleRequest $_tecDocPackageStructCriteriaAttributesByCriteriaArticlesSingleRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructCriteriaAttributesByCriteriaArticlesResponse(self::getSoapClient()->getCriteriaAttributesByCriteriaArticlesSingle(array('articleIds'=>$_tecDocPackageStructCriteriaAttributesByCriteriaArticlesSingleRequest->getArticleIds(),'articleLinkIds'=>$_tecDocPackageStructCriteriaAttributesByCriteriaArticlesSingleRequest->getArticleLinkIds(),'country'=>$_tecDocPackageStructCriteriaAttributesByCriteriaArticlesSingleRequest->getCountry(),'criteriaId'=>$_tecDocPackageStructCriteriaAttributesByCriteriaArticlesSingleRequest->getCriteriaId(),'lang'=>$_tecDocPackageStructCriteriaAttributesByCriteriaArticlesSingleRequest->getLang(),'provider'=>$_tecDocPackageStructCriteriaAttributesByCriteriaArticlesSingleRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getCriteriaFilterArticlesByValues
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesRequest::getArticleIds()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesRequest::getArticleLinkIds()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesRequest::getAttributeValues()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesRequest::getCountry()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesRequest::getCriteriaId()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesRequest::getLang()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesRequest::getLinkingTargetType()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesRequest::getProvider()
	 * @param TecDocPackageStructCriteriaFilterArticlesByValuesRequest $_tecDocPackageStructCriteriaFilterArticlesByValuesRequest
	 * @return TecDocPackageStructCriteriaFilterArticlesByValuesResponse
	 */
	public function getCriteriaFilterArticlesByValues(TecDocPackageStructCriteriaFilterArticlesByValuesRequest $_tecDocPackageStructCriteriaFilterArticlesByValuesRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructCriteriaFilterArticlesByValuesResponse(self::getSoapClient()->getCriteriaFilterArticlesByValues(array('articleIds'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesRequest->getArticleIds(),'articleLinkIds'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesRequest->getArticleLinkIds(),'attributeValues'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesRequest->getAttributeValues(),'country'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesRequest->getCountry(),'criteriaId'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesRequest->getCriteriaId(),'lang'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesRequest->getLang(),'linkingTargetType'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesRequest->getLinkingTargetType(),'provider'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getCriteriaFilterArticlesByValuesStringList
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesStringListRequest::getArticleIds()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesStringListRequest::getArticleLinkIds()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesStringListRequest::getAttributeValues()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesStringListRequest::getCountry()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesStringListRequest::getCriteriaId()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesStringListRequest::getLang()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesStringListRequest::getLinkingTargetType()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesStringListRequest::getProvider()
	 * @param TecDocPackageStructCriteriaFilterArticlesByValuesStringListRequest $_tecDocPackageStructCriteriaFilterArticlesByValuesStringListRequest
	 * @return TecDocPackageStructCriteriaFilterArticlesByValuesResponse
	 */
	public function getCriteriaFilterArticlesByValuesStringList(TecDocPackageStructCriteriaFilterArticlesByValuesStringListRequest $_tecDocPackageStructCriteriaFilterArticlesByValuesStringListRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructCriteriaFilterArticlesByValuesResponse(self::getSoapClient()->getCriteriaFilterArticlesByValuesStringList(array('articleIds'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesStringListRequest->getArticleIds(),'articleLinkIds'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesStringListRequest->getArticleLinkIds(),'attributeValues'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesStringListRequest->getAttributeValues(),'country'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesStringListRequest->getCountry(),'criteriaId'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesStringListRequest->getCriteriaId(),'lang'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesStringListRequest->getLang(),'linkingTargetType'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesStringListRequest->getLinkingTargetType(),'provider'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesStringListRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getCriteriaFilterArticlesByValuesSingle
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesSingleRequest::getArticleIds()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesSingleRequest::getArticleLinkIds()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesSingleRequest::getAttributeValues()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesSingleRequest::getCountry()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesSingleRequest::getCriteriaId()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesSingleRequest::getLang()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesSingleRequest::getLinkingTargetType()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesSingleRequest::getProvider()
	 * @param TecDocPackageStructCriteriaFilterArticlesByValuesSingleRequest $_tecDocPackageStructCriteriaFilterArticlesByValuesSingleRequest
	 * @return TecDocPackageStructCriteriaFilterArticlesByValuesResponse
	 */
	public function getCriteriaFilterArticlesByValuesSingle(TecDocPackageStructCriteriaFilterArticlesByValuesSingleRequest $_tecDocPackageStructCriteriaFilterArticlesByValuesSingleRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructCriteriaFilterArticlesByValuesResponse(self::getSoapClient()->getCriteriaFilterArticlesByValuesSingle(array('articleIds'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesSingleRequest->getArticleIds(),'articleLinkIds'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesSingleRequest->getArticleLinkIds(),'attributeValues'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesSingleRequest->getAttributeValues(),'country'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesSingleRequest->getCountry(),'criteriaId'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesSingleRequest->getCriteriaId(),'lang'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesSingleRequest->getLang(),'linkingTargetType'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesSingleRequest->getLinkingTargetType(),'provider'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesSingleRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getCriteriaFilterArticlesByValuesNumeric
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesNumericRequest::getArticleIds()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesNumericRequest::getArticleLinkIds()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesNumericRequest::getAttributeValues()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesNumericRequest::getCountry()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesNumericRequest::getCriteriaId()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesNumericRequest::getLang()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesNumericRequest::getLinkingTargetType()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesNumericRequest::getProvider()
	 * @param TecDocPackageStructCriteriaFilterArticlesByValuesNumericRequest $_tecDocPackageStructCriteriaFilterArticlesByValuesNumericRequest
	 * @return TecDocPackageStructCriteriaFilterArticlesByValuesNumericResponse
	 */
	public function getCriteriaFilterArticlesByValuesNumeric(TecDocPackageStructCriteriaFilterArticlesByValuesNumericRequest $_tecDocPackageStructCriteriaFilterArticlesByValuesNumericRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructCriteriaFilterArticlesByValuesNumericResponse(self::getSoapClient()->getCriteriaFilterArticlesByValuesNumeric(array('articleIds'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesNumericRequest->getArticleIds(),'articleLinkIds'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesNumericRequest->getArticleLinkIds(),'attributeValues'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesNumericRequest->getAttributeValues(),'country'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesNumericRequest->getCountry(),'criteriaId'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesNumericRequest->getCriteriaId(),'lang'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesNumericRequest->getLang(),'linkingTargetType'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesNumericRequest->getLinkingTargetType(),'provider'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesNumericRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getCriteriaFilterArticlesByValuesNumericStringList
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesNumericStringListRequest::getArticleIds()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesNumericStringListRequest::getArticleLinkIds()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesNumericStringListRequest::getAttributeValues()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesNumericStringListRequest::getCountry()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesNumericStringListRequest::getCriteriaId()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesNumericStringListRequest::getLang()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesNumericStringListRequest::getLinkingTargetType()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesNumericStringListRequest::getProvider()
	 * @param TecDocPackageStructCriteriaFilterArticlesByValuesNumericStringListRequest $_tecDocPackageStructCriteriaFilterArticlesByValuesNumericStringListRequest
	 * @return TecDocPackageStructCriteriaFilterArticlesByValuesNumericResponse
	 */
	public function getCriteriaFilterArticlesByValuesNumericStringList(TecDocPackageStructCriteriaFilterArticlesByValuesNumericStringListRequest $_tecDocPackageStructCriteriaFilterArticlesByValuesNumericStringListRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructCriteriaFilterArticlesByValuesNumericResponse(self::getSoapClient()->getCriteriaFilterArticlesByValuesNumericStringList(array('articleIds'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesNumericStringListRequest->getArticleIds(),'articleLinkIds'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesNumericStringListRequest->getArticleLinkIds(),'attributeValues'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesNumericStringListRequest->getAttributeValues(),'country'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesNumericStringListRequest->getCountry(),'criteriaId'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesNumericStringListRequest->getCriteriaId(),'lang'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesNumericStringListRequest->getLang(),'linkingTargetType'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesNumericStringListRequest->getLinkingTargetType(),'provider'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesNumericStringListRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getCriteriaFilterArticlesByValuesNumericSingle
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesNumericSingleRequest::getArticleIds()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesNumericSingleRequest::getArticleLinkIds()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesNumericSingleRequest::getAttributeValues()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesNumericSingleRequest::getCountry()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesNumericSingleRequest::getCriteriaId()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesNumericSingleRequest::getLang()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesNumericSingleRequest::getLinkingTargetType()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesNumericSingleRequest::getProvider()
	 * @param TecDocPackageStructCriteriaFilterArticlesByValuesNumericSingleRequest $_tecDocPackageStructCriteriaFilterArticlesByValuesNumericSingleRequest
	 * @return TecDocPackageStructCriteriaFilterArticlesByValuesNumericResponse
	 */
	public function getCriteriaFilterArticlesByValuesNumericSingle(TecDocPackageStructCriteriaFilterArticlesByValuesNumericSingleRequest $_tecDocPackageStructCriteriaFilterArticlesByValuesNumericSingleRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructCriteriaFilterArticlesByValuesNumericResponse(self::getSoapClient()->getCriteriaFilterArticlesByValuesNumericSingle(array('articleIds'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesNumericSingleRequest->getArticleIds(),'articleLinkIds'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesNumericSingleRequest->getArticleLinkIds(),'attributeValues'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesNumericSingleRequest->getAttributeValues(),'country'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesNumericSingleRequest->getCountry(),'criteriaId'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesNumericSingleRequest->getCriteriaId(),'lang'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesNumericSingleRequest->getLang(),'linkingTargetType'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesNumericSingleRequest->getLinkingTargetType(),'provider'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesNumericSingleRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getCriteriaFilterArticlesByValuesInterval
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesIntervalRequest::getArticleIds()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesIntervalRequest::getArticleLinkIds()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesIntervalRequest::getCountry()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesIntervalRequest::getCriteriaId()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesIntervalRequest::getCriteriaId2()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesIntervalRequest::getFlagDate()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesIntervalRequest::getLang()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesIntervalRequest::getLinkingTargetType()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesIntervalRequest::getProvider()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesIntervalRequest::getValue1()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesIntervalRequest::getValue2()
	 * @param TecDocPackageStructCriteriaFilterArticlesByValuesIntervalRequest $_tecDocPackageStructCriteriaFilterArticlesByValuesIntervalRequest
	 * @return TecDocPackageStructCriteriaFilterArticlesByValuesIntervalResponse
	 */
	public function getCriteriaFilterArticlesByValuesInterval(TecDocPackageStructCriteriaFilterArticlesByValuesIntervalRequest $_tecDocPackageStructCriteriaFilterArticlesByValuesIntervalRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructCriteriaFilterArticlesByValuesIntervalResponse(self::getSoapClient()->getCriteriaFilterArticlesByValuesInterval(array('articleIds'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesIntervalRequest->getArticleIds(),'articleLinkIds'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesIntervalRequest->getArticleLinkIds(),'country'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesIntervalRequest->getCountry(),'criteriaId'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesIntervalRequest->getCriteriaId(),'criteriaId2'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesIntervalRequest->getCriteriaId2(),'flagDate'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesIntervalRequest->getFlagDate(),'lang'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesIntervalRequest->getLang(),'linkingTargetType'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesIntervalRequest->getLinkingTargetType(),'provider'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesIntervalRequest->getProvider(),'value1'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesIntervalRequest->getValue1(),'value2'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesIntervalRequest->getValue2()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getCriteriaFilterArticlesByValuesIntervalStringList
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesIntervalStringListRequest::getArticleIds()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesIntervalStringListRequest::getArticleLinkIds()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesIntervalStringListRequest::getCountry()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesIntervalStringListRequest::getCriteriaId()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesIntervalStringListRequest::getCriteriaId2()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesIntervalStringListRequest::getFlagDate()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesIntervalStringListRequest::getLang()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesIntervalStringListRequest::getLinkingTargetType()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesIntervalStringListRequest::getProvider()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesIntervalStringListRequest::getValue1()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesIntervalStringListRequest::getValue2()
	 * @param TecDocPackageStructCriteriaFilterArticlesByValuesIntervalStringListRequest $_tecDocPackageStructCriteriaFilterArticlesByValuesIntervalStringListRequest
	 * @return TecDocPackageStructCriteriaFilterArticlesByValuesIntervalResponse
	 */
	public function getCriteriaFilterArticlesByValuesIntervalStringList(TecDocPackageStructCriteriaFilterArticlesByValuesIntervalStringListRequest $_tecDocPackageStructCriteriaFilterArticlesByValuesIntervalStringListRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructCriteriaFilterArticlesByValuesIntervalResponse(self::getSoapClient()->getCriteriaFilterArticlesByValuesIntervalStringList(array('articleIds'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesIntervalStringListRequest->getArticleIds(),'articleLinkIds'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesIntervalStringListRequest->getArticleLinkIds(),'country'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesIntervalStringListRequest->getCountry(),'criteriaId'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesIntervalStringListRequest->getCriteriaId(),'criteriaId2'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesIntervalStringListRequest->getCriteriaId2(),'flagDate'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesIntervalStringListRequest->getFlagDate(),'lang'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesIntervalStringListRequest->getLang(),'linkingTargetType'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesIntervalStringListRequest->getLinkingTargetType(),'provider'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesIntervalStringListRequest->getProvider(),'value1'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesIntervalStringListRequest->getValue1(),'value2'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesIntervalStringListRequest->getValue2()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getCriteriaFilterArticlesByValuesIntervalSingle
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesIntervalSingleRequest::getArticleIds()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesIntervalSingleRequest::getArticleLinkIds()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesIntervalSingleRequest::getCountry()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesIntervalSingleRequest::getCriteriaId()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesIntervalSingleRequest::getCriteriaId2()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesIntervalSingleRequest::getFlagDate()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesIntervalSingleRequest::getLang()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesIntervalSingleRequest::getLinkingTargetType()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesIntervalSingleRequest::getProvider()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesIntervalSingleRequest::getValue1()
	 * @uses TecDocPackageStructCriteriaFilterArticlesByValuesIntervalSingleRequest::getValue2()
	 * @param TecDocPackageStructCriteriaFilterArticlesByValuesIntervalSingleRequest $_tecDocPackageStructCriteriaFilterArticlesByValuesIntervalSingleRequest
	 * @return TecDocPackageStructCriteriaFilterArticlesByValuesIntervalResponse
	 */
	public function getCriteriaFilterArticlesByValuesIntervalSingle(TecDocPackageStructCriteriaFilterArticlesByValuesIntervalSingleRequest $_tecDocPackageStructCriteriaFilterArticlesByValuesIntervalSingleRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructCriteriaFilterArticlesByValuesIntervalResponse(self::getSoapClient()->getCriteriaFilterArticlesByValuesIntervalSingle(array('articleIds'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesIntervalSingleRequest->getArticleIds(),'articleLinkIds'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesIntervalSingleRequest->getArticleLinkIds(),'country'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesIntervalSingleRequest->getCountry(),'criteriaId'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesIntervalSingleRequest->getCriteriaId(),'criteriaId2'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesIntervalSingleRequest->getCriteriaId2(),'flagDate'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesIntervalSingleRequest->getFlagDate(),'lang'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesIntervalSingleRequest->getLang(),'linkingTargetType'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesIntervalSingleRequest->getLinkingTargetType(),'provider'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesIntervalSingleRequest->getProvider(),'value1'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesIntervalSingleRequest->getValue1(),'value2'=>$_tecDocPackageStructCriteriaFilterArticlesByValuesIntervalSingleRequest->getValue2()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getArticleDocuments
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructArticleDocumentsRequest::getArticleId()
	 * @uses TecDocPackageStructArticleDocumentsRequest::getArticleLinkId()
	 * @uses TecDocPackageStructArticleDocumentsRequest::getCountry()
	 * @uses TecDocPackageStructArticleDocumentsRequest::getDocTypeId()
	 * @uses TecDocPackageStructArticleDocumentsRequest::getLang()
	 * @uses TecDocPackageStructArticleDocumentsRequest::getProvider()
	 * @param TecDocPackageStructArticleDocumentsRequest $_tecDocPackageStructArticleDocumentsRequest
	 * @return TecDocPackageStructArticleDocumentsResponse
	 */
	public function getArticleDocuments(TecDocPackageStructArticleDocumentsRequest $_tecDocPackageStructArticleDocumentsRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructArticleDocumentsResponse(self::getSoapClient()->getArticleDocuments(array('articleId'=>$_tecDocPackageStructArticleDocumentsRequest->getArticleId(),'articleLinkId'=>$_tecDocPackageStructArticleDocumentsRequest->getArticleLinkId(),'country'=>$_tecDocPackageStructArticleDocumentsRequest->getCountry(),'docTypeId'=>$_tecDocPackageStructArticleDocumentsRequest->getDocTypeId(),'lang'=>$_tecDocPackageStructArticleDocumentsRequest->getLang(),'provider'=>$_tecDocPackageStructArticleDocumentsRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getThumbnailByArticleId
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructThumbnailByArticleIdRequest::getArticleId()
	 * @uses TecDocPackageStructThumbnailByArticleIdRequest::getProvider()
	 * @param TecDocPackageStructThumbnailByArticleIdRequest $_tecDocPackageStructThumbnailByArticleIdRequest
	 * @return TecDocPackageStructThumbnailByArticleIdResponse
	 */
	public function getThumbnailByArticleId(TecDocPackageStructThumbnailByArticleIdRequest $_tecDocPackageStructThumbnailByArticleIdRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructThumbnailByArticleIdResponse(self::getSoapClient()->getThumbnailByArticleId(array('articleId'=>$_tecDocPackageStructThumbnailByArticleIdRequest->getArticleId(),'provider'=>$_tecDocPackageStructThumbnailByArticleIdRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getCsgDocumentDataByArticleId2
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructCsgDocumentDataByArticleIdRequest::getArticleId()
	 * @uses TecDocPackageStructCsgDocumentDataByArticleIdRequest::getArticleLinkId()
	 * @uses TecDocPackageStructCsgDocumentDataByArticleIdRequest::getArticlePartList()
	 * @uses TecDocPackageStructCsgDocumentDataByArticleIdRequest::getCountry()
	 * @uses TecDocPackageStructCsgDocumentDataByArticleIdRequest::getLang()
	 * @uses TecDocPackageStructCsgDocumentDataByArticleIdRequest::getLinkingTargetId()
	 * @uses TecDocPackageStructCsgDocumentDataByArticleIdRequest::getLinkingTargetType()
	 * @uses TecDocPackageStructCsgDocumentDataByArticleIdRequest::getProvider()
	 * @param TecDocPackageStructCsgDocumentDataByArticleIdRequest $_tecDocPackageStructCsgDocumentDataByArticleIdRequest
	 * @return TecDocPackageStructCsgDocumentDataByArticleId2Response
	 */
	public function getCsgDocumentDataByArticleId2(TecDocPackageStructCsgDocumentDataByArticleIdRequest $_tecDocPackageStructCsgDocumentDataByArticleIdRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructCsgDocumentDataByArticleId2Response(self::getSoapClient()->getCsgDocumentDataByArticleId2(array('articleId'=>$_tecDocPackageStructCsgDocumentDataByArticleIdRequest->getArticleId(),'articleLinkId'=>$_tecDocPackageStructCsgDocumentDataByArticleIdRequest->getArticleLinkId(),'articlePartList'=>$_tecDocPackageStructCsgDocumentDataByArticleIdRequest->getArticlePartList(),'country'=>$_tecDocPackageStructCsgDocumentDataByArticleIdRequest->getCountry(),'lang'=>$_tecDocPackageStructCsgDocumentDataByArticleIdRequest->getLang(),'linkingTargetId'=>$_tecDocPackageStructCsgDocumentDataByArticleIdRequest->getLinkingTargetId(),'linkingTargetType'=>$_tecDocPackageStructCsgDocumentDataByArticleIdRequest->getLinkingTargetType(),'provider'=>$_tecDocPackageStructCsgDocumentDataByArticleIdRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getCsgDocumentsByArticleId
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructCsgDocumentsByArticleIdRequest::getArticleId()
	 * @uses TecDocPackageStructCsgDocumentsByArticleIdRequest::getCountry()
	 * @uses TecDocPackageStructCsgDocumentsByArticleIdRequest::getLang()
	 * @uses TecDocPackageStructCsgDocumentsByArticleIdRequest::getProvider()
	 * @param TecDocPackageStructCsgDocumentsByArticleIdRequest $_tecDocPackageStructCsgDocumentsByArticleIdRequest
	 * @return TecDocPackageStructCsgDocumentsByArticleIdResponse
	 */
	public function getCsgDocumentsByArticleId(TecDocPackageStructCsgDocumentsByArticleIdRequest $_tecDocPackageStructCsgDocumentsByArticleIdRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructCsgDocumentsByArticleIdResponse(self::getSoapClient()->getCsgDocumentsByArticleId(array('articleId'=>$_tecDocPackageStructCsgDocumentsByArticleIdRequest->getArticleId(),'country'=>$_tecDocPackageStructCsgDocumentsByArticleIdRequest->getCountry(),'lang'=>$_tecDocPackageStructCsgDocumentsByArticleIdRequest->getLang(),'provider'=>$_tecDocPackageStructCsgDocumentsByArticleIdRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getCoordinatesByArticleDocument
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructCoordinatesByArticleDocumentRequest::getCsgId()
	 * @uses TecDocPackageStructCoordinatesByArticleDocumentRequest::getProvider()
	 * @param TecDocPackageStructCoordinatesByArticleDocumentRequest $_tecDocPackageStructCoordinatesByArticleDocumentRequest
	 * @return TecDocPackageStructCoordinatesByArticleDocumentResponse
	 */
	public function getCoordinatesByArticleDocument(TecDocPackageStructCoordinatesByArticleDocumentRequest $_tecDocPackageStructCoordinatesByArticleDocumentRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructCoordinatesByArticleDocumentResponse(self::getSoapClient()->getCoordinatesByArticleDocument(array('csgId'=>$_tecDocPackageStructCoordinatesByArticleDocumentRequest->getCsgId(),'provider'=>$_tecDocPackageStructCoordinatesByArticleDocumentRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getArticleDocumentsByDocId
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructArticleDocumentsByDocIdRequest::getDocId()
	 * @uses TecDocPackageStructArticleDocumentsByDocIdRequest::getProvider()
	 * @uses TecDocPackageStructArticleDocumentsByDocIdRequest::getThumbFlag()
	 * @param TecDocPackageStructArticleDocumentsByDocIdRequest $_tecDocPackageStructArticleDocumentsByDocIdRequest
	 * @return TecDocPackageStructArticleDocumentsByDocIdResponse
	 */
	public function getArticleDocumentsByDocId(TecDocPackageStructArticleDocumentsByDocIdRequest $_tecDocPackageStructArticleDocumentsByDocIdRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructArticleDocumentsByDocIdResponse(self::getSoapClient()->getArticleDocumentsByDocId(array('docId'=>$_tecDocPackageStructArticleDocumentsByDocIdRequest->getDocId(),'provider'=>$_tecDocPackageStructArticleDocumentsByDocIdRequest->getProvider(),'thumbFlag'=>$_tecDocPackageStructArticleDocumentsByDocIdRequest->getThumbFlag()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getArticleHasAccessoryList
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructArticleHasAccessoryListRequest::getArticleId()
	 * @uses TecDocPackageStructArticleHasAccessoryListRequest::getCarId()
	 * @uses TecDocPackageStructArticleHasAccessoryListRequest::getCountry()
	 * @uses TecDocPackageStructArticleHasAccessoryListRequest::getManuId()
	 * @uses TecDocPackageStructArticleHasAccessoryListRequest::getModelId()
	 * @uses TecDocPackageStructArticleHasAccessoryListRequest::getMotorId()
	 * @uses TecDocPackageStructArticleHasAccessoryListRequest::getProvider()
	 * @uses TecDocPackageStructArticleHasAccessoryListRequest::getUniversalFlag()
	 * @param TecDocPackageStructArticleHasAccessoryListRequest $_tecDocPackageStructArticleHasAccessoryListRequest
	 * @return TecDocPackageStructArticleHasAccessoryListResponse
	 */
	public function getArticleHasAccessoryList(TecDocPackageStructArticleHasAccessoryListRequest $_tecDocPackageStructArticleHasAccessoryListRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructArticleHasAccessoryListResponse(self::getSoapClient()->getArticleHasAccessoryList(array('articleId'=>$_tecDocPackageStructArticleHasAccessoryListRequest->getArticleId(),'carId'=>$_tecDocPackageStructArticleHasAccessoryListRequest->getCarId(),'country'=>$_tecDocPackageStructArticleHasAccessoryListRequest->getCountry(),'manuId'=>$_tecDocPackageStructArticleHasAccessoryListRequest->getManuId(),'modelId'=>$_tecDocPackageStructArticleHasAccessoryListRequest->getModelId(),'motorId'=>$_tecDocPackageStructArticleHasAccessoryListRequest->getMotorId(),'provider'=>$_tecDocPackageStructArticleHasAccessoryListRequest->getProvider(),'universalFlag'=>$_tecDocPackageStructArticleHasAccessoryListRequest->getUniversalFlag()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getArticleAccessoryList4
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructArticleAccessoryListRequest::getArticleId()
	 * @uses TecDocPackageStructArticleAccessoryListRequest::getArticleLinkId()
	 * @uses TecDocPackageStructArticleAccessoryListRequest::getCountry()
	 * @uses TecDocPackageStructArticleAccessoryListRequest::getLang()
	 * @uses TecDocPackageStructArticleAccessoryListRequest::getLinkingTargetId()
	 * @uses TecDocPackageStructArticleAccessoryListRequest::getLinkingTargetType()
	 * @uses TecDocPackageStructArticleAccessoryListRequest::getManuId()
	 * @uses TecDocPackageStructArticleAccessoryListRequest::getModId()
	 * @uses TecDocPackageStructArticleAccessoryListRequest::getPriceDate()
	 * @uses TecDocPackageStructArticleAccessoryListRequest::getProvider()
	 * @param TecDocPackageStructArticleAccessoryListRequest $_tecDocPackageStructArticleAccessoryListRequest
	 * @return TecDocPackageStructArticleAccessoryList4Response
	 */
	public function getArticleAccessoryList4(TecDocPackageStructArticleAccessoryListRequest $_tecDocPackageStructArticleAccessoryListRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructArticleAccessoryList4Response(self::getSoapClient()->getArticleAccessoryList4(array('articleId'=>$_tecDocPackageStructArticleAccessoryListRequest->getArticleId(),'articleLinkId'=>$_tecDocPackageStructArticleAccessoryListRequest->getArticleLinkId(),'country'=>$_tecDocPackageStructArticleAccessoryListRequest->getCountry(),'lang'=>$_tecDocPackageStructArticleAccessoryListRequest->getLang(),'linkingTargetId'=>$_tecDocPackageStructArticleAccessoryListRequest->getLinkingTargetId(),'linkingTargetType'=>$_tecDocPackageStructArticleAccessoryListRequest->getLinkingTargetType(),'manuId'=>$_tecDocPackageStructArticleAccessoryListRequest->getManuId(),'modId'=>$_tecDocPackageStructArticleAccessoryListRequest->getModId(),'priceDate'=>$_tecDocPackageStructArticleAccessoryListRequest->getPriceDate(),'provider'=>$_tecDocPackageStructArticleAccessoryListRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getArticlePartList2
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructArticlePartList2Request::getArticleId()
	 * @uses TecDocPackageStructArticlePartList2Request::getArticleLinkId()
	 * @uses TecDocPackageStructArticlePartList2Request::getAxleId()
	 * @uses TecDocPackageStructArticlePartList2Request::getCarId()
	 * @uses TecDocPackageStructArticlePartList2Request::getCountry()
	 * @uses TecDocPackageStructArticlePartList2Request::getLang()
	 * @uses TecDocPackageStructArticlePartList2Request::getMarkId()
	 * @uses TecDocPackageStructArticlePartList2Request::getMotorId()
	 * @uses TecDocPackageStructArticlePartList2Request::getPriceDate()
	 * @uses TecDocPackageStructArticlePartList2Request::getProvider()
	 * @param TecDocPackageStructArticlePartList2Request $_tecDocPackageStructArticlePartList2Request
	 * @return TecDocPackageStructArticlePartList2Response
	 */
	public function getArticlePartList2(TecDocPackageStructArticlePartList2Request $_tecDocPackageStructArticlePartList2Request)
	{
		try
		{
			$this->setResult(new TecDocPackageStructArticlePartList2Response(self::getSoapClient()->getArticlePartList2(array('articleId'=>$_tecDocPackageStructArticlePartList2Request->getArticleId(),'articleLinkId'=>$_tecDocPackageStructArticlePartList2Request->getArticleLinkId(),'axleId'=>$_tecDocPackageStructArticlePartList2Request->getAxleId(),'carId'=>$_tecDocPackageStructArticlePartList2Request->getCarId(),'country'=>$_tecDocPackageStructArticlePartList2Request->getCountry(),'lang'=>$_tecDocPackageStructArticlePartList2Request->getLang(),'markId'=>$_tecDocPackageStructArticlePartList2Request->getMarkId(),'motorId'=>$_tecDocPackageStructArticlePartList2Request->getMotorId(),'priceDate'=>$_tecDocPackageStructArticlePartList2Request->getPriceDate(),'provider'=>$_tecDocPackageStructArticlePartList2Request->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getArticleLinkedAllLinkingTarget2
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructArticleLinkedAllLinkingTarget2Request::getArticleId()
	 * @uses TecDocPackageStructArticleLinkedAllLinkingTarget2Request::getCountry()
	 * @uses TecDocPackageStructArticleLinkedAllLinkingTarget2Request::getLang()
	 * @uses TecDocPackageStructArticleLinkedAllLinkingTarget2Request::getLinkingTargetId()
	 * @uses TecDocPackageStructArticleLinkedAllLinkingTarget2Request::getLinkingTargetManuId()
	 * @uses TecDocPackageStructArticleLinkedAllLinkingTarget2Request::getLinkingTargetType()
	 * @uses TecDocPackageStructArticleLinkedAllLinkingTarget2Request::getProvider()
	 * @param TecDocPackageStructArticleLinkedAllLinkingTarget2Request $_tecDocPackageStructArticleLinkedAllLinkingTarget2Request
	 * @return TecDocPackageStructArticleLinkedAllLinkingTargetResponse
	 */
	public function getArticleLinkedAllLinkingTarget2(TecDocPackageStructArticleLinkedAllLinkingTarget2Request $_tecDocPackageStructArticleLinkedAllLinkingTarget2Request)
	{
		try
		{
			$this->setResult(new TecDocPackageStructArticleLinkedAllLinkingTargetResponse(self::getSoapClient()->getArticleLinkedAllLinkingTarget2(array('articleId'=>$_tecDocPackageStructArticleLinkedAllLinkingTarget2Request->getArticleId(),'country'=>$_tecDocPackageStructArticleLinkedAllLinkingTarget2Request->getCountry(),'lang'=>$_tecDocPackageStructArticleLinkedAllLinkingTarget2Request->getLang(),'linkingTargetId'=>$_tecDocPackageStructArticleLinkedAllLinkingTarget2Request->getLinkingTargetId(),'linkingTargetManuId'=>$_tecDocPackageStructArticleLinkedAllLinkingTarget2Request->getLinkingTargetManuId(),'linkingTargetType'=>$_tecDocPackageStructArticleLinkedAllLinkingTarget2Request->getLinkingTargetType(),'provider'=>$_tecDocPackageStructArticleLinkedAllLinkingTarget2Request->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getArticleLinkedAllLinkingTargetManufacturer
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructArticleLinkedAllLinkingTargetManufacturerRequest::getArticleId()
	 * @uses TecDocPackageStructArticleLinkedAllLinkingTargetManufacturerRequest::getCountry()
	 * @uses TecDocPackageStructArticleLinkedAllLinkingTargetManufacturerRequest::getLinkingTargetType()
	 * @uses TecDocPackageStructArticleLinkedAllLinkingTargetManufacturerRequest::getProvider()
	 * @param TecDocPackageStructArticleLinkedAllLinkingTargetManufacturerRequest $_tecDocPackageStructArticleLinkedAllLinkingTargetManufacturerRequest
	 * @return TecDocPackageStructArticleLinkedAllLinkingTargetManufacturerResponse
	 */
	public function getArticleLinkedAllLinkingTargetManufacturer(TecDocPackageStructArticleLinkedAllLinkingTargetManufacturerRequest $_tecDocPackageStructArticleLinkedAllLinkingTargetManufacturerRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructArticleLinkedAllLinkingTargetManufacturerResponse(self::getSoapClient()->getArticleLinkedAllLinkingTargetManufacturer(array('articleId'=>$_tecDocPackageStructArticleLinkedAllLinkingTargetManufacturerRequest->getArticleId(),'country'=>$_tecDocPackageStructArticleLinkedAllLinkingTargetManufacturerRequest->getCountry(),'linkingTargetType'=>$_tecDocPackageStructArticleLinkedAllLinkingTargetManufacturerRequest->getLinkingTargetType(),'provider'=>$_tecDocPackageStructArticleLinkedAllLinkingTargetManufacturerRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getArticleLinkedAllLinkingTargetsByIds2
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructArticleLinkedAllLinkingTargetsByIds2Request::getArticleId()
	 * @uses TecDocPackageStructArticleLinkedAllLinkingTargetsByIds2Request::getCountry()
	 * @uses TecDocPackageStructArticleLinkedAllLinkingTargetsByIds2Request::getImmediateAttributs()
	 * @uses TecDocPackageStructArticleLinkedAllLinkingTargetsByIds2Request::getLang()
	 * @uses TecDocPackageStructArticleLinkedAllLinkingTargetsByIds2Request::getLinkedArticlePairs()
	 * @uses TecDocPackageStructArticleLinkedAllLinkingTargetsByIds2Request::getLinkingTargetType()
	 * @uses TecDocPackageStructArticleLinkedAllLinkingTargetsByIds2Request::getProvider()
	 * @param TecDocPackageStructArticleLinkedAllLinkingTargetsByIds2Request $_tecDocPackageStructArticleLinkedAllLinkingTargetsByIds2Request
	 * @return TecDocPackageStructArticleLinkedAllLinkingTargetsByIds2Response
	 */
	public function getArticleLinkedAllLinkingTargetsByIds2(TecDocPackageStructArticleLinkedAllLinkingTargetsByIds2Request $_tecDocPackageStructArticleLinkedAllLinkingTargetsByIds2Request)
	{
		try
		{
			$this->setResult(new TecDocPackageStructArticleLinkedAllLinkingTargetsByIds2Response(self::getSoapClient()->getArticleLinkedAllLinkingTargetsByIds2(array('articleId'=>$_tecDocPackageStructArticleLinkedAllLinkingTargetsByIds2Request->getArticleId(),'country'=>$_tecDocPackageStructArticleLinkedAllLinkingTargetsByIds2Request->getCountry(),'immediateAttributs'=>$_tecDocPackageStructArticleLinkedAllLinkingTargetsByIds2Request->getImmediateAttributs(),'lang'=>$_tecDocPackageStructArticleLinkedAllLinkingTargetsByIds2Request->getLang(),'linkedArticlePairs'=>$_tecDocPackageStructArticleLinkedAllLinkingTargetsByIds2Request->getLinkedArticlePairs(),'linkingTargetType'=>$_tecDocPackageStructArticleLinkedAllLinkingTargetsByIds2Request->getLinkingTargetType(),'provider'=>$_tecDocPackageStructArticleLinkedAllLinkingTargetsByIds2Request->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getArticleLinkedAllLinkingTargetsByIds2Single
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructArticleLinkedAllLinkingTargetsByIds2SingleRequest::getArticleId()
	 * @uses TecDocPackageStructArticleLinkedAllLinkingTargetsByIds2SingleRequest::getArticleLinkId()
	 * @uses TecDocPackageStructArticleLinkedAllLinkingTargetsByIds2SingleRequest::getCountry()
	 * @uses TecDocPackageStructArticleLinkedAllLinkingTargetsByIds2SingleRequest::getImmediateAttributs()
	 * @uses TecDocPackageStructArticleLinkedAllLinkingTargetsByIds2SingleRequest::getLang()
	 * @uses TecDocPackageStructArticleLinkedAllLinkingTargetsByIds2SingleRequest::getLinkingTargetId()
	 * @uses TecDocPackageStructArticleLinkedAllLinkingTargetsByIds2SingleRequest::getLinkingTargetType()
	 * @uses TecDocPackageStructArticleLinkedAllLinkingTargetsByIds2SingleRequest::getProvider()
	 * @param TecDocPackageStructArticleLinkedAllLinkingTargetsByIds2SingleRequest $_tecDocPackageStructArticleLinkedAllLinkingTargetsByIds2SingleRequest
	 * @return TecDocPackageStructArticleLinkedAllLinkingTargetsByIds2Response
	 */
	public function getArticleLinkedAllLinkingTargetsByIds2Single(TecDocPackageStructArticleLinkedAllLinkingTargetsByIds2SingleRequest $_tecDocPackageStructArticleLinkedAllLinkingTargetsByIds2SingleRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructArticleLinkedAllLinkingTargetsByIds2Response(self::getSoapClient()->getArticleLinkedAllLinkingTargetsByIds2Single(array('articleId'=>$_tecDocPackageStructArticleLinkedAllLinkingTargetsByIds2SingleRequest->getArticleId(),'articleLinkId'=>$_tecDocPackageStructArticleLinkedAllLinkingTargetsByIds2SingleRequest->getArticleLinkId(),'country'=>$_tecDocPackageStructArticleLinkedAllLinkingTargetsByIds2SingleRequest->getCountry(),'immediateAttributs'=>$_tecDocPackageStructArticleLinkedAllLinkingTargetsByIds2SingleRequest->getImmediateAttributs(),'lang'=>$_tecDocPackageStructArticleLinkedAllLinkingTargetsByIds2SingleRequest->getLang(),'linkingTargetId'=>$_tecDocPackageStructArticleLinkedAllLinkingTargetsByIds2SingleRequest->getLinkingTargetId(),'linkingTargetType'=>$_tecDocPackageStructArticleLinkedAllLinkingTargetsByIds2SingleRequest->getLinkingTargetType(),'provider'=>$_tecDocPackageStructArticleLinkedAllLinkingTargetsByIds2SingleRequest->getProvider()))));
		}
		catch(SoapFault $soapFault)
		{
			return !$this->saveLastError(__METHOD__,$soapFault);
		}
		return $this->getResult();
	}
	/**
	 * Method to call the operation originally named getPegasusVersionInfo
	 * @uses TecDocPackageWsdlClass::getSoapClient()
	 * @uses TecDocPackageWsdlClass::setResult()
	 * @uses TecDocPackageWsdlClass::getResult()
	 * @uses TecDocPackageWsdlClass::saveLastError()
	 * @uses TecDocPackageStructVersionInfoRequest::getProvider()
	 * @param TecDocPackageStructVersionInfoRequest $_tecDocPackageStructVersionInfoRequest
	 * @return TecDocPackageStructVersionInfoResponse
	 */
	public function getPegasusVersionInfo(TecDocPackageStructVersionInfoRequest $_tecDocPackageStructVersionInfoRequest)
	{
		try
		{
			$this->setResult(new TecDocPackageStructVersionInfoResponse(self::getSoapClient()->getPegasusVersionInfo(array('provider'=>$_tecDocPackageStructVersionInfoRequest->getProvider()))));
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
	 * @return int|string|TecDocPackageStructArticleAccessoryList4Response|TecDocPackageStructArticleDirectSearchAllNumbersResponse|TecDocPackageStructArticleDocumentsByDocIdResponse|TecDocPackageStructArticleDocumentsResponse|TecDocPackageStructArticleHasAccessoryListResponse|TecDocPackageStructArticleIds2Response|TecDocPackageStructArticleIds3Response|TecDocPackageStructArticleLinkedAllLinkingTargetManufacturerResponse|TecDocPackageStructArticleLinkedAllLinkingTargetResponse|TecDocPackageStructArticleLinkedAllLinkingTargetsByIds2Response|TecDocPackageStructArticlePartList2Response|TecDocPackageStructArticlesByIds2Response|TecDocPackageStructAxisConfigurationsResponse|TecDocPackageStructAxleBrakeSizesResponse|TecDocPackageStructAxleByIds2Response|TecDocPackageStructAxleByIdsResponse|TecDocPackageStructAxleIdByKeyNumberResponse|TecDocPackageStructAxleIdByTypeManCriteria2Response|TecDocPackageStructAxleIdByTypeManCriteria3Response|TecDocPackageStructAxleKeyNumbersResponse|TecDocPackageStructAxleModelsResponse|TecDocPackageStructAxlesManufacturers2Response|TecDocPackageStructAxleStylesResponse|TecDocPackageStructAxleTypesResponse|TecDocPackageStructBrandsForAssortmentResponse|TecDocPackageStructChildNodesAllLinkingTarget2Response|TecDocPackageStructChildNodesAllLinkingTargetShortCut2Response|TecDocPackageStructChildNodesPatternResponse|TecDocPackageStructConstructionTypesResponse|TecDocPackageStructCoordinatesByArticleDocumentResponse|TecDocPackageStructCountriesResponse|TecDocPackageStructCountryGroupsResponse|TecDocPackageStructCriteria2Response|TecDocPackageStructCriteriaAttributesByCriteriaArticlesResponse|TecDocPackageStructCriteriaFilterArticlesByValuesIntervalResponse|TecDocPackageStructCriteriaFilterArticlesByValuesNumericResponse|TecDocPackageStructCriteriaFilterArticlesByValuesResponse|TecDocPackageStructCsgDocumentDataByArticleId2Response|TecDocPackageStructCsgDocumentsByArticleIdResponse|TecDocPackageStructEngineIdsByTecDocEngineNoResponse|TecDocPackageStructFuelTypesResponse|TecDocPackageStructGenericArticlesByManufacturer4Response|TecDocPackageStructGenericArticlesByManufacturer5Response|TecDocPackageStructGenericArticlesByManufacturer6Response|TecDocPackageStructKeyValuesForTraderModeResponse|TecDocPackageStructLanguagesResponse|TecDocPackageStructManufacturerInfosById2Response|TecDocPackageStructManufacturerInfosByIdResponse|TecDocPackageStructMarkByIdResponse|TecDocPackageStructMotorByIds2Response|TecDocPackageStructMotorByIdsResponse|TecDocPackageStructMotorIdsByManuIdCriteria2Response|TecDocPackageStructMotorIdsByManuIdCriteriaResponse|TecDocPackageStructMotorManufacturers2Response|TecDocPackageStructMotorsByCarTypeManuIdTerm2Response|TecDocPackageStructMotorsByCarTypeManuIdTermResponse|TecDocPackageStructRequiredAttributesResponse|TecDocPackageStructShortCuts2Response|TecDocPackageStructThumbnailByArticleIdResponse|TecDocPackageStructVehicleByIds2Response|TecDocPackageStructVehicleByIdsResponse|TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Response|TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Response|TecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Response|TecDocPackageStructVehicleIdsByCarTypeManuIdTermResponse|TecDocPackageStructVehicleIdsByKeyNumberPlates3Response|TecDocPackageStructVehicleIdsByKTypeNumberResponse|TecDocPackageStructVehicleIdsByMarkResponse|TecDocPackageStructVehicleIdsByMotor2Response|TecDocPackageStructVehicleIdsByMotorResponse|TecDocPackageStructVehicleIdsByVendorId2Response|TecDocPackageStructVehicleIdsByVendorIdResponse|TecDocPackageStructVehicleManufacturers2Response|TecDocPackageStructVehicleManufacturers3Response|TecDocPackageStructVehicleModels2Response|TecDocPackageStructVehicleModels3Response|TecDocPackageStructVehicleSimplifiedSelection2Response|TecDocPackageStructVehicleSimplifiedSelection3Response|TecDocPackageStructVehicleSimplifiedSelection4Response|TecDocPackageStructVendorIds2Response|TecDocPackageStructVendorIdsResponse|TecDocPackageStructVersionInfoResponse
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