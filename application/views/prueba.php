<script>

const FORM_INFORMACION_GENERAL = {
	view: "form",
	name: `FORM_INFORMACION_GENERAL`,
	id: `FORM_INFORMACION_GENERAL`,
	elements: [
		{
			rows: [
				{ template: "<b>Información General</b>", type: "section" }, // INFORMACIÓN GENERAL
				{
					cols: [// CIUDAD, FECHA, HORRA LLEGADA, HORA SALIDA
						{
							view: "combo",
							width: 300,
							name: "ciudad",
							label: "Ciudad",
							placeholder: "Selecciona ciudad",
							id: "ciudad",
							options: {
								view: "suggest",
								body: {
									view: "list",
									url: "..//prueba/getciudadessinaloa",
								},
							},
						},
						{
							view: "datepicker",
							name: `fecha`,
							label: "Fecha",
							value: new Date(),
							width: 200,
							labelWidth: 50,
						},
						{
							view: "datepicker",
							name: `hora_llegada`,
							label: "Hora llegada",
							width: 200,
							labelWidth: 90,
							type: "time",
							stringResult: true,
						},
						{
							view: "datepicker",
							name: `hora_salida`,
							label: "Hora Salida",
							width: 200,
							labelWidth: 90,
							type: "time",
							stringResult: true,
						},
					],
				},
				{
					cols: [//VIVIENDA COTIZADA, VENDEDOR
						{
							view: "text",
							name: `vivienda_cotizada`,
							label: "Vivienda Cotizada",
							labelWidth: 120,
						},
						{ view: "text", label: "Vendedor", name: `vendedor` },
					],
				},
				{
					cols: [ // AUDITOR, AUDITOR EDAD
						{ view: "text", label: "Auditor", name: `auditor`, on: {} },
						{
							view: "text",
							label: "Edad (auditor)",
							name: `auditor_edad`,
							inputWidth: 150,
							Width: 100,
							labelWidth: 100,

						},
					],
				},

				{ template: "<b>Información del Desarrollo</b>", type: "section" }, //INFORMACIÓN DEL DESARROLLO

				{
					cols: [// DESAROLLO, DESARROLLADORA
						{
							view: "combo",
							name: "desarrollo_nombre_comercial_desarrollo",
							label: "Desarrollo",
							disabled: true,
							id: "desarrollo_nombre_comercial_desarrollo",
							options: {
								view: "suggest",
								body: {
									view: "list",
									url: "..//prueba/getdesarrollos",
								},
							},
						},
						{
							view: "combo",
							name: "desarrollo_nombre_empresa_desarroladora",
							label: "Desarrolladora",
							labelWidth: 100,
							id: "desarrollo_nombre_empresa_desarroladora",
							options: {
								view: "suggest",
								body: {
									view: "list",
									url: "..//prueba/getconstructoras",
								},
							},
						},
					],
				},

				{
					cols: [// CALLE, NO EXTERIOR, NO INTERIOR
						{
							view: "text",
							name: `desarrollo_calle`,
							label: "Calle",
							width: 450,
						},{},
						{
							view: "text",
							name: `desarrollo_numero_exterior`,
							label: "Exterior",
							inputWidth: 150,
						},
						{
							view: "text",
							name: `desarrollo_numero_interior`,
							label: "Interior",
							inputWidth: 150,
						},
					],
				},

				{
					cols: [// CIUDAD, ESTADO
						{
							view: "combo",
							name: "desarrollo_ciudad",
							label: "Ciudad",
							placeholder: "Selecciona",
							id: "desarrollo_ciudad",
							options: {
								view: "suggest",
								body: {
									view: "list",
									url: "..//prueba/getciudadessinaloa",
								},
							},
						},
						{
							view: "text",
							name: `desarrollo_estado`,
							id: `desarrollo_estado`,
							label: "Estado",
							disabled: true,
						},
					],
				},

				{
					cols: [// COLONIA, CP

						{
							view: "combo",
							name: "desarrollo_colonia",
							label: "Colonia",
							placeholder: "Selecciona",
							disabled: true,
							id: "desarrollo_colonia",
							options: {
								view: "suggest",
								body: {
									view: "list",
									url: "..//prueba/getColoniasSinaloa",
								},
							},
						},
						{
							view: "combo",
							name: "desarrollo_cp",
							id: "desarrollo_cp",
							disabled: true,
							placeholder: "Selecciona",
							label: "CP",
							options: {
								view: "suggest",
								body: {
									view: "list",
									// url:"..//prueba/getcodigopostalsinaloa" ,
								},
							},
						},
					],
				},

				{
					cols: [// PLAN MAESTRO, IMAGEN PLAN MAESTRO, DESCRIPCIÓN
						{
							view:'label',
							label:'Plan Maestro'
						},
						{
							view: "select",
							name: `desarrollo_plan_maestro`,
							inputWidth:70,
							value: 1,
							options: [
								{ id: 1, value: "SI" },
								{ id: 2, value: "NO" },
							],
						},{
							view:'label',
							label:'Imagen de Plan Maestro'
						},
						
						{
							view: "uploader",
							name: `desarrollo_plan_maestro_imagen`,
							id: "uploader_1",
							value: "Subir",
						},

					],
				},

				{ //DESCRIP PLAN MAESTRO
					view:'label',
					label:'Descrición de Plan Maestro'
				},
				
				{
					view:"textarea", 
					name: `desarrollo_plan_maestro_descripcion`,
					labelAlign:"right", 
					height:100, 
				},

				{
					cols: [ //ZONA, ETAPAS PLANEADAS, PROMEDIO
						{
							view:'label',
							label:'Zona'
						},
						{
							view: "select",
							name: `desarrollo_zona`,
							placeholder:'Selecciona Zona',
							options: "..//prueba/getzonas",
						},{},
						{
							view:'label',
							label:'Etapas Planeadas'
						},
						{
							view: "select",
							name: `desarrollo_etapas_planeadas`,	
							id: `desarrollo_etapas_planeadas`,					
							width: 100,
							value: 1,
							options: [
								{ id: 1, value: "1" },
								{ id: 2, value: "2" },
								{ id: 3, value: "3" },
								{ id: 4, value: "4" },
								{ id: 5, value: "5" },
							],
							on: {
								onChange: function (etapas) {
									var etapas_seleccionadas = $$(`FORM_INFORMACION_GENERAL`).getValues()
										.desarrollo_etapas_planeadas;
									var etapas_seleccionadas_2 =
										parseInt(etapas_seleccionadas) + 1;
									console.log(etapas_seleccionadas_2);

									var FORM_ETAPAS = $$(`FORM_ETAPAS`);

									FORM_ETAPAS.removeView(`etapas_accordion-1`);
									FORM_ETAPAS.removeView(`etapas_accordion-2`);
									FORM_ETAPAS.removeView(`etapas_accordion-3`);
									FORM_ETAPAS.removeView(`etapas_accordion-4`);
									FORM_ETAPAS.removeView(`etapas_accordion-5`);

									for (let index = 1; index < etapas_seleccionadas_2; index++) {
										FORM_ETAPAS.addView({
											view: `accordion`,
											name: `etapas_accordion-${index}`,
											id: `etapas_accordion-${index}`,
											multi: true,
											collapsed: true,
											css: { background: "#ccc !important" },
											rows: [
												{
													header: `Etapa ${index}`,
													body: {
														view: `form`,
														id: `FORM_ETAPAS-${index}`,
														name: `FORM_ETAPAS-${index}`,
														elements: [
															{
																rows: [
																	{
																		cols: [
																			{
																				view: "text",
																				label: "Planeado",
																				name: `etapa${index}_pleaneado`,
																			},
																			{
																				view: "text",
																				label: "Casas",
																				name: `etapa${index}_pleaneado_casas`,
																			},
																			{
																				view: "text",
																				label: "Deptos",
																				name: `etapa${index}_pleaneado_deptos`,
																			},
																			{
																				view: "text",
																				label: "Terrenos",
																				name: `etapa${index}_pleaneado_terrenos`,
																			},
																		],
																	},
																	{
																		cols: [
																			{
																				view: "text",
																				label: "Vendido",
																				name: `etapa${index}_vendido`,
																			},
																			{
																				view: "text",
																				label: "Casas",
																				name: `etapa${index}_vendido_casas`,
																			},
																			{
																				view: "text",
																				label: "Deptos",
																				name: `etapa${index}_vendido_deptos`,
																			},
																			{
																				view: "text",
																				label: "Terrenos",
																				name: `etapa${index}_vendido_terrenos`,
																			},
																		],
																	},
																	{
																		cols: [
																			{
																				view: "text",
																				label: "En Venta",
																				name: `etapa${index}_venta`,
																			},
																			{
																				view: "text",
																				label: "Casas",
																				name: `etapa${index}_venta_casas`,
																			},
																			{
																				view: "text",
																				label: "Deptos",
																				name: `etapa${index}_venta_deptos`,
																			},
																			{
																				view: "text",
																				label: "Terrenos",
																				name: `etapa${index}_venta_terrenos`,
																			},
																		],
																	},
																	{
																		cols: [
																			{
																				view: "select",
																				label: "Estatus de la etapa",
																				name: `etapa${index}_estatus`,
																				value: 1,
																				labelWidth: 150,
																				options: [
																					{ id: 1, value: "Por iniciar" },
																					{ id: 2, value: "En Construcción" },
																					{ id: 3, value: "Construído" },
																					{ id: 4, value: "Terminado" },
																				],
																			},
																			{
																				view: "select",
																				label: "Tipo de fraccionamiento",
																				name: `etapa${index}_tipo`,
																				labelWidth: 175,
																				value: 1,
																				options: [
																					{ id: 1, value: "Privado" },
																					{ id: 2, value: "Semiprivado" },
																					{ id: 3, value: "Abierto" },
																					{ id: 4, value: "Duplex" },
																				],
																			},
																			{},
																		],
																	},
																],
															},
														],
													},
												},
											],
										});
									}
								},
							},
						},{},
						{
							view:'label',
							label:'Prom. Ventas Mensuales'
						},
						{
							view: "text",
							name: `desarrollo_promedio_ventas_mensuales`,	
							id: `desarrollo_promedio_ventas_mensuales`,						
						},
					],
				},
			],
		},		
  	]
};

