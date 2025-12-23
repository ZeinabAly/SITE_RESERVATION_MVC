<div class="dashboard_container p-6">
    <h1 class="text-2xl font-semibold mb-6">Tableau de bord</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <div class="bg-white p-5 rounded-lg shadow border-l-4 border-blue-500">
            <p class="text-sm text-gray-500">Utilisateurs</p>
            <p class="text-2xl font-bold">20</p>
        </div>

        <div class="bg-white p-5 rounded-lg shadow border-l-4 border-green-500">
            <p class="text-sm text-gray-500">Vols</p>
            <p class="text-2xl font-bold">54</p>
        </div>

        <div class="bg-white p-5 rounded-lg shadow border-l-4 border-yellow-500">
            <p class="text-sm text-gray-500">Réservations</p>
            <p class="text-2xl font-bold">312</p>
        </div>

        <div class="bg-white p-5 rounded-lg shadow border-l-4 border-red-500">
            <p class="text-sm text-gray-500">Paiements</p>
            <p class="text-2xl font-bold">€24 580</p>
        </div>

    </div>

    <!-- Dernières actions -->
    <div class="w-full mt-10 bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Dernières réservations</h2>

        <table class="w-full text-sm">
            <thead class="border-b">
                <tr>
                    <th class="text-left py-2">Client</th>
                    <th class="text-left py-2">Vol</th>
                    <th class="text-left py-2">Date</th>
                    <th class="text-left py-2">Statut</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b">
                    <td class="py-2">John Doe</td>
                    <td>AF204</td>
                    <td>12/09/2025</td>
                    <td class="text-green-600">Confirmé</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>