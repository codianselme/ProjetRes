<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
</div>
@section("links")
<!-- Data Table Css -->
<link rel="stylesheet" type="text/css"
    href="{{ asset('files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css"
    href="{{ asset('files/assets/pages/data-table/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css"
    href="{{ asset('files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">

<!-- jquery file upload Frame work -->
<link href="{{ asset('files/assets/pages/jquery.filer/css/jquery.filer.css') }}" type="text/css" rel="stylesheet" />
<link href="{{ asset('files/assets/pages/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css') }}"
    type="text/css" rel="stylesheet" />

<!-- themify-icons line icon -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/themify-icons/themify-icons.css') }}">
@endsection

<div>
    <!-- [ breadcrumb ] start -->
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="feather icon-home bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>Dashboard</h5>
                        <span>Liste des Factures</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class=" breadcrumb breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="#"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Liste</a> </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <!-- [ breadcrumb ] end -->
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">

                    <!-- [ page content ] start -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Alternative Pagination table start -->
                            <div class="card">
                                <div class="card-header">
                                    <h5>Liste des Factures</h5>
                                    {{--<span>The default page control presented by DataTables (forward and backward buttons with up to 7 page numbers in-between) is fine for most situations, but there are cases where you may wish to customise the options presented to the end user. This is done through DataTables' extensible pagination mechanism, the pagingType option.</span>--}}
                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="alt-pg-dt" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">ID</th>
                                                    <th class="text-center">Numéro de facture</th>
                                                    <th class="text-center">Type</th>
                                                    <th class="text-center">Statut</th>
                                                    <th class="text-center">Structure</th>
                                                    <th class="text-center">Données de la demande</th>
                                                    <th class="text-center">Données de la réponse</th>
                                                    <th class="text-center">Actions</th> <!-- Nouvelle colonne pour les actions -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(!$invoices->isEmpty())
                                                    @foreach($invoices as $invoice)
                                                        <tr>
                                                            <td class="text-center">{{ $invoice->id }}</td>
                                                            <td class="text-center">{{ $invoice->invoice_number }}</td>
                                                            <td class="text-center">{{ $invoice->typeInvoice }}</td>
                                                            <td class="text-center">{{ $invoice->statusInvoice }}</td>
                                                            <td class="text-center">{{ $invoice->structure ? $invoice->structure->name : 'N/A' }}</td>
                                                            <td class="text-center">
                                                                <pre style="white-space: pre-wrap; word-wrap: break-word;">{{ json_encode($invoice->invoiceRequestDataDto, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                                            </td>
                                                            <td class="text-center">
                                                                <pre style="white-space: pre-wrap; word-wrap: break-word;">{{ json_encode($invoice->invoiceResponseDataDto, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                                            </td>
                                                            <td class="text-center">
                                                                <pre style="white-space: pre-wrap; word-wrap: break-word;">{{ json_encode($invoice->securityElementsDto, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                                            </td>
{{--                                                            <td class="text-center">--}}
{{--                                                                <pre style="white-space: pre-wrap; word-wrap: break-word;">--}}
{{--                                                                    @foreach($invoice->invoiceRequestDataDto as $key => $value)--}}
{{--                                                                        <strong>{{ $key }}:</strong> {{ json_encode($value, JSON_PRETTY_PRINT) }}<br>--}}
{{--                                                                    @endforeach--}}
{{--                                                                </pre>--}}
{{--                                                            </td>--}}
{{--                                                            <td>--}}
{{--                                                                <pre style="white-space: pre-wrap; word-wrap: break-word;">--}}
{{--                                                                    @foreach($invoice->invoiceResponseDataDto as $key => $value)--}}
{{--                                                                        <strong>{{ $key }}:</strong> {{ json_encode($value, JSON_PRETTY_PRINT) }}<br>--}}
{{--                                                                    @endforeach--}}
{{--                                                                </pre>--}}
{{--                                                            </td>--}}
{{--                                                            <td>--}}
{{--                                                                <pre style="white-space: pre-wrap; word-wrap: break-word;">--}}
{{--                                                                     @foreach($invoice->securityElementsDto as $key => $value)--}}
{{--                                                                        <strong>{{ $key }}:</strong> {{ json_encode($value, JSON_PRETTY_PRINT) }}<br>--}}
{{--                                                                    @endforeach--}}
{{--                                                                </pre>--}}
{{--                                                            </td>--}}
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="8">
                                                            <div class="alert alert-secondary ">
                                                                <div class="alert-message text-center">
                                                                    <p>Aucune donnée trouvée!</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Alternative Pagination table end -->
                        </div>
                    </div>
                    <!-- [ page content ] end -->
                </div>
            </div>
        </div>
    </div>
</div>


@section("scripts")
<!-- data-table js -->
<script src="{{ asset('files/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('files/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('files/assets/pages/data-table/js/jszip.min.js') }}"></script>
<script src="{{ asset('files/assets/pages/data-table/js/pdfmake.min.js') }}"></script>
<script src="{{ asset('files/assets/pages/data-table/js/vfs_fonts.js') }}"></script>
<script src="{{ asset('files/bower_components/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('files/bower_components/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('files/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('files/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}">
</script>
<!-- Custom js -->
<script src="{{ asset('files/assets/pages/data-table/js/data-table-custom.js') }}"></script>
<script src="{{ asset('files/assets/js/pcoded.min.js') }}"></script>
<script src="{{ asset('files/assets/js/vertical/vertical-layout.min.js') }}"></script>
<script src="{{ asset('files/assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('files/assets/js/script.js') }}"></script>
@endsection
