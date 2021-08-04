<?php

namespace App\Command;

use App\Repository\FormImportRepository;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FormImport extends Command
{
    private $importRepository;
    public function __construct(string $name = null,FormImportRepository $importRepository)
    {
        $this->importRepository=$importRepository;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this->setName('formImport')
            ->setDescription('download books from db')
            ->setHelp('This command will download form data an store in db');
         $this->addArgument('shopid',InputArgument::REQUIRED,'entre the shop id');
        $this->addArgument('password',InputArgument::REQUIRED,'password of the shop');

    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $base_uri = 'https://sff.coddle.de/api/v2/';
        $header = [
            'interface-id' =>  $input->getArgument('shopid'),
            'interface-password'=> $input->getArgument('password')
        ];

        $client = new \GuzzleHttp\Client(['base_uri' => $base_uri]);
        try {
            $res = $client->request('GET', 'forms', [ 'headers' => $header]);
            $status = $res->getStatusCode();
            $data = $res->getBody();

            $data =json_decode($data, true);
            $this->importRepository->insertForms($data['data'],$input->getArgument('shopid'));

        }catch (ClientException $e)
        {
            echo Psr7\Message::toString($e->getRequest());
            echo Psr7\Message::toString($e->getResponse());
        }

    }

}