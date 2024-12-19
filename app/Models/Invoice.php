<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'invoiceRequestDataDto',
        'invoiceResponseDataDto',
        'statusInvoice',
        'typeInvoice',
        'securityElementsDto',
        'vente_id',
        'invoice_number',
        'commentaire',
        'identify_of_mobile_trasaction',
        'reference_of_cheque',
        'name_banque_of_checque',
        'user_id',
    ];


}
