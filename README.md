TOO START/UPDATE CONTAINERS
   <br>docker compose -p dev -f compose.dev.yaml up -d --build
   <br>docker compose -p prod -f compose.prod.yaml up -d --build
   <br>docker compose -p db -f compose.db.yaml up -d --build


Docker Network
   <br>All containers live in a network named "Network"
   <br>docker network create network