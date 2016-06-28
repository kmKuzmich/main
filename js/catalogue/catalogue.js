function showBrandInfo(id) {
    JsHttpRequest.query('content.php', {'w': 'showBrandInfo', 'id': id},
        function (result, errors) {
            if (errors) {
                alert(errors);
            }
            if (result) {
                document.getElementById("InfoFormInfo").innerHTML = result["content"];
                showInfoForm();
                document.getElementById("InfoForm").style.height = "500px";
                fleXenv.updateScrollBars();
                fleXenv.fleXcrollMain("BrandCroll");
            }
        }, true);
}
function search_art() {
    closeHistorySearchFrom();
    startLoading();
    var art = document.getElementById("art").value;
    if (art.length <= 2) {
        showAlertForm("¬ведите больше символов дл€ поиска");
        stopLoading();
    }
    //в этом месте выдать сообщение о задолженности
    showMessageExp();

    if (art.length > 2) {
        var by_code = 0;
        if (document.getElementById("by_code").checked) {
            by_code = 1;
        }
        var by_sklad = 0;
        if (document.getElementById("by_sklad").checked) {
            by_sklad = 1;
        }
        var by_name = 0;
        if (document.getElementById("by_name").checked) {
            by_name = 1;
        }
        var by_producent = document.getElementById("by_producent").value;

        JsHttpRequest.query('content.php', {
                'w': 'catalogue_art_find',
                'art': art,
                'by_code': by_code,
                'by_sklad': by_sklad,
                'by_name': by_name,
                'by_producent': by_producent
            },
            function (result, errors) {
                if (errors) {
                    alert(errors);
                    stopLoading()
                }
                if (result) {
                    document.getElementById("range_list").innerHTML = result["content"];
                    stopLoading();
                    fleXenv.updateScrollBars();
                    fleXenv.fleXcrollMain("flexcroll");
                }
            }, true);
    }

}
function search_biartTec(art, producent) {
    document.getElementById("by_producent").value = producent;
    document.getElementById("art").value = art;
    win_close();
    search_art();
    closeHistorySearchFrom();
    window.location.hash = "#search=" + art;
}
function search_biart(art) {
    document.getElementById("by_producent").value = "";
//	if (document.getElementById("art").value==""){document.getElementById("art").value=art;}
    document.getElementById("art").value = art;
    win_close();
    search_art();
    closeHistorySearchFrom();
    window.location.hash = "#search=" + art;
}
function search_biproducent(producent) {
    document.getElementById("by_producent").value = producent;
    search_art();
}
function clearProd() {
    document.getElementById("by_producent").value = "";
}
function showItemActionRemark(item_id) {
    startLoading();
    JsHttpRequest.query('content.php', {'w': 'showItemActionRemark', 'item_id': item_id},
        function (result, errors) {
            if (errors) {
                alert(errors);
            }
            if (result) {
                showInfoForm();
                document.getElementById("InfoFormInfo").innerHTML = result["content"];
                document.getElementById("InfoForm").style.height = "auto";
                document.getElementById("InfoForm").style.top = "300px";
                stopLoading();
            }
        }, true);
}
function showItemSklad(item_id) {
    startLoading();
    JsHttpRequest.query('content.php', {'w': 'showItemSklad', 'item_id': item_id},
        function (result, errors) {
            if (errors) {
                alert(errors);
            }
            if (result) {
                showInfoForm();
                document.getElementById("InfoFormInfo").innerHTML = result["content"];
                document.getElementById("InfoForm").style.height = "auto";
                document.getElementById("InfoForm").style.top = "300px";
                stopLoading();
            }
        }, true);
}
function showItemInfo(item_id) {
    startLoading();
    JsHttpRequest.query('content.php', {'w': 'showItemInfo', 'item_id': item_id},
        function (result, errors) {
            if (errors) {
                alert(errors);
            }
            if (result) {
                showInfoForm();
                document.getElementById("InfoFormInfo").innerHTML = result["content"];
                document.getElementById("InfoForm").style.height = "auto";
                stopLoading();
            }
        }, true);
}
function showItemPhoto(item_id) {
    startLoading();
    JsHttpRequest.query('content.php', {'w': 'showItemPhoto', 'item_id': item_id},
        function (result, errors) {
            if (errors) {
                alert(errors);
            }
            if (result) {
                showInfoForm();
                document.getElementById("InfoFormInfo").innerHTML = result["content"];
                document.getElementById("InfoForm").style.height = "auto";
                stopLoading();
            }
        }, true);
}
function showItemAnalog(item_id) {
    startLoading()
    JsHttpRequest.query('content.php', {'w': 'showItemAnalog', 'item_id': item_id},
        function (result, errors) {
            if (errors) {
                alert(errors);
            }
            if (result) {
                win_open();
                document.getElementById("wind").style.marginLeft = "-230px";
                document.getElementById("wind").style.top = "180px";
                document.getElementById("wind").style.width = "750px";
                document.getElementById("wind").style.height = "auto";
                document.getElementById("wind").style.maxHeight = "500px";
                document.getElementById("wind_cont").innerHTML = result["content"];
                stopLoading();
                fleXenv.updateScrollBars();
                fleXenv.fleXcrollMain("AnalogCroll");
            }
        }, true);
}

