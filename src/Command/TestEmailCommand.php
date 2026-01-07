<?php
// src/Command/TestEmailCommand.php
namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class TestEmailCommand extends Command
{
    protected static $defaultName = 'app:test-email';
    protected static $defaultDescription = 'Send a test email via SES';

    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        parent::__construct();
        $this->mailer = $mailer;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $email = (new Email())
            ->from('noreply@noahhumbert.com')
            ->to('noah@noahhumbert.com')
            ->subject('SES Test Email')
            ->text('Hello! This is a test email via Amazon SES.');

        try {
            $this->mailer->send($email);
            $output->writeln('Email sent successfully!');
        } catch (\Exception $e) {
            $output->writeln('Email failed: ' . $e->getMessage());
        }

        return Command::SUCCESS;
    }
}
