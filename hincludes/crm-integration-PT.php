<?php

	/* EDIT PARAMETERS */

	$name_fc 		  = $array_data['nombre'];
	$email_fc 		  = $array_data['email'];
	$phone_fc 		  = $array_data['telefono'];
	$message_fc 	          = $array_data['mensajecrm'] . ' - ' . $array_data['detalles'];
	$cp_fc 			  = $array_data['cp'];
	$ciudad_fc 		  = $array_data['ciudadcrm'];
	$perfilcliente_fc = $array_data['perfilcliente'];
	
	error_log("FM--- Publicidad: ".$array_data['mailing']);
			
	if ( $array_data['mailing'] == 1 ){
		$recibir_mailing = true;
	} else{
		$recibir_mailing = false;
	}
			
	if( $array_data['producto'] != "" ){
		$message_fc = $message_fc." (".strtoupper($array_data["producto"]).")";
	}

	/* END EDIT PARAMETERS */



	error_log("FM--- Nombre: ".$name_fc);
	error_log("FM--- Email: ".$email_fc);		
	error_log("FM--- Tfno: ".$phone_fc);
			
	$account_type=77;
	$branch_id = 17; 		//CUPASTONE
	$sales_rep_id = 431;	//MKT CUPASTONE
	$created_by = "1";
	$user_creado = 2;
	
	$country_id = "177"; //PORTUGAL
			
	//Asignar origen
	$z_origen=196; //Si no cumple ninguna condición de las que vienen a continuación seguimos guardando como origen=196
	
	$cookie=strtolower($_COOKIE["initialTrafficSource"]);

	if (strpos($cookie, 'direct') !== false) { 
		//'directo'; 
		$z_origen=177;
	} 
	else if ((strpos($cookie, 'google') !== false)&&(strpos($cookie, 'organic') !== false)) { 
		//'búsqueda orgánica';
		$z_origen=182;	
	} 
	else if ((strpos($cookie, 'google') !== false)&&(strpos($cookie, 'organic') == false)) { 
		//'búsqueda pago'; 
		$z_origen=180;
	}
	else if ((strpos($cookie, 'live') !== false)&&(strpos($cookie, 'organic') !== false)) { 
		//'búsqueda orgánica';
		$z_origen=182;	
	}
	else if ((strpos($cookie, 'live') !== false)&&(strpos($cookie, 'organic') == false)) { 
		//'búsqueda pago'; 
		$z_origen=180; 	
	} 
	else if ((strpos($cookie, 'facebook') !== false)&&(strpos($cookie, 'ads') !== false)) { 
		//'rrss pago'; 	
		$z_origen=179;
	} 
	else if ((strpos($cookie, 'instagram') !== false)&&(strpos($cookie, 'ads') !== false)) { 
		//'rrss pago'; 	
		$z_origen=179;	
	} 
	else if ((strpos($cookie, 'twitter') !== false)&&(strpos($cookie, 'cards') !== false)) { 
		//'rrss pago'; 	
		$z_origen=179;	
	} 
	else if ((strpos($cookie, 'linkedin') !== false)&&(strpos($cookie, 'ads') !== false)) { 
		//'rrss pago'; 	
		$z_origen=179;	
	} 
	else if ((strpos($cookie, 'pinterest') !== false)&&(strpos($cookie, 'ads') !== false)) { 
		//'pinterest pago'; 	
		$z_origen=200;	
	} 
	else if ((strpos($cookie, 'instagram') !== false)&&(strpos($cookie, 'linktree') !== false)) { 
		//'rrss pago'; 	
		$z_origen=178;	
	} 
	else if ((strpos($cookie, 'tiktok') !== false)&&(strpos($cookie, 'ads') !== false)) { 
		//'tiktok pago'; 	
		$z_origen=222;	
	} 
	else if ((strpos($cookie, 'facebook') !== false) || (strpos($cookie, 'twitter') !== false) || (strpos($cookie, 'pinterest') !== false) || (strpos($cookie, 'instagram') !== false) || (strpos($cookie, 'youtube') !== false) || (strpos($cookie, 'linkedin') !== false)|| (strpos($cookie, 'tiktok') !== false) ) { 
		//'rrss orgánico'; 	
		$z_origen=178;
	} 
	else if ((strpos($cookie, 'email') !== false)) { 
		//'email'; 	
		$z_origen=183;
	} 	
			
	

	/*Llevar a cabo proceso de login api v4*/
			
	
	$username="XXXXXXXXXXXXXXXXXXXX";
	$pass="XXXXXXXXXXXXXXXX";
			
	$url_fm = 'https://api.forcemanager.net/api/v4/login';
			
	$json_fm = (object) ["username"=>$username, "password"=>$pass];
			
	$options_fm = array(
		'method' => 'POST',
		'headers' => array('Accept' => '*/*', 'Content-Type' => 'application/json'),
		'body' => json_encode($json_fm,JSON_FORCE_OBJECT)
	);
			
	$http_request = new WP_Http;

	error_log("FM--- JSON LOGIN ARRAY: ".json_encode($json_fm,JSON_FORCE_OBJECT));

			
	$response= $http_request->request( $url_fm, $options_fm );
			
	$body = wp_remote_retrieve_body($response);
	$token= json_decode($body)->token;
	$code = wp_remote_retrieve_response_code($response);
	error_log("FM--- JSON LOGIN CODE: ".$code);
	error_log("FM--- JSON LOGIN TOKEN: ".$token);
			
	if($code!=200){
		error_log("FM--- ERROR GENERANDO TOKEN DE SESION");	
		return;
	}
			
	/*FIN llevar a cabo proceso de login api v4*/
			
	/*Comprobar duplicado*/
	$id_account=0;
			
	$url_fm="https://api.forcemanager.net/api/v4/accounts?where=email='".$email_fc."'";;
	$options_fm = array(
		'method' => 'GET',
		'headers' => array('Accept' => '*/*', 'Content-Type' => 'application/json', 'X-Session-Key' =>$token),'timeout'=>20
	);
	$http_request = new WP_Http;
	$response= $http_request->request( $url_fm, $options_fm );

	$body = wp_remote_retrieve_body($response);
	$message= wp_remote_retrieve_response_message($response);		
	$text_body= str_replace("[","",print_r($body, true));
	$text_body= str_replace("]","",$text_body);
	$pos=strpos($text_body,',{"NIF"');
	if($pos!=0){
		$text_body=substr($text_body,0,$pos);
	}
	error_log("FM--- text_body: ".$text_body);	
	if(isset(json_decode($text_body)->id)){
		$id_account=json_decode($text_body)->id;
		error_log("FM--- (DUPLICADO)ID: ".json_decode($text_body)->id);	
	

		$duplicado=false;
		if($id_account>0){
			$duplicado=true;
			$account_id=$id_account;//la variable que se asignará posteriormente
			error_log("FM--- YA EXISTIA ACCOUNT: ".$id_account);
		}
	}
			
	/*FIN comprobar duplicado*/

	if(!$duplicado){//generamos el account
		$json_fm =(object) ["name"=>html_entity_decode($name_fc),"email"=>html_entity_decode($email_fc),"phone"=> html_entity_decode($phone_fc),"city"=>html_entity_decode($ciudad_fc),"postcode"=>$cp_fc,"salesRepId1"=>$sales_rep_id,"Z_Origen"=>$z_origen,"Z_origen_cupastone"=>$z_origen,"typeId"=>$account_type,"branchId"=>$branch_id,"Z_AceptacionMailings"=>$recibir_mailing,"region"=>$provincia,"Z_Provincia"=>0,"Z_TraspasoSAP_CIF"=>"","Z_TraspasoSAP_Grupo"=>0,"Z_TraspasoSAP_Ramo"=>0,"Z_TraspasoSAP_FormadePago"=>0,"Z_TraspasoSAP_CondiciondePago"=>0,"Z_TraspasoSAP_CondicionExpedicon"=>0,"Z_TraspasoSAP_Riesgo_Solicitado"=>"","Z_TraspasoSAP_Empresa_Grupo"=>0,"Z_TraspasoSAP_Agencia"=>0,	"Z_TraspasoSAP_Oficina_Ventas"=>0,"Z_TraspasoSAP_Grupo_de_cliente"=>0,"Z_TraspasoSAP_Riesgo"=>"","Z_TraspasoSAP_Tarifa"=>0,"Z_TraspasoSAP_Grupo_pertenencia_StoneFR"=>0,"Z_TraspasoSAP_CODE_TARIF_StoneFR"=>0, "Z_TraspasoSAP_Credit_a_Demander"=>"","Z_TraspasoSAP_Agence_StoneFR"=>0,"Z_TraspasoSAP_Mode_de_Paiement"=>0,"Z_Envio_de_Muestras"=>0,"Z_Enviar_direccion_distinta"=>0,"Z_EnvioMuestra_Calle_Em"=>"","Z_EnvioMuestra_Poblacion_Em"=>"","Z_EnvioMuestra_CP_Em"=>"","Z_EnvioMuestra_Tel_Em"=>"","Z_EnvioMuestra_Encargado_Em"=>0,"Z_EnvioMuestra_MuestaSolicitada_Em"=>"","Z_EnvioMuestra_FechaSolicitud_Em"=>"2019-01-01 00:00:00","Z_Resultado_Peticion_Em"=>0];
			
			
		$url_fm="https://api.forcemanager.net/api/v4/accounts";
		$options_fm = array(
			'method' => 'POST',
			'headers' => array('Accept' => '*/*', 'Content-Type' => 'application/json', 'X-Session-Key' =>$token),
			'body' => json_encode($json_fm,JSON_FORCE_OBJECT),'timeout'=>20
		);
			
			
		$http_request = new WP_Http;

		error_log("FM--- JSON ACCOUNTS: ".json_encode($json_fm,JSON_FORCE_OBJECT));

		$response= $http_request->request( $url_fm, $options_fm );

		$body = wp_remote_retrieve_body($response);
		$code = wp_remote_retrieve_response_code($response);
			
		error_log("FM--- RESPUESTA FM CODE: ".json_decode($code));
		error_log("FM--- RESPUESTA FM BODY: ".$body);

			
		$result= json_decode($body);
				
		$account_id=$result->id;
	}

	if($code=="200" || $duplicado) {

		//id de la empresa creado en el paso previo o recuperado en comprobar duplicado

				
		$activity_type_id = 22;
		$branch_id=17; //este es CUPASTONE España: SIEMPRE, no han aportado alterntiva
		$subject="Consulta web";
		$comments=str_replace("&#039;","\u0027",htmlspecialchars_decode($message_fc)); //El campo mensaje del formulario
		$created_by=1;
		$owner_id=$sales_rep_id; //En principio igual que el Sales Resp. Se podría cambiar si fuera necesario
		$start_date=date('Y-m-d\TH:i:s', time());
		$type="Task";
		$z_importancia=1; //1->ALTA, 2-> MEDIA, 3-> BAJA
		$z_fecha_consulta=date('Y-m-d\TH:i:s', time());
		$z_resultado_consulta=3; //Pendiente
		$z_tipo_cliente=0; //Pedir los que existen. Intentar cuadrarlos con los existentes.
		if($perfilcliente_fc=="Marmolista"){
			$z_tipo_cliente=51;
		}
		else if($perfilcliente_fc=="Arquiteto"){
			$z_tipo_cliente=38;
		}
		else if($perfilcliente_fc=="Desenhador/decorador"){
			$z_tipo_cliente=50;
		}
		else if($perfilcliente_fc=="Distribuidor"){
			$z_tipo_cliente=43;
		}
		else if($perfilcliente_fc=="Cliente particular"){
			$z_tipo_cliente=53;
		}
		else if($perfilcliente_fc=="Loja de Cozinhas"){
			$z_tipo_cliente=56;
		}
		$z_tipoProducto=0;  //Pedir los productos. Preguntar si puede ir vacío.
				
		$url_fm="https://api.forcemanager.net/api/v4/calendar";
		$json_fm=array("accountId" =>$account_id, "typeId"=> $activity_type_id, "comment"=> html_entity_decode($comments), "branchId"=> $branch_id, "salesRepId" => $sales_rep_id,"startDate"=>date('y/m/d', time()),
			"subject"=>$subject,"Z_Origen"=>$z_origen, "Z_FechaConsulta"=>date('Y-m-d\ H:i:s', time()), "Z_Importancia"=>$z_importancia, "Z_ResultadoConsulta"=>$z_resultado_consulta, 
			"endDate"=>date('y/m/d', strtotime("+30 days")),"Z_TipoCliente"=>$z_tipo_cliente, "Z_TipoProducto" => $z_tipoProducto, "allDay"=>false, "endHour"=>"00:00","sendNotification"=>false,"startHour"=>date('H:i', time()), "task"=>true);
					
		$options_fm = array(
			'method' => 'POST',
			'headers' => array('Accept' => '*/*', 'Content-Type' => 'application/json', 'X-Session-Key' =>$token),
			'body' => json_encode($json_fm,JSON_FORCE_OBJECT),'timeout'=>20
		);
				

		error_log("FM--- JSON CALENDAR: ".json_encode($json_fm,JSON_FORCE_OBJECT));
				
		$http_request = new WP_Http;
		$response= $http_request->request( $url_fm, $options_fm );
			
		$body = wp_remote_retrieve_body($response);
		$code = wp_remote_retrieve_response_code($response);
				
		error_log("FM--- RESPUESTA FM CODE CALENDAR: ".json_decode($code));
		error_log("FM--- RESPUESTA FM BODY: ".$body);
				
		$result= json_decode($body);
		$calendar_id=$result->id;
				
		error_log("FM--- RESPUESTA ID CALENDAR: ".$calendar_id);
	}

?>