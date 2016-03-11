<?php 
$db = new db;$slave = new slave;
include_once 'lib/video_class.php';$video=new video;
include_once 'lib/galery_class.php';$galery=new galery;
include_once 'lib/subscribe_class.php';$subscribe=new subscribe;
include_once 'lib/shop_class.php';$shop=new shop;
include_once 'lib/news_class.php';$news=new news;
include_once 'lib/client_class.php';$clnt=new client;
include_once 'lib/catalogue_class.php';$cat=new catalogue;
include_once 'lib/task_class.php';$task=new task;
require_once (RD."/js/JsHttpRequest/JsHttpRequest.php");$JsHttpRequest =& new JsHttpRequest("windows-1251");
session_start(); 
if ($_SESSION["client"]==""){$clnt->get_client();}

if ($_REQUEST["w"]=="showActionInfo"){ $GLOBALS['_RESULT'] = array("content"=>$shop->showActionInfo($_REQUEST["url"])); }

if ($_REQUEST["w"]=="AuthAcount"){ $GLOBALS['_RESULT'] = array("answer"=>$clnt->check_client($_REQUEST["email"],$_REQUEST["pass"]));}
if ($_REQUEST["w"]=="out_acount"){ $GLOBALS['_RESULT'] = array("answer"=>$clnt->out_Acount());}
if ($_REQUEST["w"]=="checkMessageBox"){ list($ex,$frm)=$clnt->getClientMessages(); $GLOBALS['_RESULT'] = array("ex"=>$ex,"form"=>$frm);}
if ($_REQUEST["w"]=="showMessageBox"){ $GLOBALS['_RESULT'] = array("content"=>$clnt->showMessageBox($_REQUEST["id"]));}
if ($_REQUEST["w"]=="setMessageStatus"){ $GLOBALS['_RESULT'] = array("content"=>$clnt->setMessageStatus($_REQUEST["id"],$_REQUEST["status"]));}
if ($_REQUEST["w"]=="setMessageAnswer"){ $GLOBALS['_RESULT'] = array("content"=>$clnt->setMessageAnswer($_REQUEST["id"],$_REQUEST["answer"]));}


if ($_REQUEST["w"]=="showMasloCategory"){ $GLOBALS['_RESULT'] = array("content"=>$cat->show_maslo_category_filter($_REQUEST["category"]));}
if ($_REQUEST["w"]=="showMasloCategoryFilters"){ $GLOBALS['_RESULT'] = array("content"=>$cat->show_maslo_filters($_REQUEST["category"]));}
if ($_REQUEST["w"]=="showMasloRange"){ list($content,$filters)=$cat->catalogue_maslo_find($_REQUEST["category"],$_REQUEST["cols"],$_REQUEST["vals"],$_REQUEST["page"]); $GLOBALS['_RESULT'] = array("content"=>$content,'filters'=>$filters);}
if ($_REQUEST["w"]=="showMasloItemInfo"){ $GLOBALS['_RESULT'] = array("content"=>$cat->showMasloItemInfo($_REQUEST["category"],$_REQUEST["item_id"])); }
if ($_REQUEST["w"]=="show_busket_maslo_form"){$GLOBALS['_RESULT'] = array("content"=>$shop->show_busket_maslo_form($_REQUEST["category"],$_REQUEST["model"]));}




if ($_REQUEST["w"]=="sendAcountInfo"){ $GLOBALS['_RESULT'] = array("answer"=>$clnt->sendAcountInfo($_REQUEST["email"]));}
if ($_REQUEST["w"]=="showAcountInfo"){ $GLOBALS['_RESULT'] = array("content"=>$clnt->check_client($_REQUEST["email"],$_REQUEST["pass"]));}
if ($_REQUEST["w"]=="SaveRegistration"){ list($err,$answer)=$clnt->saveClientRegistration($_REQUEST["recaptcha_challenge_field"],$_REQUEST["recaptcha_response_field"],$_REQUEST["email"],$_REQUEST["name"],$_REQUEST["state"],$_REQUEST["city"],$_REQUEST["new_city"],$_REQUEST["address"],$_REQUEST["phone"],$_REQUEST["activity"]);$GLOBALS['_RESULT'] = array("err"=>$err,"answer"=>$answer);}
if ($_REQUEST["w"]=="showStateForm"){ $GLOBALS['_RESULT'] = array("content"=>$clnt->showStateForm($_REQUEST["id"],1));}
if ($_REQUEST["w"]=="showCityForm"){ $GLOBALS['_RESULT'] = array("content"=>$clnt->showCityForm($_REQUEST["state"]));}
if ($_REQUEST["w"]=="showCityOrderForm"){ $GLOBALS['_RESULT'] = array("content"=>$clnt->showCityOrderForm($_REQUEST["state"]));}
if ($_REQUEST["w"]=="showActivityForm"){ $GLOBALS['_RESULT'] = array("content"=>$clnt->showActivityForm($_REQUEST["id"]));}
if ($_REQUEST["w"]=="checkClientEmail"){ list($er,$answer)=$clnt->checkClientEmail($_REQUEST["email"]);$GLOBALS['_RESULT'] = array("answer"=>$answer,"er"=>$er);}
if ($_REQUEST["w"]=="showBrandInfo"){ $GLOBALS['_RESULT'] = array("content"=>$cat->showBrandInfo($_REQUEST["id"])); }

