<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\AttributesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataFeedController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\CampaignController;

use App\Http\Controllers\MessageController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TestimonyController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CanalController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CertificadosController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\ContactoViewController;
use App\Http\Controllers\CotizacionController;
use App\Http\Controllers\DescargablesController;
use App\Http\Controllers\FaqsController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\GalerieController;
use App\Http\Controllers\HomeViewController;
use App\Http\Controllers\LogosClientController;

use App\Http\Controllers\IndexController;
use App\Http\Controllers\InnovacionViewController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LiquidacionController;
use App\Http\Controllers\MicrocategoryController;
use App\Http\Controllers\MisClientesController;
use App\Http\Controllers\MisMarcasController;
use App\Http\Controllers\NewsletterSubscriberController;
use App\Http\Controllers\NosotrosViewController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\PolyticsConditionController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\ProductosViewController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StrengthController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ValoresAtributosController;
use App\Http\Controllers\MailingAnswerController;
use App\Http\Controllers\PolyticsChangeController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\TermsAndConditionController;
use App\Models\AboutUs;
use App\Models\Microcategory;
use App\Models\NewsletterSubscriber;
use App\Models\Price;
use App\Models\Template;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Las rutas publicas */

Route::get('/', [IndexController::class, 'index'])->name('index');
// Route::get('/nosotros', [IndexController::class, 'nosotros'])->name('nosotros');
// Route::get('/innovaciones', [IndexController::class, 'innovaciones'])->name('innovaciones');
// Route::get('/servicios', [IndexController::class, 'novedades'])->name('novedades');
// Route::get('/contacto', [IndexController::class, 'contacto'])->name('contacto');

// Route::get('/servicios', [IndexController::class, 'servicios'])->name('servicios');
// Route::get('/comentario', [IndexController::class, 'comentario'])->name('comentario');
// Route::post('/comentario/nuevo', [IndexController::class, 'hacerComentario'])->name('nuevocomentario');

// Route::get('/descargables/{filtro}', [IndexController::class, 'catalogosDescargables'])->name('descargables');
// Route::get('/blog', [IndexController::class, 'blog'])->name('blog.all');
// Route::get('/blog/{filtro}', [IndexController::class, 'blog'])->name('blog');
// Route::get('/post/{id}', [IndexController::class, 'detalleBlog'])->name('detalleBlog');


/* Proceso de pago */
// Route::get('/carrito', [IndexController::class, 'carrito'])->name('carrito');
// Route::get('/pago', [IndexController::class, 'pago'])->name('pago');
// Route::post('/procesar/pago', [IndexController::class, 'procesarPago'])->name('procesar.pago');
// Route::post('/agradecimiento', [IndexController::class, 'agradecimiento'])->name('agradecimiento');

/* Catálogo y producto */
// Route::get('/producto/{id}', [IndexController::class, 'producto'])->name('producto');
// Route::get('/catalogo', [IndexController::class, 'catalogo'])->name('catalogo.all');
// Route::get('/catalogo/{filtro}', [IndexController::class, 'catalogo'])->name('catalogo');
// Route::post('carrito/buscarProducto', [CarritoController::class, 'buscarProducto'])->name('carrito.buscarProducto');
// Route::get('/coleccion/{filtro}', [IndexController::class, 'coleccion'])->name('coleccion');
// Route::get('/liquidacion', [IndexController::class, 'liquidacion'])->name('liquidacion');
Route::get('/buscar', [IndexController::class, 'searchProduct'])->name('buscar');
Route::post('/procesarcarrito', [IndexController::class, 'procesarCarrito'])->name('procesar.carrito');
Route::post('catalogo_filtro_ajax', [IndexController::class, 'catalogoFiltroAjax'])->name('catalogo_filtro_ajax');
Route::post('cambiogaleria', [IndexController::class, 'cambioGaleria'])->name('cambioGaleria');
Route::post('/subscripciones/guardar', [NewsletterSubscriberController::class, 'saveSubscripciones'])->name('subscripciones.guardar');
Route::post('/subscripciones/guardar2', [NewsletterSubscriberController::class, 'saveSubscripciones2'])->name('subscripciones.guardar2');
Route::post('/cotizar', [CotizacionController::class, 'saveCotizaciones'])->name('cotizar');
Route::post('/obtenerdata', [IndexController::class, 'obtenerdata'])->name('obtenerdata');

/* Página 404 */
Route::get('/404', [IndexController::class, 'error'])->name('error');

/* Formulario de contacto */
Route::post('guardarContactos', [IndexController::class, 'guardarContacto'])->name('guardarContactos');
Route::post('guardarContactoWsp', [IndexController::class, 'guardarContactoWsp'])->name('guardarContactoWsp');
Route::post('guardarProducto', [IndexController::class, 'guardarProducto'])->name('guardarProducto');

