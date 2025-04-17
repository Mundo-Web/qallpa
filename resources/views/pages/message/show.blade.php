<x-app-layout title="Mostrar mensajes">
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <div
            class="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
            <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
                <h2 class="font-semibold text-slate-800 dark:text-slate-100 text-2xl">Enviado el
                    {{ $message->created_at->format('d-m-Y') }} por {{ $message->full_name }}</h2>
            </header>
            <div class="p-3">

                <div class="p-6">
                  
                <!-- Información del Contacto -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                        <h3 class="font-bold text-lg mb-3 text-slate-800 dark:text-slate-100">Información del Contacto</h3>
                        <div class="space-y-3">
                            <div>
                                <p class="font-medium text-gray-500 dark:text-gray-400">Nombre completo</p>
                                <p class="dark:text-white">{{ $message->full_name }}</p>
                            </div>
                            <div>
                                <p class="font-medium text-gray-500 dark:text-gray-400">Correo electrónico</p>
                                <p class="dark:text-white">
                                    <a href="mailto:{{ $message->email }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                                        {{ $message->email }}
                                    </a>
                                </p>
                            </div>
                            <div>
                                <p class="font-medium text-gray-500 dark:text-gray-400">Teléfono</p>
                                <p class="dark:text-white flex items-center">
                                    @php
                                        $pais = collect($paises)->firstWhere('beautyCode', $message->country_code);
                                        $isoCode = $pais['isoCode']['ISO1'] ?? 'us';
                                    @endphp
                                    <span class="fi fi-{{ strtolower($isoCode) }} mr-2"></span>
                                    <a href="tel:{{ $message->phone }}" class="hover:underline">
                                        {{ $message->country_code }} {{ $message->phone }}
                                    </a>
                                </p>
                            </div>
                            @if($message->ruc)
                            <div>
                                <p class="font-medium text-gray-500 dark:text-gray-400">RUC/DNI</p>
                                <p class="dark:text-white">{{ $message->ruc }}</p>
                            </div>
                            @endif
                            <div>
                                <p class="font-medium text-gray-500 dark:text-gray-400">País</p>
                                <p class="dark:text-white">
                                    {{ $codigosPaises[$message->country_code] ?? $message->country_code }}
                                    <span class="fi fi-{{ strtolower($isoCode) }} ml-2"></span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Detalles del Servicio/Mensaje -->
                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                        <h3 class="font-bold text-lg mb-3 text-slate-800 dark:text-slate-100">Detalles del Servicio</h3>
                        <div class="space-y-3">
                            @if($message->service_product)
                            <div>
                                <p class="font-medium text-gray-500 dark:text-gray-400">Servicio/Producto de interés</p>
                                <p class="dark:text-white">{{ $message->service_product }}</p>
                            </div>
                            @endif
                           <!-- <div>
                                <p class="font-medium text-gray-500 dark:text-gray-400">Mensaje</p>
                                <div class="dark:text-white bg-white dark:bg-gray-800 p-3 rounded border border-gray-200 dark:border-gray-700">
                                    {!! nl2br(e($message->message)) !!}
                                </div>
                            </div>-->
                        </div>
                    </div>
                </div>

                    @if (count($message->answers) > 0)
                        <div class="mb-4">

                            <hr class="mb-2">
                            <span class="font-bold block mb-2">Respuestas</span>
                            @foreach ($message->answers as $answer)
                                <div
                                    class="block w-full py-2 px-3 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mb-2">

                                    <p class="font-bold tracking-tight text-gray-900 dark:text-white">
                                        {{ $answer->subject }}</p>
                                    <p class="font-normal text-gray-700 dark:text-gray-400">{!! $answer->content !!}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ route('replyMailing', $message->id) }}" method="POST">

                        <hr class="mb-2">
                        @csrf
                        <span class="font-bold block mb-2">Enviar una respuesta por correo</span>

                        <div class="md:col-span-5 mt-2">
                            <label for="subject">Asunto</label>
                            <div class="relative mb-2  mt-2">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="fa fa-pen"></i>
                                </div>
                                <input type="text" id="subject" name="subject" value=""
                                    class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Asunto">
                            </div>
                        </div>

                        <div class="md:col-span-5">
                            <label for="content">Contenido</label>
                            <div class="relative mb-6 mt-2">
                                <textarea type="text" id="content" name="content"
                                    class="ckeditor mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Contenido"></textarea>
                            </div>
                        </div>

                        <button class="bg-green-500 px-4 py-2 rounded text-white" type="submit">
                            <i class="fa-solid fa-envelope mr-2"></i>
                            Responder
                        </button>

                        <a href="{{ route('mensajes.index') }}"
                            class="block bg-red-500 px-4 py-2 rounded text-white w-max float-end">
                            <i class="fa-solid fa-arrow-left mr-2"></i>
                            Volver
                        </a>
                        
                    </form>

                </div>
            </div>
        </div>

    </div>



</x-app-layout>

<script src="/ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content', {
        toolbar: [{
                name: 'document',
                items: ['Source']
            }, // Código fuente
            {
                name: 'clipboard',
                items: ['Cut', 'Copy', 'Paste', '-', 'Undo', 'Redo']
            },
            {
                name: 'styles',
                items: ['Styles', 'Format', 'FontSize']
            }, // Tamaño y fuente
            {
                name: 'colors',
                items: ['TextColor', 'BGColor']
            }, // Color de texto y fondo
            {
                name: 'basicstyles',
                items: ['Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat']
            },
            {
                name: 'paragraph',
                items: ['NumberedList', 'BulletedList', '-', 'Blockquote']
            },
            {
                name: 'insert',
                items: ['Table', 'HorizontalRule']
            },
            {
                name: 'links',
                items: ['Link', 'Unlink']
            },
            {
                name: 'tools',
                items: ['Maximize']
            } // Maximizar
        ],
        extraPlugins: 'colorbutton,font', // Activa plugins para color y fuentes
        removePlugins: 'elementspath', // Elimina la ruta de elementos
        resize_enabled: true // Permite redimensionar el editor
    });
</script>
