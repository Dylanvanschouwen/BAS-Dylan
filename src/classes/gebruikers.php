<?php
namespace Bas\classes;

require_once 'Database.php';

class gebruikers extends Database
{
    private $table_name = "gebruikers";

    // Haal alle gebruikers op
    public function getGebruikers(): array
    {
        $sql = "SELECT * FROM $this->table_name";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Haal één gebruiker op basis van gebruikersId
    public function getGebruikerById(int $gebruikersId): ?array
    {
        $sql = "SELECT * FROM $this->table_name WHERE id = :id";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(['id' => $gebruikersId]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result ? $result : null;
    }

    // Zoek gebruiker(s) op ID
    public function zoekOpId(int $gebruikersId): array
    {
        $row = $this->getGebruikerById($gebruikersId);
        return $row ? [$row] : [];
    }

    // Zoek gebruikers op naam
    public function zoekOpNaam(string $naam): array
    {
        $sql = "SELECT * FROM $this->table_name WHERE gebruikersnaam LIKE :naam";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(['naam' => '%' . $naam . '%']);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Zoek gebruikers op rol
    public function zoekOpRol(string $rol): array
    {
        $sql = "SELECT * FROM $this->table_name WHERE rol LIKE :rol";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(['rol' => '%' . $rol . '%']);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Voeg een gebruiker toe
    public function insertGebruiker(array $data): bool
    {
        $sql = "INSERT INTO $this->table_name (gebruikersnaam, wachtwoord, rol) VALUES (:naam, :wachtwoord, :rol)";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([
            'naam'       => $data['gebruikersnaam'],
            'wachtwoord' => $data['wachtwoord'], 
            'rol'        => $data['rol']
        ]);
    }

    // Update gebruiker (met optioneel wachtwoord)
    public function updateGebruiker(int $gebruikersId, array $data): bool
    {
        $params = [
            'naam' => $data['gebruikersnaam'],
            'rol'  => $data['rol'],
            'id'   => $gebruikersId
        ];

        if (isset($data['wachtwoord'])) {
            $sql = "UPDATE $this->table_name SET gebruikersnaam = :naam, rol = :rol, wachtwoord = :wachtwoord WHERE id = :id";
            $params['wachtwoord'] = $data['wachtwoord'];
        } else {
            $sql = "UPDATE $this->table_name SET gebruikersnaam = :naam, rol = :rol WHERE id = :id";
        }

        $stmt = self::$conn->prepare($sql);
        return $stmt->execute($params);
    }

    // Wachtwoord apart wijzigen
    public function updateWachtwoord(int $gebruikersId, string $wachtwoord): bool
    {
        $sql = "UPDATE $this->table_name SET wachtwoord = :wachtwoord WHERE id = :id";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([
            'wachtwoord' => $wachtwoord,
            'id'         => $gebruikersId
        ]);
    }

    // Verwijder gebruiker
    public function deleteGebruiker(int $gebruikersId): bool
    {
        $sql = "DELETE FROM $this->table_name WHERE id = :id";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute(['id' => $gebruikersId]);
    }

    // Toon een dropdown met gebruikers
    public function dropDownGebruiker($row_selected = -1)
    {
        $lijst = $this->getGebruikers();
        echo "<label for='Gebruiker'>Kies een gebruiker:</label>";
        echo "<select name='gebruikersId'>";
        foreach ($lijst as $row) {
            $selected = ($row_selected == $row["id"]) ? "selected='selected'" : "";
            echo "<option value='" . htmlspecialchars($row["id"]) . "' $selected>" .
                htmlspecialchars($row["gebruikersnaam"]) . " (" . htmlspecialchars($row["rol"]) . ")</option>\n";
        }
        echo "</select>";
    }
}