var FORM_ETAPAS = {
  view:"form", 
  name:`FORM_ETAPAS`,
  id:`FORM_ETAPAS`, 
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
                                    id:`FORM_ETAPAS-1`,
                                    name:`FORM_ETAPAS-1`,
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

var FORM_INFORMACION_TECNICA= {  
          view: 'form',
          name:'FORM_INFORMACION_TECNICA',
          id:'FORM_INFORMACION_TECNICA', 
          elements:[
            {
              rows:[
                {template: '<b>Información técnica del desarrollo</b>', type:'section'},
                {
                  cols:
                  [
                    { view:'select',
                      name:'desarrollo_acceso',
                      label:'Acceso',
                      value:1,
                      options:[
                        { "id":1, "value":"Vigilancia" },
                        { "id":2, "value":"Caseta" },
                        { "id":3, "value":"Abierto" },
                      ]
                    },
                    { view:'select',
                      name:'desarrollo_prototipos_numero',
                      id:'desarrollo_prototipos_numero',
                      label:'Prototipos',
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
                      ],
                    },   
                  ]
                },

             /*   { view:"form", 
                  name:`form_acordion`,
                  id:`form_acordion`, 
                  elements: 
                  [*/
                    { view:`accordion`,
                      name:`accordion_prototipos`,
                      id:`accordion_prototipos`,
                      multi:true,
                      collapsed:true,
                      rows:
                        [                       
                          { header:`Información de Prototipos`, 
                            body: {  view:`form`,
                                      id:`form_protipos`,
                                      name:`form_protipos`,
                                      elements:
                                        [
                                        //  { view:'text', label:'Nombre:', labelWidth:200  }
                                        ]
                                    } 
                          }                                                  
                        ]            
                    }
                    

             //     ]
              //  }


              ]
            }
          ]
}

