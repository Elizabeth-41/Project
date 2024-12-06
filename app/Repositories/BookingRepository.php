<?php

namespace App\Repositories;

use App\Models\BookingTransaction;
use App\Repositories\Contracts\BookingRepositoryInterface;
use Illuminate\Support\Facades\Session;

class BookingRepository implements BookingRepositoryInterface
{
    public function createBooking(array $data)
    {
        return BookingTransaction::create($data);
    }

    public function findByTrxIdAndPhoneNumber($bookingTrxId, $phoneNumber) // Fixed parameter name
    {
        return BookingTransaction::where('booking_trx_id', $bookingTrxId)
            ->where('phone', $phoneNumber) // Fixed the syntax error
            ->first();
    }

    public function saveToSession(array $data) // Fixed parameter type declaration
    {
        Session::put('orderData', $data); // Added missing semicolon
    }

    public function getOrderDataFromSession()
    {
        return Session::get('orderData', []);
    }

    public function updateSessionData(array $data)
    {
        $orderData = session('orderData', []);
        $orderData = array_merge($orderData, $data);
        session(['orderData' => $orderData]); // Fixed spacing
    }

    public function clearSession() // Fixed method name to follow camelCase convention
    {
        Session::forget('orderData'); // Fixed the method name (from `forcget` to `forget`)
    }
}