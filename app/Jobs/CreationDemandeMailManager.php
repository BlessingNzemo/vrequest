<?php

namespace App\Jobs;

use Exception;
use App\Models\Demande;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\ManagerNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Notifications\UserDelegueNotification;

class CreationDemandeMailManager implements ShouldQueue
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
        if($this->data->to == 'manager'){
            try {
                $this->data->sender->notify(new ManagerNotification($this->data));
            } catch (Exception $e) {
                print($e);
            }
        }elseif($this->data->to == 'delegue'){
            try {
                $this->data->sender->notify(new UserDelegueNotification($this->data));
            } catch (Exception $e) {
                print($e);
            }
        }
    }
}
