<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;

class UpdateOrderStatus extends Command
{
    protected $signature = 'orders:update-status';
    protected $description = 'Update all orders to completed status';

    public function handle()
    {
        $updated = Order::query()->update([
            'payment_status' => 'completed',
            'order_status' => 'completed'
        ]);

        $this->info("Updated {$updated} orders to completed status.");
    }
}
