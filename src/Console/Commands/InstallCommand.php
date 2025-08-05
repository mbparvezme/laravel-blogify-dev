<?php

namespace Forphp\LaravelBlogify\Console\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'blogify:install';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Install all of the Blogify resources';

  /**
   * Execute the console command.
   */
  public function handle(): void
  {
    $this->info('Installing Blogify...');

    // Publish the configuration file
    $this->comment('Publishing configuration...');
    $this->call('vendor:publish', [
      '--provider' => 'Forphp\LaravelBlogify\BlogifyServiceProvider',
      '--tag' => 'blogify-config'
    ]);

    // Ask to run migrations
    if ($this->confirm('Would you like to run the migrations now?')) {
      $this->comment('Running migrations...');
      $this->call('migrate');
    }

    $this->info('Blogify installed successfully.');
  }
}
