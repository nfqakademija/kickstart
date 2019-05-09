<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Security\Core\User\UserInterface;

class PromoteUserCommand extends Command
{
    protected static $defaultName = 'app:promote-user';

    /** @var EntityManagerInterface */
    private $entityManager;
    private $adminRole;

    /**
     * PromoteUserCommand constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager, $adminRole = 'ROLE_ADMIN')
    {
        $this->entityManager = $entityManager;
        $this->adminRole = $adminRole;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Make user admin')
            ->addArgument('email', InputArgument::REQUIRED, 'E-mail address of existing user');
    }

    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Parsing input
        $io = new SymfonyStyle($input, $output);
        $email = $input->getArgument('email');

        // Getting user
        $this->info("Searching for user", $email, $io);
        $user = $this->entityManager->getRepository(User::class)->findByEmail($email);
        if (!$user) {
            $io->error("Cannot find user by e-mail: " . $email);
            return;
        }

        if (in_array($this->adminRole, $user->getRoles())) {
            $this->printUserRoles($user, $io);
            $io->success('Admin role already exists');
            return;
        }

        // Adding admin role
        $this->info("Adding role: ", $this->adminRole, $io);
        $roles = $user->getRoles();
        $roles[] = $this->adminRole;
        $user->setRoles(array_unique($roles));

        // Storing user
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $this->printUserRoles($user, $output);
        $io->success('Admin role successfully added');
    }

    private function info($message, $value, OutputInterface $io)
    {
        $io->writeln(sprintf('<info>%s</info>: <comment>%s</comment>', $message, $value));
    }

    private function printUserRoles(UserInterface $user, OutputInterface $io)
    {
        $io->writeln(
            "<info>User roles</info>: <comment>" . join('</comment>, <comment>', $user->getRoles()) . '</comment>'
        );
    }
}
