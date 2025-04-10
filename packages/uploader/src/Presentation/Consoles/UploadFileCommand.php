<?php

namespace Udhuong\Uploader\Presentation\Consoles;

use Illuminate\Console\Command;
use Udhuong\Uploader\Facades\Upload;

class UploadFileCommand  extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'upload:test {--path=} {--url=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test upload file';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $url = $this->option('url');
        Upload::uploadSinkFromUrl($url);
        $this->info('File uploaded successfully');
    }
}