function setFilter(p_id, sp_id) {
    var operation = 'set';
    if (sp_id != "+") {
        var status = document.getElementById("SubParam" + sp_id).checked;
    }
    if (sp_id == "+") {
        var status = document.getElementById("Param" + p_id).checked;
    }
    if (status == true) {
        operation = 'set';
    }
    if (status == false) {
        operation = 'unset';
    }
    JsHttpRequest.query('content.php', {'w': operation + 'Filter', 'param_id': p_id, 'sub_param_id': sp_id},
        function (result, errors) {
            if (errors) {
            }
            if (result) {
                if (result["answer"] == "ok") {
                    loadCatalogueRange();
                }
            }
        }, true);
}

function setFilterFromTo(p_id) {
    var from = document.getElementById("SubParamFrom" + p_id).value;
    var to = document.getElementById("SubParamTo" + p_id).value;
    JsHttpRequest.query('content.php', {'w': 'setFilterFromTo', 'param_id': p_id, 'from': from, 'to': to},
        function (result, errors) {
            if (errors) {
            }
            if (result) {
                if (result["answer"] == "ok") {
                    loadCatalogueRange();
                }
            }
        }, true);
}

function setFilterPriceFromTo() {
    var cur_id = document.getElementById("cur_id").value;
    var from = document.getElementById("price_from").value;
    var to = document.getElementById("price_to").value;
    JsHttpRequest.query('content.php', {'w': 'setFilterPriceFromTo', 'cur_id': cur_id, 'from': from, 'to': to},
        function (result, errors) {
            if (errors) {
            }
            if (result) {
                if (result["answer"] == "ok") {
                    loadCatalogueRange();
                }
            }
        }, true);
}

function setFilterQuery(query) {
    var cur_id = document.getElementById("cur_id").value;
    JsHttpRequest.query('content.php', {'w': 'setFilterQuery', 'cur_id': cur_id, 'query': query},
        function (result, errors) {
            if (errors) {
            }
            if (result) {
                if (result["answer"] == "ok") {
                    loadCatalogueRange();
                }
            }
        }, true);
}

function setFilterRSBS(id) {
    var cur_id = document.getElementById("cur_id").value;
    var operation = 'set';
    var status = document.getElementById(id).checked;
    if (status == false) {
        operation = 'unset';
    }
    JsHttpRequest.query('content.php', {'w': operation + 'FilterRSBS', 'cur_id': cur_id, 'id': id},
        function (result, errors) {
            if (errors) {
            }
            if (result) {
                if (result["answer"] == "ok") {
                    loadCatalogueRange();
                }
            }
        }, true);
}

