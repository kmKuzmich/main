<?php
/**
 * Test with TecDocPackage
 * @package TecDocPackage
 * @author Mikaël DELSOL <contact@wsdltophp.com>
 * @date 10/02/2013
 */
ini_set('memory_limit','512M');
ini_set('display_errors', true);
error_reporting(-1);
/**
 * Load autoload
 */
require_once dirname(__FILE__) . '/TecDocPackageAutoload.php';
/**
 * TecDocPackage Informations
 */
define('TECDOCPACKAGE_WSDL_URL','http://webservicepilot.tecdoc.net/pegasus-2-0/wsdl/TecdocToCat');
define('TECDOCPACKAGE_USER_LOGIN','');
define('TECDOCPACKAGE_USER_PASSWORD','');
/**
 * Wsdl instanciation infos
 */
$wsdl = array();
$wsdl[TecDocPackageWsdlClass::WSDL_URL] = TECDOCPACKAGE_WSDL_URL;
$wsdl[TecDocPackageWsdlClass::WSDL_CACHE_WSDL] = WSDL_CACHE_NONE;
$wsdl[TecDocPackageWsdlClass::WSDL_TRACE] = true;
if(TECDOCPACKAGE_USER_LOGIN !== '')
	$wsdl[TecDocPackageWsdlClass::WSDL_LOGIN] = TECDOCPACKAGE_USER_LOGIN;
if(TECDOCPACKAGE_USER_PASSWORD !== '')
	$wsdl[TecDocPackageWsdlClass::WSDL_PASSWD] = TECDOCPACKAGE_USER_PASSWORD;
// etc....
/**
 * Examples
 */


/*************************************
 * Example for TecDocPackageServiceGet
 */