Route::post('/getProvincia', [PriceController::class, 'getProvincias'])->name('prices.getProvincias');
Route::post('/getDistrito', [PriceController::class, 'getDistrito'])->name('prices.getDistrito');
Route::post('/calculeEnvio', [PriceController::class, 'calculeEnvio'])->name('prices.calculeEnvio');

Route::post('/getSubcategoria', [CategoryController::class, 'getSubcategoria'])->name('getSubcategoria');
Route::post('/getMicrocategoria', [CategoryController::class, 'getMicrocategoria'])->name('getMicrocategoria');
Route::post('/getProductMicrocategoria', [CategoryController::class, 'getProductMicrocategoria'])->name('getProductMicrocategoria');
Route::post('/getTotalProductos', [CategoryController::class, 'getTotalProductos'])->name('getTotalProductos');

/* Políticas */
// Route::get('/politicas-de-devolucion', [IndexController::class, 'politicasDevolucion'])->name('politicas_dev');
// Route::get('/terminos-y-condiciones', [IndexController::class, 'TerminosyCondiciones'])->name('terms_condition');

Route::redirect('/register', '/login');


Route::middleware(['auth:sanctum', 'verified', 'can:Admin'])->group(function () {

    Route::prefix('admin')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard/analytics', [DashboardController::class, 'analytics'])->name('analytics');
        Route::get('/dashboard/fintech', [DashboardController::class, 'fintech'])->name('fintech');

        //messages
        Route::resource('/mensajes', MessageController::class);
        Route::post('/mensajes/borrar', [MessageController::class, 'borrar'])->name('mensajes.borrar');
        Route::get('/mensajeslanding', [MessageController::class, 'showMessageLanding'])->name('mensajeslanding');
        Route::get('/mensajeslanding/{id}', [MessageController::class, 'showMessageL'])->name('mensajeslanding.show');
        Route::post('/mensajeslanding/borrar', [MessageController::class, 'mensajeslandingDelete'])->name('mensajeslanding.borrar');
        Route::get('/mensajesproduct', [MessageController::class, 'showMessageProducto'])->name('mensajesproduct');
        Route::get('/mensajesproduct/{id}', [MessageController::class, 'showproductL'])->name('mensajesproduct.show');
        Route::post('/mensajesproduct/borrar', [MessageController::class, 'mensajesproductoDelete'])->name('mensajesproduct.borrar');

        Route::resource('/politicas-de-privacidad', PolyticsConditionController::class);
        Route::resource('/terminos-y-condiciones', TermsAndConditionController::class);   
        Route::resource('/politicas-de-cambio', PolyticsChangeController::class);   
        Route::post('mailing/reply/{messageId}', [MailingAnswerController::class, 'replyMailing'])->name('replyMailing');
        //Datos Generales
        Route::resource('/datosgenerales', GeneralController::class);
        Route::resource('/homeview', HomeViewController::class);
        Route::resource('/nosotrosview', NosotrosViewController::class);
        Route::resource('/innovacionesview', InnovacionViewController::class);
        Route::resource('/productosview', ProductosViewController::class);
        Route::resource('/contactoview', ContactoViewController::class);
        
        //Testimonies
        Route::resource('/testimonios', TestimonyController::class);
        Route::post('/testimonios/deleteTestimony', [TestimonyController::class, 'deleteTestimony'])->name('testimonios.deleteTestimony');
        Route::post('/testimonios/updateVisible', [TestimonyController::class, 'updateVisible'])->name('testimonios.updateVisible');

        //Categorías
        Route::resource('/categorias', CategoryController::class);
        Route::post('/categorias/deleteCategory', [CategoryController::class, 'deleteCategory'])->name('categorias.deleteCategory');
        Route::post('/categorias/updateVisible', [CategoryController::class, 'updateVisible'])->name('categorias.updateVisible');
        // Route::get('/categorias/contarCategorias', [CategoryController::class, 'contarCategoriasDestacadas'] )->name('categorias.contarCategoriasDestacadas');


        //Subcategorías
        Route::resource('/subcategorias', SubcategoryController::class);
        Route::post('/subcategorias/deleteSubcategory', [SubcategoryController::class, 'deleteSubcategory'])->name('subcategorias.deleteSubcategory');
        Route::post('/subcategorias/updateVisible', [SubcategoryController::class, 'updateVisible'])->name('subcategorias.updateVisible');
        // Route::get('/subcategorias/contarSubCategoriasDestacadas', [SubcategoryController::class, 'contarSubCategoriasDestacadas'] )->name('subcategorias.contarSubCategoriasDestacadas');


        //Microcategorias
        Route::resource('/microcategorias', MicrocategoryController::class);
        Route::post('/microcategorias/deleteMicrocategory', [MicrocategoryController::class, 'deleteMicrocategory'])->name('microcategorias.deleteMicrocategory');
        Route::post('/microcategorias/updateVisible', [MicrocategoryController::class, 'updateVisible'])->name('microcategorias.updateVisible');

        //Descargables
        Route::resource('/descargables', DescargablesController::class);
        Route::post('/descargables/deleteDownload', [DescargablesController::class, 'deleteDownload'])->name('descargables.deleteDownload');
        Route::post('/descargables/updateVisible', [DescargablesController::class, 'updateVisible'])->name('descargables.updateVisible');

        //Certificados
        Route::resource('/certificados', CertificadosController::class);
        Route::post('/certificados/deleteCertificado', [CertificadosController::class, 'deleteCerticado'])->name('certificados.deleteCertificado');
        Route::post('/certificados/updateVisible', [CertificadosController::class, 'updateVisible'])->name('certificados.updateVisible');

        //Servicios
        Route::resource('/servicios', ServiceController::class);
        Route::post('/servicios/deleteService', [ServiceController::class, 'deleteService'])->name('servicio.deleteService');
        Route::post('/servicios/updateVisible', [ServiceController::class, 'updateVisible'])->name('servicio.updateVisible');


        //Blog
        Route::resource('/blog', BlogController::class);
        Route::post('/blog/deleteBlog', [BlogController::class, 'deleteBlog'])->name('blog.deleteBlog');
        Route::post('/blog/updateVisible', [BlogController::class, 'updateVisible'])->name('blog.updateVisible');

        //Crud Logos
        Route::resource('/logos', LogosClientController::class);
        Route::post('/logos/deleteLogo', [LogosClientController::class, 'deleteLogo'])->name('logos.deleteLogo');

        //Equipo
        Route::resource('/staff', StaffController::class);
        Route::post('/staff/updateVisible', [StaffController::class, 'updateVisible'])->name('staff.updateVisible');
        Route::post('/staff/deleteStaff', [StaffController::class, 'deleteStaff'])->name('staff.deleteStaff');

        //Beneficios    
        Route::resource('/strength', StrengthController::class);
        Route::post('/strength/updateVisible', [StrengthController::class, 'updateVisible'])->name('strength.updateVisible');
        Route::post('/strength/borrar', [StrengthController::class, 'borrar'])->name('strength.borrar');


        //Nosotros
        Route::resource('/aboutus', AboutUsController::class);
        Route::post('/aboutus/updateVisible', [AboutUsController::class, 'updateVisible'])->name('aboutus.updateVisible');
        Route::post('/aboutus/borrar', [AboutUsController::class, 'borrar'])->name('aboutus.borrar');

        //Atributes
        Route::resource('/attributes', AttributesController::class);
        Route::post('/attributes/updateVisible', [AttributesController::class, 'updateVisible'])->name('attributes.updateVisible');
        Route::post('/attributes/borrar', [AttributesController::class, 'borrar'])->name('attributes.borrar');

        //valores atributes
        Route::resource('/valoresattributes', ValoresAtributosController::class);
        Route::post('/valoresattributes/borrar', [ValoresAtributosController::class, 'borrar'])->name('valoresattributes.borrar');
        Route::post('/valoresattributes/updateVisible', [ValoresAtributosController::class, 'updateVisible'])->name('valoresattributes.updateVisible');

        //Etiquetas
        Route::resource('/tags', TagController::class);
        Route::post('/tags/deleteTags', [TagController::class, 'deleteTags'])->name('tags.deleteTags');

        //Canales
        Route::resource('/canales', CanalController::class);
        Route::post('/canales/deleteCanal', [CanalController::class, 'deleteCanal'])->name('canales.deleteCanal');

        //Precios
        Route::resource('/prices', PriceController::class);


        //Productos
        Route::resource('/products', ProductsController::class);
        Route::post('/products/updateVisible', [ProductsController::class, 'updateVisible'])->name('products.updateVisible');
        Route::post('/products/borrar', [ProductsController::class, 'borrar'])->name('products.borrar');
        Route::post('/products/borrarimg', [ProductsController::class, 'borrarimg'])->name('activity.borrarimg');
        Route::post('/products/borrarficha', [ProductsController::class, 'borrarFichaTecnica'])->name('activity.borrarficha');
        Route::post('/products/borrarhoja', [ProductsController::class, 'borrarHojaSeguridad'])->name('activity.borrarhoja');

        //Preguntas frecuentes
        Route::resource('/faqs', FaqsController::class);
        Route::post('/faqs/updateVisible', [FaqsController::class, 'updateVisible'])->name('faqs.updateVisible');
        Route::post('/faqs/borrar', [FaqsController::class, 'borrar'])->name('faqs.borrar');

        //Sliders   
        Route::resource('/slider', SliderController::class);
        Route::post('/slider/updateVisible', [SliderController::class, 'updateVisible'])->name('slider.updateVisible');
        Route::post('/slider/deleteSlider', [SliderController::class, 'deleteSlider'])->name('slider.deleteSlider');

        //Liquidacion   
        Route::resource('/liquidacion', LiquidacionController::class);
        Route::post('/liquidacion/updateVisible', [LiquidacionController::class, 'updateVisible'])->name('liquidacion.updateVisible');
        Route::post('/liquidacion/deleteSlider', [LiquidacionController::class, 'deleteLiquidacion'])->name('liquidacion.deleteLiquidacion');
        
        //Mis Marcas
        Route::resource('/mismarcas', MisMarcasController::class);
        Route::post('/mismarcas/updateVisible', [MisMarcasController::class, 'updateVisible'])->name('mismarcas.updateVisible');
        Route::post('/mismarcas/deleteMisMarcas', [MisMarcasController::class, 'deleteMisMarcas'])->name('mismarcas.deleteMisMarcas');

        //Mis Clientes
        Route::resource('/misclientes', MisClientesController::class);
        Route::post('/misclientes/updateVisible', [MisClientesController::class, 'updateVisible'])->name('misclientes.updateVisible');
        Route::post('/misclientes/deleteMisClientes', [MisClientesController::class, 'deleteMisClientes'])->name('misclientes.deleteMisClientes');

        //Galeria
        Route::resource('/galerie', GalerieController::class);
        Route::post('/galerie/updateVisible', [GalerieController::class, 'updateVisible'])->name('galerie.updateVisible');
        Route::post('/galerie/borrar', [GalerieController::class, 'borrar'])->name('galerie.borrar');

        //Colecciones
        Route::resource('/colecciones', CollectionController::class);
        Route::post('/colecciones/deleteCollection', [CollectionController::class, 'deleteCollection'])->name('collection.deleteCollection');
        Route::post('/colecciones/updateVisible', [CollectionController::class, 'updateVisible'])->name('collection.updateVisible');

        //Pedidos
        Route::get('/orders', [PedidosController::class, 'listadoPedidos'])->name('orders');
        Route::get('/orders/{id}', [PedidosController::class, 'verPedido'])->name('verPedido');

        //Suscripciones
        Route::get('/subscripciones', [NewsletterSubscriberController::class, 'showSubscripciones'])->name('subscripciones');
        
        //Cotizaciones
        Route::get('/cotizaciones', [CotizacionController::class, 'showCotizaciones'])->name('cotizaciones');

        Route::get(
            '/templates',
            fn () => view('pages.templates.index')
                ->with('regex', '/{{(.*?)}}/gs')
                ->with('llavesBegin', '{{')
                ->with('llavesEnd', '}}')
        )->name('templates.index');
        Route::get('/landings', [LandingController::class, 'index'])->name('landings.index');
        Route::get('/landings/config/{landing}', [LandingController::class, 'config'])->name('landings.config');


        Route::fallback(function () {
            return view('pages/utility/404');
        });
    });
});


