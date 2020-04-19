<script>

var button = {
  view:"button", 
    id:"my_button", 
    value:"Button", 
    css:"webix_primary", 
    inputWidth:100,
    click: registroProyecto
}

var form1 = {
  view:"form", 
  name:'form1',
  id:'form1',
  elements: 
  [
    { 
      rows:
      [ 
        { template:"Información General", type:"section" },
        {
          cols:
          [ 
            { 
              view:"select",label:"Ciudad",     value:1, options:[
              { "id":1, "value":"Master" },
              { "id":2, "value":"Release" }
              ] 
            },
            { view:"datepicker", label:"Fecha", value:"" },
            { view:"datepicker", label:"Hora llegada", type:"time",stringResult:true },
            { view:"datepicker", label:"Hora Salida", type:"time",stringResult:true },
          ]
        },
        {
          cols:
          [ 
            { 
              view:"select",label:"Auditor",     value:1, options:[
              { "id":1, "value":"Master" },
              { "id":2, "value":"Release" }
              ] 
            },
            { view:"text", label:"Edad", value:"" },
            { 
              view:"select",label:"Vendedor",     value:1, options:[
              { "id":1, "value":"Master" },
              { "id":2, "value":"Release" }
              ] 
            },
          ]
        },
        {
          cols:
          [ 
            {view:"text", label:"Vivienda Cotizada", value:"" }
          ]         
        },
        { template:"Información General del Desarrollo", type:"section" },


        {
          cols:
          [ 
            { 
              view:"select",label:"Nombre Comercial del Desarrollo",     value:1, options:[
              { "id":1, "value":"Master" },
              { "id":2, "value":"Release" }
              ] 
            },
            { 
              view:"select",label:"Empresa Desarrolladora",     value:1, options:[
              { "id":1, "value":"Master" },
              { "id":2, "value":"Release" }
              ] 
            },
          ]
        },


        {
          cols:
          [ 
            { view:"text",label:"Calle"},
            { view:"text",label:"Exterior"},
            { view:"text",label:"Interior"},          
          ]
        },

        {
          cols:
          [ 
            { 
              view:"select",label:"Ciudad",     value:1, options:[
              { "id":1, "value":"Master" },
              { "id":2, "value":"Release" }
              ] 
            },
            { 
              view:"select",label:"Estado",     value:1, options:[
              { "id":1, "value":"Master" },
              { "id":2, "value":"Release" }
              ] 
            },       
          ]
        },

        {
          cols:
          [ 
            { 
              view:"select",label:"Colonia",     value:1, options:[
              { "id":1, "value":"Master" },
              { "id":2, "value":"Release" }
              ] 
            },
            { 
              view:"select",label:"CP",     value:1, options:[
              { "id":1, "value":"Master" },
              { "id":2, "value":"Release" }
              ] 
            },     
            { 
              view:"select",label:"Zona",     value:1, options:[
              { "id":1, "value":"Master" },
              { "id":2, "value":"Release" }
              ] 
            },  
          ]
        },

        {
          cols:
          [ 
            { 
              view:"select",label:"Plan Maestro",     value:1, options:[
              { "id":1, "value":"Master" },
              { "id":2, "value":"Release" }
              ] 
            },
            { 
              view:"uploader",
              id: "uploader_1",
              width:200,
              value:"Upload file",
            },
            { 
              view:"select",
              label:"Etapas Planeadas",    
              name:'etapas_seleccionadas',
              value:1, 
              options:[
              { "id":1, "value":"1" },
              { "id":2, "value":"2" },
              { "id":3, "value":"3" },
              { "id":4, "value":"4" },
              { "id":5, "value":"5" },
              { "id":6, "value":"6" },
              { "id":7, "value":"7" },
              { "id":8, "value":"8" },
              { "id":9, "value":"9" },
              { "id":10, "value":"10"}
              ],
              on:{
                onChange:function(etapas){
                  var etapas_seleccionadasas = $$('form1').getValues().etapas_seleccionadas
                  console.log(etapas_seleccionadasas); 

                  var form1 = $$('form1');
                  var a = $$("my_win");

                  if(a){
                    $$(form1).removeView("etapas_accordion");
                  }
                 
                  for (let index = 0; index < etapas_seleccionadasas; index++) {

                    form1.addView(
                      {
                        view:"accordion",
                        name:'etapas_accordion',
                        id:'etapas_accordion',
                        multi:true,
                        collapsed:true,
                        css:{"background":"#ccc !important"},
                        rows:
                          [                       
                            {
                              header:'Etapa 1', 
                              body: {
                              view:'form' ,
                              elements:
                              [
                                {
                                  rows:[
                                  {
                                    cols:[
                                      { view:"text", label:"Planeado", value:""},
                                      { view:"text", label:"Casas", value:""},
                                      { view:"text", label:"Deptos", value:""},
                                      { view:"text", label:"Terrenos", value:""}
                                    ]
                                  },
                                  {
                                    cols:[
                                      { view:"text", label:"Vendido", value:""},
                                      { view:"text", label:"Casas", value:""},
                                      { view:"text", label:"Deptos", value:""},
                                      { view:"text", label:"Terrenos", value:""}
                                    ]
                                  },
                                  {
                                    cols:[
                                      { view:"text", label:"En Venta", value:""},
                                      { view:"text", label:"Casas", value:""},
                                      { view:"text", label:"Deptos", value:""},
                                      { view:"text", label:"Terrenos", value:""}
                                    ]
                                  },
                                  {
                                    cols:[
                                      {  view:"select",label:"Estatus de la etapa",     value:1, options:[
                                        { "id":1, "value":"Por iniciar" },
                                        { "id":2, "value":"En Construcción" },
                                        { "id":2, "value":"Construído" },
                                        { "id":2, "value":"Terminado" },
                                        ] 
                                      },
                                      {
                                          view:"select",label:"Tipo de fraccionamiento",     value:1, options:[
                                        { "id":1, "value":"Privado" },
                                        { "id":2, "value":"Semiprivado" },
                                        { "id":2, "value":"Abierto" },
                                        { "id":2, "value":"Duplex" },
                                        ] 
                                      },


                                      {}
                                    ]
                                  }
                                ]
                                }
                              ]
                              } 
                            }                 
                          ]                  

                      })
                                        
                  }

                  
                   


                }
              }
            },                     
          ]
        },

        {
          view:'text',
          label:'Estatus del desarrollo',
          labelWidth:200
        }
      ]
    }
  ]
}







