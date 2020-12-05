<?php
	if (isset($dataVueErreur) && count($dataVueErreur)>0) {
		foreach ($dataVueErreur as $value){
			if(next($dataVueErreur) != null)
				echo "$value / ";
			else
				echo "$value !";
        }
    }
?>