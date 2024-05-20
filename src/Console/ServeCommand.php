<?php

namespace Federation\UI\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ServeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'federation:ui:serve';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start a local development server that serves federation static files';

    public function handle()
    {
        $host = config('federation_ui.server.host');
        $port = config('federation_ui.server.port');
        $path = __DIR__ . "/../../public";
        $router = __DIR__ . "/../../dev-server.php";
        $this->info(<<<TEXT
        ╔═╗╔═╗╔╦╗╔═╗╦═╗╔═╗╔╦╗╦╔═╗╔╗╔
        ╠╣ ║╣  ║║║╣ ╠╦╝╠═╣ ║ ║║ ║║║║ 
        ╚  ╚═╝═╩╝╚═╝╩╚═╩ ╩ ╩ ╩╚═╝╝╚╝   

        Starting local file server on [http://$host:$port]"

        TEXT);
        $res = Process::forever()->run("php -S $host:$port -t $path $router");
        return $res->exitCode();
    }
}