<?php

/**
 * This file is part of the ftp-library package.
 *
 * (c) 2018 WEBEWEB
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\Library\FTP\Tests\Exception;

use PHPUnit_Framework_TestCase;
use WBW\Library\FTP\Exception\FTPException;

/**
 * FTP exception test.
 *
 * @author webeweb <https://github.com/webeweb/>
 * @package WBW\Library\FTP\Tests\Exception
 */
final class FTPExceptionTest extends PHPUnit_Framework_TestCase {

    /**
     * Tests the __construct() method.
     *
     * @return void
     */
    public function testConstruct() {

        $obj = new FTPException("exception");

        $res = "exception";
        $this->assertEquals($res, $obj->getMessage());
    }

}
