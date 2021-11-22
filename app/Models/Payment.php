<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    
    protected $fillable = [
		'order_id',
		'number',
		'transaction_id',
		'amount',
		'method',
		'status',
		'token',
		'payloads',
		'payment_type',
		'va_number',
		'vendor_name',
		'biller_code',
		'bill_key',
	];

	public const PAYMENT_CHANNELS = ['bca_va', 'gopay'];

	public const EXPIRY_DURATION = 7;
	public const EXPIRY_UNIT = 'days';
	  

	public const CHALLENGE = 'challenge';
	public const SUCCESS = 'success';
	public const SETTLEMENT = 'settlement';
	public const PENDING = 'pending';
	public const DENY = 'deny';
	public const EXPIRE = 'expire';
	public const CANCEL = 'cancel';


	public const PAYMENTCODE = 'PAY';

	
}
