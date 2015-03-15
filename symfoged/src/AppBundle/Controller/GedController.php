<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Finder\Finder;

class GedController extends Controller
{   
    public function indexAction()
    {
    	$finder = new Finder();
    	$finder->files()->in($this->getRequest()->server->get('DOCUMENT_ROOT').'/documents');
    	
    	$ext = "";
    	
    	foreach ($finder as $file) {
    		// Print the absolute path
    		$ext .= $file->getRealpath()."- \n";
    	
    		// Print the relative path to the file, omitting the filename
    		$ext .= $file->getRelativePath()."- \n";
    	
    		// Print the relative path to the file
    		$ext .= $file->getRelativePathname()."- \n";
    	}
    	
    	return $this->render('AppBundle:Ged:index.html.twig', array("ext" => $ext));
    }
}
