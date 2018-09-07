<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    private $notices;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(\App\Notices $notices)
    {
        $this->notices = $notices;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // ����Ҫ��������
        // ֪ͨÿ���û�ϵͳ��Ϣ
        $users = \App\Users::all();
        foreach ($users as $user){
            $user->addNotice($this->notices);
        }
    }
}
