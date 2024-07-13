## Learning Laravel
```
php artisan serve
php artisan migrate
php artisan db:seed
```
[http://localhost:8000/api/documentation](http://localhost:8000/api/documentation)


## Run project docker
```
docker compose up -d
docker-compose up --build -d
```

## Create image to docker hub
```
docker build -t pv113_image .
docker login
docker tag pv113_image:latest sash0o0k/pv113_laravel:latest
docker push sash0o0k/pv113_laravel:latest
```

### Pull docker image in server
```
docker login
docker-compose pull
docker compose stop
docker compose up -d
docker ps -a
```

## Run Database Docker image
```
docker pull mysql:8.0
docker images

docker run --name container-mysql \
	--restart=always \
	-e MYSQL_ROOT_PASSWORD=Usl387KJndksuOwsdj**djks \
	-e MYSQL_DATABASE=laravel \
	-p 3309:3306 \
	-v //data/db:/var/lib/mysql \
	-d mysql:8.0
	
DBeaver add flag allowPublicKeyRetrieval - true
```

