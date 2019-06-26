## Configuration de l'environnement de dev
- Copy `.env.example` into `.env` or run `make cenv`

## FrontEnd
- Install `yarn` in your computer
- Install project front-end dependencies `yarn install`

## BackEnd
- Install composer dependencies `make cinstall`
- Generate app key `make keygen`

## Database
- Add your database configuration
- Reload database schema `make fresh`
- Reload database schema with seeds `make seed`

## Quick lauch
- Run `make run` or `make watch` to compile and watch assets

## Docker app links
- PHP : [http://localhost](http://localhost)
- phpMyAdmin : [http://localhost:8080](http://localhost:8080)
- Maildev : [http://localhost:1080](http://localhost:1080)

## Dev mail configuration

```
MAIL_DRIVER=smtp
MAIL_HOST=maildev
MAIL_PORT=25
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
```

## Useful commands
- Enter into docker container `make enter`
- Clear cache `make ccache`
- Build application for production `make prod`
- Build `make build`
