<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <div class="modal fade"  data-bs-keyboard="false" id="qrcodeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      {{-- <form action="{{ route('invoices.qrcode') }}" method="POST" enctype="multipart/form-data">
        @csrf --}}
        <div class="modal-content rounded-0">
          <div class="text-center text-white modal-header bg-yellow">
            <center>
              <h2 class="text-center text-white modal-title fs-lg-2">Génération du QR Code</h2>
            </center>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="container">
              <div class="mt-4 row">
                <div class="text-center col-12">
                  <h4 class="fw-normal"><font face="serif">Veuillez confirmer la génération du QR code pour finaliser la normalisation de la facture.</font></h4>
                  <h5 class="fw-normal">Attention, cette action est irréversible. Voici un résumé de la facture :</h5>
                </div>
                <br>
              </div>
              <div class="mt-3 row">
                <div class="text-center col-2">
                  <img src="https://img.icons8.com/ios-filled/50/000000/bookmark.png" alt="Date icon" style="width:35px; height:35px; ">
                </div>
                @php
                  $data = json_decode($data, true);
                  $createInvoice = json_decode($createInvoice, true);
                @endphp
                <div class="col-10 align-self-center">
                  <h6 class="mb-0 fs-4">Facture_No:<b>#{{ $data['reference']}} </b></h6>
                </div>
              </div>
              <div class="mt-3 row">
                <div class="text-center col-2">
                  {{-- https://img.icons8.com/ios-filled/50/000000/checkmark.png --}}
                  <img src="https://img.icons8.com/ios-filled/50/000000/settings.png" alt="Date icon" style="width:35px; height:35px; ">
                </div>
                <div class="col-10 align-self-center">
                  <h6 class="mb-0 fs-4">Ref_DGI: <b>{{  ($createInvoice['uid'] ?? '') }}</b></h6>
                </div>
              </div>
              <div class="mt-3 row">
                <div class="text-center col-2">
                  <img src="https://img.icons8.com/ios-filled/50/000000/calendar.png" alt="Date icon" style="width:35px; height:35px; ">
                </div>
                <div class="col-10 align-self-center">
                  <h6 class="mb-0 fs-4">Date: <b>{{ now()->format('d-m-y') }}</b></h6>
                </div>
              </div>
              <div class="mt-3 row">
                <div class="text-center col-2">
                  <img src="https://img.icons8.com/ios-filled/50/000000/money-bag.png" alt="Money bag icon" style="width:35px; height:35px; ">
                </div>
                <div class="col-10 align-self-center">
                  <h6 class="mb-0 fs-4">Montant HT: <b>{{ $createInvoice['hab'] + $createInvoice['had'] }} {{ config('app.currency') }}</b></h6>
                </div>
              </div>
              <div class="mt-3 row">
                <div class="text-center col-2">
                  <img src="https://img.icons8.com/ios-filled/50/000000/tax.png" alt="Tax icon" style="width:35px; height:35px; ">
                </div>
                <div class="col-10 align-self-center">
                  <h6 class="mb-0 fs-4">Montant TVA: <b>{{ $createInvoice['vab'] + $createInvoice['vad'] }} {{ config('app.currency') }}</b></h6>
                </div>
              </div>
              <div class="mt-3 row">
                <div class="text-center col-2">
                  <img src="https://img.icons8.com/ios-filled/50/000000/invoice.png" alt="Credit card icon" style="width:35px; height:35px; ">
                </div>
                <div class="col-10 align-self-center">
                  <h6 class="mb-0 fs-4">Montant AIB: <b>{{ $createInvoice['aib'] }} {{ config('app.currency') }}</b></h6>
                </div>
              </div>
              <div class="mt-3 row">
                <div class="text-center col-2">
                  <img src="https://img.icons8.com/ios-filled/50/000000/cash-in-hand.png" alt="Total icon" style="width:35px; height:35px; ">
                </div>
                <div class="col-10 align-self-center">
                  <h6 class="mb-0 fs-4">Total: <b>{{ $createInvoice['total'] }} {{ config('app.currency') }}</b></h6>
                </div>
              </div>
              <br>
              <div class="mt-3 row">
                <div class="text-center col-12">
                  <h5 class="fw-normal">Merci de vérifier attentivement les informations avant de procéder.</h5>
                </div>
              </div>
            </div>
            {{-- <input type="hidden" name="uid" value="{{ $createInvoice['uid'] }}"> --}}
            {{-- Other hidden inputs here if needed --}}
            {{-- <input type="hidden" name="invoice" value="{{ $invoice }}"> --}}
          </div>
          <div class="modal-footer">
            <form action="{{ route('invoices.confirm-qrcode', ['invoice' => $invoice_id]) }}" method="POST">
              @csrf
              <button type="submit" class="btn btn-warning rounded-pill">Confirmer la facture</button>
            </form>
            <form action="{{ route('invoices.cancel-qrcode', ['invoice' => $invoice_id]) }}" method="POST">
              @csrf
              <button type="submit" class="btn btn-danger rounded-pill">Annuler la facture</button>
            </form>

            <a href="{{ route('login') }}" class="btn btn-secondary rounded-pill">Quitter</a>

            {{-- <a href="{{ route('invoices.confirm-qrcode', ['invoice_id' => $invoice_id]) }}" class="btn btn-primary rounded-pill">Confirmer</a>
            <a href="{{ route('invoices.cancel-qrcode', ['invoice_id' => $invoice_id]) }}" class="btn btn-danger rounded-pill">Annuler</a> --}}
          </div>
        </div>
      {{-- </form> --}}
    </div>
  </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.0/build/qrcode.min.js"></script>

<script>
  $(document).ready(function(){
      $('#qrcodeModal').modal('show');
  })
</script>
</html>
