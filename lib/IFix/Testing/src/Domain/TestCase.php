<?php

namespace IFix\Testing\Domain;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Generic test helpers for use in a domain context.
 */
abstract class TestCase extends KernelTestCase
{
    /**
     * Get the assert.
     *
     * @return Assert
     */
    abstract public function getAssert();
}
