<?php

// simple page redirect
function redirect($location){
	header('location: '. URL_ROUTE . '/' . $location);
}