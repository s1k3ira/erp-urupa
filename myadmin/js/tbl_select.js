$(document).ready(function(){$('<div id="togglesearchformdiv"><a id="togglesearchformlink"></a></div>').insertAfter("#tbl_search_form").hide();$("#togglesearchformlink").html(PMA_messages.strShowSearchCriteria).bind("click",function(){var a=$(this);$("#tbl_search_form").slideToggle();a.text()==PMA_messages.strHideSearchCriteria?a.text(PMA_messages.strShowSearchCriteria):a.text(PMA_messages.strHideSearchCriteria);return false});$("#tbl_search_form.ajax").live("submit",function(a){$search_form=$(this);
a.preventDefault();$("#sqlqueryresults").empty();var b=PMA_ajaxShowMessage(PMA_messages.strSearching,false);PMA_prepareForAjaxRequest($search_form);$.post($search_form.attr("action"),$search_form.serialize(),function(c){PMA_ajaxRemoveMessage(b);if(typeof c=="string"){$("#sqlqueryresults").html(c);$("#sqlqueryresults").trigger("makegrid");$("#tbl_search_form").slideToggle().hide();$("#togglesearchformlink").text(PMA_messages.strShowSearchCriteria);$("#togglesearchformdiv").show();PMA_init_slider()}else{c.message!=
undefined&&$("#sqlqueryresults").html(c.message);c.error!=undefined&&$("#sqlqueryresults").html(c.error)}})});$(".open_search_gis_editor").hide();$(".geom_func").bind("change",function(){var a=$(this),b=["Contains","Crosses","Disjoint","Equals","Intersects","Overlaps","Touches","Within","MBRContains","MBRDisjoint","MBREquals","MBRIntersects","MBROverlaps","MBRTouches","MBRWithin","ST_Contains","ST_Crosses","ST_Disjoint","ST_Equals","ST_Intersects","ST_Overlaps","ST_Touches","ST_Within"],c=b.concat(["Envelope",
"EndPoint","StartPoint","ExteriorRing","Centroid","PointOnSurface"]),d=a.parents("tr").find("td:nth-child(5)").find("select");$.inArray(a.val(),b)>=0?d.attr("readonly",true):d.attr("readonly",false);b=a.parents("tr").find(".open_search_gis_editor");$.inArray(a.val(),c)>=0?b.show():b.hide()});$(".open_search_gis_editor").live("click",function(a){a.preventDefault();var b=$(this);a=b.parent("td").children("input[type='text']").val();var c=b.parents("tr").find(".geom_func").val();c=c=="Envelope"?"polygon":
c=="ExteriorRing"?"linestring":"point";b=b.parent("td").children("input[type='text']").attr("name");var d=$("input[name='token']").val();openGISEditor();gisEditorLoaded?loadGISEditor(a,"Parameter",c,b,d):loadJSAndGISEditor(a,"Parameter",c,b,d)})},"top.frame_content");