if ($_REQUEST["w"]=="loadStoCategory"){ $GLOBALS['_RESULT'] = array("content"=>$cat->show_sto_category($_REQUEST["producent"])); }
if ($_REQUEST["w"]=="loadStoOtype"){ $GLOBALS['_RESULT'] = array("content"=>$cat->show_sto_otype($_REQUEST["category"])); }

if ($_REQUEST["w"]=="loadStoCategoryF"){ $GLOBALS['_RESULT'] = array("content"=>$cat->showStoCategory($_REQUEST["producent"],$_REQUEST["category"])); }
if ($_REQUEST["w"]=="loadStoOtypeF"){ $GLOBALS['_RESULT'] = array("content"=>$cat->showStoOtype($_REQUEST["category"],$_REQUEST["otype"])); }
if ($_REQUEST["w"]=="loadStoItemsFilter"){ $GLOBALS['_RESULT'] = array("content"=>$cat->loadStoItemsFilter($_REQUEST["producent"],$_REQUEST["category"],$_REQUEST["otype"])); }
if ($_REQUEST["w"]=="showAplicability"){ $GLOBALS['_RESULT'] = array("content"=>$cat->showAplicability($_REQUEST["articleId"])); }

if ($_REQUEST["w"]=="catalogue_art_find"){ $GLOBALS['_RESULT'] = array("content"=>$cat->catalogue_art_find($_REQUEST["art"],$_REQUEST["by_code"],$_REQUEST["by_sklad"],$_REQUEST["by_name"],$_REQUEST["by_producent"])); }
if ($_REQUEST["w"]=="showItemSklad"){ $GLOBALS['_RESULT'] = array("content"=>$cat->showItemSklad($_REQUEST["item_id"])); }
if ($_REQUEST["w"]=="showItemActionRemark"){ $GLOBALS['_RESULT'] = array("content"=>$cat->showItemActionRemark($_REQUEST["item_id"])); }
if ($_REQUEST["w"]=="showItemInfo"){ $GLOBALS['_RESULT'] = array("content"=>$cat->showItemInfo($_REQUEST["item_id"])); }
if ($_REQUEST["w"]=="showItemPhoto"){ $GLOBALS['_RESULT'] = array("content"=>$cat->showItemPhoto($_REQUEST["item_id"])); }
if ($_REQUEST["w"]=="showItemAnalog"){ $GLOBALS['_RESULT'] = array("content"=>$cat->showItemAnalog($_REQUEST["item_id"])); }
if ($_REQUEST["w"]=="loadTecManufactureList"){ $GLOBALS['_RESULT'] = array("content"=>$cat->show_tecdoc_manufacture($_REQUEST["manufacture"])); }
if ($_REQUEST["w"]=="loadTecModelList"){ $GLOBALS['_RESULT'] = array("content"=>$cat->loadTecModelList($_REQUEST["manufacture"],$_REQUEST["model"])); }
if ($_REQUEST["w"]=="loadTecModificationList"){ $GLOBALS['_RESULT'] = array("content"=>$cat->loadTecModificationList($_REQUEST["manufacture"],$_REQUEST["model"],$_REQUEST["modification"])); }
if ($_REQUEST["w"]=="loadTecGroupsList"){ $GLOBALS['_RESULT'] = array("content"=>$cat->loadTecGroupsList($_REQUEST["manufacture"],$_REQUEST["model"],$_REQUEST["modification"])); }
if ($_REQUEST["w"]=="loadTecDetailsList"){ $GLOBALS['_RESULT'] = array("content"=>$cat->loadTecDetailsList($_REQUEST["manufacture"],$_REQUEST["model"],$_REQUEST["modification"],$_REQUEST["groups"],$_REQUEST["brand"])); }

if ($_REQUEST["w"]=="load_news_list"){ $GLOBALS['_RESULT'] = array("content"=>$news->show_list($_REQUEST["data"])); }
if ($_REQUEST["w"]=="show_video_form"){$GLOBALS['_RESULT'] = array("content"=>$video->show_video($_REQUEST["id"]));}


