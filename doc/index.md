DOCUMENTATION
=============

Authentication

```php
// Create a password authentication.
$authentication = new PasswordAuthentication("user", "pass");

// Create an authenticator.
$authenticator = new Authenticator("hostname", $authentication);
```

FTP client

```php
// Create the client.
$client = new FtpClient($authenticator);

// Open the connection.
$client->connect();
$client->login();

// ...

// Close the connection.
$client->close();
```

FTPS client

```php
// Create the client.
$client = new FtpsClient($authenticator);

// Open the connection.
$client->connect();
$client->login();

// ...

// Close the connection.
$client->close();
```

sFTP client

```php
// Create the client.
$client = new SftpClient($authenticator);

// Open the connection.
$client->connect();
$client->login();

// ...

// Close the connection.
$client->close();
```