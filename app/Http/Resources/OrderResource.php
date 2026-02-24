<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'                 => $this->id,
            'customer_name'      => $this->customer_name,
            'customer_email'     => $this->customer_email,
            'post_title'         => optional($this->post)->title,
            'amount'             => '$' . number_format($this->amount / 100, 2),
            'fulfillment_status' => $this->fulfillment_status,
            'tracking_number'    => $this->tracking_number,
            'notes'              => $this->notes,
            'shipping_address'   => $this->shipping_address,
            'created_at'         => optional($this->created_at)->format('M-d-Y H:i'),
        ];
    }
}
