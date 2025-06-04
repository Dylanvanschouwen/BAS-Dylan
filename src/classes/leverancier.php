<?php
namespace Bas\classes;

require_once 'Database.php';

class leverancier extends Database
{
    // Haal alle leveranciers op
    public function getLeveranciers(): array
    {
        $stmt = self::$conn->query("SELECT * FROM leverancier");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Zoek leverancier op ID
    public function zoekOpId(int $levId): ?array
    {
        $stmt = self::$conn->prepare("SELECT * FROM leverancier WHERE levId = :id");
        $stmt->execute(['id' => $levId]);
        return $stmt->fetch(\PDO::FETCH_ASSOC) ?: null;
    }

    // Zoek leveranciers op naam (LIKE)
    public function zoekOpNaam(string $naam): array
    {
        $stmt = self::$conn->prepare("SELECT * FROM leverancier WHERE levNaam LIKE :naam");
        $stmt->execute(['naam' => "%$naam%"]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Voeg een leverancier toe
    public function insertLeverancier(array $data): bool
    {
        $sql = "INSERT INTO leverancier (levNaam, levContact, levEmail, levAdres, levPostcode, levWoonplaats)
                VALUES (:naam, :contact, :email, :adres, :postcode, :woonplaats)";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([
            'naam'       => $data['levNaam'],
            'contact'    => $data['levContact'],
            'email'      => $data['levEmail'],
            'adres'      => $data['levAdres'],
            'postcode'   => $data['levPostcode'],
            'woonplaats' => $data['levWoonplaats']
        ]);
    }

    // Update leverancier
    public function updateLeverancier(int $levId, array $data): bool
    {
        $sql = "UPDATE leverancier SET
                    levNaam = :naam,
                    levContact = :contact,
                    levEmail = :email,
                    levAdres = :adres,
                    levPostcode = :postcode,
                    levWoonplaats = :woonplaats
                WHERE levId = :id";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([
            'naam'       => $data['levNaam'],
            'contact'    => $data['levContact'],
            'email'      => $data['levEmail'],
            'adres'      => $data['levAdres'],
            'postcode'   => $data['levPostcode'],
            'woonplaats' => $data['levWoonplaats'],
            'id'         => $levId
        ]);
    }

    // Verwijder leverancier
    public function deleteLeverancier(int $levId): bool
    {
        $stmt = self::$conn->prepare("DELETE FROM leverancier WHERE levId = :id");
        return $stmt->execute(['id' => $levId]);
    }
}