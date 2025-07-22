<?php

    $FirstName  = $array_data['nombre'];
    $LastName   = $array_data['apellidos'];
    $Email      = $array_data['email'];
    $Phone      = $array_data['telefono'];
    $message_sf   = $array_data['mensaje'];

    $Company      = $array_data['company'];
    $PostalCode   = $array_data['cp'];
    $City         = $array_data['municipio'];

    $magasin      = is_array($array_data['magasin']) ? $array_data['magasin'][0] : $array_data['magasin'];
    $date_sf      = $array_data['date'];

    

    $RecordType   = $array_data['recordtype'];
    $Environment   = $array_data['environment'];

    if($Company==='' || empty($Company)){
        $Company = $FirstName. " ". $LastName;
    }

    $Notes = "";    
    if ( $magasin !== '' ){
        $Notes .= "Magasin:\n".$magasin;
    }

    if ( $date_sf !== '' ){
        $Notes .= "\n\nDate:\n".$date_sf;
    }

    if ( $message_sf !== '' ){
        $Notes .= "\n\nMensaje Adicional:\n".$message_sf;
    }


    error_log("SF--- Nombre: ".$FirstName);
    error_log("SF--- Apellidos: ".$LastName);
	error_log("SF--- Email: ".$Email);		
	error_log("SF--- Tfno: ".$Phone);

    error_log("SF--- PostalCode: ".$PostalCode);
    error_log("SF--- magasin: ".$magasin);
    error_log("SF--- date_sf: ".$date_sf);
    
    // Determine Lead Source from cookies
    $LeadType = "MQL_Contact";
    $LeadSource = 'WEB Directo';

    $cookie = strtolower($_COOKIE["initialTrafficSource"]);

    if (strpos($cookie, 'direct') !== false) { 
        $LeadSource = 'WEB Directo';
    } elseif ((strpos($cookie, 'google') !== false) && (strpos($cookie, 'organic') !== false)) { 
        $LeadSource = 'WEB Search Organic';
    } elseif ((strpos($cookie, 'google') !== false) && (strpos($cookie, 'organic') == false)) { 
        $LeadSource = 'WEB Search Paid';
    } elseif ((strpos($cookie, 'facebook') !== false) && (strpos($cookie, 'ads') !== false)) { 
        $LeadSource = 'fb';
    } elseif ((strpos($cookie, 'instagram') !== false) && (strpos($cookie, 'ads') !== false)) { 
        $LeadSource = 'ig';
    } elseif ((strpos($cookie, 'twitter') !== false) && (strpos($cookie, 'cards') !== false)) { 
        $LeadSource = 'Twitter Pago';
    } elseif ((strpos($cookie, 'linkedin') !== false) && (strpos($cookie, 'ads') !== false)) { 
        $LeadSource = 'LinkedIn Pago';
    } elseif ((strpos($cookie, 'pinterest') !== false) && (strpos($cookie, 'ads') !== false)) { 
        $LeadSource = 'Pinterest Pago';
    } elseif ((strpos($cookie, 'tiktok') !== false) && (strpos($cookie, 'ads') !== false)) { 
        $LeadSource = 'TikTok Pago';
    } elseif ((strpos($cookie, 'email') !== false)) { 
        $LeadSource = 'Contacto mail';
    } else { 
        //$LeadSource = 'Facebook Organico'; asi lo dejaron no funciona
        $LeadSource = 'WEB Directo';
    }

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

$CountryCode = "FR";
$motivo_sf = "Concertar cita en punto fisico";
$TipoDeLead = "02";
/******************************* */
// Preparar los datos para la solicitud
$data = [
    "FirstName" => $FirstName,
    "LastName" => $LastName,
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
 
?>
