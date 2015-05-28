<!DOCTYPE html>
<html lang="es">
  <head>
   
    <title>Reactiva tu cuenta que fue borrada</title>
  <style type="text/css">
     a:link{   
       text-decoration:none;   
     }  
    .clasesita{
      border: 1px solid #0101DF;
      border-radius: 1px;
      color: white;
      background-color: #308BCD;
      padding: 10px 13px;
      text-decoration: none !important;
    }
    .centrar{
      text-align:center;
      margin-top:20px;
      margin-bottom: 25px;
    }
  </style>
    
  </head>
  <body>
  <h3><b>Restablece tu contraseña de Miradita</b></h3>

  
  <div class="centrar"> Hemos recibido una petición para restablecer la contraseña de tu cuenta. </div>
  <p class="centrar"> Si hiciste esta petición, haz clic en Recuperar contraseña. Si no hiciste esta petición, puedes ignorar este correo.. </p>
  
  <p class="centrar"> {{ link_to('recuperar/password/'.$id_usuario.'/'.$random, 'RECUPERAR CONTRASEÑA', array('class' => 'clasesita'), null) }} </p>  
  
  
    
    
    
    
  </body>
</html>
