<?php
namespace Bas\classes;

require_once 'Database.php';

class inkooporder extends Database
{
    // Haal alle inkooporders op
    public function getInkooporders(): array
    {
        $stmt = self::$conn->query("SELECT * FROM inkooporder");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Zoek inkooporder op ID
    public function zoekOpId(int $inkOrdId): ?array
    {
        $stmt = self::$conn->prepare("SELECT * FROM inkooporder WHERE inkOrdId = :id");
        $stmt->execute(['id' => $inkOrdId]);
        return $stmt->fetch(\PDO::FETCH_ASSOC) ?: null;
    }

    // Zoek inkooporders op leverancier-ID
    public function zoekOpLeverancier(string $levId): array
    {
        $stmt = self::$conn->prepare("SELECT * FROM inkooporder WHERE levId = :levId");
        $stmt->execute(['levId' => $levId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Voeg een inkooporder toe
    public function insertInkooporder(array $data): bool
    {
        $sql = "INSERT INTO inkooporder (levId, artId, inkOrdDatum, inkOrdBestAantal, inkOrdStatus)
                VALUES (:levId, :artId, :datum, :aantal, :status)";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([
            'levId'   => $data['levId'],
            'artId'   => $data['artId'],
            'datum'   => $data['inkOrdDatum'],
            'aantal'  => $data['inkOrdBestAantal'],
            'status'  => $data['inkOrdStatus']
        ]);
    }

    // Update inkooporder
    public function updateInkooporder(int $inkOrdId, array $data): bool
    {
        $sql = "UPDATE inkooporder SET
                    levId = :levId,
                    artId = :artId,
                    inkOrdDatum = :datum,
                    inkOrdBestAantal = :aantal,
                    inkOrdStatus = :status
                WHERE inkOrdId = :id";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([
            'levId'   => $data['levId'],
            'artId'   => $data['artId'],
            'datum'   => $data['inkOrdDatum'],
            'aantal'  => $data['inkOrdBestAantal'],
            'status'  => $data['inkOrdStatus'],
            'id'      => $inkOrdId
        ]);
    }

    // Verwijder inkooporder
    public function deleteInkooporder(int $inkOrdId): bool
    {
        $stmt = self::$conn->prepare("DELETE FROM inkooporder WHERE inkOrdId = :id");
        return $stmt->execute(['id' => $inkOrdId]);
    }
}
?>
