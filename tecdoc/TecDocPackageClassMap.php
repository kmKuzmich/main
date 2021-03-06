<?php
/**
 * File for the class which returns the class map definition
 * @package TecDocPackage
 * @date 2013-02-10
 */
/**
 * Class which returns the class map definition by the static method TecDocPackageClassMap::classMap()
 * @package TecDocPackage
 * @date 2013-02-10
 */
class TecDocPackageClassMap
{
	/**
	 * This method returns the array containing the mapping between WSDL structs and generated classes
	 * This array is sent to the SoapClient when calling the WS
	 * @return array
	 */
	final public static function classMap()
	{
		return array (
  'ArticleAccessoryImmediateAttributsRecord' => 'TecDocPackageStructArticleAccessoryImmediateAttributsRecord',
  'ArticleAccessoryImmediateAttributsRecordSeq' => 'TecDocPackageStructArticleAccessoryImmediateAttributsRecordSeq',
  'ArticleAccessoryList3Record' => 'TecDocPackageStructArticleAccessoryList3Record',
  'ArticleAccessoryList4Record' => 'TecDocPackageStructArticleAccessoryList4Record',
  'ArticleAccessoryList4RecordSeq' => 'TecDocPackageStructArticleAccessoryList4RecordSeq',
  'ArticleAccessoryList4Response' => 'TecDocPackageStructArticleAccessoryList4Response',
  'ArticleAccessoryListRequest' => 'TecDocPackageStructArticleAccessoryListRequest',
  'ArticleDirectSearchAllNumbers2Request' => 'TecDocPackageStructArticleDirectSearchAllNumbers2Request',
  'ArticleDirectSearchAllNumbersRecord' => 'TecDocPackageStructArticleDirectSearchAllNumbersRecord',
  'ArticleDirectSearchAllNumbersRecordSeq' => 'TecDocPackageStructArticleDirectSearchAllNumbersRecordSeq',
  'ArticleDirectSearchAllNumbersResponse' => 'TecDocPackageStructArticleDirectSearchAllNumbersResponse',
  'ArticleDirectSearchById2Record' => 'TecDocPackageStructArticleDirectSearchById2Record',
  'ArticleDocumentsByDocIdRecord' => 'TecDocPackageStructArticleDocumentsByDocIdRecord',
  'ArticleDocumentsByDocIdRecordSeq' => 'TecDocPackageStructArticleDocumentsByDocIdRecordSeq',
  'ArticleDocumentsByDocIdRequest' => 'TecDocPackageStructArticleDocumentsByDocIdRequest',
  'ArticleDocumentsByDocIdResponse' => 'TecDocPackageStructArticleDocumentsByDocIdResponse',
  'ArticleDocumentsRecord' => 'TecDocPackageStructArticleDocumentsRecord',
  'ArticleDocumentsRecordSeq' => 'TecDocPackageStructArticleDocumentsRecordSeq',
  'ArticleDocumentsRequest' => 'TecDocPackageStructArticleDocumentsRequest',
  'ArticleDocumentsResponse' => 'TecDocPackageStructArticleDocumentsResponse',
  'ArticleHasAccessoryListRecord' => 'TecDocPackageStructArticleHasAccessoryListRecord',
  'ArticleHasAccessoryListRecordSeq' => 'TecDocPackageStructArticleHasAccessoryListRecordSeq',
  'ArticleHasAccessoryListRequest' => 'TecDocPackageStructArticleHasAccessoryListRequest',
  'ArticleHasAccessoryListResponse' => 'TecDocPackageStructArticleHasAccessoryListResponse',
  'ArticleIdPair' => 'TecDocPackageStructArticleIdPair',
  'ArticleIdPairSeq' => 'TecDocPackageStructArticleIdPairSeq',
  'ArticleIds2Record' => 'TecDocPackageStructArticleIds2Record',
  'ArticleIds2RecordSeq' => 'TecDocPackageStructArticleIds2RecordSeq',
  'ArticleIds2Request' => 'TecDocPackageStructArticleIds2Request',
  'ArticleIds2Response' => 'TecDocPackageStructArticleIds2Response',
  'ArticleIds2SingleRequest' => 'TecDocPackageStructArticleIds2SingleRequest',
  'ArticleIds2StringListRequest' => 'TecDocPackageStructArticleIds2StringListRequest',
  'ArticleIds3Record' => 'TecDocPackageStructArticleIds3Record',
  'ArticleIds3RecordSeq' => 'TecDocPackageStructArticleIds3RecordSeq',
  'ArticleIds3Request' => 'TecDocPackageStructArticleIds3Request',
  'ArticleIds3Response' => 'TecDocPackageStructArticleIds3Response',
  'ArticleIds3SingleRequest' => 'TecDocPackageStructArticleIds3SingleRequest',
  'ArticleIds3StringListRequest' => 'TecDocPackageStructArticleIds3StringListRequest',
  'ArticleLinkedAllLinkingTarget2Request' => 'TecDocPackageStructArticleLinkedAllLinkingTarget2Request',
  'ArticleLinkedAllLinkingTargetManufacturerRecord' => 'TecDocPackageStructArticleLinkedAllLinkingTargetManufacturerRecord',
  'ArticleLinkedAllLinkingTargetManufacturerRecordSeq' => 'TecDocPackageStructArticleLinkedAllLinkingTargetManufacturerRecordSeq',
  'ArticleLinkedAllLinkingTargetManufacturerRequest' => 'TecDocPackageStructArticleLinkedAllLinkingTargetManufacturerRequest',
  'ArticleLinkedAllLinkingTargetManufacturerResponse' => 'TecDocPackageStructArticleLinkedAllLinkingTargetManufacturerResponse',
  'ArticleLinkedAllLinkingTargetRecord' => 'TecDocPackageStructArticleLinkedAllLinkingTargetRecord',
  'ArticleLinkedAllLinkingTargetRecordSeq' => 'TecDocPackageStructArticleLinkedAllLinkingTargetRecordSeq',
  'ArticleLinkedAllLinkingTargetResponse' => 'TecDocPackageStructArticleLinkedAllLinkingTargetResponse',
  'ArticleLinkedAllLinkingTargetsByIds2Record' => 'TecDocPackageStructArticleLinkedAllLinkingTargetsByIds2Record',
  'ArticleLinkedAllLinkingTargetsByIds2RecordSeq' => 'TecDocPackageStructArticleLinkedAllLinkingTargetsByIds2RecordSeq',
  'ArticleLinkedAllLinkingTargetsByIds2Request' => 'TecDocPackageStructArticleLinkedAllLinkingTargetsByIds2Request',
  'ArticleLinkedAllLinkingTargetsByIds2Response' => 'TecDocPackageStructArticleLinkedAllLinkingTargetsByIds2Response',
  'ArticleLinkedAllLinkingTargetsByIds2SingleRequest' => 'TecDocPackageStructArticleLinkedAllLinkingTargetsByIds2SingleRequest',
  'ArticleLinkedMotorsByIdRecord' => 'TecDocPackageStructArticleLinkedMotorsByIdRecord',
  'ArticleLinkedMotorsByIdRecordSeq' => 'TecDocPackageStructArticleLinkedMotorsByIdRecordSeq',
  'ArticleLinkedVehiclesByIdRecord' => 'TecDocPackageStructArticleLinkedVehiclesByIdRecord',
  'ArticleLinkedVehiclesByIdRecordSeq' => 'TecDocPackageStructArticleLinkedVehiclesByIdRecordSeq',
  'ArticleOENumbersRecord' => 'TecDocPackageStructArticleOENumbersRecord',
  'ArticleOENumbersRecordSeq' => 'TecDocPackageStructArticleOENumbersRecordSeq',
  'ArticlePartList2Record' => 'TecDocPackageStructArticlePartList2Record',
  'ArticlePartList2RecordSeq' => 'TecDocPackageStructArticlePartList2RecordSeq',
  'ArticlePartList2Request' => 'TecDocPackageStructArticlePartList2Request',
  'ArticlePartList2Response' => 'TecDocPackageStructArticlePartList2Response',
  'ArticlePricesNormalAustauschRecord' => 'TecDocPackageStructArticlePricesNormalAustauschRecord',
  'ArticlePricesNormalAustauschRecordSeq' => 'TecDocPackageStructArticlePricesNormalAustauschRecordSeq',
  'ArticlePricesRecord' => 'TecDocPackageStructArticlePricesRecord',
  'ArticlePricesRecordSeq' => 'TecDocPackageStructArticlePricesRecordSeq',
  'ArticlesByIds2Record' => 'TecDocPackageStructArticlesByIds2Record',
  'ArticlesByIds2RecordSeq' => 'TecDocPackageStructArticlesByIds2RecordSeq',
  'ArticlesByIds2Response' => 'TecDocPackageStructArticlesByIds2Response',
  'ArticlesByIdsRequest' => 'TecDocPackageStructArticlesByIdsRequest',
  'AssignedArticleAttributsRecord' => 'TecDocPackageStructAssignedArticleAttributsRecord',
  'AssignedArticleAttributsRecordSeq' => 'TecDocPackageStructAssignedArticleAttributsRecordSeq',
  'AssignedArticleById2Record' => 'TecDocPackageStructAssignedArticleById2Record',
  'AssignedArticleInfosRecord' => 'TecDocPackageStructAssignedArticleInfosRecord',
  'AssignedArticleInfosRecordSeq' => 'TecDocPackageStructAssignedArticleInfosRecordSeq',
  'AssignedArticlesByIdsRequest' => 'TecDocPackageStructAssignedArticlesByIdsRequest',
  'AssignedArticlesByIdsSingleRequest' => 'TecDocPackageStructAssignedArticlesByIdsSingleRequest',
  'AxisConfigurationsRecord' => 'TecDocPackageStructAxisConfigurationsRecord',
  'AxisConfigurationsRecordSeq' => 'TecDocPackageStructAxisConfigurationsRecordSeq',
  'AxisConfigurationsRequest' => 'TecDocPackageStructAxisConfigurationsRequest',
  'AxisConfigurationsResponse' => 'TecDocPackageStructAxisConfigurationsResponse',
  'AxleBrakeSizesRecord' => 'TecDocPackageStructAxleBrakeSizesRecord',
  'AxleBrakeSizesRecordSeq' => 'TecDocPackageStructAxleBrakeSizesRecordSeq',
  'AxleBrakeSizesRequest' => 'TecDocPackageStructAxleBrakeSizesRequest',
  'AxleBrakeSizesResponse' => 'TecDocPackageStructAxleBrakeSizesResponse',
  'AxleByCarIdRecord' => 'TecDocPackageStructAxleByCarIdRecord',
  'AxleByCarIdRecordSeq' => 'TecDocPackageStructAxleByCarIdRecordSeq',
  'AxleByIdRecord' => 'TecDocPackageStructAxleByIdRecord',
  'AxleByIdRecordSeq' => 'TecDocPackageStructAxleByIdRecordSeq',
  'AxleByIds2Record' => 'TecDocPackageStructAxleByIds2Record',
  'AxleByIds2RecordSeq' => 'TecDocPackageStructAxleByIds2RecordSeq',
  'AxleByIds2Request' => 'TecDocPackageStructAxleByIds2Request',
  'AxleByIds2Response' => 'TecDocPackageStructAxleByIds2Response',
  'AxleByIds2SingleRequest' => 'TecDocPackageStructAxleByIds2SingleRequest',
  'AxleByIds2StringListRequest' => 'TecDocPackageStructAxleByIds2StringListRequest',
  'AxleByIdsRecord' => 'TecDocPackageStructAxleByIdsRecord',
  'AxleByIdsRecordSeq' => 'TecDocPackageStructAxleByIdsRecordSeq',
  'AxleByIdsRequest' => 'TecDocPackageStructAxleByIdsRequest',
  'AxleByIdsResponse' => 'TecDocPackageStructAxleByIdsResponse',
  'AxleByIdsStringListRequest' => 'TecDocPackageStructAxleByIdsStringListRequest',
  'AxleDetailsByIdRecord' => 'TecDocPackageStructAxleDetailsByIdRecord',
  'AxleDetailsByIdRecordSeq' => 'TecDocPackageStructAxleDetailsByIdRecordSeq',
  'AxleIdByKeyNumberRecord' => 'TecDocPackageStructAxleIdByKeyNumberRecord',
  'AxleIdByKeyNumberRecordSeq' => 'TecDocPackageStructAxleIdByKeyNumberRecordSeq',
  'AxleIdByKeyNumberRequest' => 'TecDocPackageStructAxleIdByKeyNumberRequest',
  'AxleIdByKeyNumberResponse' => 'TecDocPackageStructAxleIdByKeyNumberResponse',
  'AxleIdByTypeManCriteria2Record' => 'TecDocPackageStructAxleIdByTypeManCriteria2Record',
  'AxleIdByTypeManCriteria2RecordSeq' => 'TecDocPackageStructAxleIdByTypeManCriteria2RecordSeq',
  'AxleIdByTypeManCriteria2Request' => 'TecDocPackageStructAxleIdByTypeManCriteria2Request',
  'AxleIdByTypeManCriteria2Response' => 'TecDocPackageStructAxleIdByTypeManCriteria2Response',
  'AxleIdByTypeManCriteria3Record' => 'TecDocPackageStructAxleIdByTypeManCriteria3Record',
  'AxleIdByTypeManCriteria3RecordSeq' => 'TecDocPackageStructAxleIdByTypeManCriteria3RecordSeq',
  'AxleIdByTypeManCriteria3Request' => 'TecDocPackageStructAxleIdByTypeManCriteria3Request',
  'AxleIdByTypeManCriteria3Response' => 'TecDocPackageStructAxleIdByTypeManCriteria3Response',
  'AxleKeyNumbersRecord' => 'TecDocPackageStructAxleKeyNumbersRecord',
  'AxleKeyNumbersRecordSeq' => 'TecDocPackageStructAxleKeyNumbersRecordSeq',
  'AxleKeyNumbersRequest' => 'TecDocPackageStructAxleKeyNumbersRequest',
  'AxleKeyNumbersResponse' => 'TecDocPackageStructAxleKeyNumbersResponse',
  'AxleModelsRecord' => 'TecDocPackageStructAxleModelsRecord',
  'AxleModelsRecordSeq' => 'TecDocPackageStructAxleModelsRecordSeq',
  'AxleModelsRequest' => 'TecDocPackageStructAxleModelsRequest',
  'AxleModelsResponse' => 'TecDocPackageStructAxleModelsResponse',
  'AxleStylesRecord' => 'TecDocPackageStructAxleStylesRecord',
  'AxleStylesRecordSeq' => 'TecDocPackageStructAxleStylesRecordSeq',
  'AxleStylesRequest' => 'TecDocPackageStructAxleStylesRequest',
  'AxleStylesResponse' => 'TecDocPackageStructAxleStylesResponse',
  'AxleTypesRecord' => 'TecDocPackageStructAxleTypesRecord',
  'AxleTypesRecordSeq' => 'TecDocPackageStructAxleTypesRecordSeq',
  'AxleTypesRequest' => 'TecDocPackageStructAxleTypesRequest',
  'AxleTypesResponse' => 'TecDocPackageStructAxleTypesResponse',
  'AxleWheelbasesRecord' => 'TecDocPackageStructAxleWheelbasesRecord',
  'AxleWheelbasesRecordSeq' => 'TecDocPackageStructAxleWheelbasesRecordSeq',
  'AxlesManufacturers2Record' => 'TecDocPackageStructAxlesManufacturers2Record',
  'AxlesManufacturers2RecordSeq' => 'TecDocPackageStructAxlesManufacturers2RecordSeq',
  'AxlesManufacturers2Request' => 'TecDocPackageStructAxlesManufacturers2Request',
  'AxlesManufacturers2Response' => 'TecDocPackageStructAxlesManufacturers2Response',
  'BrandsForAssortmentRecord' => 'TecDocPackageStructBrandsForAssortmentRecord',
  'BrandsForAssortmentRecordSeq' => 'TecDocPackageStructBrandsForAssortmentRecordSeq',
  'BrandsForAssortmentRequest' => 'TecDocPackageStructBrandsForAssortmentRequest',
  'BrandsForAssortmentResponse' => 'TecDocPackageStructBrandsForAssortmentResponse',
  'CabsByCarIdRecord' => 'TecDocPackageStructCabsByCarIdRecord',
  'CabsByCarIdRecordSeq' => 'TecDocPackageStructCabsByCarIdRecordSeq',
  'ChildNodesAllLinkingTarget2Record' => 'TecDocPackageStructChildNodesAllLinkingTarget2Record',
  'ChildNodesAllLinkingTarget2RecordSeq' => 'TecDocPackageStructChildNodesAllLinkingTarget2RecordSeq',
  'ChildNodesAllLinkingTarget2Request' => 'TecDocPackageStructChildNodesAllLinkingTarget2Request',
  'ChildNodesAllLinkingTarget2Response' => 'TecDocPackageStructChildNodesAllLinkingTarget2Response',
  'ChildNodesAllLinkingTargetShortCut2Record' => 'TecDocPackageStructChildNodesAllLinkingTargetShortCut2Record',
  'ChildNodesAllLinkingTargetShortCut2RecordSeq' => 'TecDocPackageStructChildNodesAllLinkingTargetShortCut2RecordSeq',
  'ChildNodesAllLinkingTargetShortCut2Request' => 'TecDocPackageStructChildNodesAllLinkingTargetShortCut2Request',
  'ChildNodesAllLinkingTargetShortCut2Response' => 'TecDocPackageStructChildNodesAllLinkingTargetShortCut2Response',
  'ChildNodesPatternRecord' => 'TecDocPackageStructChildNodesPatternRecord',
  'ChildNodesPatternRecordSeq' => 'TecDocPackageStructChildNodesPatternRecordSeq',
  'ChildNodesPatternRequest' => 'TecDocPackageStructChildNodesPatternRequest',
  'ChildNodesPatternResponse' => 'TecDocPackageStructChildNodesPatternResponse',
  'ConstructionTypesRecord' => 'TecDocPackageStructConstructionTypesRecord',
  'ConstructionTypesRecordSeq' => 'TecDocPackageStructConstructionTypesRecordSeq',
  'ConstructionTypesRequest' => 'TecDocPackageStructConstructionTypesRequest',
  'ConstructionTypesResponse' => 'TecDocPackageStructConstructionTypesResponse',
  'CoordinatesByArticleDocumentRecord' => 'TecDocPackageStructCoordinatesByArticleDocumentRecord',
  'CoordinatesByArticleDocumentRecordSeq' => 'TecDocPackageStructCoordinatesByArticleDocumentRecordSeq',
  'CoordinatesByArticleDocumentRequest' => 'TecDocPackageStructCoordinatesByArticleDocumentRequest',
  'CoordinatesByArticleDocumentResponse' => 'TecDocPackageStructCoordinatesByArticleDocumentResponse',
  'CountriesRecord' => 'TecDocPackageStructCountriesRecord',
  'CountriesRecordSeq' => 'TecDocPackageStructCountriesRecordSeq',
  'CountriesRequest' => 'TecDocPackageStructCountriesRequest',
  'CountriesResponse' => 'TecDocPackageStructCountriesResponse',
  'CountryGroupsRecord' => 'TecDocPackageStructCountryGroupsRecord',
  'CountryGroupsRecordSeq' => 'TecDocPackageStructCountryGroupsRecordSeq',
  'CountryGroupsRequest' => 'TecDocPackageStructCountryGroupsRequest',
  'CountryGroupsResponse' => 'TecDocPackageStructCountryGroupsResponse',
  'Criteria2Record' => 'TecDocPackageStructCriteria2Record',
  'Criteria2RecordSeq' => 'TecDocPackageStructCriteria2RecordSeq',
  'Criteria2Response' => 'TecDocPackageStructCriteria2Response',
  'CriteriaAttributesByCriteriaArticlesRecord' => 'TecDocPackageStructCriteriaAttributesByCriteriaArticlesRecord',
  'CriteriaAttributesByCriteriaArticlesRecordSeq' => 'TecDocPackageStructCriteriaAttributesByCriteriaArticlesRecordSeq',
  'CriteriaAttributesByCriteriaArticlesRequest' => 'TecDocPackageStructCriteriaAttributesByCriteriaArticlesRequest',
  'CriteriaAttributesByCriteriaArticlesResponse' => 'TecDocPackageStructCriteriaAttributesByCriteriaArticlesResponse',
  'CriteriaAttributesByCriteriaArticlesSingleRequest' => 'TecDocPackageStructCriteriaAttributesByCriteriaArticlesSingleRequest',
  'CriteriaAttributesByCriteriaArticlesStringListRequest' => 'TecDocPackageStructCriteriaAttributesByCriteriaArticlesStringListRequest',
  'CriteriaFilterArticlesByValuesIntervalRecord' => 'TecDocPackageStructCriteriaFilterArticlesByValuesIntervalRecord',
  'CriteriaFilterArticlesByValuesIntervalRecordSeq' => 'TecDocPackageStructCriteriaFilterArticlesByValuesIntervalRecordSeq',
  'CriteriaFilterArticlesByValuesIntervalRequest' => 'TecDocPackageStructCriteriaFilterArticlesByValuesIntervalRequest',
  'CriteriaFilterArticlesByValuesIntervalResponse' => 'TecDocPackageStructCriteriaFilterArticlesByValuesIntervalResponse',
  'CriteriaFilterArticlesByValuesIntervalSingleRequest' => 'TecDocPackageStructCriteriaFilterArticlesByValuesIntervalSingleRequest',
  'CriteriaFilterArticlesByValuesIntervalStringListRequest' => 'TecDocPackageStructCriteriaFilterArticlesByValuesIntervalStringListRequest',
  'CriteriaFilterArticlesByValuesNumericRecord' => 'TecDocPackageStructCriteriaFilterArticlesByValuesNumericRecord',
  'CriteriaFilterArticlesByValuesNumericRecordSeq' => 'TecDocPackageStructCriteriaFilterArticlesByValuesNumericRecordSeq',
  'CriteriaFilterArticlesByValuesNumericRequest' => 'TecDocPackageStructCriteriaFilterArticlesByValuesNumericRequest',
  'CriteriaFilterArticlesByValuesNumericResponse' => 'TecDocPackageStructCriteriaFilterArticlesByValuesNumericResponse',
  'CriteriaFilterArticlesByValuesNumericSingleRequest' => 'TecDocPackageStructCriteriaFilterArticlesByValuesNumericSingleRequest',
  'CriteriaFilterArticlesByValuesNumericStringListRequest' => 'TecDocPackageStructCriteriaFilterArticlesByValuesNumericStringListRequest',
  'CriteriaFilterArticlesByValuesRecord' => 'TecDocPackageStructCriteriaFilterArticlesByValuesRecord',
  'CriteriaFilterArticlesByValuesRecordSeq' => 'TecDocPackageStructCriteriaFilterArticlesByValuesRecordSeq',
  'CriteriaFilterArticlesByValuesRequest' => 'TecDocPackageStructCriteriaFilterArticlesByValuesRequest',
  'CriteriaFilterArticlesByValuesResponse' => 'TecDocPackageStructCriteriaFilterArticlesByValuesResponse',
  'CriteriaFilterArticlesByValuesSingleRequest' => 'TecDocPackageStructCriteriaFilterArticlesByValuesSingleRequest',
  'CriteriaFilterArticlesByValuesStringListRequest' => 'TecDocPackageStructCriteriaFilterArticlesByValuesStringListRequest',
  'CriteriaRequest' => 'TecDocPackageStructCriteriaRequest',
  'CsgDocumentDataByArticleId2Record' => 'TecDocPackageStructCsgDocumentDataByArticleId2Record',
  'CsgDocumentDataByArticleId2RecordSeq' => 'TecDocPackageStructCsgDocumentDataByArticleId2RecordSeq',
  'CsgDocumentDataByArticleId2Response' => 'TecDocPackageStructCsgDocumentDataByArticleId2Response',
  'CsgDocumentDataByArticleIdRequest' => 'TecDocPackageStructCsgDocumentDataByArticleIdRequest',
  'CsgDocumentsByArticleIdRecord' => 'TecDocPackageStructCsgDocumentsByArticleIdRecord',
  'CsgDocumentsByArticleIdRecordSeq' => 'TecDocPackageStructCsgDocumentsByArticleIdRecordSeq',
  'CsgDocumentsByArticleIdRequest' => 'TecDocPackageStructCsgDocumentsByArticleIdRequest',
  'CsgDocumentsByArticleIdResponse' => 'TecDocPackageStructCsgDocumentsByArticleIdResponse',
  'DirectArticlesByIdsRequest' => 'TecDocPackageStructDirectArticlesByIdsRequest',
  'DirectArticlesByIdsSingleRequest' => 'TecDocPackageStructDirectArticlesByIdsSingleRequest',
  'DirectArticlesByIdsStringListRequest' => 'TecDocPackageStructDirectArticlesByIdsStringListRequest',
  'DynamicAddressRequest' => 'TecDocPackageStructDynamicAddressRequest',
  'DynamicAddressRequestSrc' => 'TecDocPackageStructDynamicAddressRequestSrc',
  'DynamicAddressResponse' => 'TecDocPackageStructDynamicAddressResponse',
  'DynamicAddressResponseSrc' => 'TecDocPackageStructDynamicAddressResponseSrc',
  'EanNumbersRecord' => 'TecDocPackageStructEanNumbersRecord',
  'EanNumbersRecordSeq' => 'TecDocPackageStructEanNumbersRecordSeq',
  'EngineIdsByTecDocEngineNoRecord' => 'TecDocPackageStructEngineIdsByTecDocEngineNoRecord',
  'EngineIdsByTecDocEngineNoRecordSeq' => 'TecDocPackageStructEngineIdsByTecDocEngineNoRecordSeq',
  'EngineIdsByTecDocEngineNoRequest' => 'TecDocPackageStructEngineIdsByTecDocEngineNoRequest',
  'EngineIdsByTecDocEngineNoResponse' => 'TecDocPackageStructEngineIdsByTecDocEngineNoResponse',
  'FuelTypesRecord' => 'TecDocPackageStructFuelTypesRecord',
  'FuelTypesRecordSeq' => 'TecDocPackageStructFuelTypesRecordSeq',
  'FuelTypesRequest' => 'TecDocPackageStructFuelTypesRequest',
  'FuelTypesResponse' => 'TecDocPackageStructFuelTypesResponse',
  'GenericArticlesByManufacturer4Record' => 'TecDocPackageStructGenericArticlesByManufacturer4Record',
  'GenericArticlesByManufacturer4RecordSeq' => 'TecDocPackageStructGenericArticlesByManufacturer4RecordSeq',
  'GenericArticlesByManufacturer4Request' => 'TecDocPackageStructGenericArticlesByManufacturer4Request',
  'GenericArticlesByManufacturer4Response' => 'TecDocPackageStructGenericArticlesByManufacturer4Response',
  'GenericArticlesByManufacturer4SingleRequest' => 'TecDocPackageStructGenericArticlesByManufacturer4SingleRequest',
  'GenericArticlesByManufacturer4StringListRequest' => 'TecDocPackageStructGenericArticlesByManufacturer4StringListRequest',
  'GenericArticlesByManufacturer5Record' => 'TecDocPackageStructGenericArticlesByManufacturer5Record',
  'GenericArticlesByManufacturer5RecordSeq' => 'TecDocPackageStructGenericArticlesByManufacturer5RecordSeq',
  'GenericArticlesByManufacturer5Request' => 'TecDocPackageStructGenericArticlesByManufacturer5Request',
  'GenericArticlesByManufacturer5Response' => 'TecDocPackageStructGenericArticlesByManufacturer5Response',
  'GenericArticlesByManufacturer5SingleRequest' => 'TecDocPackageStructGenericArticlesByManufacturer5SingleRequest',
  'GenericArticlesByManufacturer6Record' => 'TecDocPackageStructGenericArticlesByManufacturer6Record',
  'GenericArticlesByManufacturer6RecordSeq' => 'TecDocPackageStructGenericArticlesByManufacturer6RecordSeq',
  'GenericArticlesByManufacturer6Request' => 'TecDocPackageStructGenericArticlesByManufacturer6Request',
  'GenericArticlesByManufacturer6Response' => 'TecDocPackageStructGenericArticlesByManufacturer6Response',
  'GenericArticlesByManufacturer6SingleRequest' => 'TecDocPackageStructGenericArticlesByManufacturer6SingleRequest',
  'GenericArticlesByManufacturer6StringListRequest' => 'TecDocPackageStructGenericArticlesByManufacturer6StringListRequest',
  'ImmediateAttributsLinkedElementsRecord' => 'TecDocPackageStructImmediateAttributsLinkedElementsRecord',
  'ImmediateAttributsLinkedElementsRecordSeq' => 'TecDocPackageStructImmediateAttributsLinkedElementsRecordSeq',
  'ImmediateAttributsRecord' => 'TecDocPackageStructImmediateAttributsRecord',
  'ImmediateAttributsRecordSeq' => 'TecDocPackageStructImmediateAttributsRecordSeq',
  'ImmediateInfosRecord' => 'TecDocPackageStructImmediateInfosRecord',
  'ImmediateInfosRecordSeq' => 'TecDocPackageStructImmediateInfosRecordSeq',
  'KeyValuesForTraderModeRecord' => 'TecDocPackageStructKeyValuesForTraderModeRecord',
  'KeyValuesForTraderModeRecordSeq' => 'TecDocPackageStructKeyValuesForTraderModeRecordSeq',
  'KeyValuesForTraderModeRequest' => 'TecDocPackageStructKeyValuesForTraderModeRequest',
  'KeyValuesForTraderModeResponse' => 'TecDocPackageStructKeyValuesForTraderModeResponse',
  'LanguagesRecord' => 'TecDocPackageStructLanguagesRecord',
  'LanguagesRecordSeq' => 'TecDocPackageStructLanguagesRecordSeq',
  'LanguagesRequest' => 'TecDocPackageStructLanguagesRequest',
  'LanguagesResponse' => 'TecDocPackageStructLanguagesResponse',
  'LinkedArticlePair' => 'TecDocPackageStructLinkedArticlePair',
  'LinkedArticlePairSeq' => 'TecDocPackageStructLinkedArticlePairSeq',
  'LinkedChildNodesAllLinkingTargetRequest' => 'TecDocPackageStructLinkedChildNodesAllLinkingTargetRequest',
  'LinkedChildNodesAllLinkingTargetShortCutRequest' => 'TecDocPackageStructLinkedChildNodesAllLinkingTargetShortCutRequest',
  'LinkedShortCutsRequest' => 'TecDocPackageStructLinkedShortCutsRequest',
  'LongList' => 'TecDocPackageStructLongList',
  'MainArticlesRecord' => 'TecDocPackageStructMainArticlesRecord',
  'MainArticlesRecordSeq' => 'TecDocPackageStructMainArticlesRecordSeq',
  'ManufacturerInfosById2Record' => 'TecDocPackageStructManufacturerInfosById2Record',
  'ManufacturerInfosById2RecordSeq' => 'TecDocPackageStructManufacturerInfosById2RecordSeq',
  'ManufacturerInfosById2Request' => 'TecDocPackageStructManufacturerInfosById2Request',
  'ManufacturerInfosById2Response' => 'TecDocPackageStructManufacturerInfosById2Response',
  'ManufacturerInfosByIdRecord' => 'TecDocPackageStructManufacturerInfosByIdRecord',
  'ManufacturerInfosByIdRecordSeq' => 'TecDocPackageStructManufacturerInfosByIdRecordSeq',
  'ManufacturerInfosByIdRequest' => 'TecDocPackageStructManufacturerInfosByIdRequest',
  'ManufacturerInfosByIdResponse' => 'TecDocPackageStructManufacturerInfosByIdResponse',
  'MarkByIdRecord' => 'TecDocPackageStructMarkByIdRecord',
  'MarkByIdRecordSeq' => 'TecDocPackageStructMarkByIdRecordSeq',
  'MarkByIdRequest' => 'TecDocPackageStructMarkByIdRequest',
  'MarkByIdResponse' => 'TecDocPackageStructMarkByIdResponse',
  'MotorByIdRecord' => 'TecDocPackageStructMotorByIdRecord',
  'MotorByIds2Record' => 'TecDocPackageStructMotorByIds2Record',
  'MotorByIds2RecordSeq' => 'TecDocPackageStructMotorByIds2RecordSeq',
  'MotorByIds2Request' => 'TecDocPackageStructMotorByIds2Request',
  'MotorByIds2Response' => 'TecDocPackageStructMotorByIds2Response',
  'MotorByIds2SingleRequest' => 'TecDocPackageStructMotorByIds2SingleRequest',
  'MotorByIds2StringListRequest' => 'TecDocPackageStructMotorByIds2StringListRequest',
  'MotorByIdsRecord' => 'TecDocPackageStructMotorByIdsRecord',
  'MotorByIdsRecordSeq' => 'TecDocPackageStructMotorByIdsRecordSeq',
  'MotorByIdsRequest' => 'TecDocPackageStructMotorByIdsRequest',
  'MotorByIdsResponse' => 'TecDocPackageStructMotorByIdsResponse',
  'MotorByIdsStringListRequest' => 'TecDocPackageStructMotorByIdsStringListRequest',
  'MotorCodesByCarIdRecord' => 'TecDocPackageStructMotorCodesByCarIdRecord',
  'MotorCodesByCarIdRecordSeq' => 'TecDocPackageStructMotorCodesByCarIdRecordSeq',
  'MotorDetailsRecord' => 'TecDocPackageStructMotorDetailsRecord',
  'MotorIdsByManuIdCriteria2Record' => 'TecDocPackageStructMotorIdsByManuIdCriteria2Record',
  'MotorIdsByManuIdCriteria2RecordSeq' => 'TecDocPackageStructMotorIdsByManuIdCriteria2RecordSeq',
  'MotorIdsByManuIdCriteria2Request' => 'TecDocPackageStructMotorIdsByManuIdCriteria2Request',
  'MotorIdsByManuIdCriteria2Response' => 'TecDocPackageStructMotorIdsByManuIdCriteria2Response',
  'MotorIdsByManuIdCriteriaRecord' => 'TecDocPackageStructMotorIdsByManuIdCriteriaRecord',
  'MotorIdsByManuIdCriteriaRecordSeq' => 'TecDocPackageStructMotorIdsByManuIdCriteriaRecordSeq',
  'MotorIdsByManuIdCriteriaRequest' => 'TecDocPackageStructMotorIdsByManuIdCriteriaRequest',
  'MotorIdsByManuIdCriteriaResponse' => 'TecDocPackageStructMotorIdsByManuIdCriteriaResponse',
  'MotorManufacturers2Record' => 'TecDocPackageStructMotorManufacturers2Record',
  'MotorManufacturers2RecordSeq' => 'TecDocPackageStructMotorManufacturers2RecordSeq',
  'MotorManufacturers2Request' => 'TecDocPackageStructMotorManufacturers2Request',
  'MotorManufacturers2Response' => 'TecDocPackageStructMotorManufacturers2Response',
  'MotorsByCarTypeManuIdTerm2Record' => 'TecDocPackageStructMotorsByCarTypeManuIdTerm2Record',
  'MotorsByCarTypeManuIdTerm2RecordSeq' => 'TecDocPackageStructMotorsByCarTypeManuIdTerm2RecordSeq',
  'MotorsByCarTypeManuIdTerm2Request' => 'TecDocPackageStructMotorsByCarTypeManuIdTerm2Request',
  'MotorsByCarTypeManuIdTerm2Response' => 'TecDocPackageStructMotorsByCarTypeManuIdTerm2Response',
  'MotorsByCarTypeManuIdTermRecord' => 'TecDocPackageStructMotorsByCarTypeManuIdTermRecord',
  'MotorsByCarTypeManuIdTermRecordSeq' => 'TecDocPackageStructMotorsByCarTypeManuIdTermRecordSeq',
  'MotorsByCarTypeManuIdTermRequest' => 'TecDocPackageStructMotorsByCarTypeManuIdTermRequest',
  'MotorsByCarTypeManuIdTermResponse' => 'TecDocPackageStructMotorsByCarTypeManuIdTermResponse',
  'PassengerCarDetailsRecord' => 'TecDocPackageStructPassengerCarDetailsRecord',
  'ReplacedByNumbersRecord' => 'TecDocPackageStructReplacedByNumbersRecord',
  'ReplacedByNumbersRecordSeq' => 'TecDocPackageStructReplacedByNumbersRecordSeq',
  'ReplacedNumbersRecord' => 'TecDocPackageStructReplacedNumbersRecord',
  'ReplacedNumbersRecordSeq' => 'TecDocPackageStructReplacedNumbersRecordSeq',
  'RequiredAttributesRecord' => 'TecDocPackageStructRequiredAttributesRecord',
  'RequiredAttributesRecordSeq' => 'TecDocPackageStructRequiredAttributesRecordSeq',
  'RequiredAttributesRequest' => 'TecDocPackageStructRequiredAttributesRequest',
  'RequiredAttributesResponse' => 'TecDocPackageStructRequiredAttributesResponse',
  'SecondaryTypesByCarIdRecord' => 'TecDocPackageStructSecondaryTypesByCarIdRecord',
  'SecondaryTypesByCarIdRecordSeq' => 'TecDocPackageStructSecondaryTypesByCarIdRecordSeq',
  'ShortCuts2Record' => 'TecDocPackageStructShortCuts2Record',
  'ShortCuts2RecordSeq' => 'TecDocPackageStructShortCuts2RecordSeq',
  'ShortCuts2Request' => 'TecDocPackageStructShortCuts2Request',
  'ShortCuts2Response' => 'TecDocPackageStructShortCuts2Response',
  'StringList' => 'TecDocPackageStructStringList',
  'ThumbnailByArticleIdRecord' => 'TecDocPackageStructThumbnailByArticleIdRecord',
  'ThumbnailByArticleIdRecordSeq' => 'TecDocPackageStructThumbnailByArticleIdRecordSeq',
  'ThumbnailByArticleIdRequest' => 'TecDocPackageStructThumbnailByArticleIdRequest',
  'ThumbnailByArticleIdResponse' => 'TecDocPackageStructThumbnailByArticleIdResponse',
  'UsageNumbersRecord' => 'TecDocPackageStructUsageNumbersRecord',
  'UsageNumbersRecordSeq' => 'TecDocPackageStructUsageNumbersRecordSeq',
  'VehicleByIdRecord' => 'TecDocPackageStructVehicleByIdRecord',
  'VehicleByIdWithTermRecord' => 'TecDocPackageStructVehicleByIdWithTermRecord',
  'VehicleByIds2Record' => 'TecDocPackageStructVehicleByIds2Record',
  'VehicleByIds2RecordSeq' => 'TecDocPackageStructVehicleByIds2RecordSeq',
  'VehicleByIds2Request' => 'TecDocPackageStructVehicleByIds2Request',
  'VehicleByIds2Response' => 'TecDocPackageStructVehicleByIds2Response',
  'VehicleByIds2SingleRequest' => 'TecDocPackageStructVehicleByIds2SingleRequest',
  'VehicleByIds2StringListRequest' => 'TecDocPackageStructVehicleByIds2StringListRequest',
  'VehicleByIdsRecord' => 'TecDocPackageStructVehicleByIdsRecord',
  'VehicleByIdsRecordSeq' => 'TecDocPackageStructVehicleByIdsRecordSeq',
  'VehicleByIdsRequest' => 'TecDocPackageStructVehicleByIdsRequest',
  'VehicleByIdsResponse' => 'TecDocPackageStructVehicleByIdsResponse',
  'VehicleByIdsStringListRequest' => 'TecDocPackageStructVehicleByIdsStringListRequest',
  'VehicleDetailsRecord' => 'TecDocPackageStructVehicleDetailsRecord',
  'VehicleIdsByCarTypeManuIdModelIdCriteria2Record' => 'TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Record',
  'VehicleIdsByCarTypeManuIdModelIdCriteria2RecordSeq' => 'TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2RecordSeq',
  'VehicleIdsByCarTypeManuIdModelIdCriteria2Request' => 'TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Request',
  'VehicleIdsByCarTypeManuIdModelIdCriteria2Response' => 'TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria2Response',
  'VehicleIdsByCarTypeManuIdModelIdCriteria3Record' => 'TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Record',
  'VehicleIdsByCarTypeManuIdModelIdCriteria3RecordSeq' => 'TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3RecordSeq',
  'VehicleIdsByCarTypeManuIdModelIdCriteria3Request' => 'TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Request',
  'VehicleIdsByCarTypeManuIdModelIdCriteria3Response' => 'TecDocPackageStructVehicleIdsByCarTypeManuIdModelIdCriteria3Response',
  'VehicleIdsByCarTypeManuIdTerm2Record' => 'TecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Record',
  'VehicleIdsByCarTypeManuIdTerm2RecordSeq' => 'TecDocPackageStructVehicleIdsByCarTypeManuIdTerm2RecordSeq',
  'VehicleIdsByCarTypeManuIdTerm2Request' => 'TecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Request',
  'VehicleIdsByCarTypeManuIdTerm2Response' => 'TecDocPackageStructVehicleIdsByCarTypeManuIdTerm2Response',
  'VehicleIdsByCarTypeManuIdTermRecord' => 'TecDocPackageStructVehicleIdsByCarTypeManuIdTermRecord',
  'VehicleIdsByCarTypeManuIdTermRecordSeq' => 'TecDocPackageStructVehicleIdsByCarTypeManuIdTermRecordSeq',
  'VehicleIdsByCarTypeManuIdTermRequest' => 'TecDocPackageStructVehicleIdsByCarTypeManuIdTermRequest',
  'VehicleIdsByCarTypeManuIdTermResponse' => 'TecDocPackageStructVehicleIdsByCarTypeManuIdTermResponse',
  'VehicleIdsByKTypeNumberRecord' => 'TecDocPackageStructVehicleIdsByKTypeNumberRecord',
  'VehicleIdsByKTypeNumberRecordSeq' => 'TecDocPackageStructVehicleIdsByKTypeNumberRecordSeq',
  'VehicleIdsByKTypeNumberRequest' => 'TecDocPackageStructVehicleIdsByKTypeNumberRequest',
  'VehicleIdsByKTypeNumberResponse' => 'TecDocPackageStructVehicleIdsByKTypeNumberResponse',
  'VehicleIdsByKeyNumberPlates2Request' => 'TecDocPackageStructVehicleIdsByKeyNumberPlates2Request',
  'VehicleIdsByKeyNumberPlates3Record' => 'TecDocPackageStructVehicleIdsByKeyNumberPlates3Record',
  'VehicleIdsByKeyNumberPlates3RecordSeq' => 'TecDocPackageStructVehicleIdsByKeyNumberPlates3RecordSeq',
  'VehicleIdsByKeyNumberPlates3Response' => 'TecDocPackageStructVehicleIdsByKeyNumberPlates3Response',
  'VehicleIdsByMarkRecord' => 'TecDocPackageStructVehicleIdsByMarkRecord',
  'VehicleIdsByMarkRecordSeq' => 'TecDocPackageStructVehicleIdsByMarkRecordSeq',
  'VehicleIdsByMarkRequest' => 'TecDocPackageStructVehicleIdsByMarkRequest',
  'VehicleIdsByMarkResponse' => 'TecDocPackageStructVehicleIdsByMarkResponse',
  'VehicleIdsByMotor2Record' => 'TecDocPackageStructVehicleIdsByMotor2Record',
  'VehicleIdsByMotor2RecordSeq' => 'TecDocPackageStructVehicleIdsByMotor2RecordSeq',
  'VehicleIdsByMotor2Request' => 'TecDocPackageStructVehicleIdsByMotor2Request',
  'VehicleIdsByMotor2Response' => 'TecDocPackageStructVehicleIdsByMotor2Response',
  'VehicleIdsByMotorRecord' => 'TecDocPackageStructVehicleIdsByMotorRecord',
  'VehicleIdsByMotorRecordSeq' => 'TecDocPackageStructVehicleIdsByMotorRecordSeq',
  'VehicleIdsByMotorRequest' => 'TecDocPackageStructVehicleIdsByMotorRequest',
  'VehicleIdsByMotorResponse' => 'TecDocPackageStructVehicleIdsByMotorResponse',
  'VehicleIdsByVendorId2Record' => 'TecDocPackageStructVehicleIdsByVendorId2Record',
  'VehicleIdsByVendorId2RecordSeq' => 'TecDocPackageStructVehicleIdsByVendorId2RecordSeq',
  'VehicleIdsByVendorId2Request' => 'TecDocPackageStructVehicleIdsByVendorId2Request',
  'VehicleIdsByVendorId2Response' => 'TecDocPackageStructVehicleIdsByVendorId2Response',
  'VehicleIdsByVendorIdRecord' => 'TecDocPackageStructVehicleIdsByVendorIdRecord',
  'VehicleIdsByVendorIdRecordSeq' => 'TecDocPackageStructVehicleIdsByVendorIdRecordSeq',
  'VehicleIdsByVendorIdRequest' => 'TecDocPackageStructVehicleIdsByVendorIdRequest',
  'VehicleIdsByVendorIdResponse' => 'TecDocPackageStructVehicleIdsByVendorIdResponse',
  'VehicleManufacturers2Record' => 'TecDocPackageStructVehicleManufacturers2Record',
  'VehicleManufacturers2RecordSeq' => 'TecDocPackageStructVehicleManufacturers2RecordSeq',
  'VehicleManufacturers2Request' => 'TecDocPackageStructVehicleManufacturers2Request',
  'VehicleManufacturers2Response' => 'TecDocPackageStructVehicleManufacturers2Response',
  'VehicleManufacturers3Record' => 'TecDocPackageStructVehicleManufacturers3Record',
  'VehicleManufacturers3RecordSeq' => 'TecDocPackageStructVehicleManufacturers3RecordSeq',
  'VehicleManufacturers3Request' => 'TecDocPackageStructVehicleManufacturers3Request',
  'VehicleManufacturers3Response' => 'TecDocPackageStructVehicleManufacturers3Response',
  'VehicleModels2Record' => 'TecDocPackageStructVehicleModels2Record',
  'VehicleModels2RecordSeq' => 'TecDocPackageStructVehicleModels2RecordSeq',
  'VehicleModels2Request' => 'TecDocPackageStructVehicleModels2Request',
  'VehicleModels2Response' => 'TecDocPackageStructVehicleModels2Response',
  'VehicleModels3Record' => 'TecDocPackageStructVehicleModels3Record',
  'VehicleModels3RecordSeq' => 'TecDocPackageStructVehicleModels3RecordSeq',
  'VehicleModels3Request' => 'TecDocPackageStructVehicleModels3Request',
  'VehicleModels3Response' => 'TecDocPackageStructVehicleModels3Response',
  'VehicleSimplifiedSelection2Record' => 'TecDocPackageStructVehicleSimplifiedSelection2Record',
  'VehicleSimplifiedSelection2RecordSeq' => 'TecDocPackageStructVehicleSimplifiedSelection2RecordSeq',
  'VehicleSimplifiedSelection2Request' => 'TecDocPackageStructVehicleSimplifiedSelection2Request',
  'VehicleSimplifiedSelection2Response' => 'TecDocPackageStructVehicleSimplifiedSelection2Response',
  'VehicleSimplifiedSelection3Record' => 'TecDocPackageStructVehicleSimplifiedSelection3Record',
  'VehicleSimplifiedSelection3RecordSeq' => 'TecDocPackageStructVehicleSimplifiedSelection3RecordSeq',
  'VehicleSimplifiedSelection3Response' => 'TecDocPackageStructVehicleSimplifiedSelection3Response',
  'VehicleSimplifiedSelection4Record' => 'TecDocPackageStructVehicleSimplifiedSelection4Record',
  'VehicleSimplifiedSelection4RecordSeq' => 'TecDocPackageStructVehicleSimplifiedSelection4RecordSeq',
  'VehicleSimplifiedSelection4Response' => 'TecDocPackageStructVehicleSimplifiedSelection4Response',
  'VehicleSimplifiedSelectionRecord' => 'TecDocPackageStructVehicleSimplifiedSelectionRecord',
  'VehicleSimplifiedSelectionRequest' => 'TecDocPackageStructVehicleSimplifiedSelectionRequest',
  'VendorIds2Record' => 'TecDocPackageStructVendorIds2Record',
  'VendorIds2RecordSeq' => 'TecDocPackageStructVendorIds2RecordSeq',
  'VendorIds2Request' => 'TecDocPackageStructVendorIds2Request',
  'VendorIds2Response' => 'TecDocPackageStructVendorIds2Response',
  'VendorIdsRecord' => 'TecDocPackageStructVendorIdsRecord',
  'VendorIdsRecordSeq' => 'TecDocPackageStructVendorIdsRecordSeq',
  'VendorIdsRequest' => 'TecDocPackageStructVendorIdsRequest',
  'VendorIdsResponse' => 'TecDocPackageStructVendorIdsResponse',
  'VersionInfoRequest' => 'TecDocPackageStructVersionInfoRequest',
  'VersionInfoRequestSrc' => 'TecDocPackageStructVersionInfoRequestSrc',
  'VersionInfoResponse' => 'TecDocPackageStructVersionInfoResponse',
  'WheelBasesByCarIdRecord' => 'TecDocPackageStructWheelBasesByCarIdRecord',
  'WheelBasesByCarIdRecordSeq' => 'TecDocPackageStructWheelBasesByCarIdRecordSeq',
);
	}
}
?>