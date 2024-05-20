<div>
    <div class='row row-cards'>
        <div class='col-lg-8'>
            <x-card>
                <x-data-grid :info="$order" :fields="['id', 'total_price', 'status']" />
            </x-card>
            <x-card>
                <x-slot:action>
                    <x-button icon="edit" wire:click="showCreateForm">Ajouter</x-button>
                </x-slot:action>
                <div class="table-responsive">
                    <table class="table mb-0  table-vcenter text-nowrap ">
                        <thead>
                            <tr>
                                <th>Matière première</th>
                                <th>Quantité</th>
                                <th>Prix total</th>
                                <th>-</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($rawMaterials->isEmpty())
                                <x-alert type="info"
                                    message="Vous avez commander tout les type de matière première disponible" />
                            @elseif ($line)
                                @include('dashboard.order-line._form-table', [
                                    'line' => $line,
                                    'rawMaterials' => $rawMaterials,
                                ])
                            @endif

                            @foreach ($order->lines as $line)
                                <tr>
                                    <td>{{ $line->rawMaterial->name }}</td>
                                    <td>{{ $line->formatted_quantity }}</td>
                                    <td>{{ $line->total_price }}</td>
                                    <td>

                                        <x-button wire:click='deleteOrderLine({{ $line->id }})'
                                            wire:confirm="Etes vous sure de vouloir supprimer cette ligne de commande? Cette action est irréversible"
                                            type='submit' variant="danger" icon='trash' />
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </x-card>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Transition</h3>
                    <x-select :options="['En attente de paiement', 'Approuver', 'Annuler']" name='transitions' />
                    <x-button>Confirmer</x-button>
                </div>
            </div>
        </div>
    </div>
</div>
