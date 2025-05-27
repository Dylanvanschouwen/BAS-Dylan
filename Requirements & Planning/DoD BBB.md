
# ✅ Definition of Done (DoD) – Project BBB (Boodschappenservice Bas van der Heijden)

## 📦 Algemene Criteria
- [ ] Functionaliteit werkt volledig zoals beschreven in de bijbehorende user story.
- [ ] Feature is volledig geïmplementeerd volgens **Objectgeoriënteerd Programmeren (OOP)**.
- [ ] Er wordt uitsluitend gebruikgemaakt van **PDO** voor database-interactie (geen `mysqli`).
- [ ] Elke CRUD-operatie (Create, Read, Update, Delete) is aanwezig indien van toepassing.
- [ ] Er is een aparte, werkende **database connectieklasse** (`Database.php` of vergelijkbaar).
- [ ] Elke pagina bevat:
  - [ ] Het logo en de naam “Bas Boodschappenservice”.
  - [ ] Een footer met het gratis Nederlandse telefoonnummer: **0800-11-11-216**.
  - [ ] Externe CSS voor styling (geen inline of interne CSS).

## 🧩 Ontwerp & Documentatie
- [ ] Elke sprint bevat minimaal:
  - [ ] Een wireframe van de userinterface (per functionaliteit).
  - [ ] Een class diagram met actuele klassen, attributen en methoden.
- [ ] Er is een **use case diagram** beschikbaar in de map `requirements & planning`.
- [ ] Een actuele **burndown chart** is beschikbaar en bijgewerkt na elke sprint.
- [ ] **Story points** zijn toegekend aan elke user story.
- [ ] Alle documentatiebestanden staan in de juiste mappen:
  - `requirements & planning`: DoD, use case diagram, burndown chart.
  - `ontwerp`: wireframes, ERD, classdiagram.
- [ ] Project is voorzien van een overzichtelijke en informatieve `README.md` in de root van de repository.

## 🔐 Gebruiksgemak & Rollen
- [ ] Er is een hoofdmenu waarin gebruikers hun **rol** kunnen kiezen (verkoper, bezorger, magazijnmedewerker, inkoper, etc.) – *Must Have*.
- [ ] Elke gebruiker ziet alleen de opties die relevant zijn voor zijn/haar rol – *Must Have*.
- [ ] (Could Have) Gebruikers kunnen inloggen met een gebruikersaccount en worden automatisch doorgestuurd naar hun rol-specifieke dashboard.
- [ ] Navigatie is duidelijk, eenvoudig en responsive.

## 🧪 Testen & Kwaliteit
- [ ] Elke PHP-klasse en methode is voorzien van een **unit test** met **PHPUnit**.
- [ ] Acceptatietests zijn uitgevoerd op alle functionaliteiten door de ontwikkelaar zelf.
- [ ] Applicatie is volledig werkend en foutloos getest binnen de **XAMPP-omgeving**.
- [ ] Code is overzichtelijk, herbruikbaar en voldoet aan PSR-12 conventies (optioneel, bonus).

## 🗃️ Database
- [ ] Database bevat minimaal de tabellen: `artikelen`, `klanten`, `leveranciers`, `verkooporders`, `inkooporders`.
- [ ] Tabellen zijn onderling verbonden met correcte **relaties en sleutels** (Foreign Keys).
- [ ] Data wordt op veilige wijze ingevoerd, aangepast, verwijderd en opgehaald via PDO.
- [ ] De SQL-structuur is gedocumenteerd in een **ERD** en toegevoegd in de `ontwerp` map.

## 📂 Git & Versiebeheer
- [ ] Alle wijzigingen zijn gecommit in Git met duidelijke commit messages (bijv. “Sprint 2 – verkooporder toevoegen afgerond”).
- [ ] Repository is **private** en bevat geen overtollige bestanden (zoals `.DS_Store`, `.vscode`, etc.).
- [ ] Docent **robwigmans** heeft toegang tot de repository via GitHub.
- [ ] De juiste link naar de repository is gedeeld via **Canvas**.
- [ ] Project is overzichtelijk gestructureerd met mappen zoals `classes`, `views`, `tests`, `styles`, `img`, `controllers`, etc.

## 🌟 Optionele Bonuspunten (Nice-to-Haves)
- [ ] Responsive design met basis ondersteuning voor mobiel/tablet.
- [ ] Login- en sessiebeheer met beveiliging (bijvoorbeeld met hashed wachtwoorden).
- [ ] Filters of zoekopties op meerdere velden (bijv. filteren op klantnaam én postcode).
- [ ] Interne logging of foutafhandeling bij mislukte databaseacties.
