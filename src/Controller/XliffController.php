<?php

namespace App\Controller;

use App\Entity\XliffElement;
use App\Service\XliffConstruct;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Task;
use App\Form\Type\TaskType;
use Symfony\Component\HttpFoundation\Response;

class XliffController extends Controller
{
    /**
     * @Route("/", name="xliff")
     */
    public function new(Request $request)
    {

        // only set default values if there is no upload present
        //if ($request->files->count() == 0) {

        $task = new Task();

        $xliffElement1 = new XliffElement();
        $task->getXliffElements()->add($xliffElement1);
        $xliffElement2 = new XliffElement();
        $task->getXliffElements()->add($xliffElement2);

        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            if(is_object($task->getXlfFile())){

                //load xlf file and convert it to an php array
                $xlfFileContent = file_get_contents($task->getXlfFile()->getPathname());
                $xml = simplexml_load_string($xlfFileContent, "SimpleXMLElement", LIBXML_NOCDATA);
                $json = json_encode($xml);
                $array = json_decode($json,TRUE);

                // clear default values for XLF File
                $task = new Task();

                //set the file attributes
                $sourceLanguage = $array['file']['@attributes']['source-language'] ?? 'en';
                $targetLanguage = $array['file']['@attributes']['target-language'] ?? NULL;
                $productName = $array['file']['@attributes']['product-name'] ?? 'extension';

                $task->setSourceLanguage($sourceLanguage);
                $task->setTargetLanguage($targetLanguage);
                $task->setProductName($productName);

                if(is_array($array['file']['body']['trans-unit'])){

                    //set the elements from the xlf file
                    $xliffElements = [];
                    foreach ($array['file']['body']['trans-unit'] as $key=>$element){
                        $xliffElements[$key] = new XliffElement();
                        if(isset($element['target'])){
                           $xliffElements[$key]->setTarget($element['target']);
                        }
                        if(isset($element['source'])){
                            $xliffElements[$key]->setSource($element['source']);
                        }
                        if(isset($element['@attributes']['id'])){
                            $xliffElements[$key]->setId($element['@attributes']['id']);
                        }

                        $task->getXliffElements()->add($xliffElements[$key]);
                    }
                }
                $form = $this->createForm(TaskType::class, $task);
                return $this->render('xliff/index.html.twig', [
                    'form' => $form->createView(),
                ]);

            }

            // set the file attributes manually added
            $sourceLanguage = $form->getData()->getSourceLanguage() ?? 'en';
            $targetLanguage = $form->getData()->getTargetLanguage() ?? NULL;
            $productName = $form->getData()->getProductName() ?? 'extension';
            $xliff = new XliffConstruct($sourceLanguage,$targetLanguage,$productName);

            // set the elements attributes manually added
            foreach($form->getData()->getXliffElements() as $element){
                $xliff->addPhrase($element->getSource(),$element->getTarget(),$element->getId());
            }

            $response = new Response($xliff->getDocument());
            $response->headers->set('Content-Type', 'xml');

            return $response;
        }

        return $this->render('xliff/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
