@extends('components.public.matrix', ['pagina' => 'Inicio'])
@section('titulo', 'Inicio')
@section('css_importados')



    <style>
        .swiper-pagination-numbers .swiper-pagination-bullet {
            width: 22px;
            height: 8px;
            border-radius: 0px;
            background-color: #18C991 !important;
        }

        .swiper-pagination-numbers .swiper-pagination-bullet:not(.swiper-pagination-bullet-active) {

            background-color: #A9F1D1 !important;
            opacity: 1;
        }

        /* Estilos para el modal */
        #modalTerms {
            transition: opacity 0.3s ease;
        }

        #modalContent {
            max-height: 70vh;
            overflow-y: auto;
            padding-right: 1rem;
        }

        #modalContent::-webkit-scrollbar {
            width: 8px;
        }

        #modalContent::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        #modalContent::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        #modalContent::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Estilos para los enlaces del modal */
        .open-modal {
            transition: color 0.2s ease;
        }

        .open-modal:hover {
            color: #18C991;

        }
    </style>

    <main>
        <div class="absolute top-0 left-0 opacity-70 w-full z-50 hidden ">
            <img src="{{ asset('images/images/back_d.png') }}" alt="" class="w-full h-auto">
        </div>
        <!--Cintillo superior-->
        <section class="bg-morado py-3 text-white flex justify-around md:justify-center md:gap-x-16 md:text-2xl md:py-4">

            <a href="tel:{{ $general[0]->cellphone }}" class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
                    <path
                        d="M5.5 9C5.5 5.70017 5.5 4.05025 6.52513 3.02513C7.55025 2 9.20017 2 12.5 2C15.7998 2 17.4497 2 18.4749 3.02513C19.5 4.05025 19.5 5.70017 19.5 9V15C19.5 18.2998 19.5 19.9497 18.4749 20.9749C17.4497 22 15.7998 22 12.5 22C9.20017 22 7.55025 22 6.52513 20.9749C5.5 19.9497 5.5 18.2998 5.5 15V9Z"
                        stroke="white" stroke-width="1.5" stroke-linecap="round" />
                    <path d="M11.5 19H13.5" stroke="white" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path
                        d="M9.5 2L9.589 2.53402C9.78188 3.69129 9.87832 4.26993 10.2752 4.62204C10.6892 4.98934 11.2761 5 12.5 5C13.7239 5 14.3108 4.98934 14.7248 4.62204C15.1217 4.26993 15.2181 3.69129 15.411 2.53402L15.5 2"
                        stroke="white" stroke-width="1.5" stroke-linejoin="round" />
                </svg>
                <span class="hidden md:block mr-2">Llámanos: </span>{{ $general[0]->cellphone }}
            </a>

            <a href="mailto:{{ $general[0]->email }}" class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
                    <path
                        d="M11 19.5C10.5337 19.4939 10.0668 19.485 9.59883 19.4732C6.45033 19.3941 4.87608 19.3545 3.74496 18.2184C2.61383 17.0823 2.58114 15.5487 2.51577 12.4814C2.49475 11.4951 2.49474 10.5147 2.51576 9.52843C2.58114 6.46113 2.61382 4.92748 3.74495 3.79139C4.87608 2.6553 6.45033 2.61573 9.59882 2.53658C11.5393 2.4878 13.4607 2.48781 15.4012 2.53659C18.5497 2.61574 20.1239 2.65532 21.255 3.79141C22.3862 4.92749 22.4189 6.46114 22.4842 9.52844C22.4939 9.98251 22.4991 10.1965 22.4999 10.5"
                        stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M2.5 5L9.41302 8.92462C11.9387 10.3585 13.0613 10.3585 15.587 8.92462L22.5 5" stroke="white"
                        stroke-width="1.5" stroke-linejoin="round" />
                    <path
                        d="M19.5 17C19.5 17.8284 18.8284 18.5 18 18.5C17.1716 18.5 16.5 17.8284 16.5 17C16.5 16.1716 17.1716 15.5 18 15.5C18.8284 15.5 19.5 16.1716 19.5 17ZM19.5 17V17.5C19.5 18.3284 20.1716 19 21 19C21.8284 19 22.5 18.3284 22.5 17.5V17C22.5 14.5147 20.4853 12.5 18 12.5C15.5147 12.5 13.5 14.5147 13.5 17C13.5 19.4853 15.5147 21.5 18 21.5"
                        stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span class="hidden md:block mr-2">Email: </span>{{ $general[0]->email }}
            </a>

        </section>

        <!--Logo-->
        <section class="py-5 flex justify-center">
            <img src="{{ asset('images/images/Logo-Qallpa.svg') }}" alt="">
        </section>

        <!--Fomrulario-->
        <section class="bg-cover pt-6 px-4 text-white md:py-20 md:px-0"
            style="background-image: url('{{ asset('images/images/Imagen-Hero.png') }}');">
            <section class="flex-none md:flex md:justify-center md:gap-x-10 md:px-36">
                <!-- Primer elemtno -->
                <div class=" flex-none md:flex items-center md:w-3/5">
                    <div class="text-wrap">
                        <h2 class="text-4xl md:text-7xl md:leading-24" id="titulo">
                            Tu Socio Estratégico en Contabilidad y Finanzas
                        </h2>
                        <p class="mt-4 text-xl md:text-4xl md:leading-12" id="subtitulo">
                            En Qallpa Consultores & Asociados SAC, ofrecemos asesoria integral en contabilidad
                        </p>

                        <section class="py-6 hidden md:block" id="slogan">
                            <p class="text-xl w-2/3 md:text-2xl mt-18">¡Hablmeos! recibe una consulta gratuita.</p>
                        </section>
                    </div>
                </div>


                <!-- El segundo elemento -->
                <div class="md:w-2/5  px-0 md:px-16 lg:px-8">
                    <div class="bg-white mt-8 p-5 rounded-2xl md:mt-0 md:p-6 md:*:rounded-4xl " id="fomulario">
                        <h2 class="text-4xl lg:text-3xl text-black pb-2">¿Que servicio <span
                                class="text-verdeo">contable</span>
                            necesitas?
                        </h2>

                        <form id="dataWhatsapp">
                            @csrf
                            <div class="mt-5 grid grid-cols-4 gap-2 md:gap-4">

                                <div class="col-span-4 mt-4 lg:mt-0">
                                    <div class="relative">
                                        <input type="text" id="full_name" name="full_name"
                                            class="
        peer
        w-full
        rounded-lg
        bg-white
        px-3
        py-4
        text-base
        text-gray-900
        outline
        outline-1
        outline-gray-300
        -outline-offset-1
        transition-all
        duration-200
        placeholder-transparent
        focus:outline-none
        focus:-outline-offset-2
        focus:outline-verdeo
        focus:border-green-400
        focus:ring-0
        md:py-4
      "
                                            placeholder="Nombre completo" />
                                        <label for="full_name"
                                            class="
        absolute
        left-3
        -top-3
        bg-white
        px-1
        text-sm
        text-verdeo
        transition-all
        duration-200
        peer-placeholder-shown:top-1/2
        peer-placeholder-shown:-translate-y-1/2
        peer-placeholder-shown:text-sm
        peer-placeholder-shown:text-gray-500
        peer-focus:-top-1
        peer-focus:text-sm
        peer-focus:text-verdeo
      ">
                                            Nombre completo<span class="text-verdeo">*</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-span-2 mt-4 lg:mt-0">

                                    <div class=" relative">
                                        <select id="country_code" name="country_code" required
                                            class="
                      select_landing
                      peer
                      block
                      w-full
                      rounded-lg
                      bg-white
                      px-3
                      py-4
                      text-base
                      text-gray-900
                      outline-1
                      -outline-offset-1 
                      outline-gray-300 
                      
                      focus:outline-2
                      focus:-outline-offset-2 
                      focus:outline-verdeo
                      focus:border-green-400
                      sm:text-sm/6
                      md:py-10
                      ">
                                            <option selected></option>
                                            <option value="US">+51</option>
                                            <option value="CA">+57</option>
                                            <option value="FR">+58</option>
                                            <option value="DE">+16</option>
                                        </select>

                                        <label for="country_code"
                                            class="
                          text-xs
                          peer-valid:-top-2
                          text-verdeo absolute left-2 top-2 bg-white px-1 transition-all">Codigo
                                            del País*
                                        </label>

                                    </div>


                                </div>

                                <div class="col-span-2 mt-4 lg:mt-0">
                                    <div class=" relative">
                                        <input type="text" name="phone" id="phone" placeholder=" "
                                            autocomplete="given-name"
                                            class="
                      peer
        w-full
        rounded-lg
        bg-white
        px-3
        py-4
        text-base
        text-gray-900
        outline
        outline-1
        outline-gray-300
        -outline-offset-1
        transition-all
        duration-200
        placeholder-transparent
        focus:outline-none
        focus:-outline-offset-2
        focus:outline-verdeo
        focus:border-green-400
        focus:ring-0
        md:py-4
                      ">

                                        <label for="phone"
                                            class="
                      absolute
        left-3
        -top-3
        bg-white
        px-1
        text-sm
        text-verdeo
        transition-all
        duration-200
        peer-placeholder-shown:top-1/2
        peer-placeholder-shown:-translate-y-1/2
        peer-placeholder-shown:text-sm
        peer-placeholder-shown:text-gray-500
        peer-focus:-top-1
        peer-focus:text-sm
        peer-focus:text-verdeo">Teléfono*</label>
                                    </div>
                                </div>




                                <div class="col-span-4 mt-4 lg:mt-0">
                                    <div class=" relative">
                                        <input type="text" name="email" id="email" placeholder=" "
                                            autocomplete="given-name"
                                            class="
                      peer
        w-full
        rounded-lg
        bg-white
        px-3
        py-4
        text-base
        text-gray-900
        outline
        outline-1
        outline-gray-300
        -outline-offset-1
        transition-all
        duration-200
        placeholder-transparent
        focus:outline-none
        focus:-outline-offset-2
        focus:outline-verdeo
        focus:border-green-400
        focus:ring-0
        md:py-4
                      ">

                                        <label for="email"
                                            class="
                    absolute
        left-3
        -top-3
        bg-white
        px-1
        text-sm
        text-verdeo
        transition-all
        duration-200
        peer-placeholder-shown:top-1/2
        peer-placeholder-shown:-translate-y-1/2
        peer-placeholder-shown:text-sm
        peer-placeholder-shown:text-gray-500
        peer-focus:-top-1
        peer-focus:text-sm
        peer-focus:text-verdeo">Correo
                                            electrónico*</label>
                                    </div>
                                </div>

                                <div class="col-span-4 mt-4 lg:mt-0">
                                    <div class=" relative">
                                        <input type="text" name="ruc" id="ruc" placeholder=" "
                                            autocomplete="given-name"
                                            class="
                     peer
        w-full
        rounded-lg
        bg-white
        px-3
        py-4
        text-base
        text-gray-900
        outline
        outline-1
        outline-gray-300
        -outline-offset-1
        transition-all
        duration-200
        placeholder-transparent
        focus:outline-none
        focus:-outline-offset-2
        focus:outline-verdeo
        focus:border-green-400
        focus:ring-0
        md:py-4
                      ">

                                        <label for="ruc"
                                            class="
                      absolute
        left-3
        -top-3
        bg-white
        px-1
        text-sm
        text-verdeo
        transition-all
        duration-200
        peer-placeholder-shown:top-1/2
        peer-placeholder-shown:-translate-y-1/2
        peer-placeholder-shown:text-sm
        peer-placeholder-shown:text-gray-500
        peer-focus:-top-1
        peer-focus:text-sm
        peer-focus:text-verdeo">RUC
                                            de la empresa*</label>
                                    </div>
                                </div>

                                <div class="col-span-4 mt-4 lg:mt-0 ">

                                    <div class=" relative">
                                        <select id="service_product" name="service_product"
                                            class="
                      peer
        w-full
        rounded-lg
        bg-white
        px-3
        py-4
        text-base
        text-gray-900
        outline
        outline-1
        outline-gray-300
        -outline-offset-1
        transition-all
        duration-200
        placeholder-transparent
        focus:outline-none
        focus:-outline-offset-2
        focus:outline-verdeo
        focus:border-green-400
        focus:ring-0
        md:py-4">

                                            <option value="Emprendedor Persona Natural (NRUS)">Emprendedor Persona Natural
                                                (NRUS)</option>
                                            <option value="Persona Natural o Jurídica (Paquete Básico - RMT)">Persona
                                                Natural o Jurídica (Paquete Básico - RMT)</option>
                                            <option
                                                value="Persona Natural o Jurídica (Régimen Especial de Impuesto a la Renta — RER)
