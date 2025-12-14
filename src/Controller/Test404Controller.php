<?php
// src/Controller/TestController.php
#[Route('/test404')]
public function trigger404(): Response
{
    throw $this->createNotFoundException('Testing custom 404.');
}
?>