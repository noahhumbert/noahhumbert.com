<?php
// src/Controller/TestController.php
#[Route('/trigger404')]
public function trigger404(): Response
{
    throw $this->createNotFoundException('Testing custom 404.');
}
?>