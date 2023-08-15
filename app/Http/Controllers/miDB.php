<?php

   function bd_consulta($query)
	{
		$hostname="localhost";
		$user="zamoritt_root";
		$password="2694Hostgator";
		$bd="zamoritt_agroquimicos";
		$connection = mysqli_connect($hostname , $user , $password);

		if (!$connection->set_charset("utf8")) {
			 printf("Error cargando el conjunto de caracteres utf8: %s\n",
				$mysqli->error);
			 exit();
		}
		if($connection == false)
			$mensaje_form="Ha habido un error".mysqli_connect_error();

		mysqli_select_db ($connection, $bd);
		
            $query3 = "SET @i = 0;";
            $result3 = mysqli_query($connection, $query3);
            
		$result = mysqli_query($connection, $query);
		mysqli_close($connection);
		return $result;
	}

?>