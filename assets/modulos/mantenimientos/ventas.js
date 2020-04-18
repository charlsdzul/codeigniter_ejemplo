var path = "../sistema/imgs/";
var app_ventas={
    //datatable, generar 2 ventanas
    id:'wventas',
    view:'window',
    head:'VENTAS',
    //hidden:false,
    modal:true,
    width:1200,
    height:800,
    position:'center',
    body:{
            isolate:true, type:"wide", rows:[
			    { template:"top", height:35 },
				    { type:"wide", cols:[
				        { template:"left", id:"left",                            
                        },
                            { view:'text',label:'Entre Calle',name:'calle1'},                            
                            
					    { template:"center", id:"center" },
					    { template:"right", id:"right" }
				    ]},
					    { template:"bottom", height:35 }
             ]				

    },
}
    


webix.ready(function(){
   webix.ui(app_ventas); 
    
});




         /* type:"space", id:"a1", rows:[{
                 type:"space", padding:0, responsive:"a1", cols:[
                     { view:"list", data:["Users", "Reports", "Settings"],
                       ready:function(){ this.select(this.getFirstId()); },
                       select:true, scroll:false, width:200 },
                     { template:"column 2", width:200 },
                     { view:"datatable", select:true, columns:[
                        { id:"title", fillspace:1 }, { id:"votes"}
                       ], data:small_film_set,
                       minWidth:300 }
                 ]}
          ] */  
        /*cols:[
			{ view:"form", elements:[
				{ type:"header", template:"Validate on blur"},
				{ view:"text", labelAlign:"right", 
					name:"country", label:"Country",
					validate:"isNotEmpty", validateEvent:"blur",
					value:"Belarus" },
				{ view:"text", labelPosition:"top", 
					name:"city", label:"City",
					validate:"isNotEmpty", validateEvent:"blur",
					value:"" }, {}
			]},
			{ view:"form", elements:[
				{ type:"header", template:"Validate on key"},
				{ view:"text", labelAlign:"right", 
					name:"country", label:"Country",
					validate:"isNotEmpty", validateEvent:"key",
					value:"Belarus" },
				{ view:"text", labelPosition:"top", 
					name:"city", label:"City",
					validate:"isNotEmpty", validateEvent:"key",
					value:"" }, {}
			]},
			{ view:"form", elements:[
				{ type:"header", template:"Validate by API"},
				{ view:"text", labelAlign:"right", 
					name:"country", label:"Country",
					validate:"isNotEmpty",
					value:"Belarus" },
				{ view:"text", labelPosition:"top", 
					name:"city", label:"City",
					validate:"isNotEmpty",
					value:"" },
				{ view:"button", type:"form", value:"Validate", click:function(){
					webix.message( this.getFormView().validate() );
				}}, {}
			]}
		]*/