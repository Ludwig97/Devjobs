<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
   
    @forelse ($vacantes as $vacante)
        <div class="p-6 text-gray-900 dark:text-gray-100 md:flex md:justify-between md:items-center">
            <div class="space-y-3">
                <a href="{{ route('vacantes.show', $vacante->id ) }}" class="text-xl font-bold">
                    {{ $vacante->titulo }}
                </a>
                <p class="text-sm text-gray-200 font-bold">{{ $vacante->empresa }}</p>
                <p class="text-sm text-gray-100">Ultimo dia: {{ $vacante->ultimo_dia }}</p>
            </div>

            <div class="flex flex-col md:flex-row items-stretch text-center gap-3  mt-5 md:mt-0">
                <a href="#"
                    class="bg-slate-300 py-2 px-4 rounded-lg text-black text-xs font-bold uppercase text-center">
                Candidatos
                </a>

                <a href="{{ route('vacantes.edit', $vacante->id) }}"
                        class="bg-blue-800 py-2 px-4 rounded-lg text-black text-xs font-bold uppercase text-center">
                Editar
                </a>

                <button 
                    wire:click="$dispatch('mostrarAlerta', {{ $vacante->id }})"
                    class="bg-red-600 py-2 px-4 rounded-lg text-black text-xs font-bold uppercase text-center">
                    Eliminar
                </button>
                 
            </div>

        </div>
    @empty
        <p class="p-3 text-center text-sm text-white">No hay vacantes que mostrar</p>
    @endforelse

    <div class="flex justify-center mt-10">
        {{ $vacantes->links() }}
    </div>
</div>
@push('scripts')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        Livewire.on('mostrarAlerta', vacanteId => {
            Swal.fire({
            title: 'Eliminar Vacante?',
            text: "Una vacante eliminada, no se puede recuperar",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Eliminar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                //eliminar la vacante
                Livewire.dispatch('eliminarVacante', {vacante: vacanteId})
                Swal.fire(
                    'Se Elimino la Vacante!',
                    'Eliminado Correctamente.',
                    'success'
            )
        }
        })
        })
        
    </script>
    
@endpush


