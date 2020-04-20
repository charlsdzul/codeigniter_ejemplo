<script>




var form1 = {
  view:"form", 
  name:`form1`,
  id:`form1`,
  elements: 
  [
    { 
      rows:
      [ 
        { template:"<b>Información General</b>", type:"section" },
        {
          cols:
          [ 
            { width:300,
              view:"select", 
              name:`ciudad`,
              label:"Ciudad",     
              value:1, 
              options:"../prueba/getciudades"  //URL de controlador. GET no necesita enviar parametro
            },
            { view:"datepicker",name:`fecha`, label:"Fecha", width:200, labelWidth:50},
            { view:"datepicker", name:`hora_llegada`,label:"Hora llegada", width:200, labelWidth:90,type:"time",stringResult:true },
            { view:"datepicker", name:`hora_salida`,label:"Hora Salida", width:200,labelWidth:90,type:"time",stringResult:true },
          ]
        },
        {
          cols:
          [ 
            {view:"text",name:`vivienda_cotizada`, label:"Vivienda Cotizada", labelWidth:120 },
            {view:"text",label:"Vendedor", name:`vendedor` },
          ]         
        },
        {
          cols:
          [ 
            { view:"text",label:"Auditor", name:`auditor`,},
            { view:"text", label:"Edad (auditor)",name:`auditor_edad`, inputWidth:150, Width:100, labelWidth:100},
            
          ]
        },

        { template:"<b>Información General del Desarrollo</b>", type:"section" },


        {
          cols:
          [ 
            { 
              view:"select",
              name:`desarrollo_nombre_comercial_desarrollo`,
              label:"Nombre Comercial del Desarrollo",
              labelWidth:225,
              value:1, 
              options:"../prueba/getdesarrollos" 
            },
            { 
              view:"select",
              name:`desarrollo_nombre_empresa_desarroladora`,
              label:"Empresa Desarrolladora",    
              labelWidth:175, 
              value:1, 
              options:"../prueba/getconstructoras" 
            },
          ]
        },

        {
          cols:
          [ 
            { 
              view:"select",name:`desarrollo_ciudad`, id:`desarrollo_ciudad`,label:"Ciudad",     value:1, options:"../prueba/getciudades",
              on:{
                onChange:function(){
                  var desarrollo_ciudad = $$(`desarrollo_ciudad`).getValue()
                  webix.ajax()
                  .get("../prueba/getestado",{desarrollo_ciudad: desarrollo_ciudad})
                  .then(function(data){
                      let res = data.text()   
                      $$(`desarrollo_estado`).setValue(res)
                  }) 
                }
              }
            },  
            { view:"text",name:`desarrollo_estado`, id:`desarrollo_estado`,label:"Estado", value:``, disabled:true }       ,
            { 
              view:"select",
              name:`desarrollo_colonia`,
              id:`desarrollo_colonia`,
              label:"Colonia",
              value:1, 
              options: "../prueba/getColoniasSinaloa" ,
              on:{
                onChange:function(){

                var desarrollo_colonia = $$(`desarrollo_colonia`).getValue()

                  webix.ajax()
                  .get("../prueba/getcp",{desarrollo_colonia: desarrollo_colonia})
                  .then(function(data){
                      let res = data.text()   
                      console.log(res) 
                      $$(`desarrollo_cp`).setValue(res)

                  })
                }
              }             

            },
          ]
        },

        {
          cols:
          [ 
            { view:"text",name:`desarrollo_calle`, label:"Calle",width:400,},
            { view:"text",name:`desarrollo_numero_exterior`,label:"Exterior",inputWidth:150},
            { view:"text",name:`desarrollo_numero_interior`,label:"Interior",inputWidth:150}, 
            { 
              view:"select",              
              name:`desarrollo_cp`,
              id:`desarrollo_cp`,
              label:"CP", 
              labelWidth:50,   
              value:`81476`, //Correspondiente a Col "1 de mayo " 
              options:"../prueba/getcodigopostalsinaloa"  
            }
      
          ]
        },

        {
          cols:
          [            
            { 
              view:"select",name:`desarrollo_plan_maestro`,label:"Plan Maestro",     value:1, options:[
              { "id":1, "value":"SI" },
              { "id":2, "value":"NO" }
              ] 
            },
            { 
              view:"uploader",
              name:`desarrollo_plan_maestro_imagen`,
              id: "uploader_1",
              width:200,
              value:"Upload file",
            },      
          ]
        },
        {
          cols:
          [  
            { view:"select",name:`desarrollo_zona`,label:"Zona",     value:1, options:"../prueba/getzonas" }, 
            {
              view:`select`,
              name:`desarrollo_estatus_desarrollo`,
              label:`Estatus del desarrollo`,
              labelWidth:150,
              options:[
                { "id":1, "value":"Por iniciar" },
                { "id":2, "value":"En Construcción" },
                { "id":3, "value":"Construído" },
                { "id":4, "value":"Terminado" }
              ]
              
            },
            { 
              view:"select",
              name:`desarrollo_etapas_planeadas`,
              label:"Etapas Planeadas",    
              labelWidth:125,
              width:250,
              name:`etapas_seleccionadas`,
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
                  var etapas_seleccionadas = $$(`form1`).getValues().etapas_seleccionadas
                  var etapas_seleccionadas_2 = parseInt(etapas_seleccionadas) + 1
                  console.log(etapas_seleccionadas_2)

                  var form_etapas = $$(`form_etapas`);

                  form_etapas.removeView(`etapas_accordion-1`);
                  form_etapas.removeView(`etapas_accordion-2`);
                  form_etapas.removeView(`etapas_accordion-3`);
                  form_etapas.removeView(`etapas_accordion-4`);
                  form_etapas.removeView(`etapas_accordion-5`);
                  form_etapas.removeView(`etapas_accordion-6`);
                  form_etapas.removeView(`etapas_accordion-7`);
                  form_etapas.removeView(`etapas_accordion-8`);
                  form_etapas.removeView(`etapas_accordion-9`);
                  form_etapas.removeView(`etapas_accordion-10`);

                    for (let index = 1; index < (etapas_seleccionadas_2); index++) {
                      form_etapas.addView(
                        {
                          view:`accordion`,
                          name:`etapas_accordion-${index}`,
                          id:`etapas_accordion-${index}`,
                          multi:true,
                          collapsed:true,
                          css:{"background":"#ccc !important"},
                          rows:
                                [                       
                                  {
                                    header:`Etapa ${index}`, 
                                    body: {
                                    view:`form`,
                                    id:`form_etapas-${index}`,
                                    name:`form_etapas-${index}`,
                                    elements:
                                    [
                                      {
                                        rows:[
                                        {
                                          cols:[
                                            { view:"text", label:"Planeado", name:`etapa${index}_pleaneado`},
                                            { view:"text", label:"Casas", name:`etapa${index}_pleaneado_casas`},
                                            { view:"text", label:"Deptos", name:`etapa${index}_pleaneado_deptos`},
                                            { view:"text", label:"Terrenos", name:`etapa${index}_pleaneado_terrenos`}
                                          ]
                                        },
                                        {
                                          cols:[
                                            { view:"text", label:"Vendido", name:`etapa${index}_vendido`},
                                            { view:"text", label:"Casas", name:`etapa${index}_vendido_casas`},
                                            { view:"text", label:"Deptos", name:`etapa${index}_vendido_deptos`},
                                            { view:"text", label:"Terrenos", name:`etapa${index}_vendido_terrenos`}
                                          ]
                                        },
                                        {
                                          cols:[
                                            { view:"text", label:"En Venta", name:`etapa${index}_venta`},
                                            { view:"text", label:"Casas", name:`etapa${index}_venta_casas`},
                                            { view:"text", label:"Deptos", name:`etapa${index}_venta_deptos`},
                                            { view:"text", label:"Terrenos", name:`etapa${index}_venta_terrenos`}
                                          ]
                                        },
                                        {
                                          cols:[
                                            {  view:"select",label:"Estatus de la etapa", name:`etapa${index}_estatus`,value:1, labelWidth:150,options:[
                                              { "id":1, "value":"Por iniciar" },
                                              { "id":2, "value":"En Construcción" },
                                              { "id":3, "value":"Construído" },
                                              { "id":4, "value":"Terminado" },
                                              ] 
                                            },
                                            {
                                                view:"select",label:"Tipo de fraccionamiento", name:`etapa${index}_tipo`, labelWidth:175, value:1, options:[
                                              { "id":1, "value":"Privado" },
                                              { "id":2, "value":"Semiprivado" },
                                              { "id":3, "value":"Abierto" },
                                              { "id":4, "value":"Duplex" },
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

            
        
            }

                      )                      
                    }

                }
              },
           
            },                     
          ]
        },
      ]
    }
  ]
}

var form_etapas = {
  view:"form", 
  name:`form_etapas`,
  id:`form_etapas`, 
  elements: [
          {
                          view:`accordion`,
                          name:`etapas_accordion-1`,
                          id:`etapas_accordion-1`,
                          multi:true,
                          collapsed:true,
                          css:{"background":"#ccc !important"},
                          rows:
                                [                       
                                  {
                                    header:`Etapa 1`, 
                                    body: {
                                    view:`form`,
                                    id:`form_etapas-1`,
                                    name:`form_etapas-1`,
                                    elements:
                                    [
                                      {
                                        rows:[
                                        {
                                          cols:[
                                            { view:"text", label:"Planeado", name:`etapa1_planeado`},
                                            { view:"text", label:"Casas", name:`etapa1_planeado_casas`},
                                            { view:"text", label:"Deptos", name:`etapa1_planeado_deptos`},
                                            { view:"text", label:"Terrenos", name:`etapa1_planeado_terrenos`}
                                          ]
                                        },
                                        {
                                          cols:[
                                            { view:"text", label:"Vendido", name:`etapa1_vendido`},
                                            { view:"text", label:"Casas", name:`etapa1_vendido_casas`},
                                            { view:"text", label:"Deptos", name:`etapa1_vendido_deptos`},
                                            { view:"text", label:"Terrenos", name:`etapa1_vendido_terrenos`}
                                          ]
                                        },
                                        {
                                          cols:[
                                            { view:"text", label:"En Venta", name:`etapa1_venta`},
                                            { view:"text", label:"Casas", name:`etapa1_venta_casas`},
                                            { view:"text", label:"Deptos", name:`etapa1_venta_deptos`},
                                            { view:"text", label:"Terrenos", name:`etapa1_venta_terrenos`}
                                          ]
                                        },
                                        {
                                          cols:[
                                            {  view:"select",label:"Estatus de la etapa", name:`etapa1_estatus`,value:1, labelWidth:150,options:[
                                              { "id":1, "value":"Por iniciar" },
                                              { "id":2, "value":"En Construcción" },
                                              { "id":3, "value":"Construído" },
                                              { "id":4, "value":"Terminado" },
                                              ] 
                                            },
                                            {
                                                view:"select",label:"Tipo de fraccionamiento", name:`etapa1_tipo`, labelWidth:175, value:1, options:[
                                              { "id":1, "value":"Privado" },
                                              { "id":2, "value":"Semiprivado" },
                                              { "id":3, "value":"Abierto" },
                                              { "id":4, "value":"Duplex" },
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

            
        
          }
  ]
  
}


var button_submit={
  view:"button", 
    id:"button_submit", 
    value:"Guardar", 
    css:"webix_primary", 
    inputWidth:100,
    align:"center",
    click: guardarProyecto
}






function guardarProyecto(){

  //Obtiene valores del formulario 1. Es necesario que los inputs tengan el atributo 'name'
  form1_datos = $$(`form1`).getValues();
  console.log(form1_datos)

  var numero_etapas = 0;
  var etapas_datos = {}; //Array para almacenar arrays de cada etapa

  // Obtiene los valores de cada form/acordion de cada etapa
  for (let index = 0; index<10; index++) {
    form_etapa = $$(`form_etapas-${index+1}`)

    if(form_etapa){
      form_etapa = $$(`form_etapas-${index+1}`).getValues();
      console.log(form_etapa);
      etapas_datos[`etapa_${numero_etapas+1}`] = form_etapa        
      numero_etapas++; //Cuenta el número de etapas (dato para enviar a servidor)
    } 

  } 

  console.log(numero_etapas)


  webix.ajax().post("../prueba/saveDesarrollo", { form1_datos:form1_datos, etapas_datos:etapas_datos,numero_etapas:numero_etapas }).then(function(data){
           let res = JSON.parse(data.text())

           console.dir(res)
            //var dato_cliente;
/*
            res.forEach(cliente => {
                dato_cliente = {
                id: cliente[0], 
                usuario: cliente[1] + " " + cliente[2], 
                estatus: cliente[3], 
                rol: cliente[4],
            };

                $$('tablaDatos').add(dato_cliente)                   
            });
*/


        });

}


var button = {
  view:"button", 
    id:"my_button", 
    value:"Button", 
    css:"webix_secondary", 
    inputWidth:100,
    click: registroProyecto
}


function registroProyecto(){

  var window = webix.ui({
      view:"window",
      id:"my_win",
      name:"my_win",
      head:"Registro de Evaluación",
      position:"center",
      width: 1000,
      height: 1000,
      body:{
        rows:[
          form1,
          form_etapas,
          button_submit
        ],
      }
  }).show(); 

}


webix.ui({     
  id:`mylayout`,               
  type:"space",
    rows:[
      button
    ]
 });
</script>