function setSliderValue(place_from, place_to, value) {
    var ft = value.split(';');
    document.getElementById(place_from).value = ft[0];
    document.getElementById(place_to).value = ft[1];
}

function setRangePage(page) {
    document.getElementById("page").value = page;
//	loadCatalogueNavigation();
    loadCatalogueRange();
}

function showZoomForm() {
    document.getElementById("ZoomForm").style.visibility = "visible";
    document.getElementById("ZoomForm").style.position = "absolute";
    document.getElementById("ZoomForm").style.width = "1100px";
    document.getElementById("ZoomForm").style.left = "50%";
    document.getElementById("ZoomForm").style.marginLeft = "-500px";
    document.getElementById("ZoomForm").style.top = "10px";
}
function closeZoomForm() {
    document.getElementById("ZoomForm").style.visibility = "hidden";
    document.getElementById("ZoomForm").style.position = "absolute";
    document.getElementById("ZoomForm").style.left = "-150%";
    document.getElementById("ZoomForm").style.top = "0%";
    document.getElementById("zoomModelImage").innerHTML = "";
}


function zoomModel(id) {
    JsHttpRequest.query('content.php', {'w': 'getModelImage', 'id': id},
        function (result, errors) {
            if (errors) {
            }
            if (result) {
                showZoomForm();
                document.getElementById("zoomModelImage").innerHTML = result["image"];
            }
        }, true);
}