function registroProyecto(){

  var window = webix.ui({
      view:"window",
      id:"my_win",
      name:"my_win",
      head:"My Window",
      position:"center",
      width: 1000,
      height: 1000,
      body:{
        rows:[
          form1
        ],
  //template:"Some text",        
      }
  }).show();
}


webix.ui({     
  id:'mylayout',               
  type:"space",
    rows:[
     button
    ]
 });




/*
 function altaCliente(){


    var form_name = $$('formAlta').getValues().nombre;
    var form_last = $$('formAlta').getValues().apellido;
    var form_estatus = $$('formAlta').getValues().estatus;
    var form_rol = $$('formAlta').getValues().rol;

   // console.log(form_name);

    webix.ajax()
    .post("../clientes/altaClientes",{name:form_name, last:form_last, estatus:form_estatus, rol:form_rol})
    .then(function(data){
        let res = data.text()
       
       if(res=='00'){             
        webix.alert('ALTA EXITOSA',"alert-warning");

       }else{
        webix.alert('ALTA NO EXITOSA',"alert-warning"); 
       }


    })




 }*/





/*
webix.ui({  
  button



  	view:"form",
      id: 'formAlta',
    scroll:false,
  	width:300,
  	elements:[
        { view:"text", label:"Nombre", name:'nombre'},

        { view:"text", label:"Apellido", name:'apellido'},

        { view:"select", label:"Estatus", name:'estatus',options:[
            {id:'ACTIVO', value:'ACTIVO'},
            {id:'INACTIVO', value:'INACTIVO'}
        ]},

        { view:"select", label:"Rol", name:'rol',options: [
          {id:'ADMIN', value:'ADMIN'},
          {id:'USER', value:'USER'}
        ]},

        { margin:5, cols:[
            { view:"button", click:'altaCliente', label:"Alta" , type:"form" }
        
        ]}
  	]




});

*/

</script>