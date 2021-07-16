<?php

/*
 * This file is part of the ftp-library package.
 *
 * (c) 2021 WEBEWEB
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\Library\Ftp\Tests;

use PHPUnit\Framework\TestCase;
use WBW\Library\Ftp\Security\Authenticator;
use WBW\Library\Ftp\Security\PasswordAuthentication;

/**
 * Abstract test case.
 *
 * @author webeweb <https://github.com/webeweb/>
 * @package WBW\Library\Ftp\Tests
 * @abstract
 */
abstract class AbstractTestCase extends TestCase {

    /**
     * Authenticator.
     *
     * @var Authenticator
     */
    protected $authenticator;

    /**
     * Password authentication.
     *
     * @var PasswordAuthentication
     */
    protected $passwordAuthentication;

    /**
     * {@inheritDoc}
     */
    protected function setUp(): void {
        parent::setUp();

        // Set a Password authentication mock.
        $this->passwordAuthentication = new PasswordAuthentication("user", "pass");

        // Set an Authenticator mock.
        $this->authenticator = new Authenticator("hostname", $this->passwordAuthentication);
        $this->authenticator->setPort(null);
    }
}
