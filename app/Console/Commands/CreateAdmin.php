<?php

namespace App\Console\Commands;

use App\Models\Admin;
use App\Models\Kasir;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
     /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create-admin {name=Administrator} {email=admin@admin.com} {password=password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Administrator model with super privileges';

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
     * Get string argument.
     *
     * @param string $key
     * @param string $default
     *
     * @return string
     */
    protected function getStringArgument(string $key, string $default): string
    {
        return is_string($this->argument($key)) ? $this->argument($key) : $default;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $email = $this->getStringArgument('email', 'admin@admin.com');

        $newAdmin = Kasir::create([
            'nama'     => $this->argument('name'),
            'email'    => $email,
            'alamat'=>'xxx',
            'password' => Hash::make($this->getStringArgument('password', 'password')),
        ]);

        $newAdmin->assignRole('Kasir');

        $this->line('<info>Admin '.$email.' has been created.</info>');
    }
}
