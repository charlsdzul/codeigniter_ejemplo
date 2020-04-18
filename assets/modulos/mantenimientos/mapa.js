var path = "../sistema/imgs/";

var app_mapa={

    id:'win_mapa', 

    cols:[

        {

            rows:[

                {   

                  view:'toolbar',

                    cols:[

                        {view:'label',label:'Mapa'},

                        {view:'button',label:'Agregar',type:'icon',icon:'plus-circle',width:100,click:function(){

                                $$('fmapa').clear();

                                $$('fmapa').clearValidation();

                                $$('c_form_mapa').show();

                                var mapObj = $$("map").getMap();

                                mapObj.setZoom(8);

                        }}

                    ]   

                },
              
                {

                view:"open-map", 
                id:"map",
                zoom:9,
                center:[ 23.249, -106.411 ]

                }
               
            ]
        },
        {

                id:'c_form_mapa',

                hidden:true,

                rows:[

                    {

                        view:'toolbar',

                        cols:[

                            {view:'label',label:'Datos Marcador'}                            

                        ]

                    },

                    {                             

                       view:'form',

                       id:'fmapa',

                       elements:[

                            {view:'text',name:'lat',label:'Latitud',required:true},

                            {view:'text',name:'long',label:'Longitud',required:true},

                        {

                               cols:[

                                     {},

                                     { view:"button", type:"imageButton",label:"Agregar", image:path+"save.gif",height:60,width:120,hotkey:'enter',click:function(){

                                         
                                        if($$('fmapa').validate()){ 

                                             var mapObj = $$("map").getMap();

                                            var lat_m = $$('fmapa').getValues().lat;
                                            var long_m = $$('fmapa').getValues().long;
                                        
                                            mapObj.panTo([lat_m, long_m]);
                                            L.marker([lat_m, long_m]).addTo(mapObj);
                                            mapObj.setZoom(10);
                                            $$('c_form_mapa').hide();

                                        };

                                     }}, 

                                     {view:'button', type:"imageButton",label:'cerrar', image:path+"undo.gif",height:60,width:120,fillspace:true,click:function(){

                                            $$('c_form_mapa').hide();

                                     }}

                               ]

                            },

                           {}

                        ],

                        elementsConfig:{

                            labelWidth:120

                        },

                        rules:{                            

                            lat:webix.rules.isNotEmpty,
                            long:webix.rules.isNotEmpty

                        },

                    },

                ]

            }
    ]






}