function loadTecManufactureList(manufacture) {
    if (manufacture == 0 || manufacture == '') {
        manufacture = document.getElementById("manufacture")[document.getElementById("manufacture").selectedIndex].value;
    }
    JsHttpRequest.query('content.php', {'w': 'loadTecManufactureList', 'manufacture': manufacture},
        function (result, errors) {
            if (errors) {
                alert(errors);
            }
            if (result) {
                document.getElementById("manufacture_place").innerHTML = result["content"];
            }
        }, true);
}
function loadTecModelList(manufacture, model) {
    if (manufacture == 0 || manufacture == '') {
        manufacture = document.getElementById("manufacture")[document.getElementById("manufacture").selectedIndex].value;
    }
    JsHttpRequest.query('content.php', {'w': 'loadTecModelList', 'manufacture': manufacture, 'model': model},
        function (result, errors) {
            if (errors) {
                alert(errors);
            }
            if (result) {
                document.getElementById("model_place").innerHTML = result["content"];
            }
        }, true);
}
function loadTecModificationList(manufacture, model, modification) {
    if (manufacture == 0 || manufacture == '') {
        manufacture = document.getElementById("manufacture")[document.getElementById("manufacture").selectedIndex].value;
    }
    if (model == 0 || model == '') {
        model = document.getElementById("model")[document.getElementById("model").selectedIndex].value;
    }
    JsHttpRequest.query('content.php', {
            'w': 'loadTecModificationList',
            'manufacture': manufacture,
            'model': model,
            'modification': modification
        },
        function (result, errors) {
            if (errors) {
                alert(errors);
            }
            if (result) {
                document.getElementById("modification_place").innerHTML = result["content"];
            }
        }, true);
}
function loadTecDocGroupsList() {
    var manufacture = document.getElementById("manufacture")[document.getElementById("manufacture").selectedIndex].value;
    var model = document.getElementById("model")[document.getElementById("model").selectedIndex].value;
    var modification = document.getElementById("modification")[document.getElementById("modification").selectedIndex].value;
    location.href = "?dep=23&manufacture=" + manufacture + "&model=" + model + "&modification=" + modification;
    initTree();
    collapseAll();
    stopLoading();
    fleXenv.updateScrollBars();
    fleXenv.fleXcrollMain("InfoCroll");
}
function loadTecGroupsList(manufacture, model, modification) {
    startLoading();
    if (manufacture == 0 || manufacture == '' || !manufacture) {
        manufacture = document.getElementById("manufacture")[document.getElementById("manufacture").selectedIndex].value;
    }
    if (model == 0 || model == '' || !model) {
        model = document.getElementById("model")[document.getElementById("model").selectedIndex].value;
    }
    if (modification == 0 || modification == '' || !modification) {
        modification = document.getElementById("modification")[document.getElementById("modification").selectedIndex].value;
    }
    JsHttpRequest.query('content.php', {
            'w': 'loadTecGroupsList',
            'manufacture': manufacture,
            'model': model,
            'modification': modification
        },
        function (result, errors) {
            if (errors) {
                alert(errors);
                stopLoading();
            }
            if (result) {
                document.getElementById("range_list").innerHTML = result["content"];
                stopLoading();

                $("#navigation").treeview({
                    persist: "location",
                    collapsed: true,
                    unique: true
                });
                fleXenv.updateScrollBars();
                fleXenv.fleXcrollMain("InfoCroll");
                initTree();
                collapseAll();
                loadTecDetailsListMore(manufacture, model, modification, vr[0], opbrd);
            }
        }, true);
    stopLoading();
}
function loadTecDetailsList(manufacture, model, modification, groups, brandNo) {
    startLoading();
    if (!document.getElementById("PartsCroll")) {
        loadTecManufactureList(manufacture);
        loadTecModelList(manufacture, model);
        loadTecModificationList(manufacture, model, modification);
        loadTecGroupsList(manufacture, model, modification);
        //loadTecDetailsListMore(manufacture,model,modification,groups,brandNo);
    }
    if (document.getElementById("PartsCroll")) {
        JsHttpRequest.query('content.php', {
                'w': 'loadTecDetailsList',
                'manufacture': manufacture,
                'model': model,
                'modification': modification,
                'groups': groups,
                'brand': brandNo
            },
            function (result, errors) {
                if (errors) {
                    alert(errors);
                    stopLoading();
                }
                if (result) {
                    document.getElementById("PartsCrolls").innerHTML = result["content"];
                    fleXenv.updateScrollBars();
                    fleXenv.fleXcrollMain("PartsCroll");
                    stopLoading();
                }
            }, true);
    }
}
function loadTecDetailsListMore(manufacture, model, modification, groups, brandNo) {
    startLoading();
    var hash = location.hash;
    var op = hash.split("=");
    if (op[0] != "#groups") {
        stopLoading();
    }
    if (op[0] == "#groups") {
        var vr = op[1].split("/");
        var opbrd = "";
        if (!vr[4]) {
            opbrd = "";
        }
        if (vr[4]) {
            opbrd = vr[4];
        }
        JsHttpRequest.query('content.php', {
                'w': 'loadTecDetailsList',
                'manufacture': manufacture,
                'model': model,
                'modification': modification,
                'groups': vr[0],
                'brand': opbrd
            },
            function (result, errors) {
                if (errors) {
                    alert(errors);
                    stopLoading();
                }
                if (result) {
                    document.getElementById("PartsCrolls").innerHTML = result["content"];
                    fleXenv.updateScrollBars();
                    fleXenv.fleXcrollMain("PartsCroll");
                    stopLoading();
                }
            }, true);
    }
}
function loadStoProducentFilter(producent) {
    loadStoCategoryF(producent, 0);
    loadStoOtypeF(0, 0);
    loadStoItemsFilter();
}
function loadStoCategoryFilter(producent, category) {
    loadStoCategoryF(producent, category);
    loadStoOtypeF(category, 0);
    loadStoItemsFilter();
}
function loadStoOtypeFilter(category, otype) {
    loadStoOtypeF(category, otype);
    loadStoItemsFilter();
}

