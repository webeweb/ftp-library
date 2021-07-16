<?php

/*
 * This file is part of the ftp-library package.
 *
 * (c) 2018 WEBEWEB
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\Library\Ftp\Tests\Exception;

use WBW\Library\Ftp\Exception\FtpException;
use WBW\Library\Ftp\Tests\AbstractTestCase;

/**
 * FTP exception test.
 *
 * @author webeweb <https://github.com/webeweb/>
 * @package WBW\Library\Ftp\Tests\Exception
 */
class FtpExceptionTest extends AbstractTestCase {

    /**
     * Tests the __construct() method.
     *
     * @return void
     */
    public function test__construct(): void {

        $obj = new FtpException("exception");

        $res = "exception";
        $this->assertEquals($res, $obj->getMessage());
    }
}
