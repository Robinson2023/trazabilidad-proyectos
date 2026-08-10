<div class="w-full bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">

    <div class="flex flex-row items-stretch">

        {{-- IMAGEN --}}
        <div class="w-52 flex-shrink-0 bg-gray-100
                    flex items-center justify-center p-4">

            @if($product->image)

                <img
                    src="{{ asset('storage/products/'.$product->image) }}"
                    alt="{{ $product->name }}"
                    class="w-20 h-30 object-cover rounded-xl shadow">

            @else

                <div class="w-25 h-45 rounded-xl bg-gray-300
                            flex items-center justify-center">

                    <span class="text-6xl">
                        📦
                    </span>

                </div>

            @endif

        </div>


        {{-- INFORMACIÓN --}}
        <div class="flex-1 p-6 min-w-0">

            <h2 class="text-2xl font-bold text-gray-800">
                {{ $product->name }}
            </h2>

            <p class="text-gray-500 mt-2">
                {{ Str::limit($product->description, 180) }}
            </p>

            <div class="flex items-center gap-12 mt-6">

                {{-- ETAPAS --}}
                <div>

                    <p class="text-sm text-gray-500">
                        Etapas
                    </p>

                    <p class="text-2xl font-bold text-gray-800">
                        {{ $product->steps_count }}
                    </p>

                </div>


                {{-- ESTADO --}}
                <div>

                    <p class="text-sm text-gray-500">
                        Estado
                    </p>

                    @if($product->active)

                        <p class="text-lg font-semibold text-green-600">
                            🟢 Activo
                        </p>

                    @else

                        <p class="text-lg font-semibold text-red-600">
                            🔴 Inactivo
                        </p>

                    @endif

                </div>

            </div>

        </div>


        {{-- ACCIONES --}}
        <div class="w-64 flex-shrink-0 p-6
                    flex flex-col justify-center gap-3
                    border-l border-gray-200">

            <a
                href="{{ route('products.edit',$product) }}"
                class="w-full rounded-lg bg-amber-500
                       hover:bg-amber-600 text-black
                       text-center py-3 font-semibold">

                ✏️ Editar

            </a>


            <a
                href="{{ route('products.steps.index',$product) }}"
                class="w-full rounded-lg bg-blue-600
                       hover:bg-blue-700 text-white
                       text-center py-3 font-semibold">

                ⚙️ Administrar procesos

            </a>


            <form
                action="{{ route('products.destroy',$product) }}"
                method="POST">

                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    onclick="return confirm('¿Eliminar este producto?')"
                    class="w-full rounded-lg bg-red-600
                           hover:bg-red-700 text-white
                           py-3 font-semibold">

                    🗑️ Eliminar

                </button>

            </form>

        </div>

    </div>

</div>