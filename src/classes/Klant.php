<?php
// auteur: Dylan van schouwen
// functie: definitie class Klant
namespace Bas\classes;

use Bas\classes\Database;

include_once "functions.php";

class Klant extends Database
{
    private $table_name = "klant";

    // Haal alle klanten op
    public function getKlanten(): array
    {
        $sql = "SELECT klantId, klantNaam, klantEmail, klantAdres, klantPostcode, klantWoonplaats FROM $this->table_name";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Haal één klant op basis van klantId
    public function getKlantById(int $klantId): ?array
    {
        $sql = "SELECT * FROM $this->table_name WHERE klantId = :id";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(['id' => $klantId]);
        $result = $stmt->fetch();
        return $result ? $result : null;
    }

    // Voeg een klant toe
    public function insertKlant(array $data): bool
    {
        $sql = "INSERT INTO $this->table_name (klantNaam, klantEmail, klantAdres, klantPostcode, klantWoonplaats)
                VALUES (:naam, :email, :adres, :postcode, :woonplaats)";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([
            'naam'      => $data['klantNaam'],
            'email'     => $data['klantEmail'],
            'adres'     => $data['klantAdres'],
            'postcode'  => $data['klantPostcode'],
            'woonplaats' => $data['klantWoonplaats']
        ]);
    }

    // Update klantgegevens
    public function updateKlant(int $klantId, array $data): bool
    {
        $sql = "UPDATE $this->table_name SET
                    klantNaam = :naam,
                    klantEmail = :email,
                    klantAdres = :adres,
                    klantPostcode = :postcode,
                    klantWoonplaats = :woonplaats
                WHERE klantId = :id";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([
            'naam'      => $data['klantNaam'],
            'email'     => $data['klantEmail'],
            'adres'     => $data['klantAdres'],
            'postcode'  => $data['klantPostcode'],
            'woonplaats' => $data['klantWoonplaats'],
            'id'        => $klantId
        ]);
    }

    // Verwijder klant
    public function deleteKlant(int $klantId): bool
    {
        $sql = "DELETE FROM $this->table_name WHERE klantId = :id";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute(['id' => $klantId]);
    }

    // Toon een HTML-tabel van klanten
    public function showTable(array $lijst): void
    {
        if (empty($lijst)) {
            echo "<p>Geen klanten gevonden.</p>";
            return;
        }
        $txt = "<table>";

        // Voeg de kolomnamen boven de tabel
        $txt .= getTableHeader($lijst[0]);
        foreach ($lijst as $row) {
            $txt .= "<tr>";
            $txt .= "<td>" . htmlspecialchars($row["klantId"]) . "</td>";
            $txt .= "<td>" . htmlspecialchars($row["klantNaam"]) . "</td>";
            $txt .= "<td>" . htmlspecialchars($row["klantEmail"]) . "</td>";
            $txt .= "<td>" . htmlspecialchars($row["klantAdres"]) . "</td>";
            $txt .= "<td>" . htmlspecialchars($row["klantPostcode"]) . "</td>";
            $txt .= "<td>" . htmlspecialchars($row["klantWoonplaats"]) . "</td>";
            // Wijzig knop
            $txt .= "<td>
                <form method='get' action='update.php'>
                    <input type='hidden' name='klantId' value='" . htmlspecialchars($row["klantId"]) . "'>
                    <button type='submit' name='update'>Wijzig</button>
                </form>
            </td>";
            // Verwijder knop
            $txt .= "<td>
                <form method='post' action='delete.php' onsubmit=\"return confirm('Weet je zeker dat je deze klant wilt verwijderen?');\">
                    <input type='hidden' name='klantId' value='" . htmlspecialchars($row["klantId"]) . "'>
                    <button type='submit' name='verwijderen'>Verwijderen</button>
                </form>
            </td>";
            $txt .= "</tr>";
        }
        $txt .= "</table>";
        echo $txt;
    }

    // Toon een dropdown met klanten
    public function dropDownKlant($row_selected = -1)
    {
        $lijst = $this->getKlanten();
        echo "<label for='Klant'>Kies een klant:</label>";
        echo "<select name='klantId'>";
        foreach ($lijst as $row) {
            $selected = ($row_selected == $row["klantId"]) ? "selected='selected'" : "";
            echo "<option value='" . htmlspecialchars($row["klantId"]) . "' $selected>" .
                htmlspecialchars($row["klantNaam"]) . " (" . htmlspecialchars($row["klantEmail"]) . ")</option>\n";
        }
        echo "</select>";
    }

    // CRUD-overzicht
    public function crudKlant(): void
    {
        $lijst = $this->getKlanten();
        $this->showTable($lijst);
    }
    // Zoekfunctie op klantnaam
    public function zoekOpNaam(string $naam): array
    {
        $sql = "SELECT * FROM $this->table_name WHERE klantNaam LIKE :naam";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(['naam' => '%' . $naam . '%']);
        return $stmt->fetchAll();
    }
//zoekfunctie op postcode
    public function zoekOpPostcode(string $postcode): array
    {
        $sql = "SELECT * FROM $this->table_name WHERE klantPostcode LIKE :postcode";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(['postcode' => '%' . $postcode . '%']);
        return $stmt->fetchAll();
    }

}
