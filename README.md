# MyPDO
Librería para un uso más rápido de PDO de PHP 5.5 en adelante, para facilitar la forma de insertar datos con PDO
## Funciones
- ### rawInsert(Conexion (Conexion), tabla (String), campos (array), tabla (array) )
Esta función no utiliza PDO para la insertar un nuevo registro a la base de datos (BD), si no que utiliza los valores que son pasados
- ### PDOInsert(Conexion (Conexion), tabla (String), campos (array), tabla (array) )
Esta función utiliza PDO y regresa un '1' si la acción se completa, de lo contraro devuleve un error de codigo de MySQL o un mensaje de advertencia.
- ### PDOUpdate (Conexion (Conexion), tabla (String), campos (array), tabla (array), campoID (mixed), datoID (mixed))
Esta función es para actualizar es necesario utilizar campoID y datoID para poder encontrar los valores que se van a actualizar mediante esta función
## Mensajes de advertencia:
- Cantidad de Campos no coincide con Datos
- Valor Malicioso en el campo: x
- Varialbe no especificada -Campo: x
(Donde x es el campo donde se encontró el error)
