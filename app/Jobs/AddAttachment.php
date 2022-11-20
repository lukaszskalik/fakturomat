<?php

namespace App\Jobs;

use App\Models\Attachment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AddAttachment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $path;
    protected $invoiceId;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $path, int $invoiceId)
    {
        $this->path = $path;
        $this->invoiceId = $invoiceId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $attachment = new Attachment();
        $attachment->path = $this->path;
        $attachment->invoice_id = $this->invoice->id;
        $attachment->save();
    }
}
