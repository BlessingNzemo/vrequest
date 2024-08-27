<?php

namespace App\Jobs;

use App\Notifications\AgentNotification;
use App\Notifications\AgentNotificationDemandeAcceptee;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use App\Notifications\ChefCharroiEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ValidationManagerDemandeMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public $data)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if($this->data->to == 'chef_charroi'){
            try {
                $this->data->sender->notify(new ChefCharroiEmail($this->data));
            } catch (Exception $e) {
                // print($e);
            }
        }elseif($this->data->to == 'agent'){
            try {
                $this->data->sender->notify(new AgentNotification($this->data));
            } catch (Exception $e) {
                // print($e);
            }
        }
        
    }
}
