TOO START/UPDATE CONTAINERS
   docker compose -p dev -f compose.dev.yaml up -d --build
   docker compose -p prod -f compose.prod.yaml up -d --build
   docker compose -p db -f compose.db.yaml up -d --build


Docker Network
   All containers live in a network named "Network"
   docker network create network