<?php

namespace App\Http\Controllers;

use App\Helpers\EmailConfig;
use App\Http\Requests\StoreIndexRequest;
use App\Http\Requests\UpdateIndexRequest;
use App\Models\AboutUs;
use App\Models\AddressUser;
use App\Models\Attributes;
use App\Models\AttributesValues;
use App\Models\Blog;
use App\Models\Faqs;
use App\Models\General;
use App\Models\Index;
use App\Models\Message;
use App\Models\Products;
use App\Models\Slider;
use App\Models\Strength;
use App\Models\Testimony;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Combinacion;
use App\Models\Descargables;
use App\Models\DetalleOrden;
use App\Models\ImagenProducto;
use App\Models\Liquidacion;
use App\Models\Microcategory;
use App\Models\Ordenes;
use App\Models\Specifications;
use App\Models\Staff;
use App\Models\Subcategory;
use App\Models\TypeAttribute;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\MisClientes;
use App\Models\MisMarcas;
use App\Models\Certificados;
use App\Models\ContactDetail;
use App\Models\ContactoView;
use App\Models\HomeView;
use App\Models\InnovacionView;
use App\Models\NosotrosView;
use App\Models\PolyticsChange;
use App\Models\PolyticsCondition;
use App\Models\ProductosView;
use App\Models\TermsAndCondition;
use Attribute;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

