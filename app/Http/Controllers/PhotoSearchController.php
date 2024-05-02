<?php
// Este edocumento fue creado gracias a: php artisan make:controller PhotoSearchController
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class PhotoSearchController extends Controller
{

    public function create()
    {
        $photos = []; // Variable $photos que define una matriz vacía por defecto
        return view('home', compact('photos'));
    }

    public function store(Request $request)
    {
        $searchTerm = $request->input('textBuscado'); //Almacena en searchTerm el texto buscado en la vista, desde la solicitud HTTP
        $pageNumber = $request->input('page', 1); // Establecer en 1 por defecto

        $response = Http::withHeaders([ //// Realiza una solicitud HTTP GET a la API de Unsplash con los headers y parámetros necesarios
            'Authorization' => 'Client-ID tLsIbU2Ljf2UgtcOMkaKB3wftxrjvq1XDFS-26BdvH0' //Utilizamos un Client-ID para la autorizacion (nos lo brinda la API)
        ])->get('https://api.unsplash.com/search/photos', [ //Solicitud con el metodo GET a traves de la URL determinada el cual corresponde a la API de busqueda de fotos
            'query' => $searchTerm,  //Parametro de busqueda por término
            'page' => $pageNumber,   //Paginación
            'per_page' => 20,        //Número de resultados 
            'order_by' => 'popular', //Orden de resultados (selecciona entre los mas populares)
        ]);


        //Variable $photos que responde al resultado de JSON con extraccion del array "result" o que asigna uno vacío "result" si este no existe.
        $photos = $response->json()['results'] ?? []; 


        // Retorna a la vista de  'home', pasando el array de fotos a la misma
        return view('home', compact('photos'));
    }
}