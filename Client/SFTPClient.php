<?php

/**
 * This file is part of the ftp-library package.
 *
 * (c) 2018 WEBEWEB
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\Library\FTP\Client;

use WBW\Library\Core\Security\Authenticator;

/**
 * SFTP client.
 *
 * @author webeweb <https://github.com/webeweb/>
 * @package WBW\Library\FTP\Client
 */
class SFTPClient extends AbstractFTPClient {

    /**
     * Constructor.
     *
     * @param Authenticator $authenticator The authenticator.
     */
    public function __construct(Authenticator $authenticator) {
        parent::__construct($authenticator);
        $this->getAuthenticator()->setScheme("sftp");
        if (null === $this->getAuthenticator()->getPort()) {
            $this->getAuthenticator()->setPort(22);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function connect($timeout = 90) {
        $host = $this->getAuthenticator()->getHost();
        $port = $this->getAuthenticator()->getPort();
        $this->setConnection(@ftp_ssl_connect($host, $port, $timeout));
        if (false === $this->getConnection()) {
            throw $this->newFTPException("connection failed");
        }
        return $this;
    }

}