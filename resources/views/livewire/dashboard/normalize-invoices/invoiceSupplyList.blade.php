@extends('layouts.admin')
@section('main-content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Listes des Factures</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Factures</a></li>
                            <li class="breadcrumb-item active">Factures d'approvisionnement</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        @livewire('direction.invoice.supply.index')
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
@endsection