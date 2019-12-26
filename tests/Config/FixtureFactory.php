<?php

namespace Tests\Config;

use App\Entity;
use DateTime;
use ReflectionClass;

trait FixtureFactory
{
    /**
     * @param string $username
     * @param array|string $options If a string, specifies the users role, else an array of options
     */
    protected function createUserFixture($username, $options = [])
    {
        if (is_string($options)) {
            $options = ['roles' => $options];
        }

        $options = array_merge([
            'roles' => [ 'ROLE_USER' ],
            'password' => $username . 'pass',
            'email' => $username . '@email.com',
            'firstName' => 'Some',
            'surname' => 'User',
        ], $options);

        $options['roles'] = is_array($options['roles'])
            ? $options['roles']
            : [$options['roles']]
        ;
        
        $encoder = $this->getContainer()->get('security.password_encoder');
        $fixture =  new Entity\User();
        $fixture
            ->setUsername($username)
            ->setPassword($encoder->encodePassword($fixture, $options['password']))
            ->setFirstName($options['firstName'])
            ->setSurname($options['surname'])
            ->setEmail($options['email'])
            ->setRoles($options['roles'])
        ;

        return $fixture;
    }

    protected $defaultProjectType;
    protected function createProjectFixture(array $options = [])
    {
        $options = array_merge([
            'type' => $this->defaultProjectType,
            'property' => 'Some Project Property',
            'proposal' => 'Some Project Proposal',
            'reference' => 19005,
            'authorityReference' => null,
            'manager' => null,
            'active' => true,
            'zones' => []
        ], $options);
        
        if ($options['type'] === null) {
            $this->defaultProjectType = $this->createProjectTypeFixture('Some Project Type');
            $options['type'] = $this->defaultProjectType;
        }

        $fixture = new Entity\Project($options['reference']);
        $fixture
            ->setType($options['type'])
            ->setProposal($options['proposal'])
            ->setActive($options['active'])
            ->setAuthorityReference($options['authorityReference'])
            ->setManager($options['manager'])
        ;

        foreach ($options['zones'] as $zone) {
            $fixture->addZone($zone);
        }

        $fixture
            ->getProperty()
            ->setAddress1($options['property'])
        ;
        return $fixture;
    }

    protected function createProjectContactFixture(
        Entity\Project $project,
        Entity\Contact $contact,
        Entity\ContactType $type
    ) {
        $fixture = new Entity\ProjectContact();
        $fixture
            ->setProject($project)
            ->setContact($contact)
            ->setType($type)
        ;

        return $fixture;
    }

    protected function createProjectOrganisationFixture(
        Entity\Project $project,
        Entity\Organisation $organisation,
        Entity\OrganisationType $type
    ) {
        $fixture = new Entity\ProjectOrganisation();
        $fixture
            ->setProject($project)
            ->setOrganisation($organisation)
            ->setType($type)
        ;

        return $fixture;
    }

    protected function createOrganisationFixture(array $options = [])
    {
        $options = array_merge([
            'name' => 'Some Organisation',
            'active' => true,
        ], $options);
        
        $fixture = new Entity\Organisation();
        $fixture
            ->setName($options['name'])
            ->setActive($options['active'])
        ;

        return $fixture;
    }

    protected function createContactFixture(array $options = [])
    {
        $options = array_merge([
            'firstName' => 'Some',
            'surname' => 'Contact',
            'notes' => '',
            'organisation' => null,
        ], $options);
        
        $fixture = new Entity\Contact();
        $fixture
            ->setFirstName($options['firstName'])
            ->setSurname($options['surname'])
            ->setNotes($options['notes'])
            ->setOrganisation($options['organisation'])
        ;

        return $fixture;
    }

    protected function createDirectoryEmailFixture(Entity\Directory\DirectoryContainer $container, array $options = [])
    {
        $options = array_merge([
            'type' => Entity\Directory\Email::TYPE_WORK,
            'email' => 'some@email.com',
        ], $options);
        
        $fixture = new Entity\Directory\Email();
        $fixture
            ->setType($options['type'])
            ->setEmail($options['email'])
        ;

        $container->getDirectory()->addEmail($fixture);

        return $fixture;
    }

    protected function createDirectoryPhoneFixture(Entity\Directory\DirectoryContainer $container, array $options = [])
    {
        $options = array_merge([
            'type' => Entity\Directory\Phone::TYPE_WORK,
            'phone' => '03 5155 5555',
        ], $options);
        
        $fixture = new Entity\Directory\Phone();
        $fixture
            ->setType($options['type'])
            ->setPhone($options['phone'])
        ;

        $container->getDirectory()->addPhone($fixture);

        return $fixture;
    }

