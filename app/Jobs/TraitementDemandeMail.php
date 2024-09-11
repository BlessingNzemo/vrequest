<?php

namespace App\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\ManagerNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Notifications\ChauffeurNotification;
use App\Notifications\AgentNotificationDemandeAcceptee;
use App\Notifications\MailCharroiToAgentDemandeRejecte;

class TraitementDemandeMail implements ShouldQueue
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
        if($this->data->etat == 'traitée'){
            try {
                $this->data->agent->notify(new AgentNotificationDemandeAcceptee($this->data));
                $this->data->manager->notify(new ManagerNotification($this->data));
                $this->data->chauffeur->notify(new ChauffeurNotification($this->data));
            } catch (Exception $e) {
                // print($e);
            }
        }
        elseif($this->data->etat == 'rejetée'){
            try{
                $this->data->sender->notify(new MailCharroiToAgentDemandeRejecte($this->data));
            }catch(Exception $e){
                //print($e);
            }
        }
        
    }
}
