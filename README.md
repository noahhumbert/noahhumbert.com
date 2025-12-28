            TO START/UPDATE CONTAINERS
<br>`docker compose -p dev -f compose.dev.yaml up -d --build`<br>
`docker compose -p prod -f compose.prod.yaml up -d --build`<br>
`docker compose -p db -f compose.db.yaml up -d --build`<br>


                  Docker Network
`The Containers are all running on the "network" network for use of only one SQL container`