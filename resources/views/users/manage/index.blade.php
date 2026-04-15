<x-videos-app-layout>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Gestió d'Usuaris</h1>
            @can('create-users')
                <a href="{{ route('users.manage.create') }}"
                   data-qa="add-user-btn"
                   class="px-4 py-2 text-sm bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors font-medium">
                    + Afegir usuari
                </a>
            @endcan
        </div>

        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200" data-qa="users-table">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Super Admin</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Accions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($users as $user)
                        <tr data-qa="user-row-{{ $user->id }}">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $user->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $user->email }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $user->isSuperAdmin() ? 'Sí' : 'No' }}
                            </td>
                            <td class="px-6 py-4 text-right text-sm font-medium">
                                <div class="flex justify-end gap-2">
                                    @can('edit-users')
                                        <a href="{{ route('users.manage.edit', $user) }}"
                                           data-qa="edit-user-{{ $user->id }}"
                                           class="text-blue-600 hover:text-blue-800">Editar</a>
                                    @endcan
                                    @can('delete-users')
                                        <a href="{{ route('users.manage.delete', $user) }}"
                                           data-qa="delete-user-{{ $user->id }}"
                                           class="text-red-600 hover:text-red-800">Eliminar</a>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                                No hi ha usuaris registrats.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-videos-app-layout>
