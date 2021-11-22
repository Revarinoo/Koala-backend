<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
class Order extends Model
{
    // use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'status',
        'order_date',
        'content_id',
        'influencer_id',
    ];

    public function content() {
        return $this->belongsTo('App\Models\Content');
    }

    public function orderDetail() {
        return $this->hasMany('App\Models\OrderDetail');
    }

    public function influencer() {
        return $this->belongsTo('App\Models\Influencer');
    }

    public const CREATED = 'created';
	public const CONFIRMED = 'confirmed';
	public const DELIVERED = 'delivered';
	public const COMPLETED = 'completed';
	public const CANCELLED = 'cancelled';

	public const ORDERCODE = 'INV';

	public const PAID = 'paid';
	public const UNPAID = 'unpaid';

	public const STATUSES = [
		self::CREATED => 'Created',
		self::CONFIRMED => 'Confirmed',
		self::DELIVERED => 'Delivered',
		self::COMPLETED => 'Completed',
		self::CANCELLED => 'Cancelled',
	];
    
    /**
	 * Generate order code
	 *
	 * @return string
	 */
	public static function generateCode()
	{
		$dateCode = self::ORDERCODE . '/' . date('Ymd') . '/' .\General::integerToRoman(date('m')). '/' .\General::integerToRoman(date('d')). '/';

		$lastOrder = self::select([\DB::raw('MAX(orders.code) AS last_code')])
			->where('code', 'like', $dateCode . '%')
			->first();

		$lastOrderCode = !empty($lastOrder) ? $lastOrder['last_code'] : null;
		
		$orderCode = $dateCode . '00001';
		if ($lastOrderCode) {
			$lastOrderNumber = str_replace($dateCode, '', $lastOrderCode);
			$nextOrderNumber = sprintf('%05d', (int)$lastOrderNumber + 1);
			
			$orderCode = $dateCode . $nextOrderNumber;
		}

		if (self::_isOrderCodeExists($orderCode)) {
			return generateOrderCode();
		}

		return $orderCode;
	}

	/**
	 * Check if the generated order code is exists
	 *
	 * @param string $orderCode order code
	 *
	 * @return void
	 */
	private static function _isOrderCodeExists($orderCode)
	{
		return Order::where('code', '=', $orderCode)->exists();
	}

	/**
	 * Check order is paid or not
	 *
	 * @return boolean
	 */
	public function isPaid()
	{
		return $this->payment_status == self::PAID;
	}

	/**
	 * Check order is created
	 *
	 * @return boolean
	 */
	public function isCreated()
	{
		return $this->status == self::CREATED;
	}

	/**
	 * Check order is confirmed
	 *
	 * @return boolean
	 */
	public function isConfirmed()
	{
		return $this->status == self::CONFIRMED;
	}

	/**
	 * Check order is delivered
	 *
	 * @return boolean
	 */
	public function isDelivered()
	{
		return $this->status == self::DELIVERED;
	}

	/**
	 * Check order is completed
	 *
	 * @return boolean
	 */
	public function isCompleted()
	{
		return $this->status == self::COMPLETED;
	}

	/**
	 * Check order is cancelled
	 *
	 * @return boolean
	 */
	public function isCancelled()
	{
		return $this->status == self::CANCELLED;
	}

}
