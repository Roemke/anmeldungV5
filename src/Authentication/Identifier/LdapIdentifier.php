<?php
declare(strict_types=1);

namespace App\Authentication\Identifier;

use App\Service\Ldap\LdapService;
use Authentication\Identifier\IdentifierInterface;

final class LdapIdentifier implements IdentifierInterface
{
    /** @var array<string, mixed> */
    private array $config;

    /** @var array<string, string> */
    private array $errors = [];

    private LdapService $ldapService;

    /**
     * @param array<string, mixed> $config
     */
    public function __construct(array $config = [])
    {
        // Minimal sinnvolle Defaults
        $this->config = $config + [
            'fields' => [
                'username' => 'username',
                'password' => 'password',
            ],
            'host' => 'ldap://localhost',
            'baseDn' => 'ou=people,dc=local,dc=dev',
        ];

        $this->ldapService = new LdapService(
            (string)$this->config['host'],
            (string)$this->config['baseDn']
        );
    }

    /**
     * Identify a user based on credentials.
     *
     * @param array<string, mixed> $credentials
     * @return array<string, mixed>|null
     */
    public function identify(array $credentials): ?array
    {
        $this->errors = [];

        $fields = (array)$this->config['fields'];
        $userField = (string)($fields['username'] ?? 'username');
        $passField = (string)($fields['password'] ?? 'password');

        $username = $credentials[$userField] ?? null;
        $password = $credentials[$passField] ?? null;

        if (!is_string($username) || $username === '' || !is_string($password) || $password === '') {
            $this->errors['credentials'] = 'Missing username or password.';
            return null;
        }

        if (!$this->ldapService->authenticate($username, $password)) {
            $this->errors['credentials'] = 'Invalid username or password.';
            return null;
        }

        // Identität, die im Session-Storage landet
        return [
            'username' => $username,
            'is_admin' => false,
            'auth_source' => 'ldap',
        ];
    }

    /**
     * @return array<string, string>
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
