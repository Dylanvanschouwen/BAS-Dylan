<?php
namespace Bas\classes;

require_once 'Database.php';

class verkooporders extends Database
{
    // Haal alle verkooporders op met klantinfo
    public function getOrdersWithKlantInfo() {
        $sql = "SELECT v.*, k.klantNaam, k.klantAdres, k.klantWoonplaats, 
                       k.klantPostcode
                FROM verkooporder v
                JOIN klant k ON v.klantId = k.klantId";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Update alleen de status van een verkooporder
    public function updateStatus($verkOrdId, $status) {
        $sql = "UPDATE verkooporder SET verkOrdStatus = :status WHERE verkOrdId = :id";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(['status' => $status, 'id' => $verkOrdId]);
    }

    // Zet statusnummer om naar tekst
    public function statusText($status) {
        switch ($status) {
            case 1: return "In behandeling";
            case 2: return "Onderweg";
            case 3: return "Afgeleverd";
            case 4: return "Geannuleerd";
            default: return "Onbekend";
        }
    }
}