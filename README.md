## Getting Started

### Docker
This project store docker images. Download docker application to your machine if you don't have it. Open your terminal:

    cd /path/to/your_project_folder
    docker-compose up -d --build
    
### Composer
Make composer install:

    docker-compose exec php composer install
    
### Code style and test
You can check code style and test locally:

    docker-compose exec php composer check
    
    docker-compose exec php ./vendor/bin/phpunit tests
