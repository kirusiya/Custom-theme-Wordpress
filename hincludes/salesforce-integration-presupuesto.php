<?php
/* EDIT PARAMETERS */

$FirstName 		  = $array_data['nombre'];
$LastName         = $array_data['apellidos'];
$Email 		      = $array_data['email'];

$Phone 		      = $array_data['telefono'];
$CountryCode      = is_array($array_data['pais']) ? $array_data['pais'][0] : $array_data['pais'];
$PostalCode       = $array_data['cp'];

$City 	          = $array_data['municipio'];

$motivo_sf        = is_array($array_data['motivo']) ? $array_data['motivo'][0] : $array_data['motivo'];


$message_sf 	  = $array_data['mensaje'];
$mailing_sf 	  = $array_data['mailing'];
$paginaanterior_sf= $array_data['paginaanterior'];

$Company        = $array_data['company'];


$CompanyEmail   = $array_data['email'];

/**nuevos campos */
$AccountType    = is_array($array_data['accounttype']) ? $array_data['accounttype'][0] : $array_data['accounttype'];
$TipoDeLead     = is_array($array_data['tipolead']) ? $array_data['tipolead'][0] : $array_data['tipolead'];
$ProductFamiliy = is_array($array_data['productfamily']) ? $array_data['productfamily'][0] : $array_data['productfamily'];
$MetrosCuadrados   = is_array($array_data['metroscuadrados']) ? $array_data['metroscuadrados'][0] : $array_data['metroscuadrados'];
$aplicacion   = is_array($array_data['aplicacion']) ? $array_data['aplicacion'][0] : $array_data['aplicacion'];

$fechaEstimada   = is_array($array_data['fechaestimada']) ? $array_data['fechaestimada'][0] : $array_data['fechaestimada'];
$presupuesto   = is_array($array_data['presupuesto']) ? $array_data['presupuesto'][0] : $array_data['presupuesto'];
$detalles   = $array_data['detalles'];

$contactemos   = is_array($array_data['contactemos']) ? $array_data['contactemos'][0] : $array_data['contactemos'];
$CompanyEmail = "";
/**nuevos campos */




$Notes = "Más detalles de tu Presupuesto\n".$detalles."\n\nContactar en:\n".$contactemos;

error_log("SF--- Pais: ".$CountryCode);
error_log("SF--- Publicidad: ".$array_data['mailing']);
error_log("SF--- ProductFamiliy: ".$ProductFamiliy);
error_log("SF--- MetrosCuadrados: ".$MetrosCuadrados);
error_log("SF--- aplicacion: ".$aplicacion);


/* END EDIT PARAMETERS */

error_log("SF--- Nombre: ".$FirstName);
error_log("SF--- Apellidos: ".$LastName);
error_log("SF--- Email: ".$Email);		
error_log("SF--- Tfno: ".$Phone);
        
        
//$CountryCode = "ES"; //ESPAÑA

$RecordType   = $array_data['recordtype'];
$Environment   = $array_data['environment'];

// $RecordType = "MKT ES Cupa Stone Leads Marketing";
// $Environment = "CUPA STONE Espana";


$LeadType = "MQL_Contact";

$LeadSource = 'WEB Directo';//LeadGroupSource__c = Web propia (asumo no estoy seguro)
//$LeadGroupSource__c = "Web propia";
$cookie=strtolower($_COOKIE["initialTrafficSource"]);

if (strpos($cookie, 'direct') !== false) { 
    //'directo'; 
    $LeadSource = 'WEB Directo';//LeadGroupSource__c = Web propia (asumo no estoy seguro)
} 
else if ((strpos($cookie, 'google') !== false)&&(strpos($cookie, 'organic') !== false)) { 
    //'búsqueda orgánica';
    $LeadSource = 'WEB Search Organic';//LeadGroupSource__c = Webs externas (asumo no estoy seguro)
} 
else if ((strpos($cookie, 'google') !== false)&&(strpos($cookie, 'organic') == false)) { 
    //'búsqueda pago'; 
    $LeadSource = 'WEB Search Paid';//LeadGroupSource__c = Webs externas (asumo no estoy seguro)
}
else if ((strpos($cookie, 'live') !== false)&&(strpos($cookie, 'organic') !== false)) { 
    //'búsqueda orgánica';
    //$LeadSource = ''; //no me dijeron value ni con que LeadGroupSource__c se relaciona

}
else if ((strpos($cookie, 'live') !== false)&&(strpos($cookie, 'organic') == false)) { 
    //'búsqueda pago'; 
    //$LeadSource = ''; //no me dijeron value ni con que LeadGroupSource__c se relaciona	
} 
else if ((strpos($cookie, 'facebook') !== false)&&(strpos($cookie, 'ads') !== false)) { 
    //'rrss pago'; 	
    $LeadSource = 'fb';// LeadGroupSource__c = RRSS Pago
} 
else if ((strpos($cookie, 'instagram') !== false)&&(strpos($cookie, 'ads') !== false)) { 
    //'rrss pago'; 	
    $z_origen=179;	
    $LeadSource = 'ig';// LeadGroupSource__c = RRSS Pago
} 
else if ((strpos($cookie, 'twitter') !== false)&&(strpos($cookie, 'cards') !== false)) { 
    //'rrss pago'; 	
    $LeadSource = 'Twitter Pago';// LeadGroupSource__c = RRSS Pago	(Twitter Pago no estaba en el excel, pero asumo que es asi)
} 
else if ((strpos($cookie, 'linkedin') !== false)&&(strpos($cookie, 'ads') !== false)) { 
    //'rrss pago'; 	
    $LeadSource = 'LinkedIn Pago';// LeadGroupSource__c = RRSS Pago
} 
else if ((strpos($cookie, 'pinterest') !== false)&&(strpos($cookie, 'ads') !== false)) { 
    //'pinterest pago'; 	
    $LeadSource = 'Pinterest Pago';// LeadGroupSource__c = RRSS Pago
} 
else if ((strpos($cookie, 'instagram') !== false)&&(strpos($cookie, 'linktree') !== false)) { 
    //'rrss pago'; 	
    $LeadSource = 'Instagram Organico';// LeadGroupSource__c = RRSS Pago	
} 
else if ((strpos($cookie, 'tiktok') !== false)&&(strpos($cookie, 'ads') !== false)) { 
    //'tiktok pago'; 	
    $LeadSource = 'TikTok Pago';// LeadGroupSource__c = RRSS Pago
} 
else if ((strpos($cookie, 'facebook') !== false) || (strpos($cookie, 'twitter') !== false) || (strpos($cookie, 'pinterest') !== false) || (strpos($cookie, 'instagram') !== false) || (strpos($cookie, 'youtube') !== false) || (strpos($cookie, 'linkedin') !== false)|| (strpos($cookie, 'tiktok') !== false) ) { 
    //'rrss organico'; 	
    $LeadSource = 'Facebook Organico';// LeadGroupSource__c = RRSS Organico (asumo que cualquier red social aca es organico)
} 
else if ((strpos($cookie, 'email') !== false)) { 
    //'email'; 	
    $LeadSource = 'Contacto mail';// LeadGroupSource__c = Contacto Mail (Asumo que esto es cuando no hay nada de leads es envio por el formulario enviado?)
}