function loadStoCategoryF(producent, category) {
    JsHttpRequest.query('content.php', {'w': 'loadStoCategoryF', 'producent': producent, 'category': category},
        function (result, errors) {
            if (errors) {
                alert(errors);
            }
            if (result) {
                document.getElementById("sto_category_place").innerHTML = result["content"];
            }
        }, true);
}
function loadStoOtypeF(category, otype) {
    JsHttpRequest.query('content.php', {'w': 'loadStoOtypeF', 'category': category, 'otype': otype},
        function (result, errors) {
            if (errors) {
                alert(errors);
            }
            if (result) {
                document.getElementById("sto_otype_place").innerHTML = result["content"];
            }
        }, true);
}
function loadStoCategory(producent) {
    JsHttpRequest.query('content.php', {'w': 'loadStoCategory', 'producent': producent},
        function (result, errors) {
            if (errors) {
                alert(errors);
            }
            if (result) {
                document.getElementById("sto_category_place").innerHTML = result["content"];
            }
        }, true);
}
function loadStoOtype(category) {
    JsHttpRequest.query('content.php', {'w': 'loadStoOtype', 'category': category},
        function (result, errors) {
            if (errors) {
                alert(errors);
            }
            if (result) {
                document.getElementById("sto_otype_place").innerHTML = result["content"];
            }
        }, true);
}
function loadStoItemsFilter() {
    startLoading();
    var producent = 0;
    if (document.getElementById("sto_producent").selectedIndex) {
        producent = document.getElementById("sto_producent")[document.getElementById("sto_producent").selectedIndex].value;
    }
    var category = 0;
    if (document.getElementById("sto_category").selectedIndex) {
        category = document.getElementById("sto_category")[document.getElementById("sto_category").selectedIndex].value;
    }
    var otype = 0;
    if (document.getElementById("sto_otype").selectedIndex) {
        otype = document.getElementById("sto_otype")[document.getElementById("sto_otype").selectedIndex].value;
    }
    JsHttpRequest.query('content.php', {
            'w': 'loadStoItemsFilter',
            'producent': producent,
            'category': category,
            'otype': otype
        },
        function (result, errors) {
            if (errors) {
                alert(errors);
            }
            if (result) {
                document.getElementById("items_list").innerHTML = result["content"];
                stopLoading();
            }
        }, true);
}
function loadStoItemsList() {
    startLoading();
    var producent = document.getElementById("sto_producent")[document.getElementById("sto_producent").selectedIndex].value;
    var category = document.getElementById("sto_category")[document.getElementById("sto_category").selectedIndex].value;
    var otype = 0;
    if (document.getElementById("sto_otype").selectedIndex) {
        otype = document.getElementById("sto_otype")[document.getElementById("sto_otype").selectedIndex].value;
    }
    location.href = "?dep=23&producent=" + producent + "&category=" + category + "&otype=" + otype;
}
function history_search() {
    startLoading();
    JsHttpRequest.query('content.php', {'w': 'historySearch'},
        function (result, errors) {
            if (errors) {
                alert(errors);
                stopLoading();
            }
            if (result) {
                document.getElementById("HistorySearchFrom").innerHTML = result["content"];
                showHistorySearchFrom();
                stopLoading();
            }
        }, true);
}

