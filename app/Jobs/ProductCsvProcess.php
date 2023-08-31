<?php

namespace App\Jobs;

use App\Events\ProductCreated;
use App\Models\Product;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProductCsvProcess implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->data as $row) {
            $sku = $row['handle'];

            if (!Product::where('sku', $sku)->exists())
            {
                 Product::create([
                    'title' => $row['title'],
                    'description' => $row['body_html'],
                    'sku' => $row['handle'],
                    'type' => $row['type'],
                    'status' => $row['published'],
                ]);
            }
               
            // this code will send email if duplicate sku found
            event(new ProductCreated($sku));
        }
    }
}