if ($_REQUEST["w"]=="load_model_opinion"){ $GLOBALS['_RESULT'] = array("content"=>$cat->load_model_opinion($_REQUEST["model"],$_REQUEST["page"])); }
if ($_REQUEST["w"]=="save_model_opinion"){ $GLOBALS['_RESULT'] = array("answer"=>$cat->save_model_opinion($_REQUEST["model"],$_REQUEST["name"],$_REQUEST["desc"],$_REQUEST["pos"],$_REQUEST["neg"])); }
if ($_REQUEST["w"]=="show_model_var"){ $GLOBALS['_RESULT'] = array("content"=>$cat->show_model_var($_REQUEST["var"],$_REQUEST["model"]));}

if ($_REQUEST["w"]=="addModelCompare"){ $GLOBALS['_RESULT'] = array("content"=>$cat->add_model_compare($_REQUEST["model"]));}
if ($w=="delete_model_compare"){$content=$cat->delete_model_compare($model);}
if ($w=="show_model_compare"){$content=$cat->show_model_compare($model);}

if ($_REQUEST["w"]=="save_model_vote"){$GLOBALS['_RESULT'] = array("content"=>$cat->save_model_vote($_REQUEST["model"],$_REQUEST["rate"]));}
if ($w=="show_model_vote"){$content=$cat->show_model_vote($model);}
if ($_REQUEST["w"]=="show_busket_form"){$GLOBALS['_RESULT'] = array("content"=>$shop->show_busket_form($_REQUEST["model"]));}
if ($_REQUEST["w"]=="updateBusketModelCount"){$GLOBALS['_RESULT'] = array("content"=>$shop->updateBusketModelCount($_REQUEST["or_id"],$_REQUEST["count"]));}
if ($_REQUEST["w"]=="dropModel"){$GLOBALS['_RESULT'] = array("content"=>$shop->dropModel($_REQUEST["model"]));}


if ($_REQUEST["w"]=="SaveModelBusket"){$GLOBALS['_RESULT'] = array("content"=>$shop->SaveModelBusket($_REQUEST["order_id"],$_REQUEST["model"],$_REQUEST["count"],$_REQUEST["price"]));}


if ($_REQUEST["w"]=="showDocOrder"){$GLOBALS['_RESULT'] = array("content"=>$shop->showDocOrder($_REQUEST["doc_id"]));}
if ($_REQUEST["w"]=="showOrderStr"){$GLOBALS['_RESULT'] = array("content"=>$shop->showOrderStr($_REQUEST["orderId"]));}
if ($_REQUEST["w"]=="showOrderComment"){$GLOBALS['_RESULT'] = array("content"=>$shop->showOrderComment($_REQUEST["orderId"]));}
if ($_REQUEST["w"]=="saveOrderComment"){$GLOBALS['_RESULT'] = array("answer"=>$shop->saveOrderComment($_REQUEST["orderId"],$_REQUEST["more"]));}

if ($_REQUEST["w"]=="confirmOrder"){$GLOBALS['_RESULT'] = array("answer"=>$shop->checkExpressQuant($_REQUEST["orderId"]));}


if ($_REQUEST["w"]=="show_busket"){$GLOBALS['_RESULT'] = array("content"=>$shop->show_busket());}
if ($_REQUEST["w"]=="showClientBusket"){$GLOBALS['_RESULT'] = array("content"=>$shop->show_busket_client());}
if ($_REQUEST["w"]=="show_payment_comment"){$GLOBALS['_RESULT'] = array("content"=>$shop->show_payment_comment($_REQUEST["comment"]));}
if ($_REQUEST["w"]=="getModelImage"){$GLOBALS['_RESULT'] = array("image"=>$cat->get_model_image($_REQUEST["id"]));}

