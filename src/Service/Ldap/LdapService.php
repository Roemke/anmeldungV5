<?php
declare(strict_types=1);

namespace App\Service\Ldap;

final class LdapService
{
    private string $host;
    private string $baseDn;

    public function __construct(
        string $host = 'ldap://localhost',
        string $baseDn = 'ou=people,dc=local,dc=dev'
    ) {
        $this->host = $host;
        $this->baseDn = $baseDn;
    }

    public function authenticate(string $username, string $password): bool
    {
        $conn = ldap_connect($this->host);
        if ($conn === false) {
            return false;
        }

        ldap_set_option($conn, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($conn, LDAP_OPT_REFERRALS, 0);

        $dn = sprintf('uid=%s,%s', $username, $this->baseDn);

        return @ldap_bind($conn, $dn, $password);
    }
}
