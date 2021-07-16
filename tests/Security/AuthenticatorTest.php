<?php

/*
 * This file is part of the ftp-library package.
 *
 * (c) 2018 WEBEWEB
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\Library\Ftp\Tests\Security;

use WBW\Library\Ftp\Security\Authenticator;
use WBW\Library\Ftp\Security\PasswordAuthentication;
use WBW\Library\Ftp\Tests\AbstractTestCase;

/**
 * Authenticator test.
 *
 * @author webeweb <https://github.com/webeweb/>
 * @package WBW\Library\Ftp\Tests\Security
 */
class AuthenticatorTest extends AbstractTestCase {

    /**
     * Tests the setPasswordAuthentication() method.
     *
     * @return void
     */
    public function testSetPasswordAuthentication(): void {

        $obj = new Authenticator(null, $this->passwordAuthentication);

        $obj->setPasswordAuthentication(new PasswordAuthentication(null, null));
        $this->assertNull($obj->getPasswordAuthentication()->getUsername());
        $this->assertNull($obj->getPasswordAuthentication()->getPassword());
    }

    /**
     * Tests the setScheme() method.
     *
     * @return void
     */
    public function testSetScheme(): void {

        $obj = new Authenticator(null, $this->passwordAuthentication);

        $obj->setScheme("scheme");
        $this->assertEquals("scheme", $obj->getScheme());
    }

    /**
     * Tests the __construct() method.
     *
     * @return void
     */
    public function test__construct(): void {

        $obj = new Authenticator(null, $this->passwordAuthentication);

        $this->assertNull($obj->getHostname());
        $this->assertSame($this->passwordAuthentication, $obj->getPasswordAuthentication());
        $this->assertNull($obj->getPort());
        $this->assertNull($obj->getScheme());
    }
}