var boton_guardar = {
    view:"button", 
    id:"boton_guardar", 
    value:"Guardar", 
    css:"webix_primary", 
    inputWidth:100,
    align:"center",
    click: guardarProyecto
}

var boton_salir= {
    view:"button", 
    id:"boton_salir", 
    value:"Salir", 
    css:"webix_primary", 
    inputWidth:100,
    align:"center",
	click:function(){
		$$('ventana_formulario').hide()
	}
}

const TABVIEW_MENU_EVALUACION = {
	view: "tabview",
	cells: [
				{	header: "Información General",
					body: {
						rows:[
								FORM_INFORMACION_GENERAL,
								FORM_ETAPAS
						]
					}															
				},

														{
														header: "Desarrollo",
														body: {
															id: "listView",
															view: "text", 
															id:'b'											
															}
														},

														{
														header: "Información Técnica ",
														body: {
																id: "listView",
																view: "text", 
																id:'c'
															}											
														},

														{
														header: "Información Financiera",
														body: {
																id: "listView",
																view: "text", 
																id:'d'
															}
														},

														{
														header: "Velocidad de Venta",
														body: {
																id: "listView",
																view: "text", 
																id:'e'
															}
														},

														{
														header: "Atención",
														body: {
																id: "listView",
																view: "text", 
																id:'f'
															}
														},

														{
														header: "Experiencia de compra",
														body: {
																id: "listView",
																view: "text", 
																id:'g'
															}
														},
	]
}	



