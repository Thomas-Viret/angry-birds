Routes possibles :

| URL          | Méthode HTTP | Controller       | Méthode    | Titre                   | Commentaire                      |
| ------------ | ------------ | ---------------- | ---------- | ----------------------- | -------------------------------- |
| `/`          | `GET`        | `BirdController` | `home`     | Angrybirds              | Liste des oiseaux                | - |
| `/bird/{id}` | `GET`        | `BirdController` | `show`     | Angrybirds - {birdName} | Détail d'un oiseau               |
| `/download`  | `GET`        | `BirdController` | `download` | Angrybirds - Download   | Téléchargement du calendrier PDF |
| `/api/birds` | `GET`        | `ApiController`  | `birds`    | -                       | JSON du tableau d'oiseaux        |