error_log("SF--- LeadSource: ".$LeadSource);

error_log("SF--- CountryCode: ".$CountryCode);
error_log("SF--- RecordType: ".$RecordType);
error_log("SF--- Environment: ".$Environment);

error_log("SF--- ProductFamiliy: ".$ProductFamiliy);

error_log("SF--- AccountType: ".$AccountType);
error_log("SF--- Company: ".$Company);
error_log("SF--- CompanyEmail: ".$CompanyEmail);


error_log("SF--- Motivo Array: " . print_r($array_data['motivo'], true));

error_log("SF--- Notes: ".$Notes);


// Configuración para loguearse y obtener el access token
$access_token = "";
$data = [
    'grant_type' => 'client_credentials',
    'client_id' => $client_id,
    'client_secret' => $client_secret
];

// Inicializar cURL
$ch = curl_init();

// Configuración de la solicitud cURL
curl_setopt($ch, CURLOPT_URL, $login_url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/x-www-form-urlencoded'
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

// Ejecutar la solicitud y obtener la respuesta
$response = curl_exec($ch);

// Cerrar la conexión cURL
curl_close($ch);

// Decodificar la respuesta JSON
$response_data = json_decode($response, true);

// Verificar si el token se obtuvo correctamente
if (isset($response_data['access_token'])) {
    $access_token = $response_data['access_token'];
    
    // Imprimir el token en el log de errores
    error_log("SF--- Access Token: " . $access_token);
} else {
    error_log("SF--- Error al obtener el access token: " . print_r($response_data, true));
}


/******************************* */
// Preparar los datos para la solicitud
$data = [
    "LastName" => $LastName,
    "FirstName" => $FirstName,
    "Phone" => $Phone,
    "MobilePhone" => $Phone,        
    "Company" => $Company,
    "RecordType" => ["Name" => $RecordType],
    "CountryCode" => $CountryCode,
    "City" => $City,
    "PostalCode" => $PostalCode,
    "Email" => $Email,
    "LeadSource" => $LeadSource,
    "Environment__c" => $Environment,
    "TipoDeLead__c" => $TipoDeLead,
    "LeadType__c" => $LeadType,
    "ProductFamiliy__c" => $ProductFamiliy,
    "AccountType__c" => $AccountType,
    "CompanyEmail__c" => $CompanyEmail,
    "TypeOfProject__c" => $MetrosCuadrados,
    "EstimatedProjectStartDate__c" => $fechaEstimada,
    "EstimatedBudget__c" => $presupuesto,
    "Applications__c" => $aplicacion,
    "ReasonRequest__c" => $motivo_sf,
    "Notes__c" => $Notes
];


$json_data_pretty = json_encode($data, JSON_PRETTY_PRINT);

// Imprimir en los logs de error
error_log("Datos JSON para Postman:\n" . $json_data_pretty);

// Convertir datos a JSON
$json_data = json_encode($data);

// Inicializar cURL
$ch = curl_init();

// Configurar la solicitud cURL
curl_setopt($ch, CURLOPT_URL, $lead_url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $access_token",
    "Content-Type: application/json",
    "Sforce-Duplicate-Rule-Header: allowSave=true"// para aceptar campos clave duplicados
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);

// Ejecutar la solicitud y obtener la respuesta
$response = curl_exec($ch);

// Verificar si hubo un error en cURL
if ($response === false) {
    error_log("Error en cURL: " . curl_error($ch));
} else {
    // Decodificar la respuesta JSON
    $response_data = json_decode($response, true);

    error_log("Lead response: " . print_r($response_data, true));

    // Verificar la respuesta
    if (isset($response_data['success']) && $response_data['success'] === true) {
        $lead_id = $response_data['id'];
        error_log("Lead creado exitosamente con ID: " . $lead_id);
        $_SESSION['ProductFamily'] = "";
    } else {
        error_log("Error al crear el Lead: " . print_r($response_data, true));
    }
}

// Cerrar la conexión cURL
curl_close($ch);






