<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Producto;
use App\Noticia;
use App\Maquinaria;
use App\Asesoria;
include('miDB.php');

class API extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check())
        {
            return response()->json(["mensaje" => "This is my API"]);
        }
        else
        {
            return response()->json(["mensaje" => "No estas Logueago"]);
        }
    }

    public function token()
    {
        // Mensaje de exito
        return response()->json(["token" => csrf_token()]);
    }

    public function users()
    {
        if(Auth::check() == false || Auth::check() == true)
        {
            // Mensaje de exito
            $datos = User::all();

            $userData = array();

            foreach ($datos as &$row)
            {
              
                  $userData['respuesta'][] = $row;
             
            }


            return json_encode($userData);
        }
        else
        {
            return response()->json(["respuesta" => "No estas Logueago"]);
        }
    }

    public function noticias()
    {
        if(Auth::check() == false || Auth::check() == true)
        {
            // Mensaje de exito
            $datos = Noticia::all();

            $userData = array();

            foreach ($datos as &$row)
            {
              
                  $userData['respuesta'][] = $row;
             
            }


            return json_encode($userData);
        }
        else
        {
            return response()->json(["respuesta" => "No estas Logueago"]);
        }
    }

    public function productos()
    {
        if(Auth::check() == false || Auth::check() == true)
        {
            // Mensaje de exito
            $datos = Producto::all();

            $userData = array();

            foreach ($datos as &$row)
            {
              
                  $userData['respuesta'][] = $row;
             
            }


            return json_encode($userData);
        }
        else
        {
            return response()->json(["respuesta" => "No estas Logueago"]);
        }
    }

    public function asesorias()
    {
        if(Auth::check() == false || Auth::check() == true)
        {
            // Mensaje de exito
            $datos = Asesoria::all();

            $userData = array();

            foreach ($datos as &$row)
            {
              
                  $userData['respuesta'][] = $row;
             
            }


            return json_encode($userData);
        }
        else
        {
            return response()->json(["respuesta" => "No estas Logueago"]);
        }
    }

    public function mix()
    {
        if(Auth::check() == false || Auth::check() == true)
        {
            $query2 =  "SELECT @i := @i + 1 AS miID, T.imagen 
                            FROM 
                            (SELECT imagen FROM noticias
                            UNION
                            SELECT imagen FROM productos 
                            UNION
                            SELECT imagen FROM maquinarias) T LIMIT 12;";

            $datos = bd_consulta($query2);
            
            $userData = array();
          
           
            while ($fila = mysqli_fetch_assoc($datos)) 
            {
                $userData['respuesta'][] = $fila;
            }
            

            return json_encode($userData);
        }
        else
        {
            return response()->json(["respuesta" => "No estas Logueago"]);
        }
    }

    public function getProducto(Request $data)
    {
        // Mensaje de exito
        $datos = DB::select(" SELECT * from productos WHERE idProducto = ".$data['idProducto']." ");

        $userData = array();

        foreach ($datos as &$row)
        {
          
              $userData['respuesta'][] = $row;
         
        }

        
        return json_encode($userData);
    }

    public function getMaquinaria(Request $data)
    {
        // Mensaje de exito
        $datos = DB::select(" SELECT * from maquinarias WHERE idMaquinaria = ".$data['idMaquinaria']." ");

        $userData = array();

        foreach ($datos as &$row)
        {
          
              $userData['respuesta'][] = $row;
         
        }

        
        return json_encode($userData);
    }

    public function getNoticia(Request $data)
    {
        // Mensaje de exito
        $datos = DB::select(" SELECT * from noticias WHERE idNoticia = ".$data['idNoticia']." ");

        $userData = array();

        foreach ($datos as &$row)
        {
          
              $userData['respuesta'][] = $row;
         
        }

        
        return json_encode($userData);
    }

    public function maquinarias()
    {
        if(Auth::check() == false || Auth::check() == true)
        {
            // Mensaje de exito
            $datos = Maquinaria::all();

            $userData = array();

            foreach ($datos as &$row)
            {
              
                  $userData['respuesta'][] = $row;
             
            }


            return json_encode($userData);
        }
        else
        {
            return response()->json(["respuesta" => "No estas Logueago"]);
        }
    }

    public function expe(Request $data)
    {
        if($data->post())
        {
            return response()->json(["respuesta" => $data['name']." : ".$data['date']]);
        }
        else
        {
            return response()->json(["respuesta" => "No estas Logueago"]);
        }
    }

    public function login(Request $data)
    {
        if($data->post())
        {
            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) 
            {
                return response()->json(["respuesta" => "true"]); 
            }
            else
            {
                return response()->json(["respuesta" => "false"]);
            }
            
        }
        else
        {
            return response()->json(["respuesta" => "No estas Logueago"]); 
        }
    }

    public function newProducto(Request $data)
    {
        //obtenemos el campo file definido en el formulario
       $file = $data->file('imagenProducto');
       $fecha = date('jnyGis');
 
       //obtenemos el nombre del archivo
       $nombre = 'https://zamoritta33.com/agroquimicos-zamora/public/productos/P-'.$fecha."-".$file->getClientOriginalName();
       $file->move('productos', "P-".$fecha."-".$file->getClientOriginalName());


       $nuevoProducto = new Producto();
       $nuevoProducto->nombre = $data['nombre'];
       $nuevoProducto->marca = $data['marca'];
       $nuevoProducto->clasificacion = $data['clasificacion'];
       $nuevoProducto->ingredienteActivo = $data['ingredienteActivo'];
       $nuevoProducto->precioUnitario = $data['precioUnitario'];
       $nuevoProducto->stock = $data['stock'];
       $nuevoProducto->descripcion = $data['descripcion'];
       $nuevoProducto->formaAplicacion = $data['formaAplicacion'];
       $nuevoProducto->imagen = $nombre;
       $nuevoProducto->save();


        return response()->json(["respuesta" => $data['nombre']." : ".$data['marca']." : ".$data['clasificacion']." : ".$data['ingredienteActivo']." : ".$data['precioUnitario']." : ".$data['stock']." : ".$data['descripcion']." : ".$data['formaAplicacion']." : ".$nombre ]);

    }

    public function editProducto(Request $data)
    {
        //obtenemos el campo file definido en el formulario
        if($data->file('imagenProducto'))
        {
           $file = $data->file('imagenProducto');
           $fecha = date('jnyGis');
     
           //obtenemos el nombre del archivo
           $nombre = 'https://zamoritta33.com/agroquimicos-zamora/public/productos/P-'.$fecha."-".$file->getClientOriginalName();

           
           $file->move('productos', "P-".$fecha."-".$file->getClientOriginalName());
        
           Producto::where('idProducto', $data->idProducto)->update(['nombre'=>$data->nombre, 'marca'=>$data->marca, 'clasificacion'=>$data->clasificacion, 'ingredienteActivo'=>$data->ingredienteActivo, 'precioUnitario'=>$data->precioUnitario, 'stock'=>$data->stock, 'descripcion'=>$data->descripcion, 'formaAplicacion'=>$data->formaAplicacion, 'imagen'=>$nombre]);

           return response()->json(["respuesta" => $data['idProducto']." => ".$data['nombre']." : ".$data['marca']." : ".$data['clasificacion']." : ".$data['ingredienteActivo']." : ".$data['precioUnitario']." : ".$data['stock']." : ".$data['descripcion']." : ".$data['formaAplicacion']." : ".$nombre ]);
        }
        else
        {

            Producto::where('idProducto', $data->idProducto)->update(['nombre'=>$data->nombre, 'marca'=>$data->marca, 'clasificacion'=>$data->clasificacion, 'ingredienteActivo'=>$data->ingredienteActivo, 'precioUnitario'=>$data->precioUnitario, 'stock'=>$data->stock, 'descripcion'=>$data->descripcion, 'formaAplicacion'=>$data->formaAplicacion]);

           return response()->json(["respuesta" => $data['idProducto']." => ".$data['nombre']." : ".$data['marca']." : ".$data['clasificacion']." : ".$data['ingredienteActivo']." : ".$data['precioUnitario']." : ".$data['stock']." : ".$data['descripcion']." : ".$data['formaAplicacion']." : NO_IMAGE" ]);
        }

    }

    public function editMaquinaria(Request $data)
    {
        //obtenemos el campo file definido en el formulario
        if($data->file('imagenProducto'))
        {
           $file = $data->file('imagenProducto');
           $fecha = date('jnyGis');
     
           //obtenemos el nombre del archivo
           $nombre = 'https://zamoritta33.com/agroquimicos-zamora/public/productos/P-'.$fecha."-".$file->getClientOriginalName();

           
           $file->move('productos', "P-".$fecha."-".$file->getClientOriginalName());
        
           Maquinaria::where('idMaquinaria', $data->idMaquinaria)->update(['nombre'=>$data->nombre, 'marca'=>$data->marca, 'clasificacion'=>$data->clasificacion, 'precioUnitario'=>$data->precioUnitario, 'stock'=>$data->stock, 'descripcion'=>$data->descripcion, 'imagen'=>$nombre]);

           return response()->json(["respuesta" => $data['idMaquinaria']." => ".$data['nombre']." : ".$data['marca']." : ".$data['clasificacion']." : ".$data['precioUnitario']." : ".$data['stock']." : ".$data['descripcion']." : ".$nombre ]);
        }
        else
        {

            Maquinaria::where('idMaquinaria', $data->idMaquinaria)->update(['nombre'=>$data->nombre, 'marca'=>$data->marca, 'clasificacion'=>$data->clasificacion, 'precioUnitario'=>$data->precioUnitario, 'stock'=>$data->stock, 'descripcion'=>$data->descripcion]);

           return response()->json(["respuesta" => $data['idMaquinaria']." => ".$data['nombre']." : ".$data['marca']." : ".$data['clasificacion']." : ".$data['precioUnitario']." : ".$data['stock']." : ".$data['descripcion']." : NO_IMAGE" ]);
        }

    }

    public function editNoticia(Request $data)
    {
        //obtenemos el campo file definido en el formulario
        if($data->file('imagenProducto'))
        {
           $file = $data->file('imagenProducto');
           $fecha = date('jnyGis');
     
           //obtenemos el nombre del archivo
           $nombre = 'https://zamoritta33.com/agroquimicos-zamora/public/productos/P-'.$fecha."-".$file->getClientOriginalName();

           
           $file->move('productos', "P-".$fecha."-".$file->getClientOriginalName());
        
           Noticia::where('idNoticia', $data->idNoticia)->update(['titulo'=>$data->titulo, 'texto'=>$data->texto, 'imagen'=>$nombre]);

           return response()->json(["respuesta" => $data['idNoticia']." => ".$data['titulo']." : ".$data['texto']." : ".$nombre ]);
        }
        else
        {

            Noticia::where('idNoticia', $data->idNoticia)->update(['titulo'=>$data->titulo, 'texto'=>$data->texto]);

           return response()->json(["respuesta" => $data['idNoticia']." => ".$data['titulo']." : ".$data['texto']." : NO_IMAGE" ]);
        }

    }

    public function newMaquinaria(Request $data)
    {
        //obtenemos el campo file definido en el formulario
       $file = $data->file('imagenProducto');
       $fecha = date('jnyGis');
 
       //obtenemos el nombre del archivo
       $nombre = 'https://zamoritta33.com/agroquimicos-zamora/public/productos/P-'.$fecha."-".$file->getClientOriginalName();
       $file->move('productos', "P-".$fecha."-".$file->getClientOriginalName());


       $nuevoProducto = new Maquinaria();
       $nuevoProducto->nombre = $data['nombre'];
       $nuevoProducto->marca = $data['marca'];
       $nuevoProducto->clasificacion = $data['clasificacion'];
       $nuevoProducto->precioUnitario = $data['precioUnitario'];
       $nuevoProducto->stock = $data['stock'];
       $nuevoProducto->descripcion = $data['descripcion'];
       $nuevoProducto->imagen = $nombre;
       $nuevoProducto->save();


        return response()->json(["respuesta" => $data['nombre']." : ".$data['marca']." : ".$data['clasificacion']." : ".$data['precioUnitario']." : ".$data['stock']." : ".$data['descripcion']." : ".$nombre ]);

    }
    public function newNoticia(Request $data)
    {
        //obtenemos el campo file definido en el formulario
       $file = $data->file('imagenProducto');
       $fecha = date('jnyGis');
 
       //obtenemos el nombre del archivo
       $nombre = 'https://zamoritta33.com/agroquimicos-zamora/public/productos/P-'.$fecha."-".$file->getClientOriginalName();
       $file->move('productos', "P-".$fecha."-".$file->getClientOriginalName());


       $nuevoProducto = new Noticia();
       $nuevoProducto->titulo = $data['titulo'];
       $nuevoProducto->texto = $data['texto'];
       $nuevoProducto->imagen = $nombre;
       $nuevoProducto->save();


        return response()->json(["respuesta" => $data['titulo']." : ".$data['texto']." : ".$nombre ]);

    }

    public function newAsesoria(Request $data)
    {
       $nuevoProducto = new Asesoria();
       $nuevoProducto->nombre = $data['nombre'];
       $nuevoProducto->telefono = $data['telefono'];
       $nuevoProducto->correo = $data['correo'];
       $nuevoProducto->texto = $data['texto'];
       $nuevoProducto->save();


        return response()->json(["respuesta" => $data['nombre']." : ".$data['telefono']." : ".$data['correo']." : ".$data['texto'] ]);

    }

    public function delAsesoria(Request $data)
    {
        Asesoria::where('idAsesoria', $data['idAsesoria'])->delete();

        return response()->json(["respuesta" => "DEL => ".$data['idAsesoria'] ]);

    }

    public function delProducto(Request $data)
    {
        Producto::where('idProducto', $data['idProducto'])->delete();

        return response()->json(["respuesta" => "DEL => ".$data['idProducto'] ]);

    }

    public function delMaquinaria(Request $data)
    {
        Maquinaria::where('idMaquinaria', $data['idMaquinaria'])->delete();

        return response()->json(["respuesta" => "DEL => ".$data['idMaquinaria'] ]);

    }

    public function delNoticia(Request $data)
    {
        Noticia::where('idNoticia', $data['idNoticia'])->delete();

        return response()->json(["respuesta" => "DEL => ".$data['idNoticia'] ]);

    }
}