<?php
namespace Bas\classes;

require_once 'Database.php';

class gebruikers extends Database
{
    // Haal alle gebruikers op
    public function getGebruikers(): array
    {
        $stmt = self::$conn->query("SELECT * FROM gebruikers");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Zoek gebruiker op ID
    public function zoekOpId(int $gebruikersId): array
    {
        $stmt = self::$conn->prepare("SELECT * FROM gebruikers WHERE gebruikersId = :id");
        $stmt->execute(['id' => $gebruikersId]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $row ? [$row] : [];
    }

    // Zoek gebruikers op naam (LIKE)
    public function zoekOpNaam(string $naam): array
    {
        $stmt = self::$conn->prepare("SELECT * FROM gebruikers WHERE gebruikersNaam LIKE :naam");
        $stmt->execute(['naam' => "%$naam%"]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Voeg een gebruiker toe
    public function insertGebruiker(array $data): bool
    {
        $sql = "INSERT INTO gebruikers (gebruikersNaam, gebruikersEmail, gebruikersRol, gebruikersWachtwoord)
                VALUES (:naam, :email, :rol, :wachtwoord)";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([
            'naam'       => $data['gebruikersNaam'],
            'email'      => $data['gebruikersEmail'],
            'rol'        => $data['gebruikersRol'],
            'wachtwoord' => $data['gebruikersWachtwoord'] // Zorg dat dit gehashed is!
        ]);
    }

    // Update gebruiker
    public function updateGebruiker(int $gebruikersId, array $data): bool
    {
        $sql = "UPDATE gebruikers SET
                    gebruikersNaam = :naam,
                    gebruikersEmail = :email,
                    gebruikersRol = :rol
                WHERE gebruikersId = :id";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([
            'naam'  => $data['gebruikersNaam'],
            'email' => $data['gebruikersEmail'],
            'rol'   => $data['gebruikersRol'],
            'id'    => $gebruikersId
        ]);
    }

    // Optioneel: wachtwoord apart wijzigen
    public function updateWachtwoord(int $gebruikersId, string $wachtwoord): bool
    {
        $sql = "UPDATE gebruikers SET gebruikersWachtwoord = :wachtwoord WHERE gebruikersId = :id";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([
            'wachtwoord' => $wachtwoord,
            'id'         => $gebruikersId
        ]);
    }

    // Verwijder gebruiker
    public function deleteGebruiker(int $gebruikersId): bool
    {
        $stmt = self::$conn->prepare("DELETE FROM gebruikers WHERE gebruikersId = :id");
        return $stmt->execute(['id' => $gebruikersId]);
    }
}