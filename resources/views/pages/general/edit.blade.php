<x-app-layout title="Editar General">
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <form action="{{ route('datosgenerales.update', $general->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div
                class="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
                <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
                    <h2 class="font-semibold text-slate-800 dark:text-slate-100 text-2xl tracking-tight">Datos generales
                        del negocio</h2>
                </header>
                @if (session('success'))
                    <script>
                        window.onload = function() {
                            mostrarAlerta();
                        }
                    </script>
                @endif
                <div class="p-3">
                    <div class="flex items-center justify-center">
                        <div class="rounded shadow-lg p-4 px-4 w-full">
                            <div class="grid gap-4 gap-y-2 text-sm">
                                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5 w-full">

                                    <h2 class="md:col-span-5 text-lg font-semibold text-slate-800 dark:text-white">
                                        Información de contacto
                                    </h2>

                                    {{-- <div class="md:col-span-5">
                                                        <label for="address">Dirección de la empresa</label>
                                                        <div class="relative mb-2 ">
                                                            <div
                                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                                    fill="currentColor" viewBox="0 0 20 20"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                                                    </path>
                                                                    <path
                                                                        d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z">
                                                                    </path>
                                                                </svg>
                                                            </div>
                                                            <input type="text" id="address" name="address"
                                                                value="{{ $general->address }}"
                                                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                placeholder="name@flowbite.com">
                                                        </div>
                                    </div> --}}

                                    {{-- <div class="md:col-span-2">
                                                        <label for="inside">Interior</label>
                                                        <div class="relative mb-2">
                                                            <div
                                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                                    fill="currentColor" viewBox="0 0 20 20"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                                                    </path>
                                                                    <path
                                                                        d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z">
                                                                    </path>
                                                                </svg>
                                                            </div>
                                                            <input type="text" id="inside" name="inside"
                                                                value="{{ $general->inside }}"
                                                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                placeholder="Interior Oficina 204 - Piso 4">
                                                        </div>
                                    </div> --}}

                                    {{-- <div class="md:col-span-1">
                                                        <label for="district">Ciudad</label>
                                                        <div class="relative mb-2">
                                                            <div
                                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                                    fill="currentColor" viewBox="0 0 20 20"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                                                    </path>
                                                                    <path
                                                                        d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z">
                                                                    </path>
                                                                </svg>
                                                            </div>
                                                            <input type="text" id="city" name="city"
                                                                value="{{ $general->city }}"
                                                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                placeholder="Interior Oficina 204 - Piso 4">
                                                        </div>
                                    </div> --}}

                                    {{-- <div class="md:col-span-1">
                                                        <label for="district">Distrito</label>
                                                        <div class="relative mb-2">
                                                            <div
                                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                                    fill="currentColor" viewBox="0 0 20 20"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                                                    </path>
                                                                    <path
                                                                        d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z">
                                                                    </path>
                                                                </svg>
                                                            </div>
                                                            <input type="text" id="district" name="district"
                                                                value="{{ $general->district }}"
                                                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                placeholder="Interior Oficina 204 - Piso 4">
                                                        </div>
                                    </div> --}}

                                    {{-- <div class="md:col-span-1">
                                                        <label for="country">País</label>
                                                        <div class="relative mb-2">
                                                            <div
                                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                                    fill="currentColor" viewBox="0 0 20 20"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                                                    </path>
                                                                    <path
                                                                        d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z">
                                                                    </path>
                                                                </svg>
                                                            </div>
                                                            <input type="text" id="country" name="country"
                                                                value="{{ $general->country }}"
                                                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                placeholder="Interior Oficina 204 - Piso 4">
                                                        </div>
                                    </div> --}}

                                    {{-- <div class="md:col-span-5">
                                                        <label for="mapa">Otras direcciones</label>
                                                        <div class="relative mb-2 ">

                                                            <textarea id="mapa" name="mapa"
                                                                class="ckeditor mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                >{{ $general->mapa }}</textarea>
                                                        </div>
                                    </div> --}}

                                    <div class="md:col-span-5">
                                        <label for="email">Correo electrónico</label>
                                        <div class="relative mb-2">
                                            <div
                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                    fill="currentColor" viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                                    </path>
                                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <input type="email" id="email" name="email"
                                                value="{{ $general->email }}"
                                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="name@flowbite.com">
                                        </div>
                                    </div>

                                    <div class="md:col-span-2">
                                        <label for="cellphone">Número de celular</label>
                                        <div class="relative mb-2">
                                            <div
                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                    fill="currentColor" viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                                    </path>
                                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <input type="text" id="cellphone" name="cellphone"
                                                value="{{ $general->cellphone }}"
                                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="+51 123 456 789">
                                        </div>
                                    </div>

                                    {{-- <div class="md:col-span-1">
                                                        <label for="office_phone">Número de Teléfono</label>
                                                        <div class="relative mb-2">
                                                            <div
                                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                                    fill="currentColor" viewBox="0 0 20 20"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                                                    </path>
                                                                    <path
                                                                        d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z">
                                                                    </path>
                                                                </svg>
                                                            </div>
                                                            <input type="text" id="office_phone"
                                                                name="office_phone"
                                                                value="{{ $general->office_phone }}"
                                                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                placeholder="+51 1234567">
                                                        </div>
                                    </div> --}}

                                    {{-- <div class="md:col-span-5">
                                                        <div class="grid grid-cols-1 gap-5">
                                                            <div class="my-2">
                                                                <div class=" flex items-end justify-between gap-2 ">
                                                                    <label for="especificacion">Datos de contacto </label>
                                                                    <button type="button" id="AddEspecifiacion"
                                                                        class="text-blue-500 hover:underline focus:outline-none font-medium">
                                                                        Agregar datos
                                                                    </button>
                                                                </div>
                                                           
                                                            @foreach ($datoscontacto as $item)
                                                                <div class="flex flex-col md:flex-row gap-2 w-full">
                                                                    <div class="relative  mt-2 mb-0 md:mb-2 w-full md:w-1/2 lg:w-1/4">
                                                                        <div
                                                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                            <i class="fa-solid fa-pencil text-xl"></i>
                                                                        </div>
                                                                        <select type="text" id="Area-{{ $item->id }}"
                                                                            name="Area-{{ $item->id }}" value=""
                                                                            class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                           >
                                                                            <option value="1">Dirección</option>
                                                                            <option value="2">Teléfono</option>
                                                                            <option value="3">Email</option>

                                                                        </select>
                                                                    </div>

                                                                    <div class="relative  mt-2 w-full md:w-full lg:w-1/3" id="N-{{ $item->id }}">
                                                                        <div
                                                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                            <i class="fa-solid fa-pencil text-xl"></i>
                                                                        </div>
                                                                        <input type="text" id="Nombre-{{ $item->id }}"
                                                                            name="Nombre-{{ $item->id }}" value="{{ $item->nombre }}"
                                                                            class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                            placeholder="Nombre">

                                                                    </div>
                                                                    
                                                                    <div class="relative  mt-2 w-full md:w-full lg:w-1/3"  id="C-{{ $item->id }}">
                                                                        <div
                                                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                            <i class="fa-solid fa-pencil text-xl"></i>
                                                                        </div>
                                                                        <input type="text" id="Celular-{{ $item->id }}"
                                                                            name="Celular-{{ $item->id }}" value="{{ $item->celular }}"
                                                                            class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                            placeholder="Número de celular">

                                                                    </div>

                                                                    <div class="relative  mt-2 w-full md:w-full lg:w-1/3" id="E-{{ $item->id }}">
                                                                        <div
                                                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                            <i class="fa-solid fa-pencil text-xl"></i>
                                                                        </div>
                                                                        <input type="text" id="Email-{{ $item->id }}"
                                                                            name="Email-{{ $item->id }}" value="{{ $item->email }}"
                                                                            class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                            placeholder="Correo Electrónico">

                                                                    </div>

                                                                </div>
                                                            @endforeach    
                                                            </div>       
                                                       </div>
                                    </div> --}}


                                    {{-- <div class="md:col-span-2">
                                                        <label for="support_one">Nombre de soporte 1</label>
                                                        <div class="relative mb-2">
                                                            <div
                                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                                    fill="currentColor" viewBox="0 0 20 20"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                                                    </path>
                                                                    <path
                                                                        d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z">
                                                                    </path>
                                                                </svg>
                                                            </div>
                                                            <input type="text" id="support_one" name="support_one"
                                                                value="{{ $general->support_one }}"
                                                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                placeholder="Nombre de soporte 1">
                                                        </div>
                                    </div> --}}

                                    <div class="md:col-span-5">
                                        <label for="whatsapp">Whatsapp de soporte (sin
                                            guiones)</label>
                                        <div class="relative mb-3">
                                            <div
                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                    fill="currentColor" viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                                    </path>
                                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <input type="text" id="whatsapp" name="whatsapp"
                                                value="{{ $general->whatsapp }}"
                                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="+51987654321">
                                        </div>
                                    </div>

                                    {{-- <div class="md:col-span-2">
                                                        <label for="support_two">Nombre de soporte 2</label>
                                                        <div class="relative mb-2">
                                                            <div
                                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                                    fill="currentColor" viewBox="0 0 20 20"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                                                    </path>
                                                                    <path
                                                                        d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z">
                                                                    </path>
                                                                </svg>
                                                            </div>
                                                            <input type="text" id="support_two" name="support_two"
                                                                value="{{ $general->support_two }}"
                                                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                placeholder="Nombre de soporte 2">
                                                        </div>
                                    </div> --}}

                                    {{-- <div class="md:col-span-3">
                                                        <label for="whatsapp">Whatsapp de soporte 2 (sin
                                                            guiones)</label>
                                                        <div class="relative mb-3">
                                                            <div
                                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                                    fill="currentColor" viewBox="0 0 20 20"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                                                    </path>
                                                                    <path
                                                                        d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z">
                                                                    </path>
                                                                </svg>
                                                            </div>
                                                            <input type="text" id="whatsapp2" name="whatsapp2"
                                                                value="{{ $general->whatsapp2 }}"
                                                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                placeholder="+51987654321">
                                                        </div>
                                    </div> --}}


                                    <div class="md:col-span-5">
                                        <label for="mensaje_whatsapp">Mensaje predeterminado para
                                            Whastapp</label>
                                        <div class="relative mb-2">
                                            <div
                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                    fill="currentColor" viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                                    </path>
                                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <input type="text" id="mensaje_whatsapp" name="mensaje_whatsapp"
                                                value="{{ $general->mensaje_whatsapp }}"
                                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="+51 1234567">
                                        </div>
                                    </div>

                                    {{-- <div class="md:col-span-5">
                                                        <label for="schedule">Horario de Oficina</label>
                                                        <div class="relative mb-2">
                                                            <div
                                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                                    fill="currentColor" viewBox="0 0 20 20"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                                                    </path>
                                                                    <path
                                                                        d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z">
                                                                    </path>
                                                                </svg>
                                                            </div>
                                                            <input type="text" id="schedule" name="schedule"
                                                                value="{{ $general->schedule }}"
                                                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                placeholder="Horario de Oficina">
                                                        </div>
                                    </div> --}}

                                    <h2 class="md:col-span-5 text-lg font-semibold text-slate-800 mt-2 dark:text-white">
                                        Redes Sociales</h2>

                                    <div class="md:col-span-5">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-0">
                                            <div>
                                                <div class="relative">
                                                    <div
                                                        class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                            fill="currentColor" viewBox="0 0 20 20"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                                            </path>
                                                            <path
                                                                d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                    <input type="text" id="rs_facebook" name="facebook"
                                                        value="{{ $general->facebook }}"
                                                        class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="Facebook">
                                                </div>
                                            </div>

                                            <div>
                                                <div class="relative ">
                                                    <div
                                                        class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                            fill="currentColor" viewBox="0 0 20 20"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                                            </path>
                                                            <path
                                                                d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                    <input type="text" id="rs_instagram" name="instagram"
                                                        value="{{ $general->instagram }}"
                                                        class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="Instagram">
                                                </div>
                                            </div>

                                            {{--  <div>
                                                                <div class="relative ">
                                                                    <div
                                                                        class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                                            fill="currentColor" viewBox="0 0 20 20"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                                                            </path>
                                                                            <path
                                                                                d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z">
                                                                            </path>
                                                                        </svg>
                                                                    </div>
                                                                    <input type="text" id="rs_youtube"
                                                                        name="youtube"
                                                                        value="{{ $general->youtube }}"
                                                                        class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                        placeholder="Youtube">
                                                                </div>
                                                            </div> --}}

                                            <div>

                                                <div class="relative">
                                                    <div
                                                        class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                            fill="currentColor" viewBox="0 0 20 20"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                                            </path>
                                                            <path
                                                                d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                    <input type="text" id="rs_twitter" name="twitter"
                                                        value="{{ $general->twitter }}"
                                                        class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="Twitter">
                                                </div>
                                            </div>

                                            {{--  <div>
                                                <div class="relative ">
                                                    <div
                                                        class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                            fill="currentColor" viewBox="0 0 20 20"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                                            </path>
                                                            <path
                                                                d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                    <input type="text" id="rs_tiktok" name="tiktok"
                                                        value="{{ $general->tiktok }}"
                                                        class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="Tik Tok">
                                                </div>
                                            </div> --}}

                                            <div>
                                                <div class="relative ">
                                                    <div
                                                        class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                            fill="currentColor" viewBox="0 0 20 20"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                                            </path>
                                                            <path
                                                                d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                    <input type="text" id="rs_linkedin" name="linkedin"
                                                        value="{{ $general->linkedin }}"
                                                        class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="Linkedin">
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    {{-- <h2 class="md:col-span-5 text-lg font-semibold text-slate-800 mt-2 dark:text-white">
                                     Descripción de la empresa</h2> --}}

                                    {{-- <div class="md:col-span-5">
                                                        <label for="aboutus">Acerca de nosotros</label>
                                                        <div class="relative mb-2">
                                                            <x-textarea name="aboutus"
                                                                value="{!! $general->aboutus !!}" />
                                                        </div>
                                    </div> --}}

                                    <!-- <div class="md:col-span-2">
                                                        <label for="city">City</label>
                                                        <input type="text" name="city" id="city" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" placeholder="" />
                                    </div> -->

                                    <!-- <div class="md:col-span-2">
                                                        <label for="country">Country / region</label>
                                                        <div class="h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                                                        <input name="country" id="country" placeholder="Country" class="px-4 appearance-none outline-none text-gray-800 w-full bg-transparent" value="" />
                                                        <button tabindex="-1" class="cursor-pointer outline-none focus:outline-none transition-all text-gray-300 hover:text-red-600">
                                                            <svg class="w-4 h-4 mx-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                                            </svg>
                                                        </button>
                                                        <button tabindex="-1" for="show_more" class="cursor-pointer outline-none focus:outline-none border-l border-gray-200 transition-all text-gray-300 hover:text-blue-600">
                                                            <svg class="w-4 h-4 mx-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"></polyline></svg>
                                                        </button>
                                                        </div>
                                    </div> -->

                                    <!-- <div class="md:col-span-2">
                                                        <label for="state">State / province</label>
                                                        <div class="h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                                                        <input name="state" id="state" placeholder="State" class="px-4 appearance-none outline-none text-gray-800 w-full bg-transparent" value="" />
                                                        <button tabindex="-1" class="cursor-pointer outline-none focus:outline-none transition-all text-gray-300 hover:text-red-600">
                                                            <svg class="w-4 h-4 mx-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                                            </svg>
                                                        </button>
                                                        <button tabindex="-1" for="show_more" class="cursor-pointer outline-none focus:outline-none border-l border-gray-200 transition-all text-gray-300 hover:text-blue-600">
                                                            <svg class="w-4 h-4 mx-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"></polyline></svg>
                                                        </button>
                                                        </div>
                                    </div> -->

                                    <!-- <div class="md:col-span-5">
                                                        <div class="inline-flex items-center">
                                                        <input type="checkbox" name="billing_same" id="billing_same" class="form-checkbox" />
                                                        <label for="billing_same" class="ml-2">My billing address is different than above.</label>
                                                        </div>
                                    </div> -->

                                    <div class="md:col-span-5 text-right mt-6">
                                        <div class="inline-flex items-end">
                                            <button type="submit" id="form_general"
                                                onclick="confirmarActualizacion()"
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">Actualizar
                                                datos</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>

    <script src="/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('mapa', {
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
    <script>
        $('document').ready(function() {

            tinymce.init({
                selector: 'textarea#description',
                height: 500,
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'charmap', 'preview',
                    'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'table'
                ],
                toolbar: 'undo redo | blocks | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px;}'
            });
            // Función para mostrar la alerta de confirmación antes de enviar el formulario
            function confirmarActualizacion() {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: 'Esta acción actualizará los datos.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, actualizar',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Envía el formulario si se confirma la acción
                        document.getElementById('form_general').submit();
                    }
                });
            }


            function mostrarAlerta() {
                Swal.fire({
                    title: '¡Actualizado!',
                    text: 'Los datos se han actualizado correctamente.',
                    icon: 'success',
                    confirmButtonText: 'Aceptar',
                });
            }


        });
    </script>
    <script>
        let valorInput = 0

        $('document').ready(function() {

            const existingInputs = document.querySelectorAll("input[name^='Nombre-']");

            if (existingInputs.length > 0) {
                // Encontrar el valor numérico más alto en los names existentes
                existingInputs.forEach(input => {
                    const nameParts = input.name.split('-');
                    const number = parseInt(nameParts[1], 10);
                    if (number > valorInput) {
                        valorInput = number;
                    }
                });
            }

            $("#AddEspecifiacion").on('click', function(e) {
                e.preventDefault()
                valorInput++
                console.log('agregando especificacion')
                const addButton = document.getElementById("AddEspecifiacion");
                const divFlex = document.createElement("div");
                // const dRelative = document.createElement("div");
                const dRelative2 = document.createElement("div");
                const dRelative3 = document.createElement("div");
                const dRelative4 = document.createElement("div");

                divFlex.classList.add('flex', 'gap-2')
                // dRelative.classList.add('relative', 'mb-2', 'mt-2','w-full', 'md:w-1/2', 'lg:w-1/4')
                dRelative2.classList.add('relative', 'mb-2', 'mt-2', 'w-full', 'md:w-full', 'lg:w-1/3')
                dRelative3.classList.add('relative', 'mb-2', 'mt-2', 'w-full', 'md:w-full', 'lg:w-1/3')
                dRelative4.classList.add('relative', 'mb-2', 'mt-2', 'w-full', 'md:w-full', 'lg:w-1/3')

                const iconContainer = document.createElement("div");
                const icon = `<div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg"
                      version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0"
                      y="0" viewBox="0 0 469.336 469.336" style="enable-background:new 0 0 512 512"
                      xml:space="preserve" class="">
                      <g>
                        <path
                          d="m456.836 76.168-64-64.054c-16.125-16.139-44.177-16.17-60.365.031L45.763 301.682a10.733 10.733 0 0 0-2.688 4.587L.409 455.73a10.682 10.682 0 0 0 10.261 13.606c.979 0 1.969-.136 2.927-.407l149.333-42.703a10.714 10.714 0 0 0 4.583-2.69l289.323-286.983c8.063-8.069 12.5-18.787 12.5-30.192s-4.437-22.124-12.5-30.193zM285.989 89.737l39.264 39.264-204.996 204.997-14.712-29.434a10.671 10.671 0 0 0-9.542-5.896H78.921L285.989 89.737zm-259.788 353.4L40.095 394.5l34.742 34.742-48.636 13.895zm123.135-35.177-51.035 14.579-51.503-51.503 14.579-51.035h28.031l18.385 36.771a10.671 10.671 0 0 0 4.771 4.771l36.771 18.385v28.032zm21.334-17.543v-17.082c0-4.042-2.281-7.729-5.896-9.542l-29.434-14.712 204.996-204.996 39.264 39.264-208.93 207.068zM441.784 121.72l-47.033 46.613-93.747-93.747 46.582-47.001c8.063-8.063 22.104-8.063 30.167 0l64 64c4.031 4.031 6.25 9.385 6.25 15.083s-2.219 11.052-6.219 15.052z"
                          fill="#9F9F9F" opacity="1" data-original="#000000" class=""></path>
                      </g>
                    </svg>
                  </div>`
                iconContainer.innerHTML = icon;

                // Obtener el nodo del icono
                const iconNode = iconContainer.firstChild;



                // const inputArea = document.createElement("select");
                const inputName = document.createElement("input");
                const inputPhone = document.createElement("input");
                const inputEmail = document.createElement("input");

                // let inputA = agregarElementoSelect(inputArea, valorInput, 'Area')
                let inputN = agregarElementos(inputName, valorInput, 'Nombre')
                let inputC = agregarElementos(inputPhone, valorInput, 'Celular')
                let inputE = agregarElementos(inputEmail, valorInput, 'Email')


                // dRelative.appendChild(inputA);
                dRelative2.appendChild(inputN);
                dRelative3.appendChild(inputC);
                dRelative4.appendChild(inputE);


                // Agregar el icono como primer hijo de dRelative
                //dRelative.insertBefore(iconNode, inputA);

                // Clonar el nodo del icono para agregarlo como primer hijo de dRelative2
                const iconNodeCloned = iconNode.cloneNode(true);
                dRelative2.insertBefore(iconNodeCloned, inputN);

                const iconNodeCloned2 = iconNode.cloneNode(true);
                dRelative3.insertBefore(iconNodeCloned2, inputC);

                const iconNodeCloned3 = iconNode.cloneNode(true);
                dRelative4.insertBefore(iconNodeCloned3, inputE);


                //divFlex.appendChild(dRelative);
                divFlex.appendChild(dRelative2);
                divFlex.appendChild(dRelative3);
                divFlex.appendChild(dRelative4);

                const parentContainer = addButton.parentElement
                    .parentElement; // Obtener el contenedor padre
                parentContainer.insertBefore(divFlex, addButton.parentElement
                    .nextSibling); // Insertar el input antes del siguiente elemento después del botón



            })
        })

        function agregarElementos(elemento, valorInput, name) {
            elemento.setAttribute("type", "text");
            elemento.setAttribute("name", `${name}-${valorInput}`);
            elemento.setAttribute("placeholder", `${capitalizeFirstLetter(name)}`);
            elemento.setAttribute("id", `${name}-${valorInput}`);
            //elemento.setAttribute("id", `${name}-${valorInput}`);
            //elemento.setAttribute("id", `${name}-${valorInput}`);

            elemento.classList.add("mt-1", "bg-gray-50", "border", "border-gray-300", "text-gray-900", "text-sm",
                "rounded-lg",
                "focus:ring-blue-500", "focus:border-blue-500", "block", "w-full", "pl-10", "p-2.5",
                "dark:bg-gray-700",
                "dark:border-gray-600", "dark:placeholder-gray-400", "dark:text-white",
                "dark:focus:ring-blue-500",
                "dark:focus:border-blue-500");

            return elemento
        }


        function agregarElementoSelect(elemento, valorInput, name) {
            elemento.setAttribute("type", "text");
            elemento.setAttribute("name", `${name}-${valorInput}`);
            elemento.setAttribute("placeholder", `${capitalizeFirstLetter(name)}`);
            elemento.setAttribute("id", `${name}-${valorInput}`);

            let valorAtributo = [{
                    id: 1,
                    name: "Dirección"
                },
                {
                    id: 2,
                    name: "Teléfono"
                },
                {
                    id: 3,
                    name: "Email"
                }
            ];

            const optionElement = document.createElement("option");
            optionElement.setAttribute("value", "0");
            optionElement.textContent = name == 'Area' ? 'Seleccione tipo' : " ";
            elemento.appendChild(optionElement);

            valorAtributo.forEach(optionText => {

                const optionElement = document.createElement("option");
                optionElement.setAttribute("value", optionText.id);
                optionElement.textContent = optionText.name;
                elemento.appendChild(optionElement);

            });

            elemento.classList.add("mt-1", "bg-gray-50", "border", "border-gray-300", "text-gray-900", "text-sm",
                "rounded-lg",
                "focus:ring-blue-500", "focus:border-blue-500", "block", "w-full", "pl-10", "p-2.5",
                "dark:bg-gray-700",
                "dark:border-gray-600", "dark:placeholder-gray-400", "dark:text-white",
                "dark:focus:ring-blue-500",
                "dark:focus:border-blue-500");

            return elemento
        }

        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
    </script>



</x-app-layout>
