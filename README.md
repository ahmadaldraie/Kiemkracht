# Kiemkracht

Kiemkracht repository is een proef opdracht voor een sollitatie bij Kiem Kracht.

## Functionaliteiten

- Een formulier waarmee de klanten hun gegevens (voornaam, achternaam, email) met een kassaticket kunnen invoeren
- **Alleen voor geauthenticeerde gebruikers met een beheerdersrol.** Een pagina waar u alle kassatickets van de klanten kunt bekijken, zoeken of verwijderen.
- **Alleen voor geauthenticeerde gebruikers met een beheerdersrol.** Een pagina waar u alle klanten kunt bekijken, zoeken, verwijderen, of zijn gegevens wijzegen.

## Installatie

Volg de stappen hieronder om het project lokaal te draaien:

1. **Clone de repository**
   ```bash
   git clone https://github.com/ahmadaldraie/Kiemkracht.git
   cd Kiemkracht
   ```

2. **Installeer afhankelijkheden**
   Zorg ervoor dat je PHP/Laravel, composer, en Node.js hebt geïnstalleerd en voer daarna:
   ```bash
   composer install
   npm install
   ```

3. **Maak een `.env` bestand**
   Kopieer het `.env.example` bestand naar `.env` en stel de juiste configuratie in:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```


5. **Start de applicatie**
   ```bash
   npm run build
   php artisan serve
   ```
   Bezoek vervolgens de applicatie in je browser op `http://localhost:8000`.
   #NOTE: U kan altijd op de logo in de hoek kliken om terug naar de index pagina te gaan.