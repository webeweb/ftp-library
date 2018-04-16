<?php

/**
 * This file is part of the core-library package.
 *
 * (c) 2018 NdC/WBW
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\Library\FTP\Tests\Client;

use Exception;
use PHPUnit_Framework_TestCase;
use WBW\Library\Core\Exception\IO\IOException;
use WBW\Library\Core\Security\Authenticator;
use WBW\Library\Core\Security\PasswordAuthentication;
use WBW\Library\FTP\Client\FTPClient;

/**
 * FTP client test.
 *
 * @author webeweb <https://github.com/webeweb/>
 * @package WBW\Library\Core\Tests\Net
 * @final
 */
final class FTPClientTest extends PHPUnit_Framework_TestCase {

    /**
     * Authenticator (read-only).
     *
     * @var Authenticator
     */
    private $authenticatorR;

    /**
     * Authenticator (read-write).
     *
     * @var Authenticator
     */
    private $authenticatorW;

    /**
     * {@inheritdoc}
     */
    protected function setUp() {
        parent::setUp();

        // Set a Password authentication.
        $passwordAuthenticationR = new PasswordAuthentication("anonymous", "guest");
        $passwordAuthenticationW = new PasswordAuthentication("dlpuser@dlptest.com", "eiTqR7EMZD5zy7M");

        // Set the Authenticator mocks.
        $this->authenticatorR = new Authenticator("speedtest.tele2.net", $passwordAuthenticationR);
        $this->authenticatorW = new Authenticator("ftp.dlptest.com", $passwordAuthenticationW);
    }

    /**
     * Tests the __construct() method.
     *
     * @return void
     */
    public function testConstructor() {

        $obj = new FTPClient($this->authenticatorR);

        $this->assertEquals($this->authenticatorR, $obj->getAuthenticator());
    }

    /**
     * Tests the connect() method.
     *
     * @return void
     */
    public function testConnect() {

        $obj = new FTPClient($this->authenticatorR);

        $this->assertEquals($obj, $obj->connect());

        try {
            $obj->getAuthenticator()->setHost("github.com");
            $obj->connect(2);
        } catch (Exception $ex) {
            $this->assertInstanceOf(IOException::class, $ex);
            $this->assertEquals("ftp://anonymous:guest@github.com:21 connection failed", $ex->getMessage());
        }
    }

    /**
     * Tests the login() method.
     *
     * @return void
     * @depends testConnect
     */
    public function testLogin() {

        $obj = new FTPClient($this->authenticatorR);
        $obj->connect();

        $this->assertEquals($obj, $obj->login());
    }

    /**
     * Tests the mkdir() method.
     *
     * @return void
     * @depends testLogin
     */
    public function testMkdir() {

        $obj = new FTPClient($this->authenticatorW);
        $obj->connect();
        $obj->login();

        $this->assertEquals($obj, $obj->mkdir("ftp-library"));
    }

    /**
     * Tests the close() method.
     *
     * @return void
     * @depends testConnect
     */
    public function testClose() {

        $obj = new FTPClient($this->authenticatorR);
        $obj->connect();

        $this->assertEquals($obj, $obj->close());
    }

}
