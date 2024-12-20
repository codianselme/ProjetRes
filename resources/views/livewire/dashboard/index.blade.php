<div>
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Tableau de Bord Administrateur</h3>
                            </div>
                        </div>
                    </div>

                    <div class="row g-gs">
                        <div class="col-md-3 mb-4">
                            <div class="card card-bordered card-full">
                                <div class="card-inner">
                                    <div class="card-title-group align-start mb-0">
                                        <div class="card-title">
                                            <h4 class="title">Total des Ventes</h4>
                                        </div>
                                    </div>
                                    <div class="card-amount">
                                        <span class="amount text-right">{{ $totalSales }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-4">
                            <div class="card card-bordered card-full">
                                <div class="card-inner">
                                    <div class="card-title-group align-start mb-0">
                                        <div class="card-title">
                                            <h4 class="title">Montant Total des Ventes</h4>
                                        </div>
                                    </div>
                                    <div class="card-amount">
                                        <span class="amount text-right">{{ number_format($totalAmount, 0) }} FCFA</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-4">
                            <div class="card card-bordered card-full">
                                <div class="card-inner">
                                    <div class="card-title-group align-start mb-0">
                                        <div class="card-title">
                                            <h4 class="title">Total Plats</h4>
                                        </div>
                                    </div>
                                    <div class="card-amount">
                                        <span class="amount text-right">{{ $totalDishes }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-4">
                            <div class="card card-bordered card-full">
                                <div class="card-inner">
                                    <div class="card-title-group align-start mb-0">
                                        <div class="card-title">
                                            <h4 class="title">Total Boissons</h4>
                                        </div>
                                    </div>
                                    <div class="card-amount">
                                        <span class="amount text-right">{{ $totalDrinks }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-gs">
                        <div class="col-md-3 mb-4">
                            <div class="card card-bordered card-full">
                                <div class="card-inner">
                                    <div class="card-title-group align-start mb-0">
                                        <div class="card-title">
                                            <h4 class="title">Stock Total d'Aliments</h4>
                                        </div>
                                    </div>
                                    <div class="card-amount">
                                        <span class="amount text-right">{{ $totalFoodStock }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-4">
                            <div class="card card-bordered card-full">
                                <div class="card-inner">
                                    <div class="card-title-group align-start mb-0">
                                        <div class="card-title">
                                            <h4 class="title">Stock Total de Boissons</h4>
                                        </div>
                                    </div>
                                    <div class="card-amount">
                                        <span class="amount text-right">{{ $totalDrinkStock }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-4">
                            <div class="card card-bordered card-full">
                                <div class="card-inner">
                                    <div class="card-title-group align-start mb-0">
                                        <div class="card-title">
                                            <h4 class="title">Total Utilisateurs</h4>
                                        </div>
                                    </div>
                                    <div class="card-amount">
                                        <span class="amount text-right">{{ $totalUsers }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-4">
                            <div class="card card-bordered card-full">
                                <div class="card-inner">
                                    <div class="card-title-group align-start mb-0">
                                        <div class="card-title">
                                            <h4 class="title">{{ \Carbon\Carbon::now()->format('d/m/Y') }}</h4>
                                        </div>
                                    </div>
                                    <div class="card-amount">
                                        <span class="amount text-right">{{ $isCashRegisterOpen ? 'Caisse Ouverte' : 'Caisse Fermée' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                    <div class="row g-gs">
                        <div class="col-xxl-6 col-sm-12 mb-4">
                            <div class="nk-block">
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                        <h5>Graphique des Ventes Mensuelles</h5>
                                        <canvas id="monthlySalesChart" style="height: 300px;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-6 col-sm-12 mb-4">
                            <div class="nk-block">
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                        <h5>Ventes par Méthode de Paiement</h5>
                                        <canvas id="paymentMethodChart" style="height: 300px;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <h5>Dernières Ventes</h5>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Numéro de Facture</th>
                                            <th>Date</th>
                                            <th>Montant Total</th>
                                            <th>Montant Payé</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(App\Models\Sale::orderBy('created_at', 'desc')->take(5)->get() as $sale)
                                        <tr>
                                            <td>{{ $sale->invoice_number }}</td>
                                            <td>{{ $sale->created_at->format('d/m/Y') }}</td>
                                            <td>{{ number_format($sale->total_amount, 0) }} FCFA</td>
                                            <td>{{ number_format($sale->paid_amount, 0) }} FCFA</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('js')
    <script>
        const ctx = document.getElementById('monthlySalesChart').getContext('2d');
        const monthlySalesData = @json($monthlySalesData);
        const labels = Array.from({length: 12}, (v, k) => k + 1); // Mois de 1 à 12

        const monthlySalesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Montant des Ventes',
                    data: monthlySalesData,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2,
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Montant (FCFA)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Mois'
                        }
                    }
                }
            }
        });

        const paymentMethodCtx = document.getElementById('paymentMethodChart').getContext('2d');
        const paymentMethodData = @json($salesByPaymentMethod);
        const paymentMethods = Object.keys(paymentMethodData);
        const paymentCounts = Object.values(paymentMethodData);

        const paymentMethodChart = new Chart(paymentMethodCtx, {
            type: 'bar',
            data: {
                labels: paymentMethods,
                datasets: [{
                    label: 'Nombre de Ventes',
                    data: paymentCounts,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    @endsection
</div>