if ($_REQUEST["w"]=="loadCatalogueRange"){ $GLOBALS['_RESULT'] = array("content"=>$cat->show_model_menu_jquery($_REQUEST["top_id"],$_REQUEST["cur_id"],$_REQUEST["page"],$_REQUEST["order_by"],$_REQUEST["view_type"])); }
if ($_REQUEST["w"]=="setFilter"){ $GLOBALS['_RESULT'] = array("answer"=>$cat->setFilter($_REQUEST["param_id"],$_REQUEST["sub_param_id"])); }
if ($_REQUEST["w"]=="unsetFilter"){ $GLOBALS['_RESULT'] = array("answer"=>$cat->unsetFilter($_REQUEST["param_id"],$_REQUEST["sub_param_id"])); }
if ($_REQUEST["w"]=="setFilterFromTo"){ $GLOBALS['_RESULT'] = array("answer"=>$cat->setFilterFromTo($_REQUEST["param_id"],$_REQUEST["from"],$_REQUEST["to"])); }
if ($_REQUEST["w"]=="setFilterPriceFromTo"){ $GLOBALS['_RESULT'] = array("answer"=>$cat->setFilterPriceFromTo($_REQUEST["cur_id"],$_REQUEST["from"],$_REQUEST["to"])); }
if ($_REQUEST["w"]=="setFilterQuery"){ $GLOBALS['_RESULT'] = array("answer"=>$cat->setFilterQuery($_REQUEST["cur_id"],$_REQUEST["query"])); }
if ($_REQUEST["w"]=="setFilterRSBS"){ $GLOBALS['_RESULT'] = array("answer"=>$cat->setFilterRSBS($_REQUEST["cur_id"],$_REQUEST["id"])); }
if ($_REQUEST["w"]=="unsetFilterRSBS"){ $GLOBALS['_RESULT'] = array("answer"=>$cat->unsetFilterRSBS($_REQUEST["cur_id"],$_REQUEST["id"])); }
if ($_REQUEST["w"]=="historySearch"){ $GLOBALS['_RESULT'] = array("content"=>$cat->historySearch()); }

if ($_REQUEST["w"]=="addToRecomend"){ $GLOBALS['_RESULT'] = array("answer"=>$cat->addToRecomend($_REQUEST["item_id"])); }
if ($_REQUEST["w"]=="delFromRecomend"){ $GLOBALS['_RESULT'] = array("answer"=>$cat->delFromRecomend($_REQUEST["item_id"])); }
if ($_REQUEST["w"]=="DropImg"){ $GLOBALS['_RESULT'] = array("answer"=>$cat->DropImg($_REQUEST["item_id"],$_REQUEST["filename"])); }

if ($_REQUEST["w"]=="loadOrdersList"){$GLOBALS['_RESULT'] = array("content"=>$shop->show_orders_active_list(1));}
if ($_REQUEST["w"]=="PlusOneOrder"){$GLOBALS['_RESULT'] = array("Answer"=>$shop->PlusOneActiveOrder());}



if ($_REQUEST["w"]=="print_order"){$GLOBALS['_RESULT'] = array("content"=>$shop->print_order($_REQUEST["order"]));}

if ($_REQUEST["w"]=="showTaskCalendar"){$GLOBALS['_RESULT'] = array("content"=>$task->show_calendar($_REQUEST["month"],$_REQUEST["year"]));}
if ($_REQUEST["w"]=="showTaskForm"){$GLOBALS['_RESULT'] = array("content"=>$task->showTaskForm($_REQUEST["data"]));}
if ($_REQUEST["w"]=="newTask"){$GLOBALS['_RESULT'] = array("content"=>$task->newTask($_REQUEST["data"]));}
if ($_REQUEST["w"]=="addTask"){$GLOBALS['_RESULT'] = array("Answer"=>$task->addTask($_REQUEST["data"],$_REQUEST["caption"],$_REQUEST["data_end"],$_REQUEST["time_end"],$_REQUEST["email"],$_REQUEST["desc"]));}

//$vote_answer=$slave->get_vote_answer();

if ($w=="subscribe"){$content=$subscribe->save_subscribe($_GET["email"]);}
if ($w=="save_article_opinion"){$content=$articles->save_opinion($article_id,$name,$desc);}

// shop -------------



if ($w=="show_special_offer"){$content=$cat->show_special_offer($top_id);}
if ($w=="show_model_var"){$content=$cat->show_model_var($var,$model);}
if ($w=="show_model_img"){$content=$cat->show_model_img($model,$file);}
if ($w=="show_model_desc"){$content=$cat->get_model_desc($model);}
if ($w=="show_action"){$content=$cat->show_main_banners_desc($action_id);}
if ($w=="get_next_banner_id"){$content=$cat->get_next_banner_id($_GET["cur_id"]);}
if ($w=="show_model_desc_more"){$content=$cat->get_model_desc_more($model);}

if ($w=="show_list_busket_form"){$content=$shop->show_list_busket_form($model);}
if ($w=="save_busket_form"){$content=$shop->save_busket_form($model,$count);}
if ($w=="drop_busket_position"){$content=$shop->drop_busket_position($model);}
if ($w=="drop_busket_position_ac"){$content=$shop->drop_busket_position_ac($ord);}
if ($w=="show_order_history"){$content=$shop->show_order_history($page);}
if ($w=="show_order_ac_history"){$content=$shop->show_order_ac_history($page);}
if ($w=="show_order_serv_history"){$content=$shop->show_order_serv_history($page);}


?>