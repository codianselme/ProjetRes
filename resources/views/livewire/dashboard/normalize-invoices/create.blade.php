@extends('layouts.invoices')

@section('content')
<div class="page-wrapper">
    <!-- Bouton de retour - visible uniquement à l'écran -->
    <div class="navigation-buttons">
        <a href="{{ route('dashboard.sales.sales') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i> Retour aux ventes
        </a>
        
        @if (isset($securityElementsDto) && isset($securityElementsDto['qrCode']))
            <button onclick="window.print()" class="print-btn">
                <i class="fas fa-print"></i> Imprimer le ticket
            </button>
        @endif
    </div>

    <div class="invoice-wrapper">
        <div class="invoice-content">
            <!-- En-tête de la facture -->
            <div class="invoice-header">
                <div class="header-content">
                    <div class="logo-container">
                        <img src="{{ asset('home/site-images/logo.png') }}" alt="Logo" class="logo">
                    </div>
                    <div class="company-info">
                        <h1>BAR RESTAURANT<br>LES SAVEURS DU CORIDOR</h1>
                        <div class="company-details">
                            <p><strong>RCCM :</strong> {{ env('RCCM') }} | <strong>IFU :</strong> {{ env('SGMEF_IFU') }}</p>
                            <p><strong>Tél :</strong> {{ env('TEL') }}</p>
                            <p><strong>Email :</strong> {{ env('EMAIL') }}</p>
                            <p><strong>Adresse :</strong> {{ env('ADDR') }}</p>
                        </div>
                    </div>
                </div>
                <hr>
            </div>

            <div>
                <table class="invoice-details">
                    @php
                        $reference = $data['type'] === 'FA' ?   $data['reference'] : $data['reference'];
                        $date = (new DateTime($invoice->created_at))->format('Y-m-d');
                        $heure = (new DateTime($invoice->created_at))->format('H:i:s');
                    @endphp
                    <tr>
                        <td>
                            @if($data['type'] === 'FV')
                                FACTURE N° {{ $reference ?? '' }}
                            @endif

                            @if($data['type'] === 'FA')
                                FACTURE D'AVOIR : Ref.fact.orig : {{ $reference ?? '' }}
                            @endif
                        </td>
                        {{-- <td>Date : {{ $date ?? '' }}</td> --}}
                        <td>Date : {{ $date ?? '' }} à {{ $heure ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>@if(isset($data['client']['name'])) Client : {{ $data['client']['name'] }} @endif</td>
                        {{-- <td>@if(isset($data['client']['contact'])) {{ $data['client']['contact'] }} @endif</td> --}}
                        <td>@if(isset($data['client']['ifu'])) IFU : {{ $data['client']['ifu'] }} @endif</td>
                    </tr>
                    <tr>
                        <td>
                            Date Numérisation 
                            <br>

                            @if (isset($securityElementsDto) && isset($securityElementsDto['dateTime']))
                                {{ $securityElementsDto['dateTime'] }}
                            @else
                                Non Numérisé
                            @endif
                        </td>
                        {{-- <td></td> --}}
                        <td>
                            Mode de paiement 
                            <br>

                            @php
                                $payment = Arr::get($data['payment'], 0, []);
                            @endphp
                            {{ $payment['name'] }}
                            @if($payment['name'] == 'MOBILEMONEY')
                                <br>
                                {{ Arr::get($data['reference'], 'identify_of_mobile_trasaction', '') }}
                            @elseif($payment['name'] == 'CHEQUES')
                                <br>
                                {{ Arr::get(get_reference_field($data['reference']), 'name_banque_of_checque', '') }}
                                <br>
                                {{ Arr::get(get_reference_field($data['reference']), 'reference_of_cheque', '') }}
                            @endif
                        </td>
                    </tr>
                </table>
            </div>

            

            <div>
                <table class="invoice-items">
                    <thead>
                        <tr>
                            <th style=with: 70%>Désignation</th>
                            <th style=with: 10%>Qté</th>
                            <th style=with: 10%>&emsp;&emsp;&emsp;&emsp;PU</th>
                            <th style=with: 10%>&emsp;Montant</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($total = 0)
                        @foreach ($data['items'] as $item)
                            @php($price = $item['price'] ?? 0)
                            @php($quantity = $item['quantity'] ?? 0)
                            @php($total += $price * $quantity)
                            @php($name_parts = explode('  ', $item['name'] ?? '-'))

                            <tr>
                                <td>
                                    {{ $name_parts[0] ?? '-' }}
                                    <small>{{ isset($item['taxGroup']) ? '(' . $item['taxGroup'] . ')' : '-' }}</small>
                                    <br>
                                    <em>{{ isset($name_parts[1]) ? $name_parts[1] : '' }}</em>
                                </td>
                                <td>{{ $quantity }}</td>
                                <td>{{ $data['type'] == 'FA' ? '-' : '' }}  {{ number_format(round($price), 0, '', ' ') }}</td>
                                <td>{{ $data['type'] == 'FA' ? '-' : '' }}  {{ number_format((round($price) * $quantity), 0, '', ' ') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="totals-separator">
                            <td colspan="3" class="total">Total HT</td>
                            <td style="text-align: right">
                                {{ $data['type'] == 'FA' ? '-' : '' }}
                                {{ number_format((($createInvoice['hab'] ?? 0) + ($createInvoice['had'] ?? 0)), 0, '', ' ') }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="total">TVA 18%</td>
                            <td style="text-align: right">
                                {{ $data['type'] == 'FA' ? '-' : '' }}
                                {{ number_format((($createInvoice['vab'] ?? 0) + ($createInvoice['vad'] ?? 0)), 0, '', ' ') }}
                            </td>
                        </tr>
                        {{-- <tr>
                            <td colspan="3" class="total">Montant AIB <small>{{ isset($data['aib']) ? '('. ( $data['aib'] == 'A' ? '1%' : '5%' ) . ')' : '' }}</small>:</td>
                            <td>
                                {{ $data['type'] == 'FA' ? '-' : '' }}
                                {{ ($createInvoice['aib'] ?? 0) }}
                            </td>
                        </tr> --}}
                        <tr class="totals-separator">
                            <td colspan="3" class="total">Net à payer</td>
                            <td style="text-align: right">
                                {{ $data['type'] == 'FA' ? '-' : '' }}
                                {{ number_format($createInvoice['total'] ?? 0, 0, '', ' ') }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            

            <div class="invoice-footer">
                <p>
                    Arrêté la présente facture à la somme de (Francs CFA) :  
                    {{ \App\Helpers\NumberToWords::convert($createInvoice['total']) }} francs CFA
                </p>
                
                <div class="cashier-info">
                    <div class="info-row">
                        <span class="cashier">Caissier(e) : {{ auth()->user()->name }}</span>
                        <span class="date">Date : {{ date('d/m/Y à H:i:s') }}</span>
                    </div>
                </div>
                
                <div class="qr-code">
                    @if (isset($securityElementsDto))
                        @if (isset($securityElementsDto['qrCode']))
                            <center>
                                <img src="data:image/png;base64, {!! base64_encode(
                                    QrCode::format('png')->size(100)->generate($securityElementsDto['qrCode']),
                                ) !!}" alt="QR Code"
                                    class="text-center">
                            </center>
                            {{-- @isset($securityElementsDto['codeMECeFDGI'])
                                <center> code_MECeF_DGI : {{ $securityElementsDto['codeMECeFDGI'] }}</center>
                            @endisset
                            @isset($securityElementsDto['nim'])
                                <center> Nim : {{ $securityElementsDto['nim'] }}</center>
                            @endisset --}}
                        @else
                            Numérisation : Annulée
                        @endif
                    @else
                        <a class="btn btn-outline-success btn-rounded waves-effect waves-light" href="{{ route('invoices.modalqrcode', ['invoice' => $invoice->id]) }}">Générer le QRCode</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .page-wrapper {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .invoice-wrapper {
        background: white;
        padding: 5px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 450px;
        margin: 20px auto;
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
    }

    .navigation-buttons {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
    }

    .back-btn {
        background: #34495e;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s ease;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .back-btn:hover {
        background: #2c3e50;
        color: white;
        text-decoration: none;
    }

    .print-btn {
        background: #2c3e50;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .print-btn:hover {
        background: #34495e;
    }

    @media print {
        .page-wrapper {
            padding: 0;
            display: block;
        }

        .invoice-wrapper {
            box-shadow: none;
            padding: 0;
            margin: 0;
        }

        .navigation-buttons {
            display: none;
        }
    }

    .invoice-header {
        margin-bottom: 20px;
    }

    .header-content {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 15px;
    }

    .logo-container {
        flex: 0 0 auto;
    }

    .logo {
        width: 120px;
        height: auto;
        object-fit: contain;
    }

    .company-info {
        flex: 1;
    }

    .company-info h1 {
        font-size: 18px;
        font-weight: bold;
        margin: 0 0 10px 0;
        color: #2c3e50;
        line-height: 1.3;
    }

    .company-details {
        font-size: 14px;
    }

    .company-details p {
        margin: 5px 0;
        color: #444;
    }

    .company-details strong {
        color: #2c3e50;
    }

    hr {
        border: none;
        border-top: 1px solid #ddd;
        margin: 15px 0;
    }

    .cashier-info {
        margin: 10px 0;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 12px;
    }

    .cashier {
        font-weight: 500;
    }

    .date {
        color: #666;
    }
</style>
@endsection