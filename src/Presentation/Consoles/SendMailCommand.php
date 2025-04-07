<?php

namespace App\Presentation\Consoles;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendMailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send-mail-test {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test gửi mail';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $email = $this->argument('email');
        $htmlContent = '<h1>Welcome to our service</h1><p>Thank you for signing up.</p>';

        $result = Mail::html($htmlContent, static function ($message) use ($email) {
            $message->to($email)->subject('Welcome to our service Laravel-base');
        });
        dump($result);
        $this->info('Gửi mail thành công');
    }
}
