<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MountDrive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:mountdrive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Montage d\'un drive.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //return Command::SUCCESS;

        exec("echo 'user' | sudo -S mount.cifs -o user=projm1_21,pass=5IwEc39Y8h9T //192.168.176.2/projetm12021 /home/user/cryptolocker_V1.3/cryptolocker/storage/app/partage2");

        $this->info("commande has been executed.");
    }
}
