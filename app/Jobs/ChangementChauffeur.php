<?php

namespace App\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use App\Notifications\AgentNotification;
use App\Notifications\ChangementChauffeurAgentNotification;
use App\Notifications\ChangementChauffeurNotifications;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ChangementChauffeur implements ShouldQueue
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
        if($this->data->chauffeur != $this->data->agent){
            try {
                
                $this->data->chauffeur->notify(new ChangementChauffeurNotifications($this->data));
                $this->data->agent->notify(new ChangementChauffeurAgentNotification($this->data));
                // dd("message envoyé");
            } catch (Exception $e) {
                // print($e);
            }
        
            
        }
        else{
            try {
                $this->data->agent->notify(new ChangementChauffeurAgentNotification($this->data));
            } catch (Exception $e) {
                // print($e);
            }
        }
    }
}
