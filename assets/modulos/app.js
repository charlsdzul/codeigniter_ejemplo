/*var app={
    urls:{},
    base_url:BASE_URL,
    guardar:function(url,datos,success){
        webix.ajax().post(app.base_url + url,datos,success);
    },
    grid:function(datatable,url){
        $$(datatable).clearAll();
        $$(datatable).load(app.base_url +url);
    },
    combo:function(combo,url){
       $$(combo).setValue('');
       $$(combo).getList().clearAll();
       $$(combo).getList().load(url,function(){
           var first=$$(combo).getList().getFirstId();
           if(first!=undefined)
               $$(combo).setValue(first);
       });
    },
};*/



var app={
    urls:{},
    base_url:BASE_URL,
    guardar:function(url,datos,success){
        webix.ajax().post(app.base_url + url,datos,success);
    },
    grid:function(datatable,url){
        $$(datatable).clearAll();
        $$(datatable).load(app.base_url +url);
    },
    combo:function(combo,url){
      $$(combo).setValue('');              
      $$(combo).define('options',url);
    },
};
