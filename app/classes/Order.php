<?php

namespace Classes;

class Order
{
    private int $orderId;
    private int $customerId;
    private array $orderItems;
    private string $status;

    public function __construct()
    {
    }
}