    protected function createDirectoryAddressFixture(Entity\Directory\DirectoryContainer $container, array $options = [])
    {
        $options = array_merge([
            'type' => Entity\Directory\Address::TYPE_WORK,
            'address1' => 'Address 1',
            'address2' => 'Address 2',
            'address3' => 'Address 3',
            'address4' => 'Address 4',
        ], $options);
        
        $fixture = new Entity\Directory\Address();
        $fixture
            ->setType($options['type'])
            ->setAddress1($options['address1'])
            ->setAddress2($options['address2'])
            ->setAddress3($options['address3'])
            ->setAddress4($options['address4'])
        ;

        $container->getDirectory()->addAddress($fixture);

        return $fixture;
    }

    protected function createProjectTypeFixture($name, array $options = [])
    {
        $options = array_merge([
            'taskDefinitions' => [],
        ], $options);

        $fixture = new Entity\ProjectType();
        $fixture
            ->setName($name)
        ;

        foreach ($options['taskDefinitions'] as $taskDefinition) {
            $fixture->addTaskDefinition($taskDefinition);
        }

        return $fixture;
    }

    protected function createContactTypeFixture($name, array $options = [])
    {
        $fixture = new Entity\ContactType();
        $fixture
            ->setName($name)
        ;

        return $fixture;
    }

    protected function createZoneFixture($code, $name, array $options = [])
    {
        $fixture = new Entity\Zone();
        $fixture
            ->setCode($code)
            ->setName($name)
        ;

        return $fixture;
    }

    protected function createOrganisationTypeFixture($name, array $options = [])
    {
        $fixture = new Entity\OrganisationType();
        $fixture
            ->setName($name)
        ;

        return $fixture;
    }

    protected function createProjectProposalFixture($name, array $options = [])
    {
        $fixture = new Entity\ProjectProposal();
        $fixture
            ->setName($name)
        ;

        return $fixture;
    }

    protected $taskDefinitionDisplayOrder = 1;
    protected function createTaskDefinitionFixture($name, array $options = [])
    {
        $options = array_merge([
            'dueDateInterval' => '+4weeks',
        ], $options);

        $fixture = new Entity\TaskDefinition();
        $fixture
            ->setName($name)
            ->setDisplayOrder($this->taskDefinitionDisplayOrder++)
            ->setDueDateInterval($options['dueDateInterval'])
        ;

        return $fixture;
    }

    protected $stepDefinitionDisplayOrders = [];
    protected function createStepDefinitionFixture($name, Entity\TaskDefinition $taskDefinition, array $options = [])
    {
        if (!isset($this->stepDefinitionDisplayOrders[$taskDefinition->getName()])) {
            $this->stepDefinitionDisplayOrders[$taskDefinition->getName()] = 1;
        }
        $fixture = new Entity\StepDefinition($taskDefinition);
        $fixture
            ->setName($name)
            ->setDisplayOrder($this->stepDefinitionDisplayOrders[$taskDefinition->getName()]++)
        ;
        $taskDefinition->addStepDefinition($fixture);

        return $fixture;
    }

    // protected function createTaskFixtures(Entity\Project $project, Entity\TaskDefinition $taskDefinition = null, array $options = [])
    // {
    //     $fixture = $this->createTaskFixture($project, $taskDefinition, $options);

    //     foreach 
    //     return $fixture;
    // }

    protected function createTaskFixture(Entity\Project $project, Entity\TaskDefinition $taskDefinition = null, array $options = [])
    {
        $options = array_merge([
            'name' => 'Some Task Name',
            'dueDate' => 'tomorrow',
            'completionDate' => null,
            'createdDate' => 'yesterday',
            'status' => Entity\Task::STATUS_PENDING,
        ], $options);
        
        $fixture = new Entity\Task($project);

        if ($options['status'] !== Entity\Task::STATUS_PENDING) {
            $fixture->setStatus($options['status']);
        }

        $fixture
            ->setName($options['name'])
            ->setTaskDefinition($taskDefinition)
            ->setCreatedDate(new DateTime($options['createdDate']))
            ->setDueDate(new DateTime($options['dueDate']))
            ->setCompletionDate(
                $options['completionDate']
                ? new DateTime($options['completionDate'])
                : null
            )
        ;

        return $fixture;
    }

    protected function createPermitFixture(Entity\Project $project, array $options = [])
    {
        $options = array_merge([
            'number' => $project->getAuthorityReference() ?? 'ASD123',
            'issuedDate' => '-1week',
            'expiryDate' => null,
        ], $options);
        
        $fixture = new Entity\Permit($project);

        $fixture
            ->setNumber($options['number'])
            ->setIssuedDate(new DateTime($options['issuedDate']))
            ->setExpiryDate(
                $options['expiryDate']
                ? new DateTime($options['expiryDate'])
                : null
            )
        ;

        return $fixture;
    }
}