function guardarProyecto(){

  //Obtiene valores del formulario 1. Es necesario que los inputs tengan el atributo 'name'
  formulario_1_datos = $$(`FORM_INFORMACION_GENERAL`).getValues();
  console.log(formulario_1_datos)

  var numero_etapas = 0;
  var etapas_datos = {}; //Array para almacenar arrays de cada etapa

  // Obtiene los valores de cada form/acordion de cada etapa
  for (let index = 0; index<10; index++) {
    form_etapa = $$(`FORM_ETAPAS-${index+1}`)

    if(form_etapa){
      form_etapa = $$(`FORM_ETAPAS-${index+1}`).getValues();
      console.log(form_etapa);
      etapas_datos[`etapa_${numero_etapas+1}`] = form_etapa        
      numero_etapas++; //Cuenta el número de etapas (dato para enviar a servidor)
    } 

  } 

  //console.log(numero_etapas)


          webix.ajax().post("../prueba/saveDesarrollo", { formulario_1_datos:formulario_1_datos, etapas_datos:etapas_datos,numero_etapas:numero_etapas }).then(function(data){
           
           // let res = JSON.parse(data.text())

         //  console.log(res)
          });
      
             /*
            res.forEach(cliente => {
                dato_cliente = {
                id: cliente[0], 
                usuario: cliente[1] + " " + cliente[2], 
                estatus: cliente[3], 
                rol: cliente[4],
            };

                $$('tablaDatos').add(dato_cliente)                   
            });*/


        

}





		//*********************************************************** FORMULARIO DE REGISTRO DE EVALUACIÓN****************************************** */
		//Carlos Dzul.

		function registroProyecto() {

			
			var window = webix
				.ui({
					view: "window",
					id: "ventana_formulario",
					name: "ventana_formulario",
					head: "Registro de Evaluación",
					position: "center",
					modal: true,
					body:{
						rows:[
							TABVIEW_MENU_EVALUACION,
							{
								cols:[
									boton_guardar,
							  		boton_salir
								]
							}
						]						
					}
				})
				.show();


/** FUNCIONES DEL BLOCK DE NOTAS */
	  
			/*
			 ************** EVENTOS PARA VIEW 'desarrollo_cp'
			 */	    
			$$("desarrollo_cp").attachEvent("onChange", function () {
				/** Obtiene CP seleccionado */
				var cp_selected = $$("desarrollo_cp").getText();

				if (cp_selected != "") {
					/***** Obtiene COLONIAS segpun el CP seleccionado. Asigna las colonias a  'desarrollo_colonia' */
					webix
						.ajax()
						.get("..//prueba/getcolonias", {
							cp_selected: cp_selected,
						})
						.then(function (data) {
							let res = JSON.parse(data.text());
							$$(`desarrollo_colonia`).define("options", res);
							$$("desarrollo_colonia").refresh();
						});

					/***** Obtiene el ESTADO segpun el CP seleccionado. Asigna el ESTADO a  'desarrollo_estado' */
					webix
						.ajax()
						.get("..//prueba/getestadoporcp", {
							cp_selected: cp_selected,
						})
						.then(function (data) {
							let res = data.text();
							if (res) {
								$$(`desarrollo_estado`).setValue(res);
							} else {
								$$(`desarrollo_estado`).setValue("");
							}
						});

					/***** Obtiene CIUDAD segpun el CP seleccionado. Asigna CIUDAD a  'desarrollo_ciudad' */
					webix
						.ajax()
						.get("..//prueba/getciudadesporcp", {
							cp_selected: cp_selected,
						})
						.then(function (data) {
							let res = JSON.parse(data.text());
							if (res) {
								$$(`desarrollo_ciudad`).define("options", res);
								$$("desarrollo_ciudad").refresh();
								$$(`desarrollo_ciudad`).setValue("");
							}
						});
				}
			}); 
        

			/*
			 ************** EVENTOS PARA VIEW 'desarrollo_colonia'
			 */
			$$("desarrollo_colonia").attachEvent("onChange", function () {
				/**Obtiene Colonia seleccionada */
				var desarrollo_colonia = $$(`desarrollo_colonia`).getValue();
				var desarrollo_ciudad = $$(`desarrollo_ciudad`).getValue();

				/*********Obtiene CP de la colonia seleccionada. Asigna COLONIA a 'desarrollo_colonia' */
				webix
					.ajax()
					.get("..//prueba/getcp", {
						desarrollo_colonia: desarrollo_colonia,
						desarrollo_ciudad: desarrollo_ciudad,
					})
					.then(function (data) {
						let res = data.text();
						console.log(res);
						$$(`desarrollo_cp`).setValue(res);
					});
			}); 

			/*
			 ************** EVENTOS PARA VIEW 'desarrollo_ciudad'
			 */
			$$("desarrollo_ciudad").attachEvent("onChange", function () {
				/**Obtiene Ciudad seleccionada */
				var desarrollo_ciudad = $$(`desarrollo_ciudad`).getValue();

				if (desarrollo_ciudad != "") {
					/*********Obtiene ESTADO de la ciudad seleccionada. Asigna ESTADO a 'desarrollo_estado' */
					webix
						.ajax()
						.get("..//prueba/getestado", {
							desarrollo_ciudad: desarrollo_ciudad,
						})
						.then(function (data) {
							let res = data.text();
							$$(`desarrollo_estado`).setValue(res);
						});

					/*********Obtiene CPs de la ciudad seleccionada. Asigna CPs  a 'desarrollo_cp' */
					webix
						.ajax()
						.get("..//prueba/getcpsporciudad", {
							desarrollo_ciudad: desarrollo_ciudad,
						})
						.then(function (data) {
							let res = JSON.parse(data.text());
							console.dir(res);
							if (res) {
								$$(`desarrollo_cp`).define("options", res);
								$$("desarrollo_cp").refresh();
								$$("desarrollo_cp").enable();
							} else {
								$$(`desarrollo_cp`).setValue("");
							}
						});

					/*********Obtiene Colonias de la ciudad seleccionada. Asigna Colonias  a 'desarrollo_colonia' */
					webix
						.ajax()
						.get("..//prueba/getcoloniasporciudad", {
							desarrollo_ciudad: desarrollo_ciudad,
						})
						.then(function (data) {
							let res = JSON.parse(data.text());
							console.dir(res);
							if (res) {
								$$(`desarrollo_colonia`).define("options", res);
								$$("desarrollo_colonia").refresh();
								$$("desarrollo_colonia").enable();
							} else {
								$$(`desarrollo_cp`).setValue("");
							}
						});
				}
      		});       

   




		} //Fin function registroProyecto

		// FORMULARIO DZUL

/*		registroProyecto();
		desarrolloNombre = this.getItem(id).desarrollo;
		desarrolloDatos = this.getItem(id);
		console.log(desarrolloNombre);
		console.log(desarrolloDatos);
		$$("desarrollo_nombre_comercial_desarrollo").setValue(desarrolloNombre);*/

		//*********************************************************** FIN FORMULARIO DE REGISTRO DE EVALUACIÓN****************************************** */




 registroProyecto() // temporal para que aprezca l aventana al cargar

</script>