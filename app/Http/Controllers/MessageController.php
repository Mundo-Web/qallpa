<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Models\Message;
use Illuminate\Http\Request;


class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $mensajes = Message::orderBy('created_at', 'DESC')
                            ->get();
                                // Cargar el JSON de países
    $paisesJson = file_get_contents(public_path('libs/prefijocelular.json'));
    $paises = json_decode($paisesJson, true);
    
    // Crear un array asociativo código => país
    $codigosPaises = [];
    foreach ($paises as $pais) {
        $codigosPaises[$pais['beautyCode']] = $pais['country'];
    }

        return view('pages.message.index', compact('mensajes','codigosPaises'));
    
        
    }

    public function showMessageLanding(){
        $mensajeslanding = Message::where('status', '=', 1)
                            ->whereNotIn('source', ['Inicio', 'Contacto', 'Producto', 'WSP - Productos Químicos','WSP - Tratamiento de Agua'])
                            ->orderBy('created_at', 'DESC')
                            ->get();
        return view('pages.landingmessages.index', compact('mensajeslanding'));
    }


    public function showMessageProducto()
    {
        //
        $mensajesproduct = Message::where('status', '=', 1)
                            ->where('source','=', 'Producto')
                            ->orderBy('created_at', 'DESC')
                            ->get();
        return view('pages.messageProduct.index', compact('mensajesproduct'));
    
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }
    function storePublic(Request $request)
    {
        $mensaje = new Message();

        $mensaje->full_name = $request->full_name; 
        $mensaje->email = $request->email; 
        $mensaje->phone = $request->phone; 
        $mensaje->source = $request->tipo_message; 
        $mensaje->message = $request->mensaje; 

        $mensaje->save();

        return response()->json(['message' => 'Solicitud enviada Correctamente']);
    }

    /**
     * Display the specified resource.
     */
    //public function show(Message $message)
    public function show($id)
    {
        //
        $message = Message::findOrFail($id);

        $message->is_read = 1; 
        $message->save();

        return view('pages.message.show', compact('message'));
    }


    public function showMessageL($id)
    {
        //
        $message = Message::findOrFail($id);

        $message->is_read = 1; 
        $message->save();

        return view('pages.landingmessages.show', compact('message'));
    }

    public function showproductL($id)
    {
        //
        $message = Message::findOrFail($id);

        $message->is_read = 1; 
        $message->save();

        return view('pages.messageProduct.show', compact('message'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMessageRequest $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }


    public function borrar(Request $request)
    {

        $mensaje = Message::find($request->id);
        $mensaje->status = 0; 
        $mensaje->save();

        return response()->json(['success' => true]);

    }

    public function mensajeslandingDelete(Request $request)
    {

        $mensaje = Message::find($request->id);
        $mensaje->status = 0; 
        $mensaje->save();

        return response()->json(['success' => true]);

    }

    public function mensajesproductoDelete(Request $request)
    {

        $mensaje = Message::find($request->id);
        $mensaje->status = 0; 
        $mensaje->save();

        return response()->json(['success' => true]);

    }


    public function deleteMensajes(Request $request) {
        //Recupero el id mandado mediante ajax
        
        $id = $request->id;
        //Busco el servicio con id como parametro
        $message = Message::findOrfail($id);
        //Modifico el status a false
        $message->status = false;
        //Guardo 
        $message->save();

        // Devuelvo una respuesta JSON u otra respuesta según necesites
        return response()->json(['message' => 'Mensaje eliminado.']);
    
    }
}