use function PHPUnit\Framework\isNull;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $productos = Products::all();


        $general = General::all();

        $politicDev = PolyticsCondition::first();
        $termsAndCondicitions = TermsAndCondition::first();
        $polyticChange = PolyticsChange::first();




        return view('public.index', compact('general', 'politicDev', 'termsAndCondicitions', 'polyticChange'));
    }

    public function coleccion($filtro)
    {
        try {
            $collections = Collection::where('status', '=', 1)->where('visible', '=', 1)->get();

            if ($filtro == 0) {
                $productos = Products::where('status', '=', 1)->where('visible', '=', 1)->paginate(16);
                $collection = Collection::where('status', '=', 1)->where('visible', '=', 1)->get();
            } else {
                $productos = Products::where('status', '=', 1)->where('visible', '=', 1)->where('collection_id', '=', $filtro)->paginate(16);
                $collection = Collection::where('status', '=', 1)->where('visible', '=', 1)->where('id', '=', $filtro)->first();
            }

            return view('public.collection', compact('filtro', 'productos', 'collection', 'collections'));
        } catch (\Throwable $th) {
        }
    }

    public function catalogoFiltroAjax(Request $request)
    {
        $productos = Products::obtenerProductos();
        $page = 0;
        if (!empty($productos->nextPageUrl())) {
            $parse_url = parse_url($productos->nextPageUrl());

            if (!empty($parse_url['query'])) {
                parse_str($parse_url['query'], $get_array);
                $page = !empty($get_array['page']) ? $get_array['page'] : 0;
            }
        }

        return response()->json(
            [
                'status' => true,
                'page' => $page,
                'success' => view('public._listproduct', [
                    'productos' => $productos,
                ])->render(),
            ],
            200,
        );
    }

    public function catalogo(Request $request, string $filtro = null)
    {
        $categorias = null;
        $productos = null;
        $categoria = null;

        try {
            $general = General::all();
            $textoproducto = ProductosView::first();
            $faqs = Faqs::where('status', '=', 1)->where('visible', '=', 1)->get();
            $categorias = Category::where('status', '=', 1)->where('destacar', '=', 1)->where('visible', '=', 1)->orderBy('order', 'asc')->get();

            $subcategorias = Subcategory::all();
            $microcategorias = Microcategory::all();
            $testimonie = Testimony::where('status', '=', 1)->where('visible', '=', 1)->get();
            $atributos = Attributes::where('status', '=', 1)->where('visible', '=', 1)->get();
            $colecciones = Collection::where('status', '=', 1)->where('visible', '=', 1)->get();

            if (is_null($filtro) || $filtro == 0) {
                //$productos = Products::where('status', '=', 1)->where('visible', '=', 1)->with('tags')->paginate(12);
                $productos = Products::obtenerProductos();

                $categoria = Category::all();
            } else {
                //$productos = Products::where('status', '=', 1)->where('visible', '=', 1)->where('categoria_id', '=', $filtro)->with('tags')->paginate(12);
                $productos = Products::obtenerProductos($filtro);

                $categoria = Category::findOrFail($filtro);
            }

            $page = 0;
            if (!empty($productos->nextPageUrl())) {
                $parse_url = parse_url($productos->nextPageUrl());

                if (!empty($parse_url['query'])) {
                    parse_str($parse_url['query'], $get_array);
                    $page = !empty($get_array['page']) ? $get_array['page'] : 0;
                }
            }

            return view('public.catalogo', compact('textoproducto', 'general', 'faqs', 'categorias', 'testimonie', 'filtro', 'productos', 'categoria', 'atributos', 'colecciones', 'page', 'subcategorias', 'microcategorias'));
        } catch (\Throwable $th) {
        }
    }

    public function comentario()
    {
        $comentarios = Testimony::where('status', '=', 1)->where('visible', '=', 1)->paginate(15);
        $contarcomentarios = count($comentarios);
        return view('public.comentario', compact('comentarios', 'contarcomentarios'));
    }

    public function hacerComentario(Request $request)
    {
        $user = auth()->user();

        $newComentario = new Testimony();
        if (isset($user)) {
            $alert = null;
            $request->validate(
                [
                    'testimonie' => 'required',
                ],
                [
                    'testimonie.required' => 'Ingresa tu comentario',
                ],
            );

            $newComentario->name = $user->name;
            $newComentario->testimonie = $request->testimonie;
            $newComentario->visible = 0;
            $newComentario->status = 1;
            $newComentario->email = $user->email;
            $newComentario->save();

            $mensaje = 'Gracias. Tu comentario pasará por una validación y será publicado.';
            $alert = 1;
        } else {
            $alert = 2;
            $mensaje = 'Inicia sesión para hacer un comentario';
        }

        return redirect()
            ->route('comentario')
            ->with(['mensaje' => $mensaje, 'alerta' => $alert]);
    }

    public function contacto()
    {
        $general = General::all();
        $contactodetalle = ContactDetail::all();
        $textocontacto = ContactoView::first();
        $textoshome = HomeView::first();
        $contactos = ContactDetail::where('status', '=', 1)->get();
        $preguntasfrec = Faqs::where('status', '=', 1)->where('visible', '=', 1)->get();
        $faqs = Faqs::where('status', '=', 1)->where('visible', '=', 1)->get();
        return view('public.contacto', compact('textocontacto', 'preguntasfrec', 'textoshome', 'general', 'contactos', 'faqs', 'contactodetalle'));
    }

    public function carrito()
    {
        //
        $url_env = $_ENV['APP_URL'];
        $departamentos = DB::table('departments')->get();
        return view('public.checkout_carrito', compact('url_env', 'departamentos'));
    }

    public function pago(Request $request)
    {
        //
        $formToken = $request->input('token');
        $codigoCompra = $request->input('codigoCompra');

        $detalleUsuario = [];
        $user = auth()->user();
        $N_orden = Ordenes::where('codigo_orden', '=', $codigoCompra)->get()->toArray();
        /* if (!isNull($user)) {
      $detalleUsuario = UserDetails::where('email', $user->email)->get();
    } */
        $detalleUsuario = UserDetails::where('id', $N_orden[0]['usuario_id'])->get();

        $distritos = DB::select('select * from districts where active = ? order by 3', [1]);
        $provincias = DB::select('select * from provinces where active = ? order by 3', [1]);
        $departamento = DB::select('select * from departments where active = ? order by 2', [1]);

        //consultar n orden
        // traer los datos necesarios para armar el token
        // $formToken =  $this->generateFormTokenIzipay();

        $url_env = $_ENV['APP_URL'];
        return view('public.checkout_pago', compact('url_env', 'distritos', 'provincias', 'departamento', 'detalleUsuario', 'formToken', 'codigoCompra'));
    }

    private function generateFormTokenIzipay($amount, $orderId, $email)
    {
        $clientId = config('services.izipay.client_id');
        $clientSecret = config('services.izipay.client_secret');
        $auth = base64_encode($clientId . ':' . $clientSecret);

        $url = config('services.izipay.url');
        $response = Http::withHeaders([
            'Authorization' => "Basic $auth",
            'Content-Type' => 'application/json',
        ])
            ->post($url, [
                'amount' => $amount * 100,
                'currency' => 'PEN',
                'orderId' => $orderId,
                'customer' => [
                    'email' => $email,
                ],
            ])
            ->json();

        $token = $response['answer']['formToken'];
        return $token;
    }

    public function procesarPago(Request $request)
    {
        $codigoCompra = $request->codigoCompra;
        $dataArray = $request->data;
        $result = [];

        $codigoAleatorio = '';
        foreach ($dataArray as $item) {
            $result[$item['name']] = $item['value'];
        }
        $tipoTarjeta = $result['tipo_tarjeta'];

        try {
            $reglasPrimeraCompra = [
                'email' => 'required',
            ];
            $mensajes = [
                'email.required' => 'El campo Email es obligatorio.',
            ];
            // $request->validate($reglasPrimeraCompra, $mensajes);

            $orden = Ordenes::where('codigo_orden', '=', $codigoCompra);

            $orden->update(['tipo_tarjeta' => $tipoTarjeta]);

            $ordenid = $orden->get();
            AddressUser::where('id', $ordenid[0]['address_id'])->update([
                'dir_av_calle' => $result['dir_av_calle'],
                'dir_numero' => $result['dir_numero'],
                'dir_bloq_lote' => $result['dir_bloq_lote'],
            ]);

            UserDetails::where('email', '=', $request->email)->update($result);

            return response()->json(['message' => 'Todos los datos estan correctos', 'codigoCompra' => $codigoAleatorio]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['message' => $th], 400);
        }
    }

    private function guardarOrden()
    {
        //almacenar venta, generar orden de pedido , guardar en tabla detalle de compra, li
    }

    private function codigoVentaAleatorio()
    {
        $codigoAleatorio = '';

        // Longitud deseada del código
        $longitudCodigo = 10;

        // Genera un código aleatorio de longitud 10
        for ($i = 0; $i < $longitudCodigo; $i++) {
            $codigoAleatorio .= mt_rand(0, 9); // Agrega un dígito aleatorio al código
        }
        return $codigoAleatorio;
    }

    public function agradecimiento(Request $request)
    {
        //
        $codigoCompra = $request->input('codigoCompra');

        $ordenes = Ordenes::where('codigo_orden', '=', $codigoCompra)->update(['status_id' => 2]);

        return view('public.checkout_agradecimiento', compact('codigoCompra'));
    }

    public function cambiofoto(Request $request)
    {
        $user = User::findOrFail($request->id);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $route = 'storage/images/users/';
            $nombreImagen = Str::random(10) . '_' . $file->getClientOriginalName();

            if (File::exists(storage_path() . '/app/public/' . $user->profile_photo_path)) {
                File::delete(storage_path() . '/app/public/' . $user->profile_photo_path);
            }

            $this->saveImg($file, $route, $nombreImagen);

            $routeforshow = 'images/users/';
            $user->profile_photo_path = $routeforshow . $nombreImagen;

            $user->save();

            return response()->json(['message' => 'La imagen se cargó correctamente.']);
        }
    }

    public function actualizarPerfil(Request $request)
    {
        $name = $request->name;
        $lastname = $request->lastname;
        $email = $request->email;
        $user = User::findOrFail($request->id);

        if ($request->password !== null || $request->newpassword !== null || $request->confirmnewpassword !== null) {
            if (!Hash::check($request->password, $user->password)) {
                $imprimir = 'La contraseña actual no es correcta';
                $alert = 'error';
            } else {
                $user->password = Hash::make($request->newpassword);
                $imprimir = 'Cambio de contraseña exitosa';
                $alert = 'success';
            }
        }

        if ($user->name == $name && $user->lastname == $lastname) {
            $imprimir = 'Sin datos que actualizar';
            $alert = 'question';
        } else {
            $user->name = $name;
            $user->lastname = $lastname;
            $alert = 'success';
            $imprimir = 'Datos actualizados';
        }

        $user->save();
        return response()->json(['message' => $imprimir, 'alert' => $alert]);
    }

    public function micuenta()
    {
        $user = Auth::user();
        return view('public.dashboard', compact('user'));
    }

    public function pedidos()
    {
        $user = Auth::user();

        $detalleUsuario = UserDetails::where('email', $user->email)
            ->get()
            ->toArray();

        $ordenes = Ordenes::where('usuario_id', $detalleUsuario[0]['id'])
            ->with('DetalleOrden')
            ->with('statusOrdenes')
            ->get();

        return view('public.dashboard_order', compact('user', 'ordenes'));
    }

    public function direccionFavorita(Request $request)
    {
        $item = AddressUser::find($request->id);
        if ($item) {
            AddressUser::where('user_id', $item->user_id)->update(['favorite' => 0]);
            $item->favorite = 1;
            $item->save();

            return response()->json(['message' => 'Dirección favorita modificada']);
        }

        return response()->json(['error' => 'Item no encontrado'], 404);
    }

    public function direccion()
    {
        $user = Auth::user();
        $direcciones = AddressUser::where('user_id', $user->id)->get();
        $departamentofiltro = DB::select('select * from departments where active = ? order by 2', [1]);
        $departamento = DB::select('select * from departments where active = ? order by 2', [1]);

        foreach ($direcciones as $direccion) {
            $distrito = DB::table('districts')
                ->where('id', $direccion->distrito_id)
                ->first();
            $provincia = DB::table('provinces')
                ->where('id', $direccion->provincia_id)
                ->first();
            $departamento = DB::table('departments')
                ->where('id', $direccion->departamento_id)
                ->first();

            $direccion->distrito_id = $distrito ? $distrito->description : '';
            $direccion->provincia_id = $provincia ? $provincia->description : '';
            $direccion->departamento_id = $departamento ? $departamento->description : '';
        }

        return view('public.dashboard_direccion', compact('user', 'direcciones', 'departamento', 'departamentofiltro'));
    }

    public function obtenerProvincia($departmentId)
    {
        $provinces = DB::select('select * from provinces where active = ? and department_id = ? order by description', [1, $departmentId]);
        return response()->json($provinces);
    }

    public function obtenerDistritos($provinceId)
    {
        $distritos = DB::select('select * from districts where active = ? and province_id = ? order by description', [1, $provinceId]);
        return response()->json($distritos);
    }

    public function guardarDireccion(Request $request)
    {
        $user = Auth::user();
        $direccion = new AddressUser();

        $direccion->departamento_id = $request->departamento_id;
        $direccion->provincia_id = $request->provincia_id;
        $direccion->distrito_id = $request->distrito_id;
        $direccion->dir_av_calle = $request->nombre_calle;
        $direccion->dir_numero = $request->numero_calle;
        $direccion->dir_bloq_lote = $request->direccion;
        $direccion->user_id = $user->id;
        $direccion->save();

        return response()->json(['message' => 'Dirección guardada exitosamente']);
    }

    public function error()
    {
        //
        return view('public.404');
    }



    public function cambioGaleria(Request $request)
    {
        $colorId = $request->id;
        $productId = $request->idproduct;

        $images = ImagenProducto::where('color_id', $colorId)->where('product_id', $productId)->get();

        // return response()->json(['images' => $images]);
        // $productos = Products::where('id', '=', $productId)->with('attributes')->with('tags')->get();
        $tallas = Combinacion::where('color_id', $colorId)->where('product_id', $productId)->with('talla')->get();

        return response()->json(
            [
                'status' => true,
                'images' => $images,
                'tallas' => $tallas,
            ],
            200,
        );
    }

    public function producto(string $id)
    {

        $producto = Products::where('id', '=', $id)->first();

        $meta_title = $producto->meta_title ?? $producto->producto;
        $meta_description = $producto->meta_description  ?? Str::limit(strip_tags($producto->description), 160);
        $meta_keywords = $producto->meta_keywords ?? '';


        $colors = DB::table('imagen_productos')->where('product_id', $id)->groupBy('color_id')->join('attributes_values', 'color_id', 'attributes_values.id')->get();

        $productos = Products::where('id', '=', $id)->with('attributes')->with('tags')->get();


        $especificaciones = Specifications::where('product_id', '=', $id)
            ->where(function ($query) {
                $query->whereNotNull('tittle')->orWhereNotNull('specifications');
            })
            ->get();
        $productosConGalerias = DB::select(
            "
            SELECT products.*, galeries.*
            FROM products
            INNER JOIN galeries ON products.id = galeries.product_id
            WHERE products.id = :productId limit 5
        ",
            ['productId' => $id],
        );

        $IdProductosComplementarios = $productos->toArray();
        $IdProductosComplementarios = $IdProductosComplementarios[0]['categoria_id'];

        $ProdComplementarios = $producto->productrelacionados()->where('status', 1)->get();

        if ($ProdComplementarios->isEmpty()) {
            $ProdComplementarios = Products::where('categoria_id', '=', $IdProductosComplementarios)
                ->where('id', '!=', $producto->id) // Excluir el producto actual
                ->where('status', 1)
                ->get();
        }

        //$productosRelacionados = Products::where('categoria_id', '=', $IdProductosComplementarios)->get();

        $atributos = Attributes::where('status', '=', true)->get();


        $valorAtributo = AttributesValues::where('status', '=', true)->get();

        $url_env = $_ENV['APP_URL'];

        return view('public.product', compact('meta_title', 'meta_description', 'meta_keywords', 'producto', 'productos', 'atributos', 'valorAtributo', 'ProdComplementarios', 'productosConGalerias', 'especificaciones', 'url_env', 'colors'));
    }

    public function liquidacion()
    {
        try {
            $liquidacion = Products::where('status', '=', 1)->where('visible', '=', 1)->where('liquidacion', '=', 1)->paginate(16);

            return view('public.liquidacion', compact('liquidacion'));
        } catch (\Throwable $th) {
        }
    }

    public function nosotros()
    {
        try {
            $general = General::first();
            $textosnosotros = NosotrosView::first();
            $testimonie = Testimony::where('status', '=', 1)->where('visible', '=', 1)->get();
            $staff = Staff::where('status', '=', 1)->get();
            $valores = MisClientes::where('status', '=', 1)->where('visible', '=', 1)->get();
            $certificados = Certificados::where('status', '=', 1)->where('visible', '=', 1)->get();
            $nosotros = AboutUs::where('status', '=', 1)->get();
            $benefit = Strength::where('status', '=', 1)->get();
            return view('public.nosotros', compact('textosnosotros', 'benefit', 'general', 'testimonie', 'staff', 'nosotros', 'valores', 'certificados'));
        } catch (\Throwable $th) {
        }
    }

    public function innovaciones()
    {
        $general = General::first();
        $innovaciontext = InnovacionView::first();
        $productos = Products::where('status', '=', 1)->where('visible', '=', 1)->with('tags')->get();
        $category = Category::where('status', '=', 1)
            ->where('visible', '=', 1)
            // ->whereHas('productos', function ($query) {
            //     $query->where('status', 1)->where('visible', 1);
            // })
            ->orderBy('order', 'asc')
            ->get();
        return view('public.innovaciones', compact('general', 'innovaciontext', 'productos', 'category'));
    }

    public function novedades()
    {
        try {
            $general = General::first();
            $testimonie = Testimony::where('status', '=', 1)->where('visible', '=', 1)->get();
            $novedades = Products::where('status', '=', 1)->where('visible', '=', 1)->where('recomendar', '=', 1)->paginate(16);
            $benefit = Liquidacion::where('status', '=', 1)->where('visible', '=', 1)->get();
            $productos = Products::where('status', '=', 1)->where('visible', '=', 1)->with('tags')->with('canals')->get();
            $category = Category::where('status', '=', 1)
                ->where('visible', '=', 1)
                // ->whereHas('productos', function ($query) {
                //     $query->where('status', 1)->where('visible', 1);
                // })
                ->orderBy('order', 'asc')
                ->get();
            return view('public.novedades', compact('novedades', 'benefit', 'productos', 'category', 'general', 'testimonie'));
        } catch (\Throwable $th) {
        }
    }

    public function blog(Request $request, string $filtro = null)
    {
        try {
            $categorias = Category::where('status', '=', 1)->where('visible', '=', 1)->get();

            if ($filtro == 0) {
                $posts = Blog::where('status', '=', 1)->where('visible', '=', 1)->get();

                $categoria = Category::where('status', '=', 1)->where('visible', '=', 1)->get();

                // $lastpost = Blog::where('status', '=', 1)->where('visible', '=', 1)->orderBy('created_at', 'desc')->first();

                // $lastpost = $posts->last();

                // $restopost = $posts->reject(function ($post) use ($lastpost) {
                //   return $post->id === $lastpost->id;
                // });

            } else {
                $posts = Blog::where('status', '=', 1)->where('visible', '=', 1)->where('category_id', '=', $filtro)->get();

                $categoria = Category::where('status', '=', 1)->where('visible', '=', 1)->where('id', '=', $filtro)->get();

                // $lastpost = Blog::where('status', '=', 1)->where('visible', '=', 1)->orderBy('created_at', 'desc')->where('category_id', '=', $filtro)->first();

                // $lastpost = $posts->last();

                // $restopost = $posts->reject(function ($post) use ($lastpost) {
                //   return $post->id === $lastpost->id;
                // });
            }

            $postsgeneral = Blog::where('status', '=', 1)->where('visible', '=', 1)->get();

            $lastpost = $postsgeneral->last();

            return view('public.blog', compact('posts', 'categoria', 'categorias', 'filtro', 'lastpost', 'postsgeneral'));
        } catch (\Throwable $th) {
        }
    }

    public function detalleBlog($id)
    {
        $post = Blog::where('status', '=', 1)->where('visible', '=', 1)->where('id', '=', $id)->first();

        $postsrelacionados = Blog::where('status', '=', 1)
            ->where('visible', '=', 1)
            ->where('category_id', '=', $post->category_id)
            ->where('id', '!=', $post->id) // Excluir el post actual
            ->take(6)
            ->get();

        $meta_title = $post->meta_title ?? $post->title;
        $meta_description = $post->meta_description  ?? Str::limit($post->extract, 160);
        $meta_keywords = $post->meta_keywords ?? '';

        return view('public.post', compact('meta_title', 'meta_description', 'meta_keywords', 'post', 'postsrelacionados'));
    }

    public function catalogosDescargables($filtro)
    {
        try {
            $categorias = Category::where('status', '=', 1)->where('visible', '=', 1)->orderBy('order', 'asc')->get();

            if ($filtro == 0) {
                //$productos = Products::where('status', '=', 1)->where('visible', '=', 1)->with('tags')->paginate(12);
                $descargables = Descargables::where('status', '=', 1)->where('visible', '=', 1)->paginate(16);

                $categoria = Category::where('status', '=', 1)->where('visible', '=', 1)->get();
                //$categoria = Category::all();
            } else {
                //$productos = Products::where('status', '=', 1)->where('visible', '=', 1)->where('categoria_id', '=', $filtro)->with('tags')->paginate(12);
                $descargables = Descargables::where('status', '=', 1)->where('visible', '=', 1)->where('categoria_id', '=', $filtro)->paginate(16);

                $categoria = Category::where('status', '=', 1)->where('visible', '=', 1)->where('id', '=', $filtro)->get();
                //$categorias = Category::findOrFail($filtro);
            }

            return view('public.descargables', compact('descargables', 'categorias', 'filtro', 'categoria'));
        } catch (\Throwable $th) {
        }
    }

    public function searchProduct(Request $request)
    {
        $query = $request->input('query');
        $resultados = Products::where('producto', 'like', "%$query%")->where('visible', '=', true)->where('status', '=', true)
            ->with('categoria')->get();

        return response()->json($resultados);
    }
    //  --------------------------------------------
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
    public function store(StoreIndexRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Index $index)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Index $index)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIndexRequest $request, Index $index)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Index $index)
    {
        //
    }

    /**
     * Save contact from blade
     */
    public function guardarContacto(Request $request)
    {
        $data = $request->all();
        $data['full_name'] = $request->full_name;
        $ipAddress = $request->ip();
        $ancho = $request->client_width;
        $latitud = $request->client_latitude;
        $longitud = $request->client_longitude;
        $sistema = $request->client_system;

        try {
            $reglasValidacion = [
                'full_name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
            ];
            $mensajes = [
                'full_name.required' => 'El campo nombre es obligatorio.',
                'email.required' => 'El campo correo electrónico es obligatorio.',
                'email.email' => 'El formato del correo electrónico no es válido.',
                'email.max' => 'El campo correo electrónico no puede tener más de :max caracteres.',
            ];
            $request->validate($reglasValidacion, $mensajes);


            if (!is_null($ipAddress)) {
                $data['ip'] = $ipAddress;
            } else {
                $data['ip'] = 'Sin data';
            }

            if (!is_null($latitud)) {
                $data['client_latitude'] = $latitud;
            } else {
                $data['client_latitude'] = 'Sin data';
            }

            if (!is_null($longitud)) {
                $data['client_longitude'] = $longitud;
            } else {
                $data['client_longitude'] = 'Sin data';
            }

            if (!is_null($sistema)) {
                $data['client_system'] = $sistema;
            } else {
                $data['client_system'] = 'Sin data';
            }


            if ($ancho >= 1 && $ancho <= 767) {
                $data['device'] = 'mobile';
            } elseif ($ancho >= 768 && $ancho <= 1024) {
                $data['device'] = 'tablet';
            } elseif ($ancho >= 1025) {
                $data['device'] = 'desktop';
            } elseif (is_null($ancho)) {
                $data['device'] = 'Sin data';
            }



            $dataform = Message::create($data);
            $this->envioCorreoAdmin($dataform);
            $this->envioCorreoCliente($dataform);

            return response()->json(['message' => 'Mensaje enviado con exito']);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->validator->errors()], 400);
        }
    }


    public function guardarContactoWsp(Request $request)
    {
        $data = $request->all();
        $data['full_name'] = $request->full_name;
        $ipAddress = $request->ip();
        $ancho = $request->client_width;
        $latitud = $request->client_latitude;
        $longitud = $request->client_longitude;
        $sistema = $request->client_system;

        try {
            $reglasValidacion = [
                'full_name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|numeric',
                'country_code' => 'required|string',
                'ruc' => 'required|numeric',
                'service_product' => 'required|string|max:255',
            ];
            $mensajes = [
                'full_name.required' => 'El campo nombre es obligatorio.',
                'email.required' => 'El campo correo electrónico es obligatorio.',
                'email.email' => 'El formato del correo electrónico no es válido.',
                'email.max' => 'El campo correo electrónico no puede tener más de :max caracteres.',
                'phone.required' => 'El campo teléfono es obligatorio.',
                'phone.numeric' => 'El campo teléfono debe ser un número.',

                'country_code.required' => 'El campo código de país es obligatorio.',
                'country_code.string' => 'El campo código de país debe ser una cadena de texto.',
                'ruc.required' => 'El campo RUC es obligatorio.',
                'ruc.numeric' => 'El campo RUC debe ser un número.',

                'service_product.required' => 'El campo producto o servicio es obligatorio.',
                'service_product.string' => 'El campo producto o servicio debe ser una cadena de texto.',

            ];
            $request->validate($reglasValidacion, $mensajes);


            if (!is_null($ipAddress)) {
                $data['ip'] = $ipAddress;
            } else {
                $data['ip'] = 'Sin data';
            }

            if (!is_null($latitud)) {
                $data['client_latitude'] = $latitud;
            } else {
                $data['client_latitude'] = 'Sin data';
            }

            if (!is_null($longitud)) {
                $data['client_longitude'] = $longitud;
            } else {
                $data['client_longitude'] = 'Sin data';
            }

            if (!is_null($sistema)) {
                $data['client_system'] = $sistema;
            } else {
                $data['client_system'] = 'Sin data';
            }


            if ($ancho >= 1 && $ancho <= 767) {
                $data['device'] = 'mobile';
            } elseif ($ancho >= 768 && $ancho <= 1024) {
                $data['device'] = 'tablet';
            } elseif ($ancho >= 1025) {
                $data['device'] = 'desktop';
            } elseif (is_null($ancho)) {
                $data['device'] = 'Sin data';
            }



            $formlanding = Message::create($data);

            $this->envioCorreoAdmin($formlanding);
            $this->envioCorreoCliente($formlanding);

            return response()->json(['message' => 'Redirigiendo a Whatsapp']);
        } catch (ValidationException $e) {
            \Log::error($e);
            return response()->json(['message' => $e->validator->errors()], 400);
        }
    }

    public function guardarProducto(Request $request)
    {
        $data = $request->all();
        $data['full_name'] = $request->full_name;
        $data['service_product'] = $request->service_product;
        $ipAddress = $request->ip();
        $ancho = $request->client_width;
        $latitud = $request->client_latitude;
        $longitud = $request->client_longitude;
        $sistema = $request->client_system;

        try {
            $reglasValidacion = [
                'full_name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
            ];
            $mensajes = [
                'full_name.required' => 'El campo nombre es obligatorio.',
                'email.required' => 'El campo correo electrónico es obligatorio.',
                'email.email' => 'El formato del correo electrónico no es válido.',
                'email.max' => 'El campo correo electrónico no puede tener más de :max caracteres.',
            ];
            $request->validate($reglasValidacion, $mensajes);


            if (!is_null($ipAddress)) {
                $data['ip'] = $ipAddress;
            } else {
                $data['ip'] = 'Sin data';
            }

            if (!is_null($latitud)) {
                $data['client_latitude'] = $latitud;
            } else {
                $data['client_latitude'] = 'Sin data';
            }

            if (!is_null($longitud)) {
                $data['client_longitude'] = $longitud;
            } else {
                $data['client_longitude'] = 'Sin data';
            }

            if (!is_null($sistema)) {
                $data['client_system'] = $sistema;
            } else {
                $data['client_system'] = 'Sin data';
            }


            if ($ancho >= 1 && $ancho <= 767) {
                $data['device'] = 'mobile';
            } elseif ($ancho >= 768 && $ancho <= 1024) {
                $data['device'] = 'tablet';
            } elseif ($ancho >= 1025) {
                $data['device'] = 'desktop';
            } elseif (is_null($ancho)) {
                $data['device'] = 'Sin data';
            }


            $formlanding = Message::create($data);
            $this->envioCorreoAdmin($formlanding);
            $this->envioCorreoCliente($formlanding);

            return response()->json(['message' => 'Mensaje enviado con exito']);
        } catch (ValidationException $e) {

            return response()->json(['message' => $e->validator->errors()], 400);
        }
    }

    public function saveImg($file, $route, $nombreImagen)
    {
        $manager = new ImageManager(new Driver());
        $img = $manager->read($file);

        if (!file_exists($route)) {
            mkdir($route, 0777, true); // Se crea la ruta con permisos de lectura, escritura y ejecución
        }
        $img->save($route . $nombreImagen);
    }

    private function envioCorreoAdmin($data)
    {
        $generales = General::first();
        if (!$generales || !$generales->email) {
            \Log::error('No se encontró email admin en la tabla generales');
            return false;
        }

        $emailadmin = $generales->email;
        $appUrl = env('APP_URL');
        $name = 'Administrador';
        $mensaje = "Nueva solicitud de contacto - QALLPA";

        try {
            $mail = EmailConfig::config($name, $mensaje);
            $mail->addAddress($emailadmin);
            $mail->isHTML(true);

            // Versión texto plano (alternativa para clientes de email que no soportan HTML)
            $mail->AltBody = "Nueva solicitud de contacto:\n\nNombre: {$data['full_name']}\nEmail: {$data['email']}\nMensaje: {$data['message']}";

            // HTML del correo (versión simplificada y más robusta)
            $mail->Body = $this->buildAdminEmailHtml($data, $appUrl, $name);

            // Configuración adicional importante
            $mail->SMTPKeepAlive = true;
            $mail->Encoding = 'base64';

            if (!$mail->send()) {
                \Log::error('Error PHPMailer: ' . $mail->ErrorInfo);
                throw new \Exception('Error al enviar correo: ' . $mail->ErrorInfo);
            }

            return true;
        } catch (\Exception $e) {
            \Log::error('Error en envioCorreoAdmin: ' . $e->getMessage());
            return false;
        }
    }

    private function buildAdminEmailHtml($data, $appUrl, $name)
    {
        return <<<HTML
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nuevo Contacto - QALLPA</title>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #ddd; }
            .header { text-align: center; margin-bottom: 20px; }
            .logo { max-width: 200px; }
            h1 { color: #323653; }
            .info { margin: 15px 0; }
            .btn { 
                display: inline-block; 
                padding: 10px 20px; 
                background: #323653; 
                color: white; 
                text-decoration: none; 
                border-radius: 5px; 
                margin: 20px 0;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <a href="{$appUrl}" target="_blank">
                    <img src="{$appUrl}/mail/logo.png" alt="QALLPA" class="logo">
                </a>
            </div>
            
            <h1>Nueva solicitud de contacto</h1>
            
            <div class="info">
                <p><strong>Nombre:</strong> {$data['full_name']}</p>
                <p><strong>Email:</strong> {$data['email']}</p>
                <p><strong>Mensaje:</strong> {$data['message']}</p>
            </div>
            
            <a href="{$appUrl}" class="btn" target="_blank">Ver en el sistema</a>
        </div>
    </body>
    </html>
    HTML;
    }

    private function envioCorreoCliente($data)
    {
        try {
            $name = $data['full_name'];
            $appUrl = env('APP_URL');
            $mensaje = 'Gracias por comunicarte con QALLPA';

            $mail = EmailConfig::config($name, $mensaje);
            $mail->addAddress($data['email']);
            $mail->isHTML(true);

            // Versión texto plano IMPORTANTE
            $mail->AltBody = "Hola {$name},\n\nGracias por comunicarte con QALLPA, en breve nos pondremos en contacto contigo.\n\nVisita nuestra web: {$appUrl}";

            // Construcción más segura del HTML
            $mail->Body = $this->buildClientEmailHtml($name, $appUrl);

            // Configuraciones críticas adicionales
            $mail->Encoding = 'base64';
            $mail->SMTPKeepAlive = true;
            $mail->CharSet = 'UTF-8';

            if (!$mail->send()) {
                \Log::error('Error PHPMailer al cliente: ' . $mail->ErrorInfo);
                throw new \Exception('Error al enviar: ' . $mail->ErrorInfo);
            }

            return true;
        } catch (\Exception $e) {
            \Log::error('Excepción en envioCorreoCliente: ' . $e->getMessage());
            return false;
        }
    }

    private function buildClientEmailHtml($name, $appUrl)
    {
        $logoUrl = $appUrl . '/mail/logo.png';
        $backgroundUrl = $appUrl . '/mail/fondo.png';
        $currentYear = date('Y');
        $socials = General::first();
        $link_facebook = $socials->facebook;
        $link_instagram = $socials->instagram;
        $link_linkedin = $socials->linkedin;

        $link_twitter = $socials->twitter;

        return <<<HTML
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gracias por contactarnos</title>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <style>
            body, html { 
                margin: 0; 
                padding: 0; 
                font-family: 'Montserrat', sans-serif;
                line-height: 1.6;
                background-color: #f5f5f5;
            }
            .wrapper {
                padding: 20px;
            }
            .email-container { 
                max-width: 600px; 
                margin: 0 auto; 
                background-image: url('{$backgroundUrl}');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                border-radius: 16px;
                overflow: hidden;
                box-shadow: 0 15px 35px rgba(0,0,0,0.25);
            }
            .overlay {
                background: linear-gradient(135deg, rgba(50, 54, 83, 0.75) 0%, rgba(50, 54, 83, 0.65) 100%);
                padding: 0 0 40px;
                backdrop-filter: blur(2px);
            }
            .header { 
                padding: 25px 0; 
                text-align: center;
                background-color: rgba(0, 0, 0, 0.3);
                backdrop-filter: blur(8px);
                border-bottom: 1px solid rgba(255, 255, 255, 0.15);
                position: relative;
                overflow: hidden;
            }
        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #18C991, #A9F1D1);
        }
        .logo {
            max-width: 200px;
            height: auto;
            filter: drop-shadow(0 3px 6px rgba(0,0,0,0.3));
            transition: transform 0.3s ease;
        }
        .logo:hover {
            transform: scale(1.05);
        }
        .content { 
            padding: 40px 30px; 
            text-align: center; 
            color: #FFFFFF;
            position: relative;
            z-index: 1;
        }
        .content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, #18C991, #A9F1D1);
            border-radius: 3px;
        }
        .btn {
            display: inline-block;
            padding: 16px 32px;
            background: linear-gradient(135deg, #18C991 0%, #A9F1D1 100%);
            color: #323653 !important;
            text-decoration: none;
            border-radius: 32px;
            font-weight: 700;
            margin: 35px 0 15px;
            box-shadow: 0 6px 20px rgba(24, 201, 145, 0.4);
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 15px;
            position: relative;
            overflow: hidden;
        }
        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, rgba(255,255,255,0) 0%, rgba(255,255,255,0.3) 50%, rgba(255,255,255,0) 100%);
            transition: all 0.6s ease;
        }
        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(24, 201, 145, 0.5);
        }
        .btn:hover::before {
            left: 100%;
        }
        .title {
            font-size: 42px;
            font-weight: 800;
            margin-bottom: 35px;
            line-height: 1.2;
            text-shadow: 0 2px 10px rgba(0,0,0,0.3);
            position: relative;
            display: inline-block;
        }
        .highlight {
            color: #18C991;
            position: relative;
            display: inline-block;
            text-shadow: 0 2px 10px rgba(24, 201, 145, 0.4);
        }
        .highlight::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #18C991, #A9F1D1);
            border-radius: 4px;
            box-shadow: 0 2px 8px rgba(24, 201, 145, 0.5);
        }
        .message {
            background-color: rgba(0, 0, 0, 0.25);
            border-radius: 16px;
            padding: 30px;
            margin: 35px 0;
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            position: relative;
            overflow: hidden;
        }
        .message::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, #18C991, #A9F1D1);
            border-radius: 4px 0 0 4px;
        }
        .message p {
            margin-bottom: 12px;
            text-shadow: 0 1px 3px rgba(0,0,0,0.2);
        }
        .message p:last-child {
            margin-bottom: 0;
        }
        .footer {
            text-align: center;
            padding: 0 30px 20px;
            color: rgba(255, 255, 255, 0.8);
            font-size: 13px;
            position: relative;
        }
        .footer p {
            margin: 5px 0;
            text-shadow: 0 1px 3px rgba(0,0,0,0.2);
        }
        .social-icons {
            margin: 25px 0 15px;
        }
        .social-icon {
            display: inline-block;
            margin: 0 10px;
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            text-align: center;
            line-height: 40px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            backdrop-filter: blur(5px);
        }
        .social-icon:hover {
            background-color: #18C991;
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(24, 201, 145, 0.4);
        }
        .divider {
            height: 1px;
            background: linear-gradient(90deg, rgba(255,255,255,0) 0%, rgba(255,255,255,0.3) 50%, rgba(255,255,255,0) 100%);
            margin: 20px 0;
        }
        @media only screen and (max-width: 480px) {
            .title {
                font-size: 32px;
            }
            .content {
                padding: 30px 20px;
            }
            .message {
                padding: 25px 20px;
            }
            .social-icon {
                margin: 0 8px;
                width: 36px;
                height: 36px;
                line-height: 36px;
            }
        }
        </style>
    </head>
    <body>
        <div class="wrapper">
            <div class="email-container">
                <div class="overlay">
                <div class="header">
                    <a href="{$appUrl}" target="_blank">
                        <img src="{$logoUrl}" alt="QALLPA" class="logo">
                    </a>
                </div>
                
                <div class="content">
                    <h1 class="title">¡<span class="highlight">Gracias</span> por escribirnos!</h1>
                    
                    <div class="message">
                        <p style="font-size: 19px; margin-bottom: 15px; font-weight: 600;">Hola {$name},</p>
                        <p style="font-size: 16px; margin-bottom: 10px;">Hemos recibido tu mensaje correctamente.</p>
                        <p style="font-size: 16px; font-weight: 500;">Nuestro equipo estará en contacto contigo muy pronto para atender tu solicitud.</p>
                    </div>
                    
                    <a href="{$appUrl}" class="btn" target="_blank">Visita nuestra web</a>
                    
                    <div class="social-icons">
                        <a href="{$link_facebook}" class="social-icon" target="_blank" aria-label="Facebook">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                        </a>
                        <a href="{$link_instagram}" class="social-icon" target="_blank" aria-label="Instagram">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                        </a>
                        <a href="{$link_linkedin}" class="social-icon" target="_blank" aria-label="LinkedIn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>
                        </a>
                        <a href="{$link_twitter}" class="social-icon" target="_blank" aria-label="Twitter">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"></path></svg>
                        </a>
                    </div>
                    
                    <div class="divider"></div>
                </div>
                
                <div class="footer">
                    <p>© {$currentYear} QALLPA. Todos los derechos reservados.</p>
                    <p>Si tienes alguna pregunta, no dudes en contactarnos.</p>
                    <p style="font-size: 11px; margin-top: 15px; color: rgba(255,255,255,0.6);">Si no solicitaste este correo, puedes ignorarlo de forma segura.</p>
                </div>
            </div>
            </div>
        </div>
    </body>
    </html>
    HTML;
    }

    public function procesarCarrito(Request $request)
    {
        $primeraVez = false;

        try {
            $codigoOrden = $this->codigoVentaAleatorio();
            $jsonMonto = json_decode($request->total, true);
            $montoT = $jsonMonto['total'];
            $subMonto = $jsonMonto['suma'];

            $precioEnvio = $montoT - $subMonto;
            $email = $request->email;

            $usuario = UserDetails::where('email', '=', $email)->get(); // obtenemos usuario para validarlo si no agregarlo

            //si tiene usuario registrad

            if (!$usuario->isNotEmpty()) {
                $usuario = UserDetails::create(['email' => $email]);
                $primeraVez = true;
            }

            $addres = AddressUser::create([
                'departamento_id' => (int) $request->departamento,
                'provincia_id' => (int) $request->provincia,
                'distrito_id' => (int) $request->distrito,
                'user_id' => $usuario[0]['id'],
            ]);
            $this->GuardarOrdenAndDetalleOrden($codigoOrden, $montoT, $precioEnvio, $usuario, $request->carrito, $addres);

            $formToken = $this->generateFormTokenIzipay($montoT, $codigoOrden, $email);

            //
            return response()->json(['mensaje' => 'Orden generada correctamente', 'formToken' => $formToken, 'codigoOrden' => $codigoOrden, 'primeraVez' => $primeraVez]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['mensaje' => "Intente de nuevo mas tarde , estamos trabajando en una solucion , $th"], 400);
        }
    }
    private function GuardarOrdenAndDetalleOrden($codigoOrden, $montoT, $precioEnvio, $usuario, $carrito, $addres)
    {
        $data['codigo_orden'] = $codigoOrden;
        $data['monto'] = $montoT;
        $data['precio_envio'] = $precioEnvio;
        $data['status_id'] = '1';
        $data['usuario_id'] = $usuario[0]['id'];
        $data['address_id'] = $addres['id'];

        $orden = Ordenes::create($data);

        //creamos detalle de orden
        foreach ($carrito as $key => $value) {
            DetalleOrden::create([
                'producto_id' => $value['id'],
                'cantidad' => $value['cantidad'],
                'orden_id' => $orden->id,
                'precio' => $value['precio'],
                'talla' => $value['talla'],
                'color' => $value['color']['valor'],
            ]);
        }
    }


    // if ($rangefrom !== null && $rangeto !== null) {

    //   if ($filtro == 0) {
    //     $productos = Products::where('status', '=', 1)->where('visible', '=', 1)->with('tags')->paginate(12);
    //     $categoria = Category::all();
    //   } else {
    //     $productos = Products::where('status', '=', 1)->where('visible', '=', 1)->where('categoria_id', '=', $filtro)->with('tags')->paginate(12);
    //     $categoria = Category::findOrFail($filtro);
    //   }

    //   $cleanedData = $productos->filter(function ($value) use ($rangefrom, $rangeto) {

    //     if ($value['descuento'] == 0) {

    //       if ($value['precio'] <= $rangeto && $value['precio'] >= $rangefrom) {
    //         return $value;
    //       }
    //     } else {

    //       if ($value['descuento'] <= $rangeto && $value['descuento'] >= $rangefrom) {
    //         return $value;
    //       }
    //     }
    //   });

    //   $currentPage = LengthAwarePaginator::resolveCurrentPage();
    //   $productos = new LengthAwarePaginator(
    //     $cleanedData->forPage($currentPage, 12), // Obtener los productos por página
    //     $cleanedData->count(), // Contar todos los elementos
    //     12, // Número de elementos por página
    //     $currentPage, // Página actual
    //     ['path' => request()->url()] // URL base para la paginación
    //   );
    // }

    public function politicasDevolucion()

    {
        $politicDev = PolyticsCondition::first();
        return view('public.politicasdeenvio', compact('politicDev'));
    }

    public function TerminosyCondiciones()

    {
        $termsAndCondicitions = TermsAndCondition::first();
        return view('public.terminosycondiciones', compact('termsAndCondicitions'));
    }

    public function obtenerdata(Request $request)
    {

        try {
            $producto = Products::where('id', '=', $request->id)->first();
            return response()->json(['menssage' => 'Data obtenida', 'producto' => $producto]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['menssage' => "Ocurrio un error , $th"], 400);
        }
    }
}
