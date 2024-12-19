@extends('layouts.invoices')
@section('main-content')
    <main>
        <a href="{{ route('login') }}" class="btn btn-primary" style="display: inline-flex; align-items: center; padding: 10px 15px; text-decoration: none; color: white;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="transform: scaleX(1.5);">
                <path d="M20 12H4M4 12L10 6M4 12L10 18" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span style="margin-left: 5px;"></span>
        </a>

        <br>
        <br>
        <div class="th-invoice invoice_style6" id="download_section" >

            <div class="download-inner" >
                <header class="th-header header-layout5">
                    <div class="row justify-content-between">

                        <div class="col-auto">
                            <div class="header-logo" style="display: flex; align-items: center; margin-top: -50px; margin-left: -30px;">
                                <!-- Image à gauche -->
                                <img src="{{ asset('logo_mtn/logo-mtn.png') }}" alt="Logo" style="width: 80px; height: auto; margin-right: 10px;">

                                <!-- Barre verticale -->
                                <div style="border-left: 1px solid #000; height: 40px; margin-right: 10px;"></div>

                                <!-- Nom de l'agence -->
                                <address style="margin-top: 25px;">
                                    <strong style="font-size: 18px">{{ auth()->user()?->structure?->name ?? 'DIRECTION : '.auth()->user()?->structure?->name ?? '' }}</strong>
                                    <br>
                                    {{--Powered by Faghal--}}
                                </address>
                            </div>

                            <!-- Informations du vendeur -->
                            <address>
                                <p class="mt-2" style="font-size: 16px; margin-left: -30px; margin-top: 10px;">
                                    Généré par &nbsp;: <small>{{ $data['operator']['id'] ?? '' }}</small>
                                    @php
                                    // Séparer le nom du vendeur par des espaces
                                    $names = explode(' ', $data['operator']['name'] ?? '');

                                    // Calculer la longueur totale du préfixe et des deux premiers noms
                                    $prefix_length = strlen('Généré Par : ' . ($data['operator']['id'] ?? '') . ' ');

                                    // Afficher les deux premiers noms sur la même ligne
                                    echo implode(' ', array_slice($names, 0, 2));

                                    // Si plus de deux noms, afficher les noms restants sur la ligne suivante
                                    if (count($names) > 2) {
                                    // Calculer la longueur des espaces insécables à insérer
                                    $padding_length = $prefix_length;

                                    // Afficher les noms restants avec un padding pour aligner avec les premiers noms
                                    echo '<br>' . str_repeat('&nbsp;', $padding_length + 3) . implode(' ', array_slice($names, 2));
                                    }
                                    @endphp
                                </p>
                            </address>
                        </div>

                        @php
                            $data = json_decode($data, true);
                        @endphp

                        <div class="col-auto">
                            <h5 class="">{{ $data['type'] === 'FV' ? 'FACTURE DE VENTE' : 'FACTURE D\'AVOIR' }}</h5>
                            @php
                                //dd($invoice);
                                $reference = $data['type'] === 'FA' ?   $data['reference'] : $data['reference'];
                                    $date = (new DateTime($invoice->created_at))->format('Y-m-d');
                            @endphp
                            <p class="invoice-date"><b>{{ $data['type'] === 'FA' ? 'Ref.fact.orig: ' : 'Facture N°:   #' }} </b> {{ $reference ?? '' }}</p>
                            <p class="invoice-date"><b>Date:</b> {{ $date ?? '' }}</p>
                        </div>
                    </div>
                </header>
                <div class="my-4 address-bg1">
                    <div class="row justify-content-between">
                        <div class="col-6">
                            <div class="invoice-left border-right">
                                <b>Client :</b>

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="invoice-right">
                                <address>
                                    @if(isset($data['client']['name'])) {{ $data['client']['name'] }} <br> @endif
                                    @if(isset($data['client']['ifu'])) {{ $data['client']['ifu'] }} <br> @endif
                                    @if(isset($data['client']['contact'])) {{ $data['client']['contact'] }} <br> @endif
                                    @if(isset($data['client']['address'])) {{ $data['client']['address'] }} <br> @endif
                                </address>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between mb-30">
                    <div class="col-auto">
                        <div class="invoice-left">
                            <b>Date de la Numérisation :</b>
                            @if (isset($securityElementsDto) && isset($securityElementsDto['dateTime']))
                                <address>
                                    {{ $securityElementsDto['dateTime'] }}
                                </address>
                            @else
                                <p class="mb-0">
                                    Non Numérisé
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="invoice-right">
                            <b>Mode de paiement : </b>
                            <address>
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
                            </address>
                        </div>
                    </div>
                </div>

                <table class="text-black invoice-table table-stripe4">
                    <thead>
                        <tr style="color: black;">
                            <th style="color: black;">Code de produit</th>
                            <th style="color: black;">Nom</th>
                            <th style="color: black;">Prix</th>
                            <th style="color: black;">Quantité</th>
                            <th style="color: black;">Montant</th>
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
                                <td>{{ $item['code'] ?? '-' }}</td>
                                <td>
                                    {{ $name_parts[0] ?? '-' }}
                                    <small>{{ isset($item['taxGroup']) ? '(' . $item['taxGroup'] . ')' : '-' }}</small>
                                    <br>
                                    <em>{{ isset($name_parts[1]) ? $name_parts[1] : '' }}</em>
                                </td>
                                <td>{{ $data['type'] == 'FA' ? '-' : '' }}  {{ round($price) }} FCFA</td>
                                <td>{{ $quantity }}</td>
                                <td>{{ $data['type'] == 'FA' ? '-' : '' }}  {{ (round($price) * $quantity) }} FCFA</td>
                            </tr>
                        @endforeach
                        {{-- <tr>
                            <td colspan="4" class="text-center h3"> Total</td>
                             <td class="text-center h3">{{ $data['type'] == 'FA' ? '-' : $total }} FCFA</td><
                             /tr>--}}

                    </tbody>
                </table>

                <div class="row justify-content-between">
                    <div class="col-auto">
                        <div class="mb-4 invoice-left">
                            <b>DGI Facture Info:</b>
                            @if (isset($securityElementsDto))
                                <p class="mb-0">
                                    @isset($securityElementsDto['codeMECeFDGI'])
                                        code_MECeF_DGI : {{ $securityElementsDto['codeMECeFDGI'] }}<br>
                                    @endisset
                                    @isset($securityElementsDto['nim'])
                                        Nim : {{ $securityElementsDto['nim'] }}<br>
                                    @endisset
                                    @isset($securityElementsDto['counters'])
                                        Counters : {{ $securityElementsDto['counters'] }}<br>
                                    @endisset
                                    @isset($securityElementsDto['errorCode'])
                                        <div class="alert alert-danger" role="alert">
                                            <strong>Erreur:</strong> {{ $securityElementsDto['errorDesc'] }}
                                        </div>
                                    @endisset
                                    {{-- @isset($securityElementsDto['qrCode'])
                                        A/C Name : {{ $securityElementsDto['qrCode'] }}<br>
                                    @endisset --}}
                                </p>
                            @else
                                <p class="mb-0">
                                    Non Numérisé
                                </p>
                            @endif


                        </div><br>
                        <div class="mb-4 invoice-left">
                            @if (isset($securityElementsDto))
                                @if (isset($securityElementsDto['qrCode']))
                                    <center>
                                        <img src="data:image/png;base64, {!! base64_encode(
                                            QrCode::format('png')->size(100)->generate($securityElementsDto['qrCode']),
                                        ) !!}" alt="QR Code"
                                            class="text-center">
                                    </center>
                                @else
                                    Numérisation : Annulée
                                @endif
                            @else
                                <a class="btn btn-outline-success btn-rounded waves-effect waves-light" href="{{ route('invoices.modalqrcode', ['invoice' => $invoice->id]) }}">Générer le QRCode</a>
                            @endif
                        </div>

                        <div class="invoice-note2 mt-25">
                            @if(isset($data['items'][0]['priceModification']) && isset($data['items'][0]['originalPrice']))
                                <p class="mb-0"><b>NOTE:</b> {{ $data['items'][0]['priceModification'] }} des {{$data['items'][0]['originalPrice']}} </p>
                            @endif
                                <p class="mb-0"> Nous vous remercions de votre confiance. </p>
                                <br>
                                {{ $data['reference'] ?? '' }}
                        </div><br>
                    </div>
                    <div class="col-auto">
                        <table class="total-table">
                            <tr>
                                <th>Montant HT:</th>
                                <td>{{ $data['type'] == 'FA' ? '-' : '' }}
                                    {{ ($createInvoice['hab'] ?? 0) + ($createInvoice['had'] ?? 0) }} FCFA
                                </td>
                            </tr>
                            <tr>
                                <th>Montant TVA <small>{{ isset($item[0]['taxGroup']) ? '('. $item[0]['taxGroup'] . ')' : '' }}</small>:</th>
                                <td>{{ $data['type'] == 'FA' ? '-' : '' }}
                                    {{ ($createInvoice['vab'] ?? 0) + ($createInvoice['vad'] ?? 0) }} FCFA
                                </td>
                            </tr>
                            <tr>
                                <th>Montant AIB <small>{{ isset($data['aib']) ? '('. ( $data['aib'] == 'A' ? '1%' : '5%' ) . ')' : '' }}</small>:</th>
                                <td>{{ $data['type'] == 'FA' ? '-' : '' }}
                                    {{ ($createInvoice['aib'] ?? 0) }} FCFA
                                </td>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td>{{ $data['type'] == 'FA' ? '-' : '' }}
                                    {{ ($createInvoice['total'] ?? 0) }} FCFA
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="body-shape1">
                    <svg width="850" height="145" viewBox="0 0 850 145" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M102.94 144.999C96.6306 145.048 0 142.432 0 135.175V0H850V47.7965C711.227 15.8466 566.86 11.4548 433.319 62.3735C377.8 83.5416 326.217 100.145 269.824 118.94C217.429 136.403 158.779 144.576 102.94 144.999Z"
                            fill="url(#paint0_linear_310_4187)" />
                        <defs>
                            <linearGradient id="paint0_linear_310_4187" x1="572.75" y1="-78.9907" x2="572.75"
                                y2="125.633" gradientUnits="userSpaceOnUse">
                                <stop offset="0.1344" stop-color="#FFCB05" />
                                <stop offset="1" stop-color="#FFCB05" />
                            </linearGradient>
                        </defs>
                    </svg>
                </div>
                <div class="body-shape2">
                    <svg width="850" height="130" viewBox="0 0 850 130" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M747.06 0.000656128C753.369 -0.0479126 850 2.56776 850 9.825V130H0V97.2035C138.773 129.153 283.14 133.545 416.681 82.6265C472.2 61.4584 523.783 44.8554 580.176 26.0601C632.571 8.59695 691.221 0.423874 747.06 0.000656128Z"
                            fill="url(#paint0_linear_310_4323)" />
                        <defs>
                            <linearGradient id="paint0_linear_310_4323" x1="277.25" y1="200.819" x2="277.25"
                                y2="17.3636" gradientUnits="userSpaceOnUse">
                                <stop offset="0.1344" stop-color="#FFCB05" />
                                <stop offset="1" stop-color="#FFCB05" />
                            </linearGradient>
                        </defs>
                    </svg>
                </div>
                <div class="footer-info" style="margin-top: 5%;">
                    <!-- Logo -->
                    <div style="margin-right: -40px">
                        <a href="{{ route('login') }}"><img src="{{ asset('assetsinvoice/img/logofaghal.png') }}" width="120px" alt="Fagal"></a>
                    </div>

                    <!-- Nouvelle ligne -->
                    <div style="text-align: right; margin-bottom: -30px; margin-right: -38px">
                        <p style="display: inline-block;">RCCM : {{ env('RCCM') }}</p>
                    </div>

                    <!-- informations -->
                    <div style="display: flex; align-items: center; justify-content: space-between;"
                        <!-- Informations -->
                        <div style="text-align: left; margin-bottom: -35px; margin-right: -40px;">
                            <p style="display: inline-block;">(+229) 66 68 68 89 / 54 37 37 40</p> |
                            <p style="display: inline-block;">IFU : {{ env('SGMEF_IFU') }}</p>
                        </div>
                    </div>
                </div>

                <div class="invoice-buttons">
                    {{-- <button class="print_btn"> --}}
                    <button id="download_btn" class="download_btn">
                        <svg width="20" height="21" viewBox="0 0 20 21" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M16.25 13C16.6146 13 16.9141 13.1172 17.1484 13.3516C17.3828 13.5859 17.5 13.8854 17.5 14.25V19.25C17.5 19.6146 17.3828 19.9141 17.1484 20.1484C16.9141 20.3828 16.6146 20.5 16.25 20.5H3.75C3.38542 20.5 3.08594 20.3828 2.85156 20.1484C2.61719 19.9141 2.5 19.6146 2.5 19.25V14.25C2.5 13.8854 2.61719 13.5859 2.85156 13.3516C3.08594 13.1172 3.38542 13 3.75 13H16.25ZM16.25 19.25V14.25H3.75V19.25H16.25ZM17.5 8C18.2031 8.02604 18.7891 8.27344 19.2578 8.74219C19.7266 9.21094 19.974 9.79688 20 10.5V14.875C19.974 15.2656 19.7656 15.474 19.375 15.5C18.9844 15.474 18.776 15.2656 18.75 14.875V10.5C18.75 10.1354 18.6328 9.83594 18.3984 9.60156C18.1641 9.36719 17.8646 9.25 17.5 9.25H2.5C2.13542 9.25 1.83594 9.36719 1.60156 9.60156C1.36719 9.83594 1.25 10.1354 1.25 10.5V14.875C1.22396 15.2656 1.01562 15.474 0.625 15.5C0.234375 15.474 0.0260417 15.2656 0 14.875V10.5C0.0260417 9.79688 0.273438 9.21094 0.742188 8.74219C1.21094 8.27344 1.79688 8.02604 2.5 8V3C2.52604 2.29688 2.77344 1.71094 3.24219 1.24219C3.71094 0.773438 4.29688 0.526042 5 0.5H14.7266C15.0651 0.5 15.3646 0.617188 15.625 0.851562L17.1484 2.375C17.3828 2.60938 17.5 2.90885 17.5 3.27344V8ZM16.25 8V3.27344L14.7266 1.75H5C4.63542 1.75 4.33594 1.86719 4.10156 2.10156C3.86719 2.33594 3.75 2.63542 3.75 3V8H16.25ZM16.875 10.1875C17.4479 10.2396 17.7604 10.5521 17.8125 11.125C17.7604 11.6979 17.4479 12.0104 16.875 12.0625C16.3021 12.0104 15.9896 11.6979 15.9375 11.125C15.9896 10.5521 16.3021 10.2396 16.875 10.1875Z"
                                fill="#111111" />
                        </svg>
                    </button>
                    <button id="download_btn" class="download_btn">
                        <svg width="25" height="19" viewBox="0 0 25 19" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.94531 11.1797C8.6849 10.8932 8.6849 10.6068 8.94531 10.3203C9.23177 10.0599 9.51823 10.0599 9.80469 10.3203L11.875 12.3516V6.375C11.901 5.98438 12.1094 5.77604 12.5 5.75C12.8906 5.77604 13.099 5.98438 13.125 6.375V12.3516L15.1953 10.3203C15.4818 10.0599 15.7682 10.0599 16.0547 10.3203C16.3151 10.6068 16.3151 10.8932 16.0547 11.1797L12.9297 14.3047C12.6432 14.5651 12.3568 14.5651 12.0703 14.3047L8.94531 11.1797ZM10.625 0.75C11.7969 0.75 12.8646 1.01042 13.8281 1.53125C14.8177 2.05208 15.625 2.76823 16.25 3.67969C16.8229 3.39323 17.4479 3.25 18.125 3.25C19.375 3.27604 20.4036 3.70573 21.2109 4.53906C22.0443 5.34635 22.474 6.375 22.5 7.625C22.5 8.01562 22.4479 8.41927 22.3438 8.83594C23.151 9.2526 23.7891 9.85156 24.2578 10.6328C24.7526 11.4141 25 12.2865 25 13.25C24.974 14.6562 24.4922 15.8411 23.5547 16.8047C22.5911 17.7422 21.4062 18.224 20 18.25H5.625C4.03646 18.1979 2.70833 17.651 1.64062 16.6094C0.598958 15.5417 0.0520833 14.2135 0 12.625C0.0260417 11.375 0.377604 10.2812 1.05469 9.34375C1.73177 8.40625 2.63021 7.72917 3.75 7.3125C3.88021 5.4375 4.58333 3.88802 5.85938 2.66406C7.13542 1.4401 8.72396 0.802083 10.625 0.75ZM10.625 2C9.08854 2.02604 7.78646 2.54688 6.71875 3.5625C5.67708 4.57812 5.10417 5.85417 5 7.39062C4.94792 7.91146 4.67448 8.27604 4.17969 8.48438C3.29427 8.79688 2.59115 9.33073 2.07031 10.0859C1.54948 10.8151 1.27604 11.6615 1.25 12.625C1.27604 13.875 1.70573 14.9036 2.53906 15.7109C3.34635 16.5443 4.375 16.974 5.625 17H20C21.0677 16.974 21.9531 16.6094 22.6562 15.9062C23.3594 15.2031 23.724 14.3177 23.75 13.25C23.75 12.5208 23.5677 11.8698 23.2031 11.2969C22.8385 10.724 22.3568 10.2682 21.7578 9.92969C21.2109 9.59115 21.0026 9.09635 21.1328 8.44531C21.2109 8.21094 21.25 7.9375 21.25 7.625C21.224 6.73958 20.9245 5.9974 20.3516 5.39844C19.7526 4.82552 19.0104 4.52604 18.125 4.5C17.6302 4.5 17.1875 4.60417 16.7969 4.8125C16.1719 5.04688 15.651 4.90365 15.2344 4.38281C14.7135 3.65365 14.0495 3.08073 13.2422 2.66406C12.4609 2.22135 11.5885 2 10.625 2Z"
                                fill="white" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <!--end modal-->

    </main>
@endsection
