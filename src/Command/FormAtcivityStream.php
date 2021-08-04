<?php

namespace App\Command;

use GuzzleHttp\Exception\ClientException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use GuzzleHttp\Psr7;

class FormAtcivityStream extends Command
{
    public function __construct(string $name = null)
    {
        parent::__construct($name);
    }

    protected function configure()
{
    $this->setName('FormActivityImport')
        ->setDescription('download activity stream of specific duration')
        ->setHelp('This command will download activity data an store in db');
        $this->addArgument('shopid',InputArgument::REQUIRED,'entre the shop id');
        $this->addArgument('password',InputArgument::REQUIRED,'password of the shop');
        $this->addArgument('start_date',InputArgument::REQUIRED,'entre start date');
        $this->addArgument('end_date',InputArgument::REQUIRED,'entre end date');
}

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $base_uri = 'https://sff.coddle.de/api/v2/forms/';
//        $query = $input->getArgument('form_id') . '/questions';
        $query = $base_uri.'activity_stream'.'?start_date='.$input->getArgument('start_date').'&end_date='.$input->getArgument('end_date');
//        dd($query);
        $header = [
            'interface-id' =>  $input->getArgument('shopid'),
            'interface-password'=> $input->getArgument('password'),
//
        ];

        $client = new \GuzzleHttp\Client(['base_uri' => $base_uri]);
//        dd($client);
        try {
            $res = $client->request('GET', $query, ['headers' => $header]);
//            dd($res);
            $status = $res->getStatusCode();
            $data = $res->getBody();

            $data =json_decode($data, true);
        print_r( $data);
        die();
//            $this->formQuestionImport->insertFormQuestions($data['data'],$input->getArgument('shopid'));

        } catch (ClientException $e) {
//            echo Psr7\Message::toString($e->getRequest());
//            echo Psr7\Message::toString($e->getResponse());
        echo $e->getMessage();
        }
    }
}