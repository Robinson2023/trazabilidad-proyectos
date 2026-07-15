<div class="width:320px;background:red background:red rounded-2xl shadow-lg border border-gray-200 overflow-hidden hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">

    {{-- Imagen --}}
    <div class="bg-gray-100 h-52 flex items-center justify-center">

        @if($product->image)

            <img
                src="{{ asset('storage/products/'.$product->image) }}"
                alt="{{ $product->name }}"
                class="h-40 w-40 object-cover rounded-xl shadow">

        @else

            <div class="h-40 w-40 rounded-xl bg-gray-300 flex items-center justify-center">

                <span class="text-7xl">

                    📦

                </span>

            </div>

        @endif

    </div>

    {{-- Información --}}
    <div class="p-6">

        <h2 class="text-xl font-bold text-gray-800 text-center">

            {{ $product->name }}

        </h2>

        <p class="text-gray-500 text-center mt-3 min-h-[50px]">

            {{ Str::limit($product->description,70) }}

        </p>

        <br>

        <div class="border-t my-5"></div>

        <div class="space-y-3">

            <div class="flex justify-between">

                <span class="text-gray-500">

                    Etapas

                </span>

                <strong>

                    {{ $product->steps_count }}

                </strong>

            </div>

            <div class="flex justify-between">

                <span class="text-gray-500">

                    Estado

                </span>

                @if($product->active)

                    <span class="font-semibold text-green-600">

                        🟢 Activo

                    </span>

                @else

                    <span class="font-semibold text-red-600">

                        🔴 Inactivo

                    </span>

                @endif

            </div>

        </div>

    </div>

    {{-- Botones --}}
    <div class="px-6 pb-6 space-y-3">

        <a
            href="{{ route('products.edit',$product) }}"
            class="block w-full rounded-lg bg-amber-500 hover:bg-amber-600 text-black text-center py-2 font-semibold">

            ✏ Editar

        </a>

        <a
            href="{{ route('products.steps.index',$product) }}"
            class="block w-full rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-center py-2 font-semibold">

            ⚙ Administrar procesos

        </a>

        <form
            action="{{ route('products.destroy',$product) }}"
            method="POST">

            @csrf
            @method('DELETE')

            <button
                onclick="return confirm('¿Eliminar este producto?')"
                class="w-full rounded-lg bg-red-600 hover:bg-red-700 text-white py-2 font-semibold">

                🗑 Eliminar

            </button>

        </form>

    </div>

</div>