function telefono(val){    
            return (webix.rules.isNumber(val) && val.length == 10); 
}
function otelefono(val){
    if(typeof val=="string"){
        val=val.trim();
        if(webix.rules.isNotEmpty(val)){
            //return (webix.rules.isNumber(val) && val.length == 10);
            return telefono(val);
        }
    }
    return true;
}
function ocp(val){
    if(typeof val=="string"){
        val=val.trim();
        if(webix.rules.isNotEmpty(val)){            
            return (webix.rules.isNumber(val) && val.length == 5);
        }
    }
    return true;
}
function oclave(val){
    if(typeof val=="string"){
        val=val.trim();
        if(webix.rules.isNotEmpty(val)){            
            return (val.length >= 8);
        }
    }
    return true;
}
function sueldo(val){    
            return (webix.rules.isNumber(val) && val>0); 
}

function costo(val){    
            return (webix.rules.isNumber(val) && val>0); 
}

function preciovta(val){    
            return (webix.rules.isNumber(val) && val>0); 
}

function stock(val){    
            return (webix.rules.isNumber(val) && val>0); 
}
function plazo(val){    
            return (webix.rules.isNumber(val) && val>0); 
}