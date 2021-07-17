<?php

/*
 * This file is part of the ftp-library package.
 *
 * (c) 2021 WEBEWEB
 *
 * For the full copyright and license information please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\Library\Ftp\Tests\Client;

use Exception;
use WBW\Library\Ftp\Client\FtpsClient;
use WBW\Library\Ftp\Tests\AbstractTestCase;

/**
 * FTPs client test.
 *
 * @author webeweb <https://github.com/webeweb/>
 * @package WBW\Library\Ftp\Tests\Client
 */
class FtpsClientTest extends AbstractTestCase {

    /**
     * {@inheritDoc}
     */
    protected function setUp(): void {
        parent::setUp();

        // Set the Authenticator mock.
        $this->authenticator->setPort(21);
    }

    /**
     * Tests the connect() method.
     *
     * @return void
     * @throws Exception Throws an exception if an error occurs.
     */
    public function testConnect(): void {

        $obj = new FtpsClient($this->authenticator);

        $this->assertSame($obj, $obj->connect());

        $obj->close();
    }

    /**
     * Tests the __construct() method.
     *
     * @return void
     */
    public function test__construct(): void {

        // Set the Authenticator mock.
        $this->authenticator->setPort(null);

        $obj = new FtpsClient($this->authenticator);

        $this->assertSame($this->authenticator, $obj->getAuthenticator());
        $this->assertNull($obj->getConnection());

        $this->assertEquals(990, $obj->getAuthenticator()->getPort());
    }
}