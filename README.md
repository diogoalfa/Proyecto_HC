Proyecto Horario de clases
===========
1. Para un servicio local

      1.- ir a la carpeta script hcdb, e importar la base de datos
      
      2.- ir a la carpeta CodeIgniter_2.1.4 -> applicaction -> config y modificar los parametros del archivo database.php
      
      3.- una vez hecho eso puedes entrar con la siguiente direccion 

            localhost/Proyecto_HC/CodeIgniter_2.1.4   
            
            
2.- Para un servicio global   


      1.- Descargar el repositorio 
      
      2.- verificar que en CodeIgniter_2.1.4 -> applicaction -> config -> database.php existan los siguientes parametros
            $db['default']['hostname'] = '146.83.181.4';
            $db['default']['username'] = 'grupo01';
            $db['default']['password'] = 'grupo01';
            $db['default']['database'] = 'iswdb';
            $db['default']['port'] = 6432;
            $db['default']['dbdriver'] = 'postgre';
      
      3.- una vez hecho eso puedes entrar con la siguiente direccion 
            localhost/Proyecto_HC/CodeIgniter_2.1.4   