Route::middleware(['auth:sanctum', 'verified', 'can:Customer'])->group(function () {

    Route::get('/micuenta', [IndexController::class, 'micuenta'])->name('micuenta');
    Route::get('/micuenta/pedidos', [IndexController::class, 'pedidos'])->name('pedidos');
    Route::get('/micuenta/direccion', [IndexController::class, 'direccion'])->name('direccion');
    Route::post('/micuenta/direccion/direccionFavorita', [IndexController::class, 'direccionFavorita'])->name('direccionFavorita');

    Route::post('/micuenta/cambiofoto', [IndexController::class, 'cambiofoto'])->name('cambiofoto');
    Route::post('/micuenta/direccion/cambiofoto', [IndexController::class, 'cambiofoto'])->name('cambiofoto');
    Route::post('/micuenta/pedidos/cambiofoto', [IndexController::class, 'cambiofoto'])->name('cambiofoto');

    Route::get('/obtenerProvincia/{departmentId}', [IndexController::class, 'obtenerProvincia'])->name('obtenerProvincia');
    Route::get('/obtenerDistritos/{provinceId}', [IndexController::class, 'obtenerDistritos'])->name('obtenerDistritos');
    Route::post('/guardarDireccion', [IndexController::class, 'guardarDireccion'])->name('guardar.direccion');

    Route::post('/micuenta/actualizarPerfil', [IndexController::class, 'actualizarPerfil'])->name('actualizarPerfil');
});

Route::fallback(fn () => response()->view('public.404', [], 404));
