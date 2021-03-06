<?php
/*
 * Copyright (C) 2009 Thomas Cort <tcort@tomcort.com>
 *
 * This file is part of scurrility.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

define('SCURRILITY', true);

require_once('./nusoap/nusoap.php');

$soapurl = 'http://www.scurrility.ws/scurrility/scurrility.php';
#$soapurl = 'http://localhost/scurrility/scurrility.php';

function filter($message) {
	global $soapurl;

	// Escape special characters to avoid malformed XML
	$message = str_replace('&', '&amp;', $message);
	$message = str_replace('<', '&lt;', $message);
	$message = str_replace('>', '&gt;', $message);
	$message = str_replace("'", '&apos;', $message);
	$message = str_replace('"', '&quot;', $message);

	$soapaction = 'http://www.scurrility.ws/scurrility/Scurrility';
	$soapclient = new nusoap_client($soapurl);

	// create the request manually instead of parsing the WSDL file each
	// time this method / the web service is invoked.
	$soapmsg = $soapclient->serializeEnvelope('<ScurrilityRequest xmlns="http://www.scurrility.ws/scurrility"><message>' . $message . '</message></ScurrilityRequest>','',array(),'document', 'literal');
	$result = $soapclient->send($soapmsg, $soapaction);

	if ($soapclient->fault) {
		// Debugging
		// print_r($result);
		return false;
	}

	// Debugging
	// echo $soapclient->request . "\n";
	// echo "---\n";
	// echo $soapclient->response . "\n";

	return $result['message'];
}

function getSourceCode() {
	global $soapurl;

	$soapaction = 'http://www.scurrility.ws/scurrility/GetSourceCode';
	$soapclient = new nusoap_client($soapurl);

	// create the request manually instead of parsing the WSDL file each
	// time this method / the web service is invoked.
	$soapmsg = $soapclient->serializeEnvelope('<GetSourceCodeRequest xmlns="http://www.scurrility.ws/scurrility"><component>server</component></GetSourceCodeRequest>','',array(),'document', 'literal');
	$result = $soapclient->send($soapmsg, $soapaction);

	if ($soapclient->fault) {
		// Debugging
		// print_r($result);
		return false;
	}

	// Debugging
	// echo $soapclient->request . "\n";
	// echo "---\n";
	// echo $soapclient->response . "\n";

	return $result['location'];
}

function getVersion() {
	global $soapurl;

	$soapaction = 'http://www.scurrility.ws/scurrility/GetVersion';
	$soapclient = new nusoap_client($soapurl);

	// create the request manually instead of parsing the WSDL file each
	// time this method / the web service is invoked.
	$soapmsg = $soapclient->serializeEnvelope('<GetVersionRequest xmlns="http://www.scurrility.ws/scurrility"><component>server</component></GetVersionRequest>','',array(),'document', 'literal');
	$result = $soapclient->send($soapmsg, $soapaction);

	if ($soapclient->fault) {
		// Debugging
		// print_r($result);
		return false;
	}

	// Debugging
	// echo $soapclient->request . "\n";
	// echo "---\n";
	// echo $soapclient->response . "\n";

	return $result['version'];
}

echo filter('go to hell') . "\n";
echo getSourceCode() . "\n";
echo getVersion() . "\n";
?>