function addToRecomend(item_id) {
    if (item_id != "") {
        JsHttpRequest.query('content.php', {'w': 'addToRecomend', 'item_id': item_id},
            function (result, errors) {
                if (errors) {
                }
                if (result) {
                    alert(result["answer"]);
                }
            }, true);
    }
}
function delFromRecomend(item_id) {
    if (item_id != "") {
        JsHttpRequest.query('content.php', {'w': 'delFromRecomend', 'item_id': item_id},
            function (result, errors) {
                if (errors) {
                }
                if (result) {
                    alert(result["answer"]);
                }
            }, true);
    }
}
function DropImg(item_id, filename) {
    if (item_id != "") {
        JsHttpRequest.query('content.php', {'w': 'DropImg', 'item_id': item_id, 'filename': filename},
            function (result, errors) {
                if (errors) {
                }
                if (result) {
                    alert(result["answer"]);
                }
            }, true);
    }
}
function showAplicability(articleId) {
    startLoading();
    JsHttpRequest.query('content.php', {'w': 'showAplicability', 'articleId': articleId},
        function (result, errors) {
            if (errors) {
                alert(errors);
            }
            if (result) {
                document.getElementById("AplicabilityPlace").innerHTML = result["content"];
                document.getElementById("AplicabilityPlace").style.height = "750px";
                document.getElementById("AplicabilityPlace").style.height = "400px";
                document.getElementById("AplicabilityButton").style.visibility = "hidden";


                $('#AplicabilityPlace').slimscroll({
                    width: '750px', height: '400px', size: '10px', color: '#1962b2',
                    distance: '0px',
                    railVisible: true, railColor: '#e3f0ff', railOpacity: 0.3,
                    wheelStep: 10, allowPageScroll: false, disableFadeOut: false
                });
                stopLoading();

                //fleXenv.updateScrollBars(); fleXenv.fleXcrollMain("AplicabilityPlace");
            }
        }, true);
}
function showActionInfo(url) {
    startLoading();
    JsHttpRequest.query('content.php', {'w': 'showActionInfo', 'url': url},
        function (result, errors) {
            if (errors) {
                alert(errors);
            }
            if (result) {
                showInfoForm();
                document.getElementById("InfoFormInfo").innerHTML = result["content"];
                document.getElementById("InfoForm").style.height = "auto";
                document.getElementById("InfoForm").style.top = "200px";
                stopLoading();
                document.getElementById("InfoForm").style.zIndex = "999999";
            }
        }, true);
}
function setMasloCategory(category) {
    startLoading();
    document.getElementById("maslo_category").value = category;
    JsHttpRequest.query('content.php', {'w': 'showMasloCategory', 'category': category},
        function (result, errors) {
            if (errors) {
                alert(errors);
            }
            if (result) {
                document.getElementById("category_place").innerHTML = result["content"];
                document.getElementById("maslo_colname").value = '';
                document.getElementById("maslo_value").value = '';
                setMasloCategoryFilters(category);
            }
        }, true);
}
function setMasloCategoryFilters(category) {
    startLoading();
    JsHttpRequest.query('content.php', {'w': 'showMasloCategoryFilters', 'category': category},
        function (result, errors) {
            if (errors) {
                alert(errors);
            }
            if (result) {
                document.getElementById("filters_place").innerHTML = result["content"];
                setCategoryFilter('', category, '', '', '');
            }
        }, true);
}
function setCategoryFilter(el, category, col_name, value, page) {
    startLoading();
    var cols = document.getElementById("maslo_colname").value;
    cols = cols.split(',');
    var vals = document.getElementById("maslo_value").value;
    vals = vals.split(',');
    var new_value = col_name + "=" + value;
    if (el) {
        if (el.checked) {
            if (cols.indexOf(col_name) > -1) {
            } else {
                cols.push(col_name);
            }
            if (vals.indexOf(new_value) > -1) {
            } else {
                vals.push(new_value);
            }
        } else {
            while (vals.indexOf(new_value) !== -1) {
                vals.splice(vals.indexOf(new_value), 1);
            }
        }
    }
    document.getElementById("maslo_colname").value = cols;
    document.getElementById("maslo_value").value = vals;

    JsHttpRequest.query('content.php', {
            'w': 'showMasloRange',
            'category': category,
            'cols': cols,
            'vals': vals,
            'page': page
        },
        function (result, errors) {
            if (errors) {
            }
            if (result) {
                document.getElementById("filters_place").innerHTML = result["filters"];
                document.getElementById("range_list").innerHTML = result["content"];
                stopLoading();
            }
        }, true);

}
function showMasloItemInfo(item_id, category) {
    startLoading();
    JsHttpRequest.query('content.php', {'w': 'showMasloItemInfo', 'category': category, 'item_id': item_id},
        function (result, errors) {
            if (errors) {
                alert(errors);
            }
            if (result) {
                showInfoForm();
                document.getElementById("InfoFormInfo").innerHTML = result["content"];
                document.getElementById("InfoForm").style.height = "auto";
                stopLoading();
            }
        }, true);
}