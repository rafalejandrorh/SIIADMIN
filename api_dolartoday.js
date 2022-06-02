async function obtenerDatos(){
    const response = await fetch("https://s3.amazonaws.com/dolartoday/data.json");
    const json = await response.json();

    console.log(json);
    console.log(json.USD.promedio_real);
    //console.log(JSON.stringify(json));
    
}

obtenerDatos();