$tecDocPackageServiceGet = new TecDocPackageServiceGet($wsdl);
// sample call for TecDocPackageServiceGet::getLoad()
if($tecDocPackageServiceGet->getLoad())
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getTarget()
if($tecDocPackageServiceGet->getTarget())
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getLanguages()
if($tecDocPackageServiceGet->getLanguages(new TecDocPackageStructLanguagesRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getCountries()
if($tecDocPackageServiceGet->getCountries(new TecDocPackageStructCountriesRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getCountryGroups()
if($tecDocPackageServiceGet->getCountryGroups(new TecDocPackageStructCountryGroupsRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getKeyValuesForTraderMode()
if($tecDocPackageServiceGet->getKeyValuesForTraderMode(new TecDocPackageStructKeyValuesForTraderModeRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getCriteria2()
if($tecDocPackageServiceGet->getCriteria2(new TecDocPackageStructCriteriaRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getBrandsForAssortment()
if($tecDocPackageServiceGet->getBrandsForAssortment(new TecDocPackageStructBrandsForAssortmentRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getManufacturerInfosById()
if($tecDocPackageServiceGet->getManufacturerInfosById(new TecDocPackageStructManufacturerInfosByIdRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getManufacturerInfosById2()
if($tecDocPackageServiceGet->getManufacturerInfosById2(new TecDocPackageStructManufacturerInfosById2Request(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getVehicleManufacturers2()
if($tecDocPackageServiceGet->getVehicleManufacturers2(new TecDocPackageStructVehicleManufacturers2Request(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getVehicleManufacturers3()
if($tecDocPackageServiceGet->getVehicleManufacturers3(new TecDocPackageStructVehicleManufacturers3Request(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getVehicleModels2()
if($tecDocPackageServiceGet->getVehicleModels2(new TecDocPackageStructVehicleModels2Request(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getVehicleModels3()
if($tecDocPackageServiceGet->getVehicleModels3(new TecDocPackageStructVehicleModels3Request(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getAxisConfigurations()
if($tecDocPackageServiceGet->getAxisConfigurations(new TecDocPackageStructAxisConfigurationsRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getConstructionTypes()
if($tecDocPackageServiceGet->getConstructionTypes(new TecDocPackageStructConstructionTypesRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getFuelTypes()
if($tecDocPackageServiceGet->getFuelTypes(new TecDocPackageStructFuelTypesRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getVehicleIdsByCarTypeManuIdTerm()
if($tecDocPackageServiceGet->getVehicleIdsByCarTypeManuIdTerm(new TecDocPackageStructVehicleIdsByCarTypeManuIdTermRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getVehicleIdsByCarTypeManuIdTerm2()
if($tecDocPackageServiceGet->getVehicleIdsByCarTypeManuIdTerm2(new TecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Request(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getVehicleIdsByCarTypeManuIdModelIdCriteria2()
if($tecDocPackageServiceGet->getVehicleIdsByCarTypeManuIdModelIdCriteria2(new TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Request(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getVehicleIdsByCarTypeManuIdModelIdCriteria3()
if($tecDocPackageServiceGet->getVehicleIdsByCarTypeManuIdModelIdCriteria3(new TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Request(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getVehicleSimplifiedSelection2()
if($tecDocPackageServiceGet->getVehicleSimplifiedSelection2(new TecDocPackageStructVehicleSimplifiedSelection2Request(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getVehicleSimplifiedSelection3()
if($tecDocPackageServiceGet->getVehicleSimplifiedSelection3(new TecDocPackageStructVehicleSimplifiedSelection2Request(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getVehicleSimplifiedSelection4()
if($tecDocPackageServiceGet->getVehicleSimplifiedSelection4(new TecDocPackageStructVehicleSimplifiedSelectionRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getVehicleIdsByKTypeNumber()
if($tecDocPackageServiceGet->getVehicleIdsByKTypeNumber(new TecDocPackageStructVehicleIdsByKTypeNumberRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getVehicleIdsByMotor()
if($tecDocPackageServiceGet->getVehicleIdsByMotor(new TecDocPackageStructVehicleIdsByMotorRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getVehicleIdsByMotor2()
if($tecDocPackageServiceGet->getVehicleIdsByMotor2(new TecDocPackageStructVehicleIdsByMotor2Request(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getVehicleIdsByMark()
if($tecDocPackageServiceGet->getVehicleIdsByMark(new TecDocPackageStructVehicleIdsByMarkRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getVehicleIdsByVendorId()
if($tecDocPackageServiceGet->getVehicleIdsByVendorId(new TecDocPackageStructVehicleIdsByVendorIdRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getVehicleIdsByVendorId2()
if($tecDocPackageServiceGet->getVehicleIdsByVendorId2(new TecDocPackageStructVehicleIdsByVendorId2Request(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getVehicleIdsByKeyNumberPlates3()
if($tecDocPackageServiceGet->getVehicleIdsByKeyNumberPlates3(new TecDocPackageStructVehicleIdsByKeyNumberPlates2Request(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getVehicleByIds()
if($tecDocPackageServiceGet->getVehicleByIds(new TecDocPackageStructVehicleByIdsRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getVehicleByIdsStringList()
if($tecDocPackageServiceGet->getVehicleByIdsStringList(new TecDocPackageStructVehicleByIdsStringListRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getVehicleByIds2()
if($tecDocPackageServiceGet->getVehicleByIds2(new TecDocPackageStructVehicleByIds2Request(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getVehicleByIds2StringList()
if($tecDocPackageServiceGet->getVehicleByIds2StringList(new TecDocPackageStructVehicleByIds2StringListRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getVehicleByIds2Single()
if($tecDocPackageServiceGet->getVehicleByIds2Single(new TecDocPackageStructVehicleByIds2SingleRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getAxlesManufacturers2()
if($tecDocPackageServiceGet->getAxlesManufacturers2(new TecDocPackageStructAxlesManufacturers2Request(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getAxleModels()
if($tecDocPackageServiceGet->getAxleModels(new TecDocPackageStructAxleModelsRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getAxleBrakeSizes()
if($tecDocPackageServiceGet->getAxleBrakeSizes(new TecDocPackageStructAxleBrakeSizesRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getAxleStyles()
if($tecDocPackageServiceGet->getAxleStyles(new TecDocPackageStructAxleStylesRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getAxleTypes()
if($tecDocPackageServiceGet->getAxleTypes(new TecDocPackageStructAxleTypesRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getAxleIdByTypeManCriteria2()
if($tecDocPackageServiceGet->getAxleIdByTypeManCriteria2(new TecDocPackageStructAxleIdByTypeManCriteria2Request(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getAxleIdByTypeManCriteria3()
if($tecDocPackageServiceGet->getAxleIdByTypeManCriteria3(new TecDocPackageStructAxleIdByTypeManCriteria3Request(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getAxleKeyNumbers()
if($tecDocPackageServiceGet->getAxleKeyNumbers(new TecDocPackageStructAxleKeyNumbersRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getAxleIdByKeyNumber()
if($tecDocPackageServiceGet->getAxleIdByKeyNumber(new TecDocPackageStructAxleIdByKeyNumberRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getAxleByIds()
if($tecDocPackageServiceGet->getAxleByIds(new TecDocPackageStructAxleByIdsRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getAxleByIdsStringList()
if($tecDocPackageServiceGet->getAxleByIdsStringList(new TecDocPackageStructAxleByIdsStringListRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getAxleByIds2()
if($tecDocPackageServiceGet->getAxleByIds2(new TecDocPackageStructAxleByIds2Request(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getAxleByIds2StringList()
if($tecDocPackageServiceGet->getAxleByIds2StringList(new TecDocPackageStructAxleByIds2StringListRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getAxleByIds2Single()
if($tecDocPackageServiceGet->getAxleByIds2Single(new TecDocPackageStructAxleByIds2SingleRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getMotorManufacturers2()
if($tecDocPackageServiceGet->getMotorManufacturers2(new TecDocPackageStructMotorManufacturers2Request(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getMotorIdsByManuIdCriteria()
if($tecDocPackageServiceGet->getMotorIdsByManuIdCriteria(new TecDocPackageStructMotorIdsByManuIdCriteriaRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getMotorIdsByManuIdCriteria2()
if($tecDocPackageServiceGet->getMotorIdsByManuIdCriteria2(new TecDocPackageStructMotorIdsByManuIdCriteria2Request(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getMotorsByCarTypeManuIdTerm()
if($tecDocPackageServiceGet->getMotorsByCarTypeManuIdTerm(new TecDocPackageStructMotorsByCarTypeManuIdTermRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getMotorsByCarTypeManuIdTerm2()
if($tecDocPackageServiceGet->getMotorsByCarTypeManuIdTerm2(new TecDocPackageStructMotorsByCarTypeManuIdTerm2Request(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getEngineIdsByTecDocEngineNo()
if($tecDocPackageServiceGet->getEngineIdsByTecDocEngineNo(new TecDocPackageStructEngineIdsByTecDocEngineNoRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getMotorByIds()
if($tecDocPackageServiceGet->getMotorByIds(new TecDocPackageStructMotorByIdsRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getMotorByIdsStringList()
if($tecDocPackageServiceGet->getMotorByIdsStringList(new TecDocPackageStructMotorByIdsStringListRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getMotorByIds2()
if($tecDocPackageServiceGet->getMotorByIds2(new TecDocPackageStructMotorByIds2Request(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getMotorByIds2StringList()
if($tecDocPackageServiceGet->getMotorByIds2StringList(new TecDocPackageStructMotorByIds2StringListRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getMotorByIds2Single()
if($tecDocPackageServiceGet->getMotorByIds2Single(new TecDocPackageStructMotorByIds2SingleRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getVendorIds()
if($tecDocPackageServiceGet->getVendorIds(new TecDocPackageStructVendorIdsRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getVendorIds2()
if($tecDocPackageServiceGet->getVendorIds2(new TecDocPackageStructVendorIds2Request(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getMarkById()
if($tecDocPackageServiceGet->getMarkById(new TecDocPackageStructMarkByIdRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getShortCuts2()
if($tecDocPackageServiceGet->getShortCuts2(new TecDocPackageStructShortCuts2Request(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getLinkedShortCuts()
if($tecDocPackageServiceGet->getLinkedShortCuts(new TecDocPackageStructLinkedShortCutsRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getChildNodesAllLinkingTarget2()
if($tecDocPackageServiceGet->getChildNodesAllLinkingTarget2(new TecDocPackageStructChildNodesAllLinkingTarget2Request(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getLinkedChildNodesAllLinkingTarget()
if($tecDocPackageServiceGet->getLinkedChildNodesAllLinkingTarget(new TecDocPackageStructLinkedChildNodesAllLinkingTargetRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getChildNodesAllLinkingTargetShortCut2()
if($tecDocPackageServiceGet->getChildNodesAllLinkingTargetShortCut2(new TecDocPackageStructChildNodesAllLinkingTargetShortCut2Request(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getLinkedChildNodesAllLinkingTargetShortCut()
if($tecDocPackageServiceGet->getLinkedChildNodesAllLinkingTargetShortCut(new TecDocPackageStructLinkedChildNodesAllLinkingTargetShortCutRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getChildNodesPattern()
if($tecDocPackageServiceGet->getChildNodesPattern(new TecDocPackageStructChildNodesPatternRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getGenericArticlesByManufacturer4()
if($tecDocPackageServiceGet->getGenericArticlesByManufacturer4(new TecDocPackageStructGenericArticlesByManufacturer4Request(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getGenericArticlesByManufacturer4StringList()
if($tecDocPackageServiceGet->getGenericArticlesByManufacturer4StringList(new TecDocPackageStructGenericArticlesByManufacturer4StringListRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getGenericArticlesByManufacturer4Single()
if($tecDocPackageServiceGet->getGenericArticlesByManufacturer4Single(new TecDocPackageStructGenericArticlesByManufacturer4SingleRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getGenericArticlesByManufacturer5()
if($tecDocPackageServiceGet->getGenericArticlesByManufacturer5(new TecDocPackageStructGenericArticlesByManufacturer5Request(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getGenericArticlesByManufacturer5Single()
if($tecDocPackageServiceGet->getGenericArticlesByManufacturer5Single(new TecDocPackageStructGenericArticlesByManufacturer5SingleRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getGenericArticlesByManufacturer6()
if($tecDocPackageServiceGet->getGenericArticlesByManufacturer6(new TecDocPackageStructGenericArticlesByManufacturer6Request(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getGenericArticlesByManufacturer6StringList()
if($tecDocPackageServiceGet->getGenericArticlesByManufacturer6StringList(new TecDocPackageStructGenericArticlesByManufacturer6StringListRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getGenericArticlesByManufacturer6Single()
if($tecDocPackageServiceGet->getGenericArticlesByManufacturer6Single(new TecDocPackageStructGenericArticlesByManufacturer6SingleRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getArticlesByIds2()
if($tecDocPackageServiceGet->getArticlesByIds2(new TecDocPackageStructArticlesByIdsRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getArticleIds2()
if($tecDocPackageServiceGet->getArticleIds2(new TecDocPackageStructArticleIds2Request(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getArticleIds2StringList()
if($tecDocPackageServiceGet->getArticleIds2StringList(new TecDocPackageStructArticleIds2StringListRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getArticleIds2Single()
if($tecDocPackageServiceGet->getArticleIds2Single(new TecDocPackageStructArticleIds2SingleRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getArticleIds3()
if($tecDocPackageServiceGet->getArticleIds3(new TecDocPackageStructArticleIds3Request(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getArticleIds3StringList()
if($tecDocPackageServiceGet->getArticleIds3StringList(new TecDocPackageStructArticleIds3StringListRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getArticleIds3Single()
if($tecDocPackageServiceGet->getArticleIds3Single(new TecDocPackageStructArticleIds3SingleRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getAssignedArticlesByIds2()
if($tecDocPackageServiceGet->getAssignedArticlesByIds2(new TecDocPackageStructAssignedArticlesByIdsRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getAssignedArticlesByIds2Single()
if($tecDocPackageServiceGet->getAssignedArticlesByIds2Single(new TecDocPackageStructAssignedArticlesByIdsSingleRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getArticleDirectSearchAllNumbers2()
if($tecDocPackageServiceGet->getArticleDirectSearchAllNumbers2(new TecDocPackageStructArticleDirectSearchAllNumbers2Request(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getDirectArticlesByIds2()
if($tecDocPackageServiceGet->getDirectArticlesByIds2(new TecDocPackageStructDirectArticlesByIdsRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getDirectArticlesByIds2StringList()
if($tecDocPackageServiceGet->getDirectArticlesByIds2StringList(new TecDocPackageStructDirectArticlesByIdsStringListRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getDirectArticlesByIds2Single()
if($tecDocPackageServiceGet->getDirectArticlesByIds2Single(new TecDocPackageStructDirectArticlesByIdsSingleRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getRequiredAttributes()
if($tecDocPackageServiceGet->getRequiredAttributes(new TecDocPackageStructRequiredAttributesRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getCriteriaAttributesByCriteriaArticles()
if($tecDocPackageServiceGet->getCriteriaAttributesByCriteriaArticles(new TecDocPackageStructCriteriaAttributesByCriteriaArticlesRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getCriteriaAttributesByCriteriaArticlesStringList()
if($tecDocPackageServiceGet->getCriteriaAttributesByCriteriaArticlesStringList(new TecDocPackageStructCriteriaAttributesByCriteriaArticlesStringListRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getCriteriaAttributesByCriteriaArticlesSingle()
if($tecDocPackageServiceGet->getCriteriaAttributesByCriteriaArticlesSingle(new TecDocPackageStructCriteriaAttributesByCriteriaArticlesSingleRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getCriteriaFilterArticlesByValues()
if($tecDocPackageServiceGet->getCriteriaFilterArticlesByValues(new TecDocPackageStructCriteriaFilterArticlesByValuesRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getCriteriaFilterArticlesByValuesStringList()
if($tecDocPackageServiceGet->getCriteriaFilterArticlesByValuesStringList(new TecDocPackageStructCriteriaFilterArticlesByValuesStringListRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getCriteriaFilterArticlesByValuesSingle()
if($tecDocPackageServiceGet->getCriteriaFilterArticlesByValuesSingle(new TecDocPackageStructCriteriaFilterArticlesByValuesSingleRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getCriteriaFilterArticlesByValuesNumeric()
if($tecDocPackageServiceGet->getCriteriaFilterArticlesByValuesNumeric(new TecDocPackageStructCriteriaFilterArticlesByValuesNumericRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getCriteriaFilterArticlesByValuesNumericStringList()
if($tecDocPackageServiceGet->getCriteriaFilterArticlesByValuesNumericStringList(new TecDocPackageStructCriteriaFilterArticlesByValuesNumericStringListRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getCriteriaFilterArticlesByValuesNumericSingle()
if($tecDocPackageServiceGet->getCriteriaFilterArticlesByValuesNumericSingle(new TecDocPackageStructCriteriaFilterArticlesByValuesNumericSingleRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getCriteriaFilterArticlesByValuesInterval()
if($tecDocPackageServiceGet->getCriteriaFilterArticlesByValuesInterval(new TecDocPackageStructCriteriaFilterArticlesByValuesIntervalRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getCriteriaFilterArticlesByValuesIntervalStringList()
if($tecDocPackageServiceGet->getCriteriaFilterArticlesByValuesIntervalStringList(new TecDocPackageStructCriteriaFilterArticlesByValuesIntervalStringListRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getCriteriaFilterArticlesByValuesIntervalSingle()
if($tecDocPackageServiceGet->getCriteriaFilterArticlesByValuesIntervalSingle(new TecDocPackageStructCriteriaFilterArticlesByValuesIntervalSingleRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getArticleDocuments()
if($tecDocPackageServiceGet->getArticleDocuments(new TecDocPackageStructArticleDocumentsRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getThumbnailByArticleId()
if($tecDocPackageServiceGet->getThumbnailByArticleId(new TecDocPackageStructThumbnailByArticleIdRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getCsgDocumentDataByArticleId2()
if($tecDocPackageServiceGet->getCsgDocumentDataByArticleId2(new TecDocPackageStructCsgDocumentDataByArticleIdRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getCsgDocumentsByArticleId()
if($tecDocPackageServiceGet->getCsgDocumentsByArticleId(new TecDocPackageStructCsgDocumentsByArticleIdRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getCoordinatesByArticleDocument()
if($tecDocPackageServiceGet->getCoordinatesByArticleDocument(new TecDocPackageStructCoordinatesByArticleDocumentRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getArticleDocumentsByDocId()
if($tecDocPackageServiceGet->getArticleDocumentsByDocId(new TecDocPackageStructArticleDocumentsByDocIdRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getArticleHasAccessoryList()
if($tecDocPackageServiceGet->getArticleHasAccessoryList(new TecDocPackageStructArticleHasAccessoryListRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getArticleAccessoryList4()
if($tecDocPackageServiceGet->getArticleAccessoryList4(new TecDocPackageStructArticleAccessoryListRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getArticlePartList2()
if($tecDocPackageServiceGet->getArticlePartList2(new TecDocPackageStructArticlePartList2Request(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getArticleLinkedAllLinkingTarget2()
if($tecDocPackageServiceGet->getArticleLinkedAllLinkingTarget2(new TecDocPackageStructArticleLinkedAllLinkingTarget2Request(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getArticleLinkedAllLinkingTargetManufacturer()
if($tecDocPackageServiceGet->getArticleLinkedAllLinkingTargetManufacturer(new TecDocPackageStructArticleLinkedAllLinkingTargetManufacturerRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getArticleLinkedAllLinkingTargetsByIds2()
if($tecDocPackageServiceGet->getArticleLinkedAllLinkingTargetsByIds2(new TecDocPackageStructArticleLinkedAllLinkingTargetsByIds2Request(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getArticleLinkedAllLinkingTargetsByIds2Single()
if($tecDocPackageServiceGet->getArticleLinkedAllLinkingTargetsByIds2Single(new TecDocPackageStructArticleLinkedAllLinkingTargetsByIds2SingleRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());
// sample call for TecDocPackageServiceGet::getPegasusVersionInfo()
if($tecDocPackageServiceGet->getPegasusVersionInfo(new TecDocPackageStructVersionInfoRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceGet->getResult());
else
	print_r($tecDocPackageServiceGet->getLastError());

/*************************************
 * Example for TecDocPackageServiceAdd
 */
$tecDocPackageServiceAdd = new TecDocPackageServiceAdd($wsdl);
// sample call for TecDocPackageServiceAdd::addDynamicAddress()
if($tecDocPackageServiceAdd->addDynamicAddress(new TecDocPackageStructDynamicAddressRequest(/*** update parameters list ***/)))
	print_r($tecDocPackageServiceAdd->getResult());
else
	print_r($tecDocPackageServiceAdd->getLastError());
?>