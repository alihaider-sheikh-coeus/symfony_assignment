<?php

namespace App\Command;

use App\Entity\FormQuestionImport;
use App\Repository\FormQuestionImportRepository;
use GuzzleHttp\Exception\ClientException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use GuzzleHttp\Psr7;

class FormquestionsImport extends Command
{
    private $formQuestionImport;
    public function __construct(string $name = null,FormQuestionImportRepository $formQuestionImportRepository)
    {
        $this->formQuestionImport=$formQuestionImportRepository;
        parent::__construct($name);
    }

    protected function configure()
{
$this->setName('ImportFormQuestions')
    ->setDescription('download questions of form')
    ->setHelp('This command will download form data an store in db');
    $this->addArgument('shopid',InputArgument::REQUIRED,'entre the shop id');
    $this->addArgument('password',InputArgument::REQUIRED,'password of the shop');
    $this->addArgument('form_id',InputArgument::REQUIRED,'entre form id');
}
protected function execute(InputInterface $input, OutputInterface $output)
{
    $base_uri = 'https://sff.coddle.de/api/v2/forms/';
    $path = $input->getArgument('form_id') . '/questions';
    $header = [
        'interface-id' =>  $input->getArgument('shopid'),
        'interface-password'=> $input->getArgument('password'),
    ];

    $client = new \GuzzleHttp\Client(['base_uri' => $base_uri]);
    try {
        $res = $client->request('GET', $path, ['headers' => $header]);
        $status = $res->getStatusCode();
        $data = $res->getBody();

        $data =json_decode($data, true);
//        print_r( $data['data']);
//        die();
        $this->formQuestionImport->insertFormQuestions($data['data'],$input->getArgument('shopid'));

    } catch (ClientException $e) {
        echo Psr7\Message::toString($e->getRequest());
        echo Psr7\Message::toString($e->getResponse());
//        echo $e->getMessage();
    }
}
}