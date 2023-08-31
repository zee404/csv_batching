<?php

namespace App\Listeners;

use App\Events\ProductCreated;
use App\Mail\SkuExistsNotification;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;
class SendSkuExistNotification implements ShouldQueue
{

    use InteractsWithQueue;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\ProductCreated  $event
     * @return void
     */
    public function handle(ProductCreated $event)
    {
        $sku = $event->sku;

        if(Product::where('sku',$sku)->exists()){
            Mail::to('rz72242@gmail.com')->send(new SkuExistsNotification($sku));
        }
    }
}
