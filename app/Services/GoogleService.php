<?php

namespace  App\Services;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Carbon\Carbon;

class GoogleService{

    protected $client;

    protected $service;

    protected $file;

    public function __construct()
    {
        //Create Client
        $this->client = new \Google_Client();
        //Create Service GGDrive
        $this->service = new \Google_Service_Drive($this->getClient());
        // Create Service upload data
        $this->file = new \Google_Service_Drive_DriveFile();
    }


    function getClient()
    {
        $this->client->setApplicationName('Google Drive');
        $this->client->setScopes(\Google_Service_Drive::DRIVE);
        $this->client->setAuthConfig(config('google-api.client_path'));
        $this->client->setAccessType('offline');
        $this->client->setPrompt('select_account consent');

        $tokenPath = config('google-api.token_path');
        if (file_exists($tokenPath)) {
            $accessToken = json_decode(file_get_contents($tokenPath), true);
            $this->client->setAccessToken($accessToken);
        }
        if ($this->client->isAccessTokenExpired()) {
            if ($this->client->getRefreshToken()) {
                $this->client->fetchAccessTokenWithRefreshToken($this->client->getRefreshToken());
            } else {
                $authUrl = $this->client->createAuthUrl();
                printf("Open the following link in your browser:\n%s\n", $authUrl);
                print 'Enter verification code: ';

                $authCode = trim($_GET['code']);
                $accessToken = $this->client->fetchAccessTokenWithAuthCode($authCode);
                $this->client->setAccessToken($accessToken);

                // Check to see if there was an error.
                if (array_key_exists('error', $accessToken)) {
                    throw new \Exception(join(', ', $accessToken));
                }
            }
            // Save the token to a file.
            if (!file_exists(dirname($tokenPath))) {
                mkdir(dirname($tokenPath), 0700, true);
            }
            file_put_contents($tokenPath, json_encode($this->client->getAccessToken()));
        }
        return $this->client;
    }

    public function uploadFileGoogleDrive($file){
        $fileName = $file->getClientOriginalName();
        $this->setBodyUploadData($fileName);
        $this->service->files->create(
            $this->file,
            array(
              'data' => file_get_contents($file->getRealPath()),
              'mimeType' => 'application/octet-stream',
              'uploadType' => 'resumable'
            )
        );
    }

    public function setBodyUploadData($fileName){
        $this->file->setName($fileName);
        // Id is a folder name
        $this->file->setParents(config('google-api.google_folder'));
    }

    public function dumpData(){
        //$filename = "backup-" . Carbon::now()->format('Y-m-d-His') . ".sql";
        $command = "/usr/bin/mysqldump --user=" . env('DB_USERNAME') ." --password=" . env('DB_PASSWORD') . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE') . " > " . storage_path( "/google/data/test.sql") ;
        //$command = storage_path('google/dump.sh');
        // \Spatie\DbDumper\Databases\MySql::create()
        //     ->setDbName(env('DB_HOST'))
        //     ->setUserName(env('DB_USERNAME'))
        //     ->setPassword(env('DB_PASSWORD') )
        //     ->dumpToFile($filename);
        // $process = new Process([$command]);
        // $process->run();
        // if (!$process->isSuccessful()) {
        // throw new ProcessFailedException($process);
        // }
        //echo $process->getOutput();
        //'RET=`docker exec -it db_laravel /usr/bin/mysqldump -u root --password=root root > /home/duong/laravel/laravel/storage/google/data/backup.sql`;echo $RET'
        //echo shell_exec('docker images');
        dump($command);
        exit;
        exec($command);
        // return $filename;
    }
}
