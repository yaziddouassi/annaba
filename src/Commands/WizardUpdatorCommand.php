<?php

namespace  Annaba\Annaba\Commands;

use Illuminate\Console\Command;
use App\Models\User; // Ensure you import the User model
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class WizardUpdatorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'annaba:wizard-updator';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a annaba form on update';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Ask for user input with validation
        $form = $this->askRequired('Nom du formulaire?');
        $model = $this->askRequired('Nom du model?');

        $CreateString = new \Annaba\Annaba\Utils\TransformString();

        $create1 = $model;
        $create2 = $CreateString->transformDatabase($model);
        $create3 = "App\\Models\\" . $model;
        $create4 = "livewire.annaba." . $form ;
        $create5 = Str::ucfirst($form);

        $chemin1  = 'app/Livewire/Annaba/' . $create5 . '.php' ;
        $chemin2  = 'resources/views/livewire/annaba/' . $form . '.blade.php' ;

        if (!File::exists("app/Livewire/Annaba")) {
            File::makeDirectory("app/Livewire/Annaba", 0755, true);
        }

        if (!File::exists("resources/views/livewire/annaba")) {
            File::makeDirectory("resources/views/livewire/annaba", 0755, true);
        }

        // Check if files already exist
        if (File::exists($chemin1)) {
            $this->error("Le fichier existe déjà: " . $chemin1);
            if (!$this->confirm('Voulez-vous écraser ce fichier?')) {
                $this->info('Opération annulée.');
                return Command::FAILURE;
            }
        }

        if (File::exists($chemin2)) {
            $this->error("Le fichier existe déjà: " . $chemin2);
            if (!$this->confirm('Voulez-vous écraser ce fichier?')) {
                $this->info('Opération annulée.');
                return Command::FAILURE;
            }
        }

        $crud = new \Annaba\Annaba\Utils\WizardUpdator();

        $contenu = $crud->getContenu($create1,$create2,$create3,$create4,$create5);
        $view = $crud->getView();
       
        File::put($chemin1 , $contenu);
        File::put($chemin2 , $view);
        
        $this->newLine();
        $this->info('✓ Formulaire bien créé!');
         
        return Command::SUCCESS;
    }

    /**
     * Ask a question and ensure the answer is not empty
     *
     * @param string $question
     * @return string
     */
    protected function askRequired(string $question): string
    {
        $answer = $this->ask($question);

        while (empty(trim($answer))) {
            $this->error('Ce champ est obligatoire!');
            $answer = $this->ask($question);
        }

        return trim($answer);
    }
}