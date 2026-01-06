<?php
declare(strict_types=1);

namespace App\Service\Ldap;

final class LdapService
{
    private string $host;
    private string $baseDn;
    private string $peopleDn;
    private string $groupsDn;
    private string $allowedGroup;

    public function __construct(
        string $host = 'ldap://localhost',
        string $baseDn = 'dc=bk-rheinbach,dc=net',
        string $peopleDn = 'ou=People,dc=bk-rheinbach,dc=net',
        string $groupsDn = 'ou=groups,dc=bk-rheinbach,dc=net',
        string $allowedGroup = 'verwaltung'
    ) {
        $this->host = $host;
        $this->baseDn = $baseDn;
        $this->peopleDn = $peopleDn;
        $this->groupsDn = $groupsDn;
        $this->allowedGroup = $allowedGroup;
    }

    /**
     * Zentrale Login-Methode
     */
    public function authenticate(string $username, string $password): bool
    {
        $conn = ldap_connect($this->host);
        if ($conn === false) {
            return false;
        }

        ldap_set_option($conn, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($conn, LDAP_OPT_REFERRALS, 0);

        // 1) Anonymer Bind für Suche
        if (@ldap_bind($conn) === false) {
            return false;
        }

        // 2) Benutzer suchen und DN ermitteln
        $userDn = $this->findUserDn($conn, $username);
        if ($userDn === null) {
            return false;
        }

        // 3) Passwort prüfen (Bind als Benutzer)
        if (@ldap_bind($conn, $userDn, $password) === false) {
            return false;
        }

        // 4) Gruppenmitgliedschaft prüfen
        if (! $this->isUserInAllowedGroup($conn, $userDn)) {
            return false;
        }

        return true;
    }

    /**
     * Sucht den Benutzer anhand uid und gibt den DN zurück
     */
    private function findUserDn($conn, string $username): ?string
    {
        $filter = sprintf(
            '(uid=%s)',
            ldap_escape($username, '', LDAP_ESCAPE_FILTER)
        );

        $search = ldap_search(
            $conn,
            $this->peopleDn,
            $filter,
            ['dn']
        );

        if ($search === false) {
            return null;
        }

        $entries = ldap_get_entries($conn, $search);

        if ($entries['count'] !== 1) {
            return null;
        }

        return $entries[0]['dn'];
    }

    /**
     * Prüft, ob der Benutzer Mitglied der erlaubten Gruppe ist
     */
    private function isUserInAllowedGroup($conn, string $userDn): bool
    {
        $filter = sprintf(
            '(&(objectClass=groupOfNames)(cn=%s)(member=%s))',
            ldap_escape($this->allowedGroup, '', LDAP_ESCAPE_FILTER),
            ldap_escape($userDn, '', LDAP_ESCAPE_FILTER)
        );

        $search = ldap_search(
            $conn,
            $this->groupsDn,
            $filter,
            ['cn']
        );

        if ($search === false) {
            return false;
        }

        $entries = ldap_get_entries($conn, $search);

        return $entries['count'] === 1;
    }
}
