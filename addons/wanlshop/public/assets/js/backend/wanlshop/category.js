"use strict";define(["jquery","bootstrap","backend","table","form"],function(t,e,a,i,o){var s={index:function(){i.api.init({extend:{index_url:"wanlshop/category/index"+location.search,add_url:"wanlshop/category/add",edit_url:"wanlshop/category/edit",del_url:"wanlshop/category/del",multi_url:"wanlshop/category/multi",table:"wanlshop_category"}});var e=t("#table");e.bootstrapTable({url:t.fn.bootstrapTable.defaults.extend.index_url,pk:"id",sortName:"weigh",pagination:!1,columns:[[{checkbox:!0},{field:"id",title:__("Id")},{field:"name",title:__("Name"),align:"left",formatter:s.api.formatter.escape2Html},{field:"type",title:__("Type"),custom:{article:"info",goods:"success"},formatter:i.api.formatter.flag},{field:"image",title:__("Image"),events:i.api.events.image,formatter:i.api.formatter.image},{field:"status",title:__("Status"),searchList:{normal:__("Normal"),hidden:__("Hidden")},formatter:i.api.formatter.status},{field:"id",title:__("展开"),operate:!1,formatter:s.api.formatter.subnode},{field:"isnav",title:__("Isnav"),searchList:{1:__("Yes"),0:__("No")},formatter:i.api.formatter.toggle},{field:"operate",title:__("Operate"),table:e,events:i.api.events.operate,formatter:i.api.formatter.operate}]],search:!1,commonSearch:!1}),e.on("post-body.bs.table",function(e,a,i,o){t(".btn-node-sub.disabled[data-pid!=0]").closest("tr").hide(),t(".btn-node-sub").off("click").on("click",function(e){var a=!!(t(this).data("shown")||t("a.btn[data-pid='"+t(this).data("id")+"']:visible").size()>0);return t("a.btn[data-pid='"+t(this).data("id")+"']").each(function(){t(this).closest("tr").toggle(!a),t(this).hasClass("disabled")||t(this).trigger("click")}),t(this).data("shown",!a),!1})}),t(document.body).on("click",".btn-toggle",function(e){t("a.btn[data-id][data-pid][data-pid!=0].disabled").closest("tr").hide();var a=this,i=t("i",a).hasClass("fa-chevron-down");t("i",a).toggleClass("fa-chevron-down",!i),t("i",a).toggleClass("fa-chevron-up",i),t("a.btn[data-id][data-pid][data-pid!=0]").not(".disabled").closest("tr").toggle(i),t(".btn-node-sub[data-pid=0]").data("shown",i)}),t(document.body).on("click",".btn-toggle-all",function(e){var a=this,i=t("i",a).hasClass("fa-plus");t("i",a).toggleClass("fa-plus",!i),t("i",a).toggleClass("fa-minus",i),t(".btn-node-sub.disabled[data-pid!=0]").closest("tr").toggle(i),t(".btn-node-sub[data-pid!=0]").data("shown",i)}),i.api.bindevent(e)},goods:function(){i.api.init({extend:{index_url:"wanlshop/category/goods"+location.search,add_url:"wanlshop/category/add?type=goods",edit_url:"wanlshop/category/edit?type=goods",del_url:"wanlshop/category/del",multi_url:"wanlshop/category/multi",table:"wanlshop_category"}});var e=t("#table");e.bootstrapTable({url:t.fn.bootstrapTable.defaults.extend.index_url,pk:"id",sortName:"weigh",pagination:!1,columns:[[{checkbox:!0},{field:"id",title:__("Id")},{field:"name",title:__("Name"),align:"left",formatter:s.api.formatter.escape2Html},{field:"type",title:__("Type"),custom:{article:"info",goods:"success"},formatter:i.api.formatter.flag},{field:"image",title:__("Image"),events:i.api.events.image,formatter:i.api.formatter.image},{field:"status",title:__("Status"),searchList:{normal:__("Normal"),hidden:__("Hidden")},formatter:i.api.formatter.status},{field:"id",title:__("展开"),operate:!1,formatter:s.api.formatter.subnode},{field:"isnav",title:__("Isnav"),searchList:{1:__("Yes"),0:__("No")},formatter:i.api.formatter.toggle},{field:"operate",title:__("Operate"),table:e,events:i.api.events.operate,formatter:i.api.formatter.operate}]],search:!1,commonSearch:!1}),e.on("post-body.bs.table",function(e,a,i,o){t(".btn-node-sub.disabled[data-pid!=0]").closest("tr").hide(),t(".btn-node-sub").off("click").on("click",function(e){var a=!!(t(this).data("shown")||t("a.btn[data-pid='"+t(this).data("id")+"']:visible").size()>0);return t("a.btn[data-pid='"+t(this).data("id")+"']").each(function(){t(this).closest("tr").toggle(!a),t(this).hasClass("disabled")||t(this).trigger("click")}),t(this).data("shown",!a),!1})}),t(document.body).on("click",".btn-toggle",function(e){t("a.btn[data-id][data-pid][data-pid!=0].disabled").closest("tr").hide();var a=this,i=t("i",a).hasClass("fa-chevron-down");t("i",a).toggleClass("fa-chevron-down",!i),t("i",a).toggleClass("fa-chevron-up",i),t("a.btn[data-id][data-pid][data-pid!=0]").not(".disabled").closest("tr").toggle(i),t(".btn-node-sub[data-pid=0]").data("shown",i)}),t(document.body).on("click",".btn-toggle-all",function(e){var a=this,i=t("i",a).hasClass("fa-plus");t("i",a).toggleClass("fa-plus",!i),t("i",a).toggleClass("fa-minus",i),t(".btn-node-sub.disabled[data-pid!=0]").closest("tr").toggle(i),t(".btn-node-sub[data-pid!=0]").data("shown",i)}),t(document).on("click",".btn-create",function(){a.api.open("wanlshop/category/create/",__("批量生成菜单"))}),i.api.bindevent(e)},article:function(){i.api.init({extend:{index_url:"wanlshop/category/article"+location.search,add_url:"wanlshop/category/add?type=article",edit_url:"wanlshop/category/edit?type=article",del_url:"wanlshop/category/del",multi_url:"wanlshop/category/multi",table:"wanlshop_category"}});var e=t("#table");e.bootstrapTable({url:t.fn.bootstrapTable.defaults.extend.index_url,pk:"id",sortName:"weigh",pagination:!1,columns:[[{checkbox:!0},{field:"id",title:__("Id")},{field:"name",title:__("Name"),align:"left",formatter:s.api.formatter.escape2Html},{field:"type",title:__("Type"),custom:{article:"info",goods:"success"},formatter:i.api.formatter.flag},{field:"image",title:__("Image"),events:i.api.events.image,formatter:i.api.formatter.image},{field:"status",title:__("Status"),searchList:{normal:__("Normal"),hidden:__("Hidden")},formatter:i.api.formatter.status},{field:"id",title:__("展开"),operate:!1,formatter:s.api.formatter.subnode},{field:"isnav",title:__("Isnav"),searchList:{1:__("Yes"),0:__("No")},formatter:i.api.formatter.toggle},{field:"operate",title:__("Operate"),table:e,events:i.api.events.operate,formatter:i.api.formatter.operate}]],search:!1,commonSearch:!1}),e.on("post-body.bs.table",function(e,a,i,o){t(".btn-node-sub.disabled[data-pid!=0]").closest("tr").hide(),t(".btn-node-sub").off("click").on("click",function(e){var a=!!(t(this).data("shown")||t("a.btn[data-pid='"+t(this).data("id")+"']:visible").size()>0);return t("a.btn[data-pid='"+t(this).data("id")+"']").each(function(){t(this).closest("tr").toggle(!a),t(this).hasClass("disabled")||t(this).trigger("click")}),t(this).data("shown",!a),!1})}),t(document.body).on("click",".btn-toggle",function(e){t("a.btn[data-id][data-pid][data-pid!=0].disabled").closest("tr").hide();var a=this,i=t("i",a).hasClass("fa-chevron-down");t("i",a).toggleClass("fa-chevron-down",!i),t("i",a).toggleClass("fa-chevron-up",i),t("a.btn[data-id][data-pid][data-pid!=0]").not(".disabled").closest("tr").toggle(i),t(".btn-node-sub[data-pid=0]").data("shown",i)}),t(document.body).on("click",".btn-toggle-all",function(e){var a=this,i=t("i",a).hasClass("fa-plus");t("i",a).toggleClass("fa-plus",!i),t("i",a).toggleClass("fa-minus",i),t(".btn-node-sub.disabled[data-pid!=0]").closest("tr").toggle(i),t(".btn-node-sub[data-pid!=0]").data("shown",i)}),i.api.bindevent(e)},select:function(){i.api.init({extend:{index_url:"wanlshop/category/select"}});var e=[],o=t("#table");o.on("check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table",function(a,i){"check"==a.type||"uncheck"==a.type?i=[i]:e=[],t.each(i,function(t,i){if(a.type.indexOf("uncheck")>-1){var o=e.indexOf(i.route);o>-1&&e.splice(o,1)}else-1==e.indexOf(i.route)&&e.push(i.route)})}),o.bootstrapTable({url:t.fn.bootstrapTable.defaults.extend.index_url,sortName:"id",pagination:!1,columns:[[{checkbox:!0},{field:"id",title:__("Id")},{field:"image",title:__("Image"),events:i.api.events.image,formatter:i.api.formatter.image},{field:"type",title:__("Type"),custom:{article:"info",goods:"success"},formatter:i.api.formatter.flag},{field:"name",title:__("Name"),align:"left",formatter:s.api.formatter.escape2Html},{field:"id",title:__("Route"),operate:!1,formatter:s.api.formatter.route},{field:"operate",title:__("Operate"),events:{"click .btn-chooseone":function(t,e,i,o){var s=a.api.query("multiple");s="true"==s,Fast.api.close({url:"/pages/product/list?data="+encodeURIComponent(JSON.stringify({category_id:i.id,category_name:i.name.replace(i.spacer,"")})),name:i.name.replace(i.spacer,""),multiple:s})}},formatter:function(){return'<a href="javascript:;" class="btn btn-danger btn-chooseone btn-xs"><i class="fa fa-check"></i> '+__("Choose")+"</a>"}}]]}),t(document).on("click",".btn-choose-multi",function(){var t=a.api.query("multiple");t="true"==t,Fast.api.close({url:e.join(","),multiple:t})}),i.api.bindevent(o)},add:function(){s.api.bindevent()},create:function(){s.api.bindevent()},edit:function(){s.api.bindevent()},api:{formatter:{subnode:function(t,e,a){return'<a href="javascript:;" data-toggle="tooltip" title="'+__("Toggle sub menu")+'" data-id="'+e.id+'" data-pid="'+e.pid+'" class="btn btn-xs '+(1==e.haschild||1==e.ismenu?"btn-success":"btn-default disabled")+' btn-node-sub"><i class="fa fa-sitemap"></i></a>'},route:function(t,e,a){return"/pages/product/list?data="+{category_id:e.id,category_name:e.name.replace(e.spacer,"")}},escape2Html:function(t,e,a){return t.toString().replace(/(&|&amp;)nbsp;/g,"")}},bindevent:function(){o.api.bindevent(t("form[role=form]"))}}};return s});