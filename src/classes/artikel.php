<?php
// auteur: Dylan van schouwen
// functie: definitie class Artikel
namespace Bas\classes;

require_once __DIR__ . '/Database.php';

use Bas\classes\Database;

class artikel extends Database {
    private $table_name = "artikel";

    // Haal alle artikelen op
    public function getArtikelen(): array {
        $sql = "SELECT * FROM $this->table_name";
        $stmt = self::$conn->query($sql);
        return $stmt->fetchAll();
    }

    // Haal één artikel op basis van artId
    public function getArtikel(int $artId): ?array {
        $sql = "SELECT * FROM $this->table_name WHERE artId = :artId";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(['artId' => $artId]);
        $artikel = $stmt->fetch();
        return $artikel ? $artikel : null;
    }

    // Voeg een artikel toe
    public function insertArtikel(array $data): bool
    {
        $sql = "INSERT INTO $this->table_name 
        (artOmschrijving, artInkoop, artVerkoop, artVoorraad, artMinVoorraad, artMaxVoorraad, artLocatie)
        VALUES
        (:artOmschrijving, :artInkoop, :artVerkoop, :artVoorraad, :artMinVoorraad, :artMaxVoorraad, :artLocatie)";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([
            'artOmschrijving' => $data['artOmschrijving'],
            'artInkoop' => $data['artInkoop'],
            'artVerkoop' => $data['artVerkoop'],
            'artVoorraad' => $data['artVoorraad'],
            'artMinVoorraad' => $data['artMinVoorraad'],
            'artMaxVoorraad' => $data['artMaxVoorraad'],
            'artLocatie' => $data['artLocatie']
        ]);
    }

    // Wijzig een artikel
    public function updateArtikel(int $artId, array $data): bool {
        $sql = "UPDATE $this->table_name SET
            artOmschrijving = :artOmschrijving,
            artInkoop = :artInkoop,
            artVerkoop = :artVerkoop,
            artVoorraad = :artVoorraad,
            artMinVoorraad = :artMinVoorraad,
            artMaxVoorraad = :artMaxVoorraad,
            artLocatie = :artLocatie
            WHERE artId = :artId";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([
            'artOmschrijving' => $data['artOmschrijving'],
            'artInkoop' => $data['artInkoop'],
            'artVerkoop' => $data['artVerkoop'],
            'artVoorraad' => $data['artVoorraad'],
            'artMinVoorraad' => $data['artMinVoorraad'],
            'artMaxVoorraad' => $data['artMaxVoorraad'],
            'artLocatie' => $data['artLocatie'],
            'artId' => $artId
        ]);
    }

    // Verwijder een artikel
    public function deleteArtikel(int $artId): bool
    {
        try {
            $sql = "DELETE FROM $this->table_name WHERE artId = :artId";
            $stmt = self::$conn->prepare($sql);
            return $stmt->execute(['artId' => $artId]);
        } catch (\PDOException $e) {
            if ($e->getCode() == '23000') {
                // Foreign key constraint violation
                return false;
            }
            throw $e; // andere fouten opnieuw gooien
        }
    }
    // Zoek artikelen op ID
    public function zoekOpId(int $artId): array {
        $sql = "SELECT * FROM $this->table_name WHERE artId = :artId";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(['artId' => $artId]);
        return $stmt->fetchAll();
    }

    // Zoek artikelen op omschrijving (LIKE)
    public function zoekOpOmschrijving(string $omschrijving): array {
        $sql = "SELECT * FROM $this->table_name WHERE artOmschrijving LIKE :omschrijving";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(['omschrijving' => '%' . $omschrijving . '%']);
        return $stmt->fetchAll();
    }
}
?>