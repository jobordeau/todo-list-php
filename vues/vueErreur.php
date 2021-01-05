<?php
	if (isset($dataVueErreur) && count($dataVueErreur)>0) {
		$dataVueErreur=array_unique($dataVueErreur);
		foreach ($dataVueErreur as $value){
			echo "$value ! <br>";
        }
	}
?>