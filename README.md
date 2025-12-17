            TO START/UPDATE CONTAINERS
   COMMAND     PROJECT     COMPOSE YAML
docker compose -p dev -f compose.dev.yaml up -d --build
docker compose -p test -f compose.test.yaml up -d --build
docker compose -p prod -f compose.prod.yaml up -d --build

