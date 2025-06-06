<?php
namespace Bas\classes;

require_once 'Database.php';

class verkooporders extends Database
{
    // Haal alle verkooporders op met klantinfo
    public function getOrdersWithKlantInfo() {
        $sql = "SELECT v.*, k.klantNaam, k.klantAdres, k.klantWoonplaats, k.klantPostcode
                FROM verkooporder v
                JOIN klant k ON v.klantId = k.klantId";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Haal één verkooporder op
    public function getVerkooporder($verkOrdId) {
        $sql = "SELECT v.*, k.klantNaam, k.klantAdres, k.klantWoonplaats, k.klantPostcode
                FROM verkooporder v
                JOIN klant k ON v.klantId = k.klantId
                WHERE v.verkOrdId = :id";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(['id' => $verkOrdId]);
        return $stmt->fetch();
    }

    // Update een verkooporder 
    public function updateVerkooporder(int $verkOrdId, array $data): bool {
        $sql = "UPDATE verkooporder SET
                    klantId = :klantId,
                    artId = :artId,
                    verkOrdDatum = :verkOrdDatum,
                    verkOrdBestAantal = :verkOrdBestAantal,
                    verkOrdStatus = :verkOrdStatus
                WHERE verkOrdId = :verkOrdId";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([
            'klantId'           => $data['klantId'],
            'artId'             => $data['artId'],
            'verkOrdDatum'      => $data['verkOrdDatum'],
            'verkOrdBestAantal' => $data['verkOrdBestAantal'],
            'verkOrdStatus'     => $data['verkOrdStatus'],
            'verkOrdId'         => $verkOrdId
        ]);
    }

    // Verwijder een verkooporder
    public function deleteVerkooporder(int $verkOrdId): bool {
        $sql = "DELETE FROM verkooporder WHERE verkOrdId = :id";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute(['id' => $verkOrdId]);
    }

    // Zet statusnummer om naar tekst
    public function statusText($status) {
        switch ($status) {
            case 0: return "Nieuw";
            case 1: return "In behandeling";
            case 2: return "Verzonden";
            case 3: return "Afgeleverd";
            case 4: return "Geannuleerd";
            default: return "Onbekend";
        }
    }

    // Geef alle mogelijke statussen terug als array (voor dropdowns)
    public function statusOptions() {
        return [
            0 => "Nieuw",
            1 => "In behandeling",
            2 => "Verzonden",
            3 => "Afgeleverd",
            4 => "Geannuleerd"
        ];
    }

    // Voeg een nieuwe verkooporder toe
    public function insertVerkooporder(array $data): bool {
        $sql = "INSERT INTO verkooporder (klantId, artId, verkOrdDatum, verkOrdBestAantal, verkOrdStatus)
                VALUES (:klantId, :artId, :verkOrdDatum, :verkOrdBestAantal, :verkOrdStatus)";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([
            'klantId'           => $data['klantId'],
            'artId'             => $data['artId'],
            'verkOrdDatum'      => $data['verkOrdDatum'],
            'verkOrdBestAantal' => $data['verkOrdBestAantal'],
            'verkOrdStatus'     => $data['verkOrdStatus']
        ]);
    }
    // Update de status van een verkooporder
    public function updateStatus(int $verkOrdId, int $status): bool
    {
        $stmt = self::$conn->prepare("UPDATE verkooporder SET verkOrdStatus = :status WHERE verkOrdId = :verkOrdId");
        return $stmt->execute([
            ':status' => $status,
            ':verkOrdId' => $verkOrdId
        ]);
    }// Zoek verkooporders op order ID
    public function zoekOpOrderId(int $verkOrdId) {
        $sql = "SELECT v.*, k.klantNaam, k.klantAdres, k.klantWoonplaats, k.klantPostcode
                FROM verkooporder v
                JOIN klant k ON v.klantId = k.klantId
                WHERE v.verkOrdId = :id";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(['id' => $verkOrdId]);
        return $stmt->fetchAll();
    }
// Zoek verkooporders op klant ID
    public function zoekOpKlantId(int $klantId) {
        $sql = "SELECT v.*, k.klantNaam, k.klantAdres, k.klantWoonplaats, k.klantPostcode
                FROM verkooporder v
                JOIN klant k ON v.klantId = k.klantId
                WHERE v.klantId = :klantId";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(['klantId' => $klantId]);
        return $stmt->fetchAll();
    }
// Zoek verkooporders op datum
    public function zoekOpDatum(string $datum) {
        $sql = "SELECT v.*, k.klantNaam, k.klantAdres, k.klantWoonplaats, k.klantPostcode
                FROM verkooporder v
                JOIN klant k ON v.klantId = k.klantId
                WHERE v.verkOrdDatum = :datum";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(['datum' => $datum]);
        return $stmt->fetchAll();
    }
}