">
                                                Persona Natural o Jurídica (Régimen Especial de Impuesto a la Renta — RER)
                                            </option>
                                            <option
                                                value="Persona Natural o Jurídica (Régimen General — Empresas Grandes)">
                                                Persona Natural o Jurídica (Régimen General — Empresas Grandes)</option>
                                            <option value="Persona Natural o Jurídica (MYPE - Empresas Medianas)">Persona
                                                Natural o Jurídica (MYPE - Empresas Medianas)</option>
                                        </select>

                                        <label for="service_product"
                                            class="
                         absolute
        left-3
        -top-3
        bg-white
        px-1
        text-sm
        text-verdeo
        transition-all
        duration-200
        peer-placeholder-shown:top-1/2
        peer-placeholder-shown:-translate-y-1/2
        peer-placeholder-shown:text-sm
        peer-placeholder-shown:text-gray-500
        peer-focus:-top-1
        peer-focus:text-sm
        peer-focus:text-verdeo">Tipo
                                            de Servicio*
                                        </label>

                                    </div>


                                </div>

                                <div class="col-span-4 mt-4 lg:mt-0">
                                    <button type="submit"
                                        class="w-full py-4 bg-verdeo text-white block rounded-xl text-center">Enviar
                                        solicitud</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>

            </section>

            <section class="py-6 md:hidden">
                <p class="text-center text-xl w-2/3 mx-auto">¡Hablmeos! recibe una consulta gratuita.</p>
            </section>

        </section>

        <section class="py-6 px-6 mt-6">
            <p class="text-4xl text-center leading-9 md:text-6xl md:leading-16 md:w-2/3 md:mx-auto">Más que Números: <br>
                <span class="text-verdeo">Beneficios</span> que Impulsan tu Negocio
            </p>
        </section>

        <!--Seccion sliders Benenficios-->
        <div class="w-4/5 lg:w-full mx-auto">

            <!-- primer swipper -->
            <section class="md:w-full md:p-x-180 mt-20">
                <div class="swiper numbers_swepper">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <!-- Slides -->
                        <div class="swiper-slide md:px-16">
                            <section class="text-center">
                                <img src="{{ asset('images/images/Cumplimiento 100% normativo.png') }}"
                                    alt="Cumplimiento 100% normativo" class="mx-auto h-24 w-24 object-cover">
                                <h2 class="mt-8 text-3xl">Cumplimiento 100% normativo</h2>
                                <p class="mt-3 text-xl px-6 leading-6">
                                    Evita sanciones y mantén tu contabilidad en regla connuestro asesoramiento.
                                </p>
                            </section>
                        </div>

                        <div class="swiper-slide md:px-16">
                            <section class="text-center">
                                <img src="{{ asset('images/images/Optimización de impuestos.png') }}"
                                    alt="Optimización de impuestos" class="mx-auto h-24 w-24 object-cover">
                                <h2 class="mt-8 text-3xl">Optimización de impuestos</h2>
                                <p class="mt-3 text-xl px-6 leading-6">
                                    Paga solo lo necesario con una planificación fiscal eficiente y estratégica.
                                </p>
                            </section>
                        </div>

                        <div class="swiper-slide md:px-16">
                            <section class="text-center">
                                <img src="{{ asset('images/images/Acompañamiento personalizado.png') }}"
                                    alt="Acompañamiento personalizado" class="mx-auto h-24 w-24 object-cover">
                                <h2 class="mt-8 text-3xl">Acompañamiento personalizado</h2>
                                <p class="mt-3 text-xl px-6 leading-6">
                                    Atención especializada según tu tipo de empresa y necesidades específicas.
                                </p>
                            </section>
                        </div>

                        <div class="swiper-slide md:px-16">
                            <section class="text-center">
                                <img src="{{ asset('images/images/Decisiones financieras seguras.png') }}"
                                    alt="Decisiones financieras seguras" class="mx-auto h-24 w-24 object-cover">
                                <h2 class="mt-8 text-3xl">Decisiones financieras seguras</h2>
                                <p class="mt-3 text-xl px-6 leading-6">
                                    Obtén estados contables claros y detallados para tomar mejores decisiones.
                                </p>
                            </section>
                        </div>







                    </div>


                </div>

                <!-- If we need pagination -->
                <section class="mt-14">
                    <div class="swiper-pagination-numbers text-center"></div>
                </section>

        </div>
        </section>
        <!--Seccion Servicios-->

        <section class="mt-10 py-6 px-2  md:p-32 overflow-x-hidden "
            style="background: linear-gradient(0deg, rgba(237, 252, 245, 0.20) 0%, #EDFCF5 100%);">
            <h2 class="text-3xl -tracking-tighter md:text-6xl md:w-8/12 text-[#1C1F33]">
                Soluciones Contables Tributarias y Laborables para <span class="text-verdeo">Impulsar tu Negocio</span>
            </h2>
            <p class="mt-8 text-xl leading-6 lg:leading-7 md:w-8/12 text-[#323653]">
                Deja la contabilidad en nuestras manos y enfócate en lo que mejor sabes hacer: hacer crecer tu empresa. Con
                nuestros servicios, tendrás tranquilidad financiera, cumplimiento normativo y optimización fiscal
                garantizada.
            </p>

            <div class="lg:hidden">
                <div class="swiper service_swepper mt-8  ">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <!-- Slides -->
                        <div class="swiper-slide">
                            <section class="text-center">
                                <img src="{{ asset('images/images/Emprendedor Persona Natural (NRUS).png') }}"
                                    alt="Emprendedor Persona Natural (NRUS)" class="mx-auto w-full h-72 object-cover ">
                            </section>
                            <section class="w-70 mx-auto mt-8">
                                <h2 class="text-4xl">Emprendedor Persona Natural (NRUS)</h2>
                                <p class="text-xl mt-3">Contabilidad simplificada para negocios con ingresos de hasta
                                    S/8,000 mensuales.</p>
                            </section>
                        </div>

                        <div class="swiper-slide">
                            <section class="text-center">
                                <img src="{{ asset('images/images/Persona Natural o Jurídica (Paquete Básico – RMT).png') }}"
                                    alt="Persona Natural o Jurídica (Paquete Básico – RMT)"
                                    class="mx-auto w-full h-72 object-cover ">
                            </section>
                            <section class="w-70 mx-auto mt-8">
                                <h2 class="text-4xl">Persona Natural o Jurídica (Paquete Básico – RMT)</h2>
                                <p class="text-xl mt-3">Gestión contable y tributaria para PYMEs, incluye libros
                                    electrónicos e impuestos.</p>
                            </section>
                        </div>

                        <div class="swiper-slide">
                            <section class="text-center">
                                <img src="{{ asset('images/images/Persona Natural o Jurídica (Régimen Especial de Impuesto a la Renta – RER).png') }}"
                                    alt="Persona Natural o Jurídica (Régimen Especial de Impuesto a la Renta – RER)"
                                    class="mx-auto w-full h-72 object-cover ">
                            </section>
                            <section class="w-70 mx-auto mt-8">
                                <h2 class="text-4xl">Persona Natural o Jurídica (Régimen Especial de Impuesto a la Renta –
                                    RER)</h2>
                                <p class="text-xl mt-3">Soluciones contables avanzadas, gestión de planillas y cumplimiento
                                    fiscal.</p>
                            </section>
                        </div>
                        <div class="swiper-slide">
                            <section class="text-center">
                                <img src="{{ asset('images/images/Persona Natural o Jurídica (Régimen General – Empresas Grandes).png') }}"
                                    alt="Persona Natural o Jurídica (Régimen General – Empresas Grandes)"
                                    class="mx-auto w-full h-72 object-cover ">
                            </section>
                            <section class="w-70 mx-auto mt-8">
                                <h2 class="text-4xl">Persona Natural o Jurídica (Régimen General – Empresas Grandes)</h2>
                                <p class="text-xl mt-3">Análisis financiero detallado, estrategias fiscales y auditoría
                                    contable.</p>
                            </section>
                        </div>
                        <div class="swiper-slide">
                            <section class="text-center">
                                <img src="{{ asset('images/images/Persona Natural o Jurídica (MYPE – Empresas Medianas).png') }}"
                                    alt="Persona Natural o Jurídica (MYPE – Empresas Medianas)"
                                    class="mx-auto w-full h-72 object-cover ">
                            </section>
                            <section class="w-70 mx-auto mt-8">
                                <h2 class="text-4xl">Persona Natural o Jurídica (MYPE – Empresas Medianas)</h2>
                                <p class="text-xl mt-3">Análisis financiero detallado, estrategias fiscales y auditoría
                                    contable.</p>
                            </section>
                        </div>


                    </div>

                    <!-- If we need navigation buttons -->
                    <section class="mt-14 flex justify-end gap-x-5">
                        <div class="service-prev rounded-full bg-verdec text-verdeo p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                            </svg>

                        </div>
                        <div class="service-next rounded-full bg-verdec text-verdeo p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>

                        </div>
                    </section>

                </div>
            </div>
            <div class="max-w-7xl mx-auto hidden lg:block mt-16">
                <!-- Primera fila - 3 tarjetas -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Tarjeta 1 -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-md">
                        <img src="{{ asset('images/images/Emprendedor Persona Natural (NRUS).png') }}"
                            alt="Emprendedor Persona Natural (NRUS)" class="w-full h-96 object-cover">
                        <div class="p-6">
                            <h2 class="text-2xl font-medium text-[#1C1F33] mb-2">Emprendedor Persona Natural (NRUS)</h2>
                            <p class="text-[#323653]">
                                Contabilidad simplificada para negocios con ingresos de hasta S/8,000 mensuales.
                            </p>
                        </div>
                    </div>

                    <!-- Tarjeta 2 -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-md">
                        <img src="{{ asset('images/images/Persona Natural o Jurídica (Paquete Básico – RMT).png') }}"
                            alt="Persona Natural o Jurídica (Paquete Básico – RMT)" class="w-full h-96 object-cover">
                        <div class="p-6">
                            <h2 class="text-2xl font-medium text-[#1C1F33] mb-2">Persona Natural o Jurídica (Paquete
                                Básico –
                                RMT)</h2>
                            <p class="text-[#323653]">
                                Gestión contable y tributaria para PYMEs, incluye libros electrónicos e impuestos.
                            </p>
                        </div>
                    </div>

                    <!-- Tarjeta 3 -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-md">
                        <img src="{{ asset('images/images/Persona Natural o Jurídica (Régimen Especial de Impuesto a la Renta – RER).png') }}"
                            alt="Persona Natural o Jurídica (Régimen Especial
                                de Impuesto a la Renta – RER)"
                            class="w-full h-96 object-cover ">
                        <div class="p-6">
                            <h2 class="text-2xl font-medium text-[#1C1F33] mb-2">Persona Natural o Jurídica (Régimen
                                Especial
                                de Impuesto a la Renta – RER)</h2>
                            <p class="text-[#323653]">
                                Soluciones contables avanzadas, gestión de planillas y cumplimiento fiscal.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Segunda fila - 2 tarjetas -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Tarjeta 4 -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-md">
                        <img src="{{ asset('images/images/Persona Natural o Jurídica (Régimen General – Empresas Grandes).png') }}"
                            alt="Persona Natural o Jurídica (Régimen General –
                                Empresas Grandes)"
                            class="w-full h-96 object-cover">
                        <div class="p-6">
                            <h2 class="text-2xl font-medium text-[#1C1F33] mb-2">Persona Natural o Jurídica (Régimen
                                General
                                –
                                Empresas Grandes)</h2>
                            <p class="text-[#323653]">
                                Análisis financiero detallado, estrategias fiscales y auditoría contable.
                            </p>
                        </div>
                    </div>

                    <!-- Tarjeta 5 -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-md">
                        <img src="{{ asset('images/images/Persona Natural o Jurídica (MYPE – Empresas Medianas).png') }}"
                            alt="Persona Natural o Jurídica (MYPE – Empresas
                                Medianas)"
                            class="w-full h-96 object-cover">
                        <div class="p-6">
                            <h2 class="text-2xl font-medium text-[#1C1F33] mb-2">Persona Natural o Jurídica (MYPE –
                                Empresas
                                Medianas)</h2>
                            <p class="text-[#323653]">
                                Análisis financiero detallado, estrategias fiscales y auditoría contable.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <section class="bg-verdeo p-6">
            <p class="text-center text-white leading-normal text-md">Nota : El costo de los servicios está sujeta a
                modificación, previa reunión con el cliente.</p>
        </section>

        <footer class="bg-morado px-4 pt-8 lg:pt-0 text-white">
            <section class="flex flex-col lg:flex-row justify-between max-w-7xl mx-auto lg:h-96 items-center">
                <div class="lg:w-7/12 ">
                    <div class="max-w-md ">
                        <img src="{{ asset('images/images/Logo-Qallpa-Footer.svg') }}" alt="">

                        <p class="mt-6 -tracking-tighter leading-6 text-md">
                            En Qallpa Consultores & Asociados SAC, ofrecemos asesoría integral en contabilidad, tributación
                            y gestión laboral para emprendedores y empresas en Perú.
                        </p>
                    </div>
                </div>

                <div class="w-full lg:w-3/12">
                    <h3 class="mt-14 text-lg font-bold lg:mt-0">
                        Políticas
                    </h3>
                    <ul class="flex flex-col gap-2">
                        <li>
                            <a href="#" class="open-modal" data-type="privacy"
                                data-content="{{ $politicDev->content ?? 'No hay contenido disponible' }}">
                                Políticas de privacidad
                            </a>
                        </li>
                        <li>
                            <a href="#" class="open-modal" data-type="changes"
                                data-content="{{ $polyticChange->content ?? 'No hay contenido disponible' }}">
                                Políticas de cambio
                            </a>
                        </li>
                        <li>
                            <a href="#" class="open-modal" data-type="terms"
                                data-content="{{ $termsAndCondicitions->content ?? 'No hay contenido disponible' }}">
                                Términos y condiciones
                            </a>
                        </li>

                    </ul>
                </div>

                <div class="w-full lg:w-2/12">
                    <h3 class="mt-8 text-lg font-bold lg:mt-0">
                        Contacto
                    </h3>
                    <ul class="flex flex-col gap-2">
                        <li><a href="tel:{{ $general[0]->cellphone }}">{{ $general[0]->cellphone }}</a></li>
                        <li><a href="mailto:{{ $general[0]->email }}">{{ $general[0]->email }}</a></li>
                        <li></li>
                    </ul>
                </div>



            </section>
            <div class="lg:flex mt-8 lg:mt-0 justify-between border-t border-white max-w-7xl mx-auto">
                <p class=" mt-8 text-sm font-medium lg:text-base ">
                    Copyright © 2025 Qallpa Consultores. Reservados todos los derechos.
                </p>

                <section class=" flex gap-x-3 py-3  lg:py-8">
                    @if ($general[0]->facebook)
                        <a href="{{ $general[0]->facebook }}" target="_blank" rel="noopener noreferrer"
                            class="cursor-pointer"><img src="{{ asset('images/images/face.svg') }}" alt=""></a>
                    @endif

                    @if ($general[0]->twitter)
                        <a href="{{ $general[0]->twitter }}" target="_blank" rel="noopener noreferrer"
                            class="cursor-pointer"><img src="{{ asset('images/images/twitter.svg') }}"
                                alt=""></a>
                    @endif

                    @if ($general[0]->linkedin)
                        <a href="{{ $general[0]->linkedin }}" target="_blank" rel="noopener noreferrer"
                            class="cursor-pointer"><img src="{{ asset('images/images/in.svg') }}" alt=""></a>
                    @endif
                    @if ($general[0]->instagram)
                        <a href="{{ $general[0]->instagram }}" target="_blank" rel="noopener noreferrer"
                            class="cursor-pointer"><img src="{{ asset('images/images/ins.svg') }}" alt=""></a>
                    @endif

                </section>
            </div>

            <!-- Modal Términos y Condiciones -->
            <div class="fixed inset-0 z-50 hidden" id="modalTerms" aria-modal="true" role="dialog">
                <!-- Fondo oscuro -->
                <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity -z-10" id="modalBackdrop"></div>

                <!-- Contenido del modal centrado -->
                <div
                    class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0 z-50">
                    <!-- Contenedor del modal -->
                    <div
                        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 ">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                    <h3 class="text-2xl leading-6 font-bold text-gray-900 mb-4" id="modalTitle">
                                        Términos y Condiciones
                                    </h3>
                                    <div class="mt-2 max-h-[70vh] overflow-y-auto">
                                        <div id="modalContent" class="prose">
                                            <!-- Contenido dinámico se cargará aquí -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="button"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                                id="closeModal">
                                Cerrar
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </footer>




        </body>

    @section('scripts_importados')
        <script>
            // Manejo del modal
            $(document).ready(function() {
                const modal = $('#modalTerms');
                const modalContent = $('#modalContent');
                const modalTitle = $('#modalTitle');

                // Abrir modal
                $('.open-modal').on('click', function(e) {
                    e.preventDefault();

                    const type = $(this).data('type');
                    const content = $(this).data('content');

                    // Configurar título según el tipo
                    let title = '';
                    switch (type) {
                        case 'privacy':
                            title = 'Políticas de Privacidad';
                            break;
                        case 'changes':
                            title = 'Políticas de Cambio';
                            break;
                        case 'terms':
                            title = 'Términos y Condiciones';
                            break;
                    }

                    modalTitle.text(title);
                    modalContent.html(content);
                    modal.removeClass('hidden');
                });

                // Cerrar modal
                $('#closeModal').on('click', function() {
                    modal.addClass('hidden');
                });

                // Cerrar al hacer clic fuera del contenido
                modal.on('click', function(e) {
                    if ($(e.target).is(modal)) {
                        modal.addClass('hidden');
                    }
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                //para el seelct 2
                $('.select_landing').select2({
                    dropdownCssClass: 'bg-orange-800',
                    selectionCssClass: 'peer block w-full rounded-lg bg-white px-3 py-4 text-base text-gray-900 outline-1 -outline-offset-1  outline-gray-300 focus:outline-2 focus:-outline-offset-2  focus:outline-verdeo sm:text-sm/6 !h-14 md:!py-6',
                    //minimumResultsForSearch: -1
                });

                //using Timeline
                const tl = gsap.timeline({
                        repeat: -1,
                        loop: true,
                        repeatDelay: 6
                    })
                    .from("#titulo", {
                        x: -332,
                        duration: 1,
                        ease: "bounce.out",
                        duration: 1,
                        opacity: 0
                    })
                    .from("#subtitulo", {
                        x: -330,
                        duration: 1,
                        ease: "bounce.out",
                        duration: 2,
                        opacity: 0
                    })
                    .from("#slogan", {
                        x: -330,
                        duration: 1,
                        ease: "bounce.out",
                        duration: 2,
                        opacity: 0
                    });

                gsap.from("#fomulario", {
                    scale: 1.4,
                    ease: "bounce.out",
                    duration: 2,
                    opacity: 0
                });


                //llamamoe el jSon con los codigos





                // Cargar códigos de país desde el JSON
                $.getJSON('/libs/prefijocelular.json', function(data) {
                    const $select = $('#country_code');
                    $select.empty().append('<option selected></option>'); // Opción vacía inicial

                    // Añadir cada país con su bandera
                    data.forEach(function(item) {
                        const isoCode = item.isoCode.ISO1.toLowerCase(); // Ej: "af" para Afganistán
                        const banderaUrl =
                            `https://flagcdn.com/24x18/${isoCode}.png`; // Imagen de 24x18px

                        $select.append(`
                <option 
                    value="${item.realCode}" 
                    data-iso="${isoCode}" 
                    data-beautycode="${item.beautyCode}"
                >
                    ${item.beautyCode} | ${item.country}
                </option>
            `);
                    });
                    $select.val('51').trigger('change');

                    // Inicializar Select2 con banderas
                    $select.select2({

                        templateResult: formatOption, // Cómo se ven las opciones en el dropdown
                        templateSelection: formatOption, // Cómo se ve la selección actual
                        escapeMarkup: function(m) {
                            return m;
                        }, // Permite HTML en las opciones
                        dropdownCssClass: 'select2-with-flags',
                        selectionCssClass: 'peer block w-full rounded-lg bg-white px-3 py-4 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-verdeo sm:text-sm/6 !h-14 md:!py-4'
                    });
                });

                // Función para mostrar banderas en Select2
                function formatOption(option) {
                    if (!option.id) return option.text; // Opción vacía

                    const isoCode = $(option.element).data('iso');
                    const beautyCode = $(option.element).data('beautycode');
                    const countryName = option.text.split('|')[1]?.trim() || '';

                    // Si es la selección actual (cuando el dropdown está cerrado)
                    if (option.selected) {
                        return $(`
                <span class="flex items-center">
                    <img src="https://flagcdn.com/24x18/${isoCode}.png" class="w-6 h-4 mr-2" alt="${countryName}">
                    <span>${beautyCode}</span>
                </span>
            `);
                    }

                    // Opciones del dropdown
                    return $(`
            <span class="flex items-center">
                <img src="https://flagcdn.com/24x18/${isoCode}.png" class="w-6 h-4 mr-2" alt="${countryName}">
                <span>${beautyCode}</span>
            </span>
        `);
                }

                // Resto de tu código (Select2, GSAP, Swiper, etc.)
                $('.select_landing').select2({
                    dropdownCssClass: 'bg-orange-800',
                    selectionCssClass: 'peer block w-full rounded-lg bg-white px-3 py-4 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-verdeo sm:text-sm/6 !h-14 md:!py-6',
                });

                // Animaciones GSAP y Swiper...


            });


            const swiper = new Swiper('.numbers_swepper', {
                // Optional parameters
                //centeredSlides:true,
                //spaceBetween:100,
                loop: true,
                autoplay: true,
                duration: .64,

                // If we need pagination
                pagination: {
                    el: '.swiper-pagination-numbers',
                    clickable: true,
                },

                // Navigation arrows
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },

                breakpoints: {
                    640: {
                        slidesPerView: 1,
                    },
                    1024: {
                        slidesPerView: 3,

                    },
                },

                // And if we need scrollbar
                scrollbar: {
                    el: '.swiper-scrollbar',
                },
            });

            const service_swiper = new Swiper('.service_swepper', {
                // Optional parameters
                loop: true,

                // If we need pagination
                pagination: {
                    el: '.swiper-pagination',
                },

                // Navigation arrows
                navigation: {
                    nextEl: '.service-next',
                    prevEl: '.service-prev',
                },

                // And if we need scrollbar
                scrollbar: {
                    el: '.swiper-scrollbar',
                },
            });
        </script>

    @stop

@stop
